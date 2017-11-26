<?php
/* All rights reserved belong to the module, the module developers http://opencartadmin.com */
// http://opencartadmin.com © 2011-2016 All Rights Reserved
// Distribution, without the author's consent is prohibited
// Commercial license
class ControllerAgooRelatedRelated extends Controller
{
	private $error = array();
	protected  $data;
    private $module_files_related = Array('agootemplates/module/related/products.tpl');

	public function index($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);


        $this->data['related_template'] = 'agoo/latest/latest.tpl';
       	$this->language->load('agoo/related/related');

        $this->load->model('catalog/blog');
        $this->load->model('catalog/record');

		if (isset($this->data['id']))	{
			$this->data['categories'] = $this->model_catalog_blog->getCategories(0);
			if (isset($this->request->post['record_blog'])) {
				$this->data['record_blog'] = $this->request->post['record_blog'];
			} elseif (isset($this->request->get['record_id'])) {
				$this->data['record_blog'] = $this->model_catalog_record->getRecordCategories($this->request->get['record_id']);
			} else {
				$this->data['record_blog'] = array();
			}
			$all_blogs = Array(
				'blog_id' => -1,
				'name' => $this->language->get('text_all_blogs'),
				'status' => 1,
				'sort_order' => -1
			);
			array_unshift($this->data['categories'], $all_blogs);
		}

        if (!isset($this->data['id'])) {
         $this->data['id'] = false;
        }
		if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['anchor'])) {
			$this->data['ascp_widgets'][$this->data['id']]['anchor'] = '';
		}



		$this->data['positions'] = array(
		'content_top' => $this->language->get('entry_position_content_top') ,
		'content_bottom' => $this->language->get('entry_position_content_bottom'),
		'column_left' => $this->language->get('entry_position_column_left'),
		'column_right' => $this->language->get('entry_position_column_right'),
		'header' => $this->language->get('entry_position_header'),
		'footer' => $this->language->get('entry_position_footer')
		);


		$this->data['block_records_width_templates'] = array(
		$this->language->get('entry_block_records_width_templates_2') => '49%',
		$this->language->get('entry_block_records_width_templates_3') => '32%',
		$this->language->get('entry_block_records_width_templates_4') => '24%',
		$this->language->get('entry_block_records_width_templates_5') => '19%',
		$this->language->get('entry_value_templates_clear') => ""
		);

if (SC_VERSION > 15) {
$this->data['ascp_widgets'][$this->data['id']]['anchor_templates'] = array(

$this->language->get('entry_anchor_templates_menu') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#menu ul:first').append(data);",

$this->language->get('entry_anchor_templates_menu_1') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#menu ul:first > li:nth-child(1)').after(data);",

$this->language->get('entry_anchor_templates_tab') =><<<EOF
$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('.nav-tabs').append ('<li><a data-toggle=\'tab\' href=\'#tab-html-'+cmswidget+'\'>'+heading_title+' ('+total+')'+'</a></li>');
$('.tab-content:first').append($(data).html());
EOF
,

$this->language->get('entry_anchor_templates_footer') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, li, a').removeClass();
data = $(data).html();
$('footer .row ul:first').append(data);",

$this->language->get('entry_anchor_templates_footer_1') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, li, a').removeClass();
data = $(data).html();
$('footer .row > div:nth-child(2) > ul:first > li:nth-child(2)').after(data);",

$this->language->get('entry_anchor_templates_sitemap') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, ul, li, a').removeClass();
data = $(data).html();
$('#content > .row > div:nth-child(2) > ul').append(data);",

$this->language->get('entry_anchor_templates_html') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').html(data);",

$this->language->get('entry_anchor_templates_prepend') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').prepend(data);",

$this->language->get('entry_anchor_templates_append') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').append(data);",

$this->language->get('entry_anchor_templates_before') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').before(data);",

$this->language->get('entry_anchor_templates_after') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').after(data);",

$this->language->get('entry_anchor_templates_clear') => ""
);
} else {

$this->data['ascp_widgets'][$this->data['id']]['anchor_templates'] = array(

$this->language->get('entry_anchor_templates_menu') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#menu ul:first').append(data);",

$this->language->get('entry_anchor_templates_menu_1') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#menu ul:first > li:nth-child(1)').after(data);",

$this->language->get('entry_anchor_templates_tab') =><<<EOF
$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#tabs').append ('<a href=\'#tab-html-'+cmswidget+'\'>'+heading_title+' ('+total+')'+'</a>');
$('#tab-description').after(data);
$('#tabs a').each(function() {
   var obj = $(this);
   $(obj.attr('href')).hide();
   $(obj).unbind( 'click' );
});
$('#tabs a').tabs();
EOF
,

$this->language->get('entry_anchor_templates_footer') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, li, a').removeClass();
data = $(data).html();
$('#footer .column ul:first').append(data);",

$this->language->get('entry_anchor_templates_footer_1') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, li, a').removeClass();
data = $(data).html();
$('#footer .column:nth-child(2) > ul:first > li:nth-child(2)').after(data);",

$this->language->get('entry_anchor_templates_sitemap') => "$('#cmswidget-'+cmswidget).remove();
$(data).find('div, ul, li, a').removeClass();
data = $(data).html();
$('.sitemap-info > .right > ul:first').append(data);",

$this->language->get('entry_anchor_templates_html') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').html(data);",

$this->language->get('entry_anchor_templates_prepend') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').prepend(data);",

$this->language->get('entry_anchor_templates_append') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').append(data);",

$this->language->get('entry_anchor_templates_before') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').before(data);",

$this->language->get('entry_anchor_templates_after') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').after(data);",

$this->language->get('entry_anchor_templates_clear') => ""
);


}

