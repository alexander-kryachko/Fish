<?php
class ModelCatalogProduct extends Model {
    public function addProduct($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

        $product_id = $this->db->getLastId();
//pr.statuses
		
		$this->load->model('catalog/product_status');
		$this->model_catalog_product_status->addProductStatuses($product_id, $data);
		

// pr. statuses
		
		
if (isset($data['image_url']) && trim($data['image_url']) != "") {
			$this->load->model('tool/image'); 
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image_url'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");
			$this->model_tool_image->resize($data['image_url'], 100, 100);	
		} else  
        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");

              if (isset($data['def_img']) && $data['def_img'] != "") {
                 $q="UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['def_img']) . "' WHERE product_id = '" . (int)$product_id . "'";
                 $this->db->query($q);
              }


              if (isset($data['def_img']) && $data['def_img'] != "") {
                 $q="UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['def_img']) . "' WHERE product_id = '" . (int)$product_id . "'";
                 $this->db->query($q);
              }

        }

        foreach ($data['product_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
        }
		if (empty($data['keyword'])) $data['keyword'] = trim($this->translitIt($value['name']));
			else $data['keyword'] = trim($this->translitIt($data['keyword']));


        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

                    foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        if (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0 ) {
                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
                        }
                    }else{
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '".$product_option_id."'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int)$product_option['required'] . "'");
                }
            }
        }

        if (isset($data['product_discount'])) {
            foreach ($data['product_discount'] as $product_discount) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
            }
        }

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {

              if ($this->config->get('pim_deletedef') && isset($data['def_img']) && $data['def_img'] == $product_image['image']) { continue;}


              if ($this->config->get('multiimageuploader_deletedef') && isset($data['def_img']) && $data['def_img'] == $product_image['image']) { continue;}

			# OCFilter start
      $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product WHERE product_id = '" . (int)$product_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product_description WHERE product_id = '" . (int)$product_id . "'");

			if (isset($data['ocfilter_product_option'])) {
				foreach ($data['ocfilter_product_option'] as $option_id => $values) {
					foreach ($values['values'] as $value_id => $value) {
						if (isset($value['selected'])) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_to_product SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', value_id = '" . (int)$value_id . "', slide_value_min = '" . (isset($value['slide_value_min']) ? (float)$value['slide_value_min'] : 0) . "', slide_value_max = '" . (isset($value['slide_value_max']) ? (float)$value['slide_value_max'] : 0) . "'");

							foreach ($value['description'] as $language_id => $description) {
								if (trim($description['description'])) {
									$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_to_product_description SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', value_id = '" . (int)$value_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($description['description']) . "'");
								}
							}
						}
					}
				}
			}
			# OCFilter end

			

                if (isset($product_image['image_url']) && trim($product_image['image_url']) != "") {
					$this->load->model('tool/image'); 
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image_url'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
					$this->model_tool_image->resize($product_image['image_url'], 100, 100);	
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
				}  
            }
        }

        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
            }
        }

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
            }
        }

        if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
        } elseif (isset($data['product_category'][0])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_to_category SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
        }
        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
            }
        }

        
    if (isset($data['related_category_status'])){

        $all_related_products = $this->db->query("SELECT *  FROM " . DB_PREFIX . "product_to_category WHERE category_id = " . $data['related_category_id']);

        foreach ($all_related_products->rows as $product_id_all) {
            if (isset($data['product_related'])) {
                
	// RelatedLinks
		foreach ($data['product_related'] as $related_id => $status) {
	// RelatedLinks end
			
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id_all['product_id'] . "' AND related_id = '" . (int)$related_id . "'");
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id_all['product_id'] . "', related_id = '" . (int)$related_id . "'");
                    //$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id_all['product_id'] . "'");
                    //$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id_all['product_id'] . "'");
                }
            }else{
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id_all['product_id'] . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id_all['product_id'] . "'");
            }
        }
    }

    if (isset($data['product_related'])) {
        
	// RelatedLinks
		foreach ($data['product_related'] as $related_id => $status) {
	// RelatedLinks end
			
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");

	// RelatedLinks
		if ((int)$status['sta'] > 0) {
	// RelatedLinks end
			
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
            //
	// RelatedLinks
				}
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				if ((int)$status['sta'] != 1) {
	// RelatedLinks end
			
            //$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");

	// RelatedLinks
				}
	// RelatedLinks end
			
        }
    }
                








        if (isset($data['product_reward'])) {
            foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
            }
        }

        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
                }
            }
        }

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

