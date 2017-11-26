<?php
####################################################################################################
#  Cloudcache CDN Integration for Opencart 1.5.1.x from HostJars http://opencart.hostjars.com      #
####################################################################################################
?><?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
      	<tr>
      		<td><?php echo $entry_cdn_status; ?></td>
      		<td>
      			<select name="cdn_status">
	                <?php if ($cdn_status) { ?>
	                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	                <option value="0"><?php echo $text_disabled; ?></option>
	                <?php } else { ?>
	                <option value="1"><?php echo $text_enabled; ?></option>
	                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	                <?php } ?>
           		</select>
           	</td>
        </tr>
        <tr>
        	<td><?php echo $entry_cdn_domain; ?></td>
        	<td><input type="text" name="cdn_domain" size="50" value="<?php echo $cdn_domain; ?>"/></td>
        </tr>
        <tr>
        	<td><?php echo $entry_cdn_images; ?></td>
        	<td><input type="checkbox" name="cdn_images" value="1" <?php echo ($cdn_images) ? 'checked="checked"' : ''; ?>"/></td>
        </tr>
        <tr>
        	<td><?php echo $entry_cdn_js; ?></td>
        	<td><input type="checkbox" name="cdn_js" value="1" <?php echo ($cdn_js) ? 'checked="checked"' : ''; ?>"/></td>
        </tr>
        <tr>
        	<td><?php echo $entry_cdn_css; ?></td>
        	<td><input type="checkbox" name="cdn_css" value="1" <?php echo ($cdn_css) ? 'checked="checked"' : ''; ?>"/></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php echo $footer; ?>