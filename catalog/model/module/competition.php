<?php
class ModelModuleCompetition extends Model {

	public function getCompetition($competition_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_description WHERE competition_id = '" . (int)$competition_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
		return $query->rows;
	}

	public function getAnswers($competition_id) {
		$answer_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_answers WHERE competition_id = '" . (int)$competition_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY answer_id ASC");

		foreach ($query->rows as $result) {
			$answer_data[] = array(
				'id'       	  => $result['answer_id'],
				'value' 	  => $result['value']
			);
		}
		
		return $answer_data;
	}

	public function enterCompetition($data) {
				if(!isset($data['answer'])):
					$data['answer'] = "";
				endif;
		
				$this->db->query("INSERT INTO " . DB_PREFIX . "competition_participants SET name = '" . $this->db->escape($data['name']) . "', email = '" . $data['email'] . "', answer_id = '" . $data['answer'] . "', competition_id = '" . $data['competition_id'] . "', language_id = '" . (int)$this->config->get('config_language_id') . "'");
	
				if($data['newsletter'] == 1):
					$this->db->query("INSERT INTO " . DB_PREFIX . "competition_newsletter SET name = '" . $this->db->escape($data['name']) . "', email = '" . $data['email'] . "', language_id = '" . (int)$this->config->get('config_language_id') . "'");
				endif;
	} 

	public function getCompetitionExist($email, $id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_participants WHERE email = '" . $email . "' AND competition_id = '" . $id . "'");
		return $query->num_rows;
	}
	
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");
	
		return $query->row;
	}
	
}
?>