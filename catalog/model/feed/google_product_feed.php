<?php
class ModelFeedGoogleProductFeed extends Model {
	
	public function getProduct($product_id, $language_id) {
				

		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
				
		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$language_id . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$language_id . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$language_id . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$language_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

				
		
		if ($query->num_rows) {
			$query->row['price'] = ($query->row['discount'] ? $query->row['price']*$query->row['discount']/100 : $query->row['price']);
			$query->row['rating'] = (int)$query->row['rating'];
			
			return $query->row;
		} else {
			return false;
		}
	}

	public function getProducts($language_code) {
		$product_data = array();
		
		$query = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE `code` ='" . $language_code . "'");
		$language_id = $query->row['language_id'];
		
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE `status` = '1' AND gpf_status = '1'");
		
		if ($query->num_rows) {
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id'], $language_id);
			}
		
			return $product_data;
		} else {
			return false;
		}
	}
	
		
	public function getLanguageCode() {
				
			$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `key` = 'config_language'");
		 	 
			foreach ($query->rows as $result) {
				$language_code = $result['value'];
			}
			
		
		return $language_code;
	}
	
		
	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	
	public function getCategories($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		
		return $query->rows;
	}	

	public function isInstalled($currency) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE `code` = '" . $currency . "'");
		
		if($query->num_rows) {
			return TRUE;
		} else {
			return FALSE;
		}
	}	

	public function getSEOURL($product_id) {
		
		$query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE `query` ='product_id=" . $product_id . "'");
		
		if ($query->num_rows) {
				$keyword = $query->row['keyword'];
		
			return $keyword;
		} else {
			return false;
		}
	}
	
	public function getSSL($version, $store_id = 0) {
	
		if($version >= '1.5.5') {
			$ssl = 'config_secure';
		} else {
			$ssl = 'config_use_ssl';
		}
		
		$query = $this->db->query("SELECT `value` FROM " . DB_PREFIX . "setting WHERE `key` ='" . $ssl . "' AND `store_id` = '" . $store_id. "'");
		
		if ($query->num_rows) {
				$value = $query->row['value'];
		
			return $value;
		} else {
			return false;
		}
	}
	
}
?>