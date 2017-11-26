<?php
class ControllerFeedMC360 extends Controller {
	private $error = array();

	public function index() {
		$this->data = array_merge($this->data, $this->load->language('feed/mc360'));
		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('mc_360', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
		}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->document->breadcrumbs = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_feed'),
			'href'      => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => $this->url->link('feed/mc360', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('feed/mc360', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['mc360_status'])) {
			$this->data['mc360_status'] = $this->request->post['mc360_status'];
		} else {
			$this->data['mc360_status'] = $this->config->get('mc360_status');
		}

		if (isset($this->request->post['mc360_key'])) {
			$this->data['mc360_key'] = $this->request->post['mc360_key'];
		} else {
			$this->data['mc360_key'] = $this->config->get('mc360_key');
		}
		
		if (isset($this->request->post['mc360_debug'])) {
			$this->data['mc360_debug'] = $this->request->post['mc360_debug'];
		} else {
			$this->data['mc360_debug'] = $this->config->get('mc360_debug');
		}

		if (isset($this->request->post['mc360_store'])) {
			$this->data['mc360_store'] = $this->request->post['mc360_store'];
		} else if($this->config->get('mc360_store')) {
			$this->data['mc360_store'] = $this->config->get('mc360_store');		
		} else {
			$this->data['mc360_store'] = substr(md5(uniqid(rand(),true)),0,20);
		}		

		$this->template = 'feed/mc360.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'feed/mc360')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>