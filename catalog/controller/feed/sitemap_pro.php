
<?php

class ControllerFeedSitemapPro extends Controller {

	private $sitemaplog;
	private $limit = 50000;
	private $gzip_level = 9;
	private $categories = array();	
	private $category_data = array();	
	private $products = array();	

	public function __construct($registry) {
			$this->sitemaplog = new Log('sitemaplog.log');
			parent::__construct($registry);
			
			$this->load->model('feed/sitemap_pro');
			$this->load->model('catalog/manufacturer');
			 
			 
			$results  = $this->model_feed_sitemap_pro->getCategories(0);
			 foreach ($results as $row) {
				$category_data[$row['parent_id']][$row['category_id']] = $row;
			}
		
			
		$this->categories = $category_data;
					
		$this->BuildPath();
		
		unset ($this->categories);
		
		
		}
	
	

	private function BuildPath($parent_id = 0, $current_path = null) {
		
		$new_path = '';
	 
		if (array_key_exists($parent_id, $this->categories)) {
			$results = $this->categories[$parent_id];

			foreach ($results as $result) {
				if (!isset($current_path)) {
					$new_path = $result['category_id'];
				} else {
					$new_path = $current_path . '_' . $result['category_id'];
				}
			
				
	
				if (array_key_exists($result['category_id'], $this->categories)) {
					$children = $this->BuildPath($result['category_id'], $new_path);
				}
				
				$result['path']  = $new_path;
				
				$this->category_data[$result['category_id']] = $result;
					
				}
    		}

	}
			

			

	
	public function index()	{
	
		
	$this->sitemaplog->write('sitemap_start-----------------------');

	/*	
		if (($_SERVER['SERVER_ADDR'] != '127.0.0.1') && (!isset($this->session->data['token']))) {
		
			$this->sitemaplog->write('Hack attempt from ' . $_SERVER['SERVER_ADDR']);
			
			die;
		
		}
	*/	
		$starttime = microtime(true);
		
		if ($this->config->get('sitemap_pro_status')) {
		
			
					
		
			
			$limit = $this->config->get('sitemap_limit');
			$gzip_level = $this->config->get('gzip_level');
			
					
			if (isset($limit)) {
					$this->limit =  $limit;
				} 
					
			if (isset($gzip_level)) {
					$this->gzip_level =  $gzip_level;
					}
					
			if (isset($this->request->post['parts'])) {	

						
				
				$parts =  (int)$this->request->post['parts'];
				
				}
				
				$output = '<?xml version="1.0" encoding="UTF-8"?>';
				$output.= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
				$output.= '<sitemap>';
				$output.= '<loc>' . HTTP_SERVER . 'sm/base.xml.gz</loc>';
				$output.= '<lastmod>' . date("Y-m-d") . '</lastmod>';
				$output.= '</sitemap>';
				
				// start makebase
				
				//$this->cleanDir();
				$this->makebase();
				
				// start product
				if ($this->config->get('sitemap_pro_product_status') && isset($this->request->post['parts'])) {
				
					
					$this->load->model('feed/sitemap_pro');
					
						
				
					for ($part = 0; $part <= $parts; $part++) {
					
						$output.= '<sitemap>';
						$output.= '<loc>' . HTTP_SERVER . 'sm/products' . $part . '.xml.gz</loc>';
						$output.= '<lastmod>' . date("Y-m-d") . '</lastmod>';
						$output.= '</sitemap>';
														
					}
				}   else {
					$this->sitemaplog->write('products disabled');
				}
				
				$output.= '</sitemapindex>';
				

				$file = 'sm/sitemap.xml';
				$handle = fopen($file, 'w');
				flock($handle, LOCK_EX);
				fwrite($handle, $output);
				flock($handle, LOCK_UN);
				fclose($handle);
				
				$this->sitemaplog->write('sitemap_end | limit:' . $this->limit . ' | gzip_level:' . $this->gzip_level);
				
				$time =  microtime(true) - $starttime;
				
										
				$this->sitemaplog->write('total time: ' . $time);
		 		
			
		}  else {
		
			$this->sitemaplog->write('Failed_Turn_it_on');

		}
				
	}
	
