<?php  
class ControllerModuleCustomMenu extends Controller {
	protected function index($setting) {
	
		$this->load->model('module/custom_menu');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/custom_menu.css');
		$this->document->addScript('catalog/view/javascript/custom_menu.js');
		
		$cache = 'custom_menu_';
		$cache_data = $this->cache->get($cache);
			
		if(!$cache_data) {
			$this->data['custom_menu'] = $this->model_module_custom_menu->getCustomMenu();
			$this->cache->set($cache, $this->data['custom_menu']);
		} else {
			$this->data['custom_menu'] = $cache_data;
		}
		
		$l_code = $this->session->data['language'];
		$this->data['head'] = $setting[$l_code]['head'];
		$this->data['style'] = $setting['style'];
		$this->data['in_module'] = $setting['in_module'];
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/custom_menu.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/custom_menu.tpl';
		} else {
			$this->template = 'default/template/module/custom_menu.tpl';
		}
		
		$this->render();
  	}

}
?>