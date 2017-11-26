<?php
class ModelCatalogReview extends Model {
    public function addReview($product_id, $data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', rating_service = '" . (int)$data['rating_service'] . "', date_added = NOW()");
    }

    public function getReviewsByProductId($product_id, $start = 0, $limit = 20) {
        if ($start < 0) $start = 0;
        if ($limit < 1) $limit = 20;

		$query = $this->db->query("SELECT master_product_id FROM ".DB_PREFIX."product_master WHERE product_id = " . (int)$product_id . " AND special_attribute_group_id = 2");
		$master = count($query->rows) && (int)$query->row['master_product_id'] > 0
			? (int)$query->row['master_product_id']
			: (int)$product_id;
			
		$pids = array($product_id, $master);
		$query = $this->db->query("SELECT product_id FROM ".DB_PREFIX."product_master WHERE master_product_id = ".$master." AND special_attribute_group_id = 2");
		if (count($query->rows)) foreach ($query->rows as $result) if ($result['product_id'] > 0) $pids[] = $result['product_id'];
		$pids = array_unique($pids);

        $query = $this->db->query("SELECT 
			r.review_id, r.author, r.rating, r.rating_service, r.text, p.product_id, pd.name, p.price, p.image, r.date_added 
		FROM " . DB_PREFIX . "review r 
		LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		WHERE p.product_id IN (".implode(',', $pids).") 
			AND p.date_available <= NOW() AND p.status = 1 AND r.status = 1 AND pd.language_id = " . (int)$this->config->get('config_language_id') . " 
			ORDER BY r.date_added DESC LIMIT " . (int)$start . ", " . (int)$limit);
		
        return $query->rows;
    }
	
    public function getRandomReviewsByCategoryId($category_id, $path, $ocfilters, $n = 3){
		$values = array();
		$arr = explode(";", $ocfilters);
		for ($i = 0, $l = count($arr); $i < $l; $i++){
			$arr2 = explode(":", $arr[$i]);
			if ($arr2[0] == 'p') continue;
			$opt = explode(",", $arr2[1]);
			for ($j=0; $j < count($opt); $j++) $values[] = $opt[$j];
		}
		
		//$n = 100;
		$result = $pids = $p2m = array();
		
        $query = $this->db->query("SELECT 
			r.product_id, r.review_id, r.author, r.rating, r.rating_service, r.text, r.date_added 
		FROM " . DB_PREFIX . "review r 
		INNER JOIN ".DB_PREFIX."product_to_category p2c on (p2c.product_id = r.product_id)
		INNER JOIN ".DB_PREFIX."product p on (r.product_id = p.product_id)
		WHERE p2c.category_id = ".(int)$category_id." AND r.rating > 3 AND r.text NOT LIKE '%?%' AND r.status = 1 AND p.status = 1
		ORDER BY r.rating DESC
		");
		if (empty($query->rows)) return array();

		foreach ($query->rows as $row){
			$result[] = $row;
			$pids[] = $row['product_id'];
		}

		$skipProducts = array();
		if (!empty($values)){
			$query = mysql_query('SELECT value_id, option_id FROM oc_ocfilter_option_value WHERE value_id IN ('.implode(',', $values).')');
			$o2v = $v2o = array();
			while ($row = mysql_fetch_assoc($query)){
				if (!isset($o2v[$row['option_id']])) $o2v[$row['option_id']] = array();
				$o2v[$row['option_id']][] = $row['value_id'];
				$v2o[$row['value_id']] = $row['option_id'];
			}
			foreach($o2v as $o => $v){
				$query = mysql_query('SELECT 
						ov2p.product_id
					FROM oc_ocfilter_option_value_to_product ov2p
					INNER JOIN oc_product_to_category p2c on (p2c.product_id = ov2p.product_id)
					WHERE option_id = '.$o.' AND value_id IN ('.implode(',', $v).')');
				$tmpPids = array();
				while ($row = mysql_fetch_assoc($query)){
					$tmpPids[] = $row['product_id'];
				}
				$skipProducts = array_merge($skipProducts, array_diff($pids, $tmpPids));
			}
			$skipProducts = array_unique($skipProducts);
		}

		/*if ($_SERVER['REMOTE_ADDR'] == '37.57.71.114'){
			echo  $ocfilters;
			print_r($values);
			echo '<hr />';
			print_r($skipProducts);
		}*/
		
		foreach($result as $k => $v){
			if (in_array($v['product_id'], $skipProducts)) unset($result[$k]);
		}
		if (empty($result)) return array();

		shuffle($result);
		$result = array_slice($result, 0, $n);

		$query = $this->db->query("SELECT DISTINCT product_id, master_product_id FROM ".DB_PREFIX."product_master WHERE product_id IN (".implode(',', array_unique($pids)).") AND special_attribute_group_id = 2");
		if (!empty($query->rows)) foreach ($query->rows as $row){
			if ($row['master_product_id'] > 0) $p2m[$row['product_id']] = $row['master_product_id'];
		}
		
		$pids2 = array();
		foreach($result as $k => $v){
			$result[$k]['pid'] = !empty($p2m[$v['product_id']]) ? $p2m[$v['product_id']] : $v['product_id'];
			$pids2[] = $result[$k]['pid'];
		}


		
		$names = array();
		$query = $this->db->query("SELECT product_id, name FROM ".DB_PREFIX."product_description WHERE product_id IN (".implode(',', array_unique($pids2)).") AND " . (int)$this->config->get('config_language_id'));
		foreach ($query->rows as $row){
			$names[$row['product_id']] = $row['name'];
		}

		foreach($result as $k => $v){
			$result[$k]['product'] = $names[$v['pid']];
			$result[$k]['href'] = $this->url->link('product/product', 'path='.$path.'&product_id='.$v['pid']);
		}
		return $result;
    }	

    public function getAverageRating($product_id) {
        $query = $this->db->query("SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review WHERE status = '1' AND product_id = '" . (int)$product_id . "' GROUP BY product_id");

        if (isset($query->row['total'])) {
            return (int)$query->row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalReviews() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) WHERE p.date_available <= NOW() AND p.status = '1' AND r.status = '1'");

        return $query->row['total'];
    }

    public function getTotalReviewsByProductId($product_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
}
?>
