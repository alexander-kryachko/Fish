<?php
class ControllerModuleFilter extends Controller {
    protected function index($setting) {
        $this->language->load('module/filter');

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['setting'] = $setting;

        $filter_setting = $this->config->get('filter_setting');

        $this->load->model('module/filter');

        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = null;
        }

        $this->data['filter'] = $filter;

        $tmp = array();
        $filter = explode(',', $filter);
        foreach ($filter as $key => $value) {
            $value = explode(':', $value);
            if (isset($value[0]) && isset($value[1])) {
                $tmp[$value[1]] = $value[0];
            }
        }

        $filter = $tmp;

        if(isset($this->request->get['route'])) {
            if($this->request->get['route'] == 'product/manufacturer/info') {
                $manufacturer_id = 0;
                $this->data['manufacturer_id'] = "";
                if(isset($this->request->get['manufacturer_id'])) {
                    $this->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
                    $manufacturer_id = $this->data['manufacturer_id'];
                } else {
                    return;
                }

                $attributes_values  = $this->model_module_filter->getManufacturerAttributesValues($manufacturer_id);
                $attributes_id      = $this->model_module_filter->getAttributesManufacturer($attributes_values);
                $attributes_value   = $this->model_module_filter->getAttributesValueByManufacturer($attributes_values);
                $attributes         = $this->model_module_filter->getAttributesNameFromManufacturersByID($attributes_id);

                $this->data['filter_attributes']        = $attributes;
                $this->data['filter_attributes_value']  = $attributes_value;

                foreach ($this->data['filter_attributes'] as $key => $value) {
                    foreach ($this->data['filter_attributes_value'][$key] as $sub_key => $filter_attribute_value) {
                        $this->data['filter_attributes_value'][$key][$sub_key]['href'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer_id);
                    }
                }
            } elseif($this->request->get['route'] == 'product/category') {
                $category_id = 0;
                $this->data['category_id'] = "";
                if (isset($this->request->get['path'])) {
                    $path = '';
                    $parts = explode('_', (string)$this->request->get['path']);
                    $category_id = (int)array_pop($parts);
                } else {
                    return;
                }

                $attributes_values  = $this->model_module_filter->getCategoryAttributesValues($category_id);
                $attributes_id      = $this->model_module_filter->getAttributesCategory($attributes_values);
                $attributes_value   = $this->model_module_filter->getAttributesValueByCategory($attributes_values);
                $attributes         = $this->model_module_filter->getAttributesNameFromCategoriesByID($attributes_id);

                foreach ($attributes_value as $key => &$value) {
                    foreach ($value as $sub_key => &$attribute_value) {
                        $url = array();
                        if (isset($filter[$sub_key])) {
                            foreach ($filter as $i => $j) if ($i != $sub_key) $url[] = $j . ':' . $i;
                            $attribute_value['checked'] = true;
                        } else {
                            foreach ($filter as $i => $j) $url[] = $j . ':' . $i;
                            $url[] = $key . ':' . $sub_key;
                            $attribute_value['checked'] = false;
                        }
                        $url = '&filter=' . implode(',', $url);

                        $attribute_value['href'] = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url);
                    }
                }

                $this->data['filter_attributes']        = $attributes;
                $this->data['filter_attributes_value']  = $attributes_value;
            } else
                return;
        }

        $this->data['text_show_all']        = $this->language->get('text_show_all');
        $this->data['text_showed']          = $this->language->get('text_showed');
        $this->data['text_total']           = $this->language->get('text_total');
        $this->data['text_pages']           = $this->language->get('text_pages');
        $this->data['text_page']            = $this->language->get('text_page');
        $this->data['text_price']           = $this->language->get('text_price');
        $this->data['text_add_to_cart']     = $this->language->get('text_add_to_cart');
        $this->data['text_from']            = $this->language->get('text_from');
        $this->data['text_error_loading']   = $this->language->get('text_error_loading');
        $this->data['text_addToCart']       = $this->language->get('text_addToCart');
        $this->data['config_catalog_limit'] = $this->config->get('config_catalog_limit');
        $this->data['product_thumb_width']  = $this->config->get('config_image_product_width');
        $this->data['product_thumb_height'] = $this->config->get('config_image_product_height');

        if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filter.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/filter.tpl';
        } else {
            $this->template = 'default/template/module/filter.tpl';
        }

        $this->render();
    }
}

?>
