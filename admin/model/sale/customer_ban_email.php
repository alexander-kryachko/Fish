<?php
class ModelSaleCustomerBanEmail extends Model {
	public function addCustomerBanEmail($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_ban_email` SET `email` = '" . $this->db->escape($data['email']) . "' ON DUPLICATE KEY UPDATE `email` = VALUES(`email`)");
	}
	
	public function editCustomerBanEmail($customer_ban_email_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer_ban_email` SET `email` = '" . $this->db->escape($data['email']) . "' WHERE customer_ban_email_id = '" . (int)$customer_ban_email_id . "'");
	}
	
	public function deleteCustomerBanEmail($customer_ban_email_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_ban_email` WHERE customer_ban_email_id = '" . (int)$customer_ban_email_id . "'");
	}
	
	public function getCustomerBanEmail($customer_ban_email_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ban_email` WHERE customer_ban_email_id = '" . (int)$customer_ban_email_id . "'");
	
		return $query->row;
	}
	
	public function getCustomerBanEmails($data = array()) {
		$sql = "SELECT *, (SELECT COUNT(DISTINCT customer_id) FROM `" . DB_PREFIX . "customer` c WHERE c.email = cbi.email) AS total FROM `" . DB_PREFIX . "customer_ban_email` cbi";
				
		$sql .= " ORDER BY `email`";	
			
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
	
	public function getTotalCustomerBanEmails($data = array()) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_ban_email`");
				 
		return $query->row['total'];
	}
}
?>