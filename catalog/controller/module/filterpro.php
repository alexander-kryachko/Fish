<?php
class ControllerModuleFilterPro extends Controller {

	public function check(){
		$this->load->model('module/filterpro');
		$this->load->model('catalog/product');
		$this->model_module_filterpro->check();
	}
	protected function index($setting) {
		if($setting['type'] == 1) {
			$this->language->load('product/filter');
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');

			$sort = 'p.sort_order';
			$order = 'ASC';
			$limit = $this->config->get('config_catalog_limit');

			$url = '';

			if(isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['sorts'] = array();

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href' => $this->url->link('product/filter', 'sort=p.sort_order&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href' => $this->url->link('product/filter', 'sort=pd.name&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href' => $this->url->link('product/filter', 'sort=pd.name&order=DESC' . $url)
			);

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href' => $this->url->link('product/filter', 'sort=p.price&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href' => $this->url->link('product/filter', 'sort=p.price&order=DESC' . $url)
			);

			if($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text' => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href' => $this->url->link('product/filter', 'sort=rating&order=DESC' . $url)
				);

				$this->data['sorts'][] = array(
					'text' => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href' => $this->url->link('product/filter', 'sort=rating&order=ASC' . $url)
				);
			}

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href' => $this->url->link('product/filter', 'sort=p.model&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text' => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href' => $this->url->link('product/filter', 'sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if(isset($this->request->get['sort'])) {
				$url .= 'sort=' . $this->request->get['sort'];
			}

