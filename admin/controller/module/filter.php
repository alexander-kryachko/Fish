<?php
class ControllerModuleFilter extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/filter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('module/filter');
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_setting_setting->editSetting('filter', $this->request->post);

            $this->model_module_filter->clearDB();

            $attributes_categories = isset($this->request->post['attributes_categories']) ? $this->request->post['attributes_categories'] : array();

            foreach ($attributes_categories as $attribute) {
                if ($attribute['attribute_id'] == 'price') {
                    $attribute['name'] = $this->language->get('attr_price');
                } elseif ($attribute['attribute_id'] == 'manufacturers') {
                    $attribute['name'] = $this->language->get('attr_manufacturers');
                } else {
                    $attribute['name'] = $this->model_module_filter->getAttributeName($attribute['attribute_id']);
                }

                $attribute_id = $this->model_module_filter->addAttributeCategories($attribute);
                $attribute_values = $this->getAttributeValues($attribute['attribute_id']);

                if (!isset($attribute['categories'])) {
                    $attribute['categories'] = array();
                }

                foreach ($attribute_values as $attribute_value) {
                    $attribute_value_id = $this->model_module_filter->addAttributeCategoriesValue($attribute_id, $attribute_value['value']);
                    $products_id = $this->getProductsID($attribute['attribute_id'], $attribute_value);

                    if (!empty($products_id)) {
                        $categories_id = $this->model_module_filter->getCategoriesIDByProducts($products_id);
                        $categories_id = array_intersect($attribute['categories'], $categories_id);

                        foreach ($categories_id as $category_id) {
                            $quantity_items = $this->model_module_filter->getTotalProductsOnCategory($category_id, $products_id);
                            $this->model_module_filter->addCategoryAttribute($category_id, $attribute_value_id, $quantity_items);
                        }

                        foreach ($products_id as $product_id)
                            $this->model_module_filter->addProductAttributeCategory($product_id, $attribute_id, $attribute_value_id);
                    }
                }
            }

            $attributes_manufacturers = isset($this->request->post['attributes_manufacturers']) ? $this->request->post['attributes_manufacturers'] : array();

            foreach ($attributes_manufacturers as $attribute) {
                if ($attribute['attribute_id'] == 'price') {
                    $attribute['name'] = $this->language->get('attr_price');
                } elseif ($attribute['attribute_id'] == 'manufacturers') {
                    $attribute['name'] = $this->language->get('attr_manufacturers');
                } else {
                    $attribute['name'] = $this->model_module_filter->getAttributeName($attribute['attribute_id']);
                }

                $attribute_id = $this->model_module_filter->addAttributeManufacturers($attribute);
                $attribute_values = $this->getAttributeValues($attribute['attribute_id']);

                foreach ($attribute_values as $attribute_value) {
                    $attribute_value_id = $this->model_module_filter->addAttributeManufacturersValue($attribute_id, $attribute_value['value']);
                    $products_id = $this->getProductsID($attribute['attribute_id'], $attribute_value);

                    if (!empty($products_id)) {
                        $manufacturers_id = $this->model_module_filter->getManufacturersIDByProducts($products_id);

                        foreach ($manufacturers_id as $manufacturer_id) {
                            $quantity_items = $this->model_module_filter->getTotalProductsOnManufacturer($manufacturer_id, $products_id);
                            $this->model_module_filter->addManufacturerAttribute($manufacturer_id, $attribute_value_id, $quantity_items);
                        }

                        foreach ($products_id as $product_id)
                            $this->model_module_filter->addProductAttributeManufacturer($product_id, $attribute_id, $attribute_value_id);
                    }
                }
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['button_save']          = $this->language->get('button_save');
        $this->data['button_cancel']        = $this->language->get('button_cancel');
        $this->data['button_add']           = $this->language->get('button_add');
        $this->data['button_remove']        = $this->language->get('button_remove');
        $this->data['button_add_module']    = $this->language->get('button_add_module');
        $this->data['button_add_all']       = $this->language->get('button_add_all');
        $this->data['button_remove_all']    = $this->language->get('button_remove_all');

        $this->data['tab_categories']       = $this->language->get('tab_categories');
        $this->data['tab_manufacturers']    = $this->language->get('tab_manufacturers');

        $this->data['entry_attributes']     = $this->language->get('entry_attributes');
        $this->data['entry_sort_order']     = $this->language->get('entry_sort_order');
        $this->data['entry_category']       = $this->language->get('entry_category');
        $this->data['entry_manufacturer']   = $this->language->get('entry_manufacturer');
        $this->data['entry_category_view']       = $this->language->get('entry_category_view');
        $this->data['entry_manufacturer_view']   = $this->language->get('entry_manufacturer_view');
        $this->data['entry_layout']         = $this->language->get('entry_layout');
        $this->data['entry_position']       = $this->language->get('entry_position');
        $this->data['entry_status']         = $this->language->get('entry_status');

        $this->data['text_content_top']     = $this->language->get('text_content_top');
        $this->data['text_content_bottom']  = $this->language->get('text_content_bottom');
        $this->data['text_column_left']     = $this->language->get('text_column_left');
        $this->data['text_column_right']    = $this->language->get('text_column_right');

        $this->data['text_enabled']         = $this->language->get('text_enabled');
        $this->data['text_disabled']        = $this->language->get('text_disabled');

        $this->data['token']                = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
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
            'href'      => $this->url->link('module/filter', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/filter', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        // Массив атрибутов фильтра для категорий. Стандартные атрибуты - цена и производители. Остальные получаются вызовм функции из модели
        $attributes_categories = array(
            array('attribute_id' => 'price', 'name' => $this->language->get('attr_price')),
            array('attribute_id' => 'manufacturers', 'name' => $this->language->get('attr_manufacturers'))
        );
        $attributes_categories = array_merge($attributes_categories, $this->model_module_filter->getAttributesCategories());

        // Массив атрибутов фильтра для производителей. Стандартный атрибут - цена. Остальные получаются вызовм функции из модели
        $attributes_manufacturers = array(
            array('attribute_id' => 'price', 'name' => $this->language->get('attr_price'))
        );
        $attributes_manufacturers = array_merge($attributes_manufacturers, $this->model_module_filter->getAttributesManufacturers());

        if($this->model_setting_setting->getSetting('filter')) {
            $setting = $this->model_setting_setting->getSetting('filter');
        }

        // Список всех доступных атрибутов
        $this->data['attributes_categories_all'] = $attributes_categories;
        $this->data['attributes_manufacturers_all'] = $attributes_manufacturers;

        // Список активных атрибутов
        $attributes_categories = isset($setting['attributes_categories']) ? $setting['attributes_categories'] : array();
        $this->data['attributes_manufacturers'] = isset($setting['attributes_manufacturers']) ? $setting['attributes_manufacturers'] : array();

        foreach ($attributes_categories as $key => $attribute) {
            if (!isset($attribute['categories'])) {
                $attributes_categories[$key]['categories'] = array();
            }
        }

        $this->data['attributes_categories'] = $attributes_categories;

        // Список категорий
        $this->load->model('catalog/category');
        $categories = $this->model_catalog_category->getAllCategories();
        $this->data['categories'] = $this->getAllCategories($categories);

        $this->data['modules'] = array();

        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        if(isset($this->request->post['filter_module'])) {
            $this->data['modules'] = $this->request->post['filter_module'];
        } elseif($this->config->get('filter_module')) {
            $this->data['modules'] = $this->config->get('filter_module');
        }

        $this->template = 'module/filter.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function install() {
        $this->load->model('module/filter');

        $this->model_module_filter->install();
    }

    public function uninstall() {
        $this->load->model('module/filter');

        $this->model_module_filter->uninstall();
    }

    public function getAttributeValues($attribute_id) {
        if ($attribute_id == 'price') {
            return array(
                array('value' => "до 25грн",                'start' => 0,    'end' => 25),
                array('value' => "от 25грн до 50грн",       'start' => 25,   'end' => 50),
                array('value' => "от 50грн до 100грн",      'start' => 50,   'end' => 100),
                array('value' => "от 100грн до 200грн",     'start' => 100,  'end' => 200),
                array('value' => "от 200грн до 300грн",     'start' => 200,  'end' => 300),
                array('value' => "от 300грн до 500грн",     'start' => 300,  'end' => 500),
                array('value' => "от 500грн до 1,000грн",   'start' => 500,  'end' => 1000),
                array('value' => "от 1,000грн до 1,500грн", 'start' => 1000, 'end' => 1500),
                array('value' => "от 1,500грн до 2,000грн", 'start' => 1500, 'end' => 2000),
                array('value' => "от 2,000грн и выше",      'start' => 2000, 'end' => 1000000)
            );
        } elseif ($attribute_id == 'manufacturers') {
            return $this->model_module_filter->getManufactutersList();
        } else {
            return $this->model_module_filter->getAttributeValues($attribute_id);
        }
    }

    public function getProductsID($attribute_id, $attribute_value) {
        if ($attribute_id == 'price') {
            return $this->model_module_filter->getProductsIDByPrice($attribute_value['start'], $attribute_value['end']);
        } elseif ($attribute_id == 'manufacturers') {
            return $this->model_module_filter->getProductsIDByManufactuters($attribute_value['manufacturer_id']);
        } else {
            return $this->model_module_filter->getProductsIDByAttribute($attribute_id, $attribute_value['value']);
        }
    }

    public function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
        $output = array();

        if (array_key_exists($parent_id, $categories)) {
            if ($parent_name != '') {
                $parent_name .= $this->language->get('text_separator');
            }

            foreach ($categories[$parent_id] as $category) {
                if($category['seo_h1']) $name = $category['seo_h1'];
                else                    $name = $category['name'];

                $output[$category['category_id']] = array(
                    'category_id' => $category['category_id'],
                    'name'        => $this->db->escape($parent_name . $name)
                );

                $output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $name);
            }
        }

        return $output;
    }

    public function getCategoriesList() {
        $data = array();

        $this->load->model('catalog/category');
        $categories = $this->model_catalog_category->getAllCategories();
        $categories = $this->getAllCategories($categories);

        foreach ($categories as $category) {
            $data[] = array(
                'category_id' => $category['category_id'],
                'name'       =>  strip_tags(html_entity_decode($category['name'], ENT_QUOTES, 'UTF-8'))
            );
        }

        $this->response->setOutput(json_encode($data));
    }
}
?>
