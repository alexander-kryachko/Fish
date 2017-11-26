<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="scp_grad" style="overflow: hidden;">
    <div style="float:left; margin-top: 10px;" >
    	<img src="view/image/blog-icon.png" style="height: 21px; margin-left: 10px; " >
    </div>

<div style="margin-left: 10px; float:left; margin-top: 10px;  color: #777;">
<ins style="color: #00A3D9; padding-top: 17px; text-shadow: 0 2px 1px #FFFFFF; padding-left: 3px;  font-weight: normal;  text-decoration: none; ">
<?php echo strip_tags($heading_title); ?> :: <?php  echo $theme;     ?>
</ins> ver.: <?php echo $blog_version; ?>
</div>

    <div class="scp_grad_green" style=" height: 40px; float:right; ">
      <div style="color: #555;margin-top: 2px; line-height: 18px; margin-left: 9px; margin-right: 9px; overflow: hidden;"><?php echo $language->get('heading_dev'); ?></div>
    </div>

</div>

  <div class="page-header">
    <div class="container-fluid">

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>


<div id="content1" style="border: none;">

<div style="clear: both; line-height: 1px; font-size: 1px;"></div>


<?php if ($error_warning) { ?>
    <div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>

<?php if ($success) { ?>
    <div class="alert alert-success success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>


<div class="box1">

<div class="content">

<?php echo $agoo_menu; ?>




      <div class="buttons" style="float:right;">
      <a onclick="$('#form').submit();" class="markbuttono asc_blinking nohref"><?php echo $language->get('button_adapter'); ?></a>
      <a onclick="location = '<?php echo $cancel; ?>';" class="markbuttono  nohref"><?php echo $language->get('button_cancel'); ?></a>
      </div>

      <div style="width: 100%; overflow: hidden; clear: both; height: 1px; line-height: 1px;">&nbsp;</div>


  <div class="box">
   <div class="content">

    	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          <table class="form">

			<tr style="vertical-align: text-top;">
				<td><?php echo $language->get('entry_sample_template'); ?></td>
				<td>
					<div class="input-group"><select class="form-control" id="id_sample_template"  name="sample_template">
						<option value="module/latest.tpl"  <?php if (isset($sample_template) &&  $sample_template=='module/latest.tpl')  { echo 'selected="selected"'; } ?>>module/latest.tpl</option>
						<option value="module/bestseller.tpl"  <?php if (isset($sample_template) &&  $sample_template=='module/bestseller.tpl')  { echo 'selected="selected"'; } ?>>module/bestseller.tpl</option>
						<option value="module/special.tpl" <?php if (isset($sample_template) &&  $sample_template=='module/special.tpl') { echo 'selected="selected"'; } ?>>module/special.tpl</option>
						<option value="module/featured.tpl" <?php if (isset($sample_template) &&  $sample_template=='module/featured.tpl') { echo 'selected="selected"'; } ?>>module/featured.tpl</option>
						<option value="product/product.tpl" <?php if (isset($sample_template) &&  $sample_template=='product/product.tpl') { echo 'selected="selected"'; } ?>>product/product.tpl</option>
					</select></div>
				</td>
			</tr>



            <tr style="vertical-align: top;">
              <td style="vertical-align: top;">
<div>
<a href="<?php echo $load_template; ?>" class="asc_blinking ajax_action markbuttono nohref"><?php echo $language->get('entry_load_template'); ?></a>
</div>
<br>
<div>
<a href="<?php echo $load_template_full; ?>" class="ajax_action markbuttono nohref"><?php echo $language->get('entry_load_template_full'); ?></a>
</div>
<br>
<div>
<a href="<?php echo $load_template_new; ?>" class="ajax_action markbuttono nohref"><?php echo $language->get('entry_load_template_new'); ?></a>
</div>
<br>
<a href="<?php echo $load_template_delete; ?>" class="ajax_action markbuttono button_purple nohref"><?php echo $language->get('entry_load_delete'); ?></a>
</div>
<br>

              <br>
              <br>
              <div id="file_theme">
              <?php echo $language->get('entry_success')."../<b>".$theme."</b>/template/".$file_theme; ?>
              </div>

            	<!--
            	<br>
            	<div class="blog-next-prev">
					<a data-sc-tooltip="<?php echo $language->get('text_help_adapter'); ?>"><?php echo $language->get('entry_help_adapter'); ?></a>
				</div>
                -->

              </td>
              <td style="vertical-align: top;">
               <div class="input-group">
				<span class="input-group-addon"></span>
               	<textarea name="success_file" id="text_area" class="form-control" rows="20" style="width: 100%;"><?php echo htmlspecialchars($success_data); ?></textarea>
               </div>
              </td>
            </tr>



            <tr>
              <td colspan="2" style="text-align: center;"><?php echo $language->get('html_help_adapter'); ?></td>

            </tr>


            <?php if (isset($replace_code) && !empty($replace_code)) { foreach ($replace_code as $num => $r_code) { ?>
            <tr>
              <td>
              <?php echo $language->get('entry_replace_text'); ?>
              </td>
              <td>
               <textarea name="replace_code[<?php echo $num; ?>][in]" style="width: 100%;"><?php echo $r_code['in']; ?></textarea>
               <?php echo $language->get('entry_replace_text_na'); ?>
               <textarea name="replace_code[<?php echo $num; ?>][out]" style="width: 100%;"><?php echo $r_code['out'];; ?></textarea>
              </td>
            </tr>
            <?php } } ?>


          <!--

            <tr>
              <td><?php echo $language->get('entry_remove_tag'); ?></td>
              <td>

               <?php
              if (isset($success_tag)) {
              foreach ($success_tag as $num => $tag) {
              if (in_array($tag, $remove_tag[$theme])) {

              ?>
               <input type="checkbox" value="<?php echo $tag; ?>" name="selected_tag[]" checked="checked" >
              <?php
              print_r($tag);
              } else {
              ?>
               <input type="checkbox" value="<?php echo $tag; ?>" name="selected_tag[]">
              <?php
              print_r($tag);
              }
               ?>
              <br>
              <?php
              }
              }
               ?>

              </td>
            </tr>


            <tr>
              <td><?php echo $language->get('entry_remove_id'); ?></td>
              <td>

               <?php
              if (isset($success_id)) {
              foreach ($success_id as $num => $id) {
              if (in_array($id, $remove_id[$theme])) {

              ?>
               <input type="checkbox" value="<?php echo $id; ?>" name="selected_id[]" checked="checked" >
              <?php
              print_r($id);
              } else {
              ?>
               <input type="checkbox" value="<?php echo $id; ?>" name="selected_id[]">
              <?php
              print_r($id);
              }
               ?>
              <br>
              <?php
              }
              }
               ?>

              </td>
            </tr>

            <tr>
              <td><?php echo $language->get('entry_remove_class'); ?></td>
              <td>

               <?php
              if (isset($success_class)) {
              foreach ($success_class as $num => $class) {              	foreach ($class as $n => $classic) {
              if (in_array($classic, $remove_class[$theme])) {
              ?>
               <input type="checkbox" value="<?php echo $classic; ?>" name="selected_class[<?php echo $classic; ?>][]" checked="checked" >
              <?php
              print_r($classic);
              } else {              ?>
               <input type="checkbox" value="<?php echo $classic; ?>" name="selected_class[<?php echo $classic; ?>][]">
              <?php
              print_r($classic);
              }
               ?>
              <br>
              <?php
              }
              }
              }
               ?>

              </td>
            </tr>

            <tr>
              <td><?php if (isset($time)) echo $time; ?></td>
              <td>

              </td>
            </tr>

           -->
          </table>


   		</form>
    </div>
  </div>
</div>

<script>

$('a.ajax_action').click(function() {
url_action = $(this).attr('href');
this_action = this;
$(this).append('<div id="loading"><\/div>');

 	$.ajax({
					url: url_action,
					type: 'post',
					async: true,
					data: $("#form").serialize(),
					dataType: 'html',
					beforeSend: function()
					{
                      $(this_action).addClass('loader');
                      $('#text_area').html('<?php echo strip_tags($language->get('text_loading_adapter')); ?>');
                       $('#loading').html('<?php echo $language->get('text_loading_adapter'); ?>');
  					},
					success: function(html) {
						if (html) {
                        	$('#text_area').html(html);
                        	$('#file_theme').html('');
                        	$('#loading').remove();
						}
						$(this_action).removeClass('loader');
					}
				});


return false;
});





</script>


</div>
<?php echo $footer; ?>