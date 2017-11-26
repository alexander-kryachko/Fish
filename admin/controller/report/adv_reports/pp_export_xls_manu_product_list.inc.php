<?php
ini_set("memory_limit","256M");
			
	$export_xls_manu_product_list ="<html><head>";
	$export_xls_manu_product_list .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_xls_manu_product_list .="</head>";
	$export_xls_manu_product_list .="<body>";					
	$export_xls_manu_product_list .="<table border='1'>";
	foreach ($results as $result) {		
	$export_xls_manu_product_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_xls_manu_product_list .= "<td colspan='2' align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";					
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";					
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_xls_manu_product_list .= "<td colspan='2' align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_order_prod_order_id')."</td>";					
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_order_prod_date_added')."</td>";	
	} else {
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date_start')."</td>";				
	$export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date_end')."</td>";
	}
	isset($_POST['pp25']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp27']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';
	$export_xls_manu_product_list .="</tr>";

	$this->load->model('catalog/product');
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
		
	$export_xls_manu_product_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_xls_manu_product_list .= "<td colspan='2' align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".'Q' . $result['quarter']."</td>";					
	} elseif ($filter_group == 'month') {
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['month']."</td>";
	} elseif ($filter_group == 'day') {
	$export_xls_manu_product_list .= "<td colspan='2' align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['order_id']."</td>";	
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";	
	} else {
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_xls_manu_product_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";	
	}
	isset($_POST['pp25']) ? $export_xls_manu_product_list .= "<td align='left' valign='top' style='color:#03C; mso-ignore: colspan'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_xls_manu_product_list .= "<strong>".$manufacturer['name']."</strong>" : '';
			}
		}
	isset($_POST['pp25']) ? $export_xls_manu_product_list .= "</td>" : '';
	isset($_POST['pp27']) ? $export_xls_manu_product_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_xls_manu_product_list .= "<td align='right' valign='top' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['tax']."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_manu_product_list .= "<td align='right' valign='top' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['total']."</td>" : '';
	$export_xls_manu_product_list .="</tr>";
	$export_xls_manu_product_list .="<tr>";
	$export_xls_manu_product_list .= "<td colspan='2' style='mso-ignore: colspan'></td>";
	$count = isset($_POST['pp25'])+isset($_POST['pp27'])+isset($_POST['pp28'])+isset($_POST['pp30'])+isset($_POST['pp29']);
	$export_xls_manu_product_list .= "<td colspan='";
	$export_xls_manu_product_list .= $count;
	$export_xls_manu_product_list .="' align='center'>";					
		$export_xls_manu_product_list .="<table border='1'>";
		$export_xls_manu_product_list .="<tr>";
		isset($_POST['pp60']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_order_id')."</td>" : '';
		isset($_POST['pp61']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_date_added')."</td>" : '';
		isset($_POST['pp62']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_inv_no')."</td>" : '';
		isset($_POST['pp63']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_id')."</td>" : '';
		isset($_POST['pp64']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_sku')."</td>" : '';
		isset($_POST['pp65']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_model')."</td>" : '';
		isset($_POST['pp66']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_name')."</td>" : '';
		isset($_POST['pp67']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_option')."</td>" : '';
		isset($_POST['pp77']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_attributes')."</td>" : '';
		isset($_POST['pp79']) ? $export_xls_manu_product_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_category')."</td>" : '';
		isset($_POST['pp69']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_currency')."</td>" : '';
		isset($_POST['pp70']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_price')."</td>" : '';
		isset($_POST['pp71']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_quantity')."</td>" : '';
		isset($_POST['pp73']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_tax')."</td>" : '';
		isset($_POST['pp72']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_prod_total')."</td>" : '';
		$export_xls_manu_product_list .="</tr>";
		$export_xls_manu_product_list .="<tr>";
		isset($_POST['pp60']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_ord_idc']."</td>" : '';
		isset($_POST['pp61']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_order_date']."</td>" : '';
		isset($_POST['pp62']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_inv_no']."</td>" : '';
		isset($_POST['pp63']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_pidc']."</td>" : '';
		isset($_POST['pp64']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_sku']."</td>" : '';
		isset($_POST['pp65']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_model']."</td>" : '';
		isset($_POST['pp66']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_name']."</td>" : '';
		isset($_POST['pp67']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_option']."</td>" : '';
		isset($_POST['pp77']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_attributes']."</td>" : '';
		isset($_POST['pp79']) ? $export_xls_manu_product_list .= "<td align='left' style='mso-ignore: colspan'>".$result['product_category']."</td>" : '';
		isset($_POST['pp69']) ? $export_xls_manu_product_list .= "<td align='right' style='mso-ignore: colspan'>".$result['product_currency']."</td>" : '';
		isset($_POST['pp70']) ? $export_xls_manu_product_list .= "<td align='right' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['product_price']."</td>" : '';
		isset($_POST['pp71']) ? $export_xls_manu_product_list .= "<td align='right' style='mso-ignore: colspan'>".$result['product_quantity']."</td>" : '';
		isset($_POST['pp73']) ? $export_xls_manu_product_list .= "<td align='right' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['product_tax']."</td>" : '';
		isset($_POST['pp72']) ? $export_xls_manu_product_list .= "<td align='right' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['product_total']."</td>" : '';
		$export_xls_manu_product_list .="</tr>";					
		$export_xls_manu_product_list .="</table>";
	$export_xls_manu_product_list .="</td>";
	$export_xls_manu_product_list .="</tr>";					
	}
	$export_xls_manu_product_list .="<tr>";
	$export_xls_manu_product_list .= "<td colspan='2' style='background-color:#D8D8D8;'></td>";
	isset($_POST['pp25']) ? $export_xls_manu_product_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp27']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';				
	$export_xls_manu_product_list .="</tr>";	
	$export_xls_manu_product_list .="<tr>";
	$export_xls_manu_product_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF; font-weight:bold;'>".$this->language->get('text_filter_total')."</td>";
	isset($_POST['pp25']) ? $export_xls_manu_product_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp27']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold; mso-number-format:#\,\#\#0\.00'>".$result['tax_total']."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_manu_product_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold; mso-number-format:#\,\#\#0\.00'>".$result['total_total']."</td>" : '';
	$export_xls_manu_product_list .="</tr></table>";	
	$export_xls_manu_product_list .="</body></html>";

$filename = "manufacturer_purchased_report_product_list_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Type: application/vnd.ms-excel; charset=UTF-8; encoding=UTF-8');			
header('Content-Disposition: attachment; filename='.$filename.".xls");
header('Content-Transfer-Encoding: UTF-8');
print $export_xls_manu_product_list;			
exit;
?>