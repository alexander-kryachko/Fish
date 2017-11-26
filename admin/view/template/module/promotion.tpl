
<!--author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (marketing@fisherway.com.ua fisherway.com.ua)-->
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
      <div class="buttons"><a onclick="$('#form-settings').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      
      <div id="tabs" class="htabs">
        <a href="#tab-promotions"><?php echo $tab_promotions; ?></a>
        <a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-support"><?php echo $tab_support; ?></a>
      </div>
    
        <div id="tab-promotions">
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-delete">
          
          <div class="buttons" style="float: right; margin:  0 5px 7px 0;">
            <a href="<?php echo $insert; ?>" class="button" style="margin-right: 5px;"><?php echo $button_insert; ?></a>
            <a onclick="$('#form-delete').submit();" class="button"><?php echo $button_delete; ?></a>
          </div>
          <table id="promotions" class="list">
            <thead>
              <tr>
                <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                <td class="left"><?php echo $promotion_image; ?></td>                            
                <td class="left"><?php echo $promotion_name; ?></td>              
                <td class="left"><?php echo $promotion_action; ?></td>  
              </tr>
            </thead>
            <tbody>

            <?php if ($promotions) { ?>
            <?php foreach ($promotions as $promotion) { ?>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" name="selected[]" value="<?php echo $promotion['promotion_id']; ?>" />
              </td>
              <td class="left"><img src="<?php echo $promotion['thumb']; ?>" /></td>
              <td class="left"><?php echo $promotion['name']; ?></td>
              <td class="left"><?php foreach ($promotion['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
            
            </tbody>
          </table>

          <div class="pagination">  
            <?php echo $pagination; ?>
          </div>  
        
        </form>  
        </div>
        
        <div id="tab-general">  
        <form action="<?php echo $action_settings; ?>" method="post" enctype="multipart/form-data" id="form-settings">
          <br />
          <table id="general" class="list" style="width: 700px;">
              <tr>
                <td class="left"><?php echo $text_key; ?></td>              
                <td width="500" style="text-align: left;">
                  <input type="text" size="70" name="promotion_options[key]" value="<?php echo isset($options['key']) ? $options['key'] : '';?>">
                </td>
              </tr>
          </table>          
          <br />
          <table id="general" class="list" style="width: 700px;">
			      <thead>
              <tr>
				        <td class="left"></td>
                <td class="left"><?php echo $text_product; ?></td>
				        <td class="left"><?php echo $text_category; ?></td>
              </tr>								  
			      </thead>
            <tbody >
              <tr>
                <td class="left"><?php echo $text_image_width; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[product][image_width]" value="<?php echo isset($options['product']['image_width']) ? $options['product']['image_width'] : '0';?>">
                </td>
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[category][image_width]" value="<?php echo isset($options['category']['image_width']) ? $options['category']['image_width'] : '0';?>">
                </td>
              </tr>
			        <tr>
                <td class="left"><?php echo $text_image_height; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[product][image_height]" value="<?php echo isset($options['product']['image_height']) ? $options['product']['image_height'] : '0';?>">
                </td>
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[category][image_height]" value="<?php echo isset($options['category']['image_height']) ? $options['category']['image_height'] : '0';?>">
                </td>
              </tr>
			        <tr>
                <td class="left"><?php echo $promotion_status; ?></td>              
                <td width="1" style="text-align: left;">
				          <select name="promotion_options[product][status]">
                    <option value="0" <?php echo (isset($options['product']['status']) && !$options['product']['status']) ?  'selected="selected"' : '';?>><?php echo $promotion_disable; ?></option>
                    <option value="1" <?php echo (isset($options['product']['status']) && $options['product']['status']) ?  'selected="selected"' : '';?>><?php echo $promotion_enable; ?></option>
                  </select>					
                </td>
                <td width="1" style="text-align: left;">
				          <select name="promotion_options[category][status]">
                    <option value="0" <?php echo (isset($options['category']['status']) && !$options['category']['status']) ?  'selected="selected"' : '';?>><?php echo $promotion_disable; ?></option>
                    <option value="1" <?php echo (isset($options['category']['status']) && $options['category']['status']) ?  'selected="selected"' : '';?>><?php echo $promotion_enable; ?></option>                    
                  </select>					
                </td>
              </tr>
            </tbody>
          </table>
          <br />
          
            <table id="general" class="list" style="width: 700px;">
			      <thead>
              <tr>
				        <td class="left"><?php echo $text_popup; ?></td>
                <td class="left"></td>
              </tr>								  
			      </thead>
            <tbody >
              <tr>
                <td class="left"><?php echo $text_popup_image_width; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[popup][image_width]" value="<?php echo isset($options['popup']['image_width']) ? $options['popup']['image_width'] : '0';?>">
                </td>
              </tr>
			        <tr>
                <td class="left"><?php echo $text_popup_image_height; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[popup][image_height]" value="<?php echo isset($options['popup']['image_height']) ? $options['popup']['image_height'] : '0';?>">
                </td>
              </tr>

              <tr>
                <td class="left"><?php echo $text_popup_product_image_width; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[popup_product][image_width]" value="<?php echo isset($options['popup_product']['image_width']) ? $options['popup_product']['image_width'] : '0';?>">
                </td>
              </tr>
			        <tr>
                <td class="left"><?php echo $text_popup_product_image_height; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[popup_product][image_height]" value="<?php echo isset($options['popup_product']['image_height']) ? $options['popup_product']['image_height'] : '0';?>">
                </td>
              </tr>
              
              <tr>
                <td class="left"><?php echo $text_popup_products; ?></td>              
                <td width="1" style="text-align: left;">
                  <input type="text" name="promotion_options[popup_products]" value="<?php echo isset($options['popup_products']) ? $options['popup_products'] : '0';?>">
                </td>
              </tr>
              
            </tbody>
          </table>
        
        </form>
        </div>
        
        <div id="tab-support">
          <?php echo $support_text; ?>
        </div>

    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<?php echo $footer; ?>