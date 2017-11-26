<?php
class ControllerModuleLatestsInRecent extends Controller {
	private $error = array();
  private $_templateData = array();
  private $version = '1.2.1';
	
	public function index() {   
		$this->_templateData = $this->load->language('module/latests_in_recent');
    $this->_templateData['heading_title'] = $this->language->get('heading_title') . ' v' . $this->version;

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
      $url = $this->request->post['seo_url'];
			$this->model_setting_setting->editSetting('latests_in_recent', $this->request->post);		
      $this->saveSEOUrl($url);
			$this->cache->delete('product.latestrecent');
			$this->session->data['success'] = $this->language->get('text_success');
      if (version_compare(VERSION, '2.0', '<')) {
        $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
      } else {
        $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
      }
		}
		
 		if (isset($this->error['warning'])) {
			$this->_templateData['error_warning'] = $this->error['warning'];
		} else {
			$this->_templateData['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$this->_templateData['error_image'] = $this->error['image'];
		} else {
			$this->_templateData['error_image'] = '';
		}
		
		if (isset($this->error['days'])) {
			$this->_templateData['error_days'] = $this->error['days'];
		} else {
			$this->_templateData['error_days'] = '';
		}

		if (isset($this->error['limit'])) {
			$this->_templateData['error_limit'] = $this->error['limit'];
		} else {
			$this->_templateData['error_limit'] = '';
		}
		
 		if (isset($this->error['name'])) {
			$this->_templateData['error_name'] = $this->error['name'];
		} else {
			$this->_templateData['error_name'] = array();
		}

    $this->_templateData['breadcrumbs'] = array();

    $this->_templateData['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_home'),
      'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => false
    );

    $this->_templateData['breadcrumbs'][] = array(
      'text'      => $this->language->get('text_module'),
      'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => ' :: '
    );
  
    $this->_templateData['breadcrumbs'][] = array(
      'text'      => $this->language->get('heading_title'),
      'href'      => $this->url->link('module/latests_in_recent', 'token=' . $this->session->data['token'], 'SSL'),
      'separator' => ' :: '
    );
		
