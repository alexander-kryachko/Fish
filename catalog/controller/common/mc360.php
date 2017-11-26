<?php 
class ControllerCommonMC360 extends Controller { 
	public function index() {
		$expire_cookie = strtotime('+30 Days');

		if (isset($this->request->get['mc_cid'])) {
			setcookie('mc_ecomm_cid',trim($this->request->get['mc_cid']),$expire_cookie);

			if ($this->config->get('mc360_debug')) {
				$this->log->write("MC_360 DEBUG: Cookie Set --> mc_cid: " . $this->request->get['mc_cid']);
			}
		}

		if (isset($this->request->get['mc_eid'])) {
			setcookie('mc_ecomm_eid',trim($this->request->get['mc_eid']),$expire_cookie);

			if ($this->config->get('mc360_debug')) {
				$this->log->write("MC_360 DEBUG: Cookie Set --> mc_eid: " . $this->request->get['mc_eid']);
			}
		}
	}
}
?>