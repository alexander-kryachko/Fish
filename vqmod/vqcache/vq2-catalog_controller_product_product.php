<?php
class ControllerProductProduct extends Controller {
    private $error = array();

    public function index() {
if (!isset($this->request->get['path'])) {

		//$debug = $_SERVER['REMOTE_ADDR'] == '77.122.7.164' ? true : false;
		$debug = true;
		$debugStr = $_SERVER['REMOTE_ADDR']."\t".date('d.m.y H:i:s')."\t\t";
		$t1 = microtime(true);

        $this->language->load('product/product');
		/*****start x2_nop*****/
		$this->language->load('product/x2_nop');
        /******end x2_nop*****/

        $this->data['breadcrumbs'] = array();

 //       $this->data['breadcrumbs'][] = array(
 //           'text'      => $this->language->get('text_home'),
 //           'href'      => $this->url->link('common/home'),
 //           'separator' => false
 //       );

        //$this->load->model('catalog/category');

		/**/
		//if (!isset($this->request->get['path'])){
			$product_id = $this->request->get['product_id'];
			$this->load->model('catalog/category');
			$this->load->model('catalog/product');
			$this->language->load('module/set');
			$this->data['tab_sets'] = $this->language->get('tab_sets');
			if ($this->config->get('set_place_product_page')&&$this->config->get('set_place_product_page')=='before_tabs'){
				$this->data['set_place'] = 'before_tabs';
			} else {
				$this->data['set_place'] = 'in_tabs';
			}
			//$this->load->model('catalog/set');
			
			//$this->data['count_set'] = count($this->model_catalog_set->getSetsProduct($this->request->get['product_id']));
			//$this->data['is_set'] = $this->model_catalog_set->isSetExist($this->request->get['product_id']);
			
			$get_categories = $this->model_catalog_product->getCategories($product_id);
			foreach ($get_categories as $cat) {
				$cat_id = $cat['category_id']; break;
			}
			$full_url = $cat_id;
			while($cat_id) {
				$parent = $this->model_catalog_category->getCategory($cat_id);
				$cat_id = $parent['parent_id'];
				if ( $cat_id != 0 ) $full_url = $cat_id . "_" . $full_url; else break;
			}
			//$this->redirect($this->url->link('product/product', 'path='. $full_url .'&product_id=' . $product_id));
		//}
		/**/
		
        //if (isset($this->request->get['path'])) {
            $path = '';
            $parts = explode('_', $full_url); // (string)$this->request->get['path']);
            $category_id = (int)array_pop($parts);
            foreach ($parts as $path_id) {
                if (!$path) $path = $path_id;
                else $path .= '_' . $path_id;
                $category_info = $this->model_catalog_category->getCategory($path_id);
				if ($category_info['seo_h1']) {
					 $this->data['breadcrumbs'][] = array(
					  'text'	  => $category_info['seo_h1'],
					  'href'	  => $this->url->link('product/category', 'path=' . $path),
					  'separator' => $this->language->get('text_separator')
					 );
				} else {
					 $this->data['breadcrumbs'][] = array(
					  'text'	  => $category_info['seo_h1'],
					  'href'	  => $this->url->link('product/category', 'path=' . $path),
					  'separator' => $this->language->get('text_separator')
					 );
				}
			}

            // Set the last category breadcrumb
            $category_info = $this->model_catalog_category->getCategory($category_id);
            if ($category_info) {
                $url = '';
                if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
                if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
                if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];
                if (isset($this->request->get['limit'])) $url .= '&limit=' . $this->request->get['limit'];
				$full_url_ready = $this->url->link('product/category', 'path=' . $full_url);
				$category_info['full_url'] = $full_url_ready;
                $this->data['breadcrumbs'][] = array(
                    'text'      => $category_info['seo_h1'],
                    'href'      => $full_url_ready, // $this->request->get['path']
                    'separator' => $this->language->get('text_separator')
                );
            }
        //}

        $this->load->model('catalog/manufacturer');

        if (isset($this->request->get['manufacturer_id'])) {
            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_brand'),
                'href'      => $this->url->link('product/manufacturer'),
                'separator' => $this->language->get('text_separator')
            );

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

            if ($manufacturer_info) {
                $this->data['breadcrumbs'][] = array(
                    'text'      => $manufacturer_info['name'],
                    'href'      => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),
                    'separator' => $this->language->get('text_separator')
                );
            }
        }

        if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
            $url = '';

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['category_id'])) {
                $url .= '&category_id=' . $this->request->get['category_id'];
            }

            if (isset($this->request->get['sub_category'])) {
                $url .= '&sub_category=' . $this->request->get['sub_category'];
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

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_search'),
                'href'      => $this->url->link('product/search', $url),
                'separator' => $this->language->get('text_separator')
            );
        }

        if (isset($this->request->get['product_id'])) {
            $product_id = (int)$this->request->get['product_id'];
        } else {
            $product_id = 0;
        }
		
		$t2 = microtime(true);
		$debugStr .= number_format($t2-$t1, 2, '.', '')."\t"; // 1
		

        $this->load->model('catalog/product');
		  /*****start x2_nop*****/
		$this->load->model('catalog/x2_nop');
		$this->data['x2_nop'] = $this->model_catalog_x2_nop->getNumberOfPurchases($product_id);
        /******end x2_nop*****/
		$this->language->load('module/set');
		$this->data['tab_sets'] = $this->language->get('tab_sets');
		if ($this->config->get('set_place_product_page')&&$this->config->get('set_place_product_page')=='before_tabs'){
			$this->data['set_place'] = 'before_tabs';
		} else {
			$this->data['set_place'] = 'in_tabs';
		}
		$this->load->model('catalog/set');
		
		$this->data['count_set'] = count($this->model_catalog_set->getSetsProduct($this->request->get['product_id']));
		$this->data['is_set'] = $this->model_catalog_set->isSetExist($this->request->get['product_id']);
		

		//$product_info = $this->model_catalog_product->getProduct($product_id);
		$opts = array();
		$query = $this->db->query("SELECT `value` FROM " . DB_PREFIX . "setting WHERE `key` = 'promotion_options'");
		$promotion_options = unserialize($query->row['value']);
		if (!empty($promotion_options['product']['status'])) $opts[] = 'promotions';

		$product_info = $this->model_catalog_product->getProduct($product_id, $opts);

		$this->data['text_category'] = $this->language->get('text_category');
				$querycats = $this->model_catalog_product->getCategories($product_id);
				$categories = array();
				foreach( $querycats as $item ) {
					$categ = $this->model_catalog_category->getCategory($item['category_id']);
					$catinfo['id'] = $item['category_id'];
					$catinfo['href'] = $this->url->link('product/category', 'path=' . $item['category_id']);
					$catinfo['name'] = $categ['name'];
					$categories[] = $catinfo;
				}
		
		$t3 = microtime(true);
		$debugStr .= number_format($t3-$t2, 2, '.', '')."\t"; // 2

        if ($product_info) {
		$this->data['promotion'] = $product_info['promotions']['product']; //promotions
		 $watched = isset($this->request->cookie["youwatched"]) ? unserialize(html_entity_decode($this->request->cookie["youwatched"])) : array();
            $watched[$product_id] = time();
            setcookie("youwatched", serialize($watched), time() + 60 * 60 * 24 * 365, '/');
		$this->data['statuses'] =  $product_info['statuses']['product'];   //pr.status
$this->data['stickers'] =  $product_info['statuses']['product_stickers'];      //pr.status
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['category_id'])) {
                $url .= '&category_id=' . $this->request->get['category_id'];
            }

            if (isset($this->request->get['sub_category'])) {
                $url .= '&sub_category=' . $this->request->get['sub_category'];
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

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['breadcrumbs'][] = array(
                'text'      => $product_info['name'],
                'href'      => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id']),
                'separator' => $this->language->get('text_separator')
            );

            if ($product_info['seo_title']) {
                $this->document->setTitle($product_info['seo_title']);
            } else {
                $this->document->setTitle($product_info['name']);
            }

            $this->document->setDescription($product_info['meta_description']);
            $this->document->setKeywords($product_info['meta_keyword']);
            $this->document->addScript('catalog/view/javascript/jquery/tabs.js');
            $this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
            $this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');

            if ($product_info['seo_h1']) {
                $this->data['heading_title'] = $product_info['seo_h1'];
            } else {
                $this->data['heading_title'] = $product_info['name'];
            }

            $this->data['text_select'] = $this->language->get('text_select');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_mpn'] = $this->language->get('text_mpn');
			$this->data['text_sku'] = $this->language->get('text_sku');

			// Stock Notify Start			
			$this->language->load('hb_oosn');
			$this->data['notify_button'] = $this->language->get('button_notify_button');
			$this->data['oosn_info_text'] = $this->language->get('oosn_info_text');
			$this->data['oosn_text_email'] = $this->language->get('oosn_text_email');
			$this->data['oosn_text_email_plh'] = $this->language->get('oosn_text_email_plh');
			$this->data['oosn_text_name'] = $this->language->get('oosn_text_name');
			$this->data['oosn_text_name_plh'] = $this->language->get('oosn_text_name_plh');
			$this->data['oosn_text_phone'] = $this->language->get('oosn_text_phone');
			$this->data['oosn_text_phone_plh'] = $this->language->get('oosn_text_phone_plh');

			$this->data['quantity'] = $product_info['quantity'];

			$query = $this->db->query("SELECT stock_status_id FROM " . DB_PREFIX . "stock_status WHERE name = '".$product_info['stock_status']."'");
			$this->data['stock_status_id'] = $query->row['stock_status_id'];

			if ($this->customer->isLogged()){
				$this->data['email'] = $this->customer->getEmail();
				$this->data['fname'] = $this->customer->getFirstName();
				$this->data['phone'] = $this->customer->getTelephone();
			}else {
				$this->data['email'] = $this->data['fname'] =  $this->data['phone'] = '';
			}
			// Stock Notify End
			
            $this->data['text_reward'] = $this->language->get('text_reward');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_discount'] = $this->language->get('text_discount');
            $this->data['text_stock'] = $this->language->get('text_stock');
						/*****start x2_nop*****/
			$this->data['text_x2_nop'] = $this->language->get('text_x2_nop');
			/******end x2_nop*****/
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_discount'] = $this->language->get('text_discount');
            $this->data['text_option'] = $this->language->get('text_option');
            $this->data['text_qty'] = $this->language->get('text_qty');
            $this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
            $this->data['text_or'] = $this->language->get('text_or');
            $this->data['text_write'] = $this->language->get('text_write');
            $this->data['text_note'] = $this->language->get('text_note');
            $this->data['text_share'] = $this->language->get('text_share');
            $this->data['text_wait'] = $this->language->get('text_wait');
            $this->data['text_tags'] = $this->language->get('text_tags');

            $this->data['entry_name'] = $this->language->get('entry_name');
            $this->data['entry_review'] = $this->language->get('entry_review');
            $this->data['entry_rating'] = $this->language->get('entry_rating');
            $this->data['entry_good'] = $this->language->get('entry_good');
            $this->data['entry_bad'] = $this->language->get('entry_bad');
            $this->data['entry_captcha'] = $this->language->get('entry_captcha');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_upload'] = $this->language->get('button_upload');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->load->model('catalog/review');

            $this->data['tab_description'] = $this->language->get('tab_description');
            $this->data['tab_attribute'] = $this->language->get('tab_attribute');
            $this->data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);
            $this->data['tab_related'] = $this->language->get('tab_related');

            $this->data['product_id'] = $this->request->get['product_id'];
			$this->data['categories'] = $categories;
            $this->data['manufacturer'] = $product_info['manufacturer'];
            $this->data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
            $this->data['model'] = $product_info['model'];
			$this->data['sku'] =  ltrim($product_info['sku'],'0');

			$this->data['upc'] = $product_info['upc'];
            $this->data['reward'] = $product_info['reward'];
            $this->data['points'] = $product_info['points'];
                        $this->data['date_available'] = $product_info['date_available'];
			$this->data['viewed'] = $product_info['viewed'];
			$this->data['quantity'] = $product_info['quantity'];
			//youtube
			  $this->data['youtubes'] = array();
            $query = $this->db->query("SELECT mpn as video FROM ".DB_PREFIX."product WHERE product_id='".(int)$product_id."'");
            $youtubes = explode(',',$query->row['video']);
            $this->data['youtubes'] = $youtubes;
			//youtube end
			$this->data['no_stock'] = $this->language->get('text_nostock');

            // Timer
            $this->data['text_weeks'] = $this->language->get('text_weeks');
            $this->data['text_days'] = $this->language->get('text_days');
            $this->data['text_hours'] = $this->language->get('text_hours');
            $this->data['text_min'] = $this->language->get('text_min');
            $this->data['text_sec'] = $this->language->get('text_sec');

            $this->data['countdown'] = false;
            if (isset($product_info['special_date_end']) && $product_info['special_date_end'] != '0000-00-00') {
                $date = explode('-', $product_info['special_date_end']);
                $this->data['year'] = intval($date[0]);
                $this->data['month'] = intval($date[1]);
                $this->data['day'] = intval($date[2]);

                $time = explode(':', '23-59-59');
                $this->data['hour'] = intval($time[0]);
                $this->data['min'] = intval($time[1]);
                $this->data['sec'] = intval($time[2]);

                $this->data['show_weeks'] = 0;

                $this->data['countdown'] = true;
            }
            // Timer
