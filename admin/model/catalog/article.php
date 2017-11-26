<?php
class ModelCatalogArticle extends Model {
	public function addArticle($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "article SET parent_id = '" . (int)$data['parent_id'] . "', alternative_link = '" . $data['alternative_link'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', viewed = '" . (int)$data['viewed'] . "', product = '" . (isset($data['product']) ? serialize($data['product']) : '') . "', date_modified = NOW(), date_added = '" . $data['date_added'] . "'");
	
		$article_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "article SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE article_id = '" . (int)$article_id . "'");
		}
		
		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "article_description SET article_id = '" . (int)$article_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "', related_title = '" . $this->db->escape($value['related_title']) . "'");
		}
		
		if (isset($data['article_store'])) {
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "article_to_store SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "article_to_layout SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('article');

		return $article_id;
	}
	
	public function editArticle($article_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "article SET parent_id = '" . (int)$data['parent_id'] . "', alternative_link = '" . $data['alternative_link'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', viewed = '" . (int)$data['viewed'] . "', product = '" . (isset($data['product']) ? serialize($data['product']) : '') . "', date_added = '" . $data['date_added'] ."', date_modified = NOW() WHERE article_id = '" . (int)$article_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "article SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE article_id = '" . (int)$article_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "article_description WHERE article_id = '" . (int)$article_id . "'");

		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "article_description SET article_id = '" . (int)$article_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "', seo_title = '" . $this->db->escape($value['seo_title']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "', related_title = '" . $this->db->escape($value['related_title']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "article_to_store WHERE article_id = '" . (int)$article_id . "'");
		
		if (isset($data['article_store'])) {		
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "article_to_store SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "article_to_layout WHERE article_id = '" . (int)$article_id . "'");

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "article_to_layout SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('article');
	}
	
	public function deleteArticle($article_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "article WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "article_description WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "article_to_store WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "article_to_layout WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id . "'");
		
		$query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "article WHERE parent_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteArticle($result['article_id']);
		}
		
		$this->cache->delete('article');
	} 

	public function getArticle($article_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id . "') AS keyword FROM " . DB_PREFIX . "article WHERE article_id = '" . (int)$article_id . "'");
		
		return $query->row;
	}

	public function getArticles($parent_id = 0) {
		$article_data = $this->cache->get('article.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
	
		if (!$article_data) {
			$article_data = array();
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) WHERE a.parent_id = '" . (int)$parent_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name ASC");
		
			foreach ($query->rows as $result) {
				$article_data[] = array(
					'article_id' => $result['article_id'],
					'name'        => $this->getPath($result['article_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);
			
				$article_data = array_merge($article_data, $this->getArticles($result['article_id']));
			}	
	
			$this->cache->set('article.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $article_data);
		}
		
		return $article_data;
	} 
	
	public function getParentArticles($data = array()) {

			$article_data = array();
		
			$sql = "SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY a.article_id";

		$sql .= " ORDER BY ad.name";

		$sql .= " ASC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		
			foreach ($query->rows as $result) {
				$article_data[] = array(
					'article_id' => $result['article_id'],
					'name'        => $result['name']
				);
			}	

		return $article_data;
	}
	
	public function getPath($article_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) WHERE a.article_id = '" . (int)$article_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
	
	public function getArticleDescriptions($article_id) {
		$article_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_description WHERE article_id = '" . (int)$article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_description_data[$result['language_id']] = array(
				'seo_title'        => $result['seo_title'],
				'seo_h1'           => $result['seo_h1'],
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'short_description'      => $result['short_description'],
				'description'      => $result['description'],
				'related_title'     => $result['related_title']
			);
		}
		
		return $article_description_data;
	}

	public function getParentName($article_id) {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_description WHERE article_id = '" . (int)$article_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->row) {
			return $query->row['name'];
		} else {
			return false;	
		}
	}	
	
	public function getArticleStores($article_id) {
		$article_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_to_store WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_store_data[] = $result['store_id'];
		}
		
		return $article_store_data;
	}

	public function getProductRelated($article_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article WHERE article_id = '" . (int)$article_id . "'");

		if ($query->row) {
			return unserialize($query->row['product']);
		} else {
			return false;	
		}

	}

	public function getArticleLayouts($article_id) {
		$article_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_to_layout WHERE article_id = '" . (int)$article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $article_layout_data;
	}
		
	public function getTotalArticles() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article");
		
		return $query->row['total'];
	}	
		
	public function getTotalArticlesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}

	public function getTotalArticlesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}		

	public function getArticlesByParentId($parent_id = 0) {
		$query = $this->db->query("SELECT *, (SELECT COUNT(parent_id) FROM " . DB_PREFIX . "article WHERE parent_id = a.article_id) AS children FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) WHERE a.parent_id = '" . (int)$parent_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");
		
		return $query->rows;
	}

	public function getAllArticles() {
		$article_data = $this->cache->get('article.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));

		if (!$article_data || !is_array($article_data)) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY a.parent_id, a.sort_order, ad.name");

			$article_data = array();
			foreach ($query->rows as $row) {
				$article_data[$row['parent_id']][$row['article_id']] = $row;
			}

			$this->cache->set('article.all.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $article_data);
		}

		return $article_data;
	}

		public function getTotalArticlesByParent($article_id) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article WHERE parent_id = '" . (int)$article_id . "'");
	
			return $query->row['total'];
		}

		public function createArticles() {
		$this->dropArticles();
		$create_article = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article` (`article_id` int(11) NOT NULL AUTO_INCREMENT,`image`varchar(255) DEFAULT NULL,`parent_id` int(11) NOT NULL DEFAULT '0',`alternative_link` varchar(255) NOT NULL,`sort_order` int(3) NOT NULL DEFAULT '0',`status` tinyint(1) NOT NULL,`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',`product` text NOT NULL,`viewed` int(7) NOT NULL DEFAULT '0', PRIMARY KEY (`article_id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
		$this->db->query($create_article);
		$create_articles_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_description` (`article_id` int(11) NOT NULL,`language_id` int(11) NOT NULL,`name` varchar(255) NOT NULL DEFAULT '',`short_description`text NOT NULL,`description`text NOT NULL,`meta_description` varchar(255) NOT NULL,`meta_keyword` varchar(255) NOT NULL,`seo_title` varchar(255) NOT NULL,`seo_h1` varchar(255) NOT NULL,`related_title` varchar(255) NOT NULL,PRIMARY KEY (`article_id`,`language_id`),KEY `name` (`name`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
		$this->db->query($create_articles_descriptions);
		$create_article_to_layout = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_to_layout` (`article_id` int(11) NOT NULL,`store_id` int(11) NOT NULL,`layout_id` int(11) NOT NULL,PRIMARY KEY(`article_id`,`store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
		$this->db->query($create_article_to_layout);
		$create_article_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_to_store` (`article_id` int(11) NOT NULL,`store_id` int(11) NOT NULL,PRIMARY KEY (`article_id`,`store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
		$this->db->query($create_article_to_store);
		$alias = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'information/articles'");
		if (!$alias->row) {
		$create_articles_alias = "INSERT INTO `" . DB_PREFIX . "url_alias` (query, keyword) VALUES ('information/articles', 'articles');";
		$this->db->query($create_articles_alias);
		}
	}

		public function dropArticles() {
			$sql = "DROP TABLE IF EXISTS `" . DB_PREFIX . "article`;";
			$this->db->query($sql);
			$sql = "DROP TABLE IF EXISTS `" . DB_PREFIX . "article_description`;";
			$this->db->query($sql);
			$sql = "DROP TABLE IF EXISTS `" . DB_PREFIX . "article_to_layout`;";
			$this->db->query($sql);
			$sql = "DROP TABLE IF EXISTS `" . DB_PREFIX . "article_to_store`;";
			$this->db->query($sql);
			$sql = "DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information/articles'";
			$this->db->query($sql);
		}
}
?>