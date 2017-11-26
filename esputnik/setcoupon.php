<?
header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', '76874FisherOO_115');
//mysql_connect('localhost', 'root', '');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');

$privateKey = "sdf:AS23-bH83fnsz";

// check
$check = array(
	'type' => isset($_GET['type']) ? $_GET['type'] : '',
	'discount' => isset($_GET['discount']) ? $_GET['discount'] : '',
	'discount_plan' => isset($_GET['discount_plan']) ? $_GET['discount_plan'] : '',
	'shipping' => isset($_GET['shipping']) ? $_GET['shipping'] : '',
	'date_start' => isset($_GET['date_start']) ? $_GET['date_start'] : '',
	'days' => isset($_GET['days']) ? $_GET['days'] : '',
	//'date_end' => isset($_GET['date_end']) ? $_GET['date_end'] : '',
	'uses_total' => isset($_GET['uses_total']) ? $_GET['uses_total'] : '',
	'uses_customer' => isset($_GET['uses_customer']) ? $_GET['uses_customer'] : '',
	'coupon_product' => isset($_GET['coupon_product']) ? $_GET['coupon_product'] : '',

	'coupon_name' => isset($_GET['coupon_name']) ? $_GET['coupon_name'] : '',
	'coupon_prefix' => isset($_GET['coupon_prefix']) ? $_GET['coupon_prefix'] : '',
);
$hash = isset($_GET['hash']) ? $_GET['hash'] : false;
if ($hash != md5($privateKey.serialize($check))) die();


// get data
$type = isset($_GET['type']) ? strtoupper($_GET['type']) : false;
if (!in_array($type, array('P', 'F', 'C'))) $type = 'F';
$discount = isset($_GET['discount']) ? (float)$_GET['discount'] : 0;
$discount_plan = $type == 'C' && !empty($_GET['discount_plan']) ? unserialize($_GET['discount_plan']) : '';
$coupon_product = !empty($_GET['coupon_product']) ? unserialize($_GET['coupon_product']) : array();
$total = 0;
$logged = 0;
$shipping = !empty($_GET['shipping']) ? 1 : 0;
$date_start = date('Y-m-d', !empty($_GET['date_start']) ? strtotime($_GET['date_start']) : time());
//$days = date('Y-m-d', !empty($_GET['date_end']) ? strtotime($_GET['date_end']) : time() + 86400 * 365 * 5);
$date_end = date('Y-m-d', time() + 86400 * (!empty($_GET['days']) ? (int)$_GET['days'] : 365 * 5));
$status = 1;
$uses_total = isset($_GET['uses_total']) ? (int)$_GET['uses_total'] : 1;
$uses_customer = isset($_GET['uses_customer']) ? (int)$_GET['uses_customer'] : 1;

$coupon_name = isset($_GET['coupon_name']) ? htmlspecialchars(trim($_GET['coupon_name']), ENT_COMPAT, 'utf-8') : '';
$coupon_prefix = isset($_GET['coupon_prefix']) ? htmlspecialchars(trim($_GET['coupon_prefix']), ENT_COMPAT, 'utf-8') : '';

$result = mysql_query('SELECT COUNT(*) as `n` FROM oc_coupon');
$row = mysql_fetch_assoc($result);
$name = !empty($coupon_name) ? $coupon_name : 'Дисконтная карта (Esputnik) №'.($row['n'] + 1);
$gen_digits = 5;
do{
	$code = $coupon_prefix;
	for ($i=0; $i<$gen_digits; $i++) $code.= rand(0,9);
	$result = mysql_query('SELECT coupon_id FROM oc_coupon WHERE `code` = "'.$code.'" LIMIT 1');
	$row = mysql_fetch_assoc($result);
	$check = $row['coupon_id'];
} while(!empty($check));

mysql_query("INSERT INTO oc_coupon SET 
	name = '" . mysql_real_escape_string($name) . "', 
	code = '" . mysql_real_escape_string($code) . "', 
	type = '" . mysql_real_escape_string($type) . "', 
	discount = '" . (float)$discount . "', 
	discount_plan ='" . mysql_real_escape_string(serialize($discount_plan)) . "', 
	total = '" . (float)$total . "', 
	logged = '" . (int)$logged . "', 
	shipping = '" . (int)$shipping . "', 
	date_start = '" . mysql_real_escape_string($date_start) . "', 
	date_end = '" . mysql_real_escape_string($date_end) . "', 
	uses_total = '" . (int)$uses_total . "', 
	uses_customer = '" . (int)$uses_customer . "', 
	status = '" . (int)$status . "', 
	date_added = NOW()
");
$coupon_id = mysql_insert_id();

if (!empty($coupon_product)) foreach(array_unique($coupon_product) as $product_id){
	mysql_query("INSERT INTO oc_coupon_product SET coupon_id = '" . (int)$coupon_id . "', product_id = '" . (int)$product_id . "'");
}

echo $code;
exit();
?>