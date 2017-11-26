<?php
class ModelWgiOosNotify extends Model {
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
	
	public function getLanguagess() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language`");
		return $query->rows;
	}
}
?>