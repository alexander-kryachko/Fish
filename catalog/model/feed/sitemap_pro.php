<?php
class ModelFeedSitemapPro extends Model {

	public function getProducts($start = 0, $limit = null) {
	
	 $now = date('Y-m-d H:i') . ':00';
	
		
			$sql = "SELECT p.product_id, p.date_added, p.date_modified  FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON ( p.status = '1' AND p.date_available <= '". $now ."' AND p.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "')"; 

							
			$sql .= " ORDER BY p.product_id";	
						
			$sql .= " ASC";
			
			if ($limit) {
			
			$sql .= " LIMIT " . $start . ", " . $limit;
			
			}
			 						
			$query = $this->db->query($sql);
			
			return $query->rows;
		
	}
	
	
	public function getTotal() {
	
		$now = date('Y-m-d H:i') . ':00';
		
		    $sql = "SELECT COUNT(p.product_id) as total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND p.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= '". $now ."') LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "') ";
			
			$query = $this->db->query($sql);
		
			$result = $query->row;
		
		return $result['total'];
	}
	
	public function getCategories() {
	
		$query = $this->db->query("SELECT c.category_id, c.parent_id, date_added, date_modified, cd.name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.parent_id, c.category_id");

		return $query->rows;
	}
	
	
	

}
?>