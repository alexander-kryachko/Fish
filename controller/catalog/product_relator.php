<?php
class ControllerCatalogProductRelator extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('catalog/product');
		$this->language->load('catalog/product_relator');

		$this->document->setTitle($this->language->get('text_product_relator'));
		 
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');

		$this->getList();
	}

 
	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$filter_category_id = $this->request->get['filter_category_id'];
		} else {
			$filter_category_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
						
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
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
       		'text'      => $this->language->get('text_product_relator'),
			'href'      => $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['products'] = array();

		$data = array(
			'filter_name'	  		  => $filter_name, 
			'filter_model'	  		  => $filter_model,
			'filter_category_id'	  => $filter_category_id,
			'filter_status'  		  => $filter_status,
			'sort'            		  => $sort,
			'order'          		  => $order,
			'start'       		      => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'      		      => $this->config->get('config_admin_limit')
		);

		$this->load->model('tool/image');
		
		$category_data = array();
		$this->data['categories'] = $this->model_catalog_category->getCategories($category_data);
		
		$product_total = $this->model_catalog_product->getTotalProductsByCategory($data);

		$results = $this->model_catalog_product->getProductsByCategoryIdSorted($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_relate_products'),
				'href' => $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'], 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			
			$related = count($this->model_catalog_product->getProductRelated($result['product_id']));
			
			$product_categories = array();
			$product_category_data = $this->model_catalog_product->getProductCategories($result['product_id']);
			foreach ($product_category_data as $product_category) {

				$category_descriptions = $this->model_catalog_category->getCategoryDescriptions($product_category);
				//$product_categories[] = $category_descriptions[$this->config->get('config_language_id')]['name'];
			}
	
      		$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'image'      => $image,
				'related'    => $related,
				'categories'    => $product_categories,
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'action'     => $action
			);
    	}
		
		$this->data['text_product_relator'] = $this->language->get('text_product_relator');	
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
			
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_related'] = $this->language->get('column_related');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_category'] = $this->language->get('column_category');
		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_status'] = $filter_status;
		$this->data['filter_category_id'] = $filter_category_id;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/product_relator_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	
	public function update() {
    	$this->language->load('catalog/product');
		$this->language->load('catalog/product_relator');

    	$this->document->setTitle($this->language->get('text_product_relator'));
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_catalog_product->updateRelated($this->request->get['product_id'], $this->request->post);
				
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if ($this->request->get['product_id']) {
			$this->getForm();
		} else {
			$this->redirect($this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'], 'SSL'));
		}
  	}
	
	protected function getForm() {
		if (isset($this->request->get['product_id'])) {
			$product_id = $this->request->get['product_id'];
		} else {
			$product_id = null;
		}
	
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$filter_category_id = $this->request->get['filter_category_id'];
		} else {
			$filter_category_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
						
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$url_product_id = '';
		if (isset($this->request->get['product_id'])) {
			$url .= '&product_id=' . $this->request->get['product_id'];
			$url_product_id = '&product_id=' . $this->request->get['product_id'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_product_relator'),
			'href'      => $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$product = $this->model_catalog_product->getProduct($product_id);
		
		$this->data['breadcrumbs'][] = array(
       		'text'      => $product['name'],
			'href'      => $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['name'] = $product['name'];
		$this->data['product_relator'] = $this->url->link('catalog/product_relator', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['reset'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . $url_product_id, 'SSL');
		$this->data['update'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		
		$this->data['products'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_category_id'	  => $filter_category_id,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$category_data = array();
		$this->data['categories'] = $this->model_catalog_category->getCategories($category_data);
		
		$results = $this->model_catalog_product->getProductsByCategoryIdSorted($data);
			
		$related_products = $this->model_catalog_product->getProductRelated($product_id);
	    	
		foreach ($results as $result) {
			if($result['product_id'] != $product_id) {
				
				if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], 40, 40);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}

				$related = count($this->model_catalog_product->getProductRelated($result['product_id']));
				
				$related_match = false;
				foreach ($related_products as $related_product) {
					if($related_product == $result['product_id']) {
						$related_match = true;
					}
				}
				
				$product_categories = array();
				$product_category_data = $this->model_catalog_product->getProductCategories($result['product_id']);
				foreach ($product_category_data as $product_category) {

					$category_descriptions = $this->model_catalog_category->getCategoryDescriptions($product_category);
					if (isset($category_descriptions[$this->config->get('config_language_id')]['name'])) {
						$product_categories[] = $category_descriptions[$this->config->get('config_language_id')]['name'];
					}
				}
				
				$this->data['products'][] = array(
					'product_id'     => $result['product_id'],
					'name'     		 => $result['name'],
					'model'     	 => $result['model'],
					'image'  		 => $image,
					'related'   	 => $related,
					'related_match'  => $related_match,
					'categories' 	 => $product_categories,
					'status'   		 => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				);
			}
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');			
		$this->data['text_multiway'] = $this->language->get('text_multiway');	
			
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_price'] = $this->language->get('column_price');		
		$this->data['column_related'] = $this->language->get('column_related');		
		$this->data['column_status'] = $this->language->get('column_status');

		$this->data['column_category'] = $this->language->get('column_category');		
				
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_back'] = $this->language->get('button_back');
		$this->data['button_update'] = $this->language->get('button_update');
		$this->data['button_reset'] = $this->language->get('button_reset');
		 
 		$this->data['token'] = $this->session->data['token'];
		
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

		$url = '';
		
		if (isset($this->request->get['product_id'])) {
			$url .= '&product_id=' . $this->request->get['product_id'];
		}
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/product_relator/update', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['product_id'])) {
			$url .= '&product_id=' . $this->request->get['product_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_category_id'] = $filter_category_id;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['product_id'] = $product_id;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		

		$this->template = 'catalog/product_relator_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	protected function validateForm() { 
  	if (!$this->user->hasPermission('modify', 'catalog/product_relator')) {
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
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/option');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);
			
			$results = $this->model_catalog_product->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);	
				
				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
					
					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();
							
							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
						
								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}
						
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}
					
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>