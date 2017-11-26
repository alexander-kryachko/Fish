<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
  <?php if (empty($vqmod_available)) { ?>
  <div class="warning"><?php echo $error_vqmod; ?></div>
  <?php } ?>    
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <?php if (!empty($vqmod_available)) { ?>
      <div class="buttons"><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
      <?php } ?>
    </div>
    <div class="content">
    <?php if (!empty($vqmod_available)) { ?>
    <div id="tabs" class="htabs"><a id="about" href="#tab-about"><?php echo $tab_about; ?></a></div> 
      	        
     <div id="tab-about">
     <div id="adv_sale_order"></div>
     <div id="adv_product_purchased"></div>
     <div id="adv_customer_order"></div>
     <div align="center"><img src="view/image/adv_reports/adv_logo.jpg" /></div>
     </div>
     
     <?php } ?>
    </div>
  </div>
</div> 
<?php if ($adv_so_ext_version && $adv_so_version && $adv_so_version['version'] != $adv_so_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('<img id=\"warning\" src=\"view/image/warning.png\" width=\"15\" height=\"15\" align=\"absmiddle\" hspace=\"5\" border=\"0\" />');  $('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } elseif ($adv_pp_ext_version && $adv_pp_version && $adv_pp_version['version'] != $adv_pp_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('<img id=\"warning\" src=\"view/image/warning.png\" width=\"15\" height=\"15\" align=\"absmiddle\" hspace=\"5\" border=\"0\" />');  $('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } elseif ($adv_co_ext_version && $adv_co_version && $adv_co_version['version'] != $adv_co_current_version) { ?>  
<script type="text/javascript"><!--
$('#about').append('<img id=\"warning\" src=\"view/image/warning.png\" width=\"15\" height=\"15\" align=\"absmiddle\" hspace=\"5\" border=\"0\" />');  $('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
//--></script> 
<?php } ?>
<script type="text/javascript"><!--
$('.htabs a').tabs();
//--></script> 
<?php echo $footer; ?>