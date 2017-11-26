<?php
class ControllerModulePds extends Controller {
	private $error = array();

	public function index() {

		$this->load->language('module/pds');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pds', $this->request->post);

			$this->cache->delete('product');
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

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
			'href'      => $this->url->link('module/pds', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('module/pds', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/pds.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		//START
		//entry
		$this->setDataLang('entry_allow_buying_series');
		$this->setDataLang('entry_show_thumbnails');
		$this->setDataLang('entry_thumbnail_size');
		$this->setDataLang('entry_hide_from_list_view');
		$this->setDataLang('entry_preview_size');
		$this->setDataLang('entry_thumbnail_hover_effect');
		$this->setDataLang('entry_enable_preview');

		//text
		$this->setDataLang('text_general');
		$this->setDataLang('text_category_page');
		$this->setDataLang('text_product_page');
		$this->setDataLang('text_hide_from_list_view');
		$this->setDataLang('text_hide_items');
		$this->setDataLang('text_hide_series');
		$this->setDataLang('text_hide_none');
		$this->setDataLang('text_show_thumbnails');
		$this->setDataLang('text_thumbnail_hover_effect');
		$this->setDataLang('text_rollover');
		$this->setDataLang('text_preview');
		$this->setDataLang('text_no_effect');
		$this->setDataLang('text_enable_preview');
		$this->setDataLang('text_list_preview_size');
		$this->setDataLang('text_yes');
		$this->setDataLang('text_no');

		//data
		$this->setData('pds_allow_buying_series', 0);
		$this->setData('pds_hide_from_list_view', 'items');

		$this->setData('pds_show_thumbnails', 1);
		$this->setData('pds_list_thumbnail_width', 500);
		$this->setData('pds_list_thumbnail_height', 500);
		$this->setData('pds_thumbnail_hover_effect', 'rollover');
		$this->setData('pds_list_preview_width', 500);
		$this->setData('pds_list_preview_height', 500);

		$this->setData('pds_detail_thumbnail_width', 500);
		$this->setData('pds_detail_thumbnail_height', 500);
		$this->setData('pds_preview_width', 500);
		$this->setData('pds_preview_height', 500);
		$this->setData('pds_enable_preview', 1);

		//END

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/pds')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function install()
	{
		$prefix = DB_PREFIX;
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}special_attribute_group`
(
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	`special_attribute_group_name` varchar(100) NOT NULL DEFAULT '',
	`special_attribute_group_description` varchar(4000) NOT NULL DEFAULT '',
	PRIMARY KEY (`special_attribute_group_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
INSERT INTO `{$prefix}special_attribute_group` VALUES('2', 'Image', 'Product image');

EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}special_attribute`
(
	`special_attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	`special_attribute_name` varchar(100) NOT NULL DEFAULT '',
	`special_attribute_value` varchar(2000) NOT NULL DEFAULT '',
	PRIMARY KEY (`special_attribute_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}product_master`
(
	`master_product_id` int(10) NOT NULL,
	`product_id` int(10) unsigned NOT NULL,
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	PRIMARY KEY (`master_product_id`, `product_id`, `special_attribute_group_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}product_special_attribute`
(
	`product_special_attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`product_id` int(10) unsigned NOT NULL,
	`special_attribute_id` int(10) NOT NULL,
	PRIMARY KEY (`product_special_attribute_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE INDEX `product_id`
ON `{$prefix}product_master`(`product_id`);
EOF;
		$this->db->query($sql);
	}

	public function uninstall()
	{
		$prefix = DB_PREFIX;
		$sql =
<<<EOF
DROP TABLE IF EXISTS `{$prefix}special_attribute_group`;
DROP TABLE IF EXISTS `{$prefix}special_attribute`;
DROP TABLE IF EXISTS `{$prefix}product_master`;
DROP TABLE IF EXISTS `{$prefix}product_special_attribute`;
EOF;
		$this->db->query($sql);
	}
}
?>
