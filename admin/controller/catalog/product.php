<?php
class ControllerCatalogProduct extends Controller {
    private $error = array();


    public function quick_edit()
    {
        if ( $this->request->post['product_id'] && $this->request->post['action'] && isset($this->request->post['value']) ) {
            $product_id = $this->request->post['product_id'];
            $action = $this->request->post['action'];
            $value = $this->request->post['value'];

            switch ($action) {
                case 'name':
                $sql = "SELECT language_id FROM ".DB_PREFIX."language l LEFT JOIN ".DB_PREFIX."setting s ON(l.code = s.value) WHERE s.key = 'config_admin_language'";
                $query = $this->db->query($sql);
                $language_id = $query->row['language_id'];

                $sql = "UPDATE ".DB_PREFIX."product_description SET name = '". $this->db->escape($value)."' WHERE product_id = $product_id AND language_id = $language_id";
                break;
                case 'model':
                $sql = "UPDATE ".DB_PREFIX."product SET model = '$value' WHERE product_id = $product_id";
                break;
                case 'quantity':
                $sql = "UPDATE ".DB_PREFIX."product SET quantity = $value WHERE product_id = $product_id";
                break;
                case 'price':
                $sql = "UPDATE ".DB_PREFIX."product SET price = $value WHERE product_id = $product_id";
                break;
                case 'special':
                $sql = "UPDATE ".DB_PREFIX."product_special SET price = $value WHERE product_id = $product_id ORDER BY priority, price LIMIT 1";
                break;
                case 'status':
                $sql = "UPDATE ".DB_PREFIX."product SET status = $value WHERE product_id = $product_id";
                break;
                default:
                $sql = '';
                break;
            }
            if ($sql != '') {
                $query = $this->db->query($sql);
                echo '1';
                $this->cache->delete('product');
            }else{
                echo $product_id.' '.$action. ' '.$value;
            }
        }
    }

    public function index() {
        $this->language->load('catalog/product');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        $this->getList();
    }
    public function filter() {

        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_category_id'])) {
            $filter_category_id = $this->request->get['filter_category_id'];
        } else {
            $filter_category_id = null;
        }
        if (isset($this->request->get['filter_manufacturer_id'])) {
            $filter_manufacturer_id = $this->request->get['filter_manufacturer_id'];
        } else {
            $filter_manufacturer_id = null;
        }

        if (isset($this->request->get['filter_model'])) {
            $filter_model = $this->request->get['filter_model'];
        } else {
            $filter_model = null;
        }

        if (isset($this->request->get['filter_price'])) {
            $filter_price = $this->request->get['filter_price'];
        } else {
            $filter_price = null;
        }

        if (isset($this->request->get['filter_quantity'])) {
            $filter_quantity = $this->request->get['filter_quantity'];
        } else {
            $filter_quantity = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.name';
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

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . $this->request->get['filter_name'];
        }

        if (isset($this->request->get['filter_category_id'])) {
            $url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
        }

        if (isset($this->request->get['filter_manufacturer_id'])) {
            $url .= '&filter_manufacturer_id=' . $this->request->get['filter_manufacturer_id'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . $this->request->get['filter_name'];
        }

        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . $this->request->get['filter_model'];
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_quantity'])) {
            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $data = array(
            'filter_name'     => $filter_name,
            'filter_category_id'      => $filter_category_id,
            'filter_manufacturer_id'      => $filter_manufacturer_id,
            'filter_model'    => $filter_model,
            'filter_price'    => $filter_price,
            'filter_quantity' => $filter_quantity,
            'filter_status'   => $filter_status,
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit'           => $this->config->get('config_admin_limit')
            );

        $this->load->model('tool/image');
        $this->load->model('catalog/product');

        $product_total = $this->model_catalog_product->getTotalProducts($data);

        $results = $this->model_catalog_product->getProducts($data);

        $json['products'] = array();
        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
                );

            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], 40, 40);
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
            }

            $special = false;

            $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

            foreach ($product_specials  as $product_special) {
                if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] > date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] < date('Y-m-d'))) {
                    $special = $product_special['price'];

                    break;
                }
            }

            $json['products'][] = array(
                'product_id'    => $result['product_id'],
                'name'          => $result['name'],
                'category'      => $this->model_catalog_product->getProductCatNames($result['product_id']),
                'manufacturer'  => $result['m_name'],
                'model'         => $result['model'],
                'price'         => $result['price'],
                'special'       => $special,
                'image'     => $image,
                'quantity'      => $result['quantity'],
                'status'        => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                'selected'      => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                'action'        => $action
                );
        }
        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $json['pagination'] = $pagination->render();

        $this->response->setOutput(json_encode($json));
    }


    public function setatten() {
        $this->load->language('catalog/product');
        $this->load->model('catalog/product');
        $output='';
        if(isset($this->request->get['object_id'])){
            $requestpart = explode('-',$this->request->get['object_id']);
            if(count($requestpart)==2){
                $column_name = $requestpart[0];
                $product_id = $requestpart[1];
                $result = $this->model_catalog_product->getProduct($product_id);
                if($result[$column_name]){
                    $this->model_catalog_product->setAttributeen($product_id, $column_name, 0);
                } else {
                    $this->model_catalog_product->setAttributeen($product_id, $column_name, 1);
                }
                $result = $this->model_catalog_product->getProduct($product_id);
                $output = $result[$column_name] ? $this->language->get('text_enabled') : $this->language->get('text_disabled');
            }
        }
        $this->response->setOutput($output);
    }

    public function insert() {
        $this->language->load('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->request->post['jan'] = $this->user->getUserName();
            $this->model_catalog_product->addProduct($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';


            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
            }

            if (isset($this->request->get['filter_manufacturer_id'])) {
                $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
            $this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			
            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
            }

            if (isset($this->request->get['filter_manufacturer_id'])) {
                $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product->deleteProduct($product_id);
            }
		

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
            }

            if (isset($this->request->get['filter_manufacturer_id'])) {
                $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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
			

            $this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    public function copy() {
        $this->language->load('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');

        if (isset($this->request->post['selected']) && $this->validateCopy()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product->copyProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
            }

            if (isset($this->request->get['filter_manufacturer_id'])) {
                $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
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

            $this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    private function getList() {
		$this->load->model('catalog/set');
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }
        if (isset($this->request->get['filter_category_id'])) {
            $filter_category_id = $this->request->get['filter_category_id'];
        } else {
            $filter_category_id = null;
        }
        if (isset($this->request->get['filter_manufacturer_id'])) {
            $filter_manufacturer_id = $this->request->get['filter_manufacturer_id'];
        } else {
            $filter_manufacturer_id = null;
        }

        if (isset($this->request->get['filter_model'])) {
            $filter_model = $this->request->get['filter_model'];
        } else {
            $filter_model = null;
        }

        if (isset($this->request->get['filter_price'])) {
            $filter_price = $this->request->get['filter_price'];
        } else {
            $filter_price = null;
        }

        if (isset($this->request->get['filter_quantity'])) {
            $filter_quantity = $this->request->get['filter_quantity'];
        } else {
            $filter_quantity = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.name';
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

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;
        $this->data['page'] = $page;

        $url = '';

        if (isset($this->request->get['filter_category_id'])) {
            $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
        }

        if (isset($this->request->get['filter_manufacturer_id'])) {
            $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . $this->request->get['filter_name'];
        }

        if (isset($this->request->get['filter_model'])) {
            $url .= '&filter_model=' . $this->request->get['filter_model'];
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_quantity'])) {
            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
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

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
            );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
            );

        $this->data['insert'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

//BOF Product Series
        $this->data['create_product_series'] = $this->url->link('catalog/product/createProductSeries', 'token=' . $this->session->data['token'] . $url, 'SSL');
//EOF Product Series

        $this->data['quick_edit'] = $this->url->link('catalog/product/quick_edit', 'token=' . $this->session->data['token'] . $url, 'SSL');


        $this->data['products'] = array();

        $data = array(
            'filter_name'     => $filter_name,
            'filter_manufacturer_id'  => $filter_manufacturer_id,
            'filter_category_id'      => $filter_category_id,
            'filter_model'    => $filter_model,
            'filter_price'    => $filter_price,
            'filter_quantity' => $filter_quantity,
            'filter_status'   => $filter_status,
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit'           => $this->config->get('config_admin_limit')
            );

        $this->load->model('tool/image');

        $product_total = $this->model_catalog_product->getTotalProducts($data);

        $results = $this->model_catalog_product->getProducts($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
                );

            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], 40, 40);
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
            }

            $special = false;

            $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

            foreach ($product_specials  as $product_special) {
                if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] > date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] < date('Y-m-d'))) {
                    $special = $product_special['price'];

                    break;
                }
            }

			if($this->config->get('set_place_product_page')){
				if($this->model_catalog_set->getSetByProduct($result['product_id'])){continue;}    
			}
			
            $this->data['products'][] = array(
                'product_id' => $result['product_id'],
                'category'   => $this->model_catalog_product->getProductCatNames($result['product_id']),
                'manufacturer'  => $result['m_name'],
                'name'       => $result['name'],
                'model'      => $result['model'],
                'price'      => $result['price'],
                'special'    => $special,
                'image'      => $image,
                'quantity'   => $result['quantity'],
                'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                'action'     => $action
                );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_save'] = $this->language->get('text_save');
        if($this->data['text_save'] == 'text_save') $this->data['text_save'] = 'Save';

        $this->data['text_close'] = $this->language->get('text_close');
        if($this->data['text_close'] == 'text_close') $this->data['text_close'] = 'Close';


        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');


        $this->data['column_category'] = $this->language->get('column_category');
        $this->data['column_manufacturer'] = $this->language->get('column_manufacturer');
        $this->data['column_image'] = $this->language->get('column_image');
        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_model'] = $this->language->get('column_model');
        $this->data['column_price'] = $this->language->get('column_price');
        $this->data['column_quantity'] = $this->language->get('column_quantity');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_copy'] = $this->language->get('button_copy');
        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');
        $this->data['button_clear'] = $this->language->get('button_clear');

        $this->data['token'] = $this->session->data['token'];

