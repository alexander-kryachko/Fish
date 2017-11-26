<?php
class ControllerFeedGoogleSitemap extends Controller {
	public function index() {
		if ($this->config->get('google_sitemap_status')) {
		
			$output = $this->cache->get('sitemap.'.(int)$this->config->get('config_store_id'));
			
			if (!$output) {
				
			$output  = '<?xml version="1.0" encoding="UTF-8"?>';
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			
			
			$this->load->model('feed/google_sitemap');

		 $products = $this->model_feed_google_sitemap->getProducts();

			foreach ($products as $product) {
				$output .= '<url>';
				$output .= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $product['product_id']))) . '</loc>';
				$output .= '<lastmod>' . substr(max($product['date_added'], $product['date_modified']), 0, 10) . '</lastmod>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>1.0</priority>';
				$output .= '</url>';
			}

			$this->load->model('catalog/category');

			$output .= $this->getCategories(0);

			$query = $this->db->query("SELECT * from " . DB_PREFIX . "filterpro_seo");
			$route_manufacturer = (version_compare('1.5.4', '1.5.3') > 0) ? 'product/manufacturer/product' : 'product/manufacturer/info';
			foreach($query->rows as $row) {
				$filter_url = $row['url'];
				$filterpro_data = unserialize($row['data']);

				$data = array();
				parse_str(str_replace('&amp;', '&', $filterpro_data['url']), $data);
				if(isset($data['route'])) {
					$output .= '<url>';
					if($data['route'] == 'product/category') {
						$output .= '<loc>' . $this->url->link($data['route'], 'path=' . (isset($data['path']) ? $data['path'] : $data['category_id']) . '&' . $filter_url) . '</loc>';
					} elseif($data['route'] == $route_manufacturer) {
						$output .= '<loc>' . $this->url->link($data['route'], 'manufacturer_id=' . $data['manufacturer_id'] . '&' . $filter_url) . '</loc>';
					} else {
						$output .= '<loc>' . $this->url->link($data['route'], $filter_url) . '</loc>';
					}
					$output .= '<changefreq>weekly</changefreq>';
					$output .= '<priority>0.7</priority>';
					$output .= '</url>';
				}
			}

			$this->load->model('catalog/manufacturer');

			$manufacturers = $this->model_catalog_manufacturer->getManufacturers();

			foreach ($manufacturers as $manufacturer) {
				$output .= '<url>';
				$output .= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']))) . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.7</priority>';
				$output .= '</url>';
			}

			$this->load->model('catalog/information');

			$informations = $this->model_catalog_information->getInformations();

			foreach ($informations as $information) {
				$output .= '<url>';
				$output .= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('information/information', 'information_id=' . $information['information_id']))) . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.5</priority>';
				$output .= '</url>';
			}


			$this->load->model('catalog/article');

			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('information/articles') . '</loc>';
			$output .= '<changefreq>monthly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';

			$output .= $this->getArticles(0);
		


				/*------ShopRating------*/

				$output .= '<url>';
				$output .= '<loc>' . $this->url->link('information/shop_rating') . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.5</priority>';
				$output .= '</url>';

				/*----END ShopRating----*/

			
			
			$output .= '</urlset>';

			
				$this->cache->set('sitemap.'.(int)$this->config->get('config_store_id'), $output);
			}
			
			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);
		}
	}

	protected function getCategories($parent_id, $current_path = '') {
		$output = '';

		$results = $this->model_catalog_category->getCategories($parent_id);

		foreach ($results as $result) {
			if (!$current_path) {
				$new_path = $result['category_id'];
			} else {
				$new_path = $current_path . '_' . $result['category_id'];
			}

			$output .= '<url>';
			$output .= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/category', 'path=' . $new_path))) . '</loc>';
			$output .= '<lastmod>' . substr(max($result['date_added'], $result['date_modified']), 0, 10) . '</lastmod>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';

			$output .= $this->getCategories($result['category_id'], $new_path);
		}

		return $output;
	}

	protected function getArticles($parent_id, $current_path = '') {
		$output = '';

		$results = $this->model_catalog_article->getArticles($parent_id);

		foreach ($results as $result) {
			if (!$current_path) {
				$new_path = $result['article_id'];
			} else {
				$new_path = $current_path . '_' . $result['article_id'];
			}

			$output .= '<url>';
			$output .= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('information/article', 'article=' . $new_path))) . '</loc>';
			$output .= '<changefreq>monthly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';

			$output .= $this->getArticles($result['article_id'], $new_path);
		}

		return $output;
	}
		
}
?>