<?php
class ControllerModuleDisqus extends Controller {
	private $error = array(); 
	private $version = '1.0';
	
	public function index() {   
		$this->load->language('module/disqus');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('disqus', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title') . ' v' . $this->version;

		$this->data['tab_settings']  = $this->language->get('tab_settings');
		$this->data['tab_extension']  = $this->language->get('tab_extension');
		
		$this->data['text_heading_title']  = $this->language->get('text_heading_title');
		$this->data['text_enabled']        = $this->language->get('text_enabled');
		$this->data['text_disabled']       = $this->language->get('text_disabled');
		$this->data['text_content_top']    = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left']    = $this->language->get('text_column_left');
		$this->data['text_column_right']   = $this->language->get('text_column_right');
		
		$this->data['entry_disqus_shortname']	= $this->language->get('entry_disqus_shortname');
		$this->data['entry_layout'] 	   		= $this->language->get('entry_layout');
		$this->data['entry_position']      		= $this->language->get('entry_position');
		$this->data['entry_status']        		= $this->language->get('entry_status');
		$this->data['entry_sort_order']    		= $this->language->get('entry_sort_order');
		
		$this->data['button_save']         = $this->language->get('button_save');
		$this->data['button_cancel']       = $this->language->get('button_cancel');
		$this->data['button_add_module']   = $this->language->get('button_add_module');
		$this->data['button_remove']       = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['disqus_shortname'])) {
			$this->data['error_disqus_shortname'] = $this->error['disqus_shortname'];
		} else {
			$this->data['error_disqus_shortname'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/disqus', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/disqus', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->update_check();
		
		if (isset($this->error['update'])) {
			$this->data['update'] = $this->error['update'];
		} else {
			$this->data['update'] = '';
		}
		
		if (isset($this->request->post['disqus_shortname'])){
			$this->data['disqus_shortname'] = $this->request->post['disqus_shortname'];
		} elseif ($this->config->get('disqus_shortname')) {
			$this->data['disqus_shortname'] = $this->config->get('disqus_shortname');
		} else {
			$this->data['disqus_shortname'] = '';
		}
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['disqus_module'])) {
			$this->data['modules'] = $this->request->post['disqus_module'];
		} elseif ($this->config->get('disqus_module')) { 
			$this->data['modules'] = $this->config->get('disqus_module');
		}				
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/disqus.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/disqus')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (strlen($this->request->post['disqus_shortname']) < 3){
			$this->error['disqus_shortname'] = $this->language->get('error_disqus_shortname');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	private function update_check() {
		if (extension_loaded('curl')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'v='.$this->version.'&ex=6&e='.urlencode($this->config->get('config_email')));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);
			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}	
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			if ($http_code == 200) {
				$result = json_decode($result);
				
				if ( isset($result->version) && ($result->version > $this->version) ) {
						$this->error['update'] = 'A new version of ' . $this->language->get('heading_title') . ' is available: v' . $result->version . '. You can go to <a target="_blank" href="' . $result->url . '">extension page</a> to see the Changelog.';
				}
			}
		} else {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);
			
			$data = 'v='.$this->version.'&ex=6&e='.$this->config->get('config_email');
			
			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}	
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;
			
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				
				if ($at_start) {
					$at_start = false;
					
					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}
					
					$http_code = $m[2];
					continue;
				}
				
				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}
					
					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}
					
					continue;
				}
				
                $response .= $line;
			}
					
			fclose($fp);
			
			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}
				
				$result = json_decode($response);
				
				if ( isset($result->version) && ($result->version > $this->version) ) {
						$this->error['update'] = 'A new version of ' . $this->language->get('heading_title') . ' is available: v' . $result->version . '. You can go to <a target="_blank" href="' . $result->url . '">extension page</a> to see the Changelog.';
				}
			}
		}
	}
}
?>