//BOF Product Series
            //insert product|color
            $this->load->model('catalog/product_special_attribute');
            $this->load->model('catalog/special_attribute');
            if(!isset($data['product_series_image']))
                $data['product_series_image'] = '';

            $data['special_attribute_group_id'] = '2'; //2 is image
            $this->model_catalog_product_special_attribute->editProductSpecialAttribute(array(
                'product_id' => $product_id,
                'special_attribute_id' => $this->model_catalog_special_attribute->getImageId($data)
            ));

            //insert product|master product
            $this->load->model('catalog/product_master');
            $master_product_id = $this->model_catalog_product_master->getMasterProductIdFromData($data);
            if($master_product_id == 0 || $master_product_id > 0) //is either series or series item
            {
                $this->model_catalog_product_master->addLink(array(
                    'product_id' => $product_id,
                    'master_product_id' => $master_product_id,
                    'special_attribute_group_id' => '2' //2 is image
                ));
            }
            //EOF Product Series
        $this->cache->delete('product');
//BOF Product Series
            if(isset($product_id))
                return $product_id;
            //EOF Product Series
    }

	public function editProduct($product_id, $data){ 
		$this->load->model('catalog/product_status');
		$this->model_catalog_product_status->addProductStatuses($product_id, $data);
        $this->db->query("UPDATE " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");
if (isset($data['image_url']) && trim($data['image_url']) != "") {
			$this->load->model('tool/image'); 
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image_url'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");
			$this->model_tool_image->resize($data['image_url'], 100, 100);	
		} else  
        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int)$product_id . "'");

              if (isset($data['def_img']) && $data['def_img'] != "") {
                 $q="UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['def_img']) . "' WHERE product_id = '" . (int)$product_id . "'";
                 $this->db->query($q);
              }


              if (isset($data['def_img']) && $data['def_img'] != "") {
                 $q="UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['def_img']) . "' WHERE product_id = '" . (int)$product_id . "'";
                 $this->db->query($q);
              }

        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

        foreach ($data['product_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "'");
        }
		if (empty($data['keyword'])) $data['keyword'] = trim($this->translitIt($value['name']));
			else $data['keyword'] = trim($this->translitIt($data['keyword']));

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");

        if (!empty($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

                    foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    if (isset($product_option['product_option_value'])  && count($product_option['product_option_value']) > 0 ) {
                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
                        }
                    }else{
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '".$product_option_id."'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int)$product_option['required'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_discount'])) {
            foreach ($data['product_discount'] as $product_discount) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {

              if ($this->config->get('pim_deletedef') && isset($data['def_img']) && $data['def_img'] == $product_image['image']) { continue;}


              if ($this->config->get('multiimageuploader_deletedef') && isset($data['def_img']) && $data['def_img'] == $product_image['image']) { continue;}

			# OCFilter start
		$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product WHERE product_id = '" . (int)$product_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product_description WHERE product_id = '" . (int)$product_id . "'");

			if (isset($data['ocfilter_product_option'])) {
				foreach ($data['ocfilter_product_option'] as $option_id => $values) {
					foreach ($values['values'] as $value_id => $value) {
						if (isset($value['selected'])) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_to_product SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', value_id = '" . (int)$value_id . "', slide_value_min = '" . (isset($value['slide_value_min']) ? (float)$value['slide_value_min'] : 0) . "', slide_value_max = '" . (isset($value['slide_value_max']) ? (float)$value['slide_value_max'] : 0) . "'");

							foreach ($value['description'] as $language_id => $description) {
								if (trim($description['description'])) {
									$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_to_product_description SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', value_id = '" . (int)$value_id . "', language_id = '" . (int)$language_id . "', description = '" . $this->db->escape($description['description']) . "'");
								}
							}
						}
					}
				}
			}
			# OCFilter end

			

                if (isset($product_image['image_url']) && trim($product_image['image_url']) != "") {
					$this->load->model('tool/image'); 
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image_url'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
					$this->model_tool_image->resize($product_image['image_url'], 100, 100);	
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
				}  
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
            }
        }

        if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
        } elseif (isset($data['product_category'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_to_category SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");

        
    if (isset($data['related_category_status'])){

        $all_related_products = $this->db->query("SELECT *  FROM " . DB_PREFIX . "product_to_category WHERE category_id = " . $data['related_category_id']);

        foreach ($all_related_products->rows as $product_id_all) {
            if (isset($data['product_related'])) {
                
	// RelatedLinks
		foreach ($data['product_related'] as $related_id => $status) {
	// RelatedLinks end
			
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id_all['product_id'] . "' AND related_id = '" . (int)$related_id . "'");
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id_all['product_id'] . "', related_id = '" . (int)$related_id . "'");
                    //$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id_all['product_id'] . "'");
                    //$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id_all['product_id'] . "'");
                }
            }else{
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id_all['product_id'] . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id_all['product_id'] . "'");
            }
        }
    }

    if (isset($data['product_related'])) {
        
	// RelatedLinks
		foreach ($data['product_related'] as $related_id => $status) {
	// RelatedLinks end
			
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");

	// RelatedLinks
		if ((int)$status['sta'] > 0) {
	// RelatedLinks end
			
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
            //
	// RelatedLinks
				}
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				if ((int)$status['sta'] != 1) {
	// RelatedLinks end
			
            //$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");

	// RelatedLinks
				}
	// RelatedLinks end
			
        }
    }
                








        $this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_reward'])) {
            foreach ($data['product_reward'] as $customer_group_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

		//BOF Product Series
		//update product|color
		if(isset($data['product_series_image']))
		{
			$this->load->model('catalog/product_special_attribute');
			$this->load->model('catalog/special_attribute');
			$data['special_attribute_group_id'] = '2'; //2 is image
			$this->model_catalog_product_special_attribute->editProductSpecialAttribute(array(
				'product_id' => $product_id,
				'special_attribute_id' => $this->model_catalog_special_attribute->getImageId($data)
			));
		}

		//update product|master product
		$this->load->model('catalog/product_master');
		$master_product_id = $this->model_catalog_product_master->getMasterProductIdFromData($data);

		$this->model_catalog_product_master->editLink(array(
			'product_id' => $product_id,
			'master_product_id' => $master_product_id,
			'special_attribute_group_id' => '2' //2 is image
		));
		//EOF Product Series

		$this->cache->delete('product');

		//BOF Product Series
		if(isset($product_id)) return $product_id;
        //EOF Product Series
    }
	
    public function saveQuantity($product_id,$quantity) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = '" . (int)$quantity. "', date_modified = NOW() WHERE product_id = '". $product_id . "'");

        $query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product WHERE product_id = '". $product_id . "'");
        $row = $query->row;
        return $row['quantity'];
    }	

    public function copyProduct($product_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        if ($query->num_rows) {
            $data = array();

            $data = $query->row;

            $data['sku'] = '';
            $data['upc'] = '';
            $data['viewed'] = '0';
            $data['keyword'] = '';
            $data['status'] = '0';

            $data = array_merge($data, array('product_attribute' => $this->getProductAttributes($product_id)));
            $data = array_merge($data, array('product_description' => $this->getProductDescriptions($product_id)));
            $data = array_merge($data, array('product_discount' => $this->getProductDiscounts($product_id)));
				# OCFilter start
				$this->load->model('catalog/ocfilter');

				$data = array_merge($data, array('ocfilter_option_value_to_product' => $this->model_catalog_ocfilter->getProductOCFilterValues($product_id)));
				# OCFilter end
				
            $data = array_merge($data, array('product_filter' => $this->getProductFilters($product_id)));
            $data = array_merge($data, array('product_image' => $this->getProductImages($product_id)));
            $data = array_merge($data, array('product_option' => $this->getProductOptions($product_id)));
            $data = array_merge($data, array('product_related' => $this->getProductRelated($product_id)));
            $data = array_merge($data, array('product_reward' => $this->getProductRewards($product_id)));
            $data = array_merge($data, array('product_special' => $this->getProductSpecials($product_id)));
            $data = array_merge($data, array('product_category' => $this->getProductCategories($product_id)));
            $data = array_merge($data, array('product_download' => $this->getProductDownloads($product_id)));
            $data = array_merge($data, array('product_layout' => $this->getProductLayouts($product_id)));
            $data = array_merge($data, array('product_store' => $this->getProductStores($product_id)));
			//pr.statuses
					$this->load->model('catalog/product_status');
		$data = array_merge($data, array('product_status' => $this->model_catalog_product_status->getProductStatuses($product_id)));
			//pr.statuses

//BOF Product Series
            $this->load->model('catalog/product_special_attribute');
            $data = array_merge($data, array('product_color' => $this->model_catalog_product_special_attribute->getProductSpecialAttribute($product_id, '2'))); //2 is image
            $data = array_merge($data, array('master_product' => $this->getMasterProductId($product_id, '2'))); //2 is image
            //BOF Product Series
            $this->addProduct($data);
        }
    }

    public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_quantity WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_1c WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
	//promotions
			
 $this->load->model('catalog/promotion');
 $this->model_catalog_promotion->deletePromotionProduct($product_id);
		
	//promotions
	
	//pr.statuses
		$this->load->model('catalog/product_status');
		$this->model_catalog_product_status->deleteProductStatuses($product_id);
		
	//pr.statuses
	
	   //set
		$this->load->model('catalog/set');
		$results = $this->model_catalog_set->getSetsByProductId($product_id);
		if($results){
			foreach($results as $result){
				$results = $this->model_catalog_set->deleteSet($result['set_id']);
			}
		}
	   //set end 
	
        $this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			# OCFilter start
			$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product WHERE product_id = '" . (int)$product_id . "'");
			# OCFilter end
			
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");

