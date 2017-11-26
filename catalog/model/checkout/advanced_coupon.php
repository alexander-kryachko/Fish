<?php
class ModelCheckoutAdvancedCoupon extends Model {

	public function getCouponInfo($code) {
		$sql = $this->db->query("SELECT * FROM `" . DB_PREFIX. "advanced_coupon` WHERE code='" . $code. "' AND status = 1");		
		return $sql;
	}
	
	public function getSpecialProductInfo($product_id) {
		$sql = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_special` WHERE product_id='" . (int)$product_id . "'");
		return $sql->num_rows;
	}
	
	public function getDiscountProductInfo($product_id) {
		$sql = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_discount` WHERE product_id='" . (int)$product_id . "'");
		return $sql->num_rows;
	}
	
	public function getAdvancedCoupon($code) {
		
		$advanced_coupon_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_coupon c WHERE (c.code = '" . $this->db->escape($code) . "') AND ((c.date_start = '0000-00-00' OR c.date_start < NOW()) AND (c.date_end = '0000-00-00' OR c.date_end > NOW())) AND c.status = '1'");
		
		if ($advanced_coupon_query->num_rows) {
			
			foreach ($advanced_coupon_query->rows as $advanced_coupon_result) {
				 
				$status = true;
				
				$advanced_coupon_options = unserialize($advanced_coupon_result['options']);
			
				unset($advanced_coupon_result['options']);
			
				$result = array_merge($advanced_coupon_result, $advanced_coupon_options);
				
				// check for the product buy
				if(count($result['category_buy']) > 0) {
					for($i=0; $i<count($result['category_buy']); $i++) {
						$product_id_list = $this->model_checkout_advanced_coupon->getProductList($result['category_buy'][$i]);
						
						if($product_id_list) {
							foreach($product_id_list as $k => $p) {
								foreach ($p as $pro_id) {
									if(count($result['product_buy']) > 0) {
										if(!in_array($pro_id, $result['product_buy'])) {
											array_push($result['product_buy'], $pro_id);
										}
									} else {
										array_push($result['product_buy'], $pro_id);
									}
								}
							}
						}
						
					}
				}
				
				if(count($result['manufacturer_buy']) > 0) {
					for($i=0; $i<count($result['manufacturer_buy']); $i++) {
						$product_id_lists = $this->model_checkout_advanced_coupon->getProductLists($result['manufacturer_buy'][$i]);
						
						if($product_id_lists) {
							foreach($product_id_lists as $k => $p) {
								foreach($p as $pro_id) {
									if(count($result['product_buy']) > 0) {
										if(!in_array($pro_id, $result['product_buy'])) {
											array_push($result['product_buy'], $pro_id);
										}
									} else {
										array_push($result['product_buy'], $pro_id);
									}
								}
							}
						}
					}
				}
				
				//print "<pre>"; print_r($result['product_buy']); exit;
				
				//check for the product
				if(count($result['category']) > 0) {
					for($i=0; $i<count($result['category']); $i++) {
						$product_id_list = $this->model_checkout_advanced_coupon->getProductList($result['category'][$i]);
						
						if($product_id_list) {
							foreach($product_id_list as $k => $p) {
								foreach ($p as $pro_id) {
									if(count($result['product']) > 0) {
										if(!in_array($pro_id, $result['product'])) {
											array_push($result['product'], $pro_id);
										}
									} else {
										array_push($result['product'], $pro_id);
									}
								}
							}
						}
						
					}
				}
				
				if(count($result['manufacturer']) > 0) {
					for($i=0; $i<count($result['manufacturer']); $i++) {
						$product_id_lists = $this->model_checkout_advanced_coupon->getProductLists($result['manufacturer'][$i]);
						
						if($product_id_lists) {
							foreach($product_id_lists as $k => $p) {
								foreach($p as $pro_id) {
									if(count($result['product']) > 0) {
										if(!in_array($pro_id, $result['product'])) {
											array_push($result['product'], $pro_id);
										}
									} else {
										array_push($result['product'], $pro_id);
									}
								}
							}
						}
					}
				}
				
				$counter_buy = count($result['product_buy']);
				$counter = count($result['product']);
				
				//echo $counter_buy; exit;
				
				// Condition to display promotion when user logged in
				if ($result['logged'] && !$this->customer->getId()) {
					$status = false;
				}
				
				
				
				// Condition for store
				if(isset($result['store'])) {
				if (!(in_array((int)$this->config->get('config_store_id'), $result['store']))) {
						$status = false;
					}
				}
				
				// Condition For Customer Group
				if($this->customer->getId()) {	
					if(isset($result['customer_group'])) {
						if (!(in_array((int)$this->customer->getCustomerGroupId(), $result['customer_group']))) {
							$status = false;
						}
					}
				}
				
				// Condition For Currency
				if(isset($result['currency'])) {
				if (!(in_array((int)$this->currency->getId(), $result['currency']))) {
						$status = false;
					}
				}
							
				// Condition For Language
				if(isset($result['language'])) {
				if (!(in_array((int)$this->getLanguageId($this->session->data['language']), $result['language']))) {
						$status = false;
					}
				}
							
				// Condition For Day
				if(isset($result['day'])) {
				if (!(in_array(date("l"), $result['day']))) {
						$status = false;
					}
				}
						
				
				// Condition for total uses of promotion
				$advanced_coupon_history_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "advanced_coupon_history` ch WHERE ch.advanced_coupon_id = '" . (int)$result['advanced_coupon_id'] . "'");
	
				if ($result['uses_total'] > 0 && ($advanced_coupon_history_query->row['total'] >= $result['uses_total'])) {
					$status = false;
				}
				
				// Condition for total uses of promotion per customer							
				if ($this->customer->getId()) {
					$advanced_coupon_history_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "advanced_coupon_history` ch WHERE ch.advanced_coupon_id = '" . (int)$result['advanced_coupon_id'] . "' AND ch.customer_id = '" . (int)$this->customer->getId() . "'");
					
					if ($result['uses_customer'] > 0 && ($advanced_coupon_history_query->row['total'] >= $result['uses_customer'])) {
						$status = false;
					}
				}
				
				// Works With Coupon or Not
				if($result['coupon_combine'] == 0 && isset($this->session->data['coupon'])){
					$status = false;	
				}
				
				// Special Products
				$ac_special_product = array();
				if($result['special_combine'] == 0) {
					$ac_special_products = $this->getAdvancedCouponProductSpecials();	
					foreach($ac_special_products as $key=>$value) {
		                $ac_special_product[$key] = $value['product_id'];
					}
										
				}
				
				// Discounted Products
				$ac_discount_product = array();
				if($result['discount_combine'] == 0) {
					$ac_discount_products = $this->getAdvancedCouponProductDiscounts();	
					foreach($ac_discount_products as $key=>$value) {
		               	$ac_discount_product[$key] = $value['product_id'];
					}
				}
				
				$ac_base_quantity = 0;
				$ac_base_total = 0;
				$ac_product_quantity = 0;
				$ac_product_total = 0;
				$ac_product_buy_quantity = 0;
				$ac_product_buy_total = 0;
				
				unset($ac_base);
				unset($ac_product);
				unset($ac_product_buy);
										
				$sp=0;
				$ac_total=0;
				$ac_buy=0;
				$ac_base = array();
				$ac_product = array();
				$ac_product_buy = array();
				
				foreach ($this->cart->getProducts() as $product) {
					
					// Condition For Special Products
					if($ac_special_product) {
						if (in_array($product['product_id'], $ac_special_product)) {
							continue;	
						}
					}
					
					// Condition For Discounted Products					
					if($ac_discount_product) {
						if (in_array($product['product_id'], $ac_discount_product)) {
							continue;	
						}
					}
					
					$base_quantity = $product['quantity'];
					$base_product_id = $product['product_id'];
					$base_total = $product['total'];
					$base_price = $product['price'];
					$base_tax_class_id = $product['tax_class_id'];
						
					$ac_base['quantity'][$sp] = $base_quantity;
					$ac_base['total'][$sp] = $base_total;
					$ac_base['price'][$sp] = $base_price;	
					$ac_base['tax_class_id'][$sp] = $base_tax_class_id;
					$ac_base['product_id'][$sp] = $base_product_id;
					$ac_base_quantity += $base_quantity;
					$ac_base_total += $base_total;
					$sp++;
					
					if($result['product']) {
						if($result['product_type'] == 1) {
							if(in_array($base_product_id, $result['product'])) {
								$ac_product['quantity'][$ac_total] = $base_quantity;
								$ac_product['total'][$ac_total] = $base_total;
								$ac_product['price'][$ac_total] = $base_price;
								$ac_product['tax_class_id'][$ac_total] = $base_tax_class_id;
								$ac_product['product_id'][$ac_total] = $base_product_id;
								$ac_product_quantity += $base_quantity;
								$ac_product_total += $base_total;
								$ac_total++;
								$counter -= 1;
							}
						} else {
							if(in_array($base_product_id, $result['product'])) {
								$ac_product['quantity'][$ac_total] = $base_quantity;
								$ac_product['total'][$ac_total] = $base_total;
								$ac_product['price'][$ac_total] = $base_price;
								$ac_product['tax_class_id'][$ac_total] = $base_tax_class_id;
								$ac_product['product_id'][$ac_total] = $base_product_id;
								$ac_product_quantity += $base_quantity;
								$ac_product_total += $base_total;
								$ac_total++;
								$counter = 0;
							}
						}
					}
					
					if($result['product_buy']) {
						if($result['product_buy_type'] == 1) {
							if (in_array($base_product_id, $result['product_buy'])) {
								$ac_product_buy['quantity'][$ac_buy] = $base_quantity;
								$ac_product_buy['total'][$ac_buy] = $base_total;
								$ac_product_buy['price'][$ac_buy] = $base_price;
								$ac_product_buy['tax_class_id'][$ac_buy] = $base_tax_class_id;
								$ac_product_buy['product_id'][$ac_buy] = $base_product_id;
								$ac_product_buy_quantity += $base_quantity;
								$ac_product_buy_total += $base_total;
								$ac_buy++;
								$counter_buy -= 1;
							}
						} else {
							if (in_array($base_product_id, $result['product_buy'])) {
								$ac_product_buy['quantity'][$ac_buy] = $base_quantity;
								$ac_product_buy['total'][$ac_buy] = $base_total;
								$ac_product_buy['price'][$ac_buy] = $base_price;
								$ac_product_buy['tax_class_id'][$ac_buy] = $base_tax_class_id;
								$ac_product_buy['product_id'][$ac_buy] = $base_product_id;
								$ac_product_buy_quantity += $base_quantity;
								$ac_product_buy_total += $base_total;
								$ac_buy++;
								$counter_buy = 0;
							}
						}
					}					
				}
				
				if($counter > 0) {
					//echo $counter;
					$status = false;
				}
				
				if($counter_buy > 0) {
					$status = false;
				}
				
				// Condition for Total Amount
				$ac_total = $result['total'];
				$cart_subtotal = $ac_base_total;
			
				if(strpos($ac_total,"-") !== false) {
	     			$ac_total_limit = explode("-", $ac_total);
	    			if (($ac_total_limit[0] > $cart_subtotal) || ($ac_total_limit[1] <  $cart_subtotal)) {
					$status = false;
					}     
	   			}
				else {
	  				if ($ac_total > $cart_subtotal) {
					$status = false;
	       			}
				}	
				
				// Condition for Total Quantity
				$ac_quantity_total = $result['quantity_total'];
				$cart_quantity_total = $ac_base_quantity;
				
				if(strpos($ac_quantity_total,"-") !== false) {
	     			$ac_quantity_total_limit = explode("-", $ac_quantity_total);
		    			if (($ac_quantity_total_limit[0] > $cart_quantity_total) || ($ac_quantity_total_limit[1] <  $cart_quantity_total)) {
						$status = false;
					}     
	   			}
				else {
	  				if ($ac_quantity_total > $cart_quantity_total) {
						$status = false;
	       			}
				}	
				
				//Condition for Sale Quantity and Buy Quantity Without Selected Products
				if (($result['quantity_sale'] + $result['quantity_buy']) > ($cart_quantity_total)) {
						$status = false;
					}
				
				// Condition For Sale Quantity With Selected Products
				if ($result['product']) {
						if (($ac_product_quantity < $result['quantity_sale']) || ($ac_product_quantity < 1)) {
							$status = false;
						}	
					}
				
				// Condition For Buy Quantity With Selected Products
				if ($result['product_buy']) {
						if (($ac_product_buy_quantity < $result['quantity_buy']) || ($ac_product_buy_quantity < 1)) {
							$status = false;
						}	
					}
				
				//Condition for Buy Quantity and Sale Quantity With Selected Products
				if($result['product'] && $result['product_buy']) {
					if($ac_product == $ac_product_buy) {
						if($ac_product_quantity < ($result['quantity_buy']+$result['quantity_sale'])) {
							$status = false;	
							}
						}
						
					if (($ac_product_quantity + $ac_product_buy_quantity) < ($result['quantity_sale'] + $result['quantity_buy'])) {
						$status = false;
					}		
				}
				
								
				if ($status) {
				 	$advanced_coupon_data[] = array(
						'advanced_coupon_id' 		=> $result['advanced_coupon_id'],
						'code'           			=> $result['code'],
						'name'           			=> $result['name'],
						'type'           			=> $result['type'],
						'quantity_type'           	=> $result['quantity_type'],
						'discount'       			=> $result['discount'],
						'total'          			=> $result['total'],
						'quantity_total' 			=> $result['quantity_total'],
						'quantity_sale'  			=> $result['quantity_sale'],
						'quantity_buy'   			=> $result['quantity_buy'],
						'quantity_type'  			=> $result['quantity_type'],
						'shipping'       			=> $result['shipping'],
						'ac_product_sale_type'		=> $result['product_type'],
						'ac_product_buy_type'		=> $result['product_buy_type'],
						'ac_product_sale_array'		=> $result['product'],
						'ac_product_buy_array'		=> $result['product_buy'],
						'ac_base'     				=> $ac_base,
						'ac_base_quantity'       	=> $ac_base_quantity,
						'ac_base_total'       	    => $ac_base_total,
						'ac_product'     			=> $ac_product,
						'ac_product_quantity'       => $ac_product_quantity,
						'ac_product_total'          => $ac_product_total,
						'ac_product_buy' 			=> $ac_product_buy,
						'ac_product_buy_quantity'   => $ac_product_buy_quantity,
						'ac_product_buy_total'      => $ac_product_buy_total,
						'date_start'     			=> $result['date_start'],
						'date_end'       			=> $result['date_end'],
						'uses_total'     			=> $result['uses_total'],
						'uses_customer'  			=> $result['uses_customer'],
						'status'         			=> $result['status'],
						'date_added'     			=> $result['date_added']
					);
				  } 
			}
		
