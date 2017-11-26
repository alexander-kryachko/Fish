<?php
class ControllerModuleHbOosnm extends Controller {
	public function index() {
		$this->language->load('module/hb_oosnm');

		$this->data['hb_oosn_name_enable']	= $this->config->get('hb_oosn_name_enable');
		$this->data['hb_oosn_mobile_enable']	= $this->config->get('hb_oosn_mobile_enable');
		$this->data['hb_oosn_animation'] = $this->config->get('hb_oosn_animation');
		$this->data['hb_oosn_css'] = $this->config->get('hb_oosn_css');
		
		$this->data['notify_button'] = $this->language->get('button_notify_button');
		$this->data['oosn_info_text'] = $this->language->get('oosn_info_text');
		$this->data['oosn_text_email'] = $this->language->get('oosn_text_email');
		$this->data['oosn_text_email_plh'] = $this->language->get('oosn_text_email_plh');
		$this->data['oosn_text_name'] = $this->language->get('oosn_text_name');
		$this->data['oosn_text_name_plh'] = $this->language->get('oosn_text_name_plh');
		$this->data['oosn_text_phone'] = $this->language->get('oosn_text_phone');
		$this->data['oosn_text_phone_plh'] = $this->language->get('oosn_text_phone_plh');
		
		if ($this->customer->isLogged()){
			$this->data['email'] = $this->customer->getEmail();
			$this->data['fname'] = $this->customer->getFirstName();
			$this->data['phone'] = $this->customer->getTelephone();
		}else {
			$this->data['email'] = $this->data['fname'] =  $this->data['phone'] = '';
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/hb_oosnm.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/hb_oosnm.tpl';
		} else {
			$this->template = 'default/template/module/hb_oosnm.tpl';
		}
		$this->render();
	}
}