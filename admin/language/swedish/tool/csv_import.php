<?php
#####################################################################################
#  Module CSV IMPORT PRO for Opencart 1.5.x From HostJars opencart.hostjars.com 	#
#####################################################################################

// Heading
$_['heading_title']    = 'CSV Import PRO';

// Tabs
$_['tab_config'] = 'Steg 1: Globala inställningar';
$_['tab_map'] = 'Steg 2: Fält kartläggning';
$_['tab_adjust'] = 'Steg 3: Justera data';
$_['tab_import'] = 'Steg 4: Importera';

// Text
$_['text_csv_import_menu']     = 'CSV Import';
$_['text_success']     = 'Fungerade: Lade till %s produkter, Uppdaterade %s produkter, Skippade %s produkter, Missade %s produkter.';
$_['text_add']     = 'Lägg till';
$_['text_reset']     = 'Återställ';
$_['text_update']     = 'Lägg till / Uppdatera';


// Entry
$_['entry_import_file']     = 'Produkt Import Fil:';
$_['entry_import_url']     = 'Produkt Import URL:';
$_['entry_stock_status']  = 'Standard Lager Status:';
$_['entry_weight_class']  = 'Standard Vikt Klass:';
$_['entry_length_class']  = 'Standard Längd Klass:';
$_['entry_tax_class']  = 'Standard Skatt Klass:';
$_['entry_subtract']  = 'Ta bort från lager:';
$_['entry_product_status']  = 'Standard Produkt status:';
$_['entry_language']  = 'Språk:';
$_['entry_ignore_fields'] = 'Skippa Produkter Där:';
$_['entry_store']  	   = 'Affär:';
$_['entry_remote_images']  	   = 'Ladda ner bilder från annan källa:';
$_['entry_remote_images_warning']  	   = 'Varning: Importeringen kommer troligen att time-out för filer som inehåller mer än 500 produkter';
$_['entry_language']   = 'Språk:';
$_['entry_delimiter']  = 'CSV Fält Separatör:';
$_['entry_escape']     = 'CSV Escape Tecken:';
$_['entry_qualifier']  = 'CSV Text Beteckning:';
$_['entry_data_feed']  = 'CSV Data Fil:';
$_['entry_field_mapping']= 'Fält Kartläggning:';
$_['entry_import_type']= 'Import Typ:';
$_['entry_price_multiplier']= 'Pris Multiplikator:';
$_['entry_image_remove']= 'Bild Ta bort text:';
$_['entry_image_prepend']= 'Bild Lägg till text före:';
$_['entry_image_append']= 'Bild Lägg till text efter:';
$_['entry_split_category']= 'Kategori Separatör:';
$_['entry_top_categories']= 'Lägga till kategorier till toppen:';

// Field Names
$_['text_field_oc_title']	 = 'OpenCart Fält';
$_['text_field_csv_title']	 = 'CSV Kolumnrubriken';
$_['text_field_name']     = 'Namn';
$_['text_field_price']     = 'Pris';
$_['text_field_special_price']     = 'Specialpris';
$_['text_field_model']     = 'Modell';
$_['text_field_sku']     = 'Sku';
$_['text_field_upc']     = 'UPC';
$_['text_field_points']     = 'Poäng';
$_['text_field_reward']     = 'Belöningar';
$_['text_field_manufacturer']     = 'Tillverkare';
$_['text_field_attribute']     = 'Attribut';
$_['text_field_category']     = 'Kategori';
$_['text_field_quantity']     = 'Antal';
$_['text_field_image']     = 'Bild';
$_['text_field_additional_image']     = 'Extra bild';
$_['text_field_description']     = 'Beskrivning';
$_['text_field_meta_desc']     = 'Meta Description';
$_['text_field_meta_keyw']     = 'Meta Keywords';
$_['text_field_weight']     = 'Vikt';
$_['text_field_length']     = 'Längd';
$_['text_field_height']     = 'Höjd';
$_['text_field_width']     = 'Bredd';
$_['text_field_location']     = 'Plats';
$_['text_field_keyword']     = 'SEO Sökord';
$_['text_field_tags']     = 'Produkt nyckelord';


// Import
$_['button_import']	   = 'Importera';
$_['button_save'] 	   = 'Spara';
$_['button_cancel']	   = 'Avbryt';


// Error
$_['error_permission'] = 'Varning: Du har inte behörighet att ändra csv-import!';
$_['error_empty']      = 'Varning: Ingen fil eller tom fil, spara endast!';
$_['error_update_field_mapping'] = 'Varning:. Du har angett en uppdatering baserad på %s, men %s är inte kartlagd.';
?>