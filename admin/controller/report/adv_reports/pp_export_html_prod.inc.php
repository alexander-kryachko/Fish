<?php
ini_set("memory_limit","256M");
	
	$export_html_prod ="<html><head>";
	$export_html_prod .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_html_prod .="</head>";
	$export_html_prod .="<body>";
	$export_html_prod .="<style type='text/css'>
	.list_main {
		border-collapse: collapse;
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;	
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.list_main td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;	
	}
	.list_main thead td {
		background-color: #E5E5E5;
		padding: 3px;
		font-weight: bold;
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
	$export_html_prod .="<table class='list_main'>";
	$export_html_prod .="<thead>";
	$export_html_prod .="<tr>";
	if ($filter_group == 'year') {				
	$export_html_prod .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_html_prod .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_prod_order_id')."</td>";
	$export_html_prod .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_prod_date_added')."</td>";
	} else {
	$export_html_prod .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_start')."</td>";
	$export_html_prod .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_end')."</td>";	
	}
	isset($_POST['pp21']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_sku')."</td>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_name')."</td>" : '';
	isset($_POST['pp23']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_model')."</td>" : '';
	isset($_POST['pp24']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_category')."</td>" : '';
	isset($_POST['pp25']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp34']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_attribute')."</td>" : '';
	isset($_POST['pp26']) ? $export_html_prod .= "<td align='left'>".$this->language->get('column_status')."</td>" : '';
	isset($_POST['pp35']) ? $export_html_prod .= "<td align='right'>".$this->language->get('column_stock_quantity')."</td>" : '';
	isset($_POST['pp27']) ? $export_html_prod .= "<td align='right'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_html_prod .= "<td align='right'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_html_prod .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_html_prod .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';
	$export_html_prod .="</tr>";
	$export_html_prod .="</thead><tbody>";
	foreach ($results as $result) {
		
	$this->load->model('catalog/product');
	$cat =  $this->model_catalog_product->getProductCategories($result['product_id']);
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
	$categories = $this->model_report_adv_product_purchased->getProductsCategories(0); 
	
	$export_html_prod .="<tr>";
	if ($filter_group == 'year') {				
	$export_html_prod .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_html_prod .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} else {
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_html_prod .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	isset($_POST['pp21']) ? $export_html_prod .= "<td align='left'>".$result['sku']."</td>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "<td align='left' style='color:#03C;'><strong>".$result['name']."</strong>" : '';
	if ($filter_ogrouping) {
	if ($result['oovalue']) {
	isset($_POST['pp22']) ? $export_html_prod .= "<table cellpadding='0' cellspacing='0' border='0' style='border:none;'><tr>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "<td style='font-family:Arial, Helvetica; font-size:11px; color:#03C; border:none;' nowrap='nowrap'>".$result['ooname'].":</td>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "<td style='font-family:Arial, Helvetica; font-size:11px; color:#03C; border:none;' nowrap='nowrap'>".$result['oovalue']."</td>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "</tr></table>" : '';
	}
	}		
	isset($_POST['pp22']) ? $export_html_prod .= "</td>" : '';
	isset($_POST['pp23']) ? $export_html_prod .= "<td align='left'>".$result['model']."</td>" : '';
	isset($_POST['pp24']) ? $export_html_prod .= "<td align='left'>" : '';
		foreach ($categories as $category) {
			if (in_array($category['category_id'], $cat)) {
			isset($_POST['pp24']) ? $export_html_prod .= "".$category['name']."<br>" : '';
			}
		}
	isset($_POST['pp24']) ? $export_html_prod .= "</td>" : '';
	isset($_POST['pp25']) ? $export_html_prod .= "<td align='left'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_html_prod .= "".$manufacturer['name']."" : '';
			}
		}
	isset($_POST['pp25']) ? $export_html_prod .= "</td>" : '';
	isset($_POST['pp34']) ? $export_html_prod .= "<td align='left'>".$result['attribute']."</td>" : '';
	isset($_POST['pp26']) ? $export_html_prod .= "<td align='left'>".($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'))."</td>" : '';
	isset($_POST['pp35']) ? $export_html_prod .= "<td align='right' nowrap='nowrap'>" : '';	
	if ($result['stock_quantity'] <= 0) {
	isset($_POST['pp35']) ? $export_html_prod .= "<span style='color:#FF0000;'>".$result['stock_quantity']."</span>" : '';
	} elseif ($result['stock_quantity'] <= 5) {
	isset($_POST['pp35']) ? $export_html_prod .= "<span style='color:#FFA500;'>".$result['stock_quantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_html_prod .= "<span>".$result['stock_quantity']."</span>" : '';
	}
	if ($filter_ogrouping) {	
	if ($result['oovalue']) {	
	if ($result['stock_oquantity'] <= 0) {
	isset($_POST['pp35']) ? $export_html_prod .= "<br><span style='color:#FF0000; font-size:11px;'>".$result['stock_oquantity']."</span>" : '';
	} elseif ($result['stock_oquantity'] <= 5) {
	isset($_POST['pp35']) ? $export_html_prod .= "<br><span style='color:#FFA500; font-size:11px;'>".$result['stock_oquantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_html_prod .= "<br><span style='font-size:11px;'>".$result['stock_oquantity']."</span>" : '';
	}
	}
	}	
	isset($_POST['pp35']) ? $export_html_prod .= "</td>" : '';
	isset($_POST['pp27']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_html_prod .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_html_prod .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';
	$export_html_prod .="</tr>";
	}
	$export_html_prod .="</tbody><tbody><tr>";
	$export_html_prod .= "<td colspan='2' align='right' style='background-color:#E7EFEF;'><strong>".$this->language->get('text_filter_total')."</strong></td>";
	isset($_POST['pp21']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp22']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';	
	isset($_POST['pp23']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp24']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp25']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp34']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp26']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp35']) ? $export_html_prod .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_html_prod .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	$export_html_prod .="</tr></tbody></table>";	
	$export_html_prod .="</body></html>";

$filename = "product_purchased_report_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Disposition: attachment; filename='.$filename.".html");
print $export_html_prod;			
exit;
?>