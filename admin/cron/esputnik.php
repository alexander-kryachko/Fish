<?
require_once('/var/www/admin/www/fisherway.com.ua/config.php');
set_time_limit(0);
$user = 'fish.sput@fisherway.com.ua';
$password = 'fish098';
$config_complete_status_id = 5;
$addressBookId = 3227;
$discountFieldId = 10043;
$couponFieldId = 10154;
$paymentFieldId = 10155;

$currentDiscountFieldId = 10388;
$targetDiscountFieldId = 10389;
$leftToUpgradeFieldId = 10390;

header('Content-type: text/html; encoding=utf-8');
mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
mysql_select_db(DB_DATABASE);
mysql_query('set names utf8');

$start = microtime(true);

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

// update client prefs
$chunks = array_chunk($data, 500);
foreach($chunks as $chunk) mysql_query('INSERT IGNORE INTO oc_client_to_pref(`pref_id`, `telephone`, `email`) VALUES '.implode(',', $chunk));

// get client prefs (можно объединить с предыдущим блоком)
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

// get field ids 
$result = mysql_query('SELECT pref_id, name, value FROM oc_client_pref');
$fields = $fKeys = $fIds = array();
while($row = mysql_fetch_assoc($result)){
	if (!isset($fields[$row['name']])) $fields[$row['name']] = array();
	$fields[$row['name']][$row['pref_id']] = $row['value'];
	$fKeys[$row['pref_id']] = array('name' => $row['name'], 'value' => $row['value']);
}

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
		if (!isset($fields[$f->name])) continue;
		$fIds[$f->name] = $f->id;
	}
}
//print_r($addressbooks->addressBook->fieldGroups);
//die();