//BOF Product Series
        if (isset($this->error['color_name'])) {
            $this->data['error_product_name'] = $this->error['color_name'];
        } else {
            $this->data['error_product_name'] = '';
        }

        if (isset($this->error['color_name_duplicated'])) {
            $this->data['error_product_name_duplicated'] = $this->error['color_name_duplicated'];
        } else {
            $this->data['error_product_name_duplicated'] = '';
        }

        if (isset($this->error['color_code'])) {
            $this->data['error_product_code'] = $this->error['color_code'];
        } else {
            $this->data['error_product_code'] = '';
        }

        if (isset($this->error['product_color'])) {
            $this->data['error_product_color'] = $this->error['product_color'];
        } else {
            $this->data['error_product_color'] = '';
        }

        if (isset($this->error['master_product'])) {
            $this->data['error_master_product'] = $this->error['master_product'];
        } else {
            $this->data['error_master_product'] = '';
        }

        if (isset($this->request->post['new_product_name'])) {
            $this->data['new_product_name'] = $this->request->post['new_product_name'];
        } else {
            $this->data['new_product_name'] = '';
        }

        if (isset($this->request->post['new_product_code'])) {
            $this->data['new_product_code'] = $this->request->post['new_product_code'];
        } else {
            $this->data['new_product_code'] = '';
        }

        if (isset($this->request->post['master_product'])) {
            $this->data['master_product'] = $this->request->post['master_product'];
        } else {
            $this->data['master_product'] = '-1';
        }

//get existing colors
        $this->load->model('catalog/special_attribute');
        $this->load->model('catalog/product_special_attribute');
        $this->load->model('catalog/product_master');

$results = $this->model_catalog_special_attribute->getAllSpecialAttribute('2'); //2 is Image
$this->data['all_product_colors'] = array();
foreach($results as $result)
{
    $this->data['all_product_colors'][] = array(
        'color_id' => $result['special_attribute_id'],
        'color_name' => $result['special_attribute_name'],
        'color_code' => $result['special_attribute_value'],
        );
}

//get list of available master products
$this->data['all_master_product'] = $this->model_catalog_product_master->getAllMasterableProducts('2'); //2 is Image

if (isset($this->request->post['product_series_image'])) {
    $this->data['product_series_image'] = $this->request->post['product_series_image'];
} elseif (isset($this->request->get['product_id'])) {
$psa = $this->model_catalog_product_special_attribute->getProductSpecialAttribute($this->request->get['product_id'], '2'); //'2' is image

$this->data['product_series_image'] = $psa['special_attribute_value'];
} else {
$this->data['product_series_image'] = 'no_image.jpg'; //NA by default
}

$this->load->model('tool/image');

if (isset($this->data['product_series_image']) && file_exists(DIR_IMAGE . $this->data['product_series_image'])) {
    if($this->data['product_series_image'] != '')
    {
        $this->data['product_series_thumb'] = $this->model_tool_image->resize($this->data['product_series_image'], 100, 100);
    }
    else
    {
        $this->data['product_series_thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
    }
} else {
    $this->data['product_series_thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
}

if (isset($this->request->post['master_product'])) {
    $this->data['master_product'] = $this->request->post['master_product'];
} elseif (isset($this->request->get['product_id'])) {
$this->data['master_product'] = $this->model_catalog_product_master->getMasterProductId($this->request->get['product_id'], '2'); //2 is Image
} else {
$this->data['master_product'] = '-1'; //is single item by default
}

if(isset($this->request->get['product_id']))
{
    $product_id = $this->request->get['product_id'];
    $this->data['product_id'] = $product_id;

//$this->data['current_product_color'] = $this->model_catalog_product_special_attribute->getProductSpecialAttribute($product_id, '2'); //2 is Image

    $this->data['color_linked_products'] = array();
$results = $this->model_catalog_product->getLinkedProducts($product_id, '2'); //2 is Image
foreach($results as $result)
{
    $this->data['color_linked_products'][] = array(
        'product_id' => $result['product_id'],
        'product_name' => $result['product_name'],
        'product_model' => $result['product_model'],
        'color_name' => $result['special_attribute_name'],
        'product_series_thumb' => $result['special_attribute_value'] != '' ?
        $this->model_tool_image->resize($result['special_attribute_value'], 50, 50) :
        $this->model_tool_image->resize($result['image'], 50, 50)   ,
        'edit_href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'], 'SSL')
        );
}
}
else
{
    $this->data['product_id'] = '';
//$this->data['current_product_color'] = '';
    $this->data['color_linked_products'] = array();
}

