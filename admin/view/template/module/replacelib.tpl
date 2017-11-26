<?php echo $header; ?>
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
   <?php $class = 'odd'; ?>
    <div class="heading">
      <h1><img src="view/image/user-group.png" alt="" /> <?php echo $heading_title; ?></h1>
	    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a href="<?php echo $cancel; ?>" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"> 
	<table class="list" align="center">
	<thead>
	 <tr>
	 <td class="left" colspan="3">
	 Libraries detected on your installation which can be loaded from google CDN
	 </td>
	
	 </tr>
	 
	 </thead>
	 <tr>
	 <td class="left" colspan="3" style="spacing:70px">
	  <div class="scrollbox" style="width: 435px; height:162px; ">
	 <?php foreach($jquery_js as $min_file){
	 $checked='';
	 $this->load->model('module/replacelib');
	  $total_data=$this->model_module_replacelib->selectdata($min_file);
	  if(count($total_data)>0)
	  {
	  if($total_data[0]['status']=='1')
	  {
	   $checked='checked=checked';
	  }
	  }
	 ?>
	     <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class; ?>" style="height:22px;">
				<input type="checkbox" name="min_js[]" value="<?php echo $min_file; ?>" <?php echo $checked?> />
                  <?php echo $min_file; ?>
			</div>
        <?php }?>
		</div>
		 <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a><br><br>
		 <div>
		 Check to shift to the Google CDN
		 </div>
		 </td>
		
        <tr>
		<td style="padding:7px;font-size: 14px;">
		 <div style="height:200px;width:300px" align="left">
		 <?php echo $plugin_description; ?>
          </div>
		  </td>
		  <td style="padding:7px;font-size: 14px;">
		 <div style="height:200px;width:300px" align="left">
		 <?php echo $plugin_description1; ?>
          </div>
		  </td>
		  <td style="padding:7px;font-size: 14px;">
		 <div style="height:200px;width:300px" align="left">
		 <?php echo $plugin_description2; ?>
          </div>
		  </td>
        </tr>		
	   </table>
	    <div align="center">
        <label><a href="http://www.transpacific-software.com/opencart_development_theme_installation_extensions.php">Developed by Transpacific Software</a><br>
		       Support:&nbsp&nbsp<a href="http://www.transpacific-software.com/opencart.php">connect@transpacific.in
		</label>
         </div>	
        </div>	   
      </form>
	  	  
    </div>
  </div>
</div>
<?php echo $footer; ?> 