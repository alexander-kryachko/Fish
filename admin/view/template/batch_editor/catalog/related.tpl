<form id="form-related<?php echo $product_id; ?>">
 <?php if ($product_id == -1) { ?>
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
   <tr><td class="left"><input type="text" name="related_input" value="" size="100" /></td></tr>
  </thead>
  <tbody>
   <tr>
    <td class="left white">
     <div class="be-scrollbox" id="related" style="width:100%; height:350px;">
      <?php foreach ($data as $value) { ?>
      <div id="related<?php echo $value['product_id']; ?>"><img onclick="$(this).parent().remove();" src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /><?php echo $value['name']; ?><input type="hidden" name="related[]" value="<?php echo $value['product_id']; ?>" /></div>
      <?php } ?>
     </div>
    </td>
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td class="center">
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
     <a style="float:left;" onclick="relatedToForm('form-<?php echo $link; ?><?php echo $product_id; ?>');"><img src="view/batch_editor/image/button_load.png" alt="<?php echo $button_insert_sel; ?>" title="<?php echo $button_insert_sel; ?>"></a>
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
$('#form-related<?php echo $product_id; ?> input[name=\'related_input\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		xhr = $.ajax({dataType:'json', url:'index.php?route=catalog/product/autocomplete&token=' + token + '&filter_name=' +  encodeURIComponent(request.term),
			success: function(json) {
				response($.map(json, function(item) {
					return { label:item.name, value:item.product_id }
				}));
			}
		});
	},
	select: function(event, ui) {
		var html = '<div id="related' + ui.item.value + '"><img onclick="$(this).parent().remove();" src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />' + ui.item.label + '<input type="hidden" name="related[]" value="' + ui.item.value + '" /></div>';
		
		$('#form-related<?php echo $product_id; ?> #related #related' + ui.item.value).remove();
		$('#form-related<?php echo $product_id; ?> #related').append(html);
		
		return false;
	}
});
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