<?php
class ModelCatalogVger extends Model {
	public function getProductVger($product_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
				
		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
		
		if ($query->num_rows) {
			$query->row['price'] = ($query->row['discount'] ? $query->row['price']*$query->row['discount']/100 : $query->row['price']);
			$query->row['rating'] = (int)$query->row['rating'];
			
			return $query->row;
		} else {
			return false;
		}
	}

	public function getBestSellerProductsByCat($limit) {
				
		$path_id = '';
		$product_data_raw = '';
		
		if (isset($this->request->get['path'])) {
			$path = $this->request->get['path'];
			$cat = explode ("_", $path);
			$path_id = end($cat);
		}
		
		$top_test = false;
		
		if ($path_id) {
			$category_data = $this->model_catalog_category->getCategory($path_id);
			if ($category_data['top'] == '1') {
				$top_test = true;
			}	
		}

		if (!$path_id){
			$path_id = 0;
		}
						
		$product_data = array();
			
		$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)  LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2c.category_id = " . $path_id . " GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);
			
		if ($query->num_rows) {
			foreach ($query->rows as $result) { 		
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
			}
			
		} elseif ($top_test == true) {
			$children = $this->model_catalog_category->getCategories($path_id);
			foreach ($children as $child) {
				$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)  LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2c.category_id = " . $child['category_id'] . " GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);
				if ($query->num_rows) {
					foreach ($query->rows as $result) { 		
						$product_data_raw[$result['product_id']] = $this->getProductVger($result['product_id']);
					}
				}
			}
			
			if ($product_data_raw) {
				$shuffleKeys = array_keys($product_data_raw);
				shuffle($shuffleKeys);
				$product_data = array();
				foreach($shuffleKeys as $key) {
		    		$product_data[$key] = $product_data_raw[$key];
				}
			
				$product_data = array_slice($product_data, 0, (int)$limit); 
			}
								
		} else {
			$product_data = $this->cache->get('product.bestsellerbycat.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);
				if (!$product_data) { 
					$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

						foreach ($query->rows as $result) { 		
						$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
						}
				$this->cache->set('product.bestsellerbycat.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
			}
		}
		
		if (!$product_data) { 
			$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);
	 	 
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
		}
		
		$this->cache->set('product.latestbycat.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $product_data);
		}
		
		return ($product_data);
	}
	
	public function getProductSpecialsByCat($limit) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
		
		$path_id = '';
		$product_data_raw = '';
		
		if (isset($this->request->get['path'])) {
			$path = $this->request->get['path'];
			$cat = explode ("_", $path);
			$path_id = end($cat);
		}
		
		$top_test = false;
		
		if ($path_id) {
			$category_data = $this->model_catalog_category->getCategory($path_id);
			if ($category_data['top'] == '1') {
				$top_test = true;
			}	
		}

		if (!$path_id){
			$path_id = 0;
		}

		$product_data = array();
			
		$query = $this->db->query("SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND p2c.category_id = '" . $path_id . "' GROUP BY ps.product_id LIMIT " . (int)$limit);

		if ($query->num_rows) {
			foreach ($query->rows as $result) { 		
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
			}
			
		} elseif ($top_test == true) {
			$children = $this->model_catalog_category->getCategories($path_id);
			foreach ($children as $child) {
				$query = $this->db->query("SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) AND p2c.category_id = '" . $child['category_id'] . "' GROUP BY ps.product_id LIMIT " . (int)$limit);
				if ($query->num_rows) {
					foreach ($query->rows as $result) { 		
						$product_data_raw[$result['product_id']] = $this->getProductVger($result['product_id']);
					}
				}
			}
			
			if ($product_data_raw) {
				$shuffleKeys = array_keys($product_data_raw);
				shuffle($shuffleKeys);
				$product_data = array();
				foreach($shuffleKeys as $key) {
	   				$product_data[$key] = $product_data_raw[$key];
				}
			
				$product_data = array_slice($product_data, 0, (int)$limit); 
			}
					
		} else {
			$product_data = $this->cache->get('product.specialsbycat.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);
				if (!$product_data) { 
					$query = $this->db->query("SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id LIMIT " . (int)$limit);
					
					foreach ($query->rows as $result) { 		
						$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
					}
				$this->cache->set('product.specialsbycat.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
			}
		}
		
		if (!$product_data) { 
			$query = $this->db->query("SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id LIMIT " . (int)$limit);
	 	 
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
		}
		
		$this->cache->set('product.specialsbycat.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
		}
		return $product_data;
	}
		
	public function getLatestProductsByCat($limit) {
	
		$path_id = '';
		$product_data_raw = '';
		
		if (isset($this->request->get['path'])) {
			$path = $this->request->get['path'];
			$cat = explode ("_", $path);
			$path_id = end($cat);
		}
		
		$top_test = false;
		
		if ($path_id) {
			$category_data = $this->model_catalog_category->getCategory($path_id);
			if ($category_data['top'] == '1') {
				$top_test = true;
			}	
		}

		if (!$path_id){
			$path_id = 0;
		}
		
		$product_data = array();
		
		$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2c.category_id = " . $path_id . " ORDER BY p.date_added DESC LIMIT " . (int)$limit);
		
		if ($query->num_rows) {
			foreach ($query->rows as $result) { 		
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
			}
			
		} elseif ($top_test == true) {
			$children = $this->model_catalog_category->getCategories($path_id);
			foreach ($children as $child) {
				$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2c.category_id = " . $child['category_id'] . " ORDER BY p.date_added DESC LIMIT " . (int)$limit);
				if ($query->num_rows) {
					foreach ($query->rows as $result) { 		
						$product_data_raw[$result['product_id']] = $this->getProductVger($result['product_id']);
					}
				}
			}
			
			if ($product_data_raw) {
				$shuffleKeys = array_keys($product_data_raw);
				shuffle($shuffleKeys);
				$product_data = array();
				foreach($shuffleKeys as $key) {
		    		$product_data[$key] = $product_data_raw[$key];
				}
			
				$product_data = array_slice($product_data, 0, (int)$limit); 
			}
								
		} else {
			$product_data = $this->cache->get('product.latestbycat.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit);
			if (!$product_data) { 
				$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);
		 	 
				foreach ($query->rows as $result) {
					$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
			}
			
			$this->cache->set('product.latestbycat.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $product_data);
			}
		}
		
		if (!$product_data) { 
			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);
	 	 
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProductVger($result['product_id']);
		}
		
		$this->cache->set('product.latestbycat.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $product_data);
		}
		
		return ($product_data);
	}
}
?>