//BOF Product Series
            //delete product|color
            $this->load->model('catalog/product_special_attribute');
            $this->model_catalog_product_special_attribute->deleteProductSpecialAttribute(array(
                'product_id' => $product_id
            ));

            //delete product|master product
            $this->load->model('catalog/product_master');
            $this->model_catalog_product_master->deleteLink(array(
                'product_id' => $product_id
            ));
            //EOF Product Series
        $this->cache->delete('product');
//BOF Product Series
            if(isset($product_id))
                return $product_id;
            //EOF Product Series
    }


                public function setAttributeen($product_id, $column_name, $value){
        $this->db->query("UPDATE " . DB_PREFIX . "product SET " . $column_name . " = '" . (int)$value . "' WHERE product_id = '" . (int)$product_id . "'");
    }

public function getMaxModel() {
        $query = $this->db->query("SELECT max(product_id) FROM " . DB_PREFIX . "product");
        return $query->row;
    }
    public function getProduct($product_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }
    public function getProductCatNames($product_id) {
        $query = $this->db->query("SELECT p2c.category_id FROM " . DB_PREFIX . "product_to_category p2c ".
                      "WHERE product_id = '" . (int)$product_id . "' order by category_id");

        $categories = array();
        $this->load->model('catalog/category');
        foreach ($query->rows as $row) {
            $categories[] = $this->model_catalog_category->getCategory($row['category_id']);
        }
        return $categories;
    }
    public function getProducts($data = array()) {
        if ($data) {
            $sql = "SELECT p.*, pd.*,  m.name as 'm_name' FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
                $sql .= " LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)";

            if (!empty($data['filter_category_id'])) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
            }

            $sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            if (!empty($data['filter_name'])) {
                $sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
            }

            if (!empty($data['filter_model'])) {
                $sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_model'])) . "%'";
            }


			if (!empty($data['filter_sku'])) {
				$sql .= " AND LCASE(p.sku) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_sku'])) . "%'";
			}
			
            if (!empty($data['filter_price'])) {
                $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
            }

            if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
                $sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
            }

            if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
                $sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
            }

            if (!empty($data['filter_category_id'])) {
                if (!empty($data['filter_sub_category'])) {
                    $implode_data = array();

                    $implode_data[] = "category_id = '" . (int)$data['filter_category_id'] . "'";

                    $this->load->model('catalog/category');

                    $categories = $this->model_catalog_category->getCategories($data['filter_category_id']);

                    foreach ($categories as $category) {
                        $implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
                    }

                    $sql .= " AND (" . implode(' OR ', $implode_data) . ")";
                } else {
                    if ($data['filter_category_id'] == 'null') {
						$sql .= " AND p2c.category_id is null ";
                    } elseif(is_array($data['filter_category_id'])){
						$sql .= " AND p2c.category_id IN (".implode(',', $data['filter_category_id']).")";
					} else {
						$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
                    }
                }
            }
            if (!empty($data['filter_manufacturer_id'])) {
                $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
            }


            $sql .= " GROUP BY p.product_id";

            $sort_data = array(
                'pd.name',
                'p.model',
 	'p.sku',	
                'p.price',
                'p.quantity',
                'p.status',
                'p.sort_order'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY pd.name";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $product_data = $this->cache->get('product.' . (int)$this->config->get('config_language_id'));

            if (!$product_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.name ASC");

                $product_data = $query->rows;

                $this->cache->set('product.' . (int)$this->config->get('config_language_id'), $product_data);
            }

            return $product_data;
        }
    }
