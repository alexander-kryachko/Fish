<style type="text/css">
#form-image_google_auto<?php echo $product_id; ?> ol {
	padding-left:20px;
}

#form-image_google_auto<?php echo $product_id; ?> ol li {
	float:left;
	width:100%;
	height:28px;
}
</style>
<form id="form-image_google_auto<?php echo $product_id; ?>">
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="10%"><?php echo $text_number_images; ?>:</td>
    <td class="center" width="10%"><?php echo $text_main; ?>:</td>
    <td class="left" width="55%"><?php echo $text_folder; ?> (<?php echo $text_by_priority; ?>):</td>
    <td class="center" colspan="5"><?php echo $text_optional; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center">
     <select name="image_google_auto[number_images]">
      <?php for ($count = 1; $count < 11; $count++) { ?>
      <option value="<?php echo $count; ?>"><?php echo $count; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center"><input name="image_google_auto[main_image]" type="text" value="0" size="3" /></td>
    <td class="left">
     <ol>
      <li><?php echo $text_existing; ?></li>
      <?php if ($main_category) { ?>
      <li><?php echo $text_main_category; ?> (<?php echo $text_translit; ?>)</li>
      <?php } ?>
      <li><?php echo $text_category; ?> (<?php echo $text_translit; ?>)</li>
      <li>
       <?php echo $text_folder; ?>:
       <input class="image_google_auto_directory" value="<?php echo $directory; ?>" disabled="disabled">
       <a onclick="$('#form-image_google_auto<?php echo $product_id; ?> input.image_google_auto_directory').after(' <input name=\'image_google_auto[directory][]\' /> <span class=\'separator\'>/</span> ');"><img src="view/image/add.png" title="<?php echo $text_add; ?>" alt="<?php echo $text_add; ?>" /></a>
       <a onclick="$('#form-image_google_auto<?php echo $product_id; ?> input[name=\'image_google_auto[directory][]\']:last').remove(); $('#form-image_google_auto<?php echo $product_id; ?> span.separator:last').remove();"><img src="view/image/delete.png" title="<?php echo $text_delete; ?>" alt="<?php echo $text_delete; ?>" /></a>
      </li>
     </ol>
    </td>
    <td class="center">
     <select name="image_google_auto[url][fileType]">
      <option value="">&mdash;&nbsp;<?php echo $text_file_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['fileType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_google_auto[url][imgDominantColor]">
      <option value="">&mdash;&nbsp;<?php echo $text_color; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgDominantColor'] as $value) { ?>
      <option value="<?php echo $value; ?>" style="background:<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_google_auto[url][imgColorType]">
      <option value="">&mdash;&nbsp;<?php echo $text_colorization; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgColorType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_google_auto[url][imgSize]">
      <option value="">&mdash;&nbsp;<?php echo $text_size; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgSize'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_google_auto[url][imgType]">
      <option value="">&mdash;&nbsp;<?php echo $text_image_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </td>
   </tr>
   <tr>
    <td class="left" colspan="8"><b><?php echo $text_keyword; ?>: <?php echo $keyword_field; ?></b></td>
   </tr>
   <tr>
    <td class="center" colspan="8"><a class="button" onclick="editTool('<?php echo $product_id; ?>', 'image_google_auto', 'add');"><?php echo $text_add; ?></a></td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--

//--></script>