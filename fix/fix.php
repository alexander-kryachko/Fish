<?
set_time_limit(0);
$user = 'marketing@fisherway.com.ua';
$password = ')a7P2f7b29';
$config_complete_status_id = 5;
$addressBookId = 3227;
$discountFieldId = 10043;


header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', 'fish&chips');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');

// get orders
$result = mysql_query('SELECT * FROM oc_order');
while ($row = mysql_fetch_assoc($result)) $orders[] = $row;

// get coupons
$couponIds = array();
$result = mysql_query("SELECT c.coupon_id, c.name, c.code, c.discount, c.date_start, c.date_end, c.status,
	(SELECT SUM(o.total) FROM oc_coupon_history ch
		INNER JOIN `oc_order` o ON o.order_id = ch.order_id
		WHERE ch.coupon_id = c.coupon_id AND o.order_status_id = '" . $config_complete_status_id ."' GROUP BY c.coupon_id) AS total
	FROM oc_coupon c WHERE c.type = 'C'");
while ($row = mysql_fetch_assoc($result)){
	if ($row['total'] == 0) continue;
	$coupons[] = $row;
	$couponIds[] = $row['coupon_id'];
}

// group coupons by phones/emails
$result = mysql_query("SELECT ch.coupon_id, o.telephone, o.email, o.firstname
	FROM oc_coupon_history ch 
	INNER JOIN oc_order o on (o.order_id = ch.order_id)
	WHERE ch.coupon_id IN (".implode(',', $couponIds).")");
$coupon2phones = $coupon2emails = $coupon2names = array();
while ($row = mysql_fetch_assoc($result)) {
	if (!empty($row['telephone'])){
		if (!isset($coupon2phones[$row['coupon_id']])) $coupon2phones[$row['coupon_id']] = array();
		$coupon2phones[$row['coupon_id']][] =  $row['telephone'];
	}

	if (!empty($row['email'])){
		if (!isset($coupon2emails[$row['coupon_id']])) $coupon2emails[$row['coupon_id']] = array();
		$coupon2emails[$row['coupon_id']][] =  $row['email'];
	}
	
	if (!empty($row['firstname'])){
		if (!isset($coupon2names[$row['coupon_id']])) $coupon2names[$row['coupon_id']] = array();
		$coupon2names[$row['coupon_id']][] =  $row['firstname'];
	}
}

// get contacts from esputnik
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

	foreach(json_decode($output) as $c){
		$contacts[$c->id] = array('id' => $c->id);
		if (!empty($c->firstName)) $contacts[$c->id]['firstName'] = $c->firstName;
		foreach($c->channels as $ch){
			switch($ch->type){
				case 'email': $contacts[$c->id]['email'] = $ch->value; break;
				case 'sms': $contacts[$c->id]['sms'] = $ch->value; break;
			}
		}
	}
	if (empty($output) || $output == '[]') 
		break;
	$startindex += $maxrows;
}

// group contacts by phones/emails
$contactsBySms = $contactsByEmail = $duplicates = array();
foreach($contacts as $c){
	if (!empty($c['sms'])){
		$phone = substr($c['sms'], -10);
		if (isset($contactsBySms[$phone])){
			//echo '<b>Phone already exists:</b>';
			//print_r($c);
			//echo '<hr />';
			$duplicates[] = $phone;
		} else {
			$contactsBySms[$phone] = $c;
		}
	}

	if (!empty($c['email'])){
		$email = trim(strtolower($c['email']));
		if (isset($contactsByEmail[$email])){
			//echo '<b>Email already exists:</b>';
			//print_r($c);
			//echo '<hr />';
			$duplicates[] = $email;
		} else {
			$contactsByEmail[$email] = $c;
		}
	}
}

// update coupons totals at esputnik
$toCreate = $toUpdate = array();
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
			break;
		}	
	}

	/*
	// search contact by email
	if (!$found && !empty($coupon2emails[$c['coupon_id']])){
		$emails = $coupon2emails[$c['coupon_id']];		
		foreach($emails as $k => $v) $emails[$k] = trim(strtolower($v));
		$emails = array_unique($emails);

		foreach($emails as $p){
			if (!isset($coupon2emails[$p])) continue;
			$found = true;
			$email = $p;
			break;
		}
	}
	*/
	
	echo $c['coupon_id'].': ';
	if (!$found){
		$phone = !empty($coupon2phones[$c['coupon_id']]) ? substr(preg_replace('/\D/', '', array_pop($coupon2phones[$c['coupon_id']])), -10) : false;
		$email = !empty($coupon2emails[$c['coupon_id']]) ? trim(array_pop($coupon2emails[$c['coupon_id']])) : false;
		$name = !empty($coupon2names[$c['coupon_id']]) ? trim(array_pop($coupon2names[$c['coupon_id']])) : '';
	
		// create contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->channels = array();
		if ($email) $contact->channels[] = array('type'=>'email', 'value' => $email);
		if ($phone) $contact->channels[] = array('type'=>'sms', 'value' => $phone);
		$contact->fields = array(
			array('id' => $discountFieldId, 'value' => round($c['total'])) //number_format($c['total'], 2, '.', ''))
		);
		$toCreate[] = $contact;
		echo 'not found -> create<br />';
	} elseif (!empty($phone)){
		$name = !empty($coupon2names[$c['coupon_id']]) ? trim(array_pop($coupon2names[$c['coupon_id']])) : '';
		// update contact
		$contact = new stdClass();
		$contact->addressBookId = $addressBookId;  
		$contact->firstName = $name;
		$contact->channels = array();
		//$contact->channels[] = array('type'=>'email', 'value' => $email);
		$contact->channels[] = array('type'=>'sms', 'value' => $contactsBySms[$phone]['sms']);
		$contact->fields = array(
			array('id' => $discountFieldId, 'value' => round($c['total'])) //number_format($c['total'], 2, '.', ''))
		);
		$toUpdate[] = $contact;
		echo $phone.' ('.$contactsBySms[$phone]['sms'].')<br />';
	}
}
echo '<hr />';
if (!empty($toCreate)){
	$request_entity = new stdClass();
	$request_entity->contacts = $toCreate;
	$request_entity->dedupeOn = 'sms';
	$request_entity->contactFields = array('firstName', 'email', 'sms');
	$request_entity->customFieldsIDs = array($discountFieldId);
	$request_entity->groupNames = array('coupons');

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
	echo($output);
	echo '<br />created: '.count($toCreate);
	echo '<hr />';
	echo json_encode($request_entity);
	echo '<hr />';
}

