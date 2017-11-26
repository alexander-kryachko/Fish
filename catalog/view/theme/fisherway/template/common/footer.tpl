
    </div>
</div>


<div id="header2">

<?/*
	<a href="javascript:void(0);" title="Показать меню" class="mLink " name="">
    	<img src="catalog/view/theme/fisherway/image/menu.png" width="30" height="30" class="" alt="Меню">
	</a>
	<div class="topmenu">
	<div class="headercontainer">
		<div class="inner">
		
		<?php  if($_SERVER['REQUEST_URI'] == "/")  { ?> <div id="logo"></div>
 <?php } else { ?>
 <a id="logo" href="/" title="Рыболовные снасти"></a>
 <?php }?>
	
			<div id="searchContainer">
			 <div class="phones"><span class="phone"><span>(044)</span> 568-01-48 &nbsp; <span>(095)</span> 446-76-71 &nbsp; </span><span class="phone"><span>(068)</span> 489-94-90 &nbsp; <span>(063)</span> 568-01-48 &nbsp; </span><a id="callme">Вам перезвонить?</a></div>
			 <div class="phonesMobile"><span class="phone">(044) 568-01-48 &nbsp; (095) 446-76-71 &nbsp; </span><span class="phone">(068) 489-94-90 &nbsp; (063) 568-01-48 &nbsp; </span><a id="callme">Вам перезвонить?</a></div>
			 <div id="search">
				<input type="text" name="search" id="searchin" placeholder="Поиск" value="<?php echo $search; ?>" />
				<div class="button-search">Найти</div>
			 </div>
			</div>
			<a id="mainNav" href="javascript:void(0);">Меню</a>
			<?php
			//echo '<div class="cart">'.$cart.'</div>';
			?>
		</div>
	</div>
</div>
*/?>
<?php // echo $supermenu; ?>






</div>
﻿

 <footer class="footer">
 			<div class="footer-in">
                 <div class="width">
                     <div class="footer-row-1">
                         <div class="footer-col-1"><img src="/catalog/view/theme/fisherway/image/logo_footer.png" alt=""></div>
                         <div class="footer-subscribe footer-col-2">
                             <div class="h">Хотите получить новости и быть в курсе акций?</div>
                             <!-- <form action="">
                                 <input type="text">
                                 <input type="submit" value="Подписаться">
                             </form> -->
		                             <iframe frameborder="0" src="https://secure.esputnik.com.ua/2hdfnvEXsGs" width="100%" height="70" scrolling="no"></iframe>

                         </div>
                     </div>
                     <div class="footer-row-2">
                         <div class="footer-col-1">
                             <div class="footer-phones">
                                 <a href="tel:+380445680148"><span class="code">(044)</span> 568-01-48</a>
                                 <a href="tel:+380954467671"><span class="code">(095)</span> 446-76-71</a>
                                 <a href="tel:+380684899490"><span class="code">(068)</span> 489-94-90</a>
                                 <a href="tel:+380635680148"><span class="code">(063)</span> 568-01-48</a>
                             </div>
                             <a href="mailto:contact@fisherway.com.ua">contact@fisherway.com.ua</a>
                         </div>
                         <div class="footer-col-2">
                             <ul class="footer-navi">
                             	<li><a href="/vip">Скидки %</a></li>
                             	<li><a href="/feedback">Отзывы</a></li>
                             	<li><a href="/dostavka-oplata">Доставка и оплата</a></li>
                             	<li><a href="/contact">Контакты</a></li>
                             	<a href="index.php?route=product/latest">Новинки</a>
                             </ul>
                         </div>
                     </div>
                     <div class="footer-row-3">
                     	 <a href="http://www.activeclub.com.ua"><img src="http://www.activeclub.com.ua/top/images/null.png" alt="Туризм и активный отдых. Поход Крым, поход Кавказ, поход Алтай, поход Карпаты" border="0" width="" height=""></a><a href="http://www.activeclub.com.ua/top/"><img src="http://www.activeclub.com.ua/top/button.php?u=fisherway" alt="ACTIVE-рейтинг туристических сайтов. Туризм и отдых" border="0" width="88" height="31"/></a>
                     	<a href="http://darg.gov.ua/"><img src="http://fisherway.com.ua/image/data/banners/dra.jpg" alt="Державне Агентство Рибного Господарства" border="0" width="" height=""></a>
                         <small class="cpr">
                             <strong>© «FisherWay» 2017</strong>
                             Все права защищены
                         </small>
                     </div>
                 </div>
 			</div>
 		</footer>






    <div class="header-row-2">
        <nav class="width header-nav page-cols">
            <div class="page-col-1">
                <div class="mobile-menu-call">
                    Меню
                </div>
 <div id="supermenu">
 <?php foreach ($modules as $module) { ?>
 <?php echo $module; ?>
 <?php } ?>
 </div>
 </div>
            <div id="cartWrapper" class="page-col-2 cart-place">
            	<div class="cart" id="cartContainer"><i class="icn icn-x2 icn-cart"></i><?php echo $cart;?></div>
            </div>
        </nav>
    </div>







<?php
//<div style="display: none;">
//print_r($_SERVER);
//echo strtolower($_SERVER['REQUEST_URI']);
// if (preg_match('@[A-Z]@u',$_SERVER['REQUEST_URI'])) {
// 	$refer = strtolower($_SERVER['REQUEST_URI']);
// 	header('Location: http://'.$_SERVER['SERVER_NAME'].$refer);
// 	exit();
// }

