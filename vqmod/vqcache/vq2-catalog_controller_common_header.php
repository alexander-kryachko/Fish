<?php
class ControllerCommonHeader extends Controller {
    protected function index() {
// Clear Thinking: Redirect Manager
				if ($this->config->get('redirect_manager_status')) {
					$preserve_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` WHERE from_url LIKE '%?%'");
					$request_uri = (!$preserve_query->num_rows) ? explode('?', urldecode($this->request->server['REQUEST_URI'])) : array(urldecode($this->request->server['REQUEST_URI']));
					$query_string = (!empty($request_uri[1])) ? $request_uri[1] : '';
					
					$from = 'http' . (isset($this->request->server['HTTPS']) && $this->request->server['HTTPS'] != 'off' ? 's' : '') . '://' . $this->request->server['HTTP_HOST'] . $request_uri[0];
					if (substr($from, -1) == '/') $from = substr($from, 0, -1);
					
					$wildcard_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` WHERE from_url LIKE '%*%'");
					if ($wildcard_query->num_rows) {
						$redirect_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` WHERE ('" . $this->db->escape($from) . "' LIKE REPLACE(REPLACE(from_url, '_', '\_'), '*', '%') OR '" . $this->db->escape($from) . "/' LIKE REPLACE(REPLACE(from_url, '_', '\_'), '*', '%')) AND active = 1 AND (date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())");
					} else {
						$redirect_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` WHERE ('" . $this->db->escape($from) . "' = from_url OR '" . $this->db->escape($from) . "/' = from_url) AND active = 1 AND (date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())");
					}
					
					if ($redirect_query->num_rows) {
						$this->db->query("UPDATE `" . DB_PREFIX . "redirect` SET times_used = times_used+1 WHERE redirect_id = " . (int)$redirect_query->row['redirect_id']);
						if (substr($redirect_query->row['from_url'], -1) == '/') $redirect_query->row['from_url'] = substr($redirect_query->row['from_url'], 0, -1);
						
						$from_wildcards = explode('|', str_replace(explode('*', $redirect_query->row['from_url']), '|', $from . '/'));
						$to_wildcards = explode('*', $redirect_query->row['to_url']);
						
						$to = '';
						for ($i = 0; $i < count($to_wildcards); $i++) {
							$to .= $from_wildcards[$i] . $to_wildcards[$i];
						}
						if ($query_string) $to .= (strpos($redirect_query->row['to_url'], '?')) ? '&' . $query_string : '?' . $query_string;
						
						header('Location: ' . str_replace('&amp;', '&', $to), true, $redirect_query->row['response_code']);
						exit();
					}
				}
				// end

	//promotions start
	$this->document->addStyle('catalog/view/theme/default/stylesheet/promotion.css');
$this->document->addScript('catalog/view/javascript/promotion.js');
$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');	
//promotions
       $this->data['title'] = $this->document->getTitle();

		//Shoputils.Auto.Update.Orders Begin
		$this->load->model('shoputils/auto_update_orders');
		$this->model_shoputils_auto_update_orders->autoUpdateOrders();
		//Shoputils.Auto.Update.Orders End
	  

	  
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        $this->data['base'] = $server;
        $this->data['description'] = $this->document->getDescription();
        $this->data['keywords'] = $this->document->getKeywords();
        $this->data['links'] = $this->document->getLinks();
//		$this->document->addStyle('catalog/view/theme/default/stylesheet/product_statuses.css'); // product statuses
        $this->data['styles'] = $this->document->getStyles();
        $this->data['scripts'] = $this->document->getScripts();
        $this->data['lang'] = $this->language->get('code');
        $this->data['direction'] = $this->language->get('direction');
		
		if ($this->config->get('ecommerce_tracking_status') && isset($this->request->get['route']) && $this->request->get['route'] == 'checkout/success') {
			$this->data['google_analytics'] = '';
		} else {
			$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		}
		
        $this->data['name'] = $this->config->get('config_name');

        if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
        } else {
            $this->data['icon'] = '';
        }

