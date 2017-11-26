<?php
class ControllerModuleCustomMenu extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('module/custom_menu');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		 
		$this->load->model('module/custom_menu');

		$this->getList();
	}

	public function insert() {
		$this->language->load('module/custom_menu');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('module/custom_menu');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_module_custom_menu->addCustomMenu($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

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
			
			$this->redirect($this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('module/custom_menu');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('module/custom_menu');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_module_custom_menu->editCustomMenu($this->request->get['menu_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

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
			
			$this->redirect($this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
 
	public function delete() {
		$this->language->load('module/custom_menu');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('module/custom_menu');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_id) {
				$this->model_module_custom_menu->deleteCustomMenu($menu_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

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
			
			$this->redirect($this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			
			if ($this->request->post['apply']) {
				$url = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'], 'SSL');
			} else {
				$url = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
			}
			
			unset($this->request->post['apply']);
			
			$this->model_setting_setting->editSetting('custom_menu', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($url);
		}
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
	
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'id.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
		
		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['entry_head'] = $this->language->get('entry_head');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_style_template'] = $this->language->get('text_style_template');
		$this->data['text_style_module'] = $this->language->get('text_style_module');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_header'] = $this->language->get('text_header');
		$this->data['entry_style'] = $this->language->get('entry_style');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['text_status'] = $this->language->get('text_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_apply'] = $this->language->get('button_apply');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		
		$this->data['action_mod'] = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'], 'SSL');	
		$this->data['cancel_mod'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
							
		$this->data['insert'] = $this->url->link('module/custom_menu/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('module/custom_menu/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['custom_menus'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$headermenu_total = $this->model_module_custom_menu->getTotalCustomMenu();
	
		$results = $this->model_module_custom_menu->getCustomMenu($data);
 
    	foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('module/custom_menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $result['menu_id'] . $url, 'SSL')
			);
						
			$this->data['custom_menus'][] = array(
				'menu_id' => $result['menu_id'],
				'name'          => $result['name'],
				'parent_id'          => $result['parent_id'],
				'link'          => $result['link'],
				'sort_order'          => $result['sort_order'],
				'status'          => $result['status'],
				'selected'       => isset($this->request->post['selected']) && in_array($result['menu_id'], $this->request->post['selected']),
				'action'         => $action
			);
		}	
		
		$this->data['custom_menus1'] = array();		
	
		$results = $this->model_module_custom_menu->getCustomMenu2();
 
    	foreach ($results as $result) {
						
			$this->data['custom_menus1'][] = array(
				'menu_id' => $result['menu_id'],
				'name'          => $result['name'],
				'parent_id'          => $result['parent_id'],
				'sort_order'          => $result['sort_order'],
			);
		}
	
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_title'] = $this->language->get('column_title');
		$this->data['column_link'] = $this->language->get('column_link');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_title'] = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . '&sort=id.name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . '&sort=i.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $headermenu_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['custom_menu_module'])) {
			$this->data['modules'] = $this->request->post['custom_menu_module'];
		} elseif ($this->config->get('custom_menu_module')) { 
			$this->data['modules'] = $this->config->get('custom_menu_module');
		}
	
		$this->load->model('design/layout');
	
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/custom_menu_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_bottom'] = $this->language->get('entry_bottom');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['text_select'] = $this->language->get('text_select');
		
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		
		$this->data['entry_level2'] = $this->language->get('entry_level2');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_link'] = $this->language->get('entry_link');
		$this->data['entry_parent_id'] = $this->language->get('entry_parent_id');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['entry_column'] = $this->language->get('entry_column');
		$this->data['custom_menu'] = $this->model_module_custom_menu->getCustomMenu1();
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
    	
		$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}
		
	 	if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}
		
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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),     		
      		'separator' => false
   		);
		
		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		if (!isset($this->request->get['menu_id'])) {
			$this->data['action'] = $this->url->link('module/custom_menu/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('module/custom_menu/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $this->request->get['menu_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('module/custom_menu', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		$this->language->load('module/custom_menu');

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->get['menu_id'])) {
			$custom_menu_info=$this->model_module_custom_menu->getCustomMenuForm($this->request->get['menu_id']);
		}	
	
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['status'] = $custom_menu_info['status'];
		} else {
			$this->data['status'] = 1;
		}	
		
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['sort_order'] = $custom_menu_info['sort_order'];
		} else {
			$this->data['sort_order'] ='';
		}
				
		if (isset($this->request->post['menu_description'])) {
			$this->data['menu_description'] = $this->request->post['menu_description'];
		} elseif (isset($this->request->get['menu_id'])) {
			$this->data['menu_description'] =$this->model_module_custom_menu->getCustomMenuDescriptions($this->request->get['menu_id']);
		} else {
			$this->data['menu_description'] = array();
		}	
		
		if (isset($this->request->post['link'])) {
			$this->data['link'] = $this->request->post['link'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['link'] = $custom_menu_info['link'];
		} else {
			$this->data['link'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['image'] = $custom_menu_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 50, 50);
		} elseif (!empty($custom_menu_info) && $custom_menu_info['image'] && file_exists(DIR_IMAGE . $custom_menu_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($custom_menu_info['image'], 50, 50);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 50, 50);
		}
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 50, 50);
	
		if (isset($this->request->post['parent_id'])) {
			$this->data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['parent_id'] = $custom_menu_info['parent_id'];
		} else {
			$this->data['parent_id'] = '';
		}
		
		if (isset($this->request->post['parent_parent_id'])) {
			$this->data['parent_parent_id'] = $this->request->post['parent_parent_id'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['parent_parent_id'] = $custom_menu_info['parent_parent_id'];
		} else {
			$this->data['parent_parent_id'] = '';
		}
		
		if (isset($this->request->post['column'])) {
			$this->data['column'] = $this->request->post['column'];
		} elseif (!empty($custom_menu_info)) {
			$this->data['column'] = $custom_menu_info['column'];
		} else {
			$this->data['column'] = '';
		}

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
				
		$this->template = 'module/custom_menu_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/custom_menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['menu_description'] as $language_id => $value) {
			if ( (utf8_strlen($value['name']) > 64)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/custom_menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>