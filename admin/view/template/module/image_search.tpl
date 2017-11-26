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
      
      <h3><a href="<?php echo $search_page_link; ?>"><?php echo $search_page_go_text; ?></a></h3>
      
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        
        <table id="general" class="list">
          <tbody >
            
            <!--
            <tr>
              <td width="150"><?php echo $image_path; ?></td>              
              <td class="left">
                <input type="text" name="image_search_options[image_path]" value="<?php echo isset($options['image_path']) ? $options['image_path'] : '';?>">
              </td>
            </tr>          
            -->
            
            <input type="hidden" name="image_search_options[image_path]" value="<?php echo isset($options['image_path']) ? $options['image_path'] : '';?>">
            
            <tr>
              <td width="150"><?php echo $product_count; ?></td>              
              <td class="left">
                <input type="text" name="image_search_options[product_count]" value="<?php echo isset($options['product_count']) ? $options['product_count'] : '';?>">
              </td>
            </tr>                    

            <tr>
              <td width="150"><?php echo $search_where; ?></td>              
              <td class="left">
                <input type="checkbox" name="image_search_options[search_where][model]" value="1" <?php echo isset($options['search_where']['model']) && $options['search_where']['model'] ? "checked='checked'" : "";?> /><?php echo $search_where_model; ?>
                <input type="checkbox" name="image_search_options[search_where][name]" value="1" <?php echo isset($options['search_where']['name']) && $options['search_where']['name'] ? "checked='checked'" : "";?> /><?php echo $search_where_name; ?>
                <input type="checkbox" name="image_search_options[search_where][sku]" value="1" <?php echo isset($options['search_where']['sku']) && $options['search_where']['sku'] ? "checked='checked'" : "";?> /><?php echo $search_where_sku; ?>                                
              </td>
            </tr>                    

            <tr>
              <td width="150"><?php echo $server_timeout; ?></td>              
              <td class="left">
                <input type="text" name="image_search_options[server_timeout]" value="<?php echo isset($options['server_timeout']) ? $options['server_timeout'] : '';?>">
              </td>
            </tr>                    

          </tbody>
        </table>

        <table id="search" class="list">
          <tbody >
          
            <tr>
              <td width="150"><?php echo $site_search; ?></td>              
              <td class="left">
                <input type="text" name="image_search_options[SiteRestriction]" value="<?php echo isset($options['SiteRestriction']) ? $options['SiteRestriction'] : '';?>">
              </td>
            </tr>          
            
            <tr>
              <td width="150"><?php echo $safe_search; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_SAFESEARCH]">
                  <option value="" ></option>
                  <option value="SAFESEARCH_STRICT" <?php echo (isset($options['RESTRICT_SAFESEARCH']) && $options['RESTRICT_SAFESEARCH'] == 'SAFESEARCH_STRICT') ? 'selected="selected"' : "" ;?>><?php echo $safe_search_strict; ?></option>
                  <option value="SAFESEARCH_MODERATE" <?php echo (isset($options['RESTRICT_SAFESEARCH']) && $options['RESTRICT_SAFESEARCH'] == 'SAFESEARCH_MODERATE') ? 'selected="selected"' : "" ;?>><?php echo $safe_search_moderate; ?></option>
                  <option value="SAFESEARCH_OFF" <?php echo (isset($options['RESTRICT_SAFESEARCH']) && $options['RESTRICT_SAFESEARCH'] == 'SAFESEARCH_OFF') ? 'selected="selected"' : "" ;?>><?php echo $safe_search_off; ?></option>

                </select>
              </td>  
            </tr>

            <tr>
              <td width="150"><?php echo $image_size; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_IMAGESIZE]">
                  <option value="" ></option>
                  <option value="IMAGESIZE_SMALL" <?php echo (isset($options['RESTRICT_IMAGESIZE']) && $options['RESTRICT_IMAGESIZE'] == 'IMAGESIZE_SMALL') ? 'selected="selected"' : "" ;?>><?php echo $image_size_small; ?></option>
                  <option value="IMAGESIZE_MEDIUM" <?php echo (isset($options['RESTRICT_IMAGESIZE']) && $options['RESTRICT_IMAGESIZE'] == 'IMAGESIZE_MEDIUM') ? 'selected="selected"' : "" ;?>><?php echo $image_size_medium; ?></option>
                  <option value="IMAGESIZE_LARGE" <?php echo (isset($options['RESTRICT_IMAGESIZE']) && $options['RESTRICT_IMAGESIZE'] == 'IMAGESIZE_LARGE') ? 'selected="selected"' : "" ;?>><?php echo $image_size_large; ?></option>
                  <option value="IMAGESIZE_EXTRA_LARGE" <?php echo (isset($options['RESTRICT_IMAGESIZE']) && $options['RESTRICT_IMAGESIZE'] == 'IMAGESIZE_EXTRA_LARGE') ? 'selected="selected"' : "" ;?>><?php echo $image_size_extra_large; ?></option>                                                      
                </select>
              </td>  
            </tr>

            <tr>
              <td width="150"><?php echo $image_colorization; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_COLORIZATION]">
                  <option value="" ></option>
                  <option value="COLORIZATION_GRAYSCALE" <?php echo (isset($options['RESTRICT_COLORIZATION']) && $options['RESTRICT_COLORIZATION'] == 'COLORIZATION_GRAYSCALE') ? 'selected="selected"' : "" ;?>><?php echo $image_colorization_grayscale; ?></option>
                  <option value="COLORIZATION_COLOR" <?php echo (isset($options['RESTRICT_COLORIZATION']) && $options['RESTRICT_COLORIZATION'] == 'COLORIZATION_COLOR') ? 'selected="selected"' : "" ;?>><?php echo $image_colorization_color; ?></option>
                </select>
              </td>  
            </tr>

            <tr>
              <td width="150"><?php echo $image_color_filter; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_COLORFILTER]">
                  <option value="" ></option>
                  <option value="COLOR_BLACK" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_BLACK') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_black; ?></option>
                  <option value="COLOR_BLUE" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_BLUE') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_blue; ?></option>
                  <option value="COLOR_BROWN" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_BROWN') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_brown; ?></option>
                  <option value="COLOR_GRAY" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_GRAY') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_gray; ?></option>
                  <option value="COLOR_GREEN" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_GREEN') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_green; ?></option>
                  <option value="COLOR_ORANGE" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_ORANGE') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_orange; ?></option>
                  <option value="COLOR_PINK" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_PINK') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_pink; ?></option>
                  <option value="COLOR_PURPLE" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_PURPLE') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_purple; ?></option>
                  <option value="COLOR_RED" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_RED') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_red; ?></option>
                  <option value="COLOR_TEAL" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_TEAL') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_teal; ?></option>
                  <option value="COLOR_WHITE" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_WHITE') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_white; ?></option>
                  <option value="COLOR_YELLOW" <?php echo (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER'] == 'COLOR_YELLOW') ? 'selected="selected"' : "" ;?>><?php echo $image_color_filter_yellow; ?></option>
                </select>
              </td>  
            </tr>

            <tr>
              <td width="150"><?php echo $file_type; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_FILETYPE]">
                  <option value="" ></option>
                  <option value="FILETYPE_JPG" <?php echo (isset($options['RESTRICT_FILETYPE']) && $options['RESTRICT_FILETYPE'] == 'FILETYPE_JPG') ? 'selected="selected"' : "" ;?>><?php echo $file_type_jpg; ?></option>
                  <option value="FILETYPE_PNG" <?php echo (isset($options['RESTRICT_FILETYPE']) && $options['RESTRICT_FILETYPE'] == 'FILETYPE_PNG') ? 'selected="selected"' : "" ;?>><?php echo $file_type_png; ?></option>
                  <option value="FILETYPE_GIF" <?php echo (isset($options['RESTRICT_FILETYPE']) && $options['RESTRICT_FILETYPE'] == 'FILETYPE_GIF') ? 'selected="selected"' : "" ;?>><?php echo $file_type_gif; ?></option>
                  <option value="FILETYPE_BMP" <?php echo (isset($options['RESTRICT_FILETYPE']) && $options['RESTRICT_FILETYPE'] == 'FILETYPE_BMP') ? 'selected="selected"' : "" ;?>><?php echo $file_type_bmp; ?></option>
                </select>
              </td>  
            </tr>

            <tr>
              <td width="150"><?php echo $image_type; ?></td>
              <td class="left">
                <select name="image_search_options[RESTRICT_IMAGETYPE]">
                  <option value="" ></option>
                  <option value="IMAGETYPE_FACES" <?php echo (isset($options['RESTRICT_IMAGETYPE']) && $options['RESTRICT_IMAGETYPE'] == 'IMAGETYPE_FACES') ? 'selected="selected"' : "" ;?>><?php echo $image_type_faces; ?></option>
                  <option value="IMAGETYPE_PHOTO" <?php echo (isset($options['RESTRICT_IMAGETYPE']) && $options['RESTRICT_IMAGETYPE'] == 'IMAGETYPE_PHOTO') ? 'selected="selected"' : "" ;?>><?php echo $image_type_photo; ?></option>
                  <option value="IMAGETYPE_CLIPART" <?php echo (isset($options['RESTRICT_IMAGETYPE']) && $options['RESTRICT_IMAGETYPE'] == 'IMAGETYPE_CLIPART') ? 'selected="selected"' : "" ;?>><?php echo $image_type_clipart; ?></option>
                  <option value="IMAGETYPE_LINEART" <?php echo (isset($options['RESTRICT_IMAGETYPE']) && $options['RESTRICT_IMAGETYPE'] == 'IMAGETYPE_LINEART') ? 'selected="selected"' : "" ;?>><?php echo $image_type_lineart; ?></option>                                    
                </select>
              </td>  
            </tr>

            <tr>
              <td width="150">
                <?php echo $image_rights; ?>
                <br />
                <?php echo $image_rights_more_link; ?>
              </td>
              <td class="left">
                <select name="image_search_options[RESTRICT_RIGHTS]">
                  <option value="" ></option>
                  <option value="RIGHTS_REUSE" <?php echo (isset($options['RESTRICT_RIGHTS']) && $options['RESTRICT_RIGHTS'] == 'RIGHTS_REUSE') ? 'selected="selected"' : "" ;?>><?php echo $image_rights_reuse; ?></option>
                  <option value="RIGHTS_COMERCIAL_REUSE" <?php echo (isset($options['RESTRICT_RIGHTS']) && $options['RESTRICT_RIGHTS'] == 'RIGHTS_COMERCIAL_REUSE') ? 'selected="selected"' : "" ;?>><?php echo $image_rights_commercial_reuse; ?></option>
                  <option value="RIGHTS_MODIFICATION" <?php echo (isset($options['RESTRICT_RIGHTS']) && $options['RESTRICT_RIGHTS'] == 'RIGHTS_MODIFICATION') ? 'selected="selected"' : "" ;?>><?php echo $image_rights_modification; ?></option>
                  <option value="RIGHTS_COMMERCIAL_MODIFICATION" <?php echo (isset($options['RESTRICT_RIGHTS']) && $options['RESTRICT_RIGHTS'] == 'RIGHTS_COMMERCIAL_MODIFICATION') ? 'selected="selected"' : "" ;?>><?php echo $image_rights_commercial_modification; ?></option>

                </select>
              </td>  
            </tr>

          </tbody>
        </table>
                     
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
//--></script> 
<?php echo $footer; ?>