//get product color option
if (isset($this->request->post['color_option'])) {
    $this->data['color_option'] = $this->request->post['color_option'];
/*} else if ((int)$this->data['current_product_color'] > 0){
$this->data['color_option'] = 'existingColor';
}*/
} else{
    $this->data['color_option'] = 'colorNotAvailable';
}

//get Product Series type
$this->data['is_single_item'] = (int)$this->data['master_product'] == -1;
$this->data['is_product_series_master'] = (int)$this->data['master_product'] == 0;
$this->data['is_product_series_slave'] = (int)$this->data['master_product'] > 0;
$this->data['is_linked_product_series_master'] = ($this->data['is_product_series_master'] && sizeof($this->data['color_linked_products']) > 0);

//text
$this->load->language('catalog/pds');
$this->data['tab_product_series'] = $this->language->get('tab_product_series');

$this->data['text_is_a_product_series_master'] = $this->language->get('text_is_a_product_series_master');
$this->data['text_product_under_same_product_series'] = $this->language->get('text_product_under_same_product_series');
$this->data['text_link_to_a_product_series'] = $this->language->get('text_link_to_a_product_series');
$this->data['text_edit'] = $this->language->get('text_edit');
$this->data['text_confirm_leave_page'] = $this->language->get('text_confirm_leave_page');
$this->data['text_is_single_item'] = $this->language->get('text_is_single_item');
$this->data['text_is_product_series_master'] = $this->language->get('text_is_product_series_master');
$this->data['text_is_product_series_slave'] = $this->language->get('text_is_product_series_slave');
$this->data['text_product_color'] = $this->language->get('text_product_color');

$this->data['column_product_code'] = $this->language->get('column_product_code');
$this->data['column_product_series_image'] = $this->language->get('column_product_series_image');
$this->data['column_color'] = $this->language->get('column_color');
$this->data['column_name'] = $this->language->get('column_name');
$this->data['column_action'] = $this->language->get('column_action');
$this->data['column_model'] = $this->language->get('column_model');

$this->data['entry_product_not_available'] = $this->language->get('entry_product_not_available');
$this->data['entry_choose_from_existing_color'] = $this->language->get('entry_choose_from_existing_color');
$this->data['entry_add_new_color'] = $this->language->get('entry_add_new_color');

$this->data['button_create_product_series'] = $this->language->get('button_create_product_series');

//EOF Product Series
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

$url = '';

if (isset($this->request->get['filter_category_id'])) {
    $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
}

if (isset($this->request->get['filter_manufacturer_id'])) {
    $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
}

if (isset($this->request->get['filter_name'])) {
    $url .= '&filter_name=' . $this->request->get['filter_name'];
}

if (isset($this->request->get['filter_model'])) {
    $url .= '&filter_model=' . $this->request->get['filter_model'];
}

if (isset($this->request->get['filter_price'])) {
    $url .= '&filter_price=' . $this->request->get['filter_price'];
}

if (isset($this->request->get['filter_quantity'])) {
    $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
}

if (isset($this->request->get['filter_status'])) {
    $url .= '&filter_status=' . $this->request->get['filter_status'];
}

if ($order == 'ASC') {
    $url .= '&order=DESC';
} else {
    $url .= '&order=ASC';
}

if (isset($this->request->get['page'])) {
    $url .= '&page=' . $this->request->get['page'];
}

$this->data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
$this->data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
$this->data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
$this->data['sort_quantity'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
$this->data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
$this->data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

$url = '';

if (isset($this->request->get['filter_category_id'])) {
    $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
}

if (isset($this->request->get['filter_manufacturer_id'])) {
    $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
}

if (isset($this->request->get['filter_name'])) {
    $url .= '&filter_name=' . $this->request->get['filter_name'];
}

if (isset($this->request->get['filter_model'])) {
    $url .= '&filter_model=' . $this->request->get['filter_model'];
}

if (isset($this->request->get['filter_price'])) {
    $url .= '&filter_price=' . $this->request->get['filter_price'];
}

if (isset($this->request->get['filter_quantity'])) {
    $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
}

if (isset($this->request->get['filter_status'])) {
    $url .= '&filter_status=' . $this->request->get['filter_status'];
}

if (isset($this->request->get['sort'])) {
    $url .= '&sort=' . $this->request->get['sort'];
}

if (isset($this->request->get['order'])) {
    $url .= '&order=' . $this->request->get['order'];
}

$pagination = new Pagination();
$pagination->total = $product_total;
$pagination->page = $page;
$pagination->limit = $this->config->get('config_admin_limit');
$pagination->text = $this->language->get('text_pagination');
$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

$this->data['pagination'] = $pagination->render();

$this->data['filter_category_id'] = $filter_category_id;
$this->data['filter_manufacturer_id'] = $filter_manufacturer_id;
$this->data['filter_name'] = $filter_name;
$this->data['filter_model'] = $filter_model;
$this->data['filter_price'] = $filter_price;
$this->data['filter_quantity'] = $filter_quantity;
$this->data['filter_status'] = $filter_status;

$this->data['sort'] = $sort;
$this->data['order'] = $order;

$this->load->model('catalog/category');
$this->load->model('catalog/manufacturer');

$this->data['categories'] = $this->model_catalog_category->getCategories(0);


$this->data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();


$this->template = 'catalog/product_list.tpl';
$this->children = array(
    'common/header',
    'common/footer'
    );

$this->response->setOutput($this->render());
}

