<style type="text/css">
.ocfilter-div-checked {
	background:#EAF7D9;
}
.ocfilter-div {
	padding:2px;
}
</style>
<script type="text/javascript"><!--
function ocFilterCheck(this_) {
	if ($(this_).prop('checked')) {
		$(this_).parents('div.ocfilter-div').addClass('ocfilter-div-checked');
	} else {
		$(this_).parents('div.ocfilter-div').removeClass('ocfilter-div-checked');
	}
}
//--></script>
<?php if ($product_id > 0) { ?>
<?php if ($data['data']) { ?>
<form id="form-ocfilter<?php echo $product_id; ?>">
 <table class="be-form">
  <tr>
   <td width="1%"><img src="<?php echo $product_image; ?>" /></td>
   <td width="99%"><h3><?php echo $product_name; ?></h3></td>
  </tr>
 </table>
 <div class="be-scrollbox" style="width:100%; height:350px;">
 <table class="be-form">
  <?php foreach ($data['data'] as $option_id=>$value) { ?>
  <tbody>
   <tr>
    <td class="left">
     <?php echo $value['name']; ?>
     <span class="be-help">[<?php echo $value['type']; ?>]</span>
    </td>
    <td class="left">
     <?php if ($value['type'] == 'checkbox' || $value['type'] == 'radio' || $value['type'] == 'select') { ?>
     <table>
      <?php foreach ($value['value'] as $value_id=>$name) { ?>
      <tr>
       <td width="40%">
        <?php if (isset ($data['product'][$option_id][$value_id])) { ?>
        <div class="ocfilter-div ocfilter-div-checked">
         <label>
          <input name="ocfilter[<?php echo $option_id; ?>][values][<?php echo $value_id; ?>][selected]" value="<?php echo $value_id; ?>" type="checkbox" onchange="ocFilterCheck(this);" checked="checked"> <?php echo $name; ?>
         </label>
        </div>
        <?php } else { ?>
        <div class="ocfilter-div">
         <label>
          <input name="ocfilter[<?php echo $option_id; ?>][values][<?php echo $value_id; ?>][selected]" value="<?php echo $value_id; ?>" type="checkbox" onchange="ocFilterCheck(this);"> <?php echo $name; ?>
         </label>
        </div>
        <?php } ?>
       </td>
       <td>
        <?php foreach ($languages as $language) { ?>
        <?php $input_value = ''; ?>
        <?php if (isset ($data['product'][$option_id][$value_id][$language['language_id']])) { ?>
        <?php $input_value = $data['product'][$option_id][$value_id][$language['language_id']]; ?>
        <?php } ?>
        <input name="ocfilter[<?php echo $option_id; ?>][values][<?php echo $value_id; ?>][description][<?php echo $language['language_id']; ?>][description]" value="<?php echo $input_value; ?>" size="30" type="text">
        <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
        <?php } ?>
       </td>
      </tr>
      <?php } ?>
     </table>
     <?php } ?>
     <?php if ($value['type'] == 'text') { ?>
     <input name="ocfilter[<?php echo $option_id; ?>][values][0][selected]" value="1" type="hidden">
     <?php foreach ($languages as $language) { ?>
     <?php $input_value = ''; ?>
     <?php if (isset ($data['product'][$option_id][0][$language['language_id']])) { ?>
     <?php $input_value = $data['product'][$option_id][0][$language['language_id']]; ?>
     <?php } ?>
     <textarea name="ocfilter[<?php echo $option_id; ?>][values][0][description][<?php echo $language['language_id']; ?>][description]" rows="2" cols="40"><?php echo $input_value; ?></textarea>
     <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
     <?php } ?>
     <?php } ?>
     <?php if ($value['type'] == 'slide' || $value['type'] == 'slide_dual') { ?>
     <table>
      <tr>
       <td width="40%">
        <input name="ocfilter[<?php echo $option_id; ?>][values][0][selected]" value="1" type="hidden">
        <?php $input_value = ''; ?>
        <?php if (isset ($data['product'][$option_id][0]['slide_value_min'])) { ?>
        <?php $input_value = $data['product'][$option_id][0]['slide_value_min']; ?>
        <?php } ?>
        <input name="ocfilter[<?php echo $option_id; ?>][values][0][slide_value_min]" value="<?php echo $input_value; ?>" size="10" type="text">
        &nbsp;—&nbsp;
        <?php $input_value = ''; ?>
        <?php if (isset ($data['product'][$option_id][0]['slide_value_max'])) { ?>
        <?php $input_value = $data['product'][$option_id][0]['slide_value_max']; ?>
        <?php } ?>
        <input name="ocfilter[<?php echo $option_id; ?>][values][0][slide_value_max]" value="<?php echo $input_value; ?>" size="10" type="text">
       </td>
       <td>
        <?php foreach ($languages as $language) { ?>
        <?php $input_value = ''; ?>
        <?php if (isset ($data['product'][$option_id][0][$language['language_id']])) { ?>
        <?php $input_value = $data['product'][$option_id][0][$language['language_id']]; ?>
        <?php } ?>
        <input name="ocfilter[<?php echo $option_id; ?>][values][0][description][<?php echo $language['language_id']; ?>][description]" value="<?php echo $input_value; ?>" size="30" type="text">
        <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
        <?php } ?>
       </td>
      </tr>
     </table>
     <?php } ?>
    </td>
   </tr>
  </tbody>
  <?php } ?>
 </table>
 </div>
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="center">
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'prev');" title="<?php echo $button_prev; ?>">&lt;</a>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'next');" title="<?php echo $button_next; ?>" style="margin-right:50px;">&gt;</a>
     <a class="button" onclick="editLink('ocfilter', 'update', <?php echo $product_id; ?>);"><?php echo $button_save; ?></a>
     <a class="button" onclick="$('#dialogLink').dialog('close');" title="<?php echo $button_close; ?>">&times;</a>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<?php } else { ?>
<div class="attention" align="center"><?php echo $text_no_results; ?></div>
<?php } ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#dialogLink').dialog({'title':'<?php echo $text_ocfilter; ?>'});
});
//--></script>
<?php } else { ?>
<form id="form-ocfilter<?php echo $product_id; ?>">
 <?php if ($product_id == -1) { ?>
 <p><span class="be-help"><label><input name="none[<?php echo $link; ?>]" type="checkbox" /> <?php echo $text_not_contain; ?> > <?php echo ${'text_' . $link}; ?></label></span></p>
 <?php } ?>
 <div style="height:300px; overflow-y:scroll; border:1px solid #CCC; margin-bottom:10px;">
  <table class="be-form"></table>
 </div>
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="center" width="1"><a onclick="addOcFilter()"><img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" /></a></td>
    <td class="center">
     <?php if ($product_id == -1) { ?>
     <a class="button" onclick="setLinkFilter('<?php echo $link; ?>');"><?php echo $button_add_to_filter; ?></a>
     <a class="button" onclick="delLinkFilter('<?php echo $link; ?>');"><?php echo $button_remove_from_filter; ?></a>
     <?php } ?>
     <?php if ($product_id == 0) { ?>
     <a class="button" onclick="editLink('ocfilter', 'insert', <?php echo $product_id; ?>);"><?php echo $button_insert_sel; ?></a>
     <a class="button" onclick="editLink('ocfilter', 'delete', <?php echo $product_id; ?>);"><?php echo $button_delete_sel; ?></a>
     <a class="button" onclick="editLink('ocfilter', 'update', <?php echo $product_id; ?>);"><?php echo $text_edit; ?></a>
     <?php } ?>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
var ocfilter_row = 0;

function addOcFilter() {
	html = '<tbody id="ocfilter-row' + ocfilter_row + '">';
	html += ' <tr>';
	html += '  <td style="width:1px;"><a onclick="$(this).parents(\'tbody\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="left" style="width:1%;">';
	html += '   <select onchange="loadOcFilterOption($(this).val(), ' + ocfilter_row + ')">';
	html += '    <option value="0"><?php echo $text_none; ?></option>';
	<?php foreach ($categories as $category) { ?>
	html += '    <option value="<?php echo $category["category_id"]; ?>"><?php echo $category["name"]; ?></option>';
	<?php } ?>
	html += '   </select>';
	html += '  </td>';
	html += '  <td class="left" id="ocfilter_option_box' + ocfilter_row + '" style="width:1%;"><input type="text" value=""></td>';
	html += '  <td class="left" id="ocfilter_value_box' + ocfilter_row + '"></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#form-ocfilter<?php echo $product_id; ?> table.be-form').append(html);
	ocFilterAutocomplete(ocfilter_row);
	
	ocfilter_row++;
}

