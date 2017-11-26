<?
set_time_limit(0);
$user = 'fish.sput@fisherway.com.ua';
$password = 'fish098';
$config_complete_status_id = 5;
$addressBookId = 3227;
$discountFieldId = 10043;

header('Content-type: text/html; encoding=utf-8');
mysql_connect('localhost', 'valerathefish', '123FishchipS1234');
mysql_select_db('bazavaleriya');
mysql_query('set names utf8');

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/addressbooks');
curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);
echo($output);
curl_close($ch);

?>