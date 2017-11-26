<?php
/*
 * Shoputils
 *
 * ПРИМЕЧАНИЕ К ЛИЦЕНЗИОННОМУ СОГЛАШЕНИЮ
 *
 * Этот файл связан лицензионным соглашением, которое можно найти в архиве,
 * вместе с этим файлом. Файл лицензии называется: LICENSE.1.5.x.RUS.txt
 * Так же лицензионное соглашение можно найти по адресу:
 * http://opencart.shoputils.ru/LICENSE.1.5.x.RUS.txt
 * 
 * =================================================================
 * OPENCART 1.5.x ПРИМЕЧАНИЕ ПО ИСПОЛЬЗОВАНИЮ
 * =================================================================
 *  Этот файл предназначен для Opencart 1.5.x. Shoputils не
 *  гарантирует правильную работу этого расширения на любой другой 
 *  версии Opencart, кроме Opencart 1.5.x. 
 *  Shoputils не поддерживает программное обеспечение для других 
 *  версий Opencart.
 * =================================================================
*/

class ControllerModuleShoputilsAutoUpdateOrders extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/shoputils_auto_update_orders');
    $this->load->model('localisation/order_status');
		$this->load->model('localisation/country');
		$this->load->model('localisation/geo_zone');
    $this->document->addStyle('view/stylesheet/shoputils_auto_update_orders.css');
    $this->document->addStyle('view/javascript/tooltip/jquery.qtip.css');
    $this->document->addScript('view/javascript/tooltip/jquery.qtip.js');
    $this->document->addScript('view/javascript/tooltip/tooltip.js');
		$this->document->setTitle($this->language->get('heading_title'));		
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
        $this->load->model('setting/setting');
        if (isset($this->request->post['shoputils_auto_update_orders_old_order_status_ids'])) {
            $this->request->post['shoputils_auto_update_orders_old_order_status_ids'] = implode(',', $this->request->post['shoputils_auto_update_orders_old_order_status_ids']);
        }

        $this->model_setting_setting->editSetting('shoputils_auto_update_orders', $this->request->post);
        $this->session->data['success'] = sprintf($this->language->get('text_success'), $this->language->get('heading_title'));
        $this->redirect($this->makeUrl('extension/module'));
		}

    $this->_setData(array(
        'heading_title',
        'button_save',
        'button_cancel',
        'column_old_order_statuses',
        'column_new_order_status',
        'column_days',
        'column_status',
        'entry_days',
        'text_enabled',
        'text_disabled',
        'text_select_all',
        'text_unselect_all',
        'text_missing',
        'help_old_order_statuses',
        'help_new_order_status',
        'help_days',
        'text_copyright'  => sprintf($this->language->get('text_copyright'), $this->language->get('heading_title'), date('Y', time())),
        'error_warning'   => isset($this->error['warning']) ? $this->error['warning'] : '',
        'action'          => $this->makeUrl('module/shoputils_auto_update_orders'),
        'cancel'          => $this->makeUrl('extension/module'),
        'token'           => $this->session->data['token'],
        'order_statuses'           => $this->model_localisation_order_status->getOrderStatuses(),
        'modules'         => array(),
        'breadcrumbs'     => array()
    ));

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
        'href'      => $this->url->link('module/shoputils_auto_update_orders', 'token=' . $this->session->data['token'], 'SSL'),
      	'separator' => ' :: '
   		);


      $this->_updateData(
          array(
               'shoputils_auto_update_orders_old_order_status_ids',
               'shoputils_auto_update_orders_new_order_status',
               'shoputils_auto_update_orders_days',
               'shoputils_auto_update_orders_status'
          ),
          array()
      );

    if (!is_array($this->data['shoputils_auto_update_orders_old_order_status_ids'])) {
        $this->data['shoputils_auto_update_orders_old_order_status_ids'] = explode(',', $this->data['shoputils_auto_update_orders_old_order_status_ids']);
    }

		$this->template = 'module/shoputils_auto_update_orders.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/shoputils_auto_update_orders')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}				
		return !$this->error;
	}

  protected function _setData($values) {
    foreach ($values as $key => $value) {
      if (is_int($key)) {
        $this->data[$value] = $this->language->get($value);
      } else {
        $this->data[$key] = $value;
      }
    }
  }

    protected function _updateData($keys, $info) {
        foreach ($keys as $key) {
            if (isset($this->request->post[$key])) {
                $this->data[$key] = $this->request->post[$key];
            } elseif (isset($info[$key])) {
                $this->data[$key] = $info[$key];
            } else {
                $this->data[$key] = $this->config->get($key);
            }
        }
    }

  protected function makeUrl($route, $url = '') {
    return str_replace('&amp;', '&', $this->url->link($route, $url . '&token=' . $this->session->data['token'], 'SSL'));
  }
}
?>