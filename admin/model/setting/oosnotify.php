<?php
class ModelSettingOosNotify extends Model {
    public function CheckInstall() {
        $sql = "SELECT count(*) as count FROM `" . DB_PREFIX . "setting` WHERE `group` = 'notify_out_stock'"; 
        $query = $this->db->query($sql);
        if ($query->row['count'] > 0){
			return true;
		}else{
			return false;
		}
    }   
	
	public function install(){
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "out_of_stock_notify` (
			  `oosn_id` int(11) NOT NULL AUTO_INCREMENT,
			  `product_id` int(11) NOT NULL,
			  `product_option_id` int(11) NULL,
			  `product_option_value_id` int(11) NULL,
			  `selected_option` VARCHAR(100) NULL,
			  `email` varchar(50) NOT NULL,
			  `fname` varchar(50) NULL,
			  `phone` varchar(20) NULL,
			  `language_code` VARCHAR(10) NOT NULL,
			  `enquiry_date` datetime NOT NULL,
			  `notified_date` datetime DEFAULT NULL,
			  PRIMARY KEY (`oosn_id`)
			)");
		
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_name_enable', 'y', '0')"); 
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_mobile_enable', 'n', '0')"); 
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_pp_effect', 'pulsate', '0')");
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_animation', 'mfp-newspaper', '0')");
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_product_qty', '1', '0')");  
		 $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_stock_status', '0', '0')"); 
		  $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_css', '#oosn_info_text{\npadding-top:0px;\ncolor:#F00;\n}\n\n#option_no_stock_input{\nborder:1px dashed #FF3300; \nbackground-color: #FFFFCC; \npadding:10px;\n}\n\n#msgoosn{\ncolor:green;\n}', '0')");
		  
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language){
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_admin_email_subject_".$language['code']."', 'Customer is looking for a product', '0'); ");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_admin_email_body_".$language['code']."', 'Customer is looking for a product id - {product_id}. Reply to {customer_email}', '0'); ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_customer_email_subject_".$language['language_id']."', 'Your Requested Product is now Available to purchase', '0'); ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_customer_email_body_".$language['language_id']."', '&lt;table align=&quot;center&quot; bgcolor=&quot;#f9f9f9&quot; cellpadding=&quot;10px&quot; width=&quot;90%&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n			&lt;p&gt;Hi {customer_name},&lt;/p&gt;\r\n\r\n			&lt;p&gt;The product {product_name} {option} Model: {model}, you requested for is now available for ordering.&lt;/p&gt;\r\n\r\n			&lt;table cellpadding=&quot;10&quot;&gt;\r\n				&lt;tbody&gt;\r\n					&lt;tr&gt;\r\n						&lt;td&gt;{show_image}&lt;/td&gt;\r\n						&lt;td&gt;&lt;b&gt;{product_name}&lt;/b&gt;&lt;br /&gt;\r\n						Model: {model}&lt;br /&gt;\r\n						&lt;br /&gt;\r\n						&lt;a class=&quot;button&quot; href=&quot;{link}&quot;&gt;BUY NOW ! Limited Stock !&lt;/a&gt;&lt;/td&gt;\r\n					&lt;/tr&gt;\r\n				&lt;/tbody&gt;\r\n			&lt;/table&gt;\r\n\r\n			&lt;p&gt;Regards,&lt;/p&gt;\r\n\r\n			&lt;p&gt;Your Store Name&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n', '0'); ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_product_image_h_".$language['language_id']."', '80', '0'); ");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', 'hb_oosn_product_image_w_".$language['language_id']."', '80', '0'); ");
		
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock_installer', 'hb_oosn_installed', '1', '0')"); 
	}
	
	public function getReports($data = array(),$filteroption) {
		$sql = "SELECT a.product_id, b.name, a.selected_option, a.email, a.fname, a.phone, a.language_code, a.enquiry_date, a.notified_date FROM `" . DB_PREFIX . "out_of_stock_notify` a, `" . DB_PREFIX . "product_description` b where a.product_id = b.product_id and b.language_id = (SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = (SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_admin_language')) ";
        
        if ($filteroption == 'archive'){
            $sql.= " and a.notified_date IS NOT NULL ";
        }elseif ($filteroption == 'awaiting'){
            $sql.= " and a.notified_date IS NULL ";
        }
        
        $sql.= "ORDER BY a.enquiry_date DESC ";
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
	
	public function getTotalReports($filteroption) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "out_of_stock_notify";
        
        if ($filteroption == 'archive'){
            $sql.= " WHERE notified_date IS NOT NULL ";
        }elseif ($filteroption == 'awaiting'){
            $sql.= " WHERE notified_date IS NULL ";
        }
        
        $query = $this->db->query($sql);

		return $query->row['total'];
	}
    
    public function getTotalAlert() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "out_of_stock_notify");

        return $query->row['total'];
	}
    
    public function getTotalResponded() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NOT NULL");

        return $query->row['total'];
	}
    
    public function getCustomerNotified() {
        $query = $this->db->query("SELECT COUNT(distinct(email)) AS total FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NOT NULL");

    	return $query->row['total'];
	}
    
    public function getTotalRequested() {
    	$query = $this->db->query("SELECT COUNT(distinct(product_id)) AS total FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NULL");

		return $query->row['total'];
	}
    public function getAwaitingNotification() {
        $query = $this->db->query("SELECT COUNT(distinct(email)) AS total FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NULL");

		return $query->row['total'];
	}
    
    public function getDemandedList() {
        $query = $this->db->query("SELECT distinct(a.product_id) as pid, b.name, 
        (SELECT COUNT(distinct(email)) from " . DB_PREFIX . "out_of_stock_notify 
        WHERE product_id = pid) AS count FROM " . DB_PREFIX . "out_of_stock_notify a, " . DB_PREFIX . "product_description b 
        where a.product_id = b.product_id and 
        b.language_id = (SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = (SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_admin_language')) and a.notified_date IS NULL ORDER BY count DESC LIMIT 100");

		return $query->rows;
	}
		
	public function updateSettings($key,$value){
		$query = $this->db->query("SELECT count(*) as count FROM " . DB_PREFIX . "setting WHERE `key` = '".$key."'");
		$count = $query->row['count'];
		
		if ($count <> 0){
			$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET value = '".$value."' WHERE `key` = '".$key."'");
		}else {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES (NULL, '0', 'notify_out_stock', '".$key."', '".$value."', '0'); ");
		}
	}
	
	public function countStoreUrl(){
		$query = $this->db->query("SELECT count(*) as count FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_url_oosn' and store_id = 0");
		return $query->row['count'];
		
	}
	
	public function getUniqueId() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NULL");
		return $query->rows;
	}
	
	public function getStockStatus($product_id) {
		$query = $this->db->query("SELECT quantity, stock_status_id FROM " . DB_PREFIX . "product WHERE status = 1 and product_id = '".$product_id."' LIMIT 1");
		if (isset($query->row)){
			return $query->row;	
		}else {
			return false;
		}
	}
	
	public function getOptionStockStatus($product_id, $product_option_value_id, $product_option_id) {
		$query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product_option_value WHERE product_id = '".(int)$product_id."' and product_option_id = '".(int)$product_option_id."' and product_option_value_id = '".(int)$product_option_value_id."' LIMIT 1");
		if (isset($query->row)){
			return $query->row;	
		}else {
			return false;
		}
	}
	
	public function getProductStore($product_id) {
		$query = $this->db->query("SELECT store_id FROM " . DB_PREFIX . "product_to_store WHERE product_id = '".$product_id."'");
		return $query->row['store_id'];
	}
	
	public function getStoreUrl($store_id) {
		$query = $this->db->query("SELECT `value` FROM " . DB_PREFIX . "setting WHERE store_id = '".$store_id."' and `key`='config_url'");
		if (isset($query->row['value'])){
			return $query->row['value'];
		}else {
			return NULL;
		}
	}
	
	public function getProductDetails($product_id,$language_id) {
		$query = $this->db->query("SELECT b.name, a.model, a.image FROM `".DB_PREFIX."product` a, `" . DB_PREFIX . "product_description` b WHERE a.product_id = b.product_id and a.status = 1 and b.product_id = '".$product_id."' and b.language_id = '".$language_id."' LIMIT 1");
		return $query->row;
	}
	
	public function getemail($oosn_id) {
		$query = $this->db->query("SELECT *, (SELECT language_id FROM `" . DB_PREFIX . "language` WHERE BINARY code = BINARY a.language_code) as language_id FROM " . DB_PREFIX . "out_of_stock_notify a WHERE a.notified_date IS NULL and a.oosn_id = $oosn_id");
		return $query->rows;
	}
	
	public function updatenotifieddate($oosn_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "out_of_stock_notify SET notified_date = now() WHERE oosn_id = $oosn_id");
	}
	
	public function deleteRecords($delete) {
        if ($delete == 'all'){
		    $this->db->query("DELETE FROM " . DB_PREFIX . "out_of_stock_notify");
        }elseif ($delete == 'archive'){
            $this->db->query("DELETE FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NOT NULL");
        }elseif ($delete == 'awaiting'){
            $this->db->query("DELETE FROM " . DB_PREFIX . "out_of_stock_notify WHERE notified_date IS NULL");
        }
	}	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "out_of_stock_notify`");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `group` = 'notify_out_stock'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `group` = 'notify_out_stock_installer'");
	}
	
	public function getLanguagess() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language`");
		return $query->rows;
	}
}
?>