<?php
class ModelCatalogOCFilter extends Model {

	private static $caseTable = array(
		//english latin
		"\x41"=>"\x61", "\x42"=>"\x62", "\x43"=>"\x63", "\x44"=>"\x64", "\x45"=>"\x65", "\x46"=>"\x66",
		"\x47"=>"\x67", "\x48"=>"\x68", "\x49"=>"\x69", "\x4a"=>"\x6a", "\x4b"=>"\x6b", "\x4c"=>"\x6c",
		"\x4d"=>"\x6d", "\x4e"=>"\x6e", "\x4f"=>"\x6f", "\x50"=>"\x70", "\x51"=>"\x71", "\x52"=>"\x72",
		"\x53"=>"\x73", "\x54"=>"\x74", "\x55"=>"\x75", "\x56"=>"\x76", "\x57"=>"\x77", "\x58"=>"\x78",
		"\x59"=>"\x79", "\x5a"=>"\x7a",
		
		//russian cyrillic
		"\xd0\x90"=>"\xd0\xb0", "\xd0\x91"=>"\xd0\xb1", "\xd0\x92"=>"\xd0\xb2", "\xd0\x93"=>"\xd0\xb3",
		"\xd0\x94"=>"\xd0\xb4", "\xd0\x95"=>"\xd0\xb5", "\xd0\x81"=>"\xd1\x91", "\xd0\x96"=>"\xd0\xb6",
		"\xd0\x97"=>"\xd0\xb7", "\xd0\x98"=>"\xd0\xb8", "\xd0\x99"=>"\xd0\xb9", "\xd0\x9a"=>"\xd0\xba",
		"\xd0\x9b"=>"\xd0\xbb", "\xd0\x9c"=>"\xd0\xbc", "\xd0\x9d"=>"\xd0\xbd", "\xd0\x9e"=>"\xd0\xbe",
		"\xd0\x9f"=>"\xd0\xbf", "\xd0\xa0"=>"\xd1\x80", "\xd0\xa1"=>"\xd1\x81", "\xd0\xa2"=>"\xd1\x82",
		"\xd0\xa3"=>"\xd1\x83", "\xd0\xa4"=>"\xd1\x84", "\xd0\xa5"=>"\xd1\x85", "\xd0\xa6"=>"\xd1\x86",
		"\xd0\xa7"=>"\xd1\x87", "\xd0\xa8"=>"\xd1\x88", "\xd0\xa9"=>"\xd1\x89", "\xd0\xaa"=>"\xd1\x8a",
		"\xd0\xab"=>"\xd1\x8b", "\xd0\xac"=>"\xd1\x8c", "\xd0\xad"=>"\xd1\x8d", "\xd0\xae"=>"\xd1\x8e",
		"\xd0\xaf"=>"\xd1\x8f",
	);

	private static $translitTable = array(
		//russian cyrillic
		"\xd0\xb0"=>'a', "\xd0\xb1"=>'b', "\xd0\xb2"=>'v', "\xd0\xb3"=>'g',
		"\xd0\xb4"=>'d', "\xd0\xb5"=>'e', "\xd1\x91"=>'yo', "\xd0\xb6"=>'zh',
		"\xd0\xb7"=>'z', "\xd0\xb8"=>'i', "\xd0\xb9"=>'y', "\xd0\xba"=>'k',
		"\xd0\xbb"=>'l', "\xd0\xbc"=>'m', "\xd0\xbd"=>'n', "\xd0\xbe"=>'o',
		"\xd0\xbf"=>'p', "\xd1\x80"=>'r', "\xd1\x81"=>'s', "\xd1\x82"=>'t',
		"\xd1\x83"=>'u', "\xd1\x84"=>'f', "\xd1\x85"=>'h', "\xd1\x86"=>'ts',
		"\xd1\x87"=>'ch', "\xd1\x88"=>'sh', "\xd1\x89"=>'sch', "\xd1\x8a"=>'',
		"\xd1\x8b"=>'i', "\xd1\x8c"=>'', "\xd1\x8d"=>'e', "\xd1\x8e"=>'yu',
		"\xd1\x8f"=>'ya',
	);

