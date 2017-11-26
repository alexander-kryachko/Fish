<?php
class ControllerCatalogShopRating extends Controller {
    private $error = array();

    public function index() {
        $installed = $this->config->get('shop_rating_installed');



        $this->data['installed'] = $installed;
        if(!$installed){
            $this->response->redirect($this->url->link('catalog/shop_rating/install', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->update();

        $this->load->language('catalog/shop_rating');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle('view/stylesheet/shop_rate.css');

        $this->load->model('catalog/shop_rating');

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            /*if(isset($this->request->post['shop_rating_request_status']) && $this->request->post['shop_rating_request_status'] != 0){
                $this->model_catalog_shop_rating->toogleEvent(1);
            }else{
                $this->model_catalog_shop_rating->toogleEvent(0);
            }
*/

            $this->model_setting_setting->editSetting('shop_rating', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_settings_success');

            $this->redirect($this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL'));
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
        $this->data['text_disabled_not_sent'] = $this->language->get('text_disabled_not_sent');

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_moderate'] = $this->language->get('entry_moderate');
        $this->data['entry_moderate_desc'] = $this->language->get('entry_moderate_desc');
        $this->data['entry_authorized'] = $this->language->get('entry_authorized');
        $this->data['entry_authorized_desc'] = $this->language->get('entry_authorized_desc');
        $this->data['entry_good_bad'] = $this->language->get('entry_good_bad');
        $this->data['entry_summary'] = $this->language->get('entry_summary');
        $this->data['entry_shop_rating'] = $this->language->get('entry_shop_rating');
        $this->data['entry_shop_rating_desc'] = $this->language->get('entry_shop_rating_desc');
        $this->data['entry_site_rating'] = $this->language->get('entry_site_rating');
        $this->data['entry_site_rating_desc'] = $this->language->get('entry_site_rating_desc');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_count'] = $this->language->get('entry_count');
        $this->data['entry_notify'] = $this->language->get('entry_notify');
        $this->data['entry_request_mail_status'] = $this->language->get('entry_request_mail_status');
        $this->data['entry_request_subject'] = $this->language->get('entry_request_subject');
        $this->data['tokens_label'] = $this->language->get('tokens_label');
        $this->data['tokens_desc'] = $this->language->get('tokens_desc');
        $this->data['store_name'] = $this->language->get('store_name');
        $this->data['store_name_link'] = $this->language->get('store_name_link');
        $this->data['customer_name'] = $this->language->get('customer_name');
        $this->data['ratings_link'] = $this->language->get('ratings_link');
        $this->data['remove_custom_type'] = $this->language->get('remove_custom_type');

        $this->data['rates_block_title'] = $this->language->get('rates_block_title');
        $this->data['settings_block_title'] = $this->language->get('settings_block_title');
        $this->data['answer_name_text'] = $this->language->get('answer_name_text');
        $this->data['answered'] = $this->language->get('answered');
        $this->data['date'] = $this->language->get('date');
        $this->data['name'] = $this->language->get('name');
        $this->data['shop'] = $this->language->get('shop');
        $this->data['site'] = $this->language->get('site');
        $this->data['comment'] = $this->language->get('comment');
        $this->data['good'] = $this->language->get('good');
        $this->data['bad'] = $this->language->get('bad');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $this->data['action'] = $this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['change_status'] = $this->url->link('catalog/shop_rating/status', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['remove_review'] = $this->url->link('catalog/shop_rating/removeReview', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['view_rate_link'] = $this->url->link('catalog/shop_rating/viewRate', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['create_custom_type_url'] = $this->url->link('catalog/shop_rating/custom_types', 'token=' . $this->session->data['token'], 'SSL');


        $this->data['ratings'] = $this->model_catalog_shop_rating->getAllRatings();
        $this->data['rating_answers'] = $this->model_catalog_shop_rating->getRatingAnswers();
        $this->data['custom_types'] = $this->model_catalog_shop_rating->getCustomTypes();

        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );


        if (isset($this->request->post['shop_rating_status'])) {
            $this->data['shop_rating_status'] = $this->request->post['shop_rating_status'];
        } else {
            $this->data['shop_rating_status'] = $this->config->get('shop_rating_status');
        }
        if (isset($this->request->post['shop_rating_email'])) {
            $this->data['shop_rating_email'] = $this->request->post['shop_rating_email'];
        } else {
            if($this->config->get('shop_rating_email')){
                $this->data['shop_rating_email'] = $this->config->get('shop_rating_email');
            }else{
                $this->data['shop_rating_email'] = $this->config->get('config_email');
            }
        }
        if (isset($this->request->post['shop_rating_notify'])) {
            $this->data['shop_rating_notify'] = $this->request->post['shop_rating_notify'];
        } else {
            $this->data['shop_rating_notify'] = $this->config->get('shop_rating_notify');
        }
        if (isset($this->request->post['shop_rating_request_status'])) {
            $this->data['shop_rating_request_status'] = $this->request->post['shop_rating_request_status'];
        } else {
            $this->data['shop_rating_request_status'] = $this->config->get('shop_rating_request_status');
        }
        if (isset($this->request->post['shop_rating_request_subject'])) {
            $this->data['shop_rating_request_subject'] = $this->request->post['shop_rating_request_subject'];
        } elseif($this->config->get('shop_rating_request_subject') && $this->config->get('shop_rating_request_subject') != ''){
            $this->data['shop_rating_request_subject'] = $this->config->get('shop_rating_request_subject');
        }else{
            $this->data['shop_rating_request_subject'] = sprintf($this->language->get('text_request_mail_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->post['shop_rating_request_text'])) {
            $this->data['shop_rating_request_text'] = $this->request->post['shop_rating_request_text'];
        } elseif($this->config->get('shop_rating_request_text') && $this->config->get('shop_rating_request_text') !='') {
            $this->data['shop_rating_request_text'] = $this->config->get('shop_rating_request_text');
        }else{
            $this->data['shop_rating_request_text'] = $this->language->get('text_request_mail_text');
        }
        if (isset($this->request->post['shop_rating_count'])) {
            $this->data['shop_rating_count'] = $this->request->post['shop_rating_count'];
        } else {
            $this->data['shop_rating_count'] = $this->config->get('shop_rating_count');
        }
        if (isset($this->request->post['shop_rating_moderate'])) {
            $this->data['shop_rating_moderate'] = $this->request->post['shop_rating_moderate'];
        } else {
            $this->data['shop_rating_moderate'] = $this->config->get('shop_rating_moderate');
        }
        if (isset($this->request->post['shop_rating_summary'])) {
            $this->data['shop_rating_summary'] = $this->request->post['shop_rating_summary'];
        } else {
            $this->data['shop_rating_summary'] = $this->config->get('shop_rating_summary');
        }
        if (isset($this->request->post['shop_rating_authorized'])) {
            $this->data['shop_rating_authorized'] = $this->request->post['shop_rating_authorized'];
        } else {
            $this->data['shop_rating_authorized'] = $this->config->get('shop_rating_authorized');
        }
        if (isset($this->request->post['shop_rating_shop_rating'])) {
            $this->data['shop_rating_shop_rating'] = $this->request->post['shop_rating_shop_rating'];
        } else {
            $this->data['shop_rating_shop_rating'] = $this->config->get('shop_rating_shop_rating');
        }
        if (isset($this->request->post['shop_rating_site_rating'])) {
            $this->data['shop_rating_site_rating'] = $this->request->post['shop_rating_site_rating'];
        } else {
            $this->data['shop_rating_site_rating'] = $this->config->get('shop_rating_site_rating');
        }
        if (isset($this->request->post['shop_rating_good_bad'])) {
            $this->data['shop_rating_good_bad'] = $this->request->post['shop_rating_good_bad'];
        } else {
            $this->data['shop_rating_good_bad'] = $this->config->get('shop_rating_good_bad');
        }


        $this->data['heading_title'] = $this->language->get('heading_title');
        //$this->data['header'] = $this->load->controller('common/header');
        //$this->data['column_left'] = $this->load->controller('common/column_left');
        //$this->data['footer'] = $this->load->controller('common/footer');

        $this->template = 'catalog/shop_rating.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function viewRate(){
        $this->load->language('catalog/shop_rating');
        $this->document->setTitle($this->language->get('heading_title_view'));
        $this->document->addStyle('view/stylesheet/shop_rate.css');

        $this->load->model('catalog/shop_rating');

        $this->load->model('setting/setting');
        $rate_id = $this->request->get['rating_id'];

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if(isset($this->request->post['rating_date_change']) && $this->request->post['rating_date_change'] != ''){
                if(!isset($this->request->post['old_rating_date']) || $this->request->post['old_rating_date'] != $this->request->post['rating_date_change']){
                    $this->model_catalog_shop_rating->changeDate($rate_id, $this->request->post['rating_date_change']);
                }
            }
            $rating_params = array();
            if(isset($this->request->post['new_rating_comment'])){
                $rating_params['comment'] = $this->request->post['new_rating_comment'];
            }
            if(isset($this->request->post['new_rating_good'])){
                $rating_params['good'] = $this->request->post['new_rating_good'];
            }
            if(isset($this->request->post['new_rating_bad'])){
                $rating_params['bad'] = $this->request->post['new_rating_bad'];
            }
            $this->model_catalog_shop_rating->changeComment($rate_id, $rating_params);

            if(isset($this->request->post['answer'])){
                if($this->request->post['answer'] != ''){
                    $this->model_catalog_shop_rating->addAnswer($rate_id, $this->request->post);
                }
            }

            $this->session->data['success'] = $this->language->get('text_answer_success');

            $this->redirect($this->url->link('catalog/shop_rating/viewRate', 'token=' . $this->session->data['token'].'&rating_id='.$rate_id, 'SSL'));

        }
        $this->data['rating'] = $this->model_catalog_shop_rating->getRating($rate_id);
        $this->data['rating']['customs'] = $this->model_catalog_shop_rating->getRateCustomRatings($rate_id);
        $this->data['rating_answer'] = $this->model_catalog_shop_rating->getRatingAnswer($rate_id);

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

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['rating_date'] = $this->language->get('rating_date');
        $this->data['shop_rating'] = $this->language->get('shop_rating');
        $this->data['site_rating'] = $this->language->get('site_rating');
        $this->data['rating_sender'] = $this->language->get('rating_sender');
        $this->data['status_published'] = $this->language->get('status_published');
        $this->data['status_unpublished'] = $this->language->get('status_unpublished');
        $this->data['rating_sender_email'] = $this->language->get('rating_sender_email');
        $this->data['comment'] = $this->language->get('comment');
        $this->data['good'] = $this->language->get('good');
        $this->data['bad'] = $this->language->get('bad');
        $this->data['answer'] = $this->language->get('answer');
        $this->data['edit'] = $this->language->get('edit');


        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ''
        );
        $this->data['action'] = $this->url->link('catalog/shop_rating/viewRate', 'token=' . $this->session->data['token'].'&rating_id='.$rate_id, 'SSL');

        $this->data['cancel'] = $this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['change_status_url'] = $this->url->link('catalog/shop_rating/status', 'token=' . $this->session->data['token'], 'SSL');






        if (!isset($this->request->get['module_id'])) {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title_view').$rate_id,
                'href' => $this->url->link('catalog/shop_rating/viewRate', 'token=' . $this->session->data['token']. '&rating_id=' . $rate_id, 'SSL'),
                'separator' => ' :: '
            );
        } else {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('catalog/shop_rating/', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL'),
                'separator' => ' :: '
            );
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title_view').$rate_id,
                'href' => $this->url->link('catalog/shop_rating/viewRate', 'token=' . $this->session->data['token'] .'&rating_id=' . $rate_id. '&module_id=' . $this->request->get['module_id'], 'SSL'),
                'separator' => ' :: '
            );
        }


        $this->data['heading_title'] = $this->language->get('heading_title_view');
        //$this->data['header'] = $this->load->controller('common/header');
        //$this->data['column_left'] = $this->load->controller('common/column_left');
        //$this->data['footer'] = $this->load->controller('common/footer');

        $this->template = 'catalog/shop_rating_view.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    public function status(){
        $this->load->model('catalog/shop_rating');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $json = $this->model_catalog_shop_rating->changeStatus($this->request->post['rate_id']);
            $this->response->setOutput(json_encode($json));
        }
    }
    public function removeReview(){
        $this->load->model('catalog/shop_rating');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $json = $this->model_catalog_shop_rating->removeReview($this->request->post['rate_id']);
            $this->response->setOutput(json_encode($json));
        }
    }

    public function custom_types(){
        $this->load->model('catalog/shop_rating');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            switch($this->request->post['action']){
                case 'create':
                    $json =  $this->model_catalog_shop_rating->createCustomType($this->request->post['new_custom_title']);
                    $this->response->setOutput(json_encode($json));
                    break;

                case 'status':
                    $json =  $this->model_catalog_shop_rating->statusCustomType($this->request->post['custom_id']);
                    $this->response->setOutput(json_encode($json));
                    break;

                case 'remove':
                    $json =  $this->model_catalog_shop_rating->removeCustomType($this->request->post['custom_id']);
                    $this->response->setOutput(json_encode($json));
                    break;
            }
        }
    }


    public function install() {
        $this->load->model('catalog/shop_rating');
        $this->model_catalog_shop_rating->install();
        $this->load->model('setting/setting');

        $this->model_setting_setting->editSetting('shop_rating', array('shop_rating_installed' => '1'));


        $this->response->redirect($this->url->link('catalog/shop_rating', 'token=' . $this->session->data['token'], 'SSL'));

    }

    public function update() {
        $this->load->model('catalog/shop_rating');
        $this->model_catalog_shop_rating->update();


    }

    public function uninstall() {
        $this->load->model('catalog/shop_rating');
        $this->model_catalog_shop_rating->uninstall();
        $this->load->model('setting/setting');

        $this->model_setting_setting->editSetting('shop_rating', array('shop_rating_installed' => '0'));

        $this->response->redirect($this->url->link('extension/modification', 'token=' . $this->session->data['token'], 'SSL'));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'catalog/shop_rating')) {
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