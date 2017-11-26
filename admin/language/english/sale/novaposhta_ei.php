<?php
// Heading
$_['heading_title']						= '&laquo;EI&raquo; of the company &laquo;Nova Poshta&raquo;';

//Button
$_['button_create_ei']					= 'Create &laquo;EI&raquo; for &laquo;Nova Poshta&raquo;';
$_['button_create']						= 'Create express invoice';
$_['button_ei_list']					= 'List of &laquo;EI&raquo;';
$_['button_pdf']						= 'Download in PDF';
$_['button_print']						= 'Print';
$_['button_ei']							= '&laquo;EI&raquo;';
$_['button_mark']						= 'Markings';
$_['button_mark_zebra']					= 'Markings of type  &laquo;Zebra&raquo;';
$_['button_back_to_orders']				= 'Back to orders';

// Text
$_['text_form']							= 'Creating express invoice';
$_['text_list']							= 'List of express invoices';
$_['text_orders']						= 'All orders';
$_['text_order']						= 'Order';
$_['text_sender']						= 'Sender';
$_['text_recipient']					= 'Recipient';
$_['text_shipment']						= 'Parameters of shipment';
$_['text_payment']						= 'Payment';
$_['text_additionally']					= 'Additionally';
$_['text_no_backward_delivery']			= 'No backward delivery';
$_['text_ei_success_add']				= 'Express invoice successfully created';

// Column
$_['column_ei_number']					= '№ &laquo;EI&raquo;';
$_['column_estimated_delivery_date']	= 'Delivery date';
$_['column_recipient']          		= 'Recipient';
$_['column_phone']          			= 'Phone number';
$_['column_city']          				= 'City';
$_['column_address']         			= 'Address';
$_['column_state']          			= 'State';
$_['column_action']          			= 'Action';

// Entry
$_['entry_ei_number'] 					= 'Number of &laquo;EI&raquo';
$_['entry_sender']              		= 'The name (or Full Name) of the sender';
$_['entry_recipient']             		= 'The name (or Full Name) of the recipient';
$_['entry_city']              			= 'City';
$_['entry_address']              		= 'Address';
$_['entry_contact_person']              = 'Contact person';
$_['entry_phone']              			= 'Phone number';
$_['entry_cargo_type']              	= 'Cargo type';
$_['entry_width']              			= 'Width, cm';
$_['entry_length']              		= 'Length, cm';
$_['entry_height']              		= 'Height, cm';
$_['entry_weight']              		= 'Weight, kg';
$_['entry_volume_weight']              	= 'Weight volume (W х L х H / 4000), kg';
$_['entry_volume_general']              = 'General volume of the shipment, m&sup3;';
$_['entry_seats_amount']              	= 'Seats amount, pc';
$_['entry_announced_price']             = 'Announced price, grn';
$_['entry_cargo_description']           = 'Cargo description';
$_['entry_payer']              			= 'Payer';
$_['entry_payment_type']              	= 'Payment type';
$_['entry_backward_delivery']           = 'Backward delivery';
$_['entry_backward_delivery_total']		= 'The total of backward delivery';
$_['entry_backward_delivery_payer']		= 'The payer of backward delivery';
$_['entry_shipment_date']				= 'Shipment date';
$_['entry_service_type'] 				= 'Shipping type';
$_['entry_sales_order_number'] 			= 'Domestic sales order number';
$_['entry_additional_information'] 		= 'Additional information about shipment';

// Error
$_['error_permission']					= 'Error! You don`t have permission to manage this extension';
$_['error_recipient'] 					= 'Failed to save recipient';
$_['error_recipient_contact_person'] 	= 'Failed to save contact person';
$_['error_ei_add'] 						= 'Failed to create express invoice';
$_['error_full_name_correct'] 			= 'Check the spelling of the surname, name and patronymic. Correct examples: Taras Shevchenko, Ivan Franko';
$_['error_full_name_characters'] 		= 'Last name, first name must consist only of letters Ukrainian or Russian alphabets';
$_['error_city'] 						= 'City not found in the database according to the description';
$_['error_address_city'] 				= 'The address for this city is not found in the database according to the description. Check the name of the city';
$_['error_address'] 					= 'The address for this city is not found in the database according to the description. Select the desired address from the list';
$_['error_phone'] 						= 'Invalid phone number format. Correct examples: 380501234567, 0661234567';
$_['error_width']              			= 'The width must be an integer not more than 35 cm';
$_['error_length']              		= 'The length must be an integer not more than 61 cm';
$_['error_height']              		= 'The height must be an integer not more than 37 cm';
$_['error_weight'] 						= 'Weight should be a float or integer greater than 0. Correct examples: 7, 1.002 и 0,024';
$_['error_volume'] 						= 'The volume must be a float or integer greater than 0. Correct examples: 7, 1.002 и 0,024';
$_['error_seats_amount'] 				= 'Seats must be an integer greater than 0';
$_['error_announced_price'] 			= 'The declared value must be a float or an integer greater than 0. Correct examples: 700, 100.5 и 77,25';
$_['error_cargo_description'] 			= 'Description of shipment shall consist of not less than 3 characters, and to make sense';
$_['error_backward_delivery_total'] 	= 'The amount of backward delivery must be a float or an integer greater than 0. Correct examples: 77, 100.7 и 34,25';
$_['error_date']						= 'Wrong date format. Correct example: 24.08.1991';
$_['error_date_past']					= 'Submit not be in the past';
$_['error_additional_information']		= 'Additional information about shipment can not be more than 100 characters';