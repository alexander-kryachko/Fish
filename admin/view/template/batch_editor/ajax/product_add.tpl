<form id="productAdd">
 <table class="be-form">
  <tr>
   <td><?php echo $text_image; ?></td>
   <td>
    <div class="image">
     <img src="" alt="<?php echo $text_edit; ?>" title="<?php echo $text_edit; ?>" /><br />
     <input name="product[image]" data-table="product" data-field="image" data-product_id="0" type="hidden" value="" />
     <a class="button-upload" onclick="getImageManager(this)" title="<?php echo $text_path; ?>"></a>
     <a class="button-remove" onclick="$(this).parent().find('img, input').prop({'src':no_image, 'value':''});" title="<?php echo $text_clear; ?>"></a>
    </div>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_name; ?> <span class="be-required">*</span></td>
   <td>
    <?php foreach ($languages as $language) { ?>
    <input name="product[name][<?php echo $language['language_id']; ?>]" type="text" value="" />
    <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />&nbsp;&nbsp;
    <?php } ?>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_model; ?> <span class="be-required">*</span></td>
   <td><input name="product[model]" type="text" value="" /></td>
  </tr>
  <tr>
   <td><?php echo $text_price; ?></td>
   <td><input name="product[price]" type="text" value="" /></td>
  </tr>
  <tr>
   <td><?php echo $text_manufacturer_id; ?></td>
   <td>
    <select name="product[manufacturer_id]">
     <option value="0"><?php echo $text_none; ?></option>
     <?php foreach ($manufacturers as $manufacturer) { ?>
     <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
     <?php } ?>
    </select>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_tax_class_id; ?></td>
   <td>
    <select name="product[tax_class_id]">
     <option value="0"><?php echo $text_none; ?></option>
     <?php foreach ($tax_classes as $tax_class) { ?>
     <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['name']; ?></option>
     <?php } ?>
    </select>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_stock_status_id; ?></td>
   <td>
    <select name="product[stock_status_id]">
     <?php foreach ($stock_statuses as $stock_status) { ?>
     <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
     <?php } ?>
    </select>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_weight_class_id; ?></td>
   <td>
    <select name="product[weight_class_id]">
     <?php foreach ($weight_classes as $weight_class) { ?>
     <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['name']; ?></option>
     <?php } ?>
    </select>
   </td>
  </tr>
  <tr>
   <td><?php echo $text_length_class_id; ?></td>
   <td>
    <select name="product[length_class_id]">
     <?php foreach ($length_classes as $length_class) { ?>
     <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['name']; ?></option>
     <?php } ?>
    </select>
   </td>
  </tr>
 </table>
</form>
<table class="be-list">
 <tfoot>
  <tr>
   <td class="center">
    <a class="button" onclick="productAddCopyDelete('add');"><?php echo $button_insert; ?></a>
    <a class="button" onclick="$('#dialogLink').dialog('close');">X</a>
   </td>
  </tr>
 </tfoot>
</table>
<script type="text/javascript"><!--
$('#productAdd .image img').attr('src', no_image);
$('#dialogLink').dialog({title:'<?php echo $text_product_add; ?>'});
//--></script>