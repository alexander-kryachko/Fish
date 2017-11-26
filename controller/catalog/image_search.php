<?php 
class ControllerCatalogImageSearch extends Controller {
	
	private $error = array(); 
     
  public function index() {
		$this->load->language('catalog/image_search');
		
		//$this->document->addScript('catalog/view/javascript/image_search.js');
    $this->document->addStyle('view/stylesheet/image_search.css');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/image_search');
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['image']) && $this->validate()) {
		  $this->model_catalog_image_search->updatePath($this->request->post['image_path']);	
      $this->model_catalog_image_search->updateImages($this->request->post['image']);	
      $this->error = array_merge($this->error, $this->model_catalog_image_search->getError());
		}

		$this->getList();
  } 
	
 	private function getList() {				
 	
 	  $options = $this->config->get('image_search_options');
 	
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_stock_status_id'])) {
			$filter_stock_status_id = $this->request->get['filter_stock_status_id'];
		} else {
			$filter_stock_status_id = null;
		}

		if (isset($this->request->get['filter_image'])) {
			$filter_image = $this->request->get['filter_image'];
		} else {
			$filter_image = null;
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$filter_category_id = $this->request->get['filter_category_id'];
		} else {
			$filter_category_id = null;
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
						
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_stock_status_id'])) {
			$url .= '&filter_stock_status_id=' . urlencode(html_entity_decode($this->request->get['filter_stock_status_id'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_image'])) {
			$url .= '&filter_image=' . $this->request->get['filter_image'];
		}
		
		if (isset($this->request->get['filter_category_id'])) {
			$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
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
      'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/image_search', 'token=' . $this->session->data['token'] . $url, 'SSL'),       			'separator' => ' :: '
   	);
		
		$this->data['save'] = $this->url->link('catalog/image_search', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	
		$this->data['products'] = array();

    $limit = isset($options['product_count']) && $options['product_count'] ? $options['product_count'] : 5;  

		$data = array(
			'filter_status'   => $filter_status, 
			'filter_stock_status_id' 	  => $filter_stock_status_id,
			'filter_image'	  => $filter_image,
			'filter_category_id'  => $filter_category_id,
			'filter_sub_category' => true,
			'sort'            => 'p.date_added',
			'order'           => 'DESC',
			'start'           => ($page - 1) * $limit,
			'limit'           => $limit
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_image_search->getTotalProducts($data);
			
		$results = $this->model_catalog_image_search->getProducts($data);

		foreach ($results as $result) {
			
			if (!$result['image'] || !file_exists(DIR_IMAGE . $result['image'])) {
				$result['image'] = 'no_image.jpg';
			}
			
	    $image = array(
      			 'image'      => $result['image'],
				     'thumb'      => $this->model_tool_image->resize($result['image'], 40, 40),
				     'popup'      => $this->model_tool_image->resize($result['image'], 
				      $this->config->get('config_image_popup_width'), 
				      $this->config->get('config_image_popup_height')),
				     'sort_order' => $result['sort_order']
			    );
	    
	    
	    $images = array();
	    $product_images = $this->model_catalog_product->getProductImages($result['product_id']);
	    if ($product_images) {
	      foreach ($product_images as $product_image) {
	        if ($product_image['image'] && !file_exists(DIR_IMAGE . $product_image['image'])) {
	          $product_image['image'] = 'no_image.jpg';
	        }
				  $images[] = array(
      			 'image'      => $product_image['image'],
				     'thumb'      => $this->model_tool_image->resize($product_image['image'], 40, 40),
				     'popup'      => $this->model_tool_image->resize($product_image['image'], 
				      $this->config->get('config_image_popup_width'), 
				      $this->config->get('config_image_popup_height')),
				     'sort_order' => $product_image['sort_order']
			    );
	      }
	    }
	    
			$special = false;
			
			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
			
			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
					$special = $product_special['price'];
			
					break;
				}					
			}
	
      $this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'sku'        => $result['sku'],
				'price'      => $result['price'],
				'special'    => $special,
				'images'     => $images,
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'))
			);
    }
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled']    = $this->language->get('text_enabled');		
		$this->data['text_disabled']   = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
			
		$this->data['column_status']   = $this->language->get('column_status');		
		$this->data['column_stock_status']    = $this->language->get('column_stock_status');		
		$this->data['column_image']    = $this->language->get('column_image');		
		$this->data['column_category'] = $this->language->get('column_category');		
		
		$this->data['entry_name']         = $this->language->get('entry_name');
		$this->data['entry_model']        = $this->language->get('entry_model');
		$this->data['entry_sku']          = $this->language->get('entry_sku');
				
		$this->data['button_save']     = $this->language->get('button_save');		
		$this->data['button_filter']   = $this->language->get('button_filter');		
		$this->data['button_search']   = $this->language->get('button_search');		
		 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error) && $this->error) {
			$this->data['error_warning'] = implode('<br />', $this->error);
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
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/image_search', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_status']      = $filter_status;
		$this->data['filter_stock_status_id']    = $filter_stock_status_id;
		$this->data['filter_image']       = $filter_image;
		$this->data['filter_category_id'] = $filter_category_id;
		
		$this->data['image_path'] = $this->language->get('image_path');
		
		$this->load->model('localisation/stock_status');
    $this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();		
    

		$categories = $this->model_catalog_image_search->getAllCategories(); 
		
    $this->data['categories'] = $this->model_catalog_image_search->getAllCategoriesArr($categories);

    $this->data['image_statuses'] = $this->model_catalog_image_search->getImageStatuses();        
    
    $this->data['options'] = $options;
    
    $this->data['directories'] = $this->model_catalog_image_search->getDirectoryTree();
    $this->data['current_directory'] = $options['image_path'];
    
		$this->template = 'catalog/image_search.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  }

	
  private function validate() {
   	if (!$this->user->hasPermission('modify', 'catalog/image_search')) { 
     		$this->error[] = $this->language->get('error_permission');  
     		return false;
   	}
		
	  return true;
  }
  		

}
?>
