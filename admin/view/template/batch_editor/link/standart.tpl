<form id="form-<?php echo $link; ?><?php echo $product_id; ?>">
 <?php if ($product_id == -1) { ?>
 <div class="notice"><?php echo $notice_empty_field; ?></div>
 <p><span class="be-help"><label><input name="none[<?php echo $link; ?>]" type="checkbox" /> <?php echo $text_not_contain; ?> > <?php echo ${'text_' . $link}; ?></label></span></p>
 <?php } ?>
 <?php if ($product_id > 0) { ?>
 <table class="be-form">
  <tr>
   <td width="1%"><img src="<?php echo $product_image; ?>" /></td>
   <td width="99%"><h3><?php echo $product_name; ?></h3></td>
  </tr>
 </table>
 <?php } ?>
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="1"></td>
    <?php foreach ($fields as $field => $setting) { ?>
    <?php if ($field != 'product_id') { ?>
    <?php if ($setting['extra'] == 'auto_increment') { ?>
    <td class="center" width="1%"><?php echo ${'field_' . $field}; ?></td>
    <?php } else { ?>
    <td class="left"><?php echo ${'field_' . $field}; ?></td>
    <?php } ?>
    <?php } ?>
    <?php } ?>
   </tr>
  </thead>
  <?php $row = 0; ?>
  <?php if ($data) { ?>
  <?php foreach ($data as $array) { ?>
  <tbody>
   <tr>
    <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>
    <?php foreach ($array as $field => $value) { ?>
    <?php if (isset ($fields[$field]) && $field != 'product_id') { ?>
    <?php if ($fields[$field]['type'] == 'text') { ?>
    <td class="left"><textarea name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]"><?php echo $value; ?></textarea></td>
    <?php } else if ($fields[$field]['type'] == 'tinyint') { ?>
    <?php if ($value) { ?>
    <td class="left enabled">
    <?php } else { ?>
    <td class="left disabled">
    <?php } ?>
     <?php if (preg_match ('/status/', $field)) { ?>
     <select name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" onchange="selectTableTd(this);">
      <?php if ($value) { ?>
      <option value="0"><?php echo $text_disabled; ?></option>
      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
      <?php } else { ?>
      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
      <option value="1"><?php echo $text_enabled; ?></option>
      <?php } ?>
     </select>
     <?php } else { ?>
     <select name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" onchange="selectTableTd(this);">
      <?php if ($value) { ?>
      <option value="0"><?php echo $text_no; ?></option>
      <option value="1" selected="selected"><?php echo $text_yes; ?></option>
      <?php } else { ?>
      <option value="0" selected="selected"><?php echo $text_no; ?></option>
      <option value="1"><?php echo $text_yes; ?></option>
      <?php } ?>
     </select>
     <?php } ?>
    </td>
    <?php } else if (isset ($list[$field])) { ?>
    <td class="left">
     <select name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" >
      <?php foreach ($list[$field] as $value_temp) { ?>
      <?php if ($value_temp[$field] == $value) { ?>
      <option value="<?php echo $value_temp[$field]; ?>" selected="selected"><?php echo $value_temp['name']; ?></option>
      <?php } else { ?>
      <option value="<?php echo $value_temp[$field]; ?>"><?php echo $value_temp['name']; ?></option>
      <?php } ?>
      <?php } ?>
     </select>
    </td>
    <?php } else { ?>
    <?php $class = ''; ?>
    <?php if ($fields[$field]['type'] == 'date') { ?>
    <?php $class = 'date'; ?>
    <?php } ?>
    <?php if ($fields[$field]['type'] == 'datetime') { ?>
    <?php $class = 'datetime'; ?>
    <?php } ?>
    <?php if ($fields[$field]['extra'] == 'auto_increment') { ?>
    <td class="center"><b><?php echo $value; ?></b><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" value="<?php echo $value; ?>" class="<?php echo $class; ?>" type="hidden" /></td>
    <?php } else { ?>
    <td class="left"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" value="<?php echo $value; ?>" class="<?php echo $class; ?>" type="text" /></td>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
   </tr>
   <?php $row++; ?>
  </tbody>
  <?php } ?>
  <?php } else { ?>
  <tbody class="no_results">
   <tr>
    <td class="center" colspan="<?php echo count ($fields); ?>"><div class="attention" align="center"><?php echo $text_no_results; ?></div></td>
   </tr>
  </tbody>
  <?php } ?>
  <tfoot>
   <tr>
    <td class="center"><a onclick="add<?php echo $link; ?>Row(<?php echo $product_id; ?>);"><img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" /></a></td>
    <td class="center" colspan="<?php echo count ($fields); ?>">
     <?php if ($product_id > -1) { ?>
     <input id="product-copy-data-product_name-<?php echo $product_id; ?>" type="text" />
     <input id="product-copy-data-product_id-<?php echo $product_id; ?>" type="hidden" />
     <a class="button" onclick="copyProductData('<?php echo $product_id; ?>', '<?php echo $link; ?>');" style="margin-right:50px;"><?php echo $button_copy; ?></a>
     <?php } ?>
     <?php if ($product_id == -1) { ?>
     <a class="button" onclick="setLinkFilter('<?php echo $link; ?>');"><?php echo $button_add_to_filter; ?></a>
     <a class="button" onclick="delLinkFilter('<?php echo $link; ?>');"><?php echo $button_remove_from_filter; ?></a>
     <?php } ?>
     <?php if ($product_id == 0) { ?>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'add', <?php echo $product_id; ?>);"><?php echo $button_insert_sel; ?></a>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'del', <?php echo $product_id; ?>);"><?php echo $button_delete_sel; ?></a>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'upd', <?php echo $product_id; ?>);"><?php echo $text_edit; ?></a>
     <?php } ?>
     <?php if ($product_id > 0) { ?>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'prev');" title="<?php echo $button_prev; ?>">&lt;</a>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'next');" title="<?php echo $button_next; ?>" style="margin-right:50px;">&gt;</a>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'upd', <?php echo $product_id; ?>);"><?php echo $button_save; ?></a>
     <a class="button" onclick="$('#dialogLink').dialog('close');" title="<?php echo $button_close; ?>">&times;</a>
     <?php } ?>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
