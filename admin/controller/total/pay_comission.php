<?php

class ControllerTotalPayComission extends Controller {

  private $error = array();

  public function index() {
    $this->load->language('total/pay_comission');

    $this->document->setTitle(strip_tags($this->language->get('heading_title')));

    $this->load->model('setting/setting');
	 $data['heading_title'] = strip_tags($this->language->get('heading_title'));

    $data['text_edit']     = $this->language->get('text_edit');
    $data['text_enabled']  = $this->language->get('text_enabled');
    $data['text_disabled'] = $this->language->get('text_disabled');
    $data['text_none']     = $this->language->get('text_none');

    $data['entry_total']      = $this->language->get('entry_total');
    $data['entry_fee']        = $this->language->get('entry_fee');
    $data['entry_tax_class']  = $this->language->get('entry_tax_class');
    $data['entry_status']     = $this->language->get('entry_status');
    $data['entry_sort_order'] = $this->language->get('entry_sort_order');

    $data['help_total'] = $this->language->get('help_total');

    $data['button_save']   = $this->language->get('button_save');
    $data['button_cancel'] = $this->language->get('button_cancel');

    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_total'),
        'href' => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
    );

    $data['breadcrumbs'][] = array(
        'text' => strip_tags($this->language->get('heading_title')),
        'href' => $this->url->link('total/pay_comission', 'token=' . $this->session->data['token'], 'SSL'),
    );
	
    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
      $this->model_setting_setting->editSetting('pay_comission', $this->request->post);

      $this->session->data['success'] = $this->language->get('text_success');

      $this->response->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
    }

    $method_data = array();

    $this->load->model('extension/extension');

    $data['pickup_user_text'] = $this->config->get('pickup_user_text');
	$entry_percent = $this->language->get('entry_percent'); // Добавляем к каждому полю текст (указывать в %)
	
    $results = $this->getExtensions('payment');

    foreach ($results as $result) {
		$this->language->load('payment/'.$result['code']); // Подгружаем языковой файл по коду способа доставки
        $data['entry_' . $result['code']] = $this->language->get('heading_title').$entry_percent; // Получаем значения из языкового файла

		$data_payment[] = array(
          'code'  => $result['code'],
          'type'  => $result['type'],
          'front' => $result['code'] . '.' . $result['code'],
		);

    }

    $data['payment_methods'] = $data_payment;

    if (isset($this->request->post['pay_comission_payment'])) {
      $pay_method_commis_array = $this->request->post['pay_comission_payment'];

      foreach ($pay_method_commis_array as $key => $pay_comis) {
        if (!empty($pay_comis)) {
          $data['paym_val_' . $key] = $pay_comis;
        } else {
          $data['paym_val_' . $key] = '';
        }
      }
    } else {
		
		$config_payments = $this->config->get('pay_comission_payment');
		
		if (!empty($config_payments)) {
			foreach ($config_payments as $key => $pay_comis) {
			  if (!empty($pay_comis)) {
				$data['paym_val_' . $key] = $pay_comis;
			  } else {
				$data['paym_val_' . $key] = ' ';
			  }
			}
		}
    }



    $data['action'] = $this->url->link('total/pay_comission', 'token=' . $this->session->data['token'], 'SSL');

    $data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

    if (isset($this->request->post['pay_comission_tax_class_id'])) {
      $data['pay_comission_tax_class_id'] = $this->request->post['pay_comission_tax_class_id'];
    } else {
      $data['pay_comission_tax_class_id'] = $this->config->get('pay_comission_tax_class_id');
    }

    $this->load->model('localisation/tax_class');

    $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

    if (isset($this->request->post['pay_comission_status'])) {
      $data['pay_comission_status'] = $this->request->post['pay_comission_status'];
    } else {
      $data['pay_comission_status'] = $this->config->get('pay_comission_status');
    }

    if (isset($this->request->post['pay_comission_sort_order'])) {
      $data['pay_comission_sort_order'] = $this->request->post['pay_comission_sort_order'];
    } else {
      $data['pay_comission_sort_order'] = $this->config->get('pay_comission_sort_order');
    }

    $data['header']      = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer']      = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('total/pay_comission.tpl', $data));
  }
  
	private function getExtensions($type) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "'");

		return $query->rows;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/pay_comission')) {
		  $this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	 }
}