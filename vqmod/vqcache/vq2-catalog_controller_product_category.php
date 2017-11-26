<?php
class ControllerProductCategory extends Controller {
    public function index() {
		//$debug = $_SERVER['REMOTE_ADDR'] == '77.122.7.164' ? true : false;
		$debug = true;
		$debugStr = $_SERVER['REMOTE_ADDR']."\t".date('d.m.y H:i:s')."\t\t";
		$t1 = microtime(true);
	
/**	if (in_array($_SERVER['REMOTE_ADDR'], array('109.87.18.183'))){
			global $global_start_time;
			$time = microtime(true) - $global_start_time;
			file_put_contents('debug.log', date('H:i:s').' : '.$time.' sec. : CATEGORY START'.PHP_EOL, FILE_APPEND);
		}*/
	
        $this->language->load('product/category');
        $this->language->load('product/product');
        $this->load->model('catalog/category');

        $this->load->model('catalog/product');

		# OCFilter start
		$this->load->model('catalog/ocfilter');
		if (isset($this->request->get[$this->ocfilter['index']])) {
			$filter_ocfilter = $this->request->get[$this->ocfilter['index']];
		} else {
			$filter_ocfilter = null;
		}
		# OCFilter end
		$this->load->model('catalog/set');

        $this->load->model('tool/image');

        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = '';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
			if ($page == 1){
				$this->redirect('http://'.$_SERVER['HTTP_HOST'].preg_replace("/(&amp;|\?)page=1/", '', $_SERVER['REQUEST_URI']));
			}
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_catalog_limit');
        }

        $this->data['breadcrumbs'] = array();

//       $this->data['breadcrumbs'][] = array(
//           'text'      => $this->language->get('text_home'),
//         'href'      => $this->url->link('common/home'),
//          'separator' => false
//      );

        if (isset($this->request->get['path'])) {
            $path = '';
            $parts = explode('_', (string)$this->request->get['path']);
            $category_id = (int)array_pop($parts);
            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = (int)$path_id;
                } else {
                    $path .= '_' . (int)$path_id;
                }

