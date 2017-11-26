<?php
/* All rights reserved belong to the module, the module developers http://opencartadmin.com */
// http://opencartadmin.com © 2011-2016 All Rights Reserved
// Distribution, without the author's consent is prohibited
// Commercial license
class ControllerAgooLatestLatest extends Controller
{
	private $error = array();
	protected $data;
	protected $widget_type = 'latest';

	public function css($data)
	{
		$this->data = $data;
        $widget_tpl_content = '';
        $widget_tpl_flag = false;
        $widget_css_content = '';
        $widget_css_flag = false;


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css.tpl';
			$widget_tpl_flag = true;
		} else {
			if (file_exists(DIR_TEMPLATE . 'default/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css.tpl')) {
				$this->template = 'default/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css.tpl';
				$widget_tpl_flag = true;
			}
		}
		if ($widget_tpl_flag) {
			if (SC_VERSION < 20) {
				$widget_tpl_content = $this->render();
			} else {
				$widget_tpl_content = $this->load->view($this->template, $this->data);
			}
		}


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css')) {
			$widget_css_file = DIR_TEMPLATE .$this->config->get('config_template') . '/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css';
			$widget_css_flag = true;
		} else {
			if (file_exists(DIR_TEMPLATE .'default/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css')) {
				$widget_css_file = DIR_TEMPLATE .'default/template/agootemplates/stylesheet/'.$this->widget_type.'/'.$this->widget_type.'.css';
				$widget_css_flag = true;
			}
		}
        if ($widget_css_flag) {
        	$widget_css_content = file_get_contents($widget_css_file);
        }

        $css_content = $widget_tpl_content.$widget_css_content;

		return $css_content;
	}



}
