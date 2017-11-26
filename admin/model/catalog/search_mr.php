<?php

class ModelCatalogSearchMr extends Model {

	public function getDefaultOptions() {

		return array(
			'key' => '65bba470cf648218e114806f78b17e4b',
			'min_word_length' => 2,
			'fields' => array(
				'name' => array(
					'search' => 'contains',
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 80,
						'phrase' => 60,
						'word' => 40
					)
				),
				'description' => array(
					'search' => 'contains',
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 20,
						'word' => 10
					)
				),
				'tags' => array(
					'search' => 'contains',
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 45
					)
				),
				'attributes' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'model' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'exclude_characters' => '-/_',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'sku' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'upc' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'ean' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'jan' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'isbn' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
				'mpn' => array(
					'search' => 0,
					'phrase' => 'cut',
					'use_morphology' => 1,
					'use_relevance' => 1,
					'logic' => 'OR',
					'relevance' => array(
						'start' => 0,
						'phrase' => 0,
						'word' => 0
					)
				),
			),
		);
	}

	public function getFields() {

		return array('name',
			'description',
			'tags',
			'attributes',
			'model',
			'sku',
			'upc',
			'ean',
			'jan',
			'isbn',
			'mpn');
	}

	public function install() {
		
				
		$a5101cceeaf3403bc117ff94fdd91324b = array (
						'model' => true,
			'sku' => true,
			'upc' => true,
			'ean' => true,
			'jan' => true,
			'isbn' => true,
			'mpn' => true
		);
		
		$ae1a540de9b0be74be27f0217ae47846b = $this->db->query("SHOW INDEX FROM " . DB_PREFIX . "product");
		
		foreach ($ae1a540de9b0be74be27f0217ae47846b->rows as $a1daebe5dae7bbcaff94b0c949407a672) {
						if (isset($a1daebe5dae7bbcaff94b0c949407a672['Column_name']) && array_key_exists($a1daebe5dae7bbcaff94b0c949407a672['Column_name'], $a5101cceeaf3403bc117ff94fdd91324b)) {
				$a5101cceeaf3403bc117ff94fdd91324b[$a1daebe5dae7bbcaff94b0c949407a672['Column_name']] = false;
			}
		}
		
		foreach ($a5101cceeaf3403bc117ff94fdd91324b as $ad7da9d0b779734d910ccf576b4094166 => $a3fbbaeeb1f58c0166203e49a7f0b7162) {
			if ($a3fbbaeeb1f58c0166203e49a7f0b7162) {
				$this->db->query("ALTER TABLE " . DB_PREFIX . "product ADD INDEX ( " . $ad7da9d0b779734d910ccf576b4094166 . " )");
			}
		}				
	}
}
//author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (roman@pinkovskiy.com fisherway.com.ua)
