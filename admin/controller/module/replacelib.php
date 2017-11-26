<?php
class ControllerModuleReplacelib extends Controller {
       
       public function index() {
	    
        $this->load->model('module/replacelib');
        $this->language->load('module/replacelib');

        $this->data['breadcrumbs'] = array();
        $url='';
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/replacelib', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
        $this->data['heading_title'] = $this->language->get('heading_title');		
        $this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$this->data['plugin_description'] = $this->language->get('plugin_description');
		$this->data['plugin_description1'] = $this->language->get('plugin_description1');
		$this->data['plugin_description2'] = $this->language->get('plugin_description2');
		
		if (isset($this->error['warning']))
		{
			$this->data['error_warning'] = $this->error['warning'];
		} 
		else 
		{
			$this->data['error_warning'] = '';
		}
      
       $this->data['action'] = $this->url->link('module/replacelib/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');	
       $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
       	   
	   $this->data['modules'] = array();
		
		/*************************** code to find file *********************************/	  
        
		$dir    = '../catalog/view/javascript';
		
		$this->data['jquery_js']=array();
		
	   $this->data['jquery_js']=$this->files($dir);
	 
		     
	    $this->template = 'module/replacelib.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());

       }

       public function insert() {
	    $this->language->load('module/replacelib');
       $this->load->model('module/replacelib');
       if ($this->request->server['REQUEST_METHOD'] == 'POST')
	        { 
          $this->model_module_replacelib->addurl($this->request->post);
		  
		  $this->session->data['success'] = $this->language->get('text_success');
		  
		  $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		  
		  
		  
	    	}  
		}
		
	
	    public function files($path,&$files = array())
       {
	   
	   $js_list=array('jquery\-','jquery\-ui\-','mootools\-');
	   
		$dir = opendir($path."/.");
        while($item = readdir($dir))
         if(is_file($sub = $path."/".$item))
		   {
		      foreach($js_list as $js_file)
			  {
			   if(preg_match("|$js_file.*?\d+\.\d+\.\d+.*?\.js|",$item,$new_item))
		      {
            $files[] =preg_replace('|\.\./|','',$path."/".$item);
			  }
			  }
			}
			else
            if($item != "." and $item != "..")
            $this->files($sub,$files); 
            return(array_unique($files));
       }




}
?>
