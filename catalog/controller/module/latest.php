<?php
class ControllerModuleLatest extends Controller {
    protected function index($setting) {
        $this->language->load('module/latest');

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['button_cart'] = $this->language->get('button_cart');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        $this->data['products'] = array();

        $data = array(
            'sort'  => 'p.date_added',
            'order' => 'DESC',
            'start' => 0,
            'limit' => $setting['limit']
        );

        //$results = $this->model_catalog_product->getProducts($data);
		
		$results = $this->model_catalog_product->getLatestProducts($data['limit']);
		

        foreach ($results as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
            } else {
                $image = false;
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }

            if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $special = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = $result['rating'];
            } else {
                $rating = false;
            }

				$get_categories = $this->model_catalog_product->getCategories($result['product_id']);
                foreach ($get_categories as $cat) {
                    $cat_id = $cat['category_id']; break;
                }
                $full_url = $cat_id;
                while($cat_id) {
                    $parent = $this->model_catalog_category->getCategory($cat_id);
                    $cat_id = $parent['parent_id'];
                    if ( $cat_id != 0 ) $full_url = $cat_id . "_" . $full_url; else break;
                }
            $this->data['products'][] = array(
                'product_id' => $result['product_id'],
                'thumb'      => $image,
                'name'       => $result['name'],
                'price'      => $price,
                'special'    => $special,
                'rating'     => $rating,
                'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                'href'       => $this->url->link('product/product', 'path='. $full_url .'&product_id=' . $result['product_id']),
            );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/latest.tpl';
        } else {
            $this->template = 'default/template/module/latest.tpl';
        }

        $this->render();
    }
}
?>
