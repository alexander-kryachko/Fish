<?php
class ControllerModuleAttributeCategory extends Controller {

	private $error = array(); 
		
	public function index() {   
	
		$this->load->language('module/attribute_category');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
		$this->data['button_cancel'] = $this->language->get('button_cancel');
    $this->data['no_settings']   = $this->language->get('text_no_settings');
		
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
    		'href'      => $this->url->link('module/attribute_category', 'token=' . $this->session->data['token'], 'SSL'),
     		'separator' => ' :: '
   	);
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		
		
		$this->template = 'module/attribute_category.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

  public function install() {
    $this->load->model('catalog/attribute_category');		
		$this->model_catalog_attribute_category->install();  
	}

  public function uninstall() {
    $this->load->model('catalog/attribute_category');		
		$this->model_catalog_attribute_category->uninstall();  
  }
  
  public function getAttributes() {

    $category_id = isset($this->request->get['category_id']) ? (int) $this->request->get['category_id'] : 0;

    $is_series = isset($this->request->get['series']) ? (int) $this->request->get['series'] : 0;

    
    $this->load->model('catalog/attribute_category');
    $data = $this->model_catalog_attribute_category->getAjaxCategoryAttributes($category_id, $is_series);
    
    $this->response->setOutput(json_encode($data));

  }  
  
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/attribute_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}		
		return !$this->error ? TRUE : FALSE;
	}
	
}
