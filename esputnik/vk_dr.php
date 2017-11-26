<?
header('Content-type: text/html; encoding=utf-8');
$privateKey = "sdf:AS23-bH83fnsz";

$type = 'P'; 				// Тип скидки. Допустимые значения: P - процент, F - фиксированная сумма, C - накопительная скидка
$discount = 10;					// Числовое значение скидки (сумма или процент)
$discount_plan = array(); 	// Ассоциативный массив с дисконтным планом, только для типа "C". Ключи = суммы, значения = получаемые при накоплении суммы скидки.
							// Например: array('0' => '3', '3000' => '5', '5000' => '6')
$shipping = 0;				// Бесплатная доставка. Допустимые значения: 1 - да, 0 - нет.
$date_start = 0; 			// Начало действия купона в формате YYYY-mm-dd. 0 - купон доступен сразу же после создания.
$days = 6;					// Время действия купона в днях. 0 - без ограничения.
//$date_end = 0;			// Завершение действия купона в формате YYYY-mm-dd. 0 - без ограничения.
$uses_total = 10; 			// Сколько раз максимально может использоваться купон. 0 - для бесконечного использования.
$uses_customer = 10; 		// Сколько раз максимально может использоваться купон одним клиентом. 0 - для бесконечного использования.
$coupon_product = array();	// Массив с ID привязанных к купону товаров (значения externalItemId). Если пусто, действует на все товары.
$coupon_name = 'Именинники Вконтакте'; // Название купона (необязательно, по умолчанию = "Дисконтная карта (Esputnik) №...")
$coupon_prefix = 'vk-';		// Префикс купона (необязательно)

$data = array(
	'type' => $type,
	'discount' => (string)$discount,
	'discount_plan' => serialize($discount_plan),
	'shipping' => (string)$shipping,
	'date_start' => (string)$date_start,
	'days' => (string)$days,
	//'date_end' => (string)$date_end,
	'uses_total' => (string)$uses_total,
	'uses_customer' => (string)$uses_customer,
	'coupon_product' => serialize($coupon_product),

	'coupon_name' => (string)$coupon_name,
	'coupon_prefix' => (string)$coupon_prefix
);

$hash = md5($privateKey.serialize($data));
$data['hash'] = $hash;

$result = file_get_contents('http://fisherway.com.ua/esputnik/setcoupon.php?'.http_build_query($data));

if ($result){
	echo $result;
} else {
	echo 'Ошибка';
}
?>