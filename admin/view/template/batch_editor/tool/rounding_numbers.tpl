<form id="form-rounding_numbers<?php echo $product_id; ?>">
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="90%"><?php echo $text_rounding; ?>:</td>
    <td class="left" width="10%"><?php echo $text_apply_to; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center" rowspan="2">
     <div style="margin-bottom:50px;">
      <label><input type="radio" name="rounding_numbers[rule]" value="1" checked="checked" /> <?php echo $text_under_rule; ?></label>
      &nbsp;&nbsp;&nbsp;
      <label><input type="radio" name="rounding_numbers[rule]" value="2" /> <?php echo $text_in_big_way; ?></label>
     </div>
     <table class="be-list">
      <tbody>
       <tr>
        <?php for ($i = -10; $i <= 6; $i++) { ?>
        <td class="center">
         <?php if ($i == 0) { ?>
         <label><span style="font-size:18px;">.</span><br /><input type="radio" name="rounding_numbers[rounding]" value="<?php echo $i; ?>" checked="checked" /></label>
         <?php } else { ?>
         <label><span style="font-size:18px;"><?php echo (abs ($i)); ?></span><br /><input type="radio" name="rounding_numbers[rounding]" value="<?php echo $i; ?>" /></label>
         <?php } ?>
        </td>
        <?php } ?>
       </tr>
      </tbody>
     </table>
    </td>
    <td class="left">
     <b><?php echo $text_main; ?></b>
     <div class="be-scrollbox">
      <?php foreach ($apply_to['product'] as $field) { ?>
      <div><label><input type="checkbox" name="rounding_numbers[apply_to][product][]" value="<?php echo $field; ?>" /> <?php echo ${'field_' . $field}; ?></label></div>
      <?php } ?>
     </div>
    </td>
   </tr>
   <tr>
    <td class="left">
     <b><?php echo $text_optional; ?></b>
     <div class="be-scrollbox">
      <div><label><input type="checkbox" name="rounding_numbers[apply_to][product_special][]" value="price" /> <?php echo $text_special_price; ?></label></div>
      <div><label><input type="checkbox" name="rounding_numbers[apply_to][product_discount][]" value="price" /> <?php echo $text_discount_price; ?></label></div>
      <div><label><input type="checkbox" name="rounding_numbers[apply_to][product_option_value][]" value="price" /> <?php echo $text_option_price; ?></label></div>
     </div>
    </td>
   </tr>
   <tr>
    <td class="center" colspan="2"><a class="button" onclick="editTool(<?php echo $product_id; ?>, 'rounding_numbers', 'upd');"><?php echo $text_edit; ?></a></td>
   </tr>
  </tfoot>
 </table>
</form>