<?php
class ModelSaleCustomerBanPhone extends Model {
	public function addCustomerBanPhone($data) {
		$data['phone'] = trim(preg_replace('/\D/', '', $data['phone']));
		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_ban_phone` SET `phone` = '" . $this->db->escape($data['phone']) . "' ON DUPLICATE KEY UPDATE `phone` = VALUES(`phone`)");
	}
	
	public function editCustomerBanPhone($customer_ban_phone_id, $data) {
		$data['phone'] = trim(preg_replace('/\D/', '', $data['phone']));
		$this->db->query("UPDATE `" . DB_PREFIX . "customer_ban_phone` SET `phone` = '" . $this->db->escape($data['phone']) . "' WHERE customer_ban_phone_id = '" . (int)$customer_ban_phone_id . "'");
	}
	
	public function deleteCustomerBanPhone($customer_ban_phone_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_ban_phone` WHERE customer_ban_phone_id = '" . (int)$customer_ban_phone_id . "'");
	}
	
	public function getCustomerBanPhone($customer_ban_phone_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ban_phone` WHERE customer_ban_phone_id = '" . (int)$customer_ban_phone_id . "'");
	
		return $query->row;
	}
	
	public function getCustomerBanPhones($data = array()) {
		$sql = "SELECT *, (SELECT COUNT(DISTINCT customer_id) FROM `" . DB_PREFIX . "customer` c WHERE SUBSTRING(c.telephone, -10) = SUBSTRING(cbi.phone, -10)) AS total FROM `" . DB_PREFIX . "customer_ban_phone` cbi";
				
		$sql .= " ORDER BY `phone`";	
			
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
	
	public function getTotalCustomerBanPhones($data = array()) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_ban_phone`");
				 
		return $query->row['total'];
	}
}
?>