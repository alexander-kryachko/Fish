<?php
class ModelCheckoutMC360 extends Model {
	public function getOrderInfo($order_id) {
		$order_info = false;
		$order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
		if (!empty($order_query->row)) {
			$items = array();
			$tax = 0;
		
			$product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'");
		
			foreach ($product_query->rows as $product) {
				$category_query = $this->db->query("SELECT ptc.category_id, cd.name FROM `" . DB_PREFIX . "product_to_category` ptc LEFT JOIN `" . DB_PREFIX . "category_description` cd ON ptc.category_id = cd.category_id WHERE ptc.product_id = '" . (int)$product['product_id']  . "' LIMIT 1");
			
				if(!empty($category_query->row)) {
					$category_id = $category_query->row['category_id'];
					$category_name = $category_query->row['name'];
				} else {
					$category_id = '999';
					$category_name = 'No Category';
				}
			
				$tax += $product['tax'];
			
				$items[] = array(
					'product_id'	=> $product['product_id'],
					'product_name'	=> $product['name'],
					'category_id'	=> $category_id,
					'category_name'	=> $category_name,
					'qty'			=> $product['quantity'],
					'cost'			=> round($product['price'],2)
				);
			}

			$order_info = array(
				'id'		  => (int)$order_id,
				'email_id'	  => false,
				'email'		  => $order_query->row['email'],
				'campaign_id' => false,
				'total'		  => round($order_query->row['total'],2),
				'tax'		  => round($tax,2),
				'shipping'	  => round($this->session->data['mc_shipping'],2),
				'store_id'	  => $this->config->get('mc360_store'),
				'store_name'  => str_replace(array('http:','https:','/'), '', $this->config->get('config_url')),
				'plugin_id'	  => NULL,
				'items'		  => $items
			);
		}
		return $order_info;
	}
}
?>