<?php

class ModelModuleSimilar extends Model {

	public function getProductSimilar($product_id,$limit) {

		$this->load->model('catalog/product');

		$product_data = array();

		if($product_id){
			$main_category = ($this->config->get('config_seo_url_type') == 'seo_pro') ? ' AND main_category = 1' : '';
			// находим категорию, в которой нах. товар
			$category = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" .$product_id. "'" . $main_category . "");

			if($category->num_rows){
				$category_id = $category->row['category_id'];
				// делаем выборку товаров из этой же категории, которые следуют после данного товара
				$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p left join " . DB_PREFIX . "product_master pm on (p.product_id=pm.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c  ON (p.product_id = p2c.product_id) WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1' and pm.master_product_id in (0, -1) AND p.date_available <= NOW() AND p.product_id > '" .(int)$product_id. "' ORDER BY p.product_id ASC LIMIT " .(int)$limit);
				foreach ($query->rows as $result) {
					$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
				}

				if(count($query->rows) < $limit){ // если в категории после товара меньше установленного лимита...
					$limit = $limit - count($query->rows); // вычисляем разницу и делаем выборку товаров с НАЧАЛА списка, кол-во = разнице
					$sql = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p left join " . DB_PREFIX . "product_master pm on (p.product_id=pm.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c  ON (p.product_id = p2c.product_id) WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1' AND p.date_available <= NOW() and pm.master_product_id in (0, -1) AND p.product_id <> '" .(int)$product_id. "' ORDER BY p.product_id ASC LIMIT " .(int)$limit);

					foreach ($sql->rows as $result) {
						$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
					}
				}
			}
		}

		return $product_data;
	}
}