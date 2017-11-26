<form id="form-link">
 <table class="be-form">
  <tbody>
   <tr>
    <td class="left"><?php echo $text_description; ?></td>
    <td class="left">
     <?php foreach ($languages as $code => $language) { ?>
     <input name="link[description][<?php echo $code; ?>]" type="text" value="" />
     <img src="view/image/flags/<?php echo $language['image']; ?>" />&nbsp;&nbsp;
     <?php } ?>
    </td>
   </tr>
   <tr>
    <td class="left"><?php echo $text_table; ?></td>
    <td class="left">
     <select name="link[table]">
      <option value=""><?php echo $text_none; ?></option>
      <?php foreach ($tables as $table) { ?>
      <option value="<?php echo $table; ?>"><?php echo $table; ?></option>
      <?php } ?>
     </select>
    </td>
   </tr>
  </tbody>
 </table>
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="center" colspan="2">
     <a class="button" onclick="saveLink();"><?php echo $text_save; ?></a>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
//--></script>