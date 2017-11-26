<?php 
class ControllerInformationArticle extends Controller {  
	public function index() { 
		$this->language->load('information/article');
		
		$this->load->model('catalog/article');
		
		$this->load->model('tool/image');

		if ($this->config->get('article_module_heading_' .(int)$this->config->get('config_language_id'))) {
			$text_articles = $this->config->get('article_module_heading_' .(int)$this->config->get('config_language_id'));
		}else{
    			$text_articles = $this->language->get('text_articles');
		} 
			
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);

		if ($this->config->get('article_show_root') == '1' || $this->config->get('article_show_root') == '2') {
   		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $text_articles,
		'href'      => $this->url->link('information/articles'),
       		'separator' => $this->language->get('text_separator')
   		);
	
		}
			
		if (isset($this->request->get['article'])) {
			$id = '';
		
			$parts = explode('_', (string)$this->request->get['article']);
		
			foreach ($parts as $path_id) {
				if (!$id) {
					$id = $path_id;
				} else {
					$id .= '_' . $path_id;
				}
									
				$article_info = $this->model_catalog_article->getArticle($path_id);
				
				if ($article_info) {
	       			$this->data['breadcrumbs'][] = array(
   	    				'text'      => $article_info['name'],
						'href'      => $this->url->link('information/article', 'article=' . $id),
        				'separator' => $this->language->get('text_separator')
        			);
				}
			}		
		
			$article_id = array_pop($parts);
		} else {
			$article_id = 0;
		}
		
		$article_info = $this->model_catalog_article->getArticle($article_id);
	
		if ($article_info) {
			if ($article_info['seo_title']) {
		  		$this->document->setTitle($article_info['seo_title']);
			} else {
		  		$this->document->setTitle($article_info['name']);
			}

			$this->document->setDescription($article_info['meta_description']);
			$this->document->setKeywords($article_info['meta_keyword']);
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/articles.css')) {
			$this->document->addStyle('catalog/view/theme/'. $this->config->get('config_template') . '/stylesheet/articles.css');
			} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/articles.css');
			}