//product relator
public function getProductsByCategoryIdSorted($data = array()) {
					$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
					
					if (!empty($data['filter_category_id'])) {
						$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
					}

					$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
					
					if (!empty($data['filter_name'])) {
						$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					}

					if (!empty($data['filter_model'])) {
						$sql .= " AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
					}
					
					if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
						$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
					}

					if (isset($data['filter_category_id']) && !is_null($data['filter_category_id'])) {
						$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
					}					

					$sql .= " GROUP BY p.product_id";
					
								
					$sort_data = array(
						'pd.name',
						'p.model',
						'p.status',
						'p.sort_order'
					);	
					
					if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
						$sql .= " ORDER BY " . $data['sort'];	
					} else {
						$sql .= " ORDER BY pd.name";	
					}
					
					if (isset($data['order']) && ($data['order'] == 'DESC')) {
						$sql .= " DESC";
					} else {
						$sql .= " ASC";
					}
				
					if (isset($data['start']) || isset($data['limit'])) {
						if ($data['start'] < 0) {
							$data['start'] = 0;
						}				

						if ($data['limit'] < 1) {
							$data['limit'] = 20;
						}	

						$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
					}	
					
					$query = $this->db->query($sql);
				
					return $query->rows;
				}
				
				public function getTotalProductsByCategory($data = array()) {
					$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

					if (!empty($data['filter_category_id'])) {
						$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
					}
					 
					$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
								
					if (!empty($data['filter_name'])) {
						$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					}

					if (!empty($data['filter_model'])) {
						$sql .= " AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
					}
					
					if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
						$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
					}
					
					if (isset($data['filter_category_id']) && !is_null($data['filter_category_id'])) {
						$sql .= " AND p2c.category_id = '" . $this->db->escape($data['filter_category_id']) . "'";
					}
					$query = $this->db->query($sql);
					
					return $query->row['total'];
				}
				
				public function updateRelated($product_id, $data) {

					$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$data['product_id'] . "'");
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$data['product_id'] . "'");

					if (isset($data['selected'])) {
						foreach ($data['selected'] as $related_id) {
							$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$data['product_id'] . "' AND related_id = '" . (int)$related_id . "'");
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$data['product_id'] . "', related_id = '" . (int)$related_id . "'");
							$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$data['product_id'] . "'");
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$data['product_id'] . "'");
						}
					}
					
					if(isset($data['multiway'])) {
						
						if (isset($data['selected'])) {
							foreach ($data['selected'] as $related_id) {
							
								foreach ($data['selected'] as $related_id2) {
									if($related_id != $related_id2) {
										$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$related_id2 . "'");
										$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$related_id2 . "'");
									}
								}
							
							}
						}
					}

					//break;
				}
