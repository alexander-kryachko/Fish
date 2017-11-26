<?php    
class ControllerSaleCustomerBanPhone extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->language->load('sale/customer_ban_phone');
		 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_phone');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->language->load('sale/customer_ban_phone');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_phone');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	$this->model_sale_customer_ban_phone->addCustomerBanPhone($this->request->post);
			
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
			
			$this->redirect($this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    	
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->language->load('sale/customer_ban_phone');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_phone');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer_ban_phone->editCustomerBanPhone($this->request->get['customer_ban_phone_id'], $this->request->post);
	  		
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
			
			$this->redirect($this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->language->load('sale/customer_ban_phone');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_phone');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_ban_phone_id) {
				$this->model_sale_customer_ban_phone->deleteCustomerBanPhone($customer_ban_phone_id);
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
			
			$this->redirect($this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
    
    	$this->getList();
  	}  
    
  	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'phone'; 
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
			'href'      => $this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('sale/customer_ban_phone/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('sale/customer_ban_phone/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['customer_ban_phones'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$customer_ban_phone_total = $this->model_sale_customer_ban_phone->getTotalCustomerBanPhones($data);
	
		$results = $this->model_sale_customer_ban_phone->getCustomerBanPhones($data);
 
    	foreach ($results as $result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/customer_ban_phone/update', 'token=' . $this->session->data['token'] . '&customer_ban_phone_id=' . $result['customer_ban_phone_id'] . $url, 'SSL')
			);
			
			$this->data['customer_ban_phones'][] = array(
				'customer_ban_phone_id' => $result['customer_ban_phone_id'],
				'phone'                 => $result['phone'],
				'total'              => $result['total'],
				'customer'           => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&filter_phone=' . $result['phone'], 'SSL'),
				'selected'           => isset($this->request->post['selected']) && in_array($result['customer_ban_phone_id'], $this->request->post['selected']),
				'action'             => $action
			);
		}	
					
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_phone'] = $this->language->get('column_phone');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_action'] = $this->language->get('column_action');		
		
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
		
		$this->data['sort_phone'] = $this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . '&sort=phone' . $url, 'SSL');
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $customer_ban_phone_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
				
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'sale/customer_ban_phone_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
  
  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 		
    	$this->data['entry_phone'] = $this->language->get('entry_phone');
 
		$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['phone'])) {
			$this->data['error_phone'] = $this->error['phone'];
		} else {
			$this->data['error_phone'] = '';
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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['customer_ban_phone_id'])) {
			$this->data['action'] = $this->url->link('sale/customer_ban_phone/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/customer_ban_phone/update', 'token=' . $this->session->data['token'] . '&customer_ban_phone_id=' . $this->request->get['customer_ban_phone_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('sale/customer_ban_phone', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['customer_ban_phone_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$customer_ban_phone_info = $this->model_sale_customer_ban_phone->getCustomerBanPhone($this->request->get['customer_ban_phone_id']);
    	}
			
    	if (isset($this->request->post['phone'])) {
      		$this->data['phone'] = $this->request->post['phone'];
		} elseif (!empty($customer_ban_phone_info)) { 
			$this->data['phone'] = $customer_ban_phone_info['phone'];
		} else {
      		$this->data['phone'] = '';
    	}
		
		$this->template = 'sale/customer_ban_phone_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
			 
  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'sale/customer_ban_phone')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

		$phone = $this->request->post['phone'];
		preg_match_all('/\d/', $phone, $m);
    	if (count($m[0]) < 10 || utf8_strlen($phone) > 40){
      		$this->error['phone'] = $this->language->get('error_phone');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'sale/customer_ban_phone')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}	
	  	 
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  
  	} 
}
?>