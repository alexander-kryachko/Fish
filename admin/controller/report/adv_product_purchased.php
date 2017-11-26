<?php
class ControllerReportAdvProductPurchased extends Controller { 
	public function index() {  
		$this->load->language('report/adv_product_purchased');

		if (!$this->IsInstalled()) {		
			$this->session->data['error'] = $this->language->get('error_installed');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));		
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('report/adv_product_purchased');
		
		if (isset($this->request->post['filter_date_start'])) {
			$filter_date_start = $this->request->post['filter_date_start'];
		} else {
			$filter_date_start = '';
		}

		if (isset($this->request->post['filter_date_end'])) {
			$filter_date_end = $this->request->post['filter_date_end'];
		} else {
			$filter_date_end = '';
		}

		$this->data['ranges'] = array();
		
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);			
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);		
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$this->data['ranges'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->post['filter_range'])) {
			$filter_range = $this->request->post['filter_range'];
		} else {
			$filter_range = 'current_year'; //show Current Year in Statistics Range by default
		}

		$this->data['report'] = array();
		
		$this->data['report'][] = array(
			'text'  => $this->language->get('text_products'),
			'value' => 'products',
		);			
		$this->data['report'][] = array(
			'text'  => $this->language->get('text_manufacturers'),
			'value' => 'manufacturers',
		);		
		$this->data['report'][] = array(
			'text'  => $this->language->get('text_categories'),
			'value' => 'categories',
		);	
		
		if (isset($this->request->post['filter_report'])) {
			$filter_report = $this->request->post['filter_report'];
		} else {
			$filter_report = 'products'; //show Products in Report By default
		}	
		
		if (isset($this->request->post['filter_ogrouping'])) {
			$filter_ogrouping = $this->request->post['filter_ogrouping'];		
		} else {
			$filter_ogrouping = NULL;
		}	
		
		$this->data['groups'] = array();

		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_no_group'),
			'value' => 'no_group',
		);
		
		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_year'),
			'value' => 'year',
		);
		
		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_quarter'),
			'value' => 'quarter',
		);
		
		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_month'),
			'value' => 'month',
		);
		
		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_week'),
			'value' => 'week',
		);
		
		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_day'),
			'value' => 'day',
		);

		$this->data['groups'][] = array(
			'text'  => $this->language->get('text_order'),
			'value' => 'order',
		);
		
		if (isset($this->request->post['filter_group'])) {
			$filter_group = $this->request->post['filter_group'];
		} else {
			$filter_group = 'no_group'; //show No Grouping in Group By default
		}		

		if (isset($this->request->post['filter_sort'])) {
			$filter_sort = $this->request->post['filter_sort'];
		} else {
			$filter_sort = 'sold_quantity';
		}	

		if (isset($this->request->post['filter_details'])) {
			$filter_details = $this->request->post['filter_details'];
		} else {
			$filter_details = 0;
		}

		if (isset($this->request->post['filter_limit'])) {
			$filter_limit = $this->request->post['filter_limit'];
		} else {
			$filter_limit = 25;
		}
 	
		if (isset($this->request->post['filter_status_date_start'])) {
			$filter_status_date_start = $this->request->post['filter_status_date_start'];
		} else {
			$filter_status_date_start = '';
		}

		if (isset($this->request->post['filter_status_date_end'])) {
			$filter_status_date_end = $this->request->post['filter_status_date_end'];
		} else {
			$filter_status_date_end = '';
		}
		
		$this->data['order_statuses'] = $this->model_report_adv_product_purchased->getOrderStatuses(); 			
		if (isset($this->request->post['filter_order_status_id']) && is_array($this->request->post['filter_order_status_id'])) {
			$filter_order_status_id = array_flip($this->request->post['filter_order_status_id']);
		} else {
			$filter_order_status_id = '';
		}

		if (isset($this->request->post['filter_order_id_from'])) {
			if (is_numeric(trim($this->request->post['filter_order_id_from']))) {
				$filter_order_id_from = trim($this->request->post['filter_order_id_from']);
			} else {
				$filter_order_id_from = '';
			}
		} else {
			$filter_order_id_from = '';
		}
		
		if (isset($this->request->post['filter_order_id_to'])) {
			if (is_numeric(trim($this->request->post['filter_order_id_to']))) {
				$filter_order_id_to = trim($this->request->post['filter_order_id_to']);
			} else {
				$filter_order_id_to = '';
			}
		} else {
			$filter_order_id_to = '';
		}
		
		$this->data['stores'] = $this->model_report_adv_product_purchased->getOrderStores();						
		if (isset($this->request->post['filter_store_id']) && is_array($this->request->post['filter_store_id'])) {
			$filter_store_id = array_flip($this->request->post['filter_store_id']);
		} else {
			$filter_store_id = '';			
		}
		
		$this->data['currencies'] = $this->model_report_adv_product_purchased->getOrderCurrencies();	
		if (isset($this->request->post['filter_currency']) && is_array($this->request->post['filter_currency'])) {
			$filter_currency = array_flip($this->request->post['filter_currency']);
		} else {
			$filter_currency = '';		
		}

		$this->data['taxes'] = $this->model_report_adv_product_purchased->getOrderTaxes();					
		if (isset($this->request->post['filter_taxes']) && is_array($this->request->post['filter_taxes'])) {
			$filter_taxes = array_flip($this->request->post['filter_taxes']);
		} else {
			$filter_taxes = '';		
		}

		$this->data['tax_classes'] = $this->model_report_adv_product_purchased->getOrderTaxClasses();					
		if (isset($this->request->post['filter_tax_classes']) && is_array($this->request->post['filter_tax_classes'])) {
			$filter_tax_classes = array_flip($this->request->post['filter_tax_classes']);
		} else {
			$filter_tax_classes = '';		
		}
		
		$this->data['geo_zones'] = $this->model_report_adv_product_purchased->getOrderGeoZones();					
		if (isset($this->request->post['filter_geo_zones']) && is_array($this->request->post['filter_geo_zones'])) {
			$filter_geo_zones = array_flip($this->request->post['filter_geo_zones']);
		} else {
			$filter_geo_zones = '';		
		}
		
		$this->data['customer_groups'] = $this->model_report_adv_product_purchased->getOrderCustomerGroups();		
		if (isset($this->request->post['filter_customer_group_id']) && is_array($this->request->post['filter_customer_group_id'])) {
			$filter_customer_group_id = array_flip($this->request->post['filter_customer_group_id']);
		} else {
			$filter_customer_group_id = '';
		}
		
		if (isset($this->request->post['filter_customer_name'])) {
			$filter_customer_name = $this->request->post['filter_customer_name'];
		} else {
			$filter_customer_name = '';
		}

		if (isset($this->request->post['filter_customer_email'])) {
			$filter_customer_email = $this->request->post['filter_customer_email'];
		} else {
			$filter_customer_email = '';
		}

		if (isset($this->request->post['filter_customer_telephone'])) {
			$filter_customer_telephone = $this->request->post['filter_customer_telephone'];
		} else {
			$filter_customer_telephone = '';
		}

		if (isset($this->request->post['filter_ip'])) {
			$filter_ip = $this->request->post['filter_ip'];
		} else {
			$filter_ip = '';
		}
		
		if (isset($this->request->post['filter_payment_company'])) {
			$filter_payment_company = $this->request->post['filter_payment_company'];
		} else {
			$filter_payment_company = '';
		}
		
		if (isset($this->request->post['filter_payment_address'])) {
			$filter_payment_address = $this->request->post['filter_payment_address'];
		} else {
			$filter_payment_address = '';
		}

		if (isset($this->request->post['filter_payment_city'])) {
			$filter_payment_city = $this->request->post['filter_payment_city'];
		} else {
			$filter_payment_city = '';
		}
		
		if (isset($this->request->post['filter_payment_zone'])) {
			$filter_payment_zone = $this->request->post['filter_payment_zone'];
		} else {
			$filter_payment_zone = '';
		}
		
		if (isset($this->request->post['filter_payment_postcode'])) {
			$filter_payment_postcode = $this->request->post['filter_payment_postcode'];
		} else {
			$filter_payment_postcode = '';
		}

		if (isset($this->request->post['filter_payment_country'])) {
			$filter_payment_country = $this->request->post['filter_payment_country'];
		} else {
			$filter_payment_country = '';
		}

		$this->data['payment_methods'] = $this->model_report_adv_product_purchased->getOrderPaymentMethods();
		if (isset($this->request->post['filter_payment_method']) && is_array($this->request->post['filter_payment_method'])) {
			$filter_payment_method = array_flip($this->request->post['filter_payment_method']);
		} else {
			$filter_payment_method = '';		
		}
		
		if (isset($this->request->post['filter_shipping_company'])) {
			$filter_shipping_company = $this->request->post['filter_shipping_company'];
		} else {
			$filter_shipping_company = '';
		}
		
		if (isset($this->request->post['filter_shipping_address'])) {
			$filter_shipping_address = $this->request->post['filter_shipping_address'];
		} else {
			$filter_shipping_address = '';
		}

		if (isset($this->request->post['filter_shipping_city'])) {
			$filter_shipping_city = $this->request->post['filter_shipping_city'];
		} else {
			$filter_shipping_city = '';
		}
		
		if (isset($this->request->post['filter_shipping_zone'])) {
			$filter_shipping_zone = $this->request->post['filter_shipping_zone'];
		} else {
			$filter_shipping_zone = '';
		}
		
		if (isset($this->request->post['filter_shipping_postcode'])) {
			$filter_shipping_postcode = $this->request->post['filter_shipping_postcode'];
		} else {
			$filter_shipping_postcode = '';
		}

		if (isset($this->request->post['filter_shipping_country'])) {
			$filter_shipping_country = $this->request->post['filter_shipping_country'];
		} else {
			$filter_shipping_country = '';
		}

		$this->data['shipping_methods'] = $this->model_report_adv_product_purchased->getOrderShippingMethods();			
		if (isset($this->request->post['filter_shipping_method']) && is_array($this->request->post['filter_shipping_method'])) {
			$filter_shipping_method = array_flip($this->request->post['filter_shipping_method']);
		} else {
			$filter_shipping_method = '';		
		}
		
		$this->data['categories'] = $this->model_report_adv_product_purchased->getProductsCategories(0);	
		if (isset($this->request->post['filter_category']) && is_array($this->request->post['filter_category'])) {
			$filter_category = array_flip($this->request->post['filter_category']);
		} else {
			$filter_category = '';
		}
		
		$this->data['manufacturers'] = $this->model_report_adv_product_purchased->getProductsManufacturers(); 
		if (isset($this->request->post['filter_manufacturer']) && is_array($this->request->post['filter_manufacturer'])) {
			$filter_manufacturer = array_flip($this->request->post['filter_manufacturer']);
		} else {
			$filter_manufacturer = '';
		}
		
		if (isset($this->request->post['filter_sku'])) {
			$filter_sku = $this->request->post['filter_sku'];
		} else {
			$filter_sku = '';
		}

		if (isset($this->request->post['filter_product_id'])) {
			$filter_product_id = $this->request->post['filter_product_id'];
		} else {
			$filter_product_id = '';
		}
		
		if (isset($this->request->post['filter_model'])) {
			$filter_model = $this->request->post['filter_model'];
		} else {
			$filter_model = '';
		}

		$this->data['product_options'] = $this->model_report_adv_product_purchased->getProductOptions();
		if (isset($this->request->post['filter_option']) && is_array($this->request->post['filter_option'])) {
			$filter_option = array_flip($this->request->post['filter_option']);
		} else {
			$filter_option = '';
		}

		$this->data['attributes'] = $this->model_report_adv_product_purchased->getProductAttributes();
		if (isset($this->request->post['filter_attribute']) && is_array($this->request->post['filter_attribute'])) {
			$filter_attribute = array_flip($this->request->post['filter_attribute']);
		} else {
			$filter_attribute = '';
		}

		$this->data['statuses'] = $this->model_report_adv_product_purchased->getProductStatuses();
		if (isset($this->request->post['filter_status']) && is_array($this->request->post['filter_status'])) {
			$filter_status = array_flip($this->request->post['filter_status']);
		} else {
			$filter_status = '';
		}
		
		$this->data['locations'] = $this->model_report_adv_product_purchased->getProductLocations();			
		if (isset($this->request->post['filter_location']) && is_array($this->request->post['filter_location'])) {
			$filter_location = array_flip($this->request->post['filter_location']);
		} else {
			$filter_location = '';		
		}
		
		$this->data['affiliate_names'] = $this->model_report_adv_product_purchased->getOrderAffiliates();
		if (isset($this->request->post['filter_affiliate_name']) && is_array($this->request->post['filter_affiliate_name'])) {
			$filter_affiliate_name = array_flip($this->request->post['filter_affiliate_name']);
		} else {
			$filter_affiliate_name = '';
		}

		$this->data['affiliate_emails'] = $this->model_report_adv_product_purchased->getOrderAffiliates();
		if (isset($this->request->post['filter_affiliate_email']) && is_array($this->request->post['filter_affiliate_email'])) {
			$filter_affiliate_email = array_flip($this->request->post['filter_affiliate_email']);
		} else {
			$filter_affiliate_email = '';
		}

		$this->data['coupon_names'] = $this->model_report_adv_product_purchased->getOrderCouponNames();
		if (isset($this->request->post['filter_coupon_name']) && is_array($this->request->post['filter_coupon_name'])) {
			$filter_coupon_name = array_flip($this->request->post['filter_coupon_name']);
		} else {
			$filter_coupon_name = '';
		}

		if (isset($this->request->post['filter_coupon_code'])) {
			$filter_coupon_code = $this->request->post['filter_coupon_code'];
		} else {
			$filter_coupon_code = '';
		}

		if (isset($this->request->post['filter_voucher_code'])) {
			$filter_voucher_code = $this->request->post['filter_voucher_code'];
		} else {
			$filter_voucher_code = '';
		}
		
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('report/adv_product_purchased', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);		
		
		$this->data['products'] = array();
		
		$data = array(
			'filter_date_start'	     		=> $filter_date_start, 
			'filter_date_end'	     		=> $filter_date_end, 
			'filter_range'           		=> $filter_range,
			'filter_report'           		=> $filter_report,			
			'filter_ogrouping'   	 		=> $filter_ogrouping,
			'filter_group'           		=> $filter_group,
			'filter_status_date_start'		=> $filter_status_date_start, 
			'filter_status_date_end'		=> $filter_status_date_end, 			
			'filter_order_status_id'		=> $filter_order_status_id,
			'filter_order_id_from'			=> $filter_order_id_from,
			'filter_order_id_to'			=> $filter_order_id_to,			
			'filter_store_id'				=> $filter_store_id,
			'filter_currency'				=> $filter_currency,
			'filter_taxes'					=> $filter_taxes,
			'filter_tax_classes'			=> $filter_tax_classes,
			'filter_geo_zones'				=> $filter_geo_zones,			
			'filter_customer_group_id'		=> $filter_customer_group_id,		
			'filter_customer_name'	 	 	=> $filter_customer_name,			
			'filter_customer_email'			=> $filter_customer_email,
			'filter_customer_telephone'		=> $filter_customer_telephone,	
			'filter_ip' 	 				=> $filter_ip,				
			'filter_payment_company'		=> $filter_payment_company,
			'filter_payment_address'		=> $filter_payment_address,
			'filter_payment_city'			=> $filter_payment_city,
			'filter_payment_zone'			=> $filter_payment_zone,			
			'filter_payment_postcode'		=> $filter_payment_postcode,
			'filter_payment_country'		=> $filter_payment_country,
			'filter_payment_method'  		=> $filter_payment_method,
			'filter_shipping_company'		=> $filter_shipping_company,
			'filter_shipping_address'		=> $filter_shipping_address,
			'filter_shipping_city'			=> $filter_shipping_city,
			'filter_shipping_zone'			=> $filter_shipping_zone,			
			'filter_shipping_postcode'		=> $filter_shipping_postcode,
			'filter_shipping_country'		=> $filter_shipping_country,
			'filter_shipping_method'  		=> $filter_shipping_method,
			'filter_category'				=> $filter_category,
			'filter_manufacturer'			=> $filter_manufacturer,
			'filter_sku' 	 				=> $filter_sku,
			'filter_product_id'				=> $filter_product_id,
			'filter_model' 	 				=> $filter_model,
			'filter_option'  				=> $filter_option,
			'filter_attribute' 	 		 	=> $filter_attribute,
			'filter_status'   		 		=> $filter_status,			
			'filter_location'  				=> $filter_location,
			'filter_affiliate_name'			=> $filter_affiliate_name,
			'filter_affiliate_email'		=> $filter_affiliate_email,
			'filter_coupon_name'			=> $filter_coupon_name,
			'filter_coupon_code'			=> $filter_coupon_code,
			'filter_voucher_code'			=> $filter_voucher_code,			
			'filter_sort'  					=> $filter_sort,
			'filter_details'  				=> $filter_details,
			'filter_limit'  				=> $filter_limit
		);
				
		$results = $this->model_report_adv_product_purchased->getProductPurchased($data);

		$this->load->model('tool/image');
		
		foreach ($results as $result) {
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$this->load->model('catalog/product');
			$category = $this->model_catalog_product->getProductCategories($result['product_id']);
			$manufacturer = $this->model_report_adv_product_purchased->getProductManufacturers($result['manufacturer_id']);	

			if (!is_null($result['sold_quantity'])) {
				$sold_percent = round(100 * ($result['sold_quantity'] / $result['sold_quantity_total']), 2) . '%';
				$sold_percent_total = '100%';		
			} else {
				$sold_percent = 0;
				$sold_percent_total = 0;
			}
			
			$this->data['products'][] = array(
				'year'		       					=> $result['year'],
				'quarter'		       				=> 'Q' . $result['quarter'],	
				'year_quarter'		       			=> 'Q' . $result['quarter']. ' ' . $result['year'],
				'month'		       					=> $result['month'],
				'year_month'		       			=> substr($result['month'],0,3) . ' ' . $result['year'],			
				'date_start' 						=> date($this->language->get('date_format_short'), strtotime($result['date_start'])),
				'date_end'   						=> date($this->language->get('date_format_short'), strtotime($result['date_end'])),	
				'order_id'   						=> $result['order_id'],					
				'product_id' 						=> $result['product_id'],						
				'order_product_id'     				=> $result['order_product_id'],	
				'image'      						=> $image,
				'sku'    							=> $result['sku'],
				'name'     							=> $result['name'],	
				'ooname'    						=> $result['ooname'],
				'oovalue'    						=> $result['oovalue'],						
				'model'    							=> $result['model'],
				'category'  						=> $category,
				'manufacturer'  					=> $manufacturer,
				'attribute'  						=> $result['attribute'],			
				'status'     						=> $result['status'],
				'stock_quantity'     				=> $result['stock_quantity'],
				'stock_oquantity'     				=> $result['stock_oquantity'],				
				'sold_quantity' 					=> $result['sold_quantity'],
				'sold_percent' 						=> $sold_percent,								
				'tax'    							=> $this->currency->format($result['tax'], $this->config->get('config_currency')),
				'total'    							=> $this->currency->format($result['total'], $this->config->get('config_currency')),
				'order_prod_ord_id'     			=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_ord_id'] : '',
				'order_prod_ord_idc'     			=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_ord_idc'] : '',
				'order_prod_order_date'    			=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_order_date'] : '',
				'order_prod_inv_no'     			=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_inv_no'] : '',
				'order_prod_name'   				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_name'] : '',
				'order_prod_email'   				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_email'] : '',
				'order_prod_group'   				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_group'] : '',
				'order_prod_shipping_method' 		=> $filter_report == 'products' && $filter_details == 1 ? strip_tags($result['order_prod_shipping_method'], '<br>') : '',
				'order_prod_payment_method'  		=> $filter_report == 'products' && $filter_details == 1 ? strip_tags($result['order_prod_payment_method'], '<br>') : '',
				'order_prod_status'  				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_status'] : '',
				'order_prod_store'      			=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_store'] : '',	
				'order_prod_currency' 				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_currency'] : '',
				'order_prod_price' 					=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_price'] : '',
				'order_prod_quantity' 				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_quantity'] : '',
				'order_prod_tax'  					=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_tax'] : '',				
				'order_prod_total'  				=> $filter_report == 'products' && $filter_details == 1 ? $result['order_prod_total'] : '',
				'product_ord_id'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_ord_id'] : '',
				'product_ord_idc'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_ord_idc'] : '',
				'product_order_date'    			=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_order_date'] : '',
				'product_inv_no'     				=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_inv_no'] : '',
				'product_pid'  						=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_pid'] : '',
				'product_pidc'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_pidc'] : '',
				'product_sku'  						=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_sku'] : '',
				'product_model'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_model'] : '',				
				'product_name'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_name'] : '',
				'product_option'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_option'] : '',
				'product_attributes'  				=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_attributes'] : '',				
				'product_manu'  					=> $filter_report == 'categories' && $filter_details == 3 ? $result['product_manu'] : '',
				'product_category'  				=> $filter_report == 'manufacturers' && $filter_details == 3 ? $result['product_category'] : '',				
				'product_currency'  				=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_currency'] : '',
				'product_price'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_price'] : '',
				'product_quantity'  				=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_quantity'] : '',
				'product_tax'  						=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_tax'] : '',				
				'product_total'  					=> ($filter_report == 'manufacturers' && $filter_details == 3) || ($filter_report == 'categories' && $filter_details == 3) ? $result['product_total'] : '',
				'customer_ord_id' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_ord_id'] : '',
				'customer_order_date' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_order_date'] : '',
				'customer_inv_no' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_inv_no'] : '',
				'customer_cust_id' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_cust_id'] : '',
				'customer_cust_idc' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_cust_idc'] : '',
				'billing_name' 						=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_name'] : '',
				'billing_company' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_company'] : '',
				'billing_address_1' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_address_1'] : '',
				'billing_address_2' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_address_2'] : '',
				'billing_city' 						=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_city'] : '',
				'billing_zone' 						=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_zone'] : '',
				'billing_postcode' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_postcode'] : '',
				'billing_country' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['billing_country'] : '',
				'customer_telephone' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['customer_telephone'] : '',
				'shipping_name' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_name'] : '',
				'shipping_company' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_company'] : '',
				'shipping_address_1' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_address_1'] : '',
				'shipping_address_2' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_address_2'] : '',
				'shipping_city' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_city'] : '',
				'shipping_zone' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_zone'] : '',
				'shipping_postcode' 				=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_postcode'] : '',
				'shipping_country' 					=> $filter_report == 'products' && $filter_details == 2 ? $result['shipping_country'] : '',
				'sold_quantity_total' 				=> $result['sold_quantity_total'],				
				'sold_percent_total' 				=> $sold_percent_total,					
				'tax_total' 						=> $this->currency->format($result['tax_total'], $this->config->get('config_currency')),
				'total_total' 						=> $this->currency->format($result['total_total'], $this->config->get('config_currency')),
				'href' 								=> $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'], 'SSL')
			);
		}

    	if (($filter_range != 'all_time' && ($filter_group == 'year' or $filter_group == 'quarter' or $filter_group == 'month')) or ($filter_range == 'all_time' && $filter_group == 'year')) {
			
		$this->data['sales'] = array();
		
		$sales_results = $this->model_report_adv_product_purchased->getProductSaleChart($data);
		
		foreach ($sales_results as $sales_result) {
			
			$this->data['sales'][] = array(
				'gyear'		       			=> $sales_result['gyear'],
				'gyear_quarter'		       	=> 'Q' . $sales_result['gquarter']. ' ' . $sales_result['gyear'],
				'gyear_month'		       	=> substr($sales_result['gmonth'],0,3) . ' ' . $sales_result['gyear'],
				'gorders'    				=> $sales_result['gorders'],
				'gcustomers'    			=> $sales_result['gcustomers'],
				'gproducts'    				=> $sales_result['gproducts'],
				'gtotal'    				=> $sales_result['gtotal']
			);
		}
		
		}

		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_details'] = $this->language->get('text_no_details');
		$this->data['text_order_list'] = $this->language->get('text_order_list');
		$this->data['text_product_list'] = $this->language->get('text_product_list');
		$this->data['text_order_list'] = $this->language->get('text_order_list');		
		$this->data['text_customer_list'] = $this->language->get('text_customer_list');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_all_status'] = $this->language->get('text_all_status');		
		$this->data['text_all_stores'] = $this->language->get('text_all_stores');
		$this->data['text_all_currencies'] = $this->language->get('text_all_currencies');
		$this->data['text_all_taxes'] = $this->language->get('text_all_taxes');		
		$this->data['text_all_tax_classes'] = $this->language->get('text_all_tax_classes');			
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');			
		$this->data['text_all_groups'] = $this->language->get('text_all_groups');
		$this->data['text_all_payment_methods'] = $this->language->get('text_all_payment_methods');	
		$this->data['text_all_shipping_methods'] = $this->language->get('text_all_shipping_methods');
		$this->data['text_all_categories'] = $this->language->get('text_all_categories');
		$this->data['text_all_manufacturers'] = $this->language->get('text_all_manufacturers');		
		$this->data['text_all_options'] = $this->language->get('text_all_options');
		$this->data['text_all_attributes'] = $this->language->get('text_all_attributes');
		$this->data['text_all_locations'] = $this->language->get('text_all_locations');	
		$this->data['text_all_affiliate_names'] = $this->language->get('text_all_affiliate_names');
		$this->data['text_all_affiliate_emails'] = $this->language->get('text_all_affiliate_emails');
		$this->data['text_all_coupon_names'] = $this->language->get('text_all_coupon_names');
		$this->data['text_none_selected'] = $this->language->get('text_none_selected');
		$this->data['text_selected'] = $this->language->get('text_selected');		
		$this->data['text_detail'] = $this->language->get('text_detail');
		$this->data['text_export_prod_no_details'] = $this->language->get('text_export_prod_no_details');
		$this->data['text_export_prod_order_list'] = $this->language->get('text_export_prod_order_list');
		$this->data['text_export_prod_customer_list'] = $this->language->get('text_export_prod_customer_list');	
		$this->data['text_export_manu_no_details'] = $this->language->get('text_export_manu_no_details');
		$this->data['text_export_manu_product_list'] = $this->language->get('text_export_manu_product_list');
		$this->data['text_export_cat_no_details'] = $this->language->get('text_export_cat_no_details');
		$this->data['text_export_cat_product_list'] = $this->language->get('text_export_cat_product_list');		
		$this->data['text_filter_total'] = $this->language->get('text_filter_total');
		$this->data['text_filtering_options'] = $this->language->get('text_filtering_options');
		$this->data['text_column_settings'] = $this->language->get('text_column_settings');
		$this->data['text_mv_columns'] = $this->language->get('text_mv_columns');		
		$this->data['text_ol_columns'] = $this->language->get('text_ol_columns');
		$this->data['text_pl_columns'] = $this->language->get('text_pl_columns');			
		$this->data['text_cl_columns'] = $this->language->get('text_cl_columns');
		$this->data['text_export_note'] = $this->language->get('text_export_note');		
		$this->data['text_export_notice1'] = $this->language->get('text_export_notice1');
		$this->data['text_export_notice2'] = $this->language->get('text_export_notice2');		
		$this->data['text_export_limit'] = $this->language->get('text_export_limit');
		$this->data['text_pagin_page'] = $this->language->get('text_pagin_page');
		$this->data['text_pagin_of'] = $this->language->get('text_pagin_of');
		$this->data['text_pagin_results'] = $this->language->get('text_pagin_results');	

		$this->data['column_date'] = $this->language->get('column_date');
		$this->data['column_date_start'] = $this->language->get('column_date_start');
		$this->data['column_date_end'] = $this->language->get('column_date_end');
		$this->data['column_image'] = $this->language->get('column_image');
		$this->data['column_sku'] = $this->language->get('column_sku');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_model'] = $this->language->get('column_model');	
		$this->data['column_category'] = $this->language->get('column_category');		
		$this->data['column_manufacturer'] = $this->language->get('column_manufacturer');
		$this->data['column_attribute'] = $this->language->get('column_attribute');		
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_stock_quantity'] = $this->language->get('column_stock_quantity');		
		$this->data['column_sold_quantity'] = $this->language->get('column_sold_quantity');
		$this->data['column_sold_percent'] = $this->language->get('column_sold_percent');
		$this->data['column_tax'] = $this->language->get('column_tax');
		$this->data['column_total'] = $this->language->get('column_total');	
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_order_prod_date_added'] = $this->language->get('column_order_prod_date_added');
		$this->data['column_order_prod_order_id'] = $this->language->get('column_order_prod_order_id');
		$this->data['column_order_prod_inv_date'] = $this->language->get('column_order_prod_inv_date');
		$this->data['column_order_prod_inv_no'] = $this->language->get('column_order_prod_inv_no');
		$this->data['column_order_prod_customer'] = $this->language->get('column_order_prod_customer');		
		$this->data['column_order_prod_email'] = $this->language->get('column_order_prod_email');		
		$this->data['column_order_prod_customer_group'] = $this->language->get('column_order_prod_customer_group');		
		$this->data['column_order_prod_shipping_method'] = $this->language->get('column_order_prod_shipping_method');
		$this->data['column_order_prod_payment_method'] = $this->language->get('column_order_prod_payment_method');		
		$this->data['column_order_prod_status'] = $this->language->get('column_order_prod_status');
		$this->data['column_order_prod_store'] = $this->language->get('column_order_prod_store');
		$this->data['column_order_prod_currency'] = $this->language->get('column_order_prod_currency');
		$this->data['column_order_prod_price'] = $this->language->get('column_order_prod_price');		
		$this->data['column_order_prod_quantity'] = $this->language->get('column_order_prod_quantity');
		$this->data['column_order_prod_tax'] = $this->language->get('column_order_prod_tax');
		$this->data['column_order_prod_total'] = $this->language->get('column_order_prod_total');
		$this->data['column_prod_order_id'] = $this->language->get('column_prod_order_id');		
		$this->data['column_prod_date_added'] = $this->language->get('column_prod_date_added');	
		$this->data['column_prod_inv_no'] = $this->language->get('column_prod_inv_no');			
		$this->data['column_prod_id'] = $this->language->get('column_prod_id');
		$this->data['column_prod_sku'] = $this->language->get('column_prod_sku');		
		$this->data['column_prod_model'] = $this->language->get('column_prod_model');		
		$this->data['column_prod_name'] = $this->language->get('column_prod_name');	
		$this->data['column_prod_option'] = $this->language->get('column_prod_option');
		$this->data['column_prod_attributes'] = $this->language->get('column_prod_attributes');				
		$this->data['column_prod_manu'] = $this->language->get('column_prod_manu');
		$this->data['column_prod_category'] = $this->language->get('column_prod_category');			
		$this->data['column_prod_currency'] = $this->language->get('column_prod_currency');
		$this->data['column_prod_price'] = $this->language->get('column_prod_price');
		$this->data['column_prod_quantity'] = $this->language->get('column_prod_quantity');
		$this->data['column_prod_tax'] = $this->language->get('column_prod_tax');		
		$this->data['column_prod_total'] = $this->language->get('column_prod_total');		
		$this->data['column_customer_order_id'] = $this->language->get('column_customer_order_id');
		$this->data['column_customer_date_added'] = $this->language->get('column_customer_date_added');
		$this->data['column_customer_inv_no'] = $this->language->get('column_customer_inv_no');
		$this->data['column_customer_cust_id'] = $this->language->get('column_customer_cust_id');
		$this->data['column_billing_name'] = $this->language->get('column_billing_name');
		$this->data['column_billing_company'] = $this->language->get('column_billing_company');
		$this->data['column_billing_address_1'] = $this->language->get('column_billing_address_1');
		$this->data['column_billing_address_2'] = $this->language->get('column_billing_address_2');
		$this->data['column_billing_city'] = $this->language->get('column_billing_city');
		$this->data['column_billing_zone'] = $this->language->get('column_billing_zone');
		$this->data['column_billing_postcode'] = $this->language->get('column_billing_postcode');		
		$this->data['column_billing_country'] = $this->language->get('column_billing_country');
		$this->data['column_customer_telephone'] = $this->language->get('column_customer_telephone');
		$this->data['column_shipping_name'] = $this->language->get('column_shipping_name');
		$this->data['column_shipping_company'] = $this->language->get('column_shipping_company');
		$this->data['column_shipping_address_1'] = $this->language->get('column_shipping_address_1');
		$this->data['column_shipping_address_2'] = $this->language->get('column_shipping_address_2');
		$this->data['column_shipping_city'] = $this->language->get('column_shipping_city');
		$this->data['column_shipping_zone'] = $this->language->get('column_shipping_zone');
		$this->data['column_shipping_postcode'] = $this->language->get('column_shipping_postcode');		
		$this->data['column_shipping_country'] = $this->language->get('column_shipping_country');		

		$this->data['column_year'] = $this->language->get('column_year');		
		$this->data['column_quarter'] = $this->language->get('column_quarter');
		$this->data['column_month'] = $this->language->get('column_month');
    	$this->data['column_orders'] = $this->language->get('column_orders');
    	$this->data['column_customers'] = $this->language->get('column_customers');		
		$this->data['column_products'] = $this->language->get('column_products');	

		$this->data['entry_order_created'] = $this->language->get('entry_order_created');
		$this->data['entry_status_changed'] = $this->language->get('entry_status_changed');	
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_range'] = $this->language->get('entry_range');			
		$this->data['entry_status'] = $this->language->get('entry_status');		
		$this->data['entry_order_id'] = $this->language->get('entry_order_id');
		$this->data['entry_order_id_from'] = $this->language->get('entry_order_id_from');
		$this->data['entry_order_id_to'] = $this->language->get('entry_order_id_to');		
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_currency'] = $this->language->get('entry_currency');	
		$this->data['entry_tax'] = $this->language->get('entry_tax');
		$this->data['entry_tax_classes'] = $this->language->get('entry_tax_classes');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');			
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_customer_name'] = $this->language->get('entry_customer_name');		
		$this->data['entry_customer_email'] = $this->language->get('entry_customer_email'); 
		$this->data['entry_customer_telephone'] = $this->language->get('entry_customer_telephone');	
		$this->data['entry_ip'] = $this->language->get('entry_ip');		
		$this->data['entry_payment_company'] = $this->language->get('entry_payment_company');
		$this->data['entry_payment_address'] = $this->language->get('entry_payment_address');
		$this->data['entry_payment_city'] = $this->language->get('entry_payment_city');
		$this->data['entry_payment_zone'] = $this->language->get('entry_payment_zone');		
		$this->data['entry_payment_postcode'] = $this->language->get('entry_payment_postcode');
		$this->data['entry_payment_country'] = $this->language->get('entry_payment_country');		
		$this->data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$this->data['entry_shipping_company'] = $this->language->get('entry_shipping_company');
		$this->data['entry_shipping_address'] = $this->language->get('entry_shipping_address');
		$this->data['entry_shipping_city'] = $this->language->get('entry_shipping_city');
		$this->data['entry_shipping_zone'] = $this->language->get('entry_shipping_zone');		
		$this->data['entry_shipping_postcode'] = $this->language->get('entry_shipping_postcode');
		$this->data['entry_shipping_country'] = $this->language->get('entry_shipping_country');
		$this->data['entry_shipping_method'] = $this->language->get('entry_shipping_method');		
		$this->data['entry_category'] = $this->language->get('entry_category'); 
		$this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$this->data['entry_sku'] = $this->language->get('entry_sku');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_model'] = $this->language->get('entry_model');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_attributes'] = $this->language->get('entry_attributes');
		$this->data['entry_prod_status'] = $this->language->get('entry_prod_status');		
		$this->data['entry_location'] = $this->language->get('entry_location');
		$this->data['entry_affiliate_name'] = $this->language->get('entry_affiliate_name');
		$this->data['entry_affiliate_email'] = $this->language->get('entry_affiliate_email');
		$this->data['entry_coupon_name'] = $this->language->get('entry_coupon_name');
		$this->data['entry_coupon_code'] = $this->language->get('entry_coupon_code');
		$this->data['entry_voucher_code'] = $this->language->get('entry_voucher_code');
		
		$this->data['entry_report'] = $this->language->get('entry_report'); 		
		$this->data['entry_option_grouping'] = $this->language->get('entry_option_grouping');	
		$this->data['entry_group'] = $this->language->get('entry_group');		
		$this->data['entry_sort_by'] = $this->language->get('entry_sort_by');
		$this->data['entry_show_details'] = $this->language->get('entry_show_details');	
		$this->data['entry_limit'] = $this->language->get('entry_limit');	
		
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_chart'] = $this->language->get('button_chart');				
		$this->data['button_export'] = $this->language->get('button_export');
		$this->data['button_settings'] = $this->language->get('button_settings');

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['heading_version'] = $this->language->get('heading_version');	
		
		$this->data['token'] = $this->session->data['token'];

		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;
		$this->data['filter_range'] = $filter_range;
		$this->data['filter_status_date_start'] = $filter_status_date_start;
		$this->data['filter_status_date_end'] = $filter_status_date_end;		
		$this->data['filter_order_status_id'] = $filter_order_status_id;
		$this->data['filter_order_id_from'] = $filter_order_id_from;
		$this->data['filter_order_id_to'] = $filter_order_id_to;		
		$this->data['filter_store_id'] = $filter_store_id;
		$this->data['filter_currency'] = $filter_currency;
		$this->data['filter_taxes'] = $filter_taxes;	
		$this->data['filter_tax_classes'] = $filter_tax_classes;		
		$this->data['filter_geo_zones'] = $filter_geo_zones;		
		$this->data['filter_customer_group_id'] = $filter_customer_group_id;
		$this->data['filter_customer_name'] = $filter_customer_name; 
		$this->data['filter_customer_email'] = $filter_customer_email; 		
		$this->data['filter_customer_telephone'] = $filter_customer_telephone;
		$this->data['filter_ip'] = $filter_ip;		
		$this->data['filter_payment_company'] = $filter_payment_company; 
		$this->data['filter_payment_address'] = $filter_payment_address; 
		$this->data['filter_payment_city'] = $filter_payment_city; 
		$this->data['filter_payment_postcode'] = $filter_payment_postcode; 
		$this->data['filter_payment_zone'] = $filter_payment_zone; 
		$this->data['filter_payment_country'] = $filter_payment_country; 
		$this->data['filter_payment_method'] = $filter_payment_method; 		
		$this->data['filter_shipping_company'] = $filter_shipping_company; 
		$this->data['filter_shipping_address'] = $filter_shipping_address; 
		$this->data['filter_shipping_city'] = $filter_shipping_city; 
		$this->data['filter_shipping_postcode'] = $filter_shipping_postcode; 
		$this->data['filter_shipping_zone'] = $filter_shipping_zone; 
		$this->data['filter_shipping_country'] = $filter_shipping_country; 
		$this->data['filter_shipping_method'] = $filter_shipping_method; 
		$this->data['filter_manufacturer'] = $filter_manufacturer; 
		$this->data['filter_category'] = $filter_category; 
		$this->data['filter_sku'] = $filter_sku; 
		$this->data['filter_product_id'] = $filter_product_id; 
		$this->data['filter_model'] = $filter_model; 
		$this->data['filter_option'] = $filter_option;
		$this->data['filter_attribute'] = $filter_attribute;
		$this->data['filter_status'] = $filter_status;		
		$this->data['filter_location'] = $filter_location;
		$this->data['filter_affiliate_name'] = $filter_affiliate_name; 
		$this->data['filter_affiliate_email'] = $filter_affiliate_email; 
		$this->data['filter_coupon_name'] = $filter_coupon_name; 
		$this->data['filter_coupon_code'] = $filter_coupon_code; 
		$this->data['filter_voucher_code'] = $filter_voucher_code; 	
		$this->data['filter_report'] = $filter_report;			
		$this->data['filter_ogrouping'] = $filter_ogrouping;	
		$this->data['filter_group'] = $filter_group;		
		$this->data['filter_sort'] = $filter_sort;	
		$this->data['filter_details'] = $filter_details;
		$this->data['filter_limit'] = $filter_limit;
		
		$this->template = 'report/adv_product_purchased.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
		
    	if (isset($this->request->post['export']) && $this->request->post['export'] == 1) { // export_xls_prod
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_prod.inc.php");
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 2) { // export_xls_prod_order_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_prod_order_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 3) { // export_xls_prod_customer_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_prod_customer_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 4) { // export_xls_manu
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_manu.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 5) { // export_xls_manu_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_manu_product_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 6) { // export_xls_cat
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_cat.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 7) { // export_xls_cat_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_xls_cat_product_list.inc.php");
				
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 8) { // export_html_prod
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_prod.inc.php");
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 9) { // export_html_prod_order_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_prod_order_list.inc.php");
											
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 10) { // export_html_prod_customer_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_prod_customer_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 11) { // export_html_manu
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_manu.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 12) { // export_html_manu_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_manu_product_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 13) { // export_html_cat
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_cat.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 14) { // export_html_cat_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_html_cat_product_list.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 15) { // export_pdf_prod
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_prod.inc.php");
		
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 16) { // export_pdf_prod_order_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_prod_order_list.inc.php");
						
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 17) { // export_pdf_prod_customer_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_prod_customer_list.inc.php");
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 18) { // export_pdf_manu
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_manu.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 19) { // export_pdf_manu_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_manu_product_list.inc.php");
			
		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 20) { // export_pdf_cat
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_cat.inc.php");

		} elseif (isset($this->request->post['export']) && $this->request->post['export'] == 21) { // export_pdf_cat_product_list
			$this->load->model('report/adv_product_purchased_export');
    		$results = $this->model_report_adv_product_purchased_export->getProductPurchasedExport($data);
			require_once(DIR_SYSTEM . 'library/dompdf/dompdf_config.inc.php');
			include(DIR_APPLICATION."controller/report/adv_reports/pp_export_pdf_cat_product_list.inc.php");			
		}			
	}
	
	public function customer_autocomplete() {
		$json = array();

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_customer_name']) or isset($this->request->get['filter_customer_email']) or isset($this->request->get['filter_customer_telephone']) or isset($this->request->get['filter_ip']) or isset($this->request->get['filter_payment_company']) or isset($this->request->get['filter_payment_address']) or isset($this->request->get['filter_payment_city']) or isset($this->request->get['filter_payment_zone']) or isset($this->request->get['filter_payment_postcode']) or isset($this->request->get['filter_payment_country']) or isset($this->request->get['filter_shipping_company']) or isset($this->request->get['filter_shipping_address']) or isset($this->request->get['filter_shipping_city']) or isset($this->request->get['filter_shipping_zone']) or isset($this->request->get['filter_shipping_postcode']) or isset($this->request->get['filter_shipping_country'])) {
			
		$this->load->model('report/adv_product_purchased');
		
		if (isset($this->request->get['filter_customer_name'])) {
			$filter_customer_name = $this->request->get['filter_customer_name'];
		} else {
			$filter_customer_name = '';
		}

		if (isset($this->request->get['filter_customer_email'])) {
			$filter_customer_email = $this->request->get['filter_customer_email'];
		} else {
			$filter_customer_email = '';
		}	

		if (isset($this->request->get['filter_customer_telephone'])) {
			$filter_customer_telephone = $this->request->get['filter_customer_telephone'];
		} else {
			$filter_customer_telephone = '';
		}

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = '';
		}
		
		if (isset($this->request->get['filter_payment_company'])) {
			$filter_payment_company = $this->request->get['filter_payment_company'];
		} else {
			$filter_payment_company = '';
		}
		
		if (isset($this->request->get['filter_payment_address'])) {
			$filter_payment_address = $this->request->get['filter_payment_address'];
		} else {
			$filter_payment_address = '';
		}

		if (isset($this->request->get['filter_payment_city'])) {
			$filter_payment_city = $this->request->get['filter_payment_city'];
		} else {
			$filter_payment_city = '';
		}
		
		if (isset($this->request->get['filter_payment_zone'])) {
			$filter_payment_zone = $this->request->get['filter_payment_zone'];
		} else {
			$filter_payment_zone = '';
		}
		
		if (isset($this->request->get['filter_payment_postcode'])) {
			$filter_payment_postcode = $this->request->get['filter_payment_postcode'];
		} else {
			$filter_payment_postcode = '';
		}

		if (isset($this->request->get['filter_payment_country'])) {
			$filter_payment_country = $this->request->get['filter_payment_country'];
		} else {
			$filter_payment_country = '';
		}
		
		if (isset($this->request->get['filter_shipping_company'])) {
			$filter_shipping_company = $this->request->get['filter_shipping_company'];
		} else {
			$filter_shipping_company = '';
		}
		
		if (isset($this->request->get['filter_shipping_address'])) {
			$filter_shipping_address = $this->request->get['filter_shipping_address'];
		} else {
			$filter_shipping_address = '';
		}

		if (isset($this->request->get['filter_shipping_city'])) {
			$filter_shipping_city = $this->request->get['filter_shipping_city'];
		} else {
			$filter_shipping_city = '';
		}
		
		if (isset($this->request->get['filter_shipping_zone'])) {
			$filter_shipping_zone = $this->request->get['filter_shipping_zone'];
		} else {
			$filter_shipping_zone = '';
		}
		
		if (isset($this->request->get['filter_shipping_postcode'])) {
			$filter_shipping_postcode = $this->request->get['filter_shipping_postcode'];
		} else {
			$filter_shipping_postcode = '';
		}

		if (isset($this->request->get['filter_shipping_country'])) {
			$filter_shipping_country = $this->request->get['filter_shipping_country'];
		} else {
			$filter_shipping_country = '';
		}
		
		$data = array(		
			'filter_customer_name' 	 		=> $filter_customer_name,
			'filter_customer_email' 	 	=> $filter_customer_email,			
			'filter_customer_telephone' 	=> $filter_customer_telephone,
			'filter_ip' 					=> $filter_ip,			
			'filter_payment_company' 		=> $filter_payment_company,
			'filter_payment_address' 		=> $filter_payment_address,
			'filter_payment_city' 			=> $filter_payment_city,
			'filter_payment_zone' 			=> $filter_payment_zone,			
			'filter_payment_postcode' 		=> $filter_payment_postcode,
			'filter_payment_country' 		=> $filter_payment_country,			
			'filter_shipping_company' 		=> $filter_shipping_company,
			'filter_shipping_address' 		=> $filter_shipping_address,
			'filter_shipping_city' 			=> $filter_shipping_city,
			'filter_shipping_zone' 			=> $filter_shipping_zone,			
			'filter_shipping_postcode' 		=> $filter_shipping_postcode,
			'filter_shipping_country' 		=> $filter_shipping_country
		);
						
		$results = $this->model_report_adv_product_purchased->getCustomerAutocomplete($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'customer_id'     		=> $result['customer_id'],				
					'cust_name'     		=> html_entity_decode($result['cust_name'], ENT_QUOTES, 'UTF-8'),
					'cust_email'     		=> $result['cust_email'],
					'cust_telephone'     	=> $result['cust_telephone'],
					'cust_ip'     			=> $result['cust_ip'],
					'payment_company'     	=> html_entity_decode($result['payment_company'], ENT_QUOTES, 'UTF-8'),	
					'payment_address'     	=> html_entity_decode($result['payment_address'], ENT_QUOTES, 'UTF-8'),	
					'payment_city'     		=> html_entity_decode($result['payment_city'], ENT_QUOTES, 'UTF-8'),	
					'payment_zone'     		=> html_entity_decode($result['payment_zone'], ENT_QUOTES, 'UTF-8'),						
					'payment_postcode'     	=> $result['payment_postcode'],
					'payment_country'     	=> html_entity_decode($result['payment_country'], ENT_QUOTES, 'UTF-8'),					
					'shipping_company'     	=> html_entity_decode($result['shipping_company'], ENT_QUOTES, 'UTF-8'),	
					'shipping_address'     	=> html_entity_decode($result['shipping_address'], ENT_QUOTES, 'UTF-8'),
					'shipping_city'     	=> html_entity_decode($result['shipping_city'], ENT_QUOTES, 'UTF-8'),
					'shipping_zone'     	=> html_entity_decode($result['shipping_zone'], ENT_QUOTES, 'UTF-8'),					
					'shipping_postcode'     => $result['shipping_postcode'],
					'shipping_country'     	=> html_entity_decode($result['shipping_country'], ENT_QUOTES, 'UTF-8')				
				);
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}	
	
	public function product_autocomplete() {
		$json = array();

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_sku']) or isset($this->request->get['filter_product_id']) or isset($this->request->get['filter_model'])) {
		
		$this->load->model('report/adv_product_purchased');
					
		if (isset($this->request->get['filter_sku'])) {
			$filter_sku = $this->request->get['filter_sku'];
		} else {
			$filter_sku = '';
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = '';
		}
		
		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = '';
		}
		
		$data = array(				
			'filter_sku' 	 			=> $filter_sku,
			'filter_product_id' 	 	=> $filter_product_id,
			'filter_model' 	 			=> $filter_model	
		);
						
		$results = $this->model_report_adv_product_purchased->getProductAutocomplete($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'product_id'     		=> $result['product_id'],
					'prod_sku'     			=> html_entity_decode($result['prod_sku'], ENT_QUOTES, 'UTF-8'),					
					'prod_name'     		=> html_entity_decode($result['prod_name'], ENT_QUOTES, 'UTF-8'),
					'prod_model'     		=> html_entity_decode($result['prod_model'], ENT_QUOTES, 'UTF-8')				
				);
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}

	public function coupon_autocomplete() {
		$json = array();

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_coupon_code'])) {
			
		$this->load->model('report/adv_product_purchased');

		if (isset($this->request->get['filter_coupon_code'])) {
			$filter_coupon_code = $this->request->get['filter_coupon_code'];
		} else {
			$filter_coupon_code = '';
		}
		
		$data = array(		
			'filter_coupon_code' 	 		=> $filter_coupon_code			
		);
						
		$results = $this->model_report_adv_product_purchased->getCouponAutocomplete($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'coupon_id'     		=> $result['coupon_id'],
					'coupon_code'     		=> html_entity_decode($result['coupon_code'], ENT_QUOTES, 'UTF-8')
				);
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}

	public function voucher_autocomplete() {
		$json = array();

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['filter_voucher_code'])) {
			
		$this->load->model('report/adv_product_purchased');

		if (isset($this->request->get['filter_voucher_code'])) {
			$filter_voucher_code = $this->request->get['filter_voucher_code'];
		} else {
			$filter_voucher_code = '';
		}
		
		$data = array(		
			'filter_voucher_code' 	 		=> $filter_voucher_code			
		);
						
		$results = $this->model_report_adv_product_purchased->getVoucherAutocomplete($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'voucher_id'     		=> $result['voucher_id'],
					'voucher_code'     		=> html_entity_decode($result['voucher_code'], ENT_QUOTES, 'UTF-8')
				);
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function IsInstalled() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE code = 'adv_reports'");
		if (empty($query->num_rows)) {
			return false;
		}
		return true;
	}
}
?>