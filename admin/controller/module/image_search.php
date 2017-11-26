<?php
class ControllerModuleImageSearch extends Controller {
	private $error = array(); 
		
	public function index() {   
		$this->load->language('module/image_search');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('image_search', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title']            = $this->language->get('heading_title');
		
		$this->data['button_save']              = $this->language->get('button_save');
		$this->data['button_cancel']            = $this->language->get('button_cancel');
		
    $this->data['image_path'] = $this->language->get('image_path');
    $this->data['product_count'] = $this->language->get('product_count');
    $this->data['search_where'] = $this->language->get('search_where');
    $this->data['search_where_model'] = $this->language->get('search_where_model');
    $this->data['search_where_name'] = $this->language->get('search_where_name');
    $this->data['search_where_sku'] = $this->language->get('search_where_sku');
    $this->data['server_timeout'] = $this->language->get('server_timeout');                        
    $this->data['site_search'] = $this->language->get('site_search');
    $this->data['safe_search'] = $this->language->get('safe_search');
    $this->data['safe_search_strict'] = $this->language->get('safe_search_strict');
    $this->data['safe_search_moderate'] = $this->language->get('safe_search_moderate');
    $this->data['safe_search_off'] = $this->language->get('safe_search_off');
    $this->data['image_size'] = $this->language->get('image_size');
    $this->data['image_size_small'] = $this->language->get('image_size_small');
    $this->data['image_size_medium'] = $this->language->get('image_size_medium');
    $this->data['image_size_large'] = $this->language->get('image_size_large');
    $this->data['image_size_extra_large'] = $this->language->get('image_size_extra_large');
    $this->data['image_colorization'] = $this->language->get('image_colorization');
    $this->data['image_colorization_grayscale'] = $this->language->get('image_colorization_grayscale');
    $this->data['image_colorization_color'] = $this->language->get('image_colorization_color');
    $this->data['image_color_filter'] = $this->language->get('image_color_filter');
    $this->data['image_color_filter_black'] = $this->language->get('image_color_filter_black');
    $this->data['image_color_filter_blue'] = $this->language->get('image_color_filter_blue');
    $this->data['image_color_filter_brown'] = $this->language->get('image_color_filter_brown');
    $this->data['image_color_filter_gray'] = $this->language->get('image_color_filter_gray');
    $this->data['image_color_filter_green'] = $this->language->get('image_color_filter_green');
    $this->data['image_color_filter_orange'] = $this->language->get('image_color_filter_orange');
    $this->data['image_color_filter_pink'] = $this->language->get('image_color_filter_pink');
    $this->data['image_color_filter_purple'] = $this->language->get('image_color_filter_purple');
    $this->data['image_color_filter_red'] = $this->language->get('image_color_filter_red');
    $this->data['image_color_filter_teal'] = $this->language->get('image_color_filter_teal');
    $this->data['image_color_filter_white'] = $this->language->get('image_color_filter_white');
    $this->data['image_color_filter_yellow'] = $this->language->get('image_color_filter_yellow');
    $this->data['file_type'] = $this->language->get('file_type');
    $this->data['file_type_jpg'] = $this->language->get('file_type_jpg');
    $this->data['file_type_png'] = $this->language->get('file_type_png');
    $this->data['file_type_gif'] = $this->language->get('file_type_gif');
    $this->data['file_type_bmp'] = $this->language->get('file_type_bmp');
    $this->data['image_type'] = $this->language->get('image_type');
    $this->data['image_type_faces'] = $this->language->get('image_type_faces');
    $this->data['image_type_photo'] = $this->language->get('image_type_photo');
    $this->data['image_type_clipart'] = $this->language->get('image_type_clipart');
    $this->data['image_type_lineart'] = $this->language->get('image_type_lineart');
    $this->data['image_rights'] = $this->language->get('image_rights');
    $this->data['image_rights_reuse'] = $this->language->get('image_rights_reuse');
    $this->data['image_rights_commercial_reuse'] = $this->language->get('image_rights_commercial_reuse');
    $this->data['image_rights_modification'] = $this->language->get('image_rights_modification');
    $this->data['image_rights_commercial_modification'] = $this->language->get('image_rights_commercial_modification');
    $this->data['image_rights_more_link'] = $this->language->get('image_rights_more_link');		
    
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
			'href'      => $this->url->link('module/image_search', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => ' :: '
   	);
		
		$this->data['action'] = $this->url->link('module/image_search', 'token=' . $this->session->data['token'], 'SSL');		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
    
    $this->data['search_page_link'] = $this->url->link('catalog/image_search', 'token=' . $this->session->data['token'], 'SSL');
    $this->data['search_page_go_text'] = $this->language->get('search_page_go_text');

		if (isset($this->request->post['image_search_options'])) {
			$this->data['options'] = $this->request->post['image_search_options'];
		} elseif ($this->config->get('image_search_options')) { 
			$this->data['options'] = $this->config->get('image_search_options');
		}
														
		$this->template = 'module/image_search.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
  
  public function install () {
    $this->load->model('setting/setting');
    $this->load->model('catalog/image_search');
		$this->model_setting_setting->deleteSetting('image_search');
		$setting['image_search_options'] = $this->model_catalog_image_search->getDefaultOptions();
		$this->model_setting_setting->editSetting('image_search', $setting);
  }
  
  public function uninstall () {
    $this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('image_search');
  }
  
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/image_search')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error ? TRUE : FALSE;
		
	}
}
?>
