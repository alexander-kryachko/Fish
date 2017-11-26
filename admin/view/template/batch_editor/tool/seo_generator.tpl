<style type="text/css">
#form-seo_generator<?php echo $product_id; ?> span.seo_generator_optional {
	margin-left:10px;
}
</style>

<form id="form-seo_generator<?php echo $product_id; ?>">
 <table class="be-list">
  <thead>
   <tr>
    <td class="left" width="1"></td>
    <td class="left" width=""><?php echo $text_template; ?>:</td>
    <td class="left" width="15%"><?php echo $text_apply_to; ?>:</td>
    <td class="left" width="50"><?php echo $text_languages; ?>:</td>
    <td class="left" width="130"><?php echo $text_optional; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center" rowspan="2"></td>
    <td class="center" valign="top" rowspan="2">
     <div style="height:260px; overflow-y:scroll; margin:-5px;">
     <table class="be-list" id="table-seo_generator<?php echo $product_id; ?>" style="margin:0px; border:none;">
      <tfoot>
       <tr>
        <td class="center" width="1" height="23"><a onclick="addSeoGeneratorRow(<?php echo $product_id; ?>);"><img src="view/image/add.png" alt="<?php echo $text_add; ?>" title="<?php echo $text_add; ?>" /></a></td>
        <td class="center" colspan="2"></td>
       </tr>
      </tfoot>
     </table>
     </div>
    </td>
    <td class="left">
     <b><?php echo $text_main; ?></b>
     <div class="be-scrollbox">
      <?php foreach ($apply_to['p'] as $field) { ?>
      <div><label><input name="seo_generator[apply_to][p][]" type="checkbox" value="<?php echo $field; ?>" /> <?php echo ${'field_' . $field}; ?></label></div>
      <?php } ?>
     </div>
    </td>
    <td class="left" rowspan="2">
     <?php foreach ($languages as $language) { ?>
     <label>
      <?php if ($language['language_id'] == $language_id) { ?>
      <input name="seo_generator[language_id][]" type="radio" value="<?php echo $language['language_id']; ?>" checked="checked" />
      <?php } else { ?>
      <input name="seo_generator[language_id][]" type="radio" value="<?php echo $language['language_id']; ?>" />
      <?php } ?>
      <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />
     </label><br />
     <?php } ?>
    </td>
    <td class="left" rowspan="2">
     <label><input name="seo_generator[synonymizer]" type="checkbox" value="1" /> <?php echo $text_synonymizer; ?></label><br />
     <label><input name="seo_generator[translit]" type="checkbox" value="1" /> <?php echo $text_translit; ?></label><br />
    </td>
   </tr>
   <tr>
    <td class="left" valign="middle">
     <b><?php echo $text_description; ?></b>
     <div class="be-scrollbox">
      <?php foreach ($apply_to['pd'] as $field) { ?>
      <div><label><input name="seo_generator[apply_to][pd][]" type="checkbox" value="<?php echo $field; ?>" /> <?php echo ${'field_' . $field}; ?></label></div>
      <?php } ?>
     </div>
    </td>
   </tr>
   <tr>
    <td class="center" colspan="5"><a class="button" onclick="editTool(<?php echo $product_id; ?>, 'seo_generator', 'upd');"><?php echo $text_edit; ?></a></td>
   </tr>
   <tr>
    <td class="center"><a onclick="getTemplates('seo_generator', <?php echo $product_id; ?>);"><img src="view/batch_editor/image/button_load.png" title="<?php echo $text_load_template; ?>" alt="<?php echo $text_load_template; ?>" /></a></td>
    <td colspan="4" class="left">
     <input name="template_name" type="text" size="64" value="" />
     <a onclick="saveTemplate('seo_generator', <?php echo $product_id; ?>);"><img src="view/batch_editor/image/button_save.png" title="<?php echo $text_save_template; ?>" alt="<?php echo $text_save_template; ?>" /></a>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
var seo_generator_row = 0;

function addSeoGeneratorRow(product_id) {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center" width="1" height="23"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $text_delete; ?>" title="<?php echo $text_delete; ?>" /></a></td>';
	html += '  <td class="left" width="1%">';
	html += '   <select onchange="getSeoGeneratorData(this);">';
	html += '    <option value=""></option>';
	html += '    <option value="text"><?php echo $text_text; ?></option>';
	html += '    <option value="data"><?php echo $text_data; ?></option>';
	html += '   <select>';
	html += '  </td>';
	html += '  <td class="left"></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#form-seo_generator' + product_id + ' #table-seo_generator' + product_id + ' tfoot').before(html);
}

