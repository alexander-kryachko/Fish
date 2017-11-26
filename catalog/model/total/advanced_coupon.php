<?php
class ModelTotalAdvancedCoupon extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		
		$this->load->language('total/advanced_coupon');
		$this->load->model('checkout/advanced_coupon');
		
		if(isset($this->session->data['advanced_coupon'])) {
			$codes = array_unique($this->session->data['advanced_coupon']);
			foreach($codes as $code) {
				$advanced_coupon_info[] = $this->model_checkout_advanced_coupon->getAdvancedCoupon($code);
			}
		}
			
		if (isset($advanced_coupon_info)) {
	
		foreach ($advanced_coupon_info as $results) { 
			$result = $results[0];
		
			if(isset($result)) {
				
				$discount_total = 0;
				$ac_discount = $result['discount'];
				$ac_quantity_total = $result['quantity_total'];
				$ac_quantity_sale = $result['quantity_sale'];
				$ac_quantity_buy = $result['quantity_buy'];
				$ac_base = $result['ac_base'];
				$ac_base_total = $result['ac_base_total'];
				$ac_base_quantity = $result['ac_base_quantity'];
				$ac_product = $result['ac_product'];
				$ac_product_total = $result['ac_product_total'];
				$ac_product_quantity = $result['ac_product_quantity'];
				$ac_product_buy = $result['ac_product_buy'];
				$ac_product_buy_total = $result['ac_product_buy_total'];
				$ac_product_buy_quantity = $result['ac_product_buy_quantity'];
				$ac_shipping = $result['shipping'];
				$ac_quantity_type = $result['quantity_type'];
				$ac_product_sale_type = $result['ac_product_sale_type'];
				$ac_product_buy_type = $result['ac_product_buy_type'];
				$ac_product_sale_array = $result['ac_product_sale_array'];
				$ac_product_buy_array = $result['ac_product_buy_array'];
				
				
				//print "<pre>"; 
				//print_r($ac_product); 
				//print_r($ac_product_buy);
				
				// Cart Products
				$ac_cart_product = $ac_base;
				$ac_cart_total = $ac_base_total;
				$ac_cart_quantity = $ac_base_quantity;		
										
				if($ac_quantity_buy && $ac_quantity_sale) {
				
					if($ac_product && $ac_product_buy) {
						if($ac_product == $ac_product_buy) {
							$discount_factor = ((floor($ac_product_quantity/($ac_quantity_sale+$ac_quantity_buy)))*$ac_quantity_sale);
						} else {
							$discount_factor = min(floor($ac_product_buy_quantity/$ac_quantity_buy), floor($ac_product_quantity/$ac_quantity_sale))*$ac_quantity_sale;
						}
					} else if($ac_product_buy){
						if($ac_product_buy == $ac_cart_product) {
							$discount_factor = min(floor($ac_product_buy_quantity/$ac_quantity_buy), floor(($ac_cart_quantity)/$ac_quantity_sale))*$ac_quantity_sale;
						} else {
							$discount_factor = min(floor($ac_product_buy_quantity/$ac_quantity_buy), floor(($ac_cart_quantity-$ac_product_buy_quantity)/$ac_quantity_sale))*$ac_quantity_sale;
						}
					} else if($ac_product) {
						$discount_factor = min(floor($ac_product_quantity/$ac_quantity_sale), floor(($ac_cart_quantity)/($ac_quantity_buy+$ac_quantity_sale)))*$ac_quantity_sale;	
					} else {
						$discount_factor = ((floor($ac_cart_quantity/($ac_quantity_buy+$ac_quantity_sale)))*$ac_quantity_sale);
					}
					
					// Discount Multiplier 
					if($ac_quantity_type == 'F') {
						$discount_factor = $ac_quantity_sale;
					}
				} else if($ac_product && (!$ac_quantity_sale)) {
					$discount_factor = $ac_product_quantity;
				} else if($ac_quantity_sale) {
					$discount_factor = $ac_quantity_sale;
				} else {
					$discount_factor = $ac_cart_quantity;
				}
	
				// Condition for Products On Sale
				if($ac_product) {
					$ac_discount_product = $ac_product;
				} else {
					$ac_discount_product = $ac_base;
				}
			
				if(isset($ac_discount_product)) {
				
					if ($result['type'] == 'F') {
						if($ac_quantity_buy || $ac_quantity_sale) {
							$discount_total = $ac_discount*$discount_factor;
						} else {
							$discount_total = $ac_discount;
						}
						//$sub_total = $this->cart->getSubTotal();
						$sub_total = $ac_base_total;
						$tax_discount_rate = $ac_discount/$sub_total;
						
						foreach ($ac_discount_product['product_id'] as $key => $val) {
							$tax_rates = $this->tax->getRates($ac_discount_product['total'][$key], $ac_discount_product['tax_class_id'][$key]);
							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									$taxes[$tax_rate['tax_rate_id']] -= ($tax_rate['amount']*$tax_discount_rate);
								}
							}
						}
					} elseif($result['type'] == 'P') {
						if($ac_quantity_sale || $ac_product || $ac_quantity_buy || $ac_product_buy) {
							asort($ac_discount_product['price']);
							foreach ($ac_discount_product['price'] as $key => $val) {
								if($discount_factor > 0) {
									if($discount_factor >= $ac_discount_product['quantity'][$key]) {
										$discount_total += (($ac_discount_product['total'][$key]*($ac_discount))/100);
										if ($ac_discount_product['tax_class_id'][$key]) {
											$tax_rates = $this->tax->getRates($ac_discount_product['total'][$key] - ($ac_discount_product['total'][$key] - $discount_total), $ac_discount_product['tax_class_id'][$key]);
										
											foreach ($tax_rates as $tax_rate) {					
												if ($tax_rate['type'] == 'P') {
													$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
												}
												if (($tax_rate['type'] == 'F') && ($ac_discount == '100.0000')) {
													$taxes[$tax_rate['tax_rate_id']] -= ($tax_rate['amount']*$discount_factor);
												}
											}
										}
										$discount_factor -= $ac_discount_product['quantity'][$key];
									} else {
										$discount_total += (((($ac_discount_product['price'][$key])*($discount_factor))*($ac_discount))/100);
										if ($ac_discount_product['tax_class_id'][$key]) {
											$tax_rates = $this->tax->getRates($ac_discount_product['total'][$key] - ($ac_discount_product['total'][$key] - $discount_total), $ac_discount_product['tax_class_id'][$key]);
										
											foreach ($tax_rates as $tax_rate) {
												
												if ($tax_rate['type'] == 'P') {
													$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
												}
												if (($tax_rate['type'] == 'F') && ($ac_discount == '100.0000')) {
													$taxes[$tax_rate['tax_rate_id']] -= ($tax_rate['amount']*$discount_factor);
												}
											}
										}
										$discount_factor -= $ac_discount_product['quantity'][$key];
									}
								}	
							}
						} else {
							$sub_total = $ac_cart_total;
							$discount_total = ((($sub_total)*($ac_discount))/100);
							foreach ($ac_discount_product['price'] as $key => $val) {
								$tax_rates = $this->tax->getRates($ac_discount_product['total'][$key], $ac_discount_product['tax_class_id'][$key]);
								foreach ($tax_rates as $tax_rate) {
									if ($tax_rate['type'] == 'P') {
										$taxes[$tax_rate['tax_rate_id']] -= (($tax_rate['amount']*$ac_discount)/100);
									}
								}
							}
						}
					} elseif($result['type'] == 'FP') {
						if($ac_quantity_buy || $ac_quantity_sale) {
							$sub_total = $ac_cart_total;
							
							if($ac_quantity_buy) {
								if($ac_quantity_sale) {
									if($ac_product_buy_array) {
										if($ac_product_sale_array) {											
											$qty = 0;											
											foreach($ac_product['quantity'] as $k => $q) {
												$qty += $q;
											}											
											$buy_amount = 0;
											$amount = 0;
											
											if($qty <= $ac_quantity_sale) {
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													$buy_amount += $ac_product['quantity'][$i] * $ac_discount;
													$amount += $ac_product['total'][$i];
												}												
												$discount_total = $amount - $buy_amount;													
											} else {
												$temp_quantity = $ac_quantity_sale;												
												$quantity_array = array();											
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													array_push($quantity_array, $ac_product['quantity'][$i] . "," . $ac_product['price'][$i]);
												}										
												rsort($quantity_array); // for reverse sort
												
												for($i=0; $i<count($quantity_array); $i++) {
													$product_data = explode(",", $quantity_array[$i]);											
													$temp_value = 0;
													
													$remaining_quantity = 1;
													
													if($temp_quantity > 0) {
														$remaining_quantity = $temp_quantity - $product_data[0];
														$temp_quantity -= $product_data[0];
														$temp_value = 1;
													}
													
													if($remaining_quantity < 0) {
														$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
														$amount += (abs($ac_quantity_sale)) * $product_data[1];
													} else {
														if($remaining_quantity == 0) {
															$buy_amount += $product_data[0] * $ac_discount;
															$amount += $product_data[0] * $product_data[1];
														}
													}													
												}												
												$discount_total = $amount - $buy_amount;	
											}											
										} else { //product sale not found
											
											$quantity_array = array();
																						
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												array_push($quantity_array, $ac_base['quantity'][$i] . "," . $ac_base['price'][$i]);
											}
											
											rsort($quantity_array);
											
											$temp_quantity = $ac_quantity_sale;
											
											for($i=0; $i<count($quantity_array); $i++) {
												$product_data = explode(",", $quantity_array[$i]);											
												$temp_value = 0;
												
												$remaining_quantity = 1;
													
												if($temp_quantity > 0) {
													$remaining_quantity = $temp_quantity - $product_data[0];
													$temp_quantity -= $product_data[0];
													$temp_value = 1;
												}
												
												if($remaining_quantity < 0) {
													$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
													$amount += (abs($ac_quantity_sale)) * $product_data[1];
												} else {
													if($remaining_quantity == 0) {
														$buy_amount += $product_data[0] * $ac_discount;
														$amount += $product_data[0] * $product_data[1];
													}
												}												
											}
											$discount_total = $amount - $buy_amount;
										}
									} else { // product buy not found
										if($ac_product_sale_array) {
											
											$qty = 0;											
											foreach($ac_product['quantity'] as $k => $q) {
												$qty += $q;
											}											
											$buy_amount = 0;
											$amount = 0;
											
											if($qty <= $ac_quantity_sale) {
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													$buy_amount += $ac_product['quantity'][$i] * $ac_discount;
													$amount += $ac_product['total'][$i];
												}												
												$discount_total = $amount - $buy_amount;													
											} else {
												$temp_quantity = $ac_quantity_sale;												
												$quantity_array = array();											
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													array_push($quantity_array, $ac_product['quantity'][$i] . "," . $ac_product['price'][$i]);
												}										
												rsort($quantity_array); // for reverse sort
												
												for($i=0; $i<count($quantity_array); $i++) {
													$product_data = explode(",", $quantity_array[$i]);											
													$temp_value = 0;
													
													$remaining_quantity = 1;
													
													if($temp_quantity > 0) {
														$remaining_quantity = $temp_quantity - $product_data[0];
														$temp_quantity -= $product_data[0];
														$temp_value = 1;
													}
													
													if($remaining_quantity < 0) {
														$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
														$amount += (abs($ac_quantity_sale)) * $product_data[1];
													} else {
														if($remaining_quantity == 0) {
															$buy_amount += $product_data[0] * $ac_discount;
															$amount += $product_data[0] * $product_data[1];
														}
													}													
												}												
												$discount_total = $amount - $buy_amount;	
											}											
											
										} else { // both array not found
											
											$quantity_array = array();
																						
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												array_push($quantity_array, $ac_base['quantity'][$i] . "," . $ac_base['price'][$i]);
											}
											
											rsort($quantity_array);
											$temp_quantity = $ac_quantity_sale;
											
											for($i=0; $i<count($quantity_array); $i++) {
												$product_data = explode(",", $quantity_array[$i]);											
												$temp_value = 0;
												
												$remaining_quantity = 1;
													
												if($temp_quantity > 0) {
													$remaining_quantity = $temp_quantity - $product_data[0];
													$temp_quantity -= $product_data[0];
													$temp_value = 1;
												}
												
												if($remaining_quantity < 0) {
													$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
													$amount += (abs($ac_quantity_sale)) * $product_data[1];
												} else {
													if($remaining_quantity == 0) {
														$buy_amount += $product_data[0] * $ac_discount;
														$amount += $product_data[0] * $product_data[1];
													}
												}												
											}
											$discount_total = $amount - $buy_amount;
										}										
									}
								} else { // sale quantity not defined
									if($ac_product_buy_array) {
										if($ac_product_sale_array) {
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_product['quantity']); $i++) {
												$amount += $ac_product['price'][$i] * $ac_product['quantity'][$i];
												$buy_amount += $ac_discount * $ac_product['quantity'][$i];
											}											
											$discount_total = $amount - $buy_amount;
										} else { //product sale array not defined
											$buy_amount = 0;
											$amount = 0;										
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												$buy_amount += $ac_base['quantity'][$i] * $ac_discount;
												$amount += $ac_base['price'][$i] * $ac_base['quantity'][$i];
											}
	
											$discount_total = $amount - $buy_amount;
										}
									} else { // product buy array not defined
										if($ac_product_sale_array) {										
											$amount = 0;
											$buy_amount = 0;
											
											for($i=0; $i<count($ac_product['quantity']); $i++) {
												$amount += $ac_product['price'][$i] * $ac_product['quantity'][$i];
												$buy_amount += $ac_discount * $ac_product['quantity'][$i];
											}											
											$discount_total = $amount - $buy_amount;
											
											unset($buy_amount);
											unset($amount);
											
										} else { // both not found
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												$buy_amount += $ac_base['quantity'][$i] * $ac_discount;
												$amount += $ac_base['price'][$i] * $ac_base['quantity'][$i];
											}
											$discount_total = $amount - $buy_amount;
										}
									}
								}
							} else { // buy quantity not defined
								if($ac_quantity_sale) {
									if($ac_product_buy_array) {
										if($ac_product_sale_array) {
											$qty = 0;											
											foreach($ac_product['quantity'] as $k => $q) {
												$qty += $q;
											}											
											$buy_amount = 0;
											$amount = 0;
											
											if($qty <= $ac_quantity_sale) {
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													$buy_amount += $ac_product['quantity'][$i] * $ac_discount;
													$amount += $ac_product['total'][$i];
												}												
												$discount_total = $amount - $buy_amount;													
											} else {
												$temp_quantity = $ac_quantity_sale;												
												$quantity_array = array();											
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													array_push($quantity_array, $ac_product['quantity'][$i] . "," . $ac_product['price'][$i]);
												}										
												rsort($quantity_array); // for reverse sort
												
												for($i=0; $i<count($quantity_array); $i++) {
													$product_data = explode(",", $quantity_array[$i]);											
													$temp_value = 0;
													
													$remaining_quantity = 1;
													
													if($temp_quantity > 0) {
														$remaining_quantity = $temp_quantity - $product_data[0];
														$temp_quantity -= $product_data[0];
														$temp_value = 1;
													}
													
													if($remaining_quantity < 0) {
														$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
														$amount += (abs($ac_quantity_sale)) * $product_data[1];
													} else {
														if($remaining_quantity == 0) {
															$buy_amount += $product_data[0] * $ac_discount;
															$amount += $product_data[0] * $product_data[1];
														}
													}													
												}												
												$discount_total = $amount - $buy_amount;	
											}
										} else { // product sale array not found
											
											$quantity_array = array();
																						
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												array_push($quantity_array, $ac_base['quantity'][$i] . "," . $ac_base['price'][$i]);
											}
											
											rsort($quantity_array);
											
											$temp_quantity = $ac_quantity_sale;
											
											for($i=0; $i<count($quantity_array); $i++) {
												$product_data = explode(",", $quantity_array[$i]);											
												$temp_value = 0;
												
												$remaining_quantity = 1;
													
												if($temp_quantity > 0) {
													$remaining_quantity = $temp_quantity - $product_data[0];
													$temp_quantity -= $product_data[0];
													$temp_value = 1;
												}
												
												if($remaining_quantity < 0) {
													$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
													$amount += (abs($ac_quantity_sale)) * $product_data[1];
												} else {
													if($remaining_quantity == 0) {
														$buy_amount += $product_data[0] * $ac_discount;
														$amount += $product_data[0] * $product_data[1];
													}
												}												
											}
											$discount_total = $amount - $buy_amount;
										}
									} else { //product buy array not found
										if($ac_product_sale_array) {
											
											$qty = 0;											
											foreach($ac_product['quantity'] as $k => $q) {
												$qty += $q;
											}											
											$buy_amount = 0;
											$amount = 0;
											
											if($qty <= $ac_quantity_sale) {
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													$buy_amount += $ac_product['quantity'][$i] * $ac_discount;
													$amount += $ac_product['total'][$i];
												}												
												$discount_total = $amount - $buy_amount;													
											} else {
												$temp_quantity = $ac_quantity_sale;												
												$quantity_array = array();											
												for($i=0; $i<count($ac_product['quantity']); $i++) {
													array_push($quantity_array, $ac_product['quantity'][$i] . "," . $ac_product['price'][$i]);
												}										
												rsort($quantity_array); // for reverse sort
												
												for($i=0; $i<count($quantity_array); $i++) {
													$product_data = explode(",", $quantity_array[$i]);											
													$temp_value = 0;
													
													$remaining_quantity = 1;
													
													if($temp_quantity > 0) {
														$remaining_quantity = $temp_quantity - $product_data[0];
														$temp_quantity -= $product_data[0];
														$temp_value = 1;
													}
													
													if($remaining_quantity < 0) {
														$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
														$amount += (abs($ac_quantity_sale)) * $product_data[1];
													} else {
														if($remaining_quantity == 0) {
															$buy_amount += $product_data[0] * $ac_discount;
															$amount += $product_data[0] * $product_data[1];
														}
													}													
												}												
												$discount_total = $amount - $buy_amount;	
											}											
											
										} else { // both array not found
											
											$quantity_array = array();
																						
											$buy_amount = 0;
											$amount = 0;
											
											for($i=0; $i<count($ac_base['quantity']); $i++) {
												array_push($quantity_array, $ac_base['quantity'][$i] . "," . $ac_base['price'][$i]);
											}
											
											rsort($quantity_array);
											$temp_quantity = $ac_quantity_sale;
											
											for($i=0; $i<count($quantity_array); $i++) {
												$product_data = explode(",", $quantity_array[$i]);											
												$temp_value = 0;
												
												$remaining_quantity = 1;
													
												if($temp_quantity > 0) {
													$remaining_quantity = $temp_quantity - $product_data[0];
													$temp_quantity -= $product_data[0];
													$temp_value = 1;
												}
												
												if($remaining_quantity < 0) {
													$buy_amount += (abs($ac_quantity_sale)) * $ac_discount;
													$amount += (abs($ac_quantity_sale)) * $product_data[1];
												} else {
													if($remaining_quantity == 0) {
														$buy_amount += $product_data[0] * $ac_discount;
														$amount += $product_data[0] * $product_data[1];
													}
												}												
											}
											$discount_total = $amount - $buy_amount;
										}
									}
								} 
							}
							
						} else {
							$sub_total = $ac_cart_total;
							
							if($ac_quantity_total != 0) {
								if($ac_product_buy_array) {
									if($ac_product_sale_array) {
										
										$buy_amount = 0;
										$amount = 0;
										
										for($i=0; $i<count($ac_product['quantity']); $i++) {
											$amount += $ac_product['price'][$i] * $ac_product['quantity'][$i];
											$buy_amount += $ac_discount * $ac_product['quantity'][$i];
										}											
										$discount_total = $amount - $buy_amount;
										
									} else { // product sale not found										
										$buy_amount = 0;
										$amount = 0;										
										for($i=0; $i<count($ac_base['quantity']); $i++) {
											$buy_amount += $ac_base['quantity'][$i] * $ac_discount;
											$amount += $ac_base['price'][$i] * $ac_base['quantity'][$i];
										}

										$discount_total = $amount - $buy_amount;
									}
								} else { // product buy not found
									if($ac_product_sale_array) {										
										
										for($i=0; $i<count($ac_product['quantity']); $i++) {
											$amount += $ac_product['price'][$i] * $ac_product['quantity'][$i];
											$buy_amount += $ac_discount * $ac_product['quantity'][$i];
										}											
										$discount_total = $amount - $buy_amount;
										
										unset($buy_amount);
										unset($amount);
										
									} else { // both not found
										$buy_amount = 0;
										$amount = 0;
										
										for($i=0; $i<count($ac_base['quantity']); $i++) {
											$buy_amount += $ac_base['quantity'][$i] * $ac_discount;
											$amount += $ac_base['price'][$i] * $ac_base['quantity'][$i];
										}
										$discount_total = $amount - $buy_amount;
									}
								}
								
							} else {
								if($ac_product_buy_array) {
									if($ac_product_sale_array) {										
										$amount = 0;		
										$buy_amount = 0;								
										for($i=0; $i<count($ac_product['quantity']); $i++) {
											$amount += $ac_product['total'][$i];
											$buy_amount += $ac_discount * $ac_product['quantity'][$i]; 
										} 
										
										$discount_total = $amount - $buy_amount;									
									} else { // found when product sale is not defined
										$buy_amount = $ac_discount * $ac_base_quantity;										
										$discount_total = $sub_total - $buy_amount;
									}
								} else { // product buy not found
									if($ac_product_sale_array) {										
										$amount = 0;		
										$buy_amount = 0;								
										for($i=0; $i<count($ac_product['quantity']); $i++) {
											$amount += $ac_product['total'][$i];
											$buy_amount += $ac_discount * $ac_product['quantity'][$i]; 
										} 
										
										$discount_total = $amount - $buy_amount;												
									} else { // both not found
										$buy_amount = $ac_discount * $ac_base_quantity;										
										$discount_total = $sub_total - $buy_amount;
									}
								}
							}							
						}
						
						
						foreach ($ac_discount_product['price'] as $key => $val) {
							$tax_rates = $this->tax->getRates(($sub_total - $discount_total), $ac_discount_product['tax_class_id'][$key]);
							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									$taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
								} 
							}
						}	
					}
						
				}
	
				if ($result['shipping'] && isset($this->session->data['shipping_method'])) {
					if (!empty($this->session->data['shipping_method']['tax_class_id'])) {
						$tax_rates = $this->tax->getRates($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id']);
						foreach ($tax_rates as $tax_rate) {
							if ($tax_rate['type'] == 'P') {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}
					$discount_total += $this->session->data['shipping_method']['cost'];	
				}
	
				$total_promotion_sales_data[] = array(
					'code'       => 'advanced_coupon',
	    			'title'      => sprintf($this->language->get('text_advanced_coupon'), $result['name'], $result['code']),
	    			'text'       => $this->currency->format(-$discount_total),
	    			'value'      => -$discount_total,
					'sort_order' => $this->config->get('advanced_coupon_sort_order')
	  			);
				
				
				
				
				
				}
				
			}
	
			if(isset($total_promotion_sales_data)) {
				foreach ($total_promotion_sales_data as $key => $row) {
					$value[$key]  = $row['value'];
				}
							
				if($this->config->get('advanced_coupon_multiple') == 1) {
					// Multiple Advanced Coupons
					foreach ($total_promotion_sales_data as $key => $row) {
						
						$row_value = $row['value'];
						$row_text = $row['text'];
						if($total <= 0) {
							$row_value = 0;
							$row_text = $this->currency->format($row_value);
						}
								
						$total_data[] = array(
						'code'       => $row['code'],
						'title'      => $row['title'],
						'text'       => $row_text,
						'value'      => $row_value,
						'sort_order' => $row['sort_order']
						);
						
						$total += $row_value;
					}
				} else {
					// Single Advanced Coupon
					// Sort for most benefited promotion
					array_multisort($value, SORT_ASC, $total_promotion_sales_data);		
				
					$total_data[] = array(
						'code'       => $total_promotion_sales_data[0]['code'],
						'title'      => $total_promotion_sales_data[0]['title'],
						'text'       => $total_promotion_sales_data[0]['text'],
						'value'      => $total_promotion_sales_data[0]['value'],
						'sort_order' => $total_promotion_sales_data[0]['sort_order']
					);
	
					$total += $total_promotion_sales_data[0]['value'];		
				}
			}
		}
	}
		
		
	public function confirm($order_info, $order_total) {
		$code = '';
		
		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');
		
		if ($start && $end) {  
			$code = substr($order_total['title'], $start, $end - $start);
		}	
		
		$this->load->model('checkout/advanced_coupon');
		
		$advanced_coupon_id = $this->model_checkout_advanced_coupon->getAdvancedCouponId($code);
		
		if ($advanced_coupon_id) {
			$this->model_checkout_advanced_coupon->redeem($advanced_coupon_id, $order_info['order_id'], $order_info['customer_id'], $order_total['value']);	
		}						
    }
		
}
?>
