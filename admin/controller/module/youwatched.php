<?php  
class ControllerModuleYouwatched extends Controller {
    private $you_error = array();

	public function index() {
        $this->load->language('module/youwatched');
		$this->load->model('design/layout');
        $this->load->model('localisation/language');
        $this->load->model('setting/setting');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('youwatched', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_module'] = $this->language->get('button_add_module');
        $this->data['button_remove'] = $this->language->get('button_remove');

        $this->data['entry_limit'] = $this->language->get('entry_limit');
        $this->data['entry_header'] = $this->language->get('entry_header');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_title'] = $this->language->get('entry_title');
        $this->data['entry_icon'] = $this->language->get('entry_icon');
        $this->data['entry_box'] = $this->language->get('entry_box');
        $this->data['entry_yes'] = $this->language->get('entry_yes');
        $this->data['entry_no']	= $this->language->get('entry_no');
        $this->data['entry_template'] = $this->language->get('entry_template');
        $this->data['entry_layout'] = $this->language->get('entry_layout');
        $this->data['entry_position'] = $this->language->get('entry_position');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_entry_counter'] = $this->language->get('entry_entry_counter');
        $this->data['entry_template'] = $this->language->get('entry_template');
        $this->data['entry_action'] = $this->language->get('entry_action');
        $this->data['entry_level'] = $this->language->get('entry_level');

        $tpls = glob(DIR_CATALOG . 'view/theme/default/template/module/youwatched_*.tpl');

        if ($tpls) {
            foreach ($tpls as $tpl) {
                $tpl_name = str_replace("youwatched_", "", basename($tpl, '.tpl'));
                $this->data['template_name'][$tpl_name] = $this->language->get('template_name') . " - " . $tpl_name;
            }
        }

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_column_left'] = $this->language->get('text_column_left');
        $this->data['text_column_right'] = $this->language->get('text_column_right');
        $this->data['text_content_top'] = $this->language->get('text_content_top');
        $this->data['text_content_bottom'] = $this->language->get('text_content_bottom');

        $this->data['slider_visible']	   		= $this->language->get('slider_visible');
        $this->data['slider_vertical']	   		= $this->language->get('slider_vertical');
        $this->data['slider_horizontal']	    = $this->language->get('slider_horizontal');
        $this->data['slider_scroll']	   		= $this->language->get('slider_scroll');
        $this->data['slider_delay']	   		    = $this->language->get('slider_delay');
        $this->data['slider_direction']	   		= $this->language->get('slider_direction');
        
        $this->data['text_module_settings'] = $this->language->get('text_module_settings');

        if (isset($this->you_error['warning'])) {
            $this->data['error_warning'] = $this->you_error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->you_error['image'])) {
            $this->data['error_image'] = $this->you_error['image'];
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
            'href'      => $this->url->link('module/youwatched', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $languages = $this->model_localisation_language->getLanguages();

        foreach ($languages as $language) {
            if (isset($this->request->post['youwatched_counter' . $language['language_id']])) {
                $this->data['youwatched_counter' . $language['language_id']] = $this->request->post['youwatched_counter' . $language['language_id']];
            } else {
                $this->data['youwatched_counter' . $language['language_id']] = $this->config->get('youwatched_coutner' . $language['language_id']);
            }
        }

        $this->data['action'] = $this->url->link('module/youwatched', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['positions'] = array();

        $this->data['positions'][] = array(
            'position' => 'left',
            'title'    => $this->language->get('text_column_left'),
        );

        $this->data['positions'][] = array(
            'position' => 'right',
            'title'    => $this->language->get('text_column_right'),
        );

        $this->data['modules'] = array();

        if (isset($this->request->post['youwatched_module'])) {
            $this->data['modules'] = $this->request->post['youwatched_module'];
        } elseif ($this->config->get('youwatched_module')) {
            $this->data['modules'] = $this->config->get('youwatched_module');
        }

        $this->template = 'module/youwatched.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/youwatched')) {
            $this->you_error['warning'] = $this->language->get('error_permission');
        }

        if (isset($this->request->post['youwatched_module'])) {
            foreach ($this->request->post['youwatched_module'] as $key => $value) {
                if (!$value['image_width'] || !$value['image_height']) {
                    $this->you_error['image'][$key] = $this->language->get('error_image');
                }
            }
        }

        if (!$this->you_error) {
            return true;
        } else {
            return false;
        }
    }
}
?>