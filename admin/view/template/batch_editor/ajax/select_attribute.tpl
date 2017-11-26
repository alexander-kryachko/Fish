<input type="hidden" name="attribute[<?php echo $row; ?>][name]" value="" />

<select name="attribute[<?php echo $row; ?>][attribute_id]" onchange="$(this).parent('td').children('input[name=\'attribute[<?php echo $row; ?>][name]\']').val($(this).children('option:selected').html());">
 <option value="0"><?php echo $text_none; ?></option>
 <?php foreach ($attribute as $value) { ?>
 <option value="<?php echo $value['attribute_id']; ?>"><?php echo $value['attribute_name']; ?></option>
 <?php } ?>
</select>