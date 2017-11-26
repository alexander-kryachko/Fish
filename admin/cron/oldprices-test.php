<?
define('DB_PREFIX', 'oc_');

$rowsPerOperation = 200;
set_time_limit(0);
header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', '76874FisherOO_115');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');


// check
$result = mysql_query('SELECT `value` FROM '.DB_PREFIX.'setting WHERE `key` = "oldprice_status" LIMIT 1');
$row = mysql_fetch_assoc($result);
$check = (int)$row['value'];
echo 'check = '.$check.'<br />';
//if ($check == 1) exit(); // 1C processing not finished
if ($check != 2) exit(); // no changes

// check 2
$result = mysql_query('SELECT COUNT(*) as `n` FROM '.DB_PREFIX.'old_prices');
$row = mysql_fetch_assoc($result);
$check = (int)$row['n'];

if ($check){
	// updateSpecials

	// get values to compare
	$tmp = $prices = $fixSpecials = array();
	$result = mysql_query('SELECT * FROM '.DB_PREFIX.'old_prices');
	//foreach ($query->rows as $row){
	while ($row = mysql_fetch_assoc($result)){
		$tmp[$row['product_id']] = array('price' => $row['price'], 'special_price' => !empty($row['special_price']) && $row['special_price'] > 0 ? $row['special_price'] : false, 'special_id' => !empty($row['special_id']) ? $row['special_id'] : false);
	}
	$result = mysql_query('SELECT 
			p.product_id, 
			p.price,
			ps.product_special_id as special_id,
			ps.price as special
		FROM '.DB_PREFIX.'product p 
		LEFT JOIN '.DB_PREFIX.'product_special ps on (ps.product_id = p.product_id AND ps.date_end = "0000-00-00")
		WHERE p.price > 0 AND p.price_updated = 1');
	//foreach ($query->rows as $row) {
	while ($row = mysql_fetch_assoc($result)){
		$prices[$row['product_id']] = $row['price'];
		if (!empty($row['special'])) $fixSpecials[$row['product_id']] = array('id' => $row['special_id'], 'value' => $row['special']);
	}
	//print_r($fixSpecials);

	// process
	$updatePrice = $createSpecial = $updateSpecial = $removeSpecial = array();
	foreach($prices as $pid => $nprice){
		if (empty($tmp[$pid])) continue;
		$nprice = number_format((float)$nprice, 2, '.', '');
		$oprice = number_format((float)$tmp[$pid]['price'], 2, '.', '');
		$sprice = !empty($tmp[$pid]['special_id']) ? number_format((float)$tmp[$pid]['special_price'], 2, '.', '') : 0;
$diff = abs(100*$nprice/$oprice - 100);
		if ($nprice >= $oprice || ($nprice < $oprice && $diff <= 10)) {
			if (!empty($fixSpecials[$pid])){					// what if tmp link is broken
				$removeSpecial[] = $fixSpecials[$pid]['id'];	// $tmp[$pid]['special_id'];
			} 
		}
		if ($nprice < $oprice && $diff > 10 ) {
			$updatePrice[$pid] = $oprice;
			if (empty($tmp[$pid]['special_id'])) $createSpecial[$pid] = $nprice;
			elseif ($nprice != $sprice) {
				if (!empty($fixSpecials[$pid])){
					// what if tmp link is broken
					// $updateSpecial[$tmp[$pid]['special_id']] = $nprice;
					$updateSpecial[$fixSpecials[$pid]['id']] = $nprice;
				}
			}
		}
	}

	if (!empty($updatePrice)){
		$arrays = array_chunk($updatePrice, $rowsPerOperation, true);
		foreach($arrays as $arr){
			$values = array();
			foreach($arr as $pid => $price) $values[] = '('.$pid.', '.$price.')';
			mysql_query('INSERT INTO '.DB_PREFIX.'product(`product_id`, `price`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`)');
		}
	}

	if (!empty($createSpecial)){
		$arrays = array_chunk($createSpecial, $rowsPerOperation, true);
		foreach($arrays as $arr){
			$values = array();
			foreach($arr as $pid => $price) $values[] = '('.$pid.', 0, 0, '.$price.')';
			mysql_query('INSERT INTO '.DB_PREFIX.'product_special(`product_id`, `customer_group_id`, `priority`, `price`) VALUES '.implode(',', $values));
		}
	}
	
	if (!empty($updateSpecial)){
		$arrays = array_chunk($updateSpecial, $rowsPerOperation, true);
		foreach($arrays as $arr){
			$values = array();
			foreach($arr as $sid => $price) $values[] = '('.$sid.', '.$price.')';
			mysql_query('INSERT INTO '.DB_PREFIX.'product_special(`product_special_id`, `price`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`)');
		}
	}

	if (!empty($removeSpecial)){
		$arrays = array_chunk($removeSpecial, $rowsPerOperation, true);
		foreach($arrays as $arr) mysql_query('DELETE FROM '.DB_PREFIX.'product_special WHERE `product_special_id` IN ('.implode(',', $arr).')');
	}
	
	echo 'Specials updated<br />';
	
	// updateSeries
	//get products
	$products = array();
	$result = mysql_query('SELECT `product_id`, `quantity`, `price` FROM '.DB_PREFIX.'product WHERE true'); // `price` > 0
	//foreach ($query->rows as $row) {
	while ($row = mysql_fetch_assoc($result)){
		$products[$row['product_id']] = $row;
	}
	
	//get specials
	$specials = array();
	$result = mysql_query('SELECT `product_id`, `price` FROM '.DB_PREFIX.'product_special WHERE `price` > 0 AND (date_end = "0000-00-00" OR date_end >= "'.date('Y-m-d').'")');
	//foreach ($query->rows as $row) {
	while ($row = mysql_fetch_assoc($result)){
		$specials[$row['product_id']] = $row['price'];
	}

	//get master products
	$master = array();
	$result = mysql_query('SELECT `master_product_id`, `product_id` FROM '.DB_PREFIX.'product_master WHERE `product_id` > 0 AND `master_product_id` > 0 AND `product_id` <> `master_product_id`');
	//foreach ($query->rows as $row) {
	while ($row = mysql_fetch_assoc($result)){
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
		$arrays = array_chunk($update, $rowsPerOperation, true);
		foreach($arrays as $arr){
			$values = $ids = array();
			foreach($arr as $pid => $data) {
				$values[] = '('.$pid.', '.$data['price'].', '.$data['quantity'].')';
				$ids[] = $pid;
			}
			mysql_query('INSERT INTO '.DB_PREFIX.'product(`product_id`, `price`, `quantity`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`), `quantity` = VALUES(`quantity`)');
			mysql_query('DELETE FROM '.DB_PREFIX.'product_special WHERE `product_id` IN ('.implode(',', $ids).')');
		}
	}	

	echo 'Series updated<br />';

}

// rememberPrices
mysql_query('TRUNCATE TABLE '.DB_PREFIX.'old_prices');
mysql_query('INSERT INTO '.DB_PREFIX.'old_prices(`product_id`, `price`, `special_price`, `special_id`) 
	SELECT p.product_id, p.price, ps.price, ps.product_special_id
	FROM '.DB_PREFIX.'product p 
	LEFT JOIN '.DB_PREFIX.'product_special ps on (ps.product_id = p.product_id AND ps.date_end = "0000-00-00")
	WHERE p.price > 0');
	
// clear old specials
//mysql_query('DELETE FROM '.DB_PREFIX.'product_special WHERE date_start = "0000-00-00" AND date_end = "0000-00-00" AND product_special_id NOT IN (SELECT DISTINCT `special_id` FROM '.DB_PREFIX.'old_prices WHERE `special_id` > 0)');
echo 'Prices stored for next session<br />';

// finish processing
mysql_query('UPDATE '.DB_PREFIX.'setting SET `value` = "0" WHERE `key` = "oldprice_status"');
mysql_query('UPDATE '.DB_PREFIX.'product SET `price_updated` = 0');
echo 'Process finished<br />';

?>