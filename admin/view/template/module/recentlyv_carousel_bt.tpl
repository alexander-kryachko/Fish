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
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="formSubmitEdit();" class="button">Save and Keep Edit</a><a onclick="formSubmit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <input type="hidden" name="save_and_keep_edit" id='save_and_keep_edit' value="0"/>
                <div class="vtabs">
                    <?php $module_row = 1; ?>
                    <?php foreach ($modules as $module) { ?>
                        <a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>"><?php echo 'Module ' . $module_row; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('.vtabs a:first').trigger('click');
                                $('#module-<?php echo $module_row; ?>').remove();
                                $('#tab-module-<?php echo $module_row; ?>').remove();
                                return false;" /></a>
                            <?php $module_row++; ?>
                        <?php } ?>
                    <span id="module-add" style="cursor: pointer;" onclick="addModule();"><?php echo $button_add_module; ?>&nbsp;<img src="view/image/add.png" alt=""  /></span> </div>
                <?php $module_row = 1; ?>
                <?php foreach ($modules as $key => $module) { ?>
                    <div id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
                        <div id="tabsh-<?php echo $module_row; ?>" class="htabs">
                            <a href="#tab-global-<?php echo $module_row; ?>"><?php echo $text_general; ?></a>
                            <a href="#tab-carouselsetting-<?php echo $module_row; ?>">Carousel setting</a>
                            <a href="#tab-languagesetting-<?php echo $module_row; ?>"><?php echo $text_languagesettings; ?></a>
                            <a href="#tab-customcss-<?php echo $module_row; ?>">Custom CSS</a>
                        </div>
                        <div id="tab-global-<?php echo $module_row; ?>">
                            <table class="form">
                                <tr>
                                    <td class="left"><?php echo $entry_limit; ?></td>
                                    <td class="left"><input type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" size="1" /></td>
                                </tr>
                                <tr>
                                    <td class="left">Product dislpay on one page: </td>
                                    <td class="left"><input type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][scroll_limit]" value="<?php echo $module['scroll_limit']; ?>" size="1" /><br><small>If dislpay box in side change to 1</small></td>
                                </tr>
                                <tr>
                                    <td class="left"><?php echo $entry_image; ?></td>
                                    <td class="left">
                                        <input type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][image_width]" value="<?php echo $module['image_width']; ?>" size="3" />
                                        <input type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][image_height]" value="<?php echo $module['image_height']; ?>" size="3" />
                                        <?php if (isset($error_image[$module_row])) { ?>
                                            <span class="error"><?php echo $error_image[$module_row]; ?></span>
                                        <?php } ?></td>
                                </tr>

                                <tr>
                                    <td class="left"><?php echo $entry_category; ?><br /><small>This setting working only Category layout</small></td>
                                    <td class="left">
                                        <input class="dont_chcked" onclick="disableCategories(<?php echo $module_row; ?>);"   name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][display_in_all]" type="checkbox" value="1" <?php if (isset($module['display_in_all']) && $module['display_in_all'] == '1') { ?>checked<?php } ?> /> Display in ALL Categories<br/>
                                        <br />
                                        <b>OR select Categories:</b>
                                        <br />
                                        <br />
                                        <?php
                                        if (isset($module['category_source'])) {
                                            $a = $module['category_source'];
                                        } else {
                                            $a = array();
                                        }
                                        ?>
                                        <table>
                                            <?php
                                            $icount = 1;

                                            foreach ($categories as $category) {

                                                if (!($icount % 3)) {
                                                    if ($icount > 0) {
                                                        echo "</tr>";       // Close the row above this if it's not the first row
                                                    }
                                                    echo "<tr>";    // Start a new row
                                                }
                                                ?>
                                                <td style="padding-right: 19px;"> <input <?php if (isset($module['display_in_all']) && $module['display_in_all'] == '1') { ?> disabled="disabled" <?php } ?> class="category_item_<?php echo $module_row; ?>" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][category_source][]" type="checkbox" value="<?php echo $category['category_id']; ?>" <?php if (in_array($category['category_id'], $a)) { ?>checked<?php } ?> /><?php echo $category['name'] ?><br/></td>  

                                                <?php
                                                $icount++;
                                            }
                                            ?>
                                </tr>    
                            </table>
                            <br />
                            <a onclick="$(this).parent().find(':checkbox:not( .dont_chcked )').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox:not( .dont_chcked )').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                            </td>
                            </tr>

                            <tr>
                                <td class="left"><?php echo $entry_layout; ?></td>
                                <td class="left">
                                    <br />
                                    Layout:<br />
                                    <select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][layout_id]">
                                        <?php foreach ($layouts as $layout) { ?>
                                            <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <br /><br />
                                    Use in store:<br />
                                    <div class="scrollbox">
                                        <?php $class = 'even'; ?>
                                        <div class="<?php echo $class; ?>">
                                            <?php if (isset($module['store']) && in_array(0, $module['store'])) { ?>
                                                <input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][store][]" value="0" checked="checked" />
                                                <?php echo $text_default; ?>
                                            <?php } else { ?>
                                                <input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][store][]" value="0" />
                                                <?php echo $text_default; ?>
                                            <?php } ?>
                                        </div>
                                        <?php foreach ($stores as $store) { ?>
                                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                            <div class="<?php echo $class; ?>">
                                                <?php if (isset($module['store']) && in_array($store['store_id'], $module['store'])) { ?>
                                                    <input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                                                    <?php echo $store['name']; ?>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>" />
                                                    <?php echo $store['name']; ?>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <br />

                                </td>
                            </tr>

                            <tr>
                                <td class="left"><?php echo $entry_position; ?></td>
                                <td class="left"><select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][position]">
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
                                <td class="left"><?php echo $entry_status; ?></td>
                                <td class="left"><select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][status]">
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
                                <td class="right"><?php echo $entry_sort_order; ?></td>
                                <td class="right"><input type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
                            </tr>
                            <tr>
                                <td class="left">Show in box</td>
                                <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][show_in_box]" value="on" type="checkbox" <?php if (isset($module['show_in_box']) && $module['show_in_box'] == 'on') { ?> checked="checked" <?php } ?> > 
                                </td> 
                            </tr>
                            </table>
                        </div>
                        <div id="tab-carouselsetting-<?php echo $module_row; ?>">
                            <table class="form">
                                <tr>
                                    <td class="left">Set Carousel Circular</td>
                                    <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][circular]" value="on" <?php if (isset($module['carousel']['circular']) && $module['carousel']['circular'] == 'on') { ?> checked="checked" <?php } ?>  /> <small>Makes the carousel circular</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Set Carousel Infinite</td>
                                    <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][infinite]" value="on" <?php if (isset($module['carousel']['infinite']) && $module['carousel']['infinite'] == 'on') { ?> checked="checked" <?php } ?> /> <small> Makes the carousel infinite</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Set Carousel Responsive</td>
                                    <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][responsive]" value="on" <?php if (isset($module['carousel']['responsive']) && $module['carousel']['responsive'] == 'on') { ?> checked="checked" <?php } ?> /> <small> Makes the carousel responsive</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Set Carousel Direction</td>
                                    <td class="left">
                                        <select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][direction]">
                                            <option  <?php if (isset($module['carousel']['direction']) && $module['carousel']['direction'] == 'left') { ?> selected="selected" <?php } ?> value="left">Left</option>
                                            <option <?php if (isset($module['carousel']['direction']) && $module['carousel']['direction'] == 'right') { ?> selected="selected" <?php } ?>value="right">Right</option>
                                            <option <?php if (isset($module['carousel']['direction']) && $module['carousel']['direction'] == 'up') { ?> selected="selected" <?php } ?>value="up">Up</option>
                                            <option <?php if (isset($module['carousel']['direction']) && $module['carousel']['direction'] == 'down') { ?> selected="selected" <?php } ?>value="down">Down</option>
                                        </select>
                                        <br />
                                        <small> Select the direction of the products in the carousel</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Carousel Size</td>
                                    <td class="left">
                                        <input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][width]" value="<?php echo $module['carousel']['width']; ?>" type="text"> x <input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][height]" value="<?php echo $module['carousel']['height']; ?>" type="text"><br>
                                        <small>Size in px of the carousel. You can use <strong>variable</strong> or <strong>auto</strong>. If left blank the size will be automatically calculated</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Carousel Alignment</td>
                                    <td class="left">
                                        <select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][align]">
                                            <option <?php if (isset($module['carousel']['align']) && $module['carousel']['align'] == 'left') { ?> selected="selected" <?php } ?> value="left">Left</option>
                                            <option <?php if (isset($module['carousel']['align']) && $module['carousel']['align'] == 'right') { ?> selected="selected" <?php } ?> value="right" >Right</option>
                                            <option <?php if (isset($module['carousel']['align']) && $module['carousel']['align'] == 'center') { ?> selected="selected" <?php } ?> value="center">Center</option>
                                        </select><br>  
                                        <small>Select the alignment of the products in the carousel</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Set Products to Scroll</td>
                                    <td class="left">
                                        <input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][scroll_products]" value="<?php echo $module['carousel']['scroll_products']; ?>" type="text"><br>  
                                        <small>Configure the number of products to scroll at a time</small>   
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Scrolling Effect</td>
                                    <td class="left">
                                        <select name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][scroll_effect]">
                                            <option value="scroll" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'scroll') { ?> selected="selected" <?php } ?>>Scroll</option>
                                            <option value="directscroll" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'directscroll') { ?> selected="selected" <?php } ?>>Direct Scroll</option>
                                            <option value="fade" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'fade') { ?> selected="selected" <?php } ?>>Fade</option>
                                            <option value="crossfade" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'crossfade') { ?> selected="selected" <?php } ?>>Crossfade</option>
                                            <option value="cover" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'cover') { ?> selected="selected" <?php } ?>>Cover</option>
                                            <option value="cover-fade" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'cover-fade') { ?> selected="selected" <?php } ?>>Cover Fade</option>
                                            <option value="uncover" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'uncover') { ?> selected="selected" <?php } ?>>Uncover</option>
                                            <option value="uncover-fade" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'uncover-fade') { ?> selected="selected" <?php } ?>>Uncover Fade</option>
                                            <option value="none" <?php if (isset($module['carousel']['scroll_effect']) && $module['carousel']['scroll_effect'] == 'none') { ?> selected="selected" <?php } ?>>No Effect</option>
                                        </select><br>  
                                        <small>Select the effect of the scrolling products in the carousel</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Scrolling Easing Animation</td>
                                    <td class="left">
                                        <select name=recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][scroll_easing]">
                                            <option value="swing" <?php if (isset($module['carousel']['scroll_easing']) && $module['carousel']['scroll_easing'] == 'swing') { ?> selected="selected" <?php } ?> >Swing</option>
                                            <option value="linear" <?php if (isset($module['carousel']['scroll_easing']) && $module['carousel']['scroll_easing'] == 'linear') { ?> selected="selected" <?php } ?>>Linear</option>
                                            <option value="quadratic" <?php if (isset($module['carousel']['scroll_easing']) && $module['carousel']['scroll_easing'] == 'quadratic') { ?> selected="selected" <?php } ?>>Quadratic</option>
                                            <option value="cubic" <?php if (isset($module['carousel']['scroll_easing']) && $module['carousel']['scroll_easing'] == 'cubic') { ?> selected="selected" <?php } ?>>Cubic</option>
                                            <option value="elastic" <?php if (isset($module['carousel']['scroll_easing']) && $module['carousel']['scroll_easing'] == 'elastic') { ?> selected="selected" <?php } ?>>Elastic</option>
                                        </select><br>  
                                        <small>Select the effect of the scrolling products in the carousel</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Set Scrolling Duration</td>
                                    <td class="left">
                                        <input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][scroll_duration]" value="<?php echo $module['carousel']['scroll_duration']; ?>" type="text"><br>  
                                        <small>Configure the time in milli seconds for the scroll of an product</small> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">Set Timeout Duration</td>
                                    <td class="left">
                                        <input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][timeout_duration]" value="<?php echo $module['carousel']['timeout_duration']; ?>" type="text"><br>  
                                        <small>The amount of milliseconds the carousel will pause. Default is 5 * [Scrolling Duration]</small>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="left">Pause Carousel on Hover</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][hover]" value="on" <?php if (isset($module['carousel']['hover']) && $module['carousel']['hover'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Pauses the carousel on hover</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Auto Play the Carousel</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][autoplay]" value="on" <?php if (isset($module['carousel']['autoplay']) && $module['carousel']['autoplay'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Sets the caurousel to start automatically</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Carousel Direction Nav</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][nav]" value="on" <?php if (isset($module['carousel']['nav']) && $module['carousel']['nav'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Create navigation for previous/next navigation</small></td>
                                </tr>
    <!--                                <tr>
                                    <td class="left">Carousel Keyboard Nav</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][key_nav]" value="on" <?php if (isset($module['carousel']['key_nav']) && $module['carousel']['key_nav'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Allow navigating via keyboard left/right keys</small></td>
                                </tr>-->
                                <tr>
                                    <td class="left">Carousel Control Nav</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][pagination]" value="on" <?php if (isset($module['carousel']['pagination']) && $module['carousel']['pagination'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Create navigation for paging control of each product</small></td>
                                </tr>
                                <tr>
                                    <td class="left">Carousel Swipe Nav</td>
                                    <td class="left"><input name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][carousel][swipe_nav]" value="on" <?php if (isset($module['carousel']['swipe_nav']) && $module['carousel']['swipe_nav'] == 'on') { ?> checked="checked" <?php } ?> type="checkbox"> 
                                        <small>Allow navigating via swiping for touchscreen devices</small></td>
                                </tr>

                            </table>
                        </div>

                        <div id="tab-languagesetting-<?php echo $module_row; ?>">
                            <table class="form">
                                <tr>
                                    <td><?php echo $text_tabname; ?></td>
                                    <td> 
                                        <?php foreach ($languages as $language) { ?>
                                            <input style="width: 300px;" type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][tabname_lang_<?php echo $language['language_id']; ?>]" value="<?php echo $module['tabname_lang_' . $language['language_id']]; ?>" />
                                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $text_cart_btn; ?></td>
                                    <td> 
                                        <?php foreach ($languages as $language) { ?>
                                            <input style="width: 300px;" type="text" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][cart_btn_lang_<?php echo $language['language_id']; ?>]" value="<?php echo $module['cart_btn_lang_' . $language['language_id']]; ?>" />
                                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="tab-customcss-<?php echo $module_row; ?>">
                            <table class="form">
                                <tr>
                                    <td>Edit CSS: </td>
                                    <td> 
                                        <textarea style="width: 100%; height: 500px;" class="css_textarea codepress css linenumbers-off autocomplete-off" rows="30" id="customcss_textarea_<?php echo $module_row; ?>" name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][css]"><?php echo $module['css']; ?></textarea> 
                                        <br />
                                        <strong>Warning!</strong> 
                                        <i>Please keep the {module_id} and {your_template_var} in tact for this message to work properly !</i>
                                        <br /><br />
                                        <a onclick="resetToDefaultCss(<?php echo $module_row; ?>);" class="button">Reset to Default css</a>
                                    </td>
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

    $('.vtabs a').tabs();



    function addRelated(row) {
        $('#product-' + row + ' :selected').each(function() {
            $(this).remove();

            $('#related-' + row + ' option[value=\'' + $(this).attr('value') + '\']').remove();

            $('#related-' + row + '').append('<option value="' + $(this).attr('value') + '">' + $(this).text() + '</option>');

            $('#product_related-' + row + ' input[value=\'' + $(this).attr('value') + '\']').remove();

            $('#product_related-' + row + '').append('<input type="hidden" name="recentlyv_carousel_bt_module[' + row + '][products][]" value="' + $(this).attr('value') + '" />');
        });
    }

    function removeRelated(row) {
        $('#related-' + row + ' :selected').each(function() {
            $(this).remove();

            $('#product_related-' + row + ' input[value=\'' + $(this).attr('value') + '\']').remove();
        });
    }

    function getProducts(row) {
        $('#product-' + row + ' option').remove();

<?php if (isset($this->request->get['product_id'])) { ?>
            var product_id = '<?php echo $this->request->get['product_id'] ?>';
<?php } else { ?>
            var product_id = 0;
<?php } ?>

        $.ajax({url: 'index.php?route=module/recentlyv_carousel_bt/category&token=<?php echo $token; ?>&category_id=' + $('#category-' + row + '').attr('value'),
            dataType: 'json',
            success: function(data) {
                for (i = 0; i < data.length; i++) {
                    $('#product-' + row + '').append('<option value="' + data[i]['product_id'] + '">' + data[i]['name'] + ' (' + data[i]['model'] + ') </option>');
                }
            }
        });
    }

    function getRelated(row) {
        $('#related-' + row + ' option').remove();

        $.ajax({url: 'index.php?route=module/recentlyv_carousel_bt/related&token=<?php echo $token; ?>&module_id=' + row,
            type: 'POST',
            dataType: 'json',
            data: $('#product_related-' + row + ' input'),
            success: function(data) {
                $('#product_related-' + row + ' input').remove();

                for (i = 0; i < data.length; i++) {
                    $('#related-' + row + '').append('<option value="' + data[i]['product_id'] + '">' + data[i]['name'] + ' (' + data[i]['model'] + ') </option>');

                    $('#product_related-' + row + '').append('<input type="hidden" name="recentlyv_carousel_bt_module[' + row + '][products][]" value="' + data[i]['product_id'] + '" />');
                }
            }
        });
    }

