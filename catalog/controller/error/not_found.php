<?php   
class ControllerErrorNotFound extends Controller {
	public function index() {		
		$this->language->load('error/not_found');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->language('information/shop_rating');

		$this->load->model('catalog/shop_rating');

		$this->document->addStyle('catalog/view/theme/default/stylesheet/remodal/remodal.css');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/remodal/remodal-default-theme.css');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/shop_rate.css');


		
		$this->data['breadcrumbs'] = array();
 
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);		
		
		if (isset($this->request->get['route'])) {
			$data = $this->request->get;
			
			unset($data['_route_']);
			
			$route = $data['route'];
			
			unset($data['route']);
			
			$url = '';
			
			if ($data) {
				$url = '&' . urldecode(http_build_query($data, '', '&'));
			}	
			
			if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
				$connection = 'SSL';
			} else {
				$connection = 'NONSSL';
			}
											
       		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link($route, $url, $connection),
        		'separator' => $this->language->get('text_separator')
      		);	   	
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_error'] = $this->language->get('text_error');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		
		$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');
		if ($_SERVER['REQUEST_URI'] != '/404.html') {
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: /404.html');
			exit();
			//return $this->forward('error/not_found');
		}
		
		
		$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
		} else {
			$this->template = 'default/template/error/not_found.tpl';
		}


		/** Отзывы **/

		$filter_count = 3;

		$filter_data = array(
			'limit'             => $filter_count,
			//'order'				=>	'RAND()'
		);


		$this->data['ratings'] = $this->model_catalog_shop_rating->getStoreRatings($filter_data);

		foreach($this->data['ratings'] as $key=>$rating_item){
			$this->data['ratings'][$key]['customs'] = $this->model_catalog_shop_rating->getRateCustomRatings($rating_item['rate_id']);
		}

		$this->data['general']['count'] = 0;
		$this->data['general']['1'] = 0;
		$this->data['general']['2'] = 0;
		$this->data['general']['3'] = 0;
		$this->data['general']['4'] = 0;
		$this->data['general']['5'] = 0;
		$x = 0;
		$summ = 0;
		foreach($this->model_catalog_shop_rating->getStoreRatingsAll() as $rate){
			if(isset($rate['shop_rate']) && $rate['shop_rate'] > 0){
				$this->data['general'][$rate['shop_rate']]++;
				$summ = $summ + $rate['shop_rate'];
				$x++;
			}
		}

		$this->data['general']['count'] = $x;
		if($x > 0 ){
			$this->data['general']['summ'] = str_replace('.', ',', round($summ/$x, 1));
			$this->data['general']['summ_perc'] = round($summ/$x, 1)*100/5;
		}else{
			$this->data['general']['summ'] = 0;
			$this->data['general']['summ_perc'] = 0;
		}

		$this->data['rating_answers'] = $this->model_catalog_shop_rating->getRatingAnswers();


		$this->data['shop_rating_moderate'] = $this->config->get('shop_rating_moderate');
		$this->data['shop_rating_authorized'] = $this->config->get('shop_rating_authorized');
		$this->data['shop_rating_summary'] = $this->config->get('shop_rating_summary');
		$this->data['shop_rating_shop_rating'] = $this->config->get('shop_rating_shop_rating');
		$this->data['shop_rating_site_rating'] = $this->config->get('shop_rating_site_rating');
		$this->data['shop_rating_good_bad'] = $this->config->get('shop_rating_good_bad');

		$this->data['entry_rate'] = $this->language->get('entry_rate');
		$this->data['entry_site_rate'] = $this->language->get('entry_site_rate');


		/** Отзывы END**/

		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
		
		$this->response->setOutput($this->render());
  	}
}
?>