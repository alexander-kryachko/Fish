<form id="form-<?php echo $link; ?><?php echo $product_id; ?>">
 <?php if ($product_id == -1) { ?>
 <div class="notice"><?php echo $notice_empty_field; ?></div>
 <p><span class="be-help"><label><input name="none[<?php echo $link; ?>]" type="checkbox" /> <?php echo $text_not_contain; ?> > <?php echo ${'text_' . $link}; ?></label></span></p>
 <?php } ?>
 <?php if ($product_id > 0) { ?>
 <table class="be-form">
  <tr>
   <td width="1%"><img src="<?php echo $product_image; ?>" alt="" title="" /></td>
   <td width="99%"><h3><?php echo $product_name; ?></h3></td>
  </tr>
 </table>
 <?php } ?>
 <?php $row = 0;?>
 <?php if ($product_id > -1) { ?>
 <div id="languages-<?php echo $link; ?><?php echo $product_id; ?>" class="htabs">
  <?php foreach ($languages as $language) { ?>
   <a href="#<?php echo $link; ?>-<?php echo $product_id; ?>-language-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
  <?php } ?>
 </div>
 <?php foreach ($languages as $language) { ?>
 <div id="<?php echo $link; ?>-<?php echo $product_id; ?>-language-<?php echo $language['language_id']; ?>">
  <table class="be-list" >
   <thead>
    <tr>
     <td class="center" width="1"></td>
     <td class="left" width="10%"><?php echo $field_name; ?></td>
     <td class="left"><?php echo $field_description; ?></td>
    </tr>
   </thead>
   <?php $row = 0;?>
   <?php foreach ($data as $key => $array) { ?>
   <tbody class="<?php echo $link; ?>-row-<?php echo $row;?>">
    <tr>
     <td class="center"><a onclick="$('#form-<?php echo $link; ?><?php echo $product_id; ?> .<?php echo $link; ?>-row-<?php echo $row;?>').remove();"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>
     <td class="left"><input type="text" name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $language['language_id']; ?>][name]" value="<?php echo $array[$language['language_id']]['name']; ?>"/></td>
     <td class="left"><textarea name="<?php echo $link; ?>[<?php echo $row; ?>][<?php echo $language['language_id']; ?>][description]"><?php echo $array[$language['language_id']]['description'] ?></textarea></td>
    </tr>
   </tbody>
   <?php $row++;?>
   <?php } ?>
  </table>
 </div>
 <?php } ?>
 <?php } ?>
 <table class="be-list">
  <tfoot>
   <tr>
    <?php if ($product_id > -1) { ?>
    <td class="center" width="1"><a onclick="addAdditional('<?php echo $product_id; ?>');"><img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" /></a></td>
    <?php } ?>
    <td class="center" colspan="<?php echo count ($fields); ?>">
     <?php if ($product_id > -1) { ?>
     <input id="product-copy-data-product_name-<?php echo $product_id; ?>" type="text" />
     <input id="product-copy-data-product_id-<?php echo $product_id; ?>" type="hidden" />
     <a class="button" onclick="copyProductData('<?php echo $product_id; ?>', '<?php echo $link; ?>');" style="margin-right:50px;"><?php echo $button_copy; ?></a>
     <?php } ?>
     <?php if ($product_id == 0) { ?>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'upd', <?php echo $product_id; ?>);"><?php echo $text_edit; ?></a>
     <?php } ?>
     <?php if ($product_id > 0) { ?>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'prev');" title="<?php echo $button_prev; ?>">&lt;</a>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'next');" title="<?php echo $button_next; ?>" style="margin-right:50px;">&gt;</a>
     <a class="button" onclick="editLink('<?php echo $link; ?>', 'upd', <?php echo $product_id; ?>);"><?php echo $button_save; ?></a>
     <a class="button" onclick="$('#dialogLink').dialog('close');" title="<?php echo $button_close; ?>">&times;</a>
     <?php } ?>
     <?php if ($product_id == -1) { ?>
     <a class="button" onclick="setLinkFilter('<?php echo $link; ?>');"><?php echo $button_add_to_filter; ?></a>
     <a class="button" onclick="delLinkFilter('<?php echo $link; ?>');"><?php echo $button_remove_from_filter; ?></a>
     <?php } ?>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
if (typeof <?php echo $link; ?>_row == 'undefined') {
	var <?php echo $link; ?>_row = [];
}

<?php echo $link; ?>_row[<?php echo $product_id; ?>] = <?php echo $row; ?>;

function addAdditional(product_id) {
	<?php foreach ($languages as $language) { ?>
	html  = '<tbody class="<?php echo $link; ?>-row-' + <?php echo $link; ?>_row[product_id] + '">';
	html += ' <tr>';
	html += '  <td class="center"><a onclick="$(\'#form-<?php echo $link; ?>' + product_id + ' .<?php echo $link; ?>-row-' + <?php echo $link; ?>_row[product_id] + '\').remove();"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="left"><input type="text" name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $language["language_id"]; ?>][name]" value=""/></td>';
	html += '  <td class="left"><textarea name="<?php echo $link; ?>[' + <?php echo $link; ?>_row[product_id] + '][<?php echo $language["language_id"]; ?>][description]"></textarea></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#form-<?php echo $link; ?>' + product_id + ' #<?php echo $link; ?>-' + product_id + '-language-<?php echo $language["language_id"]; ?> .be-list').append(html);
	<?php } ?>
	
	<?php echo $link; ?>_row[product_id]++;
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
$(document).ready(function(e) {
	$('#form-<?php echo $link; ?><?php echo $product_id; ?> #languages-<?php echo $link; ?><?php echo $product_id; ?> a').tabs();
});

autocompleteProductCopyData('<?php echo $product_id; ?>');
//--></script>
<?php } ?>