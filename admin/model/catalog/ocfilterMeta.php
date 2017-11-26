<?php
class ModelCatalogOcfilterMeta extends Model {
	public function addMeta($data) {
		$data['option2'] = ($data['option2'] == '') ? $data['option2'] = 'null' : $data['option2'];
		$data['option1'] = ($data['option1'] == '') ? $data['option1'] = 'null' : $data['option1'];
		$sql = "INSERT into " . DB_PREFIX . "ocfilter_meta 
				values (null,".$data['category'].", ".$data['option1'].", ".$data['option2'].",
						'".$this->db->escape($data['text_top'])."',
						'".$this->db->escape($data['text_bottom'])."',
						'".$this->db->escape($data['meta_title'])."',
						'".$this->db->escape($data['meta_description'])."',
						'".$this->db->escape($data['h1'])."')";
		$this->db->query($sql);
		
		$this->cache->delete('meta');
	}
	
	public function editMeta($meta_id, $data) {
		if ($data['option2'] == '') $data['option2'] = 'null';
		if ($data['option1'] == '') $data['option1'] = 'null';
		$sql = "update " . DB_PREFIX . "ocfilter_meta set
					category_id = ".$data['category'].",
					option1 = ".$data['option1'].",
					option2 = ".$data['option2'].",
					text_top = '".$this->db->escape($data['text_top'])."',
					text_bottom = '".$this->db->escape($data['text_bottom'])."',
					meta_title = '".$this->db->escape($data['meta_title'])."',
					meta_description = '".$this->db->escape($data['meta_description'])."',
					h = '".$this->db->escape($data['h1'])."' where id = $meta_id";

		$this->db->query($sql);
		
		$this->cache->delete('meta');
	}
	
	public function deleteMeta($meta_id) {
		$sql = "DELETE FROM " . DB_PREFIX . "ocfilter_meta WHERE id = '" . (int)$meta_id . "'";
		$this->db->query($sql);
		
		$this->cache->delete('meta');
	} 
			
	public function getMeta($meta_id) {
		$sql = "select * from ".DB_PREFIX."ocfilter_meta where id = $meta_id";
		$query = $this->db->query($sql);

		return $query->row;
	} 
	
	public function getMetas($data) {
		$sql = "select a.*, b.name as option1, c.name as option2, e.name as opt1, f.name as opt2, g.name as category
				from ".DB_PREFIX."ocfilter_meta a
				LEFT JOIN ".DB_PREFIX."ocfilter_option_value_description b on a.option1 = b.value_id 
				LEFT JOIN ".DB_PREFIX."ocfilter_option_value_description c on a.option2 = c.value_id
				LEFT JOIN ".DB_PREFIX."ocfilter_option_description e on b.option_id = e.option_id 
				LEFT JOIN ".DB_PREFIX."ocfilter_option_description f on c.option_id = f.option_id
				INNER JOIN ".DB_PREFIX."category_description g on a.category_id = g.category_id 
				WHERE b.language_id = 1 ";
		
		$sql .= " GROUP BY a.id ORDER BY a.id";

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
		
	public function getTotalMeta() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ocfilter_meta");
		
		return $query->row['total'];
	}	

	public function getOptions($category_id){
		$sql = "select a.*, c.name as opt
				from ".DB_PREFIX."ocfilter_option_value_description a
				INNER JOIN ".DB_PREFIX."ocfilter_option_to_category b on a.option_id = b.option_id
				INNER JOIN ".DB_PREFIX."ocfilter_option_description c on a.option_id = c.option_id
				where b.category_id = $category_id order by c.name, a.name";

		$query = $this->db->query($sql);

		echo json_encode($query->rows);
	}

	public function checkOptions($post){
		$flag = true;
		$option1 = $post['option1'];
		$option2 = $post['option2'];
		$category_id = $post['category'];

		if ($option1 == '' && $option2 != ''){
			$sql = "select * from ".DB_PREFIX."ocfilter_meta where ((option1 = $option2 and (option2 = '' or option2 is null)) or (option2 = $option2 and (option1 = '' or option1 is null))) and category_id = $category_id";
			$query = $this->db->query($sql);
		}
		else if ($option2 == '' && $option1 != ''){
			$sql = "select * from ".DB_PREFIX."ocfilter_meta where ((option1 = $option1 and (option2 = '' or option2 is null)) or (option2 = $option1 and (option1 = '' or option1 is null))) and category_id = $category_id";
			$query = $this->db->query($sql);
		}
		else if ($option2 != '' && $option1 != ''){
			$sql = "select * from ".DB_PREFIX."ocfilter_meta where ((option1 = $option1 and option2 = $option2) or (option2 = $option1 and option1 = $option2)) and category_id = $category_id";
			$query = $this->db->query($sql);
		}

		//echo count($query->row);
		if (count($query->row) <= 0){
			$flag = false;
		}

		return $flag;
	}
}
?>