                $category_info = $this->model_catalog_category->getCategory($path_id);
				$this->data['category_info'] = $category_info;

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
        } else {
            $category_id = 0;
        }


        $category_info = $this->model_catalog_category->getCategory($category_id);

        if ($category_info) {
			$t2 = microtime(true);
			$debugStr .= number_format($t2-$t1, 2, '.', '')."\t"; // 1
            $ocfilter_meta = false;
            if ($filter_ocfilter){
                $filter_ocfilter2 = $filter_ocfilter;
                $arr = explode(";", $filter_ocfilter2);
                $options = array();
                for ($i=0; $i < count($arr); $i++) { 
                    $arr2 = explode(":", $arr[$i]);

                    if ($arr2[0] != 'p'){
                        $opt = explode(",", $arr2[1]);
                        for ($j=0; $j < count($opt); $j++) { 
                            $options[] = $opt[$j];
                        }
                    }
                }
                if (count($options) <= 2 || count($options) > 0){
                    if ($ocfilter_meta_data = $this->model_catalog_category->getOcfiltermeta($options,$category_id))
                        $ocfilter_meta = true;
                }
            }
			
			$t3 = microtime(true);
			$debugStr .= number_format($t3-$t2, 2, '.', '')."\t"; // 2

            if ($category_info['seo_title']) {
                $this->document->setTitle($category_info['seo_title']);
            } else {
                $this->document->setTitle($category_info['name']);
            }

            $this->document->setDescription($category_info['meta_description']);
            $this->document->setKeywords($category_info['meta_keyword']);
            $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
            if ($category_info['seo_h1']) {
                $this->data['heading_title'] = $category_info['seo_h1'];
            } else {
                $this->data['heading_title'] = $category_info['name'];
            }

            $this->data['text_refine'] = $this->language->get('text_refine');
            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_quantity'] = $this->language->get('text_quantity');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $this->data['text_display'] = $this->language->get('text_display');
            $this->data['text_list'] = $this->language->get('text_list');
            $this->data['text_grid'] = $this->language->get('text_grid');
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_limit'] = $this->language->get('text_limit');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['breadcrumbs'][] = array(
                'text'      => $category_info['seo_h1'],
                'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path']),
                'separator' => $this->language->get('text_separator')
            );


            if ($category_info['image']) {
                $this->data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
                $this->document->setOgImage($this->data['thumb']);
            } else {
                $this->data['thumb'] = '';
            }

            $this->data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
            $this->data['compare'] = $this->url->link('product/compare');

			$cache = 'cat_cache_' . $category_id;
			$cache_data = $this->cache->get($cache);
			
			if(!$cache_data) {
			
            $this->data['categories'] = array();
			

            $results = $this->model_catalog_category->getCategories($category_id);
			
			

            foreach ($results as $result) {
                $data = array(
                    'filter_category_id'  => $result['category_id'],
                    'filter_sub_category' => true
                );

               // $product_total = $this->model_catalog_product->getTotalProducts($data);

                $this->data['categories'][] = array(
                    'name'  => $result['name'],// . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id']),
                    'thumb' => $this->model_tool_image->resize(($result['image']=='' ? 'no_image.jpg' : $result['image']), $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'))
                );
            };
				$this->cache->set($cache, $this->data['categories']);				
			
			} else {
				$this->data['categories'] = $cache_data;
			}

            $this->data['products'] = array();
			$this->data['filter_ocfilter'] = $filter_ocfilter;

			$t4 = microtime(true);
			$debugStr .= number_format($t4-$t3, 2, '.', '')."\t"; // 3
			
			if (!empty($filter_ocfilter)){
				$this->load->model('catalog/review');
				$this->data['reviews'] = $this->model_catalog_review->getRandomReviewsByCategoryId($category_id, $this->request->get['path'], $filter_ocfilter, 3);
								   /*added to add correct canonical meta tag to page*/	   
	//echo('http://'.$_SERVER['HTTP_HOST'].'/'.$this->request->get['_route_']);
   /*end of added to add correct canonical meta tag to page*/	
			}
			else
			{
				   /*added to add correct canonical meta tag to page*/
   $this->document->addLink($this->url->link('product/category', 'path=' . $this->model_catalog_category->getCategoryPath($category_id)), 'canonical');
   /*end of added to add correct canonical meta tag to page*/
			}

            $data = array(
                'filter_category_id' => $category_id,
				# OCFilter start
				'filter_ocfilter'    => $filter_ocfilter,
				# OCFilter end
                'sort'               => $sort,
                'order'              => $order,
                //'start'              => ($page - 1) * $limit,
                //'limit'              => $limit
            );

            $modules = $this->config->get('filter_module');
            $layout_id = $this->model_catalog_category->getCategoryLayoutId($category_id);
            if (!$layout_id) {
                $this->load->model('design/layout');
                $layout_id = $this->model_design_layout->getLayout('product/category');
            }

            $filter_module = false;

            if ($modules) {
                foreach ($modules as $module) {
                    if ($module['layout_id'] == $layout_id && $module['status']) {
                        $filter_module = true;
                        break;
                    }
                }
            }

			$t5 = microtime(true);
			$debugStr .= number_format($t5-$t4, 2, '.', '')."\t"; // 4
			
            //$linkedProducts = $this->model_catalog_product->getAllLinkedProducts('2'); //2 is Image
            if ($filter_module && $filter != "") {
                $this->load->model('module/filter');

                $filter = $this->model_module_filter->getProductsIDFromCategory($filter, $category_id);

                $data['filter'] = $filter;

                if ($filter) {
                    $results = $this->model_catalog_product->getProducts($data, true);
					$linkedProducts = $this->model_catalog_product->getAllLinkedProducts('2', array_keys($results)); // optimization
				//	$results = $this->fixSortResults($results, $page, $limit, $linkedProducts, $data['sort'] == 'p.price');
				# OCFilter start
				$ocfilter_products_options = $this->model_catalog_ocfilter->getOCFilterProductsOptions($results);
				# OCFilter end
                    $product_total = $this->model_catalog_product->getFoundProducts();
                } else {
                    $results = array();
					$linkedProducts = array(); // optimization
                    $product_total = 0;
                }
            }
			
			$t6 = microtime(true);
			$debugStr .= number_format($t6-$t5, 2, '.', '')."\t"; // 5

            if (!isset($data['filter'])) {
                $results = $this->model_catalog_product->getProducts($data, true);
				$t61 = microtime(true);
				
				$linkedProducts = $this->model_catalog_product->getAllLinkedProducts('2', array_keys($results)); // optimization
				$t62 = microtime(true);
				$results = $this->fixSortResults($results, $page, $limit, $linkedProducts, $data['sort'] == 'p.price');
				$t63 = microtime(true);
				
				# OCFilter start
				if (!isset($ocfilter_products_options)) $ocfilter_products_options = $this->model_catalog_ocfilter->getOCFilterProductsOptions($results);
				# OCFilter end
				$t64 = microtime(true);
                $product_total = $this->model_catalog_product->getFoundProducts();
            }

			$t7 = microtime(true);
			$debugStr .= number_format($t7-$t6, 2, '.', '')."\t("
				.number_format($t61-$t6, 2, '.', '')."\t"
				.number_format($t62-$t61, 2, '.', '')."\t"
				.number_format($t63-$t62, 2, '.', '')."\t"
				.number_format($t64-$t63, 2, '.', '')."\t"
				.number_format($t7-$t64, 2, '.', '')
				.")\t"; // 6
			
			if (!empty($filter_ocfilter) && $category_id){
				$filterOptions = $this->model_catalog_ocfilter->getOCFilterOptionsByCategoryId($category_id);
				$filterStr = array();
				if (!empty($filterOptions)) foreach($filterOptions as $k => $opt){
					$filterSubstr = array();
					if (!empty($opt['values'])) foreach($opt['values'] as $v){
						if (in_array($v['value_id'], $options)) $filterSubstr[] = $v['name'];
					}
					$filterStr[] = implode(', ', $filterSubstr);
				}
				$filterStr = implode(' ', $filterStr);
				
				if (!empty($category_info['filter_title'])){
					$this->document->setTitle(str_replace('%f', $filterStr, $category_info['filter_title']));
				}
				if (!empty($category_info['filter_description'])){
					$this->document->setDescription(str_replace('%f', $filterStr, $category_info['filter_description']));
				}
				if (!empty($category_info['filter_h1'])){
					$this->data['heading_title'] = str_replace('%f', $filterStr, $category_info['filter_h1']);
				}
			}
            if ($ocfilter_meta){
                $this->document->setTitle($ocfilter_meta_data['meta_title']);
                $this->document->setDescription($ocfilter_meta_data['meta_description']);
                $this->data['seo_h1'] = $ocfilter_meta_data['h'];
                $this->data['description'] = html_entity_decode($ocfilter_meta_data['text_top'], ENT_QUOTES, 'UTF-8');
                $this->data['dscr_foot'] = html_entity_decode($ocfilter_meta_data['text_bottom'], ENT_QUOTES, 'UTF-8');
            } else {
                $this->data['seo_h1'] = $this->data['heading_title'];
                $this->data['dscr_foot'] = '';
            }

			if ((!$ocfilter_meta && !empty($options)) || count($_GET) > 1){
				$this->data['description'] = '';
			}

			$t8 = microtime(true);
			$debugStr .= number_format($t8-$t7, 2, '.', '')."\t"; // 7
            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                $price = str_replace("грн", '<span>грн</span>', $price);
                $special = str_replace("грн", '<span>грн</span>', $special);

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] && (float)$result['special'] < (float)$result['price'] ? $result['special'] : $result['price']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$result['rating'];
                } else {
                    $rating = false;
                }

                //product model
                if ($result['model']) {
                        $model = $result['model'];
                    } else {
                        $model = 'не заданa';
                }

                //product manufacturer
                if ($result['manufacturer']) {
                        $manufacturer = $result['manufacturer'];
                    } else {
                        $manufacturer = 'не задан';
                }

                $attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);
                $special_percent_out = round(100 - ($result['special']*100/$result['price']));

                $special_percent = '';

                if($special_percent_out != 100){
                    $special_percent = $special_percent_out;
                }

				$quantity = $result['quantity'];
				if ( $quantity <= 0 ) {
					$soldlabel = '<div class="soldlabel"></div>';
				} else {
					$soldlabel = '';
				}

				$viewed1 = $result['viewed'];
				$viewed2 = $this->config->get('config_popularproduct');
				if ( $viewed1 > $viewed2 ) {
					$popularlabel = '<div class="popularlabel"></div>';
				} else {
					$popularlabel = '';
				}
				
                $timestamp = time();
                $date_time_array = getdate($timestamp);
                $hours = $date_time_array['hours'];
                $minutes = $date_time_array['minutes'];
                $seconds = $date_time_array['seconds'];
                $month = $date_time_array['mon'];
                $day = $date_time_array['mday'];
                $year = $date_time_array['year'];
                $config_newproduct = $this->config->get('config_newproduct');
				$timestamp = mktime($hours,$minutes,$seconds,$month,$day - $config_newproduct,$year);
                $date1 = strftime('%Y-%m-%d',$timestamp);
				$date = $result['date_available'];
				if ( $date > $date1 ) {
					$newlabel = '<div class="newlabel"></div>';
				} else {
					$newlabel = '';
				}	
				
				
				if ((float)$result['special']) {
				$speciallabel = '<div class="speciallabel"></div>';
				} else {
				$speciallabel = '';
				}
                $this->data['products'][] = array(
			//	'promotion'   => $result['promotions']['category'], //promotions
			//	'statuses'    => $result['statuses']['category'], //pr statuses
			//	'stickers'    => $result['statuses']['category_stickers'],        //pr.statuses
                    'product_id'  => $result['product_id'],
						# OCFilter start
						'ocfilter_products_options' => $ocfilter_products_options[$result['product_id']],
						# OCFilter end
					'quantity'	  => $result['quantity'],
                    'thumb'       => $image,
					'is_set' 	  => $this->model_catalog_set->isSetExist($result['product_id']),
                    'name'        => $result['name'],
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
                    'price'       => $price,
                    'special'     => $special,
'soldlabel'   => $this->config->get('config_display_availableproduct') ?  $soldlabel : false,
					'popularlabel'=> $this->config->get('config_display_popularproduct') ?  $popularlabel : false,
					'newlabel'    => $this->config->get('config_display_newproduct') ?  $newlabel : false,
					'speciallabel'=> $this->config->get('config_display_specialsproduct') ?  $speciallabel : false,
                    'special_percent'     => $special_percent,

					'upc'         => $result['upc'],
					'ean'         => $result['ean'],
                    'model'      => $model,
                    'manufacturer' => $manufacturer,
                    'attribute_groups'  => $attribute_groups,
                    'tax'         => $tax,
                    'rating'      => $result['rating'],
                    'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'])
                );
            }
			

			$t9 = microtime(true);
			$debugStr .= number_format($t9-$t8, 2, '.', '')."\t"; // 8
			
            // Product Series
            if(isset($this->data['products'])) {
                $pds_list_thumbnail_width = 20;
                $pds_list_thumbnail_height = 20;
                $pds_thumbnail_hover_effect = 'rollover';

                if($pds_thumbnail_hover_effect == 'rollover') {
                    $pds_list_hover_width = $this->config->get('config_image_product_width');
                    $pds_list_hover_height = $this->config->get('config_image_product_height');
                    $pds_list_thumbnail_class = 'pds-thumb-rollover';
                } elseif($pds_thumbnail_hover_effect == 'preview') {
                    $pds_list_hover_width = 200;
                    $pds_list_hover_height = 200;
                    $pds_list_thumbnail_class = 'preview';
                } else {
                    $pds_list_thumbnail_class = '';
                }

				foreach ($this->data['products'] as &$product) {
					
					/* yoda fix
                    $product['pds'] = array();
					if (!empty($linkedProducts[$product['product_id']])){
						foreach($linkedProducts[$product['product_id']] as $result){
                            $product_pds_image = $result['special_attribute_value'] != ''
                            ? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
                            : $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);

                            if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview') {
                                $product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
                            } else {
                                $product_pds_image_hover = '';
                            }

                            $product['pds'][] = array(
                                'product_link' => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                                'product_name' => $result['product_name'],
                                'all' => $result,
                                'product_pds_image' => $product_pds_image,
                                'product_master_image' => $product['thumb'],
                                'product_pds_image_hover' => $product_pds_image_hover,
                                'pds_list_thumbnail_class' => $pds_list_thumbnail_class
                            );							
						}
					}
					*yoda fix/
					
                    /*foreach ($linkedProducts as $result) {
                        if($result['master_product_id'] == $product['product_id']) {
						
                            $product_pds_image = $result['special_attribute_value'] != ''
                            ? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
                            : $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);

                            if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview') {
                                $product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
                            } else {
                                $product_pds_image_hover = '';
                            }

                            $product['pds'][] = array(
                                'product_link' => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                                'product_name' => $result['product_name'],
                                'all' => $result,
                                'product_pds_image' => $product_pds_image,
                                'product_master_image' => $product['thumb'],
                                'product_pds_image_hover' => $product_pds_image_hover,
                                'pds_list_thumbnail_class' => $pds_list_thumbnail_class
                            );
							
                        }
                    }*/
                }
            }
            // Product Series
			
			$t10 = microtime(true);
			$debugStr .= number_format($t10-$t9, 2, '.', '')."\t"; // 9
			$debugStr .= $_SERVER['REQUEST_URI'].PHP_EOL;
			if ($debug) file_put_contents('slowlog-categories.txt', $debugStr, FILE_APPEND);
			
            $url = '';

				# OCFilter start
				if (isset($this->request->get[$this->ocfilter['index']])) {
					$url .= '&' . $this->ocfilter['index'] . '=' . $this->request->get[$this->ocfilter['index']];
				}
				# OCFilter end

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }


            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['sorts'] = array();

            if ($this->config->get('config_review_status')) {
                $this->data['sorts'][] = array(
                    'text'  => 'Рейтингу',
                    'value' => 'rating-DESC',
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
                );
            }

            $this->data['sorts'][] = array(
                'text'  => 'Новинкам',
                'value' => 'p.date_added-DESC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.date_added&order=DESC' . $url)
                );

            $this->data['sorts'][] = array(
                'text'  => 'Цене',
                'value' => 'p.price-ASC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
            );

            $url = '';
			
			# OCFilter start
			if (isset($this->request->get[$this->ocfilter['index']])) {
				$url .= '&' . $this->ocfilter['index'] . '=' . $this->request->get[$this->ocfilter['index']];
			}
			# OCFilter end

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }
            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

			if ($product_total > $limit){
				$pagination = new Pagination();
				$pagination->total = $product_total;
				$pagination->page = $page;
				$pagination->limit = $limit;
				$pagination->num_links = 20;
				//$pagination->text = $this->language->get('text_pagination');
				$pagination->text = '';
				$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');
				$this->data['pagination'] = $pagination->render();
			} else {
				$this->data['pagination'] = '';
			}
            $this->data['sort'] = $sort;
            $this->data['order'] = $order;
            $this->data['limit'] = $limit;

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/category.tpl';
            } else {
                $this->template = 'default/template/product/category.tpl';
            }

            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );
			
