<?php
class ModelTotalCoupon extends Model {

	private function getCumulativeDiscount($coupon_info, $amount) {
		$discount = $coupon_info['discount'];
		$discount_plan = $coupon_info['discount_plan'];
		if (!is_array($discount_plan)) return $discount;

		//++++ Detect complete orders total ++++
	  	$sq = $this->db->query("SELECT SUM(o.total) AS total FROM " . DB_PREFIX . "coupon_history ch 
			LEFT JOIN `" . DB_PREFIX . "order` o ON o.order_id = ch.order_id
			WHERE ch.coupon_id='" . (int) $coupon_info['coupon_id'] ."' AND o.order_status_id = '" . (int)$this->config->get('config_complete_status_id') ."'
			GROUP BY coupon_id");
		$orders_total = (!$sq->num_rows ? 0 : $sq->row['total']);
		//---- Detect complete orders total ----
		
		foreach ($discount_plan as $tot=>$disct) {
			if ($orders_total /*+ $amount*/ >= $tot)
				$discount = $disct;
		}
		return $discount;
	}

	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['coupon'])) {
			$this->load->language('total/coupon');
			
			$this->load->model('checkout/coupon');
			 
			$coupon_info = $this->model_checkout_coupon->getCoupon($this->session->data['coupon']);
			
			if ($coupon_info) {
				$discount_total = 0;
				
				//if (!$coupon_info['product']) {
				//	$sub_total = $this->cart->getSubTotal();
				//} else {
					$sub_total = 0;
					foreach ($this->cart->getProducts() as $product) {
						//skip set products
						if (strpos($product['key'], '-') !== false || !empty($product['is_special'])) continue;
						
						if (!$coupon_info['product'] || in_array($product['product_id'], $coupon_info['product'])) {
							$sub_total += $product['total'];
						}
					}			
				//}
				
				if ($coupon_info['type'] == 'F') {
					$coupon_info['discount'] = min($coupon_info['discount'], $sub_total);
				}
				else if ($coupon_info['type'] == 'C') {
					$coupon_info['discount'] = $this->getCumulativeDiscount($coupon_info, $sub_total);
				}
				
				foreach ($this->cart->getProducts() as $product) {
					//skip set products
					if (strpos($product['key'], '-') !== false || !empty($product['is_special'])) continue;
					
					$discount = 0;
					if (!$coupon_info['product']) {
						$status = true;
					} else {
						if (in_array($product['product_id'], $coupon_info['product'])) {
							$status = true;
						} else {
							$status = false;
						}
					}
					
					if ($status) {
						if ($coupon_info['type'] == 'F') {
							$discount = $coupon_info['discount'] * ($product['total'] / $sub_total);
						} elseif ($coupon_info['type'] == 'P' || $coupon_info['type'] == 'C') {
							$discount = $product['total'] / 100 * $coupon_info['discount'];
						}
				
						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);
							
							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P' || $tax_rate['type'] == 'C') {
									$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
					}
					
					$discount_total += $discount;
				}
				
				if ($coupon_info['shipping'] && isset($this->session->data['shipping_method'])) {
					if (!empty($this->session->data['shipping_method']['tax_class_id'])) {
						$tax_rates = $this->tax->getRates($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id']);
						
						foreach ($tax_rates as $tax_rate) {
							if ($tax_rate['type'] == 'P' || $tax_rate['type'] == 'C') {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}
					
					$discount_total += $this->session->data['shipping_method']['cost'];				
				}				
      			
				$total_data[] = array(
					'code'       => 'coupon',
        			'title'      => sprintf($this->language->get('text_coupon'), $this->session->data['coupon']),
	    			'text'       => $this->currency->format(-$discount_total),
        			'value'      => -$discount_total,
					'sort_order' => $this->config->get('coupon_sort_order')
      			);

				$total -= $discount_total;
			} 
		}
	}
	
	public function confirm($order_info, $order_total){
		$code = '';
		
		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');
		
		if ($start && $end) {  
			$code = substr($order_total['title'], $start, $end - $start);
		}	
		
		$this->load->model('checkout/coupon');
		
		$coupon_info = $this->model_checkout_coupon->getCoupon($code);
			
		if ($coupon_info) {
			$this->model_checkout_coupon->redeem($coupon_info['coupon_id'], $order_info['order_id'], $order_info['customer_id'], $order_total['value']);	
		}						
	}
}
?>
