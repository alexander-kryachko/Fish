<?php
class ControllerModuleClientPrefs extends Controller {
	private $error = array(); 
	
	public function add(){
		$prefType = htmlspecialchars($_POST['prefType'], ENT_COMPAT, 'utf-8');
		$prefValue = htmlspecialchars($_POST['prefValue'], ENT_COMPAT, 'utf-8');

		$this->load->model('module/clientPrefs');
		$result = $this->model_module_clientPrefs->add($prefType, $prefValue);
		echo $result;
	}
	
	public function remove(){
		$this->load->model('module/clientPrefs');
		$this->model_module_clientPrefs->remove((int)$_POST['pref_id']);
	}
	
	public function update(){
		$this->load->model('module/clientPrefs');
		$values = !empty($_POST['product_category']) ? $_POST['product_category'] : array();
		$this->model_module_clientPrefs->update($values);
		$this->redirect($this->url->link('module/clientPrefs', 'token=' . $this->session->data['token'], 'SSL'));
	}

	public function index(){
		$this->load->language('module/clientPrefs');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('module/clientPrefs');

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])){
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
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
			'href'      => $this->url->link('module/clientPrefs', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		$this->data['manufacturers'] = $this->model_module_clientPrefs->getOptionValues(288); // 288 = manufacturers
		$this->data['rows'] = $this->model_module_clientPrefs->get();

		$this->data['action'] = $this->url->link('module/clientPrefs/update', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->template = 'module/clientPrefs.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);				
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/clientPrefs')) {
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