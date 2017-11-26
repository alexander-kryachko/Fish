<?php
// Heading
$_['heading_title'] = 'Latests in Recent N Days';

// Text
$_['text_module']             = 'Modules';
$_['text_success']            = 'Success: You have modified module latest!';
$_['text_list']               = 'List';
$_['text_grid']               = 'Grid';
if (version_compare(VERSION, '2.0', '>=')) {
  $_['text_edit']               = 'Editing module';
}
$_['text_select_display']     = 'Select the type of display';
$_['text_breadcrumbs_main']   = 'Into main breadcrumbs';
$_['text_breadcrumbs_single'] = 'Into single breadcrumbs';
$_['text_yes']                = 'Yes';
$_['text_no']                 = 'No';

// Entry
$_['entry_image']                   = 'Image Size (Width x Height):';
$_['entry_days']                    = 'Latest in Recent Days:';
$_['entry_limit']                   = 'Products in Page:';
$_['entry_product_count']           = 'Show number of products in categories:';
$_['entry_hide_categories']         = 'Hide categories';
$_['entry_only_main_categories']    = 'Show only main categories';
$_['help_only_main_categories']     = "Ignore parameter 'Show in categories' and show only categories from 'Category'";
$_['entry_only_main_categories_h1'] = 'Show HTML H1 instead Category title';
$_['help_only_main_categories_h1']  = "Only with 'Show only main categories'";
$_['entry_show_category_images']    = 'Show Category Images';
$_['entry_display']                 = 'View:';
$_['entry_layout']                  = 'Layout:';
$_['entry_name']                    = 'Caption:';
$_['entry_seo_h1']                  = 'HTML H1:';
$_['entry_seo_title']               = 'HTML Title:';
$_['entry_meta_keyword']            = 'Meta Keywords:';
$_['entry_meta_description']        = 'Meta Description:';
$_['entry_description']             = 'Description:';
$_['entry_hide_outofstock']         = 'Hide out of stock goods';
$_['help_hide_outofstock']          = 'Not showing goods where quantity = 0';
$_['entry_seo_url']                 = 'SEO URL:';
$_['entry_breadcrumbs_separate']    = 'Separate breadcrumbs:';

//Buttons
$_['button_save']   = 'Save';
$_['button_cancel'] = 'Cancel';

// Error
$_['error_warning']     = 'Carefully check the form for errors!';
$_['error_permission']  = 'Warning: You do not have permission to modify module latest!';
$_['error_image']       = 'Image width &amp; height dimensions required!';
$_['error_image_value'] = 'The size of the image should contain only numbers and be a whole number!';
$_['error_days']        = 'Specify the number of days for which to display the goods!';
$_['error_days_value']  = 'The value can only contain numbers and must be an integer!';
$_['error_limit']       = 'Specify the number of products per page!';
$_['error_limit_value'] = 'The value can only contain numbers and must be an integer!';
$_['error_name']        = 'The name must be between 2 and 32 characters!';

?>