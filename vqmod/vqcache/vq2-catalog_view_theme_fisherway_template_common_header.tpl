<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" <?php if( $_SERVER['REQUEST_URI'] == '/' ) { ?>class="homepage"<?php } ?>>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">
<link rel="stylesheet" media="screen and (max-width: 350px)" href="/catalog/view/theme/fisherway/stylesheet/stylesheet_mobile.css" />
<link rel='stylesheet' href='https://apimgmtstorelinmtekiynqw.blob.core.windows.net/content/MediaLibrary/Widget/Calc/styles/calc.css' />
<meta property="og:site_name" content="<?php echo $name; ?>" /><?php 
if (isset($_GET['sort']) || isset($_GET['order'])) { 
	?><meta name="robots" content="noindex, follow, noarchive"><?php 
}
if (isset($_GET['page'])) {
    $base_url = strstr($_SERVER['REQUEST_URI'], '?', true);
	if ($_GET['page'] == 1) { 
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url; ?>" />*/
		?><meta name="robots" content="noindex, follow, noarchive" /><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page=2'; ?>" /><?php
	} else if ($_GET['page'] == 2) { 
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page']);?>" />*/
		?><meta name="robots" content="noindex, follow, noarchive" />
		<link rel="prev" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url; ?>" /><?php
        ?><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] + 1);?>" /><?php 
	} else {
		/*<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page']);?>" />*/
		?><meta name="robots" content="noindex, follow, noarchive" />
		<link rel="prev" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] - 1);?>" /><?php
        ?><link rel="next" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$base_url.'?page='.($_GET['page'] + 1);?>" /><?php 
	}
}


if ($icon) { ?><link href="/image/data/Fisherway.png" rel="icon" /><?php } 
foreach ($links as $link) { ?><link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" /><?php } 

/*
<link rel="stylesheet" type="text/css" href="/catalog/view/theme/default/stylesheet/ocfilter/ocfilter.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />	
<link rel="stylesheet" type="text/css" href="catalog/view/supermenu/supermenu.css?v=21" />
*/
?><link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/stylesheet.css?v=2" /><?php
$skipStyles = array('/ocfilter.css', '/colorbox.css', '/jquery-ui-1.8.16.custom.css', '/supermenu.css?v=21', '/supermenu.css');

 foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />

<?php } 

foreach ($styles as $style){	
	if (in_array(strrchr($style['href'], '/'), $skipStyles)) continue;
	?><?php 
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
?>
<script type="text/javascript" src="catalog/view/theme/fisherway/scripts/_jquery.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/plugins.js"></script>
<script type="text/javascript" src="/catalog/view/theme/fisherway/scripts/main.js"></script>
<?php
$skipScripts = array('/jquery.total-storage.min.js', '/ocfilter.js', '/trackbar.js', '/tabs.js', '/jquery.colorbox-min.js', '/jquery.jcarousel.min.js');
foreach ($scripts as $script) { 
	if (in_array(strrchr($script, '/'), $skipScripts)) continue;
	?><?php 
} 

 foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php }

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
<!-- PUSH -->
<script>
 (function(i,s,o,g,r,a,m){
 i["esSdk"] = r;
 i[r] = i[r] || function() {
  (i[r].q = i[r].q || []).push(arguments)
 }, a=s.createElement(o), m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g;
 m.parentNode.insertBefore(a,m)}
 ) (window, document, "script", "https://esputnik.com/scripts/v1/public/scripts?apiKey=eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiI0NTI0ZWZhYTJkYzI2MGRmYTM4YTE1NDBlMWE1YjY1MmQyZmUyNzBlMjg1YWZhOTUwN2I5NDg3YWMwOTQ0ZDE0NjhhMmZjMzUwMmEyYWM2MjZmNDU3YWY5YzcyMWM3MGQwOGU4Yzg1NzQxM2E3NWJiYjMzNDVjODMyNTFlZWEwMmQ4OWViZDNlM2U3MDY2NTFiOTczZjQ3ZmVmZDQ1MTFhMDY4ZWU0OTQ5YzFkNjQ1OWY3MDBhZjkzOTFlNCJ9.Vz_S9UTBNVWjiRvo2nGfEzKKmfGTkQc_dErfC-rrDh_JUzFItuMWeCzJZkBfJjr0BBiocBOF6RasMzAMRPv_5g&domain=C6E1E523-BAA1-4FB9-A048-45CC71CE1B81", "es");
 es("pushOn");
</script>
<!-- PUSH END -->