// get coupons
$coupons = $couponIds = array();
$result = mysql_query("SELECT c.coupon_id, c.name, c.code, c.discount, c.discount_plan, c.date_start, c.date_end, c.status,
	(SELECT SUM(o.total) FROM oc_coupon_history ch
		INNER JOIN `oc_order` o ON o.order_id = ch.order_id
		WHERE ch.coupon_id = c.coupon_id AND o.order_status_id = '" . $config_complete_status_id ."' GROUP BY c.coupon_id) AS total
	FROM oc_coupon c WHERE c.type = 'C'");
	//$n= 0;
while ($row = mysql_fetch_assoc($result)){
	if ($row['total'] == 0) continue;
	$row['current'] = $row['next'] = $row['left'] = '';
	
	$plan = unserialize($row['discount_plan']);
	if (!empty($plan)) foreach($plan as $k => $v){
		if ((float)$k <= (float)$row['total']){
			$row['current'] = number_format($v, 2, '.', '');
		}
		if ((float)$k > (float)$row['total'] && empty($row['next'])){
			$row['next'] = number_format($v, 2, '.', '');
			$row['left'] = number_format((float)$k - $row['total'], 2, '.', '');
			break;
		}
	}
	$coupons[] = $row;
	$couponIds[] = $row['coupon_id'];
	//$n++;
}

$step1 = microtime(true);
//echo number_format($step1-$start, 8, '.', '').'<br />';
//die();

// group coupons by phones/emails
$result = mysql_query("SELECT ch.coupon_id, o.telephone, o.email, o.firstname, o.payment_method, o.shipping_city
	FROM oc_coupon_history ch 
	INNER JOIN oc_order o on (o.order_id = ch.order_id)
	WHERE ch.coupon_id IN (".implode(',', $couponIds).")
	ORDER BY o.date_added
	");
$coupon2cities = $coupon2methods = $coupon2phones = $coupon2emails = $coupon2names = array();
while ($row = mysql_fetch_assoc($result)){
	if (!empty($row['telephone'])){
		if (!isset($coupon2phones[$row['coupon_id']])) $coupon2phones[$row['coupon_id']] = array();
		$coupon2phones[$row['coupon_id']][] =  $row['telephone'];
	}

	if (!empty($row['email'])){
		if (!isset($coupon2emails[$row['coupon_id']])) $coupon2emails[$row['coupon_id']] = array();
		$coupon2emails[$row['coupon_id']][] = strtolower($row['email']);
	}

	if (!empty($row['firstname'])){
		if (!isset($coupon2names[$row['coupon_id']])) $coupon2names[$row['coupon_id']] = array();
		$coupon2names[$row['coupon_id']][] =  $row['firstname'];
	}

	if (!empty($row['payment_method'])){
		if (!isset($coupon2methods[$row['coupon_id']])) $coupon2methods[$row['coupon_id']] = array();
		$coupon2methods[$row['coupon_id']][] = trim(preg_replace('/<span(.*)<\/span>/', '', $row['payment_method']));
	}

	if (!empty($row['shipping_city'])){
		if (!isset($coupon2cities[$row['coupon_id']])) $coupon2cities[$row['coupon_id']] = array();
		$coupon2cities[$row['coupon_id']][] = trim($row['shipping_city']);
	}
}

$step2 = microtime(true);
//echo number_format($step2-$step1, 8, '.', '').'<br />';
//die();

// get contacts from esputnik
$cachecontacts = DIR_CACHE.'esputnik-contacts.dat';
if (!file_exists($cachecontacts) || filemtime($cachecontacts) < time() - 3*60*60){
	$startindex = 1;
	$maxrows = 500;
	$contacts = array();
	while(true){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts?startindex='.$startindex.'&maxrows='.$maxrows);
		curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//file_put_contents('debug.txt', 'getContacts('.$startindex.')'.PHP_EOL, FILE_APPEND);

		foreach(json_decode($output) as $c){
			$contacts[$c->id] = array('id' => $c->id);
			if (!empty($c->firstName)) $contacts[$c->id]['firstName'] = $c->firstName;
			if (!empty($c->channels)) foreach($c->channels as $ch){
				switch($ch->type){
					case 'email': $contacts[$c->id]['email'] = strtolower($ch->value); break;
					case 'sms': $contacts[$c->id]['sms'] = $ch->value; break;
				}
			}
		}
		if (empty($output) || $output == '[]') 
			break;
		$startindex += $maxrows;
	}

	file_put_contents($cachecontacts, json_encode($contacts));
} else {
	$contacts = json_decode(file_get_contents($cachecontacts), true);
}

// group contacts by phones
$contactsBySms = $contactsByEmail = $duplicates = $duplicates2 = array();
foreach($contacts as $c){
	if (!empty($c['sms'])){
		$phone = substr($c['sms'], -10);
		if (isset($contactsBySms[$phone])){
			$duplicates[] = $phone;
		} else {
			$contactsBySms[$phone] = $c;
		}
	} else {
		$email = strtolower($c['email']);
		if (isset($contactsByEmail[$email])){
			$duplicates2[] = $email;
		} else {
			$contactsByEmail[$email] = $c;
		}
	}
}

$step3 = microtime(true);
//echo number_format($step3-$step2, 8, '.', '').'<br />';
//die();


// update coupons totals at esputnik
$toCreate = $toUpdateByPhone = $toUpdateByEmail = array();
$processedPhones = array();
$processedEmails = array();
foreach($coupons as $c){
	$found = $phone = $email = false;
	// search contact by phones
	if (!empty($coupon2phones[$c['coupon_id']])){
		$phones = $coupon2phones[$c['coupon_id']];
		foreach($phones as $k => $v) $phones[$k] = substr(preg_replace('/\D/', '', $v), -10);
		$phones = array_unique($phones);
		foreach($phones as $p){
			if (!isset($contactsBySms[$p])) continue;
			$found = true;
			$phone = $p;
			$name = !empty($contactsBySms[$p]['firstName']) ? $contactsBySms[$p]['firstName'] : '';
			break;
		}	
	} elseif(!empty($coupon2emails[$c['coupon_id']])){
		$emails = array_unique($coupon2emails[$c['coupon_id']]);
		foreach($emails as $e){
			if (!isset($contactsByEmail[$e])) continue;
			$found = true;
			$email = $e;
			$name = !empty($contactsByEmail[$e]['firstName']) ? $contactsByEmail[$e]['firstName'] : '';
			break;
		}
	}

	//echo $c['coupon_id'].': ';
	if (!$found){
		$phone = !empty($coupon2phones[$c['coupon_id']]) ? substr(preg_replace('/\D/', '', array_pop($coupon2phones[$c['coupon_id']])), -10) : false;
		$email = !empty($coupon2emails[$c['coupon_id']]) ? trim(array_pop($coupon2emails[$c['coupon_id']])) : false;
		$name = !empty($coupon2names[$c['coupon_id']]) ? trim(array_pop($coupon2names[$c['coupon_id']])) : '';
		$method = !empty($coupon2methods[$c['coupon_id']]) ? trim(array_pop($coupon2methods[$c['coupon_id']])) : '';
		$city = !empty($coupon2cities[$c['coupon_id']]) ? trim(array_pop($coupon2cities[$c['coupon_id']])) : '';

		// create contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->address = array('town' => $city);
		$contact->channels = array();
		if ($email) $contact->channels[] = array('type'=>'email', 'value' => $email);
		if ($phone) $contact->channels[] = array('type'=>'sms', 'value' => $phone);
		$contact->fields = array();
		$contact->fields[] = array('id' => $discountFieldId, 'value' => round($c['total']));
		$contact->fields[] = array('id' => $couponFieldId, 'value' => $c['code']);
		$contact->fields[] = array('id' => $paymentFieldId, 'value' => $method);
		
		$contact->fields[] = array('id' => $currentDiscountFieldId, 'value' => round($c['current'])); // Текущая скидка
		$contact->fields[] = array('id' => $targetDiscountFieldId, 'value' => $c['next']); // Следующая скидка
		$contact->fields[] = array('id' => $leftToUpgradeFieldId, 'value' => $c['left']); // Оставшаяся сумма
		
		// BOF: prefs addon
		$pref_ids = $prefs = array();
		if ($phone && isset($sms2prefs[$phone])) $pref_ids = array_merge($pref_ids, $sms2prefs[$phone]);
		if ($email && isset($email2prefs[$email])) $pref_ids = array_merge($pref_ids, $email2prefs[$email]);
		foreach(array_unique($pref_ids) as $pref_id){
			if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
			$fid = $fIds[$fKeys[$pref_id]['name']];
			if (!isset($prefs[$fid])) $prefs[$fid] = array();
			$prefs[$fid][] = $fKeys[$pref_id]['value'];
		}
		foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
		// EOF: prefs addon
		
		/*if ($email == 'skviria@bigmir.net'){
			echo '1: ';
			print_r($contact);
			die();
		}*/
		
		
		$toCreate[] = $contact;
		if ($email) $processedEmails[] = $email;
		if ($phone) $processedPhones[] = $phone;
		//echo 'not found -> create<br />';
	} elseif (!empty($phone)){
		$method = !empty($coupon2methods[$c['coupon_id']]) ? trim(array_pop($coupon2methods[$c['coupon_id']])) : '';
		$city = !empty($coupon2cities[$c['coupon_id']]) ? trim(array_pop($coupon2cities[$c['coupon_id']])) : '';
		$email = !empty($coupon2emails[$c['coupon_id']]) ? trim(array_pop($coupon2emails[$c['coupon_id']])) : false;
		if (!$name) $name = !empty($coupon2names[$c['coupon_id']]) ? trim(array_pop($coupon2names[$c['coupon_id']])) : '';

		// update contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->address = array('town' => $city);
		$contact->channels = array();
		if ($email) $contact->channels[] = array('type'=>'email', 'value' => $email);
		$contact->channels[] = array('type'=>'sms', 'value' => $contactsBySms[$phone]['sms']);
		$contact->fields = array();
		$contact->fields[] = array('id' => $discountFieldId, 'value' => round($c['total']));
		$contact->fields[] = array('id' => $couponFieldId, 'value' => $c['code']);
		$contact->fields[] = array('id' => $paymentFieldId, 'value' => $method); 

		$contact->fields[] = array('id' => $currentDiscountFieldId, 'value' => round($c['current'])); // Текущая скидка
		$contact->fields[] = array('id' => $targetDiscountFieldId, 'value' => $c['next']); // Следующая скидка
		$contact->fields[] = array('id' => $leftToUpgradeFieldId, 'value' => $c['left']); // Оставшаяся сумма
		
		// BOF: prefs addon
		$pref_ids = $prefs = array();
		if ($phone && isset($sms2prefs[$phone])) $pref_ids = array_merge($pref_ids, $sms2prefs[$phone]);
		if ($email && isset($email2prefs[$email])) $pref_ids = array_merge($pref_ids, $email2prefs[$email]);
		foreach(array_unique($pref_ids) as $pref_id){
			if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
			$fid = $fIds[$fKeys[$pref_id]['name']];
			if (!isset($prefs[$fid])) $prefs[$fid] = array();
			$prefs[$fid][] = $fKeys[$pref_id]['value'];
		}
		foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
		// EOF: prefs addon		

		/*if ($name == 'Тестовый клиент 3'){
			echo '2: '.$phone;
			print_r($contact);
			die();
		}*/
		$toUpdateByPhone[] = $contact;
		$processedPhones[] = $phone;
		if ($email) $processedEmails[] = $email;
	} elseif (!empty($email)){
		$method = !empty($coupon2methods[$c['coupon_id']]) ? trim(array_pop($coupon2methods[$c['coupon_id']])) : '';
		$city = !empty($coupon2cities[$c['coupon_id']]) ? trim(array_pop($coupon2cities[$c['coupon_id']])) : '';
		$phone = !empty($coupon2phones[$c['coupon_id']]) ? substr(preg_replace('/\D/', '', array_pop($coupon2phones[$c['coupon_id']])), -10) : false;
		if (!$name) $name = !empty($coupon2names[$c['coupon_id']]) ? trim(array_pop($coupon2names[$c['coupon_id']])) : '';
		
		// update contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->address = array('town' => $city);
		$contact->channels = array();
		$contact->channels[] = array('type'=>'email', 'value' => $contactsByEmail[$email]['email']);
		if ($phone) $contact->channels[] = array('type'=>'sms', 'value' => $phone);
		$contact->fields = array();
		$contact->fields[] = array('id' => $discountFieldId, 'value' => round($c['total']));
		$contact->fields[] = array('id' => $couponFieldId, 'value' => $c['code']);
		$contact->fields[] = array('id' => $paymentFieldId, 'value' => $method); 
		
		$contact->fields[] = array('id' => $currentDiscountFieldId, 'value' => round($c['current'])); // Текущая скидка
		$contact->fields[] = array('id' => $targetDiscountFieldId, 'value' => $c['next']); // Следующая скидка
		$contact->fields[] = array('id' => $leftToUpgradeFieldId, 'value' => $c['left']); // Оставшаяся сумма
		
		// BOF: prefs addon
		$pref_ids = $prefs = array();
		if ($phone && isset($sms2prefs[$phone])) $pref_ids = array_merge($pref_ids, $sms2prefs[$phone]);
		if ($email && isset($email2prefs[$email])) $pref_ids = array_merge($pref_ids, $email2prefs[$email]);
		foreach(array_unique($pref_ids) as $pref_id){
			if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
			$fid = $fIds[$fKeys[$pref_id]['name']];
			if (!isset($prefs[$fid])) $prefs[$fid] = array();
			$prefs[$fid][] = $fKeys[$pref_id]['value'];
		}
		foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
		// EOF: prefs addon		
		
		/*if ($email == 'skviria@bigmir.net'){
			echo '3: ';
			print_r($contact);
			die();
		}*/
		
		
		$toUpdateByEmail[] = $contact;
		$processedEmails[] = $email;
		if ($phone) $processedPhones[] = $phone;
	}
}

$step4 = microtime(true);
//echo number_format($step1-$start, 8, '.', '').'<br />';
//echo number_format($step2-$step1, 8, '.', '').'<br />';
//echo number_format($step3-$step2, 8, '.', '').'<br />';
//echo number_format($step4-$step3, 8, '.', '').'<br />';
//die(); 

//echo '<hr />';

if (!empty($toCreate)){
	$chunks = array_chunk($toCreate, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'sms';
		$request_entity->contactFields = array('firstName', 'email', 'sms', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($discountFieldId, $couponFieldId, $paymentFieldId, $currentDiscountFieldId, $targetDiscountFieldId, $leftToUpgradeFieldId), array_values($fIds));
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
		echo '<strong>create (coupons) '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step5_1 = microtime(true);

if (!empty($toUpdateByPhone)){
	
	$chunks = array_chunk($toUpdateByPhone, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'sms';
		$request_entity->contactFields = array('firstName', 'email', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($discountFieldId, $couponFieldId, $paymentFieldId, $currentDiscountFieldId, $targetDiscountFieldId, $leftToUpgradeFieldId), array_values($fIds));
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
		echo '<strong>update by phone '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step5_2 = microtime(true);

if (!empty($toUpdateByEmail)){

	$chunks = array_chunk($toUpdateByEmail, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'email';
		$request_entity->contactFields = array('firstName', 'sms', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($discountFieldId, $couponFieldId, $paymentFieldId, $currentDiscountFieldId, $targetDiscountFieldId, $leftToUpgradeFieldId), array_values($fIds));
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
		echo '<strong>update by email '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step5_3 = microtime(true);

/* ----------------------------------------------------- */
// get orders without coupons
$toCreate = $toUpdateByPhone = $toUpdateByEmail = array();
$result = mysql_query('SELECT 
		o.order_id,
		o.firstname,
		o.shipping_city,
		o.email,
		o.telephone,
		o.payment_method
	FROM oc_order o
	WHERE o.order_id NOT IN (
		SELECT DISTINCT order_id FROM oc_coupon_history ch 
		INNER JOIN oc_coupon c on (c.coupon_id = ch.coupon_id)
		WHERE c.type = "C"
	)
');

/*
$result = mysql_query("SELECT c.coupon_id, c.name, c.code, c.discount, c.discount_plan, c.date_start, c.date_end, c.status,
	(SELECT SUM(o.total) FROM oc_coupon_history ch
		INNER JOIN `oc_order` o ON o.order_id = ch.order_id
		WHERE ch.coupon_id = c.coupon_id AND o.order_status_id = '" . $config_complete_status_id ."' GROUP BY c.coupon_id) AS total
	FROM oc_coupon c WHERE c.type = 'C'");

	*/
while ($row = mysql_fetch_assoc($result)){
	$phone = substr(preg_replace('/\D/', '', $row['telephone']), -10);
	if (strlen($phone) < 10) $phone = false;
	$email = trim(strtolower($row['email']));
	if (empty($phone) || in_array($phone, $processedPhones) || in_array($email, $processedEmails)) continue;
	//$orders[] = $row;

	if (isset($contactsBySms[$phone])){
		// обновить по телефону
		if (!isset($toUpdateByPhone[$phone])) $toUpdateByPhone[$phone] = array('name' => '', 'city' => '', 'email' => '', 'phone' => '', 'method' => '');
		$toUpdateByPhone[$phone]['phone'] = $phone;
		$toUpdateByPhone[$phone]['name'] = !empty($contactsBySms[$phone]['firstName']) ? $contactsBySms[$phone]['firstName'] : trim($row['firstname']);
		if (!empty($row['shipping_city'])) $toUpdateByPhone[$phone]['city'] = trim($row['shipping_city']);
		if (!empty($row['email'])) $toUpdateByPhone[$phone]['email'] = trim(strtolower($row['email']));
		if (!empty($row['payment_method'])) $toUpdateByPhone[$phone]['method'] = trim(preg_replace('/<span(.*)<\/span>/', '', $row['payment_method']));
	} elseif (isset($contactsByEmail[$email])){
		// обновить по почте
		if (!isset($toUpdateByEmail[$email])) $toUpdateByEmail[$email] = array('name' => '', 'city' => '', 'email' => '', 'phone' => '', 'method' => '');
		$toUpdateByEmail[$email]['email'] = $email;
		$toUpdateByEmail[$email]['name'] = !empty($contactsByEmail[$email]['firstName']) ? $contactsByEmail[$email]['firstName'] : trim($row['firstname']);
		if (!empty($row['shipping_city'])) $toUpdateByEmail[$email]['city'] = trim($row['shipping_city']);
		$toUpdateByEmail[$email]['phone'] = $phone;
		if (!empty($row['payment_method'])) $toUpdateByEmail[$email]['method'] = trim(preg_replace('/<span(.*)<\/span>/', '', $row['payment_method']));
	} else {
		// создать
		if (!isset($toCreate[$phone])) $toCreate[$phone] = array('name' => '', 'city' => '', 'email' => '', 'phone' => '', 'method' => '');
		$toCreate[$phone]['phone'] = $phone;
		if (!empty($row['firstname'])) $toCreate[$phone]['name'] = trim($row['firstname']);
		if (!empty($row['shipping_city'])) $toCreate[$phone]['city'] = trim($row['shipping_city']);
		if (!empty($row['email'])) $toCreate[$phone]['email'] = trim(strtolower($row['email']));
		if (!empty($row['payment_method'])) $toCreate[$phone]['method'] = trim(preg_replace('/<span(.*)<\/span>/', '', $row['payment_method']));		
	}
}

$toCreateArray = $toUpdateByPhoneArray = $toUpdateByEmailArray = array();
if (!empty($toCreate)) foreach($toCreate as $r){
	$contact = new stdClass();
	$contact->addressBookId = $addressBookId;  
	$contact->firstName = $r['name'];
	$contact->address = array('town' => $r['city']);
	$contact->channels = array();
	$contact->channels[] = array('type'=>'email', 'value' => $r['email']);
	$contact->channels[] = array('type'=>'sms', 'value' => $r['phone']);
	$contact->fields = array();
	$contact->fields[] = array('id' => $paymentFieldId, 'value' => $r['method']); 
	
	// BOF: prefs addon
	$pref_ids = $prefs = array();
	if ($r['phone'] && isset($sms2prefs[$r['phone']])) $pref_ids = array_merge($pref_ids, $sms2prefs[$r['phone']]);
	if ($r['email'] && isset($email2prefs[$r['email']])) $pref_ids = array_merge($pref_ids, $email2prefs[$r['email']]);
	foreach(array_unique($pref_ids) as $pref_id){
		if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
		$fid = $fIds[$fKeys[$pref_id]['name']];
		if (!isset($prefs[$fid])) $prefs[$fid] = array();
		$prefs[$fid][] = $fKeys[$pref_id]['value'];
	}
	foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
	// EOF: prefs addon
	
	/*if ($r['email'] == 'skviria@bigmir.net'){
		echo '4: ';
		print_r($contact);
		die();
	}*/
	
	
	$toCreateArray[] = $contact;
}
if (!empty($toUpdateByPhone)) foreach($toUpdateByPhone as $r){
	$contact = new stdClass();
	$contact->addressBookId = $addressBookId;  
	$contact->firstName = $r['name'];
	$contact->address = array('town' => $r['city']);
	$contact->channels = array();
	if (!empty($r['email'])) $contact->channels[] = array('type'=>'email', 'value' => $r['email']);
	$contact->channels[] = array('type'=>'sms', 'value' => $r['phone']);
	$contact->fields = array();
	$contact->fields[] = array('id' => $paymentFieldId, 'value' => $r['method']); 
	
	// BOF: prefs addon
	$pref_ids = $prefs = array();
	if ($r['phone'] && isset($sms2prefs[$r['phone']])) $pref_ids = array_merge($pref_ids, $sms2prefs[$r['phone']]);
	if ($r['email'] && isset($email2prefs[$r['email']])) $pref_ids = array_merge($pref_ids, $email2prefs[$r['email']]);
	foreach(array_unique($pref_ids) as $pref_id){
		if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
		$fid = $fIds[$fKeys[$pref_id]['name']];
		if (!isset($prefs[$fid])) $prefs[$fid] = array();
		$prefs[$fid][] = $fKeys[$pref_id]['value'];
	}
	foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
	// EOF: prefs addon

	/*if ($r['email'] == 'skviria@bigmir.net'){
		echo '5: ';
		print_r($contact);
		die();
	}*/
	
	
	$toUpdateByPhoneArray[] = $contact;
}
if (!empty($toUpdateByEmail)) foreach($toUpdateByEmail as $r){
	$contact = new stdClass();
	$contact->addressBookId = $addressBookId;  
	$contact->firstName = $r['name'];
	$contact->address = array('town' => $r['city']);
	$contact->channels = array();
	$contact->channels[] = array('type'=>'email', 'value' => $r['email']);
	$contact->channels[] = array('type'=>'sms', 'value' => $r['phone']);
	$contact->fields = array();
	$contact->fields[] = array('id' => $paymentFieldId, 'value' => $r['method']); 
	
	// BOF: prefs addon
	$pref_ids = $prefs = array();
	if ($r['phone'] && isset($sms2prefs[$r['phone']])) $pref_ids = array_merge($pref_ids, $sms2prefs[$r['phone']]);
	if ($r['email'] && isset($email2prefs[$r['email']])) $pref_ids = array_merge($pref_ids, $email2prefs[$r['email']]);
	foreach(array_unique($pref_ids) as $pref_id){
		if (!isset($fIds[$fKeys[$pref_id]['name']])) continue;
		$fid = $fIds[$fKeys[$pref_id]['name']];
		if (!isset($prefs[$fid])) $prefs[$fid] = array();
		$prefs[$fid][] = $fKeys[$pref_id]['value'];
	}
	foreach($fIds as $k => $v) $contact->fields[] = array('id' => $v, 'value' => !empty($prefs[$v]) ? implode(', ', $prefs[$v]) : ''); // Предпочтение
	// EOF: prefs addon
	
	/*if ($r['email'] == 'skviria@bigmir.net'){
		echo '6: ';
		print_r($contact);
		die();
	}*/
	
	
	$toUpdateByEmailArray[] = $contact;
}

$step5_4 = microtime(true);

//echo '<hr />Non-coupons:<hr />';
if (!empty($toCreateArray)){

	$chunks = array_chunk($toCreateArray, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'sms';
		$request_entity->contactFields = array('firstName', 'email', 'sms', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($paymentFieldId), array_values($fIds));
		$request_entity->groupNames = array('site');

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
		echo '<strong>create (single) '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step5_5 = microtime(true);

if (!empty($toUpdateByPhoneArray)){

	$chunks = array_chunk($toUpdateByPhoneArray, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'sms';
		$request_entity->contactFields = array('firstName', 'email', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($paymentFieldId), array_values($fIds));
		$request_entity->groupNames = array('site');

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
		echo '<strong>update by phone (single) '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step5_6 = microtime(true);

if (!empty($toUpdateByEmailArray)){

	$chunks = array_chunk($toUpdateByEmailArray, 500);
	$i = 0;
	foreach($chunks as $chunk){
		$request_entity = new stdClass();
		$request_entity->contacts = $chunk;
		$request_entity->dedupeOn = 'email';
		$request_entity->contactFields = array('firstName', 'sms', 'address', 'town');
		$request_entity->customFieldsIDs = array_merge(array($paymentFieldId), array_values($fIds));
		$request_entity->groupNames = array('site');

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
		echo '<strong>update by email (single) '.++$i.'</strong><br />';
		echo($output);
		echo '<hr />';
	}
}

$step6 = microtime(true);

//echo number_format((float)$step5_1 - (float)$start4, 8, '.', '').'<br />';
//echo number_format((float)$step5_2 - (float)$start5_1, 8, '.', '').'<br />';
//echo number_format((float)$step5_3 - (float)$start5_2, 8, '.', '').'<br />';
//echo number_format((float)$step5_4 - (float)$start5_3, 8, '.', '').'<br />';
//echo number_format((float)$step5_5 - (float)$start5_4, 8, '.', '').'<br />';
//echo number_format((float)$step5_6 - (float)$step5_5, 8, '.', '').'<br />';
//echo number_format((float)$step6 - (float)$step5_6, 8, '.', '').'<br />';
//echo number_format((float)$step6 - (float)$step4, 8, '.', '').'<br />';
//die();

/* OOSN */
$oosn = $oosnEmails = array();	
$result = mysql_query("SELECT fname, email, phone FROM oc_out_of_stock_notify");
while ($row = mysql_fetch_assoc($result)){
	if (empty($row['email']) || in_array($row['email'], $oosnEmails)) continue;
	$contact = new stdClass();
	$contact->addressBookId = $addressBookId;  
	$contact->channels = array();
	if (!empty($row['email'])) $contact->channels[] = array('type'=>'email', 'value' => $row['email']);
	if (!empty($row['phone'])) $contact->channels[] = array('type'=>'sms', 'value' => $row['phone']);
	$oosn[] = $contact;
	$oosnEmails[] = $row['email'];
}
if (!empty($oosn)){
	$request_entity = new stdClass();
	$request_entity->contacts = $oosn;
	$request_entity->dedupeOn = 'email_or_sms';
	$request_entity->contactFields = array('sms', 'email');
	$request_entity->groupNames = array('waiting');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_entity));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts');
	curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	echo '<hr />';
	echo($output);
}

/* LPSUBSCRIBE */

$lpsubscribe = $lpsubscribeEmails = array();	
$result = mysql_query("SELECT name, email_id FROM oc_landing");
while ($row = mysql_fetch_assoc($result)){
	if (empty($row['email_id']) || in_array($row['email_id'], $lpsubscribeEmails)) continue;
	$contact = new stdClass();
	$contact->addressBookId = $addressBookId;
	$contact->firstName = $row['name'];	
	$contact->channels = array();
	if (!empty($row['email_id'])) $contact->channels[] = array('type'=>'email', 'value' => $row['email_id']);
//	if (!empty($row['name'])) $contact->channels[] = array('type'=>'firstName', 'value' => $row['name']);
	$lpsubscribe[] = $contact;
	$lpsubscribeEmails[] = $row['email_id'];
}
if (!empty($lpsubscribe)){
	$request_entity = new stdClass();
	$request_entity->contacts = $lpsubscribe;
	$request_entity->dedupeOn = 'email';
	$request_entity->contactFields = array('firstName', 'email');
	$request_entity->groupNames = array('Landing Page');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_entity));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts');
	curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	echo '<hr />';
	echo($output);
}
?>