        if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
            $this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
        } else {
            $this->data['logo'] = '';
        }
        $this->language->load('common/header');
        $this->data['og_url'] = (isset($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1));
        $this->data['og_image'] = $this->document->getOgImage();
        $this->data['text_home'] = $this->language->get('text_home');
        $this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
        $this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
        $this->data['text_search'] = $this->language->get('text_search');
        $this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
        $this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
        $this->data['text_account'] = $this->language->get('text_account');
        $this->data['text_checkout'] = $this->language->get('text_checkout');
        $this->data['home'] = $this->url->link('common/home');
        $this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
        $this->data['logged'] = $this->customer->isLogged();
        $this->data['account'] = $this->url->link('account/account', '', 'SSL');
        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        $this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

        // Daniel's robot detector
        $status = true;
        if (isset($this->request->server['HTTP_USER_AGENT'])){
            $robots = explode("\n", trim($this->config->get('config_robots')));

            foreach ($robots as $robot) {
                if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
                    $status = false;

                    break;
                }
            }
        }

        // A dirty hack to try to set a cookie for the multi-store feature
        $this->load->model('setting/store');
        $this->data['stores'] = array();
        if ($this->config->get('config_shared') && $status) {
            $this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();

            $stores = $this->model_setting_store->getStores();

            foreach ($stores as $store) {
                $this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
            }
        }

        // Search
        if (isset($this->request->get['search'])) {
            $this->data['search'] = $this->request->get['search'];
        } else {
            $this->data['search'] = '';
        }

        // Menu
        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string)$this->request->get['path']);
        } else {
            $parts = array();
        }
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->data['categories'] = array();

		//$categories = $this->model_catalog_category->getCategories(0);
		$categories = array();
        foreach ($categories as $category) {
            if ($category['top']) {
                // Level 2
                $children_data = array();

                $children = $this->model_catalog_category->getCategories($category['category_id']);

                foreach ($children as $child) {
                    //Будем вычислять кол-во товаров в категориях только если это кол-во надо показывать
                    if ($this->config->get('config_product_count')) {
                        $data = array(
                            'filter_category_id'  => $child['category_id'],
                            'filter_sub_category' => true
                        );

                        //$product_total = $this->model_catalog_product->freelancer($data);
                        $product_total = false;
                    }

                    $children_data[] = array(
                        'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
                        'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
                        'children' => $this->getChildrenData($child['category_id'], $category['category_id'])   // rb, 2011-09-03: menu 3rd level
                    );
                }

                // Level 1
                $this->data['categories'][] = array(
                    'name'     => $category['name'],
                    'children' => $children_data,
                    'active'   => in_array($category['category_id'], $parts),
                    'column'   => $category['column'] ? $category['column'] : 1,
                    'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
                );
            }
        }

 		$this->data['categories'] = null;
		$this->children = array(
            'module/language',
			//'module/supermenu',
			//'module/supermenu_settings',
            'module/currency',
            //'module/cart',
			 'module/sphinxautocomplete/sphinx_autocomplete_js'
        );
		$this->data['categories'] = array();
	
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/header.tpl';
        } else {
            $this->template = 'default/template/common/header.tpl';
        }

        $this->render();
		// rb, 2011-09-03: menu 3rd level
    }
    private function getChildrenData( $ctg_id, $path_prefix ){
		$children_data = array();
		$children = $this->model_catalog_category->getCategories($ctg_id);

		foreach ($children as $child) {
			$data = array(
				'filter_category_id'  => $child['category_id'],
				'filter_sub_category' => true
			);

			//if ($this->config->get('config_product_count')) { $product_total = $this->model_catalog_product->getTotalProducts($data); }
			$product_total = false;

			$children_data[] = array(
				'name'  => $child['name'],
				'href'  => $this->url->link('product/category', 'path=' . $path_prefix . '_' . $child['category_id'])
			);
		}
		return $children_data;
    }
}
?>