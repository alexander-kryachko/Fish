<?php
#####################################################################################
#  Module CSV IMPORT PRO for Opencart 1.5.x From HostJars opencart.hostjars.com 	#
#####################################################################################

class ModelToolCsvImport extends Model 
{
	
	public function getManufacturerId($manufacturer_name) {
		
		$query = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer WHERE name = '" . $this->db->escape($manufacturer_name) . "'");
		
		return (isset($query->row['manufacturer_id'])) ? $query->row['manufacturer_id'] : 0;
	}
	
	public function getCategoryId($category_name, $parentid) {
		
		$query = $this->db->query("SELECT c.category_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE cd.name = '" . $this->db->escape($category_name) . "' AND c.parent_id = '" . (int)$parentid . "'");
		
		return (isset($query->row['category_id'])) ? $query->row['category_id'] : 0;
	}
	
	public function getAttributeId($attribute_name, $attribute_group) {
		
		$query = $this->db->query("SELECT a.attribute_id FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE ad.name = '" . $this->db->escape($attribute_name) . "' AND a.attribute_group_id = '" . (int)$attribute_group . "'");
		
		return (isset($query->row['attribute_id'])) ? $query->row['attribute_id'] : 0;
	}
	
	public function getAttributeGroupId($attribute_name) {
		
		$query = $this->db->query("SELECT attribute_group_id FROM " . DB_PREFIX . "attribute_group_description WHERE name = '" . $this->db->escape($attribute_name) . "'");
		
		return (isset($query->row['attribute_group_id'])) ? $query->row['attribute_group_id'] : 0;
	}
	
	public function getProductId($id_field, $id_value) {
		
		if ($id_field == 'name') {
			$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_description WHERE name = '" . $this->db->escape($id_value) . "'");
		}
		else {
			$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE " . $this->db->escape($id_field) . " = '" . $this->db->escape($id_value) . "'");
		}
		
		return (isset($query->row['product_id'])) ?	$query->row['product_id'] : 0;
	}

	public function emptyTables() {

		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_attribute");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "attribute");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "attribute_description");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "attribute_group");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "attribute_group_description");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_description");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_discount");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_image");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_option");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_option_value");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_related");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_reward");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_special");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_tag");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_to_category");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_to_download");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_to_layout");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_to_store");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "manufacturer");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "manufacturer_to_store");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_description");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_to_layout");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "category_to_store");
		$query = $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "review");
		
		// Special query to delete any product related SEO Keywords
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'product_id=%'");
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'category_id=%'");
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'manufacturer_id=%'");
		
		$this->cache->delete('product');
		
	}
	

}


?>