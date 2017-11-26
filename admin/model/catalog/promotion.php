<?php

class ModelCatalogPromotion extends Model {
	
	public function getPromotionDescriptions($aef90c0c6b840a395c55ae39cf3120b69) {
		
		$a3b2585a0ebf60811a3b54ed641814f7f = array();

		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query("SELECT * , (SELECT pd.name FROM " . DB_PREFIX . "product_description pd WHERE pd.product_id = pr.gift_id AND pd.language_id = pr.language_id) AS gift_name FROM " . DB_PREFIX . "promotion pr WHERE pr.promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'");

		foreach ($aaaf113aee58d51d292cfc853c8cee3fc->rows as $af3c71ace109c95793e97efd1c6903481) {
			$a3b2585a0ebf60811a3b54ed641814f7f[$af3c71ace109c95793e97efd1c6903481['language_id']] = array(
				'promotion_id' => $af3c71ace109c95793e97efd1c6903481['promotion_id'],
				'gift_id' => $af3c71ace109c95793e97efd1c6903481['gift_id'],
				'gift_name' => $af3c71ace109c95793e97efd1c6903481['gift_name'],
				'language_id' => $af3c71ace109c95793e97efd1c6903481['language_id'],
				'image' => $af3c71ace109c95793e97efd1c6903481['image'],
				'name' => $af3c71ace109c95793e97efd1c6903481['name'],
				'description' => $af3c71ace109c95793e97efd1c6903481['description'],
				'status' => $af3c71ace109c95793e97efd1c6903481['status'],
				'date_start' => $af3c71ace109c95793e97efd1c6903481['date_start'],
				'date_end' => $af3c71ace109c95793e97efd1c6903481['date_end'],
				'products' => $this->getPromotionProducts($af3c71ace109c95793e97efd1c6903481['promotion_id'], $af3c71ace109c95793e97efd1c6903481['language_id'])
			);
		}

		return $a3b2585a0ebf60811a3b54ed641814f7f;
	}
	
	public function getPromotion($aef90c0c6b840a395c55ae39cf3120b69) {

		$a08a3bf5ccd34368c7b08b8052a19b8e9 = "SELECT * FROM " . DB_PREFIX . "promotion p WHERE p.language_id = '" . (int) $this->config->get('config_language_id') . "' AND p.promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'";

		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query($a08a3bf5ccd34368c7b08b8052a19b8e9);

		return $aaaf113aee58d51d292cfc853c8cee3fc->row;
	}
	
	public function addPromotion($ab836259e92f298fb5a91e8e306810cad, $aef90c0c6b840a395c55ae39cf3120b69=0) {
		
				if (!$aef90c0c6b840a395c55ae39cf3120b69) {
			
						$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query("SELECT MAX(promotion_id) as promotion_id FROM " . DB_PREFIX . "promotion");

			if ($aaaf113aee58d51d292cfc853c8cee3fc->row) {
				$aef90c0c6b840a395c55ae39cf3120b69 = $aaaf113aee58d51d292cfc853c8cee3fc->row['promotion_id'];
			} else {
				$aef90c0c6b840a395c55ae39cf3120b69 = 0;
			}
			$aef90c0c6b840a395c55ae39cf3120b69++;
		}
		
		foreach ($ab836259e92f298fb5a91e8e306810cad['promotion_description'] as $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c => $a32a2fb1efbbfed446ecf8d7a87d7093e) {

			$this->db->query("INSERT INTO " . DB_PREFIX . "promotion SET "
				. "`promotion_id` = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "', "
				. "`gift_id` = '" . (int) $a32a2fb1efbbfed446ecf8d7a87d7093e['gift_id'] . "', "
				. "`language_id` = '" . (int) $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c . "', "
				. "`image` = '" . $this->db->escape(html_entity_decode($a32a2fb1efbbfed446ecf8d7a87d7093e['image'], ENT_QUOTES, 'UTF-8')) . "', "
				. "`name` = '" . $this->db->escape(html_entity_decode($a32a2fb1efbbfed446ecf8d7a87d7093e['name'], ENT_QUOTES, 'UTF-8')) . "', "
				. "`description` = '" . $this->db->escape(html_entity_decode($a32a2fb1efbbfed446ecf8d7a87d7093e['description'], ENT_QUOTES, 'UTF-8')) . "', "
				. "`status` = '" . (int) $a32a2fb1efbbfed446ecf8d7a87d7093e['status'] . "', "
				. "`date_start` = '" . $this->db->escape(html_entity_decode($a32a2fb1efbbfed446ecf8d7a87d7093e['date_start'], ENT_QUOTES, 'UTF-8')) . "', "
				. "`date_end` = '" . $this->db->escape(html_entity_decode($a32a2fb1efbbfed446ecf8d7a87d7093e['date_end'], ENT_QUOTES, 'UTF-8')) . "'");
			
			if (isset($a32a2fb1efbbfed446ecf8d7a87d7093e['products']) && $a32a2fb1efbbfed446ecf8d7a87d7093e['products']) {
				$this->editPromotionProducts($aef90c0c6b840a395c55ae39cf3120b69, $a32a2fb1efbbfed446ecf8d7a87d7093e['products'], $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c);
			}
		}
	}
	
