<?php
class ModelCatalogImageSearch extends Model {

  private $error = array();  
  
	public function getProducts($data = array()) {
		if ($data) {
			$sql = "SELECT p.*, pd.* ";

    	if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
  			$sql .= ", pi.image as pi_image";			
  		}
			
			$sql .= " FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

    	if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
  			$sql .= " LEFT JOIN " . DB_PREFIX . "product_image pi ON (p.product_id = pi.product_id)";			
  		}
						
			if (!empty($data['filter_category_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
			}
					
			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
						
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}

			if (isset($data['filter_stock_status_id']) && !is_null($data['filter_stock_status_id'])) {
				$sql .= " AND p.stock_status_id = '" . (int)$data['filter_stock_status_id'] . "'";
			}

			if (isset($data['filter_image']) && !is_null($data['filter_image'])) {			
			  switch($data['filter_image']) {
			    case 0:
			      $sql .= " AND p.image = '' AND pi.image is NULL ";    
			      break;
			    case 1:
			      $sql .= " AND p.image != '' AND pi.image != ''";    
			      break;
			    case 2:
			      $sql .= " AND p.image != '' AND pi.image is NULL ";    
			      break;			  
			  }				
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
					$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				}
			}
			
			$sql .= " GROUP BY p.product_id";
						
