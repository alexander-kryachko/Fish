<?php

class ModelCatalogSet extends Model { 

	public function getSets($data = array()) { 
		$sql = "SELECT * FROM `" . DB_PREFIX . "set` s LEFT JOIN " . DB_PREFIX . "set_description sd ON (s.set_id = sd.set_id)";
		
        $sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND s.status>0 ";
        
        $sql .= " ORDER BY sort_order";
        	
        if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
		      	$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
			
		$query = $this->db->query($sql);
		
        return $query->rows;
	}


	public function getSet($set_id) { 
		$sql = "SELECT * FROM `" . DB_PREFIX . "set` s LEFT JOIN " . DB_PREFIX . "set_description sd ON (s.set_id = sd.set_id)";
		
        $sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND s.status>0 AND s.set_id = '" . $set_id . "'";
			
		$query = $this->db->query($sql);
		
        return $query->row;
	}

	public function isSetExist($product_id) {
	   
	    $set_id = 0; 
        
		$sql = "SELECT set_id FROM `" . DB_PREFIX . "set` WHERE product_id = '" . (int)$product_id . "'";
			
		$query = $this->db->query($sql);
		
        if(isset($query->row['set_id'])){
            $set_id = $query->row['set_id'];
        }
        
        return $set_id;
	}


	public function getSetsProduct($product_id) { 
		$result = array();
		$query = $this->db->query('SELECT DISTINCT product_id FROM '.DB_PREFIX.'product_master WHERE master_product_id = '.(int)$product_id);
		
		//BOF: fix for single products
		if (!$query->num_rows){
			$query->rows = array(0 => array('product_id' => (int)$product_id));
		}
		//EOF: fix for single products

		foreach($query->rows as $row){
			$product_id = $row['product_id'];
			$sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "product_to_set` ps LEFT JOIN `" . DB_PREFIX . "set` s ON (ps.set_id = s.set_id) LEFT JOIN `" . DB_PREFIX . "set_description` sd ON (ps.set_id = sd.set_id)";
			$sql .= " WHERE ps.clean_product_id = '" . (int)$product_id . "' AND ps.show_in_product='1' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND s.status>0";
			$sql .= " GROUP BY s.set_id ORDER BY s.sort_order";	
			$query2 = $this->db->query($sql);
			//$result += $query->rows;
			foreach($query2->rows as $r) $result[] = $r;
		}
		//echo count($result);
        return $result;
	}

    public function getSetCategories($set_id) {
        $categories = array();
        $sql = "SELECT category_id FROM `" . DB_PREFIX . "set_to_category` WHERE set_id = '" . (int)$set_id . "'";
        $query = $this->db->query($sql);
        if($query->rows){
           foreach($query->rows as $row){
            $categories[] = $row['category_id'];
           } 
        }
        return $categories;
    }

	public function getProductsInSets($set_id = 0){
 
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		} 
        
        $product_data =  array();
        $active_set = true;
		$sql = "SELECT * 
			FROM `" . DB_PREFIX . "product_to_set`
			WHERE set_id = '" . (int)$set_id . "'
			ORDER BY sort_order";	

		$query = $this->db->query($sql);
        foreach($query->rows as $product){
			//Query update:		(adding `date_start`, `date_end` from oc_special_price to results)
			if ($_SERVER['REMOTE_ADDR'] == '77.122.7.164'){
				$sql2 = "SELECT 
						p.*, 
						(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount
					FROM " . DB_PREFIX . "product p 
					LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
					WHERE p.product_id = '" . $product['product_id'] . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			} else {
			//Old query:
				$sql2 = "SELECT 
						*, 
						(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
						(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end > '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special 
					FROM " . DB_PREFIX . "product p 
					LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
					WHERE p.product_id = '" . $product['product_id'] . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			}
			
			$query2 = $this->db->query($sql2);
            $options = array();
            $tmp = explode(':', $product['product_id']);
            $product_id = $tmp[0];
            if(isset($tmp[1])) {
                $options = unserialize(base64_decode($tmp[1]));
            }
            if($query2->row){
				if ((float)$query2->row['special'] && (float)$query2->row['special'] < (float)$query2->row['price']){
                    $real_price = (float)$query2->row['special'];
				} else {
					$real_price = (float)$query2->row['price'];
				}
			
				$product['price_in_set'] = (float)$real_price * (float)$product['price_in_set'] / 100;
                $product_data[] = array(
                    'product_id'      => $product_id,
                    'product_wop_id'  => $product['product_id'],
                    'options'         => $options, 
                    'name'            => $query2->row['name'],
                    'present'         => $product['present'],
                    'image'           => $query2->row['image'],
                    'base_price'      => $query2->row['price'],
					'special_date_start' => isset($query2->row['special_date_start']) ? $query2->row['special_date_start'] : '',
					'special_date_end' => isset($query2->row['special_date_end']) ? $query2->row['special_date_end'] : '',
                    'base_special'    => ((float)$query2->row['special'] && (float)$query2->row['special'] < (float)$query2->row['price'] ? $query2->row['special'] : 0),
                    'base_discount'   => ((float)$query2->row['special'] && (float)$query2->row['special'] < (float)$query2->row['price'] ? $query2->row['special'] : $query2->row['price'])*$query2->row['discount']/100,
                    'base_quantity'   => $query2->row['quantity'],
                    'base_status'     => $query2->row['status'],
                    'tax_class_id'    => $query2->row['tax_class_id'],
                    'price_in_set'    => $product['price_in_set'],
                    'show_in_product' => isset($product['show_in_product']) ? $product['show_in_product'] : 0,
                    'quantity'        => $product['quantity'],
                    'sort_order'      => $product['sort_order']
                );                
            } else {
                $active_set = false;
            }        
        }
        if(!$active_set){
            $product_data =  array();
        }
        return $product_data;
	}

	public function getTotalSet() {
     	$sql = "SELECT COUNT(DISTINCT set_id) AS total FROM `" . DB_PREFIX . "set`";
	    
        $query = $this->db->query($sql);
           
		return $query->row['total'];
	}	
}
?>
