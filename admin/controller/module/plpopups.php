<?php
class ControllerModuleplpopups extends Controller {
	private $error = array(); 
	 
	public function index() {
		$this->language->load('module/plpopups');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('plpopups', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('module/plpopups', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['entry_plpopups_no'] = $this->language->get('entry_plpopups_no');
		$this->data['entry_plpopups_yes'] = $this->language->get('entry_plpopups_yes');
		
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		$this->data['tab_module'] = $this->language->get('tab_module');
		$this->data['entry_plpopups_setting_text'] = $this->language->get('entry_plpopups_setting_text');
		$this->data['entry_plpopups_cuscss_text'] = $this->language->get('entry_plpopups_cuscss_text');
		$this->data['entry_plpopups_faq_text'] = $this->language->get('entry_plpopups_faq_text');
		$this->data['on_off_plpopups_text'] = $this->language->get('on_off_plpopups_text');
		$this->data['openbutton_on_off_plpopups_text'] = $this->language->get('openbutton_on_off_plpopups_text');
		$this->data['dev_mode_plpopups_text'] = $this->language->get('dev_mode_plpopups_text');
		$this->data['esc_close_plpopups_text'] = $this->language->get('esc_close_plpopups_text');
		$this->data['click_close_plpopups_text'] = $this->language->get('click_close_plpopups_text');
		$this->data['entry_plpopups_open_text'] = $this->language->get('entry_plpopups_open_text');
		$this->data['entry_plpopups_open_head_text'] = $this->language->get('entry_plpopups_open_head_text');
		$this->data['entry_plpopups_open_head_2_text'] = $this->language->get('entry_plpopups_open_head_2_text');
		$this->data['entry_plpopups_cookie_text'] = $this->language->get('entry_plpopups_cookie_text');
		$this->data['entry_plpopups_cookie_name_text'] = $this->language->get('entry_plpopups_cookie_name_text');
		$this->data['entry_plpopups_cookie_ip_text'] = $this->language->get('entry_plpopups_cookie_ip_text');
		$this->data['entry_plpopups_screen_resolution_text'] = $this->language->get('entry_plpopups_screen_resolution_text');
		$this->data['entry_plpopups_timeout_text'] = $this->language->get('entry_plpopups_timeout_text');
		$this->data['entry_plpopups_timeout_one_text'] = $this->language->get('entry_plpopups_timeout_one_text');
		$this->data['entry_plpopups_zindex_text'] = $this->language->get('entry_plpopups_zindex_text');
		$this->data['entry_plpopups_margin_text'] = $this->language->get('entry_plpopups_margin_text');
		$this->data['entry_plpopups_opacity_text'] = $this->language->get('entry_plpopups_opacity_text');
		$this->data['entry_plpopups_opacity_color_text'] = $this->language->get('entry_plpopups_opacity_color_text');
		$this->data['entry_plpopups_shadow_text'] = $this->language->get('entry_plpopups_shadow_text');
		$this->data['entry_plpopups_borderradius_text'] = $this->language->get('entry_plpopups_borderradius_text');
		$this->data['entry_plpopups_close_font_text'] = $this->language->get('entry_plpopups_close_font_text');
		$this->data['entry_plpopups_close_name_text'] = $this->language->get('entry_plpopups_close_name_text');
		$this->data['entry_plpopups_close_link'] = $this->language->get('entry_plpopups_close_link');
		$this->data['entry_plpopups_close_link_help'] = $this->language->get('entry_plpopups_close_link_help');
		$this->data['entry_plpopups_close_font_size_text'] = $this->language->get('entry_plpopups_close_font_size_text');
		$this->data['entry_plpopups_close_font_color_text'] = $this->language->get('entry_plpopups_close_font_color_text');
		$this->data['entry_plpopups_close_font_color_hover_text'] = $this->language->get('entry_plpopups_close_font_color_hover_text');
		$this->data['entry_plpopups_close_font_weight_text'] = $this->language->get('entry_plpopups_close_font_weight_text');
		$this->data['entry_plpopups_close_font_italic_text'] = $this->language->get('entry_plpopups_close_font_italic_text');
		$this->data['entry_plpopups_close_button_top'] = $this->language->get('entry_plpopups_close_button_top');
		$this->data['entry_plpopups_close_button_right'] = $this->language->get('entry_plpopups_close_button_right');
		$this->data['entry_plpopups_close_css_text'] = $this->language->get('entry_plpopups_close_css_text');
		$this->data['entry_plpopups_close_css_a_text'] = $this->language->get('entry_plpopups_close_css_a_text');
		$this->data['entry_on_off_plpopups_pop_text'] = $this->language->get('entry_on_off_plpopups_pop_text');
		$this->data['entry_plpopups_id_text'] = $this->language->get('entry_plpopups_id_text');
		$this->data['entry_plpopups_background_text'] = $this->language->get('entry_plpopups_background_text');
		$this->data['entry_plpopups_background_color_text'] = $this->language->get('entry_plpopups_background_color_text');
		$this->data['entry_plpopups_background_size_h_text'] = $this->language->get('entry_plpopups_background_size_h_text');
		$this->data['entry_plpopups_background_size_w_text'] = $this->language->get('entry_plpopups_background_size_w_text');
		$this->data['entry_plpopups_css_button_text'] = $this->language->get('entry_plpopups_css_button_text');
		$this->data['entry_plpopups_css_global_text'] = $this->language->get('entry_plpopups_css_global_text');
		

		// подсказки
		$this->data['entry_plpopups_cookie_help_text'] = $this->language->get('entry_plpopups_cookie_help_text');
		$this->data['entry_plpopups_cookie_time_help_text'] = $this->language->get('entry_plpopups_cookie_time_help_text');
		$this->data['entry_plpopups_screen_resolution_help_text'] = $this->language->get('entry_plpopups_screen_resolution_help_text');
		$this->data['entry_plpopups_timeout_help_text'] = $this->language->get('entry_plpopups_timeout_help_text');
		$this->data['entry_plpopups_zindex_help_text'] = $this->language->get('entry_plpopups_zindex_help_text');
		$this->data['entry_plpopups_margin_help_text'] = $this->language->get('entry_plpopups_margin_help_text');
		$this->data['entry_plpopups_background_color_help_text'] = $this->language->get('entry_plpopups_background_color_help_text');
		$this->data['entry_plpopups_opacity_color_help_text'] = $this->language->get('entry_plpopups_opacity_color_help_text');
		$this->data['entry_plpopups_opacity_help_text'] = $this->language->get('entry_plpopups_opacity_help_text');
		$this->data['entry_plpopups_shadow_help_text'] = $this->language->get('entry_plpopups_shadow_help_text');
		$this->data['openbutton_on_off_plpopups_help_text'] = $this->language->get('openbutton_on_off_plpopups_help_text');
		$this->data['entry_plpopups_close_button_top_help'] = $this->language->get('entry_plpopups_close_button_top_help');
		$this->data['entry_plpopups_close_button_right_help'] = $this->language->get('entry_plpopups_close_button_right_help');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href'      => $this->url->link('module/plpopups', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		$this->data['action'] = $this->url->link('module/plpopups', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['on_off_plpopups'])) {
					$this->data['on_off_plpopups'] = $this->request->post['on_off_plpopups'];
				} else {
					$this->data['on_off_plpopups'] = $this->config->get('on_off_plpopups');
		}
		if (isset($this->request->post['on_off_plpopups_pop'])) {
					$this->data['on_off_plpopups_pop'] = $this->request->post['on_off_plpopups_pop'];
				} else {
					$this->data['on_off_plpopups_pop'] = $this->config->get('on_off_plpopups_pop');
		}
		if (isset($this->request->post['openbutton_on_off_plpopups'])) {
					$this->data['openbutton_on_off_plpopups'] = $this->request->post['openbutton_on_off_plpopups'];
				} else {
					$this->data['openbutton_on_off_plpopups'] = $this->config->get('openbutton_on_off_plpopups');
		}
		if (isset($this->request->post['dev_mode_plpopups'])) {
					$this->data['dev_mode_plpopups'] = $this->request->post['dev_mode_plpopups'];
				} else {
					$this->data['dev_mode_plpopups'] = $this->config->get('dev_mode_plpopups');
		}
		if (isset($this->request->post['esc_close_plpopups'])) {
					$this->data['esc_close_plpopups'] = $this->request->post['esc_close_plpopups'];
				} else {
					$this->data['esc_close_plpopups'] = $this->config->get('esc_close_plpopups');
		}
		if (isset($this->request->post['click_close_plpopups'])) {
					$this->data['click_close_plpopups'] = $this->request->post['click_close_plpopups'];
				} else {
					$this->data['click_close_plpopups'] = $this->config->get('click_close_plpopups');
		}
		if (isset($this->request->post['plpopups_cookie_ip'])) {
					$this->data['plpopups_cookie_ip'] = $this->request->post['plpopups_cookie_ip'];
				} else {
					$this->data['plpopups_cookie_ip'] = $this->config->get('plpopups_cookie_ip');
		}
		if (isset($this->request->post['plpopups_close_font_weight'])) {
					$this->data['plpopups_close_font_weight'] = $this->request->post['plpopups_close_font_weight'];
				} else {
					$this->data['plpopups_close_font_weight'] = $this->config->get('plpopups_close_font_weight');
		}
		if (isset($this->request->post['plpopups_close_font_italic'])) {
					$this->data['plpopups_close_font_italic'] = $this->request->post['plpopups_close_font_italic'];
				} else {
					$this->data['plpopups_close_font_italic'] = $this->config->get('plpopups_close_font_italic');
		}
		$this->data['config_plpopups_cookie'] = isset($this->request->post['config_plpopups_cookie']) ? $this->request->post['config_plpopups_cookie'] : $this->config->get('config_plpopups_cookie');
		$this->data['config_plpopups_cookie_name'] = isset($this->request->post['config_plpopups_cookie_name']) ? $this->request->post['config_plpopups_cookie_name'] : $this->config->get('config_plpopups_cookie_name');
		$this->data['config_plpopups_screen_resolution'] = isset($this->request->post['config_plpopups_screen_resolution']) ? $this->request->post['config_plpopups_screen_resolution'] : $this->config->get('config_plpopups_screen_resolution');
		$this->data['config_plpopups_timeout'] = isset($this->request->post['config_plpopups_timeout']) ? $this->request->post['config_plpopups_timeout'] : $this->config->get('config_plpopups_timeout');
		$this->data['config_plpopups_timeout_one'] = isset($this->request->post['config_plpopups_timeout_one']) ? $this->request->post['config_plpopups_timeout_one'] : $this->config->get('config_plpopups_timeout_one');
		$this->data['config_plpopups_zindex'] = isset($this->request->post['config_plpopups_zindex']) ? $this->request->post['config_plpopups_zindex'] : $this->config->get('config_plpopups_zindex');
		$this->data['config_plpopups_margin'] = isset($this->request->post['config_plpopups_margin']) ? $this->request->post['config_plpopups_margin'] : $this->config->get('config_plpopups_margin');
		$this->data['config_plpopups_opacity'] = isset($this->request->post['config_plpopups_opacity']) ? $this->request->post['config_plpopups_opacity'] : $this->config->get('config_plpopups_opacity');
		$this->data['config_plpopups_opacity_color'] = isset($this->request->post['config_plpopups_opacity_color']) ? $this->request->post['config_plpopups_opacity_color'] : $this->config->get('config_plpopups_opacity_color');
		$this->data['config_plpopups_shadow'] = isset($this->request->post['config_plpopups_shadow']) ? $this->request->post['config_plpopups_shadow'] : $this->config->get('config_plpopups_shadow');
		$this->data['config_plpopups_borderradius'] = isset($this->request->post['config_plpopups_borderradius']) ? $this->request->post['config_plpopups_borderradius'] : $this->config->get('config_plpopups_borderradius');
		$this->data['config_plpopups_close_font_size'] = isset($this->request->post['config_plpopups_close_font_size']) ? $this->request->post['config_plpopups_close_font_size'] : $this->config->get('config_plpopups_close_font_size');
		$this->data['config_plpopups_close_font_color'] = isset($this->request->post['config_plpopups_close_font_color']) ? $this->request->post['config_plpopups_close_font_color'] : $this->config->get('config_plpopups_close_font_color');
		$this->data['config_plpopups_close_link'] = isset($this->request->post['config_plpopups_close_link']) ? $this->request->post['config_plpopups_close_link'] : $this->config->get('config_plpopups_close_link');
		$this->data['config_plpopups_close_name'] = isset($this->request->post['config_plpopups_close_name']) ? $this->request->post['config_plpopups_close_name'] : $this->config->get('config_plpopups_close_name');
		$this->data['config_plpopups_close_font_color_hover'] = isset($this->request->post['config_plpopups_close_font_color_hover']) ? $this->request->post['config_plpopups_close_font_color_hover'] : $this->config->get('config_plpopups_close_font_color_hover');
		$this->data['config_plpopups_close_button_top'] = isset($this->request->post['config_close_plpopups_button_top']) ? $this->request->post['config_plpopups_close_button_top'] : $this->config->get('config_plpopups_close_button_top');
		$this->data['config_plpopups_close_button_right'] = isset($this->request->post['config_close_plpopups_button_right']) ? $this->request->post['config_plpopups_close_button_right'] : $this->config->get('config_plpopups_close_button_right');
		$this->data['config_plpopups_close_css'] = isset($this->request->post['config_plpopups_close_css']) ? $this->request->post['config_plpopups_close_css'] : $this->config->get('config_plpopups_close_css');
		$this->data['config_plpopups_close_a_css'] = isset($this->request->post['config_plpopups_close_a_css']) ? $this->request->post['config_plpopups_close_a_css'] : $this->config->get('config_plpopups_close_a_css');
		$this->data['config_plpopups_background_color'] = isset($this->request->post['config_plpopups_background_color']) ? $this->request->post['config_plpopups_background_color'] : $this->config->get('config_plpopups_background_color');
		$this->data['config_plpopups_css_global'] = isset($this->request->post['config_plpopups_css_global']) ? $this->request->post['config_plpopups_css_global'] : $this->config->get('config_plpopups_css_global');
		$this->data['config_plpopups_id'] = isset($this->request->post['config_plpopups_id']) ? $this->request->post['config_plpopups_id'] : $this->config->get('config_plpopups_id');
		$this->data['config_plpopups_background'] = isset($this->request->post['config_plpopups_background']) ? $this->request->post['config_plpopups_background'] : $this->config->get('config_plpopups_background');
		$this->data['config_plpopups_background_size_w'] = isset($this->request->post['config_plpopups_background_size_w']) ? $this->request->post['config_plpopups_background_size_w'] : $this->config->get('config_plpopups_background_size_w');
		$this->data['config_plpopups_background_size_h'] = isset($this->request->post['config_plpopups_background_size_h']) ? $this->request->post['config_plpopups_background_size_h'] : $this->config->get('config_plpopups_background_size_h');
		$this->data['config_plpopups_css_button'] = isset($this->request->post['config_plpopups_css_button']) ? $this->request->post['config_plpopups_css_button'] : $this->config->get('config_plpopups_css_button');
			
		$this->data['modules'] = array();
		
		if (isset($this->request->post['plpopups_module'])) {
			$this->data['modules'] = $this->request->post['plpopups_module'];
		} elseif ($this->config->get('plpopups_module')) { 
			$this->data['modules'] = $this->config->get('plpopups_module');
		}	
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/plpopups.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/plpopups')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>