			$sort_data = array(
				'pd.name',
				'p.model',
				'p.price',
				'p.quantity',
				'p.status',
				'p.sort_order',
				'p.date_added'
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
					$data['limit'] = 1;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	

			$query = $this->db->query($sql);
		  
			return $query->rows;			
			
		} else {
			$product_data = $this->cache->get('product.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));
		
			if (!$product_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_image pi ON (p.product_id = pi.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.name ASC");
	
				$product_data = $query->rows;
			
				$this->cache->set('product.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $product_data);
			}	
	
			return $product_data;
		}
	}
	
	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

  	if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_image pi ON (p.product_id = pi.product_id)";			
		}
						
		if (!empty($data['filter_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
		}
					
		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
						
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_stock_status_id']) && !is_null($data['filter_stock_status_id'])) {
			$sql .= " AND p.stock_status_id = '" . (int)$data['filter_stock_status_id'] . "'";
		}
			
		if (isset($data['filter_image']) && !is_null($data['filter_image'])) {			
		  switch($data['filter_image']) {
		    case 0:
		      $sql .= " AND p.image = '' AND pi.image is NULL ";    
		      break;
		    case 1:
		      $sql .= " AND p.image != '' AND pi.image != ''";    
		      break;
		    case 2:
		      $sql .= " AND p.image != '' AND pi.image is NULL ";    
		      break;			  
		  }				
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
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	

	
	public function getAllCategoriesArr($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name'        => $parent_name . $category['name']
				);

				$output += $this->getAllCategoriesArr($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		return $output;
	}
	
	// we must copy this function from model_catalog_category becouse it not exists in 1.5.1.3 and 1.5.2.1 versions 
	public function getAllCategories() {
		$category_data = $this->cache->get('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));

		if (!$category_data || !is_array($category_data)) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

			$category_data = array();
			foreach ($query->rows as $row) {
				$category_data[$row['parent_id']][$row['category_id']] = $row;
			}

			$this->cache->set('category.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $category_data);
		}

		return $category_data;
	}

	public function getImageStatuses() {
	  $this->load->language('catalog/image_search');

	  return array(
	    array( 'image_status_id' => '0', 
	      'name' => $this->language->get('image_status_no_image')),
	    array( 'image_status_id' => '1', 
	      'name' => $this->language->get('image_status_all_images')),
	    array( 'image_status_id' => '2', 
	      'name' => $this->language->get('image_status_only_main')),
	  );  
	  
	}
	
  public function updateImages($post_arr) {
    
    if (!is_array($post_arr)) {
      return false;
    }

    $this->load->language('catalog/image_search');    
    
    foreach ($post_arr as $nid => &$values) {
      
      if (!isset($values['url'])     || !is_array($values['url']) ||
          !isset($values['deleted']) || !is_array($values['deleted']) ||
          !isset($values['main'])    || !is_array($values['main'])) {
        continue;    
      }
      
      $main_image = '';
      foreach ($values['url'] as $image_key => &$value) {
        
        // download remote image
        if (strpos($value, 'http') === 0) {
        
          $image = $this->saveImage($value, $nid);
          
          if (!$image) {          
            $value = "";
          }
          else if (!$this->isImage(DIR_IMAGE . $image)) {            
            $this->unlinkFile(DIR_IMAGE . $image);
            $this->setError($value . " : " . $this->language->get('error_unlink_file_not_image'));
            $value = "";
          }
          else {
            $value = $image;
          }
          
        }  
       
        $unset = false;
        if (!$value || $value == 'no_image.jpg' || !file_exists(DIR_IMAGE . $value)) {
          $unset = true;                           
        } 
        else if ($values['deleted'][$image_key]) {
          $unset = true;
        }
        else if ($values['main'][$image_key]) {
          $main_image = $value;
          $unset = true;
        }
        
        if ($unset) {
          unset($values['url'][$image_key]);
          unset($values['deleted'][$image_key]);
          unset($values['main'][$image_key]);        
        }        
        
      }
      
      // if not is set main image get main image from first image
      if (!$main_image && $values['url']) {
        reset($values['url']);
        $main_image = current($values['url']);
        $key = key($values['url']);
        unset($values['url'][$key]);
        unset($values['deleted'][$key]);
        unset($values['main'][$key]);                
      }
      
      $this->updateMainImageDb($nid, $main_image, $values['url']);
      
      $this->updateImagesDb($nid, $values['url'], $main_image);
      
    }
    
  }
  
  public function updatePath($image_path) {

    if (!isset($image_path['select'])) {
      $image_path['select'] = '';
    }

    if (!isset($image_path['text'])) {
      $image_path['text'] = '';
    }
    
    if (!$image_path['select'] && !$image_path['text']) {
      return false;
    }
        
    $options = $this->config->get('image_search_options');
    $path = $image_path['select'] ? $image_path['select'] : 'data';
    
    if ($image_path['text']) {
      if (is_dir(DIR_IMAGE . $path . '/' . $image_path['text'])
        || ( is_writable(DIR_IMAGE . $path) 
        && @mkdir(DIR_IMAGE . $path . '/' . $image_path['text'], 0777, true))) {
        
        $path .= '/' . $image_path['text'];
        
        $this->cache->delete('category.tree.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). md5(DIR_IMAGE . 'data'));
        
      }
      else {
        $this->setError($image_path['text'] . " : " . $this->language->get('error_cant_create_directory'));
      }
    }
    
    if ($path != $options['image_path'] && is_dir(DIR_IMAGE . $path)) {
      
      $options['image_path'] = $path;
      $setting['image_search_options'] = $options;
      
      $this->load->model('setting/setting');
		  $this->model_setting_setting->editSetting('image_search', $setting);      
		  
		  $this->config->set('image_search_options', $options);
    }
    
  }
  
  private function saveImage($imgUrl, $nid){
	  
	  $options = $this->config->get('image_search_options');
	  $img = $this->curlGetFileContents($imgUrl);

	  if (!$img) {
	    $this->setError($imgUrl . " : " . $this->language->get('error_unlink_file_not_loaded'));
		  return false;						
	  }
	
    $ext = strtolower(substr($imgUrl, strrpos($imgUrl, ".") + 1));
		if (strpos($ext, "?") !== false){
  		$ext = substr($ext, 0, strpos($ext, "?"));
		}
		$allow_ext = array('gif', 'jpeg', 'jpg', 'png', 'bmp');
		if(!$ext || !in_array($ext, $allow_ext)) {
	    $this->setError($ext . " : " . $this->language->get('error_ext_not_support'));
		  return false;								
		}

	  $file_name = $nid . "_" . md5(microtime() . $imgUrl) . "." . $ext;
	  $image_path = isset($options['image_path']) && $options['image_path'] ? $options['image_path'] . '/' : 'data/';
	  $full_path = DIR_IMAGE . $image_path;			

	  if (!is_writable($full_path)) {
	    $this->setError($full_path . " : " . $this->language->get('error_unlink_directory_not_writable'));
	    return false;
	  }
	  
	  $file = @fopen($full_path . $file_name, "w");
				
	  if (!$file ){
	    $this->setError($file_name . " : " . $this->language->get('error_unlink_save_file'));
		  return false;
	  }
	
	  fputs ($file, $img);
  	fclose($file);
    
    return $image_path . $file_name;
  }  

	private function curlGetFileContents($url) {
    
    $options = $this->config->get('image_search_options');
    $timeout = isset($options['server_timeout']) && $options['server_timeout'] ? (int)$options['server_timeout'] : 2000;

  	$c = curl_init();
	  
	  if (!defined('CURLOPT_TIMEOUT_MS')) define('CURLOPT_TIMEOUT_MS', 156);
	  
	  curl_setopt($c, CURLOPT_HEADER, 0);
	  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($c, CURLOPT_URL, $url);
	  curl_setopt($c, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
	  curl_setopt($c, CURLOPT_REFERER, 'http://www.google.com/bot.html'); 
	  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
	  curl_setopt($c, CURLOPT_TIMEOUT_MS, $timeout);
	  // TRUE to follow any "Location: "
	  curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	  // The maximum amount of HTTP redirections to follow
	  curl_setopt($c, CURLOPT_MAXREDIRS, 5);
	
	  $contents = curl_exec($c);
	  
	  if(curl_errno($c)) {
      $this->setError("CURL error: " . curl_error($c));
    }
    
	  curl_close($c);
	  
	  return ($contents) ? $contents : false;	
  }

  public function isImage($file) {
    if (!$file) {
      return false;
    }
    
    if (function_exists( 'exif_imagetype' )) {
      if (filesize($file) > 11 && @exif_imagetype($file) !== false) {
        return true;
      }
      else {
        return false;
      }    
    }
  
    if (function_exists( 'getimagesize' )) {
    
      $a = @getimagesize($file);
      $image_type = $a[2];
        if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
          return true;
        }
        else {
          return false;    
        }
    }
    
    return true;
    
  }
        
  public function updateImagesDb($nid, $images, $main_image='') {
    
    if (!$nid || !is_array($images)) {
      return false;
    }  
    
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$nid . "'");
    $db_images = $query->rows;
    
    foreach ($db_images as $db_image) {
      
      // delete old image
      if (!in_array($db_image['image'], $images)) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_image_id = '" . (int)$db_image['product_image_id'] . "'");
        if ($db_image['image'] != $main_image) {
          $this->unlinkFile(DIR_IMAGE . $db_image['image']);
        }
      }
      else {
        // unset already exist in db image
        unset($images[array_search($db_image['image'], $images)]);
      }
    }
      
    foreach ($images as $key => $image) {
        
      $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$nid . "', image = '" . $this->db->escape($image) . "', sort_order = '" . (int)$key . "'");
    
    }    
    
  }
  
  public function updateMainImageDb($nid, $main_image, $images_arr = array()) {
    
    if (!$nid) {
      return false;
    }
    
    if (isset($images_arr) && is_array($images_arr)) {
      $query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$nid . "'");
      if (isset($query->row['image']) && $query->row['image'] && $query->row['image'] == $main_image) {
        return true;
      }
	    if (isset($query->row['image']) && $query->row['image'] 
	      && !in_array($query->row['image'], $images_arr)) {	  
	        $this->unlinkFile(DIR_IMAGE . $query->row['image']);
	    }
	  }
	  
	  $this->db->query("UPDATE " . DB_PREFIX . "product p SET image = '" . $this->db->escape($main_image) . "' WHERE p.product_id = '" . (int)$nid . "'");
  
  }
  
  private function unlinkFile($file) {
    if (!file_exists($file)) {
      $this->setError(str_replace(DIR_IMAGE,'',$file) . " : " . $this->language->get('error_unlink_file_not_exists'));
      return false;
    }
    if (!is_writable($file)) {
      $this->setError(str_replace(DIR_IMAGE,'',$file) . " : " . $this->language->get('error_unlink_file_not_writable'));
      return false;
    }
    unlink($file);
  }
  
  public function getDirectoryTree( $outerDir = '', $level = 0 ){ 
    
    if ($level == 0) {
      if (!$outerDir) {
        $outerDir = DIR_IMAGE . 'data';
      }
      $dir_array = $this->cache->get('category.tree.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). md5($outerDir));
      if ($dir_array && is_array($dir_array)) {
        return $dir_array;
      }    
    }
    
    $level++;
    $dirs = array_diff( scandir( $outerDir ), array( ".", ".." ) ); 
    $dir_array = array(); 
    foreach( $dirs as $d ){ 
        if( is_dir($outerDir . "/" . $d)  ){ 
            $dir_array[] = array (
              'path'  => str_replace(DIR_IMAGE, '', $outerDir . "/" . $d),
              'name'  => $d,
              'level' => $level
            ); 
            
            $dir_array = array_merge($dir_array, $this->getDirectoryTree( $outerDir . "/" . $d, $level));
        } 
    }
    
    $this->cache->set('category.tree.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). md5($outerDir), $dir_array);
     
    return $dir_array; 
  } 
    
  public function getDefaultOptions() {
  
    return array( 
      'image_path' => 'data/',
      'product_count' => '5',
      'server_timeout' => '2000',
      'search_where' => array ( 
        'model' => 1,
        'name' => 1, 
        'sku' => 1 ), 
     );
  }
  
  public function getError() {
    return $this->error;
  }
	
	public function setError($error) {
	  if ($error) {
      $this->error[] = $error;
    }  
  }
	
	public function clearError() {
	  $this->error = array();
	}			
}
