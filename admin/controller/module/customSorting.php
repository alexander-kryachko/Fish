<?php
class ControllerModuleCustomSorting extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/customSorting');

        $this->document->setTitle(strip_tags($this->language->get('heading_title')));
        $this->load->model('module/customSorting');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            if(!empty($_FILES)){
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/admin/uploads/'.date("d-m-Y--H-i-s", time())."/";

                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777);
                }
                $fileTypes = array('xls', 'csv', 'xlsx');

                $tempFile = $_FILES['sortingFile']['tmp_name'];
                $fileParts = pathinfo($_FILES['sortingFile']['name']);

                $targetFile = $uploadDir . uniqid() . '.' . $fileParts['extension'];

                if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                    var_dump($fileParts['extension']);
                    move_uploaded_file($tempFile, $targetFile);
                    $res = $this->readExcel($targetFile);


                    if(is_array($res)){
                        $res_length = count($res);
                        /*echo "<pre>";
                        var_dump($res);
                        echo "</pre>";*/
                        $sorting_out = array();
                        for($i = 0; $i < $res_length; $i++){
                            if($i > 0){
                                if($res[$i][0] != 0 && $res[$i][0] != ''){
                                    $sorting_out[] = array(
                                        'product_id' => $res[$i][0],
                                        'order' => ((int)$res[$i][6])*-1,
                                    );
                                }
                            }
                        }
                        $this->model_module_customSorting->editProductSorting($sorting_out);
                        $this->session->data['success'] = $this->language->get('text_success');

                        $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
                    }else{
                        $this->error['warning'] = $this->language->get('not_reading');
                    }
                } else {
                    $this->error['warning'] = $this->language->get('error_type');
                }
            }





        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_add_file'] = $this->language->get('text_add_file');


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
            'href'      => $this->url->link('module/customSorting', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/customSorting', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');



        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->template = 'module/customSorting.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }


    private function readExcel($filepath){
        require_once $_SERVER['DOCUMENT_ROOT']."/system/library/excel/PHPExcel.php";
/*        $pExcel = new PHPExcel();
        $pExcel->setActiveSheetIndex(0);
        $aSheet = $pExcel->getActiveSheet();*/
        $ar=array();
        $inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
        $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
        $objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект


        $ar = $objPHPExcel->getActiveSheet()->toArray();

        return $ar;
    }


    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/customSorting')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }



}
?>