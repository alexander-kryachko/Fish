<?php
class ModelCatalogSet extends Model {

	public function addSet($data) {
	   
       if(isset($data['enable_productcard'])){
            $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '', quantity = '99', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', price = '" . (float)$data['total_set'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['product_sort_order'] . "', date_added = NOW()");        
    		$product_id = $this->db->getLastId();
    		if (isset($data['image'])) {
    			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");
    		}
            if(!empty($data['product_description'])){
        		foreach ($data['product_description'] as $language_id => $value) {
        			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
        		}                       
            }            
    		if (isset($data['product_image'])) {
    			foreach ($data['product_image'] as $product_image) {
    				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
    			}
    		}
            
    		if (isset($data['product_category'])) {
    			foreach ($data['product_category'] as $category_id) {
    				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
    			}
    		}
    		if (isset($data['product_related'])) {
    			foreach ($data['product_related'] as $related_id) {
    				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
    				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
    				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
    				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
    			}
    		}
    		if (isset($data['product_layout'])) {
    			foreach ($data['product_layout'] as $store_id => $layout) {
    				if ($layout['layout_id']) {
    					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
    				}
    			}
    		}
    		if (isset($data['set_store'])) {
    			foreach ($data['set_store'] as $store_id) {
    				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
    			}
    		}            
    		if ($data['keyword']) {
    			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
    		}
    		$this->cache->delete('product');
       } else {
            $product_id = 0;
       }

		$this->db->query("INSERT INTO `" . DB_PREFIX . "set` SET product_id='" . (int)$product_id . "', price='" . (float)$data['total_set'] . "', enable_productcard = '" . (isset($data['enable_productcard']) ? 1 : 0 ) . "', sort_order='" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_added = now()");
		$set_id = $this->db->getLastId();
		if (isset($data['set_image'])) {
			$this->db->query("UPDATE `" . DB_PREFIX . "set` SET image = '" . $this->db->escape(html_entity_decode($data['set_image'], ENT_QUOTES, 'UTF-8')) . "' WHERE set_id = '" . (int)$set_id . "'");
		}
		if (isset($data['set_category'])) {
			foreach ($data['set_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "set_to_category SET set_id = '" . (int)$set_id . "', category_id = '" . (int)$category_id . "'");
			}		
		}                 
        if (isset($data['product'])) {
			foreach ($data['product'] as $product) {
			    $temp_product_id = explode(':', $product['product_id']);
                $clean_product_id = $temp_product_id[0]; 
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_set SET set_id = '" . (int)$set_id . "', product_id='" . $this->db->escape($product['product_id']) . "', clean_product_id='" . (int)$clean_product_id . "', price_in_set='" . (isset($product['present']) ? 0 : (float)$product['price_in_set']) . "', quantity='" . (int)$product['quantity'] . "', present='" . (isset($product['present']) ? (int)$product['present'] : 0 ) . "', show_in_product='" . (isset($product['show_in_product']) ? (int)$product['show_in_product'] : 0 ) . "', sort_order='" . (int)$product['sort_order'] . "'");
			}
		}
		foreach ($data['set_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "set_description SET set_id = '" . (int)$set_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		if (isset($data['set_store'])) {
			foreach ($data['set_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "set_to_store SET set_id = '" . (int)$set_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
        return $set_id;
	}

	public function editSet($set_id, $data) {

       if(isset($data['enable_productcard'])){
                     
          if((int)$data['product_id']){
            $product_id = (int)$data['product_id'];
            
            $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id = '" . (int)$data['manufacturer_id'] . "', price = '" . (float)$data['total_set'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['product_sort_order'] . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");
          } else {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product SET quantity = '99',  manufacturer_id = '" . (int)$data['manufacturer_id'] . "', price = '" . (float)$data['total_set'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['product_sort_order'] . "', date_added = NOW()");
            $product_id = $this->db->getLastId();            
          } 
          if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");
		  }
    	  $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
          if(!empty($data['product_description'])){
    		foreach ($data['product_description'] as $language_id => $value) {
    			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
    		}                       
          }        
		  $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'"); 
          if (isset($data['set_store'])) {
			foreach ($data['set_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		  }
		  $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
		  if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		  }
		 $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		 if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}		
		 }
	     $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		 $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
   		 if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		 }
		 $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		 if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		 }
  		 $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");
		 if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		 }
		 $this->cache->delete('product');
       } elseif((int)$data['product_id']) {
            $product_id = (int)$data['product_id'];
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");
    		$this->cache->delete('product'); 
            $product_id = 0;       
       } else {
            $product_id = 0; 
       }
 
		$this->db->query("UPDATE `" . DB_PREFIX . "set` SET product_id='" . (int)$product_id . "', price='" . (float)$data['total_set'] . "', enable_productcard = '" . (isset($data['enable_productcard']) ? 1 : 0 ) . "', sort_order='" . (int)$data['sort_order'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', status = '" . (int)$data['status'] . "' WHERE set_id='" . (int)$set_id . "'");
		if (isset($data['set_image'])) {
			$this->db->query("UPDATE `" . DB_PREFIX . "set` SET image = '" . $this->db->escape(html_entity_decode($data['set_image'], ENT_QUOTES, 'UTF-8')) . "' WHERE set_id = '" . (int)$set_id . "'");
		}
        
		$this->db->query("DELETE FROM " . DB_PREFIX . "set_to_category WHERE set_id = '" . (int)$set_id . "'");
		if (isset($data['set_category'])) {
			foreach ($data['set_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "set_to_category SET set_id = '" . (int)$set_id . "', category_id = '" . (int)$category_id . "'");
			}		
		}        
        
         		
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_set WHERE set_id='" . (int)$set_id . "'");
		if (isset($data['product'])) {   
			foreach ($data['product'] as $product) {
			    $temp_product_id = explode(':', $product['product_id']);
                $clean_product_id = $temp_product_id[0]; 			 
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_set SET set_id = '" . (int)$set_id . "', product_id='" . $this->db->escape($product['product_id']) . "', clean_product_id='" . (int)$clean_product_id . "', price_in_set='" . (isset($product['present']) ? 0 : (float)$product['price_in_set']) . "', quantity='" . (int)$product['quantity'] . "', present='" . (isset($product['present']) ? (int)$product['present'] : 0 ) . "', show_in_product='" . (isset($product['show_in_product']) ? (int)$product['show_in_product'] : 0 ) . "', sort_order='" . (int)$product['sort_order'] . "'");
			}
		}    
        $this->db->query("DELETE FROM " . DB_PREFIX . "set_description WHERE set_id = '" . (int)$set_id . "'");
        foreach ($data['set_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "set_description SET set_id = '" . (int)$set_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
        $this->db->query("DELETE FROM " . DB_PREFIX . "set_to_store WHERE set_id = '" . (int)$set_id . "'");
		if (isset($data['set_store'])) {
			foreach ($data['set_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "set_to_store SET set_id = '" . (int)$set_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
        return $set_id;
	}

	public function deleteSet($set_id) {

        $query = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "set` WHERE set_id='" . (int)$set_id . "'");
		$product_id = $query->row['product_id'];
        if($product_id){
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
    		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");
    		$this->cache->delete('product');            
        }	   
		$this->db->query("DELETE FROM `" . DB_PREFIX . "set` WHERE set_id = '" . (int)$set_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "set_description WHERE set_id = '" . (int)$set_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "set_to_store WHERE set_id = '" . (int)$set_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_set WHERE set_id = '" . (int)$set_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "set_to_category WHERE set_id = '" . (int)$set_id . "'"); 
	}

	public function getSet($set_id) { 
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "set` WHERE set_id='" . (int)$set_id . "'");
	
		return $query->row;
	}

	public function getSetDescriptions($set_id) { 
		$set_description_data = array();
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "set_description WHERE set_id = '" . (int)$set_id . "'");
	
		foreach ($query->rows as $result) {
			$set_description_data[$result['language_id']] = array(
				'name'            		=> $result['name'],
				'description'      		=> $result['description']
			);
		}
	
		return $set_description_data;
	}

	public function getSetStores($set_id) { 
		$set_store_data = array();
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "set_to_store WHERE set_id = '" . (int)$set_id . "'");
		
		foreach ($query->rows as $result) {
			$set_store_data[] = $result['store_id'];
		}
	
		return $set_store_data;
	}

	public function getSets($data = array()) { 
		$sql = "SELECT * FROM `" . DB_PREFIX . "set` s LEFT JOIN " . DB_PREFIX . "set_description sd ON (s.set_id = sd.set_id)";
        
		if (!empty($data['filter_product_id'])) {
		  $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_set p2s ON (s.set_id = p2s.set_id)";			
		}        
		
        $sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
		if (!empty($data['filter_name'])) {
		  $sql .= " AND LCASE(sd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}
        
		if (!empty($data['filter_product_id'])) {
		  $sql .= " AND p2s.clean_product_id = '" . (int)$data['filter_product_id'] . "'";
		}        
                
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
		  $sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}
        
		$sort_data = array(
		  'sd.name',
		  's.status',
		  's.sort_order'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		  $sql .= " ORDER BY " . $data['sort'];	
		} else {
		  $sql .= " ORDER BY sd.name";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
		  $sql .= " DESC";
		} else {
		  $sql .= " ASC";
		}                
        
        if(!isset($data['no_limit'])){
            if (isset($data['start']) || isset($data['limit'])) {
    			if ($data['start'] < 0) {
    				$data['start'] = 0;
    			}				
    
    			if ($data['limit'] < 1) {
    		      	$data['limit'] = 20;
    			}	
    			
    			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    		}
        }	
	
			
		$query = $this->db->query($sql);
		
        return $query->rows;
	}
    
	public function getTotalSets($data = array()) { 
	
     	$sql = "SELECT COUNT(DISTINCT s.set_id) AS total FROM `" . DB_PREFIX . "set` s LEFT JOIN " . DB_PREFIX . "set_description sd ON (s.set_id = sd.set_id)";
		
        if (!empty($data['filter_product_id'])) {
		  $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_set p2s ON (s.set_id = p2s.set_id)";			
		}
        $sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
		if (!empty($data['filter_name'])) {
		  $sql .= " AND LCASE(sd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}
        
		if (!empty($data['filter_product_id'])) {
		  $sql .= " AND p2s.clean_product_id = '" . (int)$data['filter_product_id'] . "'";
		}        
                
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
		  $sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}
                	    
        $query = $this->db->query($sql);
           
		return $query->row['total'];
	}    

	public function getSetsId() { 
		$sql = "SELECT set_id FROM `" . DB_PREFIX . "set`";
			
		$query = $this->db->query($sql);
		
        return $query->rows;
	}

	public function getProductsInSets($set_id = 0) {
        $product_data =  array();
       
		$sql = "SELECT * FROM `" . DB_PREFIX . "product_to_set`";
		
        $sql .= " WHERE set_id = '" . (int)$set_id . "'";
        
        $sql .= " ORDER BY sort_order";	
			
		$query = $this->db->query($sql);
        
        foreach($query->rows as $product){
            $options = array();
            
            $tmp = explode(':', $product['product_id']);
            
            $product_id = $tmp[0];
            if(isset($tmp[1])) {
                $options = unserialize(base64_decode($tmp[1]));
            }
            
            $sql2 = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
            $sql2 .= " WHERE p.product_id='" . $product['product_id'] . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            $query2 = $this->db->query($sql2);
            
            $options_data = array();
            
            if($options){
                foreach($options as $okey => $ovalue){
                    
                    //echo $okey.'-'.$ovalue.'<br />';
                    $option_info = $this->getOptionInfo($okey, $ovalue);
                    $options_data[$option_info['option_name']] = $option_info['option_value_name'];
                    
                }
            }
            
            $product_data[] = array(
                'product_id' => $product['product_id'],
                'name'       => $query2->row['name'],
                'options'    => $options_data,
                'price'      => $query2->row['price'],
                'price_in_set'    => $product['price_in_set'],
                'present'         => isset($product['present']) ? $product['present'] : 0,
                'show_in_product' => isset($product['show_in_product']) ? $product['show_in_product'] : 0,
                'quantity'        => $product['quantity'],
                'sort_order'      => $product['sort_order']
            
            );    
            
        }
		
        return $product_data;
	}

	public function getAllCategories() {
		$category_data = $this->cache->get('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));

		if (!$category_data || !is_array($category_data)) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

			$category_data = array();
			foreach ($query->rows as $row) {
				$category_data[$row['parent_id']][$row['category_id']] = $row;
			}

			$this->cache->set('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $category_data);
		}

		return $category_data;
	}
    
	public function getSetCategories($set_id) {
		$set_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "set_to_category WHERE set_id = '" . (int)$set_id . "'");
		
		foreach ($query->rows as $result) {
			$set_category_data[] = $result['category_id'];
		}

		return $set_category_data;
	}    
    
	public function getSetByProduct($product_id) {

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "set` WHERE product_id = '" . (int)$product_id . "'");
        
		return $query->row;
	}
    
    public function getSetsByProductId($product_id) {
		$sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "product_to_set` ps LEFT JOIN `" . DB_PREFIX . "set` s ON (ps.set_id = s.set_id) LEFT JOIN `" . DB_PREFIX . "set_description` sd ON (ps.set_id = sd.set_id)";
		
        $sql .= " WHERE ps.clean_product_id = '" . (int)$product_id . "' AND ps.show_in_product='1' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND s.status>0";
        
        $sql .= " GROUP BY s.set_id ORDER BY s.sort_order";	
			
		$query = $this->db->query($sql);
		
        return $query->rows;        
    }
    
    
	public function getProductOptions($product_id) {
		$product_option_data = array();
		
		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");
		
		foreach ($product_option_query->rows as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();	
				
				$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");
				
				foreach ($product_option_value_query->rows as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'name'                    => $product_option_value['name'],
						'image'                   => $product_option_value['image'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']					
					);
				}
				
				$product_option_data[] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'product_option_value' => $product_option_value_data,
					'required'             => $product_option['required']
				);				
			} else { 
			 
                if($product_option['type']=='file'){continue;}
			 
				$product_option_data[] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);
                				
			}
		}	
		
		return $product_option_data;
	}    
    
    public function getOptionInfo($product_option_id, $option_value_id) {
        
        $option_info = array();
        $option_id = 0;
        $option_name = '';
        $option_type = '';
        $option_value_name = '';
            
		$query1 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` WHERE product_option_id = '" . (int)$product_option_id . "'");
        if($query1->row){
            $option_id = (int)$query1->row['option_id'];
            $query2 = $this->db->query("SELECT o.type, od.name FROM `" . DB_PREFIX . "option` o LEFT JOIN `" . DB_PREFIX . "option_description` od  ON (o.option_id = od.option_id) WHERE o.option_id = '" . (int)$option_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
            if($query2->row){
                $option_name = $query2->row['name'];
                $option_type = $query2->row['type'];
            }
            
            if($option_type=='checkbox' && is_array($option_value_id)){
                $temp_option_value_name = array();
                foreach($option_value_id as $id){
            		$query3 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option_value` WHERE product_option_value_id = '" . (int)$id . "'");
                    if($query3->row){
                        $query4 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_value_description` WHERE option_value_id = '" . (int)$query3->row['option_value_id'] . "'");
                        if($query4->row){
                            $temp_option_value_name[] = $query4->row['name'];
                        }    
                    }                
                }
                $option_value_name = implode(', ', $temp_option_value_name);                
            } elseif($option_type=='text'||$option_type=='textarea'||$option_type=='file'||$option_type=='date'||$option_type=='time'||$option_type=='datetime') {
                $option_value_name = $option_value_id;
            } else {
        		$query3 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option_value` WHERE product_option_value_id = '" . (int)$option_value_id . "'");
                if($query3->row){
                    $query4 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_value_description` WHERE option_value_id = '" . (int)$query3->row['option_value_id'] . "'");
                    if($query4->row){
                        $option_value_name = $query4->row['name'];
                    }    
                }                 
            }
            
            $option_info = array(
                'option_name'       => $option_name,
                'option_value_name' => $option_value_name  
            );
                
        }
        
        return $option_info;
    }

}
?>