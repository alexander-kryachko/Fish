<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}
		
		// Decode URL
		$this->load->model('catalog/ocfilter');
		
		
		if (isset($this->request->get[$this->ocfilter['index']])){
			$redirect = rtrim('http://'.$_SERVER['HTTP_HOST'].'/'.$this->request->get['_route_'], '/');
			$n = 0;
			$values = array();
			foreach(explode(';', $this->request->get[$this->ocfilter['index']]) as $f){
				list($key, $fvals) = explode(':', $f);
				$vals = explode(',', $fvals);
				$values = array_merge($values, $vals);
			}
			$query = $this->db->query('SELECT o.option_id, ov.value_id, a.keyword
				FROM '.DB_PREFIX.'ocfilter_option o
				INNER JOIN '.DB_PREFIX.'ocfilter_option_value ov on (ov.option_id = o.option_id)
				INNER JOIN '.DB_PREFIX.'url_alias a on (a.query = CONCAT("ocfilter:", o.option_id, ":", ov.value_id))
				WHERE ov.value_id IN ('.implode(',', $values).')
				ORDER BY o.sort_order, ov.sort_order');
			$currentOpt = false;
			if (!empty($query->rows)) foreach ($query->rows as $key => $result){
				$redirect .= ($currentOpt == $result['option_id'] ? ',' : '/'). $result['keyword'];
				$currentOpt = $result['option_id'];
			}
			foreach($_GET as $k => $v){
				if (in_array($k, array('_route_', $this->ocfilter['index']))) continue;
				$redirect .= ($n++ ? '&' : '?').$k.'='.$v;
			}
			header('Location: '.$redirect);
			exit();
		}
	
		if (isset($this->request->get['_route_'])){
			$parts = explode('/', $this->request->get['_route_']);
			if (count($parts) == 1){
				$parts = explode('_', $this->request->get['_route_']);
				$fixedFilterPath = true;
			}
			
			//$fullquery = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'url_alias WHERE keyword = "'. $this->db->escape($this->request->get['_route_']) . '"');
			//if ($fullquery->num_rows) $parts = array($this->request->get['_route_']);
		
			//BOF: OCFilter
			$ocfilters = array();
			for($i=count($parts)-1;$i>=0;$i--){
				if (!strlen($parts[$i])){
					unset($parts[$i]);
					continue;
				}
				$subparts = explode(',', $parts[$i]);
				$break = false;
				foreach($subparts as $subpart){
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` LIKE 'ocfilter:%' AND `keyword` = '" . $this->db->escape($subpart) . "'");
					if (!$query->num_rows) {
						$break = true;
						break;
						//continue;
					}
					$data = explode(':', $query->row['query']);
					if (!isset($ocfilters[$data[1]])) $ocfilters[$data[1]] = array();
					$ocfilters[$data[1]][] = $data[2];
				}
				if ($break) break;
				unset($parts[$i]);
			}
	
			if (!empty($ocfilters)){
				if (empty($fixedFilterPath)){
					//redirect
					$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: '.$host . strtr(ltrim(htmlspecialchars_decode($_SERVER['REQUEST_URI']), '/'), array('/' => '_')));
					exit();
				}
				$str = '';
				foreach($ocfilters as $k => $v){
					$str .= $k.':' .implode(',',$v). ';';
				}
				$this->request->get[$this->ocfilter['index']] = substr($str, 0, -1);
			}

			global $ocAliases;
			$ocAliases = array();
			$query = $this->db->query("SELECT `keyword`, `query` FROM " . DB_PREFIX . "url_alias WHERE `query` LIKE 'ocfilter:%'");
			if (!empty($query->rows)) foreach ($query->rows as $key => $result){
				$data = explode(':', $result['query']);
				$ocAliases[$data[2]] = $result['keyword'];
			}
			//EOF: OCFilter

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
				
				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);
					
					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}
					
					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}	
					
					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}
					
					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}	
				} else {
					$this->request->get['route'] = 'error/not_found';				
				}
			}
			
			if(!isset($this->request->get['route'])){
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product';
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category';
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info';
				} elseif (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information';
				}
 			}
			
			/* BOF: FIX "_" IN CATEGORIES */
			if (empty($ocfilters) && !empty($fixedFilterPath) && $this->request->get['route'] == 'product/category' && strpos($_SERVER['REQUEST_URI'], '_') !== false){
				//redirect
				$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: '.$host . strtr(ltrim($_SERVER['REQUEST_URI'], '/'), array('_' => '/')));
				exit();
			}
			/* EOF: FIX "_" IN CATEGORIES */

			if (isset($this->request->get['route'])) {
				return $this->forward($this->request->get['route']);
			}
		}
		
		
	}
	
	public function rewrite($link) {
		
		$url_info = parse_url(str_replace('&amp;', '&', $link));
		$url = ''; 
		$data = array();
		parse_str($url_info['query'], $data);
		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
				
					if ($query->num_rows) {
						$url .= '/' . $query->row['keyword'];
						
						unset($data[$key]);
					}					
				} elseif ($key == 'path') {
					if (isset($data['route']) && $data['route'] == 'product/product'){
						unset($data[$key]);
					} else {
						$categories = explode('_', $value);
						
						foreach ($categories as $category) {
							$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
					
							if ($query->num_rows) {
								$url .= '/' . $query->row['keyword'];
							}							
						}
						unset($data[$key]);
					}
				}
			}
		}
	
		if ($url) {
			unset($data['route']);
		
			$query = '';
		
			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . $key . '=' . $value;
				}
				
				if ($query) {
					$query = '?' . trim($query, '&');
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}	
}
?>