// if (substr($_SERVER['REQUEST_URI'], -1) != '/' && !strstr($_SERVER['REQUEST_URI'], '.html') && !strstr($_SERVER['REQUEST_URI'], '?' )) {
// 	header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'/');
// 	exit();
// }


// if ( strpos($_SERVER['REQUEST_URI'], 'index.php?route=product/product') != 0 || strstr($_SERVER['REQUEST_URI'], 'index.php?route=product/category')) {
// 	header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.'404');
// 	exit();
// }

// if ( strstr($_SERVER['REQUEST_URI'], '/index.php?route=common/home')) {
// 	header('Location: http://'.$_SERVER['SERVER_NAME'].'/');
// 	exit();
// }

?><script type="text/javascript" src="catalog/view/theme/fisherway/scripts/_combined.js?v=1.27"></script><?php
$skipScripts = array('/jquery.total-storage.min.js', '/ocfilter.js', '/trackbar.js');
if (!empty($scripts)) foreach ($scripts as $script) { 
	if (in_array(strrchr($script, '/'), $skipScripts)) continue;
	?><script type="text/javascript" src="<?php echo $script; ?>"></script><?php 
} 
?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'C0HNTEwiqF';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<!-- Код cube -->
<script type="text/javascript">
!function(t,e,c,n){var s=e.createElement(c);s.async=1,s.src="https://script.softcube.com/"+n+"/sc.js";var r=e.scripts[0];r.parentNode.insertBefore(s,r)}(window,document,'script',"D9216D9B64FD4EF5A67FD11E67317A83");
</script>
<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/magnific-popup.css"> 
				<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/huntbee-popup.css">
				<script src="catalog/view/theme/default/stylesheet/jquery.magnific-popup.min.js"></script>
				
				<style type="text/css"><?php echo $hb_oosn_css;?></style>
				
				<div id="notifyform" class="white-popup mfp-with-anim mfp-hide">
					<input type="hidden" id="pid" name="pid" value="">
					<div id="oosn_info_text"><?php echo $oosn_info_text; ?></div><div id="opt_info"></div><br />
					<table style="padding-top:5px; width:100%;">
						<?php if ($hb_oosn_name_enable == 'y') {?>
							<tr>
								<td><?php echo $oosn_text_name; ?></td>
								<td><input name="notifyname" type="text" id="notifyname" placeholder="<?php echo $oosn_text_name_plh; ?>" value="<?php echo $fname;?>" /></td>
							</tr>
						<?php } ?>
						<tr>
							<td><?php echo $oosn_text_email; ?></td>
							<td><input name="notifyemail" type="text" id="notifyemail" placeholder="<?php echo $oosn_text_email_plh; ?>" value="<?php echo $email;?>" /></td>
						</tr>
						<?php if ($hb_oosn_mobile_enable == 'y') {?>
						<tr>
							<td><?php echo $oosn_text_phone; ?></td>
							<td><input name="notifyphone" type="text" id="notifyphone" placeholder="<?php echo $oosn_text_phone_plh; ?>" value="<?php echo $phone;?>" /></td>
						</tr>
						<?php } ?>
						<tr>
							<td></td>
							<td><button type="button" id="notify_btn" class="notify_button"><i class="fa fa-bell"></i> <?php echo $notify_button; ?></button></td>
						</tr>
						</table>
					   <br>
					
					<div id='loadgif' style='display:none'><img src='catalog/view/theme/default/image/loading.gif'/></div>
					<div id="msgoosn"></div>
										
				</div><!--notifyform -->
								
				<script type="text/javascript">
				function notifypop(i){$("#pid").val(i),$("#msgoosn").html(""),$.magnificPopup.open({items:{src:"#notifyform"},type:"inline",removalDelay:800,midClick:!0,callbacks:{beforeOpen:function(){this.st.mainClass="<?php echo $hb_oosn_animation;?>"}}})}
				</script>
				
				<script type="text/javascript">
				$("#notify_btn").click(function(){
					$("#msgoosn").html(""), $("#loadgif").show();
					var e=$("#notifyname").length?$("#notifyname").val():
					"",o=$("#notifyphone").length?$("#notifyphone").val():"";
					if($("#option_values").length)var t=$("#option_values").val(),n=$("#selected_option").val(),a=$("#all_selected_option").val();
					else var t=0,n=0,a=0;$.ajax({
						type:"post",url:"index.php?route=product/product_oosn",data:{
							data:$("#notifyemail").val(),
							name:e,
							phone:o,
							product_id:$("#pid").val(),
							selected_option_value:t,
							selected_option:n,
							all_selected_option:a
						},
						dataType:"json",
						success:function(e){
							if (e && e.success){
								$("#msgoosn").html(e.success),
								$("#loadgif").hide()
							}
						},
						error:function(e,o,t){
							alert(t+"\r\n"+e.statusText+"\r\n"+e.responseText)
						}
					})
				});
				</script>
				
				<!-- RMG GGL -->
				<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 981214292;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/981214292/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

				<!-- RMG GGL END -->
<script>

window.rnt=window.rnt||function(){(rnt.q=rnt.q||[]).push(arguments)};

rnt('add_event', {advId: 14875});

//<!-- EVENTS START -->

rnt('add_audience', {audienceId: '14875_3d3cf2c2-8487-4abf-a02f-bb7705a27fc7'});

//<!-- EVENTS FINISH -->

</script>

<script async src='//uaadcodedsp.rontar.com/rontar_aud_async.js'></script>
<script id="dsq-count-scr" src="//fisherway.disqus.com/count.js" async></script>
</body></html>