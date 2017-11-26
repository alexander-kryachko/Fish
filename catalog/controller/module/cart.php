<?php
class ControllerModuleCart extends Controller {
    public function index() {
        $this->language->load('module/cart');
        $this->load->model('catalog/product');

        if (isset($this->request->get['remove'])) {
			$removeId = $this->request->get['remove'];
			preg_match("/(.*)-(\d+)_0/", $removeId, $m);
			if (!empty($m[2])){
				$setId = $m[2];
				if (isset($this->cart->session->data['cart'])){
					foreach(array_keys($this->cart->session->data['cart']) as $cid){
						preg_match("/(.*)-".$setId."_0/", $cid, $m);
						if (!empty($m[1])){
							$this->cart->remove($cid);

							unset($this->session->data['vouchers'][$cid]);
						}
					}
				}
			} else {
				$this->cart->remove($removeId);
				unset($this->session->data['vouchers'][$removeId]);
			}
        }

        if (isset($this->request->get['product_id']) && isset($this->request->get['quantity'])) {
            $key = $this->request->get['product_id'];
            $value = $this->request->get['quantity'];

            $this->cart->update($key, $value);
        }

        if (isset($this->request->get['coupon']) && $this->validateCoupon()) {
            $this->session->data['coupon'] = $this->request->get['coupon'];
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } elseif (!$this->cart->checkMinTotal()) {
            $this->data['error_warning'] = sprintf($this->language->get('error_min_total'), $this->currency->format($this->cart->getMinTotal()));
        } elseif ($this->cart->getProducts() && !$this->cart->hasStock() && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
            $this->data['error_warning'] = $this->language->get('error_stock');
        } else {
            $this->data['error_warning'] = '';
        }

        // Totals
        $this->load->model('setting/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            $sort_order = array();

            $results = $this->model_setting_extension->getExtensions('total');
            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);
            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);
                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                }

                $sort_order = array();

                foreach ($total_data as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
                }

                array_multisort($sort_order, SORT_ASC, $total_data);
            }
        }

        $this->data['total'] = end($total_data);

        if (isset($this->session->data['coupon'])) {
            $this->data['total']['title'] .= ' (с учетом скидки)';
			//$this->data['total']['title'] .= var_export($this->session->data['coupon'], true);
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_items'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), '='.$total.'='.$this->currency->format($total));
        $this->data['text_empty'] = $this->language->get('text_empty');
        //$this->data['total_price'] = sprintf($this->language->get('total_price'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
		$nItems = $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0);
		$this->data['total_price'] = '<div class="cart-items"><span>'.$nItems.'</span> '.$this->declension($nItems, 'товар', 'товара', 'товаров').'</div>';
		$this->data['total_price'] .= '<div class="cart-amount"><span>'.ceil($total).'</span> грн.</div>';
				
        $this->data['text_cart'] = $this->language->get('text_cart');
        $this->data['text_checkout'] = $this->language->get('text_checkout');

        $this->data['button_remove'] = $this->language->get('button_remove');

        $this->load->model('tool/image');

        $this->data['products'] = array();

        foreach ($this->cart->getProducts() as $product) {
            $product_total = 0;

            foreach ($this->cart->getProducts() as $product_2) {
                if ($product_2['product_id'] == $product['product_id']) {
                    $product_total += $product_2['quantity'];
                }
            }

            if ($product['minimum'] > $product_total) {
                $this->data['error_warning'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
            }

            if ($product['image']) {
                $image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
            } else {
                $image = '';
            }

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'option_id' => $option['option_id'],
                    'name'  => $option['name'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type'  => $option['type']
                );
            }

            $this->load->model('catalog/product');
            $option_required_data = array();
            foreach ($this->model_catalog_product->getProductOptions($product['product_id']) as $option) {
                if ($option['required']) {
                    $find = false;
                    foreach ($option_data as $select_option) {
                        if ($select_option['option_id'] == $option['option_id']) {
                            $find = true;
                            break;
                        }
                    }

                    if (!$find) {
                        $option_value_data = array();
                        foreach ($option['option_value'] as $option_value) {
                            if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                                    $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                                } else {
                                    $price = false;
                                }

                                $option_value_data[] = array(
                                    'product_option_value_id' => $option_value['product_option_value_id'],
                                    'option_value_id'         => $option_value['option_value_id'],
                                    'name'                    => $option_value['name'],
                                    'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                    'price'                   => $price,
                                    'price_prefix'            => $option_value['price_prefix']
                                );
                            }
                        }

                        $option_required_data[] = array(
                            'product_option_id' => $option['product_option_id'],
                            'option_id'         => $option['option_id'],
                            'name'              => $option['name'],
                            'type'              => $option['type'],
                            'option_value'      => $option_value_data,
                        );
                    }
                }
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
            } else {
                $total = false;
            }

            $attribute_groups = $this->model_catalog_product->getProductAttributes($product['product_id']);

			$this->load->model('catalog/product'); 
			$this->load->model('catalog/category');
            $get_categories = $this->model_catalog_product->getCategories($product['product_id']);
                foreach ($get_categories as $cat) {
                    $cat_id = $cat['category_id']; break;
                }
                $full_url = $cat_id;
                while($cat_id) {
                    $parent = $this->model_catalog_category->getCategory($cat_id);
                    $cat_id = $parent['parent_id'];
                    if ( $cat_id != 0 ) $full_url = $cat_id . "_" . $full_url; else break;
                }
				
			preg_match("/(.*)-(\d+)_0/", $product['key'], $m);
			if (!empty($m[2])){
				$setId = $m[2];
				$query = $this->db->query("SELECT price_in_set FROM `" . DB_PREFIX . "product_to_set` WHERE product_id = '".$product['product_id']."' AND set_id = '" . (int)$setId . "'");
				if(isset($query->row['price_in_set'])){
					$total = $this->currency->format((float)$query->row['price_in_set']*$this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'))/100 * $product['quantity']);
				}
			}
	
            $this->data['products'][] = array(
                'key'      => $product['key'],
                'thumb'    => $image,
				'stock'    => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
                'name'     => $product['name'],
                'model'    => $product['model'],
                'option'   => $option_data,
                'option_required' => $option_required_data,
                'attribute_groups'  => $attribute_groups,
                'quantity' => $product['quantity'],
                'price'    => $price,
                'total'    => $total,
                'href'     => $this->url->link('product/product', 'path='. $full_url .'&product_id=' . $product['product_id'])
            );
        }

        // Gift Voucher
        $this->data['vouchers'] = array();

        if (!empty($this->session->data['vouchers'])) {
            foreach ($this->session->data['vouchers'] as $key => $voucher) {
                $this->data['vouchers'][] = array(
                    'key'         => $key,
                    'description' => $voucher['description'],
                    'amount'      => $this->currency->format($voucher['amount'])
                );
            }
        }

        $this->data['cart'] = $this->url->link('checkout/cart');

        $this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

		$this->children = array(
			'common/content_bottom',
		);		

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/cart.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/cart.tpl';
        } else {
            $this->template = 'default/template/module/cart.tpl';
        }

        $this->response->setOutput($this->render());
    }

    protected function validateCoupon() {
        $this->load->model('checkout/coupon');

        $coupon_info = $this->model_checkout_coupon->getCoupon($this->request->post['coupon']);

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
	
	protected function declension($n, $w1, $w2, $w5){
		if ($n > 10 && $n < 21 || $n % 10 > 4 || $n % 10 == 0) return $w5;
		if ($n % 10 == 1) return $w1;
		return $w2;
	}	
}
?>
