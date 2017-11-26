<?php
class ControllerModuleAdvReports extends Controller {
	private $error = array(); 

	public function index() {  		
		$this->load->language('module/adv_reports');
		
		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['heading_title'] = $this->language->get('heading_title');
			
		$this->data['tab_about'] = $this->language->get('tab_about');
		
		$this->data['text_help_request'] = $this->language->get('text_help_request');
		$this->data['text_asking_help'] = $this->language->get('text_asking_help');		
		$this->data['text_terms'] = $this->language->get('text_terms');		

		$this->data['adv_so_ext_version'] = '';
		$this->data['adv_pp_ext_version'] = '';
		$this->data['adv_co_ext_version'] = '';

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['error_vqmod'] = $this->language->get('error_vqmod');
        $this->data['vqmod_available'] = $this->VQModAvailable();
		
		$this->data['button_cancel'] = $this->language->get('button_cancel');	
		
		$this->data['token'] = $this->session->data['token'];
		
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
			'href'      => $this->url->link('module/adv_reports', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
				
		$this->template = 'module/adv_reports.tpl';

		$this->children = array(
			'common/header',
			'common/footer',
		);	
		
		$this->response->setOutput($this->render());
	}
	
	public function install(){
		// Optimize all tables
		//$alltables = mysql_query("SHOW TABLES");
		//while ($table = mysql_fetch_assoc($alltables)) {
		//	foreach ($table as $db => $tablename) {
		//		mysql_query("OPTIMIZE TABLE `" . $tablename . "`")
		//		or die(mysql_error());
		//	}
		//}
		
		// Add indexes
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_product` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_product` ADD INDEX (product_id,total,price,tax,quantity);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_product` ADD INDEX (order_id);");
			}	
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_total` WHERE Key_name != 'PRIMARY' AND Key_name != 'idx_orders_total_orders_id';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_total` ADD INDEX (order_id,value,code);");
			}	
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_option` ADD INDEX (order_product_id,type,name,product_option_value_id);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_option` ADD INDEX (order_id);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_history` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_history` ADD INDEX (order_status_id);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_history` ADD INDEX (order_id);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD INDEX (customer_id,date_added,total,email,firstname,lastname,payment_company);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD INDEX (product_id,model,sku,manufacturer_id,sort_order,status);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "category` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD INDEX (category_id,parent_id);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option` ADD INDEX (sort_order);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_description` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_description` ADD INDEX (name);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_value` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_value` ADD INDEX (option_id,sort_order);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_value_description` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_value_description` ADD INDEX (option_id,name);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product_option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option` ADD INDEX (product_id,option_id);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product_option_value` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` ADD INDEX (product_id,option_id,option_value_id,quantity,price);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` ADD INDEX (product_option_id);");
			}

		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'module/adv_reports');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'module/adv_reports');	
	}

	public function uninstall(){
		$this->load->model('setting/extension');
		$this->model_setting_extension->uninstall('module', 'adv_reports');
	}
	
	private function VQModAvailable() {
		if (class_exists('VQModObject')) {
			return true;
		}
		return false;
	}
}
?>