  public function addOption($data) {
    $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option SET status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', sort_order = '" . (int)$data['sort_order'] . "', type = '" . $this->db->escape($data['type']) . "', grouping = '" . (int)$data['grouping'] . "', selectbox = '" . (isset($data['selectbox']) ? (int)$data['selectbox'] : 0) . "', color = '" . (isset($data['color']) ? (int)$data['color'] : 0) . "', image = '" . (isset($data['image']) ? (int)$data['image'] : 0) . "'");

    $option_id = $this->db->getLastId();

    foreach ($data['ocfilter_option_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', postfix = '" . $this->db->escape($value['postfix']) . "'");
		}

    if (isset($data['category_id'])) {
			foreach ($data['category_id'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_category SET option_id = '" . (int)$option_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		if (isset($data['option_store'])) {
			foreach ($data['option_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_store SET option_id = '" . (int)$option_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['ocfilter_option_value']['insert'])) {
			foreach ($data['ocfilter_option_value']['insert'] as $value) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value SET option_id = '" . (int)$option_id . "', sort_order = '" . (int)$value['sort_order'] . "', color = '" . $this->db->escape($value['color']) . "', image = '" . $this->db->escape($value['image']) . "'");

				$value_id = $this->db->getLastId();

        foreach ($value['language'] as $language_id => $language) {
				  $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_description SET value_id = '" . (int)$value_id . "', option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($language['name']) . "'");
				}
			}
		}

    $this->cache->delete('ocfilter');
  }

  public function editOption($option_id, $data){
    $this->db->query("UPDATE " . DB_PREFIX . "ocfilter_option SET status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', sort_order = '" . (int)$data['sort_order'] . "', type = '" . $this->db->escape($data['type']) . "', grouping = '" . (int)$data['grouping'] . "', selectbox = '" . (isset($data['selectbox']) ? (int)$data['selectbox'] : 0) . "', color = '" . (isset($data['color']) ? (int)$data['color'] : 0) . "', image = '" . (isset($data['image']) ? (int)$data['image'] : 0) . "' WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_description WHERE option_id = '" . (int)$option_id . "'");
    foreach ($data['ocfilter_option_description'] as $language_id => $value) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', postfix = '" . $this->db->escape($value['postfix']) . "'");
	}

    //$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_to_category WHERE option_id = '" . (int)$option_id . "'");
	$this->db->query("UPDATE " . DB_PREFIX . "ocfilter_option_to_category SET `enabled` = 0 WHERE option_id = '" . (int)$option_id . "'");
    if (isset($data['category_id'])){
		foreach ($data['category_id'] as $category_id){
			//$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_category SET option_id = '" . (int)$option_id . "', category_id = '" . (int)$category_id . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_category(`option_id`, `category_id`, `enabled`) VALUES ('".(int)$option_id."', '".(int)$category_id."', 1)  ON DUPLICATE KEY UPDATE `enabled` = 1;");
		}
	}
	
	$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_to_store WHERE option_id = '" . (int)$option_id . "'");

	if (isset($data['option_store'])) {
		foreach ($data['option_store'] as $store_id) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_store SET option_id = '" . (int)$option_id . "', store_id = '" . (int)$store_id . "'");
		}
	}

    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_description WHERE option_id = '" . (int)$option_id . "'");

    if (isset($data['ocfilter_option_value'])) {
	
		$aliases = array();
		$query = $this->db->query("SELECT `keyword`, `query` FROM " . DB_PREFIX . "url_alias");
		if (!empty($query->rows)) foreach ($query->rows as $key => $result){
			$aliases[$result['keyword']] = $result['query'];
		}

		//update
		if (isset($data['ocfilter_option_value']['update'])) {
			foreach ($data['ocfilter_option_value']['update'] as $value_id => $value){
				$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value SET option_id = '" . (int)$option_id . "', value_id = '" . (int)$value_id . "', sort_order = '" . (int)$value['sort_order'] . "', color = '" . $this->db->escape($value['color']) . "', image = '" . $this->db->escape($value['image']) . "'");
				foreach ($value['language'] as $language_id => $language) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_description SET value_id = '" . (int)$value_id . "', option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($language['name']) . "'");
					$name = $language['name'];
				}
				
				//check slug
				if (strlen($value['slug'])){
					$a = isset($aliases[$value['slug']]) ? $aliases[$value['slug']] : false;
					if ($a){
						$c = substr($a, 0, 9);
						if ($c == 'ocfilter:'){
							$r = explode(':', $a);
							if ($r[2] != $value_id) $value['slug'] = false;
						} else $value['slug'] = false;
					}
				}
				$q = 'ocfilter:'.$option_id.':'.$value_id;
				$pos = array_search($q, $aliases);

				//generate slug
				if (!strlen($value['slug'])){
					if ($pos != false) {
						$value['slug'] = $pos;
					} else {
						$translitBase = $this->translit($this->alphanum($name, '-'));
						$c = 1;
						do{
							$translit = $translitBase.($c > 1 ? '-'.$c : '');
							$c++;
						} while(isset($aliases[$translit]));
						$value['slug'] = $translit;
					}
				}

				//save slug
				if ($pos != $value['slug']){
					$query = $this->db->query('SELECT `url_alias_id` as `id` FROM '.DB_PREFIX.'url_alias WHERE `query` = "'.$q.'" LIMIT 1');
					if (!empty($query->row['id'])){
						$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '".$this->db->escape($value['slug'])."' WHERE `query` = '".$q."' LIMIT 1");
					} else {
						$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias(`query`, `keyword`) VALUES ('".$q."', '".$this->db->escape($value['slug'])."')");
					}
					$aliases[$value['slug']] = $q;
				}
			}

		}

		//insert
		if (isset($data['ocfilter_option_value']['insert'])){
			foreach ($data['ocfilter_option_value']['insert'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value SET option_id = '" . (int)$option_id . "', sort_order = '" . (int)$value['sort_order'] . "', color = '" . $this->db->escape($value['color']) . "', image = '" . $this->db->escape($value['image']) . "'");
				$value_id = $this->db->getLastId();
				foreach ($value['language'] as $language_id => $language) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_description SET value_id = '" . (int)$value_id . "', option_id = '" . (int)$option_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($language['name']) . "'");
				}
			}
		}

    }
    $this->cache->delete('ocfilter');
  }

  public function deleteOption($option_id) {
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_description WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_to_category WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_to_store WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_description WHERE option_id = '" . (int)$option_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_to_product WHERE option_id = '" . (int)$option_id . "'");
    $this->cache->delete('ocfilter');
  }

  public function getOption($option_id) {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option oo LEFT JOIN " . DB_PREFIX . "ocfilter_option_description ood ON (oo.option_id = ood.option_id) WHERE oo.option_id = '" . (int)$option_id . "'");

    return $query->row;
  }

  public function getOptionByCategoriesId($categories_id) {

    $data = array();

    foreach ($categories_id as $category_id) $data[] = (int)$category_id;

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option oo LEFT JOIN " . DB_PREFIX . "ocfilter_option_description ood ON (ood.option_id = oo.option_id) LEFT JOIN " . DB_PREFIX . "ocfilter_option_to_category oo2c ON (oo.option_id = oo2c.option_id) WHERE oo2c.category_id IN (" . implode(',', $data) . ") AND ood.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oo.sort_order");

    return $query->rows;
  }

  public function getOptionsByCategoryId($category_id) {
    $options_data = array();

    $options_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option oo LEFT JOIN " . DB_PREFIX . "ocfilter_option_description ood ON (oo.option_id = ood.option_id) LEFT JOIN " . DB_PREFIX . "ocfilter_option_to_category cotc ON (oo.option_id = cotc.option_id) WHERE cotc.category_id = '" . (int)$category_id . "' AND ood.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oo.sort_order");

    if ($options_query->num_rows) {
      $options_id = array();

      foreach ($options_query->rows as $option) $options_id[] = (int)$option['option_id'];

      $values_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option_value oov LEFT JOIN " . DB_PREFIX . "ocfilter_option_value_description oovd ON (oov.value_id = oovd.value_id) WHERE oov.option_id IN (" . implode(',', $options_id) . ") AND oovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oov.sort_order, ABS(oovd.name)");

      $values = array();

      foreach ($values_query->rows as $value) $values[$value['option_id']][] = $value;

      foreach ($options_query->rows as $option) {
        $options_data[$option['option_id']] = $option;
        $options_data[$option['option_id']]['values'] = array();

        if (isset($values[$option['option_id']])) {
          $options_data[$option['option_id']]['values'] = $values[$option['option_id']];
        }
      }
    }

    return $options_data;
  }

  public function getOptionCategories($option_id) {
    $option_category_data = array();

    $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "ocfilter_option_to_category WHERE option_id = '" . (int)$option_id . "' AND `enabled` = 1");

    foreach ($query->rows as $result) $option_category_data[] = $result['category_id'];

    return $option_category_data;
  }

  public function getOptionStores($option_id) {
		$option_store_data = array();

		$query = $this->db->query("SELECT store_id FROM " . DB_PREFIX . "ocfilter_option_to_store WHERE option_id = '" . (int)$option_id . "'");

		foreach ($query->rows as $result) { $option_store_data[] = $result['store_id']; }

		return $option_store_data;
	}

  public function getProductValues($product_id) {
    $product_values_data = array();

    $query = $this->db->query("SELECT oov2p.*, oov2pd.description, oov2pd.language_id FROM " . DB_PREFIX . "ocfilter_option_value_to_product oov2p LEFT OUTER JOIN " . DB_PREFIX . "ocfilter_option_value_to_product_description oov2pd ON (oov2pd.product_id = oov2p.product_id AND oov2pd.option_id = oov2p.option_id AND oov2pd.value_id = oov2p.value_id) WHERE oov2p.product_id = '" . (int)$product_id . "'");

    $description = array();

    $this->load->model('localisation/language');

    $languages = $this->model_localisation_language->getLanguages();

    foreach ($query->rows as $result) {
      if ($result['language_id'] && $result['description']) {
        $description[$result['option_id'] . $result['value_id']][$result['language_id']] = array(
          'description' => $result['description']
        );
      } else {
        foreach ($languages as $language) {
          $description[$result['option_id'] . $result['value_id']][$language['language_id']] = array(
            'description' => ''
          );
        }
      }
    }

    foreach ($query->rows as $result) {
      unset($result['language_id']);
      unset($result['description']);

      $product_values_data[$result['option_id']][$result['value_id']] = $result;
      $product_values_data[$result['option_id']][$result['value_id']]['description'] = $description[$result['option_id'] . $result['value_id']];
    }

    return $product_values_data;
  }

  public function getOptionValues($option_id) { # In option form and product callback
    $value_data = array();

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option_value oov LEFT JOIN " . DB_PREFIX . "ocfilter_option_value_description oovd ON (oovd.value_id = oov.value_id) WHERE oov.option_id = '" . (int)$option_id . "' ORDER BY oov.sort_order, ABS(oovd.name)");

		$results = array();

		foreach ($query->rows as $row) {
      $results[$row['value_id']][] = $row;
		}

    foreach ($results as $key => $values) {
			$value = array_shift($values);

			$value_description = array();

			foreach ($results[$value['value_id']] as $result) {
				$value_description[$result['language_id']] = array(
          'name' => $result['name']
        );
			}

      $value_data[$key] = $value;
      $value_data[$key]['language'] = $value_description;
    }

		return $value_data;
  }

	public function getOptionDescriptions($option_id) {
		$option_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option_description WHERE option_id = '" . (int)$option_id . "'");

		foreach ($query->rows as $result) {
			$option_description_data[$result['language_id']] = array(
        'name'        => $result['name'],
        'description' => $result['description'],
        'postfix'     => $result['postfix']
      );
		}

		return $option_description_data;
	}

  public function getOptions($data = array()) { # In options list
    $option_data = array();

    $sql = "SELECT * FROM " . DB_PREFIX . "ocfilter_option oo LEFT JOIN " . DB_PREFIX . "ocfilter_option_description ood ON (oo.option_id = ood.option_id)";

    if (!empty($data['filter_category_id'])) {
      $sql .= " LEFT JOIN " . DB_PREFIX . "ocfilter_option_to_category oo2c ON (oo.option_id = oo2c.option_id)";
    }

    $sql .= " WHERE ood.language_id = '" . (int)$this->config->get('config_language_id') . "'";

    if (!empty($data['filter_category_id'])) {
			$sql .= " AND oo2c.category_id = '" . (int)$data['filter_category_id'] . "'";
		}

    if (!empty($data['filter_type'])) {
			$sql .= " AND oo.type = '" . $this->db->escape($data['filter_type']) . "'";
		}

    if (!empty($data['filter_name'])) {
			$sql .= " AND LCASE(ood.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}

    if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND oo.status = '" . (int)$data['filter_status'] . "'";
		}

    $sql .= " GROUP BY oo.option_id";

    $sort_data = array(
			'oo.sort_order',
			'ood.name'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY oo.sort_order, ood.name";
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
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

    $options_query = $this->db->query($sql);

    if ($options_query->num_rows) {
      $options_id = array();

      foreach ($options_query->rows as $option) {
        $options_id[] = (int)$option['option_id'];
      }

      $values_query = $this->db->query("SELECT oov.value_id, oov.option_id, oovd.name FROM " . DB_PREFIX . "ocfilter_option_value oov LEFT JOIN " . DB_PREFIX . "ocfilter_option_value_description oovd ON (oov.value_id = oovd.value_id) WHERE oov.option_id IN (" . implode(',', $options_id) . ") AND oovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oov.sort_order ASC, oovd.name DESC");

      $values = array();
      foreach ($values_query->rows as $value) $values[$value['option_id']][] = $value;

      $categories_query = $this->db->query("SELECT c.category_id, cd.name, oo2c.option_id FROM " . DB_PREFIX . "ocfilter_option_to_category oo2c LEFT JOIN " . DB_PREFIX . "category c ON (c.category_id = oo2c.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = c.category_id) WHERE oo2c.option_id IN (" . implode(',', $options_id) . ") AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name DESC");

      $categories = array();
      foreach ($categories_query->rows as $category) $categories[$category['option_id']][] = $category;

      foreach ($options_query->rows as $key => $option) {
        $option_data[$key] = $option;
        $option_data[$key]['values'] = (isset($values[$option['option_id']]) ? $values[$option['option_id']] : array());
        $option_data[$key]['categories'] = (isset($categories[$option['option_id']]) ? $categories[$option['option_id']] : array());
      }
    }

    return $option_data;
  }

  public function getTotalOptions($data = array()) {

    $sql = "SELECT COUNT(DISTINCT oo.option_id) AS total  FROM " . DB_PREFIX . "ocfilter_option oo LEFT JOIN " . DB_PREFIX . "ocfilter_option_description ood ON (oo.option_id = ood.option_id)";

    if (!empty($data['filter_category_id'])) {
      $sql .= " LEFT JOIN " . DB_PREFIX . "ocfilter_option_to_category oo2c ON (oo.option_id = oo2c.option_id)";
    }

    $sql .= " WHERE ood.language_id = '" . (int)$this->config->get('config_language_id') . "'";

    if (!empty($data['filter_category_id'])) {
			$sql .= " AND oo2c.category_id = '" . (int)$data['filter_category_id'] . "'";
		}

    if (!empty($data['filter_type'])) {
			$sql .= " AND oo.type = '" . $this->db->escape($data['filter_type']) . "'";
		}

    if (!empty($data['filter_name'])) {
			$sql .= " AND LCASE(ood.name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}

    if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND oo.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

  public function getCategories($parent_id, $level = -1) {
    $level++;

    $results = $this->getCategoriesByParentId($parent_id);

    $categories_data = array();

    foreach ($results as $result) {
      $categories_data[] = array(
        'category_id' => $result['category_id'],
        'name'        => $result['name'],
        'level'       => $level
      );

      $categories_data = array_merge($categories_data, $this->getCategories($result['category_id'], $level));
    }

    return $categories_data;
  }

  private function getCategoriesByParentId($parent_id = 0) { # For options list and form
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");

		return $query->rows;
	}

  public function getProductOCFilterValues($product_id) { # For product copy
    $product_filter_value_data = array();

    $product_filter_value_description = array();

		$description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option_value_to_product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($description_query->rows as $row) {
      $product_filter_value_description[$row['value_id']][$row['language_id']] = $row;
		}

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_option_value_to_product WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $key => $result) {
			$product_filter_value_data[$result['option_id']]['values'][(int)$result['value_id']] = array_merge($result, array('selected' => true));

      $product_filter_value_data[$result['option_id']]['values'][(int)$result['value_id']]['description'] = array();

			if (isset($product_filter_value_description[$result['value_id']])) {
        $product_filter_value_data[$result['option_id']]['values'][(int)$result['value_id']]['description'] = $product_filter_value_description[$result['value_id']];
			}
		}

		return $product_filter_value_data;
  }
  
  //public function smartUpdateOCFilter(){
  public function copyAttributesToOCFilter(){
	set_time_limit(0);
	error_reporting(E_ALL);
	$log = '';
	$lang = (int)$this->config->get('config_language_id');
	
	/**/header('Content-Type: text/html; charset=utf-8');

	// получить атрибуты
	$attributes = $attribute2name = array();
    $query = $this->db->query("SELECT 
			a.attribute_id,  
			a.sort_order,
			ad.name
		FROM " . DB_PREFIX . "attribute a
		INNER JOIN " . DB_PREFIX . "attribute_description ad on (a.attribute_id = ad.attribute_id AND ad.language_id = ".$lang.")
		ORDER BY a.sort_order
	");
	
	
	
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		$name = mb_strtolower(trim($result['name']), 'utf-8');
		if (!isset($attributes[$name])) $attributes[$name] = array('name' => trim($result['name']), 'sort_order' => $result['sort_order'], 'ids' => array());
		$attributes[$name]['ids'][] = $result['attribute_id'];
		$attribute2name[$result['attribute_id']] = $name;
	}
	
	// получить текущие фильтры
	$filters = $removeFilters = array();
    $query = $this->db->query("SELECT 
			o.option_id,
			od.name
		FROM " . DB_PREFIX . "ocfilter_option o
		INNER JOIN " . DB_PREFIX . "ocfilter_option_description od on (o.option_id = od.option_id AND od.language_id = ".$lang.")
		ORDER BY o.sort_order
	");
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		$name = mb_strtolower(trim($result['name']), 'utf-8');
		if (!isset($filters[$name])){
			$filters[$name] = array('name' => $result['name'], 'id' => $result['option_id']);
		} else {
			$removeFilters[$result['option_id']] = $filters[$name]['id']; //удалить дублирующиеся названия (и заменить в связях ключи на значения)
		}
	}
	
	// добавить в фильтры новые атрибуты
	if (!empty($attributes)) foreach($attributes as $name => $data){
		if (!isset($filters[$name])){
			$filters[$name] = array('name' => $data['name'], 'id' => $data['ids'][0], 'found' => true);
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option (option_id, status, type, sort_order) VALUES (".$data['ids'][0].", 1, 'checkbox', ".$data['sort_order'].")");
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_description (option_id, language_id, name) VALUES (".$data['ids'][0].", ".$lang.", '".$this->db->escape($data['name'])."')");
			//$this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_category(option_id, category_id) SELECT ");
			$log .= 'Добавлен фильтра: oid = '.$data['ids'][0].', name = '.$data['name'].'<br />';
		} else {
			$filters[$name]['found'] = true;
		}
	}

	// найти в фильтрах несуществующие атрибуты
	if (!empty($filters)) foreach($filters as $name => $data){
		if (empty($data['found'])){
			unset($filters[$name]);
			$removeFilters[$data['id']] = 0;
		}
	}

	// удалить устаревшие фильтры
	if (!empty($removeFilters)){
		$keys = array_keys($removeFilters);
		$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option WHERE option_id IN (".implode(',', $keys).")");
		$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_description WHERE option_id IN (".implode(',', $keys).")");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_to_category WHERE option_id IN (".implode(',', $keys).")");
		$log .= 'Удалены фильтры: '.implode(', ', $keys).'<br />';
	}
	
	// получить атрибуты товаров
	$productAttributes = array();
    $query = $this->db->query("SELECT 
			pa.product_id, 
			pa.attribute_id,  
			pa.text
		FROM " . DB_PREFIX . "product_attribute pa 
		WHERE language_id = '" . $lang . "'
	");
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		if (!isset($productAttributes[$result['product_id']])) $productAttributes[$result['product_id']] = array();
		if (!isset($productAttributes[$result['product_id']][$result['attribute_id']])) $productAttributes[$result['product_id']][$result['attribute_id']] = array();
		
		foreach(explode(', ', $result['text']) as $v){
			$v = trim($this->capFirst($v)); // capitalize
			if (!strlen($v)) continue;
			$productAttributes[$result['product_id']][$result['attribute_id']][] = $v;
		}
	}
	
	// получить текущие значения фильтров
	$values = array();
	$query = $this->db->query("SELECT
			vp.product_id,
			vp.option_id,
			vd.name
		FROM " . DB_PREFIX . "ocfilter_option_value_to_product vp
		INNER JOIN " . DB_PREFIX . "ocfilter_option_value_description vd on (vd.option_id = vp.option_id AND vd.value_id = vp.value_id AND vd.language_id = ".$lang.")
	");
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		if (!isset($values[$result['product_id']])) $values[$result['product_id']] = array();
		if (!isset($values[$result['product_id']][$result['option_id']])) $values[$result['product_id']][$result['option_id']] = array();
		$values[$result['product_id']][$result['option_id']][] = $result['name'];
	}
	
	$allValues = array();
	$query = $this->db->query("SELECT
			value_id,
			option_id,
			name
		FROM " . DB_PREFIX . "ocfilter_option_value_description
		WHERE language_id = ".$lang."
	");
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		//$crc = substr(crc32($result['option_id'].$result['name']), 1, 9);
		$allValues[$result['value_id']] = $result;
	}

	// получить алиасы
	$aliases = array();
	$query = $this->db->query("SELECT `keyword`, `query` FROM " . DB_PREFIX . "url_alias");
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		$aliases[$result['keyword']] = $result['query'];
	}
	
	//echo count($aliases);
	//print_r($aliases);	

	// проверка значений
	$i = 0;
	if (!empty($productAttributes)) foreach($productAttributes as $product_id => $attrs){
		$productVals = $filterVals = array();
		// значения атрибутов товара
		foreach($attrs as $aid => $vals){
			$name = isset($attribute2name[$aid]) ? $attribute2name[$aid] : false;
			$oid = isset($filters[$name]) ? $filters[$name]['id'] : false;

			foreach($vals as $val){
				if (!strlen($val)) continue;
				if (!isset($productVals[$oid])) $productVals[$oid] = array();
				$productVals[$oid][] = $val;
			}
		}

		// текущие значения фильтров товара
		if (!empty($values[$product_id])){
			foreach($values[$product_id] as $oid => $vals){
				foreach($vals as $val){
					if (!isset($filterVals[$oid])) $filterVals[$oid] = array();
					$filterVals[$oid][] = $val;
				}
			}
		}

		$oidsDiff = array_diff(array_keys($filterVals), array_keys($productVals));
		if (!empty($oidsDiff)){
			foreach($oidsDiff as $od){
				$this->db->query('DELETE FROM '.DB_PREFIX.'ocfilter_option_value_to_product WHERE `product_id` = '.$product_id.' AND `option_id` = '.$od);
				$this->db->query('DELETE FROM '.DB_PREFIX.'ocfilter_option_value_to_product_description WHERE `product_id` = '.$product_id.' AND `option_id` = '.$od);
			}
		}
		
		if (!empty($productVals)) foreach($productVals as $oid => $vals){
			$fv = !empty($filterVals[$oid]) ? $filterVals[$oid] : array();
			foreach($vals as $v){
				$crc = (int)substr(crc32($oid.$v), 1, 9);
				if (isset($allValues[$crc])){
					$allValues[$crc]['found'] = true; //не найденные значения будут удалены ниже
				}
				if (!in_array($v, $fv)){
					// добавить новое значение фильтра
					if (!isset($allValues[$crc])){
						$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value(value_id, option_id) VALUES ('".$crc."', '".$oid."')");
						$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value_description(value_id, option_id, language_id, `name`) VALUES ('".$crc."', '".$oid."', ".$lang.", '".$this->db->escape($v)."')");
						$translitBase = $this->translit($this->alphanum($v, '-'));
						//if ($product_id == 137248) {echo $v.' - '.$translitBase.'<hr />';}
						
						// удалить старые алиасы
						$q = 'ocfilter:'.$oid.':'.$crc;
						while(($pos = array_search($q, $aliases)) !== false){
							unset($aliases[$pos]);
						}
						$this->db->query('DELETE FROM '.DB_PREFIX.'url_alias WHERE `query` = "'.$q.'"');

						$c = 1;
						do{
							$translit = $translitBase.($c > 1 ? '-'.$c : '');
							//if ($c==15) die('bad='.$translit);
							$c++;
						} while(isset($aliases[$translit]));
						$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "url_alias(`query`, `keyword`) VALUES ('ocfilter:".$oid.":".$crc."', '".$this->db->escape($translit)."')");
						$aliases[$translit] = 'ocfilter:'.$oid.':'.$crc;
						$allValues[$crc] = array('value_id' => $crc, 'option_id' => $oid, 'name' => $v, 'found' => true);
						$log .= 'Добавлено значение фильтра: crc = '.$crc.', oid = '.$oid.', name = '.$v.'<br />';
					}
					// добавить новое значение фильтра в товар
					$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value_to_product(product_id, value_id, option_id) VALUES ('".$product_id."', '".$crc."', '".$oid."')");
					$fv[] = $v;
					$log .= 'Добавлено значение фильтра в товар ('.$v.'): crc = '.$crc.', oid = '.$oid.', product = '.$product_id.'<br />';
				}
			}


			//удалить из товара устаревшие фильтры
			$diff = array_diff($fv, $vals);
			if (!empty($diff)) foreach($diff as $d){
				$crc = (int)substr(crc32($oid.$d), 1, 9);
				$this->db->query('DELETE FROM '.DB_PREFIX.'ocfilter_option_value_to_product WHERE `product_id` = '.$product_id.' AND `value_id` = '.$crc.' AND `option_id` = '.$oid);
				$this->db->query('DELETE FROM '.DB_PREFIX.'ocfilter_option_value_to_product_description WHERE `product_id` = '.$product_id.' AND `value_id` = '.$crc.' AND `option_id` = '.$oid);
				$log .= 'Удален устаревший фильтр товара: crc = '.$crc.', oid = '.$oid.', product = '.$product_id.'<br />';
			}
		}
	}

	// удалить устаревшие фильтры
	if (!empty($allValues)) foreach($allValues as $value_id => $data){
		if (!empty($data['found'])) continue;
		$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value WHERE value_id = ".$value_id." AND option_id = ".$data['option_id']);
		$this->db->query("DELETE FROM " . DB_PREFIX . "ocfilter_option_value_description WHERE value_id = ".$value_id." AND option_id = ".$data['option_id']);
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE `query` = 'ocfilter:".$data['option_id'].":".$value_id."'");
		$log .= 'Удален устаревший фильтр: value_id = '.$value_id.', oid = '.$data['option_id'].'<br />';
	}

	// освободить алиасы
	$usedValues = array();
	$query = $this->db->query("SELECT value_id, option_id FROM " . DB_PREFIX . "ocfilter_option_value_description WHERE language_id = ".$lang);
	if (!empty($query->rows)) foreach ($query->rows as $key => $result){
		$usedValues[$result['value_id']] = $result['option_id'];
	}
	foreach($aliases as $k => $q){
		if (substr($q, 0, 9) != 'ocfilter:') continue;
		$d = explode(':', $q);
		$v = $d[2];
		if (!isset($usedValues[$v])){
			$this->db->query('DELETE FROM '.DB_PREFIX.'url_alias WHERE `query` = "'.$q.'"');
		}
	}
	
	// option_to_category
	// $this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_to_category`");
	$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_to_category (option_id, category_id) 
		SELECT p2v.option_id, p2c.category_id 
			FROM " . DB_PREFIX . "ocfilter_option_value_to_product p2v 
			LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p2v.product_id) WHERE p2c.category_id != '0' GROUP BY p2v.option_id, p2c.category_id");

	// option_to_store
	$store_id = 0;
	$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_to_store`");
	$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_to_store (option_id, store_id) SELECT option_id, '" . (int)$store_id . "' AS store_id FROM " . DB_PREFIX . "ocfilter_option");
	
	$this->cache->delete('ocfilter');
	$this->cache->delete('product');
  }
  
  private function capFirst($string, $encoding = 'utf-8'){
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
  }
  
  private function alphanum($str, $replacement = ' '){
	$str = $this->strlower($str);
	$str = preg_replace('/&([a-zA-Z0-9]+);/', ' ', $str);
	$m = $this->str_split($str);
	$result = '';
	for($i=0, $len = count($m[0]); $i<$len; $i++) $result .= in_array($m[0][$i], self::$caseTable) || is_numeric($m[0][$i]) ? $m[0][$i] : ' ';
	$result = preg_replace('/ +/', $replacement, $result);
	$result = trim($result, $replacement);
	return $result;
  }

  private function translit($str){
	return strtr($str, self::$translitTable);
  }

  private function str_split($str){
	preg_match_all('/(?>[\x09\x0A\x0D\x20-\x7E]|[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})/s', $str, $m);
	return $m;
  }
  
  private function strlower($str){
	if (function_exists('mb_strtolower')) return mb_strtolower($str, 'utf-8');
	if (preg_match('/^[\x00-\x7e]*$/', $str)) return strtolower($str);
	return strtr($str, self::$caseTable);
  }


/*
  public function copyAttributesToOCFilter($data = array()){
		//$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_description`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_to_category`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_to_store`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_value`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_value_to_product`");
	    //$this->db->query("TRUNCATE `" . DB_PREFIX . "ocfilter_option_value_description`");

    $this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option (option_id, status, type, sort_order) SELECT attribute_id, '1' AS status, '" . $this->db->escape($data['type']) . "' AS type, sort_order FROM " . DB_PREFIX . "attribute");
    $this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_description (option_id, language_id, name) SELECT attribute_id, language_id, name FROM " . DB_PREFIX . "attribute_description");

    $this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value_to_product (product_id, option_id, value_id) SELECT product_id, attribute_id, SUBSTR(CRC32(CONCAT(attribute_id, text)), 1, 9) AS value_id FROM " . DB_PREFIX . "product_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value (option_id, value_id) SELECT attribute_id, SUBSTR(CRC32(CONCAT(attribute_id, text)), 1, 9) AS value_id FROM " . DB_PREFIX . "product_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY attribute_id, `text`");

		$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_value_description (option_id, value_id, language_id, name) SELECT attribute_id, SUBSTR(CRC32(CONCAT(attribute_id, text)), 1, 9) AS value_id, language_id, text FROM " . DB_PREFIX . "product_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY attribute_id, `text`");

    foreach ($data['option_store'] as $store_id) {
      $this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_to_store (option_id, store_id) SELECT option_id, '" . (int)$store_id . "' AS store_id FROM " . DB_PREFIX . "ocfilter_option");
    }

		$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "ocfilter_option_to_category (option_id, category_id) SELECT p2v.option_id, p2c.category_id FROM " . DB_PREFIX . "ocfilter_option_value_to_product p2v LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p2v.product_id) WHERE p2c.category_id != '0' GROUP BY p2v.option_id, p2c.category_id");

    $this->cache->delete('ocfilter');
    $this->cache->delete('product');
  }
