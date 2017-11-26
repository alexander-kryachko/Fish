<?php
class ControllerCheckoutSuccess extends Controller { 
	public function index() {

		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['ecommerce_tracking_status'] = false;
		$this->data['order'] = array();
		$this->data['order_products'] = array();

		if ($this->config->get('ecommerce_tracking_status') && $this->config->get('config_google_analytics')){
			$this->data['ecommerce_tracking_status'] = true;

			if (strpos($this->data['google_analytics'], 'i,s,o,g,r,a,m') !== false) {
				$ecommerce_global_object_pos = strrpos($this->data['google_analytics'], "analytics.js','") + strlen("analytics.js','");
				$this->data['ecommerce_global_object'] = substr($this->data['google_analytics'], $ecommerce_global_object_pos, (strpos($this->data['google_analytics'], "');", $ecommerce_global_object_pos) - $ecommerce_global_object_pos));
				$this->data['start_google_code'] = substr($this->data['google_analytics'], 0, (strpos($this->data['google_analytics'], "pageview');") + strlen("pageview');")));
				$this->data['end_google_code'] = substr($this->data['google_analytics'], (strpos($this->data['google_analytics'], "pageview');") + strlen("pageview');")));
			} else {
				$this->data['ecommerce_global_object'] = false;
				$this->data['start_google_code'] = substr($this->data['google_analytics'], 0, strpos($this->data['google_analytics'], '(function'));
				$this->data['end_google_code'] = substr($this->data['google_analytics'], strpos($this->data['google_analytics'], '(function'));
			}

			if (isset($this->session->data['order_id'])){
				$order_id = $this->session->data['order_id'];

				$this->load->model('account/order');

				$order_info = $this->model_account_order->getOrder($order_id);

				if ($order_info){
					$tax = 0;
					$shipping = 0;

					$order_totals = $this->model_account_order->getOrderTotals($order_id);
					foreach ($order_totals as $order_total) {
						if ($order_total['code'] == 'tax') {
							$tax += $order_total['value'];
						} elseif($order_total['code'] == 'shipping') {
							$shipping += $order_total['value'];
						}
					}

					// Data required for _addTrans
					$this->data['order'] = $order_info;
					$this->data['order']['store_name'] = $this->config->get('config_name');
					$this->data['order']['order_total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
					$this->data['order']['order_tax'] = $this->currency->format($tax, $order_info['currency_code'], $order_info['currency_value'], false);
					$this->data['order']['order_shipping'] = $this->currency->format($shipping, $order_info['currency_code'], $order_info['currency_value'], false);

					// Data required for _addItem
					$order_products = $this->model_account_order->getOrderProducts($order_id);

					$this->load->model('catalog/product');
					$this->load->model('catalog/category');

					foreach ($order_products as $order_product) {
						$sku = $order_product['product_id'];

						if (($this->config->get('ecommerce_tracking_sku') == 'sku') || ($this->config->get('ecommerce_tracking_sku') == 'sku_option')) {
							$order_product_info = $this->model_catalog_product->getProduct($order_product['product_id']);

							if ($order_product_info && $order_product_info['sku']) {
								$sku = $order_product_info['sku'];
							}
						}

						if (($this->config->get('ecommerce_tracking_sku') == 'id_option') || ($this->config->get('ecommerce_tracking_sku') == 'sku_option')) {
							$order_options = $this->model_account_order->getOrderOptions($order_id, $order_product['order_product_id']);

							foreach ($order_options as $order_option) {
								$sku .= '-' . $order_option['product_option_id'] . ':' . $order_option['product_option_value_id'];

								if ($order_option['type'] != 'file') {
									$option_value = $order_option['value'];
								} else {
									$option_value = utf8_substr($order_option['value'], 0, utf8_strrpos($order_option['value'], '.'));
								}

								$order_product['name'] .= ' - ' . $order_option['name'] . ': ' . (utf8_strlen($option_value) > 20 ? utf8_substr($option_value, 0, 20) . '..' : $option_value);
							}
						}

						$categories = array();

						$order_product_categories = $this->model_catalog_product->getCategories($order_product['product_id']);

						if ($order_product_categories) {
							foreach ($order_product_categories as $order_product_category) {
								$category_data = $this->model_catalog_category->getCategory($order_product_category['category_id']);

								if ($category_data) {
									$categories[] = $category_data['name'];
								}
							}
						}

						$this->data['order_products'][] = array(
							'order_id' => $order_id,
							'sku'      => $sku,
							'name'     => $order_product['name'],
							'category' => implode(',', $categories),
							'quantity' => $order_product['quantity'],
							'price'    => $this->currency->format($order_product['price'] + ($this->config->get('config_tax') ? $order_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value'], false)
						);
					}
				}
			}
		}
		
		if (isset($this->session->data['order_id'])) {
			$utm_source = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : false;
			$click_id = isset($_COOKIE['click_id']) ? $_COOKIE['click_id'] : false;
			$prx = isset($_COOKIE['prx']) ? $_COOKIE['prx'] : false;
			$order_id = isset($this->session->data['order_id']) ? $this->session->data['order_id'] : false;
			$this->load->model('account/order');
			$order_info = $this->model_account_order->getOrder($order_id);
			if ($order_info) $order_total = $order_info['total'];
			$order_totals = $this->model_account_order->getOrderTotals($order_id);
			foreach($order_totals as $ot){
				if ($ot['code'] == 'coupon'){
					$coupon = $ot['title'];
				}
			}
			

			$flocktoryBasket = $basket = $cityAdsProductIds = $cityAdsProductQty = array();
			$order_products = $this->model_account_order->getOrderProducts($order_id);
			$this->load->model('catalog/product');
			$this->load->model('catalog/category');
			$subtotal = 0;
			foreach ($order_products as $order_product){
				if (($this->config->get('ecommerce_tracking_sku') == 'id_option') || ($this->config->get('ecommerce_tracking_sku') == 'sku_option')) {
					$order_options = $this->model_account_order->getOrderOptions($order_id, $order_product['order_product_id']);
					foreach ($order_options as $order_option) {
						if ($order_option['type'] != 'file') {
							$option_value = $order_option['value'];
						} else {
							$option_value = utf8_substr($order_option['value'], 0, utf8_strrpos($order_option['value'], '.'));
						}
						$order_product['name'] .= ' - ' . $order_option['name'] . ': ' . (utf8_strlen($option_value) > 20 ? utf8_substr($option_value, 0, 20) . '..' : $option_value);
					}
				}
				$categories = array();
				$order_product_categories = $this->model_catalog_product->getCategories($order_product['product_id']);
				if ($order_product_categories) {
					foreach ($order_product_categories as $order_product_category) {
						$category_data = $this->model_catalog_category->getCategory($order_product_category['category_id']);
						if ($category_data) $categories[] = $category_data['name'];
					}
				}
				$productUP = $order_product['price'] + ($this->config->get('config_tax') ? $order_product['tax'] : 0);
				$basket[] = array(
					"pid" => $order_product['product_id'],
					"pn" => $order_product['name'],
					"up" => number_format($productUP, 2, '.', ''),
					"pc" => implode(',', $categories),
					"qty" => $order_product['quantity'],
					"pd" => ""
				);
				$flocktoryBasket[] = array(
					"id" => $order_product['product_id'],
					"title" => $order_product['name'],
					"price" => number_format($productUP, 2, '.', ''),
					"count" => $order_product['quantity']
				);
				$cityAdsProductIds[] = $order_product['product_id'];
				$cityAdsProductQty[] = $order_product['quantity'];
				$subtotal += $order_product['quantity'] * $productUP;

				$_SESSION['cityadsTPM'] = "var xcnt_order_products = '".implode(',', $cityAdsProductIds)."';".PHP_EOL;
				$_SESSION['cityadsTPM'] .= "var xcnt_order_quantity = '".implode(',', $cityAdsProductQty)."';".PHP_EOL;
				$_SESSION['cityadsTPM'] .= "var xcnt_order_id = '".$order_id."';".PHP_EOL;
				$_SESSION['cityadsTPM'] .= "var xcnt_order_total = '".number_format($order_total, 2, '.', '')."';".PHP_EOL;
				$_SESSION['cityadsTPM'] .= "var xcnt_order_currency = 'UAH';".PHP_EOL;
				//$_SESSION['cityadsTPM'] .= "var xcnt_user_email = 'user@test.me';".PHP_EOL;
				//$_SESSION['cityadsTPM'] .= "var xcnt_user_id = '123456';".PHP_EOL;
			}		

			if ($utm_source == 'cityads' && $order_id && $click_id && $prx && !empty($order_info) && !empty($basket)){
				$discount = $subtotal - $order_total;
				$_SESSION['cityads_show_pixel'] = array(
					'order_id' => $order_id,
					'target_name' => 'q1',
					'partner_id' => CITYADS_PARTNER,
					'click_id' => $click_id,
					'prx' => $prx,
					'customer_type' => 'new',
					'payment_method' => 'cash',
					'order_total' => number_format($order_total, 2, '.', ''),
					'coupon' => !empty($coupon) ? $coupon : '',
					'discount' => number_format($discount, 2, '.', ''),
					'currency' => 'UAH',
					'basket' => json_encode($basket)
				);
				
				$url = "https://cityads.ru/service/postback?currency=UAH&order_id=".$order_id."&prx=".$prx."&click_id=".$click_id;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				$response = curl_exec($ch);
				$xml = new SimpleXMLElement($response);
				$code = strval($xml->code);
				if ($code == 'OK') {
					// Success
				} else {
					// Failed: Send repeat
				}
			}
			//$_SESSION['cityads_show_pixel'] = true;

			if ($order_id && !empty($order_info) && !empty($flocktoryBasket)){
				//BOF: Flocktory /*
			/*	$_SESSION['flocktory'] = array(
					'order_id' => $order_id,
					'order_total' => number_format($order_total, 2, '.', ''),
					'basket' => $flocktoryBasket,
					'email' => $order_info['email'],
					'name' => trim($order_info['firstname'])//.' '.$order_info['lastname'])
				);
			*/	//EOF: Flocktory
			}
// REES46 Purchase Begin
$rees46_cookie_content = array('items' => array(), 'order_id' => $this->session->data['order_id']);
$current_cart = $this->cart->getProducts();
foreach ($current_cart as $cart_item) {
  array_push($rees46_cookie_content['items'], array('item_id' => $cart_item['product_id'], 'price' => $cart_item['price'], 'amount' => $cart_item['quantity']));
}
setcookie('rees46_track_purchase', json_encode($rees46_cookie_content));
// REES46 Purchase End
			$this->cart->clear();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
		}	
									   
		$this->language->load('checkout/success');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_basket'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);	
					
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/success'),
        	'text'      => $this->language->get('text_success'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		if ($this->customer->isLogged()) {
    		$this->data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
    		$this->data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}
		
    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'			
		);
				
		$this->response->setOutput($this->render());
  	}
}
?>