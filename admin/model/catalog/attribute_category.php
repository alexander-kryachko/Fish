<?php
class ModelCatalogAttributeCategory extends Model {

  public function getAttributes($category_id = 0) {
    $attributes = array();

    $this->load->model('catalog/attribute');
		$config = $this->getSettingAttributes($category_id);

		$results = $this->model_catalog_attribute->getAttributes();
    foreach ($results as $result) {
		  $attributes[] = array(
			  'attribute_id'      => $result['attribute_id'],
			  'name'              => $result['name'],
			  'attribute_group'   => $result['attribute_group'],
			  'sort_order'        => $result['sort_order'],
			  'checked'           => (isset($config[$category_id][$result['attribute_id']]) && $config[$category_id][$result['attribute_id']]) ? ' checked="checked" ' : '',
              'attributes_series' =>  unserialize($config[$category_id]['attributes_series']),
			);
		}

    return $attributes;
  }

  public function addAttributes($post) {
    $category_id = $this->getLastCategoryId();
    $this->updateAttributes($category_id, $post);
  }

  public function editAttributes($category_id = 0, $post) {
    $this->updateAttributes($category_id, $post);
  }

  private function updateAttributes($category_id = 0, $post) {

    if (!$category_id || !isset($post['attribute_category_attributes'])) {
      return;
    }

    //$this->model_setting_setting->editSetting('attribute_category', $setting);
    $this->editSettingAttributes($category_id, $post['attribute_category_attributes'], $post['attribute_category_attributes_series']);
  }
  public function deleteAttributes($category_id) {

    if (!$category_id) {
      return;
    }

    $this->deleteSettingAttributes($category_id);
  }

  public function getLastCategoryId() {
    $query = $this->db->query("SELECT MAX(category_id) AS category_id FROM " . DB_PREFIX . "category WHERE date_added > NOW()-2");
    return $query->row['category_id'] ? $query->row['category_id'] : 0;
  }

  public function getAjaxCategoryAttributes($category_id = 0, $is_series = false) {
    $data = array();

    if(!$category_id) {
      return $data;
    }

    $this->load->model('catalog/attribute');

    $categoryAttributes = $this->getSettingAttributes($category_id);
    $allAttributes = $this->model_catalog_attribute->getAttributes();
    if($is_series){

      if(count($categoryAttributes[$category_id]['attributes_series']) > 0){


        if($is_series == 2){
          $arr = unserialize($categoryAttributes[$category_id]['attributes_series']);
          foreach ($allAttributes as $attribute) {
            if (isset($categoryAttributes[$category_id][$attribute['attribute_id']]) && ($categoryAttributes[$category_id][$attribute['attribute_id']])) {
              $mark = 0;
              foreach($arr as $key=>$value){
                if($key == $attribute['attribute_id']){
                  $mark = 1;
                }
              }
                if(!$mark){
                  $data[] = array(
                      'attribute_id'    => $attribute['attribute_id'],
                      'name'            => $attribute['name'],
                      'attribute_group' => $attribute['attribute_group'],
                      'sort_order'      => $attribute['sort_order'],
                  );
                }


            }
          }
        }else if($is_series == 1){
          $arr = unserialize($categoryAttributes[$category_id]['attributes_series']);
          foreach ($allAttributes as $attribute) {

            if (isset($categoryAttributes[$category_id][$attribute['attribute_id']]) && ($arr[$attribute['attribute_id']])) {
              $data[] = array(
                  'attribute_id'    => $attribute['attribute_id'],
                  'name'            => $attribute['name'],
                  'attribute_group' => $attribute['attribute_group'],
                  'sort_order'      => $attribute['sort_order'],
              );
            }
          }
        }


      }




    }else{
      foreach ($allAttributes as $attribute) {

        if (isset($categoryAttributes[$category_id][$attribute['attribute_id']]) && ($categoryAttributes[$category_id][$attribute['attribute_id']])) {
          $data[] = array(
              'attribute_id'    => $attribute['attribute_id'],
              'name'            => $attribute['name'],
              'attribute_group' => $attribute['attribute_group'],
              'sort_order'      => $attribute['sort_order'],
          );
        }
      }
    }



    return $data;
  }

  public function install() {
    $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "attribute_category (`category_id` INT( 11 ) NOT NULL ,
`attributes` TEXT NOT NULL)");
  }

  public function uninstall() {
    $this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "attribute_category");
  }

  /**
   * We do not use a standard model setting because it is not designed for large data and loads all data automatically in bootstrap system. And we can have a lot of categories and attributes.
   */
  private function getSettingAttributes($category_id) {
    $data = array();
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_category WHERE category_id = " . (int)$category_id);

    foreach ($query->rows as $result) {
        $data[$result['category_id']] = unserialize($result['attributes']);
        $data[$result['category_id']]['attributes_series'] = $result['attributes_series'];
    }
    return $data;
  }

  private function editSettingAttributes($category_id = 0, $data, $series = false) {

    if (!$category_id || !is_array($data)) {
      return;
    }

    $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_category WHERE category_id = " . (int)$category_id);


    $sql = "INSERT INTO " . DB_PREFIX . "attribute_category SET category_id = " . (int)$category_id . ", `attributes` = '" . $this->db->escape(serialize($data)) . "'";

    if($series){
      $sql .= ", `attributes_series` = '" . $this->db->escape(serialize($series)) . "'";
    }

    $this->db->query($sql);

  }

  private function deleteSettingAttributes($category_id = 0) {
    $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_category WHERE category_id = " . (int)$category_id);
  }

}