if (SC_VERSION > 15) {
$this->data['ascp_widgets'][$this->data['id']]['box_begin_templates'] = array(

$this->language->get('entry_box_begin_templates_tab') => '<div id="tab-html-{CMSWIDGET}" class="tab-pane">
	<div class="box" style="display: block">
		<div class="box-content bordernone">
',
$this->language->get('entry_box_begin_templates_empty') => '<div>',
$this->language->get('entry_anchor_templates_clear') => ""
);
} else {

$this->data['ascp_widgets'][$this->data['id']]['box_begin_templates'] = array(
$this->language->get('entry_box_begin_templates_tab') => '<div id="tab-html-{CMSWIDGET}" class="tab-content">
	<div class="box" style="display: block">
		<div class="box-content bordernone">
',
$this->language->get('entry_box_begin_templates_empty') => '<div>',
$this->language->get('entry_anchor_templates_clear') => ""
);

}


if (SC_VERSION > 15) {
$this->data['ascp_widgets'][$this->data['id']]['box_end_templates'] = array(
$this->language->get('entry_box_end_templates_tab') => '		</div>
	</div>
</div>',
$this->language->get('entry_box_end_templates_empty') => '</div>',
$this->language->get('entry_anchor_templates_clear') => ""
);
} else {

$this->data['ascp_widgets'][$this->data['id']]['box_end_templates'] = array(
$this->language->get('entry_box_end_templates_tab') => '		</div>
	</div>
</div>',
$this->language->get('entry_box_end_templates_empty') => '</div>',
$this->language->get('entry_anchor_templates_clear') => ""
);

}


        return $this->data;
	}

	public function settings($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);

       	$this->language->load('agoo/related/related');

		$this->data['header'] 	= '';
		$this->data['menu'] 	= '';
		$this->data['footer'] 	= '';
		$this->data['column_left'] 	= '';

		$this->template = 'agoo/related/settings.tpl';
        $this->data['language'] = $this->language;

		if (!isset($this->data['ascp_settings']['related_widget_status'])) {
			$this->data['ascp_settings']['related_widget_status'] = true;
		}

        if (SC_VERSION < 20) {
			$html = $this->render();
		} else {
			$html = $this->load->view($this->template, $this->data);
		}

        $this->data['widgets']['related']['code'] = 'related';
        $this->data['widgets']['related']['name'] = $this->language->get('text_widget_related_settings');
        $this->data['widgets']['related']['order'] = $this->language->get('order_related');
        $this->data['widgets']['related']['html'] = $html;

	    return $this->data;

	}

	public function adapter_button($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);

       	$this->language->load('agoo/related/related');

		foreach ($this->data['adapter'] as $id => $adapter) {

			$action               = array(
				'text' => $this->language->get('text_adapter_edit'),
				'href' => $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $adapter['adapter_name'].'&widget=related' , 'SSL')
			);
			$this->data['adapter'][$id]['action'][] = $action;
		}

	    return $this->data;
	}

	public function adapter_form($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);
       	$this->language->load('agoo/related/related');

        if (isset($this->request->get['widget']) && $this->request->get['widget']=='related') {
        	$this->data = $this->run($this->data);
        }

	    return $this->data;
	}

	public function adapter_update($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);
       	$this->language->load('agoo/related/related');

		if (isset($this->request->get['widget']) && $this->request->get['widget']=='related' && $this->validate()) {
			if ($this->editTheme($this->request->get['adapter_theme'], $this->request->post)) {
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->session->data['error_warning'] = $this->language->get('text_error_warning');
			}
		}

	    return $this->data;
	}

   	public function loaddata($data)
	{
		$this->data = $data;

		if (isset($this->request->get['adapter_theme']) && $this->request->get['adapter_theme']!='' && $this->validate()) {
			$this->data['theme'] = $this->request->get['adapter_theme'];
		}

		if (isset($this->request->get['ajax_action']) && $this->request->get['ajax_action']=='template_delete' && $this->data['theme'] != 'default' && $this->validate()) {
			if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/agootemplates/module/related/products.tpl')) {
            	unlink (DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/agootemplates/module/related/products.tpl');
			}
		}

		if (isset($this->request->post['sample_template']) && $this->request->post['sample_template']!='' && $this->validate()) {
			$this->data['sample_template'] = $this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = $this->request->post['sample_template'];
		} else {
        	//$this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'product/product.tpl';
        	$this->data['sample_template'] = $this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'module/latest.tpl';
        }

        if (isset($this->request->get['ajax_action']) && $this->request->get['ajax_action']=='template_new' && $this->validate() &&
         	file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/agootemplates/module/related/products.tpl')
        ) {
	        $this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'agootemplates/module/related/products.tpl';
        } else {
			if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/agootemplates/module/related/products.tpl')) {
				if ((!isset($this->request->get['ajax_action'])) || (isset($this->request->get['ajax_action']) && (($this->request->get['ajax_action']!='template_full') && $this->request->get['ajax_action']!='template'))) {
					$this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'agootemplates/module/related/products.tpl';
				}
			}
        }

		$this->data['file_theme']                      = $this->data['file_theme'][$this->data['theme']];

		$this->data['replace_main_name']               = '';

		if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme'])) {
			$success_file = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme'];
			$success      = $this->data['success_data'] = file_get_contents($success_file);
		} else {
			if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme_out'])) {
				$success_file = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme_out'];
				$success      = $this->data['success_data'] = file_get_contents($success_file);
			} else {
				if (file_exists(DIR_CATALOG . 'view/theme/default/template/' . $this->data['file_theme_out'])) {
					$this->data['theme']  = 'default';
					$success_file = DIR_CATALOG . 'view/theme/default/template/' . $this->data['file_theme_out'];
					$success      = $this->data['success_data'] = file_get_contents($success_file);
				}
			}
		}

        if (isset($this->request->get['ajax_action']) && ($this->request->get['ajax_action']=='template_full' || $this->request->get['ajax_action']=='template_new') ) {

        } else {

	        if (isset($this->request->get['ajax_action']) && ($this->request->get['ajax_action']=='template') ) {

				if (strpos($success, '($products)') !== false) {
					$pattern = "/[\<][\?]php\x20{1,}if\x20{1,}[\(][\$]products[\)]\x20{1,}[\{]\x20{1,}[\?][\>].*?[\<][\?]php\x20{1,}[\}]\x20{1,}[\?][\>]/Usiu";
					preg_match_all($pattern, $success, $matches);

			        $pattern = "/[\<][\?]php\x20{1,}if\x20{1,}[\(][\$]tags[\)]\x20{1,}[\{]\x20{1,}[\?][\>].*?[\<][\?]php\x20{1,}[\}]\x20{1,}[\?][\>]/Usiu";
					preg_match_all($pattern, $matches[0][0], $matches_new);

			        if (isset($matches_new[0][0]) && isset($matches[0][0])) {
				        $success = str_replace($matches_new[0][0], '',$matches[0][0]);
			        } else {
		            	$success = $matches[0][0];
			        }
                } else {
					if (strpos($success, 'foreach ($products as $product)') !== false) {
						$pattern = "/[\<][\?]php\x20{1,}foreach\x20{1,}[\(][\$]products\x20{1,}as\x20{1,}[\$]product[\)]\x20{1,}[\{]\x20{1,}[\?][\>].*?[\<][\?]php\x20{1,}[\}]\x20{1,}[\?][\>]/Usiu";
						preg_match_all($pattern, $success, $matches);
						$success = $matches[0][0];
					}
                }

		        $this->data['success_data'] = $success;
	         }



        }


		$this->data['success_data'] = preg_replace('/ {2,}/', ' ', $this->data['success_data']);
		$this->data['success_data'] = preg_replace('~(?:\r?\n){2,}~', "\n\r", $this->data['success_data']);

		$healthy  = array(
					"<div",
					"/div>",
					"\t"

		);

		$yummy    = array(
					"\r\n<div",
					"/div>\r\n",
					""
		);

		$this->data['success_data'] = str_replace($healthy, $yummy, $this->data['success_data']);

		if (isset($this->request->post['replace_code'])) {
				$this->data['replace_code'] = $this->request->post['replace_code'];
		} else {
				//$this->data['replace_code'][0]['in'] = '';
				//$this->data['replace_code'][0]['out'] = '';
		}


		if (isset($this->request->get['ajax_action']) && $this->request->get['ajax_action']!='' && $this->validate()) {
			return htmlspecialchars($this->data['success_data']);
		}

		return $this->data;
	}



   	public function run($data)
	{
        $time_start = microtime(true);

        $this->data = $this->loadData($data);

		$time_end                                 = microtime(true);
		$time                                     = $time_end - $time_start;
		$this->data['time']                       = sprintf("%05.5f sec.", $time);

        $this->data['template']          = 'agoo/related/adapter_form.tpl';

		$this->data['load_template'] 		= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=related&ajax_action=template', 'SSL');
		$this->data['load_template_full'] 	= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=related&ajax_action=template_full', 'SSL');
        $this->data['load_template_new'] 	= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=related&ajax_action=template_new', 'SSL');
        $this->data['load_template_delete'] 	= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=related&ajax_action=template_delete', 'SSL');

		if (isset($this->request->get['adapter_theme'])) {
			$this->data['action'] = $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=related', 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_id=' . $this->request->get['adapter_id'] . $url.'&widget=related', 'SSL');
		}

		return $this->data;
	}

	public function editTheme($adapter_theme, $post)
	{
		if (!$this->validate()) {
			return;
		}

		if (isset($post['success_file']) && $post['success_file'] != '')
			$success_data = html_entity_decode(htmlspecialchars_decode($post['success_file']), ENT_QUOTES, 'UTF-8');
		else
			$success_data = '';

		$this->data['html']  = $success_data;
		$this->data['theme'] = $adapter_theme;
		return $this->saveTheme($this->data);
	}

	private function saveTheme($data)
	{
		if (!$this->validate()) {
			return $data;
		}
        $save_flag = true;
		$this->data = $data;
		$this->load->library('parser/simple_html_dom');
		$save_flag = false;
		foreach ($this->module_files_related as $module_file) {
			$module_file_content = DIR_CATALOG . 'view/theme/default/template/' . $module_file;


			$path = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $module_file;
			if (mkdirs($path)) {
				file_put_contents($path, $this->data['html']);
			} else {
				$save_flag = false;
			}

			unset($html);
		}
		return $save_flag;
	}



	private function table_exists($tableName)
	{
		$found= false;
		$like   = addcslashes($tableName, '%_\\');
		$result = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape($like) . "';");
		$found  = $result->num_rows > 0;
		return $found;
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}



}
