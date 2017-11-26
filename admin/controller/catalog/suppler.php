<?php 
class ControllerCatalogSuppler extends Controller { 
	 private $error = array();
	
  	public function index() {
		$this->load->language('catalog/suppler');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/suppler');
				
    	$this->getList();
  	}
  
  	public function insert() {
		$this->load->language('catalog/suppler');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/suppler');
						
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_suppler->addSuppler($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
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
			
			$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    		
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->load->language('catalog/suppler');

    	$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('catalog/suppler');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_suppler->editSuppler($this->request->get['form_id'], $this->request->post);
					
			$this->session->data['success'] = $this->language->get('text_success');

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
			
			$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
        			
    	$this->getForm();
  	}   

  	public function delete() {

		$this->load->language('catalog/suppler');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/suppler');

    	if (isset($this->request->post['selected']) && $this->validateDelete() ) {
			foreach ($this->request->post['selected'] as $form_id) {
				$this->model_catalog_suppler->deleteSuppler($form_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
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
			
			$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getList();
  	}  
	
	public function base() {
		$this->load->language('catalog/suppler');
    	$this->document->setTitle($this->language->get('heading_base_title'));
		$this->load->model('catalog/suppler');		
		
		if (isset($this->request->post) and !empty($this->request->post['command'])) {	
		
			$err = $this->model_catalog_suppler->Action($this->request->post, $_SESSION['id']);		
					
			switch ($err) {			
				case 0: $this->session->data['success'] = $this->language->get('text_base_success');
					$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'], 'SSL'));
					break;				
				case 1: $this->error['warning'] = $this->language->get('error_empty');
				    break;
				case 2: $this->error['warning'] = $this->language->get('error_sos');
					break;			
				case 3: $this->error['warning'] = $this->language->get('error_ex');
					break;
				case 25: $this->error['warning'] = $this->language->get('error_con');				
					break;
				case 26: $this->error['warning'] = $this->language->get('error_attribute1');				
					break;
				case 27: $this->error['warning'] = $this->language->get('error_bad_sos');				
					break;
				case 28: $this->error['warning'] = $this->language->get('error_set_category');				
					break;
				case 29: $this->error['warning'] = $this->language->get('error_create_folder');				
					break;	
				case 30: $this->error['warning'] = $this->language->get('error_uploads');				
					break;
				case 31: $this->error['warning'] = $this->language->get('rename');				
					break;
				case 32: $this->error['warning'] = $this->language->get('error_filter');				
					break;
				case 33: $this->error['warning'] = $this->language->get('error_fields');				
					break;	
				
			}		
			$this->getList();
			
		} else $this->getBaseForm();		
  	} 

	public function getBaseForm() {
		$this->load->language('catalog/suppler');

		$this->data['heading_base_title'] = $this->language->get('heading_base_title');
		$this->data['entry_restore'] = $this->language->get('entry_restore');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['button_start'] = $this->language->get('button_start');
		$this->data['button_base'] = $this->language->get('button_base');
		$this->data['tab_general'] = $this->language->get('tab_general');		

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
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
	
		$this->data['start'] = $this->url->link('catalog/suppler/start', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->template = 'catalog/suppler_base.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		$this->response->setOutput($this->render());
	}
	public function ftp() {
		$this->load->language('catalog/suppler');
		$this->load->model('catalog/suppler');
		$file_tmp = 'usergio';
		$file_name = 'usergio.xml';
		$id = $this->request->get['form_id'];
		
		$err = $this->model_catalog_suppler->ftp($file_tmp, $file_name, $id);
	
		switch ($err) {
				
		case 0: $this->session->data['success'] = $this->language->get('text_base_success');
				$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'], 'SSL'));
			break;	
		case 1: $this->error['warning'] = $this->language->get('error_format');
			break;
		case 2: $this->error['warning'] = $this->language->get('error_vol');
			break;
		case 3: $this->error['warning'] = $this->language->get('error_open');
			break;
		case 4: $this->error['warning'] = $this->language->get('error_xml');
			break;
		case 5: $this->error['warning'] = $this->language->get('error_sos');
			break;
		case 6: $this->error['warning'] = $this->language->get('error_bad_sos');
			break;
		case 7: $this->error['warning'] = $this->language->get('error_rate');
			break;
		case 8: $this->error['warning'] = $this->language->get('error_cod');
			break;
		case 9: $this->error['warning'] = $this->language->get('error_pers');
			break;
		case 10: $this->error['warning'] = $this->language->get('error_qu');
			break;
		case 11: $this->error['warning'] = $this->language->get('error_dim');
			break;
		case 12: $this->error['warning'] = $this->language->get('error_related');
			break;
		case 13: $this->error['warning'] = $this->language->get('error_pic');
			break;
		case 14: $this->error['warning'] = $this->language->get('error_pars');
			break;
		case 15: $this->error['warning'] = $this->language->get('error_warranty');
			break;
		case 16: $this->error['warning'] = $this->language->get('error_item');
			break;
		case 17: $this->error['warning'] = $this->language->get('error_file');
			break;
		case 18: $this->error['warning'] = $this->language->get('error_weight');
			break;
		case 19: $this->error['warning'] = $this->language->get('error_price');
			break;	
		case 20: $this->error['warning'] = $this->language->get('error_add');
			break;
		case 21: $this->error['warning'] = $this->language->get('error_data');
			break;
		case 22: $this->error['warning'] = $this->language->get('error_folder');
			break;
		case 23: $this->error['warning'] = $this->language->get('error_attribute');
			break;
		case 24: $this->error['warning'] = $this->language->get('error_site');
			break;			
		case 25: $this->error['warning'] = $this->language->get('error_cat');
			break;
		case 26: $this->error['warning'] = $this->language->get('error_uploads');
			break;
		case 27: $this->error['warning'] = $this->language->get('error_save');
			break;	
		}
		$this->getBaseForm();
	}
	public function Start() {
			$this->load->language('catalog/suppler');
			$this->load->model('catalog/suppler');
						
			$id= $_SESSION['id']; 
						
			if ($this->request->server['REQUEST_METHOD'] == 'POST')  {
			if ((isset( $this->request->files['xmlfile'] )) && (is_uploaded_file($this->request->files['xmlfile']['tmp_name']))) {
				$file_name = $this->request->files['xmlfile']['name'];
				$file_tmp = $this->request->files['xmlfile']['tmp_name'];
				$err = $this->model_catalog_suppler->loadfile($file_tmp, $file_name, $id);
		
				switch ($err) {
				
				case 0: $this->session->data['success'] = $this->language->get('text_base_success');
						$this->redirect($this->url->link('catalog/suppler', 'token=' . $this->session->data['token'], 'SSL'));
					break;	
				case 1: $this->error['warning'] = $this->language->get('error_format');
					break;
				case 2: $this->error['warning'] = $this->language->get('error_vol');
					break;
				case 3: $this->error['warning'] = $this->language->get('error_open');
					break;
				case 4: $this->error['warning'] = $this->language->get('error_xml');
					break;
				case 5: $this->error['warning'] = $this->language->get('error_sos');
					break;
				case 6: $this->error['warning'] = $this->language->get('error_bad_sos');
					break;
				case 7: $this->error['warning'] = $this->language->get('error_rate');
					break;
				case 8: $this->error['warning'] = $this->language->get('error_cod');
					break;
				case 9: $this->error['warning'] = $this->language->get('error_pers');
					break;
				case 10: $this->error['warning'] = $this->language->get('error_qu');
					break;
				case 11: $this->error['warning'] = $this->language->get('error_dim');
					break;
				case 12: $this->error['warning'] = $this->language->get('error_related');
					break;
				case 13: $this->error['warning'] = $this->language->get('error_pic');
					break;
				case 14: $this->error['warning'] = $this->language->get('error_pars');
					break;
				case 15: $this->error['warning'] = $this->language->get('error_warranty');
					break;
				case 16: $this->error['warning'] = $this->language->get('error_item');
					break;
				case 17: $this->error['warning'] = $this->language->get('error_file');
					break;
				case 18: $this->error['warning'] = $this->language->get('error_weight');
					break;
				case 19: $this->error['warning'] = $this->language->get('error_price');
					break;	
				case 20: $this->error['warning'] = $this->language->get('error_add');
					break;
				case 21: $this->error['warning'] = $this->language->get('error_data');
					break;
				case 22: $this->error['warning'] = $this->language->get('error_folder');
					break;
				case 23: $this->error['warning'] = $this->language->get('error_attribute');
					break;
				case 24: $this->error['warning'] = $this->language->get('error_site');
					break;			
				case 25: $this->error['warning'] = $this->language->get('error_cat');
					break;
				case 26: $this->error['warning'] = $this->language->get('error_uploads');
					break;
				case 27: $this->error['warning'] = $this->language->get('error_save');
					break;
				case 28: $this->error['warning'] = $this->language->get('error_optsku');
					break;	
				}
			}	
		}		
		$this->getBaseForm();
	}
   
 	private function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		$this->request->get['page'] = 1;
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
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
		$this->load->model('catalog/suppler');
		$results = $this->model_catalog_suppler->createTables();

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
	$this->data['insert'] = $this->url->link('catalog/suppler/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
	$this->data['delete'] = $this->url->link('catalog/suppler/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['supplers'] = array();	
		
		$suppler_total = $this->model_catalog_suppler->getTotalSupplers();
	
		$results = $this->model_catalog_suppler->getSupplers($order);
 
    	foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL'),
				'load' => $this->url->link('catalog/suppler/ftp', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
						
			$this->data['supplers'][] = array(
				'form_id'		  => $result['form_id'],
				'suppler_id' 	  => $result['suppler_id'],
				'name'            => $result['name'],
				'sort_order'      => $result['sort_order'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['form_id'], $this->request->post['selected']),
				'action'          => $action
			);
		}	
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_scode'] = $this->language->get('column_scode');
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_file'] = $this->language->get('column_file');
		$this->data['column_load'] = $this->language->get('column_load');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];			
		}
		
		$this->data['sort_name'] = $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $suppler_total;
		$pagination->page = 1;
		$pagination->limit = 100;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = '';

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/suppler_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
  	private function getForm() {
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	$this->data['error_suppler'] = $this->language->get('error_suppler');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');			
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_left'] = $this->language->get('text_left');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_ended'] = $this->language->get('text_ended');
		$this->data['text_dc'] = $this->language->get('text_dc');		
		$this->data['text_ddesc0'] = $this->language->get('text_ddesc0');
		$this->data['text_ddesc1'] = $this->language->get('text_ddesc1');
		$this->data['text_ddesc2'] = $this->language->get('text_ddesc2');		
		$this->data['text_wse'] = $this->language->get('text_wse');
		$this->data['text_only'] = $this->language->get('text_only');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['tags_no'] = $this->language->get('tags_no');
		$this->data['tags_yes'] = $this->language->get('tags_yes');
		$this->data['text_status1'] = $this->language->get('text_status1');
		$this->data['text_status2'] = $this->language->get('text_status2');
		$this->data['text_status3'] = $this->language->get('text_status3');
		$this->data['text_status4'] = $this->language->get('text_status4');
		$this->data['text_status5'] = $this->language->get('text_status5');
		$this->data['text_status6'] = $this->language->get('text_status6');
		$this->data['text_status7'] = $this->language->get('text_status7');
		$this->data['text_status8'] = $this->language->get('text_status8');
		$this->data['text_myprice1'] = $this->language->get('text_myprice1');
		$this->data['text_myprice2'] = $this->language->get('text_myprice2');
		$this->data['text_myprice3'] = $this->language->get('text_myprice3');
		$this->data['text_myprice4'] = $this->language->get('text_myprice4');
		$this->data['text_updte1'] = $this->language->get('text_updte1');
		$this->data['text_updte2'] = $this->language->get('text_updte2');
		$this->data['text_updte3'] = $this->language->get('text_updte3');
		$this->data['text_updte4'] = $this->language->get('text_updte4');
		$this->data['text_updtee4'] = $this->language->get('text_updtee4');
		$this->data['text_updtee5'] = $this->language->get('text_updtee5');
		$this->data['text_settings'] = $this->language->get('text_settings');
		$this->data['text_all'] = $this->language->get('text_all');
		$this->data['text_act'] = $this->language->get('text_act');
		$this->data['text_math1'] = $this->language->get('text_math1');
		$this->data['text_math2'] = $this->language->get('text_math2');
		$this->data['text_math3'] = $this->language->get('text_math3');
		$this->data['text_math4'] = $this->language->get('text_math4');
		$this->data['text_math5'] = $this->language->get('text_math5');
		$this->data['text_math6'] = $this->language->get('text_math6');
		$this->data['text_math7'] = $this->language->get('text_math7');
		$this->data['text_math8'] = $this->language->get('text_math8');
		$this->data['text_refer0'] = $this->language->get('text_refer0');
		$this->data['text_refer1'] = $this->language->get('text_refer1');
		$this->data['text_zero0'] = $this->language->get('text_zero0');
		$this->data['text_zero1'] = $this->language->get('text_zero1');
		$this->data['text_zero2'] = $this->language->get('text_zero2');
		$this->data['text_warring'] = $this->language->get('text_warring');
		
		$this->data['text_ad0'] = $this->language->get('text_ad0');
		$this->data['text_ad1'] = $this->language->get('text_ad1');
		$this->data['text_ad2'] = $this->language->get('text_ad2');
		$this->data['text_ad3'] = $this->language->get('text_ad3');
		$this->data['text_ad4'] = $this->language->get('text_ad4');
		$this->data['text_ad5'] = $this->language->get('text_ad5');
		$this->data['text_ad6'] = $this->language->get('text_ad6');
		$this->data['text_ad7'] = $this->language->get('text_ad7');
		$this->data['text_ad8'] = $this->language->get('text_ad8');
		$this->data['text_ad9'] = $this->language->get('text_ad9');
		$this->data['text_ad10'] = $this->language->get('text_ad10');
		$this->data['text_ad11'] = $this->language->get('text_ad11');
		$this->data['text_ad12'] = $this->language->get('text_ad12');
		$this->data['text_kmenu'] = $this->language->get('text_kmenu');
		$this->data['text_kmenu0'] = $this->language->get('text_kmenu0');
		$this->data['text_kmenu1'] = $this->language->get('text_kmenu1');
		$this->data['text_kmenu2'] = $this->language->get('text_kmenu2');
		$this->data['text_kmenu3'] = $this->language->get('text_kmenu3');
		$this->data['text_kmenu4'] = $this->language->get('text_kmenu4');
		$this->data['text_kmenu5'] = $this->language->get('text_kmenu5');
		$this->data['text_gbotton'] = $this->language->get('text_gbotton');
		$this->data['text_competitors'] = $this->language->get('text_competitors');
		$this->data['text_command0'] = $this->language->get('text_command0');
		$this->data['text_command1'] = $this->language->get('text_command1');
		$this->data['text_command2'] = $this->language->get('text_command2');
		$this->data['text_command3'] = $this->language->get('text_command3');
		$this->data['text_command4'] = $this->language->get('text_command4');
		$this->data['text_command5'] = $this->language->get('text_command5');
		$this->data['text_command6'] = $this->language->get('text_command6');
		$this->data['text_command7'] = $this->language->get('text_command7');
		$this->data['text_command8'] = $this->language->get('text_command8');
		$this->data['text_command9'] = $this->language->get('text_command9');
		$this->data['text_command10'] = $this->language->get('text_command10');
		$this->data['text_command11'] = $this->language->get('text_command11');
		$this->data['text_command12'] = $this->language->get('text_command12');
		$this->data['text_command13'] = $this->language->get('text_command13');
		$this->data['text_command14'] = $this->language->get('text_command14');
		$this->data['text_command15'] = $this->language->get('text_command15');
		$this->data['text_command16'] = $this->language->get('text_command16');
		$this->data['text_command17'] = $this->language->get('text_command17');
		$this->data['text_command18'] = $this->language->get('text_command18');
		$this->data['text_command19'] = $this->language->get('text_command19');
		$this->data['text_command20'] = $this->language->get('text_command20');
		$this->data['text_command21'] = $this->language->get('text_command21');
		$this->data['text_command22'] = $this->language->get('text_command22');
		$this->data['text_command23'] = $this->language->get('text_command23');
		$this->data['text_command24'] = $this->language->get('text_command24');
		$this->data['text_command25'] = $this->language->get('text_command25');
		$this->data['text_command26'] = $this->language->get('text_command26');
		$this->data['text_command27'] = $this->language->get('text_command27');
		$this->data['text_command28'] = $this->language->get('text_command28');
		$this->data['text_command29'] = $this->language->get('text_command29');
		$this->data['text_command30'] = $this->language->get('text_command30');
		$this->data['text_command31'] = $this->language->get('text_command31');
		$this->data['text_command32'] = $this->language->get('text_command32');
		$this->data['text_command33'] = $this->language->get('text_command33');
		$this->data['text_command34'] = $this->language->get('text_command34');
		$this->data['text_command35'] = $this->language->get('text_command35');
		$this->data['text_command36'] = $this->language->get('text_command36');
		$this->data['text_command37'] = $this->language->get('text_command37');
		$this->data['text_command38'] = $this->language->get('text_command38');
		$this->data['text_command39'] = $this->language->get('text_command39');
		$this->data['text_command40'] = $this->language->get('text_command40');
		$this->data['text_command41'] = $this->language->get('text_command41');
		$this->data['text_command42'] = $this->language->get('text_command42');
		$this->data['text_command43'] = $this->language->get('text_command43');
		$this->data['text_command44'] = $this->language->get('text_command44');
		$this->data['text_command45'] = $this->language->get('text_command45');
		$this->data['text_command46'] = $this->language->get('text_command46');
		$this->data['text_command47'] = $this->language->get('text_command47');
		$this->data['text_command48'] = $this->language->get('text_command48');
		$this->data['text_command49'] = $this->language->get('text_command49');
		$this->data['text_command50'] = $this->language->get('text_command50');
		$this->data['text_command51'] = $this->language->get('text_command51');
		$this->data['text_command52'] = $this->language->get('text_command52');
		$this->data['text_command53'] = $this->language->get('text_command53');
		$this->data['text_command54'] = $this->language->get('text_command54');
		$this->data['text_command55'] = $this->language->get('text_command55');
		$this->data['text_command56'] = $this->language->get('text_command56');
		$this->data['text_command57'] = $this->language->get('text_command57');
		$this->data['text_command58'] = $this->language->get('text_command58');
		$this->data['text_command59'] = $this->language->get('text_command59');
		$this->data['text_command60'] = $this->language->get('text_command60');
		$this->data['text_command61'] = $this->language->get('text_command61');
		$this->data['text_command62'] = $this->language->get('text_command62');
		$this->data['text_command63'] = $this->language->get('text_command63');
		$this->data['text_command64'] = $this->language->get('text_command64');
		$this->data['text_command65'] = $this->language->get('text_command65');
		$this->data['text_command66'] = $this->language->get('text_command66');
		$this->data['text_command67'] = $this->language->get('text_command67');
		$this->data['text_command68'] = $this->language->get('text_command68');
		$this->data['text_command69'] = $this->language->get('text_command69');
		$this->data['text_command70'] = $this->language->get('text_command70');
		$this->data['text_command71'] = $this->language->get('text_command71');
		$this->data['text_command72'] = $this->language->get('text_command72');
		$this->data['text_command73'] = $this->language->get('text_command73');
		$this->data['text_command74'] = $this->language->get('text_command74');
		$this->data['text_command75'] = $this->language->get('text_command75');
		$this->data['text_command76'] = $this->language->get('text_command76');
		$this->data['text_command77'] = $this->language->get('text_command77');
		$this->data['text_command78'] = $this->language->get('text_command78');
		$this->data['text_command79'] = $this->language->get('text_command79');
		$this->data['text_command80'] = $this->language->get('text_command80');
		$this->data['text_command81'] = $this->language->get('text_command81');
		$this->data['text_command82'] = $this->language->get('text_command82');
		$this->data['text_command83'] = $this->language->get('text_command83');
		$this->data['text_command84'] = $this->language->get('text_command84');
		$this->data['text_command85'] = $this->language->get('text_command85');
		$this->data['text_command86'] = $this->language->get('text_command86');
		$this->data['text_command87'] = $this->language->get('text_command87');
		$this->data['text_command88'] = $this->language->get('text_command88');
		$this->data['text_command89'] = $this->language->get('text_command89');
		$this->data['text_command90'] = $this->language->get('text_command90');
		$this->data['text_command91'] = $this->language->get('text_command91');
		$this->data['text_command92'] = $this->language->get('text_command92');
		$this->data['text_command93'] = $this->language->get('text_command93');
		$this->data['text_command94'] = $this->language->get('text_command94');
		$this->data['text_command95'] = $this->language->get('text_command95');
		$this->data['text_command96'] = $this->language->get('text_command96');
		$this->data['text_command97'] = $this->language->get('text_command97');
		$this->data['text_command98'] = $this->language->get('text_command98');
		$this->data['text_command99'] = $this->language->get('text_command99');
		$this->data['text_command100'] = $this->language->get('text_command100');
		$this->data['text_command101'] = $this->language->get('text_command101');
		$this->data['text_command102'] = $this->language->get('text_command102');
		$this->data['text_command103'] = $this->language->get('text_command103');
		$this->data['text_command104'] = $this->language->get('text_command104');
		$this->data['text_command105'] = $this->language->get('text_command105');		
		$this->data['text_command106'] = $this->language->get('text_command106');
		$this->data['text_command107'] = $this->language->get('text_command107');
		$this->data['text_command108'] = $this->language->get('text_command108');
		$this->data['text_command109'] = $this->language->get('text_command109');
		$this->data['text_command110'] = $this->language->get('text_command110');
		$this->data['text_command111'] = $this->language->get('text_command111');
		$this->data['text_command112'] = $this->language->get('text_command112');
		$this->data['text_command113'] = $this->language->get('text_command113');
		$this->data['text_command114'] = $this->language->get('text_command114');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_suppler_id'] = $this->language->get('entry_suppler_id');
		$this->data['entry_cod'] = $this->language->get('entry_cod');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
    	$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');
		$this->data['entry_tags'] = $this->language->get('entry_tags');
		$this->data['entry_rate'] = $this->language->get('entry_rate');
		$this->data['entry_ratep'] = $this->language->get('entry_ratep');
		$this->data['entry_ratek'] = $this->language->get('entry_ratek');
		$this->data['entry_ad'] = $this->language->get('entry_ad');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_parent0'] = $this->language->get('entry_parent0');
		$this->data['entry_parent1'] = $this->language->get('entry_parent1');
		$this->data['entry_parent2'] = $this->language->get('entry_parent2');
		$this->data['entry_parent3'] = $this->language->get('entry_parent3');
		$this->data['entry_parent4'] = $this->language->get('entry_parent4');
		$this->data['entry_parent5'] = $this->language->get('entry_parent5');
		$this->data['entry_parent6'] = $this->language->get('entry_parent6');
		$this->data['entry_hide'] = $this->language->get('entry_hide');
		$this->data['entry_onoff'] = $this->language->get('entry_onoff');
		$this->data['entry_cat_ext'] = $this->language->get('entry_cat_ext');
		$this->data['entry_cat_int'] = $this->language->get('entry_cat_int');
		$this->data['entry_cat_plus'] = $this->language->get('entry_cat_plus');
		$this->data['entry_item'] = $this->language->get('entry_item');
		$this->data['entry_cat'] = $this->language->get('entry_cat');
		$this->data['entry_qu'] = $this->language->get('entry_qu');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_desc'] = $this->language->get('entry_desc');
		$this->data['entry_isattribute'] = $this->language->get('entry_isattribute');
		$this->data['entry_newphoto'] = $this->language->get('entry_newphoto');
		$this->data['entry_pic_ext'] = $this->language->get('entry_pic_ext');
		$this->data['entry_pic_int'] = $this->language->get('entry_pic_int');		
		$this->data['entry_manuf'] = $this->language->get('entry_manuf');
		$this->data['entry_warranty'] = $this->language->get('entry_warranty');
		$this->data['entry_attrib'] = $this->language->get('entry_attrib');
		$this->data['entry_attribute'] = $this->language->get('entry_attribute');
		$this->data['entry_foto'] = $this->language->get('entry_foto');
		$this->data['entry_opt'] = $this->language->get('entry_opt');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_art'] = $this->language->get('entry_art');
		$this->data['entry_ko'] = $this->language->get('entry_ko');
		$this->data['entry_pr'] = $this->language->get('entry_pr');
		$this->data['entry_po'] = $this->language->get('entry_po');	
		$this->data['entry_we'] = $this->language->get('entry_we');
		$this->data['entry_option_required'] = $this->language->get('entry_option_required');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_updte'] = $this->language->get('entry_updte');
		$this->data['entry_pmanuf'] = $this->language->get('entry_pmanuf');
		$this->data['entry_umanuf'] = $this->language->get('entry_umanuf');
		$this->data['entry_order'] = $this->language->get('entry_order');
		$this->data['entry_spec'] = $this->language->get('entry_spec');
		$this->data['entry_upurl'] = $this->language->get('entry_upurl');
		$this->data['entry_ref'] = $this->language->get('entry_ref');
		$this->data['entry_target'] = $this->language->get('entry_target');
		$this->data['entry_target0'] = $this->language->get('entry_target0');
		$this->data['entry_target1'] = $this->language->get('entry_target1');
		$this->data['entry_target2'] = $this->language->get('entry_target2');
		$this->data['entry_target3'] = $this->language->get('entry_target3');
		$this->data['entry_target4'] = $this->language->get('entry_target4');
		$this->data['entry_target5'] = $this->language->get('entry_target5');
		$this->data['entry_target6'] = $this->language->get('entry_target6');
		$this->data['entry_target7'] = $this->language->get('entry_target7');
		$this->data['entry_target8'] = $this->language->get('entry_target8');
		$this->data['entry_target9'] = $this->language->get('entry_target9');
		$this->data['entry_target10'] = $this->language->get('entry_target10');
		$this->data['entry_target11'] = $this->language->get('entry_target11');
		$this->data['entry_target12'] = $this->language->get('entry_target12');
		$this->data['entry_target13'] = $this->language->get('entry_target13');
		$this->data['entry_target14'] = $this->language->get('entry_target14');
		$this->data['entry_target15'] = $this->language->get('entry_target15');
		$this->data['entry_target16'] = $this->language->get('entry_target16');
		$this->data['entry_target17'] = $this->language->get('entry_target17');
		$this->data['entry_target18'] = $this->language->get('entry_target18');
		$this->data['entry_addattr'] = $this->language->get('entry_addattr');
		$this->data['entry_exsame'] = $this->language->get('entry_exsame');
		$this->data['entry_sku2'] = $this->language->get('entry_sku2');
		$this->data['entry_point'] = $this->language->get('entry_point');
		$this->data['entry_placep'] = $this->language->get('entry_placep');
		$this->data['entry_placep0'] = $this->language->get('entry_placep0');
		$this->data['entry_placep1'] = $this->language->get('entry_placep1');
		$this->data['entry_placep2'] = $this->language->get('entry_placep2');
		$this->data['entry_placep3'] = $this->language->get('entry_placep3');
		$this->data['entry_placep4'] = $this->language->get('entry_placep4');
		$this->data['entry_placep5'] = $this->language->get('entry_placep5');
		$this->data['entry_placep6'] = $this->language->get('entry_placep6');
		$this->data['entry_point1'] = $this->language->get('entry_point1');
		$this->data['entry_place'] = $this->language->get('entry_place');
		$this->data['entry_pars'] = $this->language->get('entry_pars');
		$this->data['entry_catcreate'] = $this->language->get('entry_catcreate');
		$this->data['entry_stay'] = $this->language->get('entry_stay');
		$this->data['entry_set_status'] = $this->language->get('entry_set_status');
		$this->data['entry_mycat'] = $this->language->get('entry_mycat');
		$this->data['entry_myqu'] = $this->language->get('entry_myqu');
		$this->data['entry_myprice'] = $this->language->get('entry_myprice');
		$this->data['entry_mydescrip'] = $this->language->get('entry_mydescrip');
		$this->data['entry_myphoto'] = $this->language->get('entry_myphoto');
		$this->data['entry_mymanuf'] = $this->language->get('entry_mymanuf');
		$this->data['entry_mymark'] = $this->language->get('entry_mymark');
		$this->data['entry_def_word'] = $this->language->get('entry_def_word');
		$this->data['entry_actcat'] = $this->language->get('entry_actcat');
		$this->data['entry_zactcat'] = $this->language->get('entry_zactcat');
		$this->data['entry_kol_status'] = $this->language->get('entry_kol_status');
		$this->data['entry_status_formula'] = $this->language->get('entry_status_formula');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_actmanuf'] = $this->language->get('entry_actmanuf');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_cod_from'] = $this->language->get('entry_cod_from');
		$this->data['entry_cod_to'] = $this->language->get('entry_cod_to');
		$this->data['entry_price_from'] = $this->language->get('entry_price_from');
		$this->data['entry_price_to'] = $this->language->get('entry_price_to');
		$this->data['entry_first'] = $this->language->get('entry_first');
		$this->data['entry_last'] = $this->language->get('entry_last');		
		$this->data['entry_actsuppler'] = $this->language->get('entry_actsuppler');
		$this->data['entry_actmult'] = $this->language->get('entry_actmult');
		$this->data['entry_attribut'] = $this->language->get('entry_attribut');
		$this->data['entry_noattribut'] = $this->language->get('entry_noattribut');
		$this->data['entry_inattribut'] = $this->language->get('entry_inattribut');
		$this->data['entry_isvalue'] = $this->language->get('entry_isvalue');
		$this->data['entry_isoptions'] = $this->language->get('entry_isoptions');
		$this->data['entry_any'] = $this->language->get('entry_any');
		$this->data['entry_find'] = $this->language->get('entry_find');
		$this->data['entry_change'] = $this->language->get('entry_change');
		$this->data['entry_all'] = $this->language->get('entry_all');
		$this->data['entry_kol'] = $this->language->get('entry_kol');
		$this->data['entry_cheap'] = $this->language->get('entry_cheap');
		$this->data['entry_addopt'] = $this->language->get('entry_addopt');
		$this->data['entry_addseo'] = $this->language->get('entry_addseo');
		$this->data['entry_addseo0'] = $this->language->get('entry_addseo0');
		$this->data['entry_addseo1'] = $this->language->get('entry_addseo1');
		$this->data['entry_addseo2'] = $this->language->get('entry_addseo2');
		$this->data['entry_importseo'] = $this->language->get('entry_importseo');
		$this->data['entry_upname'] = $this->language->get('entry_upname');
		$this->data['entry_upattr'] = $this->language->get('entry_upattr');
		$this->data['entry_upattr0'] = $this->language->get('entry_upattr0');
		$this->data['entry_upattr1'] = $this->language->get('entry_upattr1');
		$this->data['entry_upattr2'] = $this->language->get('entry_upattr2');
		$this->data['entry_upattr3'] = $this->language->get('entry_upattr3');
		$this->data['entry_upattr4'] = $this->language->get('entry_upattr4');
		$this->data['entry_upopt'] = $this->language->get('entry_upopt');
		$this->data['entry_upopt0'] = $this->language->get('entry_upopt0');
		$this->data['entry_upopt1'] = $this->language->get('entry_upopt1');
		$this->data['entry_upopt2'] = $this->language->get('entry_upopt2');		
		$this->data['entry_myplus'] = $this->language->get('entry_myplus');		
		$this->data['entry_cprice'] = $this->language->get('entry_cprice');
		$this->data['entry_minus'] = $this->language->get('entry_minus');
		$this->data['entry_chcode'] = $this->language->get('entry_chcode');
		$this->data['entry_off'] = $this->language->get('entry_off');
		$this->data['entry_joen'] = $this->language->get('entry_joen');
		$this->data['entry_site_nom'] = $this->language->get('entry_site_nom');
		$this->data['entry_site_ident'] = $this->language->get('entry_site_ident');
		$this->data['entry_site_param'] = $this->language->get('entry_site_param');
		$this->data['entry_site_point'] = $this->language->get('entry_site_point');
		$this->data['entry_site_math'] = $this->language->get('entry_site_math');
		$this->data['entry_onn'] = $this->language->get('entry_onn');
		$this->data['entry_refer'] = $this->language->get('entry_refer');
		$this->data['entry_disc'] = $this->language->get('entry_disc');
		$this->data['entry_offproduct'] = $this->language->get('entry_offproduct');
		$this->data['entry_offproduct0'] = $this->language->get('entry_offproduct0');
		$this->data['entry_offproduct1'] = $this->language->get('entry_offproduct1');
		$this->data['entry_offproduct2'] = $this->language->get('entry_offproduct2');
		$this->data['entry_descr'] = $this->language->get('entry_descr');
		$this->data['entry_plusopt'] = $this->language->get('entry_plusopt');
		$this->data['entry_addopt0'] = $this->language->get('entry_addopt0');
		$this->data['entry_addopt1'] = $this->language->get('entry_addopt1');
		$this->data['entry_addopt2'] = $this->language->get('entry_addopt2');
		$this->data['entry_upurl0'] = $this->language->get('entry_upurl0');
		$this->data['entry_upurl1'] = $this->language->get('entry_upurl1');
		$this->data['entry_upurl2'] = $this->language->get('entry_upurl2');
		$this->data['entry_newurl'] = $this->language->get('entry_newurl');
		$this->data['entry_newurl0'] = $this->language->get('entry_newurl0');
		$this->data['entry_newurl1'] = $this->language->get('entry_newurl1');
		$this->data['entry_fields'] = $this->language->get('entry_fields');
		$this->data['entry_data'] = $this->language->get('entry_data');
		$this->data['entry_seo_prod'] = $this->language->get('entry_seo_prod');		
		$this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$this->data['entry_seo_desc'] = $this->language->get('entry_seo_desc');
		$this->data['entry_seo_cat_cat'] = $this->language->get('entry_seo_cat_cat');
		$this->data['entry_seo_description'] = $this->language->get('entry_seo_description');
		$this->data['entry_seo_manuf'] = $this->language->get('entry_seo_manuf');		
		$this->data['entry_seo_nb'] = $this->language->get('entry_seo_nb');
		$this->data['entry_seo_round'] = $this->language->get('entry_seo_round');
		$this->data['entry_seo_attribut'] = $this->language->get('entry_seo_attribut');
		$this->data['entry_seo_option'] = $this->language->get('entry_seo_option');		
		$this->data['entry_seo_price'] = $this->language->get('entry_seo_price');
		$this->data['entry_seo_name'] = $this->language->get('entry_seo_name');
		$this->data['entry_seo_sprice'] = $this->language->get('entry_seo_sprice');		
		$this->data['entry_seo_manufacturer'] = $this->language->get('entry_seo_manufacturer');		
		$this->data['entry_seo_category'] = $this->language->get('entry_seo_category');
		$this->data['entry_seo_pcategory'] = $this->language->get('entry_seo_pcategory');
		$this->data['entry_seo_default'] = $this->language->get('entry_seo_default');
		$this->data['entry_seo_column'] = $this->language->get('entry_seo_column');
		$this->data['entry_seo_keyword'] = $this->language->get('entry_seo_keyword');
		$this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');
		$this->data['entry_seo_photo'] = $this->language->get('entry_seo_photo');
		$this->data['entry_seo_number'] = $this->language->get('entry_seo_number');
		$this->data['entry_seo_code'] = $this->language->get('entry_seo_code');
		$this->data['entry_seo_random'] = $this->language->get('entry_seo_random');
		$this->data['entry_photo'] = $this->language->get('entry_photo');
		$this->data['entry_seo_brand'] = $this->language->get('entry_seo_brand');
		$this->data['entry_descrip'] = $this->language->get('entry_descrip');
		$this->data['entry_seo_att'] = $this->language->get('entry_seo_att');
		$this->data['entry_seo_opt'] = $this->language->get('entry_seo_opt');
		$this->data['entry_seo_vatt'] = $this->language->get('entry_seo_vatt');
		$this->data['entry_seo_vopt'] = $this->language->get('entry_seo_vopt');
		$this->data['entry_seo_text'] = $this->language->get('entry_seo_text');
		$this->data['entry_bonus'] = $this->language->get('entry_bonus');
		$this->data['entry_seo_sku'] = $this->language->get('entry_seo_sku');		
		$this->data['entry_ddesc'] = $this->language->get('entry_ddesc');
		$this->data['entry_iprice'] = $this->language->get('entry_iprice');
		$this->data['entry_usd'] = $this->language->get('entry_usd');
		$this->data['entry_qu_discount'] = $this->language->get('entry_qu_discount');
		$this->data['entry_idcat'] = $this->language->get('entry_idcat');
		$this->data['entry_suppler_main'] = $this->language->get('entry_suppler_main');
		$this->data['entry_zero'] = $this->language->get('entry_zero');
		$this->data['entry_noprice'] = $this->language->get('entry_noprice');
		$this->data['entry_baseprice'] = $this->language->get('entry_baseprice');
		$this->data['entry_metka'] = $this->language->get('entry_metka');
		$this->data['entry_jopt'] = $this->language->get('entry_jopt');
		$this->data['entry_skuopt'] = $this->language->get('entry_skuopt');
		$this->data['entry_newproduct'] = $this->language->get('entry_newproduct');
		$this->data['entry_sdesc'] = $this->language->get('entry_sdesc');
		$this->data['entry_sname'] = $this->language->get('entry_sname');
		$this->data['entry_up'] = $this->language->get('entry_up');
		$this->data['entry_add'] = $this->language->get('entry_add');
		$this->data['entry_codid1'] = $this->language->get('entry_codid1');
		$this->data['entry_codid2'] = $this->language->get('entry_codid2');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_actfilter'] = $this->language->get('entry_actfilter');
		$this->data['entry_series'] = $this->language->get('entry_series');
		$this->data['entry_sleep'] = $this->language->get('entry_sleep');
		$this->data['entry_file'] = $this->language->get('entry_file');
		
		$this->data['entry_opt_fotos'] = $this->language->get('entry_opt_fotos');
		$this->data['entry_opt_prices'] = $this->language->get('entry_opt_prices');
		$this->data['opt_prices_s'] = $this->language->get('opt_prices_s');
		$this->data['opt_prices_min'] = $this->language->get('opt_prices_min');
		$this->data['opt_prices_plus'] = $this->language->get('opt_prices_plus');
		$this->data['entry_joen1'] = $this->language->get('entry_joen1');
		$this->data['entry_joen2'] = $this->language->get('entry_joen2');
		
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_base'] = $this->language->get('button_base');		
		
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_attribute'] = $this->language->get('tab_attribute');
		$this->data['tab_option'] = $this->language->get('tab_option');
		$this->data['tab_action'] = $this->language->get('tab_action');	
		$this->data['tab_price'] = $this->language->get('tab_price');
		$this->data['tab_seo'] = $this->language->get('tab_seo');
		
		$c_class = 0;
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}		
		
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
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);		
		
		if (!isset($this->request->get['form_id'])) {
			$this->data['action'] = $this->url->link('catalog/suppler/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $this->request->get['form_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/suppler', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['base'] = $this->url->link('catalog/suppler/base', 'token=' . $this->session->data['token']. $url, 'SSL');		
			
		if (isset($this->request->get['form_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$suppler_info = $this->model_catalog_suppler->getSuppler($this->request->get['form_id']);
		}		
		
		$this->data['suppler_all'] = $this->model_catalog_suppler->getSupplers($order);	
		
		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => 0,
			'limit' => 5000
		);
		
		$this->load->model('catalog/attribute');		
		$attributes = $this->model_catalog_attribute->getAttributes($data);	
		$this->data['attributes'] = $this->getAttributes($attributes);
		
		$this->load->model('catalog/option');	
		$this->data['options'] = $this->model_catalog_option->getOptions($data);	
		
		$id = 1;
		if (isset($this->request->get['form_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
               $id = $this->request->get['form_id']; 
		}		
		
		$_SESSION['id'] = $id;		
		$results = $this->model_catalog_suppler->getMySuppler($id);
		
		$this->load->model('catalog/manufacturer');		
    	$this->data['manufacturers'] = $this->model_catalog_suppler->getAllManufacturers($id); 		
							
		$categories = $this->model_catalog_suppler->getAllCategories($id);
		$this->data['categories'] = $this->getAllCategories($categories);
		
		$this->data['filters'] = $this->model_catalog_suppler->getAllFilters();
				
		$this->data['supplers'] = array();		
					
    	foreach ($results as $result) {
			$action = array();			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
			
			$this->data['supplers'] = array(
				'form_id' 	  	  => $result['form_id'],
				'suppler_id' 	  => $result['suppler_id'],
				'name'            => $result['name'],
				'main'            => $result['main'],
				'sort_order'      => $result['sort_order'],
				'rate'            => $result['rate'],
				'ratep'            => $result['ratep'],
				'ratek'            => $result['ratek'],
				'cod'             => $result['cod'],
				'related'         => $result['related'],
				'updte'           => $result['updte'],
				'item'            => $result['item'],
				'cat'             => $result['cat'],
				'qu'              => $result['qu'],
				'price'           => $result['price'],
				'descrip'         => $result['descrip'],
				'pic_ext'         => $result['pic_ext'],
				'manuf'           => $result['manuf'],
				'warranty'        => $result['warranty'],
				'status'		  => $result['status'],
				'ad'              => $result['ad'],				
				'my_cat'          => $result['my_cat'],
				'my_qu'           => $result['my_qu'],
				'my_price'        => $result['my_price'],
				'my_descrip'      => $result['my_descrip'],
				'newphoto'     	  => $result['newphoto'],
				'cheap'     	  => $result['cheap'],
				'my_manuf' 		  => $result['my_manuf'],
				'my_mark'         => $result['my_mark'],
				'my_photo'        => $result['my_photo'],
				'weight'         => $result['weight'],
				'length'         => $result['length'],
				'width'          => $result['width'],
				'height'         => $result['height'],
				'parent'         => $result['parent'],
				'hide'         	 => $result['hide'],
				'addopt'       	 => $result['addopt'],
				'addseo'       	 => $result['addseo'],
				'importseo'      => $result['importseo'],
				'pmanuf'       	 => $result['pmanuf'],
				'umanuf'       	 => $result['umanuf'],
				'upname'       	 => $result['upname'],
				'upattr'       	 => $result['upattr'],
				'upopt'       	 => $result['upopt'],
				'myplus'       	 => $result['myplus'],
				'cprice'       	 => $result['cprice'],
				'minus'       	 => $result['minus'],
				'chcode'       	 => $result['chcode'],
				'sorder'       	 => $result['sorder'],
				'spec'       	 => $result['spec'],
				'upurl'       	 => $result['upurl'],
				'newurl'       	 => $result['newurl'],
				'ref'       	 => $result['ref'],
				'ref1'       	 => $result['ref1'],
				'addattr'      	 => $result['addattr'],
				'exsame'      	 => $result['exsame'],
				'sku2'      	 => $result['sku2'],
				'parss'      	 => $result['parss'],
				'points'      	 => $result['points'],
				'places'      	 => $result['places'],
				'parsi'      	 => $result['parsi'],
				'pointi'      	 => $result['pointi'],
				'placei'      	 => $result['placei'],
				'parsc'      	 => $result['parsc'],
				'pointc'      	 => $result['pointc'],
				'placec'      	 => $result['placec'],
				'parsp'      	 => $result['parsp'],
				'pointp'      	 => $result['pointp'],
				'placep'      	 => $result['placep'],
				'parsd'      	 => $result['parsd'],
				'pointd'      	 => $result['pointd'],
				'placed'      	 => $result['placed'],
				'parsm'      	 => $result['parsm'],
				'pointm'      	 => $result['pointm'],
				'placem'      	 => $result['placem'],
				'parsk'      	 => $result['parsk'],
				'parsq'      	 => $result['parsq'],
				'pointq'      	 => $result['pointq'],
				'placeq'      	 => $result['placeq'],
				'bprice'      	 => $result['bprice'],
				'kmenu'      	 => $result['kmenu'],
				'catcreate'    	 => $result['catcreate'],
				'stay'    	 	 => $result['stay'],
				'off'       	 => $result['off'],
				'joen'       	 => $result['joen'],
				'onn'       	 => $result['onn'],
				'refer'       	 => $result['refer'],
				'disc'       	 => $result['disc'],
				'upc'       	 => $result['upc'],
				'ean'       	 => $result['ean'],
				'mpn'       	 => $result['mpn'],
				'ddata'       	 => $result['ddata'],
				'bonus'       	 => $result['bonus'],
				'ddesc'       	 => $result['ddesc'],
				'qu_discount'  	 => $result['qu_discount'],
				'plusopt'        => $result['plusopt'],
				'idcat'          => $result['idcat'],
				't_ref'        	 => $result['t_ref'],
				't_ref1'         => $result['t_ref1'],
				't_status'       => $result['t_status'],
				'termin'         => $result['termin'],
				'onoff'          => $result['onoff'],
				'zero'           => $result['zero'],
				'metka'          => $result['metka'],
				'jopt'           => $result['jopt'],
				'optsku'         => $result['optsku'],
				'newproduct'     => $result['newproduct'],
				'opt_fotos'      => $result['opt_fotos'],
				'opt_prices'     => $result['opt_prices'],
				'usd'            => $result['usd'],	
				'serie'          => $result['serie'],
				'sleep'          => $result['sleep'],
				'ffile'          => $result['ffile'],
								
				'selected'        => isset($this->request->post['selected']) && in_array($result['form_id'], $this->request->post['selected']),				
				'action'          => $action
			);
			
			$base = array();	
			$base[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/base', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
			
			$this->data['act'] = array(
				'act_cat'         => 0,
				'act_manuf'       => 0,
				'filter_date_start'     => '0000-00-00',
				'filter_date_end'       => '0000-00-00',
				'cod_from'       => 0,
				'cod_to'       => 0,
				'price_from'       => 0,
				'price_to'       => 0,
				'act_mult'       => '1.000',
				'isno'          => 0,
				'command'       => 0,
				'all'			=> 0,
				'zact_cat'      => 0,
				'act_attribut'  => 0,
				'act_noattribut'  => 0,
				'act_inattribut'  => 0,
				'act_isvalue'  => 0,
				'act_find'  => '',
				'act_change'  => '',
				'offproduct'  => 1,
				'descr'      => 0,
				'up-add'      => 0,
				'cat-id'      => 0,
				
				'selected'        => isset($this->request->post['selected']) && in_array($result['form_id'], $this->request->post['selected']),				
				'base'          => $base
			);
		}		
		
		$data_total = $this->model_catalog_suppler->getTotalData($id);	
	
		$limit = 50;
		$rows = $this->model_catalog_suppler->getSupplerData($id);
		$n = ($page-1)*$limit;
		$this->data['suppler'] = array();
							
		for ($i=$n; $i<$limit+$n; $i++) {
			if (!isset($rows[$i]['cat_ext'])) break;
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $rows[$i]['form_id'] . $url, 'SSL')
			);
									   
			$this->data['suppler'][] = array(
				'form_id' 	  => $rows[$i]['form_id'],
				'cat_ext'		  => $rows[$i]['cat_ext'],
				'category_id'	  => $rows[$i]['category_id'],
				'pic_int'	  	  => $rows[$i]['pic_int'],
				'cat_plus'	  	  => $rows[$i]['cat_plus'],	
				'del'			  => '0',
				'nom_id'		  => $rows[$i]['nom_id'],
				'selected'        => isset($this->request->post['selected']) && in_array($rows[$i]['form_id'], $this->request->post['selected']),
				'action'          => $action
			);
			
			if (isset($this->request->post['category_id'])) {
				$this->data['category_id'] = $this->request->post['category_id'];
			} else {
				$this->data['category_id'][] = $rows[$i]['category_id'];
			} 
			if (isset($this->request->post['del'])) {
				$this->data['del'] = $this->request->post['del'];
			} else {
				$this->data['del'][] = '0';
			}
			if (isset($this->request->post['nom_id'])) {
				$this->data['nom_id'] = $this->request->post['nom_id'];
			} else {
				$this->data['nom_id'][] = $rows[$i]['nom_id'];
			}			
		}		
		$results = $this->model_catalog_suppler->getSupplerAttributes($id);

		$this->data['sa'] = array();
								
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
									   
			$this->data['sa'][] = array(
				'attr_ext'		  => $result['attr_ext'],
				'attr_point'	  => $result['attr_point'],
				'attribute_id'	  => $result['attribute_id'],
				'filter_group_id' => $result['filter_group_id'],
				'tags'	  	 	  => $result['tags'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['attribute_id'], $this->request->post['selected']),
				'action'          => $action
			);
			
			if (isset($this->request->post['attribute_id'])) {
				$this->data['attribute_id'] = $this->request->post['attribute_id'];
			} else {
				$this->data['attribute_id'][] = $result['attribute_id'];
			} 
			if (isset($this->request->post['filter_group_id'])) {
				$this->data['filter_group_id'] = $this->request->post['filter_group_id'];
			} else {
				$this->data['filter_group_id'][] = $result['filter_group_id'];
			}			
			if (isset($this->request->post['attr_point'])) {
				$this->data['attr_point'] = $this->request->post['attr_point'];
			} else {
				$this->data['attr_point'][] = $result['attr_point'];
			}
			if (isset($this->request->post['attr_ext'])) {
				$this->data['attr_ext'] = $this->request->post['attr_ext'];
			} else {
				$this->data['attr_ext'][] = $result['attr_ext'];
			}
			if (isset($this->request->post['tags'])) {
				$this->data['tags'] = $this->request->post['tags'];    	
			} else {	
				$this->data['tags'][] = $result['tags'];
			}			
		}

		$results = $this->model_catalog_suppler->getSupplerOptions($id);	
	
		$this->data['op'] = array();
								
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
									   
			$this->data['op'][] = array(
				'opt'		  => $result['opt'],
				'option_id'	  => $result['option_id'],
				'opt_point'	  => $result['opt_point'],
				'art'	  	  => $result['art'],
				'ko'	  	  => $result['ko'],
				'pr'	   	  => $result['pr'],
				'po'	 	  => $result['po'],
				'we'	 	  => $result['we'],
				'foto'	 	  => $result['foto'],
				'option_required' 	  => $result['option_required'],				
				'selected'    => isset($this->request->post['selected']) && in_array($result['option_id'], $this->request->post['selected']),
				'action'      => $action
			);
			
			if (isset($this->request->post['option_id'])) {
				$this->data['option_id'] = $this->request->post['option_id'];
			} else {
				$this->data['option_id'][] = $result['option_id'];
			} 
			if (isset($this->request->post['opt'])) {
				$this->data['opt'] = $this->request->post['opt'];
			} else {
				$this->data['opt'][] = $result['opt'];
			}
			if (isset($this->request->post['opt_point'])) {
				$this->data['opt_point'] = $this->request->post['opt_point'];
			} else {
				$this->data['opt_point'][] = $result['opt_point'];
			}
			if (isset($this->request->post['art'])) {
				$this->data['art'] = $this->request->post['art'];    	
			} else {	
				$this->data['art'][] = $result['art'];
			}
			if (isset($this->request->post['ko'])) {
				$this->data['ko'] = $this->request->post['ko'];    	
			} else {	
				$this->data['ko'][] = $result['ko'];
			}
			if (isset($this->request->post['pr'])) {
				$this->data['pr'] = $this->request->post['pr'];    	
			} else {	
				$this->data['pr'][] = $result['pr'];
			}
			if (isset($this->request->post['po'])) {
				$this->data['po'] = $this->request->post['po'];    	
			} else {	
				$this->data['po'][] = $result['po'];
			}			
			if (isset($this->request->post['we'])) {
				$this->data['we'] = $this->request->post['we'];    	
			} else {	
				$this->data['we'][] = $result['we'];
			}
			if (isset($this->request->post['foto'])) {
				$this->data['foto'] = $this->request->post['foto'];    	
			} else {	
				$this->data['foto'][] = $result['foto'];
			}
			if (isset($this->request->post['option_required'])) {
				$this->data['option_required'] = $this->request->post['option_required'];    	
			} else {	
				$this->data['option_required'][] = $result['option_required'];
			}
			
		}
		
		$results = $this->model_catalog_suppler->getSupplerPrice($id);	
	
		$this->data['site'] = array();
								
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $result['form_id'] . $url, 'SSL')
			);
									   
			$this->data['site'][] = array(
				'nom'		  => $result['nom'],
				'ident'	 	  => $result['ident'],
				'param'	  	  => $result['param'],
				'point'	   	  => $result['point'],
				'noprice'	  => $result['noprice'],
				'paramnp'	  => $result['paramnp'],
				'pointnp'	  => $result['pointnp'],
				'baseprice'	  => $result['baseprice'],
				'action'      => $action
			);
			
			if (isset($this->request->post['nom'])) {
				$this->data['nom'] = $this->request->post['nom'];
			} else {
				$this->data['nom'][] = $result['nom'];
			} 
			if (isset($this->request->post['ident'])) {
				$this->data['ident'] = $this->request->post['ident'];
			} else {
				$this->data['ident'][] = $result['ident'];
			}
			if (isset($this->request->post['param'])) {
				$this->data['param'] = $this->request->post['param'];    	
			} else {	
				$this->data['param'][] = $result['param'];
			}
			if (isset($this->request->post['point'])) {
				$this->data['point'] = $this->request->post['point'];    	
			} else {	
				$this->data['point'][] = $result['point'];
			}
			if (isset($this->request->post['noprice'])) {
				$this->data['noprice'] = $this->request->post['noprice'];    	
			} else {	
				$this->data['noprice'][] = $result['noprice'];
			}
			if (isset($this->request->post['paramnp'])) {
				$this->data['paramnp'] = $this->request->post['paramnp'];    	
			} else {	
				$this->data['paramnp'][] = $result['paramnp'];
			}
			if (isset($this->request->post['pointnp'])) {
				$this->data['pointnp'] = $this->request->post['pointnp'];    	
			} else {	
				$this->data['pointnp'][] = $result['pointnp'];
			}
			if (isset($this->request->post['baseprice'])) {
				$this->data['baseprice'] = $this->request->post['baseprice'];    	
			} else {	
				$this->data['baseprice'][] = $result['baseprice'];
			}
		}		
		
		require_once 'suppler_license/suppler_ins.php';	  //  Do not remove it !!!
		
		$this->data['statuses'] = $this->model_catalog_suppler->getStatus($c_class, $s, $a);
		
		if (isset($this->request->post['main'])) {
      		$this->data['main'] = $this->request->post['main'];			
    	} elseif (!empty($suppler_info)) {
			$this->data['main'] = $suppler_info['main'];			
		} else {
      		$this->data['supplers']['main'] = 0;
    	}
		
		if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (!empty($suppler_info)) {
			$this->data['name'] = $suppler_info['name'];
		} else {	
      		$this->data['supplers']['name'] = '';
    	}
		
		if (isset($this->request->post['suppler_id'])) {
      		$this->data['suppler_id'] = $this->request->post['suppler_id'];
    	} elseif (!empty($suppler_info)) {
			$this->data['suppler_id'] = $suppler_info['suppler_id'];
		} else {	
      		$this->data['supplers']['suppler_id'] = '1';
    	}
		
		if (isset($this->request->post['rate'])) {
      		$this->data['rate'] = $this->request->post['rate'];			
    	} elseif (!empty($suppler_info)) {
			$this->data['rate'] = $suppler_info['rate'];			
		} else {
      		$this->data['supplers']['rate'] = 1;
    	}

		if (isset($this->request->post['ratep'])) {
      		$this->data['ratep'] = $this->request->post['ratep'];			
    	} elseif (!empty($suppler_info)) {
			$this->data['ratep'] = $suppler_info['ratep'];			
		} else {
      		$this->data['supplers']['ratep'] = 1;
    	}

		if (isset($this->request->post['ratek'])) {
      		$this->data['ratek'] = $this->request->post['ratek'];			
    	} elseif (!empty($suppler_info)) {
			$this->data['ratek'] = $suppler_info['ratek'];			
		} else {
      		$this->data['supplers']['ratek'] = 1;
    	}		
		
		if (isset($this->request->post['cod'])) {
      		$this->data['cod'] = $this->request->post['cod'];
    	} elseif (!empty($suppler_info)) {
			$this->data['cod'] = $suppler_info['cod'];
		} else {
      		$this->data['supplers']['cod'] = '';
    	}

		if (isset($this->request->post['related'])) {
      		$this->data['related'] = $this->request->post['related'];
    	} elseif (!empty($suppler_info)) {
			$this->data['related'] = $suppler_info['related'];
		} else {
      		$this->data['supplers']['related'] = '';
    	}
		
		if (isset($this->request->post['updte'])) {
      		$this->data['updte'] = $this->request->post['updte'];
    	} elseif (!empty($suppler_info)) {
			$this->data['updte'] = $suppler_info['updte'];
		} else {
      		$this->data['supplers']['updte'] = '';
    	}
		
		if (isset($this->request->post['item'])) {
      		$this->data['item'] = $this->request->post['item'];
    	} elseif (!empty($suppler_info)) {
			$this->data['item'] = $suppler_info['item'];
		} else {
      		$this->data['supplers']['item'] = '';
    	}	
		
		if (isset($this->request->post['cat'])) {
      		$this->data['cat'] = $this->request->post['cat'];
    	} elseif (!empty($suppler_info)) {
			$this->data['cat'] = $suppler_info['cat'];
		} else {
      		$this->data['supplers']['cat'] = '';
    	}	
		
		if (isset($this->request->post['qu'])) {
      		$this->data['qu'] = $this->request->post['qu'];
    	} elseif (!empty($suppler_info)) {
			$this->data['qu'] = $suppler_info['qu'];
		} else {
      		$this->data['supplers']['qu'] = '';
    	}	
		
		if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($suppler_info)) {
			$this->data['price'] = $suppler_info['price'];
		} else {
      		$this->data['supplers']['price'] = '';
    	}
		
