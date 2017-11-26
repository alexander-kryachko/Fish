<?php
class ModelCatalogLatest extends Model {
	private $NOW;

	public function __construct($registry) {
		$this->NOW = date('Y-m-d H:i') . ':00';
		parent::__construct($registry);
	}

	public function getProducts($data = array()) {
    if (version_compare(VERSION, '2.0', '<')) {
      if ($this->customer->isLogged()) {
        $customer_group_id = $this->customer->getCustomerGroupId();
      } else {
        $customer_group_id = $this->config->get('config_customer_group_id');
      }	
    } else {
      $customer_group_id = $this->config->get('config_customer_group_id');
    }
		
		$cache = md5(http_build_query($data));
		
		$product_data = $this->cache->get('product.latestrecent.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache);
		
		if (!$product_data) {
			$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product p left join " . DB_PREFIX . "product_master pm on (p.product_id=pm.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)"; 
						
			if (!empty($data['filter_category_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
			}
			
			$sql .= " WHERE p.date_added BETWEEN '" . $data['startdate'] . "' AND NOW() AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' and pm.master_product_id in (0, -1) AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'"; 

      if ($data['hide_outofstock']) {
        $sql .= " AND p.quantity > 0 and pm.master_product_id in (0, -1)"; 
      }

			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";
				
				if (!empty($data['filter_name'])) {					
					if (!empty($data['filter_description'])) {
						$sql .= "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%' OR MATCH(pd.description) AGAINST('" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "')";
					} else {
						$sql .= "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
					}
				}
				
				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}
				
				if (!empty($data['filter_tag'])) {
					$sql .= "MATCH(pd.tag) AGAINST('" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "')";
				}
			
				$sql .= ")";
				
				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}
				
				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}	
				
				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}		

				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}

				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}
				
				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}		
				
				if (!empty($data['filter_name'])) {
					$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				}					
			}
			
			if (!empty($data['filter_category_id'])) {
				if (!empty($data['filter_sub_category'])) {
					$implode_data = array();
					
					$implode_data[] = (int)$data['filter_category_id'];
					
					$this->load->model('catalog/category');
					
					$categories = $this->model_catalog_category->getCategoriesByParentId($data['filter_category_id']);
										
					foreach ($categories as $category_id) {
						$implode_data[] = (int)$category_id;
					}
								
					$sql .= " AND p2c.category_id IN (" . implode(', ', $implode_data) . ")";			
				} else {
					$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				}
			}		
					
			if (!empty($data['filter_manufacturer_id'])) {
				$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
			}
			
			$sql .= " GROUP BY p.product_id";
			
			$sort_data = array(
				'pd.name',
				'p.model',
				'p.quantity',
				'p.price',
				'rating',
				'p.sort_order',
				'p.date_added'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
					$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
				} else {
					$sql .= " ORDER BY " . $data['sort'];
				}
			} else {
				$sql .= " ORDER BY p.date_added";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC, LCASE(pd.name) DESC";
			} else {
				$sql .= " ASC, LCASE(pd.name) ASC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}				
	
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$product_data = array();
					
			$query = $this->db->query($sql);
		
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
			}
			
			$this->cache->set('product.latestrecent.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache, $product_data);
		}
		
		return $product_data;
	}
	
	public function getTotalProducts($data = array()) {
    if (version_compare(VERSION, '2.0', '<')) {
      if ($this->customer->isLogged()) {
        $customer_group_id = $this->customer->getCustomerGroupId();
      } else {
        $customer_group_id = $this->config->get('config_customer_group_id');
      }	
    } else {
      $customer_group_id = $this->config->get('config_customer_group_id');
    }
				
		$cache = md5(http_build_query($data));
		
		$product_data = $this->cache->get('product.latestrecent.total.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache);
		
		if (!$product_data) {
      if (version_compare(VERSION, '1.5.5', '>')) {
        $product_data = $this->totalProducts155($data);
      } else {
        $product_data = $this->totalProducts151($data);
      }

      $this->cache->set('product.latestrecent.total.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache, $product_data);     
		}
		
		return $product_data;
	}
  
  private function totalProducts151($data=array()) {
    $sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)";

    if (!empty($data['filter_category_id'])) {
      $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
    }
          
    $sql .= " WHERE p.date_added BETWEEN '" . $data['startdate'] . "' AND NOW() AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
    
    if ($data['hide_outofstock']) {
      $sql .= " AND p.quantity > 0";
    }
    
    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
      $sql .= " AND (";
      
      if (!empty($data['filter_name'])) {					
        if (!empty($data['filter_description'])) {
          $sql .= "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%' OR MATCH(pd.description) AGAINST('" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "')";
        } else {
          $sql .= "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }
      }
      
      if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
        $sql .= " OR ";
      }
      
      if (!empty($data['filter_tag'])) {
        $sql .= "MATCH(pd.tag) AGAINST('" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "')";
      }
    
      $sql .= ")";
      
      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }
      
      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }	
      
      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }		

      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }

      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }
      
      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }		
      
      if (!empty($data['filter_name'])) {
        $sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
      }				
    }
          
    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $implode_data = array();
        
        $implode_data[] = (int)$data['filter_category_id'];
        
        $this->load->model('catalog/category');
        
        $categories = $this->model_catalog_category->getCategories($data['filter_category_id']);
        
                  
        foreach ($categories as $category_id) {
          $implode_data[] = (int)$category_id;
        }
              
        $sql .= " AND p2c.category_id IN (" . implode(', ', $implode_data) . ")";			
      } else {
        $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
      }
    }		
    
    if (!empty($data['filter_manufacturer_id'])) {
      $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
    }
    
    $query = $this->db->query($sql);
    
    return $query->row['total']; 
  }
  
  private function totalProducts155($data=array()) {
    $sql = "SELECT COUNT(DISTINCT p.product_id) AS total"; 
    
    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";			
      } else {
        $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
      }
    
      $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
    } else {
      $sql .= " FROM " . DB_PREFIX . "product p";
    }
    
    $sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p.date_added BETWEEN '" . $data['startdate'] . "' AND NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
    
    if ($data['hide_outofstock']) {
      $sql .= " AND p.quantity > 0";
    }
    
    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";	
      } else {
        $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";			
      }	
    }
  
    $query = $this->db->query($sql);
    
    return $query->row['total']; 
  }

  function getMainCategories($date) {
		$category_data = $this->cache->get('product.latestrecent.main.categorys.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $date);
		
		if (!$category_data) {
      if (version_compare(VERSION, '2.0', '>=')) {
        $seo_h1 = 'cd.meta_h1';
      } else {
        $seo_h1 = 'cd.seo_h1';
      }
      
      $query = "SELECT c.category_id AS category_id, c.image as image, cd.name AS name, " . $seo_h1 . " AS seo_h1 FROM " . DB_PREFIX . "product as p " .
               "LEFT JOIN " . DB_PREFIX . "product_to_category as t1 ON (p.product_id = t1.product_id) " .
               "LEFT JOIN " . DB_PREFIX . "category as c ON (t1.category_id = c.category_id) " .
               "LEFT JOIN " . DB_PREFIX . "category_description as cd ON (t1.category_id = cd.category_id) " . 
               "LEFT JOIN " . DB_PREFIX . "category_to_store as c2s ON (t1.category_id = c2s.category_id) " .
               "WHERE p.date_added BETWEEN '". $date . "' AND NOW() AND p.date_available <= NOW() AND t1.main_category = 1 " .
               "AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' " . 
               "AND c.status = 1 AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY t1.category_id";
    
      $res = $this->db->query($query);
      $category_data = $res->rows;

			$this->cache->set('product.latestrecent.main.categorys.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $date, $category_data);
    };
      
    return $category_data;
  }
}
?>