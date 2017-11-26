<?php
class ModelCatalogProduct extends Model {
    //Заменим NOW() в SQL-запросах на строку с текущим временем, но с 00 вместо секунд.
    //Тем самым мы включаем кэширование SQL-запросов на уровне сервера MySQL.
    //MySQL прекрасно кэширует запросы. Время жизни кэша - 1 минута.
    private $NOW;
	
	const CACHELIFE = 180;

    public function __construct($registry) {
        $this->NOW = date('Y-m-d') . ' 00:00:00';
        parent::__construct($registry);
    }

    private $FOUND_ROWS;

    public function getFoundProducts() {
        return $this->FOUND_ROWS;
    }

    public function updateViewed($product_id) {
        //$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = viewed + 1 WHERE product_id = " . (int)$product_id . " LIMIT 1");
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1), date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");
    }

    public function getProduct($product_id, $opts = false){
		if (!$opts) $opts = array();

		if (in_array('promotions', $opts)){
			$this->load->model('catalog/promotion'); //promotions
		}
		
		$this->load->model('catalog/product_status'); //pr. statuses
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, 
			(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
			(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
			(SELECT date_end FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_end, 
			(SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");		
				
        if ($query->num_rows){
		
			$promotions = false;

			if (in_array('promotions', $opts)){
				$start = microtime(true);
				//$promotions = $this->model_catalog_promotion->getHTMLProductPromotions($product_id);
				$promotions = $this->getHTMLProductPromotions($product_id);
				//echo number_format(microtime(true) - $start, 6, '.', '').' s.<br />';
				//print_r($promotions);
				//echo '<hr />';
				//die();
			}

            return array(
				'statuses' 		   => $this->model_catalog_product_status->getHTMLProductStatuses($query->row['product_id']), //pr.statuses
                'seo_title'        => $query->row['seo_title'],
                'seo_h1'           => $query->row['seo_h1'],
				'promotions'       => $promotions,
                'product_id'       => $query->row['product_id'],
                'name'             => $query->row['name'],
                'description'      => $query->row['description'],
                'meta_description' => $query->row['meta_description'],
                'meta_keyword'     => $query->row['meta_keyword'],
                'tag'              => $query->row['tag'],
                'model'            => $query->row['model'],
                'sku'              => $query->row['sku'],
                'upc'              => $query->row['upc'],
                'ean'              => $query->row['ean'],
                'jan'              => $query->row['jan'],
                'isbn'             => $query->row['isbn'],
                'mpn'              => $query->row['mpn'],
                'location'         => $query->row['location'],
                'quantity'         => $query->row['quantity'],
                'stock_status'     => $query->row['stock_status'],
                'image'            => $query->row['image'],
                'manufacturer_id'  => $query->row['manufacturer_id'],
                'manufacturer'     => $query->row['manufacturer'],
                'price'            => ($query->row['discount'] ? ($query->row['special'] && $query->row['special'] < $query->row['price'] ? $query->row['special'] : $query->row['price'])*$query->row['discount']/100 : $query->row['price']),
                'special'          => $query->row['special'],
                'special_date_end' => $query->row['special_date_end'],
                'reward'           => $query->row['reward'],
                'points'           => $query->row['points'],
                'tax_class_id'     => $query->row['tax_class_id'],
                'date_available'   => $query->row['date_available'],
                'weight'           => $query->row['weight'],
                'weight_class_id'  => $query->row['weight_class_id'],
                'length'           => $query->row['length'],
                'width'            => $query->row['width'],
                'height'           => $query->row['height'],
                'length_class_id'  => $query->row['length_class_id'],
                'subtract'         => $query->row['subtract'],
                'rating'           => round($query->row['rating']),
                'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
                'minimum'          => $query->row['minimum'],
                'sort_order'       => $query->row['sort_order'],
                'status'           => $query->row['status'],
                'date_added'       => $query->row['date_added'],
                'date_modified'    => $query->row['date_modified'],
                'viewed'           => $query->row['viewed']
            );
        } else {
            return false;
        }
    }
	
	public function getHTMLPopupPromotions($promotion_id){
		$lang_id = (int)$this->config->get('config_language_id');
		$query = $this->db->query('SELECT * FROM '.DB_PREFIX.'promotion WHERE promotion_id = '.$promotion_id.' AND language_id = '.$lang_id.' LIMIT 1');
		if (!$query->num_rows) return false;
        $q2 = $this->db->query("SELECT pd.name AS name, p.image
			FROM " . DB_PREFIX . "product p 
			LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
			LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			WHERE p.product_id = '" . (int)$query->row['gift_id'] . "' AND pd.language_id = '" . $lang_id . "' AND p.status = 1 AND p.date_available <= '" . date('Y-m-d H:i:s'). "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
		if (!$q2->num_rows) return false;
		
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }
		
		
		$this->load->model('tool/image');
		$image = !empty($query->row['image']) ? $query->row['image'] : (!empty($q2->row['image']) ? $q2->row['image'] : '');
		
		
		$qp = $this->db->query('SELECT product_id FROM '.DB_PREFIX.'product_promotion WHERE promotion_id = '.$promotion_id.' AND language_id = '.$lang_id);
		if (!$qp->num_rows) return false;
		$ids = array();
		foreach ($qp->rows as $row) $ids[] = $row['product_id'];
		
        $qp = $this->db->query("SELECT p.product_id, p.image, p.price, pd.name,
			(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = " . (int)$customer_group_id . " AND pd2.quantity = 1 AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
			(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = " . (int)$customer_group_id . " AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special
			FROM " . DB_PREFIX . "product p 
			LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = ".$lang_id.") 
			LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			WHERE p.product_id IN (".implode(',', $ids).") AND p.status = 1 AND p.date_available <= '" . date('Y-m-d H:i:s'). "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		$products = array();
		foreach($qp->rows as $row){
			$products[] = array(
				'thumb' => $row['image'] ? $this->model_tool_image->resize($row['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height')) : false,
				'href' => $this->url->link('product/product','&product_id=' . $row['product_id']),
				'name' => $row['name'],
                'price' => ($row['discount'] ? $this->currency->format(($row['special'] && $row['special'] < $row['price'] ? $row['special'] : $row['price'])*$row['discount']/100) : $this->currency->format($row['price'])),
				'special' => $row['special'] ? $this->currency->format($row['special']) : false,
			);
		}

		$promotion = array(
			'promotion_id' => $promotion_id,
			'thumb_popup' => !empty($image) ? $this->model_tool_image->resize($image, $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height')) : false,
			'gift' => array('href' => $this->url->link('product/product','&product_id=' . (int)$query->row['gift_id']), 'name' => $q2->row['name']),
			'name' => $query->row['name'],
			'description' => $query->row['description'],
			'products' => $products,
		);
		$promotion_products = 'В акции участвуют:';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/promotion_popup.tpl')) {
			$template = $this->config->get('config_template') . '/template/module/promotion_popup.tpl';
		} else {
			$template = 'default/template/module/promotion_popup.tpl';
		}		
		ob_start();
		require(DIR_TEMPLATE.$template);
		$data = ob_get_contents();
		ob_end_clean();

		return $data;
	}
	
	public function getHTMLProductPromotions($product_id){
		$result = array('product' => false, 'category' => false);

// $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, 
//			(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
//			(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
//			(SELECT date_end FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_end, 
//			(SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");		
				
//        if ($query->num_rows){
//                'seo_title'        => $query->row['seo_title'],
		$lang_id = (int)$this->config->get('config_language_id');
		$query = $this->db->query('SELECT p.promotion_id 
			FROM '.DB_PREFIX.'product_promotion pp
			INNER JOIN '.DB_PREFIX.'promotion p on (p.promotion_id = pp.promotion_id)
			WHERE pp.product_id = '.$product_id.' AND pp.language_id = '.$lang_id.' AND p.status = 1 
			LIMIT 1');
		if (!$query->num_rows) return array('product' => false, 'category' => false);
		$promotion_id = (int)$query->row['promotion_id'];
		$query = $this->db->query('SELECT * FROM '.DB_PREFIX.'promotion WHERE promotion_id = '.$promotion_id.' AND language_id = '.$lang_id.' LIMIT 1');
		if (!$query->num_rows) return array('product' => false, 'category' => false);
		
        $q2 = $this->db->query("SELECT pd.name AS name, p.image
			FROM " . DB_PREFIX . "product p 
			LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
			LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			WHERE p.product_id = '" . (int)$query->row['gift_id'] . "' AND pd.language_id = '" . $lang_id . "' AND p.status = 1 AND p.date_available <= '" . date('Y-m-d H:i:s'). "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
			
		if (!$q2->num_rows) return array('product' => false, 'category' => false);
		//print_r($q2->row);

/*
        $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, 
			(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
			(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
			(SELECT date_end FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_end, 
			(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
*/		


		$this->load->model('tool/image');
		$image = !empty($query->row['image']) ? $query->row['image'] : (!empty($q2->row['image']) ? $q2->row['image'] : '');
		$promotion = array(
			'date_end' => $query->row['date_end'],
			'date_start' => $query->row['date_start'],
			'thumb' => !empty($image) ? $this->model_tool_image->resize($image, $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height')) : false,
			'gift' => array('href' => $this->url->link('product/product','&product_id=' . (int)$query->row['gift_id']), 'name' => $q2->row['name']),
			'name' => $query->row['name']
		);
		//echo '='.$query->row['image'];
		$promotion_valid = 'До конца акции осталось:';
		$promotion_about = 'Подробнее об акции';
		$promotion_counter_language = 'ru';
		$promotion_id;
		$popup = 'popup';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/promotion_product.tpl')) {
			$template = $this->config->get('config_template') . '/template/module/promotion_product.tpl';
		} else {
			$template = 'default/template/module/promotion_product.tpl';
		}		
		//extract($this->data);
		ob_start();
		require(DIR_TEMPLATE.$template);
		$data = ob_get_contents();
		ob_end_clean();
		
		return array('product' => $data, 'category' => false);
	}
	
	public function getFilterBreadcrumbs($product_id, $category_info){
		$category_id = (int)$category_info['category_id'];
		//print_r($category_info);
		// filter_h1 seo_h1
		//die();
		$breadcrumbs = array();

        $query = $this->db->query('SELECT 
				ovtp.value_id, 
				ovtp.option_id,
				ovd.name as `value`
			FROM '.DB_PREFIX.'ocfilter_option_value_to_product ovtp
			INNER JOIN '.DB_PREFIX.'attribute a on (a.attribute_id = ovtp.option_id AND a.breadcrumbs = 1)
			INNER JOIN '.DB_PREFIX.'ocfilter_option o on (o.option_id = ovtp.option_id AND o.status = 1)
			INNER JOIN '.DB_PREFIX.'ocfilter_option_to_category otc on (otc.option_id = ovtp.option_id AND otc.category_id = '.(int)$category_id.' AND otc.enabled = 1)
			INNER JOIN '.DB_PREFIX.'ocfilter_option_value_description ovd on (ovd.value_id = ovtp.value_id)
			WHERE ovtp.product_id = '.(int)$product_id.'
			ORDER BY o.sort_order
			');

		$aliases = $slugs = array();
        foreach ($query->rows as $result) {
			$q = 'ocfilter:'.$result['option_id'].':'.$result['value_id'];
			$aliases[$result['value_id']] = $q;
        }
        $aq = $this->db->query('SELECT query, keyword FROM '.DB_PREFIX.'url_alias WHERE `query` IN ("'.implode('", "', $aliases).'")');
		foreach ($aq->rows as $result){
			$p = explode(':', $result['query']);
			$slugs[$p[2]] = $result['keyword'];
		}
		
		$meta = array();
		$qm = $this->db->query('SELECT option1, h FROM '.DB_PREFIX.'ocfilter_meta WHERE (ISNULL(`option2`) OR `option2` = 0) AND category_id = '.$category_id);
		foreach ($qm->rows as $result){
			$meta[$result['option1']] = $result['h'];
		}

        foreach ($query->rows as $result){
			if (empty($slugs[$result['value_id']])) continue;
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
			$href = $host. strtr(substr($category_info['full_url'], strlen($host)), array('/' => '_'));
			$href .= '_'.$slugs[$result['value_id']];
			if (!empty($meta[$result['value_id']])) $text = $meta[$result['value_id']];
				else $text = strtr($category_info['filter_h1'], array('%f' => $result['value']));
			$breadcrumbs[] = array('href' => $href, 'text' => $text, 'separator' => ' &raquo; ');
        }
		return $breadcrumbs;
	}

    public function getProducts($data = array(), $is_optimized = false) {
	
		//$debug = $_SERVER['REMOTE_ADDR'] == '37.57.71.114' ? true : false;
		$debug = true;
		$debugStr = $_SERVER['REMOTE_ADDR']."\t".date('d.m.y H:i:s')."\t\t";
		$t1 = microtime(true);
	
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

		//cache query
		if (!empty($data['filter_category_id'])){
			$cacheHash = md5(serialize($data));
			$cacheDir = DIR_CACHE.'cache.get_products';
			if (!is_dir($cacheDir)) mkdir($cacheDir);
			$cacheName = $cacheDir.'/cache.get_products.'.$cacheHash.'.'.(int)$customer_group_id;
			if (is_file($cacheName) && (filemtime($cacheName) > time() - self::CACHELIFE)){
				$tmp = unserialize(file_get_contents($cacheName));
				$this->FOUND_ROWS = $tmp['FOUND_ROWS'];
				$product_data = $tmp['product_data'];
				
				$t2 = microtime(true);
				$debugStr .= number_format($t2-$t1, 2, '.', '')."\tcached\t"; // 1
				$debugStr .= $_SERVER['REQUEST_URI'].PHP_EOL;
				if ($debug) file_put_contents('slowlog-model.txt', $debugStr, FILE_APPEND);
				return $product_data;
			}
		}

		$sql = "SELECT SQL_CALC_FOUND_ROWS 
			p.product_id, p.sku, 
			(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) 
				AS rating, 
			(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) 
				AS discount, 
			(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) 
				AS special";
        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
            } else {
                $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
            }

            if (!empty($data['filter_filter'])) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
            } else {
                $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
            }
        } else {
            $sql .= " FROM " . DB_PREFIX . "product p";
        }

        $sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_master pm "
            . " ON pm.product_id = p.product_id "
            . " WHERE (pm.master_product_id = -1 "; //do not change

		$pds_hide_from_list_view = $this->config->get('pds_hide_from_list_view') ? $this->config->get('pds_hide_from_list_view') : 'items';
		if($pds_hide_from_list_view == 'series'){
			$sql .= " OR pm.master_product_id > 0 "; //= 0: master, > 0: slave
		} elseif($pds_hide_from_list_view == 'none') {
			$sql .= " OR pm.master_product_id >= 0 ";
		} else {
			$sql .= " OR pm.master_product_id = 0 ";
		}

		$sql .= " OR pm.master_product_id IS NULL) AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
            } else {
                $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
            }

            if (!empty($data['filter_filter'])) {
                $implode = array();

                $filters = explode(',', $data['filter_filter']);

                foreach ($filters as $filter_id) {
                    $implode[] = (int)$filter_id;
                }

                $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
            }
        }

        if (!empty($data['filter'])) {
            $sql .= " AND p.product_id IN (" . $data['filter'] . ")";
        }

        if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
            $sql .= " AND (";

            if (!empty($data['filter_name'])) {
                $implode = array();

                $words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

                foreach ($words as $word) {
                    $implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
                }

                if ($implode) {
                    $sql .= " " . implode(" AND ", $implode) . "";
                }

                if (!empty($data['filter_description'])) {
                    $sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                }
            }

            if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
                $sql .= " OR ";
            }

            if (!empty($data['filter_tag'])) {
                $sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            $sql .= ")";
        }

		$t11 = microtime(true);
        # OCFilter start
		if (!empty($data['filter_ocfilter'])) {
			if (!$this->registry->has('ocfilter_sql') || null === $this->registry->get('ocfilter_sql')) {
				$this->load->model('catalog/ocfilter');

				$this->model_catalog_ocfilter->getOCFilterData($data, $is_optimized);
			}

			if (!$this->registry->get('ocfilter_sql')) {
				return (__FUNCTION__ == 'getTotalProducts' ? 0 : array());
			}

			$a = str_replace("AND", "AND (", $this->registry->get('ocfilter_sql'));
			//$sql .= $this->registry->get('ocfilter_sql');

			$sql .= $a;
			//die(str_replace('AND p.product_id IN ', '', $this->registry->get('ocfilter_sql')));
			$sql .= " OR p.product_id in (select master_product_id from " . DB_PREFIX . "product_master where product_id in ".str_replace('AND p.product_id IN ', '', $this->registry->get('ocfilter_sql')).")";
			$sql .= ")";

			if ($this->registry->has('ocfilter_sql')) {
				$this->registry->set('ocfilter_sql', null);
			}

		}
		# OCFilter end
		$t2 = microtime(true);
		$debugStr .= number_format($t2-$t1, 2, '.', '')."\t(".number_format($t2-$t11, 2, '.', '').")\t"; // 1
		
		if (!empty($data['filter_manufacturer_id'])) {
            $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
        }

        $sql .= " GROUP BY p.product_id";

        $sort_data = array(
            'pd.name',
            'p.model',
            'p.quantity',
            'p.price',
            'rating',
            'p.sort_order',
			'p.viewed',
            'p.date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
                $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
            } elseif ($data['sort'] == 'p.price') {
                $sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN p.price*discount/100 ELSE p.price END)";
            } else {
                $sql .= " ORDER BY " . $data['sort'];
            }
        } else {
            $sql .= " ORDER BY p.sort_order";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(rating) DESC";
        } else {
            $sql .= " ASC, LCASE(p.viewed) DESC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 50;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
		
        $product_data = $product_data_unsorted = array();
        $query = $this->db->query($sql);
        $num_query = $this->db->query("SELECT FOUND_ROWS() AS `found_rows`");
        $this->FOUND_ROWS = intval($num_query->row['found_rows']);
		
		$t3 = microtime(true);
		$debugStr .= number_format($t3-$t2, 2, '.', '')."\t"; // 2
		
		
        if (!$is_optimized){
			// vanilla version
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
			
			$t4 = microtime(true);
			$debugStr .= number_format($t4-$t3, 2, '.', '')."\tnot optimized\t"; // 2
			
		} else {
			// BOF: optimized version
			$pids = array();
			foreach ($query->rows as $result) $pids[] = (int)$result['product_id'];
			$chunks = array_chunk($pids, 100, true);
			
			$customer_group_id = (int)$this->config->get('config_customer_group_id');
			$language_id = (int)$this->config->get('config_language_id');
			foreach($chunks as $chunk){
				//$values = array();
				//foreach($chunk as $price) $values[] = '('.$pid.', '.$price.')';
				//mysql_query('INSERT INTO '.DB_PREFIX.'product(`product_id`, `price`) VALUES '.implode(',', $values).' ON DUPLICATE KEY UPDATE `price` = VALUES(`price`)');
				
				$queryFix = $this->db->query("SELECT 
					DISTINCT *, 
					pd.name AS name, 
					p.image, 
					m.name AS manufacturer, 
					(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . $customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < '" . $this->NOW . "') AND (pd2.date_end = '0000-00-00' OR pd2.date_end > '" . $this->NOW . "')) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
					(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . $customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
					(SELECT date_end FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . $customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_end, 
					(SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . $customer_group_id . "') AS reward, 
					(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . $language_id . "') AS stock_status, 
					(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . $language_id . "') AS weight_class, 
					(SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . $language_id . "') AS length_class, 
					(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, 
					(SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, 
					p.sort_order 
				FROM " . DB_PREFIX . "product p 
				LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
				LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
				WHERE p.product_id IN (". implode(',', $chunk) .") AND pd.language_id = '" . $language_id . "' 
					AND p.status = 1 AND p.date_available <= '" . $this->NOW . "'"); 
					//  LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
					//  AND p2s.store_id = " . (int)$this->config->get('config_store_id') . "
				//$this->load->model('catalog/product_status'); //pr. statuses
				if ($queryFix->num_rows) foreach ($queryFix->rows as $rowFix){
					$product_data_unsorted[$rowFix['product_id']] = array(
						'seo_title'        => $rowFix['seo_title'],
						'seo_h1'           => $rowFix['seo_h1'],
						'product_id'       => $rowFix['product_id'],
						'name'             => $rowFix['name'],
						'description'      => $rowFix['description'],
						'meta_description' => $rowFix['meta_description'],
						'meta_keyword'     => $rowFix['meta_keyword'],
						'tag'              => $rowFix['tag'],
						'model'            => $rowFix['model'],
						'sku'              => $rowFix['sku'],
						'upc'              => $rowFix['upc'],
						'ean'              => $rowFix['ean'],
						'jan'              => $rowFix['jan'],
						'isbn'             => $rowFix['isbn'],
						'mpn'              => $rowFix['mpn'],
						'location'         => $rowFix['location'],
						'quantity'         => $rowFix['quantity'],
						'stock_status'     => $rowFix['stock_status'],
						'image'            => $rowFix['image'],
						'manufacturer_id'  => $rowFix['manufacturer_id'],
						'manufacturer'     => $rowFix['manufacturer'],
						'price'            => ($rowFix['discount'] ? $rowFix['discount'] : $rowFix['price']),
						'special'          => $rowFix['special'],
						'special_date_end' => $rowFix['special_date_end'],
						'reward'           => $rowFix['reward'],
						'points'           => $rowFix['points'],
						'tax_class_id'     => $rowFix['tax_class_id'],
						'date_available'   => $rowFix['date_available'],
						'weight'           => $rowFix['weight'],
						'weight_class_id'  => $rowFix['weight_class_id'],
						'length'           => $rowFix['length'],
						'width'            => $rowFix['width'],
						'height'           => $rowFix['height'],
						'length_class_id'  => $rowFix['length_class_id'],
						'subtract'         => $rowFix['subtract'],
						'rating'           => round($rowFix['rating']),
						'reviews'          => $rowFix['reviews'] ? $rowFix['reviews'] : 0,
						'minimum'          => $rowFix['minimum'],
						'sort_order'       => $rowFix['sort_order'],
						'status'           => $rowFix['status'],
						'date_added'       => $rowFix['date_added'],
						'date_modified'    => $rowFix['date_modified'],
						'viewed'           => $rowFix['viewed']
					);
				}
			}
			
			if (!empty($product_data_unsorted)){
				foreach($pids as $p) $product_data[$p] = $product_data_unsorted[$p];
			}
			// EOF: optimized version
			$t4 = microtime(true);
			$debugStr .= number_format($t4-$t3, 2, '.', '')."\toptimized\t"; // 2
			
		}
		
		
		if (isset($cacheName)) file_put_contents($cacheName, serialize(array(
			'product_data' => $product_data,
			'FOUND_ROWS' => $this->FOUND_ROWS
		)), LOCK_EX);

		$debugStr .= $_SERVER['REQUEST_URI'].PHP_EOL;
		if ($debug) file_put_contents('slowlog-model.txt', $debugStr, FILE_APPEND);
        return $product_data;
    }

//    public function getProductSpecials($data = array()) {
//        if ($this->customer->isLogged()) {
//            $customer_group_id = $this->customer->getCustomerGroupId();
//        } else {
//            $customer_group_id = $this->config->get('config_customer_group_id');
//        }

//        $sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "')) GROUP BY ps.product_id";

//        $sort_data = array(
//            'pd.name',
//            'p.model',
//            'ps.price',
//            'rating',
//            'p.sort_order'
//        );
	public function getProductSpecials($data = array()) {
      if ($this->customer->isLogged()) {
         $customer_group_id = $this->customer->getCustomerGroupId();
      } else {
         $customer_group_id = $this->config->get('config_customer_group_id');
      }   

      $sql = "SELECT 
			DISTINCT ps.product_id, 
			(SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating 
		FROM " . DB_PREFIX . "product_special ps 
		LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
		WHERE p.status = '1' AND p.quantity > '0' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' 
			AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
			AND (ps.date_start <> '0000-00-00' OR ps.date_end <> '0000-00-00')
			AND ps.price > '400'
		GROUP by p.price ";

		$sort_data = array(
         'pd.name',
         'p.model',
         'ps.price',
         'rating',
         'p.sort_order',
         'ps.date_end',
		 'ps.date_start',
      );


        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
                $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
            } else {
                $sql .= " ORDER BY " . $data['sort'];
            }
        } else {
            $sql .= " ORDER BY ps.price";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(ps.price) DESC";
        } else {
            $sql .= " ASC, LCASE(ps.price) ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $product_data = array();

        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        }

        return $product_data;
    }

    public function getLatestProducts($limit) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $customer_group_id . '.' . (int)$limit);

        if (!$product_data) {
            $query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_master pm on (p.product_id=pm.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' and pm.master_product_id in (0, -1) AND p.price >0 AND p.quantity >0 AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

            foreach ($query->rows as $result) {
                $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
            }

            $this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit, $product_data);
        }

        return $product_data;
    }

    public function getPopularProducts($limit) {
        $product_data = array();

        $query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed, p.date_added DESC LIMIT " . (int)$limit);

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        }

        return $product_data;
    }

    public function getBestSellerProducts($limit) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit);

        if (!$product_data) {
            $product_data = array();

            $query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0'  AND p.product_id <> 126851 AND p.product_id <> 126718 AND p.product_id <> 131413 AND p.price > '100'  AND p.sort_order < '-1000'  AND p.quantity > '0' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY p.sort_order ASC LIMIT " . (int)$limit);

            foreach ($query->rows as $result) {
                $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
            }

            $this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit, $product_data);
        }

        return $product_data;
    }


    public function getProductAttributes($product_id) {
        $product_attribute_group_data = array();

        $product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa INNER JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id AND a.enabled = 1) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

        foreach ($product_attribute_group_query->rows as $product_attribute_group) {
            $product_attribute_data = array();

            $product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa INNER JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id AND a.enabled = 1) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

            foreach ($product_attribute_query->rows as $product_attribute) {
                $product_attribute_data[] = array(
                    'attribute_id' => $product_attribute['attribute_id'],
                    'name'         => $product_attribute['name'],
                    'text'         => $product_attribute['text']
                );
            }

            $product_attribute_group_data[] = array(
                'attribute_group_id' => $product_attribute_group['attribute_group_id'],
                'name'               => $product_attribute_group['name'],
                'attribute'          => $product_attribute_data
            );
        }

        return $product_attribute_group_data;
    }

    public function getProductOptions($product_id) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

        foreach ($product_option_query->rows as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                $product_option_value_data = array();

                $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

                foreach ($product_option_value_query->rows as $product_option_value) {
                    $product_option_value_data[] = array(
                        'product_option_value_id' => $product_option_value['product_option_value_id'],
                        'option_value_id'         => $product_option_value['option_value_id'],
                        'name'                    => $product_option_value['name'],
                        'image'                   => $product_option_value['image'],
                        'quantity'                => $product_option_value['quantity'],
                        'subtract'                => $product_option_value['subtract'],
                        'price'                   => $product_option_value['price'],
                        'price_prefix'            => $product_option_value['price_prefix'],
                        'weight'                  => $product_option_value['weight'],
                        'weight_prefix'           => $product_option_value['weight_prefix']
                    );
                }

                $product_option_data[] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'option_id'         => $product_option['option_id'],
                    'name'              => $product_option['name'],
                    'type'              => $product_option['type'],
                    'option_value'      => $product_option_value_data,
                    'required'          => $product_option['required']
                );
            } else {
                $product_option_data[] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'option_id'         => $product_option['option_id'],
                    'name'              => $product_option['name'],
                    'type'              => $product_option['type'],
                    'option_value'      => $product_option['option_value'],
                    'required'          => $product_option['required']
                );
            }
        }

        return $product_option_data;
    }

    public function getProductDiscounts($product_id) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < '" . $this->NOW . "') AND (date_end = '0000-00-00' OR date_end > '" . $this->NOW . "')) ORDER BY quantity ASC, priority ASC, price ASC");

        return $query->rows;
    }

    public function getProductImages($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

        return $query->rows;
    }

    public function getProductRelated($product_id) {
        $product_data = array();

//        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.quantity > 0 AND pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.price");
        foreach ($query->rows as $result) {
            $product_data[$result['related_id']] = $this->getProduct($result['related_id']);
        }

        return $product_data;
    }

    public function getProductLayoutId($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

        if ($query->num_rows) {
            return $query->row['layout_id'];
        } else {
            return  $this->config->get('config_layout_product');
        }
    }

    public function getCategories($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

        return $query->rows;
    }

    public function getTotalProducts($data = array()) {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
            } else {
                $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
            }

            if (!empty($data['filter_filter'])) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
            } else {
                $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
            }
        } else {
            $sql .= " FROM " . DB_PREFIX . "product p";
        }

        $sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_master pm "
            . " ON pm.product_id = p.product_id "
            . " WHERE (pm.master_product_id = -1 "; //do not change

            if($this->config->get('pds_hide_from_list_view'))
                $pds_hide_from_list_view = $this->config->get('pds_hide_from_list_view');
            else
                $pds_hide_from_list_view = 'items';

            if($pds_hide_from_list_view == 'series')
            {
                $sql .= " OR pm.master_product_id > 0 "; //= 0: master, > 0: slave
            }
            elseif($pds_hide_from_list_view == 'none')
            {
                $sql .= " OR pm.master_product_id > 0 ";
                $sql .= " OR pm.master_product_id = 0 ";
            }
            else //'item' or default
            {
                $sql .= " OR pm.master_product_id = 0 ";
            }

            $sql .= " OR pm.master_product_id IS NULL) AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
            } else {
                $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
            }

            if (!empty($data['filter_filter'])) {
                $implode = array();

                $filters = explode(',', $data['filter_filter']);

                foreach ($filters as $filter_id) {
                    $implode[] = (int)$filter_id;
                }

                $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
            }
        }

        if (!empty($data['filter'])) {
            $sql .= " AND p.product_id IN (" . $data['filter'] . ")";
        }

        if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
            $sql .= " AND (";

            if (!empty($data['filter_name'])) {
                $implode = array();

                $words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

                foreach ($words as $word) {
                    $implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
                }

                if ($implode) {
                    $sql .= " " . implode(" AND ", $implode) . "";
                }

                if (!empty($data['filter_description'])) {
                    $sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                }
            }

            if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
                $sql .= " OR ";
            }

            if (!empty($data['filter_tag'])) {
                $sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            $sql .= ")";
        }

        # OCFilter start
				if (!empty($data['filter_ocfilter'])) {
					if (!$this->registry->has('ocfilter_sql') || null === $this->registry->get('ocfilter_sql')) {
						$this->load->model('catalog/ocfilter');

						$this->model_catalog_ocfilter->getOCFilterData($data);
					}

					if (!$this->registry->get('ocfilter_sql')) {
						return (__FUNCTION__ == 'getTotalProducts' ? 0 : array());
					}

					$sql .= $this->registry->get('ocfilter_sql');

					if ($this->registry->has('ocfilter_sql')) {
						$this->registry->set('ocfilter_sql', null);
					}
				}
				# OCFilter end

				if (!empty($data['filter_manufacturer_id'])) {
            $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalProductSpecials() {
        if ($this->customer->isLogged()) {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $query = $this->db->query("SELECT 
				COUNT(DISTINCT ps.product_id) AS total 
			FROM " . DB_PREFIX . "product_special ps 
			LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) 
			LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
			WHERE p.status = '1' AND p.date_available <= '" . $this->NOW . "' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' 
				AND p.quantity > '0'
				AND ps.customer_group_id = '" . (int)$customer_group_id . "' 
				AND ((ps.date_start = '0000-00-00' OR ps.date_start <= '" . $this->NOW . "') AND (ps.date_end = '0000-00-00' OR ps.date_end >= '" . $this->NOW . "'))
				AND (ps.date_start <> '0000-00-00' OR ps.date_end <> '0000-00-00')
			");

        if (isset($query->row['total'])) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

   public function getCategoryPath($product_id) {
      $query = $this->db->query("SELECT category_id AS catid FROM " . DB_PREFIX . "category WHERE category_id IN (SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' ) ORDER BY sort_order asc LIMIT 1");

      if(array_key_exists('catid', $query->row)) {
         $path = array();
         $path[0] = $query->row['catid'];

         $query = $this->db->query("SELECT parent_id AS pid FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$path[0] . "'");

         $parent = $query->row['pid'];

         $p = 1;
         while($parent>0){
            $path[$p] = $parent;

            $query = $this->db->query("SELECT parent_id AS pid FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$parent . "'");
            $parent = $query->row['pid'];
            $p++;
         }

         $path = array_reverse($path);

         $fullpath = '';

         foreach($path as $val){
            $fullpath .= '_'.$val;
         }

         return ltrim($fullpath, '_');
      }else{
         return '0';
      }
   }
   
			//BOF Product Series
            public function getLinkedProducts($product_id, $special_attribute_group_id)
            {
                $master_product_id = $this->getMasterProductId($product_id, $special_attribute_group_id);
                if($master_product_id == -1) return array();
				if($master_product_id == 0) $master_product_id = $product_id;

				$cacheDir = DIR_CACHE.'cache.linked_products';
				if (!is_dir($cacheDir)) mkdir($cacheDir);
				$cacheName = $cacheDir.'/cache.linked_products.'.$master_product_id.'.'.$special_attribute_group_id;
				if (is_file($cacheName) && filemtime($cacheName) > time() - self::CACHELIFE) {
					$f = fopen($cacheName, 'r');
					//if (flock($f, LOCK_EX)){
					$handle = fopen($cacheName, "r");
					$result = fread($handle, filesize($cacheName));
					fclose($handle);					
					return unserialize($result);
				
					//return unserialize(file_get_contents($cacheName));
				}

				//get all slave products of above master product
				$query = $this->db->query("SELECT DISTINCT p.product_id, "

               . " prom.name as promotion, "
               
				. " p.model, "
				. " p.image, "
				. " pd.name, "
				. " sa.special_attribute_name, "
				. " sa.special_attribute_value "
				. " FROM " . DB_PREFIX . "product p "
				. " LEFT JOIN " . DB_PREFIX . "product_master pm "
				. " ON pm.product_id = p.product_id "
				. " LEFT JOIN " . DB_PREFIX . "product_description pd "
				. " ON pd.product_id = p.product_id"
				. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa "
				. " ON psa.product_id = p.product_id"
				. " LEFT JOIN " . DB_PREFIX . "special_attribute sa "
				. " ON sa.special_attribute_id = psa.special_attribute_id "
				. " LEFT JOIN " . DB_PREFIX . "product_to_store p2s "
				. " ON p2s.product_id = p.product_id "

                    . " LEFT JOIN " . DB_PREFIX . "product_promotion prpr "
                    . " ON prpr.product_id = p.product_id "
                    . " LEFT JOIN " . DB_PREFIX . "promotion prom "
                    . " ON prom.promotion_id = prpr.promotion_id "
               
				. " WHERE (pm.master_product_id = " . (int)$master_product_id . ") "
				. " AND sa.special_attribute_group_id = " . (int)$special_attribute_group_id . " "
				. " AND p.status = 1 "
				. " AND p.date_available <= NOW() "
				. " AND pd.language_id = " . (int)$this->config->get('config_language_id') . " "
				. " AND p2s.store_id = " . (int)$this->config->get('config_store_id') . " "
				. " ORDER BY p.sort_order ASC ");

                $linked_product_data = array();
				foreach ($query->rows as $result) {
					$linked_product_data[] = $result;
				}
				file_put_contents($cacheName, serialize($linked_product_data), LOCK_EX);
                return $linked_product_data;
            }

            public function getAllLinkedProducts($special_attribute_group_id, $pids = false){
				$hash = md5(serialize($pids));

				$cacheName = DIR_CACHE.'cache.all_linked_products-'.$hash.'.'.$special_attribute_group_id;
				if (is_file($cacheName) && (int)filemtime($cacheName) > time() - self::CACHELIFE){
					return unserialize(file_get_contents($cacheName));
				}
				/*
				file_put_contents('test.txt', 'Foo bar');
				$f = fopen('test.txt', 'a+');
				if (flock($f, LOCK_EX)) {
					sleep(10);
					fseek($f, 0);
					var_dump(fgets($f, 4048));
					flock($f, LOCK_UN);
				}
				fclose($f);
				And while it's sleeping, call this:

				$f = fopen('test.txt', 'a+');
				fwrite($f, 'foobar');
				fclose($f);
				*/
				
				$linked_product_data = array();
				if ($pids === false || !empty($pids)){
					$query = $this->db->query("SELECT pm.master_product_id, "
					. " p.product_id, "
					. " p.image, "
					. " p.quantity, "
					. " p.price, "
					. " p.model AS 'product_model', "
					. " pd.name AS 'product_name', "
					. " sa.special_attribute_name, "
					. " sa.special_attribute_value "
					. " FROM " . DB_PREFIX . "product_master pm "
					. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa "
					. " ON psa.product_id = pm.product_id "
					. " LEFT JOIN " . DB_PREFIX . "special_attribute sa "
					. " ON sa.special_attribute_id = psa.special_attribute_id "
					. " LEFT JOIN " . DB_PREFIX . "product p "
					. " ON p.product_id = pm.product_id "
					. " LEFT JOIN " . DB_PREFIX . "product_description pd "
					. " ON pd.product_id = p.product_id"
					//. " LEFT JOIN " . DB_PREFIX . "product_to_store p2s "
					//. " ON p2s.product_id = p.product_id "
					. " WHERE " . (!empty($pids) ? "(pm.master_product_id IN (".implode(',', $pids).")) AND " : "") // OR p.product_id IN (".implode(',', $pids).")
					. " sa.special_attribute_group_id = " . (int)$special_attribute_group_id . " "
					. " AND pm.special_attribute_group_id = " . (int)$special_attribute_group_id . " "
					. " AND p.status = 1 "
					. " AND p.date_available <= NOW() "
					//. " AND p2s.store_id = " . (int)$this->config->get('config_store_id') . " "
					. " AND pd.language_id = " . (int)$this->config->get('config_language_id') . " "
					. " AND pm.master_product_id > 0"
					. " GROUP BY p.product_id " 
					. " ORDER BY p.sort_order ASC, sa.special_attribute_id ASC "
					);

					$sQ = $this->db->query('SELECT product_id, price FROM '.DB_PREFIX.'product_special ps 
						WHERE '. /*(!empty($pids) ? "product_id IN (".implode(',', $pids).") AND " : "") .*/'
							customer_group_id = 0
							AND ((date_start = "0000-00-00" OR date_start <= "'.date('Y-m-d H:i:s').'") 
							AND (date_end = "0000-00-00" OR date_end >= "'.date('Y-m-d H:i:s').'")) 
						ORDER BY priority, price');

					$specials = array();
					foreach ($sQ->rows as $r){
						if (isset($specials[$r['product_id']])) continue;
						$specials[$r['product_id']] = $r['price'];
					}
					
					foreach ($query->rows as $result){
						if (!isset($linked_product_data[$result['master_product_id']])) $linked_product_data[$result['master_product_id']] = array();
						$result['special'] = !empty($specials[$result['product_id']]) ? $specials[$result['product_id']] : false;
						$linked_product_data[$result['master_product_id']][] = $result;
					}
				}
				
				if ($pids === false){
					$result = serialize($linked_product_data);
					file_put_contents($cacheName.'.log', date('Y-m-d H:i:s')."\t".$_SERVER['REQUEST_URI'].' ('.strlen($result).')'.PHP_EOL, FILE_APPEND);
					//file_put_contents($cacheName, serialize($linked_product_data), LOCK_EX);
					$f = fopen($cacheName, 'w');
					if (flock($f, LOCK_EX)){
						fwrite($f, $result);
						fflush($f);
						flock($f, LOCK_UN);
					}				
					fclose($f);
				}
                return $linked_product_data;
            }

            public function getMasterProductId($product_id, $special_attribute_group_id)
            {
                $this->load->model('catalog/product_master');

                return $this->model_catalog_product_master->getMasterProductId($product_id, $special_attribute_group_id);
            }

            //check if a product is a master product (a product which does not link to any other product)
            public function isMaster($product_id, $special_attribute_group_id)
            {
                $this->load->model('catalog/product_master');

                return $this->model_catalog_product_master->isMaster($product_id, $special_attribute_group_id);
            }
            //EOF Product Series
}
?>
