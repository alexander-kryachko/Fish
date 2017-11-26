<?php
class ControllerModuleShopRatingVertical extends Controller {

    public function index() {
        static $module = 0;

        $this->load->language('module/shop_rating');
        $this->load->model('catalog/shop_rating');

        $this->document->addStyle('catalog/view/theme/default/stylesheet/shop_rate.css');
        $this->document->addScript('catalog/view/javascript/jquery/jquery.jcarousel.min.js');
        if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css')) {
            $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');
        } else {
            $this->document->addStyle('catalog/view/theme/default/stylesheet/carousel.css');
        }

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['text_read_more'] = $this->language->get('text_read_more');
        $this->data['href_read_more'] = $this->url->link('information/shop_rating');
        $this->data['show_rating'] = $this->config->get('shop_rating_vertical_show_rating');
        $this->data['text_summary'] = $this->language->get('text_summary');
        $this->data['text_count'] = $this->language->get('text_count');

        $ratings = $this->model_catalog_shop_rating->getLastStoreRatings($this->config->get('shop_rating_vertical_count'));

        $this->data['ratings'] =array();
        foreach($ratings as $rating){
            $this->data['ratings'][] =array(
                'author' => $rating['customer_name'],
                'shop_rating' => $rating['shop_rate'],
                'comment' => utf8_substr(strip_tags(html_entity_decode($rating['comment'], ENT_QUOTES, 'UTF-8')), 0, 150) . '..',
            );
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


        if($ratings){
            /*            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/shop_rating_vertical.tpl')) {
                            return $this->load->view($this->config->get('config_template') . '/template/module/shop_rating_vertical.tpl', $this->data);
                        } else {
                            return $this->load->view('default/template/module/shop_rating_vertical.tpl', $this->data);
                        }*/

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/shop_rating_vertical.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/shop_rating_vertical.tpl';
            } else {
                $this->template = 'default/template/module/shop_rating_vertical.tpl';
            }

            $this->render();

        }



    }

}
?>