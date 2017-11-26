<?php 
class ControllerProductLatest extends Controller {  
  var $_templateData = array();
  
	public function index() { 
		$this->_templateData = $this->load->language('product/latest');
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/latest');
		
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.date_added';
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
							
		$language_id = (int)$this->config->get('config_language_id');
		$options = $this->config->get('latests_in_recent');
		$description = $options['description'];

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $options['limit'];
		}
					
		$this->_templateData['breadcrumbs'] = array();

    $this->_templateData['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_home'),
      'href'      => $this->url->link('common/home'),
      'separator' => false
    );	
			
		$this->_templateData['breadcrumbs'][] = array(
			'text'		  => $description[$language_id]['name'],
			'href'		  => $this->url->link('product/latest'),
			'separator' => $this->language->get('text_separator')
		);

		$this->_templateData['category_ways'] = array();
    if ($options['breadcrumbs_separate']) {
      $this->_templateData['category_ways'][] = array(
        'text'      => $this->language->get('text_allcategories'),
        'href'      => $this->url->link('product/latest'),
        'separator' => false
      );
    }
		
		if (isset($this->request->get['lirpath'])) {
			$req_path = $this->request->get['lirpath'];
			$path = '';
		
			$parts = explode('_', (string)$this->request->get['lirpath']);
		
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}
									
				$category_info = $this->model_catalog_category->getCategory($path_id);
				
				if ($category_info) {
          if (($options['main_categories']) && ($options['main_show_h1']) && (strlen($category_info['seo_h1']))) {
            $name_cat = $category_info['seo_h1'];
          } else {
            $name_cat = $category_info['name'];
          }

          if ($options['breadcrumbs_separate']) {
            $this->_templateData['category_ways'][] = array(
              'text'      => $name_cat,
              'href'      => $this->url->link('product/latest'),
              'separator' => $this->language->get('text_separator')
            );
          } else {
            $this->_templateData['breadcrumbs'][] = array(
              'text'      => $name_cat,
              'href'      => $this->url->link('product/latest'),
              'separator' => $this->language->get('text_separator')
            );
          }
				}
			}		
		
			$category_id = (int)array_pop($parts);
		} else {
			$category_id = 0;
			$req_path = '0';
		}
		
	
		if ($description[$language_id]['seo_title']) {
			$this->document->setTitle($description[$language_id]['seo_title']);
		} else {
			$this->document->setTitle($description[$language_id]['name']);
		}
		
		$this->document->setDescription($description[$language_id]['meta_description']);
		$this->document->setKeywords($description[$language_id]['meta_keyword']);

    if (version_compare(VERSION, '1.5.5', '>=') && version_compare(VERSION, '2.0', '<')) {
      $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
    }

    if (version_compare(VERSION, '1.5.5', '>=')) {
			if ($description[$language_id]['seo_h1']) {
				$this->_templateData['heading_title'] = $description[$language_id]['seo_h1'];
			} else {
				$this->_templateData['heading_title'] = $description[$language_id]['name'];
			}
    } else {
      $this->_templateData['heading_title'] = $description[$language_id]['seo_title'];
    }
    
    $this->_templateData['seo_h1'] = $description[$language_id]['seo_h1'];
		$this->_templateData['name'] = $description[$language_id]['name'];
		$this->_templateData['description'] = html_entity_decode($description[$language_id]['description'], ENT_QUOTES, 'UTF-8');

		$this->_templateData['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		
		$this->_templateData['display'] = $options['display'];
		
		$this->_templateData['thumb'] = '';
								
		$this->_templateData['compare'] = $this->url->link('product/compare');
		
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
							
		//Вычитаем из даты N дней
		$date = date("Y-m-d", time());
		$d = new DateTime($date);
		$d->modify("-" . $options['days'] . " day");
		$date = $d->format("Y-m-d");
		unset($d);

		$this->_templateData['categories'] = array();

    if (!$options['hide_categories']) {
      if (($options['main_categories']) && ($category_id == 0))  {
        $results = $this->model_catalog_latest->getMainCategories($date);
      } else {
        $results = $this->model_catalog_category->getCategories($category_id);
      }

      foreach ($results as $result) {
        $filter_data = array(
          'filter_category_id'  => $result['category_id'],
          'filter_sub_category' => true,
          'startdate'			      => $date . ' 00:00:00',
          'hide_outofstock'     => $options['hide_outofstock']
        );

        $product_total = $this->model_catalog_latest->getTotalProducts($filter_data);
        
        if ((isset($product_total) && ($product_total > 0))) {
          if (($options['main_categories']) && ($options['main_show_h1']) && (strlen($result['seo_h1']))) {
            $name_cat = $result['seo_h1'] . ($options['product_count'] ? ' (' . $product_total . ')' : '');
          } else {
            $name_cat = $result['name'] . ($options['product_count'] ? ' (' . $product_total . ')' : '');
          }
          if ($options['category_images'] && (version_compare(VERSION, '1.5.5', '>='))) {
            $thumb_cat = $this->model_tool_image->resize(($result['image']=='' ? 'no_image.jpg' : $result['image']), $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
          } else {
            $thumb_cat = false;
          }
          
          $this->_templateData['categories'][] = array(
            'name'  => $name_cat,
            'href'  => $this->url->link('product/latest'),
            'thumb' => $thumb_cat
          );
          
        }
      }
		}
    
		$this->_templateData['products'] = array();
		
		$filter_data = array(
			'filter_category_id' => $category_id, 
			'sort'               => $sort,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit,
			'startdate'			     => $date . ' 00:00:00',
      'hide_outofstock'    => $options['hide_outofstock']
		);
				
		$product_total = $this->model_catalog_latest->getTotalProducts($filter_data); 
		
		$results = $this->model_catalog_latest->getProducts($filter_data);
		
		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $options['image_width'],  $options['image_height']);
			} else {
        if (version_compare(VERSION, '2.0', '<')) {
          $image = $this->model_tool_image->resize('no_image.jpg', $options['image_width'],  $options['image_height']);          
        } else {
          $image = $this->model_tool_image->resize('no_image.png', $options['image_width'],  $options['image_height']);          
        }
				
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
							
			$this->_templateData['products'][] = array(
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'date_added'  => $result['date_added'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
				'price'       => $result['price'],
				'special'     => $special,
				'tax'         => $tax,
        'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'rating'      => $result['rating'],
				'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
        'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id'])
			);
		}
		
		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
						
		$this->_templateData['sorts'] = array();
		
		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_new_arrivals'),
			'value' => 'p.date_added-DESC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=p.date_added&order=DESC' . $url)
		);

		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=pd.name&order=ASC' . $url)
		);

		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=pd.name&order=DESC' . $url)
		);

		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'p.price-ASC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=p.price&order=ASC' . $url)
		); 

		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'p.price-DESC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=p.price&order=DESC' . $url)
		); 
		
		if ($this->config->get('config_review_status')) {
			$this->_templateData['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=rating&order=DESC' . $url)
			); 
			
			$this->_templateData['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=rating&order=ASC' . $url)
			);
		}
		
		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_model_asc'),
			'value' => 'p.model-ASC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=p.model&order=ASC' . $url)
		);

		$this->_templateData['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . '&sort=p.model&order=DESC' . $url)
		);
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$this->_templateData['limits'] = array();
		
		$this->_templateData['limits'][] = array(
			'text'  => $options['limit'],
			'value' => $options['limit'],
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&limit=' . $options['limit'])
		);
					
		$this->_templateData['limits'][] = array(
			'text'  => 25,
			'value' => 25,
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&limit=25')
		);
		
		$this->_templateData['limits'][] = array(
			'text'  => 50,
			'value' => 50,
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&limit=50')
		);

		$this->_templateData['limits'][] = array(
			'text'  => 75,
			'value' => 75,
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&limit=75')
		);
		
		$this->_templateData['limits'][] = array(
			'text'  => 100,
			'value' => 100,
			'href'  => $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&limit=100')
		);
					
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
		$pagination->url = $this->url->link('product/latest', 'lirpath=' . $req_path . $url . '&page={page}');
	
		$this->_templateData['pagination'] = $pagination->render();
    
    $this->_templateData['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

    // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
    if ($page == 1) {
        $this->document->addLink($this->url->link('product/latest', 'lirpath=' . $req_path, 'SSL'), 'canonical');
    } elseif ($page == 2) {
        $this->document->addLink($this->url->link('product/latest', 'lirpath=' . $req_path, 'SSL'), 'prev');
    } else {
        $this->document->addLink($this->url->link('product/latest', 'lirpath=' . $req_path . '&page='. ($page - 1), 'SSL'), 'prev');
    }

    if ($limit && ceil($product_total / $limit) > $page) {
        $this->document->addLink($this->url->link('product/latest', 'lirpath=' . $req_path . '&page='. ($page + 1), 'SSL'), 'next');
    }
    
    
	
		$this->_templateData['sort'] = $sort;
		$this->_templateData['order'] = $order;
		$this->_templateData['limit'] = $limit;
	
		$this->_templateData['continue'] = $this->url->link('common/home');

    if (version_compare(VERSION, '2.0', '<')) {
      $this->data = array_merge($this->data, $this->_templateData);
       
      if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/latest.tpl')) {
        $this->template = $this->config->get('config_template') . '/template/product/latest.tpl';
      } else {
        $this->template = 'default/template/product/latest.tpl';
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
    } else {
      $data = $this->_templateData;

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/latest.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/latest.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/latest.tpl', $data));
			}
    }

  }
}
?>