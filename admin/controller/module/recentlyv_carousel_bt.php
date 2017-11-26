<?php

class ControllerModuleRecentlyVCarouselBt extends Controller {

    private $error = array();

    //RecentlyVCarouselBt
    //recentlyv_carousel_bt
    public function index() {
        $this->language->load('module/recentlyv_carousel_bt');

        $this->document->setTitle($this->language->get('heading_title_header'));

        $this->load->model('setting/setting');
        $this->load->model('catalog/category');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $stay_edit = $this->request->post['save_and_keep_edit'];
            unset($this->request->post['save_and_keep_edit']);

            $this->model_setting_setting->editSetting('recentlyv_carousel_bt', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            if ($stay_edit) {
                $this->redirect($this->url->link('module/recentlyv_carousel_bt', 'token=' . $this->session->data['token'], 'SSL'));
            } else {
                $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_content_top'] = $this->language->get('text_content_top');
        $this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
        $this->data['text_column_left'] = $this->language->get('text_column_left');
        $this->data['text_column_right'] = $this->language->get('text_column_right');
        $this->data['text_general'] = $this->language->get('text_general');
        $this->data['text_languagesettings'] = $this->language->get('text_languagesettings');
        $this->data['text_tabname'] = $this->language->get('text_tabname');
        $this->data['text_cart_btn'] = $this->language->get('text_cart_btn');

        $this->data['entry_product'] = $this->language->get('entry_product');
        $this->data['entry_limit'] = $this->language->get('entry_limit');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_category'] = $this->language->get('entry_category');
        $this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
        $this->data['text_select_all'] = $this->language->get('text_select_all');

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
            'href' => $this->url->link('module/recentlyv_carousel_bt', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/recentlyv_carousel_bt', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');


        $this->load->model('catalog/product');


        $this->data['modules'] = array();

        if (isset($this->request->post['recentlyv_carousel_bt_module'])) {
            $this->data['modules'] = $this->request->post['recentlyv_carousel_bt_module'];
        } elseif ($this->config->get('recentlyv_carousel_bt_module')) {
            $this->data['modules'] = $this->config->get('recentlyv_carousel_bt_module');
        }

        $this->load->model('localisation/language');
        $this->data['languages'] = $this->model_localisation_language->getLanguages();



        if (isset($this->data['modules']) && count($this->data['modules']) > 0) {
            foreach ($this->data['modules'] as $key => $module) {
                // $this->data['modules'][$key]['products'] = $this->data['products'][$key];
                foreach ($this->data['languages'] as $valueLang) {
                    $this->data['modules'][$key]['tabname_lang_' . $valueLang['language_id']] = isset($module['tabname_lang_' . $valueLang['language_id']]) ? $module['tabname_lang_' . $valueLang['language_id']] :  $this->language->get('text_Featured');
                    $this->data['modules'][$key]['cart_btn_lang_' . $valueLang['language_id']] = isset($module['cart_btn_lang_' . $valueLang['language_id']]) ? $module['cart_btn_lang_' . $valueLang['language_id']] : $this->language->get('text_Add_to_Cart');
                }
            }
        }

        $results = $this->model_catalog_category->getCategories(0);

        foreach ($results as $result) {

            $this->data['categories'][] = array(
                'category_id' => $result['category_id'],
                'name' => $result['name']
            );
        }
        
        $this->load->model('design/layout');
        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->load->model('setting/store');
        $this->data['stores'] = $this->model_setting_store->getStores();

        $this->data['token'] = $this->session->data['token'];
        $this->template = 'module/recentlyv_carousel_bt.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }


    public function getdefaultcss(){
        usleep(900);
       $str = <<<EOD
    .bt_carousel-box-{module_id}{
           overflow: hidden !important;          
    }
    .box-product > div.bt-carousel-pager-{module_id} {
        display: inline-block;
        vertical-align: middle;
        width: 100%;
        margin-right: 0px !important;
    }
    .bt-carousel-pager-{module_id} {
        color: #666666;
        font-family: Arial;
        font-size: 0.85em;
        font-weight: bold;
        padding-top: 20px;
        text-align: center;
    }
    .bt-carousel-pager-{module_id} .bt-carousel-pager-item-{module_id}{
        display: inline-block;
    }
    .bt-carousel-pager-{module_id} a:hover {
        border-color: #000000;
    }
    .bt-carousel-pager-{module_id} .bt-carousel-pager-item-{module_id}.selected a{
        border-color: #000000;
    }
    .bt-carousel-pager-{module_id} a {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 2px solid #A3A8A9;
        border-radius: 7px;
        display: block;
        height: 10px;
        margin: 0 3px;
        outline: 0 none;
        text-indent: -9999px;
        width: 10px;
    }
    ul.bt_carousel-{module_id} {
        list-style-type: none;
        margin: 0;
        padding: 0;
        list-style: none;
        display: block;
    }

    ul.bt_carousel-{module_id} li {
        text-align: center;
        padding: 0;
        margin: 7px;
        width: 145px;
        //height: 145px;
        display: block;
        float: left;
    }

    .bt_carousel_arrow_next-{module_id}, .bt_carousel_arrow_prev-{module_id} {
        background: url("catalog/view/theme/{your_template_var}/image/bt-carousel-arrows.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
        cursor: pointer;
        height: 40px;
        position: absolute;
        text-indent: -9999px;
        top: 35%;
        width: 40px;
        z-index: 101;
    }

    .bt_carousel_arrow_prev-{module_id} {
        background-position: 0 0;
        left: 0;
    }
    .bt_carousel_arrow_prev-{module_id}:hover {
        background-position: 0 -40px;
    }
    .bt_carousel_arrow_next-{module_id} {
        background-position: -40px 0;
        right: 0;
    }
    .bt_carousel_arrow_next-{module_id}:hover {
        background-position: -40px -40px;
    }
EOD;
echo $str;
    }
    
    protected function validate() {
        
        if (!$this->user->hasPermission('modify', 'module/recentlyv_carousel_bt')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (isset($this->request->post['recentlyv_carousel_bt_module'])) {
            foreach ($this->request->post['recentlyv_carousel_bt_module'] as $key => $value) {
                if (isset($value['image_width']) && isset($value['image_height']) ){
                if (!$value['image_width'] || !$value['image_height']) {
                    $this->error['image'][$key] = $this->language->get('error_image');
                }
                }
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>
