<?php
class ModelCatalogProductMaster extends Model {
	public function getMasterProductId($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT master_product_id FROM "
		. DB_PREFIX . "product_master "
		. " WHERE product_id = " . (int)$product_id . " "
		. " AND special_attribute_group_id = " . (int)$special_attribute_group_id . "");
	
		if(count($query->rows) > 0)	
			return $query->row['master_product_id'];
		
		return '-1';
	}
	
	public function isMaster($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT master_product_id FROM "		
		. DB_PREFIX . "product_master "
		. " WHERE product_id = " . (int)$product_id . " "
		. " AND special_attribute_group_id = " . (int)$special_attribute_group_id . "");

		if(count($query->rows) > 0)	
			return (int)($query->row['master_product_id']) == 0;
		
		return 0;
	}
}
?>