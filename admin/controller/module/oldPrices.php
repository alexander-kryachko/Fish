<?php
class ControllerModuleOldPrices extends Controller {
	private $error = array(); 

	public function index(){
		$this->load->language('module/oldPrices');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('module/oldPrices');
		
		$query = $this->db->query('SELECT * FROM '.DB_PREFIX.'old_prices LIMIT 1');

		if (isset($_GET['act'])){
			switch($_GET['act']){
				case 'remember':
					$this->model_module_oldPrices->rememberPrices();
					$this->session->data['success'] = 'Цены сохранены';
					break;
				case 'update':
					$this->model_module_oldPrices->updateSpecials();
					$this->session->data['success'] = 'Цены обновлены';
					break;
				case 'series':
					$this->model_module_oldPrices->updateSeries();
					$this->session->data['success'] = 'Цены товаров-серий обновлены';
					break;
				case 'clear':
					$this->model_module_oldPrices->clearPrices();
					$this->session->data['success'] = 'Акции без срока действия удалены';
					break;
			}
			
			$this->redirect($this->url->link('module/oldPrices', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])){
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		if (!empty($query->rows)) $this->data['oldpricesaved'] = true;

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
			'href'      => $this->url->link('module/oldPrices', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('module/oldPrices', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['remember'] = $this->url->link('module/oldPrices', 'act=remember&token=' . $this->session->data['token'], 'SSL');
		$this->data['update'] = $this->url->link('module/oldPrices', 'act=update&token=' . $this->session->data['token'], 'SSL');
		$this->data['series'] = $this->url->link('module/oldPrices', 'act=series&token=' . $this->session->data['token'], 'SSL');
		$this->data['clear'] = $this->url->link('module/oldPrices', 'act=clear&token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/oldPrices.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);				
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/oldPrices')) {
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