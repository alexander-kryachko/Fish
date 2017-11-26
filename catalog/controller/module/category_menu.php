<?php
class ControllerModuleCategoryMenu extends Controller {
	protected function index($setting) {
		static $module = 1;

		$this->language->load('module/category_menu');
		$this->document->addScript('catalog/view/javascript/jquery/category_menu/category-menu.js');
		$this->document->addScript('catalog/view/javascript/jquery/category_menu/jquery.menu-aim.js');

		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/category-menu.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/category-menu.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/category-menu.css');
		}

		if (!empty($setting['menu_title'][$this->config->get('config_language_id')])) {
			$this->data['heading_title'] = $setting['menu_title'][$this->config->get('config_language_id')];
		} else {
			$this->data['heading_title'] = $this->language->get('heading_title');
		}

		if (!empty($setting['title_status'][$this->config->get('config_language_id')])) {
			$this->data['title_status'] = $setting['title_status'][$this->config->get('config_language_id')];
		} else {
			$this->data['title_status'] = '';
		}

		if ($setting['position'] == 'column_right') {
			$this->data['position'] = $setting['position'];
		} else {
			$this->data['position'] = '';
		}

		if (isset($setting['style'])) {
			$this->data['style'] = $setting['style'];
		} else {
			$this->data['style'] = 'accordion';
		}

		if (isset($setting['toggle'])) {
			$this->data['toggle'] = $setting['toggle'];
		} else {
			$this->data['toggle'] = '';
		}

		if ($this->data['style'] == 'flyout') {
			$this->data['toggle'] = '';
		}

		if (isset($setting['image'])) {
			$this->data['image'] = $setting['image'];
		} else {
			$this->data['image'] = '';
		}

		if (!empty($setting['image_width'])) {
			$this->data['image_width'] = $setting['image_width'];
		} else {
			$this->data['image_width'] = '170';
		}

		if (!empty($setting['image_height'])) {
			$this->data['image_height'] = $setting['image_height'];
		} else {
			$this->data['image_height'] = '106';
		}

		if (isset($setting['icon'])) {
			$this->data['icon'] = $setting['icon'];
		} else {
			$this->data['icon'] = '';
		}

		if (!empty($setting['icon_width'])) {
			$this->data['icon_width'] = $setting['icon_width'];
		} else {
			$this->data['icon_width'] = '16';
		}

		if (!empty($setting['icon_height'])) {
			$this->data['icon_height'] = $setting['icon_height'];
		} else {
			$this->data['icon_height'] = '16';
		}

		if (isset($setting['category_selected'])) {
			$this->data['category_selected'] = $setting['category_selected'];
		} else {
			$this->data['category_selected'] = array();
		}

		if (isset($setting['featured_categories']) == 'featured') {
			$categories = $this->data['category_selected'];
		}

		if (isset($setting['manufacturer_selected'])) {
			$manufacturers = $setting['manufacturer_selected'];
		} else {
			$manufacturers = '';
		}

		if (isset($setting['information_selected'])) {
			$informations = $setting['information_selected'];
		} else {
			$informations = '';
		}

		if (isset($setting['custom_link'])) {
			$custom_links = $setting['custom_link'];
		} else {
			$custom_links = '';
		}

		if (!empty($setting['box_class'])) {
			$this->data['box_class'] = $setting['box_class'];
		} else {
			$this->data['box_class'] = 'box';
		}

		if (!empty($setting['tag'])) {
			$this->data['tag'] = $setting['tag'];
		} else {
			$this->data['tag'] = 'div';
		}

		if (!empty($setting['heading_class'])) {
			$this->data['heading_class'] = $setting['heading_class'];
		} else {
			$this->data['heading_class'] = 'box-heading';
		}

		if (!empty($setting['content_class'])) {
			$this->data['content_class'] = $setting['content_class'];
		} else {
			$this->data['content_class'] = 'box-content';
		}

		if (!isset($setting['store_id']) || !in_array($this->config->get('config_store_id'), $setting['store_id'])) {
			return;
		}

