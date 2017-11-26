<?php echo $header; ?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="view/kickstart/css/kickstart.css" media="all" /> <!-- KICKSTART -->
<style>
input[type='text'], input[type='password'] {
padding: 8px;
}
</style>
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
      <h1><img src="view/image/report.png" alt="" /> <?php echo $heading_title; ?></h1> 
		<div class="right">
        <?php if ($products) { ?><a class="button green" onclick="manualrun()"><?php echo $text_notify_customers; ?></a><?php } ?>
		<a onclick="$('#form').submit();" class="button blue"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button blue"><?php echo $button_cancel; ?></a>        
        </div>
  </div>
  <div class="content">
  <br>
      	<center><div id='loadgif' style='display:none;'><img src='view/image/loading-bar.gif'/></div></center>
		<div id="msgoutput" style="text-align:left;"></div>
   <br>

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	        <div id="tabs" class="htabs">
                <a href="#tab-records" data-toggle="tab"><?php echo $tab_records; ?></a>
                <a href="#tab-demand" data-toggle="tab"><?php echo $tab_demand; ?></a>
                <a href="#tab-email" data-toggle="tab"><?php echo $tab_email; ?></a>
                <a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a>
        	</div>
            
	         <div id="tab-records">
             <div class="content">
                <table width="100%" cellspacing="10px">
                <tr>
                
                <td style="background-color:#FFFF99; padding: 15px;">
                <b><?php echo $text_total_alert;?><?php echo $total_alert;?></b><br>
                <b><?php echo $text_total_responded;?><?php echo $total_responded;?></b><br><br>
                <div class="clearfix"></div>
                <div class="center"><a href="<?php echo $action;?>&filteroption=all" class="button small blue"><?php echo $text_show_all_reports;?></a> <a href="<?php echo $action;?>&delete=all" class="button small red"><?php echo $text_reset_all;?></a></div>
                </td>
                
                <td style="background-color:#CCFF99; padding: 15px;">
                <b><?php echo $text_customers_awaiting_notification;?><?php echo $awaiting_notification;?></b><br>
                <b><?php echo $text_number_of_products_demanded;?><?php echo $product_requested;?></b><br><br>
                <div class="clearfix"></div>
                <div class="center"><a href="<?php echo $action;?>&filteroption=awaiting" class="button small blue"><?php echo $text_show_awaiting_reports;?></a> <a href="<?php echo $action;?>&delete=awaiting" class="button small red"><?php echo $text_reset_awaiting;?></a></div>
                </td>
                
                <td style="background-color:#66CCFF; padding: 15px;">
                <b><?php echo $text_archive_records;?><?php echo $total_responded;?></b><br>
                <b><?php echo $text_customers_notified;?><?php echo $customer_notified;?></b><br><br>
                <div class="clearfix"></div>
                <div class="center">
                <a href="<?php echo $action;?>&filteroption=archive" class="button small blue"><?php echo $text_show_archive_reports;?></a> <a href="<?php echo $action;?>&delete=archive" class="button small red"><?php echo $text_reset_archive;?></a></div>
                </td>
                
                </tr>
                </table>
	
				<hr>

					<div class="col_12">
                      <h5><i class="fa fa-desktop"></i> <?php echo $current_report; ?></h5>
                      	<table class="list">
                        <thead>
                            <tr>
                            <td class="left"><?php echo $column_product_id; ?></td>
                            <td class="left"><?php echo $column_product_name; ?></td>
                            <td class="left"><?php echo $column_option; ?></td>
                            <td class="left"><?php echo $column_all_option; ?></td>
                            <td class="left"><?php echo $column_email; ?></td>
                            <td class="left"><?php echo $column_name; ?></td>
                            <td class="left"><?php echo $column_phone; ?></td>
                            <td class="left"><?php echo $column_language; ?></td>
                            <td class="left"><?php echo $column_enquiry_date; ?></td>
                            <td class="left"><?php echo $column_notify_date; ?></td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($products) { ?>
                          <?php foreach ($products as $product) { ?>
                          <tr>
                            <td class="right"><?php echo $product['product_id']; ?></td>
                            <td class="left"><a href="<?php echo $product['product_link']; ?>" target="_blank"><?php echo $product['name']; ?></a></td>
                            <td class="left"><?php echo $product['selected_option']; ?></td>
                            <td class="left"><?php echo $product['all_selected_option']; ?></td>
                            <td class="left"><?php echo $product['email']; ?></td>
                            <td class="left"><?php echo $product['fname']; ?></td>
                            <td class="left"><?php echo $product['phone']; ?></td>
                            <td class="left"><?php echo $product['language_code']; ?></td>
                            <td class="right"><?php echo $product['enquiry_date']; ?></td>
                            <td class="right"><?php echo $product['notify_date']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php } else { ?>
                          <tr>
                            <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                     	<div class="pagination"><?php echo $pagination; ?></div>
                     </div>
                     </div>
                </div> <!-- tab 1 end -->
                
                <div id="tab-demand">
                <div class="content">
                <div class="col_12">
                      <h5><i class="fa fa-bar-chart"></i> <?php echo $text_product_in_demand; ?></h5>
                      		<table class="list">
                            <thead>
                                        <tr>
                                        <td class="left"><?php echo $column_product_id; ?></td>
                                        <td class="left"><?php echo $column_product_name; ?></td>
                                        <td class="right"><?php echo $column_count; ?></td>
                                      </tr>
                                    </thead>
                                    <tbody>
                            
                            <?php if ($demands) { 
                            foreach ($demands as $demand) {
                            echo '<tr>';
                            echo '<td class="left">'.$demand['pid'].'</td>';
                            echo '<td class="left">'.$demand['name'].'</td>';
                            echo '<td class="right">'.$demand['count'].'</td>';
                            echo '</tr>';
                            }
                            }else { ?>
                                      <tr>
                                        <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
                                      </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                      </div> </div>
                </div>

				<div class="tab-pane" id="tab-email">
				
                <div id="languages" class="htabs">
                <?php foreach ($languages as $language) { ?>
                <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                <?php } ?>
              	</div>	  
                                  
                  <?php foreach ($languages as $language) { 
                        $language_code = md5($language['code']);
                  ?>
        			  <div id="language<?php echo $language['language_id']; ?>">
                           	 <h2><?php echo $text_header_admin; ?></h2>
                             <table class="form">
                            <tr>
                                <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
                                <td><input type="text" name="hb_oosn_admin_email_subject_<?php echo $language_code; ?>" size="100" value="<?php echo ${'hb_oosn_admin_email_subject_'.$language_code};?>" /></td>
                              </tr>
                              <tr>
                                <td><span class="required">*</span> <?php echo $entry_body; ?><span class="help"><?php echo $entry_store_codes; ?></span></td>
                                <td><textarea name="hb_oosn_admin_email_body_<?php echo $language_code; ?>" rows="20" cols="40" style="width: 99%"><?php echo ${'hb_oosn_admin_email_body_'.$language_code};?></textarea></td>
                              </tr>
                             </table>
		            		<hr>
                            
                            <h2><?php echo $text_header_customer; ?></h2>
							<table class="form">
                            <tr>
                                <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
                                <td><input type="text" name="hb_oosn_customer_email_subject_<?php echo $language['language_id']; ?>" size="100" value="<?php echo ${'hb_oosn_customer_email_subject_'.$language['language_id']};?>" /></td>
                              </tr>
                              <tr>
                                <td><span class="required">*</span> <?php echo $entry_body; ?><span class="help"><?php echo $entry_customer_codes; ?></span></td>
                                <td><textarea name="hb_oosn_customer_email_body_<?php echo $language['language_id']; ?>"  id="body_customer<?php echo $language['language_id']; ?>"><?php echo ${'hb_oosn_customer_email_body_'.$language['language_id']};?></textarea></td>
                              </tr>
                              
                            <tr>
                                <td><span class="required">*</span> <?php echo $text_product_image_size; ?></td>
                                <td><input name="hb_oosn_product_image_h_<?php echo $language['language_id']; ?>" type="text" size="3" value="<?php echo ${'hb_oosn_product_image_h_'.$language['language_id']};?>"> X <input name="hb_oosn_product_image_w_<?php echo $language['language_id']; ?>" type="text" size="3" value="<?php echo ${'hb_oosn_product_image_w_'.$language['language_id']};?>"></td>
                            </tr>
                              
                             </table>

                            <h2><?php echo $text_header_sms; ?></h2>
                            <table class="form">
                              <tr>
                                <td><span class="required">*</span> <?php echo $sms_body; ?><span class="help"><?php echo $entry_sms_codes; ?></span></td>
                                <td><textarea name="hb_oosn_customer_sms_body_<?php echo $language['language_id']; ?>" rows="20" cols="40" style="width: 99%"><?php echo ${'hb_oosn_customer_sms_body_'.$language['language_id']};?></textarea></td>
                              </tr>
                             </table>
                             </div>
                        <?php } ?>
	            </div>
	            
	            <div class="tab-pane" id="tab-setting">
				 <h2><?php echo $text_header_common; ?></h2>
                 <table class="form">
                    <tr>
                        <td><h5><b><?php echo $text_header_installation; ?></b></h5></td>
                        <td><div class="buttons">
                        <?php if ($hb_oosn_installed == 1){ ?>
                            <div style="color:#006600; font-weight:bold">THIS EXTENSION IS INSTALLED. <a onclick="$('#uninstall').toggle();" >[Show / Hide Uninstall Button]</a></div>
                            <div id="uninstall" style="display:none"><a onclick="location = '<?php echo $uninstall; ?>';" class="button red"><span>UNINSTALL</span></a></div>
                        <?php } else { ?>
                            <div style="color: #FF0000; font-weight:bold">THIS EXTENSION IS NOT INSTALLED.</div>
                            <a onclick="location = '<?php echo $install; ?>';" class="button green"><span>INSTALL</span></a>
                        <?php }  ?>	
                            </div></td>
                    </tr>
                 
                    <tr>
                        <td colspan="2"><h5><b><?php echo $text_header_form; ?></b></h5></td>
                    </tr>
                    
                    <tr>
                              <td><?php echo $entry_enable_name; ?></td>
                              <td><select name="hb_oosn_name_enable"  class="form-control">
                              <option value="y" <?php echo ($hb_oosn_name_enable == 'y')? 'selected':''; ?> >Yes</option>
                              <option value="n" <?php echo ($hb_oosn_name_enable == 'n')? 'selected':''; ?> >No</option>
                              </select></td>
                    </tr>
                    
                    <tr>
                              <td><?php echo $entry_enable_mobile; ?></td>
                              <td><select name="hb_oosn_mobile_enable"  class="form-control">
                              <option value="y" <?php echo ($hb_oosn_mobile_enable == 'y')? 'selected':''; ?> >Yes</option>
                              <option value="n" <?php echo ($hb_oosn_mobile_enable == 'n')? 'selected':''; ?> >No</option>
                              </select></td>
                    </tr>
                    
                    <tr>
                              <td><?php echo $entry_enable_sms; ?></td>
                              <td><select name="hb_oosn_sms_enable"  class="form-control">
                              <option value="y" <?php echo ($hb_oosn_sms_enable == 'y')? 'selected':''; ?> >Yes</option>
                              <option value="n" <?php echo ($hb_oosn_sms_enable == 'n')? 'selected':''; ?> >No</option>
                              </select></td>
                    </tr>
                    <tr>
                        <td><?php echo $text_mobile_validation; ?></td>
                        <td><input name="hb_oosn_mobile_validation"  class="form-control" type="text" value="<?php echo $hb_oosn_mobile_validation;?>"></td>
                    </tr>
                    
                    <tr>
                      <td><?php echo $entry_animation; ?></td>
                      <td><select name="hb_oosn_animation"  class="form-control">
                      <option value="mfp-zoom-in" <?php echo ($hb_oosn_animation == 'mfp-zoom-in')? 'selected':''; ?> >Zoom</option>
                      <option value="mfp-newspaper" <?php echo ($hb_oosn_animation == 'mfp-newspaper')? 'selected':''; ?> >Newspaper</option>
                      <option value="mfp-move-horizontal" <?php echo ($hb_oosn_animation == 'mfp-move-horizontal')? 'selected':''; ?>>Horizontal Move</option>
                      <option value="mfp-move-from-top" <?php echo ($hb_oosn_animation == 'mfp-move-from-top')? 'selected':''; ?>>Move from top</option>
                      <option value="mfp-3d-unfold" <?php echo ($hb_oosn_animation == 'mfp-3d-unfold')? 'selected':''; ?>>3D unfold</option>
                      <option value="mfp-zoom-out" <?php echo ($hb_oosn_animation == 'mfp-zoom-out')? 'selected':''; ?>>Zoom-out</option>
                      
                      </select></td>
                    </tr>
                    
                    <tr>
                            <td><?php echo $entry_css; ?></td>
                            <td><textarea name="hb_oosn_css"  class="form-control" rows="10" cols="40" style="width: 90%"><?php echo $hb_oosn_css;?></textarea></td>
                          </tr>
                
                    <tr>
                        <td colspan="2"><h5><b><?php echo $text_header_condition; ?></b></h5></td>
                    </tr>
                    
                    <tr>
                        <td><span class="required">*</span> <?php echo $text_product_qty; ?></td>
                        <td><input name="hb_oosn_product_qty"  class="form-control" type="text" value="<?php echo $hb_oosn_product_qty;?>"></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $text_product_stock_status; ?></td>
                        <td><select name="hb_oosn_stock_status"  class="form-control">
            
                        <option value="0" <?php echo ($hb_oosn_stock_status ==  '0')? 'selected':''; ?> >DISABLE THIS CONDITION</option>
                        <?php foreach ($stock_statuses as $stock_status) { ?>
                              <option value="<?php echo $stock_status['stock_status_id']; ?>" <?php echo ($hb_oosn_stock_status ==  $stock_status['stock_status_id'])? 'selected':''; ?> ><?php echo $stock_status['name']; ?></option>
                              <?php }?>
                              </select>			
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><h4><b><i class="fa fa-line-chart"></i> <?php echo $text_header_analytics; ?></b></h4></td>
                    </tr>
                    <tr>
                        <td><?php echo $text_campaign_source; ?></td>
                        <td><input name="hb_oosn_csource" placeholder="HuntBee"  class="form-control" type="text" value="<?php echo $hb_oosn_csource;?>"></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $text_campaign_medium; ?></td>
                        <td><input name="hb_oosn_cmedium" placeholder="stock_email"  class="form-control" type="text" value="<?php echo $hb_oosn_cmedium;?>"></td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $text_campaign_name; ?></td>
                        <td><input name="hb_oosn_cname" placeholder="Back In-Stock" class="form-control" type="text" value="<?php echo $hb_oosn_cname;?>"></td>
                    </tr>
                   
                  </table>
                  <br><hr>
                  <h2>CRON COMMAND TO SET UP IN CPANEL</h2>
				   <div class="notice warning"><b>NOTIFY TO CUSTOMER EMAILS:</b> <span style="color:green; font-weight:bold;">wget --quiet --delete-after "<?php echo HTTP_CATALOG;?>index.php?route=product/product_oosn/autonotify"</span></div>
				   <div class="notice warning"><b>DEMANDED OUT-OF-STOCK PRODUCTS EMAIL TO ADMIN :</b> <span style="color:green; font-weight:bold;">wget --quiet --delete-after "<?php echo HTTP_CATALOG;?>index.php?route=product/product_oosn/autonotify"</span></div>
	            </div>
	           
          </form>
      </div>
        <br /><center>
  <span class="help">PRODUCT STOCK NOTIFICATION PRO VERSION 7.6 (OpenCart 1.5.X) &copy; <a href="http://www.huntbee.com/">HUNTBEE.COM</a> | <a href="http://www.huntbee.com/index.php?route=account/support">SUPPORT</a></span></center>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
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
<script type="text/javascript">
function manualrun(){
	$('#msgoutput').html('');
	$('#loadgif').show();
	$.ajax({
		  type: 'post',
		  url: 'index.php?route=extension/hb_oosn/manualrun&token=<?php echo $token; ?>',
		  dataType: 'json',
		  success: function(json) {
				if (json['success']) {
					  $('#msgoutput').html(json['success']);
					  $('#loadgif').hide();
					  $("html, body").animate({ scrollTop: 0 }, "slow");
					  //window.setTimeout(function(){location.reload()},2000)
				}
		  },			
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}

	 });					
}
</script>
<?php echo $footer; ?>