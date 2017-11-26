<?php
ini_set("memory_limit","256M");
	
	$export_html_manu_product_list ="<html><head>";
	$export_html_manu_product_list .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_html_manu_product_list .="</head>";
	$export_html_manu_product_list .="<body>";
	$export_html_manu_product_list .="<style type='text/css'>
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
	
	.list_detail {
		border-collapse: collapse;
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;
		font-family: Arial, Helvetica, sans-serif;	
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.list_detail td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;
	}
	.list_detail thead td {
		background-color: #F0F0F0;
		padding: 0px 3px;
		font-size: 11px;
		font-weight: bold;	
	}
	.list_detail tbody td {
		padding: 0px 3px;
		font-size: 11px;	
	}
	.list_detail .left {
		text-align: left;
		padding: 3px;
	}
	.list_detail .right {
		text-align: right;
		padding: 3px;
	}
	.list_detail .center {
		text-align: center;
		padding: 3px;
	}	
	</style>";
	$export_html_manu_product_list .="<table class='list_main'>";
	foreach ($results as $result) {		
	$export_html_manu_product_list .="<thead>";
	$export_html_manu_product_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_html_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_year')."</td>";
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_html_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_prod_order_id')."</td>";
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_prod_date_added')."</td>";
	} else {
	$export_html_manu_product_list .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_start')."</td>";
	$export_html_manu_product_list .= "<td align='left' width='80' nowrap='nowrap'>".$this->language->get('column_date_end')."</td>";	
	}
	isset($_POST['pp25']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp27']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';				
	$export_html_manu_product_list .="</tr>";
	$export_html_manu_product_list .="</thead><tbody>";
			
	$this->load->model('catalog/product');
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
	
	$export_html_manu_product_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_html_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_html_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} else {
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_html_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	isset($_POST['pp25']) ? $export_html_manu_product_list .= "<td align='left' style='color:#03C;'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_html_manu_product_list .= "<strong>".$manufacturer['name']."</strong>" : '';
			}
		}
	isset($_POST['pp25']) ? $export_html_manu_product_list .= "</td>" : '';	
	isset($_POST['pp27']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';
	$export_html_manu_product_list .="</tr>";
	$export_html_manu_product_list .="<tr>";
	$count = isset($_POST['pp25'])+isset($_POST['pp27'])+isset($_POST['pp28'])+isset($_POST['pp30'])+isset($_POST['pp29'])+2;
	$export_html_manu_product_list .= "<td colspan='";
	$export_html_manu_product_list .= $count;
	$export_html_manu_product_list .="' align='center'>";
		$export_html_manu_product_list .="<table class='list_detail'>";
		$export_html_manu_product_list .="<thead>";
		$export_html_manu_product_list .="<tr>";
		isset($_POST['pp60']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_order_id')."</td>" : '';
		isset($_POST['pp61']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_date_added')."</td>" : '';
		isset($_POST['pp62']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_inv_no')."</td>" : '';
		isset($_POST['pp63']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_id')."</td>" : '';
		isset($_POST['pp64']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_sku')."</td>" : '';
		isset($_POST['pp65']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_model')."</td>" : '';
		isset($_POST['pp66']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_name')."</td>" : '';
		isset($_POST['pp67']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_option')."</td>" : '';
		isset($_POST['pp77']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_attributes')."</td>" : '';
		isset($_POST['pp79']) ? $export_html_manu_product_list .= "<td align='left'>".$this->language->get('column_prod_category')."</td>" : '';
		isset($_POST['pp69']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_prod_currency')."</td>" : '';
		isset($_POST['pp70']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_prod_price')."</td>" : '';
		isset($_POST['pp71']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_prod_quantity')."</td>" : '';
		isset($_POST['pp73']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_prod_tax')."</td>" : '';
		isset($_POST['pp72']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_prod_total')."</td>" : '';
		$export_html_manu_product_list .="</tr>";
		$export_html_manu_product_list .="</thead><tbody>";
		$export_html_manu_product_list .="<tr>";
		isset($_POST['pp60']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_ord_idc']."</td>" : '';
		isset($_POST['pp61']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_order_date']."</td>" : '';
		isset($_POST['pp62']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_inv_no']."</td>" : '';
		isset($_POST['pp63']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_pidc']."</td>" : '';
		isset($_POST['pp64']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_sku']."</td>" : '';
		isset($_POST['pp65']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_model']."</td>" : '';
		isset($_POST['pp66']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_name']."</td>" : '';
		isset($_POST['pp67']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_option']."</td>" : '';
		isset($_POST['pp77']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_attributes']."</td>" : '';
		isset($_POST['pp79']) ? $export_html_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_category']."</td>" : '';
		isset($_POST['pp69']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_currency']."</td>" : '';
		isset($_POST['pp70']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_price']."</td>" : '';
		isset($_POST['pp71']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_quantity']."</td>" : '';
		isset($_POST['pp73']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_tax']."</td>" : '';
		isset($_POST['pp72']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_total']."</td>" : '';
		$export_html_manu_product_list .="</tr>";					
		$export_html_manu_product_list .="</tbody></table>";
	$export_html_manu_product_list .="</td>";
	$export_html_manu_product_list .="</tr>";
	}
	$export_html_manu_product_list .="</tbody>";
	$export_html_manu_product_list .="<thead><tr>";	
	$export_html_manu_product_list .= "<td colspan='2'></td>";
	isset($_POST['pp25']) ? $export_html_manu_product_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_html_manu_product_list .= "<td align='right'>".$this->language->get('column_total')."</td>" : '';
	$export_html_manu_product_list .="</tr></thead>";
	$export_html_manu_product_list .="<tbody><tr>";	
	$export_html_manu_product_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF;'><strong>".$this->language->get('text_filter_total')."</strong></td>";
	isset($_POST['pp25']) ? $export_html_manu_product_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_html_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	$export_html_manu_product_list .="</tr></tbody></table>";
	$export_html_manu_product_list .="</body></html>";

$filename = "manufacturer_purchased_report_product_list_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Disposition: attachment; filename='.$filename.".html");
print $export_html_manu_product_list;			
exit;			
?>