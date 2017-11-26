<style type="text/css">
#form-image_bing_auto<?php echo $product_id; ?> ol {
	padding-left:20px;
}

#form-image_bing_auto<?php echo $product_id; ?> ol li {
	float:left;
	width:100%;
	height:28px;
}
</style>
<form id="form-image_bing_auto<?php echo $product_id; ?>">
 <table class="be-list">
  <thead>
   <tr>
    <td class="center" width="10%"><?php echo $text_number_images; ?>:</td>
    <td class="center" width="10%"><?php echo $text_main; ?>:</td>
    <td class="left" width="55%"><?php echo $text_folder; ?> (<?php echo $text_by_priority; ?>):</td>
    <td class="center" colspan="8"><?php echo $text_optional; ?>:</td>
   </tr>
  </thead>
  <tfoot>
   <tr>
    <td class="center">
     <select name="image_bing_auto[number_images]">
      <?php for ($count = 1; $count < 11; $count++) { ?>
      <option value="<?php echo $count; ?>"><?php echo $count; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center"><input name="image_bing_auto[main_image]" type="text" value="0" size="3" /></td>
    <td class="left">
     <ol>
      <li><?php echo $text_existing; ?></li>
      <?php if ($main_category) { ?>
      <li><?php echo $text_main_category; ?> (<?php echo $text_translit; ?>)</li>
      <?php } ?>
      <li><?php echo $text_category; ?> (<?php echo $text_translit; ?>)</li>
      <li>
       <?php echo $text_folder; ?>:
       <input class="image_bing_auto_directory" value="<?php echo $directory; ?>" disabled="disabled">
       <a onclick="$('#form-image_bing_auto<?php echo $product_id; ?> input.image_bing_auto_directory').after(' <input name=\'image_bing_auto[directory][]\' /> <span class=\'separator\'>/</span> ');"><img src="view/image/add.png" title="<?php echo $text_add; ?>" alt="<?php echo $text_add; ?>" /></a>
       <a onclick="$('#form-image_bing_auto<?php echo $product_id; ?> input[name=\'image_bing_auto[directory][]\']:last').remove(); $('#form-image_bing_auto<?php echo $product_id; ?> span.separator:last').remove();"><img src="view/image/delete.png" title="<?php echo $text_delete; ?>" alt="<?php echo $text_delete; ?>" /></a>
      </li>
     </ol>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][color]">
      <option value="">&mdash;&nbsp;<?php echo $text_color; ?>&nbsp;&mdash;</option>
      <option style="background:linear-gradient(to right, #999, #FFF)" value="Monochrome">Monochrome</option>
      <?php foreach ($filter['color'] as $value) { ?>
      <option style="background:<?php echo $value; ?>;" value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][size]">
      <option value="">&mdash;&nbsp;<?php echo $text_size; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['size'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][imageType]">
      <option value="">&mdash;&nbsp;<?php echo $text_image_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imageType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][imageContent]">
      <option value="">&mdash;&nbsp;<?php echo $text_image_content; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imageContent'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][aspect]">
      <option value="">&mdash;&nbsp;<?php echo $text_aspect; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['aspect'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][freshness]">
      <option value="">&mdash;&nbsp;<?php echo $text_freshness; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['freshness'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <select name="image_bing_auto[url][license]">
      <option value="">&mdash;&nbsp;<?php echo $text_license; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['license'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
    </td>
    <td class="center">
     <input type="text" name="image_bing_auto[url][width]" size="8" placeholder="<?php echo $text_width; ?>" />
     &times;
     <input type="text" name="image_bing_auto[url][height]" size="8" placeholder="<?php echo $text_height; ?>" />
    </td>
   </tr>
   <tr>
    <td class="left" colspan="11"><b><?php echo $text_keyword; ?>: <?php echo $keyword_field; ?></b></td>
   </tr>
   <tr>
    <td class="center" colspan="11"><a class="button" onclick="editTool('<?php echo $product_id; ?>', 'image_bing_auto', 'add');"><?php echo $text_add; ?></a></td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--

//--></script>