<link rel="stylesheet" type="text/css" href="/catalog/view/theme/fisherway/stylesheet/fresh.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sphinxAutocomplete.css">
                <script type="text/javascript">
    var selector = '#searchin';
    var catTitle = 'Категории';
    var prodTitle = 'Товары';
    var viewAllTitle = 'Показать все';
    var noResTitle = 'Ничего не найдено';
    
    $(document).ready(function() {

        var timer = null;
        $('#search input').keydown(function(){
           clearTimeout(timer); 
           timer = setTimeout(sphinxAutocomplete, 500)
        });

    });

    $(document).mouseup(function (e) {
        
        if (!$('.sphinxsearch').is(e.target) && $('.sphinxsearch').has(e.target).length === 0) {
            $('.sphinxsearch').hide();
            $('#search input').removeClass('no-bottom-borders');
            return false;
        }
        
    });


    function sphinxAutocomplete() {

        if($(selector).val() == '') {
            $('.sphinxsearch').hide();
            $('#search input').removeClass('no-bottom-borders');
            return false;
        }



        $.ajax({
            url: 'http://fisherway.com.ua/index.php?route=module/sphinxautocomplete&search=' + $(selector).val(),
            dataType: 'json',
            success: function(json) {

                var html = '';
         		//console.log('aa');       
                //Categories
                if (json.categories.length) {
                    html += '<div class="categories"><span>'+catTitle+'</span>';
                    var categories = json.categories;
                    for (i = 0; i < categories.length; i++) {
                        html += '<a href="' + categories[i]['href'] + '">';
                            if(categories[i]['image'] != '') {
                                html += '<img src="' + categories[i]['image'] + '" />';
                            }
                            html += categories[i]['name'];
                            html += '<br />';
                        html += '</a>';
                    }
                    html += '</div>';
                }
                
                //Products
                if (json.products.length) {
                    if (json.categories.length) { html += '<div class="products"><span>'+prodTitle+'</span>'; }
                    var products = json.products;
                    for (i = 0; i < products.length; i++) {
                        html += '<a href="' + products[i]['href'] + '">';
                            html += '<img src="' + products[i]['image'] + '" />';
                            html += products[i]['name'];
                            html += '<br />';
                        html += '</a>';
                    }
                    if (json.categories.length) {  html += '</div>'; }
                    html += '<div class="sphinx-viewall"><a id="view-all" href="http://fisherway.com.ua/index.php?route=product/search&amp;wildcard=true&amp;search=' + encodeURIComponent($(selector).val()) + '">'+viewAllTitle+'</a></div>';
                } else {
                    html = '<div class="sphinx-viewall">'+noResTitle+'</div>';
                }

                $('ul.dropdown-menu, .sphinxsearch').remove();
                $(selector).after('<div class="sphinxsearch">'+ html +'</div>');
                $('.sphinxsearch').show();
                $('#search input').addClass('no-bottom-borders');

            }
        });
            
    }
</script>

<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sphinxAutocomplete.css">
				<?php echo $sphinx_autocomplete_js; ?>
</head>
<body>

<div class="page-container">
	<div class="page-container-in">
<div id="notification"></div>



<header class="page-header">
    <div class="header-row-1">
        <div class="width">
            <div class="logo-place"><a href=""><img src="/catalog/view/theme/fisherway/image/logo.png" alt=""></a></div>
            <div class="search-place">
                <ul class="search-tabs">
                    <li class="active"><a href="/vip">Скидки %</a></li>
                    <li><a href="/dostavka-oplata">Доставка и оплата</a></li>
                    <li><a href="/feedback">Отзывы</a></li>
                    <li><a href="/contact">Контакты</a></li>
                </ul>
                <form class="search-form" id="search">
                    <input type="text" placeholder="Поиск товаров" name="search" id="searchin" autocomplete="off" value="<?php echo $search; ?>">
                    <div class="button-search icn button-search icn-search"></div>
                </form>
            </div>
            <div class="phones-place">
                <div class="phones-numbers">
                    <address class="head-phone-nmb phone-nmb"><a href="tel:+380445680148"><span class="code">(044)</span> 568-01-48</a></address>
                    <address class="head-phone-nmb phone-nmb"><a href="tel:+380954467671"><span class="code">(095)</span> 446-76-71</a></address>
                    <address class="head-phone-nmb phone-nmb"><a href="tel:+380684899490"><span class="code">(068)</span> 489-94-90</a></address>
                    <address class="head-phone-nmb phone-nmb"><a href="tel:+380635680148"><span class="code">(063)</span> 568-01-48</a></address>
                </div>
                <a id="callme" class="callback btn btn-red btn-mid">ОБРАТНЫЙ ЗВОНОК</a>
            </div>
            <div class="workhours"><i class="icn icn-x2 icn-wh"></i>
                <span>Работаем <b>пн-пт 9:00-20:00</b></span>
            </div>
            <div class="personal-area">
                <a href="" class="login">
                    <i class="icn icn-x2 icn-login"></i>
                    <span>ВХОД</span>
                </a>
            </div>
        </div>
    </div>
</header>
                <div class="page-itself">
                    <div class="width">