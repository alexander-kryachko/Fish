<select class="select-<?php echo $field; ?>-<?php echo $id; ?>">
 <?php if ($field == 'manufacturer_id' || $field == 'tax_class_id' || $field == 'asticker_id') { ?>
 <option value="0"></option>
 <?php } ?>
 <?php foreach ($data as $value) { ?>
 <?php if ($value['name'] == htmlspecialchars_decode($name)) { ?>
 <option value="<?php echo $value[$field]; ?>" selected="selected"><?php echo $value['name']; ?></option>
 <?php } else { ?>
 <option value="<?php echo $value[$field]; ?>"><?php echo $value['name']; ?></option>
 <?php } ?>
 <?php } ?>
</select>