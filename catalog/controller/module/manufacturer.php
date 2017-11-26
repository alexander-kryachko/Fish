<?php  
class ControllerModuleManufacturer extends Controller {
	protected function index($setting) {
	

		$this->language->load('module/manufacturer');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_hide'] = $this->language->get('text_hide');
		$this->data['text_showall'] = $this->language->get('text_showall');
		
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$this->data['manufacturer_id'] = $parts[0];
		} else {
			$this->data['manufacturer_id'] = 0;
		}
		
		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}
							
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		
		if (isset($setting['image_width'])) {
			$this->data['width'] = $setting['image_width'];
		} else {
			$this->data['width'] = 80; 
			}
			
		if (isset($setting['image_height'])) {
			$this->data['height'] = $setting['image_height'];
		} else {
			$this->data['height'] = 80; 
			}
	
		if (isset($setting['container_width'])) {
			$this->data['container_width'] = $setting['container_width'];
		} else {
			$this->data['container_width'] = 145; 
			}	

	
			
		if ($this->config->get('manufacturers')) {
				$activemanufacturers = $this->config->get('manufacturers');
				
			} else {
				$activemanufacturers = array();
			}
		
				
		$manufactureres = $this->model_catalog_manufacturer->getManufacturers(0);
		
	
			
	
	
		foreach($manufactureres as $manufacturer) {
		
		
		if ($manufacturer['image']) {
				$image = $this->model_tool_image->resize($manufacturer['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = 'no_image.jpg';
			}
		
		
			$this->data['manufactureres'][] = array(
				'manufacturer_id' => $manufacturer['manufacturer_id'],
				'name'        => $manufacturer['name'] ,
				'href'        => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']),
				'thumb'       => $image,
				'active' 	  => in_array($manufacturer['manufacturer_id'], $activemanufacturers) ? 1 : 0
			
			);
		}
		
		
		
		if ((count($this->data['manufactureres'])) == (count($activemanufacturers))) {
		  $this->data['show_button'] = false;
		} else {
		  $this->data['show_button'] = true;	
		}

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/manufacturer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/manufacturer.tpl';
		} else {
			$this->template = 'default/template/module/manufacturer.tpl';
		}
		
		$this->render();
  	}
}
?>