protected function getForm() {
			# OCFilter start
			$this->document->addStyle('view/stylesheet/ocfilter/ocfilter.css');
			$this->document->addScript('view/javascript/ocfilter/ocfilter.js');
			# OCFilter end
			
    $this->data['heading_title'] = $this->language->get('heading_title');

    $this->data['text_enabled'] = $this->language->get('text_enabled');
    $this->data['text_disabled'] = $this->language->get('text_disabled');
    $this->data['text_none'] = $this->language->get('text_none');
    $this->data['text_yes'] = $this->language->get('text_yes');
    $this->data['text_no'] = $this->language->get('text_no');
    $this->data['text_select_all'] = $this->language->get('text_select_all');
    $this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
    $this->data['text_plus'] = $this->language->get('text_plus');
    $this->data['text_minus'] = $this->language->get('text_minus');
    $this->data['text_default'] = $this->language->get('text_default');
    $this->data['text_image_manager'] = $this->language->get('text_image_manager');
    $this->data['text_browse'] = $this->language->get('text_browse');
    $this->data['text_clear'] = $this->language->get('text_clear');
    $this->data['text_option'] = $this->language->get('text_option');
    $this->data['text_option_value'] = $this->language->get('text_option_value');
    $this->data['text_select'] = $this->language->get('text_select');
    $this->data['text_none'] = $this->language->get('text_none');
    $this->data['text_percent'] = $this->language->get('text_percent');
    $this->data['text_amount'] = $this->language->get('text_amount');
    $this->data['text_hidelink'] = $this->language->get('text_hidelink');

    $this->data['entry_name'] = $this->language->get('entry_name');
    $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
    $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
    $this->data['entry_description'] = $this->language->get('entry_description');
    $this->data['entry_store'] = $this->language->get('entry_store');
    $this->data['entry_keyword'] = $this->language->get('entry_keyword');
    $this->data['entry_model'] = $this->language->get('entry_model');
    $this->data['entry_sku'] = $this->language->get('entry_sku');
    $this->data['entry_upc'] = $this->language->get('entry_upc');
    $this->data['entry_ean'] = $this->language->get('entry_ean');
    $this->data['entry_jan'] = $this->language->get('entry_jan');
    $this->data['entry_isbn'] = $this->language->get('entry_isbn');
    $this->data['entry_mpn'] = $this->language->get('entry_mpn');
    $this->data['entry_location'] = $this->language->get('entry_location');
    $this->data['entry_minimum'] = $this->language->get('entry_minimum');
    $this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
    $this->data['entry_shipping'] = $this->language->get('entry_shipping');
    $this->data['entry_date_available'] = $this->language->get('entry_date_available');
    $this->data['entry_quantity'] = $this->language->get('entry_quantity');
    $this->data['entry_stock_status'] = $this->language->get('entry_stock_status');
    $this->data['entry_price'] = $this->language->get('entry_price');
    $this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
    $this->data['entry_points'] = $this->language->get('entry_points');
    $this->data['entry_option_points'] = $this->language->get('entry_option_points');
    $this->data['entry_subtract'] = $this->language->get('entry_subtract');
    $this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
    $this->data['entry_weight'] = $this->language->get('entry_weight');
    $this->data['entry_dimension'] = $this->language->get('entry_dimension');
    $this->data['entry_length'] = $this->language->get('entry_length');
    $this->data['entry_image'] = $this->language->get('entry_image');
    $this->data['entry_download'] = $this->language->get('entry_download');
    $this->data['entry_category'] = $this->language->get('entry_category');
    $this->data['entry_filter'] = $this->language->get('entry_filter');
    $this->data['entry_related'] = $this->language->get('entry_related');
    $this->data['entry_attribute'] = $this->language->get('entry_attribute');
    $this->data['entry_text'] = $this->language->get('entry_text');
    $this->data['entry_option'] = $this->language->get('entry_option');
    $this->data['entry_option_value'] = $this->language->get('entry_option_value');
    $this->data['entry_required'] = $this->language->get('entry_required');
    $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
    $this->data['entry_status'] = $this->language->get('entry_status');
    $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
    $this->data['entry_date_start'] = $this->language->get('entry_date_start');
    $this->data['entry_date_end'] = $this->language->get('entry_date_end');
    $this->data['entry_priority'] = $this->language->get('entry_priority');
    $this->data['entry_tag'] = $this->language->get('entry_tag');
    $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
    $this->data['entry_reward'] = $this->language->get('entry_reward');
    $this->data['entry_layout'] = $this->language->get('entry_layout');
    $this->data['entry_main_category'] = $this->language->get('entry_main_category');
    $this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
    $this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');

    $this->data['button_save'] = $this->language->get('button_save');
    $this->data['button_cancel'] = $this->language->get('button_cancel');
    $this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
    $this->data['button_add_option'] = $this->language->get('button_add_option');
    $this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
    $this->data['button_add_discount'] = $this->language->get('button_add_discount');
    $this->data['button_add_special'] = $this->language->get('button_add_special');
    $this->data['button_add_image'] = $this->language->get('button_add_image');
    $this->data['button_remove'] = $this->language->get('button_remove');

    
			# OCFilter start
			$this->data['tab_ocfilter'] = $this->language->get('tab_ocfilter');
			$this->data['entry_values'] = $this->language->get('entry_values');
			$this->data['ocfilter_select_category'] = $this->language->get('ocfilter_select_category');
			# OCFilter end
			$this->data['tab_general'] = $this->language->get('tab_general');
    $this->data['tab_data'] = $this->language->get('tab_data');
    $this->data['tab_attribute'] = $this->language->get('tab_attribute');
    $this->data['tab_option'] = $this->language->get('tab_option');
    $this->data['tab_discount'] = $this->language->get('tab_discount');
    $this->data['tab_special'] = $this->language->get('tab_special');
    $this->data['tab_image'] = $this->language->get('tab_image');
    $this->data['tab_links'] = $this->language->get('tab_links');
    $this->data['tab_reward'] = $this->language->get('tab_reward');
    $this->data['tab_design'] = $this->language->get('tab_design');

//BOF Product Series
    if (isset($this->error['color_name'])) {
        $this->data['error_product_name'] = $this->error['color_name'];
    } else {
        $this->data['error_product_name'] = '';
    }

    if (isset($this->error['color_name_duplicated'])) {
        $this->data['error_product_name_duplicated'] = $this->error['color_name_duplicated'];
    } else {
        $this->data['error_product_name_duplicated'] = '';
    }

    if (isset($this->error['color_code'])) {
        $this->data['error_product_code'] = $this->error['color_code'];
    } else {
        $this->data['error_product_code'] = '';
    }

    if (isset($this->error['product_color'])) {
        $this->data['error_product_color'] = $this->error['product_color'];
    } else {
        $this->data['error_product_color'] = '';
    }

    if (isset($this->error['master_product'])) {
        $this->data['error_master_product'] = $this->error['master_product'];
    } else {
        $this->data['error_master_product'] = '';
    }

    if (isset($this->request->post['new_product_name'])) {
        $this->data['new_product_name'] = $this->request->post['new_product_name'];
    } else {
        $this->data['new_product_name'] = '';
    }

    if (isset($this->request->post['new_product_code'])) {
        $this->data['new_product_code'] = $this->request->post['new_product_code'];
    } else {
        $this->data['new_product_code'] = '';
    }

    if (isset($this->request->post['master_product'])) {
        $this->data['master_product'] = $this->request->post['master_product'];
    } else {
        $this->data['master_product'] = '-1';
    }

//get existing colors
    $this->load->model('catalog/special_attribute');
    $this->load->model('catalog/product_special_attribute');
    $this->load->model('catalog/product_master');

$results = $this->model_catalog_special_attribute->getAllSpecialAttribute('2'); //2 is Image
$this->data['all_product_colors'] = array();
foreach($results as $result)
{
    $this->data['all_product_colors'][] = array(
        'color_id' => $result['special_attribute_id'],
        'color_name' => $result['special_attribute_name'],
        'color_code' => $result['special_attribute_value'],
        );
}

//get list of available master products
$this->data['all_master_product'] = $this->model_catalog_product_master->getAllMasterableProducts('2'); //2 is Image

if (isset($this->request->post['product_series_image'])) {
    $this->data['product_series_image'] = $this->request->post['product_series_image'];
} elseif (isset($this->request->get['product_id'])) {
$psa = $this->model_catalog_product_special_attribute->getProductSpecialAttribute($this->request->get['product_id'], '2'); //'2' is image

$this->data['product_series_image'] = $psa['special_attribute_value'];
} else {
$this->data['product_series_image'] = 'no_image.jpg'; //NA by default
}

$this->load->model('tool/image');

if (isset($this->data['product_series_image']) && file_exists(DIR_IMAGE . $this->data['product_series_image'])) {
    if($this->data['product_series_image'] != '')
    {
        $this->data['product_series_thumb'] = $this->model_tool_image->resize($this->data['product_series_image'], 100, 100);
    }
    else
    {
        $this->data['product_series_thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
    }
} else {
    $this->data['product_series_thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
}

if (isset($this->request->post['master_product'])) {
    $this->data['master_product'] = $this->request->post['master_product'];
} elseif (isset($this->request->get['product_id'])) {
$this->data['master_product'] = $this->model_catalog_product_master->getMasterProductId($this->request->get['product_id'], '2'); //2 is Image
} else {
$this->data['master_product'] = '-1'; //is single item by default
}

if(isset($this->request->get['product_id']))
{
    $product_id = $this->request->get['product_id'];
    $this->data['product_id'] = $product_id;

//$this->data['current_product_color'] = $this->model_catalog_product_special_attribute->getProductSpecialAttribute($product_id, '2'); //2 is Image

    $this->data['color_linked_products'] = array();
$results = $this->model_catalog_product->getLinkedProducts($product_id, '2'); //2 is Image
foreach($results as $result)
{
    $this->data['color_linked_products'][] = array(
        'product_id' => $result['product_id'],
        'product_name' => $result['product_name'],
        'product_model' => $result['product_model'],
        'color_name' => $result['special_attribute_name'],
        'product_series_thumb' => $result['special_attribute_value'] != '' ?
        $this->model_tool_image->resize($result['special_attribute_value'], 50, 50) :
        $this->model_tool_image->resize($result['image'], 50, 50)   ,
        'edit_href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'], 'SSL')
        );
}
}
else
{
    $this->data['product_id'] = '';
//$this->data['current_product_color'] = '';
    $this->data['color_linked_products'] = array();
}

//get product color option
if (isset($this->request->post['color_option'])) {
    $this->data['color_option'] = $this->request->post['color_option'];
/*} else if ((int)$this->data['current_product_color'] > 0){
$this->data['color_option'] = 'existingColor';
}*/
} else{
    $this->data['color_option'] = 'colorNotAvailable';
}

//get Product Series type
$this->data['is_single_item'] = (int)$this->data['master_product'] == -1;
$this->data['is_product_series_master'] = (int)$this->data['master_product'] == 0;
$this->data['is_product_series_slave'] = (int)$this->data['master_product'] > 0;
$this->data['is_linked_product_series_master'] = ($this->data['is_product_series_master'] && sizeof($this->data['color_linked_products']) > 0);

//text
$this->load->language('catalog/pds');
$this->data['tab_product_series'] = $this->language->get('tab_product_series');

$this->data['text_is_a_product_series_master'] = $this->language->get('text_is_a_product_series_master');
$this->data['text_product_under_same_product_series'] = $this->language->get('text_product_under_same_product_series');
$this->data['text_link_to_a_product_series'] = $this->language->get('text_link_to_a_product_series');
$this->data['text_edit'] = $this->language->get('text_edit');
$this->data['text_confirm_leave_page'] = $this->language->get('text_confirm_leave_page');
$this->data['text_is_single_item'] = $this->language->get('text_is_single_item');
$this->data['text_is_product_series_master'] = $this->language->get('text_is_product_series_master');
$this->data['text_is_product_series_slave'] = $this->language->get('text_is_product_series_slave');
$this->data['text_product_color'] = $this->language->get('text_product_color');

$this->data['column_product_code'] = $this->language->get('column_product_code');
$this->data['column_product_series_image'] = $this->language->get('column_product_series_image');
$this->data['column_color'] = $this->language->get('column_color');
$this->data['column_name'] = $this->language->get('column_name');
$this->data['column_action'] = $this->language->get('column_action');
$this->data['column_model'] = $this->language->get('column_model');

$this->data['entry_product_not_available'] = $this->language->get('entry_product_not_available');
$this->data['entry_choose_from_existing_color'] = $this->language->get('entry_choose_from_existing_color');
$this->data['entry_add_new_color'] = $this->language->get('entry_add_new_color');

$this->data['button_create_product_series'] = $this->language->get('button_create_product_series');

//EOF Product Series
if (isset($this->error['warning'])) {
    $this->data['error_warning'] = $this->error['warning'];
} else {
    $this->data['error_warning'] = '';
}

if (isset($this->error['name'])) {
    $this->data['error_name'] = $this->error['name'];
} else {
    $this->data['error_name'] = array();
}

if (isset($this->error['meta_description'])) {
    $this->data['error_meta_description'] = $this->error['meta_description'];
} else {
    $this->data['error_meta_description'] = array();
}

if (isset($this->error['description'])) {
    $this->data['error_description'] = $this->error['description'];
} else {
    $this->data['error_description'] = array();
}

if (isset($this->error['model'])) {
    $this->data['error_model'] = $this->error['model'];
} else {
    $this->data['error_model'] = '';
}

if (isset($this->error['date_available'])) {
    $this->data['error_date_available'] = $this->error['date_available'];
} else {
    $this->data['error_date_available'] = '';
}

$url = '';

if (isset($this->request->get['filter_category_id'])) {
    $url .= '&filter_category_id=' . (int)$this->request->get['filter_category_id'];
}

if (isset($this->request->get['filter_manufacturer_id'])) {
    $url .= '&filter_manufacturer_id=' . (int)$this->request->get['filter_manufacturer_id'];
}

if (isset($this->request->get['filter_name'])) {
    $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
}

if (isset($this->request->get['filter_model'])) {
    $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
}

if (isset($this->request->get['filter_price'])) {
    $url .= '&filter_price=' . $this->request->get['filter_price'];
}

if (isset($this->request->get['filter_quantity'])) {
    $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
}

if (isset($this->request->get['filter_status'])) {
    $url .= '&filter_status=' . $this->request->get['filter_status'];
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

$this->data['breadcrumbs'] = array();

$this->data['breadcrumbs'][] = array(
    'text'      => $this->language->get('text_home'),
    'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    'separator' => false
    );

$this->data['breadcrumbs'][] = array(
    'text'      => $this->language->get('heading_title'),
    'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
    'separator' => ' :: '
    );

if (!isset($this->request->get['product_id'])) {
    $this->data['action'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
} else {
    $this->data['action'] = $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
}

$this->data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
    $product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
}
else {
    $row = $this->model_catalog_product->getMaxModel();
    $max_model = $row['max(product_id)'];
    $next_code = $max_model + 1;
    $next_code = $next_code."-";
}

$this->data['token'] = $this->session->data['token'];

$this->load->model('localisation/language');

$this->data['languages'] = $this->model_localisation_language->getLanguages();

if (isset($this->request->post['product_description'])) {
    $this->data['product_description'] = $this->request->post['product_description'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
} else {
    $this->data['product_description'] = array();
}

$language_id = $this->config->get('config_language_id');
if (isset($this->data['product_description'][$language_id]['name'])) {
    $this->data['heading_title'] = $this->data['product_description'][$language_id]['name'];
}

if (isset($this->request->post['model'])) {
    $this->data['model'] = $this->request->post['model'];
} elseif (!empty($product_info)) {
    $this->data['model'] = $product_info['model'];
} else {
    $this->data['model'] = $next_code;
}

if (isset($this->request->post['sku'])) {
    $this->data['sku'] = $this->request->post['sku'];
} elseif (!empty($product_info)) {
    $this->data['sku'] = $product_info['sku'];
} else {
    $this->data['sku'] = '';
}

if (isset($this->request->post['upc'])) {
    $this->data['upc'] = $this->request->post['upc'];
} elseif (!empty($product_info)) {
    $this->data['upc'] = $product_info['upc'];
} else {
    $this->data['upc'] = '';
}

if (isset($this->request->post['ean'])) {
    $this->data['ean'] = $this->request->post['ean'];
} elseif (!empty($product_info)) {
    $this->data['ean'] = $product_info['ean'];
} else {
    $this->data['ean'] = '';
}

if (isset($this->request->post['jan'])) {
    $this->data['jan'] = $this->request->post['jan'];
} elseif (!empty($product_info)) {
    $this->data['jan'] = $product_info['jan'];
} else {
    $this->data['jan'] = '';
}

if (isset($this->request->post['isbn'])) {
    $this->data['isbn'] = $this->request->post['isbn'];
} elseif (!empty($product_info)) {
    $this->data['isbn'] = $product_info['isbn'];
} else {
    $this->data['isbn'] = '';
}

if (isset($this->request->post['mpn'])) {
    $this->data['mpn'] = $this->request->post['mpn'];
} elseif (!empty($product_info)) {
    $this->data['mpn'] = $product_info['mpn'];
} else {
    $this->data['mpn'] = '';
}

if (isset($this->request->post['location'])) {
    $this->data['location'] = $this->request->post['location'];
} elseif (!empty($product_info)) {
    $this->data['location'] = $product_info['location'];
} else {
    $this->data['location'] = '';
}

$this->load->model('setting/store');

$this->data['stores'] = $this->model_setting_store->getStores();

if (isset($this->request->post['product_store'])) {
    $this->data['product_store'] = $this->request->post['product_store'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
} else {
    $this->data['product_store'] = array(0);
}


function translitIt($str)
{
    $tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
        " "=> "-", "."=> "", "/"=> "-", "'"=> "", "&quot;"=> ""
        );
    return strtr($str,$tr);
}


if (isset($this->request->post['keyword'])) {
    $this->data['keyword'] = $this->request->post['keyword'];
} elseif (!empty($product_info['keyword'])) {
    $this->data['keyword'] = $product_info['keyword'];
}else {
    $this->data['keyword'] = translitIt($product_info['name']);
}








if (isset($this->request->post['image'])) {
    $this->data['image'] = $this->request->post['image'];
} elseif (!empty($product_info)) {
    $this->data['image'] = $product_info['image'];
} else {
    $this->data['image'] = '';
}

$this->load->model('tool/image');

if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
    $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
    $this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
} else {
    $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
}
$this->load->model('catalog/manufacturer');

$this->data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

if (isset($this->request->post['shipping'])) {
    $this->data['shipping'] = $this->request->post['shipping'];
} elseif (!empty($product_info)) {
    $this->data['shipping'] = $product_info['shipping'];
} else {
    $this->data['shipping'] = 1;
}

if (isset($this->request->post['price'])) {
    $this->data['price'] = $this->request->post['price'];
} elseif (!empty($product_info)) {
    $this->data['price'] = $product_info['price'];
} else {
    $this->data['price'] = '';
}

$this->load->model('localisation/tax_class');

$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

if (isset($this->request->post['tax_class_id'])) {
    $this->data['tax_class_id'] = $this->request->post['tax_class_id'];
} elseif (!empty($product_info)) {
    $this->data['tax_class_id'] = $product_info['tax_class_id'];
} else {
    $this->data['tax_class_id'] = 0;
}

if (isset($this->request->post['date_available'])) {
    $this->data['date_available'] = $this->request->post['date_available'];
} elseif (!empty($product_info)) {
    $this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
} else {
    $this->data['date_available'] = date('Y-m-d', time() - 86400);
}

if (isset($this->request->post['quantity'])) {
    $this->data['quantity'] = $this->request->post['quantity'];
} elseif (!empty($product_info)) {
    $this->data['quantity'] = $product_info['quantity'];
} else {
    $this->data['quantity'] = 1;
}

if (isset($this->request->post['minimum'])) {
    $this->data['minimum'] = $this->request->post['minimum'];
} elseif (!empty($product_info)) {
    $this->data['minimum'] = $product_info['minimum'];
} else {
    $this->data['minimum'] = 1;
}

if (isset($this->request->post['subtract'])) {
    $this->data['subtract'] = $this->request->post['subtract'];
} elseif (!empty($product_info)) {
    $this->data['subtract'] = $product_info['subtract'];
} else {
    $this->data['subtract'] = 1;
}

if (isset($this->request->post['sort_order'])) {
    $this->data['sort_order'] = $this->request->post['sort_order'];
} elseif (!empty($product_info)) {
    $this->data['sort_order'] = $product_info['sort_order'];
} else {
    $this->data['sort_order'] = 1;
}

$this->load->model('localisation/stock_status');

$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

if (isset($this->request->post['stock_status_id'])) {
    $this->data['stock_status_id'] = $this->request->post['stock_status_id'];
} elseif (!empty($product_info)) {
    $this->data['stock_status_id'] = $product_info['stock_status_id'];
} else {
    $this->data['stock_status_id'] = $this->config->get('config_stock_status_id');
}

if (isset($this->request->post['status'])) {
    $this->data['status'] = $this->request->post['status'];
} elseif (!empty($product_info)) {
    $this->data['status'] = $product_info['status'];
} else {
    $this->data['status'] = 1;
}

if (isset($this->request->post['weight'])) {
    $this->data['weight'] = $this->request->post['weight'];
} elseif (!empty($product_info)) {
    $this->data['weight'] = $product_info['weight'];
} else {
    $this->data['weight'] = '';
}

$this->load->model('localisation/weight_class');

$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

if (isset($this->request->post['weight_class_id'])) {
    $this->data['weight_class_id'] = $this->request->post['weight_class_id'];
} elseif (!empty($product_info)) {
    $this->data['weight_class_id'] = $product_info['weight_class_id'];
} else {
    $this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
}

if (isset($this->request->post['length'])) {
    $this->data['length'] = $this->request->post['length'];
} elseif (!empty($product_info)) {
    $this->data['length'] = $product_info['length'];
} else {
    $this->data['length'] = '';
}

if (isset($this->request->post['width'])) {
    $this->data['width'] = $this->request->post['width'];
} elseif (!empty($product_info)) {
    $this->data['width'] = $product_info['width'];
} else {
    $this->data['width'] = '';
}

if (isset($this->request->post['height'])) {
    $this->data['height'] = $this->request->post['height'];
} elseif (!empty($product_info)) {
    $this->data['height'] = $product_info['height'];
} else {
    $this->data['height'] = '';
}

$this->load->model('localisation/length_class');

$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

if (isset($this->request->post['length_class_id'])) {
    $this->data['length_class_id'] = $this->request->post['length_class_id'];
} elseif (!empty($product_info)) {
    $this->data['length_class_id'] = $product_info['length_class_id'];
} else {
    $this->data['length_class_id'] = $this->config->get('config_length_class_id');
}

$this->load->model('catalog/manufacturer');

if (isset($this->request->post['manufacturer_id'])) {
    $this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
} elseif (!empty($product_info)) {
    $this->data['manufacturer_id'] = $product_info['manufacturer_id'];
} else {
    $this->data['manufacturer_id'] = 0;
}

if (isset($this->request->post['manufacturer'])) {
    $this->data['manufacturer'] = $this->request->post['manufacturer'];
} elseif (!empty($product_info)) {
    $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);

    if ($manufacturer_info) {
        $this->data['manufacturer'] = $manufacturer_info['name'];
    } else {
        $this->data['manufacturer'] = '';
    }
} else {
    $this->data['manufacturer'] = '';
}

// Categories
$this->load->model('catalog/category');

if (isset($this->request->post['product_category'])) {
    $categories = $this->request->post['product_category'];
} elseif (isset($this->request->get['product_id'])) {
    $categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
} else {
    $categories = array();
}
$this->data['categories'] = $this->model_catalog_category->getCategories(0);
$this->data['product_categories'] = array();

foreach ($categories as $category_id) {
    $category_info = $this->model_catalog_category->getCategory($category_id);

    if ($category_info) {
        $this->data['product_categories'][] = array(
            'category_id' => $category_info['category_id'],
            'name'        => ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name']
            );
    }
}

// Filters
$this->load->model('catalog/filter');

if (isset($this->request->post['product_filter'])) {
    $filters = $this->request->post['product_filter'];
} elseif (isset($this->request->get['product_id'])) {
    $filters = $this->model_catalog_product->getProductFilters($this->request->get['product_id']);
} else {
    $filters = array();
}

$this->data['product_filters'] = array();

foreach ($filters as $filter_id) {
    $filter_info = $this->model_catalog_filter->getFilter($filter_id);

    if ($filter_info) {
        $this->data['product_filters'][] = array(
            'filter_id' => $filter_info['filter_id'],
            'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
            );
    }
}

// Attributes
$this->load->model('catalog/attribute');

if (isset($this->request->post['product_attribute'])) {
    $product_attributes = $this->request->post['product_attribute'];
} elseif (isset($this->request->get['product_id'])) {
    $product_attributes = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
} else {
    $product_attributes = array();
}

$this->data['product_attributes'] = array();

foreach ($product_attributes as $product_attribute) {
    $attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);

    if ($attribute_info) {
        $this->data['product_attributes'][] = array(
            'attribute_id'                  => $product_attribute['attribute_id'],
            'name'                          => $attribute_info['name'],
            'product_attribute_description' => $product_attribute['product_attribute_description']
            );
    }
}