if (!empty($toUpdate)){
	$request_entity = new stdClass();
	$request_entity->contacts = $toUpdate;
	$request_entity->dedupeOn = 'sms';
	$request_entity->contactFields = array('firstName');
	$request_entity->customFieldsIDs = array($discountFieldId);
	$request_entity->groupNames = array('coupons');

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
	echo($output);
	echo '<br />updated: '.count($toUpdate);
	echo '<hr />';
	echo json_encode($request_entity);
}


/*
echo '<table>';
foreach($orders as $o){
	$phone = substr(preg_replace('/\D/', '', $o['telephone']), -10);
	if (strlen($phone) < 10) continue;
	if (!isset($clients[$phone])) $clients[$phone] = array();
	//echo '<tr><td>'.$o['firstname'].'</td><td>'.$o['email'].'</td><td>'.$o['telephone'].'</td><td>'.$phone.'</td></tr>';
}
echo '</table>';

echo '<table>';
foreach($coupons as $c){
	//if (empty($coupon2phones[$c['coupon_id']]))
	//echo '<tr><td>'.$c['coupon_id'].'</td><td>'.$c['name'].'</td><td>'.$c['discount'].'</td><td>'.$c['total'].'</td><td></td></tr>';
}
echo '</table>';

/*
foreach($orders as $order){
	echo $row['firstname'].'<br />';
	$contactId = 10501050;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contact/'.$contactId);
	curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	echo($output);
	curl_close($ch);
}
*/

/*
// get address book
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/addressbooks');
curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$addressBook = json_decode($output);
//print_r($addressBook->addressBook->fieldGroups->fields);
curl_close($ch);

{"addressBook":{
	"addressBookId":"3227",
	"name":"Основной",
	"fieldGroups":{
		"name":"Личные данные",
		"fields":[.
			{"id":"6880","name":"День рождения","description":{"required":"false","readonly":"false"}},
			{"id":"6881","name":"Пол","description":{"allowedValues":{"possibleValues":["м","ж"]},"required":"false","readonly":"false"}},
			{"id":"10043","name":"Дисконтная карта","description":{"allowedValues":{"minValue":"0","maxValue":"1000000"},"required":"false","readonly":"false"}}
		]
	}
}}

[
	{"channels":[{"type":"email","value":"sadovuy-sacha@rambler.ru"}],"addressBookId":3227,"id":21974937,"groups":[]},
	{"channels":[{"type":"email","value":"vkarasik61@gmail.com"}],"addressBookId":3227,"id":21913916,"groups":[]},
	{"channels":[{"type":"email","value":"mulyar.yuliana@yandex.ru"}],"addressBookId":3227,"id":21913676,"groups":[]},
	{"channels":[{"type":"email","value":"maria.aghibalova@gmail.com"}],"addressBookId":3227,"id":21827787,"groups":[]},
	{"channels":[{"type":"email","value":"oleg.boroday@softcube.com"}],"addressBookId":3227,"id":21724127,"groups":[]}
]
*/

?>