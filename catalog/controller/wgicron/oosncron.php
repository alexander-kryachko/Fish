<?php 
class ControllerWgicronOosncron extends Controller {
	public function index(){
		
		$this->load->model('wgi/oosnotify');
			$products = $this->model_wgi_oosnotify->getUniqueId();
			foreach ($products as $product){
				$oosn_id = $product['oosn_id'];	
				$product_id = $product['product_id'];
				$selected_option = $product['selected_option'];  // selected option text
				$product_option_id = $product['product_option_id']; // selected option id 
				$product_option_value_id = $product['product_option_value_id'];// selected option value id
				
				$hb_oosn_stock_status = $this->config->get('hb_oosn_stock_status');
				$hb_oosn_product_qty = $this->config->get('hb_oosn_product_qty');
				
				$stockstatus = $this->model_wgi_oosnotify->getStockStatus($product_id);
				
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
					//$this->data['success'] = $this->language->get('text_email_success');
				}
			}//option check
			else { //option exsists
				$optionstockstatus = $this->model_wgi_oosnotify->getOptionStockStatus($product_id, $product_option_value_id, $product_option_id);
				
				if ($optionstockstatus){
					$optionstockstatus_qty = $optionstockstatus['quantity'];
				}else {
					$optionstockstatus_qty = $hb_oosn_product_qty - 1;
				}

				if ($optionstockstatus_qty >= $hb_oosn_product_qty) {
					$this->sendNotificationtoCustomers($oosn_id);
					//$this->data['success'] = $this->language->get('text_email_success');
				}
			}// option exists, end else
				
			}// end of looping of all unique products
			
			echo 'Stock Notification CRON JOB Run!!!';
	}
	
	public function sendNotificationtoCustomers($oosn_id){
					$this->load->model('wgi/oosnotify');
					$emaillists = $this->model_wgi_oosnotify->getemail($oosn_id);
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
						
						$product_details = $this->model_wgi_oosnotify->getProductDetails($product_id,$customer_language_id);
						$pname = $product_details['name'];
						$store_id = $this->model_wgi_oosnotify->getProductStore($product_id);
						$store_url = $this->model_wgi_oosnotify->getStoreUrl($store_id);
                        
                        if(empty($store_url)){
    	                    $store_url = $this->config->get('config_url');
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
							$mail->setFrom($this->config->get('config_smtp_username'));
							$mail->setSender($this->config->get('config_name'));//Sender
							$mail->setSubject(html_entity_decode($mail_subject, ENT_QUOTES, 'UTF-8'));					
							$mail->setHtml($message);
							$mail->send();
		
						$this->model_wgi_oosnotify->updatenotifieddate($oosn_id);
					}
	}
}
?>