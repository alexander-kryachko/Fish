<?php
class ControllerModuleArticle extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/article');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('article', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_module_articles'] = $this->language->get('text_module_articles');

		$this->data['entry_heading'] = $this->language->get('entry_heading');
		$this->data['entry_articles_title'] = $this->language->get('entry_articles_title');
		$this->data['entry_articles_metadescription'] = $this->language->get('entry_articles_metadescription');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_article_thumb_category'] = $this->language->get('entry_article_thumb_category');	
		$this->data['entry_article_thumb'] = $this->language->get('entry_article_thumb');
		$this->data['entry_article_image'] = $this->language->get('entry_article_image');
		$this->data['entry_show_date'] = $this->language->get('entry_show_date');
		$this->data['entry_show_views'] = $this->language->get('entry_show_views');
		$this->data['entry_show_readmore'] = $this->language->get('entry_show_readmore');
		$this->data['entry_show_latest'] = $this->language->get('entry_show_latest');
		$this->data['entry_show_root'] = $this->language->get('entry_show_root');
		$this->data['entry_article_limit'] = $this->language->get('entry_article_limit');
		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['entry_social'] = $this->language->get('entry_social');
		$this->data['entry_image'] = $this->language->get('entry_image');	
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['image'])) {
			$this->data['error_image'] = $this->error['image'];
		} else {
			$this->data['error_image'] = array();
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/article', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/article', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['article_module'])) {
			$this->data['modules'] = $this->request->post['article_module'];
		} elseif ($this->config->get('article_module')) { 
			$this->data['modules'] = $this->config->get('article_module');
		}

		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {

		if (isset($this->request->post['article_module_heading_' . $language['language_id']])) {
			$this->data['article_module_heading_' . $language['language_id']] = $this->request->post['article_module_heading_' . $language['language_id']];
		} else {
			$this->data['article_module_heading_' . $language['language_id']] = $this->config->get('article_module_heading_' . $language['language_id']);
		}

		if (isset($this->request->post['article_module_title_' . $language['language_id']])) {
			$this->data['article_module_title_' . $language['language_id']] = $this->request->post['article_module_title_' . $language['language_id']];
		} else {
			$this->data['article_module_title_' . $language['language_id']] = $this->config->get('article_module_title_' . $language['language_id']);
		}

		if (isset($this->request->post['article_module_metadescription_' . $language['language_id']])) {
			$this->data['article_module_metadescription_' . $language['language_id']] = $this->request->post['article_module_metadescription_' . $language['language_id']];
		} else {
			$this->data['article_module_metadescription_' . $language['language_id']] = $this->config->get('article_module_metadescription_' . $language['language_id']);
		}

		if (isset($this->request->post['articles_description_' . $language['language_id']])) {
			$this->data['articles_description_' . $language['language_id']] = $this->request->post['articles_description_' . $language['language_id']];
		} else {
			$this->data['articles_description_' . $language['language_id']] = $this->config->get('articles_description_' . $language['language_id']);
		}

		}
		
		$this->data['languages'] = $languages;

		if (isset($this->request->post['article_thumb_category_width'])) {
			$this->data['article_thumb_category_width'] = $this->request->post['article_thumb_category_width'];
		} elseif ($this->config->get('article_thumb_category_width')) { 
			$this->data['article_thumb_category_width'] = $this->config->get('article_thumb_category_width');
		} else {
			$this->data['article_thumb_category_width'] = '';
		}

		if (isset($this->request->post['article_thumb_category_height'])) {
			$this->data['article_thumb_category_height'] = $this->request->post['article_thumb_category_height'];
		} elseif ($this->config->get('article_thumb_category_height')) { 
			$this->data['article_thumb_category_height'] = $this->config->get('article_thumb_category_height');
		} else {
			$this->data['article_thumb_category_height'] = '';
		}

		if (isset($this->request->post['article_thumb_width'])) {
			$this->data['article_thumb_width'] = $this->request->post['article_thumb_width'];
		} elseif ($this->config->get('article_thumb_width')) { 
			$this->data['article_thumb_width'] = $this->config->get('article_thumb_width');
		} else {
			$this->data['article_thumb_width'] = '';
		}

		if (isset($this->request->post['article_thumb_height'])) {
			$this->data['article_thumb_height'] = $this->request->post['article_thumb_height'];
		} elseif ($this->config->get('article_thumb_height')) { 
			$this->data['article_thumb_height'] = $this->config->get('article_thumb_height');
		} else {
			$this->data['article_thumb_height'] = '';
		}

		if (isset($this->request->post['article_image_width'])) {
			$this->data['article_image_width'] = $this->request->post['article_image_width'];
		} elseif ($this->config->get('article_image_width')) { 
			$this->data['article_image_width'] = $this->config->get('article_image_width');
		} else {
			$this->data['article_image_width'] = '';
		}

		if (isset($this->request->post['article_image_height'])) {
			$this->data['article_image_height'] = $this->request->post['article_image_height'];
		} elseif ($this->config->get('article_image_height')) { 
			$this->data['article_image_height'] = $this->config->get('article_image_height');
		} else {
			$this->data['article_image_height'] = '';
		}

		if (isset($this->request->post['article_show_date'])) {
			$this->data['article_show_date'] = $this->request->post['article_show_date'];
		} elseif ($this->config->get('article_show_date')) { 
			$this->data['article_show_date'] = $this->config->get('article_show_date');
		} else {
			$this->data['article_show_date'] = 0;
		}

		if (isset($this->request->post['article_show_views'])) {
			$this->data['article_show_views'] = $this->request->post['article_show_views'];
		} elseif ($this->config->get('article_show_views')) { 
			$this->data['article_show_views'] = $this->config->get('article_show_views');
		} else {
			$this->data['article_show_views'] = 0;
		}

		if (isset($this->request->post['article_show_readmore'])) {
			$this->data['article_show_readmore'] = $this->request->post['article_show_readmore'];
		} elseif ($this->config->get('article_show_readmore')) { 
			$this->data['article_show_readmore'] = $this->config->get('article_show_readmore');
		} else {
			$this->data['article_show_readmore'] = 0;
		}

		if (isset($this->request->post['article_show_latest'])) {
			$this->data['article_show_latest'] = $this->request->post['article_show_latest'];
		} elseif ($this->config->get('article_show_latest')) { 
			$this->data['article_show_latest'] = $this->config->get('article_show_latest');
		} else {
			$this->data['article_show_latest'] = 0;
		}

		$this->data['articles_root_types'] = array(
			"1" => $this->language->get('text_root_type_1'), 
			"2" => $this->language->get('text_root_type_2'), 
			"3" => $this->language->get('text_root_type_3')
		);

		if (isset($this->request->post['article_show_root'])) {
			$this->data['article_show_root'] = $this->request->post['article_show_root'];
		} else {
			$this->data['article_show_root'] = $this->config->get('article_show_root');		
		}

		if (isset($this->request->post['article_page_limit'])) {
			$this->data['article_page_limit'] = $this->request->post['article_page_limit'];
		} elseif ($this->config->get('article_page_limit')) {
			$this->data['article_page_limit'] = $this->config->get('article_page_limit');
		} else {
			$this->data['article_page_limit'] = 10;
		}

		if (isset($this->request->post['article_social'])) {
			$this->data['article_social'] = $this->request->post['article_social'];
		} elseif ($this->config->get('article_social')) {
			$this->data['article_social'] = $this->config->get('article_social');
		} else {
			$this->data['article_social'] = '';
		}
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->data['token'] = $this->session->data['token'];

		$this->template = 'module/article.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	public function install() {
		$this->load->model('catalog/article');
		$this->model_catalog_article->createArticles();
	}

	public function uninstall() {
		$this->load->model('catalog/article');
		$this->model_catalog_article->dropArticles();
	}
}
?>