<?php
class ControllerExtensionOosNotify extends Controller{ 

	private $error = array(); 
	
    public function index(){
        $this->language->load('extension/oosnotify');

		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_customise']	= $this->language->get('button_customise');
        $template="extension/oosnotify.tpl"; 
		
		
        $this->load->model('setting/oosnotify');
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/oosnotify', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		if ($this->config->get('hb_oosn_installed') <> 1){
			$this->redirect($this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL'));
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

		

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
				
		if(isset($this->request->get['delete'])){    
            $delete = $this->request->get['delete'];
			$this->model_setting_oosnotify->deleteRecords($delete);
			$this->data['success'] = $this->language->get('text_reset_success');
		}
		
		if(isset($this->request->post['sendemail'])){		
			$products = $this->model_setting_oosnotify->getUniqueId();
			foreach ($products as $product){
				$oosn_id = $product['oosn_id'];	
				$product_id = $product['product_id'];
				$selected_option = $product['selected_option'];  // selected option text
				$product_option_id = $product['product_option_id']; // selected option id 
				$product_option_value_id = $product['product_option_value_id'];// selected option value id
				
				$hb_oosn_stock_status = $this->config->get('hb_oosn_stock_status');
				$hb_oosn_product_qty = $this->config->get('hb_oosn_product_qty');
				
				$stockstatus = $this->model_setting_oosnotify->getStockStatus($product_id);
				
				if ($stockstatus){
					$qty = $stockstatus['quantity'];
					$stock_status_id = $stockstatus['stock_status_id'];
				}else {
					$qty = $hb_oosn_product_qty - 1;
					$stock_status_id = 0;
				}
				
				if ($hb_oosn_stock_status ==  '0'){ 
					$stock_status_id = 0;
				}
				
			if (($selected_option == '0') or (empty($selected_option)) ) { //option check
				if (($qty >= $hb_oosn_product_qty) and ($stock_status_id == $hb_oosn_stock_status)){
					$this->sendNotificationtoCustomers($oosn_id);
					$this->data['success'] = $this->language->get('text_email_success');
				}
			}//option check
			else { //option exsists
				$optionstockstatus = $this->model_setting_oosnotify->getOptionStockStatus($product_id, $product_option_value_id, $product_option_id);
				if ($optionstockstatus){
					$optionstockstatus_qty = $optionstockstatus['quantity'];
				}else {
					$optionstockstatus_qty = $hb_oosn_product_qty - 1;
				}
				if ($optionstockstatus_qty >= $hb_oosn_product_qty) {
					$this->sendNotificationtoCustomers($oosn_id);
					$this->data['success'] = $this->language->get('text_email_success');
				}
			}// option exists, end else
				
			}// end of looping of all unique products
			
		}// end of sendemail function

        $this->data['total_alert'] = $this->model_setting_oosnotify->getTotalAlert();
        $this->data['total_responded'] = $this->model_setting_oosnotify->getTotalResponded();
        $this->data['customer_notified'] = $this->model_setting_oosnotify->getCustomerNotified();
        $this->data['awaiting_notification'] = $this->model_setting_oosnotify->getAwaitingNotification();
        $this->data['product_requested'] = $this->model_setting_oosnotify->getTotalRequested();

		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		if (isset($this->request->get['filteroption'])) {
    		$filteroption = $this->request->get['filteroption'];
            $this->data['current_report'] = strtoupper($filteroption); 
		}else {
    	    $filteroption = $this->data['current_report'] = strtoupper('ALL'); 
		}
		$reports_total = $this->model_setting_oosnotify->getTotalReports($filteroption); 
		
		$this->data['products'] = array();

		$results = $this->model_setting_oosnotify->getReports($data,$filteroption);

		foreach ($results as $result) {
			
			$this->data['products'][] = array(
				'product_id'    => $result['product_id'],
				'name'   => $result['name'],
				'selected_option'   => $result['selected_option'],
				'email'   => $result['email'],
				'fname'   => $result['fname'],
				'phone'   => $result['phone'],
				'language_code'   => $result['language_code'],
				'enquiry_date'  => $result['enquiry_date'],
				'notify_date'  => $result['notified_date'],
                'product_link' => $this->url->link('catalog/product/update&product_id='.$result['product_id'], 'token=' . $this->session->data['token'], 'SSL')
			);
		}
				
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['link_to_setting'] = $this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['column_product_id'] = $this->language->get('column_product_id');
		$this->data['column_product_name'] = $this->language->get('column_product_name');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_phone'] = $this->language->get('column_phone');
		$this->data['column_option'] = $this->language->get('column_option');
		$this->data['column_language'] = $this->language->get('column_language');
		$this->data['column_enquiry_date'] = $this->language->get('column_enquiry_date');
		$this->data['column_notify_date'] = $this->language->get('column_notify_date');
		$this->data['current_page'] = $this->url->link('extension/oosnotify', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['text_notify_customers']			= $this->language->get('text_notify_customers');
		$this->data['text_total_alert']					= $this->language->get('text_total_alert');
		$this->data['text_total_responded']				= $this->language->get('text_total_responded');
		$this->data['text_show_all_reports']			= $this->language->get('text_show_all_reports');
		$this->data['text_reset_all']					= $this->language->get('text_reset_all');
		$this->data['text_customers_awaiting_notification']		= $this->language->get('text_customers_awaiting_notification');
		$this->data['text_number_of_products_demanded']			= $this->language->get('text_number_of_products_demanded');
		$this->data['text_show_awaiting_reports']				= $this->language->get('text_show_awaiting_reports');
		$this->data['text_reset_awaiting']						= $this->language->get('text_reset_awaiting');
		$this->data['text_archive_records']						= $this->language->get('text_archive_records');
		$this->data['text_customers_notified']					= $this->language->get('text_customers_notified');
		$this->data['text_show_archive_reports']				= $this->language->get('text_show_archive_reports');
		$this->data['text_reset_archive']						= $this->language->get('text_reset_archive');
		$this->data['text_reports']								= $this->language->get('text_reports');
		$this->data['text_current_report_all']					= $this->language->get('text_current_report_all');
		$this->data['text_current_report_awaiting']				= $this->language->get('text_current_report_awaiting');
		$this->data['text_current_report_archive']				= $this->language->get('text_current_report_archive');
		$this->data['text_product_in_demand']					= $this->language->get('text_product_in_demand');
		$this->data['column_count']   							= $this->language->get('column_count');

		$url = '';		

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$pagination = new Pagination();
		$pagination->total = $reports_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('extension/oosnotify', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->data['demands'] = $this->model_setting_oosnotify->getDemandedList();
		
		
        $this->template = ''.$template.'';
        $this->children = array(
            'common/header',
            'common/footer'
        );      
        $this->response->setOutput($this->render());
    }
	
	public function setting(){
        $this->language->load('extension/oosnotify');
		$this->document->setTitle($this->language->get('heading_title_setting')); 
		$this->data['heading_title_setting'] = $this->language->get('heading_title_setting');
		
		$this->load->model('setting/setting');
		$this->load->model('setting/oosnotify');
		
        $template="extension/oosnotify_settings.tpl"; 

        //Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('notify_out_stock', $this->request->post);	
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$text_strings = array(
				'button_save',
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
				'entry_effect',
				'entry_animation',
				'button_save',
				'button_cancel',
				'text_success',
				'text_product_qty',
				'text_product_stock_status',
				'text_header_admin',
				'text_header_customer',
				'entry_subject',
				'entry_body',
				'text_admin_tab',
				'text_customer_tab',
				'text_header_condition',
				'text_header_email',
				'entry_css',
				'entry_store_codes',
				'entry_customer_codes',
				'text_product_image_size',
				'text_header_installation',
				'installation'
		);
		
		foreach ($text_strings as $text) {
			$this->data[$text] = $this->language->get($text);
		}
		
		$this->data['action'] = $this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/oosnotify/', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['uninstall'] = $this->url->link('extension/oosnotify/uninstall', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['install'] = $this->url->link('extension/oosnotify/install', 'token=' . $this->session->data['token'], 'SSL');	
		$this->data['href'] = $this->url->link('extension/oosnotify','token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/stock_status');
		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
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
			'href'      => $this->url->link('extension/oosnotify', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		if (isset($_POST['save'])){
			$store_subject = $this->request->post['store_subject'];
			$store_body = $this->request->post['store_body'];
			
			$store_subject = addslashes($store_subject);
			$store_body = addslashes($store_body);
			
			$this->model_setting_oosnotify->updateSettings('oosn_store_mail_sub', $store_subject);
			$this->model_setting_oosnotify->updateSettings('oosn_store_mail_body', $store_body);
			
			$languages = $this->data['languages'];
			foreach ($languages as $language){
				$customer_subject = $this->request->post['customer_subject_'.$language['language_id']];
				$customer_body = $this->request->post['customer_body_'.$language['language_id']];
				$customer_subject = addslashes($customer_subject);
				$customer_body = addslashes($customer_body);
				
				$this->model_setting_oosnotify->updateSettings('oosn_customer_mail_sub'.$language['language_id'], $customer_subject);
				$this->model_setting_oosnotify->updateSettings('oosn_customer_mail_body'.$language['language_id'], $customer_body);		
			}
			
			$href = $this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL');
			$this->data['success']	='Saved Successfully. <a href="'.$href.'" class="button">Refresh this page</a> ';
		}
		
		$this->data['store_subject'] = $this->config->get('oosn_store_mail_sub');
		$this->data['store_body'] = $this->config->get('oosn_store_mail_body');
		
 		$this->template = ''.$template.'';
        $this->children = array(
            'common/header',
            'common/footer'
        );      
        $this->response->setOutput($this->render());
    }
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/oosnotify')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	public function install(){
			$this->load->model('setting/oosnotify');
			$this->model_setting_oosnotify->install();
			$this->data['success'] = 'This extension has been installed successfully';
			$this->redirect($this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	public function uninstall(){
			$this->load->model('setting/oosnotify');
			$this->model_setting_oosnotify->uninstall();
			$this->data['success'] = 'This extension is uninstalled successfully';
			$this->redirect($this->url->link('extension/oosnotify/setting', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	public function sendNotificationtoCustomers($oosn_id){
					$this->load->model('setting/oosnotify');
					$emaillists = $this->model_setting_oosnotify->getemail($oosn_id);
					foreach ($emaillists as $emaillist){
						$product_id = $emaillist['product_id'];
						$customer_email = $emaillist['email'];
						$customer_name = $emaillist['fname'];
						if (empty($emaillist['fname'])){
							$customer_name = '';
						}
						
						if (strlen($emaillist['selected_option']) > 3){
							$selected_option = $emaillist['selected_option'];
						}else {
							$selected_option = '';
						}
						$oosn_id = $emaillist['oosn_id'];
						$customer_language_id = $emaillist['language_id'];
						
						$product_details = $this->model_setting_oosnotify->getProductDetails($product_id,$customer_language_id);
						$pname = $product_details['name'];
						$store_id = $this->model_setting_oosnotify->getProductStore($product_id);
						$store_url = $this->model_setting_oosnotify->getStoreUrl($store_id);
                        
                        if(empty($store_url)){
    	                    $store_url = HTTP_CATALOG;
                        }
						$link = $store_url.'index.php?route=product/product&product_id='.$product_id;
						$pmodel = $product_details['model'];
						$pimage = $product_details['image'];
						
						if (!empty($pimage)){
							$pimagelink = $store_url.'/image/'.$pimage;
							$showimage = '<img height="'.$this->config->get('hb_oosn_product_image_h_'.$customer_language_id).'px" src="'.$pimagelink.'" width="'.$this->config->get('hb_oosn_product_image_w_'.$customer_language_id).'px" />';
						} else{
							$pimagelink = $store_url.'/image/no_image.jpeg';
							$showimage = '<img height="'.$this->config->get('hb_oosn_product_image_h_'.$customer_language_id).'px" src="'.$pimagelink.'" width="'.$this->config->get('hb_oosn_product_image_w_'.$customer_language_id).'px" />';
						}
						
							$mail_body = $this->config->get('hb_oosn_customer_email_body_'.$customer_language_id);
							$mail_body = str_replace("{product_name}",$pname,$mail_body);
							$mail_body = str_replace("{customer_name}",$customer_name,$mail_body);
							$mail_body = str_replace("{model}",$pmodel,$mail_body);
							$mail_body = str_replace("{option}",$selected_option,$mail_body);
							$mail_body = str_replace("{image_url}",$pimagelink,$mail_body);
							$mail_body = str_replace("{show_image}",$showimage,$mail_body);
							$mail_body = str_replace("{link}",$link,$mail_body);
							
							$mail_subject =  $this->config->get('hb_oosn_customer_email_subject_'.$customer_language_id);
							$mail_subject = str_replace("{product_name}",$pname,$mail_subject);
							
							$message  = '<html dir="ltr" lang="en">' . "\n";
							$message .= '  <head>' . "\n";
							$message .= '    <title>' . $mail_subject . '</title>' . "\n";
							$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
							$message .= '  </head>' . "\n";
							$message .= '  <body>' . html_entity_decode($mail_body, ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
							$message .= '</html>' . "\n";
					
										
							$mail = new Mail();	
							$mail->protocol = $this->config->get('config_mail_protocol');
							$mail->parameter = $this->config->get('config_mail_parameter');
							$mail->hostname = $this->config->get('config_smtp_host');
							$mail->username = $this->config->get('config_smtp_username');
							$mail->password = $this->config->get('config_smtp_password');
							$mail->port = $this->config->get('config_smtp_port');
							$mail->timeout = $this->config->get('config_smtp_timeout');				
							$mail->setTo($customer_email);
							$mail->setFrom($this->config->get('config_email'));
							$mail->setSender($this->config->get('config_name'));//Sender
							$mail->setSubject(html_entity_decode($mail_subject, ENT_QUOTES, 'UTF-8'));					
							$mail->setHtml($message);
							$mail->send();
		
						$this->model_setting_oosnotify->updatenotifieddate($oosn_id);
					}
	}
	
}
?>