function getSeoGeneratorData(this_) {
	var type = $(this_).val();
	var html = '';
	
	if (type == 'text') {
		html += '<textarea name="seo_generator[data][' + seo_generator_row + '][text]" style="width:99%; height:14px;"></textarea>';
	}
	
	if (type == 'data') {
		html += '<select name="seo_generator[data][' + seo_generator_row + '][data]" onchange="getSeoGeneratorOptional(this, ' + seo_generator_row + ');" >';
		html += '<option value="product_id">{Product ID}</option>';
		<!--<?php foreach ($fields as $field) { ?>-->
		<!--<?php if ($field == 'price') { ?>-->
		<!--<?php foreach ($currencies as $currency) { ?>-->
		html += '<option value="<?php echo $field; ?>_<?php echo $currency["code"]; ?>">{<?php echo ${"field_" . $field}; ?> <?php echo $currency["code"]; ?>}</option>';
		<!--<?php } ?>-->
		<!--<?php } else { ?>-->
		html += '<option value="<?php echo $field; ?>">{<?php echo ${"field_" . $field}; ?>}</option>';
		<!--<?php } ?>-->
		<!--<?php } ?>-->
		<!--<?php foreach ($options as $option) { ?>-->
		html += '<option value="{<?php echo $option; ?>}">{<?php echo ${"text_" . $option}; ?>}</option>';
		<!--<?php } ?>-->
		html += '</select>';
	}
	
	$(this_).parent('td').next('td:first').html(html);
	
	seo_generator_row++;
}

function getSeoGeneratorOptional(this_, row) {
	$(this_).parent('td').children('span.seo_generator_optional').remove();
	
	if ($(this_).val() == '{attributes_all}') {
		var html = '<span class="seo_generator_optional">';
		
		html += '{<?php echo $text_attribute; ?>}';
		html += '<input name="seo_generator[data][' + row + '][separator_attribute_value]" type="text" size="2" value=":" title="<?php echo $text_separator; ?>" />';
		html += '<label>{<?php echo $text_value; ?>} <input name="seo_generator[data][' + row + '][value_only]" type="checkbox" value="1" /></label>';
		html += '<input name="seo_generator[data][' + row + '][separator_attribute]" type="text" size="2" value=", " title="<?php echo $text_separator; ?>" />';
		html += '</span>';
		
		$(this_).after(html);
	} else if ($(this_).val() == '{attribute}') {
		var html = '<span class="seo_generator_optional">';
		
		html += '{<input name="seo_generator[data][' + row + '][attribute_name]" type="text" />}<input name="seo_generator[data][' + row + '][attribute_id]" type="hidden" />';
		html += '<input name="seo_generator[data][' + row + '][separator_attribute_value]" type="text" size="2" value=":" title="<?php echo $text_separator; ?>" />';
		html += '<label>{<?php echo $text_value; ?>} <input name="seo_generator[data][' + row + '][value_only]" type="checkbox" value="1" /></label>';
		html += '</span>';
		
		$(this_).after(html);
		
		SeoGeneratorAttributeAutocomplete(row);
	} else if ($(this_).val() == '{categories_all}') {
		var html = '<span class="seo_generator_optional">';
		
		html += '<input name="seo_generator[data][' + row + '][separator_category]" type="text" size="2" value=", " title="<?php echo $text_separator; ?>" />';
		html += '</span>';
		
		$(this_).after(html);
	}
}

function SeoGeneratorAttributeAutocomplete(row) {
	$('#form-seo_generator<?php echo $product_id; ?> input[name=\'seo_generator[data][' + row + '][attribute_name]\']').catcomplete({
		delay: 0,
		source: function(request, response) {
			xhr = $.ajax({dataType:'json', url:'index.php?route=catalog/attribute/autocomplete&token=' + token + '&filter_name=' + encodeURIComponent(request.term),
				success: function(json) {
					response($.map(json, function(item) { return { category:item.attribute_group, label:item.name, value:item.attribute_id }}));
				}
			});
		},
		select: function(event, ui) {
			$('#form-seo_generator<?php echo $product_id; ?> input[name=\'seo_generator[data][' + row + '][attribute_name]\']').val(ui.item.label);
			$('#form-seo_generator<?php echo $product_id; ?> input[name=\'seo_generator[data][' + row + '][attribute_id]\']').val(ui.item.value);
			
			return false;
		}
	});
}
//--></script>