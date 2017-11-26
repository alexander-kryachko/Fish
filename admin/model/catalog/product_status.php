<?php
 class ModelCatalogProductStatus extends Model{

	public function getStatusDescriptions($ae74c1a0b383eb3e7645615ac816c8509){
		$a9de94da3640fdf2504980c688c1aa8ff=array();
		$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query("SELECT * , (SELECT ad.name FROM ".DB_PREFIX."attribute_description ad WHERE ad.attribute_id = s.attribute_id AND ad.language_id = s.language_id) AS attribute_name FROM ".DB_PREFIX."status s WHERE s.status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'");
		foreach($a604285cbf6a8e7ea9455fcf02269330a->rows as $abc8b85d1b37fb22794dec27d9fdf1cff){
			$a9de94da3640fdf2504980c688c1aa8ff[$abc8b85d1b37fb22794dec27d9fdf1cff['language_id']]=$abc8b85d1b37fb22794dec27d9fdf1cff;
			$a9de94da3640fdf2504980c688c1aa8ff[$abc8b85d1b37fb22794dec27d9fdf1cff['language_id']]['attribute_value']=$this->getStatusAttributeValues($abc8b85d1b37fb22794dec27d9fdf1cff['status_id'],$abc8b85d1b37fb22794dec27d9fdf1cff['attribute_id'],$abc8b85d1b37fb22794dec27d9fdf1cff['language_id']);
		}
		return $a9de94da3640fdf2504980c688c1aa8ff;
	}
	public function getStatus($ae74c1a0b383eb3e7645615ac816c8509){
		$ac9b0dec1bb6ee0ee0b80cea4149f6094="SELECT * FROM ".DB_PREFIX."status s WHERE s.language_id = '".(int) $this->config->get('config_language_id')."' AND s.status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'";
		$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query($ac9b0dec1bb6ee0ee0b80cea4149f6094);
		return $a604285cbf6a8e7ea9455fcf02269330a->row;
	}
	public function addStatus($a90182dd0fd3a4ba8b2ef0976b7e7b834,$ae74c1a0b383eb3e7645615ac816c8509=0){
		if(!$ae74c1a0b383eb3e7645615ac816c8509){
			$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query("SELECT MAX(status_id) as status_id FROM ".DB_PREFIX."status");
			if($a604285cbf6a8e7ea9455fcf02269330a->row){
				$ae74c1a0b383eb3e7645615ac816c8509=$a604285cbf6a8e7ea9455fcf02269330a->row['status_id'];
			}else{$ae74c1a0b383eb3e7645615ac816c8509=0;}$ae74c1a0b383eb3e7645615ac816c8509++;
		}foreach($a90182dd0fd3a4ba8b2ef0976b7e7b834['status_description']as $aefa2ac881d6d18c691aad825b542e3e4=>$a08e65537d2e824d99c1af8c769aa0399){$a08e65537d2e824d99c1af8c769aa0399['new']=isset($a08e65537d2e824d99c1af8c769aa0399['new'])?(int) $a08e65537d2e824d99c1af8c769aa0399['new']:0;$a08e65537d2e824d99c1af8c769aa0399['bestseller']=isset($a08e65537d2e824d99c1af8c769aa0399['bestseller'])?(int) $a08e65537d2e824d99c1af8c769aa0399['bestseller']:0;$a08e65537d2e824d99c1af8c769aa0399['popular']=isset($a08e65537d2e824d99c1af8c769aa0399['popular'])?(int) $a08e65537d2e824d99c1af8c769aa0399['popular']:0;$a08e65537d2e824d99c1af8c769aa0399['special']=isset($a08e65537d2e824d99c1af8c769aa0399['special'])?(int) $a08e65537d2e824d99c1af8c769aa0399['special']:0;$a08e65537d2e824d99c1af8c769aa0399['promotion']=isset($a08e65537d2e824d99c1af8c769aa0399['promotion'])?(int) $a08e65537d2e824d99c1af8c769aa0399['promotion']:0;$a08e65537d2e824d99c1af8c769aa0399['promotion_image']=isset($a08e65537d2e824d99c1af8c769aa0399['promotion_image'])?(int) $a08e65537d2e824d99c1af8c769aa0399['promotion_image']:0;$this->db->query("INSERT INTO ".DB_PREFIX."status SET "."`status_id` = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."', "."`language_id` = '".(int) $aefa2ac881d6d18c691aad825b542e3e4."', "."`image` = '".$this->db->escape(html_entity_decode($a08e65537d2e824d99c1af8c769aa0399['image'],ENT_QUOTES,'UTF-8'))."', "."`name` = '".$this->db->escape(html_entity_decode($a08e65537d2e824d99c1af8c769aa0399['name'],ENT_QUOTES,'UTF-8'))."', "."`attribute_id` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['attribute_id']."', "."`sort_order` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['sort_order']."', "."`sticker` = '".$this->db->escape(html_entity_decode($a08e65537d2e824d99c1af8c769aa0399['sticker'],ENT_QUOTES,'UTF-8'))."', "."`manufacturer_id` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['manufacturer_id']."', "."`category_id` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['category_id']."', "."`price_from` = '".(float) $a08e65537d2e824d99c1af8c769aa0399['price_from']."', "."`price_to` = '".(float) $a08e65537d2e824d99c1af8c769aa0399['price_to']."', "."`stock_from` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['stock_from']."', "."`stock_to` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['stock_to']."', "."`new` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['new']."', "."`bestseller` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['bestseller']."', "."`popular` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['popular']."', "."`special` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['special']."', "."`promotion` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['promotion']."', "."`promotion_image` = '".(int) $a08e65537d2e824d99c1af8c769aa0399['promotion_image']."', "."`url` = '".$this->db->escape(html_entity_decode($a08e65537d2e824d99c1af8c769aa0399['url'],ENT_QUOTES,'UTF-8'))."'");$this->editStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a08e65537d2e824d99c1af8c769aa0399['attribute_id'],$aefa2ac881d6d18c691aad825b542e3e4,$a08e65537d2e824d99c1af8c769aa0399['attribute_value']);}$this->cache->delete('product.statuses');}
	public function editStatus($ae74c1a0b383eb3e7645615ac816c8509,$a90182dd0fd3a4ba8b2ef0976b7e7b834){$this->db->query("DELETE FROM ".DB_PREFIX."status WHERE status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'");$this->addStatus($a90182dd0fd3a4ba8b2ef0976b7e7b834,$ae74c1a0b383eb3e7645615ac816c8509);}
	public function deleteStatus($ae74c1a0b383eb3e7645615ac816c8509){$this->db->query("DELETE FROM ".DB_PREFIX."status WHERE status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'");$this->db->query("DELETE FROM ".DB_PREFIX."status_attribute WHERE status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'");$this->db->query("DELETE FROM ".DB_PREFIX."product_status WHERE status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."'");$this->cache->delete('product.statuses');}
	public function getStatuses($a90182dd0fd3a4ba8b2ef0976b7e7b834=array()){$ac9b0dec1bb6ee0ee0b80cea4149f6094="SELECT * FROM ".DB_PREFIX."status s WHERE s.language_id = '".(int) $this->config->get('config_language_id')."' ";if(!empty($a90182dd0fd3a4ba8b2ef0976b7e7b834['filter_name'])){$ac9b0dec1bb6ee0ee0b80cea4149f6094.=" AND s.name LIKE '%".$this->db->escape($a90182dd0fd3a4ba8b2ef0976b7e7b834['filter_name'])."%'";}$ac9b0dec1bb6ee0ee0b80cea4149f6094.=" ORDER BY s.sort_order ASC";if(isset($a90182dd0fd3a4ba8b2ef0976b7e7b834['start'])||isset($a90182dd0fd3a4ba8b2ef0976b7e7b834['limit'])){if($a90182dd0fd3a4ba8b2ef0976b7e7b834['start']<0){$a90182dd0fd3a4ba8b2ef0976b7e7b834['start']=0;}if($a90182dd0fd3a4ba8b2ef0976b7e7b834['limit']<1){$a90182dd0fd3a4ba8b2ef0976b7e7b834['limit']=20;}$ac9b0dec1bb6ee0ee0b80cea4149f6094.=" LIMIT ".(int) $a90182dd0fd3a4ba8b2ef0976b7e7b834['start'].",".(int) $a90182dd0fd3a4ba8b2ef0976b7e7b834['limit'];}$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query($ac9b0dec1bb6ee0ee0b80cea4149f6094);return $a604285cbf6a8e7ea9455fcf02269330a->rows;}
	public function getTotalStatuses(){$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query("SELECT COUNT(*) AS total FROM ".DB_PREFIX."status s WHERE s.language_id = '".(int) $this->config->get('config_language_id')."'");return $a604285cbf6a8e7ea9455fcf02269330a->row['total'];}
	public function getStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4=0){if(!$aefa2ac881d6d18c691aad825b542e3e4){$aefa2ac881d6d18c691aad825b542e3e4=(int) $this->config->get('config_language_id');}$ac9b0dec1bb6ee0ee0b80cea4149f6094="SELECT * FROM ".DB_PREFIX."status_attribute WHERE language_id = '".(int) $aefa2ac881d6d18c691aad825b542e3e4."' AND status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."' AND attribute_id = '".(int) $a625bbfa9e04f5f7ef8669b781eb1ac91."'";$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query($ac9b0dec1bb6ee0ee0b80cea4149f6094);$a9e8021f6c093ee074dc49b57d413c9f3=array();foreach($a604285cbf6a8e7ea9455fcf02269330a->rows as $af4753bdb0deb5d15285883a19ceb1c35){$a9e8021f6c093ee074dc49b57d413c9f3[]=$af4753bdb0deb5d15285883a19ceb1c35['text'];}return $a9e8021f6c093ee074dc49b57d413c9f3;}
	public function getStatusAttributeValues($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4){$ab1026af7fc7879cd9e669b96ec72a9ca=$this->getStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4);return implode(',',$ab1026af7fc7879cd9e669b96ec72a9ca);}
	public function addStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4,$a79436850a2ceee7b0146747698333a61){if(!is_array($a79436850a2ceee7b0146747698333a61)){$a79436850a2ceee7b0146747698333a61=array_map('trim',explode(',',$a79436850a2ceee7b0146747698333a61));}foreach($a79436850a2ceee7b0146747698333a61 as $a93172cbf5dda74c2ed235bc9170ba8c9){if($a625bbfa9e04f5f7ef8669b781eb1ac91){$this->db->query("INSERT INTO ".DB_PREFIX."status_attribute SET "."`status_id` = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."', "."`language_id` = '".(int) $aefa2ac881d6d18c691aad825b542e3e4."', "."`attribute_id` = '".(int) $a625bbfa9e04f5f7ef8669b781eb1ac91."', "."`text` = '".$this->db->escape(html_entity_decode($a93172cbf5dda74c2ed235bc9170ba8c9,ENT_QUOTES,'UTF-8'))."'");}}}
	public function editStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4,$a79436850a2ceee7b0146747698333a61){$this->db->query("DELETE FROM ".DB_PREFIX."status_attribute WHERE status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."' AND language_id = '".(int) $aefa2ac881d6d18c691aad825b542e3e4."'");$this->addStatusAttributes($ae74c1a0b383eb3e7645615ac816c8509,$a625bbfa9e04f5f7ef8669b781eb1ac91,$aefa2ac881d6d18c691aad825b542e3e4,$a79436850a2ceee7b0146747698333a61);}
	public function getProductStatuses($aef4ddd72f6aa29354399db85052612c7){$ac9b0dec1bb6ee0ee0b80cea4149f6094="SELECT s.*, ps.product_show, ps.category_show, ps.product_id, ps.sort_order FROM ".DB_PREFIX."product_status ps LEFT JOIN ".DB_PREFIX."status s ON ps.status_id = s.status_id WHERE s.language_id = '".(int) $this->config->get('config_language_id')."' AND ps.product_id = '".(int) $aef4ddd72f6aa29354399db85052612c7."' ORDER BY ps.sort_order ASC";$a604285cbf6a8e7ea9455fcf02269330a=$this->db->query($ac9b0dec1bb6ee0ee0b80cea4149f6094);$a3d6057e30b946e8e2a8f20c7c2fd5585=array();foreach($a604285cbf6a8e7ea9455fcf02269330a->rows as $af4753bdb0deb5d15285883a19ceb1c35){$af4753bdb0deb5d15285883a19ceb1c35['thumb']=$this->getThumb($af4753bdb0deb5d15285883a19ceb1c35['image']);$a3d6057e30b946e8e2a8f20c7c2fd5585[]=$af4753bdb0deb5d15285883a19ceb1c35;}return $a3d6057e30b946e8e2a8f20c7c2fd5585;}
	public function addProductStatuses($aef4ddd72f6aa29354399db85052612c7,$a90182dd0fd3a4ba8b2ef0976b7e7b834){$this->deleteProductStatuses($aef4ddd72f6aa29354399db85052612c7);if(isset($a90182dd0fd3a4ba8b2ef0976b7e7b834['product_status'])){foreach($a90182dd0fd3a4ba8b2ef0976b7e7b834['product_status']as $a140c9610f69eb3168efc54b6dc3e73b0){if($a140c9610f69eb3168efc54b6dc3e73b0['status_id']){$ae74c1a0b383eb3e7645615ac816c8509=$a140c9610f69eb3168efc54b6dc3e73b0['status_id'];$a7104c378ca6d1ad5e37fedc2ac1c7e40=isset($a140c9610f69eb3168efc54b6dc3e73b0['product_show'])?$a140c9610f69eb3168efc54b6dc3e73b0['product_show']:0;$a824d62ea2dbba62b0507596d0aa9325d=isset($a140c9610f69eb3168efc54b6dc3e73b0['category_show'])?$a140c9610f69eb3168efc54b6dc3e73b0['category_show']:0;$a1654bfc0dc870ae1249e5078d767b4fe=isset($a140c9610f69eb3168efc54b6dc3e73b0['sort_order'])?$a140c9610f69eb3168efc54b6dc3e73b0['sort_order']:0;$this->db->query("INSERT INTO ".DB_PREFIX."product_status SET status_id = '".(int) $ae74c1a0b383eb3e7645615ac816c8509."', product_id = '".(int) $aef4ddd72f6aa29354399db85052612c7."', product_show = '".(int) $a7104c378ca6d1ad5e37fedc2ac1c7e40."', category_show = '".(int) $a824d62ea2dbba62b0507596d0aa9325d."', sort_order = '".(int) $a1654bfc0dc870ae1249e5078d767b4fe."'");}}}}
	public function deleteProductStatuses($aef4ddd72f6aa29354399db85052612c7){$this->db->query("DELETE FROM ".DB_PREFIX."product_status WHERE product_id = '".(int) $aef4ddd72f6aa29354399db85052612c7."'");$this->cache->delete('product.statuses');}
	public function getThumb($afaa7f852adb7a8762e348941d534d627,$ad18d03eea6c9027ac5e33bee643ef9a2='product'){$this->load->model('tool/image');$aad4eb70501fa84f224bc82e58d6ea188=$this->config->get('product_status_options');$a4b0fd40867135bc916e5ed7c1f3cbd92=HTTP_CATALOG.'image/'.$afaa7f852adb7a8762e348941d534d627;if(!isset($afaa7f852adb7a8762e348941d534d627)||!$afaa7f852adb7a8762e348941d534d627||!file_exists(DIR_IMAGE.$afaa7f852adb7a8762e348941d534d627)){$afaa7f852adb7a8762e348941d534d627='no_image.jpg';}if($aad4eb70501fa84f224bc82e58d6ea188[$ad18d03eea6c9027ac5e33bee643ef9a2]['image_width']||$aad4eb70501fa84f224bc82e58d6ea188[$ad18d03eea6c9027ac5e33bee643ef9a2]['image_height']){$a4b0fd40867135bc916e5ed7c1f3cbd92=$this->model_tool_image->resize($afaa7f852adb7a8762e348941d534d627,$aad4eb70501fa84f224bc82e58d6ea188[$ad18d03eea6c9027ac5e33bee643ef9a2]['image_width'],$aad4eb70501fa84f224bc82e58d6ea188[$ad18d03eea6c9027ac5e33bee643ef9a2]['image_height']);}return $a4b0fd40867135bc916e5ed7c1f3cbd92;}
	public function getDefaultOptions(){return array('key'=>'ff852aab3687688d5f0d449026a4c24a','product'=>array('image_width'=>50,'image_height'=>50,'name_display'=>'tip','status_display'=>'inline','auto_display'=>'enable','sticker_display'=>'enable'),'category'=>array('image_width'=>50,'image_height'=>50,'name_display'=>'tip','status_display'=>'inline','auto_display'=>'enable','sticker_display'=>'enable'),'product_sticker'=>array('image_width'=>50,'image_height'=>50,),'category_sticker'=>array('image_width'=>50,'image_height'=>50,),'status_bestseller_total'=>5,'status_popular_total'=>50,'status_new_hours'=>72,'cache'=>0);}
	public function install(){$this->uninstall();$this->db->query("
		CREATE TABLE IF NOT EXISTS ".DB_PREFIX."status (
			`status_id` int(11) NOT NULL,
			`language_id` int(11) NOT NULL,
			`image` varchar(255) NOT NULL,
			`name` text NOT NULL,
			`url` varchar(255) NOT NULL,
			`sort_order` INT(3) NOT NULL DEFAULT '0',
			`attribute_id` int(11) NOT NULL,
			`sticker` VARCHAR(255) NOT NULL,
			`manufacturer_id` INT(11) NOT NULL, 
			`category_id` INT(11) NOT NULL,
			`price_from` DECIMAL(15,4) NOT NULL,
			`price_to` DECIMAL(15,4) NOT NULL,
			`stock_from` INT(4) NOT NULL,
			`stock_to` INT(4) NOT NULL,
			`new` INT(1) NOT NULL,
			`bestseller` INT(1) NOT NULL,
			`popular` INT(1) NOT NULL,
			`special` INT(1) NOT NULL,
			`promotion` INT(1) NOT NULL,
			`promotion_image` INT(1) NOT NULL, 
			PRIMARY KEY (`status_id`, `language_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci
	");$this->db->query("
		CREATE TABLE IF NOT EXISTS ".DB_PREFIX."status_attribute (
			`status_id` int(11) NOT NULL,
			`attribute_id` int(11) NOT NULL,
			`language_id` int(11) NOT NULL,
			`text` text NOT NULL,
			KEY (`status_id`, `attribute_id`, `language_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci
	");$this->db->query("
		CREATE TABLE  IF NOT EXISTS ".DB_PREFIX."product_status (
			`product_id` int(11) NOT NULL,
			`status_id` int(11) NOT NULL,
			`product_show` int(1) NOT NULL,
			`category_show` tinyint(1) NOT NULL,
			`sort_order` INT(3) NOT NULL DEFAULT '0',
			KEY (`status_id`),
			KEY (`product_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
	");}
	public function uninstall(){$this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."status");$this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."status_attribute");$this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."product_status");}}
//author sv2109 (sv2109@gmail.com) license for 1 product copy granted for marketing@fisherway.com.ua (marketing@fisherway.com.ua fisherway.com.ua)
