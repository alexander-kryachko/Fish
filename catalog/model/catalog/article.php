<?php
class ModelCatalogArticle extends Model {
	public function getArticle($article_id) {
		return $this->getArticles((int)$article_id, 'by_id');
	}

	public function getArticles($id = 0, $type = 'by_parent') {
		static $data = null;

		if ($data === null) {
			$data = array();

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND a.status = '1' ORDER BY a.parent_id, a.sort_order, ad.name");

			foreach ($query->rows as $row) {
				$data['by_id'][$row['article_id']] = $row;
				$data['by_parent'][$row['parent_id']][] = $row;
			}
		}

		return ((isset($data[$type]) && isset($data[$type][$id])) ? $data[$type][$id] : array());
	}

	public function getArticlesByParentId($article_id) {
		$article_data = array();

		$articles = $this->getArticles((int)$article_id);

		foreach ($articles as $article) {
			$article_data[] = $article['article_id'];

			$children = $this->getArticlesByParentId($article['article_id']);

			if ($children) {
				$article_data = array_merge($children, $article_data);
			}
		}

		return $article_data;
	}

	public function getArticlesList($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE NOT EXISTS (SELECT parent_id FROM " . DB_PREFIX . "article b WHERE b.parent_id = a.article_id) AND a.parent_id = '" . (int)$data['article_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND a.status = '1' ORDER BY a.sort_order, a.date_added DESC, LCASE(ad.name) LIMIT " . (int)$data['start'] . "," . (int)$data['limit']);

		return $query->rows;
	}

	public function getLatestArticles($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_description ad ON (a.article_id = ad.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE NOT EXISTS (SELECT parent_id FROM " . DB_PREFIX . "article b WHERE b.parent_id = a.article_id) AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND a.status = '1' ORDER BY a.date_added DESC LIMIT " . (int)$data['start'] . "," . (int)$data['limit']);
				
		if ($query->num_rows) {
			return $query->rows;
		}
	}

	public function getProductRelated($article_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article WHERE article_id = '" . (int)$article_id . "'");

		if ($query->row) {
			return unserialize($query->row['product']);
		} else {
			return false;	
		}
	}

	public function getArticlesLayoutId($route) {
		$query = $this->db->query("SELECT layout_id FROM " . DB_PREFIX . "layout_route WHERE route = '".$route."' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");							if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;	
		}	
	}

	public function getArticleLayoutId($article_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_to_layout WHERE article_id = '" . (int)$article_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return $this->config->get('config_layout_article');
		}
	}

	public function getTotalArticlesByArticleId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE NOT EXISTS (SELECT parent_id FROM " . DB_PREFIX . "article b WHERE b.parent_id = a.article_id) AND a.parent_id = '" . (int)$parent_id . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND a.status = '1' AND a.sort_order <> '-1'");

		return $query->row['total'];
	}

	public function getTotalArticles() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article a LEFT JOIN " . DB_PREFIX . "article_to_store a2s ON (a.article_id = a2s.article_id) WHERE NOT EXISTS (SELECT parent_id FROM " . DB_PREFIX . "article b WHERE b.parent_id = a.article_id) AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND a.status = '1' AND a.sort_order <> '-1'");

		return $query->row['total'];
	}

	public function updateViewed($article_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "article SET viewed = (viewed + 1) WHERE article_id = '" . (int)$article_id . "'");
	}
}
?>