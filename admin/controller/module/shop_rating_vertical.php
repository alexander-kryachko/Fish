<?php
class ControllerModuleShopRatingVertical extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/shop_rating_vertical');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/shop_rating');

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('shop_rating_vertical', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_settings_success');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['settings_block_title'] = $this->language->get('settings_block_title');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_count'] = $this->language->get('entry_count');
        $this->data['entry_show_rating'] = $this->language->get('entry_show_rating');


        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_content_top'] = $this->language->get('text_content_top');
        $this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
        $this->data['text_column_left'] = $this->language->get('text_column_left');
        $this->data['text_column_right'] = $this->language->get('text_column_right');

        $this->data['entry_layout'] = $this->language->get('entry_layout');
        $this->data['entry_position'] = $this->language->get('entry_position');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_module'] = $this->language->get('button_add_module');
        $this->data['button_remove'] = $this->language->get('button_remove');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $this->data['action'] = $this->url->link('module/shop_rating_vertical', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        if (!isset($this->request->get['module_id'])) {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/shop_rating_vertical', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );
        } else {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/shop_rating_vertical', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL'),
                'separator' => ' :: '
            );
        }
        $this->data['modules'] = array();

        if (isset($this->request->post['shop_rating_vertical_module'])) {
            $this->data['modules'] = $this->request->post['shop_rating_vertical_module'];
        } elseif ($this->config->get('shop_rating_vertical_module')) {
            $this->data['modules'] = $this->config->get('shop_rating_vertical_module');
        }



        if (isset($this->request->post['shop_rating_vertical_status'])) {
            $this->data['shop_rating_vertical_status'] = $this->request->post['shop_rating_vertical_status'];
        } else {
            $this->data['shop_rating_vertical_status'] = $this->config->get('shop_rating_vertical_status');
        }
        if (isset($this->request->post['shop_rating_vertical_count'])) {
            $this->data['shop_rating_vertical_count'] = $this->request->post['shop_rating_vertical_count'];
        } else {
            $this->data['shop_rating_vertical_count'] = $this->config->get('shop_rating_vertical_count');
        }
        if (isset($this->request->post['shop_rating_vertical_show_rating'])) {
            $this->data['shop_rating_vertical_show_rating'] = $this->request->post['shop_rating_vertical_show_rating'];
        } else {
            $this->data['shop_rating_vertical_show_rating'] = $this->config->get('shop_rating_vertical_show_rating');
        }


        $this->data['heading_title'] = $this->language->get('heading_title');
        /* $this->data['header'] = $this->load->controller('common/header');
         $this->data['column_left'] = $this->load->controller('common/column_left');
         $this->data['footer'] = $this->load->controller('common/footer');

         $this->response->setOutput($this->load->view('module/shop_rating_vertical.tpl', $this->data));
        */


        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();


        $this->template = 'module/shop_rating_vertical.tpl';

        $this->children = array(
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());

    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/shop_rating_vertical')) {
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