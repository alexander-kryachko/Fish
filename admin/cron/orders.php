<?
set_time_limit(0);
define('HTTP_SERVER', 'http://fisherway.com.ua/');
$user = 'fish.sput@fisherway.com.ua';
$password = 'fish098';
$config_complete_status_id = 5;

header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', '76874FisherOO_115');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');

// get orders & products
$categories = $orders = $products = $oids = $pids = $p2c = array();
$result = mysql_query('SELECT cd.category_id, cd.name FROM oc_category_description cd WHERE language_id = 1');
while ($row = mysql_fetch_assoc($result)) $categories[$row['category_id']] = $row['name'];

$result = mysql_query('SELECT * FROM oc_order WHERE `esputnik` = 0 AND order_status_id = '.$config_complete_status_id);	// date_added
while ($row = mysql_fetch_assoc($result)){
	$orders[] = $row;
	$oids[] = $row['order_id'];
}
if (empty($oids)) exit();

$result = mysql_query('SELECT 
		op.order_id,
		op.name,
		op.price,
		op.quantity,
		op.product_id
	FROM oc_order_product op 
	WHERE op.order_id IN ('.implode(',', $oids).')
');
while ($row = mysql_fetch_assoc($result)) {
	if (!isset($products[$row['order_id']])) $products[$row['order_id']] = array();
	$products[$row['order_id']][] = array(
		'name' => $row['name'], // Название продукта.
		'cost' => (float)$row['price'], // Стоимость единицы продукта.
		//'category' => 'cat' // Категория продукта.
		'quantity' => (int)$row['quantity'], // Количество единиц товара.
		'externalItemId' => (!empty($row['product_id']) ? $row['product_id'] : 'ext'), // Идентификатор продукта в Вашей системе.

		// необязательные поля
		//'url' => 'http://test.com?product1', // Ссылка на продукт на Вашем сайте, необходим для генерации писем со ссылками на продукты в брошенной корзине/заказе.
		//'imageUrl' => 'http://test.com?image', // Ссылка на картинку с изображением товара.
		//'description' => 'desc', // Краткое описание товара.		
	);
	if (!empty($row['product_id'])) $pids[] = $row['product_id'];
}

// get pictures and urls$
$pictures = $urls = array();
if (!empty($pids)){
	$result = mysql_query('SELECT product_id, image FROM oc_product p WHERE product_id IN ('.implode(',', $pids).')');
	while ($row = mysql_fetch_assoc($result)) $pictures[$row['product_id']] = HTTP_SERVER.'image/'.$row['image'];
	
	$result = mysql_query('SELECT query, keyword FROM oc_url_alias WHERE query LIKE "product_id=%"');
	while ($row = mysql_fetch_assoc($result)) $urls[substr($row['query'], 11)] = HTTP_SERVER.$row['keyword'];
}

$result = mysql_query('SELECT product_id, category_id FROM oc_product_to_category ORDER BY `main_category`');
while ($row = mysql_fetch_assoc($result)) $p2c[$row['product_id']] = $row['category_id'];

$add_orders_url = 'https://esputnik.com.ua/api/v1/orders';

$nOrders = count($orders);
$iterations = ceil($nOrders/1000);
for($i=0; $i<$iterations; $i++){
	$orders_list = new stdClass();
	$orders_list->orders = array();
	for($j=$i*1000;$j<($i+1)*1000;$j++){
		if (!isset($orders[$j])) break;
		$o = $orders[$j];
		$phone = !empty($o['telephone']) ? '38'.substr(preg_replace('/\D/', '', $o['telephone']), -10) : false;

		$order = new stdClass();
		$order->status = "DELIVERED"; // Статус заказа. Возможные значения: DELIVERED, IN_PROGRESS, CANCELLED, ABANDONED_SHOPPING_CART, INITIALIZED. Для RFM анализа учитываются только заказы со статусом DELIVERED.
		$order->date = date('Y-m-d\TH:i:s', strtotime($o['date_added']));  // Дата заказа в формате yyyy-MM-ddTHH:mm:ss.
		$order->externalOrderId = (string)$o['order_id'];  // Идентификатор заказа в Вашей системе.
		if ($phone) $order->externalCustomerId = $phone;  // Идентификатор клиента в Вашей системе. Если вы ходите идентифицировать клиентов по email или номеру телефона, продублируйте значение в этом поле и в соответствующем поле email или phone.

		$order->totalCost = $o['total'];  // Итоговая сумма по заказу.

		// НЕОБЯЗАТЕЛЬНЫЕ ПОЛЯ
		if (!empty($o['email'])) $order->email = $o['email'];  // Email клиента.
		if ($phone) $order->phone = $phone;  // Номер телефона клиента.
		//$order->shipping = 1;  // Стоимость доставки (дополнительная информация, при расчётах не учитывается).
		//$order->taxes = 20;  // Налоги (дополнительная информация, при расчётах не учитывается).
		//$order->storeId = "1050";  // Для ситуации, если Вам нужно хранить несколько наборов данных (по разным магазинам) в одной учетной записи eSputnik, иначе можно оставить пустым.
		//$order->restoreUrl = "http://test.com?restore";  // Cсылка на восстановление корзины, если необходима такая функциональность.
		//$order->statusDescriptsion = "test";  // Дополнительное описание статуса заказа.

		$order->items = array();  // Список продуктов, входящих в заказ.
		$total = 0;
		if (!empty($products[$o['order_id']])) foreach($products[$o['order_id']] as $p){
			$add = array(
				// обязательные поля
				'name' => $p['name'], // Название продукта.
				'cost' => $p['cost'], // Стоимость единицы продукта.
				'category' => isset($p2c[$p['externalItemId']]) ? $categories[$p2c[$p['externalItemId']]] : 'unknown', // Категория продукта.
				'quantity' => $p['quantity'], // Количество единиц товара.
				'externalItemId' => $p['externalItemId'], // Идентификатор продукта в Вашей системе.
			);
			if (!empty($urls[$p['externalItemId']])) $add['url'] = $urls[$p['externalItemId']];
			if (!empty($pictures[$p['externalItemId']])) $add['imageUrl'] = $pictures[$p['externalItemId']];
			//$add['description'] = 'desc';
			$order->items[] = $add;
			$total += $p['cost']*$p['quantity'];
		}
		if ($total > $order->totalCost) $order->discount = $total - $order->totalCost;  // Скидка (дополнительная информация, при расчётах не учитывается).
		$orders_list->orders[] = $order;
	}

	echo json_encode($orders_list);
	echo '<hr />';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orders_list));
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, $add_orders_url);
	curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	//file_put_contents('debug.txt', 'orders'.PHP_EOL, FILE_APPEND);
	echo($output);
	echo '<hr />';

}

if (!empty($oids)) mysql_query('UPDATE oc_order SET `esputnik` = 1 WHERE order_id IN ('.implode(',', $oids).')');

?>