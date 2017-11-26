<style type="text/css">
.cke_dialog_body {
	z-index:10001 !important;
}
</style>
<form id="form-description<?php echo $product_id; ?>">
 <?php if ($product_id > 0) { ?>
 <table class="be-form">
  <tr>
   <td width="1%"><img src="<?php echo $product_image; ?>" /></td>
   <td width="99%"><h3><?php echo $product_name; ?></h3></td>
  </tr>
 </table>
 <?php } ?>
 <div id="languages" class="htabs">
  <?php foreach ($languages as $language) { ?>
  <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
  <?php } ?>
 </div>
 <?php $ckeditors = array (); ?>
 <?php foreach ($languages as $language) { ?>
 <div id="language<?php echo $language['language_id']; ?>">
  <table class="be-form">
   <?php foreach ($table as $field => $parameter) { ?>
   <tr>
    <td width="17%"><?php echo ${'text_' . $field}; ?>
     <?php if ($field == 'name') { ?>
     <span class="be-required">*</span>
     <?php } ?></td>
    <td width="83%"><?php $form_value = ''; ?>
     <?php if (isset ($data[$language['language_id']][$field])) { ?>
     <?php $form_value = $data[$language['language_id']][$field]; ?>
     <?php } ?>
     <?php if ($field == 'description') { ?>
     <textarea name="description[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]" style="display:none;"><?php echo $form_value; ?></textarea>
     <?php $ckeditor_id = 'ckeditor_description' . '_' . $product_id . '_' . $field . '_' . $language['language_id']; ?>
     <textarea id="<?php echo $ckeditor_id; ?>"><?php echo $form_value; ?></textarea>
     <?php $ckeditors[] = $ckeditor_id; ?>
     <?php } else if ($parameter['type'] == 'text') { ?>
     <textarea name="description[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]" style="width:98%; height:50px;"><?php echo $form_value; ?></textarea>
     <?php } else { ?>
     <?php $size = 0; ?>
     <?php if (isset ($parameter['size'])) { ?>
     <?php $size = $parameter['size']; ?>
     <?php } ?>
     <?php if (isset ($parameter['size_1'])) { ?>
     <?php $size = ($parameter['size'] + $parameter['size_1'] + 1); ?>
     <?php } ?>
     <?php if ($size) { ?>
     <input type="text" name="description[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]" size="120" value="<?php echo $form_value; ?>" maxlength="<?php echo $size; ?>" />
     <?php } else { ?>
     <input type="text" name="description[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]" size="120" value="<?php echo $form_value; ?>" />
     <?php } ?>
     <?php } ?></td>
   </tr>
   <?php } ?>
  </table>
 </div>
 <?php } ?>
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="center">
     <?php if ($product_id > -1) { ?>
     <input id="product-copy-data-product_name-<?php echo $product_id; ?>" type="text" />
     <input id="product-copy-data-product_id-<?php echo $product_id; ?>" type="hidden" />
     <a class="button" onclick="copyProductData('<?php echo $product_id; ?>', '<?php echo $link; ?>');" style="margin-right:50px;"><?php echo $button_copy; ?></a>
     <?php } ?>
     <?php if ($product_id > 0) { ?>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'prev');" title="<?php echo $button_prev; ?>">&lt;</a>
     <a class="button" onclick="listProductLink('<?php echo $product_id; ?>', '<?php echo $link; ?>', 'next');" title="<?php echo $button_next; ?>" style="margin-right:50px;">&gt;</a>
     <a class="button" onclick="CKeditorToTextarea_<?php echo $link; ?>_<?php echo $product_id; ?>(); editLink('description', 'upd', <?php echo $product_id; ?>);"><?php echo $button_save; ?></a>
     <a class="button" onclick="$('#dialogLink').dialog('close');" title="<?php echo $button_close; ?>">&times;</a>
     <?php } ?>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
function CKeditorToTextarea_<?php echo $link; ?>_<?php echo $product_id; ?>() {
	<!--<?php foreach ($ckeditors as $ckeditor) { ?>-->
	$('#<?php echo $ckeditor; ?>').prev('textarea:first').val(CKEDITOR.instances.<?php echo $ckeditor; ?>.getData());
	<!--<?php } ?>-->
}

$(document).ready(function(e) {
	$('#form-description<?php echo $product_id; ?> #languages a').tabs();
	
	<!--<?php foreach ($ckeditors as $ckeditor) { ?>-->
	CKEDITOR.replace('<?php echo $ckeditor; ?>', {
		resize_enabled: true,
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=' + token,
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=' + token,
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=' + token,
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=' + token,
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=' + token,
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=' + token
	});
	<!--<?php } ?>-->
});
//--></script>

<?php if ($product_id) { ?>
<script type="text/javascript"><!--
$('#dialogLink').dialog({title:"<?php echo $text_description; ?>"});
//--></script>
<?php } ?>

<?php if ($ckeditors) { ?>
<script type="text/javascript"><!--
$('#dialogLink').dialog({
	beforeClose: function(e) {
		<!--<?php foreach ($ckeditors as $ckeditor) { ?>-->
		CKEDITOR.instances.<?php echo $ckeditor; ?>.destroy();
		<!--<?php } ?>-->
	}
});
//--></script>
<?php } ?>

<?php if ($product_id > -1) { ?>
<script type="text/javascript"><!--
autocompleteProductCopyData('<?php echo $product_id; ?>');
//--></script>
<?php } ?>