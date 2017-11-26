<?php echo $header; ?>
<style>
.scrollbox div {
	clear: both;
	overflow: auto;
}
.yandex-categ {
	float: right;
	width: 20px;
}

</style>
<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/feed.png" alt="" /> <?php echo $heading_title; ?></h1>
			<div class="buttons"><a class="button" id="form-submit"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
		</div>

		<div class="content">
			<div id="tabs" class="htabs">
				<a href="#tab-general"><?php echo $tab_general; ?></a>
				<a href="#tab-categories"><?php echo $tab_categories; ?></a>
				<a href="#tab-attributes"><?php echo $tab_attributes; ?></a>
				<a href="#tab-tailor"><?php echo $tab_tailor; ?></a>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	        <div id="tab-general">
			<table class="form">
				<tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="yandex_yml_status">
					<?php if ($yandex_yml_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select></td>
				</tr>
<?php /*
				<tr>
				<td><?php echo $entry_shopname; ?></td>
				<td><input name="yandex_yml_shopname" type="text" value="<?php echo $yandex_yml_shopname; ?>" size="40" maxlength="20" /></td>
				</tr>
				<tr>
				<td><?php echo $entry_company; ?></td>
				<td><input name="yandex_yml_company" type="text" value="<?php echo $yandex_yml_company; ?>" size="40" /></td>
				</tr>
*/ ?>
				<tr>
				<td><?php echo $entry_datamodel; ?></td>
				<td><select name="yandex_yml_datamodel">
				<?php foreach ($datamodels as $key=>$datamodel) { ?>
					<option value="<?php echo $key; ?>"<?php echo ($key==$yandex_yml_datamodel ? ' selected="selected"' : ''); ?>>
						<?php echo $datamodel; ?>
					</option>
				<?php } ?>
				</select>
				</td>
				</tr>
				<tr>
				<td><?php echo $entry_currency; ?></td>
				<td><select name="yandex_yml_currency">
					<?php foreach ($currencies as $currency) { ?>
					<?php if ($currency['code'] == $yandex_yml_currency) { ?>
					<option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo '(' . $currency['code'] . ') ' . $currency['title']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $currency['code']; ?>"><?php echo '(' . $currency['code'] . ') ' . $currency['title']; ?></option>
					<?php } ?>
					<?php } ?>
					</select></td>
				</tr>
                <tr>
                <td><?php echo $entry_unavailable; ?></td>
                <td><input type="checkbox" id="unavailable" name="yandex_yml_unavailable" value="1" <?php echo ($yandex_yml_unavailable ? 'checked="checked"' : ''); ?> /></td>
                </tr>
                <td><?php echo $entry_in_stock; ?></td>
                <td><select name="yandex_yml_in_stock" id="in_stock" <?php echo ($yandex_yml_unavailable ? 'disabled="disabled"' : ''); ?>>
                    <?php foreach ($stock_statuses as $stock_status) { ?>
                    <?php if ($stock_status['stock_status_id'] == $yandex_yml_in_stock) { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                    </select></td>
                </tr>
                <tr>
                <td><?php echo $entry_out_of_stock; ?></td>
                <td><select name="yandex_yml_out_of_stock">
                    <?php foreach ($stock_statuses as $stock_status) { ?>
                    <?php if ($stock_status['stock_status_id'] == $yandex_yml_out_of_stock) { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                    </select></td>
                </tr>

				<tr>
				  <td><?php echo $entry_pickup; ?></td>
				  <td><?php if ($yandex_yml_pickup) { ?>
				    <input type="radio" name="yandex_yml_pickup" value="1" checked="checked" />
				    <?php echo $text_yes; ?>
				    <input type="radio" name="yandex_yml_pickup" value="0" />
				    <?php echo $text_no; ?>
				    <?php } else { ?>
				    <input type="radio" name="yandex_yml_pickup" value="1" />
				    <?php echo $text_yes; ?>
				    <input type="radio" name="yandex_yml_pickup" value="0" checked="checked" />
				    <?php echo $text_no; ?>
				    <?php } ?></td>
				</tr>

				<tr>
				  <td><?php echo $entry_delivery_cost; ?></td>
				  <td><input type="text" name="yandex_yml_delivery_cost" value="<?php echo $yandex_yml_delivery_cost; ?>"  size="4" /></td>
				</tr>
				
				<tr>
				  <td><?php echo $entry_sales_notes; ?></td>
				  <td><input type="text" name="yandex_yml_sales_notes" value="<?php echo $yandex_yml_sales_notes; ?>"  size="40" maxlength="50" /></td>
				</tr>

				<tr>
				  <td><?php echo $entry_store; ?></td>
				  <td><?php if ($yandex_yml_store) { ?>
				    <input type="radio" name="yandex_yml_store" value="1" checked="checked" />
				    <?php echo $text_yes; ?>
				    <input type="radio" name="yandex_yml_store" value="0" />
				    <?php echo $text_no; ?>
				    <?php } else { ?>
				    <input type="radio" name="yandex_yml_store" value="1" />
				    <?php echo $text_yes; ?>
				    <input type="radio" name="yandex_yml_store" value="0" checked="checked" />
				    <?php echo $text_no; ?>
				    <?php } ?></td>
				</tr>
				
				<tr>
				  <td><?php echo $entry_utmsource; ?></td>
				  <td><input type="text" name="yandex_yml_utmsource" value="<?php echo $yandex_yml_utmsource; ?>"  size="12" maxlength="20" /></td>
				</tr>
				
				<tr>
				  <td><?php echo $entry_numpictures; ?></td>
				  <td><input type="text" name="yandex_yml_numpictures" value="<?php echo $yandex_yml_numpictures; ?>"  size="4" maxlength="4" /></td>
				</tr>
				
				<tr>
				<td><?php echo $entry_data_feed; ?></td>
				<td><b><?php echo $data_feed; ?></b></td>
				</tr>

				<tr>
				<td><?php echo $entry_cron_run; ?></td>
				<td><b><?php echo $cron_path; ?></b></td>
				</tr>
				<tr>
				<td><?php echo $entry_export_url; ?></td>
				<td><b><?php echo $export_url; ?></b></td>
				</tr>

			</table>
			</div>

	        <div id="tab-categories">
			<table class="form">
				<tr>
				<td><?php echo $entry_category; ?></td>
				<td><div class="scrollbox" style="height: 400px; overflow-x: auto; width: 100%;">
					<?php $class = 'odd'; ?>
					<?php foreach ($categories as $category) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($category['category_id'], $yandex_yml_categories)) { ?>
						<input type="checkbox" name="yandex_yml_categories[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
						<?php echo $category['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="yandex_yml_categories[]" value="<?php echo $category['category_id']; ?>" />
						<?php echo $category['name']; ?>
						<?php } ?>
						
						<input type="text" name="yandex_yml_categ_mapping[<?php echo $category['category_id']; ?>]" value="<?php echo (isset($yandex_yml_categ_mapping[$category['category_id']]) ? $yandex_yml_categ_mapping[$category['category_id']] : ''); ?>" class="yandex-categ" />
					</div>
					<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
				
				<tr>
				<td><?php echo $entry_manufacturers; ?></td>
				<td><div class="scrollbox" style="height: 200px;">
					<?php $class = 'odd'; $attr_group_id = -1; ?>
					<?php foreach ($manufacturers as $manufacturer) {
						$class = ($class == 'even' ? 'odd' : 'even');
					?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($manufacturer['manufacturer_id'], $yandex_yml_manufacturers)) { ?>
						<input type="checkbox" name="yandex_yml_manufacturers[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" checked="checked" />
						<?php echo $manufacturer['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="yandex_yml_manufacturers[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
						<?php echo $manufacturer['name']; ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>				

		        <tr>
		          <td>&nbsp;</td>
		          <td><input type="text" name="yandex_yml_product_blacklist" value="" /></td>
		        </tr>

		        <tr>
		          <td><?php echo $entry_blacklist_type; ?></td>
		          <td><select name="yandex_yml_blacklist_type" id="blacklist-type-select">
						<option value="black"<?php echo ($blacklist_type == 'black' ? ' selected' : ''); ?>><?php echo $text_blacklist; ?></option>
						<option value="white"<?php echo ($blacklist_type == 'white' ? ' selected' : ''); ?>><?php echo $text_whitelist; ?></option>
					  </select>
		          </td>
		        </tr>
		        <tr>
		          <td><div id="blacklist-product-label"><?php echo $entry_blacklist; ?></div>
		              <div id="whitelist-product-label"><?php echo $entry_whitelist; ?></div>
		          </td>
		          <td><div id="blacklist-product" class="scrollbox" style="height: 200px;">
		              <?php $class = 'odd'; ?>
		              <?php foreach ($blacklist as $product_bl) { ?>
		              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
		              <div id="blacklist-product<?php echo $product_bl['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_bl['name']; ?><img src="view/image/delete.png" />
		                <input type="hidden" name="yandex_yml_blacklist[]" value="<?php echo $product_bl['product_id']; ?>" />
		              </div>
		              <?php } ?>
		            </div></td>
		        </tr>

			</table>
			</div>

			<div id="tab-attributes">
			<table class="form">
				<tr>
				<td colspan="2"><?php echo $tab_attributes_description; ?></td>
				</tr>
				<tr>
				<td><?php echo $entry_attributes; ?></td>
				<td><div class="scrollbox" style="height: 200px;">
					<?php $class = 'odd'; $attr_group_id = -1; ?>
					<?php foreach ($attributes as $attribute) {
						if ($attr_group_id != $attribute['attribute_group_id']) {
							echo '<div><b>'.$attribute['attribute_group'].'</b></div>';
							$attr_group_id = $attribute['attribute_group_id'];
							$class = 'even';
						}
						$class = ($class == 'even' ? 'odd' : 'even');
					?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($attribute['attribute_id'], $yandex_yml_attributes)) { ?>
						<input type="checkbox" name="yandex_yml_attributes[]" value="<?php echo $attribute['attribute_id']; ?>" checked="checked" />
						<?php echo $attribute['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="yandex_yml_attributes[]" value="<?php echo $attribute['attribute_id']; ?>" />
						<?php echo $attribute['name']; ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
				<tr>
				<td><?php echo $entry_adult; ?></td>
				<td><select name="yandex_yml_adult">
					<option value="0"><?php echo $text_no; ?></option>
					<?php
					$attr_group_id = -1;
					foreach ($attributes as $key=>$attribute) {
						if ($attr_group_id != $attribute['attribute_group_id']) {
							echo '<optgroup label="'.$attribute['attribute_group'].'">';
							$attr_group_id = $attribute['attribute_group_id'];
						}
						echo '<option value="'.$attribute['attribute_id'].'"'.($yandex_yml_adult == $attribute['attribute_id'] ? ' selected="selected"' : '').'>'.$attribute['name'].'</option>';
						if (!isset($attributes[$key+1]) || ($attr_group_id != $attributes[$key+1]['attribute_group_id'])) {
							echo '</optgroup>';
						}
					}
					?>
					</select>
				</tr>
				<tr>
				<td><?php echo $entry_manufacturer_warranty; ?></td>
				<td><select name="yandex_yml_manufacturer_warranty">
					<option value="0"><?php echo $text_no; ?></option>
					<?php
					$attr_group_id = -1;
					foreach ($attributes as $key=>$attribute) {
						if ($attr_group_id != $attribute['attribute_group_id']) {
							echo '<optgroup label="'.$attribute['attribute_group'].'">';
							$attr_group_id = $attribute['attribute_group_id'];
						}
						echo '<option value="'.$attribute['attribute_id'].'"'.($yandex_yml_manufacturer_warranty == $attribute['attribute_id'] ? ' selected="selected"' : '').'>'.$attribute['name'].'</option>';
						if (!isset($attributes[$key+1]) || ($attr_group_id != $attributes[$key+1]['attribute_group_id'])) {
							echo '</optgroup>';
						}
					}
					?>
					</select>
				</tr>
				<tr>
				<td><?php echo $entry_country_of_origin; ?></td>
				<td><select name="yandex_yml_country_of_origin">
					<option value="0"><?php echo $text_no; ?></option>
					<?php
					$attr_group_id = -1;
					foreach ($attributes as $key=>$attribute) {
						if ($attr_group_id != $attribute['attribute_group_id']) {
							echo '<optgroup label="'.$attribute['attribute_group'].'">';
							$attr_group_id = $attribute['attribute_group_id'];
						}
						echo '<option value="'.$attribute['attribute_id'].'"'.($yandex_yml_country_of_origin == $attribute['attribute_id'] ? ' selected="selected"' : '').'>'.$attribute['name'].'</option>';
						if (!isset($attributes[$key+1]) || ($attr_group_id != $attributes[$key+1]['attribute_group_id'])) {
							echo '</optgroup>';
						}
					}
					?>
					</select>
				</tr>
				<tr>
					<td><?php echo $entry_attr_vs_description; ?></td>
					<td><input type="checkbox" name="yandex_yml_attr_vs_description"<?php echo ($yandex_yml_attr_vs_description ? ' checked="checked"' : ''); ?>/></td>
				</tr>
			</table>
			</div>
	        <div id="tab-tailor">
			<table class="form">
				<tr>
				<td colspan="2"><?php echo $tab_tailor_description; ?></td>
				</tr>
				
				<tr>
				<td><?php echo $entry_color_option; ?></td>
				<td><div class="scrollbox" style="height: 100px; overflow-x: auto; width: 100%;">
					<?php $class = 'odd'; ?>
					<?php foreach ($options as $option) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($option['option_id'], $yandex_yml_color_options)) { ?>
						<input type="checkbox" name="yandex_yml_color_options[]" value="<?php echo $option['option_id']; ?>" checked="checked" />
						<?php echo $option['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="yandex_yml_color_options[]" value="<?php echo $option['option_id']; ?>" />
						<?php echo $option['name']; ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
				
				<tr>
				<td><?php echo $entry_size_option; ?><br/><?php echo $entry_size_unit; ?></td>
				<td><div class="scrollbox" style="height: 160px; overflow-x: auto; width: 100%;">
					<?php $class = 'odd'; ?>
					<?php foreach ($options as $option) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($option['option_id'], $yandex_yml_size_options)) { ?>
						<input type="checkbox" name="yandex_yml_size_options[]" value="<?php echo $option['option_id']; ?>" checked="checked" />
						<?php echo $option['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="yandex_yml_size_options[]" value="<?php echo $option['option_id']; ?>" />
						<?php echo $option['name']; ?>
						<?php } ?>
						
		                <select name="yandex_yml_size_units[<?php echo $option['option_id']; ?>]" style="float:right;">
       						<?php $yandex_yml_size_unit = (isset($yandex_yml_size_units[$option['option_id']]) ? $yandex_yml_size_units[$option['option_id']] : ''); ?>
							<option value="" <?php echo ($yandex_yml_size_unit == '' ? ' selected="selected"' : ''); ?>><?php echo $text_no; ?></option>
		                    <?php foreach ($size_units_orig as $key=>$item) { ?>
				                <option value="<?php echo $key; ?>" <?php echo ($yandex_yml_size_unit == $key ? ' selected="selected"' : ''); ?>><?php echo $item; ?></option>
		                    <?php } ?>
		                    <?php foreach ($size_units_type as $key=>$item) { ?>
				                <option value="<?php echo $key; ?>" <?php echo ($yandex_yml_size_unit == $key ? ' selected="selected"' : ''); ?>><?php echo $item; ?></option>
		                    <?php } ?>
		                </select>
					</div>
					<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
								
				<tr>
				  <td><?php echo $entry_optioned_name; ?></td>
				  <td>
				  	<input type="radio" name="yandex_yml_optioned_name" value="no" <?php echo (!$yandex_yml_optioned_name || ($yandex_yml_optioned_name == 'no') ? ' checked="checked"' : ''); ?>>
				  		<?php echo $optioned_name_no; ?><br />
				  	<input type="radio" name="yandex_yml_optioned_name" value="short" <?php echo ($yandex_yml_optioned_name == 'short' ? ' checked="checked"' : ''); ?>>
				  		<?php echo $optioned_name_short; ?><br />
				  	<input type="radio" name="yandex_yml_optioned_name" value="long" <?php echo ($yandex_yml_optioned_name == 'long' ? ' checked="checked"' : ''); ?>>
				  		<?php echo $optioned_name_long; ?>
				  </td>
				</tr>				
			</table>
			</div>
			<input type="submit" id="submitting_submit" style="display: none;" />
			</form>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('#tabs a').tabs();

$('#form-submit').click(function() {
	$('.yandex-categ').each(function() {
		if ($(this).val() == '')
			$(this).attr('disabled', 'disabled');
	})
	$('#submitting_submit').trigger('click');
});

// Options autocomplete
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

$('#unavailable').change(function() {
	if ($(this).attr('checked')) {
		$('#in_stock').attr('disabled', 'disabled');
	}
	else {
		$('#in_stock').attr('disabled', false);
		$(this).removeAttr('disabled');
	}
})

$('.yandex-categ').each(function() {
	if ($(this).val() != '') {
		$(this).css('width','96%');
	}
})

$('.yandex-categ').focus(function() {
	$(this).css('width','96%');
	//$(this).trigger('change');
});
$('.yandex-categ').blur(function() {
	if (!$(this).val()) {
		$(this).css('width','20px');
	}
});

$('.yandex-categ').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=feed/yandex_yml/autocomplete&token=<?php echo $token; ?>&text=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response(json);
			}
		});
		
	}, 
	select: function(event, ui) {
		$(this).val(ui.item.value);
		return false;
	},
	focus: function(event, ui) {
		$(this).val(ui.item.value);
		return false;
	}
});


var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-42296537-1']);
_gaq.push(['_setDomainName', 'opencartforum.ru']);
_gaq.push(['_setAllowLinker', true]);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

$('#blacklist-type-select').change(function() {
	if ($(this).val() == 'black') {
		$('#blacklist-product-label').show();
		$('#whitelist-product-label').hide();
	}
	else {
		$('#whitelist-product-label').show();
		$('#blacklist-product-label').hide();
	}
})
$('#blacklist-type-select').trigger('change');

$('input[name="yandex_yml_product_blacklist"]').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#blacklist-product' + ui.item.value).remove();
		
		$('#blacklist-product').append('<div id="blacklist-product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="yandex_yml_blacklist[]" value="' + ui.item.value + '" /></div>');

		$('#coupon-product div:odd').attr('class', 'odd');
		$('#coupon-product div:even').attr('class', 'even');
		
		$('input[name="yandex_yml_product_blacklist"]').val('');
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#blacklist-product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#blacklist-product div:odd').attr('class', 'odd');
	$('#blacklist-product div:even').attr('class', 'even');	
});
//--></script> 
<?php echo $footer; ?>
