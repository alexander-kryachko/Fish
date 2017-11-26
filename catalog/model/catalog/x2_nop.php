<?php
class ModelCatalogX2Nop extends Model {
	public function getNumberOfPurchases($product_id) {

		$query = $this->db->query("SELECT SUM(quantity) FROM " . DB_PREFIX . "order_product WHERE product_id = '" . (int)$product_id . "'");

		return $query->row['SUM(quantity)'];
	}
}
?>