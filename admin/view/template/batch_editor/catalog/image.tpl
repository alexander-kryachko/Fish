<form id="form-image<?php echo $product_id; ?>">
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
 
 <div class="be-scrollhead">
  <table class="be-list">
   <col width="50" /><col width="30%" />
   <thead>
    <tr>
     <td class="center"></td>
     <td class="center"><?php echo $text_image; ?></td>
     <td class="left"><?php echo $text_sort_order; ?></td>
    </tr>
   </thead>
  </table>
 </div>
 
 <div class="be-scrollcontent">
  <table class="be-list" id="table-image<?php echo $product_id; ?>">
   <col width="50" /><col width="30%" />
   <?php $image_row = 0; ?>
   <?php if ($data) { ?>
   <?php foreach ($data as $value) { ?>
   <tbody>
    <tr>
     <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>
     <td class="center">
      <?php if ($product_id > 0) { ?>
      <a onclick="setMainImage(this);"><?php echo $text_main; ?></a><br />
      <?php } ?>
      <div class="image">
       <img src="<?php echo $value['thumb']; ?>" alt="<?php echo $text_edit; ?>" title="<?php echo $text_edit; ?>" />
       <input name="image[<?php echo $image_row; ?>][image]" data-table="product_image" data-field="image" data-product_id="<?php echo $product_id; ?>" type="hidden" value="<?php echo $value['image']; ?>" />
       <a class="button-upload" onclick="getImageManager(this)" title="<?php echo $text_path; ?>"></a>
       <a class="button-remove" onclick="$(this).parent().find('img, input').prop({'src':no_image, 'value':''});" title="<?php echo $text_clear; ?>"></a>
      </div>
     </td>
     <td class="left"><input name="image[<?php echo $image_row; ?>][sort_order]" type="text" value="<?php echo $value['sort_order']; ?>" /></td>
    </tr>
   </tbody>
   <?php $image_row++; ?>
   <?php } ?>
   <?php } else { ?>
   <tbody class="no_results">
    <tr>
     <td class="center" colspan="3"><div align="center" class="attention"><?php echo $text_no_results; ?></div></td>
    </tr>
   </tbody>
   <?php } ?>
  </table>
 </div>
 
 <div class="be-scrollfoot">
  <table class="be-list">
   <col width="50" /><col />
   <tfoot>
    <tr>
     <td class="center"><a class="add_product_image"><img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" /></a></td>
     <td class="center" colspan="2">
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
      <a class="button" onclick="editLink('<?php echo $link; ?>', 'add', '<?php echo $product_id; ?>');"><?php echo $button_insert_sel; ?></a>
      <a class="button" onclick="editLink('<?php echo $link; ?>', 'del', '<?php echo $product_id; ?>');"><?php echo $button_delete_sel; ?></a>
      <a class="button" onclick="editLink('<?php echo $link; ?>', 'upd', '<?php echo $product_id; ?>');"><?php echo $text_edit; ?></a>
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
 </div>
</form>
<script type="text/javascript"><!--
if (typeof image_row == 'undefined') {
	var image_row = [];
}

image_row[<?php echo $product_id; ?>] = <?php echo $image_row; ?>;

$('#form-image<?php echo $product_id; ?> .add_product_image').click(function(e) {
	$('#form-image<?php echo $product_id; ?> #table-image<?php echo $product_id; ?> tbody.no_results').remove();
	
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center"><a onclick="removeTableRow(this);"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="center">';
	<!--<?php if ($product_id > 0) { ?>-->
	html += '   <a onclick="setMainImage(this);"><?php echo $text_main; ?></a><br />';
	<!--<?php } ?>-->
	html += '   <div class="image">';
	html += '    <img src="' + no_image + '" alt="<?php echo $text_edit; ?>" title="<?php echo $text_edit; ?>" />';
	html += '    <input name="image[' + image_row[<?php echo $product_id; ?>] + '][image]" data-table="product_image" data-field="image" data-product_id="<?php echo $product_id; ?>" type="hidden" value="" />';
	html += '    <a class="button-upload" onclick="getImageManager(this)" title="<?php echo $text_path; ?>"></a>';
	html += '    <a class="button-remove" onclick="$(this).parents(\'div:first\').find(\'img, input\').prop({\'src\':no_image, \'value\':\'\'});" title="<?php echo $text_clear; ?>"></a>';
	html += '   </div>';
	html += '  </td>';
	html += '  <td class="left"><input name="image[' + image_row[<?php echo $product_id; ?>] + '][sort_order]" type="text" value="" /></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#form-image<?php echo $product_id; ?> #table-image<?php echo $product_id; ?>').append(html);
	$('#form-image<?php echo $product_id; ?> .be-scrollcontent').scrollTop(99999);
	
	image_row[<?php echo $product_id; ?>]++;
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

function setMainImage($this) {
	var image = $($this).parent().find('input').val();
	var thumb = $($this).parent().find('img').attr('src');
	
	creatOverlayLoad(true);
	
	xhr = $.ajax({type:'POST', dataType:'json', url:'index.php?route=batch_editor/index/editProduct&token=' + token, data:'selected[]=<?php echo $product_id; ?>&product_image=' + image + '&field=image',
		success: function(json) {
			$('#product input[data-table=\'product\'][data-field=\'image\'][data-product_id=\'<?php echo $product_id; ?>\']').val(image).trigger('change').parent().find('img').attr('src', thumb);
			
			$('#form-image<?php echo $product_id; ?> .be-form').find('img').attr('src', thumb);
			
			creatMessage(json);
			creatOverlayLoad(false);
		}
	})
}
//--></script>
<?php } ?>

<?php if ($product_id > -1) { ?>
<script type="text/javascript"><!--
autocompleteProductCopyData('<?php echo $product_id; ?>');
//--></script>
<?php } ?>