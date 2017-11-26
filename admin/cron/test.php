<?
set_time_limit(0);
define('HTTP_SERVER', 'http://fisherway.com.ua/');
$user = 'fish.sput@fisherway.com.ua';
$password = 'fish098';
$config_complete_status_id = 5;

header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', '123FishchipS1234');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');


// get preferences by phone & email
$data = array();
$result = mysql_query('SELECT 
	 DISTINCT cp2c.pref_id, o.telephone, NULL
	FROM `oc_order_product` op
	INNER JOIN `oc_order` o on (o.order_id = op.order_id)
	INNER JOIN `oc_product_to_category` p2c on (p2c.product_id = op.product_id)
	INNER JOIN `oc_client_pref_to_category` cp2c on (cp2c.category_id = p2c.category_id)
	WHERE LENGTH(o.telephone) >= 10;
');
while ($row = mysql_fetch_assoc($result)) $data[] = '('.$row['pref_id'].', "'.substr(preg_replace('/\D/', '', $row['telephone']), -10).'", NULL)';
$result = mysql_query('SELECT 
	 DISTINCT cp2c.pref_id, NULL, o.email
	FROM `oc_order_product` op
	INNER JOIN `oc_order` o on (o.order_id = op.order_id)
	INNER JOIN `oc_product_to_category` p2c on (p2c.product_id = op.product_id)
	INNER JOIN `oc_client_pref_to_category` cp2c on (cp2c.category_id = p2c.category_id)
	WHERE LOCATE("@", o.email) > 0;
');
while ($row = mysql_fetch_assoc($result)) $data[] = '('.$row['pref_id'].', NULL, "'.mysql_real_escape_string(trim(strtolower($row['email']))).'")';
$chunks = array_chunk($data, 500);
foreach($chunks as $chunk) mysql_query('INSERT IGNORE INTO oc_client_to_pref(`pref_id`, `telephone`, `email`) VALUES '.implode(',', $chunk));

$sms2prefs = array();
$email2prefs = array();
$result = mysql_query('SELECT pref_id, telephone, email FROM `oc_client_to_pref`');
while ($row = mysql_fetch_assoc($result)){
	if ($row['telephone']){
		if (!isset($sms2prefs[$row['telephone']])) $sms2prefs[$row['telephone']] = array();
		$sms2prefs[$row['telephone']][] = $row['pref_id'];
	} elseif ($row['email']){
		if (!isset($email2prefs[$row['email']])) $email2prefs[$row['email']] = array();
		$email2prefs[$row['email']][] = $row['pref_id'];
	}
}




//$add_orders_url = 'https://esputnik.com.ua/api/v1/orders';

$maxrows = 5;
$startindex = 1;

// get field ids 
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com/api/v1/addressbooks');
curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$addressbooks = json_decode($output);
curl_close($ch);
foreach($addressbooks->addressBook->fieldGroups as $fg){
	foreach($fg->fields as $f){
		//echo $f->name.'<br />';
		//switch($f->name){
		//	case '';
		//}
	}
}

//echo PHP_EOL.'<br />---------<br />'.PHP_EOL;

// get test contacts
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts?email=the.wmuzz@gmail.com&startindex='.$startindex.'&maxrows='.$maxrows);
curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contact/22299817');
curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
//file_put_contents('debug.txt', 'getContacts('.$startindex.')'.PHP_EOL, FILE_APPEND);

// test pref ids
$pref_ids = array(5, 9, 11); // сезон = зима, вид = спиннинг, карповая

$contacts = json_decode($output);

/*
foreach(json_decode($output) as $c){
	$contacts[$c->id] = array('id' => $c->id);
	if (!empty($c->firstName)) $contacts[$c->id]['firstName'] = $c->firstName;
	foreach($c->channels as $ch){
		switch($ch->type){
			case 'email': $contacts[$c->id]['email'] = strtolower($ch->value); break;
			case 'sms': $contacts[$c->id]['sms'] = $ch->value; break;
		}
	}
}
*/

		/*
		$addressBookId = 3227;
		$discountFieldId = 10043;
		$couponFieldId = 10154;
		$paymentFieldId = 10155;
		$currentDiscountFieldId = 10388;
		$targetDiscountFieldId = 10389;
		$leftToUpgradeFieldId = 10390;
		
		$toUpdateByPhone = array();
		$method = 'На карту Приватбанка';
		$city = 'Харьков';
		$email = 'the.wmuzz@gmail.com';
		$name = 'Тестовый клиент 3';
		$sms = '380630434774';

		// update contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->address = array('town' => $city);
		$contact->channels = array();
		$contact->channels[] = array('type'=>'email', 'value' => $email);
		$contact->channels[] = array('type'=>'sms', 'value' => $sms);
		$contact->fields = array();
		$contact->fields[] = array('id' => $discountFieldId, 'value' => '2708');
		$contact->fields[] = array('id' => $couponFieldId, 'value' => '1009');
		$contact->fields[] = array('id' => $paymentFieldId, 'value' => $method); 

		$contact->fields[] = array('id' => $currentDiscountFieldId, 'value' => '3'); // Текущая скидка
		$contact->fields[] = array('id' => $targetDiscountFieldId, 'value' => '5.00'); // Следующая скидка
		$contact->fields[] = array('id' => $leftToUpgradeFieldId, 'value' => '292.19'); // Оставшаяся сумма
		
		$contact->fields[] = array('id' => 23022, 'value' => array('Зима')); // Сезон
		$contact->fields[] = array('id' => 23038, 'value' => 'Спиннинговая, Карповая'); // Вид

		$toUpdateByPhone[] = $contact;

		if (!empty($toUpdateByPhone)){
			//print_r($toUpdateByPhone);
			$request_entity = new stdClass();
			$request_entity->contacts = $toUpdateByPhone;
			$request_entity->dedupeOn = 'sms';
			$request_entity->contactFields = array('firstName', 'email', 'address', 'town');
			//$request_entity->customFieldsIDs = array($discountFieldId, $couponFieldId, $paymentFieldId);
			$request_entity->customFieldsIDs = array($discountFieldId, $couponFieldId, $paymentFieldId, $currentDiscountFieldId, $targetDiscountFieldId, $leftToUpgradeFieldId, 23022, 23038);
			$request_entity->groupNames = array('site', 'coupons');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_entity));
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts');
			curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			//file_put_contents('debug.txt', 'update'.PHP_EOL, FILE_APPEND);
			echo '<hr />';
			echo($output);
		}
		*/


echo '<hr />';
echo '<pre>';
print_r($addressbooks);
//print_r($data);
echo '</pre>';

//
?>