*/
	/*
	 **********************
	 *	Install methods   *
	 **********************
	*/

  public function existsTables() {
    $exists = true;

    $this->config->load('ocfilter');

    foreach ($this->config->get('ocfilter_install_table_steps') as $table => $fields) {
			$query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . $this->db->escape($table) . "'");

			if (!$query->num_rows) {
        $exists = false;
      }
    }

    return $exists;
  }

  public function createTables() {
    $this->config->load('ocfilter');

		foreach($this->config->get('ocfilter_install_table_steps') as $table => $fields) {
      $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . $table . "` (" . implode(", ", $fields) . ") COLLATE='utf8_general_ci' ENGINE=MyISAM");
		}

    return $this->existsTables();
	}

  public function installCode($packages) {
		foreach ($this->getCodeSteps() as $step) {
			if (!in_array($step['package'], $packages)) {
				continue;
			}

			$content = file_get_contents($step['file']);

      preg_match_all('!(#|\<\!--)\s+?ocfilter start.+?ocfilter end\s+?(--\>|)!is', $content, $matches);

			if ($matches && $matches[0]) {
		    $content = str_replace($matches[0], '', $content);
			}

			$search = array();
			$replace = array();

			foreach ($step['actions'] as $code) {
			  if (isset($code['{PREG_QUOTE}'])) {
			    $search[] = '!(' . $code['{SEARCH}'] . ')!sui';
			  } else {
			    $search[] = '!(' . preg_quote($code['{SEARCH}']) . ')!sui';
			  }

			  $replace[] = $code['{REPLACE}'];
			}

			$content = preg_replace($search, $replace, $content);

			$fp = fopen($step['file'], 'w+');
			fwrite($fp, $content);
			fclose($fp);
		}
	}

	public function getCodeSteps() {
  	$this->config->load('ocfilter');

		$steps = $this->config->get('ocfilter_install_code_steps');

    $this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();

		foreach ($steps as $key => $step) {
      if (strpos($step['file'], '/language/')) {
				unset($steps[$key]);

        foreach ($languages as $key => $language) {
          if ($language['status']) {
						$_step = $step;

						$_step['file'] = str_replace('{directory}', $language['directory'], $step['file']);

						$steps[] = $_step;
					}
				}
			}
		}

		return $steps;
	}
}

?>