		if (isset($this->request->post['usd'])) {
      		$this->data['usd'] = $this->request->post['usd'];
    	} elseif (!empty($suppler_info)) {
			$this->data['usd'] = $suppler_info['usd'];
		} else {
      		$this->data['supplers']['usd'] = '';
    	}

		if (isset($this->request->post['t-status'])) {
      		$this->data['t_status'] = $this->request->post['t_status'];
    	} elseif (!empty($data['statuses']) and !empty($suppler_info)) {
			$this->data['t_status'] = $suppler_info['t_status'];
		} else {
      		if (empty($data['statuses'])) unset($data['supplers']['ad']);
			else $this->data['supplers']['t_status'] = '';
    	}
		
		if (isset($this->request->post['descrip'])) {
      		$this->data['descrip'] = $this->request->post['descrip'];
    	} elseif (!empty($suppler_info)) {
			$this->data['descrip'] = $suppler_info['descrip'];
		} else {
      		$this->data['supplers']['descrip'] = '';
    	}	
		
		if (isset($this->request->post['pic_ext'])) {
      		$this->data['pic_ext'] = $this->request->post['pic_ext'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pic_ext'] = $suppler_info['pic_ext'];
		} else {
      		$this->data['supplers']['pic_ext'] = '';
    	}

		if (isset($this->request->post['manuf'])) {
      		$this->data['manuf'] = $this->request->post['manuf'];
		} elseif (!empty($suppler_info)) {
			$this->data['manuf'] = $suppler_info['manuf'];
		} else {
      		$this->data['supplers']['manuf'] = '';
    	}
		
		if (isset($this->request->post['warranty'])) {
      		$this->data['warranty'] = $this->request->post['warranty'];
    	} elseif (!empty($suppler_info)) {
			$this->data['warranty'] = $suppler_info['warranty'];
		} else {
      		$this->data['supplers']['warranty'] = '';
    	}	
		
		if (isset($this->request->post['sku2'])) {
      		$this->data['sku2'] = $this->request->post['sku2'];
    	} elseif (!empty($suppler_info)) {
			$this->data['sku2'] = $suppler_info['sku2'];
		} else {
      		$this->data['supplers']['sku2'] = '';
    	}

		if (isset($this->request->post['parss'])) {
      		$this->data['parss'] = $this->request->post['parss'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parss'] = $suppler_info['parss'];
		} else {
      		$this->data['supplers']['parss'] = '';
    	}

		if (isset($this->request->post['points'])) {
      		$this->data['points'] = $this->request->post['points'];
    	} elseif (!empty($suppler_info)) {
			$this->data['points'] = $suppler_info['points'];
		} else {
      		$this->data['supplers']['points'] = '';
    	}
		
		if (isset($this->request->post['places'])) {
      		$this->data['places'] = $this->request->post['places'];
    	} elseif (!empty($suppler_info)) {
			$this->data['places'] = $suppler_info['places'];
		} else {
      		$this->data['supplers']['places'] = '';
    	}
		
		if (isset($this->request->post['parsi'])) {
      		$this->data['parsi'] = $this->request->post['parsi'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsi'] = $suppler_info['parsi'];
		} else {
      		$this->data['supplers']['parsi'] = '';
    	}

		if (isset($this->request->post['pointi'])) {
      		$this->data['pointi'] = $this->request->post['pointi'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointi'] = $suppler_info['pointi'];
		} else {
      		$this->data['supplers']['pointi'] = '';
    	}
		
		if (isset($this->request->post['placei'])) {
      		$this->data['placei'] = $this->request->post['placei'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placei'] = $suppler_info['placei'];
		} else {
      		$this->data['supplers']['placei'] = '';
    	}
		
		if (isset($this->request->post['parsc'])) {
      		$this->data['parsc'] = $this->request->post['parsc'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsc'] = $suppler_info['parsc'];
		} else {
      		$this->data['supplers']['parsc'] = '';
    	}

		if (isset($this->request->post['pointc'])) {
      		$this->data['pointc'] = $this->request->post['pointc'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointc'] = $suppler_info['pointc'];
		} else {
      		$this->data['supplers']['pointc'] = '';
    	}
		
		if (isset($this->request->post['placec'])) {
      		$this->data['placec'] = $this->request->post['placec'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placec'] = $suppler_info['placec'];
		} else {
      		$this->data['supplers']['placec'] = '';
    	}
		
		if (isset($this->request->post['parsp'])) {
      		$this->data['parsp'] = $this->request->post['parsp'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsp'] = $suppler_info['parsp'];
		} else {
      		$this->data['supplers']['parsp'] = '';
    	}

		if (isset($this->request->post['pointp'])) {
      		$this->data['pointp'] = $this->request->post['pointp'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointp'] = $suppler_info['pointp'];
		} else {
      		$this->data['supplers']['pointp'] = '';
    	}
		
		if (isset($this->request->post['placep'])) {
      		$this->data['placep'] = $this->request->post['placep'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placep'] = $suppler_info['placep'];
		} else {
      		$this->data['supplers']['placep'] = '';
    	}
		
		if (isset($this->request->post['parsd'])) {
      		$this->data['parsd'] = $this->request->post['parsd'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsd'] = $suppler_info['parsd'];
		} else {
      		$this->data['supplers']['parsd'] = '';
    	}

		if (isset($this->request->post['pointd'])) {
      		$this->data['pointd'] = $this->request->post['pointd'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointd'] = $suppler_info['pointd'];
		} else {
      		$this->data['supplers']['pointd'] = '';
    	}
		
		if (isset($this->request->post['placed'])) {
      		$this->data['placed'] = $this->request->post['placed'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placed'] = $suppler_info['placed'];
		} else {
      		$this->data['supplers']['placed'] = '';
    	}
		
		if (isset($this->request->post['t-status'])) {
      		$this->data['t_status'] = $this->request->post['t_status'];
    	} elseif (!empty($data['statuses']) and !empty($suppler_info)) {
			$this->data['t_status'] = $suppler_info['t_status'];
		} else {
      		if (empty($data['statuses'])) unset($data['supplers']['name']);
			else $this->data['supplers']['t_status'] = '';
    	}
		
		if (isset($this->request->post['parsm'])) {
      		$this->data['parsm'] = $this->request->post['parsm'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsm'] = $suppler_info['parsm'];
		} else {
      		$this->data['supplers']['parsm'] = '';
    	}

		if (isset($this->request->post['pointm'])) {
      		$this->data['pointm'] = $this->request->post['pointm'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointm'] = $suppler_info['pointm'];
		} else {
      		$this->data['supplers']['pointm'] = '';
    	}
		
		if (isset($this->request->post['placem'])) {
      		$this->data['placem'] = $this->request->post['placem'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placem'] = $suppler_info['placem'];
		} else {
      		$this->data['supplers']['placem'] = '';
    	}
		
		if (isset($this->request->post['parsk'])) {
      		$this->data['parsk'] = $this->request->post['parsk'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsk'] = $suppler_info['parsk'];
		} else {
      		$this->data['supplers']['parsk'] = '';
    	}
		
		if (isset($this->request->post['parsq'])) {
      		$this->data['parsq'] = $this->request->post['parsq'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parsq'] = $suppler_info['parsq'];
		} else {
      		$this->data['supplers']['parsq'] = '';
    	}
		
		if (isset($this->request->post['pointq'])) {
      		$this->data['pointq'] = $this->request->post['pointq'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pointq'] = $suppler_info['pointq'];
		} else {
      		$this->data['supplers']['pointq'] = '';			
    	}
		
		if (isset($this->request->post['placeq'])) {
      		$this->data['placeq'] = $this->request->post['placeq'];
    	} elseif (!empty($suppler_info)) {
			$this->data['placeq'] = $suppler_info['placeq'];
		} else {
      		$this->data['supplers']['placeq'] = '';			
    	}
		
		if (isset($this->request->post['bprice'])) {
      		$this->data['bprice'] = $this->request->post['bprice'];
    	} elseif (!empty($suppler_info)) {
			$this->data['bprice'] = $suppler_info['bprice'];
		} else {
      		$this->data['supplers']['bprice'] = '';			
    	}
		
		if (isset($this->request->post['kmenu'])) {
      		$this->data['kmenu'] = $this->request->post['kmenu'];
    	} elseif (!empty($suppler_info)) {
			$this->data['kmenu'] = $suppler_info['kmenu'];
		} else {
      		$this->data['supplers']['kmenu'] = '0';			
    	}
		
		if (isset($this->request->post['qu_discount'])) {
      		$this->data['qu_discount'] = $this->request->post['qu_discount'];
    	} elseif (!empty($suppler_info)) {
			$this->data['qu_discount'] = $suppler_info['qu_discount'];
		} else {
      		$this->data['supplers']['qu_discount'] = '';			
    	}
		
		if (isset($this->request->post['catcreate'])) {
      		$this->data['catcreate'] = $this->request->post['catcreate'];
    	} elseif (!empty($suppler_info)) {
			$this->data['catcreate'] = $suppler_info['catcreate'];
		} else {
      		$this->data['supplers']['catcreate'] = '0';
    	}
		
		if (isset($this->request->post['stay'])) {
      		$this->data['stay'] = $this->request->post['stay'];
    	} elseif (!empty($suppler_info)) {
			$this->data['stay'] = $suppler_info['stay'];
		} else {
      		$this->data['supplers']['stay'] = '0';
    	}
		
		if (isset($this->request->post['joen'])) {
      		$this->data['joen'] = $this->request->post['joen'];
    	} elseif (!empty($suppler_info)) {
			$this->data['joen'] = $suppler_info['joen'];
		} else {
      		$this->data['supplers']['joen'] = '0';
    	}
		
		if (isset($this->request->post['refer'])) {
      		$this->data['refer'] = $this->request->post['refer'];
    	} elseif (!empty($suppler_info)) {
			$this->data['refer'] = $suppler_info['refer'];
		} else {
      		$this->data['supplers']['refer'] = '0';
    	}
		
		if (isset($this->request->post['onn'])) {
      		$this->data['onn'] = $this->request->post['onn'];
    	} elseif (!empty($suppler_info)) {
			$this->data['onn'] = $suppler_info['onn'];
		} else {
      		$this->data['supplers']['onn'] = '0';
    	}
		
		if (isset($this->request->post['disc'])) {
      		$this->data['disc'] = $this->request->post['disc'];
    	} elseif (!empty($suppler_info)) {
			$this->data['disc'] = $suppler_info['disc'];
		} else {
      		$this->data['supplers']['disc'] = '0';
    	}
		
		if (isset($this->request->post['ad'])) {
      		$this->data['ad'] = $this->request->post['ad'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ad'] = $suppler_info['ad'];
		} else {
      		$this->data['supplers']['ad'] = '1';
    	}
		
		if (isset($this->request->post['off'])) {
      		$this->data['off'] = $this->request->post['off'];
    	} elseif (!empty($suppler_info)) {
			$this->data['off'] = $suppler_info['off'];
		} else {
      		$this->data['supplers']['off'] = '0';
    	}
		
		if (isset($this->request->post['parent'])) {
      		$this->data['parent'] = $this->request->post['parent'];
    	} elseif (!empty($suppler_info)) {
			$this->data['parent'] = $suppler_info['parent'];
		} else {
      		$this->data['supplers']['parent'] = '0';
    	}
		
		if (isset($this->request->post['hide'])) {
      		$this->data['hide'] = $this->request->post['hide'];
    	} elseif (!empty($suppler_info)) {
			$this->data['hide'] = $suppler_info['hide'];
		} else {
      		$this->data['supplers']['hide'] = '1';
    	}
		
		if (isset($this->request->post['onoff'])) {
      		$this->data['onoff'] = $this->request->post['onoff'];
    	} elseif (!empty($suppler_info)) {
			$this->data['onoff'] = $suppler_info['onoff'];
		} else {
      		$this->data['supplers']['onoff'] = '1';
    	}
		
		if (isset($this->request->post['addopt'])) {
      		$this->data['addopt'] = $this->request->post['addopt'];
    	} elseif (!empty($suppler_info)) {
			$this->data['addopt'] = $suppler_info['addopt'];
		} else {
      		$this->data['supplers']['addopt'] = '0';
    	}
		
		if (isset($this->request->post['addseo'])) {
      		$this->data['addseo'] = $this->request->post['addseo'];
    	} elseif (!empty($suppler_info)) {
			$this->data['addseo'] = $suppler_info['addseo'];
		} else {
      		$this->data['supplers']['addseo'] = '0';
    	}
		
		if (isset($this->request->post['upurl'])) {
      		$this->data['upurl'] = $this->request->post['upurl'];
    	} elseif (!empty($suppler_info)) {
			$this->data['upurl'] = $suppler_info['upurl'];
		} else {
      		$this->data['supplers']['upurl'] = '0';
    	}
		
		if (isset($this->request->post['newurl'])) {
      		$this->data['newurl'] = $this->request->post['newurl'];
    	} elseif (!empty($suppler_info)) {
			$this->data['newurl'] = $suppler_info['newurl'];
		} else {
      		$this->data['supplers']['newurl'] = '0';
    	}
		
		if (isset($this->request->post['upc'])) {
      		$this->data['upc'] = $this->request->post['upc'];
    	} elseif (!empty($suppler_info)) {
			$this->data['upc'] = $suppler_info['upc'];
		} else {
      		$this->data['supplers']['upc'] = '';
    	}
		
		if (isset($this->request->post['ean'])) {
      		$this->data['ean'] = $this->request->post['ean'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ean'] = $suppler_info['ean'];
		} else {
      		$this->data['supplers']['ean'] = '';
    	}
		
		if (isset($this->request->post['mpn'])) {
      		$this->data['mpn'] = $this->request->post['mpn'];
    	} elseif (!empty($suppler_info)) {
			$this->data['mpn'] = $suppler_info['mpn'];
		} else {
      		$this->data['supplers']['mpn'] = '';
    	}
		
		if (isset($this->request->post['ddata'])) {
      		$this->data['ddata'] = $this->request->post['ddata'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ddata'] = $suppler_info['ddata'];
		} else {
      		$this->data['supplers']['ddata'] = '';
    	}
		
		if (isset($this->request->post['ref'])) {
      		$this->data['ref'] = $this->request->post['ref'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ref'] = $suppler_info['ref'];
		} else {
      		$this->data['supplers']['ref'] = '';
    	}
		
		if (isset($this->request->post['ref1'])) {
      		$this->data['ref1'] = $this->request->post['ref1'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ref1'] = $suppler_info['ref1'];
		} else {
      		$this->data['supplers']['ref1'] = '';
    	}
		
		if (isset($this->request->post['t_ref'])) {
      		$this->data['t_ref'] = $this->request->post['t_ref'];
    	} elseif (!empty($suppler_info)) {
			$this->data['t_ref'] = $suppler_info['t_ref'];
		} else {
      		$this->data['supplers']['t_ref'] = '0';
    	}
		
		if (isset($this->request->post['t_ref1'])) {
      		$this->data['t_ref1'] = $this->request->post['t_ref1'];
    	} elseif (!empty($suppler_info)) {
			$this->data['t_ref1'] = $suppler_info['t_ref1'];
		} else {
      		$this->data['supplers']['t_ref1'] = '0';
    	}
		
		if (isset($this->request->post['addattr'])) {
      		$this->data['addattr'] = $this->request->post['addattr'];
    	} elseif (!empty($suppler_info)) {
			$this->data['addattr'] = $suppler_info['addattr'];
		} else {
      		$this->data['supplers']['addattr'] = '0';
    	}
		
		if (isset($this->request->post['exsame'])) {
      		$this->data['exsame'] = $this->request->post['exsame'];
    	} elseif (!empty($suppler_info)) {
			$this->data['exsame'] = $suppler_info['exsame'];
		} else {
      		$this->data['supplers']['exsame'] = '0';
    	}
		
		if (isset($this->request->post['importseo'])) {
      		$this->data['importseo'] = $this->request->post['importseo'];
    	} elseif (!empty($suppler_info)) {
			$this->data['importseo'] = $suppler_info['importseo'];
		} else {
      		$this->data['supplers']['importseo'] = '0';
    	}
		
		if (isset($this->request->post['pmanuf'])) {
      		$this->data['pmanuf'] = $this->request->post['pmanuf'];
    	} elseif (!empty($suppler_info)) {
			$this->data['pmanuf'] = $suppler_info['pmanuf'];
		} else {
      		$this->data['supplers']['pmanuf'] = '0';
    	}
		
		if (isset($this->request->post['umanuf'])) {
      		$this->data['umanuf'] = $this->request->post['umanuf'];
    	} elseif (!empty($suppler_info)) {
			$this->data['umanuf'] = $suppler_info['umanuf'];
		} else {
      		$this->data['supplers']['umanuf'] = '0';
    	}
		
		if (isset($this->request->post['sorder'])) {
      		$this->data['sorder'] = $this->request->post['sorder'];
    	} elseif (!empty($suppler_info)) {
			$this->data['sorder'] = $suppler_info['sorder'];
		} else {
      		$this->data['supplers']['sorder'] = '';
    	}
		
		if (isset($this->request->post['spec'])) {
      		$this->data['spec'] = $this->request->post['spec'];
    	} elseif (!empty($suppler_info)) {
			$this->data['spec'] = $suppler_info['spec'];
		} else {
      		$this->data['supplers']['spec'] = '';
    	}
		
		if (isset($this->request->post['myplus'])) {
      		$this->data['myplus'] = $this->request->post['myplus'];
    	} elseif (!empty($suppler_info)) {
			$this->data['myplus'] = $suppler_info['myplus'];
		} else {
      		$this->data['supplers']['myplus'] = '';
    	}
		
		if (isset($this->request->post['cprice'])) {
      		$this->data['cprice'] = $this->request->post['cprice'];
    	} elseif (!empty($suppler_info)) {
			$this->data['cprice'] = $suppler_info['cprice'];
		} else {
      		$this->data['supplers']['cprice'] = '0';
    	}
		
		if (isset($this->request->post['minus'])) {
      		$this->data['minus'] = $this->request->post['minus'];
    	} elseif (!empty($suppler_info)) {
			$this->data['minus'] = $suppler_info['minus'];
		} else {
      		$this->data['supplers']['minus'] = '1';
    	}
		
		if (isset($this->request->post['chcode'])) {
      		$this->data['chcode'] = $this->request->post['chcode'];
    	} elseif (!empty($suppler_info)) {
			$this->data['chcode'] = $suppler_info['chcode'];
		} else {
      		$this->data['supplers']['chcode'] = '0';
    	}
		
		if (isset($this->request->post['upname'])) {
      		$this->data['upname'] = $this->request->post['upname'];
    	} elseif (!empty($suppler_info)) {
			$this->data['upname'] = $suppler_info['upname'];
		} else {
      		$this->data['supplers']['upname'] = '0';
    	}
		
		if (isset($this->request->post['upattr'])) {
      		$this->data['upattr'] = $this->request->post['upattr'];
    	} elseif (!empty($suppler_info)) {
			$this->data['upattr'] = $suppler_info['upattr'];
		} else {
      		$this->data['supplers']['upattr'] = '0';
    	}
		
		if (isset($this->request->post['upopt'])) {
      		$this->data['upopt'] = $this->request->post['upopt'];
    	} elseif (!empty($suppler_info)) {
			$this->data['upopt'] = $suppler_info['upopt'];
		} else {
      		$this->data['supplers']['upopt'] = '0';
    	}
		
		if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($suppler_info)) {
			$this->data['status'] = $suppler_info['status'];
		} else {
      		$this->data['supplers']['status'] = '4';
    	}
		
		if (isset($this->request->post['my_cat'])) {
      		$this->data['my_cat'] = $this->request->post['my_cat'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_cat'] = $suppler_info['my_cat'];
		} else {
      		$this->data['supplers']['my_cat'] = '0';
    	}
		
		if (isset($this->request->post['my_qu'])) {
      		$this->data['my_qu'] = $this->request->post['my_qu'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_qu'] = $suppler_info['my_qu'];
		} else {
      		$this->data['supplers']['my_qu'] = '99';
    	}
		
		if (isset($this->request->post['my_price'])) {
      		$this->data['my_price'] = $this->request->post['my_price'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_price'] = $suppler_info['my_price'];
		} else {
      		$this->data['supplers']['my_price'] = '1';
    	}
		
		if (isset($this->request->post['my_descrip'])) {
      		$this->data['my_descrip'] = $this->request->post['my_descrip'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_descrip'] = $suppler_info['my_descrip'];
		} else {
      		$this->data['supplers']['my_descrip'] = '';
    	}

		if (isset($this->request->post['my_manuf'])) {
      		$this->data['my_manuf'] = $this->request->post['my_manuf'];
		} elseif (!empty($suppler_info)) {
			$this->data['my_manuf'] = $suppler_info['my_manuf'];
		} else {
      		$this->data['supplers']['my_manuf'] = '0';
    	}

		if (isset($this->request->post['my_mark'])) {
      		$this->data['my_mark'] = $this->request->post['my_mark'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_mark'] = $suppler_info['my_mark'];
		} else {
      		$this->data['supplers']['my_mark'] = '';
    	}
		
		if (isset($this->request->post['my_photo'])) {
      		$this->data['my_photo'] = $this->request->post['my_photo'];
    	} elseif (!empty($suppler_info)) {
			$this->data['my_photo'] = $suppler_info['my_photo'];
		} else {
      		$this->data['supplers']['my_photo'] = '';
    	}
		
		if (isset($this->request->post['newphoto'])) {
      		$this->data['newphoto'] = $this->request->post['newphoto'];
    	} elseif (!empty($suppler_info)) {
			$this->data['newphoto'] = $suppler_info['newphoto'];
		} else {
      		$this->data['supplers']['newphoto'] = '1';			
    	}
		
		if (isset($this->request->post['cheap'])) {
      		$this->data['cheap'] = $this->request->post['cheap'];
    	} elseif (!empty($suppler_info)) {
			$this->data['cheap'] = $suppler_info['cheap'];
		} else {
      		$this->data['supplers']['cheap'] = '';			
    	}
		
		if (isset($this->request->post['weight'])) {
      		$this->data['weight'] = $this->request->post['weight'];
    	} elseif (!empty($suppler_info)) {
			$this->data['weight'] = $suppler_info['weight'];
		} else {
      		$this->data['supplers']['weight'] = '';
    	}
		
		if (isset($this->request->post['length'])) {
      		$this->data['length'] = $this->request->post['length'];
    	} elseif (!empty($suppler_info)) {
			$this->data['length'] = $suppler_info['length'];
		} else {
      		$this->data['supplers']['length'] = '';
    	}
		
		if (isset($this->request->post['width'])) {
      		$this->data['width'] = $this->request->post['width'];
    	} elseif (!empty($suppler_info)) {
			$this->data['width'] = $suppler_info['width'];
		} else {
      		$this->data['supplers']['width'] = '';
    	}
		
		if (isset($this->request->post['height'])) {
      		$this->data['height'] = $this->request->post['height'];
    	} elseif (!empty($suppler_info)) {
			$this->data['height'] = $suppler_info['height'];
		} else {
      		$this->data['supplers']['height'] = '';
    	}		
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (!empty($suppler_info)) {
			$this->data['sort_order'] = $suppler_info['sort_order'];
		} else {
      		$this->data['sort_order'] = '0';
    	}
		
		if (isset($this->request->post['bonus'])) {
      		$this->data['bonus'] = $this->request->post['bonus'];
    	} elseif (!empty($suppler_info)) {
			$this->data['bonus'] = $suppler_info['bonus'];
		} else {
      		$this->data['bonus'] = '';
    	}	

		if (isset($this->request->post['ddesc'])) {
      		$this->data['ddesc'] = $this->request->post['ddesc'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ddesc'] = $suppler_info['ddesc'];
		} else {
      		$this->data['ddesc'] = '0';
    	}
		
		if (isset($this->request->post['plusopt'])) {
      		$this->data['plusopt'] = $this->request->post['plusopt'];
    	} elseif (!empty($suppler_info)) {
			$this->data['plusopt'] = $suppler_info['plusopt'];
		} else {
      		$this->data['supplers']['plusopt'] = '0';
    	}
		
		if (isset($this->request->post['jopt'])) {
      		$this->data['jopt'] = $this->request->post['jopt'];
    	} elseif (!empty($suppler_info)) {
			$this->data['jopt'] = $suppler_info['jopt'];
		} else {
      		$this->data['supplers']['jopt'] = '0';
    	}
		
		if (isset($this->request->post['optsku'])) {
      		$this->data['optsku'] = $this->request->post['optsku'];
    	} elseif (!empty($suppler_info)) {
			$this->data['optsku'] = $suppler_info['optsku'];
		} else {
      		$this->data['supplers']['optsku'] = '0';
    	}
		
		if (isset($this->request->post['newproduct'])) {
      		$this->data['newproduct'] = $this->request->post['newproduct'];
    	} elseif (!empty($suppler_info)) {
			$this->data['newproduct'] = $suppler_info['newproduct'];
		} else {
      		$this->data['supplers']['newproduct'] = '';
    	}
		
		if (isset($this->request->post['idcat'])) {
      		$this->data['idcat'] = $this->request->post['idcat'];
    	} elseif (!empty($suppler_info)) {
			$this->data['idcat'] = $suppler_info['idcat'];
		} else {
      		$this->data['supplers']['idcat'] = '0';
    	}
		
		if (isset($this->request->post['termin'])) {
      		$this->data['termin'] = $this->request->post['termin'];
    	} elseif (!empty($suppler_info)) {
			$this->data['termin'] = $suppler_info['termin'];
		} else {
      		$this->data['supplers']['termin'] = '';
    	}
		
		if (isset($this->request->post['t_status'])) {
      		$this->data['t_status'] = $this->request->post['t_status'];
    	} elseif (!empty($suppler_info)) {
			$this->data['t_status'] = $suppler_info['t_status'];
		} else {
      		$this->data['supplers']['t_status'] = '';
    	}
		
		if (isset($this->request->post['zero'])) {
      		$this->data['zero'] = $this->request->post['zero'];
    	} elseif (!empty($suppler_info)) {
			$this->data['zero'] = $suppler_info['zero'];
		} else {
      		$this->data['supplers']['zero'] = '';
    	}
		
		if (isset($this->request->post['metka'])) {
      		$this->data['metka'] = $this->request->post['metka'];
    	} elseif (!empty($suppler_info)) {
			$this->data['metka'] = $suppler_info['metka'];
		} else {
      		$this->data['supplers']['metka'] = '';
    	}
		
		if (isset($this->request->post['opt_prices'])) {
      		$this->data['opt_prices'] = $this->request->post['opt_prices'];
    	} elseif (!empty($suppler_info)) {
			$this->data['opt_prices'] = $suppler_info['opt_prices'];
		} else {
      		$this->data['supplers']['opt_prices'] = 0;
    	}
		
		if (isset($this->request->post['opt_fotos'])) {
      		$this->data['opt_fotos'] = $this->request->post['opt_fotos'];
    	} elseif (!empty($suppler_info)) {
			$this->data['opt_fotos'] = $suppler_info['opt_fotos'];
		} else {
      		$this->data['supplers']['opt_fotos'] = 0;
    	}
		
		if (isset($this->request->post['serie'])) {
      		$this->data['serie'] = $this->request->post['serie'];
    	} elseif (!empty($suppler_info)) {
			$this->data['serie'] = $suppler_info['serie'];
		} else {
      		$this->data['supplers']['serie'] = '';
    	}
		
		if (isset($this->request->post['sleep'])) {
      		$this->data['sleep'] = $this->request->post['sleep'];
    	} elseif (!empty($suppler_info)) {
			$this->data['sleep'] = $suppler_info['sleep'];
		} else {
      		$this->data['supplers']['sleep'] = 0;
    	}
		
		if (isset($this->request->post['ffile'])) {
      		$this->data['ffile'] = $this->request->post['ffile'];
    	} elseif (!empty($suppler_info)) {
			$this->data['ffile'] = $suppler_info['ffile'];
		} else {
      		$this->data['supplers']['ffile'] = 0;
    	}
				
		if (isset($this->error['warning']) or isset($this->error['name'])) {
			$this->data['supplers']['name'] = '';
			$this->data['supplers']['rate'] = '1.000';
			$this->data['supplers']['ratep'] = '1.000';
			$this->data['supplers']['ratek'] = '1.000';
			$this->data['supplers']['cod'] = '';
			$this->data['supplers']['related'] = '';
			$this->data['supplers']['updte'] = '0';
			$this->data['supplers']['item'] = '';
			$this->data['supplers']['cat'] = '';
			$this->data['supplers']['qu'] = '';
			$this->data['supplers']['price'] = '';
			$this->data['supplers']['descrip'] = '';
			$this->data['supplers']['pic_ext'] = '';
			$this->data['supplers']['pic_ext'] = '';
			$this->data['supplers']['manuf'] = '';
			$this->data['supplers']['warranty'] = '';
			$this->data['supplers']['myplus'] = '';
			$this->data['supplers']['status'] = '';
			$this->data['supplers']['my_cat'] = '';
			$this->data['supplers']['my_qu'] = '';
			$this->data['supplers']['my_price'] = '';
			$this->data['supplers']['my_descrip'] = '';
			$this->data['supplers']['my_manuf'] = '';
			$this->data['supplers']['my_photo'] = '';
			$this->data['supplers']['weight'] = '';
			$this->data['supplers']['length'] = '';
			$this->data['supplers']['width'] = '';
			$this->data['supplers']['height'] = '';
			$this->data['supplers']['ad'] = '1';
			$this->data['supplers']['parent'] = '0';
			$this->data['supplers']['newphoto'] = '0';
			$this->data['supplers']['hide'] = '1';			
			$this->data['supplers']['cheap'] = '0';
			$this->data['supplers']['addopt'] = '0';
			$this->data['supplers']['minus'] = '0';
			$this->data['supplers']['chcode'] = '0';
			$this->data['supplers']['sku2'] = '0';
			$this->data['supplers']['pointp'] = '';
			$this->data['supplers']['pointq'] = '';
			$this->data['supplers']['placeq'] = '';
			$this->data['supplers']['bprice'] = '';
			$this->data['supplers']['kmenu'] = '0';
			$this->data['supplers']['qu_discount'] = '';
			$this->data['supplers']['idcat'] = '0';
			$this->data['supplers']['plusopt'] = '0';
			$this->data['sort_order'] = 0;
			$this->data['keyword'] = '';
			$this->data['supplers']['t_ref'] = '0';
			$this->data['supplers']['t_status'] = '';
			$this->data['supplers']['termin'] = '';
			$this->data['supplers']['zero'] = '0';
			$this->data['supplers']['metka'] = '0';
			$this->data['supplers']['newproduct'] = '';
			$this->data['supplers']['opt_fotos'] = 0;
			$this->data['supplers']['opt_prices'] = 0;
			$this->data['supplers']['series'] = '';
			$this->data['supplers']['sleep'] = 0;
			$this->data['supplers']['ffile'] = 0;
			
		}
		
		$pagination = new Pagination();
		$pagination->total = $data_total;
		$pagination->page = $page;
		$pagination->limit = 50;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/suppler/update', 'token=' . $this->session->data['token'] . '&form_id=' . $id . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();		
		
		$this->template = 'catalog/suppler_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	} 	
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'catalog/suppler')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}		
						
    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}

	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/suppler')) {
      		$this->error['warning'] = $this->language->get('error_permission'); 
		}  	 	
				
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
  	private function getAttributes($attributes, $attribute_group_id = 0, $attribute_group = '') {
		$output = array();
		
		foreach ($attributes as $attribute) {
			if ($attribute['attribute_group'] != '') $attribute['attribute_group'] .= $this->language->get('text_separator');
			
			$output[$attribute['attribute_id']] = array(
			'attribute_id' => $attribute['attribute_id'],
			'name'        => $attribute['attribute_group'] . $attribute['name']
			);
				
		}	
		return $output;    
    }
	 
	private function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name'        => $parent_name . $category['name']
				);

				$output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		return $output;
    
    }
	
}
?>