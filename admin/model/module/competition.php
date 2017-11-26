<?php
class ModelModuleCompetition extends Model {

	public function install_competition() {
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "competition (
			competition_id INT(11) AUTO_INCREMENT, 
			competition_name varchar(255),
			PRIMARY KEY (competition_id)
			)");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "competition_answers (
			answer_id INT(11) AUTO_INCREMENT,
			value TEXT,
			language_id INT(11),
			competition_id INT(11), 
			correct INT(1) NOT NULL DEFAULT 0,
			KEY (answer_id)
			)");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "competition_description (
			competition_description_id INT(11) AUTO_INCREMENT, 
			description TEXT,
			title TEXT,
			question TEXT,
			language_id int(3) DEFAULT NULL,
			newsletter INT(1) NOT NULL DEFAULT 0,
			competition_id INT(11),
			status INT(1) NOT NULL DEFAULT 0,
			term INT(1) NOT NULL DEFAULT 0,
			information_id INT(8) NOT NULL DEFAULT 0,
			PRIMARY KEY (competition_description_id)
			)");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "competition_newsletter (
			newsletter_id INT(11) AUTO_INCREMENT, 
			name VARCHAR(255),
			email VARCHAR(255),
			language_id INT(8),
			PRIMARY KEY (newsletter_id)
			)");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "competition_participants (
			participants_id INT(11) AUTO_INCREMENT, 
			name VARCHAR(255),
			email VARCHAR(255),
			answer_id INT(11),
			competition_id INT(11),
			language_id INT(3),
			winner INT(1) NOT NULL DEFAULT 0,
			PRIMARY KEY (participants_id)
			)");
	}

	public function uninstall_competition() {
		$this->db->query("DROP TABLE " . DB_PREFIX . "competition");
		$this->db->query("DROP TABLE " . DB_PREFIX . "competition_answers");
		$this->db->query("DROP TABLE " . DB_PREFIX . "competition_description");
		$this->db->query("DROP TABLE " . DB_PREFIX . "competition_newsletter");
		$this->db->query("DROP TABLE " . DB_PREFIX . "competition_participants");
	}

	public function getCompetitions() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition");
		return $query->rows;
	}

	public function addCompetition() {
		$this->db->query("INSERT INTO " . DB_PREFIX . "competition SET sort_order = 0, status = 0");
	}

	public function deleteNewsletter($newsletter_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_newsletter WHERE newsletter_id = '" . (int)$newsletter_id . "'");
	}

	public function deleteCompetition($competition_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition WHERE competition_id = '" . (int)$competition_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_description WHERE competition_id = '" . (int)$competition_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_answers WHERE competition_id = '" . (int)$competition_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_participants WHERE competition_id = '" . (int)$competition_id . "'");
	}

	public function insertCompetition($competition) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "competition SET competition_name = '" . $competition . "'");
	}
	
	public function updateInformation($competition_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_description WHERE competition_id = '" . (int)$competition_id . "'");
					
		foreach ($data['information_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "competition_description SET competition_id = '" . (int)$competition_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', question = '" . $this->db->escape($value['question']) . "', newsletter = '" . $this->db->escape($value['newsletter']) . "', information_id = '" . $this->db->escape($value['information_id']) . "', term = '" . $this->db->escape($value['term']) . "', status = '" . $this->db->escape($value['status']) . "'");
		}
	}

	public function getInformation($competition_id) {
		$information_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_description WHERE competition_id = '" . (int)$competition_id . "'");

		foreach ($query->rows as $result) {
			$information_description_data[$result['language_id']] = array(
				'title'       		=> $result['title'],
				'description' 		=> $result['description'],
				'question' 	  		=> $result['question'],
				'newsletter'  		=> $result['newsletter'],
				'status'  	  		=> $result['status'],
				'term'  	  		=> $result['term'],
				'information_id'  	=> $result['information_id']
			);
		}
		
		return $information_description_data;
	}

	public function getInformationPages() {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");
			$information_data = $query->rows;
			
			return $information_data;
	}
	
	public function getAnswers($competition_id) {
		$answer_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_answers WHERE competition_id = '" . (int)$competition_id . "' ORDER BY answer_id ASC");

		foreach ($query->rows as $result) {
			$answer_data[][$result['language_id']] = array(
				'id'       	  => $result['answer_id'],
				'value' 	  => $result['value'],
				'correct' 	  => $result['correct']
			);
		}
		
		return $answer_data;
	}

	public function updateAnswers($competition_id, $data) {
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "competition_answers WHERE competition_id = '" . (int)$competition_id . "'");

		if(isset($data['answer_new'])):
		foreach($data['answer_new'] as $langid => $value):
			foreach($value as $answer):
				$this->db->query("INSERT INTO " . DB_PREFIX . "competition_answers SET competition_id = '" . (int)$competition_id . "', language_id = '" . (int)$langid . "', value = '" . $answer["answer"] . "', correct = '" . $answer["correct"] . "'");
			endforeach;
		endforeach;
		endif;
		
		if(isset($data['answer_old'])):
		foreach($data['answer_old'] as $langid => $value):
			foreach($value as $id => $answer):
				$this->db->query("INSERT INTO " . DB_PREFIX . "competition_answers SET answer_id = '" . (int)$id . "', competition_id = '" . (int)$competition_id . "', language_id = '" . (int)$langid . "', value = '" . $answer["answer"] . "', correct = '" . $answer["correct"] . "'");
			endforeach;
		endforeach;
		endif;
	}
	
	public function getParticipants($competition_id) {
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "competition_participants` cp LEFT JOIN " . DB_PREFIX . "competition_answers ca ON (cp.answer_id = ca.answer_id) WHERE cp.competition_id = '" . (int)$competition_id . "'");

		return $query->rows;
	}

	public function getNewsletters() {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_newsletter");
		
		return $query->rows;
	}

	public function getWinners($competition_id) {
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "competition_participants` cp LEFT JOIN " . DB_PREFIX . "competition_answers ca ON (cp.answer_id = ca.answer_id) WHERE cp.competition_id = '" . (int)$competition_id . "' AND winner = 1");
		
		return $query->rows;
	}

	public function selectWinners($competition_id, $amount) {
		
		$this->resetWinners($competition_id);
		
		$string = "";
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_answers WHERE competition_id = '" . (int)$competition_id . "' AND correct = 1");


		if($query->num_rows > 0):
			$a_rows = $query->num_rows;
			$i = 1;
			foreach ($query->rows as $result) {
				if($i != $a_rows):
					$string .= $result['answer_id'] . ",";
				else:
					$string .= $result['answer_id'];
				endif;
				$i++;
			}
			
			$winners = $this->db->query("SELECT * FROM " . DB_PREFIX . "competition_participants WHERE answer_id IN ($string) ORDER BY RAND() LIMIT $amount");
			
			
			foreach($winners->rows as $winner):
				$this->db->query("UPDATE " . DB_PREFIX . "competition_participants SET winner = 1 WHERE participants_id = '" . $winner['participants_id'] . "'");
			endforeach;
			
			return $winners->rows;
		else:
			return false;
		endif;

	}

	private function resetWinners($competition_id) {
		$query = $this->db->query("UPDATE " . DB_PREFIX . "competition_participants SET winner = 0 WHERE competition_id = $competition_id");
	}

}
?>