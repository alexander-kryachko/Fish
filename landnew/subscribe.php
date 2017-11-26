<?php
$db = mysql_connect("localhost", "valerathefish", "76874FisherOO_115");
mysql_select_db("bazavaleriya") or die("Error1 :".mysql_error());
$strSQL = "INSERT INTO oc_subscribe(name, email_id) values('" . $_POST["name"] . "','" . $_POST["email_id"] . "')";
mysql_query('set names utf8');
mysql_query($strSQL) or die(mysql_error());
//print("<h1>Подписка на рассылку завершена!</h1>");

 
set_time_limit(0);
$user = 'fish.sput@fisherway.com.ua';
$password = 'fish098';
$event_url = 'https://esputnik.com.ua/api/v1/event';
$config_complete_status_id = 5;
$addressBookId = 3227;
$discountFieldId = 10043;
$couponFieldId = 10154;
$paymentFieldId = 10155;

$currentDiscountFieldId = 10388;
$targetDiscountFieldId = 10389;
$leftToUpgradeFieldId = 10390;


//add to esputnik
$lpsubscribe = $lpsubscribeEmails = array();	
$result = mysql_query("SELECT name, email_id FROM oc_subscribe");
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


$event = new stdClass();
$event->eventTypeKey = 'landing'; // идентификатор типа события
$event->keyValue = $lpsubscribeEmails; // ключ уникальности события - обычно используется email контакта, его идентификатор в системе eSputnik либо в другой системе, или другая уникальная для каждого контакта информация
$event->params = array('name'=> 'EmailAddress', 'value' => $lpsubscribeEmails); // параметры события, которые будут передаваться в сценарий, запускаемую данным событием


send_request($event_url, $event, $user, $password);
 
function send_request($url, $json_value, $user, $password) {
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_value));
 curl_setopt($ch, CURLOPT_HEADER, 1);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'));
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
 $output = curl_exec($ch);
 curl_close($ch);
// echo($output);
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
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/contacts');
	curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
//	echo '<hr />';
//	echo($output);
	
 

}
mysql_close($db); //закрытие соединения	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<title>Успех регистрации. Рыболовные снасти - Все для рыбалки</title>
		<meta name="description" content="рыбалка, рыболовный интернет-магазин, рыболовный магазин, рыболовные снасти"</>
		<meta name="keywords"  content="рыбалка, рыболовный интернет-магазин, рыболовный магазин, рыболовные снасти"</>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.measurer.js"></script>
		<script type="text/javascript" src="jquery.gradienttext.js"></script>
		<script type="text/javascript" src="jquery.masonry.min.js"></script>
		
		<script type="text/javascript">
		$(document).ready(function(){$('#fisherway,#fisherway_2,#fisherway_3,#fisherway_4,#fisherway_5').gradientText({colors:['#00669c','#009a9a']});});
		</script>
		
		<script type="text/javascript">
    	$(function() {$('#otziv_block_cont').masonry({itemSelector : '#otziv_block_1',}); });
		</script>
		
    </head>
<body>
<div id="wrapper">

<div id="header">
<div id="header_block">
	<div id="header_block_1"></div>
	<div id="header_block_2">РЫБОЛОВНЫЙ ИНТЕРНЕТ-МАГАЗИН</div>
	<div id="header_block_3">
		<p>(044) 568-01-48&nbsp;&nbsp;(095) 446-76-71</p>
		<p>(068) 489-94-90&nbsp;&nbsp;(063) 568-01-48</p>
		<a href="mailto:client@fisherway.com.ua">client@fisherway.com.ua</a></div>
	</div>
</div>

<div id="text_block">
	<p id="fisherway">Спасибо! Мы получили вашу заявку</p>
</div>	
<!--
<div id="forma">
<div id="forma_block">
	<div id="forma_block_1">
		<div id="forma_item"><b>ПРОМО-КОД НА СКИДКУ 15%</b><br/>НА ПЕРВЫЙ ЗАКАЗ В ИНТЕРНЕТ-МАГАЗИНЕ</div>
		<div id="forma_item"><b>УЧАСТИЕ В РОЗЫГРЫШАХ И КОНКУРСАХ</b><br/>ТОЛЬКО СРЕДИ КЛИЕНТОВ</div>
		<div id="forma_item"><b>КАРТУ VIP-КЛИЕНТА</b><br/>С НАКОПИТЕЛЬНОЙ СКИДКОЙ</div>
	</div>
	<div id="forma_block_2">
		<b>ЗАПОЛНИТЕ АНКЕТУ</br>УЧАСТНИКА</b>
		</br>
		</br>
		<div style="padding:0px 40px;">
		<iframe frameborder="0" src="http://sn.am/I1Z7DmLMGs" width="90%" height="165" scrolling="no"></iframe>
		</div>
-->	
  

<div id="text_block">
	<p id="fisherway_orange">Ваш код скидки на первый заказ: gf-150315</p>
<br><br>
<p align="center">
Введите его при оформлении заказа, скидка рассчитается автоматически
</p>
<br><br>
<div align="center">
<img src="img/kupon.jpg">
</div>
<br><br>
<div align="center">
<a href="http://fisherway.com.ua"><img src="img/button.png"></a>
</div>
</div>
<div id="plushka">
<div id="plushka_block" style="width:800px">
	<div id="plushka_block_2">СОХРАНИТЕ E-MAIL<br/>МЫ ОТПРАВИЛИ НА НЕГО КОД СКИДКИ</div>
	<div id="plushka_arrow"></div>
	<div id="plushka_block_3">ВЫБИРАЙТЕ РЫБОЛОВНЕ СНАСТИ И<br/>ОФОРМЛЯЙТЕ ЗАКАЗ</div>
</div>	
</div>

<div id="razdel_block"></div>	


<div id="clear"></div>

<div id="footer_block"></div>


</div>
<!-- Код cube -->
<script type="text/javascript">

(function(){
 var alertFallback = true;
   if (typeof console === "undefined" || typeof console.log === "undefined") {
     console = {};
     if (alertFallback) {
         console.log = function(msg){};
     } else {
         console.log = function() {};
     }
   }
var siteId = 'D9216D9B64FD4EF5A67FD11E67317A83';
var scScr = document.createElement('script');
scScr.async = true;
scScr.src = 'https://cdnanalytics.datasoftcube.com/' + siteId + '/sc.js?r=' + 1*new Date();
document.body.appendChild(scScr);
}());

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42988686-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter22272319 = new Ya.Metrika({id:22272319,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22272319" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Google Code for &#1059;&#1089;&#1087;&#1077;&#1096;&#1085;&#1072;&#1103; &#1088;&#1077;&#1075;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1103; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 981214292;
var google_conversion_language = "uk";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "wvJGCOKjsVgQ1Mjw0wM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/981214292/?label=wvJGCOKjsVgQ1Mjw0wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>