// Options
$this->load->model('catalog/option');

if (isset($this->request->post['product_option'])) {
    $product_options = $this->request->post['product_option'];
} elseif (isset($this->request->get['product_id'])) {
    $product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);
} else {
    $product_options = array();
}

$this->data['product_options'] = array();

foreach ($product_options as $product_option) {
    if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
        $product_option_value_data = array();

        foreach ($product_option['product_option_value'] as $product_option_value) {
            $product_option_value_data[] = array(
                'product_option_value_id' => $product_option_value['product_option_value_id'],
                'option_value_id'         => $product_option_value['option_value_id'],
                'quantity'                => $product_option_value['quantity'],
                'subtract'                => $product_option_value['subtract'],
                'price'                   => $product_option_value['price'],
                'price_prefix'            => $product_option_value['price_prefix'],
                'points'                  => $product_option_value['points'],
                'points_prefix'           => $product_option_value['points_prefix'],
                'weight'                  => $product_option_value['weight'],
                'weight_prefix'           => $product_option_value['weight_prefix']
                );
        }

        $this->data['product_options'][] = array(
            'product_option_id'    => $product_option['product_option_id'],
            'product_option_value' => $product_option_value_data,
            'option_id'            => $product_option['option_id'],
            'name'                 => $product_option['name'],
            'type'                 => $product_option['type'],
            'required'             => $product_option['required']
            );
    } else {
        $this->data['product_options'][] = array(
            'product_option_id' => $product_option['product_option_id'],
            'option_id'         => $product_option['option_id'],
            'name'              => $product_option['name'],
            'type'              => $product_option['type'],
            'option_value'      => $product_option['option_value'],
            'required'          => $product_option['required']
            );
    }
}

