<?php 
class ControllerTotalSet extends Controller { 
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('total/set');

        $this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->model_setting_setting->editSetting('set_total', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/total&token=' . $this->session->data['token']);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		
		$this->data['entry_price_for_sale'] = $this->language->get('entry_price_for_sale');
		$this->data['entry_sale'] = $this->language->get('entry_sale');
		$this->data['entry_tax'] = $this->language->get('entry_tax');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_status_order'] = $this->language->get('entry_status_order');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
					
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_sale'] = $this->language->get('button_add_sale');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/total&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_total'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=total/set&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=total/set&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/total&token=' . $this->session->data['token'];

		


		if (isset($this->request->post['set_sale'])) {
			$this->data['set_sale'] = $this->request->post['set_sale'];
		} else {
			$this->data['set_sale'] = $this->config->get('set_sale');
		}
        

		if (isset($this->request->post['set_status'])) {
			$this->data['set_status'] = $this->request->post['set_status'];
		} else {
			$this->data['set_status'] = $this->config->get('set_status');
		}

		if (isset($this->request->post['set_status_order'])) {
			$this->data['set_status_order'] = $this->request->post['set_status_order'];
		} else {
			$this->data['set_status_order'] = $this->config->get('set_status_order');
		}
		
		if (isset($this->request->post['set_sort_order'])) {
			$this->data['set_sort_order'] = $this->request->post['set_sort_order'];
		} else {
			$this->data['set_sort_order'] = $this->config->get('set_sort_order');
		}
		
		$this->template = 'total/set.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'total/set')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>