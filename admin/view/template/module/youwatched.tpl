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
            <h1><?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">
                </table>
                <table id="module" class="list">
                    <thead>
                    <tr>
                        <td class="left"><?php echo $entry_limit; ?></td>
                        <td class="left"><?php echo $entry_image; ?></td>
                        <td class="left"><?php echo $entry_layout; ?></td>
                        <td class="left"><?php echo $entry_position; ?></td>
                        <td class="left"><?php echo $entry_status; ?></td>
                        <td class="left"><?php echo $entry_template; ?></td>
                        <td class="center"><?php echo $entry_sort_order; ?></td>
                        <td class="center"><?php echo $entry_level; ?></td>
                        <td class="center"><?php echo $entry_action; ?></td>
                    </tr>
                    </thead>
                    <?php $module_row = 0; ?>
                    <?php foreach ($modules as $module) { ?>
                    <tbody id="module-row<?php echo $module_row; ?>">
                    <tr>
                        <td class="left"><input type="text" name="youwatched_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" size="1" /></td>
                        <td class="left"><input type="text" name="youwatched_module[<?php echo $module_row; ?>][image_width]" value="<?php echo $module['image_width']; ?>" size="3" />
                            <input type="text" name="youwatched_module[<?php echo $module_row; ?>][image_height]" value="<?php echo $module['image_height']; ?>" size="3" />
                            <?php if (isset($error_image[$module_row])) { ?>
                            <span class="error"><?php echo $error_image[$module_row]; ?></span>
                            <?php } ?></td>
                        <td class="left"><select name="youwatched_module[<?php echo $module_row; ?>][layout_id]">
                            <?php foreach ($layouts as $layout) { ?>
                            <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        </td>
                        <td class="left"><select name="youwatched_module[<?php echo $module_row; ?>][position]">
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

                        </select></td>
                        <td class="left"><select name="youwatched_module[<?php echo $module_row; ?>][status]">
                            <?php if ($module['status']) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                        </select></td>

                        <td class="left"><select class="template" name="youwatched_module[<?php echo $module_row; ?>][template]">
                            <?php foreach ($template_name as $tpl_name => $tpl_label){ ?>
                            <option value="<?php echo $tpl_name;?>" <? echo ($module['template'] == $tpl_name) ? 'selected="selected"' : '';?>><?php echo $tpl_label; ?></option>
                            <?php } ?>

                        </select>
                        <?php if ($module['template'] == "default") { ?>
                        <div class="slider-options" style="display:none">
                        <?php }else { ?>
                            <div class="slider-options" style="display:block">
                        <?php } ?>
                            <label for="youwatched_module[<?php echo $module_row; ?>][slider][visible]"><?php echo $slider_visible;?></label>
                            <input name="youwatched_module[<?php echo $module_row; ?>][slider][visible]"type="text" size="1" value="<?php echo $module['slider']['visible'];?>"/><br/>
                            <label for="youwatched_module[<?php echo $module_row; ?>][slider][scroll]"><?php echo $slider_scroll;?></label>
                            <input name="youwatched_module[<?php echo $module_row; ?>][slider][scroll]" type="text" size="1" value="<?php echo $module['slider']['scroll'];?>"/><br/>
                            <label for="youwatched_module[<?php echo $module_row; ?>][slider][delay]"><?php echo $slider_delay;?></label>
                            <input name="youwatched_module[<?php echo $module_row; ?>][slider][delay]"type="text" size="1" value="<?php echo $module['slider']['delay'];?>"/><br/>
                            <label for="youwatched_module[<?php echo $module_row; ?>][slider][direction]"><?php echo $slider_direction;?></label>
                            <select name="youwatched_module[<?php echo $module_row; ?>][slider][direction]">
                               <option value="horizontal" selected="selected"><?php echo $slider_horizontal; ?></option>
                            </select>
                        </div>
                        </td>

                        <td class="center">
                            <input type="text" name="youwatched_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" />
                        </td>
                        <td class="center">
                            <input type="text" name="youwatched_module[<?php echo $module_row; ?>][level]" value="<?php echo $module['level']; ?>" size="1" />
                        </td>

                        <td class="center">
                            <a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a>
                        </td>
                    </tr>
                    </tbody>
                    <?php $module_row++; ?>
                    <?php } ?>
                    <tfoot>
                    <tr>
                        <td colspan="8"></td>
                        <td class="center"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
            <script type="text/javascript"><!--
            var module_row = <?php echo $module_row; ?>;

            function addModule() {
                html  = '<tbody id="module-row' + module_row + '">';
                html += '  <tr>';
                html += '    <td class="left"><input type="text" name="youwatched_module[' + module_row + '][limit]" value="5" size="1" /></td>';
                html += '    <td class="left"><input type="text" name="youwatched_module[' + module_row + '][image_width]" value="80" size="3" /> <input type="text" name="youwatched_module[' + module_row + '][image_height]" value="80" size="3" /></td>';
                html += '    <td class="left"><select name="youwatched_module[' + module_row + '][layout_id]">';
            <?php foreach ($layouts as $layout) { ?>
                    html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
                <?php } ?>
                html += '    </select></td>';
                html += '    <td class="left"><select name="youwatched_module[' + module_row + '][position]">';
                html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
                html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
                html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
                html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
                html += '    </select></td>';
                html += '    <td class="left"><select name="youwatched_module[' + module_row + '][status]">';
                html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
                html += '      <option value="0"><?php echo $text_disabled; ?></option>';
                html += '    </select></td>';
                html += '    <td class="left"><select class="template" name="youwatched_module[' + module_row + '][template]">';

                <?php foreach ($template_name as $tpl_name => $tpl_label){ ?>
                    html += '      <option value="<?php echo $tpl_name;?>"><?php echo $tpl_label; ?></option>';
                <?php } ?>
                html += '    </select>';
                html += '<div class="slider-options" style="display:none">';
                html += '<label for="youwatched_module[' + module_row + '][slider][visible]"><?php echo $slider_visible;?></label>';
                html += '<input name="youwatched_module[' + module_row + '][slider][visible]"type="text" size="1" value="5"/><br/>';
                html += '<label for="youwatched_module[' + module_row + '][slider][scroll]"><?php echo $slider_scroll;?></label>';
                html += '<input name="youwatched_module[' + module_row + '][slider][scroll]" type="text" size="1" value="1"/><br/>';
                html += '<label for="youwatched_module[' + module_row + '][slider][delay]"><?php echo $slider_delay;?></label>';
                html += '<input name="youwatched_module[' + module_row + '][slider][delay]"type="text" size="1" value="0"/><br/>';
                html += '<label for="youwatched_module[' + module_row + '][slider][direction]"><?php echo $slider_direction;?></label>';
                html += '<select name="youwatched_module[' + module_row + '][slider][direction]">';
                html += '<option value="horizontal" selected="selected"><?php echo $slider_horizontal; ?></option>';
                html += '</select>';
                html += '</div>';

                html += '   </td>';
                html += '    <td class="center"><input type="text" name="youwatched_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
                html += '    <td class="center"><input type="text" name="youwatched_module[' + module_row + '][level]" value="1" size="1" /></td>';
                html += '    <td class="center"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
                html += '  </tr>';
                html += '</tbody>';

                $('#module tfoot').before(html);

                module_row++;
            }
            $(function(){
                $('body').on('change','.template', function(){
                    if ($(this).val() == "default"){
                        $('.slider-options',$(this).parent()).css('display','none');
                    }else{
                        $('.slider-options',$(this).parent()).css('display','block');
                    }
                })
            })
            //--></script>
        </div>
    </div>
    <?php echo $footer; ?>