			if(isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->data['limits'] = array();

			$this->data['limits'][] = array(
				'text' => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href' => $this->url->link('product/filter', $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);

			$this->data['limits'][] = array(
				'text' => 25,
				'value' => 25,
				'href' => $this->url->link('product/filter', $url . '&limit=25')
			);

			$this->data['limits'][] = array(
				'text' => 50,
				'value' => 50,
				'href' => $this->url->link('product/filter', $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text' => 75,
				'value' => 75,
				'href' => $this->url->link('product/filter', $url . '&limit=75')
			);

			$this->data['limits'][] = array(
				'text' => 100,
				'value' => 100,
				'href' => $this->url->link('product/filter', $url . '&limit=100')
			);


			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;

			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

			$this->data += $this->language->load('product/category');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));

			if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro_container.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/filterpro_container.tpl';
			} else {
				$this->template = 'default/template/module/filterpro_container.tpl';
			}
		} else {
			$this->language->load('module/filterpro');

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

			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['page'] = $page;
			$this->data['limit'] = $limit;

			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['text_price_range'] = $this->language->get('text_price_range');
			$this->data['text_manufacturers'] = $this->language->get('text_manufacturers');
			$this->data['text_tags'] = $this->language->get('text_tags');
			$this->data['text_categories'] = $this->language->get('text_categories');
			$this->data['text_attributes'] = $this->language->get('text_attributes');
			$this->data['text_all'] = $this->language->get('text_all');
			$this->data['clear_filter'] = $this->language->get('clear_filter');
			$this->data['text_instock'] = $this->language->get('text_instock');
			$this->data['text_filer_special'] = $this->language->get('text_filer_special');
			$this->data['text_filer_news'] = $this->language->get('text_filer_news');
			$this->data['text_show_filer_special'] = $this->language->get('text_show_filer_special');

			$this->data['pds_sku'] = $this->language->get('pds_sku');
			$this->data['pds_upc'] = $this->language->get('pds_upc');
			$this->data['pds_location'] = $this->language->get('pds_location');
			$this->data['pds_model'] = $this->language->get('pds_model');
			$this->data['pds_brand'] = $this->language->get('pds_brand');
			$this->data['pds_stock'] = $this->language->get('pds_stock');
			$this->data['symbol_right'] = $this->currency->getSymbolRight();
			$this->data['symbol_left'] = $this->currency->getSymbolLeft();

			$this->data['setting'] = $setting;

			if(VERSION == '1.5.0') {
				$filterpro_setting = unserialize($this->config->get('filterpro_setting'));
			} else {
				$filterpro_setting = $this->config->get('filterpro_setting');
			}

			$this->data['text_show_filer_news'] = sprintf($this->language->get('text_show_filer_news'), $filterpro_setting['news_days']);

			$this->data['heading_title'] = $filterpro_setting['filterpro_name'];

			if(!isset($this->request->get['route'])){
				$route = "common/home";
			} else{
				$route = $this->request->get['route'];
			}

			$is_special = $route == "product/special";
			$is_bydate = $route == "product/productsbydate";

			$category_id = false;
			$this->data['path'] = "";
			if(isset($this->request->get['path'])) {
				$this->data['path'] = $this->request->get['path'];
				$parts = explode('_', (string)$this->request->get['path']);
				$category_id = array_pop($parts);
			}

			$manufacturer_id = false;
			if(isset($this->request->get['manufacturer_id'])) {
				$manufacturer_id = $this->request->get['manufacturer_id'];
				$data = array(
					'filter_manufacturer_id' => $this->request->get['manufacturer_id']
				);
			} else {
				$data = array(
					'filter_category_id' => $category_id,
					'filter_sub_category' => isset($filterpro_setting['subcategories'])
				);
			}
			$data['start'] = 0;
			$data['limit'] = 1;

			$this->load->model('catalog/product');
			$this->load->model('tool/image');

			$product_total = $this->model_catalog_product->getTotalProducts($data);

			if($product_total == 0) {
				return;
			}

			$this->data['category_id'] = $category_id;

			$data = array('category_id' => $category_id, 'manufacturer_id' => $manufacturer_id, 'special' => $is_special, 'by_date' => $is_bydate, 'instock' => false);

			$this->load->model('module/filterpro');

			$this->data['manufacturers'] = false;
			if(isset($this->request->get['manufacturer_id'])) {
				$this->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
			} else {
				if($filterpro_setting['display_manufacturer'] != 'none') {
					$this->data['manufacturers'] = $this->model_module_filterpro->getManufacturers($data);
					$this->data['display_manufacturer'] = $filterpro_setting['display_manufacturer'];
					$this->data['expanded_manufacturer'] = isset($filterpro_setting['expanded_manufacturer']) ? 1 : 0;
				}
			}
			$this->data['options'] = array();
			if(isset($filterpro_setting['display_option'])) {
				foreach($filterpro_setting['display_option'] as $display_option) {
					if($display_option != "none") {
						$this->data['options'] = $this->model_module_filterpro->getOptions($data);
						break;
					}
				}
			}

			foreach($this->data['options'] as $i => $option) {
				if(!isset($filterpro_setting['display_option'][$option['option_id']])) {
					$filterpro_setting['display_option'][$option['option_id']] = 'none';
				}
				$display_option = $filterpro_setting['display_option'][$option['option_id']];
				if($display_option != 'none') {
					$this->data['options'][$i]['display'] = $display_option;
					$this->data['options'][$i]['expanded'] = isset($filterpro_setting['expanded_option_' . $option['option_id']]) ? 1 : 0;
					foreach($this->data['options'][$i]['option_values'] as $j => $option_value) {
						$this->data['options'][$i]['option_values'][$j]['thumb'] = $this->model_tool_image->resize($this->data['options'][$i]['option_values'][$j]['image'], (int)$filterpro_setting['option_images_w'], (int)$filterpro_setting['option_images_h']);
					}
				} else {
					unset($this->data['options'][$i]);
				}
			}
			$this->data['tags'] = array();

			if(version_compare(VERSION, "1.5.4") <= 0 && $filterpro_setting['display_tags'] != 'none') {
				$this->data['tags'] = $this->model_module_filterpro->getTags($data);
				$this->data['expanded_tags'] = isset($filterpro_setting['expanded_tags']) ? 1 : 0;
			}

			$this->data['categories'] = false;
			if($filterpro_setting['display_categories'] != 'none' && $route != "product/search") {
				//$this->data['categories'] = $this->model_module_filterpro->getSubCategories($data);
				$this->data['categories'] = $this->model_catalog_product->getFilterCategories($data);

				$this->data['expanded_categories'] = isset($filterpro_setting['expanded_categories']) ? 1 : 0;
			}


			$this->data['attributes'] = array();
			if(isset($filterpro_setting['display_attribute'])) {
				foreach($filterpro_setting['display_attribute'] as $display_attribute) {
					if($display_attribute != "none") {
						$this->data['attributes'] = $this->model_module_filterpro->getAttributes($data);
						break;
					}
				}
			}

//			$multi_sort = array(
//				2 => array("1", "2", "3", "4"),
//				3 => array("100мгц", "200мгц"),
//				4 => array("8гб", "16гб")
//			);
			foreach($this->data['attributes'] as $j => $attribute_group) {
				foreach($attribute_group['attribute_values'] as $attribute_id => $attribute) {
					if(!isset($filterpro_setting['display_attribute'][$attribute_id])) {
						$filterpro_setting['display_attribute'][$attribute_id] = 'none';
//					} else {
//						if(in_array($attribute_id, array_keys($multi_sort))) {
//							$ssort = array();
//							foreach($this->data['attributes'][$j]['attribute_values'][$attribute_id]['values'] as $i => $value) {
//								$ssort[$i] = in_array($value['a'], $multi_sort[$attribute_id]) ? array_search($value['a'], $multi_sort[$attribute_id]) : (int)$value['a'];
//							}
//							array_multisort($ssort, SORT_ASC, $this->data['attributes'][$j]['attribute_values'][$attribute_id]['values']);
//						}
					}
					$display_attribute = $filterpro_setting['display_attribute'][$attribute_id];
					if($display_attribute != 'none') {
						if($display_attribute == 'slider') {
							$values = $this->data['attributes'][$j]['attribute_values'][$attribute_id]['values'];
							$first = $values[0];
							$this->data['attributes'][$j]['attribute_values'][$attribute_id]['suffix'] = preg_replace("/^[0-9]*(\\.[0-9]*)?/", '', $first);
							$values = array_map('floatVal', $values);
							$values = array_unique($values);
							sort($values);
							$this->data['attributes'][$j]['attribute_values'][$attribute_id]['values'] = $values;
						}
						$this->data['attributes'][$j]['attribute_values'][$attribute_id]['display'] = $display_attribute;
						$this->data['attributes'][$j]['attribute_values'][$attribute_id]['expanded'] = isset($filterpro_setting['expanded_attribute_' . $attribute_id]) ? 1 : 0;
					} else {
						unset($this->data['attributes'][$j]['attribute_values'][$attribute_id]);
						if(!$this->data['attributes'][$j]['attribute_values']) {
							unset($this->data['attributes'][$j]);
						}
					}
				}
			}

			$this->data['filter_groups'] = array();
			$this->load->model('catalog/category');

			$this->data['option_main_checkbox'] = isset($filterpro_setting['option_main_checkbox']) ? 1 : 0;

			if(version_compare(VERSION, "1.5.5") >= 0 && $filterpro_setting['display_filter'] != 'none') {
				$this->data['display_filter'] = $filterpro_setting['display_filter'];
				$this->data['expanded_filter'] = isset($filterpro_setting['expanded_filter']) ? 1 : 0;

				$filter_groups = $this->model_catalog_category->getCategoryFilters($category_id);

				if($filter_groups) {
					foreach($filter_groups as $filter_group) {
						$filter_data = array();

						foreach($filter_group['filter'] as $filter) {
							$filter_data[] = array(
								'filter_id' => $filter['filter_id'],
								'name' => $filter['name']
							);
						}

						$this->data['filter_groups'][] = array(
							'filter_group_id' => $filter_group['filter_group_id'],
							'name' => $filter_group['name'],
							'filter' => $filter_data
						);
					}
				}
			}

			$this->data['price_slider'] = $filterpro_setting['price_slider'];
			$this->data['attr_group'] = $filterpro_setting['attr_group'];
			$this->data['filer_special'] = isset($filterpro_setting['filer_special']);
			$this->data['filer_news'] = isset($filterpro_setting['filer_news']);


			$this->data['min_price'] = false;
			$this->data['max_price'] = false;
			if ($this->data['price_slider']){
				$priceLimits = $this->model_module_filterpro->getPriceLimits(array(
					'category_id' => $category_id,
					'manufacturer_id' => $manufacturer_id,
					'special' => $is_special,
					'by_date' => $is_bydate,
					'instock' => false,
				));
				$coefficient = $this->currency->getValue($this->config->get('config_currency'));

				$k = 1;
				if((float)$filterpro_setting['tax'] > 0) {
					$k = 1 + (float)$filterpro_setting['tax'] / 100;
				}
				$this->data['min_price'] = floor($this->currency->convert($priceLimits['min_price']*$coefficient * $k, $this->config->get('config_currency'), $this->currency->getCode()));
				$this->data['max_price'] = ceil($this->currency->convert($priceLimits['max_price']*$coefficient * $k, $this->config->get('config_currency'), $this->currency->getCode()));
			}

			$manufacturer = false;
			if(isset($this->request->get['manufacturer_id'])) {
				$manufacturer = array($this->request->get['manufacturer_id']);
			}

			$categories = false;
			if($category_id) {
				$categories = array($category_id);
			}
			$arr_data = array(
					'instock' => false, 'option_value' => false, 'manufacturer' => $manufacturer, 'attribute_value' => false,
					'tags' => false, 'categories' => $categories, 'category_id' => $category_id, 'attr_slider' => false, 'filter' => false, 'min_price' => 0, 'max_price' => 0, 'start' => 0,
					'limit' => 1, 'sort' => false, 'order' => false
			);

			if($this->data['filer_news']) {
				$news = $this->model_module_filterpro->getProducts($arr_data + array('filer_news' => true, 'limit' => 1));
				$this->data['filer_news'] = count($news) > 0;
			}

			if($this->data['filer_special']) {
				$special = $this->model_module_filterpro->getProducts($arr_data + array('special' => true, 'filer_news' => false, 'limit' => 1));
				$this->data['filer_special'] = count($special) > 0;
			}

			$this->data['instock_checked'] = isset($filterpro_setting['instock_checked']) ? 1 : 0;
			$this->data['instock_visible'] = isset($filterpro_setting['instock_visible']) ? 1 : 0;

			if(!$this->data['tags'] && !$this->data['categories'] && !$this->data['options']
					&& !$this->data['manufacturers'] && !$this->data['attributes'] && !$this->data['max_price']
			&& !$this->data['instock_checked']) {
				return;
			}

			$theme_name = "default";
			if(isset($filterpro_setting['theme_name'])) {
				$theme_name = $filterpro_setting['theme_name'];
			}

			$this->document->addScript('catalog/view/javascript/jquery/jquery.tmpl.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/jquery.deserialize.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/jquery.loadmask.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/jquery.lazyload.min.js');
			if(isset($filterpro_setting['enable_touch_screen'])) {
				$this->document->addScript('catalog/view/javascript/jquery/jquery.ui.touch-punch.min.js');
			}
			$this->document->addScript('catalog/view/javascript/filterpro.min.js');

			if(isset($filterpro_setting['jscrollpane'])) {
				$this->document->addScript('catalog/view/javascript/jquery/jscrollpane/jquery.mousewheel.js');
				$this->document->addScript('catalog/view/javascript/jquery/jscrollpane/jquery.jscrollpane.min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/jscrollpane/jquery.jscrollpane.css');
			}

			if(isset($filterpro_setting['enable_endless_scroller'])) {
				$this->document->addScript('catalog/view/javascript/jquery/jquery.endlessScroll.js');
			}

			if($theme_name == "mega") {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/filterpro-mega.css');
				$this->document->addScript('catalog/view/javascript/jquery/qtip2/mega/jquery.qtip.min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/qtip2/mega/jquery.qtip.min.css');
			} else {
				if($theme_name == "slider") {
					if($setting["position"] == "content_top") {
						$this->document->addStyle('catalog/view/theme/default/stylesheet/filterpro-slide-h.css');
					} else {
						$this->document->addStyle('catalog/view/theme/default/stylesheet/filterpro-slide.css');
					}
				} else {
					$this->document->addStyle('catalog/view/theme/default/stylesheet/filterpro.css');
				}
				$this->document->addScript('catalog/view/javascript/jquery/qtip2/jquery.qtip.min.js');
				$this->document->addStyle('catalog/view/javascript/jquery/qtip2/jquery.qtip.min.css');
			}
			$this->document->addStyle('catalog/view/theme/default/stylesheet/jquery.loadmask.css');
			if($this->config->get('config_template') == 'shoppica2') {
				$this->document->addStyle('catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css');
			}

			$filter_hash = "";
			if(isset($this->session->data['fp_data'])) {
				$filter_hash = http_build_query($this->session->data['fp_data']);
				unset($this->session->data['fp_data']);
			}
            if(isset($this->request->get['filter_id'])) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filterpro_seo WHERE `url`='" . $this->db->escape("filter_id=" . $this->request->get['filter_id']) . "'");
                if ($query->num_rows){
                    $filterpro_seo = unserialize($query->row['data']);
                    $filter_hash = $filterpro_seo['url'];
                }
            }

			$this->data['filterpro_container'] = $filterpro_setting['filterpro_container'];
			$this->data['filterpro_afterload'] = html_entity_decode($filterpro_setting['filterpro_afterload'], ENT_QUOTES, 'UTF-8');
			$this->data['filterOptions'] = json_encode(array(
									'container'		=> $filterpro_setting['filterpro_container'],
									'filter_redirect'	=> isset($this->request->get['filter_redirect'])?$this->request->get['filter_redirect']:null,
									'filter_hash'		=> $filter_hash,
									'window_hash'		=> !isset($filterpro_setting['hide_window_hash']),
									'hide_count'		=> isset($filterpro_setting['hide_count']),
									'hide_options'		=> isset($filterpro_setting['hide_options']),
									'disable_mask'		=> isset($filterpro_setting['disable_mask']),
									'endless_scroller'	=> isset($filterpro_setting['enable_endless_scroller']),
									'noajax'			=> isset($filterpro_setting['no_ajax']),
									'filter_onload'		=> isset($filterpro_setting['filter_onload']),
									'filer_selected'	=> isset($filterpro_setting['filer_selected']),
									'search'			=> $route == "product/search",
													   ));
			$this->data['noajax'] = isset($filterpro_setting['no_ajax']);
            $this->data['filter_redirect'] = isset($this->request->get['filter_redirect']) ? $this->request->get['filter_redirect'] : "";

			if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/filterpro.tpl';
			} else {
				$this->template = 'default/template/module/filterpro.tpl';
			}
		}
		$this->render();
	}

	public function getProducts() {
		
		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			return;
		}
		$this->load->model('module/filterpro');
		$this->load->model('module/filterproCustom');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$getTotals = false;
		if(isset($this->request->post['getTotals']) && $this->request->post['getTotals']) {
			$getTotals = true;
		}

		list($filterpro_setting, $page, $limit, $manufacturer_id, $attribute_value, $option_value, $filter_value, $category_id, $data) = $this->model_module_filterpro->getData();

		$is_special = (isset($this->request->post['route']) && $this->request->post['route'] == "product/special") || isset($this->request->post['filer_special']);
		$is_bydate = isset($this->request->post['route']) && $this->request->post['route'] == "product/productsbydate";
		$data['special'] = $is_special;
		$data['by_date'] = $is_bydate;
		$data['filer_news'] = isset($this->request->post['filer_news']);

		$totals_manufacturers = array();
		if ($getTotals && $filterpro_setting['display_manufacturer'] != 'none' && !isset($this->request->post['manufacturer_id'])){
			$totals_manufacturers = $this->model_module_filterpro->getTotalManufacturers($data);
		}

		$totals_options = array();
		$totals_attributes = array();
		$totals_categories = array();
		$totals_tags = array();
		$total_filters = array();

		if($getTotals) {
			$totals_options = array();
			if(isset($filterpro_setting['display_option'])) {
				foreach($filterpro_setting['display_option'] as $display_option) {
					if($display_option != "none") {
						$totals_options = $this->model_module_filterpro->getTotalOptions($data);
						break;
					}
				}
			}


			if(!isset($filterpro_setting['option_total_simple']) && $filterpro_setting['option_mode'] == 'and') {
				if($option_value && $totals_options) {
					foreach($option_value as $option_id => $option_value_id) {
						foreach($totals_options as $i => $totals_option) {
							if($totals_option['o'] == $option_id) {
								unset($totals_options[$i]);
							}
						}
						$temp_data = $data;
						unset($temp_data['option_value'][$option_id]);
						foreach($this->model_module_filterpro->getTotalOptions($temp_data) as $option) {
							if($option['o'] == $option_id) {
								$totals_options[] = $option;
							}
						}
					}
				}
			}

			$totals_attributes = array();
			if(isset($filterpro_setting['display_attribute'])) {
				foreach($filterpro_setting['display_attribute'] as $display_attribute) {
					if($display_attribute != "none") {
						$totals_attributes = $this->model_module_filterpro->getTotalAttributes($data);
						break;
					}
				}
			}

			$totals_tags = array();

			if(version_compare(VERSION, "1.5.4") <= 0 && $filterpro_setting['display_tags'] != 'none') {
				$totals_tags = $this->model_module_filterpro->getTotalTags($data);
			}

			$totals_tags = false;
			$totals_categories = array();
			if($filterpro_setting['display_categories'] != 'none') {
				$totals_categories = $this->model_module_filterpro->getTotalCategories($data, $category_id);
			}

			if(version_compare(VERSION, "1.5.5") >= 0 && $filterpro_setting['display_filter'] != 'none') {
				$total_filters = $this->model_module_filterpro->getTotalFilters($data);
				if($filter_value) {
					foreach($filter_value as $filter_group_id => $filter_value_id) {
						foreach($total_filters as $i => $totals_filter) {
							if($totals_filter['g'] == $filter_group_id) {
								unset($total_filters[$i]);
							}
						}
						$temp_data = $data;
						unset($temp_data['filter'][$filter_group_id]);

						foreach($this->model_module_filterpro->getTotalFilters($temp_data) as $filter) {

							if($filter['g'] == $filter_group_id) {
								$total_filters[] = $filter;
							}
						}
					}
				}
			}
		}

		$min_price = false;
		$max_price = false;


		$this->request->get['path'] = isset($this->request->post['path']) ? $this->request->post['path'] : '';

		if(isset($filterpro_setting['no_ajax'])) {
			$result_html = "";
			$pagination = "";
			$product_total = 1;
		} else {
			$results = $this->model_module_filterpro->getProducts($data);

            $product_total = $this->model_module_filterpro->getTotalProducts($data);

            $result_html = $this->getHtmlProducts($results, $product_total, $is_special);

            $pagination = new Pagination();
            $pagination->total = $product_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->text = $this->language->get('text_pagination');


            if (isset($this->request->post['manufacturer_id'])) {
                $pagination->url = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->post['manufacturer_id'] . '&page={page}');
            } else {
                $pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&page={page}');
            }

            $pagination = $pagination->render();
		}
		$k = 1;
		if((float)$filterpro_setting['tax'] > 0) {
			$k = 1 + (float)$filterpro_setting['tax'] / 100;
		}
		$min_price = $this->currency->convert($min_price * $k, $this->config->get('config_currency'), $this->currency->getCode());
		$max_price = $this->currency->convert($max_price * $k, $this->config->get('config_currency'), $this->currency->getCode());


		$json = json_encode(array('result_html' => mb_convert_encoding($result_html,'UTF-8','UTF-8'), 'min_price' => $min_price, 'max_price' => $max_price, 'pagination' => $pagination,
								 'totals_data' =>
								 $getTotals ?
										 array(
											 'product_total' => $product_total,
											 'manufacturers' => $totals_manufacturers,
											 'options' => $totals_options,
											 'attributes' => $totals_attributes,
											 'filters' => $total_filters,
											 'categories' => $totals_categories,
											 'tags' => $totals_tags)
										 : false));
		$this->response->setOutput($json);
	}


	private function getHtmlProducts($results, $product_total, $is_special) {

		$this->data += $this->language->load('product/category');

		$url = '';

		$this->data['use_lazyload'] = isset($filterpro_setting['use_lazyload']) ? 1 : 0;

		$this->data['products'] = array();
$this->load->model('catalog/set');
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

				$special_percent = '';

                if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					$special_percent_out = round(100 - ($result['special']*100/$result['price']));
					if($special_percent_out != 100){
						$special_percent = $special_percent_out;
					}
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
					'special_percent' 	 => $special_percent,
'soldlabel'   => $this->config->get('config_display_availableproduct') ?  $soldlabel : false,
					'popularlabel'=> $this->config->get('config_display_popularproduct') ?  $popularlabel : false,
					'newlabel'    => $this->config->get('config_display_newproduct') ?  $newlabel : false,
					'speciallabel'=> $this->config->get('config_display_specialsproduct') ?  $speciallabel : false,
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
			

		if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro_list.tpl') &&
		   file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro_grid.tpl')
		) {
			$this->template = $this->config->get('config_template') . '/template/module/filterpro_list.tpl';
			$return['list'] = $this->render();
			$this->template = $this->config->get('config_template') . '/template/module/filterpro_grid.tpl';
			$return['grid'] = $this->render();
			return $return;
		} elseif(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro_products.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/filterpro_products.tpl';
		} else {
			$this->template = 'default/template/module/filterpro_products.tpl';
		}

		if($is_special){
			$this->template = $this->config->get('config_template') . '/template/module/filterpro_products_special.tpl';
		}

		return $this->render();
	}
}

?>