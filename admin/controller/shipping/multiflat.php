<?php
class ControllerShippingMultiflat extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('shipping/multiflat');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('multiflat', $this->request->post);
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_multiflat_sort_order'] = $this->language->get('text_multiflat_sort_order');
		$this->data['text_multiflat_name'] = $this->language->get('text_multiflat_name');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');


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
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/multiflat', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('shipping/multiflat', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		if (isset($this->request->post['multiflat'])) {
			$this->data['modules'] = $this->request->post['multiflat'];
		} elseif ($this->config->get('multiflat')) {
			$this->data['modules'] = $this->config->get('multiflat');
		}

		$this->data['multiflat_sort_order'] = "";
		if (isset($this->request->post['multiflat_sort_order'])) {
			$this->data['multiflat_sort_order'] = $this->request->post['multiflat_sort_order'];
		} elseif ($this->config->get('multiflat_sort_order')) {
			$this->data['multiflat_sort_order'] = $this->config->get('multiflat_sort_order');
		}

		$this->data['multiflat_name'] = "";
		if (isset($this->request->post['multiflat_name'])) {
			$this->data['multiflat_name'] = $this->request->post['multiflat_name'];
		} elseif ($this->config->get('multiflat_name')) {
			$this->data['multiflat_name'] = $this->config->get('multiflat_name');
		}


		$this->load->model('localisation/tax_class');
		
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$this->load->model('localisation/geo_zone');
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
								
		$this->template = 'shipping/multiflat.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/multiflat')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>