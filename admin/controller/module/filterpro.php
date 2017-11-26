<?php
class ControllerModuleFilterPro extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('module/filterpro');
		if (!$this->model_module_filterpro->getLicense()){
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->model_module_filterpro->createTables();
		$this->load->language('module/filterpro');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['data'])) {
			$parsed = $this->model_module_filterpro->parse_str(base64_decode($this->request->post['data']));
			$this->request->post = $parsed;
		}

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (isset($this->request->post['filterpro_seo'])) {
				$filterpro_seo = $this->request->post['filterpro_seo'];
			} else {
				$filterpro_seo = array();
			}
			$this->setSeoFilter($filterpro_seo);
			$this->saveSeo($filterpro_seo);
			unset($this->request->post['filterpro_seo']);

			$this->model_module_filterpro->editSettings($this->request->post);
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_option_mode'] = $this->language->get('text_option_mode');
		$this->data['text_attribute_mode'] = $this->language->get('text_attribute_mode');
		$this->data['text_attribute_value_mode'] = $this->language->get('text_attribute_value_mode');
		$this->data['text_mode_or'] = $this->language->get('text_mode_or');
		$this->data['text_mode_and'] = $this->language->get('text_mode_and');
		$this->data['text_attr_group'] = $this->language->get('text_attr_group');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_filter_position'] = $this->language->get('text_filter_position');
		$this->data['text_product_container'] = $this->language->get('text_product_container');
		$this->data['text_expanded'] = $this->language->get('text_expanded');
		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['text_filterpro_container'] = $this->language->get('text_filterpro_container');
		$this->data['text_filterpro_afterload'] = $this->language->get('text_filterpro_afterload');
		$this->data['text_theme'] = $this->language->get('text_theme');
		$this->data['text_filters'] = $this->language->get('text_filters');
		$this->data['text_filterpro_name'] = $this->language->get('text_filterpro_name');
		$this->data['text_jscrollpane'] = $this->language->get('text_jscrollpane');
		$this->data['text_option_main_checkbox'] = $this->language->get('text_option_main_checkbox');
		$this->data['text_option_images_w_h'] = $this->language->get('text_option_images_w_h');
		$this->data['text_sort_by_quantity_first'] = $this->language->get('text_sort_by_quantity_first');
		$this->data['text_hide_options'] = $this->language->get('text_hide_options');
		$this->data['text_hide_count'] = $this->language->get('text_hide_count');
		$this->data['text_disable_mask'] = $this->language->get('text_disable_mask');
		$this->data['text_hide_window_hash'] = $this->language->get('text_hide_window_hash');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_price_slider'] = $this->language->get('text_price_slider');
		$this->data['text_attr_delimeter'] = $this->language->get('text_attr_delimeter');

		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_seo'] = $this->language->get('tab_seo');
		$this->data['tab_additional'] = $this->language->get('tab_additional');
		$this->data['tab_experimental'] = $this->language->get('tab_experimental');
		$this->data['text_additional_info'] = $this->language->get('text_additional_info');
		$this->data['text_max_input_vars'] = $this->language->get('text_max_input_vars');
		$this->data['text_enable_touch_screen'] = $this->language->get('text_enable_touch_screen');
		$this->data['text_enable_cache'] = $this->language->get('text_enable_cache');
		$this->data['text_clean_cache'] = $this->language->get('text_clean_cache');
		$this->data['text_check_indexes'] = $this->language->get('text_check_indexes');
		$this->data['text_enable_endless_scroller'] = $this->language->get('text_enable_endless_scroller');
		$this->data['text_filer_news'] = $this->language->get('text_filer_news');
		$this->data['text_filer_special'] = $this->language->get('text_filer_special');
		$this->data['text_news_days'] = $this->language->get('text_news_days');
		$this->data['text_no_ajax'] = $this->language->get('text_no_ajax');
		$this->data['text_apply_to_all'] = $this->language->get('text_apply_to_all');

		$this->data['entry_filter_h1'] = $this->language->get('entry_filter_h1');
		$this->data['entry_filter_title'] = $this->language->get('entry_filter_title');
		$this->data['entry_filter_description'] = $this->language->get('entry_filter_description');
		$this->data['entry_filter_seo'] = $this->language->get('entry_filter_seo');
		$this->data['entry_filter_url'] = $this->language->get('entry_filter_url');
		$this->data['entry_filter_meta_description'] = $this->language->get('entry_filter_meta_description');
		$this->data['entry_filter_meta_keywords'] = $this->language->get('entry_filter_meta_keywords');
		$this->data['button_add_seo_filter'] = $this->language->get('button_add_seo_filter');

		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_categories'] = $this->language->get('text_categories');
		$this->data['text_subcategories_show'] = $this->language->get('text_subcategories_show');
		$this->data['text_tags'] = $this->language->get('text_tags');
		$this->data['text_instock'] = $this->language->get('text_instock');
		$this->data['text_checked'] = $this->language->get('text_checked');
		$this->data['text_visible'] = $this->language->get('text_visible');

		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_apply'] = $this->language->get('button_apply');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_create'] = $this->language->get('button_create');
		$this->data['text_tooltip'] = $this->language->get('text_tooltip');
		$this->data['text_tooltip_help'] = $this->language->get('text_tooltip_help');
		$this->data['text_subcategories'] = $this->language->get('text_subcategories');
		$this->data['text_enable_fastorder'] = $this->language->get('text_enable_fastorder');
		$this->data['text_use_lazyload'] = $this->language->get('text_use_lazyload');
		$this->data['text_attr_total_simple'] = $this->language->get('text_attr_total_simple');
		$this->data['text_option_total_simple'] = $this->language->get('text_option_total_simple');
		$this->data['text_filter_onload'] = $this->language->get('text_filter_onload');
		$this->data['text_filer_selected'] = $this->language->get('text_filer_selected');

		$this->load->model('catalog/option');

		$total_options = $this->model_catalog_option->getTotalOptions();
		$this->data['options'] = $this->model_module_filterpro->getOptions(array('start' => 0, 'limit' => $total_options));
		foreach($this->data['options'] as $i => $option) {
			if(!in_array($option['type'], array('radio', 'checkbox', 'select', 'image'))) {
				unset($this->data['options'][$i]);
			}
		}

		$this->load->model('catalog/attribute');

		$total_attributes = $this->model_catalog_attribute->getTotalAttributes();
		$this->data['attributes'] = $this->model_module_filterpro->getAttributes(array('start' => 0, 'limit' => $total_attributes));

		if(isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if(isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if(isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/filterpro', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['token']  = $this->session->data['token'];
		$this->data['action'] = $this->url->link('module/filterpro', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['clean_cache_action'] = $this->url->link('module/filterpro/clean_cache', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['check_indexes_action'] = $this->url->link('module/filterpro/check_indexes', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		$this->data['container_layouts'] = $this->data['layouts'];

		$cat_layout = false;
		foreach($this->data['layouts'] as $i => $layout) {
			if($layout['layout_id'] == 3) {
				$cat_layout = $i;
				break;
			}
		}
		if($cat_layout) {
			$temp = $this->data['layouts'][$cat_layout];
			$this->data['layouts'][$cat_layout] = $this->data['layouts'][0];
			$this->data['layouts'][0] = $temp;
			unset($this->data['container_layouts'][$cat_layout]);
		}

		if(VERSION == '1.5.0') {
			$modules = array();
			if(!is_null($this->config->get('filterpro_module'))) {
				$modules = explode(',', $this->config->get('filterpro_module'));
			}
			foreach($modules as $module) {
				$this->data['modules'][] = array('layout_id' => $this->config->get('filterpro_' . $module . '_layout_id'),
												 'position' => $this->config->get('filterpro_' . $module . '_position'),
												 'status' => $this->config->get('filterpro_' . $module . '_status'),
												 'sort_order' => $this->config->get('filterpro_' . $module . '_sort_order')
				);
			}
			$this->data['setting'] = unserialize($this->config->get('filterpro_setting'));
		} else {
			if(isset($this->request->post['filterpro_module']) || isset($this->request->post['filterpro_setting'])) {
				$this->data['modules'] = $this->request->post['filterpro_module'];
				$this->data['setting'] = $this->request->post['filterpro_setting'];
				$this->data['filterpro_seo'] = $this->request->post['filterpro_seo'];
			} elseif($this->config->get('filterpro_module')) {
				$this->data['modules'] = $this->config->get('filterpro_module');
				$this->data['setting'] = $this->config->get('filterpro_setting');
				$this->data['filterpro_seo'] = $this->loadSeo();
			}
		}

		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (!isset($this->data['setting']['filterpro_container'])) {
			$this->data['setting']['filterpro_container'] = ".product-{view}";
		}
		if (!isset($this->data['setting']['filterpro_afterload'])) {
			$this->data['setting']['filterpro_afterload'] = "";
		}

		$this->data['display_categories'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_categories'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));

		$this->data['display_subcategories'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_subcategories'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));

		$this->data['display_options'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));
		$this->data['display_options'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_options'][] = array('value' => 'select', 'name' => $this->language->get('text_display_select'));
		$this->data['display_options'][] = array('value' => 'radio', 'name' => $this->language->get('text_display_radio'));
		$this->data['display_options'][] = array('value' => 'image', 'name' => $this->language->get('text_display_image'));

		$this->data['display_attributes'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));
		$this->data['display_attributes'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_attributes'][] = array('value' => 'select', 'name' => $this->language->get('text_display_select'));
		$this->data['display_attributes'][] = array('value' => 'radio', 'name' => $this->language->get('text_display_radio'));
		$this->data['display_attributes'][] = array('value' => 'slider', 'name' => $this->language->get('text_display_slider'));

		$this->data['display_manufacturers'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));
		$this->data['display_manufacturers'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_manufacturers'][] = array('value' => 'select', 'name' => $this->language->get('text_display_select'));
		$this->data['display_manufacturers'][] = array('value' => 'radio', 'name' => $this->language->get('text_display_radio'));

		$this->data['display_filters'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));
		$this->data['display_filters'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_filters'][] = array('value' => 'select', 'name' => $this->language->get('text_display_select'));

		$this->data['display_all'][] = array('value' => 'checkbox', 'name' => $this->language->get('text_display_checkbox'));
		$this->data['display_all'][] = array('value' => 'none', 'name' => $this->language->get('text_display_none'));
		$this->data['display_all'][] = array('value' => 'select', 'name' => $this->language->get('text_display_select'));

		$this->data['theme_names']['default'] = $this->language->get('text_theme_default');
		$this->data['theme_names']['mega'] = $this->language->get('text_theme_mega');
		$this->data['theme_names']['slider'] = $this->language->get('text_theme_slider');

		$this->template = 'module/filterpro.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function install() {
		if($this->validate()) {
			$this->load->model('module/filterpro');
			if(!$this->model_module_filterpro->install()) {
				$this->load->model('setting/extension');
				$this->load->model('setting/setting');

				$extension = 'filterpro';
				$this->model_setting_extension->uninstall('module', $extension);

				$this->model_setting_setting->deleteSetting($extension);

				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}
	}

	private function validate() {
		if(!$this->user->hasPermission('modify', 'module/filterpro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	public function clean_cache(){
		$this->load->language('module/filterpro');
		if(!$this->user->hasPermission('modify', 'module/filterpro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} else {
			$this->cache->delete('filterpro');
			$this->response->setOutput(json_encode(array('success'=>$this->language->get('text_cache_cleaned'))));
		}
	}

	public function check_indexes(){
		$this->load->language('module/filterpro');
		if(!$this->user->hasPermission('modify', 'module/filterpro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('module/filterpro');
			$k = $this->model_module_filterpro->check_indexes();
			if($k){
				$text = sprintf($this->language->get('indexes_added'), $k);
			}else {
				$text = $this->language->get('no_indexes_added');
			}
			$this->response->setOutput(json_encode(array('success'=> $text)));
		}
	}

	private function loadSeo() {
		$result = array();
		$query = $this->db->query("SELECT `url`,`data` FROM " . DB_PREFIX . "filterpro_seo");
		foreach($query->rows as $k => $v) {
			$result[] = unserialize($v['data']);
		}
		return $result;
	}

	private function saveSeo($data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "filterpro_seo");
		foreach($data as $k => $v) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "filterpro_seo(`url`,`data`) VALUES('filter_id=" . $k . "','" . $this->db->escape(serialize($v)) . "')");
		}
	}

	private function setSeoFilter($seo_filter) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'filter_id=%'");

		foreach($seo_filter as $i => $filterdata) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias(query, keyword) VALUES('filter_id=" . $i . "', '" . $this->db->escape($filterdata['seo']) . "')");
		}
		$this->cache->delete('seo_pro');
	}
}

?>