function loadOcFilterOption(category_id, row) {
	$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_option_box' + row).html(loading);
	$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_value_box' + row).html('');
	
	if (category_id > 0) {
		$.post('index.php?route=batch_editor/data/getOcFilterOption&token=' + token, 'category_id=' + category_id + '&row=' + row, function(html) {
			$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_option_box' + row).html(html);
		});
	} else {
		$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_option_box' + row).html('<input type="text" value="">');
		ocFilterAutocomplete(row);
	}
}

function loadOcFilterValue(option_id, row) {
	$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_value_box' + row).html(loading);
	
	$.post('index.php?route=batch_editor/data/getOcFilterValue&token=' + token, 'option_id=' + option_id, function(html) {
		$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_value_box' + row).html(html);
	});
}

function ocFilterAutocomplete(row) {
	$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_option_box' + row + ' input').autocomplete({
		delay: 0,
		source: function (request, response) {
			xhr = $.ajax({url:'index.php?route=batch_editor/data/autocompleteOcFilter&token=' + token + '&filter_name=' +  encodeURIComponent(request.term), dataType:'json', success: function(json) {
				response($.map (json, function (item) {
					return { label:item.name, value: item.option_id }
				}));
			}});
		},
		select: function (event, ui) {
			$('#form-ocfilter<?php echo $product_id; ?> #ocfilter_option_box' + row + ' input').val(ui.item.label);
			loadOcFilterValue(ui.item.value, row);
			return false;
		}
	});
}
//--></script>
<?php } ?>