creatDateTime();

if (typeof <?php echo $link; ?>_row == 'undefined') {
	var <?php echo $link; ?>_row = [];
}

<?php echo $link; ?>_row[<?php echo $product_id; ?>] = <?php echo $row; ?>;

if (typeof add<?php echo $link; ?>Row == 'undefined') {
	function add<?php echo $link; ?>Row(product_id) {
		$('#form-<?php echo $link; ?>' + product_id + ' .be-list .no_results').remove();
		
		var html = '';
		
		html += '<tbody>';
		html += ' <tr>';
		html += '  <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>';
		
		<?php foreach ($fields as $field => $setting) { ?>
		<?php if ($field != 'product_id') { ?>
		<?php if ($setting['type'] == 'text') { ?>
		html += '  <td class="left"><textarea name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]"></textarea></td>';
		<?php } else if ($setting['type'] == 'tinyint') { ?>
		<?php if (preg_match ('/status/', $field)) { ?>
		html += '  <td class="left disabled">';
		html += '   <select name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" onchange="selectTableTd(this);">';
		html += '    <option value="0"><?php echo $text_disabled; ?></option>';
		html += '    <option value="1" ><?php echo $text_enabled; ?></option>';
		html += '   </select>';
		html += '  </td>';
		<?php } else { ?>
		html += '  <td class="left">';
		html += '   <select name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" onchange="selectTableTd(this);">';
		html += '    <option value="0"><?php echo $text_no; ?></option>';
		html += '    <option value="1" ><?php echo $text_yes; ?></option>';
		html += '   </select>';
		html += '  </td>';
		<?php } ?>
		<?php } else if (isset ($list[$field])) { ?>
		html += '  <td class="left">';
		html += '   <select name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" >';
		<?php foreach ($list[$field] as $value) { ?>
		html += '    <option value="<?php echo $value[$field]; ?>"><?php echo $value["name"]; ?></option>';
		<?php } ?>
		html += '   </select>';
		html += '  </td>';
		<?php } else if ($field == 'price' && $setting['type'] == 'decimal') { ?>
		html += '  <td class="left">';
		
		if (product_id == 0) {
			html += '   <select name="price_action[' + <?php echo $link; ?>_row[product_id] + ']">';
			<?php foreach ($actions as $action) { ?>
			html += '    <option value="<?php echo $action["action"]; ?>"><?php echo $action["name"]; ?></option>';
			<?php } ?>
			html += '   </select>';
		}
		
		html += '   <input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" value="" type="text" />';
		html += '  </td>';
		<?php } else { ?>
		<?php $class = ''; ?>
		<?php if ($setting['type'] == 'date') { ?>
		<?php $class = 'date'; ?>
		<?php } ?>
		<?php if ($setting['type'] == 'datetime') { ?>
		<?php $class = 'datetime'; ?>
		<?php } ?>
		<?php if ($setting['extra'] == 'auto_increment') { ?>
		html += '  <td class="center"><input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" class="<?php echo $class; ?>" value="" type="hidden" /></td>';
		<?php } else { ?>
		html += '  <td class="left"><input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $field; ?>]" class="<?php echo $class; ?>" value="" type="text" /></td>';
		<?php } ?>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		
		html += ' </tr>';
		html += '</tbody>';
		
		$('#form-<?php echo $link; ?>' + product_id + ' .be-list tfoot').before(html);
		
		creatDateTime();
		
		<?php echo $link; ?>_row[product_id]++;
	}
}
//--></script>

<?php if ($product_id == -1) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#dialog-<?php echo $link; ?>').dialog({title:'<?php echo ${"text_" . $link}; ?>'});
});
//--></script>
<?php } ?>

<?php if ($product_id > 0) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#dialogLink').dialog({title:'<?php echo ${"text_" . $link}; ?>'});
});
//--></script>
<?php } ?>

<?php if ($product_id > -1) { ?>
<script type="text/javascript"><!--
autocompleteProductCopyData('<?php echo $product_id; ?>');
//--></script>
<?php } ?>