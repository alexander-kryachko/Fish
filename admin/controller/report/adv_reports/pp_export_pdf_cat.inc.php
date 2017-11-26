<?php
ini_set("memory_limit","256M");
			
	$export_pdf_cat ="<html><head>";
	$export_pdf_cat .="</head>";
	$export_pdf_cat .="<body>";
	$export_pdf_cat .="<style type='text/css'>
	.list_main {
		border-collapse: collapse;		
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;	
		font-family: Helvetica;
		font-size: 10px;
	}
	.list_main td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;	
	}
	.list_main tbody a {
		text-decoration: none;
	}
	.list_main tbody td {
		vertical-align: middle;
		padding: 3px;
	}
	.list_main .left {
		text-align: left;
		padding: 7px;
	}
	.list_main .right {
		text-align: right;
		padding: 7px;
	}
	.list_main .center {
		text-align: center;
		padding: 3px;
	}
	</style>";
	$export_pdf_cat .= "<table class='list_main'>";
	$export_pdf_cat .= "<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_cat .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_pdf_cat .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_order_id')."</td>";
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_date_added')."</td>";	
	} else {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_start')."</td>";
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_end')."</td>";	
	}
	isset($_POST['pp24']) ? $export_pdf_cat .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_category')."</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_cat .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_pdf_cat .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_pdf_cat .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_cat .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';		
	$export_pdf_cat .= "</tr>";
	$export_pdf_cat .= "<tbody>";
	foreach ($results as $result) {
			
	$this->load->model('catalog/product');
	$cat =  $this->model_catalog_product->getProductCategories($result['product_id']);
	$categories = $this->model_report_adv_product_purchased->getProductsCategories(0);
			
	$export_pdf_cat .= "<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_cat .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_pdf_cat .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";		
	} else {
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_pdf_cat .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	isset($_POST['pp24']) ? $export_pdf_cat .= "<td align='left' style='color:#03C;'>" : '';
		foreach ($categories as $category) {
			if (in_array($category['category_id'], $cat)) {
			isset($_POST['pp24']) ? $export_pdf_cat .= "<strong>".$category['name']."</strong><br>" : '';
			}
		}
	isset($_POST['pp24']) ? $export_pdf_cat .= "</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';	
	$export_pdf_cat .="</tr>";				
	}
	$export_pdf_cat .="</tbody><tbody><tr>";
	$export_pdf_cat .= "<td colspan='2' align='right' style='background-color:#E7EFEF;'><strong>".$this->language->get('text_filter_total')."</strong></td>";
	isset($_POST['pp24']) ? $export_pdf_cat .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_cat .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	$export_pdf_cat .="</tr></table></tbody>";	
	$export_pdf_cat .="</body></html>";

ini_set('mbstring.substitute_character', "none"); 
$dompdf_pdf_cat = mb_convert_encoding($export_pdf_cat, 'ISO-8859-1', 'UTF-8'); 
$dompdf = new DOMPDF();
$dompdf->load_html($dompdf_pdf_cat);
$dompdf->set_paper("a3", "landscape");
$dompdf->render();
$dompdf->stream("category_purchased_report_".date("Y-m-d",time()).".pdf");
?>