$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');

			
			if ($article_info['seo_h1']) {
      				$this->data['heading_title'] = $article_info['seo_h1'];
   			} else {
      				$this->data['heading_title'] = $article_info['name'];
   			}

			if ($article_info['related_title']) {
      				$this->data['text_related'] = $article_info['related_title'];
   			} else {
      				$this->data['text_related'] = $this->language->get('text_related');
   			}
			
			$this->data['text_subcategories'] = $this->language->get('text_subcategories');
			$this->data['text_articles_list'] = $this->language->get('text_articles_list');

			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['text_readmore'] = $this->language->get('text_readmore');	
			$this->data['text_empty'] = $this->language->get('text_empty');			
			
			$this->data['show_date'] = $this->config->get('article_show_date');
			$this->data['show_views'] = $this->config->get('article_show_views');
			$this->data['show_readmore'] = $this->config->get('article_show_readmore');
			$this->data['social'] = html_entity_decode($this->config->get('article_social'));		
			$this->data['button_continue'] = $this->language->get('button_continue');

			$results = $this->model_catalog_article->getArticles($article_id);
					
			if ($article_info['image']) {

				if ($results) {
				if ($this->config->get('article_thumb_category_width') && $this->config->get('article_thumb_category_height')) {
				$this->data['image'] = $this->model_tool_image->resize($article_info['image'], $this->config->get('article_thumb_category_width'), $this->config->get('article_thumb_category_height'));
				$this->data['image_popup'] = '';
				} else {
				$this->data['image'] = '';
				$this->data['image_popup'] = '';
				}

				}else{

				if ($this->config->get('article_image_width') && $this->config->get('article_image_height')) {
				$this->data['image'] = $this->model_tool_image->resize($article_info['image'], $this->config->get('article_image_width'), $this->config->get('article_image_height'));
				$this->data['image_popup'] = 'image/' . $article_info['image'];
				} else {
				$this->data['image'] = '';
				$this->data['image_popup'] = '';
				}
			}

                 	} else {
				$this->data['image'] = '';
				$this->data['image_popup'] = '';
			}
									
			$this->data['description'] = html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8');

			$this->data['date'] = date($this->language->get('date_format_short'), strtotime($article_info['date_added']));
			$this->data['viewed'] = $article_info['viewed'];


			$this->data['products'] = array();
			
			$products = $this->model_catalog_article->getProductRelated($article_id);

			if ($products) {

			$this->load->model('catalog/product');
			
			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info['status'] != 0) {

				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
				} else {
					$tax = false;
				}
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$product_info['rating'];
				} else {
					$rating = false;
				}
	            $this->load->model('catalog/product_master');
	            $is_master = $this->model_catalog_product_master->isMaster($product_id, '2'); //2 is Image
				//if (!$is_master) $master_id = $this->model_catalog_product_master->getMasterProductId($product_id, '2');

							
				$this->data['products'][] = array(
					'quantity' => $product_info['quantity'],
					'sku' => $product_info['sku'],
					'color_series_type' => $product_info['color_series_type'],
					'product_id' => $product_info['product_id'],
					'thumb'   	 => $image,
					'name'    	 => $product_info['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '...',
					'price'   	 => $price,
					'special' 	 => $special,
					'tax'         => $tax,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'is_master' => $is_master
				);
			}

			}

			}
			
			$url = '';
					
			$this->data['articles'] = array();
					
			foreach ($results as $result) {

				if ($result['sort_order'] != '-1') {

				$data = array(
					'filter_article_id'  => $result['article_id'],
					'filter_sub_article' => true	
				);

			if ($this->config->get('article_thumb_category_width') && $this->config->get('article_thumb_category_height')) {
				if ($result['image']) {
				$thumb_category = $this->model_tool_image->resize($result['image'], $this->config->get('article_thumb_category_width'), $this->config->get('article_thumb_category_height'));
				} else {
				$thumb_category = $this->model_tool_image->resize('no_image.jpg', $this->config->get('article_thumb_category_width'), $this->config->get('article_thumb_category_height'));
				}
                 	} else {
				$thumb_category = '';
			}

			$short_description = html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8');

			$description = strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));

			if (strlen($short_description) > 20) {
				$desc = str_replace(array('<p>', '</p>'), '', $short_description);
			}else{
				if (strlen($description) > 20) {
					$desc = utf8_substr(str_replace(array('<p>', '</p>'), '', $description), 0, 400) . '...';
				}else{
					$desc = '';
				}
			}

			$level_data = $this->model_catalog_article->getArticles($result['article_id']);

			if (!$result['alternative_link']) {
				$link_to_go = $this->url->link('information/article', 'article=' . $this->request->get['article'] . '_' . $result['article_id'] . $url);
				$external = false;
			}else{
				$link_to_go = $result['alternative_link'];
				$external = true;
			}
				
				$this->data['articles'][] = array(
					'article_id'  => $result['article_id'],
					'thumb_category'  => $thumb_category,
					'name'  => $result['name'],
					'children'    => $level_data,
					'description' => $desc,
					'date'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'viewed'  => $result['viewed'],
					'href'  => $link_to_go,
					'external'  => $external
				);
			}

			}
		
			$this->data['articles_list'] = array();

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
	
			if ($this->config->get('article_page_limit')) {
				$limit = $this->config->get('article_page_limit');
			}else{
	    			$limit = 10;
			}

			$filter_data = array(
				'article_id'              => $article_id,
				'sort'  => 'a.date_added',
				'order' => 'DESC',
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$articles_list = $this->model_catalog_article->getArticlesList($filter_data);

			foreach ($articles_list as $result) {

				if ($result['sort_order'] != '-1') {

			if ($this->config->get('article_thumb_width') && $this->config->get('article_thumb_height')) {
				if ($result['image']) {
				$thumb = $this->model_tool_image->resize($result['image'], $this->config->get('article_thumb_width'), $this->config->get('article_thumb_height'));
				} else {
				$thumb = $this->model_tool_image->resize('no_image.jpg', $this->config->get('article_thumb_width'), $this->config->get('article_thumb_height'));
				}
                 	} else {
				$thumb = '';
			}

			$short_description = html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8');

			$description = strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));

			if (strlen($short_description) > 20) {
				$desc = str_replace(array('<p>', '</p>'), '', $short_description);
			}else{
				if (strlen($description) > 20) {
					$desc = utf8_substr(str_replace(array('<p>', '</p>'), '', $description), 0, 400) . '...';
				}else{
					$desc = '';
				}
			}

			if (!$result['alternative_link']) {
				$link_to_go = $this->url->link('information/article', 'article=' . $this->request->get['article'] . '_' . $result['article_id'] . $url);
				$external = false;
			}else{
				$link_to_go = $result['alternative_link'];
				$external = true;
			}
				
				$this->data['articles_list'][] = array(
					'article_id'  => $result['article_id'],
					'thumb'  => $thumb,
					'name'  => $result['name'],
					'description' => $desc,
					'href'  => $link_to_go,
					'date'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'viewed'  => $result['viewed'],
					'external'  => $external
				);
			}

			}

			$articles_total = $this->model_catalog_article->getTotalArticlesByArticleId($article_id);

			$pagination = new Pagination();
			$pagination->total = $articles_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('information/article', 'article=' . $this->request->get['article'] . $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();

			if ($this->config->get('article_show_root') == '1' || $this->config->get('article_show_root') == '2') {
				$this->data['continue'] = $this->url->link('information/articles');
			}else{
				$this->data['continue'] = '';
			}

			$this->model_catalog_article->updateViewed($article_id);

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/article.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/article.tpl';
			} else {
				$this->template = 'default/template/information/article.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
				
			$this->response->setOutput($this->render());										
    	} else {
			$url = '';
			
			if (isset($this->request->get['article'])) {
				$url .= '&article=' . $this->request->get['article'];
			}
									
			
						
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/article', $url),
				'separator' => $this->language->get('text_separator')
			);
				
			$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('information/articles');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
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

	public function updateViewed() {
		$this->load->model('catalog/article');
		$this->model_catalog_article->updateViewed($this->request->post['article_id']);
	}

}
?>