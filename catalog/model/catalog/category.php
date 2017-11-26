<?php
class ModelCatalogCategory extends Model {
	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");
		
		return $query->row;
	}
	
	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	
	public function getCategoryFilters($category_id) {
		$implode = array();
		
		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");
		
		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}
		
		
		$filter_group_data = array();
		
		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");
			
			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();
				
				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY f.sort_order, LCASE(fd.name)");
				
				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']			
					);
				}
				
				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);	
				}
			}
		}
		
		return $filter_group_data;
	}
				
	public function getCategoryLayoutId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");
		
		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return $this->config->get('config_layout_category');
		}
	}
					
	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");
		
		return $query->row['total'];
	}

	public function getOcfiltermeta($options,$category_id){
		$meta = false;
		if (count($options) == 1){
			$sql = "select * from " . DB_PREFIX . "ocfilter_meta where ((option1 = ".$options[0]." AND (option2 is null or option2 = '')) OR (option2 = ".$options[0]." AND (option1 is null or option1 = ''))) and category_id = $category_id";
			$query = $this->db->query($sql);
			$meta = $query->row;
		}
		else if (count($options) == 2){
			$sql = "select * from " . DB_PREFIX . "ocfilter_meta where ((option1 = ".$options[0]." AND option2 = ".$options[1].") OR (option1 = ".$options[1]." AND option2 = ".$options[0].")) and category_id = $category_id";
			$query = $this->db->query($sql);
			$meta = $query->row;
		}
		if (count($meta) <= 0)
			$meta = false;
		return $meta;
	}
	   /** custom code used in code to add correct canonical meta tag to page
* Returns the path to a category in the format 1_2_3 
* @param int $category_id 
* @return string the path to the category 
*/
public function getCategoryPath($category_id){
         $path = '';
            $category = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c WHERE c.category_id = " .(int)($category_id));
   
   if($category->row['parent_id'] != 0){
          $path .= $this->getCategoryPath($category->row['parent_id']) . '_';
   }
   
   $path .= $category->row['category_id'];
   
    return $path;
}
}
?>