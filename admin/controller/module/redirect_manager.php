<?php
//==============================================================================
// Redirect Manager v156.2
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
//==============================================================================

class ControllerModuleRedirectManager extends Controller { 
	private $error = array();
	private $type = 'module';
	private $name = 'redirect_manager';
	
	public function index() {
		// non-standard
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "redirect` (";
		$sql .= " `redirect_id` int(11) NOT NULL AUTO_INCREMENT,";
		$sql .= " `active` tinyint(1) NOT NULL DEFAULT '0',";
		$sql .= " `from_url` text COLLATE utf8_bin NOT NULL,";
		$sql .= " `to_url` text COLLATE utf8_bin NOT NULL,";
		$sql .= " `response_code` int(3) NOT NULL DEFAULT '301',";
		$sql .= " `date_start` date NOT NULL DEFAULT '0000-00-00',";
		$sql .= " `date_end` date NOT NULL DEFAULT '0000-00-00',";
		$sql .= " `times_used` int(5) NOT NULL DEFAULT '0',";
		$sql .= " PRIMARY KEY (`redirect_id`)";
		$sql .= ") ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin";
		$this->db->query($sql);
		// end
		
		$this->data['type'] = $this->type;
		$this->data['name'] = $this->name;
		
		$token = $this->data['token'] = (isset($this->session->data['token'])) ? $this->session->data['token'] : '';
		$version = $this->data['version'] = (!defined('VERSION')) ? 140 : (int)substr(str_replace('.', '', VERSION), 0, 3);
		
		$this->data = array_merge($this->data, $this->load->language($this->type . '/' . $this->name));
		$this->data['exit'] = $this->makeURL('extension/' . $this->type, 'token=' . $token, 'SSL');
		$this->load->model('setting/setting');
		
		// non-standard
		$sorts = array('active', 'from_url', 'to_url', 'response_code', 'date_start', 'date_end', 'times_used');
		$this->data['sort'] = (isset($this->request->get['sort']) && in_array($this->request->get['sort'], $sorts)) ? $this->request->get['sort'] : 'from_url';
		
		$orders = array('ASC', 'DESC');
		$this->data['order'] = (isset($this->request->get['order']) && in_array($this->request->get['order'], $orders)) ? $this->request->get['order'] : 'ASC';
		
		$page = (isset($this->request->get['page'])) ? (int)$this->request->get['page'] : 1;
		$limit = (int)$this->config->get('config_admin_limit');
		// end
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			// non-standard
			$this->model_setting_setting->editSetting($this->name, array(
				$this->name . '_status'		=> $this->request->post[$this->name . '_status']
			));
			
			if (!empty($this->request->get['delall'])) {
				$this->db->query("TRUNCATE `" . DB_PREFIX . "redirect`");
			} else {
				if (!empty($this->request->post['data'])) {
					foreach ($this->request->post['data'] as $key => $value) {
						$from_url = (strpos($value['from_url'], 'http://') === 0 || strpos($value['from_url'], 'https://') === 0) ? $value['from_url'] : 'http://' . $value['from_url'];
						$to_url = (strpos($value['to_url'], 'http://') === 0 || strpos($value['to_url'], 'https://') === 0) ? $value['to_url'] : 'http://' . $value['to_url'];
						
						$sql = ($key < 0) ? "INSERT INTO `" : "UPDATE `";
						$sql .= DB_PREFIX . "redirect` SET";
						$sql .= " active = '" . (int)$value['active'] . "',";
						$sql .= " from_url = '" . $this->db->escape(trim($from_url)) . "',";
						$sql .= " to_url = '" . $this->db->escape(trim($to_url)) . "',";
						$sql .= " response_code = '" . (int)$value['response_code'] . "',";
						$sql .= " date_start = '" . $this->db->escape($value['date_start']) . "',";
						$sql .= " date_end = '" . $this->db->escape($value['date_end']) . "',";
						$sql .= " times_used = '" . (int)$value['times_used'] . "'";
						$sql .= ($key < 0) ? "" : " WHERE redirect_id = '" . (int)$key . "'";
						
						$this->db->query($sql);
					}
				}
				if (!empty($this->request->post['deleted'])) {
					$this->db->query("DELETE FROM `" . DB_PREFIX . "redirect` WHERE redirect_id = '" . implode("' OR redirect_id = '", $this->request->post['deleted']) . "'");
				}
			}
			
			if (!empty($this->request->get['resetall'])) {
				$this->db->query("UPDATE `" . DB_PREFIX . "redirect` SET times_used = '0'");
			}
			
			if (!empty($this->request->get['import'])) {
				$this->importCSV();
			}
			
			file_put_contents(DIR_LOGS.'clearthinking.txt',date('Y-m-d H:i:s')."\t".$this->request->server['REMOTE_ADDR']."\t".serialize($this->request->post[$this->name.'_status'])."\n",FILE_APPEND|LOCK_EX);
			$this->session->data['success'] = $this->data['standard_success'];
			$this->redirect(isset($this->request->get['exit']) ? $this->data['exit'] : $this->makeURL($this->type . '/' . $this->name, 'token=' . $token . '&sort=' . $this->data['sort'] . '&order=' . $this->data['order'] . '&page=' . $page, 'SSL'));
			// end
		}
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			'href'		=> $this->makeURL('common/home', 'token=' . $token, 'SSL'),
			'text'		=> $this->language->get('text_home'),
			'separator' => false
		);
		$breadcrumbs[] = array(
			'href'		=> $this->makeURL('extension/' . $this->type, 'token=' . $token, 'SSL'),
			'text'		=> $this->language->get('standard_' . $this->type),
			'separator' => ' :: '
		);
		$breadcrumbs[] = array(
			'href'		=> $this->makeURL($this->type . '/' . $this->name, 'token=' . $token, 'SSL'),
			'text'		=> $this->language->get('heading_title'),
			'separator' => ' :: '
		);
		
		$this->data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$this->data['success'] = (isset($this->session->data['success'])) ? $this->session->data['success'] : '';
		unset($this->session->data['success']);
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `group` = '" . $this->db->escape($this->name) . "' ORDER BY `key` ASC");
		foreach ($query->rows as $setting) {
			$value = isset($this->request->post[$setting['key']]) ? $this->request->post[$setting['key']] : $setting['value'];
			$this->data[$setting['key']] = (is_string($value) && strpos($value, 'a:') === 0) ? unserialize($value) : $value;
		}
		
		// non-standard
		$results = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` ORDER BY " . $this->data['sort'] . " " . $this->data['order'] . " LIMIT " . (($page-1) * $limit) . "," . $limit);
		$this->data['results'] = $results->rows;
		
		$all_results = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "redirect`");
		
		$pagination = new Pagination();
		$pagination->total = $all_results->row['total'];
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->data['text_pagination'];
		$pagination->url = $this->makeURL($this->type . '/' . $this->name, 'token=' . $token . '&sort=' . $this->data['sort'] . '&order=' . $this->data['order'] . '&page={page}', 'SSL');
		$this->data['pagination'] = $pagination->render();
		// end
		
		$this->template = $this->type . '/' . $this->name . '.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		if ($version < 150) {
			$this->document->title = $this->data['heading_title'];
			$this->document->breadcrumbs = $breadcrumbs;
			$this->response->setOutput($this->render(true), $this->config->get('config_compression'));
		} else {
			$this->document->setTitle($this->data['heading_title']);
			$this->data['breadcrumbs'] = $breadcrumbs;
			$this->response->setOutput($this->render());
		}
	}
	
	private function makeURL($route, $args = '', $connection = 'NONSSL') {
		if (!defined('VERSION') || VERSION < 1.5) {
			$url = ($connection == 'NONSSL') ? HTTP_SERVER : HTTPS_SERVER;
			$url .= 'index.php?route=' . $route;
			$url .= ($args) ? '&' . ltrim($args, '&') : '';
			return $url;
		} else {
			return $this->url->link($route, $args, $connection);
		}
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', $this->type . '/' . $this->name)) {
			$this->error['warning'] = $this->data['standard_error'];
		}
		if (!empty($this->request->get['import']) && !is_uploaded_file($this->request->files['import_file']['tmp_name'])) {
			$this->error['warning'] = 'File error';
		}
		return ($this->error) ? false : true;
	}
	
	public function exportCSV() {
		if (!$this->user->hasPermission('access', $this->type . '/' . $this->name)) return;
		
		header('Pragma: public');
		header('Expires: 0');
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $this->name . '.csv');
		header('Content-Transfer-Encoding: binary');
		
		$results = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` ORDER BY redirect_id ASC");
		echo implode(',', array_keys($results->row)) . "\n";
		foreach ($results->rows as $result) {
			echo implode(',', str_replace('"', '%22', $result)) . "\n";
		}
		exit();
	}
	
	private function importCSV() {
		$contents = file_get_contents($this->request->files['import_file']['tmp_name']);
		
		foreach (explode("\n", str_replace('"', '', $contents)) as $num => $row) {
			if (!$num || empty($row)) continue;
			
			$col = explode(',', $row);
			$redirect_id = (!empty($col[0])) ? "redirect_id = " . (int)$col[0] . "," : '';
			
			$sql = "
				active = " . (int)$col[1] . ",
				from_url = '" . $this->db->escape($col[2]) . "',
				to_url = '" . $this->db->escape($col[3]) . "',
				response_code = " . (int)$col[4] . ",
				date_start = '" . $this->db->escape($col[5]) . "',
				date_end = '" . $this->db->escape($col[6]) . "',
				times_used = " . (int)$col[7] . "
			";
			
			$this->db->query("INSERT INTO `" . DB_PREFIX . "redirect` SET " . $redirect_id . $sql . " ON DUPLICATE KEY UPDATE " . $sql);
		}
	}
}
?>