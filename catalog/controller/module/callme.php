<?php 
class ControllerModuleCallme extends Controller {
	private $error = array(); 
	    
  	public function index() {
	
		$callme_module_cfg = $this->config->get('callme_setting');		
		$this->data['height'] = '360';
		
		if ($callme_module_cfg['showfieldtime'] == '1') $this->data['height'] = '425'; 
		if ($callme_module_cfg['capcha'] == '1') $this->data['height'] = '425'; 
		if ($callme_module_cfg['showfieldtime'] == '1' && $callme_module_cfg['capcha'] == '1') $this->data['height'] = '475'; 
		
		if ($callme_module_cfg['button_status'] == '1') {
						
			$css_color = $callme_module_cfg['button_color'];
						
			if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/callme/callme_'.$css_color.'.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/callme/callme_'.$css_color.'.css');
				$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/callme/callme_'.$css_color.'.css');
				$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');			
			}
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/callme_button.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/module/callme_button.tpl';
			} else {
					$this->template = 'default/template/module/callme_button.tpl';
					$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
					$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			}
		
		$this->render();
		}
	}
	
	//open form	for callme
	public function open() {
				
		$this->language->load('module/callme');
		$this->document->setTitle($this->language->get('heading_title')); 
		$callme_module_cfg = $this->config->get('callme_setting');
		$this->data['link_page'] = $this->config->get('link_page');
	//  $this->data['showfieldtime'] = $callme_module_cfg['showfieldtime'];
	//  $this->data['button_status'] = $callme_module_cfg['button_status'];		
		$this->data['callme_setting'] = $callme_module_cfg;
					
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				if ($callme_module_cfg['link_page']=='1') {
				$link_page = $this->request->post['link_page']. "\n\n" ;
				} else {
				$link_page = '';
				}
				
				if (isset($this->request->post['time1'])) {
				$time = $this->request->post['time1']. "--" .$this->request->post['time2'] . "\n\n"  ;
				} else {
				$time = '';
				}
				
				
		
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email'));
	  		$mail->setFrom($this->config->get('config_smtp_username'));
	  		$mail->setSender('Fisherway.com.ua');
	  		$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name'], ENT_QUOTES, 'UTF-8')));
	  		$mail->setText(html_entity_decode($this->request->post['name'] . "\n\n" 
			.$this->request->post['tel'] . "\n\n" 
			.$time 
			.$link_page
			.$this->request->post['enquiry'], ENT_QUOTES, 'UTF-8'));
      		$mail->send();
	  				
			$this->data['success'] = $this->language->get('success');
    	
		}
			
    	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_tel'] = $this->language->get('entry_tel');
		$this->data['entry_time'] = $this->language->get('entry_time');
		$this->data['yes'] = $this->language->get('yes');
		$this->data['no'] = $this->language->get('no');
		$this->data['qs'] = $this->language->get('qs');


		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->error['tel'])) {
			$this->data['error_tel'] = $this->error['tel'];
		} else {
			$this->data['error_tel'] = '';
		}		
		
		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}		

		if (isset($this->error['capcha'])) {
			$this->data['error_capcha'] = $this->error['capcha'];
		} else {
			$this->data['error_capcha'] = '';
		}		
	

    	$this->data['button_send'] = $this->language->get('button_send');
    
		$this->data['action'] = $this->url->link('module/callme/open');


    	
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = $this->customer->getEmail();
		}
		
		if (isset($this->request->post['tel'])) {
			$this->data['tel'] = $this->request->post['tel'];
		} else {
			$this->data['tel'] = '';
		}
		
			if (isset($this->request->post['time1'])) {
				$this->data['time1'] = $this->request->post['time1'];
			} else {
				$this->data['time1'] = $this->language->get('time1');
			}		
			if (isset($this->request->post['time2'])) {
				$this->data['time2'] = $this->request->post['time2'];
			} else {
				$this->data['time2'] = $this->language->get('time2');
			}
			
			if (isset($this->request->post['link_page'])) {
				$this->data['link_page'] = $this->request->post['link_page'];
			}

		
		
		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}
		
		

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/callme.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/callme.tpl';
			} else {
				$this->template = 'default/template/module/callme.tpl';
			}
				
 		$this->response->setOutput($this->render());		
	}

	
  	private function validate() {
	$callme_module_cfg = $this->config->get('callme_setting');
	
    	if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}
		
		 if ((utf8_strlen($this->request->post['tel']) < 3) || (utf8_strlen($this->request->post['tel']) > 32)) {
      		$this->error['tel'] = $this->language->get('error_tel');
    	}
		
		if ($callme_module_cfg['capcha']=='1') {
			if (isset($this->request->post['irobot_no']) || !isset($this->request->post['irobot_yes'])) {
				$this->error['capcha'] = $this->language->get('error_capcha');
			}
		}

		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}

	
}
?>