$this->data['option_values'] = array();

foreach ($this->data['product_options'] as $product_option) {
    if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
        if (!isset($this->data['option_values'][$product_option['option_id']])) {
            $this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
        }
    }
}

$this->load->model('sale/customer_group');

$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

if (isset($this->request->post['product_discount'])) {
    $this->data['product_discounts'] = $this->request->post['product_discount'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_discounts'] = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
} else {
    $this->data['product_discounts'] = array();
}

if (isset($this->request->post['product_special'])) {
    $this->data['product_specials'] = $this->request->post['product_special'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_specials'] = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
} else {
    $this->data['product_specials'] = array();
}

// Images
if (isset($this->request->post['product_image'])) {
    $product_images = $this->request->post['product_image'];
} elseif (isset($this->request->get['product_id'])) {
    $product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
} else {
    $product_images = array();
}

$this->data['product_images'] = array();

foreach ($product_images as $product_image) {
    if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
        $image = $product_image['image'];
    } else {
        $image = 'no_image.jpg';
    }

    $this->data['product_images'][] = array(
        'image'      => $image,
        'thumb'      => $this->model_tool_image->resize($image, 100, 100),
        'sort_order' => $product_image['sort_order']
        );
}

$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

// Downloads
$this->load->model('catalog/download');

if (isset($this->request->post['product_download'])) {
    $product_downloads = $this->request->post['product_download'];
} elseif (isset($this->request->get['product_id'])) {
    $product_downloads = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
} else {
    $product_downloads = array();
}

$this->data['product_downloads'] = array();

foreach ($product_downloads as $download_id) {
    $download_info = $this->model_catalog_download->getDownload($download_id);

    if ($download_info) {
        $this->data['product_downloads'][] = array(
            'download_id' => $download_info['download_id'],
            'name'        => $download_info['name']
            );
    }
}

if (isset($this->request->post['main_category_id'])) {
    $this->data['main_category_id'] = $this->request->post['main_category_id'];
} elseif (isset($product_info)) {
    $this->data['main_category_id'] = $this->model_catalog_product->getProductMainCategoryId($this->request->get['product_id']);
} else {
    $this->data['main_category_id'] = 0;
}

if (isset($this->request->post['product_related'])) {
    $products = $this->request->post['product_related'];
} elseif (isset($this->request->get['product_id'])) {
    $products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
} else {
    $products = array();
}

$this->data['product_related'] = array();

foreach ($products as $product_id) {
    $related_info = $this->model_catalog_product->getProduct($product_id);

    if ($related_info) {
        $this->data['product_related'][] = array(
            'product_id' => $related_info['product_id'],
            'name'       => $related_info['name']
            );
    }
}

if (isset($this->request->post['points'])) {
    $this->data['points'] = $this->request->post['points'];
} elseif (!empty($product_info)) {
    $this->data['points'] = $product_info['points'];
} else {
    $this->data['points'] = '';
}

if (isset($this->request->post['product_reward'])) {
    $this->data['product_reward'] = $this->request->post['product_reward'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
} else {
    $this->data['product_reward'] = array();
}

if (isset($this->request->post['product_layout'])) {
    $this->data['product_layout'] = $this->request->post['product_layout'];
} elseif (isset($this->request->get['product_id'])) {
    $this->data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
} else {
    $this->data['product_layout'] = array();
}

$this->load->model('design/layout');

$this->data['layouts'] = $this->model_design_layout->getLayouts();
//product statuses
$this->load->language('module/product_status');
		$this->data['status_show_in_category'] = $this->language->get('status_show_in_category');
		$this->data['status_show_in_product'] = $this->language->get('status_show_in_product');
		$this->data['tab_statuses'] = $this->language->get('tab_statuses');
		$this->data['status_image'] = $this->language->get('status_image');
		$this->data['status_name'] = $this->language->get('status_name');
		$this->data['button_add_status'] = $this->language->get('button_add_status');
	
		$this->load->model('catalog/product_status');
		if (isset($this->request->get['product_id'])) {
			$this->data['product_statuses'] = $this->model_catalog_product_status->getProductStatuses($this->request->get['product_id']);
		} else {
			$this->data['product_statuses'] = array();
		}
//prod statuses


$this->template = 'catalog/product_form.tpl';
$this->children = array(
    'common/header',
    'common/footer'
    );

$this->response->setOutput($this->render());
}

protected function validateForm() {
	$this->request->post['sku'] = trim($this->request->post['sku']);

    if (!$this->user->hasPermission('modify', 'catalog/product')) {
        $this->error['warning'] = $this->language->get('error_permission');
    }

    foreach ($this->request->post['product_description'] as $language_id => $value) {
        if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
            $this->error['name'][$language_id] = $this->language->get('error_name');
        }
    }

    if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
        $this->error['model'] = $this->language->get('error_model');
    }

