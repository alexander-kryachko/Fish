<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; if (isset($_GET['page'])) { echo ", ". ((int) $_GET['page'])." страница";} ?></title>
<base href="<?php echo $base; ?>" />
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo ", ". ((int) $_GET['page'])." страница";} ?>" />
<?php if ($keywords) { ?><meta name="keywords" content="<?php echo $keywords; ?>" /><?php } ?>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<META name="robots" content="noarchive" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="/catalog/view/theme/fisherway/stylesheet/_stylesheet_mobile.css?v=1.4" />
<meta property="og:site_name" content="<?php echo $name; ?>" /><?php 
if (isset($_GET['sort']) || isset($_GET['order'])) { 
	?><meta name="robots" content="noindex, nofollow"><?php 
}
if (isset($_GET['page'])) {
    $base_url = strstr($_SERVER['REQUEST_URI'], '?', true);
	if ($_GET['page'] == 1) { 
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url; ?>" />*/
		?><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page=2'; ?>" /><?php
	} else if ($_GET['page'] == 2) { 
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page']);?>" />*/
		?><link rel="prev" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url; ?>" /><?php
        ?><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] + 1);?>" /><?php 
	} else {
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page']);?>" />*/
		?><link rel="prev" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] - 1);?>" /><?php
        ?><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] + 1);?>" /><?php 
	}
}
if ($icon) { ?><link href="<?php echo $icon; ?>" rel="icon" /><?php } 
foreach ($links as $link) { ?><link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" /><?php } 

/*
<link rel="stylesheet" type="text/css" href="/catalog/view/theme/default/stylesheet/ocfilter/ocfilter.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />	
<link rel="stylesheet" type="text/css" href="catalog/view/supermenu/supermenu.css?v=21" />
*/
?><link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/_stylesheet.css?v=1.20" /><?php
$skipStyles = array('/ocfilter.css', '/colorbox.css', '/jquery-ui-1.8.16.custom.css', '/supermenu.css?v=21', '/supermenu.css');
foreach ($styles as $style){	
	if (in_array(strrchr($style['href'], '/'), $skipStyles)) continue;
	?><link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" /><?php 
} 


/*
<script type="text/javascript" src="/catalog/view/javascript/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/slider/slides.min.jquery.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/gallery/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/jquery.liactualsize.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/set.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/slider/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="catalog/view/supermenu/supermenu-responsive.js?v=22"></script>

<script type="text/javascript" src="/catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/imagepreview/imagepreview.js"></script>
http://fisherway.com.ua/…cript/jquery/jquery.total-storage.min.js
http://fisherway.com.ua/…log/view/javascript/ocfilter/ocfilter.js
http://fisherway.com.ua/…log/view/javascript/ocfilter/trackbar.js
http://fisherway.com.ua/catalog/view/javascript/jquery/tabs.js
http://fisherway.com.ua/…t/jquery/colorbox/jquery.colorbox-min.js
http://fisherway.com.ua/…y/scripts/slider/jquery.jcarousel.min.js
ajaxupload.js
*/
?><script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/_jquery.js"></script><?php
$skipScripts = array('/jquery.total-storage.min.js', '/ocfilter.js', '/trackbar.js', '/tabs.js', '/jquery.colorbox-min.js', '/jquery.jcarousel.min.js');
foreach ($scripts as $script) { 
	if (in_array(strrchr($script, '/'), $skipScripts)) continue;
	?><script type="text/javascript" src="<?php echo $script; ?>"></script><?php 
} 
?><script type="text/javascript">if(Function('/*@cc_on return document.documentMode===10@*/')()){document.documentElement.className+=' ie10';}</script>
<!--[if IE]><link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/ie.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/ie7.css" /><![endif]-->
<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/ie6.css" /><script type="text/javascript" src="/catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script><script type="text/javascript">DD_belatedPNG.fix('#logo img');</script><![endif]-->
<?php 
/*if ($stores) { ?>
	<script type="text/javascript"><!--
		$(document).ready(function() {
			<?php foreach ($stores as $store) { ?>
				$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
			<?php } ?>
		});
	//--></script>
<?php }*/ 
echo $google_analytics; 
?>
<script type="text/javascript">
$(function() {
	  $('.mLink').click( function() {
			if($('.topmenu').css('visibility') == 'visible') {
				$('.topmenu').css('visibility','hidden');
			}
			else {
				$('.topmenu').css('visibility','visible');
			}
		});

	  $('.closeBtn').click( function() {
	  		$('.topmenu').css('visibility','hidden');
	  		
	  });
	});


</script>

<script type="text/javascript">
$(function() {
	  $('#mainNav').click( function() {
	  	$('#supermenu').slideToggle(400, function() {
	  	if($('#mainNav').hasClass('active')) {
			$('#mainNav').removeClass('active');
			$('#container').css('margin-top','390px');
				  	$('#supermenu').css('display','none');
						}
						else {
	  	$('#supermenu').css('display','block');
	  	$('#container').css('margin-top','90px');
	  	$('#mainNav').addClass('active');

		}		
		});	
		});
	});


</script>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function(d,w,c){
    (w[c]=w[c] || []).push(function(){try {w.yaCounter22272319 = new Ya.Metrika({id:22272319});}catch(e){};});
    var n = d.getElementsByTagName("script")[0],s = d.createElement("script"),f=function(){n.parentNode.insertBefore(s, n);};
    s.type = "text/javascript";s.async = true;s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
    if (w.opera == "[object Opera]"){d.addEventListener("DOMContentLoaded", f, false);}else{f();}
})(document, window, "yandex_metrika_callbacks");
</script><noscript><div><img src="//mc.yandex.ru/watch/22272319" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<div id="container">
<div id="notification"></div>