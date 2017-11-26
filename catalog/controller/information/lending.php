<?php
class ControllerInformationLending extends Controller {
    private $error = array();

    public function index() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->redirect($this->url->link('common/home'));
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }

        $this->data['action'] = $this->url->link('information/lending');

        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } else {
            $this->data['name'] = '';
        }

        if (isset($this->request->post['email'])) {
            $this->data['email'] = $this->request->post['email'];
        } else {
            $this->data['email'] = '';
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/lending.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/information/lending.tpl';
        } else {
            $this->template = 'default/template/information/lending.tpl';
        }

        $this->response->setOutput($this->render());
    }

    protected function validate() {
        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!$this->ocstore->validate($this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
?>
