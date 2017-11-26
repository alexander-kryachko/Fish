<?php  
class ControllerModuleHtmlBlock extends Controller {
	
	protected function index($setting) {
		
		$this->data['message'] = $message = '';
		
		if ($block = $this->config->get('html_block_' . $setting['html_block_id'])) {
			
			$content = $block['content'][$this->config->get('config_language_id')];
			
			if (isset($block['theme']) && !empty($block['template'])) {
				
				$replace = array(
					'[title]'	=> $block['title'][$this->config->get('config_language_id')],
					'[content]'	=> $content
				);
				
				$content = strtr($block['template'], $replace);
			
			}
			
			$content = preg_replace_callback('|\[[a-zA-Z_]+?\]|isu', array($this, 'getTokenValue'), $content);
			
			$message = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
			
			if (isset($block['use_php']) && preg_match('|<\?php.+?\?>|isu', $message)) {
				
				ob_start();
				@eval('?>' . $message);
				$message = ob_get_contents();
				ob_end_clean();
				
			}
			
			$this->data['message'] = $message;
			
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/html_block.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/html_block.tpl';
		} else {
			$this->template = 'default/template/module/html_block.tpl';
		}
		
		$this->render();
	}
	
	private function getTokenValue($token) {
		
		if (!isset($token[0])) return '';
		
		$value = $token[0];
		
		switch($value) {
			case '[config_name]':
				$value = $this->config->get('config_name');
				break;
			case '[config_title]':
				$value = $this->config->get('config_title');
				break;
			case '[config_owner]':
				$value = $this->config->get('config_owner');
				break;
			case '[config_address]':
				$value = $this->config->get('config_address');
				break;
			case '[config_email]':
				$value = $this->config->get('config_email');
				break;
			case '[config_telephone]':
				$value = $this->config->get('config_telephone');
				break;
			case '[config_fax]':
				$value = $this->config->get('config_fax');
				break;
			case '[customer_firstname]':
				$value = $this->customer->getFirstName();
				break;
			case '[customer_lastname]':
				$value = $this->customer->getLastName();
				break;
			case '[customer_email]':
				$value = $this->customer->getEmail();
				break;
			case '[customer_telephone]':
				$value = $this->customer->getTelephone();
				break;
			case '[customer_fax]':
				$value = $this->customer->getFax();
				break;
			case '[customer_reward]':
				$value = $this->customer->getRewardPoints();
				break;
			case '[currency_code]':
				$value = $this->currency->getCode();
				break;
			case '[currency_title]':
				$this->load->model('localisation/currency');
				$results = $this->model_localisation_currency->getCurrencies();	
				foreach ($results as $result) {
					if ($result['status'] && $result['code'] == $this->currency->getCode()) {
						$value = $result['title'];
						break;
					}
				}
				break;
			case '[language_code]':
				$value = $this->getLanguageData('code');
				break;
			case '[language_name]':
				$value = $this->getLanguageData('name');
				break;
		}
		return $value;
	}
	
	private function getLanguageData($key){
		static $language = array();
		
		if (!$language) {
			$this->load->model('localisation/language');
			$results = $this->model_localisation_language->getLanguages();
			foreach ($results as $result) {
				if ($result['status'] && $result['code'] == $this->session->data['language']) {
					$language = $result;
				}
			}
		}
		
		return isset($language[$key]) ? $language[$key] : '';
	}
	
}
?>