<?php
class ControllerModuleDisqus extends Controller {
	protected function index($setting) {				
		static $module = 0;
		
		$this->data['disqus_shortname']		= $this->config->get('disqus_shortname');
		$this->data['disqus_identifier']	= null;
		$this->data['disqus_url']			= null;
		
		if (isset($this->request->get['route'])){
			$route = $this->request->get['route'];
		} else {
			$route = 'common/home';
		}
		
		if (isset($this->request->get['product_id'])){
			$this->data['disqus_identifier'] = 'pid' . $this->request->get['product_id'];
			$this->data['disqus_url'] = $this->url->link('product/product', 'product_id=' . $this->request->get['product_id'], 'SSL');
		} elseif ( $route == 'product/category' && isset($this->request->get['path'])) {
			$parts =  explode('_', $this->request->get['path']);
			$category_id = $parts[ count($parts) - 1];
			
			$this->data['disqus_identifier'] = 'cid' . $category_id;
			$this->data['disqus_url'] = $this->url->link('product/category', 'path=' . $category_id, 'SSL');
		} elseif ( $route == 'product/manufacturer'){
			if (isset($this->request->get['manufacturer_id'])){
				$this->data['disqus_url'] = $this->url->link('product/manufacturer', 'manufacturer_id=' . $this->request->get['manufacturer_id'], 'SSL');
				$this->data['disqus_identifier'] = 'mid' . $this->request->get['manufacturer_id'];
			} else {
				$this->data['disqus_url'] = $this->url->link('product/manufacturer', '', 'SSL'); 	
			}				
		} elseif ( $route == 'information/information' && isset($this->request->get['information_id'])){
			$this->data['disqus_url'] = $this->url->link('information/information', 'information_id=' . $this->request->get['information_id'], 'SSL'); 
			$this->data['disqus_identifier'] = 'iid' . $this->request->get['information_id'];
		} else {
				$this->data['disqus_url'] = 'http';
	   
				$this->data['disqus_url'] .= "://";
				
				if ($this->request->server["SERVER_PORT"] != "80") {
					$this->data['disqus_url'] .= $this->request->server["SERVER_NAME"] . ":" . $this->request->server["SERVER_PORT"] . $this->request->server["REQUEST_URI"];
				} else {
					$this->data['disqus_url'] .= $this->request->server["SERVER_NAME"] . $this->request->server["REQUEST_URI"];
				}
		}
		
		$this->data['module'] = $module++; 
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/disqus.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/disqus.tpl';
		} else {
			$this->template = 'default/template/module/disqus.tpl';
		}

		$this->render();
	}
}
?>