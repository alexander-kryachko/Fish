<?php

/**
 * Google Analytics Ecommerce Tracking module for Opencart by Extensa Web Development
 *
 * Copyright © 2013 Extensa Web Development Ltd. All Rights Reserved.
 * This file may not be redistributed in whole or significant part.
 * This copyright notice MUST APPEAR in all copies of the script!
 *
 * @author 		Extensa Web Development Ltd. (www.extensadev.com)
 * @copyright	Copyright (c) 2013, Extensa Web Development Ltd.
 * @package 	Google Analytics Ecommerce Tracking module
 * @link		http://www.opencart.com/index.php?route=extension/extension/info&extension_id=11242
 */

class ControllerModuleEcommerceTracking extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/ecommerce_tracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ecommerce_tracking', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['entry_sku'] = $this->language->get('entry_sku');
		$this->data['entry_status'] = $this->language->get('entry_status');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href'      => $this->url->link('module/ecommerce_tracking', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/ecommerce_tracking', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ecommerce_tracking_sku'])) {
			$this->data['ecommerce_tracking_sku'] = $this->request->post['ecommerce_tracking_sku'];
		} else {
			$this->data['ecommerce_tracking_sku'] = $this->config->get('ecommerce_tracking_sku');
		}

		if (isset($this->request->post['ecommerce_tracking_status'])) {
			$this->data['ecommerce_tracking_status'] = $this->request->post['ecommerce_tracking_status'];
		} else {
			$this->data['ecommerce_tracking_status'] = $this->config->get('ecommerce_tracking_status');
		}

		$this->data['skus'] = array(
			array('id' => 'id', 'name' => $this->language->get('text_product_id')),
			array('id' => 'sku', 'name' => $this->language->get('text_sku')),
			array('id' => 'id_option', 'name' => $this->language->get('text_id_option')),
			array('id' => 'sku_option', 'name' => $this->language->get('text_sku_option'))
		);

		$this->template = 'module/ecommerce_tracking.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ecommerce_tracking')) {
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