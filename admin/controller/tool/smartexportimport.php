<?php 
class ControllerToolSmartExportImport extends Controller { 
	private $error = array();
	
	public function index() {
		$this->load->language('tool/smartexportimport');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('tool/smartexportimport');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if ((isset( $this->request->files['upload'] )) && (is_uploaded_file($this->request->files['upload']['tmp_name']))) {
				$file = $this->request->files['upload']['tmp_name'];
				if ($this->model_tool_smartexportimport->upload($file)===TRUE) {
					$this->session->data['success'] = $this->language->get('text_success');
					$this->redirect($this->url->link('tool/smartexportimport', 'token=' . $this->session->data['token'], 'SSL'));
				}
				else {
					$this->error['warning'] = $this->language->get('error_upload');
				}
			}
		}

		if (!empty($this->session->data['export_error']['errstr'])) {
			$this->error['warning'] = $this->session->data['export_error']['errstr'];
			if (!empty($this->session->data['export_nochange'])) {
				$this->error['warning'] .= '<br />'.$this->language->get( 'text_nochange' );
			}
			$this->error['warning'] .= '<br />'.$this->language->get( 'text_log_details' );
		}
		unset($this->session->data['export_error']);
		unset($this->session->data['export_nochange']);
		
		$minProductId = $this->model_tool_smartexportimport->getMinproduct_id();
		$maxProductId = $this->model_tool_smartexportimport->getMaxproduct_id();
		$countProduct = $this->model_tool_smartexportimport->getCountproduct();
		
		$this->data['min_product_id'] = $minProductId;
		$this->data['max_product_id'] = $maxProductId;
		$this->data['count_product'] = $countProduct;

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_restore'] = $this->language->get('entry_restore');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['button_import'] = $this->language->get('button_import');
		$this->data['button_export'] = $this->language->get('button_export');

		$this->data['entry_exportway_sel'] = $this->language->get('entry_exportway_sel');
		$this->data['entry_start_id'] = $this->language->get('entry_start_id');
		$this->data['entry_end_id'] = $this->language->get('entry_end_id');
		$this->data['entry_start_index'] = $this->language->get('entry_start_index');
		$this->data['entry_end_index'] = $this->language->get('entry_end_index');
		$this->data['button_export_pid'] = $this->language->get('button_export_pid');
		$this->data['button_export_page'] = $this->language->get('button_export_page');

		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['error_select_file'] = $this->language->get('error_select_file');
		$this->data['error_post_max_size'] = str_replace( '%1', ini_get('post_max_size'), $this->language->get('error_post_max_size') );
		$this->data['error_upload_max_filesize'] = str_replace( '%1', ini_get('upload_max_filesize'), $this->language->get('error_upload_max_filesize') );
		$this->data['error_pid_no_data'] = $this->language->get('error_pid_no_data');
		$this->data['error_page_no_data'] = $this->language->get('error_page_no_data');
		$this->data['error_param_not_number'] = $this->language->get('error_param_not_number');

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
			'href'      => $this->url->link('tool/smartexportimport', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = $this->url->link('tool/smartexportimport', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['export'] = $this->url->link('tool/smartexportimport/download', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['post_max_size'] = $this->return_bytes( ini_get('post_max_size') );
		$this->data['upload_max_filesize'] = $this->return_bytes( ini_get('upload_max_filesize') );

		$this->template = 'tool/smartexportimport.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		$this->response->setOutput($this->render());
	}


	function return_bytes($val)
	{
		$val = trim($val);
	
		switch (strtolower(substr($val, -1)))
		{
			case 'm': $val = (int)substr($val, 0, -1) * 1048576; break;
			case 'k': $val = (int)substr($val, 0, -1) * 1024; break;
			case 'g': $val = (int)substr($val, 0, -1) * 1073741824; break;
			case 'b':
				switch (strtolower(substr($val, -2, 1)))
				{
					case 'm': $val = (int)substr($val, 0, -2) * 1048576; break;
					case 'k': $val = (int)substr($val, 0, -2) * 1024; break;
					case 'g': $val = (int)substr($val, 0, -2) * 1073741824; break;
					default : break;
				} break;
			default: break;
		}
		return $val;
	}


	public function download() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			
			if (isset( $this->request->post['exportway'] )) {
				$exportway = $this->request->post['exportway'];
			}
			if (isset( $this->request->post['min'] )) {
				$min = $this->request->post['min'];
			}
			if (isset( $this->request->post['max'] )) {
				$max = $this->request->post['max'];
			}
			// send the categories, products and options as a spreadsheet file
			$this->load->model('tool/smartexportimport');
			switch($exportway) {
				case 'pid':
					$this->model_tool_smartexportimport->download(NULL, NULL, $min, $max);
					break;
				case 'page':
					$this->model_tool_smartexportimport->download($min*($max-1-1), $min, NULL, NULL); //min为每批大小，max-1为当前导出第几批（因为在页面上进行分批导出时当前批自动加1是在提交数据前，故加1后提交的数据打了个1，这里需要减掉）
					break;
				default:
					break;
			}
			$this->redirect( $this->url->link( 'tool/smartexportimport', 'token='.$this->request->get['token'], 'SSL' ) );

		} else {

			// return a permission error page
			return $this->forward('error/permission');
		}
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'tool/smartexportimport')) {
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