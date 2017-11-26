<?php 
class ControllerCatalogOcfiltermeta extends Controller { 
	private $error = array();
 
	public function index() {
		$this->language->load('catalog/ocfilter_meta');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ocfilterMeta');
		 
		$this->getList();
	}

	public function insert() {
		$this->language->load('catalog/ocfilter_meta');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ocfilterMeta');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_ocfilterMeta->addMeta($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}

		$this->getForm();
	}

	public function getOptions() {
		$this->load->model('catalog/ocfilterMeta');
		$category_id = $this->request->post['category_id'];

		$this->model_catalog_ocfilterMeta->getOptions($category_id);
	}

	public function update() {
		$this->language->load('catalog/ocfilter_meta');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ocfilterMeta');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_ocfilterMeta->editMeta($this->request->get['id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/ocfilter_meta');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/ocfilterMeta');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $meta_id) {
				$this->model_catalog_ocfilterMeta->deleteMeta($meta_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->getList();
	}
	
	protected function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
						
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['insert'] = $this->url->link('catalog/ocfilter_meta/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/ocfilter_meta/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->data['metas'] = array();
		
		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
				
		$meta_total = $this->model_catalog_ocfilterMeta->getTotalMeta();
		
		$results = $this->model_catalog_ocfilterMeta->getMetas($data);

		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/ocfilter_meta/update', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
			);

			$this->data['metas'][] = array(
				'id'			=> $result['id'],
				'category'      => $result['category'],
				'option1'       => ($result['option1'] != '') ? $result['opt1'].":".$result['option1'] : '',
				'option2'  		=> ($result['option2'] != '') ? $result['opt2'].":".$result['option2'] : '',
				'action'        => $action
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_category'] = $this->language->get('column_category');
		$this->data['column_option1'] = $this->language->get('column_option1');
		$this->data['column_option2'] = $this->language->get('column_option2');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 		$this->data['button_repair'] = $this->language->get('button_repair');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$pagination = new Pagination();
		$pagination->total = $meta_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
		
		$this->template = 'catalog/ocfilter_meta.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_column'] = $this->language->get('entry_column');		
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_option'] = $this->language->get('entry_option');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
 		if (isset($this->error['category'])) {
			$this->data['error_category'] = $this->error['category'];
		} else {
			$this->data['error_category'] = false;
		}

		if (isset($this->error['option'])) {
			$this->data['error_option'] = $this->error['option'];
		} else {
			$this->data['error_option'] = false;
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['id'])) {
			$this->data['action'] = $this->url->link('catalog/ocfilter_meta/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/ocfilter_meta/update', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/ocfilter_meta', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$meta_info = $this->model_catalog_ocfilterMeta->getMeta($this->request->get['id']);
    	}
		
		$this->data['token'] = $this->session->data['token'];

		$this->load->model('catalog/category');

		$this->data['categories'] = $this->model_catalog_category->getCategories(array());
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['category_id'])) {
			$this->data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($meta_info)) {
			$this->data['category_id'] = $meta_info['category_id'];	
		}

		if (isset($this->request->post['category'])) {
			$this->data['category_id'] = $this->request->post['category'];
		} elseif (!empty($meta_info)) {
			$this->data['category_id'] = $meta_info['category_id'];	
		}

		if (isset($this->request->post['option1'])) {
			$this->data['option1'] = $this->request->post['option1'];
		} elseif (!empty($meta_info)) {
			$this->data['option1'] = $meta_info['option1'];
		} else {
			$this->data['option1'] = '';
		}

		if (isset($this->request->post['option2'])) {
			$this->data['option2'] = $this->request->post['option2'];
		} elseif (!empty($meta_info)) {
			$this->data['option2'] = $meta_info['option2'];
		} else {
			$this->data['option2'] = '';
		}
		
		if (isset($this->request->post['text_top'])) {
			$this->data['text_top'] = $this->request->post['text_top'];
		} elseif (!empty($meta_info)) {
			$this->data['text_top'] = $meta_info['text_top'];
		} else {
			$this->data['text_top'] = '';
		}

		if (isset($this->request->post['h'])) {
			$this->data['h'] = $this->request->post['h'];
		} elseif (!empty($meta_info)) {
			$this->data['h'] = $meta_info['h'];
		} else {
			$this->data['h'] = '';
		}

		if (isset($this->request->post['text_bottom'])) {
			$this->data['text_bottom'] = $this->request->post['text_bottom'];
		} elseif (!empty($meta_info)) {
			$this->data['text_bottom'] = $meta_info['text_bottom'];
		} else {
			$this->data['text_bottom'] = '';
		}

		if (isset($this->request->post['meta_title'])) {
			$this->data['meta_title'] = $this->request->post['meta_title'];
		} elseif (!empty($meta_info)) {
			$this->data['meta_title'] = $meta_info['meta_title'];
		} else {
			$this->data['meta_title'] = '';
		}

		if (isset($this->request->post['meta_description'])) {
			$this->data['meta_description'] = $this->request->post['meta_description'];
		} elseif (!empty($meta_info)) {
			$this->data['meta_description'] = $meta_info['meta_description'];
		} else {
			$this->data['meta_description'] = '';
		}
						
		$this->template = 'catalog/ocfilter_meta_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/ocfilter_meta')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->request->post['category'] == ''){
			$this->error['category'] = $this->language->get('error_category');
		}

		if ($this->request->post['option1'] == '' && $this->request->post['option2'] == ''){
			$this->error['option'] = $this->language->get('error_option');
		}
		else{
			if (!isset($this->request->get['id'])){
				$this->load->model('catalog/ocfilterMeta');
				if ($this->model_catalog_ocfilterMeta->checkOptions($this->request->post))
					$this->error['option'] = $this->language->get('error_option_is');
			}
		}		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
			
	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');
			
			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
			
			$results = $this->model_catalog_category->getCategories($data);
				
			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'], 
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}		
		}

		$sort_order = array();
	  
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}		
}
?>