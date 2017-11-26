<?php
ini_set("memory_limit","256M");

	$export_pdf_prod_customer_list = "<html><head>";			
	$export_pdf_prod_customer_list .= "</head>";
	$export_pdf_prod_customer_list .= "<body>";
	$export_pdf_prod_customer_list .= "<style type='text/css'>
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
	$export_pdf_prod_customer_list .= "<table class='list_main'>";
	foreach ($results as $result) {
	$export_pdf_prod_customer_list .= "<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_prod_customer_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_quarter')."</td>";				
	} elseif ($filter_group == 'month') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_year')."</td>";
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_month')."</td>";
	} elseif ($filter_group == 'day') {
	$export_pdf_prod_customer_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date')."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_order_id')."</td>";
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_order_prod_date_added')."</td>";	
	} else {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_start')."</td>";
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_date_end')."</td>";	
	}
	isset($_POST['pp21']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sku')."</td>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_name')."</td>" : '';
	isset($_POST['pp23']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_model')."</td>" : '';
	isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_category')."</td>" : '';
	isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_manufacturer')."</td>" : '';
	isset($_POST['pp34']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_attribute')."</td>" : '';
	isset($_POST['pp26']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_status')."</td>" : '';
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_stock_quantity')."</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';
	$export_pdf_prod_customer_list .= "</tr>";
	$export_pdf_prod_customer_list .= "<tbody>";
	
	$this->load->model('catalog/product');
	$cat =  $this->model_catalog_product->getProductCategories($result['product_id']);
	$manu = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	
	$manufacturers = $this->model_report_adv_product_purchased->getProductsManufacturers();
	$categories = $this->model_report_adv_product_purchased->getProductsCategories(0); 
			
	$export_pdf_prod_customer_list .= "<tr>";
	if ($filter_group == 'year') {				
	$export_pdf_prod_customer_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";
	} elseif ($filter_group == 'quarter') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".'Q' . $result['quarter']."</td>";						
	} elseif ($filter_group == 'month') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['year']."</td>";	
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['month']."</td>";	
	} elseif ($filter_group == 'day') {
	$export_pdf_prod_customer_list .= "<td colspan='2' align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	} elseif ($filter_group == 'order') {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".$result['order_id']."</td>";	
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";		
	} else {
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_start']))."</td>";
	$export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap' style='background-color:#F0F0F0;'>".date($this->language->get('date_format_short'), strtotime($result['date_end']))."</td>";
	}	
	isset($_POST['pp21']) ? $export_pdf_prod_customer_list .= "<td align='left'>".$result['sku']."</td>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td align='left' style='color:#03C;'><strong>".$result['name']."</strong>" : '';
	if ($filter_ogrouping) {
	if ($result['oovalue']) {
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<table cellpadding='0' cellspacing='0' border='0' style='border:none;'><tr>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td style='font-family: Helvetica; font-size:9px; color:#03C; border:none;' nowrap='nowrap'>".$result['ooname'].":</td>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td style='font-family: Helvetica; font-size:9px; color:#03C; border:none;' nowrap='nowrap'>".$result['oovalue']."</td>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "</tr></table>" : '';
	}
	}		
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "</td>" : '';
	isset($_POST['pp23']) ? $export_pdf_prod_customer_list .= "<td align='left'>".$result['model']."</td>" : '';
	isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "<td align='left'>" : '';
		foreach ($categories as $category) {
			if (in_array($category['category_id'], $cat)) {
			isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "".$category['name']."<br>" : '';
			}
		}
	isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "</td>" : '';
	isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "<td align='left'>" : '';
		foreach ($manufacturers as $manufacturer) {
			if (in_array($manufacturer['manufacturer_id'], $manu)) {
			isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "".$manufacturer['name']."" : '';
			}
		}
	isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "</td>" : '';
	isset($_POST['pp34']) ? $export_pdf_prod_customer_list .= "<td align='left'>".$result['attribute']."</td>" : '';
	isset($_POST['pp26']) ? $export_pdf_prod_customer_list .= "<td align='left'>".($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'))."</td>" : '';
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap'>" : '';	
	if ($result['stock_quantity'] <= 0) {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<span style='color:#FF0000;'>".$result['stock_quantity']."</span>" : '';
	} elseif ($result['stock_quantity'] <= 5) {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<span style='color:#FFA500;'>".$result['stock_quantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<span>".$result['stock_quantity']."</span>" : '';
	}
	if ($filter_ogrouping) {	
	if ($result['oovalue']) {	
	if ($result['stock_oquantity'] <= 0) {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<br><span style='color:#FF0000; font-size:9px;'>".$result['stock_oquantity']."</span>" : '';
	} elseif ($result['stock_oquantity'] <= 5) {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<br><span style='color:#FFA500; font-size:9px;'>".$result['stock_oquantity']."</span>" : '';
	} else {
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<br><span style='font-size:9px;'>".$result['stock_oquantity']."</span>" : '';
	}
	}
	}	
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "</td>" : '';
	isset($_POST['pp27']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".$result['sold_quantity']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#FFC;'>".'0%'."</td>" : '';
	}										
	isset($_POST['pp30']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['tax'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap'>".$this->currency->format($result['total'], $this->config->get('config_currency'))."</td>" : '';						
	$export_pdf_prod_customer_list .= "</tr>";	
	$export_pdf_prod_customer_list .= "<tr>";
	$count = isset($_POST['pp21'])+isset($_POST['pp22'])+isset($_POST['pp23'])+isset($_POST['pp24'])+isset($_POST['pp25'])+isset($_POST['pp34'])+isset($_POST['pp26'])+isset($_POST['pp35'])+isset($_POST['pp27'])+isset($_POST['pp28'])+isset($_POST['pp30'])+isset($_POST['pp29'])+2;
	$export_pdf_prod_customer_list .= "<td colspan='";
	$export_pdf_prod_customer_list .= $count;
	$export_pdf_prod_customer_list .="' align='center'>";
		$export_pdf_prod_customer_list .= "<table class='list_detail'>";
		$export_pdf_prod_customer_list .= "<tr>";
		isset($_POST['pp80']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_customer_order_id')."</td>" : '';
		isset($_POST['pp81']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_customer_date_added')."</td>" : '';
		isset($_POST['pp82']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_customer_inv_no')."</td>" : '';
		isset($_POST['pp83']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_customer_cust_id')."</td>" : '';
		isset($_POST['pp84']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_name')."</td>" : '';
		isset($_POST['pp85']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_company')."</td>" : '';	
		isset($_POST['pp86']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_address_1')."</td>" : '';
		isset($_POST['pp87']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_address_2')."</td>" : '';
		isset($_POST['pp88']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_city')."</td>" : '';
		isset($_POST['pp89']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_zone')."</td>" : '';
		isset($_POST['pp90']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_postcode')."</td>" : '';
		isset($_POST['pp91']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_billing_country')."</td>" : '';
		isset($_POST['pp92']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_customer_telephone')."</td>" : '';
		isset($_POST['pp93']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_name')."</td>" : '';
		isset($_POST['pp94']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_company')."</td>" : '';
		isset($_POST['pp95']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_address_1')."</td>" : '';
		isset($_POST['pp96']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_address_2')."</td>" : '';
		isset($_POST['pp97']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_city')."</td>" : '';
		isset($_POST['pp98']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_zone')."</td>" : '';
		isset($_POST['pp99']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_postcode')."</td>" : '';
		isset($_POST['pp100']) ? $export_pdf_prod_customer_list .= "<td align='left' style='background-color:#F0F0F0; padding:0px 3px; font-size:9px; font-weight: bold;'>".$this->language->get('column_shipping_country')."</td>" : '';
		$export_pdf_prod_customer_list .="</tr>";
		$export_pdf_prod_customer_list .="<tbody>";
		$export_pdf_prod_customer_list .="<tr>";
		isset($_POST['pp80']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['customer_ord_idc']."</td>" : '';
		isset($_POST['pp81']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['customer_order_date']."</td>" : '';
		isset($_POST['pp82']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['customer_inv_no']."</td>" : '';
		isset($_POST['pp83']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['customer_cust_idc']."</td>" : '';
		isset($_POST['pp84']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_name']."</td>" : '';
		isset($_POST['pp85']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_company']."</td>" : '';
		isset($_POST['pp86']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_address_1']."</td>" : '';
		isset($_POST['pp87']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_address_2']."</td>" : '';
		isset($_POST['pp88']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_city']."</td>" : '';
		isset($_POST['pp89']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_zone']."</td>" : '';
		isset($_POST['pp90']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_postcode']."</td>" : '';
		isset($_POST['pp91']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['billing_country']."</td>" : '';
		isset($_POST['pp92']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['customer_telephone']."</td>" : '';
		isset($_POST['pp93']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_name']."</td>" : '';
		isset($_POST['pp94']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_company']."</td>" : '';
		isset($_POST['pp95']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_address_1']."</td>" : '';
		isset($_POST['pp96']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_address_2']."</td>" : '';
		isset($_POST['pp97']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_city']."</td>" : '';
		isset($_POST['pp98']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_zone']."</td>" : '';
		isset($_POST['pp99']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_postcode']."</td>" : '';
		isset($_POST['pp100']) ? $export_pdf_prod_customer_list .= "<td align='left' nowrap='nowrap'>".$result['shipping_country']."</td>" : '';			
		$export_pdf_prod_customer_list .= "</tr>";					
		$export_pdf_prod_customer_list .= "</tbody></table>";
	$export_pdf_prod_customer_list .="</td>";
	$export_pdf_prod_customer_list .="</tr>";
	}	
	$export_pdf_prod_customer_list .="</tbody>";
	$export_pdf_prod_customer_list .="<tr>";	
	$export_pdf_prod_customer_list .= "<td colspan='2' style='background-color:#E5E5E5;'></td>";
	isset($_POST['pp21']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';		
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';	
	isset($_POST['pp23']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp34']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp26']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_quantity')."</td>" : '';
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_sold_percent')."</td>" : '';
	isset($_POST['pp30']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_tax')."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_prod_customer_list .= "<td align='right' style='background-color:#E5E5E5; padding:3px; font-weight:bold;'>".$this->language->get('column_total')."</td>" : '';
	$export_pdf_prod_customer_list .="</tr>";
	$export_pdf_prod_customer_list .="<tbody><tr>";	
	$export_pdf_prod_customer_list .= "<td colspan='2' align='right' style='background-color:#E7EFEF;'><strong>".$this->language->get('text_filter_total')."</strong></td>";
	isset($_POST['pp21']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp22']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';	
	isset($_POST['pp23']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp24']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp25']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp34']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp26']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp35']) ? $export_pdf_prod_customer_list .= "<td style='background-color:#DDDDDD;'></td>" : '';
	isset($_POST['pp27']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$result['sold_quantity_total']."</td>" : '';
	if (!is_null($result['sold_quantity'])) {
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'100%'."</td>" : '';
	} else {
	isset($_POST['pp28']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".'0%'."</td>" : '';
	}	
	isset($_POST['pp30']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['tax_total'], $this->config->get('config_currency'))."</td>" : '';
	isset($_POST['pp29']) ? $export_pdf_prod_customer_list .= "<td align='right' nowrap='nowrap' style='background-color:#E7EFEF; color:#003A88; font-weight:bold;'>".$this->currency->format($result['total_total'], $this->config->get('config_currency'))."</td>" : '';
	$export_pdf_prod_customer_list .="</tr></tbody></table>";
	$export_pdf_prod_customer_list .="</body></html>";

ini_set('mbstring.substitute_character', "none"); 
$dompdf_pdf_prod_customer_list = mb_convert_encoding($export_pdf_prod_customer_list, 'ISO-8859-1', 'UTF-8'); 
$dompdf = new DOMPDF();
$dompdf->load_html($dompdf_pdf_prod_customer_list);
$dompdf->set_paper("a3", "landscape");
$dompdf->render();
$dompdf->stream("product_purchased_report_customer_list_".date("Y-m-d",time()).".pdf");
?>