/**		if (in_array($_SERVER['REMOTE_ADDR'], array('109.87.18.183'))){
				global $global_start_time;
				$time = microtime(true) - $global_start_time;
				file_put_contents('debug.log', date('H:i:s').' : '.$time.' sec. : CATEGORY END'.PHP_EOL, FILE_APPEND);
			}*/
            $this->response->setOutput($this->render());
/**		if (in_array($_SERVER['REMOTE_ADDR'], array('109.87.18.183'))){
				global $global_start_time;
				$time = microtime(true) - $global_start_time;
				file_put_contents('debug.log', date('H:i:s').' : '.$time.' sec. : CATEGORY DEAD'.PHP_EOL.PHP_EOL, FILE_APPEND);
			}*/
        } else {
            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_error'),
                'href'      => $this->url->link('product/category'),
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
    }
	
	private function fixSortResults($results, $page, $limit, $linkedProducts, $pricesort = false){
		$is = $isnot = array();
		foreach($results as $r){
			$atStore = false;			
			$r['pds'] = array();
			if (!empty($linkedProducts[$r['product_id']])){
				foreach($linkedProducts[$r['product_id']] as $result){
					$r['pds'][] = array('all' => $result);
				}
			}
			if ($r['price']){
				if (empty($r['pds'])){
					if ($r['quantity'] > 0) $atStore = true;
				} else {
					//if (!$r['special']){
						foreach ($r['pds'] as $p){
							if (!$p['all']['quantity']) continue;
							$atStore = true;
						}
					//}
				}
			}
			if ($atStore) $is[] = $r; else $isnot[] = $r;
		}
		
		if ($pricesort){
			usort($is, function($a, $b){
				$aPrice = (float)$a['price'];
				if (!$a['special'] || (float)$a['special'] > $aPrice){
					if (!empty($a['pds'])){
						$min = 999999; 
						foreach ($a['pds'] as $p){
							if (!$p['all']['quantity']) continue;
							$min = $p['all']['special'] > 0 && $p['all']['special'] < $p['all']['price'] ? ($p['all']['special'] < $min ? $p['all']['special']  : $min) : ($p['all']['price'] < $min ? $p['all']['price']  : $min);
						}
						if ($min != 999999) $aPrice = (float)$min;
					}
				} else $aPrice = $a['special'];
				
				$bPrice = (float)$b['price'];
				if (!$b['special'] || (float)$b['special'] > $bPrice){
					if (!empty($b['pds'])){
						$min = 999999; 
						foreach ($b['pds'] as $p) {
							if (!$p['all']['quantity']) continue;
							$min = $p['all']['special'] > 0 && $p['all']['special'] < $p['all']['price'] ? ($p['all']['special'] < $min ? $p['all']['special']  : $min) : ($p['all']['price'] < $min ? $p['all']['price']  : $min);
						}
						if ($min != 999999) $bPrice = (float)$min;
					}
				} else $bPrice = $b['special'];
				
				if ($aPrice == $bPrice) return 0;
				return $aPrice < $bPrice ? -1 : 1;
			});
			//print_r($is);
		}

		$results = array();
		foreach($is as $r) $results[] = $r;
		foreach($isnot as $r) $results[] = $r;
		$results = array_slice($results, ($page-1)*$limit, $limit);
		return $results;
	}
}
?>
