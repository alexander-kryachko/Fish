<?php 
class ControllerCheckoutMC360 extends Controller { 
	public function index() { 
		if ($this->config->get('mc360_status') && isset($this->session->data['mc_order_id'])) {
			if (isset($this->request->cookie['mc_ecomm_cid']) && isset($this->request->cookie['mc_ecomm_eid'])) {
				if ($this->config->get('mc360_debug')) {
					$this->log->write("MC_360 DEBUG: Cookie Found - Processing eCommerce 360");
				}
			
				$this->load->model('checkout/mc360');

				$mc360 = $this->model_checkout_mc360->getOrderInfo($this->session->data['mc_order_id']);

				if (!$mc360) {
					$this->log->write("MC_360 ERROR: Unable to load order_id " . $this->session->data['mc_order_id']);
				} else {
					$mc360['email_id'] = $this->request->cookie['mc_ecomm_eid'];
					$mc360['campaign_id'] = $this->request->cookie['mc_ecomm_cid'];
					
					if ($this->config->get('mc360_key') && ($this->config->get('mc360_key') != '')) {
						$this->load->library('mcapi/MCAPI.class');
						$mc = NEW MCAPI($this->config->get('mc360_key'));
						$response = $mc->ecommOrderAdd($mc360);
						
						if(!$response || !empty($mc->errorMessage)) {
							$this->log->write("MC_360 OrderAdd Failed with error: " . $mc->errorMessage);
						}
					
					} else {
						$this->log->write("MC_360 ERROR: API Key Undefined!");
					}
				}
			}
		}
		unset($this->session->data['mc_order_id']);
		unset($this->session->data['mc_shipping']);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mc360.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/mc360.tpl';
		} else {
			$this->template = 'default/template/module/mc360.tpl';
		}
		
		$this->render();	
	}
}	
?>