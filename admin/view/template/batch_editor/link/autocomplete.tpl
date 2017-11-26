<form id="form-<?php echo $link; ?><?php echo $product_id; ?>">
 <?php if ($product_id == -1) { ?>
 <span class="be-help"><label><input name="none[<?php echo $link; ?>]" type="checkbox" value="1" /> <?php echo $text_not_contain; ?> > <?php echo ${'text_' . $link}; ?></label></span>
 <?php if (isset ($fields['main_category'])) { ?>
 <span class="be-help"><label><input name="none[main_category]" type="checkbox" value="1" onclick="inputFormDisabled(this);" /> <?php echo $text_not_contain; ?> > <?php echo $field_main_category; ?></label></span>
 <?php } ?>
 <br />
 <span class="be-help"><label><input name="has[<?php echo $link; ?>]" type="checkbox" value="1" /> <?php echo $text_strictly_selected; ?></label></span>
 <span class="be-help"><label><input name="count[<?php echo $link; ?>]" type="checkbox" value="1" /> <?php echo $text_with_regard_number; ?></label></span>
 <?php } ?>
 <?php if ($product_id > 0) { ?>
 <table class="be-form">
  <tr>
   <td width="1%"><img src="<?php echo $product_image; ?>" /></td>
   <td width="99%"><h3><?php echo $product_name; ?></h3></td>
  </tr>
 </table>
 <?php } ?>
 <p><input name="autocomplete_<?php echo $link; ?>" type="text" size="50" /></p>
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="20"></td>
    <?php foreach ($fields as $field => $setting) { ?>
    <?php if ($field != 'product_id') { ?>
    <?php if ($field == 'main_category') { ?>
    <td class="center" width="20%"><?php echo ${'field_' . $field}; ?><label><span class="be-help"><input id="no_select" type="radio" value="0" onclick="selectTableRow(this);" /><?php echo $text_none; ?></span></label></td>
    <?php } else { ?>
    <?php if ($setting['extra'] == 'auto_increment') { ?>
    <td class="center" width="1"><?php echo ${'field_' . $field}; ?></td>
    <?php } else { ?>
    <td class="left"><?php echo ${'field_' . $field}; ?></td>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
   </tr>
  </thead>
  <?php $row = 0; ?>
  <?php if ($data) { ?>
  <?php foreach ($data as $key => $array) { ?>
  <tbody>
   <tr>
    <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>
    <?php foreach ($fields as $field => $setting) { ?>
    <?php if ($field != 'product_id') { ?>
    <?php if ($field == 'main_category') { ?>
    <?php if ($array['main_category']) { ?>
    <td class="center"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" type="radio" value="1" onclick="selectTableRow(this);" checked="checked" /></td>
    <?php } else { ?>
    <td class="center"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" type="radio" value="1" onclick="selectTableRow(this);" /></td>
    <?php } ?>
    <?php } else { ?>
    <?php if ($setting['extra'] == 'auto_increment') { ?>
    <td class="center"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" type="hidden" value="<?php echo $array[$field]; ?>" /><b><?php echo $array[$field]; ?></b></td>
    <?php } else { ?>
    <?php if (isset ($names[$array[$field]])) { ?>
    <td class="left"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" type="hidden" value="<?php echo $array[$field]; ?>" /> <?php echo $names[$array[$field]]; ?></td>
    <?php } else { ?>
    <td class="left"><input name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $field; ?>]" type="text" value="<?php echo $array[$field]; ?>" /></td>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
   </tr>
  </tbody>
  <?php $row++; ?>
  <?php } ?>
  <?php } else { ?>
  <tbody class="no_results"><tr><td class="center" colspan="<?php echo count ($fields); ?>"><div class="attention" align="center"><?php echo $text_no_results; ?></div></td></tr></tbody>
  <?php } ?>
  <tfoot>
   <tr>
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
<?php $value = 'product_id'; ?>
<?php if ($link == 'category') { ?>
<?php $value = 'category_id'; ?>
<?php } ?>
<?php if ($link == 'coupon_product') { ?>
<?php $value = 'coupon_id'; ?>
<?php } ?>
<?php if ($link == 'sizechart_to_product') { ?>
<?php $value = 'sizechart_id'; ?>
<?php } ?>
<?php if ($link == 'product_to_tag') { ?>
<?php $value = 'tag_id'; ?>
<?php } ?>
<?php if ($link == 'product_to_series') { ?>
<?php $value = 'series_id'; ?>
<?php } ?>
<?php if ($link == 'product_related_article') { ?>
<?php $value = 'article_id'; ?>
<?php } ?>
<script type="text/javascript"><!--
if (typeof <?php echo $link; ?>_row == 'undefined') {
	var <?php echo $link; ?>_row = [];
}

<?php echo $link; ?>_row[<?php echo $product_id; ?>] = <?php echo $row; ?>;

$('#form-<?php echo $link; ?><?php echo $product_id; ?> input[name=\'autocomplete_<?php echo $link; ?>\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		xhr = $.ajax({dataType:'json', url:'index.php?route=batch_editor/data/autocomplete&token=' + token + '&autocomplete=<?php echo $value; ?>&keyword=' + encodeURIComponent(request.term),
			success: function(json) {
				response($.map(json, function(item) {
					return { label:item.name, value:item.<?php echo $value ?> }
				}));
			}
		});
	},
	select: function(event, ui) {
		var html = '';
		
		html += '<tbody>';
		html += ' <tr>';
		html += '  <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>';
		<?php foreach ($fields as $field=>$setting) { ?>
		<?php if ($field != 'product_id') { ?>
		<?php if ($field == 'main_category') { ?>
		html += '  <td class="center"><input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[<?php echo $product_id; ?>] + '][<?php echo $field; ?>]" type="radio" value="1" onclick="selectTableRow(this);" /></td>';
		<?php } else { ?>
		<?php if ($setting['extra'] == 'auto_increment') { ?>
		html += '  <td class="center"><input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[<?php echo $product_id; ?>] + '][<?php echo $field; ?>]" type="hidden" value="0" /></td>';
		<?php } else { ?>
		html += '  <td class="left">';
		html += '   <input name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[<?php echo $product_id; ?>] + '][<?php echo $field; ?>]" type="hidden" value="' + ui.item.value + '" />' + ui.item.label;
		html += '  </td>';
		<?php } ?>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		html += ' </tr>';
		html += '</tbody>';
		
		$('#form-<?php echo $link; ?><?php echo $product_id; ?> table.be-list input[value=\'' + ui.item.value + '\']').parents('tbody').remove();
		$('#form-<?php echo $link; ?><?php echo $product_id; ?> table.be-list .no_results').remove();
		$('#form-<?php echo $link; ?><?php echo $product_id; ?> table.be-list tfoot').before(html);
		
		<?php echo $link; ?>_row[<?php echo $product_id; ?>]++;
		return false;
	}
});
//--></script>


<?php if (isset ($fields['main_category'])) { ?>
<script type="text/javascript"><!--
$('#form-<?php echo $link; ?><?php echo $product_id; ?> input[type=\'radio\']:checked').parents('tbody').addClass('selected');

if ($('#form-<?php echo $link; ?><?php echo $product_id; ?> input[type=\'radio\']:checked').length == 0) {
	$('#form-<?php echo $link; ?><?php echo $product_id; ?> #no_select').prop('checked', true);
}
//--></script>
<?php } ?>

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