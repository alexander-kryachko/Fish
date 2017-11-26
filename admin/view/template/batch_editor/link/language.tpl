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
 <div id="languages-<?php echo $link; ?><?php echo $product_id; ?>" class="htabs">
  <?php foreach ($languages as $language) { ?>
  <a href="#language-<?php echo $link; ?><?php echo $product_id; ?><?php echo $language['language_id']; ?>">
   <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" alt="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
  </a>
  <?php } ?>
 </div>
 <?php foreach ($languages as $language) { ?>
 <div id="language-<?php echo $link; ?><?php echo $product_id; ?><?php echo $language['language_id']; ?>">
  <table class="be-form">
   <?php foreach ($fields as $field=>$value) { ?>
   <?php if ($value['key'] != 'PRI') { ?>
   <tr>
    <td class="left"><?php echo ${'field_' . $field}; ?></td>
    <td class="left">
     <?php $text = ''; ?>
     <?php if (isset ($data[$language['language_id']][$field])) { ?>
     <?php $text = $data[$language['language_id']][$field]; ?>
     <?php } ?>
     <?php if ($value['type'] == 'text') { ?>
     <textarea name="<?php echo $link; ?>[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]"><?php echo $text; ?></textarea>
     <?php } else { ?>
     <input name="<?php echo $link; ?>[<?php echo $language['language_id']; ?>][<?php echo $field; ?>]" value="<?php echo $text; ?>" type="text" />
     <?php } ?>
    </td>
   </tr>
   <?php } ?>
   <?php } ?>
  </table>
  <table class="be-list">
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
 </div>
 <?php } ?>
</form>
<script type="text/javascript"><!--
$('#form-<?php echo $link; ?><?php echo $product_id; ?> #languages-<?php echo $link; ?><?php echo $product_id; ?> a').tabs();
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