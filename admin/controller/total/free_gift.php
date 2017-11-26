<?php
class ControllerTotalFreeGift extends Controller {
	private $error = array();
	
	public function index() {   
		$this->load->language('total/free_gift');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		$this->load->model('catalog/product');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('free_gift', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_order_subtotal'] = $this->language->get('entry_order_subtotal');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_required_cart_product'] = $this->language->get('entry_required_cart_product');
		$this->data['entry_customer_groups'] = $this->language->get('entry_customer_groups');
		$this->data['entry_gift_product'] = $this->language->get('entry_gift_product');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
			
		if (isset($this->error['gift_product'])) {
			$this->data['error_gift_product'] = $this->error['gift_product'];
		} else {
			$this->data['error_gift_product'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/free_gift', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('total/free_gift', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['free_gift_status'])){
			$this->data['free_gift_status'] = $this->request->post['free_gift_status'];
		} elseif ( $this->config->get('free_gift_status')){
			$this->data['free_gift_status'] = $this->config->get('free_gift_status');
		} else {
			$this->data['free_gift_status'] = '';
		}
		
		if (isset($this->request->post['free_gift_order_subtotal'])){
			$this->data['free_gift_order_subtotal'] = $this->request->post['free_gift_order_subtotal'];
		} elseif ( $this->config->get('free_gift_order_subtotal')){
			$this->data['free_gift_order_subtotal'] = $this->config->get('free_gift_order_subtotal');
		} else {
			$this->data['free_gift_order_subtotal'] = '';
		}
		
		if (isset($this->request->post['free_gift_required_cart_product'])) {
			$required_products = explode(',', $this->request->post['free_gift_required_cart_product']);
		} else {		
			$required_products = explode(',', $this->config->get('free_gift_required_cart_product'));
		}
		
		$this->data['required_products'] = array();
		
		foreach ($required_products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				$this->data['required_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}	
		
		if (isset($this->request->post['free_gift_required_cart_product'])){
			$this->data['free_gift_required_cart_product'] = $this->request->post['free_gift_required_cart_product'];
		} elseif ( $this->config->get('free_gift_required_cart_product')){
			$this->data['free_gift_required_cart_product'] = $this->config->get('free_gift_required_cart_product');
		} else {
			$this->data['free_gift_required_cart_product'] = '';
		}
		
		if (isset($this->request->post['free_gift_allowed_groups'])){
			$this->data['free_gift_allowed_groups'] = $this->request->post['free_gift_allowed_groups'];
		} elseif ( $this->config->get('free_gift_allowed_groups')){
			$this->data['free_gift_allowed_groups'] = $this->config->get('free_gift_allowed_groups');
		} else {
			$this->data['free_gift_allowed_groups'] = array();
		}
		
		if (isset($this->request->post['free_gift_gift_product'])){
			$this->data['free_gift_gift_product'] = $this->request->post['free_gift_gift_product'];
		} elseif ( $this->config->get('free_gift_gift_product')){
			$this->data['free_gift_gift_product'] = $this->config->get('free_gift_gift_product');
		} else {
			$this->data['free_gift_gift_product'] = '';
		}
		
		if (isset($this->request->post['free_gift_gift_product'])) {
			$gift_products = explode(',', $this->request->post['free_gift_gift_product']);
		} else {		
			$gift_products = explode(',', $this->config->get('free_gift_gift_product'));
		}
		
		$this->data['gift_products'] = array();
		
		foreach ($gift_products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				$this->data['gift_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}	
		
		if (isset($this->request->post['free_gift_sort_order'])){
			$this->data['free_gift_sort_order'] = $this->request->post['free_gift_sort_order'];
		} elseif ( $this->config->get('free_gift_sort_order')){
			$this->data['free_gift_sort_order'] = $this->config->get('free_gift_sort_order');
		} else {
			$this->data['free_gift_sort_order'] = '';
		}

		$this->load->model('sale/customer_group');	
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		$this->data['token'] = $this->session->data['token'];
						
		$this->template = 'total/free_gift.tpl';
		$this->children = array(
			'common/header', 
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		
		if (!$this->user->hasPermission('modify', 'total/free_gift')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!isset($this->request->post['free_gift_gift_product'])){
			$this->error['gift_product'] = $this->language->get('error_gift_product');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>