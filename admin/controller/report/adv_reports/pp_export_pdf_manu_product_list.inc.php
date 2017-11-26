<?php
ini_set("memory_limit","256M");

	$export_pdf_manu_product_list = "<html><head>";			
	$export_pdf_manu_product_list .= "</head>";
	$export_pdf_manu_product_list .= "<body>";
	$export_pdf_manu_product_list .= "<style type='text/css'>
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

	.list_detail {
		border-collapse: collapse;		
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;
		font-family: Helvetica;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.list_detail td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;
	}
	.list_detail tbody td {
		padding: 0px 3px;
		font-size: 9px;	
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
	$export_pdf_manu_product_list .= "<table class='list_main'>";
	foreach ($results as $result) {
	$export_pdf_manu_product_list .= "<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_pdf_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_order_id')."</td>";
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_date_added')."</td>";	
	} else {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_start')."</td>";
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_end')."</td>";	
	}
	isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';	
	$export_pdf_manu_product_list .= "</tr>";
	$export_pdf_manu_product_list .= "<tbody>";
			
	$this->load->model('catalog/product');
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
			
	$export_pdf_manu_product_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_pdf_manu_product_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";		
	} else {
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}
	isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "<td align='left' style='color:#03C;'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "<strong>".$manufacturer['name']."</strong>" : '';
			}
		}
	isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';	
	$export_pdf_manu_product_list .= "</tr>";	
	$export_pdf_manu_product_list .= "<tr>";
	$count = isset($_POST['pp25'])+isset($_POST['pp27'])+isset($_POST['pp28'])+isset($_POST['pp30'])+isset($_POST['pp29'])+2;
	$export_pdf_manu_product_list .= "<td colspan='";
	$export_pdf_manu_product_list .= $count;
	$export_pdf_manu_product_list .="' align='center'>";
		$export_pdf_manu_product_list .= "<table class='list_detail'>";
		$export_pdf_manu_product_list .= "<tr>";
		isset($_POST['pp60']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_order_id')."</td>" : '';
		isset($_POST['pp61']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_date_added')."</td>" : '';
		isset($_POST['pp62']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_inv_no')."</td>" : '';
		isset($_POST['pp63']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_id')."</td>" : '';
		isset($_POST['pp64']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_sku')."</td>" : '';
		isset($_POST['pp65']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_model')."</td>" : '';
		isset($_POST['pp66']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_name')."</td>" : '';
		isset($_POST['pp67']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_option')."</td>" : '';
		isset($_POST['pp77']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_attributes')."</td>" : '';
		isset($_POST['pp79']) ? $export_pdf_manu_product_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_category')."</td>" : '';
		isset($_POST['pp69']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_currency')."</td>" : '';
		isset($_POST['pp70']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_price')."</td>" : '';
		isset($_POST['pp71']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_quantity')."</td>" : '';
		isset($_POST['pp73']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_tax')."</td>" : '';
		isset($_POST['pp72']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_prod_total')."</td>" : '';		
		$export_pdf_manu_product_list .="</tr>";
		$export_pdf_manu_product_list .="<tbody>";
		$export_pdf_manu_product_list .="<tr>";
		isset($_POST['pp60']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_ord_idc']."</td>" : '';
		isset($_POST['pp61']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_order_date']."</td>" : '';
		isset($_POST['pp62']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_inv_no']."</td>" : '';
		isset($_POST['pp63']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_pidc']."</td>" : '';
		isset($_POST['pp64']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_sku']."</td>" : '';
		isset($_POST['pp65']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_model']."</td>" : '';
		isset($_POST['pp66']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_name']."</td>" : '';
		isset($_POST['pp67']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_option']."</td>" : '';
		isset($_POST['pp77']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_attributes']."</td>" : '';
		isset($_POST['pp79']) ? $export_pdf_manu_product_list .= "<td align='left' nowrap='nowrap'>".$result['product_category']."</td>" : '';
		isset($_POST['pp69']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_currency']."</td>" : '';
		isset($_POST['pp70']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_price']."</td>" : '';
		isset($_POST['pp71']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_quantity']."</td>" : '';
		isset($_POST['pp73']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_tax']."</td>" : '';
		isset($_POST['pp72']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap'>".$result['product_total']."</td>" : '';				
		$export_pdf_manu_product_list .= "</tr>";					
		$export_pdf_manu_product_list .= "</tbody></table>";
	$export_pdf_manu_product_list .="</td>";
	$export_pdf_manu_product_list .="</tr>";
	}	
	$export_pdf_manu_product_list .="</tbody>";
	$export_pdf_manu_product_list .="<tr>";	
	$export_pdf_manu_product_list .= "<td colspan='2' style='background-color:#E5E5E5;'></td>";
	isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_manu_product_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';
	$export_pdf_manu_product_list .="</tr>";
	$export_pdf_manu_product_list .="<tbody><tr>";	
	$export_pdf_manu_product_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF;'><strong>".$this->language->get('text_filter_total')."</strong></td>";
	isset($_POST['pp25']) ? $export_pdf_manu_product_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_manu_product_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	$export_pdf_manu_product_list .="</tr></tbody></table>";
	$export_pdf_manu_product_list .="</body></html>";

ini_set('mbstring.substitute_character', "none"); 
$dompdf_pdf_manu_product_list = mb_convert_encoding($export_pdf_manu_product_list, 'ISO-8859-1', 'UTF-8'); 
$dompdf = new DOMPDF();
$dompdf->load_html($dompdf_pdf_manu_product_list);
$dompdf->set_paper("a3", "landscape");
$dompdf->render();
$dompdf->stream("manufacturer_purchased_report_product_list_".date("Y-m-d",time()).".pdf");
?>