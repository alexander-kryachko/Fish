<?php

//*******************************************************************************
// Sphinx Search v1.2.2
// Author: Iverest EOOD
// E-mail: sales@iverest.com
// Website: http://www.iverest.com
//*******************************************************************************

//require_once DIR_APPLICATION .'../catalog/model/catalog/sphinx.php';

class ControllerModuleSphinxsearch extends Controller {
	
	private $LIMIT = 500;
	
	public function install() {
		
		$this->db->query("
        CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "sphinx_suggestions` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `trigrams` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `freq` int(11) NOT NULL ,
          PRIMARY KEY (`id`),
		  UNIQUE KEY `keyword` (`keyword`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");

	}
	
	public function index() {
		$this->language->load('module/sphinxsearch');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('sphinxsearch', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		//Common text
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_rt_yes'] = $this->language->get('text_rt_yes');
		$this->data['text_rt_no'] = $this->language->get('text_rt_no');
		$this->data['text_calculating'] = $this->language->get('text_calculating');
		
		//Tabs
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_autocomplete'] = $this->language->get('tab_autocomplete');
		$this->data['tab_productOptions'] = $this->language->get('tab_productOptions');
		$this->data['tab_categoriesOptions'] = $this->language->get('tab_categoriesOptions');
		$this->data['tab_suggestions'] = $this->language->get('tab_suggestions');
		$this->data['tab_config'] = $this->language->get('tab_config');
		$this->data['tab_rtIndex'] = $this->language->get('tab_rtIndex');
		
		//General tab
		$this->data['entry_sphinx_status'] = $this->language->get('entry_sphinx_status');
		$this->data['entry_sort_status'] = $this->language->get('entry_sort_status');
		$this->data['entry_autocomplete_status'] = $this->language->get('entry_autocomplete_status');
		$this->data['entry_sphinx_server'] = $this->language->get('entry_sphinx_server');
		$this->data['entry_sphinx_port'] = $this->language->get('entry_sphinx_port');
		
		$this->data['entry_sphinx_match_mode_title'] = $this->language->get('entry_sphinx_match_mode_title');
		$this->data['entry_sphinx_sort_mode_title'] = $this->language->get('entry_sphinx_sort_mode_title');
		$this->data['entry_sphinx_ranking_mode_title'] = $this->language->get('entry_sphinx_ranking_mode_title');
		$this->data['entry_sphinx_weight_title'] = $this->language->get('entry_sphinx_weight_title');
		
		$this->data['entry_sphinx_match_mode'] = $this->language->get('entry_sphinx_match_mode');
		$this->data['entry_sphinx_sort_info'] = $this->language->get('entry_sphinx_sort_info');
		$this->data['entry_sphinx_attr_expr_info'] = $this->language->get('entry_sphinx_attr_expr_info');
		$this->data['entry_sphinx_ranking_mode'] = $this->language->get('entry_sphinx_ranking_mode');
		
		$this->data['entry_sphinx_match_modes_explanation'] = $this->language->get('entry_sphinx_match_modes_explanation');
		$this->data['entry_sphinx_sort_modes_explanation'] = $this->language->get('entry_sphinx_sort_modes_explanation');
		$this->data['entry_sphinx_ranking_modes_explanation'] = $this->language->get('entry_sphinx_ranking_modes_explanation');
		
		$this->load->model('catalog/sphinxsearch');
		
		$this->data['sphinx_match_modes'] = $this->model_catalog_sphinxsearch->sphinxMatchModes();
		$this->data['sphinx_sort_modes'] = $this->model_catalog_sphinxsearch->sphinxSortModes();
		$this->data['sphinx_ranking_modes'] = $this->model_catalog_sphinxsearch->sphinxRankingModes();
		$this->data['sphinx_sort_attrs'] = $this->model_catalog_sphinxsearch->sphinxSortAttrs();
		
		//Autocomplete tabs
		$this->data['entry_sphinx_autocomplete'] = $this->language->get('entry_sphinx_autocomplete');
		$this->data['entry_autocomplete_selector'] = $this->language->get('entry_autocomplete_selector');
		$this->data['entry_autocomplete_limit'] = $this->language->get('entry_autocomplete_limit');
		$this->data['entry_autocomplete_categories'] = $this->language->get('entry_autocomplete_categories');
		$this->data['entry_sphinx_autocomplete_cat_limit'] = $this->language->get('entry_sphinx_autocomplete_cat_limit');
		
		//Products tab
		$this->data['entry_sphinx_product_status'] = $this->language->get('entry_sphinx_product_status');
		$this->data['entry_sphinx_products_quantity'] = $this->language->get('entry_sphinx_products_quantity');
		
		//Categories tab
		$this->data['entry_sphinx_category_status'] = $this->language->get('entry_sphinx_category_status');
		$this->data['entry_sphinx_category_product_status'] = $this->language->get('entry_sphinx_category_product_status');
		$this->data['entry_sphinx_categories_product_quantity'] = $this->language->get('entry_sphinx_categories_product_quantity');
		
		//Suggestions tab
		$this->data['entry_sphinx_suggestion_explanation'] = $this->language->get('entry_sphinx_suggestion_explanation');
		$this->data['entry_sphinx_gen_btn'] = $this->language->get('entry_sphinx_gen_btn');
		$this->data['entry_sphinx_gen_suggestions'] = $this->language->get('entry_sphinx_gen_suggestions');
		$this->data['entry_sphinx_show_errors_attention'] = $this->language->get('entry_sphinx_show_errors_attention');
		
		//Config tab
		$this->data['entry_sphinx_config_attention'] = $this->language->get('entry_sphinx_config_attention');
		$this->data['entry_sphinx_config_index_type'] = $this->language->get('entry_sphinx_config_index_type');
		$this->data['entry_sphinx_config_path_to_indexes'] = $this->language->get('entry_sphinx_config_path_to_indexes');
		$this->data['entry_sphinx_config_path_to_log'] = $this->language->get('entry_sphinx_config_path_to_log');
		$this->data['entry_sphinx_config_generate_file'] = $this->language->get('entry_sphinx_config_generate_file');
		$this->data['entry_sphinx_gen_config_btn'] = $this->language->get('entry_sphinx_gen_config_btn');
		
		//RT index tab
		$this->data['entry_sphinx_rtIndex_attention'] = $this->language->get('entry_sphinx_rtIndex_attention');
		$this->data['entry_sphinx_rtIndex_gen_products_btn'] = $this->language->get('entry_sphinx_rtIndex_gen_products_btn');
		$this->data['entry_sphinx_rtIndex_gen_categories_btn'] = $this->language->get('entry_sphinx_rtIndex_gen_categories_btn');
		
		//Buttons
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
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
			'href'      => $this->url->link('module/sphinxsearch', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/sphinxsearch', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
		
		//General tab
		if (isset($this->request->post['sphinx_search_module'])) {
			$this->data['sphinx_search_module'] = $this->request->post['sphinx_search_module'];
		} else {
			$this->data['sphinx_search_module'] = $this->config->get('sphinx_search_module');
		}
		
		if (isset($this->request->post['sphinx_search_server'])) {
			$this->data['sphinx_search_server'] = $this->request->post['sphinx_search_server'];
		} else {
			$this->data['sphinx_search_server'] = $this->config->get('sphinx_search_server');
		}
		
		if (isset($this->request->post['sphinx_search_port'])) {
			$this->data['sphinx_search_port'] = $this->request->post['sphinx_search_port'];
		} else {
			$this->data['sphinx_search_port'] = $this->config->get('sphinx_search_port');
		}
		
		if (isset($this->request->post['sphinx_match_mode'])) {
			$this->data['sphinx_match_mode'] = $this->request->post['sphinx_match_mode'];
		} else {
			$this->data['sphinx_match_mode'] = $this->config->get('sphinx_match_mode');
		}
		
		if (isset($this->request->post['sphinx_sort_mode'])) {
			$this->data['sphinx_sort_mode'] = $this->request->post['sphinx_sort_mode'];
		} else {
			$this->data['sphinx_sort_mode'] = $this->config->get('sphinx_sort_mode');
		}
		
		if (isset($this->request->post['sphinx_ranking_mode'])) {
			$this->data['sphinx_ranking_mode'] = $this->request->post['sphinx_ranking_mode'];
		} else {
			$this->data['sphinx_ranking_mode'] = $this->config->get('sphinx_ranking_mode');
		}
		
		if (isset($this->request->post['sphinx_search_sort'])) {
			$this->data['sphinx_search_sort'] = $this->request->post['sphinx_search_sort'];
		} else {
			$this->data['sphinx_search_sort'] = $this->config->get('sphinx_search_sort');
		}
		
		if (isset($this->request->post['sphinx_sort_attr_val'])) {
			$this->data['sphinx_sort_attr_val'] = $this->request->post['sphinx_sort_attr_val'];
		} else {
			$this->data['sphinx_sort_attr_val'] = $this->config->get('sphinx_sort_attr_val');
		}
		
		if (isset($this->request->post['sphinx_weights'])) {
			$this->data['sphinx_weights'] = $this->request->post['sphinx_weights'];
		} else {
			$this->data['sphinx_weights'] = $this->config->get('sphinx_weights');
		}
		
		//Autocomplete tab
		if (isset($this->request->post['sphinx_search_autocomple'])) {
			$this->data['sphinx_search_autocomple'] = $this->request->post['sphinx_search_autocomple'];
		} else {
			$this->data['sphinx_search_autocomple'] = $this->config->get('sphinx_search_autocomple');
		}
		
		if (isset($this->request->post['sphinx_autocomple_selector'])) {
			$this->data['sphinx_autocomple_selector'] = $this->request->post['sphinx_autocomple_selector'];
		} else {
			$this->data['sphinx_autocomple_selector'] = $this->config->get('sphinx_autocomple_selector');
		}
		
		if (isset($this->request->post['sphinx_autocomple_limit'])) {
			$this->data['sphinx_autocomple_limit'] = $this->request->post['sphinx_autocomple_limit'];
		} else {
			$this->data['sphinx_autocomple_limit'] = $this->config->get('sphinx_autocomple_limit');
		}
		
		if (isset($this->request->post['sphinx_search_autocomplete_categories'])) {
			$this->data['sphinx_search_autocomplete_categories'] = $this->request->post['sphinx_search_autocomplete_categories'];
		} else {
			$this->data['sphinx_search_autocomplete_categories'] = $this->config->get('sphinx_search_autocomplete_categories');
		}
		
		if (isset($this->request->post['sphinx_autocomplete_cat_limit'])) {
			$this->data['sphinx_autocomplete_cat_limit'] = $this->request->post['sphinx_autocomplete_cat_limit'];
		} else {
			$this->data['sphinx_autocomplete_cat_limit'] = $this->config->get('sphinx_autocomplete_cat_limit');
		}
		
		//Products tab
		if (isset($this->request->post['sphinx_search_product_status'])) {
			$this->data['sphinx_search_product_status'] = $this->request->post['sphinx_search_product_status'];
		} else {
			$this->data['sphinx_search_product_status'] = $this->config->get('sphinx_search_product_status');
		}
		
		if (isset($this->request->post['sphinx_search_products_quantity'])) {
			$this->data['sphinx_search_products_quantity'] = $this->request->post['sphinx_search_products_quantity'];
		} else {
			$this->data['sphinx_search_products_quantity'] = $this->config->get('sphinx_search_products_quantity');
		}
		
		//Categories tab
		if (isset($this->request->post['sphinx_category_status'])) {
			$this->data['sphinx_category_status'] = $this->request->post['sphinx_category_status'];
		} else {
			$this->data['sphinx_category_status'] = $this->config->get('sphinx_category_status');
		}
		
		if (isset($this->request->post['sphinx_category_product_status'])) {
			$this->data['sphinx_category_product_status'] = $this->request->post['sphinx_category_product_status'];
		} else {
			$this->data['sphinx_category_product_status'] = $this->config->get('sphinx_category_product_status');
		}
		
		if (isset($this->request->post['sphinx_category_product_quantity'])) {
			$this->data['sphinx_category_product_quantity'] = $this->request->post['sphinx_category_product_quantity'];
		} else {
			$this->data['sphinx_category_product_quantity'] = $this->config->get('sphinx_category_product_quantity');
		}
		
		//Config tab
		if (isset($this->request->post['sphinx_config_index_type'])) {
			$this->data['sphinx_config_index_type'] = $this->request->post['sphinx_config_index_type'];
		} else {
			$this->data['sphinx_config_index_type'] = $this->config->get('sphinx_config_index_type');
		}
		
		if (isset($this->request->post['sphinx_config_path_to_indexes'])) {
			$this->data['sphinx_config_path_to_indexes'] = $this->request->post['sphinx_config_path_to_indexes'];
		} else {
			$this->data['sphinx_config_path_to_indexes'] = $this->config->get('sphinx_config_path_to_indexes');
		}
		
		if (isset($this->request->post['sphinx_config_path_to_log'])) {
			$this->data['sphinx_config_path_to_log'] = $this->request->post['sphinx_config_path_to_log'];
		} else {
			$this->data['sphinx_config_path_to_log'] = $this->config->get('sphinx_config_path_to_log');
		}
		
		$this->template = 'module/sphinxsearch.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->document->addStyle('view/stylesheet/sphinx.css');
				
		$this->response->setOutput($this->render());
	}
	
	public function save() {
		
		$postdata = $this->request->post;
		
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('sphinxsearch', $postdata);
		
	} 
	
	/**
	 * Generate suggestions - gets all products from 'product_description' table, extract the keywords, builds trigrams and freqs
	 */
	public function generateSuggestions() {
		
		if (!$this->validate()) {
			echo 'You have no permissons to do that!';
			return;
		}
		
		$timeLimit = (int)ini_get('max_execution_time')-10;
		$timeStart = microtime(true);
		
		$this->load->model('catalog/sphinxsearch');
		
		$isRtIndex = $this->config->get('sphinx_config_index_type');
		
		$sphinxConnection = $this->checkSphinxConnection();

		if($sphinxConnection['error'] != '') {
			$this->response->setOutput(json_encode($sphinxConnection));
			return;
		}
		
		$offset = 0;
		if(isset($this->request->get['offset'])) {
			$offset = (int)$this->request->get['offset'];
		}
		
		$this->load->model('catalog/product');
		
		if($offset == 0) {
			$this->session->data['total'] = (int)$this->model_catalog_product->getTotalProducts();
		}
		
		if($offset == 0 && !$isRtIndex) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "sphinx_suggestions`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "sphinx_suggestions` AUTO_INCREMENT =1;");
		}
		
		$data = array(
			'start' => $offset,
			'limit' => $this->LIMIT
		);
		
		$products = $this->model_catalog_product->getProducts($data);
		
		if(empty($products) || $products == '') {
			$json = array(
					'error' => 'No products found!',
					'offset' => '',
					'limit' => $this->LIMIT,
					'total' => ''
			);
			$this->response->setOutput(json_encode($json));
			return;
		}
		
		foreach ($products as $idx => $product) {
			
			if (microtime(true) - $timeStart >= $timeLimit) {
				break;
			}
			
			$productDesc = $this->model_catalog_product->getProductDescriptions($product['product_id']);
			
			$result = $this->model_catalog_sphinxsearch->addToSphinxSuggestions($productDesc);
				
		}
		
		$json = array(
			'error' => '',
			'offset' => $offset+$idx+1,
			'limit' => $this->LIMIT,
			'total' => $this->session->data['total']	
		);
		
		if(isset($result['error'])) {
			$json = array(
					'error' => $result['error'],
					'offset' => '',
					'limit' => $this->LIMIT,
					'total' => ''
			);
		}
		$this->response->setOutput(json_encode($json));
		
	}
	
	public function generateSphinxConfig() {
		
		$baseFile = DIR_SYSTEM .'library/sphinx/sphinx.conf.in';
		
		if($this->config->get('sphinx_config_index_type')) {
			$baseFile = DIR_SYSTEM .'library/sphinx/sphinx.rt.conf.in';
		}
		
		$newConfigFile = DIR_DOWNLOAD .'sphinx.conf';
		
		if(!file_exists($baseFile)) {
			die('Please make sure that '. $baseFile. ' exists!');
		}
		
		$baseFileContent = file_get_contents($baseFile);
		
		$find = array(
			'{{ sphinx_config_db_host }}',
			'{{ sphinx_config_db_user }}',
			'{{ sphinx_config_db_pass }}',
			'{{ sphinx_config_db_name }}',
			'{{ sphinx_config_db_table_prefix }}',
			'{{ sphinx_config_path_to_indexes }}',
			'{{ sphinx_config_path_to_log }}'
		);
		
		$replace = array(
			DB_HOSTNAME,
			DB_USERNAME,
			DB_PASSWORD,
			DB_DATABASE,
			DB_PREFIX,
			$this->config->get('sphinx_config_path_to_indexes'),
			$this->config->get('sphinx_config_path_to_log')
		);
		
		$newContent = str_replace($find, $replace, $baseFileContent);
		 
		file_put_contents($newConfigFile, $newContent);
		
		if (file_exists($newConfigFile)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($newConfigFile));
			readfile($newConfigFile);
		}
		
		unlink($newConfigFile);
		
	}
	
	public function buildProductsRtIndex() {
		
		$timeLimit = (int)ini_get('max_execution_time')-10;
		$timeStart = microtime(true);
		
		$this->load->model('catalog/sphinxsearch');
		$this->load->model('catalog/product');
		
		//Check sphinx connection before continue
		$sphinxConnection = $this->checkSphinxConnection();

		if($sphinxConnection['error'] != '') {
			$this->response->setOutput(json_encode($sphinxConnection));
			return;
		}
		
		$offset = 0;
		if(isset($this->request->get['offset'])) {
			$offset = (int)$this->request->get['offset'];
		}
		
		if($offset == 0) {
			$this->session->data['main_total'] = (int)$this->model_catalog_product->getTotalProducts();
		}

		$products = $this->model_catalog_product->getProducts(array('start' => $offset, 'limit' => $this->LIMIT));
		
		if(empty($products) || $products == '') {
			$json = array(
					'error' => 'No products found!',
					'offset' => '',
					'limit' => '',
					'total' => ''
			);
			
			$this->response->setOutput(json_encode($json));
			return;
		}
		
		foreach ($products as $idx => $product) {
				
			if (microtime(true) - $timeStart >= $timeLimit) {
				break;
			}
			
			$productDesc = $this->model_catalog_product->getProductDescriptions($product['product_id']);
			$productRating = $this->model_catalog_sphinxsearch->getRatingByProductId($product['product_id']);
			
			if(empty($productDesc)) {
				continue;
			}
			
			foreach ($productDesc as $lang_id => $info) {
				//Prepare the data
				$productInfo = array_merge($info, $product);
				$productInfo['id'] = $this->model_catalog_sphinxsearch->properSphinxId($product['product_id'], $lang_id);
				$productInfo['product_id'] = $this->model_catalog_sphinxsearch->properSphinxId($product['product_id'], $lang_id);
				$productInfo['name'] = $info['name'];
				$productInfo['description'] = $info['description'];
				$productInfo['language_id'] = $lang_id;
				$productInfo['date_available'] = strtotime($product['date_available']);
				$productInfo['rating'] = $productRating;
				$categoriesFilter = (implode(',', $this->model_catalog_product->getProductCategories($product['product_id'])) != 0) ? '('.implode(',', $this->model_catalog_product->getProductCategories($product['product_id'])).')' : '(0)';
				$productInfo['categories_filter'] = $categoriesFilter;
				$storeFilter = (implode(',', $this->model_catalog_product->getProductStores($product['product_id'])) != 0) ? '('.implode(',', $this->model_catalog_product->getProductStores($product['product_id'])).')' : '(0)';
				$productInfo['store_filter'] = $storeFilter;
				
				$productAttributes = $this->model_catalog_product->getProductAttributes($product['product_id']);
				$prAttributes = array();
				if(is_array($productAttributes) && !empty($productAttributes)) {
					foreach ($productAttributes as $attribute) {
						$prAttributes[] = $attribute['attribute_id'];
					}
					
					$productInfo['product_attribute'] = '('. implode(',', $prAttributes) .')';
				}
				
				$this->model_catalog_sphinxsearch->insertOrReplace('products', $productInfo);
			}
		}
		
		$json = array(
				'offset' => $offset+$idx+1,
				'limit' => $this->LIMIT,
				'total' => $this->session->data['main_total']
		);
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function buildCategoriesRtIndex() {
		
		$timeLimit = (int)ini_get('max_execution_time')-10;
		$timeStart = microtime(true);
		
		$this->load->model('catalog/sphinxsearch');
		$this->load->model('catalog/category');
		
		//Check sphinx connection before continue
		$sphinxConnection = $this->checkSphinxConnection();

		if($sphinxConnection['error'] != '') {
			$this->response->setOutput(json_encode($sphinxConnection));
			return;
		}
		
		$offset = 0;
		if(isset($this->request->get['offset'])) {
			$offset = (int)$this->request->get['offset'];
		}
		
		if($offset == 0) {
			$this->session->data['categoryinfo_total'] = $this->model_catalog_sphinxsearch->getTotalRows('category_description');
		}
		
		$categories = $this->model_catalog_sphinxsearch->getCategories($offset, $this->LIMIT);

		if(empty($categories) || $categories == '') {
			$json = array(
					'error' => 'No categories found!',
					'offset' => '',
					'limit' => '',
					'total' => ''
			);
		
			$this->response->setOutput(json_encode($json));
			return;
		}
		
		foreach($categories as $idx => &$res) {
				
			if (microtime(true) - $timeStart >= $timeLimit) {
				break;
			}

			//Prepare the data
			$res['id'] = $this->model_catalog_sphinxsearch->properSphinxId($res['category_id'], $res['language_id']);
			$res['category_id'] = $this->model_catalog_sphinxsearch->properSphinxId($res['category_id'], $res['language_id']);
			
			$store_filter = (implode(',', $this->model_catalog_category->getCategoryStores($res['category_id'])) != 0) ? '('.implode(',', $this->model_catalog_category->getCategoryStores($res['category_id'])).')' : '(0)';
			$res['store_filter'] = $store_filter; 
			
			$this->model_catalog_sphinxsearch->insertOrReplace('categories', $res, 'insert');
		}
		
		$json = array(
				'offset' => $offset+$idx+1,
				'limit' => $this->LIMIT,
				'total' => $this->session->data['categoryinfo_total']
		);
		
		$this->response->setOutput(json_encode($json));
		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/sphinxsearch')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	protected function checkSphinxConnection() {
		
		$this->load->model('catalog/product');
		
		$sphinxConnection = $this->model_catalog_sphinxsearch->sphinxConnection();
		if($sphinxConnection->connect_error) {


			$json = array(
					'error' => $sphinxConnection->connect_error,
					'offset' => '',
					'limit' => '',
					'total' => ''
			);
		
			return $json;

		}
	}
	
}

?>