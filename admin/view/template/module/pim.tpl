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
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>

  </div>
  <div class="content">
  <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-server"><?php echo $tab_server; ?></a><a href="#tab-front"><?php echo $tab_front; ?></a><a href="#tab-help"><?php echo $tab_help; ?></a></div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
       <div id="tab-general">
          <table class="form">
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="pim_status">
                  <?php if ($pim_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr> 
            <tr>
              <td><?php echo $entry_miu_patch; ?></td>
              <td><select name="pim_miu">
                  <?php if ($pim_miu) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_aceshop; ?></td>
              <td><select name="pim_joomla">
                  <?php if ($pim_joomla) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr> 

          </table>
       </div>
       <div id="tab-server">
        <table class="form">
   
                      
            <tr>
                <td><?php echo $entry_delete_def_image; ?></td>
                <td>
                 <select name="pim_deletedef">
                  <option value="0" <?php if (!$pim_deletedef){ echo " selected";}?>><?php echo $text_no;?></option>
                  <option value="1" <?php if ($pim_deletedef){ echo " selected";}?>><?php echo $text_yes;?></option>
                 </select>
               </td>
            </tr>
            <tr>
              <td><?php echo $entry_copyOverwrite; ?></td>
              <td><select name="pim_copyOverwrite">
                  <?php if ($pim_copyOverwrite) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
            </tr>               
            <tr>
              <td><?php echo $entry_uploadOverwrite; ?></td>
              <td><select name="pim_uploadOverwrite">
                  <?php if ($pim_uploadOverwrite) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
            </tr>  
            <tr>
              <td><?php echo $entry_uploadMaxSize; ?></td>
              <td> <input type="text" name="pim_uploadMaxSize" value="<?php echo $pim_uploadMaxSize; ?>" size="4" /> Megabytes.</td>
            </tr>  
                       
                                            
        </table>
       </div>
       <div id="tab-front">
        <table class="form">
            <tr>
              <td><?php echo $entry_language; ?></td>
              <td><select name="pim_language">
                  <option value=""> EN </option>
                  <?php foreach ($langs as $l) {?>
                      <option value="<?php echo $l;?>" <?php if ($l==$pim_language){ echo " selected";}?>><?php echo strtoupper($l);?></option>
                  <?php } ?>
                </select></td>
            </tr>         
            <tr>
                <td><?php echo $entry_dimensions; ?></td>
                <td>
                  <input type="text" name="pim_width" value="<?php echo $pim_width; ?>" size="3" /> x
                  <input type="text" name="pim_height" value="<?php echo $pim_height; ?>" size="3" />                
                 </td>
            </tr>
                                    
        </table>
       </div>
       <div id="tab-help">
          <h1>Welcome and thank you for purchasing our module!</h1> 
          <br/>
          <h2>About this module</h2>
          <p>
            <b>Power Image Manager</b> is another great module developed by <a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=stone" target="_blank">WebNet</a>
          </p>
          <h2>Need Support?</h2>
            <a id="activate"  href="mailto: support@webnet.bg?subject=Power Image Manager on <?php echo HTTP_CATALOG;?>" class="green_button">Request support by Email</a>
            <br/>
          <h2>Happy about our modules?</h2>  
            <p>Please give as your vote & comment on <a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=stone" target="_blank">Opencart Extension Store</a></p>

       </div>              
    </form>
  </div>
</div>
<div class="modal"></div>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 


<?php echo $footer; ?>