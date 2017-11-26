<?php
class ControllerExtensionHbOosn extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		$this->load->language('extension/hb_oosn');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		$this->load->model('setting/hb_oosn');
		
		if ($this->config->get('hb_oosn_installed') <> 1){
			$this->redirect($this->url->link('extension/hb_oosn/install', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('hb_oosn', $this->request->post);	
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		if(isset($this->request->get['delete'])){    
            $delete = $this->request->get['delete'];
			$this->model_setting_hb_oosn->deleteRecords($delete);
			$this->session->data['success'] = $this->language->get('text_reset_success');
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		if (isset($this->request->get['filteroption'])) {
    		$filteroption = $this->request->get['filteroption'];
            $this->data['current_report'] = $this->language->get('tile_'.$filteroption); 
		}else {
			$filteroption = 'all';
    	    $this->data['current_report'] = $this->language->get('tile_all'); 
		}
		$reports_total = $this->model_setting_hb_oosn->getTotalReports($filteroption); 
		
		$this->data['products'] = array();

		$results = $this->model_setting_hb_oosn->getReports($data,$filteroption);

		foreach ($results as $result) {
			
			$this->data['products'][] = array(
				'product_id'    => $result['product_id'],
				'name'   => $result['name'],
				'selected_option'   => ($result['selected_option'] == '0')?'NA':$result['selected_option'],
				'all_selected_option'   => ($result['all_selected_option'] == '0')?'NA':$result['all_selected_option'],
				'email'   => $result['email'],
				'fname'   => $result['fname'],
				'phone'   => $result['phone'],
				'language_code'   => $result['language_code'],
				'enquiry_date'  => date("d M Y g:i A", strtotime($result['enquiry_date'])),
				'notify_date'  => (!empty($result['notified_date']))? date("d M Y g:i A", strtotime($result['notified_date'])) : '',
                'product_link' => $this->url->link('catalog/product/update&product_id='.$result['product_id'], 'token=' . $this->session->data['token'], 'SSL')
			);
		}
		
		$pagination = new Pagination();
		$pagination->total = $reports_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['demands'] = $this->model_setting_hb_oosn->getDemandedList();

		$text_strings = array(
				'heading_title',
				'button_save',
				'button_cancel',
				'tab_records',
				'tab_demand',
				'tab_email',
				'tab_setting',
				'tile_all','tile_awaiting','tile_archive',
				'header_product',
				'header_others',
				'header_sitemaps',
				'header_allstore',
				'text_no_results',
				'column_product_id',
				'column_product_name',
				'column_email',
				'column_name',
				'column_phone',
				'column_option',
				'column_all_option',
				'column_language', 
				'column_enquiry_date', 
				'column_notify_date',
				'text_notify_customers',
				'text_total_alert',
				'text_total_responded',
				'text_show_all_reports',
				'text_reset_all',
				'text_customers_awaiting_notification',
				'text_number_of_products_demanded',
				'text_show_awaiting_reports',
				'text_reset_awaiting',
				'text_archive_records',
				'text_customers_notified',
				'text_show_archive_reports',
				'text_reset_archive',
				'text_reports',
				'text_current_report_all',
				'text_current_report_awaiting',
				'text_current_report_archive',
				'text_product_in_demand',
				'column_count',
				'entry_text',
				'entry_success_msg',
				'entry_store_subject',
				'entry_store_body',
				'entry_customer_subject',
				'entry_customer_body',
				'email_to_store',
				'email_to_customer',
				'text_header_common',
				'text_header_form',
				'entry_enable_name',
				'entry_enable_mobile',
				'entry_enable_sms',
				'entry_animation',
				'text_success',
				'text_product_qty',
				'text_product_stock_status',
				'text_header_admin',
				'text_header_customer',
				'entry_subject',
				'entry_body',
				'sms_body',
				'text_admin_tab',
				'text_customer_tab',
				'text_header_condition',
				'text_header_email',
				'text_header_sms',
				'entry_css',
				'entry_store_codes',
				'entry_sms_codes',
				'entry_customer_codes',
				'text_product_image_size',
				'text_mobile_validation',
				'text_header_installation',
				'installation','text_header_analytics','text_campaign_source', 'text_campaign_medium', 'text_campaign_name'		);
		
		foreach ($text_strings as $text) {
			$this->data[$text] = $this->language->get($text);
		}
		
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['uninstall'] = $this->url->link('extension/hb_oosn/uninstall', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/stock_status');
		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
		foreach ($this->data['languages'] as $result){
	 		$language_id = $result['language_id'];	
			$code = md5($result['code']);	
			$this->data['hb_oosn_admin_email_subject_'.$code] =  $this->config->get('hb_oosn_admin_email_subject_'.$code);
			$this->data['hb_oosn_admin_email_body_'.$code] =  $this->config->get('hb_oosn_admin_email_body_'.$code);
			$this->data['hb_oosn_customer_email_subject_'.$language_id] =  $this->config->get('hb_oosn_customer_email_subject_'.$language_id);
			$this->data['hb_oosn_customer_email_body_'.$language_id] =  $this->config->get('hb_oosn_customer_email_body_'.$language_id);
			$this->data['hb_oosn_product_image_h_'.$language_id] =  $this->config->get('hb_oosn_product_image_h_'.$language_id);
			$this->data['hb_oosn_product_image_w_'.$language_id] =  $this->config->get('hb_oosn_product_image_w_'.$language_id);
			$this->data['hb_oosn_customer_sms_body_'.$language_id] =  $this->config->get('hb_oosn_customer_sms_body_'.$language_id);

		}
		$this->data['hb_oosn_installed'] = $this->config->get('hb_oosn_installed');
		$this->data['hb_oosn_name_enable'] = $this->config->get('hb_oosn_name_enable');
		$this->data['hb_oosn_mobile_enable'] = $this->config->get('hb_oosn_mobile_enable');
		$this->data['hb_oosn_sms_enable'] = $this->config->get('hb_oosn_sms_enable');
		$this->data['hb_oosn_animation'] = $this->config->get('hb_oosn_animation');
		$this->data['hb_oosn_css'] = $this->config->get('hb_oosn_css');
		$this->data['hb_oosn_product_qty'] = $this->config->get('hb_oosn_product_qty');
		$this->data['hb_oosn_stock_status'] = $this->config->get('hb_oosn_stock_status');
		$this->data['hb_oosn_mobile_validation'] = $this->config->get('hb_oosn_mobile_validation');
		
		$this->data['hb_oosn_csource'] = $this->config->get('hb_oosn_csource');
		$this->data['hb_oosn_cmedium'] = $this->config->get('hb_oosn_cmedium');
		$this->data['hb_oosn_cname'] = $this->config->get('hb_oosn_cname');

		
		$this->data['total_alert'] = $this->model_setting_hb_oosn->getTotalAlert();
        $this->data['total_responded'] = $this->model_setting_hb_oosn->getTotalResponded();
        $this->data['customer_notified'] = $this->model_setting_hb_oosn->getCustomerNotified();
        $this->data['awaiting_notification'] = $this->model_setting_hb_oosn->getAwaitingNotification();
        $this->data['product_requested'] = $this->model_setting_hb_oosn->getTotalRequested();		

		$this->template = 'extension/hb_oosn.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		$this->response->setOutput($this->render());

	}
		
	public function manualrun(){
        $url = HTTP_CATALOG."index.php?route=product/product_oosn/autonotify";
		$returnedoutput = $this->loadexternal($url);
		        
		$json['success'] = '<div class="notice warning">'.$returnedoutput.'</div>';
		$this->response->setOutput(json_encode($json));         
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/hb_oosn')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	public function loadexternal($url){
		$curl = function_exists('curl_version') ? true : false;
		$filefunction = file_get_contents(__FILE__) ? true : false;
		
		if ($filefunction){
			return file_get_contents($url);
		}elseif ($curl) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			return curl_exec($ch);
		}else {
			return 'Both curl and allow_url_fopen are disabled in your server. Contact your hosting support to enable it.';
		}
	}
		public function install(){
			$this->load->model('setting/hb_oosn');
			$this->model_setting_hb_oosn->install();
			$this->data['success'] = 'This extension has been installed successfully';
			$this->redirect($this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		public function uninstall(){
				$this->load->model('setting/hb_oosn');
				$this->model_setting_hb_oosn->uninstall();
				$this->data['success'] = 'This extension is uninstalled successfully';
				$this->redirect($this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		public function upgrade(){
				$this->load->model('setting/hb_oosn');
				$this->model_setting_hb_oosn->upgrade();
				$this->data['success'] = 'This extension is upgraded successfully';
				$this->redirect($this->url->link('extension/hb_oosn', 'token=' . $this->session->data['token'], 'SSL'));
		}

}
?>