	public function editPromotion($ab836259e92f298fb5a91e8e306810cad, $aef90c0c6b840a395c55ae39cf3120b69) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "promotion WHERE promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'");
		
		$this->cache->delete('promotion');
		
		$this->addPromotion($ab836259e92f298fb5a91e8e306810cad, $aef90c0c6b840a395c55ae39cf3120b69);		
	}

	public function deletePromotion($aef90c0c6b840a395c55ae39cf3120b69) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "promotion WHERE promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_promotion WHERE promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'");
	}
	
	public function deletePromotionProduct($a2f068e8c802c070fef35578430eab001) {
		$this->db->query("UPDATE " . DB_PREFIX . "promotion SET gift_id = '', status = 0 WHERE gift_id = '" . (int) $a2f068e8c802c070fef35578430eab001 . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_promotion WHERE product_id = '" . (int) $a2f068e8c802c070fef35578430eab001 . "'");
	}
	
	public function getPromotions($ab836259e92f298fb5a91e8e306810cad = array()) {

		$a08a3bf5ccd34368c7b08b8052a19b8e9 = "SELECT p.image as gift_image, pr.* FROM " . DB_PREFIX . "promotion pr LEFT JOIN " . DB_PREFIX . "product p ON pr.gift_id = p.product_id WHERE pr.language_id = '" . (int) $this->config->get('config_language_id') . "' ";

		$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " ORDER BY pr.promotion_id DESC";

		if (isset($ab836259e92f298fb5a91e8e306810cad['start']) || isset($ab836259e92f298fb5a91e8e306810cad['limit'])) {
			if ($ab836259e92f298fb5a91e8e306810cad['start'] < 0) {
				$ab836259e92f298fb5a91e8e306810cad['start'] = 0;
			}

			if ($ab836259e92f298fb5a91e8e306810cad['limit'] < 1) {
				$ab836259e92f298fb5a91e8e306810cad['limit'] = 20;
			}

			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " LIMIT " . (int) $ab836259e92f298fb5a91e8e306810cad['start'] . "," . (int) $ab836259e92f298fb5a91e8e306810cad['limit'];
		}

		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query($a08a3bf5ccd34368c7b08b8052a19b8e9);

		return $aaaf113aee58d51d292cfc853c8cee3fc->rows;
	}
	
	public function getTotalPromotions() {
		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "promotion pr WHERE pr.language_id = '" . (int) $this->config->get('config_language_id') . "'");

		return $aaaf113aee58d51d292cfc853c8cee3fc->row['total'];
	}

	public function getPromotionProducts($aef90c0c6b840a395c55ae39cf3120b69, $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c=0) {
		
		if (!$a8dc17e1368e9ea1d9f30bb4fd8eb8d6c) {
		  $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c = (int) $this->config->get('config_language_id');
		}
		
		$a08a3bf5ccd34368c7b08b8052a19b8e9 = "SELECT pd.* FROM " . DB_PREFIX . "product_description pd LEFT JOIN  " . DB_PREFIX . "product_promotion pp ON pp.product_id = pd.product_id  WHERE pd.language_id = '" . (int) $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c . "' AND pp.language_id = '" . (int) $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c . "' AND pp.promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'";

		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query($a08a3bf5ccd34368c7b08b8052a19b8e9);
		
		$a0176129bda26b5201f96dae662c79e05 = array();
		
		foreach ($aaaf113aee58d51d292cfc853c8cee3fc->rows as $a0a1eaa2898c76de42494ce2ea2ba9e60) {
			$a0176129bda26b5201f96dae662c79e05[$a0a1eaa2898c76de42494ce2ea2ba9e60['product_id']] = $a0a1eaa2898c76de42494ce2ea2ba9e60['name'];
		}
		
		return $a0176129bda26b5201f96dae662c79e05;
	}
	
	public function addPromotionProducts($aef90c0c6b840a395c55ae39cf3120b69, $a0176129bda26b5201f96dae662c79e05, $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c) {
		
		if (!$a0176129bda26b5201f96dae662c79e05 || !is_array($a0176129bda26b5201f96dae662c79e05)) {
			return false;
		}
		
		foreach ($a0176129bda26b5201f96dae662c79e05 as $a2f068e8c802c070fef35578430eab001) {
			if ($a2f068e8c802c070fef35578430eab001) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_promotion SET "
					. "`promotion_id` = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "', "
					. "`language_id` = '" . (int) $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c . "', "
					. "`product_id` = '" . (int) $a2f068e8c802c070fef35578430eab001 . "'");
			}
		}
	}
	
	public function editPromotionProducts($aef90c0c6b840a395c55ae39cf3120b69, $a0176129bda26b5201f96dae662c79e05, $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c) {
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_promotion WHERE promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "' AND language_id = '" . (int) $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c . "'");
		$this->addPromotionProducts($aef90c0c6b840a395c55ae39cf3120b69, $a0176129bda26b5201f96dae662c79e05, $a8dc17e1368e9ea1d9f30bb4fd8eb8d6c);
		
	}

	public function deletePromotionProducts($aef90c0c6b840a395c55ae39cf3120b69) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_promotion WHERE promotion_id = '" . (int) $aef90c0c6b840a395c55ae39cf3120b69 . "'");
	}

	public function getThumb($a0cf0a79f7fa5817e44390acfff7f6282) {

		$this->load->model('tool/image');

		if (!isset($a0cf0a79f7fa5817e44390acfff7f6282) || !$a0cf0a79f7fa5817e44390acfff7f6282 || !file_exists(DIR_IMAGE . $a0cf0a79f7fa5817e44390acfff7f6282)) {
			$a0cf0a79f7fa5817e44390acfff7f6282 = 'no_image.jpg';
		}

		return $this->model_tool_image->resize($a0cf0a79f7fa5817e44390acfff7f6282, 100, 100);
	}
	
	public function getProducts($ab836259e92f298fb5a91e8e306810cad = array()) {
		$a08a3bf5ccd34368c7b08b8052a19b8e9 = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

		if (!empty($ab836259e92f298fb5a91e8e306810cad['filter_category_id'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";			
		}

		$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 

		if (!empty($ab836259e92f298fb5a91e8e306810cad['filter_name'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND pd.name LIKE '" . $this->db->escape($ab836259e92f298fb5a91e8e306810cad['filter_name']) . "%'";
		}

		if (!empty($ab836259e92f298fb5a91e8e306810cad['filter_model'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND p.model LIKE '" . $this->db->escape($ab836259e92f298fb5a91e8e306810cad['filter_model']) . "%'";
		}

		if (!empty($ab836259e92f298fb5a91e8e306810cad['filter_price'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND p.price LIKE '" . $this->db->escape($ab836259e92f298fb5a91e8e306810cad['filter_price']) . "%'";
		}

		if (isset($ab836259e92f298fb5a91e8e306810cad['filter_quantity']) && !is_null($ab836259e92f298fb5a91e8e306810cad['filter_quantity'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND p.quantity = '" . $this->db->escape($ab836259e92f298fb5a91e8e306810cad['filter_quantity']) . "'";
		}

		if (isset($ab836259e92f298fb5a91e8e306810cad['filter_status']) && !is_null($ab836259e92f298fb5a91e8e306810cad['filter_status'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND p.status = '" . (int)$ab836259e92f298fb5a91e8e306810cad['filter_status'] . "'";
		}
		
		if (isset($ab836259e92f298fb5a91e8e306810cad['filter_category_id']) && !is_null($ab836259e92f298fb5a91e8e306810cad['filter_category_id'])) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " AND p2c.category_id = '" . (int)$ab836259e92f298fb5a91e8e306810cad['filter_category_id'] . "'";
		}

		$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " GROUP BY p.product_id";

		$a91116ebc3ac17da942a456cae03e32a9 = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
		);	

		if (isset($ab836259e92f298fb5a91e8e306810cad['sort']) && in_array($ab836259e92f298fb5a91e8e306810cad['sort'], $a91116ebc3ac17da942a456cae03e32a9)) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " ORDER BY " . $ab836259e92f298fb5a91e8e306810cad['sort'];	
		} else {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " ORDER BY pd.name";	
		}

		if (isset($ab836259e92f298fb5a91e8e306810cad['order']) && ($ab836259e92f298fb5a91e8e306810cad['order'] == 'DESC')) {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " DESC";
		} else {
			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " ASC";
		}

		if (isset($ab836259e92f298fb5a91e8e306810cad['start']) || isset($ab836259e92f298fb5a91e8e306810cad['limit'])) {
			if ($ab836259e92f298fb5a91e8e306810cad['start'] < 0) {
				$ab836259e92f298fb5a91e8e306810cad['start'] = 0;
			}				

			if ($ab836259e92f298fb5a91e8e306810cad['limit'] < 1) {
				$ab836259e92f298fb5a91e8e306810cad['limit'] = 20;
			}	

			$a08a3bf5ccd34368c7b08b8052a19b8e9 .= " LIMIT " . (int)$ab836259e92f298fb5a91e8e306810cad['start'] . "," . (int)$ab836259e92f298fb5a91e8e306810cad['limit'];
		}
		
		$aaaf113aee58d51d292cfc853c8cee3fc = $this->db->query($a08a3bf5ccd34368c7b08b8052a19b8e9);

		return $aaaf113aee58d51d292cfc853c8cee3fc->rows;
	}	
	
	public function getDefaultOptions() {

		return array(
			'key' => 'e6109176cf2aeae9e1f7c2217c05fff1',
			'product' => array(
				'image_width' => 80,
				'image_height' => 80,
				'status' => '1'
			),
			'category' => array(
				'image_width' => 25,
				'image_height' => 25,
				'status' => '1'
			),
			'popup' => array(
				'image_width' => 60,
				'image_height' => 60
			),
			'popup_product' => array(
				'image_width' => 40,
				'image_height' => 40
			),
			'popup_products' => 6
		);
	}

	public function install() {

		$this->uninstall();

		$this->db->query("
			CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "promotion (
				`promotion_id` int(11) NOT NULL,
				`gift_id` int(11) NOT NULL,
				`language_id` int(11) NOT NULL,
				`image` varchar(255) NOT NULL,
				`name` text NOT NULL,
				`description` text NOT NULL,
				`status` tinyint(1) NOT NULL,
				`date_start` date NOT NULL DEFAULT '0000-00-00',
				`date_end` date NOT NULL DEFAULT '0000-00-00',
				KEY (`promotion_id`, `language_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci
		");
		
		$this->db->query("
			CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_promotion (
				`promotion_id` int(11) NOT NULL,
				`product_id` int(11) NOT NULL,
				`language_id` int(11) NOT NULL,
				KEY (`promotion_id`, `product_id`, `language_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci
		");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "promotion");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "promotion_product");
	}	
}
//author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (marketing@fisherway.com.ua fisherway.com.ua)
