<?php
class ControllerProductManufacturer extends Controller {
    public function index() {
        $this->language->load('product/manufacturer');

        $this->load->model('catalog/manufacturer');

        $this->load->model('tool/image');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_index'] = $this->language->get('text_index');
        $this->data['text_empty'] = $this->language->get('text_empty');

        $this->data['button_continue'] = $this->language->get('button_continue');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_brand'),
            'href'      => $this->url->link('product/manufacturer'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['categories'] = array();

        $results = $this->model_catalog_manufacturer->getManufacturers();

        foreach ($results as $result) {
            if (is_numeric(utf8_substr($result['name'], 0, 1))) {
                $key = '0 - 9';
            } else {
                $key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
            }

            if (!isset($this->data['manufacturers'][$key])) {
                $this->data['categories'][$key]['name'] = $key;
            }

            $this->data['categories'][$key]['manufacturer'][] = array(
                'name' => $result['name'],
                'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
            );
        }

        $this->data['continue'] = $this->url->link('common/home');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer_list.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/manufacturer_list.tpl';
        } else {
            $this->template = 'default/template/product/manufacturer_list.tpl';
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

    public function info() {
        $this->language->load('product/manufacturer');

        $this->load->model('catalog/manufacturer');

        $this->load->model('catalog/product');
		$this->load->model('catalog/set');

        $this->load->model('tool/image');

        if (isset($this->request->get['manufacturer_id'])) {
            $manufacturer_id = (int)$this->request->get['manufacturer_id'];
        } else {
            $manufacturer_id = 0;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort_order';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_catalog_limit');
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_brand'),
            'href'      => $this->url->link('product/manufacturer'),
            'separator' => $this->language->get('text_separator')
        );

        $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

        if ($manufacturer_info) {
            if ($manufacturer_info['seo_title']) {
                $this->document->setTitle($manufacturer_info['seo_title']);
            } else {
                $this->document->setTitle($manufacturer_info['name']);

            }
            $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
            $this->document->setDescription($manufacturer_info['meta_description']);
            $this->document->setKeywords($manufacturer_info['meta_keyword']);

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['breadcrumbs'][] = array(
                'text'      => $manufacturer_info['name'],
                'href'      => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),
                'separator' => $this->language->get('text_separator')
            );

            if ($manufacturer_info['seo_h1']) {
                $this->data['heading_title'] = $manufacturer_info['seo_h1'];
            } else {
                $this->data['heading_title'] = $manufacturer_info['name'];
            }

            $this->data['description'] = html_entity_decode($manufacturer_info['description'], ENT_QUOTES, 'UTF-8');



            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_quantity'] = $this->language->get('text_quantity');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $this->data['text_display'] = $this->language->get('text_display');
            $this->data['text_list'] = $this->language->get('text_list');
            $this->data['text_grid'] = $this->language->get('text_grid');
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_limit'] = $this->language->get('text_limit');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['compare'] = $this->url->link('product/compare');

            $this->data['products'] = array();

            $data = array(
                'filter_manufacturer_id' => $manufacturer_id,
                'sort'                   => $sort,
                'order'                  => $order,
                'start'                  => ($page - 1) * $limit,
                'limit'                  => $limit
            );

            $results = $this->model_catalog_product->getProducts($data);
            //Вызов метода getFoundProducts должен проводится сразу же после getProducts
            //только тогда он выдает правильное значения количества товаров
            $product_total = $this->model_catalog_product->getFoundProducts();

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = false;
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

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] && (float)$result['special'] < (float)$result['price'] ? $result['special'] : $result['price']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$result['rating'];
                } else {
                    $rating = false;
                }

				$this->load->model('catalog/product');
				$this->load->model('catalog/set');
				$this->load->model('catalog/category');
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
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
					'is_set' 	  => $this->model_catalog_set->isSetExist($result['product_id']),
                    'name'        => $result['name'],
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
                    'price'       => $price,
                    'special'     => $special,
                    'tax'         => $tax,
                    'rating'      => $result['rating'],
                    'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'href'        => $this->url->link('product/product', 'path='. $full_url .'&product_id=' . $result['product_id'])
                );
            }

            $url = '';

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['sorts'] = array();

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_default'),
                'value' => 'p.sort_order-ASC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.sort_order&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_asc'),
                'value' => 'pd.name-ASC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_desc'),
                'value' => 'pd.name-DESC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_asc'),
                'value' => 'p.price-ASC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_desc'),
                'value' => 'p.price-DESC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=DESC' . $url)
            );

            if ($this->config->get('config_review_status')) {
                $this->data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_desc'),
                    'value' => 'rating-DESC',
                    'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=DESC' . $url)


            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_rating_asc'),
                'value' => 'rating-ASC',
                    'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=ASC' . $url)

            );
            }

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_model_asc'),
                'value' => 'p.model-ASC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.model&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_model_desc'),
                'value' => 'p.model-DESC',
                'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.model&order=DESC' . $url)
            );

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $this->data['limits'] = array();

            $limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

            sort($limits);

            foreach($limits as $limits){
                $this->data['limits'][] = array(
                    'text'  => $limits,
                    'value' => $limits,
                    'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&limit=' . $limits)
                );
            }

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $pagination = new Pagination();
            $pagination->total = $product_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->text = $this->language->get('text_pagination');
            $pagination->url = $this->url->link('product/manufacturer/info','manufacturer_id=' . $this->request->get['manufacturer_id'] .  $url . '&page={page}');

            $this->data['pagination'] = $pagination->render();

            $this->data['sort'] = $sort;
            $this->data['order'] = $order;
            $this->data['limit'] = $limit;

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer_info.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/manufacturer_info.tpl';
            } else {
                $this->template = 'default/template/product/manufacturer_info.tpl';
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
        } else {
            $url = '';

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_error'),
                'href'      => $this->url->link('product/category', $url),
                'separator' => $this->language->get('text_separator')
            );

            $this->document->setTitle($this->language->get('text_error'));

            $this->data['heading_title'] = $this->language->get('text_error');

            $this->data['text_error'] = $this->language->get('text_error');

            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
            } else {
                $this->template = 'default/template/error/not_found.tpl';
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
    }
}
?>