<?php
class ControllerProductSpecial extends Controller {
    public function index() {
        $this->language->load('product/special');
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
		
        $this->load->model('tool/image');

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'ps.date_start';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_catalog_limit');
        }

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
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

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('product/special', $url),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['heading_title'] = $this->language->get('heading_title');

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

        $this->data['compare'] = $this->url->link('product/compare');

        $this->data['products'] = array();

        $data = array(
            'sort'  => $sort,
					# OCFilter start
					'filter_ocfilter'    => $filter_ocfilter,
					# OCFilter end
            'order' => $order,
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        );
				# OCFilter start
				$ocfilter_products_options = $this->model_catalog_ocfilter->getOCFilterProductsOptions($results);
				# OCFilter end
						# OCFilter start
				if (!isset($ocfilter_products_options)) $ocfilter_products_options = $this->model_catalog_ocfilter->getOCFilterProductsOptions($results);
				# OCFilter end		
        $product_total = $this->model_catalog_product->getTotalProductSpecials($data);
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
		
        $results = $this->model_catalog_product->getProductSpecials($data);

        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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
                $special_percent_out = round(100 - ($result['special']*100/$result['price']));

                $special_percent = '';

                if($special_percent_out != 100){
                    $special_percent = $special_percent_out;
                }
            } else {
                $special = false;
                $special_percent = '';
            }

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

$this->load->model('catalog/product'); $this->load->model('catalog/category');
            $get_categories = $this->model_catalog_product->getCategories($result['product_id']);
                foreach ($get_categories as $cat) {
                    $cat_id = $cat['category_id']; break;
                }
                $full_url = $cat_id;
                while($cat_id) {
                    $parent = $this->model_catalog_category->getCategory($cat_id);
                    $cat_id = $parent['parent_id'];
                    if ( $cat_id != 0 ) $full_url = $cat_id . "_" . $full_url; else break;
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
                'product_id'  => $result['product_id'],
										# OCFilter start
				//		'ocfilter_products_options' => $ocfilter_products_options[$result['product_id']],
						# OCFilter end
                'thumb'       => $image,
                'name'        => $result['name'],
                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
                'price'       => $price,
                'special'     => $special,
					'soldlabel'   => $this->config->get('config_display_availableproduct') ?  $soldlabel : false,
					'popularlabel'=> $this->config->get('config_display_popularproduct') ?  $popularlabel : false,
					'newlabel'    => $this->config->get('config_display_newproduct') ?  $newlabel : false,
					'speciallabel'=> $this->config->get('config_display_specialsproduct') ?  $speciallabel : false,
                'special_percent'     => $special_percent,
                'tax'         => $tax,
                'rating'      => $result['rating'],
                'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                'href'        => $this->url->link('product/product', 'path='. $full_url .'&product_id=' . $result['product_id'])
            );
        }

        $url = '';
				# OCFilter start
				if (isset($this->request->get[$this->ocfilter['index']])) {
					$url .= '&' . $this->ocfilter['index'] . '=' . $this->request->get[$this->ocfilter['index']];
				}
				# OCFilter end
        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }

        $this->data['sorts'] = array();

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_default'),
            'value' => 'p.sort_order-ASC',
            'href'  => $this->url->link('product/special', 'sort=p.sort_order&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_name_asc'),
            'value' => 'pd.name-ASC',
            'href'  => $this->url->link('product/special', 'sort=pd.name&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_name_desc'),
            'value' => 'pd.name-DESC',
            'href'  => $this->url->link('product/special', 'sort=pd.name&order=DESC' . $url)
        );

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_price_asc'),
            'value' => 'ps.price-ASC',
            'href'  => $this->url->link('product/special', 'sort=ps.price&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_price_desc'),
            'value' => 'ps.price-DESC',
            'href'  => $this->url->link('product/special', 'sort=ps.price&order=DESC' . $url)
        );

        if ($this->config->get('config_review_status')) {
            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_rating_desc'),
                'value' => 'rating-DESC',
                'href'  => $this->url->link('product/special', 'sort=rating&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_rating_asc'),
                'value' => 'rating-ASC',
                'href'  => $this->url->link('product/special', 'sort=rating&order=ASC' . $url)
            );
        }

        $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_model_asc'),
                'value' => 'p.model-ASC',
                'href'  => $this->url->link('product/special', 'sort=p.model&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text'  => $this->language->get('text_model_desc'),
            'value' => 'p.model-DESC',
            'href'  => $this->url->link('product/special', 'sort=p.model&order=DESC' . $url)
        );

        $url = '';
			# OCFilter start
			if (isset($this->request->get[$this->ocfilter['index']])) {
				$url .= '&' . $this->ocfilter['index'] . '=' . $this->request->get[$this->ocfilter['index']];
			}
			# OCFilter end
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }


        $this->data['limits'] = array();

        $limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

        sort($limits);

        foreach($limits as $limits){
            $this->data['limits'][] = array(
                'text'  => $limits,
                'value' => $limits,
                'href'  => $this->url->link('product/special', $url . '&limit=' . $limit)
            );
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }

        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('product/special', $url . '&page={page}');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;
        $this->data['limit'] = $limit;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/special.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/special.tpl';
        } else {
            $this->template = 'default/template/product/special.tpl';
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
