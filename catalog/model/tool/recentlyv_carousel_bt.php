<?php

class ModelToolRecentlyVCarouselBt extends Model {
    
    public function getProductsViewed($data = array()) {
		$sql = "SELECT product_id FROM " . DB_PREFIX . "product p WHERE p.viewed > 0 ORDER BY p.date_modified DESC, p.viewed DESC";
					
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
}

?>
