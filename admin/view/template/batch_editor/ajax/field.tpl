<?php if ($setting['type'] == 'char' || $setting['type'] == 'varchar' || $setting['type'] == 'text') { ?>
<?php $is_text = true; ?>
<?php } else { ?>
<?php $is_text = false; ?>
<?php } ?>

<?php if ($setting['type'] == 'date' || $setting['type'] == 'datetime') { ?>
<?php $is_date = true; ?>
<?php } else { ?>
<?php $is_date = false; ?>
<?php } ?>

<?php if ($list) { ?>
<table class="be-list" style="margin:-6px;">
 <tbody>
  <tr>
   <td class="center" width="1">
    <select name="table[<?php echo $table; ?>][<?php echo $field; ?>][not]">
     <option value=""></option>
     <option value="NOT">not</option>
    </select>
   </td>
   <td class="left">
    <div class="be-scrollbox" style="margin:-5px;">
     <?php foreach ($list as $value) { ?>
     <div><label><input type="checkbox" name="table[<?php echo $table; ?>][<?php echo $field; ?>][value][]" value="<?php echo $value[$field]; ?>" /><?php echo $value['name']; ?></label></div>
     <?php } ?>
    </div>
   </td>
  </tr>
 </tbody>
</table>
<?php } else { ?>
<?php if ($setting['type'] == 'tinyint') { ?>
<select name="table[<?php echo $table; ?>][<?php echo $field; ?>][value]">
 <?php if ($field == 'status') { ?>
 <option value="0"><?php echo $text_disabled; ?></option>
 <option value="1"><?php echo $text_enabled; ?></option>
 <?php } else {?>
 <option value="0"><?php echo $text_no; ?></option>
 <option value="1"><?php echo $text_yes; ?></option>
<?php } ?>
</select>
<?php } else { ?>
<?php $class = ''; ?>
<?php if ($setting['type'] == 'date') { ?>
<?php $class = 'date'; ?>
<?php } ?>
<?php if ($setting['type'] == 'datetime') { ?>
<?php $class = 'datetime'; ?>
<?php } ?>
<table class="be-list" style="margin:-6px;">
 <tbody>
  <tr>
   <td class="left" width="10%">
    <?php if ($setting['type'] != 'text') { ?>
    <label><input name="table[<?php echo $table; ?>][<?php echo $field; ?>][duplicate]" type="checkbox" onchange="checkFilterDuplicate(this);" value="1" /> <?php echo $text_duplicate; ?></label>
    <?php } ?>
   </td>
   <td class="center" width="1">
    <select name="table[<?php echo $table; ?>][<?php echo $field; ?>][not]">
     <option value=""></option>
     <option value="NOT">not</option>
    </select>
   </td>
   <td class="center" width="1">
    <select name="table[<?php echo $table; ?>][<?php echo $field; ?>][action]">
     <option value="=">=</option>
     <option value="LIKE%">[<?php echo $text_value; ?>]%</option>
     <option value="%LIKE">%[<?php echo $text_value; ?>]</option>
     <option value="%LIKE%">%[<?php echo $text_value; ?>]%</option>
    </select>
   </td>
   <td class="left" width="1">
    <select name="table[<?php echo $table; ?>][<?php echo $field; ?>][is]" onchange="getFilterTextareaRange(this);" style="min-width:200px;">
     <option value="value"><?php echo $text_value; ?></option>
     <?php if (!$is_date) { ?>
     <option value="array"><?php echo $text_value_by_space; ?></option>
     <?php } ?>
     <?php if (!$is_text) { ?>
     <option value="range"><?php echo $text_range; ?></option>
     <?php } ?>
    </select>
   </td>
   <td class="left">
    <?php if ($is_date) { ?>
    <input name="table[<?php echo $table; ?>][<?php echo $field; ?>][value]" type="text" class="<?php echo $class; ?>" />
    <?php } else { ?>
    <textarea name="table[<?php echo $table; ?>][<?php echo $field; ?>][value]" style="height:13px; vertical-align:middle; width:50%;"></textarea>
    <?php } ?>
    <?php if (!$is_text) { ?>
    <span style="display:none;">&gt;<input type="text" name="table[<?php echo $table; ?>][<?php echo $field; ?>][value_min]" class="<?php echo $class; ?>" disabled="disabled" />&mdash;<input type="text" name="table[<?php echo $table; ?>][<?php echo $field; ?>][value_max]" class="<?php echo $class; ?>" disabled="disabled" />&lt;</span>
    <?php } ?>
   </td>
  </tr>
 </tbody>
</table>
<?php } ?>
<?php } ?>