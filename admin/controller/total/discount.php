<?php

class ControllerTotalDiscount extends Controller
{

    private $error = array();

    public function index()
    {
        $this->load->language('total/discount');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
        {
            $this->model_setting_setting->editSetting('discount', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_edit'] = $this->language->get('text_edit');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['entry_from_summ'] = $this->language->get('entry_from_summ');
        $this->data['entry_to_summ'] = $this->language->get('entry_to_summ');
        $this->data['entry_discount_value'] = $this->language->get('entry_discount_value');
        $this->data['entry_discount_type'] = $this->language->get('entry_discount_type');
        $this->data['entry_discount_type_precent'] = $this->language->get('entry_discount_type_precent');
        $this->data['entry_discount_type_fixed_summ'] = $this->language->get('entry_discount_type_fixed_summ');
        $this->data['entry_delete_discount'] = $this->language->get('entry_delete_discount');
        $this->data['entry_incentive_program'] = $this->language->get('entry_incentive_program');
        $this->data['entry_incentive_program_accamulation'] = $this->language->get('entry_incentive_program_accamulation');
        $this->data['entry_incentive_program_summ_current_order'] = $this->language->get('entry_incentive_program_summ_current_order');
        $this->data['entry_exclude_ids'] = $this->language->get('entry_exclude_ids');
        $this->data['entry_exclude_promotional_items'] = $this->language->get('entry_exclude_promotional_items');
         
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning']))
        {
            $this->data['error_warning'] = $this->error['warning'];
        } else
        {
            $this->data['error_warning'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_total'),
            'href' => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('total/discount', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('total/discount', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');


        if (isset($this->request->post['discount_status']))
            $this->data['discount_status'] = $this->request->post['discount_status'];
        else
            $this->data['discount_status'] = $this->config->get('discount_status');

        if (isset($this->request->post['discount_sort_order']))
            $this->data['discount_sort_order'] = $this->request->post['discount_sort_order'];
        else
            $this->data['discount_sort_order'] = $this->config->get('discount_sort_order');

        if (isset($this->request->post['discount_value']))
            $this->data['discount_value'] = $this->request->post['discount_value'];
        else
            $this->data['discount_value'] = $this->config->get('discount_value');

        if (isset($this->request->post['discount_from_summ']))
            $this->data['discount_from_summ'] = $this->request->post['discount_from_summ'];
        else
            $this->data['discount_from_summ'] = $this->config->get('discount_from_summ');

        if (isset($this->request->post['discount_to_summ']))
            $this->data['discount_to_summ'] = $this->request->post['discount_to_summ'];
        else
            $this->data['discount_to_summ'] = $this->config->get('discount_to_summ');

        if (isset($this->request->post['discount_value']))
            $this->data['discount_value'] = $this->request->post['discount_value'];
        else
            $this->data['discount_value'] = $this->config->get('discount_value');

        if (isset($this->request->post['discount_type']))
            $this->data['discount_type'] = $this->request->post['discount_type'];
        else
            $this->data['discount_type'] = $this->config->get('discount_type');

        if (isset($this->request->post['discount_incentive_program']))
            $this->data['discount_incentive_program'] = $this->request->post['discount_incentive_program'];
        else
            $this->data['discount_incentive_program'] = $this->config->get('discount_incentive_program');

        if (isset($this->request->post['discount_exclude_ids']))
             $this->data['discount_exclude_ids'] = $this->request->post['discount_exclude_ids'];
        else
             $this->data['discount_exclude_ids'] = $this->config->get('discount_exclude_ids');
        
        if (isset($this->request->post['discount_promotional_items']))
            $this->data['discount_promotional_items'] = $this->request->post['discount_promotional_items'];
        else
            $this->data['discount_promotional_items'] = $this->config->get('discount_promotional_items');
        
        $this->children = array(
            'common/header',
            'common/footer');

        $this->template = 'total/discount.tpl';
        $this->response->setOutput($this->render());
    }

    protected function validate()
    {
        $data = $this->request->post;

        if (!$this->user->hasPermission('modify', 'total/discount'))
            $this->error['warning'] = $this->language->get('error_permission');
        else if (
                !isset($data['discount_to_summ']) ||
                !isset($data['discount_from_summ']) ||
                !isset($data['discount_value']) ||
                !isset($data['discount_type']) ||
                !isset($data['discount_incentive_program'])
        )
            $this->error['warning'] = $this->language->get('error_one_discount');
        else if (
                count($data['discount_from_summ']) != count($data['discount_to_summ']) ||
                count($data['discount_from_summ']) != count($data['discount_value']) ||
                count($data['discount_from_summ']) != count($data['discount_type']) ||
                count($data['discount_from_summ']) != count($data['discount_incentive_program'])
        )
            $this->error['warning'] = $this->language->get('error_field_absence');
        else
        {
            $len = count($data['discount_value']);
            for ($i = 0; $i < $len; $i++)
            {
                if (!(is_numeric($data['discount_to_summ'][$i]) && is_numeric($data['discount_from_summ'][$i]) && is_numeric($data['discount_value'][$i])))
                {
                    $this->error['warning'] = $this->language->get('error_empty_values');
                    break;
                } else if (!($data['discount_incentive_program'][$i] == 'accumulation' || $data['discount_incentive_program'][$i] == 'summ_current_order'))
                {
                    $this->error['warning'] = $this->language->get('error_select_incentive_program');
                    break;
                } else if (!($data['discount_type'][$i] == 'precent' || $data['discount_type'][$i] == 'fixed_summ'))
                {
                    $this->error['warning'] = $this->language->get('error_select_discount_type');
                    break;
                } else if (!($data['discount_to_summ'][$i] > 0 && $data['discount_from_summ'][$i] > 0 && $data['discount_value'][$i] > 0))
                {
                    $this->error['warning'] = $this->language->get('error_zero_values');
                    break;
                } else if ($data['discount_value'][$i] > 100 && $data['discount_type'][$i] == 'precent')
                {
                    $this->error['warning'] = $this->language->get('error_precent');
                    break;
                } else if ($data['discount_to_summ'][$i] <= $data['discount_from_summ'][$i])
                {
                    $this->error['warning'] = $this->language->get('error_from_>_to');
                    break;
                }
            }
        }



        return !$this->error;
    }

}
