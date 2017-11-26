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
            <div id="tabs" class="htabs"><a href="#tab-categories"><?php echo $tab_categories; ?></a><a href="#tab-manufacturers"><?php echo $tab_manufacturers; ?></a></div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-categories">
                    <table id="attribute_categories" class="list">
                        <thead>
                            <tr>
                                <td class="left"><?php echo $entry_attributes; ?></td>
                                <td class="left"><?php echo $entry_category_view; ?></td>
                                <td class="right"><?php echo $entry_sort_order; ?></td>
                                <td></td>
                            </tr>
                        </thead>
                        <?php $attribute_categories_row = 0; ?>
                        <?php foreach ($attributes_categories as $attribute) { ?>
                        <tbody id="attribute_categories_<?php echo $attribute_categories_row; ?>">
                            <tr>
                                <td class="left">
                                    <select name="attributes_categories[<?php echo $attribute_categories_row; ?>][attribute_id]">
                                        <?php foreach ($attributes_categories_all as $attribute_categories) { ?>
                                        <?php if ($attribute_categories['attribute_id'] == $attribute['attribute_id']) { ?>
                                        <option value="<?php echo $attribute_categories['attribute_id']; ?>" selected><?php echo $attribute_categories['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $attribute_categories['attribute_id']; ?>"><?php echo $attribute_categories['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td class="left">

                                    <table class="form">
                                        <tr>
                                            <td style="border: 0;"><?php echo $entry_category; ?></td>
                                            <td style="border: 0;"><input type="text" class="js_autocomplete" name="<?php echo $attribute_categories_row; ?>" size="100" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0;">&nbsp;</td>
                                            <td style="border: 0;">
                                                <div id="categories_<?php echo $attribute_categories_row; ?>" class="js_categories scrollbox" style="width: 535px; height: 150px;">

                                                    <?php $class = 'odd'; ?>
                                                    <?php foreach ($attribute['categories'] as $category_id) { ?>
                                                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                                    <div id="categories_<?php echo $attribute_categories_row; ?>_<?php echo $category_id; ?>" class="<?php echo $class; ?>"><?php echo $categories[$category_id]['name']; ?><img src="view/image/delete.png" />
                                                    <input type="hidden" name="attributes_categories[<?php echo $attribute_categories_row; ?>][categories][]" value="<?php echo $category_id; ?>" />
                                                    </div>
                                                    <?php } ?>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0;">&nbsp;</td>
                                            <td style="border: 0;">
                                                <a onclick="add_all(<?php echo $attribute_categories_row; ?>);"><?php echo $button_add_all; ?></a> | <a onclick="remove_all(<?php echo $attribute_categories_row; ?>);"><?php echo $button_remove_all; ?></a>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td class="right">
                                    <input type="text" name="attributes_categories[<?php echo $attribute_categories_row; ?>][sort_order]" value="<?php echo $attribute['sort_order']; ?>" size="3">
                                </td>
                                <td class="left">
                                    <a onclick="$('#attribute_categories_<?php echo $attribute_categories_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php $attribute_categories_row++; ?>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="left"><a onclick="addAttributeCategories();" class="button"><span><?php echo $button_add; ?></span></a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="tab-manufacturers">
                    <table id="attribute_manufacturers" class="list">
                        <thead>
                            <tr>
                                <td class="left"><?php echo $entry_attributes; ?></td>
                                <td class="right"><?php echo $entry_sort_order; ?></td>
                                <td></td>
                            </tr>
                        </thead>
                        <?php $attribute_manufacturers_row = 0; ?>
                        <?php foreach ($attributes_manufacturers as $attribute) { ?>
                        <tbody id="attribute_manufacturers_<?php echo $attribute_manufacturers_row; ?>">
                            <tr>
                                <td class="left">
                                    <select name="attributes_manufacturers[<?php echo $attribute_manufacturers_row; ?>][attribute_id]">
                                        <?php foreach ($attributes_manufacturers_all as $attribute_manufacturers) { ?>
                                        <?php if ($attribute_manufacturers['attribute_id'] == $attribute['attribute_id']) { ?>
                                        <option value="<?php echo $attribute_manufacturers['attribute_id']; ?>" selected><?php echo $attribute_manufacturers['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $attribute_manufacturers['attribute_id']; ?>"><?php echo $attribute_manufacturers['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td class="right">
                                    <input type="text" name="attributes_manufacturers[<?php echo $attribute_manufacturers_row; ?>][sort_order]" value="<?php echo $attribute['sort_order']; ?>" size="3">
                                </td>
                                <td class="left">
                                    <a onclick="$('#attribute_manufacturers_<?php echo $attribute_manufacturers_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php $attribute_manufacturers_row++; ?>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="left"><a onclick="addAttributeManufacturers();" class="button"><span><?php echo $button_add; ?></span></a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <table id="module" class="list">
                <thead>
                <tr>
                <td class="left"><?php echo $entry_layout; ?></td>
                <td class="left"><?php echo $entry_position; ?></td>
                <td class="left"><?php echo $entry_status; ?></td>
                <td class="right"><?php echo $entry_sort_order; ?></td>
                <td></td>
                </tr>
                </thead>
                <?php
                $module_row = 0;
                ?>
                <?php foreach ($modules as $module) { ?>
                <tbody id="module-row<?php echo $module_row; ?>">
                <tr>
                <td class="left"><select name="filter_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
                </select></td>
                <td class="left"><select name="filter_module[<?php echo $module_row; ?>][position]">
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
                <td class="left"><select name="filter_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
                </select></td>
                <td class="right"><input type="text" name="filter_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
                <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
                </tr>
                </tbody>
                <?php $module_row++; ?>
                <?php } ?>
                <tfoot>
                <tr>
                <td colspan="4"></td>
                <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
                </tr>
                </tfoot>
                </table>
                </form>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
$('#tabs a').tabs();

var module_row = <?php echo $module_row; ?>;

function addModule() {
    html  = '<tbody id="module-row' + module_row + '">';
    html += '  <tr>';
    html += '    <td class="left"><select name="filter_module[' + module_row + '][layout_id]">';
    <?php foreach ($layouts as $layout) { ?>
    html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';
    html += '    <td class="left"><select name="filter_module[' + module_row + '][position]">';
    html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
    html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
    html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
    html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
    html += '    </select></td>';
    html += '    <td class="left"><select name="filter_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
    html += '    <td class="right"><input type="text" name="filter_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
    html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';
    html += '</tbody>';

    $('#module tfoot').before(html);

    module_row++;
}

var attribute_categories_row = <?php echo $attribute_categories_row; ?>;
function addAttributeCategories() {
    html  = '<tbody id="attribute_categories_' + attribute_categories_row + '">';
    html += '    <tr>';
    html += '        <td class="left">';
    html += '            <select name="attributes_categories[' + attribute_categories_row + '][attribute_id]">';
                    <?php foreach ($attributes_categories_all as $attribute_categories) { ?>
    html += '                    <option value="<?php echo $attribute_categories['attribute_id']; ?>"><?php echo $attribute_categories['name']; ?></option>';
                    <?php } ?>
    html += '            </select>';
    html += '        </td>';
    html += '        <td class="left">';

    html += '            <table class="form">';
    html += '                <tr>';
    html += '                    <td style="border: 0;"><?php echo $entry_category; ?></td>';
    html += '                    <td style="border: 0;">';
    html += '                        <input type="text" class="js_autocomplete" name="' + attribute_categories_row + '" size="100" value="" />';
    html += '                    </td>';
    html += '                </tr>';
    html += '                <tr>';
    html += '                    <td style="border: 0;">&nbsp;</td>';
    html += '                    <td style="border: 0;">';
    html += '                        <div id="categories_' + attribute_categories_row + '" class="js_categories scrollbox" style="width: 535px; height: 150px;"></div>';
    html += '                    </td>';
    html += '                </tr>';
    html += '               <tr>';
    html += '                   <td style="border: 0;">&nbsp;</td>';
    html += '                   <td style="border: 0;">';
    html += '                       <a onclick="add_all(' + attribute_categories_row + ');"><?php echo $button_add_all; ?></a> | <a onclick="remove_all(' + attribute_categories_row + ');"><?php echo $button_remove_all; ?></a>';
    html += '                   </td>';
    html += '               </tr>';

    html += '            </table>';

    html += '        </td>';

    html += '        <td class="right">';
    html += '            <input type="text" name="attributes_categories[' + attribute_categories_row + '][sort_order]" value="" size="3">';
    html += '        </td>';
    html += '        <td class="left">';
    html += '            <a onclick="$(\'#attribute_categories_' + attribute_categories_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a>';
    html += '        </td>';
    html += '    </tr>';
    html += '</tbody>';
    $('#attribute_categories tfoot').before(html);

    attribute_categories_row++;

    autocomplete();
}

var attribute_manufacturers_row = <?php echo $attribute_manufacturers_row; ?>;
function addAttributeManufacturers() {
    html  = '<tbody id="attribute_manufacturers_' + attribute_manufacturers_row + '">';
    html += '    <tr>';
    html += '        <td class="left">';
    html += '            <select name="attributes_manufacturers[' + attribute_manufacturers_row + '][attribute_id]">';
                    <?php foreach ($attributes_manufacturers_all as $attribute_manufacturers) { ?>
    html += '                    <option value="<?php echo $attribute_manufacturers['attribute_id']; ?>"><?php echo $attribute_manufacturers['name']; ?></option>';
                    <?php } ?>
    html += '            </select>';
    html += '        </td>';
    html += '        <td>&nbsp;</td>';
    html += '        <td class="right">';
    html += '            <input type="text" name="attributes_manufacturers[' + attribute_manufacturers_row + '][sort_order]" value="" size="3">';
    html += '        </td>';
    html += '        <td class="left">';
    html += '            <a onclick="$(\'#attribute_manufacturers_' + attribute_manufacturers_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a>';
    html += '        </td>';
    html += '    </tr>';
    html += '</tbody>';
    $('#attribute_manufacturers tfoot').before(html);
    attribute_manufacturers_row++;
}

function add_all(id) {
    $.ajax({
        url: "index.php?route=module/filter/getCategoriesList&token=<?php echo $token; ?>",
        dataType: 'json',
        success: function(json) {
            $('#categories_' + id + ' div').remove();

            html = '';

            $.map(json, function(item) {
                html += '<div id="categories_' + id + '_' + item.category_id + '">' + item.name + '<img src="view/image/delete.png" />';
                html += '<input type="hidden" name="attributes_categories[' + id + '][categories][]" value="' + item.category_id + '" />';
                html += '</div>';
            });

            $('#categories_' + id).append(html);

            $('.js_categories div:odd').attr('class', 'odd');
            $('.js_categories div:even').attr('class', 'even');
        }
    });
}

function remove_all(id) {
    $('#categories_' + id + ' div').remove();
}

function autocomplete() {
    $('.js_autocomplete').autocomplete({
        delay: 0,
        source: function(request, response) {
            $.ajax({
                url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item.name,
                            value: item.category_id
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            var row = $(this).attr("name");

            $('#categories_' + row + '_' + ui.item.value).remove();

            $('#categories_' + row).append('<div id="categories_' + row + '_' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="attributes_categories[' + row + '][categories][]" value="' + ui.item.value + '" /></div>');

            $('#categories_' + row + ' div:odd').attr('class', 'odd');
            $('#categories_' + row + ' div:even').attr('class', 'even');

            $(this).val('');

            return false;
        },
        focus: function(event, ui) {
            return false;
        }
    });

    $('.js_categories div img').live('click', function() {
        $(this).parent().remove();

        $('.js_categories div:odd').attr('class', 'odd');
        $('.js_categories div:even').attr('class', 'even');
    });
}

autocomplete();

//--></script>

<?php echo $footer; ?>
