<?php

class ControllerModuleRecentlyVCarouselBt extends Controller {

    protected function index($setting) {
        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string) $this->request->get['path']);
            $category_id = end($parts);
        } else {
            $parts = array();
            $category_id = true;
        }
        //preVar($setting);
        if (isset($setting['store']) && in_array($this->config->get('config_store_id'), $setting['store'])) {

            $display_in_all = (isset($setting['display_in_all']) && $setting['display_in_all'] == '1') ? true : false;

            if ($display_in_all || ($category_id === true || isset($setting['category_source']) && in_array($category_id, $setting['category_source']))) {

                $this->load->model('tool/recentlyv_carousel_bt');

                $this->load->model('catalog/category');
                $this->language->load('module/recentlyv_carousel_bt');

                $this->data['tabname_lang'] = isset($setting['tabname_lang_' . $this->config->get('config_language_id')]) ? $setting['tabname_lang_' . $this->config->get('config_language_id')] : 'Recently Viewed';
                $this->data['cart_btn_lang'] = isset($setting['cart_btn_lang_' . $this->config->get('config_language_id')]) ? $setting['cart_btn_lang_' . $this->config->get('config_language_id')] : 'Add to Cart';

                $this->data['show_in_box'] = (isset($setting['show_in_box']) && $setting['show_in_box'] == 'on' ) ? true : false;


                $this->data['carouselSetting'] = $setting['carousel'];
                $this->data['carouselSetting']['scroll_limit'] = $setting['scroll_limit'];
                $this->data['carouselSetting']['css'] = $setting['css'];
                $id = sha1($this->data['tabname_lang'] . time() . rand(0, 500));

                $this->data['module_id'] = $id;
                $this->load->model('catalog/product');

                $this->load->model('tool/image');

                $this->data['products'] = array();

                if (empty($setting['limit'])) {
                    $setting['limit'] = 10;
                }


                $data = array(
                    'start' => 0,
                    'limit' => $setting['limit']
                );

                $results = $this->model_tool_recentlyv_carousel_bt->getProductsViewed($data);

//                preVar($results);
//                exit;
                $products = array_slice($results, 0, (int) $setting['limit']);

                foreach ($products as $productT) {
                    $product_id = $productT['product_id'];
                    $product_info = $this->model_catalog_product->getProduct($product_id);

                    if ($product_info) {
                        if ($product_info['image']) {
                            $image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
                        } else {
                            $image = false;
                        }

                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }

                        if ((float)$product_info['special'] && (float)$product_info['special'] < (float)$product_info['price']){
                            $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $special = false;
                        }

                        if ($this->config->get('config_review_status')) {
                            $rating = $product_info['rating'];
                        } else {
                            $rating = false;
                        }

                        $this->data['products'][] = array(
                            'product_id' => $product_info['product_id'],
                            'thumb' => $image,
                            'name' => $product_info['name'],
                            'price' => $price,
                            'special' => $special,
                            'rating' => $rating,
                            'reviews' => sprintf($this->language->get('text_reviews'), (int) $product_info['reviews']),
                            'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
                        );
                    }
                }

                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/recentlyv_carousel_bt.tpl')) {
                    $this->template = $this->config->get('config_template') . '/template/module/recentlyv_carousel_bt.tpl';
                    $this->data['template'] = $this->config->get('config_template');
                } else {
                    $this->template = 'default/template/module/recentlyv_carousel_bt.tpl';
                    $this->data['template'] = 'default';
                }


                $this->render();
            }
        }
    }

}

?>
