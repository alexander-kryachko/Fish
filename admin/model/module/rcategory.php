<?php
class ModelModuleRcategory extends Model {
	public function getRcategories($category_id) {
		$product_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_related WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['rcategory_id'];
		}

		return $product_category_data;
	}

	public function showTable($table) {
		if (mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . DB_PREFIX . $table . "'"))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function createTable() {
		$sql = "CREATE TABLE `" . DB_PREFIX . "category_related` (`category_id` INT(11) NOT NULL,	`rcategory_id` INT(11) NOT NULL, PRIMARY KEY (`category_id`, `rcategory_id`))";
		$this->db->query($sql);
	}

}
?>