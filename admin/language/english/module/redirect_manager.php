<?php
//==============================================================================
// Redirect Manager v156.2
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
//==============================================================================

$version = 'v156.2';

// Heading
$_['heading_title']				= 'Redirect Manager';

// Buttons
$_['button_save_exit']			= 'Save & Exit';
$_['button_save_keep_editing']	= 'Save & Keep Editing';
$_['button_import_csv']			= 'Import CSV';
$_['button_export_csv']			= 'Export CSV';
$_['button_reset_all']			= 'Reset All';
$_['button_delete_all']			= 'Delete All';
$_['button_add_row']			= 'Add Redirect';

// Entries
$_['entry_sort_by']				= 'Sort By:';
$_['entry_order']				= 'Order:';
$_['entry_ascending']			= 'Ascending';
$_['entry_descending']			= 'Descending';
$_['entry_status']				= 'Status:';
$_['entry_active']				= 'Active';
$_['entry_from_url']			= 'From URL';
$_['entry_to_url']				= 'To URL';
$_['entry_date_start']			= 'Date Start';
$_['entry_date_end']			= 'Date End';
$_['entry_response_code']		= 'Response Code';
$_['entry_times_used']			= 'Times Used';

// Text
$_['text_help']					= '
	<ol class="help" style="margin: 0; line-height: 1.5">
		<li>You <strong>MUST</strong> have renamed the .htaccess.txt file to .htaccess for this extension to work.</li>
		<li>Enter URLs with http:// or https:// at the beginning. If left out, http:// will be added for you.</li>
		<li>Use an asterisk (the * symbol) to include a wildcard in a From URL. This will match 0 or more characters for that part of the URL.<br />
			You can also use wildcards in the associated To URL, to redirect using the part matched by the wildcard(s) in the From URL.</li>
		<li>Leave one or both date fields blank to have no date restriction.</li>
		<li>Re-ordering the list of redirects will automatically save your settings and redirects.</li>
	</ol>';
$_['text_moved_permanently']	= '301 Moved Permanently';
$_['text_found']				= '302 Found';
$_['text_temporary_redirect']	= '307 Temporary Redirect';
$_['text_warning']				= 'Warning: This operation cannot be undone. Continue?';

// Copyright
$_['copyright']					= '<div style="text-align: center" class="help">' . $_['heading_title'] . ' ' . $version . ' &copy; <a target="_blank" href="http://www.getclearthinking.com">Clear Thinking, LLC</a></div>';

// Standard Text
$_['standard_module']			= 'Modules';
$_['standard_shipping']			= 'Shipping';
$_['standard_payment']			= 'Payments';
$_['standard_total']			= 'Order Totals';
$_['standard_feed']				= 'Product Feeds';
$_['standard_success']			= 'Success: You have modified ' . $_['heading_title'] . '!';
$_['standard_error']			= 'Warning: You do not have permission to modify ' . $_['heading_title'] . '!';
?>