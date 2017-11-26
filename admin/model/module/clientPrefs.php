<?php 
class ModelModuleClientPrefs extends Model {

	//private $rowsPerOperation = 200;
	
	public function add($prefType, $prefValue){
		$query = $this->db->query("SELECT pref_id FROM " . DB_PREFIX . "client_pref WHERE `name` LIKE '" . $this->db->escape($prefType) . "' AND `value` LIKE '" . $this->db->escape($prefValue) . "'");
		if($query->num_rows > 0) return false;
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "client_pref(`name`, `value`) VALUES ('" . $this->db->escape($prefType) . "', '" . $this->db->escape($prefValue) . "')");
		return true;
	}
	
	public function get(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "client_pref ORDER BY `name`, `value`");

		$result = array();
		if($query->num_rows > 0){
			foreach ($query->rows as $row) $result[$row['pref_id']] = $row;
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "client_pref_to_category");
			foreach ($query->rows as $row) {
				if (!isset($result[$row['pref_id']]['categories'])) $result[$row['pref_id']]['categories'] = array();
				$result[$row['pref_id']]['categories'][] = $row['category_id'];
			}
		}
		return $result;
	}
	
	public function remove($pref_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "client_pref WHERE pref_id = ".(int)$pref_id." LIMIT 1");
		$this->db->query("DELETE FROM " . DB_PREFIX . "client_pref_to_category WHERE pref_id = ".(int)$pref_id);
	}
	
	public function update($values){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "client_pref ORDER BY `name`, `value`");
		$rows = array();
		if($query->num_rows > 0){
			foreach ($query->rows as $row){
				if (!empty($values[$row['pref_id']])) $rows[$row['pref_id']] = $values[$row['pref_id']];
				//$rows[$row['pref_id']] = !empty($values[$row['pref_id']]) ? $values[$row['pref_id']] : array();
			}
		}
		
		$data = array();
		foreach($rows as $pref_id => $cats){
			foreach($cats as $cid) $data[] = '('.$pref_id.', '.$cid.')';
		}
		
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "client_pref_to_category");
		if (!empty($data)) $this->db->query('INSERT INTO '.DB_PREFIX.'client_pref_to_category(`pref_id`, `category_id`) VALUES '.implode(',', $data));
	}
	
	public function getOptionValues($option_id){
		$query = $this->db->query("SELECT value_id, name FROM " . DB_PREFIX . "ocfilter_option_value_description WHERE language_id = 1 AND option_id = ".$option_id." ORDER BY `name`");
		$rows = array();
		if($query->num_rows > 0){
			foreach ($query->rows as $row){
				$rows[$row['value_id']] = $row['name'];
			}
		}
		return $rows;
	}

	/*public function rememberPrices(){
		@unlink("./uploads/sos.tmp");

		$this->db->query('TRUNCATE TABLE '.DB_PREFIX.'old_prices');
		$this->db->query('INSERT INTO '.DB_PREFIX.'old_prices(`product_id`, `price`, `special_price`, `special_id`) 
			SELECT p.product_id, p.price, ps.price, ps.product_special_id
			FROM '.DB_PREFIX.'product p 
			LEFT JOIN '.DB_PREFIX.'product_special ps on (ps.product_id = p.product_id AND ps.date_end = "0000-00-00")
			WHERE p.price > 0');
	}

	public function updateSpecials(){
		@unlink("./uploads/sos.tmp");

		// get values to compare
		$tmp = $prices = array();
		$query = $this->db->query('SELECT * FROM '.DB_PREFIX.'old_prices');
		foreach ($query->rows as $row) $tmp[$row['product_id']] = array('price' => $row['price'], 'special_price' => !empty($row['special_price']) && $row['special_price'] > 0 ? $row['special_price'] : false, 'special_id' => !empty($row['special_id']) ? $row['special_id'] : false);

		//$query = $this->db->query('SELECT `product_id`, `price` FROM '.DB_PREFIX.'product WHERE `price` > 0');
		//foreach ($query->rows as $row) $prices[$row['product_id']] = $row['price'];
		$query = $this->db->query('SELECT 
				p.product_id, 
				p.price,
				ps.price as special
			FROM '.DB_PREFIX.'product p 
			LEFT JOIN '.DB_PREFIX.'product_special ps on (ps.product_id = p.product_id AND ps.date_end = "0000-00-00")
			WHERE p.price > 0');
		foreach ($query->rows as $row) {
			$prices[$row['product_id']] = !empty($row['special']) ? $row['special'] : $row['price'];
		}

		// process
		$updatePrice = $createSpecial = $updateSpecial = $removeSpecial = array();
		foreach($prices as $pid => $nprice){
			if (empty($tmp[$pid])) continue;
			$nprice = (float)$nprice;
			$oprice = (float)$tmp[$pid]['price'];
			if ($nprice >= $oprice && !empty($tmp[$pid]['special_id'])) $removeSpecial[] = $tmp[$pid]['special_id'];
			if ($nprice < $oprice) {
				$updatePrice[$pid] = $oprice;
				if (empty($tmp[$pid]['special_id'])) $createSpecial[$pid] = $nprice;
				elseif ($nprice != $tmp[$pid]['special_price']) $updateSpecial[$tmp[$pid]['special_id']] = $nprice;
			}
		}

		if (!empty($updatePrice)){
			$arrays = array_chunk($updatePrice, $this->rowsPerOperation, true);
			foreach($arrays as $arr){
				$values = array();
				foreach($arr as $pid => $price) $values[] = '('.$pid.', '.$price.')';
				$this->db->query('INSERT INTO '.DB_PREFIX.'product(`product_id`, `price`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`)');
			}
		}
		
		if (!empty($createSpecial)){
			$arrays = array_chunk($createSpecial, $this->rowsPerOperation, true);
			foreach($arrays as $arr){
				$values = array();
				foreach($arr as $pid => $price) $values[] = '('.$pid.', 0, 0, '.$price.')';
				$this->db->query('INSERT INTO '.DB_PREFIX.'product_special(`product_id`, `customer_group_id`, `priority`, `price`) VALUES '.implode(',', $values));
			}
		}
		
		if (!empty($updateSpecial)){
			$arrays = array_chunk($updateSpecial, $this->rowsPerOperation, true);
			foreach($arrays as $arr){
				$values = array();
				foreach($arr as $sid => $price) $values[] = '('.$sid.', '.$price.')';
				$this->db->query('INSERT INTO '.DB_PREFIX.'product_special(`product_special_id`, `price`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`)');
			}
		}
		
		if (!empty($removeSpecial)){
			$arrays = array_chunk($removeSpecial, $this->rowsPerOperation, true);
			foreach($arrays as $arr) $this->db->query('DELETE FROM '.DB_PREFIX.'product_special WHERE `product_special_id` IN ('.implode(',', $arr).')');
		}
		$this->db->query('TRUNCATE TABLE '.DB_PREFIX.'old_prices');
	}

	public function updateSeries(){
		//get products
		$products = array();
		$query = $this->db->query('SELECT `product_id`, `quantity`, `price` FROM '.DB_PREFIX.'product WHERE true'); // `price` > 0
		foreach ($query->rows as $row) {
			$products[$row['product_id']] = $row;
		}
		
		//get specials
		$specials = array();
		$query = $this->db->query('SELECT `product_id`, `price` FROM '.DB_PREFIX.'product_special WHERE `price` > 0 AND (date_end = "0000-00-00" OR date_end >= "'.date('Y-m-d').'")');
		foreach ($query->rows as $row) $specials[$row['product_id']] = $row['price'];

		//get master products
		$master = array();
		$query = $this->db->query('SELECT `master_product_id`, `product_id` FROM '.DB_PREFIX.'product_master WHERE `product_id` > 0 AND `master_product_id` > 0 AND `product_id` <> `master_product_id`');
		foreach ($query->rows as $row) {
			if (!isset($master[$row['master_product_id']])) $master[$row['master_product_id']] = array();
			$master[$row['master_product_id']][] = $row['product_id'];
		}

		$update = array();
		foreach($master as $mid => $rows){
			if (!isset($products[$mid])) continue;
			$quantity = 0;
			$price = 0;
			foreach($rows as $p){
				if (!isset($products[$p])) continue;
				$quantity += $products[$p]['quantity'];
				$rowPrice = $products[$p]['price'];
				if (isset($specials[$p]) && $specials[$p] > 0 && $specials[$p] < $rowPrice) $rowPrice = $specials[$p];
				if ($products[$p]['quantity'] && ($price == 0 || $price > $rowPrice)) $price = $rowPrice;
			}
			$update[$mid] = array('price' => $price, 'quantity' => $quantity);
		}

		if (!empty($update)){
			$arrays = array_chunk($update, $this->rowsPerOperation, true);
			foreach($arrays as $arr){
				$values = $ids = array();
				foreach($arr as $pid => $data) {
					$values[] = '('.$pid.', '.$data['price'].', '.$data['quantity'].')';
					$ids[] = $pid;
				}
				$this->db->query('INSERT INTO '.DB_PREFIX.'product(`product_id`, `price`, `quantity`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`), `quantity` = VALUES(`quantity`)');
				$this->db->query('DELETE FROM '.DB_PREFIX.'product_special WHERE `product_id` IN ('.implode(',', $ids).')');
			}
		}
	}

	public function clearPrices(){
		$this->db->query('DELETE FROM '.DB_PREFIX.'product_special WHERE date_end = "0000-00-00"');
		$this->db->query('TRUNCATE TABLE '.DB_PREFIX.'old_prices');
	}*/

}
?>