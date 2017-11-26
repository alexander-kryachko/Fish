<?php 
class ControllerFeedSitemapPro extends Controller {
	private $error = array(); 
	
	private $path = '';


	
	public function index() {
		
		$this->path = str_replace('system/', 'sm/' , DIR_SYSTEM);
		
		$this->data['frontend_link'] = HTTP_CATALOG . 'index.php?route=feed/sitemap_pro';
	
		$this->data['ajax_image'] = HTTP_SERVER . 'view/image/ajaxload.gif';

		$this->language->load('feed/sitemap_pro');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('sitemap_pro', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_success'] = $this->language->get('text_success');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_category_status'] = $this->language->get('entry_category_status');
		$this->data['entry_product_status'] = $this->language->get('entry_product_status');
		$this->data['entry_manufacturer_status'] = $this->language->get('entry_manufacturer_status');
		$this->data['entry_information_status'] = $this->language->get('entry_information_status');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');
		
		$this->data['entry_secure'] = $this->language->get('entry_secure');
		$this->data['help_secure'] = $this->language->get('help_secure');
		
		
		$this->data['entry_gzip'] = $this->language->get('entry_gzip');
		$this->data['help_gzip'] = $this->language->get('help_gzip');
		
		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['help_limit'] = $this->language->get('help_limit');
		
		$this->data['text_generate'] = $this->language->get('text_generate');
		
		$this->data['cron_help'] = $this->language->get('cron_help');
		$this->data['help_url'] = $this->language->get('help_url');
		
		$this->data['text_ajax_success'] = $this->language->get('text_ajax_success');
		$this->data['text_ajax_error'] = $this->language->get('text_ajax_error');
		
		$this->data['error_off'] = $this->language->get('error_off');
		
	
		if (file_exists ($this->path . 'sitemap.xml')) {
		
			$filedate =  filectime($this->path . 'sitemap.xml');
			$age = ((time() - $filedate)/3600);
			if  ($age < 24) {
				$this->data['text_time'] = sprintf($this->language->get('text_time'), date('Y-m-d H:i:s', $filedate ));
			} else {
				$this->data['text_time'] = $this->language->get('text_timeout');
			}
			
		} else {
			$this->data['text_time'] =  $this->language->get('text_notfound');
		}
		  
		
		
		
		
		if  ($this->config->get('sitemap_pro_secure')) {
			  $this->data['sitemap_pro_secure'] = $this->config->get('sitemap_pro_secure');
			} else {
				$this->data['sitemap_pro_secure'] = substr(md5($this->config->get('config_encryption')), 0, 10);
			}	
			
		
		$gzip = (int)$this->config->get('gzip_level');
		
		if  (isset($gzip)) {
			  $this->data['gzip_level'] = $gzip ;
			} else {
				$this->data['gzip_level'] = 5;
			}
			
		if  ($this->config->get('sitemap_limit')) {
			  $this->data['sitemap_limit'] = $this->config->get('sitemap_limit');
			} else {
				$this->data['sitemap_limit'] = 50000;
			}
			
		if  ($this->config->get('sitemap_pro_category_status')) {
			  $this->data['sitemap_pro_category_status'] = $this->config->get('sitemap_pro_category_status');
			} else {
				$this->data['sitemap_pro_category_status'] = 1;
			}	
		
		if  ($this->config->get('sitemap_pro_product_status')) {
			  $this->data['sitemap_pro_product_status'] = $this->config->get('sitemap_pro_product_status');
			} else {
				$this->data['sitemap_pro_product_status'] = 1;
			}	
			
		if  ($this->config->get('sitemap_pro_manufacturer_status')) {
			  $this->data['sitemap_pro_manufacturer_status'] = $this->config->get('sitemap_pro_manufacturer_status');
			} else {
				$this->data['sitemap_pro_manufacturer_status'] = 1;
			}
		
		if  ($this->config->get('sitemap_pro_information_status')) {
			  $this->data['sitemap_pro_information_status'] = $this->config->get('sitemap_pro_information_status');
			} else {
				$this->data['sitemap_pro_information_status'] = 1;
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
       		'text'      => $this->language->get('text_feed'),
			'href'      => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('feed/sitemap_pro', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('feed/sitemap_pro', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['sitemap_pro_status'])) {
			$this->data['sitemap_pro_status'] = $this->request->post['sitemap_pro_status'];
		} else {
			$this->data['sitemap_pro_status'] = $this->config->get('sitemap_pro_status');
		}
		
		$this->data['data_feed'] = HTTP_CATALOG . 'index.php?route=feed/sitemap_pro';

		$this->template = 'feed/sitemap_pro.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		

		
		$this->response->setOutput($this->render());
	} 
	
	protected function validate() {
		
	
		if (!$this->user->hasPermission('modify', 'feed/sitemap_pro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} 
		
		if (!is_numeric($this->request->post['gzip_level'])) {
			$this->error['warning'] = $this->language->get('error_gzip');
		} 
		
		/*
		
		if (!is_numeric($this->request->post['sitemap_limit'])) {
			$this->error['warning'] = $this->language->get('error_limit');
		} elseif ((int) $this->request->post['sitemap_limit'] < 10000){
			$this->error['warning'] = $this->language->get('error_limit_lo');
		} elseif ((int) $this->request->post['sitemap_limit'] > 50000){
			$this->error['warning'] = $this->language->get('error_limit_hi');
		}
			*/	
			
				
		if (!file_exists ($this->path)) {
			$this->error['warning'] = $this->language->get('error_folder');
		} elseif (!is_writable($this->path)) {
			$this->error['warning'] = $this->language->get('error_chmod');
		}
		
		
		
		

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}	
}
?>