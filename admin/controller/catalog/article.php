<?php 
class ControllerCatalogArticle extends Controller { 
	private $error = array();
	private $article_id = 0;
	private $path = array();
 
	public function index() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		 
		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$article_id = $this->model_catalog_article->addArticle($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

		if (isset($this->request->post['apply'])) { 

		if (isset($this->request->get['article_id'])) {	
			$this->redirect($this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'], 'SSL')); 
		} else {
			$this->redirect($this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $article_id, 'SSL')); 
		} 
		} else {
			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}

		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_article->editArticle($this->request->get['article_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
		if (isset($this->request->post['apply']) && isset($this->request->get['article_id'])) {	
			$this->redirect($this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'], 'SSL')); 
		} else {
			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/article');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $article_id) {
				$this->model_catalog_article->deleteArticle($article_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . '&path=', 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['insert'] = $this->url->link('catalog/article/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('catalog/article/delete', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['path'])) {
			if ($this->request->get['path'] != '') {
				$this->path = explode('_', $this->request->get['path']);
				$this->article_id = end($this->path);
				$this->session->data['path'] = $this->request->get['path'];
			} else {
				unset($this->session->data['path']);
			}
		} elseif (isset($this->session->data['path'])) {
			$this->path = explode('_', $this->session->data['path']);
			$this->article_id = end($this->path);
		}

		$this->data['articles'] = $this->getArticles(0);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
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
		
		$this->template = 'catalog/article_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
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
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_alternative_link'] = $this->language->get('entry_alternative_link');
		$this->data['entry_short_description'] = $this->language->get('entry_short_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_related_title'] = $this->language->get('entry_related_title');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_related_help'] = $this->language->get('entry_related_help');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_image'] = $this->language->get('entry_image');	
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_date_added'] = $this->language->get('entry_date_added');
		$this->data['entry_viewed'] = $this->language->get('entry_viewed');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_apply'] = $this->language->get('button_apply');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['article_id'])) {
			$this->data['action'] = $this->url->link('catalog/article/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['article_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$article_info = $this->model_catalog_article->getArticle($this->request->get['article_id']);
    	}
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['article_description'])) {
			$this->data['article_description'] = $this->request->post['article_description'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_description'] = $this->model_catalog_article->getArticleDescriptions($this->request->get['article_id']);
		} else {
			$this->data['article_description'] = array();
		}

		if (isset($article_info)) {
			unset($this->data['articles'][$article_info['article_id']]);
		}

		if (isset($this->request->post['parent_id'])) {
			$this->data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($article_info)) {
			$this->data['parent_id'] = $article_info['parent_id'];
			$this->data['parent_name'] = $this->model_catalog_article->getParentName($article_info['parent_id']);
		} else {
			$this->data['parent_id'] = 0;
			$this->data['parent_name'] = '';
		}
						
		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['article_store'])) {
			$this->data['article_store'] = $this->request->post['article_store'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_store'] = $this->model_catalog_article->getArticleStores($this->request->get['article_id']);
		} else {
			$this->data['article_store'] = array(0);
		}

		$this->load->model('catalog/product');

		$this->data['products'] = array();

		if (isset($this->request->post['product'])) {
			$products = $this->request->post['product'];
		} elseif (isset($this->request->get['article_id'])) {
			$products = $this->model_catalog_article->getProductRelated($this->request->get['article_id']);
		} else {
			$products = array();
		}

		if ($products) {
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$this->data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		    }	
		}			
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($article_info)) {
			$this->data['keyword'] = $article_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['alternative_link'])) {
			$this->data['alternative_link'] = $this->request->post['alternative_link'];
		} elseif (!empty($article_info)) {
			$this->data['alternative_link'] = $article_info['alternative_link'];
		} else {
			$this->data['alternative_link'] = '';
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($article_info)) {
			$this->data['image'] = $article_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($article_info) && $article_info['image'] && file_exists(DIR_IMAGE . $article_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($article_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
				
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($article_info)) {
			$this->data['sort_order'] = $article_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}

		if (isset($this->request->post['date_added'])) {
       			$this->data['date_added'] = $this->request->post['date_added'];
		} elseif (!empty($article_info)) {
			$this->data['date_added'] = date('Y-m-d', strtotime($article_info['date_added']));
		} else {
			$this->data['date_added'] = date('Y-m-d', time());
		}

		if (isset($this->request->post['viewed'])) {
			$this->data['viewed'] = $this->request->post['viewed'];
		} elseif (!empty($article_info)) {
			$this->data['viewed'] = $article_info['viewed'];
		} else {
			$this->data['viewed'] = 0;
		}
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($article_info)) {
			$this->data['status'] = $article_info['status'];
		} else {
			$this->data['status'] = 1;
		}
				
		if (isset($this->request->post['article_layout'])) {
			$this->data['article_layout'] = $this->request->post['article_layout'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_layout'] = $this->model_catalog_article->getArticleLayouts($this->request->get['article_id']);
		} else {
			$this->data['article_layout'] = array();
		}

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
						
		$this->template = 'catalog/article_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['article_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
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

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/article');

		foreach ($this->request->post['selected'] as $article_id) {

		$article_parent = $this->model_catalog_article->getTotalArticlesByParent($article_id);

		if ($article_parent) {
			$this->error['warning'] = sprintf($this->language->get('error_delete'), $article_parent);
		}

		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}

	private function getArticles($parent_id, $parent_path = '', $indent = '') {
		$article_id = array_shift($this->path);

		$output = array();

		static $href_article = null;
		static $href_action = null;

		if ($href_article === null) {
			$href_article = $this->url->link('catalog/article', 'token=' . $this->session->data['token'] . '&path=', 'SSL');
			$href_action = $this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=', 'SSL');
		}

		$results = $this->model_catalog_article->getArticlesByParentId($parent_id);

		foreach ($results as $result) {
			$path = $parent_path . $result['article_id'];

			$href = ($result['children']) ? $href_article . $path : '';

			$name = $result['name'];

			if ($article_id == $result['article_id']) {
				$name = '<b>' . $name . '</b>';

				$this->data['breadcrumbs'][] = array(
					'text'      => $result['name'],
					'href'      => $href,
					'separator' => ' :: '
				);

				$href = '';
			}

			$selected = isset($this->request->post['selected']) && in_array($result['article_id'], $this->request->post['selected']);

			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $href_action . $result['article_id']
			);

			$output[$result['article_id']] = array(
				'article_id' => $result['article_id'],
				'name'        => $name,
				'sort_order'  => $result['sort_order'],
				'selected'    => $selected,
				'action'      => $action,
				'href'        => $href,
				'indent'      => $indent
			);

			if ($article_id == $result['article_id']) {
				$output += $this->getArticles($result['article_id'], $path . '_', $indent . str_repeat('&nbsp;', 8));
			}
		}

		return $output;
	}

	private function getAllArticles($articles, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $articles)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($articles[$parent_id] as $article) {
				$output[$article['article_id']] = array(
					'article_id' => $article['article_id'],
					'name'        => $parent_name . $article['name']
				);

				$output += $this->getAllArticles($articles, $article['article_id'], $parent_name . $article['name']);
			}
		}

		return $output;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/article');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 10
			);

			$results = $this->model_catalog_article->getParentArticles($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'article_id' => $result['article_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->setOutput(json_encode($json));
	}

}
?>