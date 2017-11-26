<?php
class ControllerFeedGoogleProductFeed extends Controller {
	public function index() {
	
		if(!defined('HTTP_IMAGE')) {
			define('HTTP_IMAGE', HTTP_SERVER . 'image/');
		}
		if(!defined('HTTPS_IMAGE')) {
			define('HTTPS_IMAGE', HTTPS_SERVER . 'image/');
		}

		$this->load->model('feed/google_product_feed');
		$ssl = $this->model_feed_google_product_feed->getSSL(VERSION);

		if ($this->config->get('google_product_feed_status')) {

			$this->load->model('catalog/category');
			$this->load->model('tool/image');
			
			$mobile_url = $this->config->get('gpf_mobile_url');
			$seo_url = $this->config->get('config_seo_url');
			
			$nl = "\n";
			$nt = "\n"; //"\n\t";
			$ntt = "\n"; //"\n\t\t";
			$output  = '<?xml version="1.0" encoding="UTF-8"?>';
			$output .= $nl.'<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
            $output .= $nl.'<channel>';
			$output .= $nl.'<title><![CDATA[' . $this->config->get('config_name') . ']]></title>';
			$output .= $nl.'<description><![CDATA[' . $this->config->get('config_meta_description') . ']]></description>';
			$output .= $nl.'<link><![CDATA[' . ($ssl == 1 ? HTTPS_SERVER : HTTP_SERVER) . ']]></link>';


			$oos = $this->getOosStatus();
			$language_code = $this->model_feed_google_product_feed->getLanguageCode();
			$currency = $this->config->get('google_product_feed_currency');
			if(!$this->model_feed_google_product_feed->isInstalled($currency)) {
				$cni = 'Google Product Feed Currency is Not Installed !';
			}
			
			$products = $this->model_feed_google_product_feed->getProducts($language_code);
			if ($products) {
				foreach ($products as $product) {
					$product_variants_array = $this->getProductVariants($product['product_id']);
						if(empty($product_variants_array)) {
							// Output Regular Item details
							$output .= $nl.$nl.$nt.'<item>';
							$output .= $ntt.'<title><![CDATA[' . html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8') . ']]></title>';
							
							$output .= $ntt.'<link><![CDATA[' . html_entity_decode($this->url->link('product/product', 'product_id=' . $product['product_id']) . ($product['adwords_redirect'] ? '&source=google_shopping&grouping=' . $product['adwords_grouping'] : '')) . ']]></link>';
							if($mobile_url != '') {
								$output .= $ntt.'<mobile_link><![CDATA[' . $mobile_url . 'index.php?route=product/product&product_id=' . $product['product_id'] . ($product['adwords_redirect'] ? '&source=google_shopping&grouping=' . html_entity_decode($product['adwords_grouping']) : '') . ']]></mobile_link>';
							}
							if($product['description']) {
								$output .= $ntt.'<description><![CDATA[' . mb_substr(trim(strip_tags(html_entity_decode($product['description']))), 0, 4994, 'UTF-8') . ' . . .]]></description>';
							}
							$output .= $ntt.'<g:id><![CDATA[' . $product['product_id'] . ']]></g:id>';
							$output .= $ntt.'<g:condition><![CDATA['.html_entity_decode($product['condition'], ENT_QUOTES, 'UTF-8') . ']]></g:condition>';
							$output .= $ntt.'<g:google_product_category><![CDATA['.html_entity_decode($product['google_product_category'], ENT_QUOTES, 'UTF-8') . ']]></g:google_product_category>';

							if ($product['image']) {
								$output .= $ntt.'<g:image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . $product['image'] . ']]></g:image_link>';
							} else {
								$output .= $ntt.'<g:image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . 'no_image.jpg' . ']]></g:image_link>';
							}

							$additional_images = $this->model_feed_google_product_feed->getProductImages($product['product_id']);
							
							if($additional_images) {
								$image_ctr = 1;
								foreach ($additional_images as $additional_image) {
									if ($image_ctr <= 10) {
										$output .= $ntt.'<g:additional_image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . $additional_image['image'] . ']]></g:additional_image_link>';
									} else {
										break;								
									}
									$image_ctr ++;							
								}
							}
							
							if($product['identifier_exists'] =='FALSE') {
								$output .= $ntt.'<g:identifier_exists><![CDATA[' . html_entity_decode($product['identifier_exists'], ENT_QUOTES, 'UTF-8') . ']]></g:identifier_exists>';
							}
							if($product['gpf_is_bundle'] === "TRUE") {
								$output .= $ntt.'<g:is_bundle><![CDATA[' . html_entity_decode($product['gpf_is_bundle'], ENT_QUOTES, 'UTF-8') . ']]></g:is_bundle>';
							}
							if($product['gtin'] !="") {
								$output .= $ntt.'<g:gtin><![CDATA[' . html_entity_decode($product['gtin'], ENT_QUOTES, 'UTF-8') . ']]></g:gtin>';
							}
							if($product['brand'] !="") {
								$output .= $ntt.'<g:brand><![CDATA[' . html_entity_decode($product['brand'], ENT_QUOTES, 'UTF-8') . ']]></g:brand>';
							}
							if($product['mpn'] !="") {
								$output .= $ntt.'<g:mpn><![CDATA[' . html_entity_decode($product['mpn'], ENT_QUOTES, 'UTF-8') . ']]></g:mpn>';
							}
							if($product['gender'] !="Not Applicable" && $product['gender'] !="") {
								$output .= $ntt.'<g:gender><![CDATA[' . html_entity_decode($product['gender'], ENT_QUOTES, 'UTF-8') . ']]></g:gender>';
							}
							if($product['agegroup'] !="Not Applicable" && $product['agegroup'] !="") {
								$output .= $ntt.'<g:age_group><![CDATA[' . html_entity_decode($product['agegroup'], ENT_QUOTES, 'UTF-8') . ']]></g:age_group>';
							}
							if($product['colour'] !="") {
								$output .= $ntt.'<g:color><![CDATA[' . html_entity_decode($product['colour'], ENT_QUOTES, 'UTF-8') . ']]></g:color>';
							}
							if($product['size'] !="") {
								$output .= $ntt.'<g:size><![CDATA[' . html_entity_decode($product['size'], ENT_QUOTES, 'UTF-8') . ']]></g:size>';
							}

							if($product['gpf_size_system'] !="" && $product['gpf_size_system'] !="Not Applicable") {
								$output .= $ntt.'<g:size_system><![CDATA[' . html_entity_decode($product['gpf_size_system'], ENT_QUOTES, 'UTF-8') . ']]></g:size_system>';
							}

							if($product['gpf_size_type'] !="" && $product['gpf_size_type'] !="Not Applicable") {
								$output .= $ntt.'<g:size_type><![CDATA[' . html_entity_decode($product['gpf_size_type'], ENT_QUOTES, 'UTF-8') . ']]></g:size_type>';
							}

							if($product['adwords_grouping'] !="") {
								$output .= $ntt.'<g:adwords_grouping><![CDATA[' . html_entity_decode($product['adwords_grouping'], ENT_QUOTES, 'UTF-8') . ']]></g:adwords_grouping>';
							}

							if($product['adwords_labels'] !="") {
								$first = true;
								$labels = explode(',', $product['adwords_labels']);
								foreach ($labels as $label) {
									if ($first) {
										$output .= $ntt.'<g:adwords_labels><![CDATA[' . trim($label) . ']]></g:adwords_labels>';
										$first = false;
									} else {
										$output .= ',<g:adwords_labels><![CDATA[' . trim($label) . ']]></g:adwords_labels>';
									}
								}
							}

							if($product['custom_labels'] !="") {
								$labels = explode(',', $product['custom_labels']);
								for ($i=0; $i<=4; $i++) {
									if ($labels[$i] !='' && $labels[$i] != 'Not Applicable') {
										$output .= $ntt.'<g:custom_label_' . $i . '><![CDATA[' . trim($labels[$i]) . ']]></g:custom_label_' . $i . '>';
									}
								}
							}

							if(isset($cni)) {
									$output .= $ntt.'<g:price><![CDATA[' . $cni . ']]></g:price>';
							
							} elseif ($currency != 'USD') {
									$output .= $ntt.'<g:price><![CDATA[' . $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency, false, false) . ' ' . $currency . ']]></g:price>';
							
							} else {
									$output .= $ntt.'<g:price><![CDATA[' . $this->currency->format($product['price'], $currency, false, false) . ' ' . $currency . ']]></g:price>';
							}

							$special_dates = $this->getProductSpecialDates($product['product_id']);

							if ($product['special']) {
								if(isset($cni)) {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $cni . ']]></g:sale_price>';
								
								} elseif ($currency != 'USD') {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id']), $currency, false, false) . ' ' . $currency . ']]></g:sale_price>';
								
								} else {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $this->currency->format($product['special'], $currency, false, false) . ' ' . $currency . ']]></g:sale_price>';
								}

								$output .= $ntt.'<g:sale_price_effective_date><![CDATA[' .  $special_dates['date_start'] . 'T00:00:00' . date('O') . '/' . $special_dates['date_end'] . 'T23:59:59' . date('O') . ']]></g:sale_price_effective_date>';
							}

							$categories = $this->model_feed_google_product_feed->getCategories($product['product_id']);
							$count = 0;
							foreach ($categories as $category) {
							if ($count == 10) {
								break;
							}
								$path = $this->getPath($category['category_id']);

								if ($path) {
									$string = '';

									foreach (explode('_', $path) as $path_id) {
										$category_info = $this->model_catalog_category->getCategory($path_id);

										if ($category_info) {
											if (!$string) {
												$string = $category_info['name'];
											} else {
												$string .= ' &gt; ' . $category_info['name'];
											}
										}
									}

									$output .= $ntt.'<g:product_type><![CDATA[' . $string . ']]></g:product_type>';
									$count++;
								}
							}
							if($product['quantity'] > 0) {
								$output .= $ntt.'<g:availability><![CDATA[in stock]]></g:availability>';
							} else {
								$output .= $ntt.'<g:availability><![CDATA[' . $product['oos_status'] . ']]></g:availability>';
							}
							if($product['quantity'] <= 0 && $product['oos_status'] == 'Preorder' && $product['gpf_availability_date'] != '') {
								$output .= $ntt.'<g:availability_date><![CDATA[' . $product['gpf_availability_date'] . 'T' . $product['gpf_availability_time'] . date('O') . ']]></g:availability_date>';
							}
							if($product['weight'] > 0) {
								$output .= $ntt.'<g:shipping_weight><![CDATA[' . $this->weight->format($product['weight'], $product['weight_class_id']) . ']]></g:shipping_weight>';
							}
							
							$output .= $nt.'</item>';
						} else {
						//Output Product Variants
							$ctr = 0;
							foreach($product_variants_array as $product_variant){
								
								$output .= $nl.$nl.$nt.'<item>';
								$output .= $ntt.'<title><![CDATA[' . html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8') . ']]></title>';
								
								$output .= $ntt.'<link><![CDATA[' . html_entity_decode($this->url->link('product/product', 'product_id=' . $product['product_id']) . ($product['adwords_redirect'] ? '&source=google_shopping&grouping=' . $product['adwords_grouping'] : '')) . ']]></link>';
								if($mobile_url != '') {
									$output .= $ntt.'<mobile_link><![CDATA[' . $mobile_url . 'index.php?route=product/product&product_id=' . $product['product_id'] . ($product['adwords_redirect'] ? '&source=google_shopping&grouping=' . html_entity_decode($product['adwords_grouping']) : '') . ']]></mobile_link>';
								}

								if($product['description']) {
									$output .= $ntt.'<description><![CDATA[' . mb_substr(trim(strip_tags(html_entity_decode($product['description']))), 0, 4994, 'UTF-8') . ' . . .]]></description>';
								}
								// product id needs -1, -2 etc. adding
								$output .= $ntt.'<g:item_group_id><![CDATA[' . $product['product_id'] . ']]></g:item_group_id>';
								$output .= $ntt.'<g:id><![CDATA[' . $product['product_id'] . '-' . ($ctr+1) . ']]></g:id>';
								$output .= $ntt.'<g:condition><![CDATA['.html_entity_decode($product['condition'], ENT_QUOTES, 'UTF-8') . ']]></g:condition>';
								$output .= $ntt.'<g:google_product_category><![CDATA['.$product['google_product_category']. ']]></g:google_product_category>';

								if ($product_variant['image'] && $product_variant['image'] == 'no_image.jpg') {
									$product_variant['image'] = NULL;
								}
								
								if ($product['image'] || $product_variant['image']) {
									$output .= $ntt.'<g:image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . ($product_variant['image'] ? $product_variant['image'] : $product['image']) . ']]></g:image_link>';
								} else {
									$output .= $ntt.'<g:image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . 'no_image.jpg' . ']]></g:image_link>';
								}

								$additional_images = $this->model_feed_google_product_feed->getProductImages($product['product_id']);
								
								if($additional_images) {
									$image_ctr = 1;
									foreach ($additional_images as $additional_image) {
										if ($image_ctr <= 10) {
											$output .= $ntt.'<g:additional_image_link><![CDATA[' . ($ssl == 1 ? HTTPS_IMAGE : HTTP_IMAGE) . $additional_image['image'] . ']]></g:additional_image_link>';
										} else {
											break;								
										}
										$image_ctr ++;							
									}
								}
								
								if($product['identifier_exists'] =='FALSE') {
									$output .= $ntt.'<g:identifier_exists><![CDATA[' . html_entity_decode($product['identifier_exists'], ENT_QUOTES, 'UTF-8') . ']]></g:identifier_exists>';
								}
								if($product['gpf_is_bundle'] === "TRUE") {
									$output .= $ntt.'<g:is_bundle><![CDATA[' . html_entity_decode($product['gpf_is_bundle'], ENT_QUOTES, 'UTF-8') . ']]></g:is_bundle>';
								}
								if($product['gtin'] !="") {
									$output .= $ntt.'<g:gtin><![CDATA[' . html_entity_decode($product['gtin'], ENT_QUOTES, 'UTF-8') . ']]></g:gtin>';
								}
								if($product['brand'] !="") {
									$output .= $ntt.'<g:brand><![CDATA[' . html_entity_decode($product['brand'], ENT_QUOTES, 'UTF-8') . ']]></g:brand>';
								}
								if(isset($product_variant['mpn']) && $product_variant['mpn'] !="") {
									$output .= $ntt.'<g:mpn><![CDATA[' . html_entity_decode($product_variant['mpn'], ENT_QUOTES, 'UTF-8') . ']]></g:mpn>';
								} elseif($product['mpn'] !="") {
									$output .= $ntt.'<g:mpn><![CDATA[' . html_entity_decode($product['mpn'], ENT_QUOTES, 'UTF-8') . ']]></g:mpn>';
								}
								if($product['gender'] !="Not Applicable" && $product['gender'] !="") {
									$output .= $ntt.'<g:gender><![CDATA[' . html_entity_decode($product['gender'], ENT_QUOTES, 'UTF-8') . ']]></g:gender>';
								}
								if($product['agegroup'] !="Not Applicable" && $product['agegroup'] !="") {
									$output .= $ntt.'<g:age_group><![CDATA[' . html_entity_decode($product['agegroup'], ENT_QUOTES, 'UTF-8') . ']]></g:age_group>';
								}
								if($product['colour'] !="") {
									$output .= $ntt.'<g:color><![CDATA[' . html_entity_decode($product['colour'], ENT_QUOTES, 'UTF-8') . ']]></g:color>';
								}
								if($product['size'] !="") {
									$output .= $ntt.'<g:size><![CDATA[' . html_entity_decode($product['size'], ENT_QUOTES, 'UTF-8') . ']]></g:size>';
								}
								if($product_variant['size'] !="") {
									$output .= $ntt.'<g:size><![CDATA[' . html_entity_decode($product_variant['size'], ENT_QUOTES, 'UTF-8') . ']]></g:size>';
								}
								if($product['gpf_size_system'] !="" && $product['gpf_size_system'] !="Not Applicable") {
									$output .= $ntt.'<g:size_system><![CDATA[' . html_entity_decode($product['gpf_size_system'], ENT_QUOTES, 'UTF-8') . ']]></g:size_system>';
								}

								if($product['gpf_size_type'] !="" && $product['gpf_size_type'] !="Not Applicable") {
									$output .= $ntt.'<g:size_type><![CDATA[' . html_entity_decode($product['gpf_size_type'], ENT_QUOTES, 'UTF-8') . ']]></g:size_type>';
								}

								if($product_variant['colour'] !="") {
									$output .= $ntt.'<g:color><![CDATA[' . html_entity_decode($product_variant['colour'], ENT_QUOTES, 'UTF-8') . ']]></g:color>';
								}
								if($product_variant['pattern'] !="") {
									$output .= $ntt.'<g:pattern><![CDATA[' . html_entity_decode($product_variant['pattern'], ENT_QUOTES, 'UTF-8') . ']]></g:pattern>';
								}
								if($product_variant['material'] !="") {
									$output .= $ntt.'<g:material><![CDATA[' . html_entity_decode($product_variant['material'], ENT_QUOTES, 'UTF-8') . ']]></g:material>';
								}

								if($product['adwords_grouping'] !="") {
									$output .= $ntt.'<g:adwords_grouping><![CDATA[' . html_entity_decode($product['adwords_grouping'], ENT_QUOTES, 'UTF-8') . ']]></g:adwords_grouping>';
								}

								if($product['adwords_labels'] !="") {
									$first = true;
									$labels = explode(',', $product['adwords_labels']);
									foreach ($labels as $label) {
										if ($first) {
											$output .= $ntt.'<g:adwords_labels><![CDATA[' . trim($label) . ']]></g:adwords_labels>';
											$first = false;
										} else {
											$output .= ',<g:adwords_labels><![CDATA[' . trim($label) . ']]></g:adwords_labels>';
										}
									}
								}

								if($product['custom_labels'] !="") {
									$labels = explode(',', $product['custom_labels']);
									for ($i=0; $i<=4; $i++) {
										if ($labels[$i] !='' && $labels[$i] != 'Not Applicable') {
											$output .= $ntt.'<g:custom_label_' . $i . '><![CDATA[' . trim($labels[$i]) . ']]></g:custom_label_' . $i . '>';
										}
									}
								}

								if(isset($cni)) {
										$output .= $ntt.'<g:price><![CDATA[' . $cni . ']]></g:price>';
								
								} elseif ($currency != 'USD') {
										$output .= $ntt.'<g:price><![CDATA[' . $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency, false, false) . ' ' . $currency . ']]></g:price>';
								
								} else {
										$output .= $ntt.'<g:price><![CDATA[' . $this->currency->format($product['price'], $currency, false, false) . ' ' . $currency . ']]></g:price>';
								}

								$special_dates = $this->getProductSpecialDates($product['product_id']);

							if ($product['special']) {
								if(isset($cni)) {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $cni . ']]></g:sale_price>';
								
								} elseif ($currency != 'USD') {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id']), $currency, false, false) . ' ' . $currency . ']]></g:sale_price>';
								
								} else {
										$output .= $ntt.'<g:sale_price><![CDATA[' . $this->currency->format($product['special'], $currency, false, false) . ' ' . $currency . ']]></g:sale_price>';
								}
								$output .= $ntt.'<g:sale_price_effective_date><![CDATA[' .  $special_dates['date_start'] . 'T00:00:00' . date('O') . '/' . $special_dates['date_end'] . 'T23:59:59' . date('O') . ']]></g:sale_price_effective_date>';
							}

								$categories = $this->model_feed_google_product_feed->getCategories($product['product_id']);
								$count = 0;
								foreach ($categories as $category) {
									if ($count ==10) {
										break;
									}
									$path = $this->getPath($category['category_id']);

									if ($path) {
										$string = '';

										foreach (explode('_', $path) as $path_id) {
											$category_info = $this->model_catalog_category->getCategory($path_id);

											if ($category_info) {
												if (!$string) {
													$string = $category_info['name'];
												} else {
													$string .= ' &gt; ' . $category_info['name'];
												}
											}
										}

										$output .= $ntt.'<g:product_type><![CDATA[' . $string . ']]></g:product_type>';
										$count++;
									}
								}
								if($product['quantity'] > 0) {
									$output .= $ntt.'<g:availability><![CDATA[in stock]]></g:availability>';
								} else {
									$output .= $ntt.'<g:availability><![CDATA[' . $product['oos_status'] . ']]></g:availability>';
								}
								if($product['quantity'] <= 0 && $product['oos_status'] == 'Preorder') {
									$output .= $ntt.'<g:availability_date><![CDATA[' . $product['availability_date'] . 'T' . $product['gpf_availability_time'] . date('O') . ']]></g:gpf_availability_date>';
								}
								if($product['weight'] > 0) {
									$output .= $ntt.'<g:shipping_weight><![CDATA[' . $this->weight->format($product['weight'], $product['weight_class_id']) . ']]></g:shipping_weight>';
								}
								
								$output .= $nt.'</item>';
								$ctr++;
							}
							
							
						}
					
				}
			} else {
				$output = 'No products enabled for Google Shopping';
			}
			
			if ($products) {
				$output .= $nl.$nl.$nl.'</channel>';
				$output .= $nl.'</rss>';
			}
			
