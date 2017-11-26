<?php  
class ControllerModuleplpopups extends Controller {
	protected function index($setting) {

		
		
    	$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
    	$this->data['on_off_plpopups'] = $this->config->get('on_off_plpopups');
        $this->data['on_off_plpopups_pop'] = $this->config->get('on_off_plpopups_pop');
        $this->data['openbutton_on_off_plpopups'] = $this->config->get('openbutton_on_off_plpopups');
    	$this->data['dev_mode_plpopups'] = $this->config->get('dev_mode_plpopups');
    	$this->data['esc_close_plpopups'] = $this->config->get('esc_close_plpopups');
    	$this->data['click_close_plpopups'] = $this->config->get('click_close_plpopups');
        $this->data['plpopups_cookie_ip'] = $this->config->get('plpopups_cookie_ip');
    	$this->data['plpopups_cookie'] = $this->config->get('config_plpopups_cookie');
    	$this->data['plpopups_cookie_name'] = $this->config->get('config_plpopups_cookie_name');
    	$this->data['plpopups_screen_resolution'] = $this->config->get('config_plpopups_screen_resolution');
    	$this->data['plpopups_timeout'] = $this->config->get('config_plpopups_timeout');
        $this->data['plpopups_timeout_one'] = html_entity_decode($setting['plpopups_timeout_one'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
    	$this->data['plpopups_zindex'] = $this->config->get('config_plpopups_zindex');
        $this->data['plpopups_margin'] = $this->config->get('config_plpopups_margin');
    	$this->data['plpopups_opacity'] = $this->config->get('config_plpopups_opacity');
    	$this->data['plpopups_opacity_color'] = $this->config->get('config_plpopups_opacity_color');
    	$this->data['plpopups_shadow'] = $this->config->get('config_plpopups_shadow');
        $this->data['plpopups_borderradius'] = $this->config->get('config_plpopups_borderradius');
        $this->data['plpopups_close_button_top'] = $this->config->get('config_plpopups_close_button_top');
        $this->data['plpopups_close_name'] = html_entity_decode($setting['plpopups_close_name'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        $this->data['plpopups_close_link'] = html_entity_decode($setting['plpopups_close_link'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        $this->data['plpopups_close_button_right'] = $this->config->get('config_plpopups_close_button_right');
        $this->data['plpopups_close_font_size'] = $this->config->get('config_plpopups_close_font_size');
    	$this->data['plpopups_close_font_color'] = $this->config->get('config_plpopups_close_font_color');
    	$this->data['plpopups_close_font_color_hover'] = $this->config->get('config_plpopups_close_font_color_hover');
    	$this->data['plpopups_close_font_weight'] = $this->config->get('plpopups_close_font_weight');
    	$this->data['plpopups_close_font_italic'] = $this->config->get('plpopups_close_font_italic');
        $this->data['plpopups_close_css'] = html_entity_decode($setting['plpopups_close_css'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        $this->data['plpopups_close_css_a'] = html_entity_decode($setting['plpopups_close_css_a'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
    	$this->data['plpopups_background_color'] = $this->config->get('config_plpopups_background_color');
    	$this->data['plpopups_css_global'] = $this->config->get('config_plpopups_css_global');
        $this->data['plpopups_id'] = html_entity_decode($setting['plpopups_id'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        $this->data['on_off_plpopups_pop'] = html_entity_decode($setting['on_off_plpopups_pop'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
    	$this->data['plpopups_background'] = html_entity_decode($setting['plpopups_background'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
    	$this->data['plpopups_background_size_w'] = html_entity_decode($setting['plpopups_background_size_w'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
    	$this->data['plpopups_background_size_h'] = html_entity_decode($setting['plpopups_background_size_h'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		$this->data['plpopups'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        $this->data['plpopups_css_button'] = html_entity_decode($setting['plpopups_css_button'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/plpopups.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/plpopups.tpl';
		} else {
			$this->template = 'default/template/module/plpopups.tpl';
		}
		
		$this->render();
	}
}
?>
