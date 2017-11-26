<style type="text/css">
#form-option_price<?php echo $product_id; ?> input {
	width:40px;
}
</style>

<form id="form-option_price<?php echo $product_id; ?>">
 <table class="be-list" id="table-option_price<?php echo $product_id; ?>">
  <thead>
   <tr>
    <td class="center" rowspan="2" width="1"></td>
    <td class="center" rowspan="2"><?php echo $text_action; ?>:</td>
    <td class="center" colspan="10"><?php echo $text_condition; ?>:</td>
   </tr>
   <tr>
    <td class="center" width="10%"><?php echo $field_option_id; ?>:</td>
    <td class="center" width="10%"><?php echo $field_option_value_id; ?>:</td>
    <td class="center"><?php echo $field_subtract; ?>:</td>
    <td class="center"><?php echo $field_quantity; ?>:</td>
    <td class="center" colspan="2"><?php echo $field_price; ?>:</td>
    <td class="center" colspan="2"><?php echo $field_points; ?>:</td>
    <td class="center" colspan="2"><?php echo $field_weight; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center"><a onclick="addOptionPriceRow(<?php echo $product_id; ?>);"><img src="view/image/add.png" alt="<?php echo $text_add; ?>" title="<?php echo $text_add; ?>" /></a></td>
    <td class="center" colspan="11"><a class="button" onclick="editTool(<?php echo $product_id; ?>, 'option_price', 'upd');"><?php echo $text_edit; ?></a></td>
   </tr>
  </tfoot>
 </table>
</form>

<script type="text/javascript"><!--
var option_price_row = 0;

function addOptionPriceRow(product_id) {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	
	html += '  <td class="center"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $text_delete; ?>" title="<?php echo $text_delete; ?>" /></a></td>';
	
	html += '  <td class="center">';
	html += '   <select name="option_price[data][' + option_price_row + '][action]">';
	<!--<?php foreach ($actions as $action) { ?>-->
	html += '    <option value="<?php echo $action["action"]; ?>"><?php echo $action["name"]; ?></option>';
	<!--<?php } ?>-->
	html += '   </select>';
	html += '   <input name="option_price[data][' + option_price_row + '][value]" type="text" value="" />';
	html += '  </td>';
	
	html += '  <td class="center">';
	html += '   <select name="option_price[data][' + option_price_row + '][option_id]" onchange="getOptionPriceOptionValue(this, ' + option_price_row + ');">';
	html += '   <option value=""><?php echo $text_none; ?></option>';
	<?php foreach ($options as $option) { ?>
	html += '   <option value="<?php echo $option["option_id"]; ?>"><?php echo $option["name"]; ?></option>';
	<?php } ?>
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">';
	html += '   <select name="option_price[data][' + option_price_row + '][option_value_id]">';
	html += '    <option value=""><?php echo $text_none; ?></option>';
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">';
	html += '   <select name="option_price[data][' + option_price_row + '][subtract]">';
	html += '    <option value=""></option>';
	html += '    <option value="1"><?php echo $text_yes; ?></option>';
	html += '    <option value="0"><?php echo $text_no; ?></option>';
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">&gt;<input name="option_price[data][' + option_price_row + '][quantity_min]" type="text" />&mdash;<input name="option_price[data][' + option_price_row + '][quantity_max]" type="text" />&lt;</td>';
	
	html += '  <td class="center" width="1">';
	html += '   <select name="option_price[data][' + option_price_row + '][price_prefix]">';
	html += '    <option value=""></option>';
	<!--<?php foreach ($option_price_prefix as $price_prefix) { ?>-->
	html += '    <option value="<?php echo $price_prefix["value"]; ?>"><?php echo $price_prefix["name"]; ?></option>';
	<!--<?php } ?>-->
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">&gt;<input name="option_price[data][' + option_price_row + '][price_min]" type="text" />&mdash;<input name="option_price[data][' + option_price_row + '][price_max]" type="text" />&lt;</td>';
	
	html += '  <td class="center" width="1">';
	html += '   <select name="option_price[data][' + option_price_row + '][points_prefix]">';
	html += '    <option value=""></option>';
	html += '    <option value="+">+</option>';
	html += '    <option value="-">-</option>';
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">&gt;<input name="option_price[data][' + option_price_row + '][points_min]" type="text" />&mdash;<input name="option_price[data][' + option_price_row + '][points_max]" type="text" />&lt;</td>';
	
	html += '  <td class="center" width="1">';
	html += '   <select name="option_price[data][' + option_price_row + '][weight_prefix]">';
	html += '    <option value=""></option>';
	html += '    <option value="+">+</option>';
	html += '    <option value="-">-</option>';
	html += '   </select>';
	html += '  </td>';
	
	html += '  <td class="center">&gt;<input name="option_price[data][' + option_price_row + '][weight_min]" type="text" />&mdash;<input name="option_price[data][' + option_price_row + '][weight_max]" type="text" />&lt;</td>';
	
	html += ' </tr>';
	html += '</tbody>';
	
	$('#form-option_price' + product_id + ' #table-option_price' + product_id + ' tfoot').before(html);
	
	option_price_row++;
}

function getOptionPriceOptionValue(this_, row) {
	var td = $(this_).parent('td').next('td:first');
	
	xhr = $.ajax({type:'POST', dataType:'json', data:'option_id=' + $(this_).val(), url:'index.php?route=batch_editor/data/getOptionValues&token=' + token,
		beforeSend: function() { td.html(loading); },
		success: function(json) {
			var html = '';
			
			html += '<select name="option_price[data][' + row + '][option_value_id]">';
			html += ' <option value=""><?php echo $text_none; ?></option>';
			
			$.each(json, function (index, value) {
				html += ' <option value="' + value['option_value_id'] + '">' + value['name'] + '</option>';
			});
			
			html += '</select>';
			
			td.html(html);
		}
	});
}

//--></script>