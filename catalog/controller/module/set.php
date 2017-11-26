<?php

class ControllerModuleSet extends Controller {

	protected function index($setting) {
		static $module = 0;
	
		$this->language->load('module/set');
			
		$this->load->model('catalog/set');
        $this->load->model('tool/image'); 

		$this->data['set_count'] = $this->model_catalog_set->getTotalSet();

      	$this->data['heading_title'] = $this->language->get('heading_title');	
		$this->data['text_more'] = $this->language->get('text_more');

        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_upload'] = $this->language->get('button_upload');
        
        $this->data['text_baseprice'] = $this->language->get('text_baseprice');
        $this->data['text_setprice'] = $this->language->get('text_setprice');
        $this->data['text_setquantity'] = $this->language->get('text_setquantity');
        
        $this->data['text_total'] = $this->language->get('text_total');
        $this->data['text_save'] = $this->language->get('text_save');
        $this->data['text_present'] = $this->language->get('text_present');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_notactive'] = $this->language->get('text_notactive');
        
        
		$this->data['sets'] = array();
        
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        if (isset($this->request->get['path'])) {
            $path = '';
            $parts = explode('_', (string)$this->request->get['path']);
            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = $path_id;
                } else {
                    $path .= '_' . $path_id;
                }
            }
            $category_id = array_pop($parts);
        } elseif(isset($this->request->get['product_id'])) {
			$categories = array(); 
            $categories = $this->model_catalog_product->getCategories($this->request->get['product_id']);
            if($categories){
                foreach($categories as $category){
                    $categories[] = $category['category_id']; 
                }
            }
            $category_id = array_pop($categories);
        } else {            
            $category_id = null;
        }
        
               
        
        
		$results = $this->model_catalog_set->getSets($data = array('start'=>0, 'limit' => $setting['quantityshow']));
	
		foreach ($results as $result) {
		  
            if($category_id&&isset($setting['check_category'])&&$setting['check_category']){
                $categories_set = $this->model_catalog_set->getSetCategories($result['set_id']);
                if($categories_set){
                    if(!in_array($category_id, $categories_set)){continue;}    
                }
            }
		    
            $active_set = true;
              
            $temp_save = 0;
            $old_total = 0;
            
            if ($result['image']) {
                $set_image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
            } else {
				$set_image = false;
            }             
		  
			$price = 0;
            
            $products_in_set = array();
            $products_result = $this->model_catalog_set->getProductsInSets($result['set_id']);
            foreach($products_result as $product){
                
                $active_product = true;

				if ($product['image']) {
					$image = $this->model_tool_image->resize($product['image'], $setting['image_width'], $setting['image_height']);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
				}

				if ((float)$product['base_special'] && (float)$product['base_special'] < (float)$product['base_price']) {
                    $real_price = (float)$product['base_special'];
				} else {
					$real_price = (float)$product['base_price'];
				}
                    
                $product_options = array();
                
                	
     			foreach ($this->model_catalog_product->getProductOptions($product['product_id']) as $option) { 
        				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
        					$option_value_data = array();
        					
        					foreach ($option['option_value'] as $option_value) {
        					    
                                $selected = false;
                                
        						//if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
        							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
        								$option_price = $this->currency->format($this->tax->calculate($option_value['price'], $result['tax_class_id'], $this->config->get('config_tax')));
        							} else {
        								$option_price = false;
        							}
                                    if(isset($product['options'][$option['product_option_id']])&&$product['options'][$option['product_option_id']] == $option_value['product_option_value_id']){
                                        $selected = true;
                                        $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                        if ((int)$option_value['quantity']==0) {
                                            $active_product = false;
                                        }
                                    } 
                                    if($option['type'] == 'checkbox' && isset($product['options'][$option['product_option_id']]) && in_array($option_value['product_option_value_id'], $product['options'][$option['product_option_id']])){
                                        $selected = true;
                                        $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                        if ((int)$option_value['quantity']==0) {
                                            $active_product = false;
                                        }                                           
                                    }
        							$option_value_data[] = array(
        								'product_option_value_id' => $option_value['product_option_value_id'],
        								'option_value_id'         => $option_value['option_value_id'],
                                        'selected'                => $selected,
                                        'active'                  => (int)$option_value['quantity'],
        								'name'                    => $option_value['name'],
        								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
        								'price'                   => $option_price,
        								'price_prefix'            => $option_value['price_prefix']
        							);
        						//} 
        					}
        					
        					$product_options[] = array(
        						'product_option_id' => $option['product_option_id'],
        						'option_id'         => $option['option_id'],
                                'selected'          => isset($product['options'][$option['product_option_id']]),
        						'name'              => $option['name'],
        						'type'              => $option['type'],
        						'option_value'      => $option_value_data,
        						'required'          => $option['required']
        					);					
        				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
        					$product_options[] = array(
        						'product_option_id' => $option['product_option_id'],
        						'option_id'         => $option['option_id'],
                                'selected'          => isset($product['options'][$option['product_option_id']]),
        						'name'              => $option['name'],
        						'type'              => $option['type'],
        						'option_value'      => isset($product['options'][$option['product_option_id']]) ? $product['options'][$option['product_option_id']] : $option['option_value'],
        						'required'          => $option['required']
        					);						
        				}
                }                    

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
    				$price_product = $this->currency->format($this->tax->calculate($real_price, $product['tax_class_id'], $this->config->get('config_tax')));
    		    } else {
    				$price_product = false;
                }
				
                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
    				$price_in_set = $this->currency->format($this->tax->calculate($product['price_in_set'], $product['tax_class_id'], $this->config->get('config_tax')));
					$price += $product['price_in_set'] * $product['quantity'];
    		    } else {
    				$price_in_set = false;
                } 
                 
                $sale_value = round((((float)$real_price - (float)$product['price_in_set'])/(float)$real_price)*100);


                    
                if(!$product['base_status']||!$product['base_quantity']) {
                    $active_product = false;
                }
                
                if(!$active_product){
                    $active_set = false;
                }
                               
                
                $products_in_set[] = array(
                    'product_id'   => $product['product_wop_id'],
                    'name'         => $product['name'],
                    'present'      => $product['present'],
                    'option_set'   => $product['options'],
                    'options'      => $product_options,
                    'thumb'        => $image,
                    'active'       => $active_product,
                    'price'        => $price_product,
                    'price_in_set' => $price_in_set,
                    'sale_value'   => $sale_value,
                    'text_salevalue'=> sprintf($this->language->get('text_salevalue'), $sale_value) . '%',
                    'quantity'     => (int)$product['quantity'],
                    'text_quantity'=> sprintf($this->language->get('text_quantity'), $product['quantity']),
                    'href'         => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                );
                $old_total += (float)$real_price*(int)$product['quantity'];     
                
            }
			
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($price, $result['tax_class_id'], $this->config->get('config_tax')));
		    } else {
				$price = false;
            }

            
            //$temp_save = (float)$old_total-(float)$result['price'];
            //$save = $this->currency->format($this->tax->calculate($temp_save, $result['tax_class_id'], $this->config->get('config_tax')));           
            
            if((int)$result['product_id']){
                $url = $this->url->link('product/product', 'product_id=' . $result['product_id']);
            } else {
                $url = '';
            }
            
                      
			$this->data['sets'][] = array(
                'set_id'        => $result['set_id'],
                'image'         => $set_image,
				'name'        	=> $result['name'],
				'description'  	=> html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                'products'      => $products_in_set,
                'price'         => $price,
                'save'          => 0,//$save,
                'active'        => $active_set,
                'href'          => $url
			);
		}
	
		$this->data['module'] = $module++; 
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/set.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/set.tpl';
		} else {
			$this->template = 'default/template/module/set.tpl';
		}
	
		$this->render();
	}
    
    public function setsload(){
        $this->language->load('module/set');
        $this->load->model('catalog/set');
        $this->load->model('tool/image');
        $this->load->model('catalog/product');

        
        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_upload'] = $this->language->get('button_upload');
                
        $this->data['text_baseprice'] = $this->language->get('text_baseprice');
        $this->data['text_setprice'] = $this->language->get('text_setprice');
        $this->data['text_setquantity'] = $this->language->get('text_setquantity');
                
        $this->data['text_total'] = $this->language->get('text_total');
        $this->data['text_save'] = $this->language->get('text_save');
        $this->data['text_present'] = $this->language->get('text_present');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_notactive'] = $this->language->get('text_notactive');
        $this->data['tab_sets'] = $this->language->get('tab_sets');
        
        $image_width = (int)$this->config->get('set_product_page_image_width') ? $this->config->get('set_product_page_image_width') : $this->config->get('config_image_product_width'); 
        $image_height = (int)$this->config->get('set_product_page_image_height') ? $this->config->get('set_product_page_image_height') : $this->config->get('config_image_product_height');
        
  		$this->data['sets'] = array();
  		$results = $this->model_catalog_set->getSetsProduct($this->request->get['product_id']);
  		foreach ($results as $result) {
                    $active_set = true;
                      
                    $temp_save = 0;
                    $old_total = 0;
                    
                    if ($result['image']) {
                        $set_image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
                    } else {
        				$set_image = false;
                    }             
        		  
					$price = 0;
                    
                    $products_in_set = array();
                    $products_result = $this->model_catalog_set->getProductsInSets($result['set_id']);
					$skip_set = false;
                    foreach($products_result as $product){
						if ($_SERVER['REMOTE_ADDR'] == '77.122.7.164'){
							print_r($product);
							if ((!empty($product['special_date_start']) && $product['special_date_start'] != '0000-00-00') || (!empty($product['special_date_end']) && $product['special_date_end'] != '0000-00-00')){
								$skip_set = true;
								break;
							}
						}

                        $active_product = true;
        				if ($product['image']) {
        					$image = $this->model_tool_image->resize($product['image'], $image_width, $image_height);
        				} else {
        					$image = $this->model_tool_image->resize('no_image.jpg', $image_width, $image_height);
        				}
        
        				if ((float)$product['base_special'] && (float)$product['base_special'] < (float)$product['base_price']) {
                            $real_price = (float)$product['base_special'];
        				} else {
        					$real_price = (float)$product['base_price'];
        				}
                            
                        $product_options = array();
                			
             			foreach ($this->model_catalog_product->getProductOptions($product['product_id']) as $option) { 
                			    
                				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
                					$option_value_data = array();
                					
                					foreach ($option['option_value'] as $option_value) {
                					    
                                        $selected = false;
                                        
                						//if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                								$option_price = $this->currency->format($this->tax->calculate($option_value['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                							} else {
                								$option_price = false;
                							}
                                            if(isset($product['options'][$option['product_option_id']])&&$product['options'][$option['product_option_id']] == $option_value['product_option_value_id']){
                                                $selected = true;
                                                $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                                if ((int)$option_value['quantity']==0) {
                                                    $active_product = false;
                                                }
                                            } 
                                            if($option['type'] == 'checkbox' && isset($product['options'][$option['product_option_id']]) && in_array($option_value['product_option_value_id'], $product['options'][$option['product_option_id']])){
                                                $selected = true;
                                                $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                                if ((int)$option_value['quantity']==0) {
                                                    $active_product = false;
                                                }                                           
                                            }
                							$option_value_data[] = array(
                								'product_option_value_id' => $option_value['product_option_value_id'],
                								'option_value_id'         => $option_value['option_value_id'],
                                                'selected'                => $selected,
                                                'active'                  => (int)$option_value['quantity'],
                								'name'                    => $option_value['name'],
                								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
                								'price'                   => $option_price,
                								'price_prefix'            => $option_value['price_prefix']
                							);
                						//} 
                					}
                					
                					$product_options[] = array(
                						'product_option_id' => $option['product_option_id'],
                						'option_id'         => $option['option_id'],
                                        'selected'          => isset($product['options'][$option['product_option_id']]),
                						'name'              => $option['name'],
                						'type'              => $option['type'],
                						'option_value'      => $option_value_data,
                						'required'          => $option['required']
                					);					
                				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                					$product_options[] = array(
                						'product_option_id' => $option['product_option_id'],
                						'option_id'         => $option['option_id'],
                                        'selected'          => isset($product['options'][$option['product_option_id']]),
                						'name'              => $option['name'],
                						'type'              => $option['type'],
                						'option_value'      => isset($product['options'][$option['product_option_id']]) ? $product['options'][$option['product_option_id']] : $option['option_value'],
                						'required'          => $option['required']
                					);						
                				}
                        }                    
                                                        
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            				$price_product = $this->currency->format($this->tax->calculate($real_price, $product['tax_class_id'], $this->config->get('config_tax')));
            		    } else {
            				$price_product = false;
                        }                
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            				$price_in_set = $this->currency->format($this->tax->calculate($product['price_in_set'], $product['tax_class_id'], $this->config->get('config_tax')));
							$price += $product['price_in_set'] * $product['quantity'];
            		    } else {
            				$price_in_set = false;
                        } 
                         
                        $sale_value = round((((float)$real_price - (float)$product['price_in_set'])/(float)$real_price)*100);
                                                    
                        if(!$product['base_status']||!$product['base_quantity']) {
                            $active_product = false;
                        }
                        
                        if(!$active_product){
                            $active_set = false;
                        }
                                       
                        
                        $products_in_set[] = array(
                            'product_id'   => $product['product_wop_id'],
                            'name'         => $product['name'],
                            'present'      => $product['present'],
                            'option_set'   => $product['options'],
                            'options'      => $product_options,
                            'thumb'        => $image,
                            'active'       => $active_product,
                            'price'        => $price_product,
                            'price_in_set' => $price_in_set,
                            'sale_value'   => $sale_value,
                            'text_salevalue'=> sprintf($this->language->get('text_salevalue'), $sale_value) . '%',
                            'quantity'     => (int)$product['quantity'],
                            'text_quantity'=> sprintf($this->language->get('text_quantity'), $product['quantity']),
                            'href'         => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                        );
                        $old_total += (float)$real_price*(int)$product['quantity'];     
                    }
					if ($skip_set) continue;
					
                    if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
        				$price = $this->currency->format($this->tax->calculate($price, $result['tax_class_id'], $this->config->get('config_tax')));
        		    } else {
        				//$price = false;
                    }
					
                    $temp_save = (float)$old_total-(float)$result['price'];
                    $save = $this->currency->format($this->tax->calculate($temp_save, $product['tax_class_id'], $this->config->get('config_tax')));           
                    
                    if((int)$result['product_id']){
                        $url = $this->url->link('product/product', 'product_id=' . $result['product_id']);
                    } else {
                        $url = '';
                    }
                              
        			$this->data['sets'][] = array(
                        'set_id'        => $result['set_id'],
                        'image'         => $set_image,
        				'name'        	=> $result['name'],
        				'description'  	=> html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                        'products'      => $products_in_set,
                        'price'         => $price,
                        'save'          => $save,
                        'active'        => $active_set,
                        'href'          => $url
        			);
  		}
        
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/setsform.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/setsform.tpl';
		} else {
				$this->template = 'default/template/module/setsform.tpl';
		}
		$this->response->setOutput($this->render());
    }

    public function productload(){
        
        $this->language->load('module/set');
        $this->load->model('catalog/set');
        $this->load->model('tool/image');
        $this->load->model('catalog/product'); 
        
        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_upload'] = $this->language->get('button_upload');
        
        $this->data['heading_products'] = $this->language->get('heading_products');        
        $this->data['text_baseprice'] = $this->language->get('text_baseprice');
        $this->data['text_setprice'] = $this->language->get('text_setprice');
        $this->data['text_setquantity'] = $this->language->get('text_setquantity');
                
        $this->data['text_total'] = $this->language->get('text_total');
        $this->data['text_save'] = $this->language->get('text_save');
        $this->data['text_present'] = $this->language->get('text_present');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_notactive'] = $this->language->get('text_notactive');
        
        $image_width = (int)$this->config->get('set_product_page_card_image_width') ? $this->config->get('set_product_page_card_image_width') : $this->config->get('config_image_product_width'); 
        $image_height = (int)$this->config->get('set_product_page_card_image_height') ? $this->config->get('set_product_page_card_image_height') : $this->config->get('config_image_product_height');
            
        $this->data['products'] = array();
        
        $this->data['set_id'] = 0;
        $this->data['active_set'] = true;
        $temp_save = 0;
        $old_total = 0;        
        
        if(isset($this->request->get['set_id'])){
            
            $this->data['set_id'] = $this->request->get['set_id'];
            
            $set_info = $this->model_catalog_set->getSet($this->request->get['set_id']);            
            
            $results = $this->model_catalog_set->getProductsInSets($this->request->get['set_id']);
            if($results){
                foreach ($results as $product){
                    
                        $active_product = true;
        
        				if ($product['image']) {
        					$image = $this->model_tool_image->resize($product['image'], $image_width, $image_height);
        				} else {
        					$image = $this->model_tool_image->resize('no_image.jpg', $image_width, $image_height);
        				}
        
        				if ((float)$product['base_special'] && (float)$product['base_special'] < (float)$product['base_price']) {
                            $real_price = (float)$product['base_special'];
        				} else {
        					$real_price = (float)$product['base_price'];
        				}
                                                        
                        $product_options = array();
                			
             			foreach ($this->model_catalog_product->getProductOptions($product['product_id']) as $option) { 
                			    
                				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
                					$option_value_data = array();
                					
                					foreach ($option['option_value'] as $option_value) {
                					    
                                        $selected = false;
                                        
                						//if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                								$option_price = $this->currency->format($this->tax->calculate($option_value['price'], $set_info['tax_class_id'], $this->config->get('config_tax')));
                							} else {
                								$option_price = false;
                							}
                                            if(isset($product['options'][$option['product_option_id']])&&$product['options'][$option['product_option_id']] == $option_value['product_option_value_id']){
                                                $selected = true;
                                                $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                                if ((int)$option_value['quantity']==0) {
                                                    $active_product = false;
                                                }
                                            } 
                                            if($option['type'] == 'checkbox' && isset($product['options'][$option['product_option_id']]) && in_array($option_value['product_option_value_id'], $product['options'][$option['product_option_id']])){
                                                $selected = true;
                                                $real_price = (float)$real_price + ($option_value['price_prefix'] . (float)$option_value['price']);
                                                if ((int)$option_value['quantity']==0) {
                                                    $active_product = false;
                                                }                                           
                                            }
                							$option_value_data[] = array(
                								'product_option_value_id' => $option_value['product_option_value_id'],
                								'option_value_id'         => $option_value['option_value_id'],
                                                'selected'                => $selected,
                                                'active'                  => (int)$option_value['quantity'],
                								'name'                    => $option_value['name'],
                								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
                								'price'                   => $option_price,
                								'price_prefix'            => $option_value['price_prefix']
                							);
                						//} 
                					}
                					
                					$product_options[] = array(
                						'product_option_id' => $option['product_option_id'],
                						'option_id'         => $option['option_id'],
                                        'selected'          => isset($product['options'][$option['product_option_id']]),
                						'name'              => $option['name'],
                						'type'              => $option['type'],
                						'option_value'      => $option_value_data,
                						'required'          => $option['required']
                					);					
                				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                					$product_options[] = array(
                						'product_option_id' => $option['product_option_id'],
                						'option_id'         => $option['option_id'],
                                        'selected'          => isset($product['options'][$option['product_option_id']]),
                						'name'              => $option['name'],
                						'type'              => $option['type'],
                						'option_value'      => isset($product['options'][$option['product_option_id']]) ? $product['options'][$option['product_option_id']] : $option['option_value'],
                						'required'          => $option['required']
                					);						
                				}
                        }                    
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            				$price_product = $this->currency->format($this->tax->calculate($real_price, $set_info['tax_class_id'], $this->config->get('config_tax')));
            		    } else {
            				$price_product = false;
                        }                
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            				$price_in_set = $this->currency->format($this->tax->calculate($product['price_in_set'], $set_info['tax_class_id'], $this->config->get('config_tax')));
            		    } else {
            				$price_in_set = false;
                        } 
                         
                        $sale_value = round((((float)$real_price - (float)$product['price_in_set'])/(float)$real_price)*100);
                                                    
                        if(!$product['base_status']||!$product['base_quantity']) {
                            $active_product = false;
                        }
                        
                        if(!$active_product){
                            $this->data['active_set'] = false;
                        }
                        
                        $this->data['products'][] = array(
                            'product_id'   => $product['product_wop_id'],
                            'name'         => $product['name'],
                            'present'      => $product['present'],
                            'option_set'   => $product['options'],
                            'options'      => $product_options,
                            'thumb'        => $image,
                            'active'       => $active_product,
                            'price'        => $price_product,
                            'price_in_set' => $price_in_set,
                            'sale_value'   => $sale_value,
                            'text_salevalue'=> sprintf($this->language->get('text_salevalue'), $sale_value) . '%',
                            'quantity'     => (int)$product['quantity'],
                            'text_quantity'=> sprintf($this->language->get('text_quantity'), $product['quantity']),
                            'href'         => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                        );
                        
                        $old_total += (float)$real_price*(int)$product['quantity']; 
                        
                }


            }
            $temp_save = (float)$old_total-(float)$set_info['price'];
            $set_save = $this->currency->format($this->tax->calculate($temp_save, $set_info['tax_class_id'], $this->config->get('config_tax')));              
            
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $set_price = $this->currency->format($this->tax->calculate($set_info['price'], $set_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $set_price = false;
            }            
            
            
            $this->data['set_price'] = $set_price;
            $this->data['set_save'] = $set_save;        
        
        }
        
        
        
        
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/setproductform.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/setproductform.tpl';
		} else {
				$this->template = 'default/template/module/setproductform.tpl';
		}
				
		$this->response->setOutput($this->render());
    }


	public function add_to_cart() {
	   
		$this->language->load('module/set');
        $this->load->model('catalog/set');
		
		$json = array();
		
		if (isset($this->request->post['set_id'])) {
			$set_id = $this->request->post['set_id'];
		} else {
			$set_id = 0;
		}
		
		$this->load->model('catalog/product');
		  
		if (isset($this->request->post['product_id'])) {
			$product_ids = array_filter($this->request->post['product_id']);
		} else {
			$product_ids = array();	
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = array_filter($this->request->post['quantity']);
		} else {
			$quantity = array();
		}
													
		if (isset($this->request->post['option'])) {
			$option = array_filter($this->request->post['option']);
		} else {
			$option = array();	
		}

        if($product_ids){
            foreach($product_ids as $k=>$product_id){
                $temp = explode(':', $product_id);
                $real_product_id = $temp[0];
                $product_options = $this->model_catalog_product->getProductOptions($real_product_id);
       			foreach ($product_options as $product_option) {
       				if ($product_option['required'] && empty($option[$product_id][$product_option['product_option_id']])) {
                        $json['error']['option'][] = array(
                            'set_id'            => $set_id,
                            'sort_in_set'       => $k,
                            'product_id'        => $product_id,
                            'product_option_id' => $product_option['product_option_id'],
                            'text_error'        => sprintf($this->language->get('error_required'), $product_option['name'])
                        );
     				}
       			}                    
            }
        }

		if (!$json) {
			//if (!isset($this->session->data['set'][$set_id . '_0'])) {
				 $key_set = $set_id . '_0';
			//} else {
			//	 $count_set = count($this->session->data['set']);
			//	 $key_set = $set_id . '_' . ++$count_set; 
			//}			 

			$product_cart_data = array();

			foreach($product_ids as $product_id){
				$temp = explode(':', $product_id);
				$real_product_id = $temp[0];
				if(isset($option[$product_id])){
					$key = (int)$real_product_id . ':' . base64_encode(serialize($option[$product_id])) . '-' . $key_set;
				} else {
					$key = (int)$real_product_id . '-' . $key_set; 
				}
				if ((int)$quantity[$product_id] && ((int)$quantity[$product_id] > 0)) {
					if (!isset($this->session->data['cart'][$key])) {
						$this->session->data['cart'][$key] = (int)$quantity[$product_id];
					} else {
						$this->session->data['cart'][$key] += (int)$quantity[$product_id];
					}
				}
				$product_cart_data[$key] = (int)$quantity[$product_id];                         
			}
			
			$this->session->data['set'][$key_set] = $product_cart_data;
			
			$set_info = $this->model_catalog_set->getSet($set_id);

			if((int)$set_info['product_id']){
				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $set_info['product_id']), $set_info['name'], $this->url->link('checkout/cart'));    
			} else {
				$json['success'] = sprintf($this->language->get('text_success1'), $set_info['name'], $this->url->link('checkout/cart'));
			}
			
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			
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
			
			$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
		} 
		
		$this->response->setOutput(json_encode($json));		
	}
}
?>
