<?php
class ControllerModuleLatestArticles extends Controller {
	protected function index($setting) {
		$this->language->load('module/latest_articles');
		
      		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['show_date'] = $this->config->get('article_show_date');
		$this->data['button_readmore'] = $this->language->get('button_readmore');
		$this->data['text_all_articles'] = $this->language->get('text_all_articles');
		$this->data['link_all_articles'] = $this->url->link('information/articles');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/articles.css')) {
			$this->document->addStyle('catalog/view/theme/'. $this->config->get('config_template') . '/stylesheet/articles.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/articles.css');
		}
				
		$this->load->model('catalog/article');
		
		$this->load->model('tool/image');
		
		$this->data['articles'] = array();
		
		$data = array(
			'sort'  => 'a.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_article->getLatestArticles($data);

		if ($results) {

		foreach ($results as $result) {

			if ($result['sort_order'] != '-1') {

			$image = false;

			if ($this->config->get('article_thumb_width') && $this->config->get('article_thumb_height')) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
			}
			}

			$short_description = strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'));

			$description = strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));

			if (strlen($short_description) > 10) {
				$desc = $short_description;
			}else{
				$desc = $description;
			}

			if (!$result['alternative_link']) {
				$link_to_go = $this->url->link('information/article', 'article=' . $result['article_id']);
				$external = false;
			}else{
				$link_to_go = $result['alternative_link'];
				$external = true;
			}
		
			if ($setting['position'] == 'content_top' || $setting['position'] == 'content_bottom') {
				$this->data['position'] = 'latest_inline';
				$caption = utf8_substr($desc, 0, 200) . '...';

			} else {
				$this->data['position'] = 'latest_column';
				$caption = utf8_substr($desc, 0, 120) . '...';			
			}
			
			$this->data['articles'][] = array(
				'article_id' => $result['article_id'],
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'caption'    	 => $caption,
				'href'    	 => $link_to_go,
				'date'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'viewed'  => $result['viewed'],
				'external'  => $external
			);
			}
		}
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest_articles.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/latest_articles.tpl';
		} else {
			$this->template = 'default/template/module/latest_articles.tpl';
		}

		$this->render();
	}
}
?>