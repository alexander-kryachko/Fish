<?php
class ControllerModuleCallme extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/callme');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		$this->load->model('setting/setting');
		$callme_module_cfg = $this->config->get('callme_setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (isset($this->request->post['callme_setting']['button_status']))   {
				if ($this->request->post['callme_setting']['button_status'] == '1'){
					
					$this->load->model('design/layout');
					$layouts = $this->model_design_layout->getLayouts();
					
					foreach ($layouts as $layout) {
					$layout_id = $layout['layout_id'];
					$this->request->post['callme_module'][$layout_id]=array('layout_id' => $layout_id, 'position'=>'content_top', 'status'=>'1', 'sort_order'=>'1' );
					}
					$this->model_setting_setting->editSetting('callme', $this->request->post);	
										
				}
			}
			
						
			$this->model_setting_setting->editSetting('callme', $this->request->post);		
					 
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_showfieldtime'] = $this->language->get('text_showfieldtime');
		$this->data['text_link_page'] = $this->language->get('text_link_page');
		$this->data['text_button_page'] = $this->language->get('text_button_page');
		$this->data['text_button_color'] = $this->language->get('text_button_color');
				
		$lngs = array ('text_white', 'text_green', 'text_black', 'text_pink', 'text_blue', 'text_capcha');
		foreach ($lngs as $lng) {
		$this->data[$lng] = $this->language->get($lng);
		}
				
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		
		
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
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/callme', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/callme', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		
		
		
		$callme_module_cfg_data = array ('showfieldtime', 'link_page', 'button_status', 'button_color', 'capcha');
		foreach ($callme_module_cfg_data as $datas) {
			if (isset($this->request->post['callme_setting'][$datas])) {
				$this->data[$datas] = $this->request->post['callme_setting'][$datas];
			} else {
				$this->data[$datas] = $callme_module_cfg[$datas];
			}
		}


		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
				
		$this->template = 'module/callme.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/callme')) {
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