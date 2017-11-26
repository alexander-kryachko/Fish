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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>


<script type="text/javascript">
<!--
function googleTaxonomy() {
	if (document.form.google_product_feed_lang.value == 'ch-US') {
		var href='http://www.google.com/basepages/producttype/taxonomy.en-US.txt';
	} else {
		var href='http://www.google.com/basepages/producttype/taxonomy.' + document.form.google_product_feed_lang.value + '.txt';
	}
	window.open(href,"GoogleTaxonomy");
}
</script>

<script type="text/javascript">
<!--
function viewFeed() {
	var href='<?php echo $view_feed; ?>'
	window.open(href,"GoogleProductFeed");
}
</script>

<script type="text/javascript">
<!--
function copyData() {
	var r = confirm('<?php echo $alert_copy_data; ?>');
	if(r==true) {
		document.form.copy_data.value = "1";
		$('#form').submit();
	}
}
</script>

<script type="text/javascript">
<!--
function enableAllProducts() {
	var r = confirm('<?php echo $alert_enable; ?>');
	if (r == true) {
		document.form.enable_all_products.value = "1";
		$('#form').submit();
	}
}
</script>

<script type="text/javascript">
<!--
function disableAllProducts() {
	var r = confirm('<?php echo $alert_disable; ?>');
	if (r == true) {
		document.form.enable_all_products.value = "2";
		$('#form').submit();
	}
}
</script>


