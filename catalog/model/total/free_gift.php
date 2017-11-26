<?php
class ModelTotalFreeGift extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
				
		if ($this->isAllowedFreeGift()) {
		
			$this->load->language('total/free_gift');
		
			$discount_total = $this->getGiftSubTotal();					
			
			if ($discount_total > 0 ) {	
				
				$total_data[] = array(
					'code'       => 'free_gift',
					'title'      => $this->language->get('text_free_gift_discount'),
					'text'       => $this->currency->format(-$discount_total),
					'value'      => -$discount_total,
					'sort_order' => $this->config->get('free_gift_sort_order')
				);	

				$total -= $discount_total;
			}	
		}		
	}
	
	public function isAllowedFreeGift() {
			
		if ($this->customer->isLogged()){
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}
		
		if ( !$this->config->get('free_gift_status') ) {
			return false;
		}
		
		if ($this->config->get('free_gift_order_subtotal')) {
			if ( $this->cart->getSubTotal() < $this->config->get('free_gift_order_subtotal') ) {
				return false;
			}
		}
		
		if ($this->config->get('free_gift_required_cart_product')) {
			$required_products_founded = 0;
			$required_products = explode(",", $this->config->get('free_gift_required_cart_product'));
			
			foreach($this->cart->getProducts() as $product) {
				if (in_array($product['product_id'], $required_products)) {
					$required_products_founded++;
				}
			}
			
			if (!$required_products_founded) {
				return false;
			}
		}
		
		if ($this->config->get('free_gift_allowed_groups')) {
			if (!in_array($customer_group_id, $this->config->get('free_gift_allowed_groups'))){
				return false;
			}
		}

		return true;	
	}
	
	public function addGift() {
		$gift_products = explode(",", $this->config->get('free_gift_gift_product'));
			
		foreach($gift_products as $product_id) {
			if ($this->isGiftProductAvailable($product_id)) {
				$this->cart->add($product_id);
			}	
		}
		
		$this->session->data['free_gift_products'] = $this->config->get('free_gift_gift_product');
	}
	
	public function removeGift() { 
		if (isset($this->session->data['free_gift_products'])) {
			$gift_products = explode(",", $this->session->data['free_gift_products']);
			
			foreach($this->cart->getProducts() as $product) {
				if (in_array($product['product_id'], $gift_products)) {
					$this->cart->update($product['product_id'], $product['quantity'] - 1);
				}
			}
		}
		
		unset($this->session->data['free_gift_products']);
	}
	
	public function updateGift() {
		$gift_products = explode(",", $this->config->get('free_gift_gift_product'));
			
		foreach($gift_products as $product_id) {
			if (!$this->isInCart($product_id)) {
				if ($this->isGiftProductAvailable($product_id)) {
					$this->cart->add($product_id);
				}
			}
		}
	}
	
	public function isGiftAdded() {
		$gift_products_added = 0;
		
		$gift_products = explode(",", $this->config->get('free_gift_gift_product'));
		
		foreach ($this->cart->getProducts() as $product) {
			if (in_array($product['product_id'], $gift_products)) {
				$gift_products_added++;
			}	
		}
		
		if ($gift_products_added == count($gift_products)) {
			return true;
		}
		
		return false;
	}
	
	public function isInCart($product_id) {
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['product_id'] == $product_id) {
				return true;
			}	
		}
		
		return false;
	}
	
	public function isInGift($product_id) {
		$gift_products = explode(",", $this->config->get('free_gift_gift_product'));
		
		if (in_array($product_id, $gift_products)) {
			return true;
		}
		
		return false;
	}
	
	private function isGiftProductAvailable($product_id) {
	
		$this->load->model('catalog/product');
		
		$product_info = $this->model_catalog_product->getProduct($product_id);
		
		if ($product_info) {
			if ($product_info['status'] && ($product_info['subtract'] == 0 || $product_info['quantity'])) {
				return true;
			}
		}
		
		return false;
	}
	
	private function getGiftSubTotal() {
		$gift_value = 0;
		
		if (isset($this->session->data['free_gift_products'])) {
			$gift_products = explode(",", $this->session->data['free_gift_products']);
		
			foreach ($this->cart->getProducts() as $product) {
				if (in_array($product['product_id'], $gift_products)) {
					$gift_value += $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * 1;
				}	
			}
		}
		
		return $gift_value;
	}
}
?>