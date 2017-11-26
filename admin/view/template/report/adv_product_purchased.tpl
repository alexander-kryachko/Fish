<?php echo $header; ?>
<?php if (!defined('_JEXEC')) { ?>
<script type="text/javascript">
jQuery(document).ready(function() { 
  jQuery("#content_report").hide(); 
  jQuery(window).load(function() { 
    	jQuery("#content_report").show(); 
    	jQuery("#content-loading").hide(); 
  	});
});
</script>
<div id="content-loading" style="position: absolute; background-color:white; layer-background-color:white; height:100%; width:100%; text-align:center;"><img src="view/image/adv_reports/page_loading.gif" border="0"></div>
<?php } ?>
<style type="text/css">
.box > .content_report {
	padding: 10px;
	border-left: 1px solid #CCCCCC;
	border-right: 1px solid #CCCCCC;
	border-bottom: 1px solid #CCCCCC;
	min-height: 300px;
}
.list_main {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 10px;
}
.list_main td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main thead td {
	background-color: #E5E5E5;
	padding: 0px 5px;
	font-weight: bold;	
}
.list_main tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main .left {
	text-align: left;
	padding: 7px;
}
.list_main .right {
	text-align: right;
	padding: 7px;
}
.list_main .center {
	text-align: center;
	padding: 3px;
}
.list_main .noresult {
	text-align: center;
	padding: 7px;
}

.list_detail {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-top: 10px;
	margin-bottom: 10px;
}
.list_detail td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list_detail thead td {
	background-color: #F0F0F0;
	padding: 0px 3px;
	font-size: 11px;
	font-weight: bold;
}
.list_detail tbody td {
	padding: 0px 3px;
	font-size: 11px;	
}
.list_detail .left {
	text-align: left;
	padding: 3px;
}
.list_detail .right {
	text-align: right;
	padding: 3px;
}
.list_detail .center {
	text-align: center;
	padding: 3px;
}
		
.export_item {
  text-decoration: none;
  cursor: pointer;
}
.export_item a {
  text-decoration: none;
}
.export_item :hover {
  opacity: 0.7;
  -moz-opacity: 0.7;
  -ms-filter: "alpha(opacity=70)"; /* IE 8 */
  filter: alpha(opacity=70); /* IE < 8 */
} 
a.cbutton {
	text-decoration: none;
	color: #FFF;
	display: inline-block;
	padding: 5px 15px 5px 15px;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}

.pagination_report {
	padding:3px;
	margin:3px;
	text-align:right;
	margin-top:10px;
}
.pagination_report a {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #ddd;
	text-decoration: none; 
	color: #666;
}
.pagination_report a:hover, .pagination_report a:active {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #c0c0c0;
}
.pagination_report span.current {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #a0a0a0;
	font-weight: bold;
	background-color: #f0f0f0;
	color: #666;
}
.pagination_report span.disabled {
	padding: 4px 8px 4px 8px;
	margin-right: 2px;
	border: 1px solid #f3f3f3;
	color: #ccc;
}

.ui-dialog .ui-dialog-content {
  background: #f3f3f3 !important;
} 

.styled-select-type {
	background-color: #ffcc99;
	padding: 3px;
 	border: 1px solid #999;
    -moz-border-radius: 3px; 
    border-radius: 3px;
}
.styled-select {
	background-color: #E7EFEF;
	padding: 3px;
 	border: 1px solid #999;
    -moz-border-radius: 3px; 
    border-radius: 3px;
}

