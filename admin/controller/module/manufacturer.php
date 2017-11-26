<?php
class ControllerModuleManufacturer extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/manufacturer');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('manufacturer', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_container_width'] = $this->language->get('entry_container_width');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$this->data['error_image'] = $this->error['image'];
		} else {
			$this->data['error_image'] = array();
		}

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
			'href'      => $this->url->link('module/manufacturer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/manufacturer', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['manufacturer_module'])) {
			$this->data['modules'] = $this->request->post['manufacturer_module'];
		} elseif ($this->config->get('manufacturer_module')) { 
			$this->data['modules'] = $this->config->get('manufacturer_module');
		}
	
	
		
		if (isset($this->request->post['manufacturers'])) {
			$this->data['manufacturers'] = $this->request->post['manufacturers'];
		} elseif ($this->config->get('manufacturers')) { 
			$this->data['manufacturers'] = $this->config->get('manufacturers');
		} else {
			$this->data['manufacturers'] = array();
		}
		


	
		
		$this->load->model('catalog/manufacturer');
		
		$arr = array();
		
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers(array());	
		

		foreach	($manufacturers as $manufacturer) {
		
			$arr[]  = array (
			'name' => $manufacturer['name'],
			'manufacturer_id' => $manufacturer['manufacturer_id'],
			'active' => in_array($manufacturer['manufacturer_id'], $this->data['manufacturers']) ? 1 : 0
			);
		
		}
		
		$this->data['manufacturers'] = $arr;
			
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/manufacturer.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/manufacturer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (isset($this->request->post['manufacturer_module'])) {
			foreach ($this->request->post['manufacturer_module'] as $key => $value) {
				if (!$value['image_width'] || !$value['image_height']) {
					$this->error['image'][$key] = $this->language->get('error_image');
				}
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