<div class="box">
  <div class="heading">
    <h1><img src="view/image/feed.png"><?php echo $heading_title; ?></h1>
    <div class="buttons"> 
				<?php if ($gpf_defaults_saved == '1') { ?>
				<a onclick="location = '<?php echo $bulk_update; ?>';" class="button"><span><?php echo $button_bulk_update; ?></span></a>
				<?php } ?>
				<a onclick="viewFeed()" class="button"><span><?php echo $button_view_feed; ?></span></a>
				<a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a>
				<a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a>
		
	</div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="form">
	  <input type="hidden" name="copy_data" value="0" />
	  <input type="hidden" name="enable_all_products" value="0" />
      <table class="form">
	  
		
				<tr>
				  <td width = "40%"><?php echo $text_general; ?></td>
				  <td width = "60%"></td>
				</tr>
				<tr>
				  <td width = "40%"><?php echo $entry_status; ?></td>
				  <td width = "60%"><select name="google_product_feed_status">
					  <?php if ($google_product_feed_status) { ?>
					  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					  <option value="0"><?php echo $text_disabled; ?></option>
					  <?php } else { ?>
					  <option value="1"><?php echo $text_enabled; ?></option>
					  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					  <?php } ?>
					</select></td>
				</tr>
				<tr>
				  <td><?php echo $entry_enable_all_products; ?></td>
				  <td>    <div class="buttons"> 
						<a onclick="enableAllProducts()" class="button"><span><?php echo $button_enable_all_products; ?></span></a>
						<a onclick="disableAllProducts()" class="button"><span><?php echo $button_disable_all_products; ?></span></a>
						</div>
					</td>
				</tr>
				<tr>
				  <td><?php echo $entry_data_feed; ?></td>
				  <td><textarea cols="110" rows="4"><?php echo $data_feed; ?></textarea>			  
				  </td>
				</tr>
				<tr>
				  <td><?php echo $entry_currency; ?></td>
				  <td><select name="google_product_feed_currency">
					  <?php foreach($currencies as $currency) { ?>
					  <?php if ($google_product_feed_currency == $currency) { ?>
					  <option value="<?php echo $currency; ?>" selected="selected"><?php echo $currency; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select></td>
				</tr>
				<tr>
				  <td><?php echo $entry_language; ?></td>
				  <td><select name="google_product_feed_lang">
					  <?php foreach($languages as $language) { ?>
					  <?php if ($google_product_feed_lang == $language['value']) { ?>
					  <option value="<?php echo $language['value']; ?>" selected="selected"><?php echo $language['selection']; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $language['value']; ?>"><?php echo $language['selection']; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				</tr>
				 <tr>
					<td><?php echo $entry_default_google_product_category; ?></td>
					<td><input type="text" name="default_google_product_category" style="width:400px;" value="<?php echo $default_google_product_category; ?>" />
					<a onclick = "googleTaxonomy()" title="click here to select a default category">
					<img src="view/image/plus.png" width="16" height=" 16"style=" margin: 15px 15px 0;"></a><br /><br />
					</td>
				  </tr>
				  <tr>
					<td><?php echo $entry_condition; ?></td>
					<td><select name="condition" style="float: left; margin-right: 50px;">
					  <?php foreach($available_conditions as $av_cond) { ?>
					  <?php if ($condition == $av_cond) { ?>
					  <option value="<?php echo $av_cond; ?>" selected="selected"><?php echo $av_cond; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $av_cond; ?>"><?php echo $av_cond; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				  </tr>
				  <tr>
					<td><?php echo $entry_oos_status; ?></td>
					<td><select name="oos_status" style="float: left; margin-right: 50px;">
					  <?php foreach($available_oos_statuses as $av_oos) { ?>
					  <?php if ($oos_status == $av_oos) { ?>
					  <option value="<?php echo $av_oos; ?>" selected="selected"><?php echo $av_oos; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $av_oos; ?>"><?php echo $av_oos; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				  </tr>
				  <tr>
					<td><?php echo $entry_size_system; ?></td>
					<td><select name="gpf_size_system" style="float: left; margin-right: 50px;">
					  <?php foreach($available_size_systems as $av_ss) { ?>
					  <?php if ($gpf_size_system == $av_ss) { ?>
					  <option value="<?php echo $av_ss; ?>" selected="selected"><?php echo $av_ss; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $av_ss; ?>"><?php echo $av_ss; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				  </tr>
				  <tr>
					<td><?php echo $entry_identifier_exists; ?></td>
					<td><select name="identifier_exists" style="float: left; margin-right: 50px;">
					  
					  <?php if ($identifier_exists == 'FALSE') { ?>
						  <option value="TRUE"><?php echo $text_true; ?></option>
						  <option value="FALSE" selected="selected"><?php echo $text_false; ?></option>
					  <?php } else { ?>
						  <option value="TRUE" selected="selected"><?php echo $text_true; ?></option>
						  <option value="FALSE"><?php echo $text_false; ?></option>
					  <?php } ?>
					</select>
					</td>
				  </tr>
				 <tr>
					<td><?php echo $entry_gpf_mobile_url; ?></td>
					<td><input type="text" name="gpf_mobile_url" style="width:400px;" value="<?php echo $gpf_mobile_url; ?>" />
					</td>
				  </tr>
				<tr>
				  <td><?php echo $entry_copy_manufacturer; ?></td>
				  <td><select name="google_product_feed_copy_manufacturer" style="float: left; margin-right: 50px;">
					  <?php foreach($yes_no as $y_n) { ?>
					  <?php if ($google_product_feed_copy_manufacturer == $y_n) { ?>
					  <option value="<?php echo $y_n; ?>" selected="selected"><?php echo $y_n; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $y_n; ?>"><?php echo $y_n; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				</tr>
				 <tr>
					<td><?php echo $text_custom_labels; ?></td>
					<td>&nbsp;
					</td>
				  </tr>
			<?php for($i=0; $i<=4; $i++) { ?>
				 <tr>
					<td><?php echo $entry_custom_label . $i . ':' . $text_custom_labels_help; ?></td>
					<td>
						<?php echo $text_custom_labels_group; ?><br />
						<input type="text" name="custom_labels_group[<?php echo $i; ?>]" value="<?php echo $custom_labels_group[$i]; ?>" style="width: 250px;" /><br />
						<?php echo $entry_custom_labels; ?><br />
						<textarea name="custom_labels[<?php echo $i; ?>]" rows="5" cols="100"><?php echo $custom_labels[$i]; ?></textarea>
					</td>
				  </tr>
			<?php } ?>
				 <tr>
					<td><?php echo $text_copy; ?></td>
					<td>&nbsp;
					</td>
				  </tr>
				<tr>
				  <td><?php echo $entry_copy_fields; ?></td>
              <td><div class="scrollbox" style="height: 120px">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($fields as $field) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <input type="checkbox" name="copy_field[]" value="<?php echo $field; ?>" />
                    <?php echo $field; ?>
                  </div>
                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
				 <tr>
					<td><?php echo $entry_replace_av_for_order; ?></td>
					<td>
                    <input type="checkbox" name="replace_av_for_order" value="1" />
					</td>
				  </tr>
				<tr>
				  <td><?php echo $entry_copy_gtin; ?></td>
				  <td><select name="google_product_feed_copy_gtin" style="float: left; margin-right: 50px;">
					  <?php foreach($original_gtin as $gtin) { ?>
					  <?php if ($google_product_feed_copy_gtin == $gtin) { ?>
					  <option value="<?php echo $gtin; ?>" selected="selected"><?php echo $gtin; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $gtin; ?>"><?php echo $gtin; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				</tr>
				<tr>
				  <td><?php echo $entry_copy_mpn; ?></td>
				  <td><select name="google_product_feed_copy_mpn" style="float: left; margin-right: 50px;">
					  <?php foreach($original_mpn as $mpn) { ?>
					  <?php if ($google_product_feed_copy_mpn == $mpn) { ?>
					  <option value="<?php echo $mpn; ?>" selected="selected"><?php echo $mpn; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $mpn; ?>"><?php echo $mpn; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select>
					</td>
				</tr>
				<tr>
				  <td><?php echo $entry_copy_to; ?></td>
				  <td><select name="google_product_feed_copy_to" style="float: left; margin-right: 50px;">
					  <?php foreach($copy_options as $option) { ?>
					  <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
					  <?php } ?>
					</select>
					
					</td>
				</tr>
				<tr>
				  <td></td>
				  <td><div class="buttons"><a onclick="copyData()" class="button"><span><?php echo $button_copy_data; ?></span></a></div></td>
				</tr>
				 <tr>
					<td>&nbsp;</td>
					<td>    
					</td>
				  </tr>
				  <tr>
					<td colspan="2"><?php echo $entry_troubleshooting; ?></td>
				  </tr>
				  <tr>
					<td colspan="2" style="background: #ffffcc;"><?php echo $entry_information; ?></td>
				  </tr>
			
      </table>
    </form>
  </div>
</div>
</div>


<?php echo $footer; ?>