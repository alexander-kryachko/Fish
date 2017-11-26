<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });

    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
});
</script>
</head>
<style type="text/css" > #prod-headingatxt,#prod-headingbtxt,#prod-headingctxt,#prod-headingdtxt,#prod-headingetxt,#prod-headingftxt,#prod-headinggtxt,#prod-headinghtxt,#prod-headingitxt,#prod-headingjtxt,#prod-headingptxt  {	-moz-border-bottom-colors: none;    -moz-border-left-colors: none;    -moz-border-right-colors: none;    -moz-border-top-colors: none;    background-color: #F9F9F9;    border-color: #D7D7D7 #D7D7D7 #02A8F6;    border-image: none;    border-style: solid;    border-width: 1px 1px 4px;    color: #f60;
	font-size: 17px;    font-weight: bold;    line-height: 32px;    padding: 13px 20px;
	margin-bottom:5px;    text-transform: uppercase; } .check-box{ border: 1px solid #DDDDDD; width:100%; } .check-content{ display:table; padding-left: 10px; padding-top: 10px;} .check { width: 150px; float:left; } #drop {background:purple; width: 50%; float:right; height:80px; text-align: center; margin-top:-30px;}</style>
<body>
<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><img src="view/image/logo.png" title="<?php echo $heading_title; ?>" onclick="location = '<?php echo $home; ?>'" /></div>
    <?php if ($logged) { ?>
    <div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?></div>
    <?php } ?>
  </div>
  <?php if ($logged) { ?>
  <div id="menu">
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="<?php echo $home; ?>" class="top"><?php echo $text_dashboard; ?></a></li>
      <li id="catalog"><a class="top"><?php echo $text_catalog; ?></a>
        <ul>
          <li><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
          <li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li><?php echo $mass_p_u_code; ?>
<li><a href="index.php?route=batch_editor/index&token=<?php echo $this->session->data['token']; ?>">Batch Editor</a></li>
	          <!-- OCFilter start -->
	          <li><a href="<?php echo $ocfilter; ?>"><?php echo $text_ocfilter; ?></a></li>
	          <!-- OCFilter end -->
	          
          <li><a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a></li>
          <li><a class="parent"><?php echo $text_attribute; ?></a>
            <ul>
              <li><a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a></li>
              <li><a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
          <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>

          <li><a href="<?php echo $suppler; ?>"><?php echo $text_suppler; ?></a></li> 
		  <li><a href="<?php echo $suppler; ?>"><?php echo $text_suppler; ?></a></li> <!--*suppler*-->
           <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>

				<li><a href="<?php echo $shop_rating; ?>"><?php echo $text_shop_rating; ?></a></li>
			
			
          <li><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
          <li><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
<li><a href="<?php echo $article; ?>"><?php echo $text_article; ?></a></li>
		  <li><a href="<?php echo $product_relator; ?>"><?php echo $text_product_relator; ?></a></li>
          <li><a href="<?php echo $image_search; ?>"><?php echo $text_image_search; ?></a></li>
          <li><a href="<?php echo $ocfilter_meta; ?>"><?php echo $text_ocfilter_meta; ?></a></li>

        </ul>
      </li>
      <li id="extension"><a class="top"><?php echo $text_extension; ?></a>
        <ul>
          <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
          <li><a href="<?php echo $shipping; ?>"><?php echo $text_shipping; ?></a></li>
          <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
          <li><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
          <li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>		  
<li><a href="<?php echo $exchange1c; ?>">Opencart Exchange 1C</a></li>
		  <li><a href="<?php echo $hb_oosn_link; ?>"><?php echo $text_hb_oosn; ?></a></li>
		  <li><a href="<?php echo $vk_export; ?>" class="parent"><?php echo $text_vk_export; ?></a>
  <ul>
    <li><a href="<?php echo $vk_export; ?>"><?php echo $text_vk_export; ?></a></li>
    <li><a href="<?php echo $vk_export_albums; ?>"><?php echo $text_vk_export_albums; ?></a></li>
    <li><a href="<?php echo $vk_export_setting; ?>"><?php echo $text_vk_export_setting; ?></a></li>
    <li><a href="<?php echo $vk_export_report; ?>"><?php echo $text_vk_export_cron_report; ?></a></li>
  </ul>
</li>
        </ul>
      </li>
      <li id="sale"><a class="top"><?php echo $text_sale; ?></a>
        <ul>
<!--          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li> -->
		<li><a href="<? echo HTTP_SERVER ?>index.php?route=sale/order&token=<?php echo $this->session->data['token'] ?>&filter_order_status_id=23,26,22,21,1,0,18,24,19,16,20">Продажи</a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
              <li><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
              <li><a href="<?php echo $customer_ban_ip; ?>"><?php echo $text_customer_ban_ip; ?></a></li>
			  <li><a href="<?php echo $customer_ban_email; ?>"><?php echo $text_customer_ban_email; ?></a></li>
			  <li><a href="<?php echo $customer_ban_phone; ?>"><?php echo $text_customer_ban_phone; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>

		<li><a href="<?php echo $advanced_coupon; ?>"><?php echo $text_advanced_coupon; ?></a></li>
			
          <li><a class="parent"><?php echo $text_voucher; ?></a>
            <ul>
              <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
              <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
        </ul>
      </li>
      <li id="system"><a class="top"><?php echo $text_system; ?></a>
        <ul>
          <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
          <li><a class="parent"><?php echo $text_design; ?></a>
            <ul>
              <li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
              <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_users; ?></a>
            <ul>
              <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
              <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_localisation; ?></a>
            <ul>
              <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
              <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
              <li><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
              <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
              <li><a class="parent"><?php echo $text_return; ?></a>
                <ul>
                  <li><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
                  <li><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
                  <li><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
                </ul>
              </li>
              <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
              <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
              <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
              <li><a class="parent"><?php echo $text_tax; ?></a>
                <ul>
                  <li><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
                  <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
                </ul>
              </li>
              <li><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
              <li><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
          <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
        <li><a href="<?php echo $export; ?>"><?php echo $text_export; ?></a></li>
<li><a href="<?php echo str_replace('tool/backup', 'tool/csv_import', $backup); ?>">CSV Import PRO</a></li>
          <li><a href="<?php echo $generate_sitemap; ?>"><?php echo $text_generate_sitemap; ?></a></li>
        <li><a href="<?php echo $export; ?>"><?php echo $text_export; ?></a></li>
        </ul>
      </li>
      <li id="reports"><a class="top"><?php echo $text_reports; ?></a>
        <ul>
          <li><a class="parent"><?php echo $text_sale; ?></a>
            <ul>
			<li><a href="<?php echo $report_export_xls; ?>"><?php echo $text_report_export_xls; ?></a></li>
              <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
              <li><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
              <li><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
              <li><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
              <li><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_product; ?></a>
            <ul>
              <li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
              
<li><a href="<?php echo $report_adv_product_purchased; ?>"><?php echo $text_report_adv_product_purchased; ?></a></li> 
            
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              <li><a href="<?php echo $report_customer_online; ?>"><?php echo $text_report_customer_online; ?></a></li>
              <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
              <li><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
              <li><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_affiliate; ?></a>
            <ul>
              <li><a href="<?php echo $report_affiliate_commission; ?>"><?php echo $text_report_affiliate_commission; ?></a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="octeam"><a class="top"><?php echo $text_octeam; ?></a>
        <ul>
          <li><a href="<?php echo $octeam_toolset; ?>"><?php echo $text_octeam_toolset; ?></a></li>
        </ul>
      </li>
      <li id="help"><a class="top"><?php echo $text_help; ?></a>
        <ul>
          <li><a onClick="window.open('http://myopencart.ru');"><?php echo $text_opencart; ?></a></li>
          <li><a onClick="window.open('http://wiki.myopencart.ru');"><?php echo $text_documentation; ?></a></li>
          <li><a onClick="window.open('http://opencartforum.ru');"><?php echo $text_support; ?></a></li>
        </ul>
      </li>
    </ul>
    <ul class="right" style="display: none;">
      <li id="store"><a href="<?php echo $store; ?>" target="_blank" class="top"><?php echo $text_front; ?></a>
        <ul>
          <?php foreach ($stores as $stores) { ?>
          <li><a href="<?php echo $stores['href']; ?>" target="_blank"><?php echo $stores['name']; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      <li><a class="top" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
    </ul>
  </div>
  <?php } ?>
</div>
