<?php  
class ControllerModuleRecommend extends Controller {
	protected function index($setting) {

		$this->language->load('module/recommend');

      	$this->data['heading_title'] = $this->language->get('heading_title');
      	
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		//$this->data['code'] = html_entity_decode($this->config->get('recommend_code'));
		$cartproducts = $this->cart->getProducts();
		
		$this->load->model('tool/image');
		
		$this->load->model('catalog/product');
		
		$limit = 0;

		/* BOF: SAME RELATED PRODUCTS FIX */
		$skipProductIDs = array();
		foreach($cartproducts as $cp) $skipProductIDs[] = $cp['product_id'];
		/* EOF: SAME RELATED PRODUCTS FIX */
		
		foreach ($cartproducts as $cartproduct)
			{
					
			$results = $this->model_catalog_product->getProductRelated($cartproduct['product_id']);
			if (isset($setting['limitpprod'])) {$results = array_splice($results, 0, $setting['limitpprod']);}
								
			foreach ($results as $result) {
				/* BOF: SAME RELATED PRODUCTS FIX */
				if (in_array($result['product_id'], $skipProductIDs)) continue;
				$skipProductIDs[] = $result['product_id'];
				/* EOF: SAME RELATED PRODUCTS FIX */
				

				$limit++;

				if ($limit <= $setting['limit'])
				{
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
					} else {
						$image = false;
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
							
					if ((float)$result['special'] && (float)$result['special'] < (float)$result['price']){ 
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
					
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}
					
					$attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);
					
					$this->data['products'][] = array(
						'product_id' => $result['product_id'],
						'thumb'   	 => $image,
						'name'    	 => $result['name'],
						'price'   	 => $price,
						'attribute_groups'  => $attribute_groups,
						'special' 	 => $special,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					);
				}
				}
			}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/recommend.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/recommend.tpl';
		} else {
			$this->template = 'default/template/module/recommend.tpl';
		}

		$this->render();
	}
}
?>