		$this->_templateData['action'] = $this->url->link('module/latests_in_recent', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->_templateData['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->_templateData['displays'] = array();
		$this->_templateData['displays'][] = array (
			'text' 	=> $this->language->get('text_list'),
			'value'	=> 0,
		); 
				
		$this->_templateData['select_display'] = $this->language->get('text_select_display');
		$this->_templateData['displays'][] = array (
			'text' 	=> $this->language->get('text_grid'),
			'value'	=> 1,
		);
		
		if (isset($this->request->post['latests_in_recent'])) {
			$this->_templateData['latests_in_recent'] = $this->request->post['latests_in_recent'];
		} else {
			$this->_templateData['latests_in_recent'] = $this->config->get('latests_in_recent');
			if (!$this->_templateData['latests_in_recent']) {
				//Настройки по умолчанию
				$this->_templateData['latests_in_recent'] = array (
					'image_width'			      => $this->config->get('config_image_product_width'),
					'image_height'  	      => $this->config->get('config_image_product_height'),
					'days'  	  			      => 15,
					'limit'       		      => $this->config->get('config_catalog_limit'),
          'hide_categories'       => 0,
					'main_categories'	      => 0,
          'main_show_h1'          => 0,
          'category_images'       => 0,
					'display' 	 			      => 1,
					'product_count' 	      => 1,
          'hide_outofstock'       => 0,
          'breadcrumbs_separate'  => 0,
          'description'           => array(),
				);
			}
		}
    
    if (isset($this->request->post['seo_url'])) {
      $this->_templateData['seo_url'] = $this->request->post['seo_url'];
    } else {
      $this->_templateData['seo_url'] = $this->getSEOUrl();
    };
    
		$this->_templateData['token'] = $this->session->data['token'];

		//Загружаем доступные языки
		$this->load->model('localisation/language');
		$this->_templateData['languages'] = $this->model_localisation_language->getLanguages();

    if (version_compare(VERSION, '2.0' , "<")) {
      $this->data = array_merge($this->data, $this->_templateData);
      
      $this->template = 'module/latests_in_recent.tpl';
      $this->children = array(
        'common/header',
        'common/footer'
      );
          
      $this->response->setOutput($this->render());
    } else {
      $data = $this->_templateData;
      $data['header'] = $this->load->controller('common/header');
      $data['column_left'] = $this->load->controller('common/column_left');
      $data['footer'] = $this->load->controller('common/footer');

      $this->response->setOutput($this->load->view('module/latests_in_recent.tpl', $data));
    }
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/latests_in_recent')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
    //Проверка размеров картинок		
    if (!$this->request->post['latests_in_recent']['image_width'] || !$this->request->post['latests_in_recent']['image_height']) {
      $this->error['image'] = $this->language->get('error_image');
    } elseif ((preg_match("/[^0-9]/", $this->request->post['latests_in_recent']['image_width'])) || (preg_match("/[^0-9]/", $this->request->post['latests_in_recent']['image_height']))) {
        $this->error['image'] = $this->language->get('error_image_value');
    }
    
    //Количество дней
    if (!$this->request->post['latests_in_recent']['days']) {
      $this->error['days'] = $this->language->get('error_days');
    } else {
      if (preg_match("/[^0-9]/", $this->request->post['latests_in_recent']['days'])) {
        $this->error['days'] = $this->language->get('error_days_value');
      }
    }

    //Количество товаров на странице
    if (!$this->request->post['latests_in_recent']['limit']) {
      $this->error['limit'] = $this->language->get('error_limit');
    } else {
      if (preg_match("/[^0-9]/", $this->request->post['latests_in_recent']['limit'])) {
        $this->error['limit'] = $this->language->get('error_limit_value');
      }
    }
    
    foreach ($this->request->post['latests_in_recent']['description'] as $language_id => $value) {
      if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
        $this->error['name'][$language_id] = $this->language->get('error_name');
      }
    }
    
    if (version_compare(VERSION, '2.0', '<')) {
      if (!isset($this->request->post['latests_in_recent']['product_count'])) {
        $this->request->post['latests_in_recent']['product_count'] = 0;
      }

      if (!isset($this->request->post['latests_in_recent']['hide_categories'])) {
        $this->request->post['latests_in_recent']['hide_categories'] = 0;	
      }

      if (!isset($this->request->post['latests_in_recent']['main_categories'])) {
        $this->request->post['latests_in_recent']['main_categories'] = 0;	
      }
      
      if (!isset($this->request->post['latests_in_recent']['main_show_h1'])) {
        $this->request->post['latests_in_recent']['main_show_h1'] = 0;	
      }
      
      if (!isset($this->request->post['latests_in_recent']['category_images'])) {
        $this->request->post['latests_in_recent']['category_images'] = 0;	
      }
      
      if (!isset($this->request->post['latests_in_recent']['hide_outofstock'])) {
        $this->request->post['latests_in_recent']['hide_outofstock'] = 0;
      }

      if (!isset($this->request->post['latests_in_recent']['breadcrumbs_separate'])) {
        $this->request->post['latests_in_recent']['breadcrumbs_separate'] = 0;
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
  
  public function install() {
    $this->load->model('design/layout');
    $layouts = $this->model_design_layout->getLayouts();
    $find = false;
    foreach ($layouts as $layout) {
      $routes = $this->model_design_layout->getLayoutRoutes($layout['layout_id']);
      foreach ($routes as $route) {
        if ($route['route'] == 'product/latest') {
          $find = true;
          break 2;
        }
      }
    }
    
    if (!$find) {
      $layout = array(
        'name' => 'LatestRecent',
        'layout_route' => array(),
      );
      
      $layout_route = array(
        'store_id' => 0,
        'route' => 'product/latest'
      );
      
      $layout['layout_route'][] = $layout_route;
      
      $this->model_design_layout->addLayout($layout);
    }
  }
  
  public function uninstall() {
    $layout_ids = array();
    foreach ($layouts as $layout) {
      $routes = $this->model_design_layout->getLayoutRoutes($layout['layout_id']);
      foreach ($routes as $route) {
        if ($route['route'] == 'product/latest') {
          $layout_ids[] = $layout['layout_id'];
          break;
        }
      }
    }
    
    $this->load->model('design/layout');
    foreach ($layout_ids as $id) {
      $this->model_design_layout->deleteLayout($id);
    }
    $sql = "DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'product/latest'";
    $this->db->query($sql);
    $this->cache->delete('seo_pro');
  }
  
  private function getSEOUrl() {
    $sql = "SELECT DISTINCT keyword FROM `" . DB_PREFIX . "url_alias` WHERE `query`='product/latest'";
    $query = $this->db->query($sql);
    if ($query->num_rows) {
      return $query->row['keyword'];
    } else {
      return '';
    }
  }
  
  private function saveSEOUrl($url) {
    $url = trim($url);
    if ($url) {
      if ($this->getSEOUrl()) {
        $sql = "UPDATE `" . DB_PREFIX . "url_alias` SET `keyword` = '" . $this->db->escape($url) . "' WHERE `query`='product/latest'";
      } else {
        $sql = "INSERT INTO `" . DB_PREFIX . "url_alias` SET `keyword` = '" . $this->db->escape($url) . "', `query`='product/latest'";
      }
      $this->db->query($sql);
      $this->cache->delete('seo_pro');
    }
  }
  
}
?>