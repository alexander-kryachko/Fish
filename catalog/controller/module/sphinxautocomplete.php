<?php
//*******************************************************************************
// Sphinx Search v1.2.2
// Author: Iverest EOOD
// E-mail: sales@iverest.com
// Website: http://www.iverest.com
//*******************************************************************************

class ControllerModuleSphinxautocomplete extends Controller {

    public function sphinx_autocomplete_js()
    {
        if(!$this->config->get('sphinx_search_module') || !$this->config->get('sphinx_search_autocomple')) {
            return '';
        }

        $this->language->load('module/sphinx');

        $this->data['label_categories'] = $this->language->get('label_categories');
		$this->data['label_products'] = $this->language->get('label_products');
		$this->data['label_view_all'] = $this->language->get('label_view_all');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$ssl = 'NONSSL';

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
		    $ssl = 'SSL';
		}

		$query_string = 'search';
		$version = (!defined('VERSION')) ? 140 : (int)substr(str_replace('.', '', VERSION), 0, 3);
		if ($version < 150) { $query_string = 'keyword'; }
		if ($version < 155) { $query_string = 'filter_name'; }

		$this->data['search_url'] = $this->url->link('product/search', 'wildcard=true&' . $query_string .'=', $ssl);
		$this->data['autocomplete_url'] = $this->url->link('module/sphinxautocomplete', 'search=', $ssl);

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/sphinxautocomplete.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/sphinxautocomplete.tpl';
        } else {
            $this->template = 'default/template/module/sphinxautocomplete.tpl';
        }

        $this->render();
    }

	public function index() {


		$categories = array();
		$products = array();

		if (!isset($this->request->get['search']) || trim($this->request->get['search']) == '') {
		    $this->response->setOutput(json_encode(array('products' => $products, 'categories' => $categories)));
		    return;
		}

		$this->load->model('catalog/sphinx');

		$autoCompleteLimit = (int)$this->config->get('sphinx_autocomple_limit');
		if (!$autoCompleteLimit) {
		    $autoCompleteLimit = 5;
		}

		$searchData = array(
		                      'filter_name' => $this->request->get['search'],
		                      'sort' => 'default',
		                      'filter_category_id' => 0,
		                      'start' => 0,
		                      'limit' => $autoCompleteLimit
		                   );

		$resultsProducts = $this->model_catalog_sphinx->search($searchData, 'products', true);

		$this->load->model('tool/image');

		foreach ($resultsProducts['results'] as $product) {
		    $image = $this->model_tool_image->resize(($product['image']) ? $product['image'] : 'no_image.jpg', 40, 40);

		    $products[] = array(
                    		    'name'			=> $product['name'],
                    		    'href'			=> $this->url->link('product/product', 'product_id=' . $product['product_id']),
                    		    'image'			=> $image,
		                       );
		}

		if (!(int)$this->config->get('sphinx_search_autocomplete_categories') || !(int)$this->config->get('sphinx_autocomplete_cat_limit')) {
		    $this->response->setOutput(json_encode(array('products' => $products, 'categories' => $categories)));
		    return;
		}

		$autoCompleteCatLimit = (int)$this->config->get('sphinx_autocomplete_cat_limit');
		
		if (!$autoCompleteCatLimit) {
			$autoCompleteCatLimit = 5;
		}
		
		$searchData['limit'] = $autoCompleteCatLimit;

		$resultsCategories = $this->model_catalog_sphinx->search($searchData, 'categories', true);

		foreach ($resultsCategories['results'] as $category) {
		    if($category['image']) {
		        $image = $this->model_tool_image->resize($category['image'], 40, 40);
		    } else {
		        $image = '';
		    }

		    $categories[] = array(
                		    'name' => $category['name'],
                		    'href' => $this->url->link('product/category', 'path='.$category['category_id']),
                		    'image' => $image
		    );
		}

		$this->response->setOutput(json_encode(array('products' => $products, 'categories' => $categories)));
    }

}
?>