//			$this->writeFile($output);

			$this->response->addHeader('Content-Type: application/rss+xml');
			$this->response->setOutput($output, 0);
		}
	}
	

	protected function getPath($parent_id, $current_path = '') {
		$category_info = $this->model_catalog_category->getCategory($parent_id);

		if ($category_info) {
			if (!$current_path) {
				$new_path = $category_info['category_id'];
			} else {
				$new_path = $category_info['category_id'] . '_' . $current_path;
			}

			$path = $this->getPath($category_info['parent_id'], $new_path);

			if ($path) {
				return $path;
			} else {
				return $new_path;
			}
		}
	}
	
		public function getProductSpecialDates($product_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");
		
		if ($query->num_rows) {
			if ($query->row['date_start'] == '0000-00-00') {
				$query->row['date_start'] = date("Y-m-d");
			}
			if ($query->row['date_end'] == '0000-00-00') {
				$query->row['date_end'] = date("Y-m-d", strtotime('+1 Week'));
			}
			
			return $query->row;
		} else {
			return FALSE;
		}
	}

		public function getOosStatus() {
		
		$data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `key` = 'oos_status'");
		
		foreach ($query->rows as $result) {
			$data[$result['key']] = $result['value'];
		}
				
		return $data['oos_status'];
	}

	public function getProductVariants($product_id) {
		$query = $this->db->query("SELECT variants FROM " . DB_PREFIX . "product_variants WHERE product_id = '" . (int)$product_id . "'");	
		
		if ($query->num_rows) {
			foreach ($query->rows as $result){
				$data = array();
				$data = unserialize($result['variants']);
			}
			
		} else {
			$data = FALSE;
		}
		return $data;
	}

	public function decode_variants($data) {
		$separator = '|';
		$variant = array();
		$size_data = array();
		$colour_data = array();
		$pattern_data = array();
		$material_data = array();
		$variant_data = explode($separator, $data);
		$ctr = 0;
		$i = 0;
		foreach ($variant_data as $v) {
			switch ($ctr) {
				case 0:
					$size_data[$i] = $v;
					break;
				case 1:
					$colour_data[$i] = $v;
					break;
				case 2:
					$pattern_data[$i] = $v;
					break;
				case 3:
					$material_data[$i] = $v;
					break;
			}
			$ctr++;
			if($ctr ==4) {
				$ctr = 0;
				$i++;
			}
		}
		$variant['size'] = $size_data;
		$variant['colour'] = $colour_data;
		$variant['pattern'] = $pattern_data;
		$variant['material'] = $material_data;
		
		return $variant;
	}

	public function writeFile($output) {
	
		$fp = fopen('feed.xml', 'w');
		fwrite ($fp, $output);
		fclose($fp);
	}

	

}
?>