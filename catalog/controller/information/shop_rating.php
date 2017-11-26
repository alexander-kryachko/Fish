<?php
class ControllerInformationShopRating extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('information/shop_rating');

        $this->load->model('catalog/shop_rating');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addStyle('catalog/view/theme/default/stylesheet/remodal/remodal.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/remodal/remodal-default-theme.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/shop_rate.css');
        $this->document->addScript('catalog/view/javascript/jquery/remodal/remodal.min.js');
        $this->document->addScript('https://www.google.com/recaptcha/api.js');
        if ($this->config->get('config_google_captcha_status')) {
            $this->document->addScript('https://www.google.com/recaptcha/api.js');
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $rating_id = $this->model_catalog_shop_rating->addRating($this->request->post);


            if($rating_id > 0){
                if($this->config->get('shop_rating_moderate')){
                    $this->session->data['shop_rating_success_text'] = $this->language->get('shop_rating_success_text_moderate');
                }else{
                    $this->session->data['shop_rating_success_text'] = $this->language->get('shop_rating_success_text');
                }
                $this->session->data['rating_send'] = true;
            }
            $this->response->redirect($this->url->link('information/shop_rating'));


        }


        if(isset($this->session->data['shop_rating_success_text'])){
            $this->data['success'] = $this->session->data['shop_rating_success_text'];
            unset($this->session->data['shop_rating_success_text']);
        }else{
            $this->data['success'] = '';
        }
        if(isset($this->session->data['rating_send'])){
            $this->data['rating_send'] = $this->session->data['rating_send'];
        }else{
            $this->data['rating_send'] = false;
        }
        //$this->data['rating_send'] = false;

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['module_description'] = $this->language->get('module_description');
        $this->data['send_rating'] = $this->language->get('send_rating');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/shop_rating'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['text_rate'] = $this->language->get('text_rate');
        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_comment'] = $this->language->get('entry_comment');
        $this->data['entry_good'] = $this->language->get('entry_good');
        $this->data['entry_bad'] = $this->language->get('entry_bad');
        $this->data['entry_rate'] = $this->language->get('entry_rate');
        $this->data['entry_site_rate'] = $this->language->get('entry_site_rate');
        $this->data['button_submit'] = $this->language->get('button_send');
        $this->data['button_close'] = $this->language->get('button_close');
        $this->data['god_bad_desc'] = $this->language->get('god_bad_desc');
        $this->data['registered_customer_text'] = $this->language->get('registered_customer_text');
        $this->data['answer'] = $this->language->get('answer');
        $this->data['text_summary'] = $this->language->get('text_summary');
        $this->data['text_count'] = $this->language->get('text_count');
        $this->data['text_will_send'] = $this->language->get('text_will_send');
        $this->data['text_email_desc'] = $this->language->get('text_email_desc');

        $this->data['action'] = $this->url->link('information/shop_rating', '', 'SSL');
        $url = '';
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $filter_count = 10;
        if($this->config->get('shop_rating_count')){
            $filter_count = $this->config->get('shop_rating_count');
        }
        $filter_data = array(
            'start'             => ($page - 1) * $filter_count,
            'limit'             => $filter_count
        );

        $total = $this->model_catalog_shop_rating->getStoreRatingsTotal($filter_data);
        $this->data['ratings'] = $this->model_catalog_shop_rating->getStoreRatings($filter_data);

        foreach($this->data['ratings'] as $key=>$rating_item){
            $this->data['ratings'][$key]['customs'] = $this->model_catalog_shop_rating->getRateCustomRatings($rating_item['rate_id']);
        }

        $this->data['general']['count'] = 0;
        $this->data['general']['1'] = 0;
        $this->data['general']['2'] = 0;
        $this->data['general']['3'] = 0;
        $this->data['general']['4'] = 0;
        $this->data['general']['5'] = 0;
        $x = 0;
        $summ = 0;
        foreach($this->model_catalog_shop_rating->getStoreRatingsAll() as $rate){
            if(isset($rate['shop_rate']) && $rate['shop_rate'] > 0){
                $this->data['general'][$rate['shop_rate']]++;
                $summ = $summ + $rate['shop_rate'];
                $x++;
            }
        }

        $this->data['general']['count'] = $x;
        if($x > 0 ){
            $this->data['general']['summ'] = str_replace('.', ',', round($summ/$x, 1));
            $this->data['general']['summ_perc'] = round($summ/$x, 1)*100/5;
        }else{
            $this->data['general']['summ'] = 0;
            $this->data['general']['summ_perc'] = 0;
        }

        $this->data['rating_answers'] = $this->model_catalog_shop_rating->getRatingAnswers();


        $this->data['shop_rating_moderate'] = $this->config->get('shop_rating_moderate');
        $this->data['shop_rating_authorized'] = $this->config->get('shop_rating_authorized');
        $this->data['shop_rating_summary'] = $this->config->get('shop_rating_summary');
        $this->data['shop_rating_shop_rating'] = $this->config->get('shop_rating_shop_rating');
        $this->data['shop_rating_site_rating'] = $this->config->get('shop_rating_site_rating');
        $this->data['shop_rating_good_bad'] = $this->config->get('shop_rating_good_bad');

        $this->data['form_custom_types'] = $this->model_catalog_shop_rating->getCustomTypes();

        $this->data['text_login'] = sprintf($this->language->get('text_login_error'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));

        $this->data['customer_id'] = $this->customer->getId();


        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }
        if (isset($this->error['comment'])) {
            $this->data['error_comment'] = $this->error['comment'];
        } else {
            $this->data['error_comment'] = '';
        }
        if (isset($this->error['captcha'])) {
            $this->data['error_captcha'] = $this->error['captcha'];
        } else {
            $this->data['error_captcha'] = '';
        }


        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } else {
            $this->data['name'] = $this->customer->getFirstName();
        }

        if (isset($this->request->post['email'])) {
            $this->data['email'] = $this->request->post['email'];
        } else {
            $this->data['email'] = $this->customer->getEmail();
        }
        if (isset($this->request->post['comment'])) {
            $this->data['comment'] = $this->request->post['comment'];
        } else {
            $this->data['comment'] = '';
        }
        if (isset($this->request->post['good'])) {
            $this->data['good'] = $this->request->post['good'];
        } else {
            $this->data['good'] = '';
        }
        if (isset($this->request->post['bad'])) {
            $this->data['bad'] = $this->request->post['bad'];
        } else {
            $this->data['bad'] = '';
        }
        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } else {
            $this->data['name'] = $this->customer->getFirstName();
        }

        if (isset($this->request->post['email'])) {
            $this->data['email'] = $this->request->post['email'];
        } else {
            $this->data['email'] = $this->customer->getEmail();
        }

        if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {

            $this->data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);

        } elseif ($this->config->get('config_google_captcha_status')) {
                $this->data['site_key'] = $this->config->get('config_google_captcha_public');
                $this->data['captcha'] = '<div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="g-recaptcha" data-sitekey="'.$this->data['site_key'].'"></div>';
                if ($this->data['error_captcha']){
                    $this->data['captcha'] .=' <div class="text-danger">'.$this->data['error_captcha'].'</div>';
                }
                $this->data['captcha'] .='</div></div>';
            } else {
                $this->data['captcha'] = '';
            }



        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $filter_count;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('information/shop_rating', $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/shop_rating.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/information/shop_rating.tpl';
        } else {
            $this->template = 'default/template/information/shop_rating.tpl';
        }

        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());

    }
    protected function validate() {
        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        // Captcha
        if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
            $captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

            if ($captcha) {
                $this->error['captcha'] = $captcha;
            }
        }elseif ($this->config->get('config_google_captcha_status')) {
            $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

            $recaptcha = json_decode($recaptcha, true);

            if (!$recaptcha['success']) {
                $this->error['captcha'] = $this->language->get('error_captcha');
            }
            }


        return !$this->error;
    }

    public function request_mail($order_id) {
        $this->load->language('information/shop_rating');

        $this->load->model('checkout/order');
        $this->load->model('catalog/shop_rating');

        $order_info = $this->model_checkout_order->getOrder($order_id);
        $store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
        $store_url = '<a href="'.$order_info['store_url'].'">'.$store_name.'</a>';
        $customer_name = $order_info['firstname'];
        $ratings_link = '<a href="'.$this->url->link('information/shop_rating').'">"'.$this->language->get('sr_title').'"</a>';

        if(isset($order_info['customer_id']) && $order_info['customer_id'] > 0){
            $count = $this->model_catalog_shop_rating->customerRatingsCount($order_info['customer_id']);
            if($count && $count > 0){
                $send = false;
            }else{
                $send = true;
            }
        }else{
            $send = true;
        }

        if($order_info['order_status_id'] == $this->config->get('shop_rating_request_status') && $send == true) {


            if($this->config->get('shop_rating_request_subject')){
                $subject = html_entity_decode($this->config->get('shop_rating_request_subject'));
            }else{
                $subject = sprintf($this->language->get('text_request_mail_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
            }

            if($this->config->get('shop_rating_request_text') && $this->config->get('shop_rating_request_text') != ''){
                $mail_text = html_entity_decode($this->config->get('shop_rating_request_text'), ENT_QUOTES, 'UTF-8');
            }else{
                $mail_text = html_entity_decode($this->language->get('text_request_mail_text'), ENT_QUOTES, 'UTF-8');
            }
            $mail_text = str_replace('[store_name]', $store_name, $mail_text);
            $mail_text = str_replace('[store_name_link]', $store_url, $mail_text);
            $mail_text = str_replace('[customer_name]', $customer_name, $mail_text);
            $mail_text = str_replace('[ratings_link]', $ratings_link, $mail_text);

            $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';

            $message .= $mail_text;
            $message .= '</body></html>';

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');


            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));

            $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
            $mail->setSubject($subject);
            $mail->setHtml($message);
            $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $mail->send();

            $emails = explode(',', $this->config->get('config_mail_alert'));

            foreach ($emails as $email) {
                if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                    $mail->setTo($email);
                    $mail->send();
                }
            }

        }

    }

}
?>