			if(isset($advanced_coupon_data)) {
				return $advanced_coupon_data;
			}
		}
		
	}
	
	
	public function redeem($advanced_coupon_id, $order_id, $customer_id, $amount) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "advanced_coupon_history` SET advanced_coupon_id = '" . (int)$advanced_coupon_id . "', order_id = '" . (int)$order_id . "', customer_id = '" . (int)$customer_id . "', amount = '" . (float)$amount . "', date_added = NOW()");
	}
	
	public function getAdvancedCouponId($code) {
	
		$advanced_coupon_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_coupon WHERE code = '" . $this->db->escape($code) . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");
	
	    if ($advanced_coupon_query->num_rows) {
			$advanced_coupon_id = $advanced_coupon_query->row['advanced_coupon_id'];
		}
		return $advanced_coupon_id;
	}
	
	public function getAdvancedCouponNameCode($advanced_coupon_id) {
	
		$advanced_coupon_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_coupon c WHERE c.advanced_coupon_id = '" . $advanced_coupon_id . "' AND ((c.date_start = '0000-00-00' OR c.date_start < NOW()) AND (c.date_end = '0000-00-00' OR c.date_end > NOW()))");
		
		if ($advanced_coupon_query->num_rows) {
			$advanced_coupon_options = unserialize($advanced_coupon_query->row['options']);
			// Condition for store
			if ((in_array((int)$this->config->get('config_store_id'), $advanced_coupon_options['store']))) {
				$advanced_coupon['name'] = $advanced_coupon_query->row['name'];	
				$advanced_coupon['code'] = $advanced_coupon_query->row['code'];	
			}
		} else {
			$advanced_coupon['name'] = ""; 
			$advanced_coupon['code'] = ""; 
		}
		
		return $advanced_coupon;
	
	}
	
	public function getAdvancedCouponProducts($advanced_coupon_id, $advanced_coupon_product_setting) {
		$product_data = array();
		
		$advanced_coupon_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_coupon c WHERE c.advanced_coupon_id = '" . $advanced_coupon_id . "' AND ((c.date_start = '0000-00-00' OR c.date_start < NOW()) AND c.status = '1' AND (c.date_end = '0000-00-00' OR c.date_end > NOW()))");
	
		if ($advanced_coupon_query->num_rows) {
			$advanced_coupon_options = unserialize($advanced_coupon_query->row['options']);
			
			//print "<pre>"; print_r($advanced_coupon_options);
			
			if($advanced_coupon_product_setting == 'product') {
				//$advanced_coupon_products = $advanced_coupon_options['product'];
				
				if(isset($advanced_coupon_products)) {
					unset($advanced_coupon_products);
				}
				
				$advanced_coupon_products = array();
				
				if($advanced_coupon_options['category']) {
					foreach($advanced_coupon_options['category'] as $category_id) {
						$product_id_lists = $this->getCategoryProductLists($category_id);
												
						if($product_id_lists->num_rows != 0) {
							foreach ($product_id_lists->rows as $key => $product_ids) {
								foreach($product_ids as $product_id) {
									array_push($advanced_coupon_products, $product_id);
								}
							}	
						}
												
					}
				} 
				
				if($advanced_coupon_options['manufacturer']) {
					foreach($advanced_coupon_options['manufacturer'] as $manufacturer_id) {
						$product_id_lists = $this->getManufacturerProductLists($manufacturer_id);
						
						if($product_id_lists->num_rows != 0) {
							
							foreach ($product_id_lists->rows as $key => $product_ids) {
								foreach($product_ids as $product_id) {
									$found = 0;
									if(count($advanced_coupon_products) > 0) {
										if(in_array($product_id, $advanced_coupon_products)) {
											$found = 1;
										}
										
										if($found == 0) {
											array_push($advanced_coupon_products, $product_id);
										}
										
									} else {
										array_push($advanced_coupon_products, $product_id);
									}
								}
							}
						}
					}
				}
				
				if($advanced_coupon_options['product']) {
					foreach($advanced_coupon_options['product'] as $product_id) {
						$found = 0;
						if(count($advanced_coupon_products) > 0) {
							if(in_array($product_id, $advanced_coupon_products)) {
								$found = 1;
							}
							
							if($found == 0) {
								array_push($advanced_coupon_products, $product_id);
							}
							
						} else {
							array_push($advanced_coupon_products, $product_id);
						}
					}
				}
					
			} else {
				
				if(isset($advanced_coupon_products)) {
					unset($advanced_coupon_products);
				}
				
				$advanced_coupon_products = array();
				
				if($advanced_coupon_options['category_buy']) {
					foreach($advanced_coupon_options['category_buy'] as $category_id) {
						$product_id_lists = $this->getCategoryProductLists($category_id);
												
						if($product_id_lists->num_rows != 0) {
							foreach ($product_id_lists->rows as $key => $product_id) {
								foreach($product_ids as $product_id) {
									array_push($advanced_coupon_products, $product_id);
								}
							}	
						}
												
					}
				} 
				
				if($advanced_coupon_options['manufacturer_buy']) {
					foreach($advanced_coupon_options['manufacturer_buy'] as $manufacturer_id) {
						$product_id_lists = $this->getManufacturerProductLists($manufacturer_id);
						
						if($product_id_lists->num_rows != 0) {
							
							foreach ($product_id_lists->rows as $key => $product_id) {
								foreach($product_id as $product_id) {
									$found = 0;
									if(count($advanced_coupon_products) > 0) {
										if(in_array($product_id, $advanced_coupon_products)) {
											$found = 1;
										}
										
										if($found == 0) {
											array_push($advanced_coupon_products, $product_id);
										}
										
									} else {
										array_push($advanced_coupon_products, $product_id);
									}
								}
							}
						}
					}
				}
				
				if($advanced_coupon_options['product_buy']) {
					foreach($advanced_coupon_options['product_buy'] as $product_id) {
						$found = 0;
						if(count($advanced_coupon_products) > 0) {
							if(in_array($product_id, $advanced_coupon_products)) {
								$found = 1;
							}
							
							if($found == 0) {
								array_push($advanced_coupon_products, $product_id);
							}
							
						} else {
							array_push($advanced_coupon_products, $product_id);
						}
					}
				}
				
			}
			
			// Condition for store
			if ((in_array((int)$this->config->get('config_store_id'), $advanced_coupon_options['store']))) {
				foreach ($advanced_coupon_products as $product_id) { 
					$product_data[$product_id] = $this->model_catalog_product->getProduct($product_id);
				}
			} 
			
		}
		return $product_data;
	}
		
	public function getAdvancedCouponProductDiscounts() {
		$query = $this->db->query("SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_discount ORDER BY quantity, priority, price");
		return $query->rows;
	}
	
	public function getAdvancedCouponProductSpecials() {
		$query = $this->db->query("SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_special ORDER BY priority, price");
		return $query->rows;
	}
	
	public function getLanguageId($code) {
	
		$language_query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE code = '" . $this->db->escape($code) . "' AND status = '1'");
	
	    if ($language_query->num_rows) {
			$language_id = $language_query->row['language_id'];
		}
		return $language_id;
	}
	
	public function getCategoryId($product_id) {
		$sql = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "product_to_category` WHERE product_id='" . (int)$product_id . "'");
		return $sql;
	}
	
	public function getManufacturerId($product_id) {
		$sql = $this->db->query("SELECT manufacturer_id FROM `" . DB_PREFIX . "product` WHERE product_id='" . (int)$product_id . "'");
		return $sql->row['manufacturer_id'];
	}
	
	public function getCategoryProductLists($category_id) {
		$sql = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product_to_category` WHERE category_id='" . (int)$category_id . "'");
		return $sql;
	}
	
	public function getManufacturerProductLists($manufacturer_id) {
		$sql = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product` WHERE manufacturer_id='" . (int)$manufacturer_id . "'");
		return $sql;
	}
	
	public function getProductList($category_id) {
		$sql = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product_to_category` WHERE category_id='" . (int)$category_id. "'");
		return $sql->rows;
	}
	
	public function getProductLists($manufacturer_id) {
		$sql = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product` WHERE manufacturer_id='" . (int)$manufacturer_id . "'");
		return $sql->rows;
	}
	
}
?>