		if ($setting['layout_id'] == '3') {
			$featured_categories = explode('_', $this->request->get['path']);
			$featured_category = array_pop($featured_categories);
			if (!isset($setting['featured_cid']) || !in_array($featured_category, $setting['featured_cid'])) {
				return;
			}
		}

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$this->data['category_id'] = $parts[0];
		} else {
			$this->data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}

		if (isset($parts[2])) {
			$this->data['child2_id'] = $parts[2];
		} else {
			$this->data['child2_id'] = 0;
		}

		if (isset($parts[3])) {
			$this->data['child3_id'] = $parts[3];
		} else {
			$this->data['child3_id'] = 0;
		}

		if (isset($parts[4])) {
			$this->data['child4_id'] = $parts[4];
		} else {
			$this->data['child4_id'] = 0;
		}

		$this->load->model('catalog/category_menu');
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/information');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		if (isset($this->request->get['information_id'])) {
			$this->data['information_id'] = (int)$this->request->get['information_id'];
		} else {
			$this->data['information_id'] = 0;
		}

		$this->data['informations'] = array();

		if($informations) {
			foreach ($informations as $information_id) {
				$information_info = $this->model_catalog_information->getInformation($information_id);

				if($information_info) {
					$this->data['informations'][] = array(
						'information_id'  => $information_info['information_id'],
						'title'           => $information_info['title'],
						'href'            => $this->url->link('information/information', 'information_id=' .  $information_info['information_id'])
						);
				}
			}
		}

		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['manufacturer_id'] = (int)$this->request->get['manufacturer_id'];
		} else {
			$this->data['manufacturer_id'] = 0;
		}

		$this->data['manufacturers'] = array();

		if($manufacturers) {
			foreach ($manufacturers as $manufacturer_id) {
				$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

				if($manufacturer_info) {
					$this->data['manufacturers'][] = array(
						'manufacturer_id'  => $manufacturer_info['manufacturer_id'],
						'name'             => $manufacturer_info['name'],
						'href'             => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer_info['manufacturer_id'])
						);
				}
			}
		}

		$this->data['custom_links'] = array();

		if($custom_links) {
			foreach ($custom_links as $custom_link) {

				$this->data['custom_links'][] = array(
					'link_title'  => $custom_link['link_title'][$this->config->get('config_language_id')],
					'href'        => $custom_link['href'][$this->config->get('config_language_id')],
					'ciid'        => $custom_link['ciid'],
					'thumb'       => $this->model_tool_image->resize($custom_link['icon'], $this->data['icon_width'], $this->data['icon_height']),
					'sort_order'  => $custom_link['sort_order']
					);

				$sort_order = array();

				foreach ($this->data['custom_links'] as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $this->data['custom_links']);
			}
		}

		$this->data['categories'] = array();

		if ($setting['featured_categories'] == 'all') {
			$categories = $this->model_catalog_category_menu->getMenuCategories(0);

			foreach ($categories as $category) {
				$children_data = array();
				$children = $this->model_catalog_category_menu->getMenuCategories($category['category_id']);

				foreach ($children as $child) {
					$children2_data = array();
					$children2 = $this->model_catalog_category_menu->getMenuCategories($child['category_id']);

					foreach ($children2 as $child2) {
						$children3_data = array();
						$children3 = $this->model_catalog_category_menu->getMenuCategories($child2['category_id']);

						foreach ($children3 as $child3) {
							$children4_data = array();
							$children4 = $this->model_catalog_category_menu->getMenuCategories($child3['category_id']);

							foreach ($children4 as $child4) {
								$data = array(
									'filter_category_id'  => $child4['category_id'],
									'filter_sub_category' => true
									);

								$children4_data[] = array(
									'category_id'  => $child4['category_id'],
									'name'         => $child4['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
									'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id'] . '_' . $child3['category_id'] . '_' . $child4['category_id']),
									'active'       => in_array($child4['category_id'], $parts),
									'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'] . '-' . $child3['category_id'] . '-' . $child4['category_id']
									);
							}

							$data = array(
								'filter_category_id'  => $child3['category_id'],
								'filter_sub_category' => true
								);

							$children3_data[] = array(
								'category_id'  => $child3['category_id'],
								'name'         => $child3['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
								'child4_id'    => $children4_data,
								'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'] . '-' . $child3['category_id'],
								'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id'] . '_' . $child3['category_id']),
								'active'       => in_array($child3['category_id'], $parts),
								'thumb'        => $this->model_tool_image->resize($child3['image'], $this->data['image_width'], $this->data['image_height'])
								);
						}

						$data = array(
							'filter_category_id'  => $child2['category_id'],
							'filter_sub_category' => true
							);

						$children2_data[] = array(
							'category_id'  => $child2['category_id'],
							'name'         => $child2['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
							'child3_id'    => $children3_data,
							'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'],
							'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id']),
							'active'       => in_array($child2['category_id'], $parts),
							'thumb'        => $this->model_tool_image->resize($child2['image'], $this->data['image_width'], $this->data['image_height'])
							);
					}

					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
						);

					$children_data[] = array(
						'category_id'  => $child['category_id'],
						'name'         => $child['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
						'child2_id'    => $children2_data,
						'cid'          => $category['category_id'] . '-' . $child['category_id'],
						'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'active'       => in_array($child['category_id'], $parts),
						'thumb'        => $this->model_tool_image->resize($child['image'], $this->data['image_width'], $this->data['image_height'])
						);
				}

				$data = array(
					'filter_category_id'  => $category['category_id'],
					'filter_sub_category' => true
					);

				$this->data['categories'][] = array(
					'category_id'  => $category['category_id'],
					'name'         => $category['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
					'children'     => $children_data,
					'href'         => $this->url->link('product/category', 'path=' . $category['category_id']),
					'active'       => in_array($category['category_id'], $parts),
					'thumb'        => $this->model_tool_image->resize($category['image'], $this->data['image_width'], $this->data['image_height']),
					'icon_thumb'   => $this->model_tool_image->resize($category['menu_icon'], $this->data['icon_width'], $this->data['icon_height'])
					);
			}

		} else {

			foreach ($categories as $category_id) {
				$category = $this->model_catalog_category_menu->getMenuCategory($category_id);

				if ($category) {
					$children_data = array();
					$children = $this->model_catalog_category_menu->getMenuCategories($category['category_id']);

					foreach ($children as $child) {
						$children2_data = array();
						$children2 = $this->model_catalog_category_menu->getMenuCategories($child['category_id']);

						foreach ($children2 as $child2) {
							$children3_data = array();
							$children3 = $this->model_catalog_category_menu->getMenuCategories($child2['category_id']);

							foreach ($children3 as $child3) {
								$children4_data = array();
								$children4 = $this->model_catalog_category_menu->getMenuCategories($child3['category_id']);

								foreach ($children4 as $child4) {
									$data = array(
										'filter_category_id'  => $child4['category_id'],
										'filter_sub_category' => true
										);

									$children4_data[] = array(
										'category_id'  => $child4['category_id'],
										'name'         => $child4['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
										'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id'] . '_' . $child3['category_id'] . '_' . $child4['category_id']),
										'active'       => in_array($child4['category_id'], $parts),
										'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'] . '-' . $child3['category_id'] . '-' . $child4['category_id']
										);
								}

								$data = array(
									'filter_category_id'  => $child3['category_id'],
									'filter_sub_category' => true
									);

								$children3_data[] = array(
									'category_id'  => $child3['category_id'],
									'name'         => $child3['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
									'child4_id'    => $children4_data,
									'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'] . '-' . $child3['category_id'],
									'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id'] . '_' . $child3['category_id']),
									'active'       => in_array($child3['category_id'], $parts),
									'thumb'        => $this->model_tool_image->resize($child3['image'], $this->data['image_width'], $this->data['image_height'])
									);
							}

							$data = array(
								'filter_category_id'  => $child2['category_id'],
								'filter_sub_category' => true
								);

							$children2_data[] = array(
								'category_id'  => $child2['category_id'],
								'name'         => $child2['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
								'child3_id'    => $children3_data,
								'cid'          => $category['category_id'] . '-' . $child['category_id'] . '-' . $child2['category_id'],
								'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id']),
								'active'       => in_array($child2['category_id'], $parts),
								'thumb'        => $this->model_tool_image->resize($child2['image'], $this->data['image_width'], $this->data['image_height'])
								);
						}

						$data = array(
							'filter_category_id'  => $child['category_id'],
							'filter_sub_category' => true
							);

						$children_data[] = array(
							'category_id'  => $child['category_id'],
							'name'         => $child['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
							'child2_id'    => $children2_data,
							'cid'          => $category['category_id'] . '-' . $child['category_id'],
							'href'         => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
							'active'       => in_array($child['category_id'], $parts),
							'thumb'        => $this->model_tool_image->resize($child['image'], $this->data['image_width'], $this->data['image_height'])
							);
					}

					$data = array(
						'filter_category_id'  => $category['category_id'],
						'filter_sub_category' => true
						);

					$this->data['categories'][] = array(
						'category_id'  => $category['category_id'],
						'name'         => $category['name'] . ($this->config->get('config_product_count') && $setting['count'] ? ' (' . $this->model_catalog_product->getTotalProducts($data) . ')' : ''),
						'children'     => $children_data,
						'href'         => $this->url->link('product/category', 'path=' . $category['category_id']),
						'active'       => in_array($category['category_id'], $parts),
						'sort_order'   => $category['sort_order'],
						'thumb'        => $this->model_tool_image->resize($category['image'], $this->data['image_width'], $this->data['image_height']),
						'icon_thumb'   => $this->model_tool_image->resize($category['menu_icon'], $this->data['icon_width'], $this->data['icon_height'])
						);
				}

				$sort_order = array();

				foreach ($this->data['categories'] as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $this->data['categories']);
			}
		}

		$this->data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category_menu.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/category_menu.tpl';
		} else {
			$this->template = 'default/template/module/category_menu.tpl';
		}

		$this->render();
	}
}
?>