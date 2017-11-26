<?php
class ControllerModuleCompetition extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('module/competition');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_newsletter_subscribers'] = $this->language->get('text_newsletter_subscribers');
		$this->data['text_insert'] = $this->language->get('text_insert');
		$this->data['text_name'] = $this->language->get('text_name');
		$this->data['text_action'] = $this->language->get('text_action');
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_delete'] = $this->language->get('text_delete');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		} else {
			$this->data['success'] = '';
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
			'href'      => $this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('module/competition/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['newsletter'] = $this->url->link('module/competition/newsletter', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		//////////////////////////////////////////////////////////////////////////
		$this->load->model('module/competition');
		$this->data['competitions'] = $this->model_module_competition->getCompetitions();
		//////////////////////////////////////////////////////////////////////////
		
		$this->template = 'module/competition_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}

	public function newsletter() {
		$this->load->language('module/competition');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		$this->data['heading_title'] = $this->language->get('text_newsletter_subscribers');
		
		$this->data['text_newsletter_subscribers'] = $this->language->get('text_newsletter_subscribers');
		$this->data['text_back'] = $this->language->get('text_back');
		$this->data['text_name'] = $this->language->get('text_name');
		$this->data['text_email'] = $this->language->get('text_email');
		$this->data['text_action'] = $this->language->get('text_action');
		$this->data['text_delete'] = $this->language->get('text_delete');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		} else {
			$this->data['success'] = '';
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
			'href'      => $this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['back'] = $this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		//////////////////////////////////////////////////////////////////////////
		$this->load->model('module/competition');
		$this->data['newsletters'] = $this->model_module_competition->getNewsletters();
		//////////////////////////////////////////////////////////////////////////
		
		$this->template = 'module/newsletter_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}

	public function insert() {
		$this->load->model('module/competition');
		$this->load->language('module/competition');
			if ($this->validate()) {
				$competition = "Competition"; //INDSÆT LANGUAGE COMPETITION TEKST
				$this->model_module_competition->insertCompetition($competition);
				//$this->model_setting_setting->editSetting('competition', $this->request->post);		
				$this->session->data['success'] = $this->language->get('text_success');
			}
		$this->redirect($this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'));
	}

	public function delete() {
			if ($this->validate()) {
				$this->load->model('module/competition');
				$this->load->language('module/competition');
				$this->load->model('setting/setting');
				
				$competition_id = $_GET['id'];
				$this->model_module_competition->deleteCompetition($competition_id);

				$parsed_setting = $this->parseDeleteSetting($this->request->post, $competition_id);
				$this->model_setting_setting->editSetting('competition', $parsed_setting);
				
				$this->session->data['success'] = $this->language->get('text_success');
			}
		$this->redirect($this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'));
	}

	public function newsletterdelete() {
			if ($this->validate()) {
				$this->load->model('module/competition');
				$this->load->language('module/competition');
				$this->load->model('setting/setting');
				
				$newsletter_id = $_GET['id'];
				$this->model_module_competition->deleteNewsletter($newsletter_id);
				
				$this->session->data['success'] = $this->language->get('text_success');
			}
		$this->redirect($this->url->link('module/competition/newsletter', 'token=' . $this->session->data['token'], 'SSL'));
	}

	public function update() {
		
		$id = $_GET['id'];
		$this->data['competition_id'] = $id;
		
		$this->load->model('module/competition');
		
		$this->load->language('module/competition');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$parsed_setting = $this->parseUpdateSetting($this->request->post, $this->data['competition_id']);
			$this->model_setting_setting->editSetting('competition', $parsed_setting);
			
				$this->model_module_competition->updateInformation($id, $this->request->post);
				$this->model_module_competition->updateAnswers($id, $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['text_newsletter_subscribers'] = $this->language->get('text_newsletter_subscribers');
		$this->data['text_insert'] = $this->language->get('text_insert');
		$this->data['text_name'] = $this->language->get('text_name');
		$this->data['text_action'] = $this->language->get('text_action');
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_delete'] = $this->language->get('text_delete');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['text_status'] = $this->language->get('text_status');
		$this->data['text_general'] = $this->language->get('text_general');
		$this->data['text_participants'] = $this->language->get('text_participants');
		$this->data['text_winners'] = $this->language->get('text_winners');
		$this->data['text_title'] = $this->language->get('text_title');
		$this->data['text_description'] = $this->language->get('text_description');
		$this->data['text_newsletter_signup'] = $this->language->get('text_newsletter_signup');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_question'] = $this->language->get('text_question');
		$this->data['text_answer'] = $this->language->get('text_answer');
		$this->data['text_correct_answer'] = $this->language->get('text_correct_answer');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_add_answer'] = $this->language->get('text_add_answer');
		$this->data['text_email'] = $this->language->get('text_email');
		$this->data['text_amount_of_winners'] = $this->language->get('text_amount_of_winners');
		$this->data['text_select_random_winners'] = $this->language->get('text_select_random_winners');
		$this->data['text_terms_conditions'] = $this->language->get('text_terms_conditions');
		
		
		
		
		
		
		
		
		
		
		
		
		

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
			'href'      => $this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['winner_action'] = $this->url->link('module/competition/selectWinners&id=' . $this->data['competition_id'] . '', 'token=' . $this->session->data['token'], 'SSL'); 
		
		$this->data['action'] = $this->url->link('module/competition/update&id=' . $this->data['competition_id'] . '', 'token=' . $this->session->data['token'], 'SSL'); 
		
		$this->data['cancel'] = $this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL');
				
		$this->data['settings'] = array();
		
		$setting_data = array();
		if(is_array($this->config->get('competition_module'))):
		foreach($this->config->get('competition_module') as $setting_row):
			if($setting_row['competition_id'] == $id):
				$setting_data[] = array(
					'competition_id'	=>	$setting_row['competition_id'],
					'layout_id'			=>	$setting_row['layout_id'],
					'position'			=>	$setting_row['position'],
					'status'			=>	$setting_row['status'],
					'sort_order'		=>	$setting_row['sort_order']
				);
			endif;
		endforeach;
		endif;
		
		$this->data['settings'] = $setting_data;
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		////////////////////////////////////////////////////////////////
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->data['information_description'] = $this->model_module_competition->getInformation($id);
		$this->data['participants'] = $this->model_module_competition->getParticipants($id);
		$this->data['answers'] = $this->model_module_competition->getAnswers($id);
		
		$this->data['winners'] = $this->model_module_competition->getWinners($id);
		
		$this->data['information_pages'] = $this->model_module_competition->getInformationPages();
		
		
		////////////////////////////////////////////////////////////////
		
		$this->template = 'module/competition.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/competition')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	private function parseUpdateSetting($data, $id) {

		$setting_data['competition_module'] = array();
		
		if($this->config->get('competition_module')):
			foreach($this->config->get('competition_module') as $setting_row):
				if($setting_row['competition_id'] != $id):
					$setting_data['competition_module'][] = array(
						'competition_id'	=>	$setting_row['competition_id'],
						'layout_id'			=>	$setting_row['layout_id'],
						'position'			=>	$setting_row['position'],
						'status'			=>	$setting_row['status'],
						'sort_order'		=>	$setting_row['sort_order']
					);
				endif;
			endforeach;
		endif;
		
		if(isset($data['competition_module'])):
			foreach($data['competition_module'] as $data_row):
				$setting_data['competition_module'][] = array(
					'competition_id'	=>	$data_row['competition_id'],
					'layout_id'			=>	$data_row['layout_id'],
					'position'			=>	$data_row['position'],
					'status'			=>	$data_row['status'],
					'sort_order'		=>	$data_row['sort_order']
				);
			endforeach;
		endif;
		
		return $setting_data;
	}

	private function parseDeleteSetting($data, $id) {

		$setting_data['competition_module'] = array();
		
		if($this->config->get('competition_module')):
			foreach($this->config->get('competition_module') as $setting_row):
				if($setting_row['competition_id'] != $id):
					$setting_data['competition_module'][] = array(
						'competition_id'	=>	$setting_row['competition_id'],
						'layout_id'			=>	$setting_row['layout_id'],
						'position'			=>	$setting_row['position'],
						'status'			=>	$setting_row['status'],
						'sort_order'		=>	$setting_row['sort_order']
					);
				endif;
			endforeach;
		endif;
		
		return $setting_data;
	}

	public function selectWinners() {
		
		$this->load->language('module/competition');
		
		$id = $_GET['id'];
		$post_data = $this->request->post;
		$amount = $post_data['amount'];
		
		$this->load->model('module/competition');
		
		if($this->model_module_competition->selectWinners($id, $amount)):
			$this->session->data['success'] = $this->language->get('text_success');
		else:
	 		if (isset($this->error['warning'])) {
				$this->data['error_warning'] = $this->error['warning'];
			} else {
				$this->data['error_warning'] = '';
			}
		endif;

		$this->redirect($this->url->link('module/competition', 'token=' . $this->session->data['token'], 'SSL'));
	}

	public function install() {
		$this->load->model('module/competition');
		$this->model_module_competition->install_competition();
	}

	public function uninstall() {
		$this->load->model('module/competition');
		$this->model_module_competition->uninstall_competition();
	}

}
?>