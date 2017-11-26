<?php
class ControllerModuleViewed extends Controller {
	
	public function index($setting) {
				
				
		$this->load->model('setting/setting');
			
		if (isset($this->request->get['product_id'])) {
			$this->data['product_id'] = (int)$this->request->get['product_id'];//$this->url->link('module/ajax_viewed', 'product_id=' . (int)$this->request->get['product_id']);
		} else {
			$this->data['product_id'] = 0;
		}
		
	
		$this->data['module_setting'] = base64_encode(json_encode($setting));

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ajax_viewed.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/ajax_viewed.tpl';
		} else {
			$this->template = 'default/template/module/ajax_viewed.tpl';
		}
		
			$this->render();
				
	}
		
	
	
	public function getproducts() {
		
		$setting = array();
			
		if (isset($this->request->get['setting'])) {
			$setting = (array)json_decode(base64_decode($this->request->get['setting']));
		}
		
		

		
		$limit = 7;
		
		$viewed_products = array();
		
		 if (isset($this->session->data['viewed'])) {
			$viewed_products = $this->session->data['viewed'];
		} elseif(isset($this->request->cookie['ajviewed'])) {
			$viewed_products = explode(',', $this->request->cookie['ajviewed']);
		}
			
		
		$product_id = 0;
		
			
	   if (isset($this->request->get['product_id']) && (int)$this->request->get['product_id'] != 0) {
            
            $product_id = (string)$this->request->get['product_id'];   
			
			array_unshift($viewed_products, $product_id);
			
			$viewed_products = array_unique($viewed_products);
			
			if(count($viewed_products) >  $limit+1) {
				$viewed_products = array_slice($viewed_products, 0, $limit+1);
			}
	
					
			
            
            setcookie('ajviewed', implode(',',$viewed_products), time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
			
	

            if (!isset($this->session->data['viewed']) || ($this->session->data['viewed'] != $viewed_products)) {
				   
          		$this->session->data['viewed'] = $viewed_products;
												
        	}
		
			unset($viewed_products[array_search($product_id, $viewed_products)]);
				
        } 

		$viewed_products = array_slice($viewed_products, 0, $limit);
		
				
	//	$this->data['heading_title'] = $setting['name'];

		$this->data['text_tax'] = $this->language->get('text_tax');

		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_wishlist'] = $this->language->get('button_wishlist');
		$this->data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$this->data['products'] = array();

		if ($viewed_products && $product_id == 0) {
		
		foreach ($viewed_products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
					} else {
						$image = false;
					}


					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$this->data['products'][] = array(
						'product_id' => $product_info['product_id'],
						'thumb'   	 => $image,
						'name'    	 => $product_info['name'],
						'price'   	 => $price,
						'special' 	 => $special,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					);
				}
			}
		
		
		

			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ajax_viewed_product.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/module/ajax_viewed_product.tpl';
				} else {
					$this->template = 'default/template/module/ajax_viewed_product.tpl';
				}

			        $this->response->setOutput($this->render());
		}
	}
	
}