//product relator
	
    public function getProductsByCategoryId($category_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

        return $query->rows;
    }

    public function getProductDescriptions($product_id) {
        $product_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_description_data[$result['language_id']] = array(
                'seo_title'        => $result['seo_title'],
                'seo_h1'           => $result['seo_h1'],
                'name'             => $result['name'],
                'description'      => $result['description'],
                'meta_keyword'     => $result['meta_keyword'],
                'meta_description' => $result['meta_description'],
                'tag'              => $result['tag']
            );
        }

        return $product_description_data;
    }

    public function getProductCategories($product_id) {
        $product_category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_category_data[] = $result['category_id'];
        }

        return $product_category_data;
    }

    public function getProductFilters($product_id) {
        $product_filter_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_filter_data[] = $result['filter_id'];
        }

        return $product_filter_data;
    }

    public function getProductAttributes($product_id) {
        $product_attribute_data = array();

        $product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");

        foreach ($product_attribute_query->rows as $product_attribute) {
            $product_attribute_description_data = array();

            $product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

            foreach ($product_attribute_description_query->rows as $product_attribute_description) {
                $product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
            }

            $product_attribute_data[] = array(
                'attribute_id'                  => $product_attribute['attribute_id'],
                'product_attribute_description' => $product_attribute_description_data
            );
        }

        return $product_attribute_data;
    }

    public function getProductOptions($product_id) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        foreach ($product_option_query->rows as $product_option) {
            $product_option_value_data = array();

            $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option['product_option_id'] . "'");

            foreach ($product_option_value_query->rows as $product_option_value) {
                $product_option_value_data[] = array(
                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                    'option_value_id'         => $product_option_value['option_value_id'],
                    'quantity'                => $product_option_value['quantity'],
                    'subtract'                => $product_option_value['subtract'],
                    'price'                   => $product_option_value['price'],
                    'price_prefix'            => $product_option_value['price_prefix'],
                    'points'                  => $product_option_value['points'],
                    'points_prefix'           => $product_option_value['points_prefix'],
                    'weight'                  => $product_option_value['weight'],
                    'weight_prefix'           => $product_option_value['weight_prefix']
                );
            }

            $product_option_data[] = array(
                'product_option_id'    => $product_option['product_option_id'],
                'option_id'            => $product_option['option_id'],
                'name'                 => $product_option['name'],
                'type'                 => $product_option['type'],
                'product_option_value' => $product_option_value_data,
                'option_value'         => $product_option['option_value'],
                'required'             => $product_option['required']
            );
        }

        return $product_option_data;
    }

    public function getProductImages($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

        return $query->rows;
    }

    public function getProductDiscounts($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

        return $query->rows;
    }

    public function getProductSpecials($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

        return $query->rows;
    }

    public function getProductRewards($product_id) {
        $product_reward_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
        }

        return $product_reward_data;
    }

    public function getProductDownloads($product_id) {
        $product_download_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_download_data[] = $result['download_id'];
        }

        return $product_download_data;
    }

    public function getProductStores($product_id) {
        $product_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_store_data[] = $result['store_id'];
        }

        return $product_store_data;
    }


	public function getProductQuantity($product_id) {
		$product_quantity_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_quantity WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_quantity_data[] = array(
				'warehouse_id' => $result['warehouse_id'],
				'quantity' => $result['quantity']
			);
		}

		return $product_quantity_data;
	}

		
    public function getProductLayouts($product_id) {
        $product_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $product_layout_data;
    }

    public function getProductMainCategoryId($product_id) {
        $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND main_category = '1' LIMIT 1");

        return ($query->num_rows ? (int)$query->row['category_id'] : 0);
    }

    public function getProductRelated($product_id) {
        $product_related_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $product_related_data[] = $result['related_id'];
        }

        return $product_related_data;
    }


	// RelatedLinks
	public function getProductRelatedLinks($product_id) {
		$product_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE (related_id='" . (int)$product_id . "' OR product_id='" . (int)$product_id . "')  ");

		foreach ($query->rows as $result) {
			if (($result['product_id'] != $product_id) AND (!in_array($result['product_id'], $product_related_data)) ) {
			$product_related_data[] = $result['product_id'];
			}
			if (($result['related_id'] != $product_id) AND (!in_array($result['related_id'], $product_related_data)) ) {
			$product_related_data[] = $result['related_id'];
			}
		}
		return $product_related_data;
	}

	public function getProductRelatedStatus($product_id, $related_id) {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_related WHERE (product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "') XOR (product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "') ");
		$data = $query->row['total'];
		
		if ( $data <2 ) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_related WHERE (product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "') ");
		$data = $query->row['total'];
		
		if ( $data <1 ) {
		$data = 0;
		}
		}
		return $data;
	}
	// RelatedLinks end
			
    public function getTotalProducts($data = array()) {
        $sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

        if (!empty($data['filter_category_id'])) {
            $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
        }

        $sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }

        if (!empty($data['filter_model'])) {
            $sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_model'])) . "%'";
        }


			if (!empty($data['filter_sku'])) {
				$sql .= " AND LCASE(p.sku) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_sku'])) . "%'";
			}
			
        if (!empty($data['filter_price'])) {
            $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
            $sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
        }

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $implode_data = array();

                $implode_data[] = "p2c.category_id = '" . (int)$data['filter_category_id'] . "'";

                $this->load->model('catalog/category');

                $categories = $this->model_catalog_category->getCategories($data['filter_category_id']);

                foreach ($categories as $category) {
                    $implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
                }

                $sql .= " AND (" . implode(' OR ', $implode_data) . ")";
            } else {
                    if ($data['filter_category_id'] == 'null') {
                    $sql .= " AND p2c.category_id is null ";
                    } else {
                    $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
                    }
            }
        }

        if (!empty($data['filter_manufacturer_id'])) {
            $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalProductsByTaxClassId($tax_class_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int)$tax_class_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByStockStatusId($stock_status_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE stock_status_id = '" . (int)$stock_status_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByWeightClassId($weight_class_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE weight_class_id = '" . (int)$weight_class_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByLengthClassId($length_class_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE length_class_id = '" . (int)$length_class_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByDownloadId($download_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByManufacturerId($manufacturer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByAttributeId($attribute_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

        return $query->row['total'];
    }

public function getAllProducts($data = array()) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
            $sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($data['filter_name'])) . "%'";
        }

        if (isset($data['filter_model']) && !is_null($data['filter_model'])) {
            $sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($data['filter_model'])) . "%'";
        }

        if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
            $sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }
    public function getTotalProductsByOptionId($option_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_option WHERE option_id = '" . (int)$option_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsByLayoutId($layout_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

        return $query->row['total'];
    }
	
	//BOF Product Series
	public function getMasterProductId($product_id, $special_attribute_group_id)
	{
		$this->load->model('catalog/product_master');

		return $this->model_catalog_product_master->getMasterProductId($product_id, $special_attribute_group_id);
	}

	//check if a product is a master product (a product which does not link to any other product)
	public function isMaster($product_id, $special_attribute_group_id)
	{
		$this->load->model('catalog/product_master');

		return $this->model_catalog_product_master->isMaster($product_id, $special_attribute_group_id);
	}

	public function getLinkedProducts($product_id, $special_attribute_group_id)
	{
		$linked_product_data = array();

		$master_product_id = $this->getMasterProductId($product_id, $special_attribute_group_id);

		if($master_product_id == -1) //single item
		{
			//do nothing
		}
		else
		{
			if($master_product_id == 0) //this product is a master product
			{
				$master_product_id = $product_id;
			}

			//get all slave products of above master product
			$query = $this->db->query("SELECT p.product_id, "
			. " p.image, "
			. " p.model AS 'product_model', "
			. " pd.name AS 'product_name', "
			. " sa.special_attribute_name, "
			. " sa.special_attribute_value "
			. " FROM " . DB_PREFIX . "product p "
			. " LEFT JOIN " . DB_PREFIX . "product_master pm on pm.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "product_description pd on pd.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa ON psa.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "special_attribute sa ON sa.special_attribute_id = psa.special_attribute_id"
			. " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
			. " WHERE (pm.master_product_id = '" . (int)$master_product_id . "') AND sa.special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");

			foreach ($query->rows as $result) {
				$linked_product_data[] = $result;
			}
		}

		return $linked_product_data;
	}

	//return list of products that can be selected as master product
	//1. does not link to any other master product
	public function isMasterable($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT COUNT(*) AS 'total' FROM "
		. DB_PREFIX . "product p"
		. " LEFT JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id "
		. " WHERE p.product_id NOT IN"
		. " (SELECT product_id FROM " . DB_PREFIX . "product_master"
		. " WHERE special_attribute_group_id = '" . (int)$special_attribute_group_id . "'"
		. " AND master_product_id > 0)"
		. " AND p.product_id = '" . (int)$product_id . "'"
		. " ORDER BY pd.name ASC");

		return (int)($query->row['total']) > 0;
	}
	//EOF Product Series
			
	function translitIt($str)
	{
		$tr = array(
			"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
			"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
			"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
			"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
			"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
			"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
			"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
			" "=> "-", "/"=> "-", "'"=> "", "&quot;"=> "",
			"№" => "", "#" => "", "Ø" => "", //"."=> "", 
			);			
		$result = strtr($str,$tr);
		//if ($_SERVER['REMOTE_ADDR'] == '77.122.7.164'){
			$result = preg_replace('/[^a-z0-9_\.,-]/uis', '', $result);
		//	echo $result;
		//}
		return $result;
	}
}
?>