//BOF Product Series
    $this->load->model('catalog/special_attribute');

//- link to master product -> if the passed product is not a master one -> return error message
    if(isset($this->request->post['master_product'])){
		if((int)$this->request->post['master_product'] > 0){
			$this->load->model('catalog/product_master');
			if(!$this->model_catalog_product_master->isMasterable($this->request->post['master_product'], '2')) //2 is Image
			{
				$this->error['master_product'] = $this->language->get('error_master_product');
			}

			if(isset($this->request->post['product_id'])) //update product
			{
				if($this->model_catalog_product->isMaster($this->request->post['product_id'], '2')) //2 is Image
				{
					$this->error['master_product'] = $this->language->get('error_master_product_cannot_be_changed');
				}
			}
		}
	}
	//EOF Product Series
	if ($this->error && !isset($this->error['warning'])) {
		$this->error['warning'] = $this->language->get('error_warning');
	}

	if (!$this->error) {
		return true;
	} else {
		return false;
	}
}

protected function validateDelete() {
    if (!$this->user->hasPermission('modify', 'catalog/product')) {
        $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->error) {
        return true;
    } else {
        return false;
    }
}

protected function validateCopy() {
    if (!$this->user->hasPermission('modify', 'catalog/product')) {
        $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->error) {
        return true;
    } else {
        return false;
    }
}


