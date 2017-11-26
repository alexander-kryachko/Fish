<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->language->load('common/footer');
		
		$this->data['text_information'] = $this->language->get('text_information');
		$this->data['text_service'] = $this->language->get('text_service');
		$this->data['text_extra'] = $this->language->get('text_extra');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_return'] = $this->language->get('text_return');
    	$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_voucher'] = $this->language->get('text_voucher');
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');
		$this->data['text_special'] = $this->language->get('text_special');
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_order'] = $this->language->get('text_order');
		$this->data['text_wishlist'] = $this->language->get('text_wishlist');
		$this->data['text_allproducts'] = $this->language->get('text_allproducts');
		
		
		//stock notify
		$this->language->load('module/hb_oosnm');
		
		$this->data['hb_oosn_name_enable']	= $this->config->get('hb_oosn_name_enable');
		$this->data['hb_oosn_mobile_enable']	= $this->config->get('hb_oosn_mobile_enable');
		$this->data['hb_oosn_animation'] = $this->config->get('hb_oosn_animation');
		$this->data['hb_oosn_css'] = $this->config->get('hb_oosn_css');
		
		$this->data['notify_button'] = $this->language->get('button_notify_button');
		$this->data['oosn_info_text'] = $this->language->get('oosn_info_text');
		$this->data['oosn_text_email'] = $this->language->get('oosn_text_email');
		$this->data['oosn_text_email_plh'] = $this->language->get('oosn_text_email_plh');
		$this->data['oosn_text_name'] = $this->language->get('oosn_text_name');
		$this->data['oosn_text_name_plh'] = $this->language->get('oosn_text_name_plh');
		$this->data['oosn_text_phone'] = $this->language->get('oosn_text_phone');
		$this->data['oosn_text_phone_plh'] = $this->language->get('oosn_text_phone_plh');
		
		if ($this->customer->isLogged()){
			$this->data['email'] = $this->customer->getEmail();
			$this->data['fname'] = $this->customer->getFirstName();
			$this->data['phone'] = $this->customer->getTelephone();
		}else {
			$this->data['email'] = $this->data['fname'] =  $this->data['phone'] = '';
		}
		//stock notify end
		
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		
		$this->load->model('catalog/information');
		
		$this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$this->data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
    	}

		$this->data['contact'] = $this->url->link('information/contact');
		$this->data['return'] = $this->url->link('account/return/insert', '', 'SSL');
    	$this->data['sitemap'] = $this->url->link('information/sitemap');
		$this->data['manufacturer'] = $this->url->link('product/manufacturer');
		$this->data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$this->data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$this->data['special'] = $this->url->link('product/special');
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['order'] = $this->url->link('account/order', '', 'SSL');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['allproducts'] = $this->url->link('product/allproducts');
		$this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');		
		$this->data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
        $this->data['search'] = isset($this->request->get['search']) ? $this->request->get['search'] : '';
		

		$this->children = array(
			'module/supermenu',
			'module/supermenu_settings',
			'module/cart'
        );		
		
		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}		
//menu

$module_data = array();
$this->load->model('setting/extension');
$extensions = $this->model_setting_extension->getExtensions('module'); 
foreach ($extensions as $extension) {
	$modules = $this->config->get($extension['code'] . '_module');
	if ($modules) {
		foreach ($modules as $module) {
			if ($module['position'] == 'header' && $module['status']) {
				$module_data[] = array(
				'code'       => $extension['code'],
				'setting'    => $module,
				'sort_order' => $module['sort_order']
				); 
			}
		}
	}
}
$sort_order = array(); 

foreach ($module_data as $key => $value) {
       $sort_order[$key] = $value['sort_order'];
     }
	 
array_multisort($sort_order, SORT_ASC, $module_data);



$cache = 'footer_custom_menu';

$cache_data = $this->cache->get($cache);



if(!$cache_data) {
			
	$this->data['modules'] = array();

	foreach ($module_data as $module) {
		$module = $this->getChild('module/' . $module['code'], $module['setting']);

		if ($module) {
			$this->data['modules'][] = $module;
		}
	};

	$this->cache->set($cache, $this->data['modules']);

} else {
	$this->data['modules'] = $cache_data;
}

//menu end		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		} else {
			$this->template = 'default/template/common/footer.tpl';
		}
		
		$this->render();
	}
}
?>