<?php
$countMo = 1;
foreach ($modules as $module) {
    ?>
        $('#tabsh-<?php echo $countMo; ?> a').tabs();


        getProducts(<?php echo $countMo; ?>);
        getRelated(<?php echo $countMo; ?>);
    <?php
    $countMo++;
}
?>
    autoCompleteProduct();

    function disableCategories(row) {
        if ($('.category_item_' + row).attr('disabled') == 'disabled') {
            $('.category_item_' + row).removeAttr('disabled');
        } else {
            $('.category_item_' + row).attr('disabled', 'disabled');
        }

    }



    function autoCompleteProduct() {
        $('.autocompleteProduct').autocomplete({
            delay: 500,
            source: function(request, response) {
                $.ajax({
                    url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item.name,
                                value: item.product_id
                            }
                        }));
                    }
                });
            },
            select: function(event, ui) {

                $('#product-' + $(this).data('id') + ' option[value=\'' + ui.item.value + '\']').remove();
                $('#related-' + $(this).data('id') + ' option[value=\'' + ui.item.value + '\']').remove();
                $('#related-' + $(this).data('id') + '').append('<option value="' + ui.item.value + '">' + ui.item.label + '</option>');

                $('#product_related-' + $(this).data('id') + ' input[value=\'' + ui.item.value + '\']').remove();

                $('#product_related-' + $(this).data('id') + '').append('<input type="hidden" name="recentlyv_carousel_bt_module[' + $(this).data('id') + '][products][]" value="' + ui.item.value + '" />');


                return false;
            },
            focus: function(event, ui) {
                return false;
            }
        });
    }


    var module_row = <?php echo $module_row; ?>;

    function addModule() {


        html = '<div id="tab-module-' + module_row + '" class="vtabs-content">';
        html += '<div id="tabsh-' + module_row + '" class="htabs">';
        html += '<a href="#tab-global-' + module_row + '"><?php echo $text_general; ?></a>';
        html += '<a href="#tab-carouselsetting-' + module_row + '">Carousel setting</a>';
        html += '<a href="#tab-languagesetting-' + module_row + '"><?php echo $text_languagesettings; ?></a>';
        html += '<a href="#tab-customcss-' + module_row + '">Custom CSS</a>';
        html += '</div>';
        html += '<div id="tab-global-' + module_row + '">';
        html += '<table class="form">';
        html += '<tr>';
        html += ' <td class="left"><?php echo $entry_limit; ?></td>';
        html += ' <td class="left"><input type="text" name="recentlyv_carousel_bt_module[' + module_row + '][limit]" value="10" size="1" /></td>';
        html += '  </tr>';
        html += ' <tr>';
        html += '  <td class="left">Product dislpay on one page:</td>';
        html += ' <td class="left"><input type="text" name="recentlyv_carousel_bt_module[' + module_row + '][scroll_limit]" value="6" size="1" /><br><small>If dislpay box in side change to 1</small></td>';
        html += ' </tr>';
        html += ' <tr>';
        html += '  <td class="left"><?php echo $entry_image; ?></td>';
        html += ' <td class="left">';
        html += ' <input type="text" name="recentlyv_carousel_bt_module[' + module_row + '][image_width]" value="80" size="3" />';
        html += '<input type="text" name="recentlyv_carousel_bt_module[' + module_row + '][image_height]" value="80" size="3" />';

        html += '</td>';
        html += '  </tr>';

        html += ' <tr>';
        html += ' <td class="left"><?php echo $entry_category; ?><br /><small>This setting working only Category layout</small></td>';
        html += '<td class="left">';
        html += '  <input class="dont_chcked" onclick="disableCategories(' + module_row + ');"   name="recentlyv_carousel_bt_module[<?php echo $module_row; ?>][display_in_all]" type="checkbox" value="1" checked /> Display in ALL Categories<br/>';
        html += ' <br />';
        html += ' <b>OR select Categories:</b>';
        html += ' <br />';
        html += ' <br />';
<?php
if (isset($module['category_source'])) {
    $a = $module['category_source'];
} else {
    $a = array();
}
?>
        html += ' <table>';
<?php
$icount = 1;

foreach ($categories as $category) {

    if (!($icount % 3)) {
        if ($icount > 0) {
            ?>
                    html += '</tr>';
        <?php } ?>
                html += '<tr>';
    <?php } ?>

            html += '  <td style="padding-right: 19px;"> <input  class="category_item_' + module_row + '" name="recentlyv_carousel_bt_module[' + module_row + '][category_source][]" type="checkbox" value="<?php echo $category['category_id']; ?>"  /><?php echo addslashes($category['name']) ?><br/></td> ';

    <?php
    $icount++;
}
?>
        html += ' </tr>  ';
        html += ' </table>';
        html += ' <br />';
        html += '<a onclick="$(this).parent().find(\':checkbox:not( .dont_chcked )\').attr(\'checked\', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(\':checkbox:not( .dont_chcked )\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a>';
        html += ' </td>';
        html += '</tr>';

        html += ' <tr>';
        html += ' <td class="left"><?php echo $entry_layout; ?></td>';
        html += '<td class="left">';
        html += ' <br />';
        html += ' Layout:<br />';
        html += '<select name="recentlyv_carousel_bt_module[' + module_row + '][layout_id]">';
<?php foreach ($layouts as $layout) { ?>

            html += ' <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';

<?php } ?>
        html += '  </select>';
        html += ' <br /><br />';
        html += ' Use in store:<br />';
        html += ' <div class="scrollbox">';
<?php $class = 'even'; ?>
        html += ' <div class="<?php echo $class; ?>">';


        html += ' <input type="checkbox" name="recentlyv_carousel_bt_module[' + module_row + '][store][]" value="0" checked  />';
        html += '<?php echo addslashes($text_default); ?>';

        html += ' </div>';
<?php foreach ($stores as $store) { ?>
    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
            html += '  <div class="<?php echo $class; ?>">';

            html += ' <input type="checkbox" name="recentlyv_carousel_bt_module[' + module_row + '][store][]" value="<?php echo $store['store_id']; ?>" />';
            html += '   <?php echo addslashes($store['name']); ?>';

            html += ' </div>';
<?php } ?>
        html += '  </div>';
        html += ' <br />';

        html += '</td>';
        html += '  </tr>';

        html += ' <tr>';
        html += '  <td class="left"><?php echo $entry_position; ?></td>';
        html += ' <td class="left"><select name="recentlyv_carousel_bt_module[' + module_row + '][position]">';

        html += ' <option value="content_top"><?php echo $text_content_top; ?></option>';


        html += '<option value="content_bottom"><?php echo $text_content_bottom; ?></option>';


        html += ' <option value="column_left"><?php echo $text_column_left; ?></option>';

        html += '  <option value="column_right"><?php echo $text_column_right; ?></option>';

        html += '   </select></td>';
        html += ' </tr>';

        html += ' <tr>';
        html += ' <td class="left"><?php echo $entry_status; ?></td>';
        html += '<td class="left"><select name="recentlyv_carousel_bt_module[' + module_row + '][status]">';

        html += '  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
        html += ' <option value="0"><?php echo $text_disabled; ?></option>';

        html += ' </select></td>';
        html += ' </tr>';

        html += ' <tr>';
        html += ' <td class="right"><?php echo $entry_sort_order; ?></td>';
        html += '  <td class="right"><input type="text" name="recentlyv_carousel_bt_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
        html += ' </tr>';
        html += ' <tr>';
        html += ' <td class="left">Show in box</td>';
        html += ' <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][show_in_box]" value="on" type="checkbox" checked> ';
        html += ' </td> ';
        html += '  </tr>';
        html += ' </table>';
        html += '</div>';
        html += ' <div id="tab-carouselsetting-' + module_row + '">';
        html += ' <table class="form">';
        html += '   <tr>';
        html += '     <td class="left">Set Carousel Circular</td>';
        html += '    <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[' + module_row + '][carousel][circular]" value="on"  checked/> <small>Makes the carousel circular</small></td>';
        html += '  </tr>';
        html += ' <tr>';
        html += '    <td class="left">Set Carousel Infinite</td>';
        html += '    <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[' + module_row + '][carousel][infinite]" value="on" checked /> <small> Makes the carousel infinite</small></td>';
        html += ' </tr>';
        html += ' <tr>';
        html += '    <td class="left">Set Carousel Responsive</td>';
        html += '   <td class="left"><input type="checkbox" name="recentlyv_carousel_bt_module[' + module_row + '][carousel][responsive]" value="on" /> <small> Makes the carousel responsive</small></td>';
        html += '  </tr>';
        html += ' <tr>';
        html += ' <td class="left">Set Carousel Direction</td>';
        html += ' <td class="left">';
        html += '   <select name="recentlyv_carousel_bt_module[' + module_row + '][carousel][direction]">';
        html += '   <option selected="selected" value="left">Left</option>';
        html += '   <option value="right">Right</option>';
        html += '  <option value="up">Up</option>';
        html += '  <option value="down">Down</option>';
        html += '  </select>';
        html += '  <br />';
        html += ' <small> Select the direction of the products in the carousel</small></td>';
        html += ' </tr>';
        html += ' <tr>';
        html += '  <td class="left">Carousel Size</td>';
        html += ' <td class="left">';
        html += '    <input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][width]" value="" type="text"> x <input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][height]" value="" type="text"><br>';
        html += '   <small>Size in px of the carousel. You can use <strong>variable</strong> or <strong>auto</strong>. If left blank the size will be automatically calculated</small>';
        html += ' </td>';
        html += '   </tr>';
        html += ' <tr>';
        html += '  <td class="left">Carousel Alignment</td>';
        html += ' <td class="left">';
        html += '    <select name="recentlyv_carousel_bt_module[' + module_row + '][carousel][align]">';
        html += '   <option value="left">Left</option>';
        html += '   <option value="right" >Right</option>';
        html += '  <option value="center" selected="selected">Center</option>';
        html += ' </select><br>  ';
        html += '  <small>Select the alignment of the products in the carousel</small>';
        html += '  </td>';
        html += ' </tr>';
        html += '  <tr>';
        html += '   <td class="left">Set Products to Scroll</td>';
        html += '  <td class="left">';
        html += '    <input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][scroll_products]" value="1" type="text"><br>  ';
        html += '    <small>Configure the number of products to scroll at a time</small>  ';
        html += '   </td>';
        html += '  </tr>';
        html += '<tr>';
        html += '<td class="left">Scrolling Effect</td>';
        html += '<td class="left">';
        html += '   <select name="recentlyv_carousel_bt_module[' + module_row + '][carousel][scroll_effect]">';
        html += '    <option value="scroll" selected="selected">Scroll</option>';
        html += '   <option value="directscroll">Direct Scroll</option>';
        html += '  <option value="fade">Fade</option>';
        html += '  <option value="crossfade">Crossfade</option>';
        html += ' <option value="cover">Cover</option>';
        html += ' <option value="cover-fade">Cover Fade</option>';
        html += '  <option value="uncover">Uncover</option>';
        html += ' <option value="uncover-fade">Uncover Fade</option>';
        html += ' <option value="none">No Effect</option>';
        html += '   </select><br>  ';
        html += '  <small>Select the effect of the scrolling products in the carousel</small>';
        html += '  </td>';
        html += '    </tr>';
        html += '  <tr>';
        html += '  <td class="left">Scrolling Easing Animation</td>';
        html += ' <td class="left">';
        html += ' <select name=recentlyv_carousel_bt_module[' + module_row + '][carousel][scroll_easing]">';
        html += '    <option value="swing" selected="selected">Swing</option>';
        html += '   <option value="linear">Linear</option>';
        html += '  <option value="quadratic">Quadratic</option>';
        html += '  <option value="cubic">Cubic</option>';
        html += '  <option value="elastic">Elastic</option>';
        html += '  </select><br> ';
        html += '   <small>Select the effect of the scrolling products in the carousel</small>';
        html += '  </td>';
        html += '  </tr>';
        html += '  <tr>';
        html += '   <td class="left">Set Scrolling Duration</td>';
        html += '  <td class="left">';
        html += '  <input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][scroll_duration]" value="1500" type="text"><br> ';
        html += '  <small>Configure the time in milli seconds for the scroll of an product</small> ';
        html += ' </td>';
        html += '  </tr>';
        html += '  <tr>';
        html += '<td class="left">Set Timeout Duration</td>';
        html += ' <td class="left">';
        html += '   <input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][timeout_duration]" value="2500" type="text"><br>  ';
        html += '   <small>The amount of milliseconds the carousel will pause. Default is 5 * [Scrolling Duration]</small>';
        html += '   </td>';
        html += '   </tr>';

        html += '  <tr>';
        html += ' <td class="left">Pause Carousel on Hover</td>';
        html += ' <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][hover]" value="on" checked="checked" type="checkbox"> ';
        html += '  <small>Pauses the carousel on hover</small></td>';
        html += '  </tr>';
        html += '  <tr>';
        html += ' <td class="left">Auto Play the Carousel</td>';
        html += '  <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][autoplay]" value="on" checked="checked" type="checkbox"> ';
        html += '     <small>Sets the caurousel to start automatically</small></td>';
        html += '   </tr>';
        html += '  <tr>';
        html += '   <td class="left">Carousel Direction Nav</td>';
        html += '    <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][nav]" value="on" type="checkbox"> ';
        html += '     <small>Create navigation for previous/next navigation</small></td>';
        html += ' </tr>';
//        html += ' <tr>';
//        html += '  <td class="left">Carousel Keyboard Nav</td>';
//        html += '  <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][key_nav]" value="on" type="checkbox"> ';
//        html += '         <small>Allow navigating via keyboard left/right keys</small></td>';
//        html += ' </tr>';
        html += '  <tr>';
        html += '    <td class="left">Carousel Control Nav</td>';
        html += '   <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][pagination]" value="on" type="checkbox"> ';
        html += '       <small>Create navigation for paging control of each product</small></td>';
        html += '  </tr>';
        html += '   <tr>';
        html += '     <td class="left">Carousel Swipe Nav</td>';
        html += '   <td class="left"><input name="recentlyv_carousel_bt_module[' + module_row + '][carousel][swipe_nav]" value="on" type="checkbox" checked> ';
        html += '     <small>Allow navigating via swiping for touchscreen devices</small></td>';
        html += ' </tr>';
        html += '  </table>';
        html += '  </div>';

        html += '<div id="tab-languagesetting-' + module_row + '">';
        html += ' <table class="form">';
        html += '    <tr>';
        html += '     <td><?php echo $text_tabname; ?></td>';
        html += '    <td> ';
<?php foreach ($languages as $language) { ?>
            html += '       <input style="width: 300px;" type="text" name="recentlyv_carousel_bt_module[' + module_row + '][tabname_lang_<?php echo $language['language_id']; ?>]" value="Recently Viewed" />';
            html += '      <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo addslashes($language['name']); ?>" /><br />';
<?php } ?>
        html += ' </td>';
        html += '  </tr>';
        html += ' <tr>';
        html += '  <td><?php echo $text_cart_btn; ?></td>';
        html += '  <td> ';
<?php foreach ($languages as $language) { ?>
            html += '    <input style="width: 300px;" type="text" name="recentlyv_carousel_bt_module[' + module_row + '][cart_btn_lang_<?php echo $language['language_id']; ?>]" value="Add to Cart" />';
            html += '      <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo addslashes($language['name']); ?>" /><br />';
<?php } ?>
        html += ' </td>';
        html += '  </tr>';
        html += '   </table>';
        html += '     </div>';

        html += '<div id="tab-customcss-' + module_row + '">';
        html += '<table class="form">';
        html += '<tr>';
        html += '<td>Edit CSS: </td>';
        html += '<td> ';
        html += '<textarea  class="css_textarea codepress css linenumbers-off autocomplete-off" style="width: 100%; height: 500px;" id="customcss_textarea_' + module_row + '" name="recentlyv_carousel_bt_module[' + module_row + '][css]">sdasdsads sdsad</textarea> ';
        html += '<br /> ';
        html += '<strong>Warning!</strong> ';
        html += '<i>Please keep the {module_id} and {your_template_var} in tact for this message to work properly !</i> ';
        html += '<br /><br /><a onclick="resetToDefaultCss(' + module_row + ');" class="button">Reset to Default css</a>';
        html += '</td>';
        html += '</tr>';
        html += '</table>';
        html += '</div>';

        html += '   </div>';
        html += '</div>';


        $('#form').append(html);
        $('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '">Module ' + module_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');
        $('.vtabs a').tabs();
        disableCategories(module_row);
        $('#tabsh-' + module_row + ' a').tabs();
        getProducts(module_row);


        CodePress.run();


        autoCompleteProduct();
        $('#module-' + module_row).trigger('click');
        
        //eval('customcss_textarea_' + module_row + '.setCode("Loading...")');
        resetToDefaultCss(module_row);
        resetToDefaultCss(module_row);
       
        module_row++;
        
    }

    function resetToDefaultCss(row) {
     //   CodePress.run();
    
//        $('#customcss_textarea_' + row).val('Loading...');
        eval('customcss_textarea_' + row + '.setCode("Loading...")');
        $.ajax({url: 'index.php?route=module/recentlyv_carousel_bt/getdefaultcss&token=<?php echo $token; ?>',
            dataType: 'html',
            success: function(data) {
//                $('#customcss_textarea_' + row).val(data);
                eval('customcss_textarea_' + row).setCode(data);
                if (eval('customcss_textarea_' + row).editor != null){
                eval('customcss_textarea_' + row).editor.syntaxHighlight('init');
                }
            }
        });
    }
    
    function formSubmitEdit() {
        $('#save_and_keep_edit').attr('value', 1);

        for (var i = 1; i < module_row; i++) {
            if (typeof eval('customcss_textarea_' + i) !== 'undefined') {
                eval('customcss_textarea_' + i).toggleEditor();
            }
        }

        $('#form').submit();
    }
    
     function formSubmit() {
        for (var i = 1; i < module_row; i++) {
            if (typeof eval('customcss_textarea_' + i) !== 'undefined') {
                eval('customcss_textarea_' + i).toggleEditor();
            }
        }

        $('#form').submit();
    }

//--></script> 
<style>
    .css_textarea{
        font-family: monospace;
        font-size: 14px;
    }
</style>
<script type="text/javascript" src="view/javascript/codepress/codepress.js"></script>
<?php echo $footer; ?>