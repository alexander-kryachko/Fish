<form id="form-lost_image<?php echo $product_id; ?>">
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="center"><div class="be-scrollbox" style="width:100%; height:250px; margin-bottom:5px;"><table class="be-list data"></table></div></td>
   </tr>
   <tr>
    <td class="center"><a class="button" onclick="$('#form-lost_image<?php echo $product_id; ?> .data').html(''); editTool(<?php echo $product_id; ?>, 'lost_image', 'search');"><?php echo $text_search; ?></a> <label><input type="checkbox" name="lost_image[delete]" value="1" /> <?php echo $text_delete_entries; ?></label></td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--

//--></script>