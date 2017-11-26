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
      <div class="buttons"><a onclick="$('#apply').val(1); $('#form').submit();" class="button"><span><?php echo $button_apply; ?></span></a><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a href="<?php echo $cancel; ?>" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
        <input type="hidden" name="apply" id="apply" value="0" />
        <div class="vtabs">
          <?php $module_row = 1; ?>
          <?php foreach ($modules as $module) { ?>
          <a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>">
          <?php if (!empty($module['module_name'])) { ?>
          <?php echo $module['module_name']; ?>
          <?php } else { ?>
          <?php echo $tab_module . ' ' . $module_row; ?>
          <?php } ?>
          &nbsp;<img src="view/image/delete.png" alt="" onclick="$('.vtabs a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false;" /></a>
          <?php $module_row++; ?>
          <?php } ?>
          <span id="module-add"><?php echo $button_add_module; ?>&nbsp; <img src="view/image/add.png" alt="" onclick="addModule();" /></span></div>
        <?php $module_row = 1; ?>
        <?php $custom_link_row = 1; ?>
        <?php foreach ($modules as $module) { ?>
        <div id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
          <div id="tabs-<?php echo $module_row; ?>" class="htabs"><a href="#tab-module-setting-<?php echo $module_row; ?>"><?php echo $tab_module_setting; ?></a><a href="#tab-menu-setting-<?php echo $module_row; ?>"><?php echo $tab_menu_setting; ?></a><a href="#tab-other-<?php echo $module_row; ?>"><?php echo $tab_other; ?></a></div>
          <div id="tab-module-setting-<?php echo $module_row; ?>">
            <table class="form">
              <tr>
                <td><?php echo $entry_name; ?></td>
                <td><input type="text" name="category_menu_module[<?php echo $module_row; ?>][module_name]" value="<?php echo isset($module['module_name']) ? $module['module_name'] : ''; ?>" class="span3" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_store; ?></td>
                <td><div class="row">
                    <div class="span3">
                      <label class="checkbox">
                        <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][store_id][]" value="0" <?php echo isset($module['store_id']) && in_array(0, $module['store_id']) ? 'checked="checked" ' : ''; ?> />
                        <?php echo $default_store; ?> </label>
                      <?php foreach ($stores as $store) { ?>
                      <label class="checkbox">
                        <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][store_id][]" value="<?php echo $store['store_id']; ?>" <?php echo isset($module['store_id']) && in_array($store['store_id'], $module['store_id']) ? 'checked="checked" ' : ''; ?> />
                        <?php echo $store['name']; ?> </label>
                      <?php } ?>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td><?php echo $entry_layout; ?></td>
                <td><select name="category_menu_module[<?php echo $module_row; ?>][layout_id]" class="span3" onchange="if ($(this).val() == '3') {$('#featured-cid-<?php echo $module_row; ?>').show();} else {$('#featured-cid-<?php echo $module_row; ?>').hide();}">
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr id="featured-cid-<?php echo $module_row; ?>" <?php echo ($module['layout_id'] == '3' ? '' : 'style="display:none;"'); ?>>
                <td><?php echo $entry_featured_cat; ?></td>
                <td><div class="scrollbox">
                    <?php $class = 'odd'; ?>
                    <?php foreach ($categories as $category) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (!empty($module['featured_cid']) && in_array($category['category_id'], $module['featured_cid'])) { ?>
                      <label>
                        <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][featured_cid][]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                        <?php echo $category['name']; ?> </label>
                      <?php } else { ?>
                      <label>
                        <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][featured_cid][]" value="<?php echo $category['category_id']; ?>" />
                        <?php echo $category['name']; ?> </label>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
              </tr>
              <tr>
                <td><?php echo $entry_position; ?></td>
                <td><select name="category_menu_module[<?php echo $module_row; ?>][position]" class="span3">
                    <?php if ($module['position'] == 'content_top') { ?>
                    <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                    <?php } else { ?>
                    <option value="content_top"><?php echo $text_content_top; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'content_bottom') { ?>
                    <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                    <?php } else { ?>
                    <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'column_left') { ?>
                    <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                    <?php } else { ?>
                    <option value="column_left"><?php echo $text_column_left; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'column_right') { ?>
                    <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                    <?php } else { ?>
                    <option value="column_right"><?php echo $text_column_right; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_count; ?></td>
                <td><select name="category_menu_module[<?php echo $module_row; ?>][count]" class="span3">
                    <?php if ($module['count']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_status; ?></td>
                <td><select name="category_menu_module[<?php echo $module_row; ?>][status]" class="span3">
                    <?php if ($module['status']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_sort_order; ?></td>
                <td><input type="text" name="category_menu_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" class="span1" /></td>
              </tr>
            </table>
          </div>
          <div id="tab-menu-setting-<?php echo $module_row; ?>">
            <table class="form">
              <tr>
                <td><?php echo $entry_title; ?></td>
                <td><?php foreach ($languages as $language) { ?>
                  <p>
                    <input type="text" name="category_menu_module[<?php echo $module_row; ?>][menu_title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['menu_title'][$language['language_id']]) ? $module['menu_title'][$language['language_id']] : ''; ?>" class="span3" />
                    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="margin: 0 7px 0 -26px; vertical-align: middle;" /><span class="custom-checkbox">
                    <input type="checkbox" id="checkboxTitleStatus-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>" name="category_menu_module[<?php echo $module_row; ?>][title_status][<?php echo $language['language_id']; ?>]" value="1" <?php echo (isset($module['title_status'][$language['language_id']]) ? 'checked="checked" ' : ''); ?> />
                    <label for="checkboxTitleStatus-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"></label>
                    </span></p>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_items; ?></td>
                <td colspan="2"><div id="items-tabs-<?php echo $module_row; ?>" class="htabs" style="width:auto; padding:0;"><a href="#tab-categories-<?php echo $module_row; ?>"><?php echo $tab_categories; ?></a><a href="#tab-manufacturers-<?php echo $module_row; ?>"><?php echo $tab_manufacturers; ?></a><a href="#tab-informations-<?php echo $module_row; ?>"><?php echo $tab_information; ?></a><a href="#tab-links-<?php echo $module_row; ?>"><?php echo $tab_links; ?></a></div>
                  <div id="tab-categories-<?php echo $module_row; ?>">
                  <?php if ($module['featured_categories'] == 'all') { ?>
                    <label class="radio inline">
                      <input type="radio" name="category_menu_module[<?php echo $module_row; ?>][featured_categories]" value="all" checked="checked" />
                      <?php echo $text_all; ?> </label>
                    <?php } else { ?>
                    <label class="radio inline">
                      <input type="radio" name="category_menu_module[<?php echo $module_row; ?>][featured_categories]" value="all" />
                      <?php echo $text_all; ?> </label>
                    <?php } ?>
                    &nbsp;&nbsp;
                    <?php if ($module['featured_categories'] == 'featured') { ?>
                    <label class="radio inline">
                      <input type="radio" name="category_menu_module[<?php echo $module_row; ?>][featured_categories]" value="featured" checked="checked" />
                      <?php echo $text_featured; ?> </label>
                    <?php } else { ?>
                    <label class="radio inline">
                      <input type="radio" name="category_menu_module[<?php echo $module_row; ?>][featured_categories]" value="featured" />
                      <?php echo $text_featured; ?> </label>
                    <?php } ?>
                    <div id="featured-categories-<?php echo $module_row; ?>" <?php echo (isset($module['featured_categories']) && $module['featured_categories'] == 'featured' ? '' : 'style="display:none;"'); ?>>
                      <div class="scrollbox" style="margin-top: 10px;">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($categories as $category) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (!empty($module['category_selected']) && in_array($category['category_id'], $module['category_selected'])) { ?>
                          <label>
                            <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][category_selected][]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                            <?php echo $category['name']; ?> </label>
                          <?php } else { ?>
                          <label>
                            <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][category_selected][]" value="<?php echo $category['category_id']; ?>" />
                            <?php echo $category['name']; ?> </label>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div>
                      <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
                  </div>
                  <div id="tab-manufacturers-<?php echo $module_row; ?>">
                    <div class="scrollbox">
                      <?php $class = 'odd'; ?>
                      <?php foreach ($manufacturers as $manufacturer) { ?>
                      <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                      <div class="<?php echo $class; ?>">
                        <?php if (!empty($module['manufacturer_selected']) && in_array($manufacturer['manufacturer_id'], $module['manufacturer_selected'])) { ?>
                        <label>
                          <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][manufacturer_selected][]" value="<?php echo $manufacturer['manufacturer_id']; ?>" checked="checked" />
                          <?php echo $manufacturer['name']; ?> </label>
                        <?php } else { ?>
                        <label>
                          <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][manufacturer_selected][]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                          <?php echo $manufacturer['name']; ?> </label>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    </div>
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
                  <div id="tab-informations-<?php echo $module_row; ?>">
                    <div class="scrollbox">
                      <?php $class = 'odd'; ?>
                      <?php foreach ($informations as $information) { ?>
                      <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                      <div class="<?php echo $class; ?>">
                        <?php if (!empty($module['information_selected']) && in_array($information['information_id'], $module['information_selected'])) { ?>
                        <label>
                          <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][information_selected][]" value="<?php echo $information['information_id']; ?>" checked="checked" />
                          <?php echo $information['title']; ?> </label>
                        <?php } else { ?>
                        <label>
                          <input type="checkbox" name="category_menu_module[<?php echo $module_row; ?>][information_selected][]" value="<?php echo $information['information_id']; ?>" />
                          <?php echo $information['title']; ?> </label>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    </div>
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a> </div>
                  <div id="tab-links-<?php echo $module_row; ?>">
                    <table id="links-<?php echo $module_row; ?>" class="list">
                      <thead>
                        <tr>
                          <td class="left"><?php echo $entry_link_title; ?></td>
                          <td class="left"><?php echo $entry_link; ?></td>
                          <td class="left"><?php echo $entry_icon; ?></td>
                          <td class="left"><?php echo $entry_sort_order; ?></td>
                          <td></td>
                        </tr>
                      </thead>
                      <?php if (isset($module['custom_link'])) { ?>
                      <?php foreach ($module['custom_link'] as $custom_link) { ?>
                      <tbody id="link-row-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>">
                        <tr>
                          <td class="left"><?php foreach ($languages as $language) { ?>
                            <input type="text" name="category_menu_module[<?php echo $module_row; ?>][custom_link][<?php echo $custom_link_row; ?>][link_title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($custom_link['link_title'][$language['language_id']]) ? $custom_link['link_title'][$language['language_id']] : ''; ?>" style="margin-bottom: 3px;" class="span2" />
                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                            <?php } ?></td>
                          <td class="left"><?php foreach ($languages as $language) { ?>
                            <input type="text" name="category_menu_module[<?php echo $module_row; ?>][custom_link][<?php echo $custom_link_row; ?>][href][<?php echo $language['language_id']; ?>]" value="<?php echo isset($custom_link['href'][$language['language_id']]) ? $custom_link['href'][$language['language_id']] : ''; ?>" style="margin-bottom: 3px;" class="span2" />
                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                            <?php } ?></td>
                          <td class="left"><div class="image"><img src="<?php echo !empty($custom_link['icon']) ? $this->model_tool_image->resize($custom_link['icon'], 100, 100) : $no_image; ?>" alt="" id="thumb-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>" />
                              <input type="hidden" name="category_menu_module[<?php echo $module_row; ?>][custom_link][<?php echo $custom_link_row; ?>][icon]" value="<?php echo $custom_link['icon']; ?>" id="icon-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>" />
                              <br />
                              <a onclick="image_upload('icon-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>', 'thumb-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#icon-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                          <td class="left"><input type="text" name="category_menu_module[<?php echo $module_row; ?>][custom_link][<?php echo $custom_link_row; ?>][sort_order]" value="<?php echo isset($custom_link['sort_order']) ? $custom_link['sort_order'] : ''; ?>" class="span1" />
                          <input type="hidden" name="category_menu_module[<?php echo $module_row; ?>][custom_link][<?php echo $custom_link_row; ?>][ciid]" value="<?php echo $module_row; ?><?php echo $custom_link_row; ?>" /></td>
                          <td class="left"><a onclick="$('#link-row-<?php echo $module_row; ?>-<?php echo $custom_link_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
                        </tr>
                      </tbody>
                      <?php $custom_link_row++; ?>
                      <?php } ?>
                      <?php } ?>
                      <tfoot>
                        <tr>
                          <td colspan="4"></td>
                          <td class="left"><a onclick="addLink('<?php echo $module_row; ?>');" class="button"><span><?php echo $button_insert; ?></span></a></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div></td>
              </tr>
              <tr>
                <td><?php echo $entry_style; ?></td>
                <td colspan="2"><select name="category_menu_module[<?php echo $module_row; ?>][style]" onchange="if($(this).val() == 'accordion' || $(this).val() == 'collapsible') {$('#toggle-<?php echo $module_row; ?>').show();} else {$('#toggle-<?php echo $module_row; ?>').hide();}" class="span2">
                    <?php if ($module['style'] == 'accordion') { ?>
                    <option value="accordion" selected="selected"><?php echo $text_accordion; ?></option>
                    <?php } else { ?>
                    <option value="accordion"><?php echo $text_accordion; ?></option>
                    <?php } ?>
                    <?php if ($module['style'] == 'collapsible') { ?>
                    <option value="collapsible" selected="selected"><?php echo $text_collapsible; ?></option>
                    <?php } else { ?>
                    <option value="collapsible"><?php echo $text_collapsible; ?></option>
                    <?php } ?>
                    <?php if ($module['style'] == 'flyout') { ?>
                    <option value="flyout" selected="selected"><?php echo $text_flyout; ?></option>
                    <?php } else { ?>
                    <option value="flyout"><?php echo $text_flyout; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr id="toggle-<?php echo $module_row; ?>" <?php echo ($module['style'] == 'accordion' || $module['style'] == 'collapsible' ? '' : 'style="display:none;"'); ?>>
                <td><?php echo $entry_toggle; ?></td>
                <td colspan="2"><select name="category_menu_module[<?php echo $module_row; ?>][toggle]" class="span2">
                    <?php if ($module['toggle']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_image; ?></td>
                <td colspan="2"><select name="category_menu_module[<?php echo $module_row; ?>][image]" class="span2">
                    <?php if ($module['image']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>&nbsp;&nbsp;&nbsp;
                  <input type="text" name="category_menu_module[<?php echo $module_row; ?>][image_width]" value="<?php echo isset($module['image_width']) ? $module['image_width'] : '170'; ?>" class="span1" />
                  <span class="muted"> x </span>
                  <input type="text" name="category_menu_module[<?php echo $module_row; ?>][image_height]" value="<?php echo isset($module['image_height']) ? $module['image_height'] : '106'; ?>" class="span1" />
                <span class="help-inline"><?php echo $text_dimension; ?></span></td>
              </tr>
              <tr>
                <td><?php echo $entry_cat_icon; ?></td>
                <td colspan="2"><select name="category_menu_module[<?php echo $module_row; ?>][icon]" class="span2">
                    <?php if ($module['icon']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>&nbsp;&nbsp;&nbsp;
                  <input type="text" name="category_menu_module[<?php echo $module_row; ?>][icon_width]" value="<?php echo isset($module['icon_width']) ? $module['icon_width'] : '16'; ?>" class="span1" />
                  <span class="muted"> x </span>
                  <input type="text" name="category_menu_module[<?php echo $module_row; ?>][icon_height]" value="<?php echo isset($module['icon_height']) ? $module['icon_height'] : '16'; ?>" class="span1" />
                <span class="help-inline"><?php echo $text_dimension; ?></span></td>
              </tr>
            </table>
          </div>
          <div id="tab-other-<?php echo $module_row; ?>">
            <table class="form">
              <tr>
                <td><?php echo $entry_box_class; ?></td>
                <td><input type="text" name="category_menu_module[<?php echo $module_row; ?>][box_class]" value="<?php echo !empty($module['box_class']) ? $module['box_class'] : 'box'; ?>" class="span3" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_tag; ?></td>
                <td><select name="category_menu_module[<?php echo $module_row; ?>][tag]" class="span3">
                    <?php if ($module['tag']== 'div') { ?>
                    <option value="div" selected="selected">div</option>
                    <?php } else { ?>
                    <option value="div">div</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h1') { ?>
                    <option value="h1" selected="selected">h1</option>
                    <?php } else { ?>
                    <option value="h1">h1</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h2') { ?>
                    <option value="h2" selected="selected">h2</option>
                    <?php } else { ?>
                    <option value="h2">h2</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h3') { ?>
                    <option value="h3" selected="selected">h3</option>
                    <?php } else { ?>
                    <option value="h3">h3</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h4') { ?>
                    <option value="h4" selected="selected">h4</option>
                    <?php } else { ?>
                    <option value="h4">h4</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h5') { ?>
                    <option value="h5" selected="selected">h5</option>
                    <?php } else { ?>
                    <option value="h5">h5</option>
                    <?php } ?>
                    <?php if ($module['tag'] == 'h6') { ?>
                    <option value="h6" selected="selected">h6</option>
                    <?php } else { ?>
                    <option value="h6">h6</option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $entry_heading_class; ?></td>
                <td><input type="text" name="category_menu_module[<?php echo $module_row; ?>][heading_class]" value="<?php echo !empty($module['heading_class']) ? $module['heading_class'] : 'box-heading'; ?>" class="span3" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_content_class; ?></td>
                <td><input type="text" name="category_menu_module[<?php echo $module_row; ?>][content_class]" value="<?php echo !empty($module['content_class']) ? $module['content_class'] : 'box-content'; ?>" class="span3" /></td>
              </tr>
            </table>
          </div>
        </div>
        <?php $module_row++; ?>
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {

  html  = '<div id="tab-module-' + module_row + '" class="vtabs-content">';
  html += '  <div id="tabs-' + module_row + '" class="htabs"><a href="#tab-module-setting-' + module_row + '"><?php echo $tab_module_setting; ?></a><a href="#tab-menu-setting-' + module_row + '"><?php echo $tab_menu_setting; ?></a><a href="#tab-other-' + module_row + '"><?php echo $tab_other; ?></a></div>';
  html += '  <div id="tab-module-setting-' + module_row + '">';
  html += '    <table class="form">';
  html += '      <tr>';
  html += '        <td><?php echo $entry_name; ?></td>';
  html += '        <td><input type="text" name="category_menu_module[' + module_row + '][module_name]" value="" class="span3" /></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_store; ?></td>';
  html += '        <td><div class="row">';
  html += '          <div class="span3">';
  html += '          <label class="checkbox">';
  html += '            <input type="checkbox" name="category_menu_module[' + module_row + '][store_id][]" value="" checked="checked" />';
  html += '          <?php echo addslashes($default_store); ?> </label>';
  <?php foreach ($stores as $store) { ?>
  html += '          <label class="checkbox">';
  html += '            <input type="checkbox" name="category_menu_module[' + module_row + '][store_id][]" value="<?php echo $store['store_id']; ?>" checked="checked" />';
  html += '          <?php echo addslashes($store['name']); ?> </label>';
  <?php } ?>
  html += '          </div>';
  html += '        </div></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_layout; ?></td>';
  html += '        <td><select name="category_menu_module[' + module_row + '][layout_id]" class="span3" onchange="if ($(this).val() == 3) {$(\'#featured-cid-' + module_row + '\').show();} else {$(\'#featured-cid-' + module_row + '\').hide();}">';
  <?php foreach ($layouts as $layout) { ?>
  html += '             <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
  <?php } ?>
  html += '        </select></td>';
  html += '      </tr>';
  html += '      <tr id="featured-cid-' + module_row + '" style="display:none;">';
  html += '        <td><?php echo $entry_featured_cat; ?></td>';
  html += '        <td><div class="scrollbox">';
  <?php $class = 'odd'; ?>
  <?php foreach ($categories as $category) { ?>
  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '          <div class="<?php echo $class; ?>">';
  html += '          <label><input type="checkbox" name="category_menu_module[' + module_row + '][featured_cid][]" value="<?php echo $category['category_id']; ?>" />';
  html += '          <?php echo addslashes($category['name']); ?></label>';
  html += '          </div>';
  <?php } ?>
 html += '        </div><a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_position; ?></td>';
  html += '        <td><select name="category_menu_module[' + module_row + '][position]" class="span3">';
  html += '          <option value="content_top"><?php echo $text_content_top; ?></option>';
  html += '          <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
  html += '          <option value="column_left"><?php echo $text_column_left; ?></option>';
  html += '          <option value="column_right"><?php echo $text_column_right; ?></option>';
  html += '        </select></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_count; ?></td>';
  html += '        <td><select name="category_menu_module[' + module_row + '][count]" class="span3">';
  html += '          <option value="1"><?php echo $text_enabled; ?></option>';
  html += '          <option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
  html += '        </select></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_status; ?></td>';
  html += '        <td><select name="category_menu_module[' + module_row + '][status]" class="span3">';
  html += '          <option value="1"><?php echo $text_enabled; ?></option>';
  html += '          <option value="0"><?php echo $text_disabled; ?></option>';
  html += '        </select></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_sort_order; ?></td>';
  html += '        <td><input type="text" name="category_menu_module[' + module_row + '][sort_order]" value="" class="span1" /></td>';
  html += '      </tr>';
  html += '    </table>';
  html += '  </div>';
  html += '  <div id="tab-menu-setting-' + module_row + '">';
  html += '    <table class="form">';
  html += '      <tr>';
  html += '        <td><?php echo $entry_title; ?></td>';
  html += '        <td>';
  <?php foreach ($languages as $language) { ?>
  html += '          <p><input type="text" name="category_menu_module[' + module_row + '][menu_title][<?php echo $language['language_id']; ?>]" value="" class="span3" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="margin: 0 7px 0 -26px; vertical-align: middle;" /><span class="custom-checkbox"><input type="checkbox" id="checkboxTitleStatus-' + module_row + '-<?php echo $language['language_id']; ?>" name="category_menu_module[' + module_row + '][title_status][<?php echo $language['language_id']; ?>]" value="1" checked="checked" />';
  html += '          <label for="checkboxTitleStatus-' + module_row + '-<?php echo $language['language_id']; ?>"></label></span></p>';
  <?php } ?>
  html += '        </td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_items; ?></td>';
  html += '        <td colspan="2"><div id="items-tabs-' + module_row + '" class="htabs" style="width:auto; padding:0;">';
  html += '          <a href="#tab-categories-'+ module_row + '"><?php echo $tab_categories; ?></a><a href="#tab-manufacturers-' + module_row + '"><?php echo $tab_manufacturers; ?></a><a href="#tab-informations-' + module_row + '"><?php echo $tab_information; ?></a><a href="#tab-links-' + module_row + '"><?php echo $tab_links; ?></a>';
  html += '        </div>';
  html += '        <div id="tab-categories-' + module_row + '">';
  html += '          <label class="radio inline">';
  html += '            <input type="radio" name="category_menu_module[' + module_row + '][featured_categories]" value="all" checked="checked" onchange="$(\'#featured-categories-' + module_row + '\').toggle();" />';
  html += '            <?php echo $text_all; ?>';
  html += '          </label> &nbsp;&nbsp;';
  html += '          <label class="radio inline">';
  html += '            <input type="radio" name="category_menu_module[' + module_row + '][featured_categories]" value="featured" onchange="$(\'#featured-categories-' + module_row + '\').toggle();" />';
  html += '            <?php echo $text_featured; ?>';
  html += '          </label>';
  html += '        <div id="featured-categories-' + module_row + '" style="display:none;">';
  html += '          <div class="scrollbox" style="margin-top: 10px;">';
  <?php $class = 'odd'; ?>
  <?php foreach ($categories as $category) { ?>
  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '          <div class="<?php echo $class; ?>">';
  html += '          <label><input type="checkbox" name="category_menu_module[' + module_row + '][category_selected][]" value="<?php echo $category['category_id']; ?>" />';
  html += '          <?php echo addslashes($category['name']); ?> </label>';
  html += '          </div>';
  <?php } ?>
  html += '        </div><a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a></div>';
  html += '        </div>';
  html += '        <div id="tab-manufacturers-' + module_row + '">';
  html += '          <div class="scrollbox">';
  <?php $class = 'odd'; ?>
  <?php foreach ($manufacturers as $manufacturer) { ?>
  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '          <div class="<?php echo $class; ?>">';
  html += '          <label><input type="checkbox" name="category_menu_module[' + module_row + '][manufacturer_selected][]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />';
  html += '          <?php echo addslashes($manufacturer['name']); ?> </label>';
  html += '          </div>';
  <?php } ?>
  html += '        </div><a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a></div>';
  html += '        <div id="tab-informations-' + module_row + '">';
  html += '          <div class="scrollbox">';
  <?php $class = 'odd'; ?>
  <?php foreach ($informations as $information) { ?>
  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
  html += '          <div class="<?php echo $class; ?>">';
  html += '          <label><input type="checkbox" name="category_menu_module[' + module_row + '][information_selected][]" value="<?php echo $information['information_id']; ?>" />';
  html += '          <?php echo addslashes($information['title']); ?> </label>';
  html += '          </div>';
  <?php } ?>
  html += '        </div><a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a></div>';
  html += '        <div id="tab-links-'+ module_row + '">';
  html += '          <table id="links-'+ module_row + '" class="list">';
  html += '            <thead>';
  html += '              <tr>';
  html += '                <td class="left"><?php echo $entry_link_title; ?></td>';
  html += '                <td class="left"><?php echo $entry_link; ?></td>';
  html += '                <td class="left"><?php echo $entry_icon; ?></td>';
  html += '                <td class="left"><?php echo $entry_sort_order; ?></td>';
  html += '                <td></td>';
  html += '              </tr>';
  html += '            </thead>';
  html += '            <tfoot>';
  html += '              <tr>';
  html += '                <td colspan="4"></td>';
  html += '                <td class="left"><a onclick="addLink('+ module_row +');" class="button"><span><?php echo $button_insert; ?></span></a></td>';
  html += '              </tr>';
  html += '            </tfoot>';
  html += '          </table>';
  html += '        </div>';
  html += '      </td>';
  html += '    </tr>';
  html += '    <tr>';
  html += '      <td><?php echo $entry_style; ?></td>';
  html += '      <td colspan="2"><select name="category_menu_module['+ module_row +'][style]" onchange="if($(this).val() == \'accordion\' || $(this).val() == \'collapsible\') {$(\'#toggle-'+ module_row +'\').show();} else {$(\'#toggle-'+ module_row +'\').hide();}" class="span2">';
  html += '        <option value="accordion" selected="selected"><?php echo $text_accordion; ?></option>';
  html += '        <option value="collapsible"><?php echo $text_collapsible; ?></option>';
  html += '        <option value="flyout"><?php echo $text_flyout; ?></option>';
  html += '      </select></td>';
  html += '    </tr>';
  html += '    <tr id="toggle-'+ module_row +'">';
  html += '      <td><?php echo $entry_toggle; ?></td>';
  html += '      <td colspan="2"><select name="category_menu_module['+ module_row +'][toggle]" class="span2">';
  html += '        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
  html += '        <option value="0"><?php echo $text_disabled; ?></option>';
  html += '      </select></td>';
  html += '    </tr>';
  html += '    <tr>';
  html += '      <td><?php echo $entry_image; ?></td>';
  html += '      <td colspan="2"><select name="category_menu_module[' + module_row + '][image]" class="span2">';
  html += '        <option value="1"><?php echo $text_enabled; ?></option>';
  html += '        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
  html += '      </select>&nbsp;&nbsp;&nbsp;';
  html += '      <input type="text" name="category_menu_module[' + module_row + '][image_width]" value="170" class="span1" /><span class="muted"> x </span><input type="text" name="category_menu_module[' + module_row + '][image_height]" value="106" class="span1" /> <span class="help-inline"><?php echo $text_dimension; ?></span></td>';
  html += '    </tr>';
  html += '    <tr>';
  html += '      <td><?php echo $entry_cat_icon; ?></td>';
  html += '      <td colspan="2"><select name="category_menu_module[' + module_row + '][icon]" class="span2">';
  html += '        <option value="1"><?php echo $text_enabled; ?></option>';
  html += '        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
  html += '      </select>&nbsp;&nbsp;&nbsp;';
  html += '      <input type="text" name="category_menu_module[' + module_row + '][icon_width]" value="16" class="span1" /><span class="muted"> x </span><input type="text" name="category_menu_module[' + module_row + '][icon_height]" value="16" class="span1" /> <span class="help-inline"><?php echo $text_dimension; ?></span></td>';
  html += '    </tr>';
  html += '  </table>';
  html += '</div>';
  html += '  <div id="tab-other-' + module_row + '">';
  html += '    <table class="form">';
  html += '      <tr>';
  html += '        <td><?php echo $entry_box_class; ?></td>';
  html += '        <td><input type="text" name="category_menu_module[' + module_row + '][box_class]; ?>]" value="box" class="span3" /></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_tag; ?></td>';
  html += '        <td><select name="category_menu_module[' + module_row + '][tag]" class="span3">';
  html += '          <option value="div">div</option>';
  html += '          <option value="h1">h1</option>';
  html += '          <option value="h2">h2</option>';
  html += '          <option value="h3">h3</option>';
  html += '          <option value="h4">h4</option>';
  html += '          <option value="h5">h5</option>';
  html += '          <option value="h6">h6</option>';
  html += '        </select></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_heading_class; ?></td>';
  html += '        <td><input type="text" name="category_menu_module[' + module_row + '][heading_class]; ?>]" value="box-heading" class="span3" /></td>';
  html += '      </tr>';
  html += '      <tr>';
  html += '        <td><?php echo $entry_content_class; ?></td>';
  html += '        <td><input type="text" name="category_menu_module[' + module_row + '][content_class]; ?>]" value="box-content" class="span3" /></td>';
  html += '      </tr>';
  html += '    </table>';
  html += '  </div>';

  $('#form').append(html);
  $('#tabs-' + module_row + ' a').tabs();
  $('#items-tabs-' + module_row + ' a').tabs();

  $('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '"><?php echo $tab_module; ?> ' + module_row + '&nbsp; <img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');

  $('.vtabs a').tabs();
  $('#module-' + module_row).trigger('click');

  module_row++;
}
//--></script> 
<script type="text/javascript"><!--
var custom_link_row = <?php echo $custom_link_row; ?>;

function addLink(module_row) {
  html  = '<tbody id="link-row-' + module_row + '-' + custom_link_row + '">';
  html += '  <tr>';
  html += '    <td class="left">';
  <?php foreach ($languages as $language) { ?>
  html += '      <input type="text" name="category_menu_module[' + module_row + '][custom_link][' + custom_link_row + '][link_title][<?php echo $language['language_id']; ?>]" value="" style="margin-bottom: 3px;" class="span2" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
  html += '    </td>';
  html += '    <td class="left">';
  <?php foreach ($languages as $language) { ?>
  html += '      <input type="text" name="category_menu_module[' + module_row + '][custom_link][' + custom_link_row + '][href][<?php echo $language['language_id']; ?>]" value="" style="margin-bottom: 3px;" class="span2" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
  html += '    </td>';
  html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb-' + module_row + '-' + custom_link_row + '" /><input type="hidden" name="category_menu_module[' + module_row + '][custom_link][' + custom_link_row + '][icon]" value="" id="icon-' + module_row + '-' + custom_link_row + '" /><br /><a onclick="image_upload(\'icon-' + module_row + '-' + custom_link_row + '\', \'thumb-' + module_row + '-' + custom_link_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb-' + module_row + '-' + custom_link_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#icon-' + module_row + '-' + custom_link_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
  html += '    <td class="left"><input type="text" name="category_menu_module[' + module_row + '][custom_link][' + custom_link_row + '][sort_order]" value="" class="span1" /><input type="hidden" name="category_menu_module[' + module_row + '][custom_link][' + custom_link_row + '][ciid]" value="' + module_row + '' + custom_link_row + '" /></td>';
  html += '    <td class="left"><a onclick="$(\'#link-row-' + module_row + '-' + custom_link_row  + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
  html += '  </tr>';
  html += '</tbody>';

  $('#links-' + module_row + ' tfoot').before(html);

  custom_link_row++;
}
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      if ($('#' + field).attr('value')) {
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
          dataType: 'text',
          success: function(data) {
            $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
          }
        });
      }
    },  
    bgiframe: false,
    width: 700,
    height: 400,
    resizable: false,
    modal: false
  });
};
//--></script>
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script> 
<script type="text/javascript"><!--
<?php $module_row = 1; ?>
<?php foreach ($modules as $module) { ?>
$('#tabs-<?php echo $module_row; ?> a').tabs();
$('#items-tabs-<?php echo $module_row; ?> a').tabs();
$('#tab-categories-<?php echo $module_row; ?> input[type=\'radio\']').change(function() { 
  $('#featured-categories-<?php echo $module_row; ?>').toggle();
});
<?php $module_row++; ?>
<?php } ?>
//--></script> 
<?php echo $footer; ?>