a.multiSelect {
	background: #FFF url(view/image/adv_reports/dropdown.blue.png) right center no-repeat;
	border: solid 1px #BBB;
	padding-right: 20px;
	margin-top: 4px;
	height: 18px;
	position: relative;
	cursor: default;
	text-decoration: none;
	color: black;
	display: -moz-inline-stack;
	display: inline-block;
	vertical-align: middle;
}
a.multiSelect:link, a.multiSelect:visited, a.multiSelect:hover, a.multiSelect:active {
	color: black;
	text-decoration: none;
	padding-top: 2px;	
}
a.multiSelect span {
	margin: 1px 0px 2px 4px;
	overflow: hidden;
	display: -moz-inline-stack;
	display: inline-block;
	white-space: nowrap;
	min-width: 105px;	
}
.multiSelectOptions {
	margin-top: 2px;	
	overflow-y: auto;
	overflow-x: hidden;
	border: solid 1px #B2B2B2;
	background: #FFF;
	min-width: 105px;	
}
.multiSelectOptions LABEL {
	padding: 0px 2px;
	display: block;
	white-space: nowrap;
}
.multiSelectOptions LABEL.optGroup {
	font-weight: bold;
}
.multiSelectOptions .optGroupContainer LABEL {
	padding-left: 10px;
}
.multiSelectOptions.optGroupHasCheckboxes .optGroupContainer LABEL {
	padding-left: 18px;
}
.multiSelectOptions input {
	vertical-align: middle;
}
.multiSelectOptions LABEL.checked {
	background-color: #dce5f8;
}
.multiSelectOptions LABEL.selectAll {
	border-bottom: dotted 1px #CCC;
}
.multiSelectOptions LABEL.hover {
	background-color: #3399ff;
	color: white;
}
</style>
<form method="post" action="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>" id="report" name="report"> 
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/report.png" alt="" /> <?php echo $heading_title; ?></h1><span style="float:right; padding-top:5px; padding-right:5px; font-size:11px; color:#666; text-align:right;"><?php echo $heading_version; ?></span></div>
      <div align="right" style="height:38px; background-color:#F0F0F0; border: 1px solid #DDDDDD; margin-top:5px;">
      <div style="padding-top: 7px; margin-right: 5px;"><?php echo $entry_report; ?>
          <select name="filter_report" id="filter_report" onchange="jQuery('#report').submit();" class="styled-select-type"> 
              <?php foreach ($report as $report) { ?>
              <?php if ($report['value'] == $filter_report) { ?>
              <option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>" selected="selected"><?php echo $report['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>"><?php echo $report['text']; ?></option>
              <?php } ?>
              <?php } ?>
          </select>&nbsp;&nbsp; 
      	  <label <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'style="color:#999; cursor:default;"' : 'style="color:#000; cursor:auto;"' ?>><?php echo $entry_option_grouping; ?></label>
          <select name="filter_ogrouping" class="styled-select" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled"' : '' ?>> 
          <?php if ($filter_report == 'products') { ?> 
            <?php if ($filter_ogrouping && $filter_ogrouping == '1') { ?>
            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_yes; ?></option>
            <?php } ?>
            <?php if (!$filter_ogrouping) { ?>
            <option value="0" selected="selected"><?php echo $text_no; ?></option>
            <?php } else { ?>
            <option value="0"><?php echo $text_no; ?></option>
            <?php } ?>
          <?php } elseif ($filter_report != 'products') { ?> 
          <option value="1">----</option>
          <?php } ?>
          </select>&nbsp;&nbsp; 
		  <?php echo $entry_group; ?>
          <select name="filter_group" class="styled-select"> 
              <?php foreach ($groups as $group) { ?>
              <?php if ($group['value'] == $filter_group) { ?>
              <option value="<?php echo $group['value']; ?>" selected="selected"><?php echo $group['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $group['value']; ?>"><?php echo $group['text']; ?></option>
              <?php } ?>
              <?php } ?>
          </select>&nbsp;&nbsp;
          <?php echo $entry_sort_by; ?>
		  <select name="filter_sort" class="styled-select"> 
            <?php if ($filter_sort == 'date') { ?>
            <option value="date" selected="selected"><?php echo $column_date; ?></option>
            <?php } else { ?>
            <option value="date"><?php echo $column_date; ?></option>
            <?php } ?>                                   
            <?php if ($filter_report == 'products' && $filter_sort == 'sku') { ?>
            <option value="sku" selected="selected"><?php echo $column_sku; ?></option>         
            <?php } else { ?>
            <option value="sku" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_sku; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'products' && $filter_sort == 'name') { ?>
            <option value="name" selected="selected"><?php echo $column_prod_name; ?></option>            
            <?php } else { ?>
            <option value="name" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_prod_name; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'products' && $filter_sort == 'model') { ?>
            <option value="model" selected="selected"><?php echo $column_model; ?></option>            
            <?php } else { ?>
            <option value="model" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_model; ?></option>
            <?php } ?>                                
            <?php if ($filter_report == 'products' && $filter_sort == 'category' or $filter_report == 'categories' && $filter_sort == 'category') { ?>
            <option value="category" selected="selected"><?php echo $column_category; ?></option>            
            <?php } else { ?>
            <option value="category" <?php echo ($filter_report == 'manufacturers') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_category; ?></option>
            <?php } ?>                       
            <?php if ($filter_report == 'products' && $filter_sort == 'manufacturer' or $filter_report == 'manufacturers' && $filter_sort == 'manufacturer') { ?>
            <option value="manufacturer" selected="selected"><?php echo $column_manufacturer; ?></option>           
            <?php } else { ?>
            <option value="manufacturer" <?php echo ($filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_manufacturer; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'products' && $filter_sort == 'attribute') { ?>
            <option value="attribute" selected="selected"><?php echo $column_attribute; ?></option>           
            <?php } else { ?>
            <option value="attribute" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_attribute; ?></option>
            <?php } ?>             
            <?php if ($filter_report == 'products' && $filter_sort == 'status') { ?>
            <option value="status" selected="selected"><?php echo $column_status; ?></option>           
            <?php } else { ?>
            <option value="status" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_status; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'products' && $filter_sort == 'stock_quantity') { ?>
            <option value="stock_quantity" selected="selected"><?php echo $column_stock_quantity; ?></option>           
            <?php } else { ?>
            <option value="stock_quantity" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $column_stock_quantity; ?></option>
            <?php } ?>
            <?php if (!$filter_sort or $filter_sort == 'sold_quantity' or ($filter_report == 'manufacturers' && $filter_sort == 'category') or ($filter_report == 'categories' && $filter_sort == 'manufacturer')) { ?>
            <option value="sold_quantity" selected="selected"><?php echo $column_sold_quantity; ?></option>
            <?php } else { ?>
            <option value="sold_quantity"><?php echo $column_sold_quantity; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'tax') { ?>
            <option value="tax" selected="selected"><?php echo $column_tax; ?></option>
            <?php } else { ?>
            <option value="tax"><?php echo $column_tax; ?></option>
            <?php } ?>
            <?php if ($filter_sort == 'total') { ?>
            <option value="total" selected="selected"><?php echo $column_total; ?></option>
            <?php } else { ?>
            <option value="total"><?php echo $column_total; ?></option>
            <?php } ?>
          </select>&nbsp;&nbsp; 
          <?php echo $entry_show_details; ?>
		  <select name="filter_details" class="styled-select">                           
            <?php if (!$filter_details or $filter_details == '0' or ($filter_report == 'products' && $filter_details == '3') or ($filter_report == 'manufacturers' && ($filter_details == '1' or $filter_details == '2')) or ($filter_report == 'categories' && ($filter_details == '1' or $filter_details == '2'))) { ?>
            <option value="0" selected="selected"><?php echo $text_no_details; ?></option>
            <?php } else { ?>
            <option value="0"><?php echo $text_no_details; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'products' && $filter_details == '1') { ?>
            <option value="1" selected="selected"><?php echo $text_order_list; ?></option>
            <?php } else { ?>
            <option value="1" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $text_order_list; ?></option>
            <?php } ?>
            <?php if ($filter_report == 'manufacturers' && $filter_details == '3' or $filter_report == 'categories' && $filter_details == '3') { ?>
            <option value="3" selected="selected"><?php echo $text_product_list; ?></option>
            <?php } else { ?>
            <option value="3" <?php echo ($filter_report == 'products') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $text_product_list; ?></option>
            <?php } ?>            
            <?php if ($filter_report == 'products' && $filter_details == '2') { ?>
            <option value="2" selected="selected"><?php echo $text_customer_list; ?></option>
            <?php } else { ?>
            <option value="2" <?php echo ($filter_report == 'manufacturers' or $filter_report == 'categories') ? 'disabled="disabled" style="color:#999"' : '' ?>><?php echo $text_customer_list; ?></option>
            <?php } ?>                        
          </select>&nbsp;&nbsp; 
          <?php echo $entry_limit; ?>
		  <select name="filter_limit" class="styled-select"> 
            <?php if ($filter_limit == '10') { ?>
            <option value="10" selected="selected">10</option>
            <?php } else { ?>
            <option value="10">10</option>
            <?php } ?>                                
            <?php if (!$filter_limit or $filter_limit == '25') { ?>
            <option value="25" selected="selected">25</option>
            <?php } else { ?>
            <option value="25">25</option>
            <?php } ?>
            <?php if ($filter_limit == '50') { ?>
            <option value="50" selected="selected">50</option>
            <?php } else { ?>
            <option value="50">50</option>
            <?php } ?>
            <?php if ($filter_limit == '100') { ?>
            <option value="100" selected="selected">100</option>
            <?php } else { ?>
            <option value="100">100</option>
            <?php } ?>                        
          </select>&nbsp; <a id="button" onclick="jQuery('#report').submit();" class="cbutton" style="background:#069;"><span><?php echo $button_filter; ?></span></a>&nbsp;<?php if ($products) { ?><?php if (($filter_range != 'all_time' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) or ($filter_range == 'all_time' && $filter_group == 'year')) { ?><a id="show_tab_chart" class="cbutton" style="background:#930;"><span><?php echo $button_chart; ?></span></a><?php } ?><?php } ?>&nbsp;<a id="show_tab_export" class="cbutton" style="background:#699;"><span><?php echo $button_export; ?></span></a>&nbsp;<a id="settings" class="cbutton" style="background:#666;"><span><?php echo $button_settings; ?></span></a></div>
    </div>
    <div class="content_report">
<script type="text/javascript"><!--
jQuery(document).ready(function() {
var prev = {start: 0, stop: 0},
    cont = jQuery('#pagination_content #element');
	
jQuery(".pagination_report").paging(cont.length, {
	format: '[< ncnnn! >]',
	perpage: '<?php echo $filter_limit; ?>',	
	lapping: 0,
	page: null, // we await hashchange() event
			onSelect: function() {

				var data = this.slice;

				cont.slice(prev[0], prev[1]).css('display', 'none');
				cont.slice(data[0], data[1]).fadeIn(0);

				prev = data;

				return true; // locate!
			},
			onFormat: function (type) {

				switch (type) {

					case 'block':

						if (!this.active)
							return '<span class="disabled">' + this.value + '</span>';
						else if (this.value != this.page)
							return '<em><a href="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>#' + this.value + '">' + this.value + '</a></em>';
						return '<span class="current">' + this.value + '</span>';

					case 'next':

						if (this.active) {
							return '<a href="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>#' + this.value + '" class="next">Next &gt;</a>';
						}
						return '';						

					case 'prev':

						if (this.active) {
							return '<a href="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>#' + this.value + '" class="prev">&lt; Previous</a>';
						}	
						return '';						

					case 'first':

						if (this.active) {
							return '<?php echo $text_pagin_page; ?> ' + this.page + ' <?php echo $text_pagin_of; ?> ' + this.pages + '&nbsp;&nbsp;<a href="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>#' + this.value + '" class="first">|&lt;</a>';
						}	
						return '<?php echo $text_pagin_page; ?> ' + this.page + ' <?php echo $text_pagin_of; ?> ' + this.pages + '&nbsp;&nbsp';
							
					case 'last':

						if (this.active) {
							return '<a href="index.php?route=report/adv_product_purchased&token=<?php echo $token; ?>#' + this.value + '" class="prev">&gt;|</a>&nbsp;&nbsp;(' + cont.length + ' <?php echo $text_pagin_results; ?>)';
						}
						return '&nbsp;&nbsp;(' + cont.length + ' <?php echo $text_pagin_results; ?>)';					

				}
				return ''; // return nothing for missing branches
			}
});
});		
//--></script>     
<script type="text/javascript"><!--
function getStorage(key_prefix) {
    // this function will return us an object with a "set" and "get" method
    if (window.localStorage) {
        // use localStorage:
        return {
            set: function(id, data) {
                localStorage.setItem(key_prefix+id, data);
            },
            get: function(id) {
                return localStorage.getItem(key_prefix+id);
            }
        };
    }
}

jQuery(document).ready(function() {
    // a key must is used for the cookie/storage
    var storedData = getStorage('com_mysite_checkboxes_'); 
    
    jQuery('div.check input:checkbox').bind('change',function(){
        jQuery('#'+this.id+'_filter').toggle(jQuery(this).is(':checked'));
        jQuery('#'+this.id+'_title').toggle(jQuery(this).is(':checked'));
			<?php if ($products) {
					foreach ($products as $key => $product) {
						echo "jQuery('#'+this.id+'_" . $product['order_product_id'] . "_title').toggle(jQuery(this).is(':checked')); ";
						echo "jQuery('#'+this.id+'_" . $product['order_product_id'] . "').toggle(jQuery(this).is(':checked')); ";						
					}			
			} 
			;?>		
        jQuery('#'+this.id+'_total').toggle(jQuery(this).is(':checked'));			
        // save the data on change
        storedData.set(this.id, jQuery(this).is(':checked')?'checked':'not');
    }).each(function() {
        // on load, set the value to what we read from storage:
        var val = storedData.get(this.id);
        if (val == 'checked') jQuery(this).attr('checked', 'checked');
        if (val == 'not') jQuery(this).removeAttr('checked');
        if (val) jQuery(this).trigger('change');
    });
});
//--></script>
<div id="settings_window" style="display:none">
<div class="check">
<table align="center" cellspacing="0" cellpadding="0">
    <tr><td>
      &nbsp;<span style="font-size:14px; font-weight:bold;"><?php echo $text_filtering_options; ?></span><br />        
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#E7EFEF; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>           
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp2" checked="checked" type="checkbox"><label for="pp2"><?php echo substr($entry_store,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp3" checked="checked" type="checkbox"><label for="pp3"><?php echo substr($entry_currency,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp4a" checked="checked" type="checkbox"><label for="pp4a"><?php echo substr($entry_tax,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp4c" checked="checked" type="checkbox"><label for="pp4c"><?php echo substr($entry_tax_classes,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp4b" checked="checked" type="checkbox"><label for="pp4b"><?php echo substr($entry_geo_zone,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp5" checked="checked" type="checkbox"><label for="pp5"><?php echo substr($entry_customer_group,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp7" checked="checked" type="checkbox"><label for="pp7"><?php echo substr($entry_customer_name,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp8a" checked="checked" type="checkbox"><label for="pp8a"><?php echo substr($entry_customer_email,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp8b" checked="checked" type="checkbox"><label for="pp8b"><?php echo substr($entry_customer_telephone,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp8c" checked="checked" type="checkbox"><label for="pp8c"><?php echo substr($entry_ip,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17a" checked="checked" type="checkbox"><label for="pp17a"><?php echo substr($entry_payment_company,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17b" checked="checked" type="checkbox"><label for="pp17b"><?php echo substr($entry_payment_address,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17c" checked="checked" type="checkbox"><label for="pp17c"><?php echo substr($entry_payment_city,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17d" checked="checked" type="checkbox"><label for="pp17d"><?php echo substr($entry_payment_zone,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17e" checked="checked" type="checkbox"><label for="pp17e"><?php echo substr($entry_payment_postcode,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp17f" checked="checked" type="checkbox"><label for="pp17f"><?php echo substr($entry_payment_country,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp13" checked="checked" type="checkbox"><label for="pp13"><?php echo substr($entry_payment_method,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16a" checked="checked" type="checkbox"><label for="pp16a"><?php echo substr($entry_shipping_company,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16b" checked="checked" type="checkbox"><label for="pp16b"><?php echo substr($entry_shipping_address,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16c" checked="checked" type="checkbox"><label for="pp16c"><?php echo substr($entry_shipping_city,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16d" checked="checked" type="checkbox"><label for="pp16d"><?php echo substr($entry_shipping_zone,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16e" checked="checked" type="checkbox"><label for="pp16e"><?php echo substr($entry_shipping_postcode,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp16f" checked="checked" type="checkbox"><label for="pp16f"><?php echo substr($entry_shipping_country,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp14" checked="checked" type="checkbox"><label for="pp14"><?php echo substr($entry_shipping_method,0,-1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp9d" checked="checked" type="checkbox"><label for="pp9d"><?php echo substr($entry_category,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp9e" checked="checked" type="checkbox"><label for="pp9e"><?php echo substr($entry_manufacturer,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp9a" checked="checked" type="checkbox"><label for="pp9a"><?php echo substr($entry_sku,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp9b" checked="checked" type="checkbox"><label for="pp9b"><?php echo substr($entry_product,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp9c" checked="checked" type="checkbox"><label for="pp9c"><?php echo substr($entry_model,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp10" checked="checked" type="checkbox"><label for="pp10"><?php echo substr($entry_option,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp18" checked="checked" type="checkbox"><label for="pp18"><?php echo substr($entry_attributes,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp6" checked="checked" type="checkbox"><label for="pp6"><?php echo substr($entry_prod_status,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp11" checked="checked" type="checkbox"><label for="pp11"><?php echo substr($entry_location,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp12a" checked="checked" type="checkbox"><label for="pp12a"><?php echo substr($entry_affiliate_name,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp12b" checked="checked" type="checkbox"><label for="pp12b"><?php echo substr($entry_affiliate_email,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp15a" checked="checked" type="checkbox"><label for="pp15a"><?php echo substr($entry_coupon_name,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp15b" checked="checked" type="checkbox"><label for="pp15b"><?php echo substr($entry_coupon_code,0,-1); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp19" checked="checked" type="checkbox"><label for="pp19"><?php echo substr($entry_voucher_code,0,-1); ?></label></div>
          </td>                                                                                                                        
        </tr>
      </table><br />
      &nbsp;<span style="font-size:14px; font-weight:bold;"><?php echo $text_column_settings; ?></span><br />  
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#E5E5E5; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_mv_columns; ?></span><br />           
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp20" name="pp20" checked="checked" type="checkbox"><label for="pp20"><?php echo $column_image; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp21" name="pp21" checked="checked" type="checkbox"><label for="pp21"><?php echo $column_sku; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp22" name="pp22" checked="checked" type="checkbox"><label for="pp22"><?php echo $column_name; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp23" name="pp23" checked="checked" type="checkbox"><label for="pp23"><?php echo $column_model; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp24" name="pp24" checked="checked" type="checkbox"><label for="pp24"><?php echo $column_category; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp25" name="pp25" checked="checked" type="checkbox"><label for="pp25"><?php echo $column_manufacturer; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp34" name="pp34" checked="checked" type="checkbox"><label for="pp34"><?php echo $column_attribute; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp26" name="pp26" checked="checked" type="checkbox"><label for="pp26"><?php echo $column_status; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp35" name="pp35" checked="checked" type="checkbox"><label for="pp35"><?php echo $column_stock_quantity; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp27" name="pp27" checked="checked" type="checkbox"><label for="pp27"><?php echo $column_sold_quantity; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp28" name="pp28" checked="checked" type="checkbox"><label for="pp28"><?php echo $column_sold_percent; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp30" name="pp30" checked="checked" type="checkbox"><label for="pp30"><?php echo $column_tax; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp29" name="pp29" checked="checked" type="checkbox"><label for="pp29"><?php echo $column_total; ?></label></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#3C0;">* <?php echo $text_export_note; ?></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_ol_columns; ?></span><br />      
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp40" name="pp40" checked="checked" type="checkbox"><label for="pp40"><?php echo $column_order_prod_order_id; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp41" name="pp41" checked="checked" type="checkbox"><label for="pp41"><?php echo $column_order_prod_date_added; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp42" name="pp42" checked="checked" type="checkbox"><label for="pp42"><?php echo $column_order_prod_inv_no; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp43" name="pp43" checked="checked" type="checkbox"><label for="pp43"><?php echo $column_order_prod_customer; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp44" name="pp44" checked="checked" type="checkbox"><label for="pp44"><?php echo $column_order_prod_email; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp45" name="pp45" checked="checked" type="checkbox"><label for="pp45"><?php echo $column_order_prod_customer_group; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp46" name="pp46" checked="checked" type="checkbox"><label for="pp46"><?php echo $column_order_prod_shipping_method; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp47" name="pp47" checked="checked" type="checkbox"><label for="pp47"><?php echo $column_order_prod_payment_method; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp48" name="pp48" checked="checked" type="checkbox"><label for="pp48"><?php echo $column_order_prod_status; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp49" name="pp49" checked="checked" type="checkbox"><label for="pp49"><?php echo $column_order_prod_store; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp50" name="pp50" checked="checked" type="checkbox"><label for="pp50"><?php echo $column_order_prod_currency; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp51" name="pp51" checked="checked" type="checkbox"><label for="pp51"><?php echo $column_order_prod_price; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp52" name="pp52" checked="checked" type="checkbox"><label for="pp52"><?php echo $column_order_prod_quantity; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp54" name="pp54" checked="checked" type="checkbox"><label for="pp54"><?php echo $column_order_prod_tax; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp53" name="pp53" checked="checked" type="checkbox"><label for="pp53"><?php echo $column_order_prod_total; ?></label></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#3C0;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_prod_order_list); ?></strong></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_pl_columns; ?></span><br />     
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp60" name="pp60" checked="checked" type="checkbox"><label for="pp60"><?php echo $column_prod_order_id; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp61" name="pp61" checked="checked" type="checkbox"><label for="pp61"><?php echo $column_prod_date_added; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp62" name="pp62" checked="checked" type="checkbox"><label for="pp62"><?php echo $column_prod_inv_no; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp63" name="pp63" checked="checked" type="checkbox"><label for="pp63"><?php echo $column_prod_id; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp64" name="pp64" checked="checked" type="checkbox"><label for="pp64"><?php echo $column_prod_sku; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp65" name="pp65" checked="checked" type="checkbox"><label for="pp65"><?php echo $column_prod_model; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp66" name="pp66" checked="checked" type="checkbox"><label for="pp66"><?php echo $column_prod_name; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp67" name="pp67" checked="checked" type="checkbox"><label for="pp67"><?php echo $column_prod_option; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp77" name="pp77" checked="checked" type="checkbox"><label for="pp77"><?php echo $column_prod_attributes; ?></label></div>                      
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp68" name="pp68" checked="checked" type="checkbox"><label for="pp68"><?php echo $column_prod_manu; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp79" name="pp79" checked="checked" type="checkbox"><label for="pp79"><?php echo $column_prod_category; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp69" name="pp69" checked="checked" type="checkbox"><label for="pp69"><?php echo $column_prod_currency; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp70" name="pp70" checked="checked" type="checkbox"><label for="pp70"><?php echo $column_prod_price; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp71" name="pp71" checked="checked" type="checkbox"><label for="pp71"><?php echo $column_prod_quantity; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp73" name="pp73" checked="checked" type="checkbox"><label for="pp73"><?php echo $column_prod_tax; ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp72" name="pp72" checked="checked" type="checkbox"><label for="pp72"><?php echo $column_prod_total; ?></label></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#3C0;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_manu_product_list); ?> + <?php echo strip_tags($text_export_cat_product_list); ?></strong></span>  
		</td></tr>          
      </table>
      <table width="100%" cellspacing="0" cellpadding="3" style="background:#F0F0F0; border:1px solid #DDDDDD; margin-top:3px;">
        <tr>
          <td>
            &nbsp;<span style="font-size:11px; font-weight:bold;"><?php echo $text_cl_columns; ?></span><br />       
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp80" name="pp80" checked="checked" type="checkbox"><label for="pp80"><?php echo $column_customer_order_id; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp81" name="pp81" checked="checked" type="checkbox"><label for="pp81"><?php echo $column_customer_date_added; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp82" name="pp82" checked="checked" type="checkbox"><label for="pp82"><?php echo $column_customer_inv_no; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp83" name="pp83" checked="checked" type="checkbox"><label for="pp83"><?php echo $column_customer_cust_id; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp84" name="pp84" checked="checked" type="checkbox"><label for="pp84"><?php echo strip_tags($column_billing_name); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp85" name="pp85" checked="checked" type="checkbox"><label for="pp85"><?php echo strip_tags($column_billing_company); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp86" name="pp86" checked="checked" type="checkbox"><label for="pp86"><?php echo strip_tags($column_billing_address_1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp87" name="pp87" checked="checked" type="checkbox"><label for="pp87"><?php echo strip_tags($column_billing_address_2); ?></label></div>		
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp88" name="pp88" checked="checked" type="checkbox"><label for="pp88"><?php echo strip_tags($column_billing_city); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp89" name="pp89" checked="checked" type="checkbox"><label for="pp89"><?php echo strip_tags($column_billing_zone); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp90" name="pp90" checked="checked" type="checkbox"><label for="pp90"><?php echo strip_tags($column_billing_postcode); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp91" name="pp91" checked="checked" type="checkbox"><label for="pp91"><?php echo strip_tags($column_billing_country); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp92" name="pp92" checked="checked" type="checkbox"><label for="pp92"><?php echo $column_customer_telephone; ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp93" name="pp93" checked="checked" type="checkbox"><label for="pp93"><?php echo strip_tags($column_shipping_name); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp94" name="pp94" checked="checked" type="checkbox"><label for="pp94"><?php echo strip_tags($column_shipping_company); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp95" name="pp95" checked="checked" type="checkbox"><label for="pp95"><?php echo strip_tags($column_shipping_address_1); ?></label></div>
			<div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp96" name="pp96" checked="checked" type="checkbox"><label for="pp96"><?php echo strip_tags($column_shipping_address_2); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp97" name="pp97" checked="checked" type="checkbox"><label for="pp97"><?php echo strip_tags($column_shipping_city); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp98" name="pp98" checked="checked" type="checkbox"><label for="pp98"><?php echo strip_tags($column_shipping_zone); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp99" name="pp99" checked="checked" type="checkbox"><label for="pp99"><?php echo strip_tags($column_shipping_postcode); ?></label></div>
            <div style="float:left; padding-right:5px; margin:1px; border:thin dotted #666;"><input id="pp100" name="pp100" checked="checked" type="checkbox"><label for="pp100"><?php echo strip_tags($column_shipping_country); ?></label></div>
          </td>                                                                                                                        
        </tr>
		<tr><td>
		<span style="font-size:11px; color:#3C0;">* <?php echo $text_export_note; ?> - <strong><?php echo strip_tags($text_export_prod_customer_list); ?></strong></span>  
		</td></tr>         
      </table>     
	</td></tr>              
</table>     
</div>
</div> 
<script type="text/javascript">
jQuery("#settings").click(function() {					  
    var dlg = jQuery("#settings_window").dialog({
            title: '<?php echo $button_settings; ?>',
            width: 900,
            height: 600,
            modal: true,			
    });
	dlg.parent().appendTo(jQuery("#report"));
});
</script> 
<script type="text/javascript">
jQuery(document).ready(function() {
var $filter_range = jQuery('#filter_range'), $date_start = jQuery('#date-start'), $date_end = jQuery('#date-end');
$filter_range.change(function () {
    if ($filter_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
        $date_end.removeAttr('disabled');
    } else {	
        $date_start.attr('disabled', 'disabled').val('');
        $date_end.attr('disabled', 'disabled').val('');
    }
}).trigger('change');
});
</script>    
<div style="background: #E7EFEF; border: 1px solid #C6D7D7; margin-bottom: 15px;">
	<table width="100%" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	 <table cellspacing="0" cellpadding="0">
  	 <tr>
     <td align="right" style="background:#C6D7D7;">
	 <table border="0" cellspacing="0" cellpadding="0" style="background:#C6D7D7; border:2px solid #E7EFEF; padding:5px; margin-top:3px; margin-bottom:3px;">
	 <tr><td colspan="3" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_order_created; ?></span></td></tr>
  	 <tr><td>
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td><?php echo $entry_range; ?><br />    
            <select name="filter_range" id="filter_range" style="border:1px solid #999; margin-top:5px;">
              <?php foreach ($ranges as $range) { ?>
              <?php if ($range['value'] == $filter_range) { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>" selected="selected"><?php echo $range['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>"><?php echo $range['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
       </td><td width="5"></td></tr></table>
     </td><td>      
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_date_start; ?><br />
          <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td width="5"></td></tr></table>
     </td><td>
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_date_end; ?><br />
          <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td></td></tr></table>
     </td></tr></table>  
     </td>
     <td align="center" style="background:#C6D7D7;">      
	 <table border="0" cellspacing="0" cellpadding="0" style="background:#C6D7D7; border:2px solid #E7EFEF; padding:5px; margin-top:3px; margin-bottom:3px;">
	 <tr><td colspan="3" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_status_changed; ?></span></td></tr>
  	 <tr><td>
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_date_start; ?><br />
          <input type="text" name="filter_status_date_start" value="<?php echo $filter_status_date_start; ?>" id="status-date-start" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_date_end; ?><br />
          <input type="text" name="filter_status_date_end" value="<?php echo $filter_status_date_end; ?>" id="status-date-end" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td><?php echo $entry_status; ?><br />
          <span <?php echo (!$filter_order_status_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($order_statuses as $order_status) { ?><?php if (isset($filter_order_status_id[$order_status['order_status_id']])) { ?><?php echo $order_status['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_order_status_id" id="filter_order_status_id" multiple="multiple" size="1">
            <?php foreach ($order_statuses as $order_status) { ?>
            <?php if (isset($filter_order_status_id[$order_status['order_status_id']])) { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span>
       </td></tr></table>
     </td></tr></table>
	 </td>
     <td align="left" style="background:#C6D7D7;">        
	 <table border="0" cellspacing="0" cellpadding="0" style="background:#C6D7D7; border:2px solid #E7EFEF; padding:5px; margin-top:3px; margin-bottom:3px;">
	 <tr><td colspan="2" align="center"><span style="font-weight:bold; color:#333;"><?php echo $entry_order_id; ?></span></td></tr>
  	 <tr><td>  
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_order_id_from; ?><br />
          <input type="text" name="filter_order_id_from" value="<?php echo $filter_order_id_from; ?>" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td width="5"></td></tr></table>
     </td><td> 
       <table cellpadding="0" cellspacing="0" style="padding-top:3px;">
       <tr><td>&nbsp;<?php echo $entry_order_id_to; ?><br />
          <input type="text" name="filter_order_id_to" value="<?php echo $filter_order_id_to; ?>" size="12" style="height:16px; border:solid 1px #BBB; margin-top:5px;" />
       </td><td></td></tr></table>
    </td></tr></table>
    </td></tr>
	<tr>
    <td colspan="3" valign="top" style="padding:5px;">  
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp2_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_store; ?></span><br />
          <span <?php echo (!$filter_store_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($stores as $store) { ?><?php if (isset($filter_store_id[$store['store_id']])) { ?><?php echo $store['store_name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_store_id" id="filter_store_id" multiple="multiple" size="1">
            <?php foreach ($stores as $store) { ?>
            <?php if (isset($filter_store_id[$store['store_id']])) { ?>            
            <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['store_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $store['store_id']; ?>"><?php echo $store['store_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>    
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp3_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_currency; ?></span><br />
          <span <?php echo (!$filter_currency) ? '' : 'class="vtip"' ?> title="<?php foreach ($currencies as $currency) { ?><?php if (isset($filter_currency[$currency['currency_id']])) { ?><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)<br /><?php } ?><?php } ?>">
          <select name="filter_currency" id="filter_currency" multiple="multiple" size="1">
            <?php foreach ($currencies as $currency) { ?>
            <?php if (isset($filter_currency[$currency['currency_id']])) { ?>
            <option value="<?php echo $currency['currency_id']; ?>" selected="selected"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } else { ?>
            <option value="<?php echo $currency['currency_id']; ?>"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>          
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp4a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_tax; ?></span><br />
          <span <?php echo (!$filter_taxes) ? '' : 'class="vtip"' ?> title="<?php foreach ($taxes as $tax) { ?><?php if (isset($filter_taxes[$tax['tax']])) { ?><?php echo $tax['tax_title']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_taxes" id="filter_taxes" multiple="multiple" size="1">
            <?php foreach ($taxes as $tax) { ?>
            <?php if (isset($filter_taxes[$tax['tax']])) { ?>              
            <option value="<?php echo $tax['tax']; ?>" selected="selected"><?php echo $tax['tax_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax['tax']; ?>"><?php echo $tax['tax_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp4c_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_tax_classes; ?></span><br />
          <span <?php echo (!$filter_tax_classes) ? '' : 'class="vtip"' ?> title="<?php foreach ($tax_classes as $tax_class) { ?><?php if (isset($filter_tax_classes[$tax_class['tax_class']])) { ?><?php echo $tax_class['tax_class_title']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_tax_classes" id="filter_tax_classes" multiple="multiple" size="1">
            <?php foreach ($tax_classes as $tax_class) { ?>
            <?php if (isset($filter_tax_classes[$tax_class['tax_class']])) { ?>              
            <option value="<?php echo $tax_class['tax_class']; ?>" selected="selected"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax_class['tax_class']; ?>"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>      
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp4b_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_geo_zone; ?></span><br />
          <span <?php echo (!$filter_geo_zones) ? '' : 'class="vtip"' ?> title="<?php foreach ($geo_zones as $geo_zone) { ?><?php if (isset($filter_geo_zones[$geo_zone['geo_zone_country_id']])) { ?><?php echo $geo_zone['geo_zone_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_geo_zones" id="filter_geo_zones" multiple="multiple" size="1">
            <?php foreach ($geo_zones as $geo_zone) { ?>
            <?php if (isset($filter_geo_zones[$geo_zone['geo_zone_country_id']])) { ?>              
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>" selected="selected"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp5_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_customer_group; ?></span><br />
          <span <?php echo (!$filter_customer_group_id) ? '' : 'class="vtip"' ?> title="<?php foreach ($customer_groups as $customer_group) { ?><?php if (isset($filter_customer_group_id[$customer_group['customer_group_id']])) { ?><?php echo $customer_group['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_customer_group_id" id="filter_customer_group_id" multiple="multiple" size="1">
            <?php foreach ($customer_groups as $customer_group) { ?>
            <?php if (isset($filter_customer_group_id[$customer_group['customer_group_id']])) { ?>              
            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp7_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_name; ?></span><br />
        <input type="text" name="filter_customer_name" value="<?php echo $filter_customer_name; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp8a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_email; ?></span><br />
        <input type="text" name="filter_customer_email" value="<?php echo $filter_customer_email; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp8b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_customer_telephone; ?></span><br />
        <input type="text" name="filter_customer_telephone" value="<?php echo $filter_customer_telephone; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp8c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_ip; ?></span><br />
        <input type="text" name="filter_ip" value="<?php echo $filter_ip; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>       
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_company; ?></span><br />
        <input type="text" name="filter_payment_company" value="<?php echo $filter_payment_company; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_address; ?></span><br />
        <input type="text" name="filter_payment_address" value="<?php echo $filter_payment_address; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_city; ?></span><br />
        <input type="text" name="filter_payment_city" value="<?php echo $filter_payment_city; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17d_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_zone; ?></span><br />
        <input type="text" name="filter_payment_zone" value="<?php echo $filter_payment_zone; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
		</td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17e_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_postcode; ?></span><br />
        <input type="text" name="filter_payment_postcode" value="<?php echo $filter_payment_postcode; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp17f_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_payment_country; ?></span><br />
        <input type="text" name="filter_payment_country" value="<?php echo $filter_payment_country; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp13_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_payment_method; ?></span><br />
          <span <?php echo (!$filter_payment_method) ? '' : 'class="vtip"' ?> title="<?php foreach ($payment_methods as $payment_method) { ?><?php if (isset($filter_payment_method[$payment_method['payment_title']])) { ?><?php echo $payment_method['payment_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_payment_method" id="filter_payment_method" multiple="multiple" size="1">
            <?php foreach ($payment_methods as $payment_method) { ?>
            <?php if (isset($filter_payment_method[$payment_method['payment_title']])) { ?>              
            <option value="<?php echo $payment_method['payment_title']; ?>" selected="selected"><?php echo $payment_method['payment_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $payment_method['payment_title']; ?>"><?php echo $payment_method['payment_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>   
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_company; ?></span><br />
        <input type="text" name="filter_shipping_company" value="<?php echo $filter_shipping_company; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_address; ?></span><br />
        <input type="text" name="filter_shipping_address" value="<?php echo $filter_shipping_address; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_city; ?></span><br />
        <input type="text" name="filter_shipping_city" value="<?php echo $filter_shipping_city; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16d_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_zone; ?></span><br />
        <input type="text" name="filter_shipping_zone" value="<?php echo $filter_shipping_zone; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>                     
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16e_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_postcode; ?></span><br />
        <input type="text" name="filter_shipping_postcode" value="<?php echo $filter_shipping_postcode; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp16f_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_country; ?></span><br />
        <input type="text" name="filter_shipping_country" value="<?php echo $filter_shipping_country; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>           
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp14_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_shipping_method; ?></span><br />
          <span <?php echo (!$filter_shipping_method) ? '' : 'class="vtip"' ?> title="<?php foreach ($shipping_methods as $shipping_method) { ?><?php if (isset($filter_shipping_method[$shipping_method['shipping_title']])) { ?><?php echo $shipping_method['shipping_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_shipping_method" id="filter_shipping_method" multiple="multiple" size="1">
            <?php foreach ($shipping_methods as $shipping_method) { ?>
            <?php if (isset($filter_shipping_method[$shipping_method['shipping_title']])) { ?>              
            <option value="<?php echo $shipping_method['shipping_title']; ?>" selected="selected"><?php echo $shipping_method['shipping_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $shipping_method['shipping_title']; ?>"><?php echo $shipping_method['shipping_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp9d_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_category; ?></span><br />
          <span <?php echo (!$filter_category) ? '' : 'class="vtip"' ?> title="<?php foreach ($categories as $category) { ?><?php if (isset($filter_category[$category['category_id']])) { ?><?php echo $category['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_category" id="filter_category" multiple="multiple" size="1">
            <?php foreach ($categories as $category) { ?>
            <?php if (isset($filter_category[$category['category_id']])) { ?>               
            <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option> 
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>                               
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp9e_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_manufacturer; ?></span><br />
          <span <?php echo (!$filter_manufacturer) ? '' : 'class="vtip"' ?> title="<?php foreach ($manufacturers as $manufacturer) { ?><?php if (isset($filter_manufacturer[$manufacturer['manufacturer_id']])) { ?> <?php echo $manufacturer['name']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_manufacturer" id="filter_manufacturer" multiple="multiple" size="1">
            <?php foreach ($manufacturers as $manufacturer) { ?>
            <?php if (isset($filter_manufacturer[$manufacturer['manufacturer_id']])) { ?>               
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option> 
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>            
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp9a_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_sku; ?></span><br />
        <input type="text" name="filter_sku" value="<?php echo $filter_sku; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp9b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_product; ?></span><br />
        <input type="text" name="filter_product_id" value="<?php echo $filter_product_id; ?>" size="40" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table> 
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp9c_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_model; ?></span><br />
        <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp10_filter">
        <tr><td><label <?php echo ($filter_ogrouping or $filter_report != 'products') ? 'style="font-weight:bold; color:#333; cursor:auto;"' : 'style="color:#999; cursor:default;"' ?>><?php echo $entry_option; ?></label><br />
          <span <?php echo (($filter_option && $filter_ogrouping && $filter_report == 'products') or ($filter_option && $filter_report != 'products')) ? 'class="vtip"' : '' ?> title="<?php foreach ($product_options as $product_option) { ?><?php if ((isset($filter_option[$product_option['options']]) && $filter_ogrouping && $filter_report == 'products') or (isset($filter_option[$product_option['options']]) && $filter_report != 'products')) { ?><?php echo $product_option['option_name']; ?>: <?php echo $product_option['option_value']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_option" id="filter_option" multiple="multiple" size="1">
          <?php if ($filter_ogrouping && $filter_report == 'products') { ?>          
            <?php foreach ($product_options as $product_option) { ?>
            <?php if (isset($filter_option[$product_option['options']]) && $filter_ogrouping && $filter_report == 'products') { ?>              
            <option value="<?php echo $product_option['options']; ?>" selected="selected"><?php echo $product_option['option_name']; ?>: <?php echo $product_option['option_value']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $product_option['options']; ?>"><?php echo $product_option['option_name']; ?>: <?php echo $product_option['option_value']; ?></option>
            <?php } ?>
            <?php } ?>
          <?php } elseif ($filter_report != 'products') { ?>
            <?php foreach ($product_options as $product_option) { ?>
            <?php if (isset($filter_option[$product_option['options']]) && $filter_report != 'products') { ?>              
            <option value="<?php echo $product_option['options']; ?>" selected="selected"><?php echo $product_option['option_name']; ?>: <?php echo $product_option['option_value']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $product_option['options']; ?>"><?php echo $product_option['option_name']; ?>: <?php echo $product_option['option_value']; ?></option>
            <?php } ?>
            <?php } ?>            
          <?php } ?>  
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
      </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp18_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_attributes; ?></span><br />
          <span <?php echo (!$filter_attribute) ? '' : 'class="vtip"' ?> title="<?php foreach ($attributes as $attribute) { ?><?php if (isset($filter_attribute[$attribute['attribute_title']])) { ?><?php echo $attribute['attribute_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_attribute" id="filter_attribute" multiple="multiple" size="1">
            <?php foreach ($attributes as $attribute) { ?>
            <?php if (isset($filter_attribute[$attribute['attribute_title']])) { ?>              
            <option value="<?php echo $attribute['attribute_title']; ?>" selected="selected"><?php echo $attribute['attribute_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $attribute['attribute_title']; ?>"><?php echo $attribute['attribute_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp6_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_prod_status; ?></span><br />
          <span <?php echo (!$filter_status) ? '' : 'class="vtip"' ?> title="<?php foreach ($statuses as $status) { ?><?php if (isset($filter_status[$status['status']]) && $status['status'] == 1) { ?><?php echo $text_enabled; ?><br /><?php } ?><?php if (isset($filter_status[$status['status']]) && $status['status'] == 0) { ?><?php echo $text_disabled; ?><br /><?php } ?><?php } ?>">         
          <select name="filter_status" id="filter_status" multiple="multiple" size="1">
            <?php foreach ($statuses as $status) { ?>
            <?php if (isset($filter_status[$status['status']]) && $status['status'] == 1) { ?>
            <option value="<?php echo $status['status']; ?>" selected="selected"><?php echo $text_enabled; ?></option>
            <?php } elseif (!isset($filter_status[$status['status']]) && $status['status'] == 1) { ?>
            <option value="<?php echo $status['status']; ?>"><?php echo $text_enabled; ?></option>
            <?php } ?>
            <?php if (isset($filter_status[$status['status']]) && $status['status'] == 0) { ?>
            <option value="<?php echo $status['status']; ?>" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } elseif (!isset($filter_status[$status['status']]) && $status['status'] == 0) { ?>
            <option value="<?php echo $status['status']; ?>"><?php echo $text_disabled; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
      </tr></table>                    
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp11_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_location; ?></span><br />
          <span <?php echo (!$filter_location) ? '' : 'class="vtip"' ?> title="<?php foreach ($locations as $location) { ?><?php if (isset($filter_location[$location['location_title']])) { ?><?php echo $location['location_name']; ?><br /><?php } ?><?php } ?>">
		  <select name="filter_location" id="filter_location" multiple="multiple" size="1">
            <?php foreach ($locations as $location) { ?>
            <?php if (isset($filter_location[$location['location_title']])) { ?>              
            <option value="<?php echo $location['location_title']; ?>" selected="selected"><?php echo $location['location_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $location['location_title']; ?>"><?php echo $location['location_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp12a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_affiliate_name; ?></span><br />
          <span <?php echo (!$filter_affiliate_name) ? '' : 'class="vtip"' ?> title="<?php foreach ($affiliate_names as $affiliate_name) { ?><?php if (isset($filter_affiliate_name[$affiliate_name['affiliate_id']])) { ?><?php echo $affiliate_name['affiliate_name']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_affiliate_name" id="filter_affiliate_name" multiple="multiple" size="1">
            <?php foreach ($affiliate_names as $affiliate_name) { ?>
            <?php if (isset($filter_affiliate_name[$affiliate_name['affiliate_id']])) { ?>              
            <option value="<?php echo $affiliate_name['affiliate_id']; ?>" selected="selected"><?php echo $affiliate_name['affiliate_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $affiliate_name['affiliate_id']; ?>"><?php echo $affiliate_name['affiliate_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp12b_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_affiliate_email; ?></span><br />
          <span <?php echo (!$filter_affiliate_email) ? '' : 'class="vtip"' ?> title="<?php foreach ($affiliate_emails as $affiliate_email) { ?><?php if (isset($filter_affiliate_email[$affiliate_email['affiliate_id']])) { ?><?php echo $affiliate_email['affiliate_email']; ?><br /><?php } ?><?php } ?>">
          <select name="filter_affiliate_email" id="filter_affiliate_email" multiple="multiple" size="1">
            <?php foreach ($affiliate_emails as $affiliate_email) { ?>
            <?php if (isset($filter_affiliate_email[$affiliate_email['affiliate_id']])) { ?>              
            <option value="<?php echo $affiliate_email['affiliate_id']; ?>" selected="selected"><?php echo $affiliate_email['affiliate_email']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $affiliate_email['affiliate_id']; ?>"><?php echo $affiliate_email['affiliate_email']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
	  <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp15a_filter">
        <tr><td><span style="font-weight:bold; color:#333;"><?php echo $entry_coupon_name; ?></span><br />
          <span <?php echo (!$filter_coupon_name) ? '' : 'class="vtip"' ?> title="<?php foreach ($coupon_names as $coupon_name) { ?><?php if (isset($filter_coupon_name[$coupon_name['coupon_id']])) { ?><?php echo $coupon_name['coupon_name']; ?><br /><?php } ?><?php } ?>">        
          <select name="filter_coupon_name" id="filter_coupon_name" multiple="multiple" size="1">
            <?php foreach ($coupon_names as $coupon_name) { ?>
            <?php if (isset($filter_coupon_name[$coupon_name['coupon_id']])) { ?>              
            <option value="<?php echo $coupon_name['coupon_id']; ?>" selected="selected"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $coupon_name['coupon_id']; ?>"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></span></td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp15b_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_coupon_code; ?></span><br />
        <input type="text" name="filter_coupon_code" value="<?php echo $filter_coupon_code; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
      <table cellpadding="0" cellspacing="0" style="float:left; height:60px;" id="pp19_filter">
        <tr><td>&nbsp;<span style="font-weight:bold; color:#333;"><?php echo $entry_voucher_code; ?></span><br />
        <input type="text" name="filter_voucher_code" value="<?php echo $filter_voucher_code; ?>" size="20" style="margin-top:4px; height:16px; border:solid 1px #BBB; color:#F90;" onclick="this.value = '';">
        </td><td width="15"></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td>
	  </tr></table>  
	   </td>
	  </tr>
	 </table>
	</td>
	</tr>
	</table>      
</div>
<script type="text/javascript">jQuery(function(){ 
jQuery('#show_tab_export').click(function() {
		jQuery('#tab_export').slideToggle('fast');
	});
});
</script>    
  <div id="tab_export" style="background:#E7EFEF; border:1px solid #C6D7D7; padding:3px; margin-bottom:15px; display:none">
      <table width="100%" cellspacing="0" cellpadding="3">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>          
          <span id="export_xls_prod" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_prod" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_prod" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td>   
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>            
          <span id="export_xls_prod_order_list" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_prod_order_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_prod_order_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td>   
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>            
          <span id="export_xls_prod_customer_list" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_prod_customer_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_prod_customer_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td>   
          <td width="5%">&nbsp;</td>
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'categories') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>
          <span id="export_xls_manu" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_manu" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_manu" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td>                    
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'categories') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>          
          <span id="export_xls_manu_product_list" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_manu_product_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_manu_product_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td> 
          <td width="5%">&nbsp;</td>
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'manufacturers') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>          
          <span id="export_xls_cat" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_cat" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_cat" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td>                  
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'manufacturers') { ?>
          <span class="noexport_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" /></span><span class="noexport_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" /></span>
          <?php } else { ?>          
          <span id="export_xls_cat_product_list" class="export_item"><img src="view/image/adv_reports/XLS.png" width="48" height="48" border="0" title="XLS" /></span><span id="export_html_cat_product_list" class="export_item"><img src="view/image/adv_reports/HTML.png" width="48" height="48" border="0" title="HTML" /></span><span id="export_pdf_cat_product_list" class="export_item"><img src="view/image/adv_reports/PDF.png" width="48" height="48" border="0" title="PDF" /></span>
          <?php } ?></td> 
          <td width="3%">&nbsp;</td>
        </tr>
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_prod_no_details; ?></label>
          <?php } else { ?>  
          <?php echo $text_export_prod_no_details; ?>          
          <?php } ?></td>          
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_prod_order_list; ?></label>
          <?php } else { ?>  
          <?php echo $text_export_prod_order_list; ?>          
          <?php } ?></td>  
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_prod_customer_list; ?></label>
          <?php } else { ?>  
          <?php echo $text_export_prod_customer_list; ?>          
          <?php } ?></td>  
          <td width="5%">&nbsp;</td>          
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'categories') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_manu_no_details; ?></label>
          <?php } else { ?>  
          <?php echo $text_export_manu_no_details; ?>          
          <?php } ?></td>    
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'categories') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_manu_product_list; ?></label>
          <?php } else { ?>            
          <?php echo $text_export_manu_product_list; ?>
          <?php } ?></td>  
          <td width="5%">&nbsp;</td>          
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'manufacturers') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_cat_no_details; ?></label>
          <?php } else { ?>           
          <?php echo $text_export_cat_no_details; ?>
          <?php } ?></td>  
          <td width="12%" align="center" nowrap="nowrap">
          <?php if ($filter_report == 'products' or $filter_report == 'manufacturers') { ?>          
          <label style="color:#999; cursor:default;"><?php echo $text_export_cat_product_list; ?></label>
          <?php } else { ?>           
          <?php echo $text_export_cat_product_list; ?>
          <?php } ?></td>                                
          <td width="3%">&nbsp;</td>                                                                                                                       
        </tr>  
        <tr>
          <td colspan="11">*<span style="font-size:10px"><?php echo $text_export_notice1; ?> 
          <?php if (defined('_JEXEC')) { ?>
          <a href="/opencart/admin/view/template/module/adv_reports/adv_requirements_limitations.htm" id="adv_export_limit">
          <?php } else { ?>
          <a href="view/template/module/adv_reports/adv_requirements_limitations.htm" id="adv_export_limit">
          <?php } ?> 
          <strong><?php echo $text_export_limit; ?></strong></a> <?php echo $text_export_notice2; ?></span></td>
        </tr>                 
      </table> 
  <input type="hidden" id="export" name="export" value="" />
<div id="adv_export_limit_text" style="display:none"></div>
<script type="text/javascript">
jQuery("#adv_export_limit").click(function(e) {
    e.preventDefault();
    jQuery("#adv_export_limit_text").load(this.href, function() {
        jQuery(this).dialog({
            title: '<?php echo $text_export_limit; ?>',
            width:  800,
            height:  600,
            minWidth:  500,
            minHeight:  400,
            modal: true,
        });
    });
    return false;
});
</script>   
  </div>  
<?php if ($products) { ?>
<?php if (($filter_range != 'all_time' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) or ($filter_range == 'all_time' && $filter_group == 'year')) { ?>   
<script type="text/javascript">jQuery(function(){ 
jQuery('#show_tab_chart').click(function() {
		jQuery('#tab_chart').slideToggle('slow');
	});
});
</script>  
    <div id="tab_chart">
      <table align="center" cellspacing="0" cellpadding="0">
        <tr>
          <td><div style="float:left;" id="chart1_div"></div><div style="float:left;" id="chart2_div"></div></td>
        </tr>              
      </table>
    </div>
<?php } ?> 
<?php } ?>     
	<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) { ?>
    <div id="pagination_content" style="overflow:scroll; padding:1px;"> 
    <?php } else { ?>
    <div id="pagination_content" style="overflow:auto; padding:1px;">     
    <?php } ?>
    <table class="list_main">
      <thead>
          <tr>
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_year; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_quarter; ?></td>       
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_month; ?></td> 
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_date; ?></td>  
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_order_prod_order_id; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_order_prod_date_added; ?></td>           
		  <?php } else { ?>    
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_start; ?></td>
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_end; ?></td>           
		  <?php } ?> 
		  <?php if ($filter_report == 'products') { ?>          
          <td id="pp20_title" class="center"><?php echo $column_image; ?></td> 
          <td id="pp21_title" class="left"><?php echo $column_sku; ?></td>           
          <td id="pp22_title" class="left"><?php echo $column_name; ?></td>                    
          <td id="pp23_title" class="left"><?php echo $column_model; ?></td>  
          <td id="pp24_title" class="left"><?php echo $column_category; ?></td>            
          <td id="pp25_title" class="left"><?php echo $column_manufacturer; ?></td>
          <td id="pp34_title" class="left"><?php echo $column_attribute; ?></td>            
          <td id="pp26_title" class="left"><?php echo $column_status; ?></td> 
          <td id="pp35_title" class="right"><?php echo $column_stock_quantity; ?></td>            
		  <?php } elseif ($filter_report == 'manufacturers') { ?>    
          <td id="pp25_title" class="left"><?php echo $column_manufacturer; ?></td>
		  <?php } elseif ($filter_report == 'categories') { ?>
          <td id="pp24_title" class="left"><?php echo $column_category; ?></td>  
		  <?php } ?>
          <td id="pp27_title" class="right"><?php echo $column_sold_quantity; ?></td>            
          <td id="pp28_title" class="right"><?php echo $column_sold_percent; ?></td>
          <td id="pp30_title" class="right"><?php echo $column_tax; ?></td>
          <td id="pp29_title" class="right"><?php echo $column_total; ?></td>
          <?php if (($filter_report == 'products' && $filter_details == 1 OR $filter_details == 2) OR ($filter_report == 'manufacturers' && $filter_details == 3) OR ($filter_report == 'categories' && $filter_details == 3)) { ?><td class="right" nowrap="nowrap"><?php echo $column_action; ?></td><?php } ?>
          </tr>
          </thead>
          <?php if ($products) { ?>
          <?php foreach ($products as $product) { ?>
      	  <tbody id="element">        
          <tr <?php echo ($filter_details == 1 OR $filter_details == 2 OR $filter_details == 3) ? 'style="cursor:pointer;" title="' . $text_detail . '"' : '' ?> id="show_details_<?php echo $product['order_product_id']; ?>">
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['year']; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['quarter']; ?></td>  
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['month']; ?></td>
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['date_start']; ?></td>    
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['order_id']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['date_start']; ?></td>          
		  <?php } else { ?>    
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['date_start']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F0F0F0;"><?php echo $product['date_end']; ?></td>         
		  <?php } ?>
		  <?php if ($filter_report == 'products') { ?>           
          <td id="pp20_<?php echo $product['order_product_id']; ?>" class="center"><img src="<?php echo $product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td> 
          <td id="pp21_<?php echo $product['order_product_id']; ?>" class="left"><?php echo $product['sku']; ?></td>           
          <td id="pp22_<?php echo $product['order_product_id']; ?>" class="left">
          <?php if ($product['status'] != NULL) { ?>
          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php } else { ?>
          <?php echo $product['name']; ?>
          <?php } ?>
          <?php if ($filter_ogrouping) { ?>
          <?php if ($product['oovalue']) { ?>
          <table cellpadding="0" cellspacing="0" border="0" style="border:none;">
          <tr>
		  <td nowrap="nowrap" style="font-size:11px; border:none;"><?php echo $product['ooname']; ?>:</td>
          <td nowrap="nowrap" style="font-size:11px; border:none;"><?php echo $product['oovalue']; ?></td>
          </tr>
          </table>
          <?php } ?><?php } ?></td>
          <td id="pp23_<?php echo $product['order_product_id']; ?>" class="left"><?php echo $product['model']; ?></td>             
          <td id="pp24_<?php echo $product['order_product_id']; ?>" class="left"><?php foreach ($categories as $category) { ?>
                <?php if (in_array($category['category_id'], $product['category'])) { ?>
                <?php echo $category['name'];?><br />
                <?php } ?> <?php } ?></td>          
          <td id="pp25_<?php echo $product['order_product_id']; ?>" class="left"><?php foreach ($manufacturers as $manufacturer) { ?>
                <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
                <?php echo $manufacturer['name'];?>
                <?php } ?> <?php } ?></td>
          <td id="pp34_<?php echo $product['order_product_id']; ?>" class="left"><?php echo $product['attribute']; ?></td>                  
		  <td id="pp26_<?php echo $product['order_product_id']; ?>" class="left">
				<?php if ($product['status'] == '1') { ?>
				<?php echo $text_enabled; ?>
				<?php } else if ($product['status'] == '0') { ?>
				<?php echo $text_disabled; ?>
				<?php } ?></td>
          <td id="pp35_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap">
          		<?php if ($product['stock_quantity'] <= 0) { ?>
				<span style="color:#FF0000;"><?php echo $product['stock_quantity']; ?></span>
				<?php } elseif ($product['stock_quantity'] <= 5) { ?>
				<span style="color:#FFA500;"><?php echo $product['stock_quantity']; ?></span>
				<?php } else { ?>
				<?php echo $product['stock_quantity']; ?>
				<?php } ?>
				<?php if ($filter_ogrouping) { ?>
				<?php if ($product['oovalue']) { ?><br />
				<?php if ($product['stock_oquantity'] <= 0) { ?>
				<span style="font-size:11px; color:#FF0000;"><?php echo $product['stock_oquantity']; ?></span>
				<?php } elseif ($product['stock_oquantity'] <= 5) { ?>
				<span style="font-size:11px; color:#FFA500;"><?php echo $product['stock_oquantity']; ?></span>
				<?php } else { ?>
				<span style="font-size:11px;"><?php echo $product['stock_oquantity']; ?></span>
				<?php } ?>
				<?php } ?>
				<?php } ?></td>
		  <?php } elseif ($filter_report == 'manufacturers') { ?>
          <td id="pp25_<?php echo $product['order_product_id']; ?>" class="left"><?php foreach ($manufacturers as $manufacturer) { ?>
                <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
                <?php echo $manufacturer['name'];?>
                <?php } ?> <?php } ?></td>
		  <?php } elseif ($filter_report == 'categories') { ?>
          <td id="pp24_<?php echo $product['order_product_id']; ?>" class="left"><?php foreach ($categories as $category) { ?>
                <?php if (in_array($category['category_id'], $product['category'])) { ?>
                <?php echo $category['name'];?><br />
                <?php } ?> <?php } ?></td>              
		  <?php } ?>    
          <td id="pp27_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_quantity']; ?></td>           
          <td id="pp28_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_percent']; ?></td>
          <td id="pp30_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['tax']; ?></td>
          <td id="pp29_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['total']; ?></td>
          <?php if (($filter_report == 'products' && $filter_details == 1 OR $filter_details == 2) OR ($filter_report == 'manufacturers' && $filter_details == 3) OR ($filter_report == 'categories' && $filter_details == 3)) { ?><td class="right" nowrap="nowrap">[ <a><?php echo $text_detail; ?></a> ]</td><?php } ?>
          </tr>
<tr class="detail">
<td colspan="16" class="center">
<?php if ($filter_report == 'products' && $filter_details == 1) { ?>
<script type="text/javascript">jQuery(function(){ 
jQuery('#show_details_<?php echo $product["order_product_id"]; ?>').click(function() {
		jQuery('#tab_details_<?php echo $product["order_product_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $product['order_product_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="pp40_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_order_id; ?></td>        
          <td id="pp41_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_date_added; ?></td>
          <td id="pp42_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_inv_no; ?></td>            
          <td id="pp43_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_customer; ?></td>
          <td id="pp44_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_email; ?></td>
          <td id="pp45_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_customer_group; ?></td>
          <td id="pp46_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_shipping_method; ?></td>
          <td id="pp47_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_payment_method; ?></td>          
          <td id="pp48_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_status; ?></td>
          <td id="pp49_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_order_prod_store; ?></td>
          <td id="pp50_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_prod_currency; ?></td>
          <td id="pp51_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_prod_price; ?></td> 
          <td id="pp52_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_prod_quantity; ?></td>
          <td id="pp54_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_prod_tax; ?></td>
          <td id="pp53_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_order_prod_total; ?></td>                           
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="pp40_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_ord_id']; ?></td>        
          <td id="pp41_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_order_date']; ?></td>
          <td id="pp42_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_inv_no']; ?></td>
          <td id="pp43_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_name']; ?></td>
          <td id="pp44_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_email']; ?></td>
          <td id="pp45_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_group']; ?></td>
          <td id="pp46_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_shipping_method']; ?></td>
          <td id="pp47_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_payment_method']; ?></td>           
          <td id="pp48_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_status']; ?></td>
          <td id="pp49_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['order_prod_store']; ?></td>           
          <td id="pp50_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['order_prod_currency']; ?></td>  
          <td id="pp51_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['order_prod_price']; ?></td> 
          <td id="pp52_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['order_prod_quantity']; ?></td>
          <td id="pp54_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['order_prod_tax']; ?></td>
          <td id="pp53_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['order_prod_total']; ?></td>
         </tr>
    </table>
</div>
<?php } ?>
<?php if ($filter_report == 'manufacturers' && $filter_details == 3 or $filter_report == 'categories' && $filter_details == 3) { ?>
<script type="text/javascript">jQuery(function(){ 
jQuery('#show_details_<?php echo $product["order_product_id"]; ?>').click(function() {
		jQuery('#tab_details_<?php echo $product["order_product_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $product['order_product_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="pp60_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_order_id; ?></td>  
          <td id="pp61_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_date_added; ?></td>
          <td id="pp62_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_inv_no; ?></td> 
          <td id="pp63_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_id; ?></td>                                          
          <td id="pp64_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_sku; ?></td>
          <td id="pp67_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_model; ?></td>            
          <td id="pp65_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_name; ?></td> 
          <td id="pp66_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_option; ?></td>
          <td id="pp77_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_attributes; ?></td>          
          <?php if ($filter_report == 'categories') { ?>          
          <td id="pp68_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_manu; ?></td> 
          <?php } ?>
          <?php if ($filter_report == 'manufacturers') { ?>          
          <td id="pp79_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_prod_category; ?></td> 
          <?php } ?>          
          <td id="pp69_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_currency; ?></td>   
          <td id="pp70_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_price; ?></td>                     
          <td id="pp71_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_quantity; ?></td> 
          <td id="pp73_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_tax; ?></td>
          <td id="pp72_<?php echo $product['order_product_id']; ?>_title" class="right" nowrap="nowrap"><?php echo $column_prod_total; ?></td>                                                                    
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="pp60_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><a><?php echo $product['product_ord_id']; ?></a></td>  
          <td id="pp61_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_order_date']; ?></td>
          <td id="pp62_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_inv_no']; ?></td>
          <td id="pp63_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_pid']; ?></td>  
          <td id="pp64_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_sku']; ?></td>
          <td id="pp67_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_model']; ?></td>          
          <td id="pp65_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_name']; ?></td> 
          <td id="pp66_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_option']; ?></td>
          <td id="pp77_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_attributes']; ?></td>          
          <?php if ($filter_report == 'categories') { ?>        
          <td id="pp68_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_manu']; ?></td> 
          <?php } ?>
          <?php if ($filter_report == 'manufacturers') { ?>        
          <td id="pp79_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['product_category']; ?></td> 
          <?php } ?>          
          <td id="pp69_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['product_currency']; ?></td> 
          <td id="pp70_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['product_price']; ?></td> 
          <td id="pp71_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['product_quantity']; ?></td>
          <td id="pp73_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['product_tax']; ?></td>
          <td id="pp72_<?php echo $product['order_product_id']; ?>" class="right" nowrap="nowrap"><?php echo $product['product_total']; ?></td>  
         </tr>       
    </table>
</div> 
<?php } ?>  
<?php if ($filter_report == 'products' && $filter_details == 2) { ?>
<script type="text/javascript">jQuery(function(){ 
jQuery('#show_details_<?php echo $product["order_product_id"]; ?>').click(function() {
		jQuery('#tab_details_<?php echo $product["order_product_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $product['order_product_id']; ?>" style="display:none">
    <table class="list_detail">
      <thead>
        <tr>
          <td id="pp80_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_order_id; ?></td>        
          <td id="pp81_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_date_added; ?></td>
          <td id="pp82_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_inv_no; ?></td>           
          <td id="pp83_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_cust_id; ?></td>           
          <td id="pp84_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_name; ?></td> 
          <td id="pp85_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_company; ?></td> 
          <td id="pp86_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_address_1; ?></td> 
          <td id="pp87_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_address_2; ?></td> 
          <td id="pp88_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_city; ?></td>
          <td id="pp89_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_zone; ?></td> 
          <td id="pp90_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_postcode; ?></td>
          <td id="pp91_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_billing_country; ?></td>
          <td id="pp92_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_customer_telephone; ?></td>
          <td id="pp93_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_name; ?></td> 
          <td id="pp94_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_company; ?></td> 
          <td id="pp95_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_address_1; ?></td> 
          <td id="pp96_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_address_2; ?></td> 
          <td id="pp97_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_city; ?></td>
          <td id="pp98_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_zone; ?></td> 
          <td id="pp99_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_postcode; ?></td>
          <td id="pp100_<?php echo $product['order_product_id']; ?>_title" class="left" nowrap="nowrap"><?php echo $column_shipping_country; ?></td>          
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <td id="pp80_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['customer_ord_id']; ?></td>        
          <td id="pp81_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['customer_order_date']; ?></td>
          <td id="pp82_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['customer_inv_no']; ?></td>
          <td id="pp83_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['customer_cust_id']; ?></td>             
          <td id="pp84_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_name']; ?></td>         
          <td id="pp85_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_company']; ?></td> 
          <td id="pp86_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_address_1']; ?></td> 
          <td id="pp87_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_address_2']; ?></td> 
          <td id="pp88_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_city']; ?></td> 
          <td id="pp89_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_zone']; ?></td> 
          <td id="pp90_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_postcode']; ?></td>                    
          <td id="pp91_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['billing_country']; ?></td>
          <td id="pp92_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['customer_telephone']; ?></td> 
          <td id="pp93_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_name']; ?></td>         
          <td id="pp94_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_company']; ?></td> 
          <td id="pp95_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_address_1']; ?></td> 
          <td id="pp96_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_address_2']; ?></td> 
          <td id="pp97_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_city']; ?></td> 
          <td id="pp98_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_zone']; ?></td> 
          <td id="pp99_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_postcode']; ?></td>                    
          <td id="pp100_<?php echo $product['order_product_id']; ?>" class="left" nowrap="nowrap"><?php echo $product['shipping_country']; ?></td>                                                         
         </tr>
    </table>
</div> 
<?php } ?>  
</td>
</tr>       
        <?php } ?>
        <tr>
        <td colspan="16"></td>
        </tr>               
        <tr>
          <td colspan="2" class="right" style="background-color:#E7EFEF;"><strong><?php echo $text_filter_total; ?></strong></td>
		  <?php if ($filter_report == 'products') { ?>            
          <td id="pp20_total" style="background-color:#DDDDDD;"></td>
          <td id="pp21_total" style="background-color:#DDDDDD;"></td>
          <td id="pp22_total" style="background-color:#DDDDDD;"></td>
          <td id="pp23_total" style="background-color:#DDDDDD;"></td>
          <td id="pp24_total" style="background-color:#DDDDDD;"></td>
          <td id="pp25_total" style="background-color:#DDDDDD;"></td>
          <td id="pp34_total" style="background-color:#DDDDDD;"></td>
          <td id="pp26_total" style="background-color:#DDDDDD;"></td>
          <td id="pp35_total" style="background-color:#DDDDDD;"></td>              
		  <?php } elseif ($filter_report == 'manufacturers') { ?>    
          <td id="pp25_total" style="background-color:#DDDDDD;"></td>
		  <?php } elseif ($filter_report == 'categories') { ?>
          <td id="pp24_total" style="background-color:#DDDDDD;"></td>        
		  <?php } ?>        
          <td id="pp27_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['sold_quantity_total']; ?></strong></td>           
          <td id="pp28_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['sold_percent_total']; ?></strong></td>
          <td id="pp30_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['tax_total']; ?></strong></td>
          <td id="pp29_total" class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['total_total']; ?></strong></td>
          <?php if (($filter_report == 'products' && $filter_details == 1 OR $filter_details == 2) OR ($filter_report == 'manufacturers' && $filter_details == 3) OR ($filter_report == 'categories' && $filter_details == 3)) { ?><td></td><?php } ?>                  
        </tr>
        <?php } else { ?>
        <tr>
        <?php if ($filter_report == 'products') { ?> 
          <td class="noresult" colspan="16"><?php echo $text_no_results; ?></td>
        <?php } elseif ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?> 
          <td class="noresult" colspan="8"><?php echo $text_no_results; ?></td>
        <?php } ?>      
        </tr>       
        <?php } ?>
      </tbody>        
    </table>
    </div>
      <?php if ($products) { ?>    
      <div class="pagination_report"></div>
      <?php } ?>
    </div>
    </div>    
  </div>
</div>  
</form> 
<script type="text/javascript">
// jQuery multiSelect 1.2.2 beta
jQuery(document).ready(function() {
	// render the html for a single option
	function renderOption(id, option)
	{
		var html = '<label><input type="checkbox" name="' + id + '[]" value="' + option.value + '"';
		if( option.selected ){
			html += ' checked="checked"';
		}
		html += ' />' + option.text + '</label>';
		
		return html;
	}
	
	// render the html for the options/optgroups
	function renderOptions(id, options, o)
	{
		var html = "";
		
		for(var i = 0; i < options.length; i++) {
			if(options[i].optgroup) {
				html += '<label class="optGroup">';
				
				if(o.optGroupSelectable) {
					html += '<input type="checkbox" class="optGroup" />' + options[i].optgroup;
				}
				else {
					html += options[i].optgroup;
				}
				
				html += '</label><div class="optGroupContainer">';
				
				html += renderOptions(id, options[i].options, o);
				
				html += '</div>';
			}
			else {
				html += renderOption(id, options[i]);
			}
		}
		
		return html;
	}
	
	// Building the actual options
	function buildOptions(options)
	{
		var multiSelect = jQuery(this);
		var multiSelectOptions = multiSelect.next('.multiSelectOptions');
		var o = multiSelect.data("config");
		var callback = multiSelect.data("callback");

		// clear the existing options
		multiSelectOptions.html("");
		var html = "";

		// if we should have a select all option then add it
		if( o.selectAll ) {
			html += '<label class="selectAll"><input type="checkbox" class="selectAll" />' + o.selectAllText + '</label>';
		}

		// generate the html for the new options
		html += renderOptions(multiSelect.attr('id'), options, o);
		
		multiSelectOptions.html(html);
		
		// variables needed to account for width changes due to a scrollbar
		var initialWidth = multiSelectOptions.width();
		var hasScrollbar = false;
		
		// set the height of the dropdown options
		if(multiSelectOptions.height() > o.listHeight) {
			multiSelectOptions.css("height", o.listHeight + 'px');
			hasScrollbar = true;
		} else {
			multiSelectOptions.css("height", '');
		}
		
		// if the there is a scrollbar and the browser did not already handle adjusting the width (i.e. Firefox) then we will need to manaually add the scrollbar width
		var scrollbarWidth = hasScrollbar && (initialWidth == multiSelectOptions.width()) ? 17 : 0;

		// set the width of the dropdown options
		if((multiSelectOptions.width() + scrollbarWidth) < multiSelect.outerWidth()) {
			multiSelectOptions.css("width", multiSelect.outerWidth() - 2/*border*/ + 'px');
		} else {
			multiSelectOptions.css("width", (multiSelectOptions.width() + scrollbarWidth) + 'px');
		}
		
		// Apply bgiframe if available on IE6
		if( jQuery.fn.bgiframe ) multiSelect.next('.multiSelectOptions').bgiframe( { width: multiSelectOptions.width(), height: multiSelectOptions.height() });

		// Handle selectAll oncheck
		if(o.selectAll) {
			multiSelectOptions.find('INPUT.selectAll').click( function() {
				// update all the child checkboxes
				multiSelectOptions.find('INPUT:checkbox').attr('checked', jQuery(this).attr('checked')).parent("LABEL").toggleClass('checked', jQuery(this).attr('checked'));
			});
		}
		
		// Handle OptGroup oncheck
		if(o.optGroupSelectable) {
			multiSelectOptions.addClass('optGroupHasCheckboxes');
		
			multiSelectOptions.find('INPUT.optGroup').click( function() {
				// update all the child checkboxes
				jQuery(this).parent().next().find('INPUT:checkbox').attr('checked', jQuery(this).attr('checked')).parent("LABEL").toggleClass('checked', jQuery(this).attr('checked'));
			});
		}
		
		// Handle all checkboxes
		multiSelectOptions.find('INPUT:checkbox').click( function() {
			// set the label checked class
			jQuery(this).parent("LABEL").removeClass('checked', jQuery(this).attr('checked'));
			
			updateSelected.call(multiSelect);
			multiSelect.focus();
			if(jQuery(this).parent().parent().hasClass('optGroupContainer')) {
				updateOptGroup.call(multiSelect, jQuery(this).parent().parent().prev());
			}
			if( callback ) {
				callback(jQuery(this));
			}
		});
		
		// Initial display
		multiSelectOptions.each( function() {
			jQuery(this).find('INPUT:checked').parent().toggleClass('checked');
		});
		
		// Initialize selected and select all 
		updateSelected.call(multiSelect);
		
		// Initialize optgroups
		if(o.optGroupSelectable) {
			multiSelectOptions.find('LABEL.optGroup').each( function() {
				updateOptGroup.call(multiSelect, jQuery(this));
			});
		}
		
		// Handle hovers
		multiSelectOptions.find('LABEL:has(INPUT)').hover( function() {
			jQuery(this).parent().find('LABEL').removeClass('hover');
			jQuery(this).addClass('hover');
		}, function() {
			jQuery(this).parent().find('LABEL').removeClass('hover');
		});
		
		// Keyboard
		multiSelect.keydown( function(e) {
		
			var multiSelectOptions = jQuery(this).next('.multiSelectOptions');

			// Is dropdown visible?
			if( multiSelectOptions.css('visibility') != 'hidden' ) {
				// Dropdown is visible
				// Tab
				if( e.keyCode == 9 ) {
					jQuery(this).addClass('focus').trigger('click'); // esc, left, right - hide
					jQuery(this).focus().next(':input').focus();
					return true;
				}
				
				// ESC, Left, Right
				if( e.keyCode == 27 || e.keyCode == 37 || e.keyCode == 39 ) {
					// Hide dropdown
					jQuery(this).addClass('focus').trigger('click');
				}
				// Down || Up
				if( e.keyCode == 40 || e.keyCode == 38) {
					var allOptions = multiSelectOptions.find('LABEL');
					var oldHoverIndex = allOptions.index(allOptions.filter('.hover'));
					var newHoverIndex = -1;
					
					// if there is no current highlighted item then highlight the first item
					if(oldHoverIndex < 0) {
						// Default to first item
						multiSelectOptions.find('LABEL:first').addClass('hover');
					}
					// else if we are moving down and there is a next item then move
					else if(e.keyCode == 40 && oldHoverIndex < allOptions.length - 1)
					{
						newHoverIndex = oldHoverIndex + 1;
					}
					// else if we are moving up and there is a prev item then move
					else if(e.keyCode == 38 && oldHoverIndex > 0)
					{
						newHoverIndex = oldHoverIndex - 1;
					}

					if(newHoverIndex >= 0) {
						jQuery(allOptions.get(oldHoverIndex)).removeClass('hover'); // remove the current highlight
						jQuery(allOptions.get(newHoverIndex)).addClass('hover'); // add the new highlight
						
						// Adjust the viewport if necessary
						adjustViewPort(multiSelectOptions);
					}
					
					return false;
				}

				// Enter, Space
				if( e.keyCode == 13 || e.keyCode == 32 ) {
					var selectedCheckbox = multiSelectOptions.find('LABEL.hover INPUT:checkbox');
					
					// Set the checkbox (and label class)
					selectedCheckbox.attr('checked', !selectedCheckbox.attr('checked')).parent("LABEL").toggleClass('checked', selectedCheckbox.attr('checked'));
					
					// if the checkbox was the select all then set all the checkboxes
					if(selectedCheckbox.hasClass("selectAll")) {
						multiSelectOptions.find('INPUT:checkbox').attr('checked', selectedCheckbox.attr('checked')).parent("LABEL").addClass('checked').toggleClass('checked', selectedCheckbox.attr('checked')); 
					}

					updateSelected.call(multiSelect);
					
					if( callback ) callback(jQuery(this));
					return false;
				}

				// Any other standard keyboard character (try and match the first character of an option)
				if( e.keyCode >= 33 && e.keyCode <= 126 ) {
					// find the next matching item after the current hovered item
					var match = multiSelectOptions.find('LABEL:startsWith(' + String.fromCharCode(e.keyCode) + ')');
					
					var currentHoverIndex = match.index(match.filter('LABEL.hover'));
					
					// filter the set to any items after the current hovered item
					var afterHoverMatch = match.filter(function (index) {
						return index > currentHoverIndex;
					});

					// if there were no item after the current hovered item then try using the full search results (filtered to the first one)
					match = (afterHoverMatch.length >= 1 ? afterHoverMatch : match).filter("LABEL:first");

					if(match.length == 1) {
						// if we found a match then move the hover
						multiSelectOptions.find('LABEL.hover').removeClass('hover');								
						match.addClass('hover');
						
						adjustViewPort(multiSelectOptions);
					}
				}
			} else {
				// Dropdown is not visible
				if( e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13 || e.keyCode == 32 ) { //up, down, enter, space - show
					// Show dropdown
					jQuery(this).removeClass('focus').trigger('click');
					multiSelectOptions.find('LABEL:first').addClass('hover');
					return false;
				}
				//  Tab key
				if( e.keyCode == 9 ) {
					// Shift focus to next INPUT element on page
					multiSelectOptions.next(':input').focus();
					return true;
				}
			}
			// Prevent enter key from submitting form
			if( e.keyCode == 13 ) return false;
		});
	}
	
	// Adjust the viewport if necessary
	function adjustViewPort(multiSelectOptions)
	{
		// check for and move down
		var selectionBottom = multiSelectOptions.find('LABEL.hover').position().top + multiSelectOptions.find('LABEL.hover').outerHeight();
		
		if(selectionBottom > multiSelectOptions.innerHeight()){		
			multiSelectOptions.scrollTop(multiSelectOptions.scrollTop() + selectionBottom - multiSelectOptions.innerHeight());
		}
		
		// check for and move up						
		if(multiSelectOptions.find('LABEL.hover').position().top < 0){		
			multiSelectOptions.scrollTop(multiSelectOptions.scrollTop() + multiSelectOptions.find('LABEL.hover').position().top);
		}
	}
	
	// Update the optgroup checked status
	function updateOptGroup(optGroup)
	{
		var multiSelect = jQuery(this);
		var o = multiSelect.data("config");
		
		// Determine if the optgroup should be checked
		if(o.optGroupSelectable) {
			var optGroupSelected = true;
			jQuery(optGroup).next().find('INPUT:checkbox').each( function() {
				if( !jQuery(this).attr('checked') ) {
					optGroupSelected = false;
					return false;
				}
			});
			
			jQuery(optGroup).find('INPUT.optGroup').attr('checked', optGroupSelected).parent("LABEL").toggleClass('checked', optGroupSelected);
		}
	}
	
	// Update the textbox with the total number of selected items, and determine select all
	function updateSelected() {
		var multiSelect = jQuery(this);
		var multiSelectOptions = multiSelect.next('.multiSelectOptions');
		var o = multiSelect.data("config");
		
		var i = 0;
		var selectAll = true;
		var display = '';
		multiSelectOptions.find('INPUT:checkbox').not('.selectAll, .optGroup').each( function() {
			if( jQuery(this).attr('checked') ) {
				i++;
				display = display + jQuery(this).parent().text() + ', ';
			}
			else selectAll = false;
		});
		
		// trim any end comma and surounding whitespace
		display = display.replace(/\s*\,\s*$/,'');
		
		if( i == 0 ) {
			multiSelect.find("span").html( o.noneSelected );
		} else {
			if( o.oneOrMoreSelected == '*' ) {
				multiSelect.find("span").html( display );
				multiSelect.attr( "title", display );
			} else {
				multiSelect.find("span").html( o.oneOrMoreSelected.replace('%', i) );
			}
		}

		// Determine if Select All should be checked
		if(o.selectAll) {
			multiSelectOptions.find('INPUT.selectAll').attr('checked', selectAll).parent("LABEL").toggleClass('checked', selectAll);
		}
	}
	
	jQuery.extend(jQuery.fn, {
		multiSelect: function(o, callback) {
			// Default options
			if( !o ) o = {};
			if( o.selectAll == undefined ) o.selectAll = false;
			if( o.selectAllText == undefined ) o.selectAllText = "Select All";
			if( o.noneSelected == undefined ) o.noneSelected = 'Select Options';
			if( o.oneOrMoreSelected == undefined ) o.oneOrMoreSelected = '% Selected';
			if( o.optGroupSelectable == undefined ) o.optGroupSelectable = false;
			if( o.listHeight == undefined ) o.listHeight = 150;

			// Initialize each multiSelect
			jQuery(this).each( function() {
				var select = jQuery(this);
				var html = '<a href="javascript:;" class="multiSelect"><span></span></a>';
				html += '<div class="multiSelectOptions" style="position: absolute; z-index: 99; visibility: hidden;"></div>';
				jQuery(select).after(html);
				
				var multiSelect = jQuery(select).next('.multiSelect');
				var multiSelectOptions = multiSelect.next('.multiSelectOptions');
				
				// if the select object had a width defined then match the new multilsect to it
				multiSelect.find("span").css("width", jQuery(select).width() + 'px');
				
				// Attach the config options to the multiselect
				multiSelect.data("config", o);
				
				// Attach the callback to the multiselect
				multiSelect.data("callback", callback);
				
				// Serialize the select options into json options
				var options = [];
				jQuery(select).children().each( function() {
					if(this.tagName.toUpperCase() == 'OPTGROUP')
					{
						var suboptions = [];
						options.push({ optgroup: jQuery(this).attr('label'), options: suboptions });
						
						jQuery(this).children('OPTION').each( function() {
							if( jQuery(this).val() != '' ) {
								suboptions.push({ text: jQuery(this).html(), value: jQuery(this).val(), selected: jQuery(this).attr('selected') });
							}
						});
					}
					else if(this.tagName.toUpperCase() == 'OPTION')
					{
						if( jQuery(this).val() != '' ) {
							options.push({ text: jQuery(this).html(), value: jQuery(this).val(), selected: jQuery(this).attr('selected') });
						}
					}
				});
				
				// Eliminate the original form element
				jQuery(select).remove();
				
				// Add the id that was on the original select element to the new input
				multiSelect.attr("id", jQuery(select).attr("id"));
				
				// Build the dropdown options
				buildOptions.call(multiSelect, options);

				// Events
				multiSelect.hover( function() {
					jQuery(this).addClass('hover');
				}, function() {
					jQuery(this).removeClass('hover');
				}).click( function() {
					// Show/hide on click
					if( jQuery(this).hasClass('active') ) {
						jQuery(this).multiSelectOptionsHide();
					} else {
						jQuery(this).multiSelectOptionsShow();
					}
					return false;
				}).focus( function() {
					// So it can be styled with CSS
					jQuery(this).addClass('focus');
				}).blur( function() {
					// So it can be styled with CSS
					jQuery(this).removeClass('focus');
				});
				
				// Add an event listener to the window to close the multiselect if the user clicks off
				jQuery(document).click( function(event) {
					// If somewhere outside of the multiselect was clicked then hide the multiselect
					if(!(jQuery(event.target).parents().andSelf().is('.multiSelectOptions'))){
						multiSelect.multiSelectOptionsHide();
					}
				});
			});
		},
		
		// Update the dropdown options
		multiSelectOptionsUpdate: function(options) {
			buildOptions.call(jQuery(this), options);
		},
		
		// Hide the dropdown
		multiSelectOptionsHide: function() {
			jQuery(this).removeClass('active').removeClass('hover').next('.multiSelectOptions').css('visibility', 'hidden');
		},
		
		// Show the dropdown
		multiSelectOptionsShow: function() {
			var multiSelect = jQuery(this);
			var multiSelectOptions = multiSelect.next('.multiSelectOptions');
			var o = multiSelect.data("config");
		
			// Hide any open option boxes
			jQuery('.multiSelect').multiSelectOptionsHide();
			multiSelectOptions.find('LABEL').removeClass('hover');
			multiSelect.addClass('active').next('.multiSelectOptions').css('visibility', 'visible');
			multiSelect.focus();
			
			// reset the scroll to the top
			multiSelect.next('.multiSelectOptions').scrollTop(0);

			// Position it
			var offset = multiSelect.position();
			multiSelect.next('.multiSelectOptions').css({ top:  offset.top + jQuery(this).outerHeight() + 'px' });
			multiSelect.next('.multiSelectOptions').css({ left: offset.left + 'px' });
		},
		
		// get a coma-delimited list of selected values
		selectedValuesString: function() {
			var selectedValues = "";
			jQuery(this).next('.multiSelectOptions').find('INPUT:checkbox:checked').not('.optGroup, .selectAll').each(function() {
				selectedValues += jQuery(this).attr('value') + ",";
			});
			// trim any end comma and surounding whitespace
			return selectedValues.replace(/\s*\,\s*$/,'');
		}		
	});
	
	// add a new ":startsWith" search filter
	jQuery.expr[":"].startsWith = function(el, i, m) {
		var search = m[3];        
		if (!search) return false;
		return eval("/^[/s]*" + search + "/i").test(jQuery(el).text());
	};	
});
</script>
<script type="text/javascript">
// jQuery paging plugin v1.1.0
(function(k,p,n){k.fn.paging=function(v,w){var t=this,s={setOptions:function(b){this.a=k.extend(this.a||{lapping:0,perpage:10,page:1,refresh:{interval:10,url:null},format:"",onFormat:function(){},onSelect:function(){return!0},onRefresh:function(){}},b||{});this.a.lapping|=0;this.a.perpage|=0;this.a.page|=0;1>this.a.perpage&&(this.a.perpage=10);this.k&&p.clearInterval(this.k);this.a.refresh.url&&(this.k=p.setInterval(function(b){k.ajax({url:b.a.refresh.url,success:function(g){if("string"===typeof g)try{g=
k.parseJSON(g)}catch(f){return}b.a.onRefresh(g)}})},1E3*this.a.refresh.interval,this));this.l=function(b){for(var g=0,f=0,h=1,d={e:[],h:0,g:0,b:5,d:3,j:0,m:0},a,l=/[*<>pq\[\]().-]|[nc]+!?/g,k={"[":"first","]":"last","<":"prev",">":"next",q:"left",p:"right","-":"fill",".":"leap"},e={};a=l.exec(b);){a=""+a;if(n===k[a])if("("===a)f=++g;else if(")"===a)f=0;else{if(h){if("*"===a){d.h=1;d.g=0}else{d.h=0;d.g="!"===a.charAt(a.length-1);d.b=a.length-d.g;if(!(d.d=1+a.indexOf("c")))d.d=1+d.b>>1}d.e[d.e.length]=
{f:"block",i:0,c:0};h=0}}else{d.e[d.e.length]={f:k[a],i:f,c:n===e[a]?e[a]=1:++e[a]};"q"===a?++d.m:"p"===a&&++d.j}}return d}(this.a.format);return this},setNumber:function(b){this.o=n===b||0>b?-1:b;return this},setPage:function(b){function q(b,a,c){c=""+b.onFormat.call(a,c);l=a.value?l+c.replace("<a",'<a data-page="'+a.value+'"'):l+c}if(n===b){if(b=this.a.page,null===b)return this}else if(this.a.page==b)return this;this.a.page=b|=0;var g=this.o,f=this.a,h,d,a,l,r=1,e=this.l,c,i,j,m,u=e.e.length,o=
u;f.perpage<=f.lapping&&(f.lapping=f.perpage-1);m=g<=f.lapping?0:f.lapping|0;0>g?(a=g=-1,h=Math.max(1,b-e.d+1-m),d=h+e.b):(a=1+Math.ceil((g-f.perpage)/(f.perpage-m)),b=Math.max(1,Math.min(0>b?1+a+b:b,a)),e.h?(h=1,d=1+a,e.d=b,e.b=a):(h=Math.max(1,Math.min(b-e.d,a-e.b)+1),d=e.g?h+e.b:Math.min(h+e.b,1+a)));for(;o--;){i=0;j=e.e[o];switch(j.f){case "left":i=j.c<h;break;case "right":i=d<=a-e.j+j.c;break;case "first":i=e.d<b;break;case "last":i=e.b<e.d+a-b;break;case "prev":i=1<b;break;case "next":i=b<a}r|=
i<<j.i}c={number:g,lapping:m,pages:a,perpage:f.perpage,page:b,slice:[(i=b*(f.perpage-m)+m)-f.perpage,Math.min(i,g)]};for(l="";++o<u;){j=e.e[o];i=r>>j.i&1;switch(j.f){case "block":for(;h<d;++h)c.value=h,c.pos=1+e.b-d+h,c.active=h<=a||0>g,c.first=1===h,c.last=h==a&&0<g,q(f,c,j.f);continue;case "left":c.value=j.c;c.active=j.c<h;break;case "right":c.value=a-e.j+j.c;c.active=d<=c.value;break;case "first":c.value=1;c.active=i&&1<b;break;case "prev":c.value=Math.max(1,b-1);c.active=i&&1<b;break;case "last":(c.active=
0>g)?c.value=1+b:(c.value=a,c.active=i&&b<a);break;case "next":(c.active=0>g)?c.value=1+b:(c.value=Math.min(1+b,a),c.active=i&&b<a);break;case "leap":case "fill":c.pos=j.c;c.active=i;q(f,c,j.f);continue}c.pos=j.c;c.last=c.first=n;q(f,c,j.f)}t.length&&(k("a",t.html(l)).click(function(a){a.preventDefault();a=this;do if("a"===a.nodeName.toLowerCase())break;while(a=a.parentNode);s.setPage(k(a).data("page"));if(s.n)p.location=a.href}),this.n=f.onSelect.call({number:g,lapping:m,pages:a,slice:c.slice},b));
return this}};return s.setNumber(v).setOptions(w).setPage()}})(jQuery,this);
</script>
<script type="text/javascript">
// jQuery Vertigo Tip
this.vtip = function() {    
    this.xOffset = -10; // x distance from mouse
    this.yOffset = 10; // y distance from mouse       
    	
    jQuery(".vtip").unbind().hover(    
        function(e) {
            this.t = this.title;
            this.title = ''; 
            this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);
            
            jQuery('body').append( '<p id="vtip">' + this.t + '</p>' );
            
			jQuery('p#vtip').css("display", "none");
			jQuery('p#vtip').css("position", "absolute");
			jQuery('p#vtip').css("padding", "10px");
			jQuery('p#vtip').css("left", "5px");	
			jQuery('p#vtip').css("font-size", "11px");
			jQuery('p#vtip').css("background-color", "white");
			jQuery('p#vtip').css("border", "1px solid #DDDDDD");
			jQuery('p#vtip').css("background-color", "white");
			jQuery('p#vtip').css("-moz-border-radius", "5px");
			jQuery('p#vtip').css("-webkit-border-radius", "5px");
			jQuery('p#vtip').css("z-index", "9999");
			
            jQuery('p#vtip').css("top", this.top+"px").css("left", this.left+"px").fadeIn("fast");
			
        },
        function() {
            this.title = this.t;
            jQuery("p#vtip").fadeOut("fast").remove();
        }
    ).mousemove(
        function(e) {
            this.top = (e.pageY + yOffset);
            this.left = (e.pageX + xOffset);
                         
            jQuery("p#vtip").css("top", this.top+"px").css("left", this.left+"px");
        }
    );            
};
jQuery(document).ready(function($){vtip();}) 
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#date-start').datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
	jQuery('#date-end').datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});

	jQuery('#status-date-start').datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
	jQuery('#status-date-end').datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'});
	
    jQuery('#filter_order_status_id').multiSelect({
      selectAllText:'<?php echo $text_all_status; ?>', noneSelected:'<?php echo $text_all_status; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_store_id').multiSelect({
      selectAllText:'<?php echo $text_all_stores; ?>', noneSelected:'<?php echo $text_all_stores; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_currency').multiSelect({
      selectAllText:'<?php echo $text_all_currencies; ?>', noneSelected:'<?php echo $text_all_currencies; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_taxes').multiSelect({
      selectAllText:'<?php echo $text_all_taxes; ?>', noneSelected:'<?php echo $text_all_taxes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_tax_classes').multiSelect({
      selectAllText:'<?php echo $text_all_tax_classes; ?>', noneSelected:'<?php echo $text_all_tax_classes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_geo_zones').multiSelect({
      selectAllText:'<?php echo $text_all_zones; ?>', noneSelected:'<?php echo $text_all_zones; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_customer_group_id').multiSelect({
      selectAllText:'<?php echo $text_all_groups; ?>', noneSelected:'<?php echo $text_all_groups; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_payment_method').multiSelect({
      selectAllText:'<?php echo $text_all_payment_methods; ?>', noneSelected:'<?php echo $text_all_payment_methods; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_shipping_method').multiSelect({
      selectAllText:'<?php echo $text_all_shipping_methods; ?>', noneSelected:'<?php echo $text_all_shipping_methods; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_category').multiSelect({
      selectAllText:'<?php echo $text_all_categories; ?>', noneSelected:'<?php echo $text_all_categories; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_manufacturer').multiSelect({
      selectAllText:'<?php echo $text_all_manufacturers; ?>', noneSelected:'<?php echo $text_all_manufacturers; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_option').multiSelect({
      selectAllText:'<?php if ($filter_ogrouping or $filter_report != "products") { ?><?php echo $text_all_options; ?><?php } else { ?><span style="color:#999"><?php echo $text_all_options; ?></span><?php } ?>', noneSelected:'<?php if ($filter_ogrouping or $filter_report != "products") { ?><?php echo $text_all_options; ?><?php } else { ?><span style="color:#999"><?php echo $text_all_options; ?></span><?php } ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_attribute').multiSelect({
      selectAllText:'<?php echo $text_all_attributes; ?>', noneSelected:'<?php echo $text_all_attributes; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_status').multiSelect({
      selectAllText:'<?php echo $text_all_status; ?>', noneSelected:'<?php echo $text_all_status; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_location').multiSelect({
      selectAllText:'<?php echo $text_all_locations; ?>', noneSelected:'<?php echo $text_all_locations; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_affiliate_name').multiSelect({
      selectAllText:'<?php echo $text_all_affiliate_names; ?>', noneSelected:'<?php echo $text_all_affiliate_names; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });

    jQuery('#filter_affiliate_email').multiSelect({
      selectAllText:'<?php echo $text_all_affiliate_emails; ?>', noneSelected:'<?php echo $text_all_affiliate_emails; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#filter_coupon_name').multiSelect({
      selectAllText:'<?php echo $text_all_coupon_names; ?>', noneSelected:'<?php echo $text_all_coupon_names; ?>', oneOrMoreSelected:'<?php echo $text_selected; ?>'
      });
	
    jQuery('#export_xls_prod').click(function() {
      jQuery('#export').val('1') ; // export_xls_prod: #1
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_xls_prod_order_list').click(function() {
      jQuery('#export').val('2') ; // export_xls_prod_order_list: #2
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_xls_prod_customer_list').click(function() {
      jQuery('#export').val('3') ; // export_xls_prod_customer_list: #3
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_xls_manu').click(function() {
      jQuery('#export').val('4') ; // export_xls_manu: #4
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_xls_manu_product_list').click(function() {
      jQuery('#export').val('5') ; // export_xls_manu_product_list: #5
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_xls_cat').click(function() {
      jQuery('#export').val('6') ; // export_xls_cat: #6
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_xls_cat_product_list').click(function() {
      jQuery('#export').val('7') ; // export_xls_cat_product_list: #7
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_html_prod').click(function() {
      jQuery('#export').val('8') ; // export_html_prod: #8
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_html_prod_order_list').click(function() {
      jQuery('#export').val('9') ; // export_html_prod_order_list: #9
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
		
    jQuery('#export_html_prod_customer_list').click(function() {
      jQuery('#export').val('10') ; // export_html_prod_customer_list: #10
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_html_manu').click(function() {
      jQuery('#export').val('11') ; // export_html_manu: #11
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_html_manu_product_list').click(function() {
      jQuery('#export').val('12') ; // export_html_manu_product_list: #12
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });		

    jQuery('#export_html_cat').click(function() {
      jQuery('#export').val('13') ; // export_html_cat: #13
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	

    jQuery('#export_html_cat_product_list').click(function() {
      jQuery('#export').val('14') ; // export_html_cat_product_list: #14
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });
	
    jQuery('#export_pdf_prod').click(function() {
      jQuery('#export').val('15') ; // export_pdf_prod: #15
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_pdf_prod_order_list').click(function() {
      jQuery('#export').val('16') ; // export_pdf_prod_order_list: #16
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_pdf_prod_customer_list').click(function() {
      jQuery('#export').val('17') ; // export_pdf_prod_customer_list: #17
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_pdf_manu').click(function() {
      jQuery('#export').val('18') ; // export_pdf_manu: #18
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_pdf_manu_product_list').click(function() {
      jQuery('#export').val('19') ; // export_pdf_manu_product_list: #19
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });		

    jQuery('#export_pdf_cat').click(function() {
      jQuery('#export').val('20') ; // export_pdf_cat: #20
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
	
    jQuery('#export_pdf_cat_product_list').click(function() {
      jQuery('#export').val('21') ; // export_pdf_cat_product_list: #21
      jQuery('#report').attr('target', '_blank'); // opening file in a new window
      jQuery('#report').submit() ;
      jQuery('#report').attr('target', '_self'); // preserve current form      
      jQuery('#export').val('') ; 
      return(false)
    });	
});
</script>  
<script type="text/javascript"><!--
jQuery('input[name=\'filter_customer_name\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.cust_name,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_customer_name\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_customer_email\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_email=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.cust_email,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_customer_email\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_customer_telephone\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_customer_telephone=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.cust_telephone,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_customer_telephone\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_ip\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_ip=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.cust_ip,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_ip\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_company\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_company=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_company,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_company\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_address\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_address=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_address,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_address\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_city\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_city=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_city,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_city\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_zone\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_zone=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_zone,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_zone\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_postcode\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_postcode=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_postcode,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_postcode\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_payment_country\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_payment_country=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.payment_country,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_payment_country\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_company\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_company=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_company,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_company\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_address\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_address=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_address,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_address\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_city\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_city=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_city,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_city\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_zone\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_zone=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_zone,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_zone\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_postcode\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_postcode=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_postcode,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_postcode\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_shipping_country\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/customer_autocomplete&token=<?php echo $token; ?>&filter_shipping_country=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.shipping_country,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_shipping_country\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_sku\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/product_autocomplete&token=<?php echo $token; ?>&filter_sku=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.prod_sku,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_sku\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_product_id\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/product_autocomplete&token=<?php echo $token; ?>&filter_product_id=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.prod_name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_product_id\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_model\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/product_autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.prod_model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_coupon_code\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/coupon_autocomplete&token=<?php echo $token; ?>&filter_coupon_code=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.coupon_code,
						value: item.coupon_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_coupon_code\']').val(ui.item.label);
						
		return false;
	}
});

jQuery('input[name=\'filter_voucher_code\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		jQuery.ajax({
			url: 'index.php?route=report/adv_product_purchased/voucher_autocomplete&token=<?php echo $token; ?>&filter_voucher_code=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(jQuery.map(json, function(item) {
					return {
						label: item.voucher_code,
						value: item.voucher_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		jQuery('input[name=\'filter_voucher_code\']').val(ui.item.label);
						
		return false;
	}
});
//--></script> 
<?php if ($products) { ?>    
<?php if (($filter_range != 'all_time' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) or ($filter_range == 'all_time' && $filter_group == 'year')) { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);      
	  function drawChart() {        
	  	var data = google.visualization.arrayToDataTable([
			<?php if ($sales && $filter_group == 'month') {
				echo "['" . $column_month . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear_month'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "]";
						} else {
							echo "['" . $sale['gyear_month'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "],";
						}
					}	
			} elseif ($sales && $filter_group == 'quarter') {
				echo "['" . $column_quarter . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear_quarter'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "]";
						} else {
							echo "['" . $sale['gyear_quarter'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "],";
						}
					}	
			} elseif ($sales && $filter_group == 'year') {
				echo "['" . $column_year . "','". $column_orders . "','" . $column_customers . "','" . $column_products . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "]";
						} else {
							echo "['" . $sale['gyear'] . "',". $sale['gorders'] . ",". $sale['gcustomers'] . ",". $sale['gproducts'] . "],";
						}
					}	
			} 
			;?>
		]);

        var options = {
			width: 630,	
			height: 266,  
			colors: ['#edc240', '#9dc7e8', '#CCCCCC'],
			chartArea: {left: 30, top: 30, width: "75%", height: "70%"},
			pointSize: '4',
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}}
		};

			var chart = new google.visualization.LineChart(document.getElementById('chart1_div'));
			chart.draw(data, options);
	}
//--></script>
<script type="text/javascript"><!--
	google.load('visualization', '1', {packages: ['corechart']});
	function drawVisualization() {
   		var data = google.visualization.arrayToDataTable([
			<?php if ($sales && $filter_group == 'month') {
				echo "['" . $column_month . "','". $column_total . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear_month'] . "',". $sale['gtotal'] . "]";
						} else {
							echo "['" . $sale['gyear_month'] . "',". $sale['gtotal'] . "],";
						}
					}	
			} elseif ($sales && $filter_group == 'quarter') {
				echo "['" . $column_quarter . "','". $column_total . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear_quarter'] . "',". $sale['gtotal'] . "]";
						} else {
							echo "['" . $sale['gyear_quarter'] . "',". $sale['gtotal'] . "],";
						}
					}	
			} elseif ($sales && $filter_group == 'year') {
				echo "['" . $column_year . "','". $column_total . "'],";
					foreach ($sales as $key => $sale) {
						if (count($sales)==($key+1)) {
							echo "['" . $sale['gyear'] . "',". $sale['gtotal'] . "]";
						} else {
							echo "['" . $sale['gyear'] . "',". $sale['gtotal'] . "],";
						}
					}	
			} 
			;?>
		]);

        var options = {
			width: 630,	
			height: 266,  
			colors: ['#b5e08b', '#ed9999', '#739cc3'],
			chartArea: {left: 45, top: 30, width: "74%", height: "70%"},
			legend: {position: 'right', alignment: 'start', textStyle: {color: '#666666', fontSize: 12}},				
			seriesType: "bars",
			series: {2: {type: "line", lineWidth: '3', pointSize: '5'}}
		};

			var chart = new google.visualization.ComboChart(document.getElementById('chart2_div'));
			chart.draw(data, options);
	}
	
	google.setOnLoadCallback(drawVisualization);
//--></script>
<?php } ?>
<?php } ?>
<?php echo $footer; ?>