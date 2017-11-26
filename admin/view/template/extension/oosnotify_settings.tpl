<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
  <div class="box">
  
  <div class="heading">
    <h1><img src="view/image/setting.png" alt="" /> <?php echo $heading_title_setting; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
  
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	
	<!-- SMS COMMON SETTING -->
     <h2><?php echo $text_header_common; ?></h2>
     <table class="form">
	 	<tr>
			<td><h3><?php echo $text_header_installation; ?></h3></td>
			<td><div class="buttons">
			<?php if ($this->config->get('hb_oosn_installed') == 1){ ?>
				<div style="color:#006600; font-weight:bold">THIS EXTENSION IS INSTALLED. <a onclick="$('#uninstall').toggle();" >[Show / Hide Uninstall Button]</a></div>
				<div id="uninstall" style="display:none"><a onclick="location = '<?php echo $uninstall; ?>';" class="button"><span>UNINSTALL</span></a></div>
			<?php } else { ?>
				<div style="color: #FF0000; font-weight:bold">THIS EXTENSION IS NOT INSTALLED.</div>
				<a onclick="location = '<?php echo $install; ?>';" class="button"><span>INSTALL</span></a>
			<?php }  ?>	
				</div></td>
		</tr>
	 
	 	<tr>
			<td colspan="2"><h3><?php echo $text_header_form; ?></h3></td>
		</tr>
		
		<tr>
		          <td><?php echo $entry_enable_name; ?></td>
		          <td><select name="hb_oosn_name_enable">
				  <option value="y" <?php echo ($this->config->get('hb_oosn_name_enable') == 'y')? 'selected':''; ?> >Yes</option>
				  <option value="n" <?php echo ($this->config->get('hb_oosn_name_enable') == 'n')? 'selected':''; ?> >No</option>
				  </select></td>
		</tr>
		
		<tr>
		          <td><?php echo $entry_enable_mobile; ?></td>
		          <td><select name="hb_oosn_mobile_enable">
				  <option value="y" <?php echo ($this->config->get('hb_oosn_mobile_enable') == 'y')? 'selected':''; ?> >Yes</option>
				  <option value="n" <?php echo ($this->config->get('hb_oosn_mobile_enable') == 'n')? 'selected':''; ?> >No</option>
				  </select></td>
		</tr>
		
		<tr>
		          <td><?php echo $entry_effect; ?></td>
		          <td><select name="hb_oosn_pp_effect">
				  <option value="bounce" <?php echo ($this->config->get('hb_oosn_pp_effect') == 'bounce')? 'selected':''; ?> >Bounce</option>
				  <option value="pulsate" <?php echo ($this->config->get('hb_oosn_pp_effect') == 'pulsate')? 'selected':''; ?> >Pulsate</option>
				  <option value="shake" <?php echo ($this->config->get('hb_oosn_pp_effect') == 'shake')? 'selected':''; ?> >Shake</option>
				  <option value="slide" <?php echo ($this->config->get('hb_oosn_pp_effect') == 'slide')? 'selected':''; ?> >Slide</option>
				  </select></td>
		</tr>
        
        <tr>
          <td><?php echo $entry_animation; ?></td>
          <td><select name="hb_oosn_animation">
		  <option value="mfp-zoom-in" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-zoom-in')? 'selected':''; ?> >Zoom</option>
		  <option value="mfp-newspaper" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-newspaper')? 'selected':''; ?> >Newspaper</option>
		  <option value="mfp-move-horizontal" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-move-horizontal')? 'selected':''; ?>>Horizontal Move</option>
		  <option value="mfp-move-from-top" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-move-from-top')? 'selected':''; ?>>Move from top</option>
		  <option value="mfp-3d-unfold" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-3d-unfold')? 'selected':''; ?>>3D unfold</option>
		  <option value="mfp-zoom-out" <?php echo ($this->config->get('hb_oosn_animation') == 'mfp-zoom-out')? 'selected':''; ?>>Zoom-out</option>
		  
		  </select></td>
        </tr>
        
		<tr>
                <td><?php echo $entry_css; ?></td>
                <td><textarea name="hb_oosn_css" rows="10" cols="40" style="width: 90%"><?php echo $this->config->get('hb_oosn_css');?></textarea></td>
              </tr>
	
     	<tr>
			<td colspan="2"><h3><?php echo $text_header_condition; ?></h3></td>
		</tr>
		
		<tr>
            <td><span class="required">*</span> <?php echo $text_product_qty; ?></td>
			<td><input name="hb_oosn_product_qty" type="text" value="<?php echo $this->config->get('hb_oosn_product_qty');?>"></td>
        </tr>
		
		<tr>
            <td><?php echo $text_product_stock_status; ?></td>
			<td><select name="hb_oosn_stock_status">
			<option value="0" <?php echo ($this->config->get('hb_oosn_stock_status') ==  '0')? 'selected':''; ?> >DISABLE THIS CONDITION</option>
			<?php foreach ($stock_statuses as $stock_status) { ?>
				  <option value="<?php echo $stock_status['stock_status_id']; ?>" <?php echo ($this->config->get('hb_oosn_stock_status') ==  $stock_status['stock_status_id'])? 'selected':''; ?> ><?php echo $stock_status['name']; ?></option>
				  <?php }?>
				  </select>			
			</td>
        </tr>
		
       
      </table>
      <hr>

	<h3><?php echo $text_header_email; ?></h3>
	<div class="vtabs">
		<a href="#tab-admin"><?php echo $text_admin_tab; ?></a>
		<a href="#tab-customer"><?php echo $text_customer_tab; ?></a>
		
	</div>
	
      <div id="tab-admin" class="vtabs-content">
      	<h2><?php echo $text_header_admin; ?></h2>

      	<div id="tab-general">
          	<div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
        	</div>
        
			<?php foreach ($languages as $language) { ?>
          	<div id="language<?php echo $language['language_id']; ?>">
			<table class="form">
			
			<tr>
                <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
                <td><input type="text" name="hb_oosn_admin_email_subject_<?php echo $language['code']; ?>" size="100" value="<?php echo $this->config->get('hb_oosn_admin_email_subject_'.$language['code']);?>" /></td>
              </tr>
			  <tr>
                <td><span class="required">*</span> <?php echo $entry_body; ?><span class="help"><?php echo $entry_store_codes; ?></span></td>
                <td><textarea name="hb_oosn_admin_email_body_<?php echo $language['code']; ?>" rows="20" cols="40" style="width: 99%"><?php echo $this->config->get('hb_oosn_admin_email_body_'.$language['code']);?></textarea></td>
              </tr>
			  
			 </table>
			</div> 
			<?php } ?>
			
      	</div>
      </div>
	  
	  <div id="tab-customer" class="vtabs-content">
      	<h2><?php echo $text_header_customer; ?></h2>

      	<div id="tab-general">
          	<div id="languages2" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language2<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
        	</div>
        
			<?php foreach ($languages as $language) { ?>
          	<div id="language2<?php echo $language['language_id']; ?>">
			<table class="form">
			<tr>
                <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
                <td><input type="text" name="hb_oosn_customer_email_subject_<?php echo $language['language_id']; ?>" size="100" value="<?php echo $this->config->get('hb_oosn_customer_email_subject_'.$language['language_id']);?>" /></td>
              </tr>
			  <tr>
                <td><span class="required">*</span> <?php echo $entry_body; ?><span class="help"><?php echo $entry_customer_codes; ?></span></td>
                <td><textarea name="hb_oosn_customer_email_body_<?php echo $language['language_id']; ?>"  id="body_customer<?php echo $language['language_id']; ?>"><?php echo $this->config->get('hb_oosn_customer_email_body_'.$language['language_id']);?></textarea></td>
              </tr>
			  
			<tr>
				<td><span class="required">*</span> <?php echo $text_product_image_size; ?></td>
				<td><input name="hb_oosn_product_image_h_<?php echo $language['language_id']; ?>" type="text" size="3" value="<?php echo $this->config->get('hb_oosn_product_image_h_'.$language['language_id']) ?>"> X <input name="hb_oosn_product_image_w_<?php echo $language['language_id']; ?>" type="text" size="3" value="<?php echo $this->config->get('hb_oosn_product_image_w_'.$language['language_id'])?>"></td>
			</tr>
			  
			 </table>
			</div> 
			<?php } ?>
			
      	</div>
      </div>

        
    </form>
  </div>
  <br /><center>
  <span class="help">Product Out-of-Stock Notification Version 4.2 &copy; <a href="http://www.huntbee.in/">HUNTBEE.IN</a> | DEVELOPER CODE: WEBGURUINDIA</span></center>
</div>

<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
$('#languages2 a').tabs();
//--></script> 
<script type="text/javascript" src="view/javascript/ckeditor-full/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('body_customer<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>   

<?php echo $footer; ?>