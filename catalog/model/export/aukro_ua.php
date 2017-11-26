<?php
class ModelExportAukroUa extends Model {
	private function isOldVersion() {
		$v = explode('.', VERSION);
		return $v[2] < 3;
	}

	public function getCategory() {
		$query = $this->db->query("SELECT cd.name, c.category_id, c.parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' AND c.sort_order <> '-1'");

		return $query->rows;
	}

	public function getProduct($allowed_categories, $blacklist_type, $blacklist, $out_of_stock_id, $vendor_required = true, $allowed_manufacturers = '') {
		$sql_blacklist = '';
		if ($blacklist) {
			$sql_blacklist = " AND ".($blacklist_type == 'black' ? "NOT" : "")."(p.product_id IN (" . $this->db->escape($blacklist) . "))";
		}
		$query = $this->db->query("SELECT
			p.*, pd.name, pd.description, pd.meta_description, m.name AS manufacturer, p2c.category_id, IFNULL(ps.price, p.price) AS price, wcd.unit AS weight_unit
			FROM " . DB_PREFIX . "product p
			JOIN " . DB_PREFIX . "product_to_category AS p2c ON (p.product_id = p2c.product_id) " 
			. ($vendor_required ? '' : 'LEFT ') . "JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
			LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
			left join " . DB_PREFIX . "product_master pm on (p.product_id=pm.product_id)
			LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			LEFT JOIN " . DB_PREFIX . "product_special ps ON (p.product_id = ps.product_id) AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ps.date_start < NOW() AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())
			LEFT JOIN " . DB_PREFIX . "weight_class_description wcd ON (p.weight_class_id = wcd.weight_class_id) AND wcd.language_id='" . (int)$this->config->get('config_language_id') . "'
			WHERE p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'"
				.($allowed_categories ? " AND p2c.category_id IN (" . $this->db->escape($allowed_categories) . ")" : "")
				.$sql_blacklist
				.($allowed_manufacturers ? " AND p.manufacturer_id IN (" . $this->db->escape($allowed_manufacturers) . ")" : "") . "
				AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND p.date_available <= NOW() 
				AND p.status = '1'
				and pm.master_product_id <> '0'
				AND (p.quantity > '0' OR p.stock_status_id != '" . (int)$out_of_stock_id . "')
				GROUP BY p.product_id ORDER BY product_id");
		return $query->rows;
	}

	public function getProductImages($numpictures = 9) {
		$query = $this->db->query("SELECT product_id, image FROM " . DB_PREFIX . "product_image ORDER BY product_id".($this->isOldVersion() ? "" : ", sort_order"));
		$ret = array();
		foreach($query->rows as $row) {
			if (!isset($ret[$row['product_id']])) {
				$ret[$row['product_id']] = array();
			}
			if (count($ret[$row['product_id']]) < $numpictures)
				$ret[$row['product_id']][] = $row['image'];
		}
		return $ret;
	}

	public function getProductOptions($option_ids, $product_id) {
		$lang = (int)$this->config->get('config_language_id');
		
		$query = $this->db->query("SELECT pov.*, od.name AS option_name, ovd.name
			FROM " . DB_PREFIX . "product_option_value pov 
			LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (pov.option_value_id = ovd.option_value_id)
			LEFT JOIN " . DB_PREFIX . "option_description od ON (od.option_id = pov.option_id) AND (od.language_id = '$lang')
			WHERE pov.option_id IN (". implode(',', array_map('intval', $option_ids)) .") AND pov.product_id = '". (int)$product_id."'
				AND ovd.language_id = '$lang'");
		return $query->rows;
	}
	
	public function getAttributes($attr_ids) {
		if (!$attr_ids) return array();
		$query = $this->db->query("SELECT a.attribute_id, ad.name
			FROM " . DB_PREFIX . "attribute a
			LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id)
			WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND a.attribute_id IN (" . $this->db->escape($attr_ids) . ")
				ORDER BY a.attribute_id, ad.name");
		$ret = array();
		foreach($query->rows as $row) {
			$ret[$row['attribute_id']] = $row['name'];
		}
		return $ret;
	}
	
	public function getProductAttributes($product_id) {
		$query = $this->db->query("SELECT pa.attribute_id, pa.text, ad.name
			FROM " . DB_PREFIX . "product_attribute pa
			LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (pa.attribute_id = ad.attribute_id)
			WHERE pa.product_id = '" . (int)$product_id . "'
				AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'
				ORDER BY pa.attribute_id");
		return $query->rows;
	}
}
?>