	private function makebase() {
		
		$this->sitemaplog->write('base_start');
		
		$output = '<?xml version="1.0" encoding="UTF-8"?>';
		$output.= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		// make link for main page thanks for rb2
		$output.= '<url>';
		$output.= '<loc>' . HTTP_SERVER . '</loc>';
		$output.= '<changefreq>weekly</changefreq>';
		$output.= '<priority>1.0</priority>';
		$output.= '</url>';
		
		// make one query tree of categories 
		if ($this->config->get('sitemap_pro_category_status')) {
			$this->sitemaplog->write('--categories set start--');
			 
		foreach ($this->category_data as $category) {
				$output.= '<url>';
				$output.= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/category', 'path=' . $category['path']))) . '</loc>';
				$output.= '<lastmod>' . substr(max($category['date_added'], $category['date_modified']) , 0, 10) . '</lastmod>';
				$output.= '<changefreq>weekly</changefreq>';
				$output.= '<priority>0.7</priority>';
				$output.= '</url>';
			}
			$this->sitemaplog->write('--categories set end--');
		}   else {
			$this->sitemaplog->write('categories disabled');
		}
		
		   
		
		// make manufacturers
		if ($this->config->get('sitemap_pro_manufacturer_status')) {
			$this->sitemaplog->write('--manufacturer set start--');
			$this->load->model('catalog/manufacturer');
			$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
			foreach($manufacturers as $manufacturer) {
				$output.= '<url>';
				$output.= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']))) . '</loc>';
				$output.= '<changefreq>weekly</changefreq>';
				$output.= '<priority>0.7</priority>';
				$output.= '</url>';
			}
			$this->sitemaplog->write('--manufacturer set end--');
		}   else {
			$this->sitemaplog->write('manufacturer disabled');
		} 
		// make informations
		if ($this->config->get('sitemap_pro_information_status')) {
			$this->sitemaplog->write('--information set start--');
			$this->load->model('catalog/information');
			$informations = $this->model_catalog_information->getInformations();
			foreach($informations as $information) {
				$output.= '<url>';
				$output.= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('information/information', 'information_id=' . $information['information_id']))) . '</loc>';
				$output.= '<changefreq>weekly</changefreq>';
				$output.= '<priority>0.5</priority>';
				$output.= '</url>';
			}
			$this->sitemaplog->write('--information set end--');
		} else {
			$this->sitemaplog->write('information disabled');
		}
		
		$output.= '</urlset>';
		$file = 'sm/base.xml.gz';
		$handle = fopen($file, 'w');
		flock($handle, LOCK_EX);
		fwrite($handle, gzencode($output, $this->gzip_level));
		flock($handle, LOCK_UN);
		fclose($handle);
		
		$this->sitemaplog->write('base_end');
							
		$json['message'] = '***Sitemap ready***';
			
		$this->response->setOutput(json_encode($json));		
		
		
	}
	
	
	
	public function makeproducts()	{
	
		
		
		$json = array();
		
		$limit = 0;
		
		$part = 0;
		
		$ofset = 0;
		
		

		
	
		if (isset($this->request->post['limit'])) {
			$limit = (int)$this->request->post['limit'];
		} else {
			$json['error'] = 'limit_error';
		}
		
		if (isset ($this->request->post['part'])) {
			$part =  (int)$this->request->post['part'];
		} else {
			$json['error'] = 'part_error';
		}
		
		if (isset ($this->request->post['ofset'])) {
			$ofset =  (int)$this->request->post['ofset'];
		} else {
			$json['error'] = 'ofset_error';
		}
	
	
		$gzip_level =  $this->config->get('gzip_level');
		
	
		

		if (!isset($limit)) {
			$limit = $this->limit;
		}

		
		if (!isset($gzip_level)) {
			$gzip_level = $this->gzip_level;
		}
		
		$this->sitemaplog->write('start products part#'. $part . '|' . $ofset);
		

		
		$ofset = $part * 50000 + $ofset;
		
		$products = array();
	
		
		$products = $this->model_feed_sitemap_pro->getProducts($ofset, $limit);		

		
		if ((!empty($products))) {
		
	$this->sitemaplog->write('feed '. $part .'|'. $ofset. '_start');
	
		$output = '';
		foreach($products as $product) {
			$output.= '<url>';
			$output.= '<loc>' . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $product['product_id']))) . '</loc>';
			$output.= '<lastmod>' . substr(max($product['date_added'], $product['date_modified']) , 0, 10) . '</lastmod>';
			$output.= '<changefreq>weekly</changefreq>';
			$output.= '<priority>1.0</priority>';
			$output.= '</url>' . "\n";
		 }
		
	
	
    $this->sitemaplog->write('count '. count($products) );
		
	$this->sitemaplog->write('feed '. $part .'|'. $ofset.'_ready');
		
		$file = 'sm/products' . $part . '.xml';

		
		$handle = fopen($file, 'a');
		flock($handle, LOCK_EX);
		//fwrite($handle, gzencode($output, $this->gzip_level));
		fwrite($handle, $output);
				
		flock($handle, LOCK_UN);
		fclose($handle);
		
		
		
		$json['message'] = 'set #'.$part.'|'.$ofset.' ready';
	
				
		} else {
		
		$json['stop'] = 'Products end | Wait for categories';
		
			
		}
				
		$this->response->setOutput(json_encode($json));		
			
	}
	
	
	public function startfeed()	{
	
		$part =  (int)$this->request->post['part'];
		$ofset =  (int)$this->request->post['ofset'];
		
		if ($part == 0 && $ofset == 0) {
			$this->cleanDir();	
		}	
	
		$output = '<?xml version="1.0" encoding="UTF-8"?>';
		$output.= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$this->load->model('feed/sitemap_pro');
		$file = 'sm/products' . $part . '.xml';
		$handle = fopen($file, 'w');
		flock($handle, LOCK_EX);
		//fwrite($handle, gzencode($output, $this->gzip_level));
		fwrite($handle, $output);
		flock($handle, LOCK_UN);
		fclose($handle);
		
		$this->sitemaplog->write('start products part #'. $part);
		
		$json['success'] = 'product feed #'. $part .' start';
		$this->response->setOutput(json_encode($json));		
	
	}
	
	public function endfeed()	{
		$part =  (int)$this->request->post['part'];
		
		$output = '</urlset>';
		$file = 'sm/products' . $part . '.xml';
		$handle = fopen($file, 'a');
		flock($handle, LOCK_EX);
		fwrite($handle, $output);
		flock($handle, LOCK_UN);
		fclose($handle);
		
		$content = file_get_contents($file);
		$zp = gzopen($file.'.gz', "w9");
		gzwrite($zp, $content);
		gzclose($zp);
		@unlink($file);
		
		$json['message'] = 'part#'.$part.' End';
		
		$this->sitemaplog->write('end product part #'. $part);
		
		$json['success'] = 'product feed #'. $part .' end';
		$this->response->setOutput(json_encode($json));		
	
	}
	
	private function cleanDir() {
		$files = glob("sm/*");
		$c = count($files);
		if (count($files) > 0) {
			foreach ($files as $file) {      
				if (file_exists($file)) {
				@unlink($file);
				}   
			}
		}
	}
	
	
	
}
?>
