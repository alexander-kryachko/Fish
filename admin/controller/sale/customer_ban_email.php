<?php    
class ControllerSaleCustomerBanEmail extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->language->load('sale/customer_ban_email');
		 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_email');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->language->load('sale/customer_ban_email');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_email');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  	$this->model_sale_customer_ban_email->addCustomerBanEmail($this->request->post);
			
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
			
			$this->redirect($this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    	
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->language->load('sale/customer_ban_email');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_email');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer_ban_email->editCustomerBanEmail($this->request->get['customer_ban_email_id'], $this->request->post);
	  		
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
			
			$this->redirect($this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->language->load('sale/customer_ban_email');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer_ban_email');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_ban_email_id) {
				$this->model_sale_customer_ban_email->deleteCustomerBanEmail($customer_ban_email_id);
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
			
			$this->redirect($this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
    
    	$this->getList();
  	}  
    
  	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'email'; 
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
			'href'      => $this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('sale/customer_ban_email/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('sale/customer_ban_email/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['customer_ban_emails'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$customer_ban_email_total = $this->model_sale_customer_ban_email->getTotalCustomerBanEmails($data);
	
		$results = $this->model_sale_customer_ban_email->getCustomerBanEmails($data);
 
    	foreach ($results as $result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/customer_ban_email/update', 'token=' . $this->session->data['token'] . '&customer_ban_email_id=' . $result['customer_ban_email_id'] . $url, 'SSL')
			);
			
			$this->data['customer_ban_emails'][] = array(
				'customer_ban_email_id' => $result['customer_ban_email_id'],
				'email'                 => $result['email'],
				'total'              => $result['total'],
				'customer'           => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&filter_email=' . $result['email'], 'SSL'),
				'selected'           => isset($this->request->post['selected']) && in_array($result['customer_ban_email_id'], $this->request->post['selected']),
				'action'             => $action
			);
		}	
					
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_email'] = $this->language->get('column_email');
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
		
		$this->data['sort_email'] = $this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . '&sort=email' . $url, 'SSL');
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $customer_ban_email_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
				
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'sale/customer_ban_email_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
  
  	protected function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 		
    	$this->data['entry_email'] = $this->language->get('entry_email');
 
		$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
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
			'href'      => $this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['customer_ban_email_id'])) {
			$this->data['action'] = $this->url->link('sale/customer_ban_email/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/customer_ban_email/update', 'token=' . $this->session->data['token'] . '&customer_ban_email_id=' . $this->request->get['customer_ban_email_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('sale/customer_ban_email', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['customer_ban_email_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$customer_ban_email_info = $this->model_sale_customer_ban_email->getCustomerBanEmail($this->request->get['customer_ban_email_id']);
    	}
			
    	if (isset($this->request->post['email'])) {
      		$this->data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_ban_email_info)) { 
			$this->data['email'] = $customer_ban_email_info['email'];
		} else {
      		$this->data['email'] = '';
    	}
		
		$this->template = 'sale/customer_ban_email_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
			 
  	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'sale/customer_ban_email')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((utf8_strlen($this->request->post['email']) < 1) || (utf8_strlen($this->request->post['email']) > 40) || !preg_match("/^[a-z0-9_]+([\.-][a-z0-9_]+)*@[a-z0-9]+([\.-][a-z0-9]+)*\.[a-z]{2,}$/i", $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    

  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'sale/customer_ban_email')) {
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