public function saveQuantity() {
    $id  = $this->request->get['product_id'];
    $quantity = $this->request->get['quantity'];

    $this->load->model('catalog/product');

    $this->response->setOutput($this->model_catalog_product->saveQuantity($id,$quantity));
}


public function autocomplete() {
    $json = array();

    if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
        $this->load->model('catalog/product');
        $this->load->model('catalog/option');

        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = '';
        }

        if (isset($this->request->get['filter_model'])) {
            $filter_model = $this->request->get['filter_model'];
        } else {
            $filter_model = '';
        }

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = 20;
        }

        $data = array(
            'filter_name'  => $filter_name,
            'filter_model' => $filter_model,
            'start'        => 0,
            'limit'        => $limit
            );

		if (!empty($this->request->get['filter_category_id'])){
			$data['filter_category_id'] = $this->request->get['filter_category_id'];
		}

        $results = $this->model_catalog_product->getProducts($data);

        foreach ($results as $result) {
            $option_data = array();

            $product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

            foreach ($product_options as $product_option) {
                $option_info = $this->model_catalog_option->getOption($product_option['option_id']);

                if ($option_info) {
                    if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
                        $option_value_data = array();

                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            $option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

                            if ($option_value_info) {
                                $option_value_data[] = array(
                                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                                    'option_value_id'         => $product_option_value['option_value_id'],
                                    'name'                    => $option_value_info['name'],
                                    'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
                                    'price_prefix'            => $product_option_value['price_prefix']
                                    );
                            }
                        }

                        $option_data[] = array(
                            'product_option_id' => $product_option['product_option_id'],
                            'option_id'         => $product_option['option_id'],
                            'name'              => $option_info['name'],
                            'type'              => $option_info['type'],
                            'option_value'      => $option_value_data,
                            'required'          => $product_option['required']
                            );
                    } else {
                        $option_data[] = array(
                            'product_option_id' => $product_option['product_option_id'],
                            'option_id'         => $product_option['option_id'],
                            'name'              => $option_info['name'],
                            'type'              => $option_info['type'],
                            'option_value'      => $product_option['option_value'],
                            'required'          => $product_option['required']
                            );
                    }
                }
            }

            $json[] = array(
                'product_id' => $result['product_id'],
                'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                'model'      => $result['model'],
                'option'     => $option_data,
                'price'      => $result['price']
                );
        }
    }

    $this->response->setOutput(json_encode($json));
}
//BOF Product Series
public function createProductSeries() {
    $this->load->language('catalog/product');
    $this->load->language('catalog/pds');

    $this->document->setTitle($this->language->get('heading_title'));

$this->load->model('catalog/product'); //for getlist
$this->load->model('catalog/product_master');

if ($this->validateCreateProductSeries()) {

    $this->model_catalog_product_master->createProductSeries($this->request->post['selected'], '2');

    $this->session->data['success'] = $this->language->get('text_success_series_created');

    $url = '';

    if (isset($this->request->get['filter_name'])) {
        $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
    }

    if (isset($this->request->get['filter_model'])) {
        $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
    }

    if (isset($this->request->get['filter_price'])) {
        $url .= '&filter_price=' . $this->request->get['filter_price'];
    }

    if (isset($this->request->get['filter_quantity'])) {
        $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
    }

    if (isset($this->request->get['filter_status'])) {
        $url .= '&filter_status=' . $this->request->get['filter_status'];
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

    $this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
}

$this->getList();
}

private function validateCreateProductSeries() {
    if (!$this->user->hasPermission('modify', 'catalog/product')) {
        $this->error['warning'] = $this->language->get('error_permission');
    }

    if(!isset($this->request->post['selected']))
    {
        $this->error['warning'] = $this->language->get('error_no_product_selected');
    }
    else if(sizeof($this->request->post['selected']) == 0)
    {
        $this->error['warning'] = $this->language->get('error_no_product_selected');
    }
    else
    {
        $unslavable_names = array();

        foreach($this->request->post['selected'] as $product_id)
        {
            if (!$this->model_catalog_product_master->isSlavable($product_id, '2')) {
//$this->error['warning'] = $this->language->get('error_cannot_be_added_to_a_series');
                $product = $this->model_catalog_product->getProduct($product_id);

                array_push($unslavable_names, $product['name']);
            }
        }

        if(sizeof($unslavable_names) > 0)
        {
            $this->error['warning'] = $this->language->get('error_cannot_be_added_to_a_series');

            $this->error['warning'] .= '<ul>';

            foreach($unslavable_names as $unslavable_name)
            {
                $this->error['warning'] .= '<li>' . $unslavable_name . '</li>';
            }

            $this->error['warning'] .= '</ul>';
        }
    }

    if (!$this->error) {
        return true;
    } else {
        return false;
    }
}
//EOF Product Series
}
?>
