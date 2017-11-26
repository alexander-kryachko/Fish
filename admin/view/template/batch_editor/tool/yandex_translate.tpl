<form id="form-yandex_translate<?php echo $product_id; ?>">
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="33%"><?php echo $text_direction; ?>:</td>
    <td class="left" width="33%"><?php echo $text_apply_to; ?>:</td>
    <td class="left" width="33%"><?php echo $text_optional; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center">
     <select name="yandex_translate[from]">
      <option value=""></option>
      <?php foreach ($languages as $code => $language) { ?>
      <option value="<?php echo $code; ?>"><?php echo $language['name']; ?> [<?php echo $code; ?>]</option>
      <?php } ?>
     </select>
     &gt;
     <select name="yandex_translate[to]">
      <option value=""></option>
      <?php foreach ($languages as $code => $language) { ?>
      <option value="<?php echo $code; ?>"><?php echo $language['name']; ?> [<?php echo $code; ?>]</option>
      <?php } ?>
     </select>
    </td>
    <td class="left">
     <b><?php echo $text_description; ?></b>
     <div class="be-scrollbox">
      <?php foreach ($apply_to['pd'] as $field) { ?>
      <div><label><input name="yandex_translate[apply_to]" type="radio" value="<?php echo $field; ?>" /> <?php echo ${'field_' . $field}; ?></label></div>
      <?php } ?>
     </div>
    </td>
    <td class="left"><label><input name="yandex_translate[rewrite]" type="checkbox" value="1" /> <?php echo $text_rewrite; ?></label></td>
   </tr>
   <tr>
    <td class="center" colspan="3"><a class="button" onclick="editTool(<?php echo $product_id; ?>, 'yandex_translate', 'upd');"><?php echo $text_edit; ?></a></td>
   </tr>
  </tfoot>
 </table>
</form>