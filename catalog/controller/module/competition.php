<?php  
class ControllerModuleCompetition extends Controller { 
	protected function index($setting) {
		$this->language->load('module/competition');
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('tool/image'); 
		
    	$this->data['heading_title'] 				= $this->language->get('heading_title');
		$this->data['text_enter_competition'] 		= $this->language->get('text_enter_competition');
		$this->data['text_newsletter_subscribe']	= $this->language->get('text_newsletter_subscribe');
		$this->data['text_read_accept'] 			= $this->language->get('text_read_accept');

		$this->load->model('module/competition');
		$this->data['competition'] = $this->model_module_competition->getCompetition($setting['competition_id']);

		$this->data['information']	= $this->model_module_competition->getInformation($this->data['competition'][0]['information_id']);

		$this->data['answers'] = $this->model_module_competition->getAnswers($setting['competition_id']);
		
		$answers = $this->model_module_competition->getAnswers($setting['competition_id']);
		
		
		//products with answer's names
		$products_array = array();
		$y = 0;
		
		foreach ($answers as $answer) {
			$sql = "SELECT product_id FROM `oc_product_description` WHERE name='".$answer['value']."'";
			$query = $this->db->query($sql);
			foreach ($query->rows as $result) {
				$products_array[$y] = $this->model_catalog_product->getProduct($result['product_id']);
			} 
			$y++;
		}
		
		foreach ($products_array as $product) {
		
			if ($product['image']) {
						$image = $this->model_tool_image->resize($product['image'], 160, 160);
					} else {
						$image = $this->model_tool_image->resize('no_image.jpg', 160, 160);
					}
				
			$this->data['products'][] = array(
				'product_id'  => $product['product_id'],
				'thumb'       => $image,
				'name'        => $product['name']
			);
		}
		
		//products with answer's names - end
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/competition.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/competition.tpl';
		} else {
			$this->template = 'default/template/module/competition.tpl';
		}
		
		$this->render();
	}
	
	public function enterCompetition() {
		$this->load->model('module/competition');

		$this->language->load('module/competition');
		
		$this->data['text_onlyonce']			= $this->language->get('text_only_once');
		$this->data['text_name_required']		= $this->language->get('text_name_required');
		$this->data['text_email_required']		= $this->language->get('text_email_required');
		$this->data['text_thankyou']			= $this->language->get('text_thankyou');
		$this->data['text_term_required']		= $this->language->get('text_term_required');

		$data1 = $this->model_module_competition->getCompetition($this->request->post['competition_id']);

		if($data1[0]['term'] == 1):
			if($this->request->post['term'] != 1):
				$json['term_error'] = $this->data['text_term_required'];
			endif;
		endif;

		if($this->model_module_competition->getCompetitionExist($this->request->post['email'], $this->request->post['competition_id']) > 0) {
			$json['exist_error'] = $this->data['text_onlyonce'];
		}

    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$json['name_error'] = $this->data['text_name_required'];
    	}

    	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$json['email_error'] = $this->data['text_email_required'];
    	}
		
		if (isset($json['name_error']) || isset($json['email_error']) || isset($json['exist_error']) || isset($json['term_error'])) {
	  		$json['error']	= true;
		} else {
			$this->model_module_competition->enterCompetition($this->request->post);
	  		$json['success'] = $this->data['text_thankyou'];
		}


		$this->response->setOutput(json_encode($json));
		
	}
}
?>