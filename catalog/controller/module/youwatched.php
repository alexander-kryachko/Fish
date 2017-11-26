<?php  
class ControllerModuleYouwatched extends Controller {
    protected function index($setting) {
        static $module = 0;
        $this->load->model('module/youwatched');
        $this->load->model('tool/image');

        $this->language->load('module/youwatched');

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_cart'] = $this->language->get('text_cart');
        $this->data['button_cart'] = $this->language->get('button_cart');

        $this->data['products'] = array();

        $youwatched = (isset($this->request->cookie["youwatched"])) ? (unserialize(html_entity_decode($this->request->cookie["youwatched"]))) :  array();
        if ($youwatched){
            $data['start'] = 0;
            natsort($youwatched);
            $youwatched = array_reverse($youwatched, true);
            $data['limit'] = ($setting['limit'] < count($youwatched)) ? $setting['limit'] : count($youwatched);
            $data['product_ids'] = array_slice(array_keys($youwatched), 0, $data['limit']);

            if (isset($this->request->get['path'])) {
                $path = explode('_', $this->request->get['path']);
                $data['filter_category_id'] = $path[0];
                $categories = $this->model_module_youwatched->getCategoriesByParentId($path[0], $setting['level']);
                if ($categories){
                    $data['filter_sub_category'] = $categories;
                }
            }

            $results = $this->model_module_youwatched->getProducts($data);
            if ($results){
                foreach ($youwatched as $prd_id => $prd_time) {
                    if (isset($results[$prd_id])){
                        $result = $results[$prd_id];
                        if ($result['image']) {
                            $image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
                        } else {
                            $image = $this->model_tool_image->resize('no-image.jpg', $setting['image_width'], $setting['image_height']);
                        }

                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }

                        if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']){
                            $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $special = false;
                        }

                        if ($this->config->get('config_review_status')) {
                            $rating = $result['rating'];
                        } else {
                            $rating = false;
                        }

                        $this->data['products'][] = array(
                            'product_id' => $result['product_id'],
                            'thumb'   	 => $image,
                            'name'    	 => $result['name'],
                            'price'   	 => $price,
                            'special' 	 => $special,
                            'rating'     => $rating,
                            'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                            'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
                        );
                    }
                }
            }
        }

        $this->data['module'] = $module++;
        $setting['slider']['vertical'] = ($setting['slider']['direction'] == "vertical") ? 'true' : 'false';
        $this->data['setting'] = $setting;

        $template = $setting['template'] == "slider" ? 'slider' : 'default';

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/youwatched_'. $template .'.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/youwatched_'. $template .'.tpl';
		} else {
			$this->template = 'default/template/module/youwatched_'. $template .'.tpl';
		}

		$this->render();
	}
}
?>