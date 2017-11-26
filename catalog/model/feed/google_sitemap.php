<?php
class ModelFeedGoogleSitemap extends Model {

	
	public function getProducts() {
	
	
		$cache = md5('product_sitemap');
		
		$product_data = $this->cache->get('product_sitemap.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . $cache);

		
		if (!$product_data) {
			$sql = "SELECT p.product_id, p.date_added, p.date_modified  FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)"; 
			
			
			
			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'"; 
			
		
				
			$sql .= " ORDER BY p.sort_order";	
			
			
			$sql .= " ASC";
		
				
			$product_data = array();
					
			$query = $this->db->query($sql);
		
			$product_data = $query->rows;
			

		
			$this->cache->set('product_sitemap.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id')  . $cache, $product_data);
		}
		
		return $product_data;
	}

}
?>