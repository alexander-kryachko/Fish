<?php
ini_set("memory_limit","256M");
			
	$export_xls_prod_customer_list ="<html><head>";
	$export_xls_prod_customer_list .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_xls_prod_customer_list .="</head>";
	$export_xls_prod_customer_list .="<body>";					
	$export_xls_prod_customer_list .="<table border='1'>";
	foreach ($results as $result) {		
	$export_xls_prod_customer_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_xls_prod_customer_list .= "<td colspan='2' align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";					
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_year')."</td>";					
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_xls_prod_customer_list .= "<td colspan='2' align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_order_prod_order_id')."</td>";					
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_order_prod_date_added')."</td>";	
	} else {
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date_start')."</td>";				
	$export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_date_end')."</td>";
	}
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_name')."</td>" : '';
	isset($_POST['pp21']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sku')."</td>" : '';		
	isset($_POST['pp23']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_model')."</td>" : '';
	isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_category')."</td>" : '';
	isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp34']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_attribute')."</td>" : '';
	isset($_POST['pp26']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_status')."</td>" : '';
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_stock_quantity')."</td>" : '';
	isset($_POST['pp27']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';
	$export_xls_prod_customer_list .="</tr>";

	$this->load->model('catalog/product');
	$cat =  $this->model_catalog_product->getProductCategories($result['product_id']);
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
	$categories = $this->model_report_adv_product_purchased->getProductsCategories(0); 
		
	$export_xls_prod_customer_list .="<tr>";
	if ($filter_group == 'year') {				
	$export_xls_prod_customer_list .= "<td colspan='2' align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".'Q' . $result['quarter']."</td>";					
	} elseif ($filter_group == 'month') {
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['year']."</td>";
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['month']."</td>";
	} elseif ($filter_group == 'day') {
	$export_xls_prod_customer_list .= "<td colspan='2' align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".$result['order_id']."</td>";	
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";	
	} else {
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_xls_prod_customer_list .= "<td align='left' valign='top' style='background-color:#F0F0F0; mso-ignore: colspan'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";	
	}
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='color:#03C; font-weight:bold; mso-ignore: colspan'>".$result['name']."" : '';	
	if ($filter_ogrouping) {
	if ($result['oovalue']) {			
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<table border='0' cellpadding='0' cellspacing='0'><tr>" : '';
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td style='color:#03C;'>".$result['ooname'].":</td>" : '';
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td style='color:#03C;'>".$result['oovalue']."</td>" : '';
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "</tr></table>" : '';
	}
	}		
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "</td>" : '';
	isset($_POST['pp21']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>".$result['sku']."</td>" : '';
	isset($_POST['pp23']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>".$result['model']."</td>" : '';
	isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>" : '';
		foreach ($categories as $category) {
			if (in_array($category['category_id'], $cat)) {
			isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "".$category['name']."<br>" : '';
			}
		}
	isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "</td>" : '';
	isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "".$manufacturer['name']."" : '';
			}
		}
	isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "</td>" : '';
	isset($_POST['pp34']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>".$result['attribute']."</td>" : '';
	isset($_POST['pp26']) ? $export_xls_prod_customer_list .= "<td align='left' valign='top' style='mso-ignore: colspan'>".($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'))."</td>" : '';
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='mso-ignore: colspan'>" : '';	
	if ($result['stock_quantity'] <= 0) {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<span style='color:#FF0000;'>".$result['stock_quantity']."</span>" : '';
	} elseif ($result['stock_quantity'] <= 5) {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<span style='color:#FFA500;'>".$result['stock_quantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<span>".$result['stock_quantity']."</span>" : '';
	}
	if ($filter_ogrouping) {	
	if ($result['oovalue']) {	
	if ($result['stock_oquantity'] <= 0) {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<br><span style='color:#FF0000;'>".$result['stock_oquantity']."</span>" : '';
	} elseif ($result['stock_oquantity'] <= 5) {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<br><span style='color:#FFA500;'>".$result['stock_oquantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<br><span>".$result['stock_oquantity']."</span>" : '';
	}
	}
	}	
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "</td>" : '';
	isset($_POST['pp27']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='background-color:#FFC; mso-ignore: colspan'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['tax']."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_prod_customer_list .= "<td align='right' valign='top' style='mso-ignore: colspan; mso-number-format:#\,\#\#0\.00'>".$result['total']."</td>" : '';
	$export_xls_prod_customer_list .="</tr>";
	$export_xls_prod_customer_list .="<tr>";
	$export_xls_prod_customer_list .= "<td colspan='2' style='mso-ignore: colspan'></td>";
	$count = isset($_POST['pp21'])+isset($_POST['pp22'])+isset($_POST['pp23'])+isset($_POST['pp24'])+isset($_POST['pp25'])+isset($_POST['pp34'])+isset($_POST['pp26'])+isset($_POST['pp35'])+isset($_POST['pp27'])+isset($_POST['pp28'])+isset($_POST['pp30'])+isset($_POST['pp29']);
	$export_xls_prod_customer_list .= "<td colspan='";
	$export_xls_prod_customer_list .= $count;
	$export_xls_prod_customer_list .="' align='center'>";					
		$export_xls_prod_customer_list .="<table border='1'>";
		$export_xls_prod_customer_list .="<tr>";
		isset($_POST['pp80']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_customer_order_id')."</td>" : '';
		isset($_POST['pp81']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_customer_date_added')."</td>" : '';
		isset($_POST['pp82']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_customer_inv_no')."</td>" : '';
		isset($_POST['pp83']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_customer_cust_id')."</td>" : '';
		isset($_POST['pp84']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_name'))."</td>" : '';
		isset($_POST['pp85']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_company'))."</td>" : '';	
		isset($_POST['pp86']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_address_1'))."</td>" : '';
		isset($_POST['pp87']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_address_2'))."</td>" : '';
		isset($_POST['pp88']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_city'))."</td>" : '';
		isset($_POST['pp89']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_zone'))."</td>" : '';
		isset($_POST['pp90']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_postcode'))."</td>" : '';
		isset($_POST['pp91']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_billing_country'))."</td>" : '';
		isset($_POST['pp92']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".$this->language->get('column_customer_telephone')."</td>" : '';
		isset($_POST['pp93']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_name'))."</td>" : '';
		isset($_POST['pp94']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_company'))."</td>" : '';
		isset($_POST['pp95']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_address_1'))."</td>" : '';
		isset($_POST['pp96']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_address_2'))."</td>" : '';
		isset($_POST['pp97']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_city'))."</td>" : '';
		isset($_POST['pp98']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_zone'))."</td>" : '';
		isset($_POST['pp99']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_postcode'))."</td>" : '';
		isset($_POST['pp100']) ? $export_xls_prod_customer_list .= "<td align='left' style='background-color:#EFEFEF; font-weight:bold;'>".strip_tags($this->language->get('column_shipping_country'))."</td>" : '';
		$export_xls_prod_customer_list .="</tr>";
		$export_xls_prod_customer_list .="<tr>";
		isset($_POST['pp80']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['customer_ord_idc']."</td>" : '';
		isset($_POST['pp81']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['customer_order_date']."</td>" : '';
		isset($_POST['pp82']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['customer_inv_no']."</td>" : '';
		isset($_POST['pp83']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['customer_cust_idc']."</td>" : '';
		isset($_POST['pp84']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_name']."</td>" : '';
		isset($_POST['pp85']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_company']."</td>" : '';
		isset($_POST['pp86']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_address_1']."</td>" : '';
		isset($_POST['pp87']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_address_2']."</td>" : '';
		isset($_POST['pp88']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_city']."</td>" : '';
		isset($_POST['pp89']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_zone']."</td>" : '';
		isset($_POST['pp90']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_postcode']."</td>" : '';
		isset($_POST['pp91']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['billing_country']."</td>" : '';
		isset($_POST['pp92']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['customer_telephone']."</td>" : '';
		isset($_POST['pp93']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_name']."</td>" : '';
		isset($_POST['pp94']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_company']."</td>" : '';
		isset($_POST['pp95']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_address_1']."</td>" : '';
		isset($_POST['pp96']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_address_2']."</td>" : '';
		isset($_POST['pp97']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_city']."</td>" : '';
		isset($_POST['pp98']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_zone']."</td>" : '';
		isset($_POST['pp99']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_postcode']."</td>" : '';
		isset($_POST['pp100']) ? $export_xls_prod_customer_list .= "<td align='left' style='mso-ignore: colspan'>".$result['shipping_country']."</td>" : '';
		$export_xls_prod_customer_list .="</tr>";					
		$export_xls_prod_customer_list .="</table>";
	$export_xls_prod_customer_list .="</td>";
	$export_xls_prod_customer_list .="</tr>";					
	}
	$export_xls_prod_customer_list .="<tr>";
	$export_xls_prod_customer_list .= "<td colspan='2' style='background-color:#D8D8D8;'></td>";
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp21']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';		
	isset($_POST['pp23']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp34']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp26']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp27']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#D8D8D8; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';			
	$export_xls_prod_customer_list .="</tr>";	
	$export_xls_prod_customer_list .="<tr>";
	$export_xls_prod_customer_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF; font-weight:bold;'>".$this->language->get('text_filter_total')."</td>";
	isset($_POST['pp21']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';	
	isset($_POST['pp22']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp23']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp24']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp25']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp34']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp26']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp35']) ? $export_xls_prod_customer_list .= "<td style='background-color:#CCCCCC;'></td>" : '';
	isset($_POST['pp27']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold; mso-number-format:#\,\#\#0\.00'>".$result['tax_total']."</td>" : '';
	isset($_POST['pp29']) ? $export_xls_prod_customer_list .= "<td align='right' style='background-color:#E7EFEF; color:#003A88; font-weight:bold; mso-number-format:#\,\#\#0\.00'>".$result['total_total']."</td>" : '';
	$export_xls_prod_customer_list .="</tr></table>";	
	$export_xls_prod_customer_list .="</body></html>";

$filename = "product_purchased_report_customer_list_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Type: application/vnd.ms-excel; charset=UTF-8; encoding=UTF-8');			
header('Content-Disposition: attachment; filename='.$filename.".xls");
header('Content-Transfer-Encoding: UTF-8');
print $export_xls_prod_customer_list;			
exit;
?>