$this->data['rees46_is_available'] = $product_info['quantity'];
            if ($product_info['quantity'] <= 0) {
                $this->data['stock'] = $product_info['stock_status'];
            } elseif ($this->config->get('config_stock_display')) {
                $this->data['stock'] = $product_info['quantity'];
            } elseif($product_info['quantity'] > 6661400 && $product_info['quantity'] < 6661489 ) {
                $this->data['stock'] = 'Под заказ (3-5 дней)';
            } else {
                $this->data['stock'] = $this->language->get('text_instock');
            }

            $this->data['quantity'] = $product_info['quantity'];

            $this->load->model('tool/image');
        $this->data['config_popularproduct'] = $this->config->get('config_popularproduct');
		$this->data['config_newproduct'] = $this->config->get('config_newproduct');
		$this->data['config_display_newproduct'] = $this->config->get('config_display_newproduct');
		$this->data['config_display_popularproduct'] = $this->config->get('config_display_popularproduct');
		$this->data['config_display_specialsproduct'] = $this->config->get('config_display_specialsproduct');
		$this->data['config_display_availableproduct'] = $this->config->get('config_display_availableproduct');

            if ($product_info['image']) {
                $this->data['popup'] = $product_info['image'];
            } else {
                $this->data['popup'] = 'no_image.jpg';
            }

            if ($product_info['image']) {
                $this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
                $this->document->setOgImage($this->data['thumb']);
            } else {
                $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
            }

            $this->data['images'] = array();

            $results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

            foreach ($results as $result) {
                $this->data['images'][] = array(
                    'popup' => $result['image'],
                    'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
                );
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $this->data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $this->data['price'] = false;
            }
            $this->data['special_percent'] = '';
            if ((float)$product_info['special'] && (float)$product_info['special'] < (float)$product_info['price']){
                $this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                $special_percent_out = round(100 - ($product_info['special']*100/$product_info['price']));
                if($special_percent_out != 100){
                    $this->data['special_percent'] = $special_percent_out;
                }

                $this->data['discount'] = $this->currency->format($this->tax->calculate($product_info['price'] - $product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                $this->document->addScript('/catalog/view/theme/fisherway/scripts/jquery.countdown.min.js');
                //$this->document->addScript('/catalog/view/theme/fisherway/scripts/jquery.Countdown.js');
            } else {
                $this->data['special'] = false;
            }

            if ($this->config->get('config_tax')) {
                $this->data['tax'] = $this->currency->format((float)$product_info['special'] && (float)$product_info['special'] < (float)$product_info['price'] ? $product_info['special'] : $product_info['price']);
            } else {
                $this->data['tax'] = false;
            }

            $discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

            $this->data['discounts'] = array();

            foreach ($discounts as $discount) {
                $this->data['discounts'][] = array(
                    'quantity' => $discount['quantity'],
                    'price'    => $this->currency->format($this->tax->calculate(round($discount['quantity'] * ((float)$product_info['special'] > 0 && (float)$product_info['special'] < (float)$product_info['price'] ? (float)$product_info['special'] : $product_info['price'])*$discount['price']/100), $product_info['tax_class_id'], $this->config->get('config_tax')))
                );
            }

            $this->data['options'] = array();

            foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
                if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                    $option_value_data = array();

                    foreach ($option['option_value'] as $option_value) {
						//if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if (!$option_value['subtract'] || $option_value['subtract'] || ($option_value['quantity'] > 0)) {  // Stock Notify Repalce
 
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

					
                    $this->data['options'][] = array(
                        'product_option_id' => $option['product_option_id'],
                        'option_id'         => $option['option_id'],
                        'name'              => $option['name'],
                        'type'              => $option['type'],
                        'option_value'      => $option_value_data,
                        'required'          => $option['required']
                    );
                } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                    $this->data['options'][] = array(
                        'product_option_id' => $option['product_option_id'],
                        'option_id'         => $option['option_id'],
                        'name'              => $option['name'],
                        'type'              => $option['type'],
                        'option_value'      => $option['option_value'],
                        'required'          => $option['required']
                    );
                }
            }

			// is_master?
            $this->load->model('catalog/product_master');
            $is_master = $this->model_catalog_product_master->isMaster($product_id, '2'); //2 is Image
			if (!$is_master) $master_id = $this->model_catalog_product_master->getMasterProductId($product_id, '2');
			
			$this->data['minimum'] = $product_info['minimum'] ? $product_info['minimum'] : 1;
            $this->data['review_status'] = $this->config->get('config_review_status');
			$this->data['mpn'] = html_entity_decode($product_info['mpn'], ENT_QUOTES, 'UTF-8');
            $this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
            $this->data['rating'] = (int)$product_info['rating'];
            $this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
            $this->data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
            $this->data['related_product'] = array();
            $this->data['complect_id'] = '';
            $this->data['complect_price'] = 0;
			if (empty($this->data['description']) && isset($master_id) && $master_id > 0){
				$pMaster = $this->model_catalog_product->getProduct($master_id); 				
				$this->data['description'] = html_entity_decode($pMaster['description'], ENT_QUOTES, 'UTF-8');
			}

            $results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

            if ($results) {
                $rand_keys = array_rand($results);
                $result = $results[$rand_keys];

                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
                } else {
                    $image = false;
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']){
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$result['rating'];
                } else {
                    $rating = false;
                }

                $this->data['related_product'] = array(
                    'product_id' => $result['product_id'],
                    'thumb'      => $image,
                    'name'       => $result['name'],
                    'price'      => $price,
                    'special'    => $special,
					'upc'         => $result['upc'],
                    'rating'     => $rating,
                    'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'href'       => $this->url->link('product/product', 'path='. $full_url .'&product_id=' . $result['product_id'])
                );

                $this->data['complect_id'] = $this->request->get['product_id'] . ',' . $result['product_id'];

                if ((float)$product_info['special'] && (float)$product_info['special'] < (float)$product_info['price']){
                    $this->data['complect_price'] += $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
                } else {
                    $this->data['complect_price'] += $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
                }

                if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']){
                    $this->data['complect_price'] += $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
                } else {
                    $this->data['complect_price'] += $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
                }

                $this->data['complect_price'] = $this->currency->format($this->data['complect_price']);
            }

            $this->data['tags'] = array();

            if ($product_info['tag']) {
                $tags = explode(',', $product_info['tag']);

                foreach ($tags as $tag) {
                    $this->data['tags'][] = array(
                        'tag'  => trim($tag),
                        'href' => $this->url->link('product/search', 'tag=' . trim($tag))
                    );
                }
            }

            $pds_allow_buying_series = false;
            if ($this->config->get('pds_allow_buying_series')) {
                $pds_allow_buying_series = $this->config->get('pds_allow_buying_series');
            }

            if($is_master && !$pds_allow_buying_series) {
                $this->data['is_master'] = true;
            } else {
                $this->data['is_master'] = false;
				$this->data['master_info'] = $this->model_catalog_product->getProduct($master_id);
				$this->data['master_link'] = $this->url->link('product/product', '&product_id=' . $master_id);
            }

			//BOF Product Series
            //get link of linked products + colors
            $results = $this->model_catalog_product->getLinkedProducts($this->request->get['product_id'], '2'); //'2' is Image

            $this->data['pds'] = array();

            $this->document->addScript('/catalog/view/theme/fisherway/scripts/slider/jquery.jcarousel.min.js');

            $pds_detail_thumbnail_width = 400;
            $pds_detail_thumbnail_height = 400;
            $pds_preview_width = 400;
            $pds_preview_height = 400;
            $this->data['pds_enable_preview'] = 1;

            foreach ($results as $result)
            {

                $product_info = $this->model_catalog_product->getProduct($result['product_id']);
				//$product_quantity = $this->model_catalog_product->getProduct($result['quantity']);
				//$product_quantity =  $result['quantity'];

                $product_pds_image = $result['special_attribute_value'] != ''
                    ? $this->model_tool_image->resize($result['special_attribute_value'], $pds_detail_thumbnail_width, $pds_detail_thumbnail_height)
                    : $this->model_tool_image->resize($result['image'], $pds_detail_thumbnail_width, $pds_detail_thumbnail_height);

                $product_main_image = ($result['image'] != '' && $result['image'] != 'no_image.jpg')
                    ? $this->model_tool_image->resize($result['image'], $pds_preview_width, $pds_preview_height) //user default main image
                    : $this->model_tool_image->resize($result['special_attribute_value'], $pds_preview_width, $pds_preview_height); // use series image

				//
				$pds_discounts = $this->model_catalog_product->getProductDiscounts($result['product_id']);
				$pds_discounts_data = array();
				foreach ($pds_discounts as $pds_discount){
					$pds_discounts_data[] = array(
						'quantity' => $pds_discount['quantity'],
						'price'    => $this->currency->format($this->tax->calculate(round($pds_discount['quantity'] * ((float)$product_info['special'] > 0 && (float)$product_info['special'] < (float)$product_info['price'] ? (float)$product_info['special'] : $product_info['price'])*$pds_discount['price']/100), $product_info['tax_class_id'], $this->config->get('config_tax')))
					);
				}

                $this->data['pds'][] = array(
                    'product_id' => $result['product_id'],
					'quantity' => $product_info['quantity'],
                    'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
                    'product_name' => $result['name'],
                    'all' => $result,
                    'product_pds_image' => $product_pds_image,
                    'product_main_image' => $product_main_image,
				//	'review' =>  $product_review,
                    'manufacturer' => $product_info['manufacturer'],
                    'attribute_groups' => $this->model_catalog_product->getProductAttributes($result['product_id']),
					'discounts' => $pds_discounts_data,

            'promotion' => empty($result['promotion'])?'':$result['promotion'],
            

					'price' => $product_info['price'],
					'special' => $product_info['special'],
					'sku' => $product_info['sku']
                );
            }
			
			
			if ($is_master || empty($this->data['pds'])){
				if($this->model_catalog_product->getCategoryPath($this->request->get['product_id'])!='0'){
					$href = $this->url->link('product/product', 'path=' . $this->model_catalog_product->getCategoryPath($this->request->get['product_id']) . '&product_id=' . $this->request->get['product_id']);
					$this->document->addLink($href, 'canonical');
				}else{
					$href = $this->url->link('product/product', 'product_id=' . $this->request->get['product_id']);
					$this->document->addLink($href, 'canonical');
				}
			} else {
				/* BOF: Series canonical test */
				$this->document->addLink($this->data['master_link'], 'canonical');   // включение/отключение каноникалов на слейвах
				/* EOF: Series canonical test */
			}
			
			$this->data['filter_breadcrumbs'] = $this->model_catalog_product->getFilterBreadcrumbs($product_id, $category_info);
            $this->load->model('catalog/product_master');
            $this->load->language('product/pds');

            if(!isset($this->data['display_add_to_cart']))
            {
                $is_master = $this->model_catalog_product_master->isMaster($this->request->get['product_id'], '2'); //2 is Image
                $pds_allow_buying_series = 0;
                $this->data['display_add_to_cart'] = !$is_master || $pds_allow_buying_series;
                $this->data['no_add_to_cart_message'] = $this->language->get('text_select_series_item');
            }

            $this->data['text_in_the_same_series'] = $this->language->get('text_in_the_same_series');
            //EOF Product Series
            $this->model_catalog_product->updateViewed($this->request->get['product_id']);  //счетчик просмотров товаров

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/product.tpl';
            } else {
                $this->template = 'default/template/product/product.tpl';
            }

			$_SESSION['cityadsTPM'] = "var xcnt_product_id = '".$this->request->get['product_id']."';".PHP_EOL;
            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );

			$t4 = microtime(true);
			$debugStr .= number_format($t4-$t3, 2, '.', '')."\t"; // 3
			$debugStr .= $_SERVER['REQUEST_URI'].PHP_EOL;
			if ($debug) file_put_contents('slowlog-products.txt', $debugStr, FILE_APPEND);

            $this->response->setOutput($this->render());
        } else {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['category_id'])) {
                $url .= '&category_id=' . $this->request->get['category_id'];
            }

            if (isset($this->request->get['sub_category'])) {
                $url .= '&sub_category=' . $this->request->get['sub_category'];
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

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_error'),
                'href'      => $this->url->link('product/product', $url . '&product_id=' . $product_id),
                'separator' => $this->language->get('text_separator')
            );

            $this->document->setTitle($this->language->get('text_error'));

            $this->data['heading_title'] = $this->language->get('text_error');

            $this->data['text_error'] = $this->language->get('text_error');

            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
            } else {
                $this->template = 'default/template/error/not_found.tpl';
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
		} else {
			$product_id = $this->request->get['product_id'];
			/*
			$this->load->model('catalog/category');
			$this->load->model('catalog/product');
			$this->language->load('module/set');
			$this->data['tab_sets'] = $this->language->get('tab_sets');
			if ($this->config->get('set_place_product_page')&&$this->config->get('set_place_product_page')=='before_tabs'){
				$this->data['set_place'] = 'before_tabs';
			} else {
				$this->data['set_place'] = 'in_tabs';
			}
			$this->load->model('catalog/set');
			
			$this->data['count_set'] = count($this->model_catalog_set->getSetsProduct($this->request->get['product_id']));
			$this->data['is_set'] = $this->model_catalog_set->isSetExist($this->request->get['product_id']);
			
			$get_categories = $this->model_catalog_product->getCategories($product_id);
			foreach ($get_categories as $cat) {
				$cat_id = $cat['category_id']; break;
			}
			$full_url = $cat_id;
			while($cat_id) {
				$parent = $this->model_catalog_category->getCategory($cat_id);
				$cat_id = $parent['parent_id'];
				if ( $cat_id != 0 ) $full_url = $cat_id . "_" . $full_url; else break;
			}
			*/
			header('HTTP/1.1 301 Moved Permanently');
			$this->redirect($this->url->link('product/product', 'path='. $full_url .'&product_id=' . $product_id));
		}
	}

	public function getPromotion(){
		$promotion_id = isset($_GET['promotion_id']) ? (int)$_GET['promotion_id'] : false;
		if (!$promotion_id) exit();

		$this->load->model('catalog/product');
		echo $this->model_catalog_product->getHTMLPopupPromotions($promotion_id);
		exit();
	}

    public function review() {
        $this->language->load('product/product');

        $this->load->model('catalog/review');

        $this->data['text_on'] = $this->language->get('text_on');
        $this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['reviews'] = array();

        $review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

        $results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

        foreach ($results as $result) {
            $this->data['reviews'][] = array(
                'author'     => $result['author'],
                'text'       => $result['text'],
                'rating'     => (int)$result['rating'],
                'rating_service' => (int)$result['rating_service'],
               'reviews'    => sprintf($this->language->get('text_reviews'), (int)$review_total),
//				'reviews'    => (int)$review_total),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = 5;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

        $this->data['pagination'] = $pagination->render();

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/review.tpl';
        } else {
            $this->template = 'default/template/product/review.tpl';
        }

        $this->response->setOutput($this->render());
    }

    public function write() {
        $this->language->load('product/product');

        $this->load->model('catalog/review');

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
                $json['error'] = $this->language->get('error_name');
            }

            if ((utf8_strlen($this->request->post['text']) < 2) || (utf8_strlen($this->request->post['text']) > 10000)) {
                $json['error'] = $this->language->get('error_text');
            }

            if (empty($this->request->post['rating'])) {
                $json['error'] = $this->language->get('error_rating');
            }

            if (empty($this->request->post['rating_service'])) {
                $json['error'] = $this->language->get('error_rating_service');
            }

            /*if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
                $json['error'] = $this->language->get('error_captcha');
            }*/

            if (!isset($json['error'])) {
                $this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function captcha() {
        $this->load->library('captcha');

        $captcha = new Captcha();

        $this->session->data['captcha'] = $captcha->getCode();

        $captcha->showImage();
    }

    public function upload() {
        $this->language->load('product/product');

        $json = array();

        if (!empty($this->request->files['file']['name'])) {
            $filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
                $json['error'] = $this->language->get('error_filename');
            }

            // Allowed file extension types
            $allowed = array();

            $filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));

            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }

            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                $json['error'] = $this->language->get('error_filetype');
            }

            // Allowed file mime types
            $allowed = array();

            $filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));

            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }

            if (!in_array($this->request->files['file']['type'], $allowed)) {
                $json['error'] = $this->language->get('error_filetype');
            }

            if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
            }
        } else {
            $json['error'] = $this->language->get('error_upload');
        }

        if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
            $file = basename($filename) . '.' . md5(mt_rand());

            // Hide the uploaded file name so people can not link to it directly.
            $json['file'] = $this->encryption->encrypt($file);

            move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);

            $json['success'] = $this->language->get('text_upload');
        }

        $this->response->setOutput(json_encode($json));
    }
}
?>
