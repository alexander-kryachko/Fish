<?php 
class ModelCatalogSuppler extends Model {
	public function createTables() {
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler (form_id INT(10) AUTO_INCREMENT, suppler_id INT(11), name varchar(64), main INT(1), sort_order INT(13), rate decimal(12,4), ratep decimal(12,4), ratek decimal(12,4), cod varchar(128), item varchar(128), cat varchar(128), qu varchar(128), price varchar(128), descrip varchar(128), pic_ext varchar(128), manuf varchar(128), warranty varchar(512), ad varchar(2), status INT(2), my_cat INT(5), my_qu varchar(128), my_price INT(2), my_descrip varchar(512), my_manuf varchar(64), my_mark varchar(512), weight varchar(3), length varchar(3), width varchar(3), height varchar(3), parent  varchar(1), hide varchar(1), newphoto varchar(1), my_photo varchar(512), cheap varchar(3), addopt varchar(1), addseo varchar(1), related varchar(3), updte varchar(1), pmanuf varchar(1), upattr varchar(1), upopt varchar(1), upname varchar(1), myplus varchar(3), cprice varchar(3), minus varchar(1), chcode varchar(1), importseo varchar(1), sorder  varchar(3), spec varchar(128), upurl varchar(3), ref varchar(3), ref1 varchar(3), addattr varchar(1), exsame varchar(1), sku2  varchar(3), parss varchar(3), points varchar(64), places varchar(5), parsi varchar(3), pointi varchar(64), placei varchar(5), parsc varchar(3), pointc varchar(64), placec varchar(5), parsp varchar(3), pointp varchar(64), placep varchar(5), parsd varchar(3), pointd varchar(64), placed varchar(5), parsm varchar(3), pointm varchar(64), placem varchar(5), parsk varchar(3), parsq varchar(3), pointq varchar(64), placeq varchar(5), bprice varchar(3), kmenu varchar(3), catcreate varchar(1), stay varchar(1), joen varchar(1), off varchar(1), umanuf varchar(1), onn   varchar(12),  refer varchar(3), disc varchar(12), newurl varchar(1), upc varchar(3), ean varchar(3), mpn varchar(3), ddata varchar(3), bonus varchar(64), ddesc varchar(1), qu_discount varchar(128), plusopt varchar(1), idcat varchar(1), t_ref varchar(3), t_ref1 varchar(3), termin varchar(3), t_status varchar(255), onoff varchar(1), zero varchar(1),  metka varchar(1), jopt varchar(1), optsku varchar(1), newproduct varchar(5), opt_prices varchar(1), opt_fotos varchar(1), usd varchar(3), serie varchar(3), sleep varchar(1), ffile varchar(1), PRIMARY KEY (form_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_data (nom_id int(11) AUTO_INCREMENT, form_id int(11), cat_ext varchar(128), category_id int(11), pic_int varchar(160), cat_plus varchar(512), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_attributes (nom_id int(11) AUTO_INCREMENT, form_id int(11), attr_ext varchar(128), attr_point varchar(64), attribute_id int(11), tags varchar(1), filter_group_id int(11), PRIMARY KEY (nom_id))  ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_options (nom_id int(11) AUTO_INCREMENT, form_id int(11), option_id int(11), opt varchar(64), opt_point varchar(64), po varchar(3), ko varchar(3), pr varchar(64), we varchar(3), `option_required` varchar(1), art varchar(3), foto varchar(3), PRIMARY KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_sku_description (nom_id int(11) AUTO_INCREMENT, sku_id int(11), sku varchar(64), store_id int(2), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_sku (nom_id int(11) AUTO_INCREMENT, sku_id int(11), product_id int(11), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions (relatedoptions_id int(11) AUTO_INCREMENT, product_id int(11), quantity int(4), price decimal(15,4), model varchar(64), defaultselect  tinyint(1), defaultselectpriority int(11), weight decimal(15,8), weight_prefix varchar(1), PRIMARY  KEY (relatedoptions_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_option  (relatedoptions_id int(11), product_id int(11), option_id int(11), option_value_id int(11)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_variant  (relatedoptions_variant_id int(11) AUTO_INCREMENT, relatedoptions_variant_name varchar(255), PRIMARY  KEY (relatedoptions_variant_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
				
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_variant_option  (relatedoptions_variant_id int(11), option_id int(11)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_variant_product  (relatedoptions_variant_id int(11), product_id int(11), relatedoptions_use tinyint(1)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_discount (relatedoptions_id int(11), customer_group_id int(11), quantity int(4), priority int(5), price decimal(15,4)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_special (relatedoptions_id int(11), customer_group_id int(11), priority int(5), price decimal(15,4)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "relatedoptions_to_char (relatedoptions_id int(11), char_id varchar(255)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_price (nom_id int(11) AUTO_INCREMENT, form_id int(11), nom varchar(3), ident varchar(16), param varchar(128), point varchar(64),  noprice varchar(64), paramnp  varchar(128), pointnp varchar(64), baseprice int(1), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_ref (nom_id int(11) AUTO_INCREMENT, product_id int(11), ident varchar(16), url text, price decimal(15,4), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "redirect (redirect_id int(11) AUTO_INCREMENT, active tinyint(1) DEFAULT '0', from_url text, to_url text, response_code int(3) DEFAULT '301', date_start date DEFAULT '0000-00-00', date_end date DEFAULT '0000-00-00', times_used int(5) DEFAULT '0', product_id int(11), PRIMARY  KEY (redirect_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_seo (nom_id int(11) AUTO_INCREMENT,  form_id int(11), prod_title varchar(400), prod_meta_desc varchar(400), prod_desc text, prod_keyword varchar(1000), prod_h1 text, prod_photo text, cat_title varchar(400), cat_meta_desc varchar(400), cat_desc text, manuf_title varchar(400), manuf_meta_desc varchar(400), manuf_desc text, seo_1 text, seo_2 text, seo_3 text, seo_4 text, seo_5 text, seo_6 text, seo_7 text, seo_8 text, seo_9 text, seo_10 text, seo_11 text, seo_12 text, seo_13 text, seo_14 text, seo_15 text, seo_16 text, seo_17 text, seo_18 text, seo_19 text, seo_20 text, seo_r1 text, seo_r2 text, seo_r3 text, seo_r4 text, seo_r5 text, seo_r6 text, PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "suppler_base_price (nom_id int(11) AUTO_INCREMENT, product_id int(11), model varchar(64), bprice decimal(12,4), bpack int(11), brate decimal(12,4), bsuppler varchar(2), bdisc decimal(12,4), bmin decimal(12,4), bav decimal(12,4), bmax decimal(12,4), optimal  decimal(12,4), market_percent_to_price decimal(6,3), market_percent_to_bprice decimal(6,3),  market_percent_to_bdprice decimal(6,3), PRIMARY  KEY (nom_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8");		
		
		$this->cache->delete('suppler');
	}
	
	public function getMinAttribute() {	
		$query = $this->db->query("SELECT min(attribute_id) FROM " . DB_PREFIX . "attribute");	
		return $query->row;
	}
	
	public function getMaxSuppler() {	
		$query = $this->db->query("SELECT max(suppler_id) FROM " . DB_PREFIX . "suppler");	
		return $query->row;
	}
	
	public function getMaxCategoryID() {	
		$query = $this->db->query("SELECT max(category_id) FROM " . DB_PREFIX . "category");
		return $query->row;
	}	
	
	public function getMaxManufacturerID() {	
		$query = $this->db->query("SELECT max(manufacturer_id) FROM " . DB_PREFIX . "manufacturer");
		return $query->row;
	}

	public function addSuppler($data) {
		if (!isset($data['suppler_id']) or !$data['suppler_id']) {
			$row = $this->getMaxSuppler();
			if (!empty($row)) $data['suppler_id'] = $row['max(suppler_id)'] + 1;
			else $data['suppler_id'] = 1;		
		}
		$data['rate'] = str_replace(',','.',trim($data['rate']));
		if (!$data['rate']) $data['rate'] = 1.0;
		$data['ratep'] = str_replace(',','.',trim($data['ratep']));
		if (!$data['ratep']) $data['ratep'] = 1.0;
		$data['ratek'] = str_replace(',','.',trim($data['ratek']));
		if (!$data['ratek']) $data['ratek'] = 1.0;
		
		$lang = $this->config->get('config_language_id');
		if (isset($data['main'])) $main = 1;
		else $main = 0;
		
      	$this->db->query("INSERT INTO " . DB_PREFIX . "suppler SET `suppler_id` = '". $data['suppler_id'] . "', `name` = '" . $this->db->escape($data['name']) . "', `main` = '" . $main . "', `sort_order` = '" . $lang . "', `rate` = '" . $data['rate'] . "', `ratep` = '" . $data['ratep'] . "', `ratek` = '" . $data['ratek'] . "', `cod` = '" . $this->db->escape($data['cod']) . "', `item` = '" . $this->db->escape($data['item']) . "', `cat` = '" . $this->db->escape($data['cat']) . "', `qu` = '" . $this->db->escape($data['qu']) . "', `price` = '" . $this->db->escape($data['price']) . "', `descrip` = '" . $this->db->escape($data['descrip']) . "', `pic_ext` = '" . $this->db->escape($data['pic_ext']) . "', `manuf` = '" . $this->db->escape($data['manuf']) . "', `warranty` = '" . $this->db->escape($data['warranty']) . "', `ad` = '" . $data['ad'] . "', `status` = '" . $data['status'] . "', `my_cat` = '" . $data['my_cat'] . "', `my_qu` = '" . $this->db->escape($data['my_qu']) . "', `my_price` = '" . $data['my_price'] . "', `my_descrip` = '" . $this->db->escape($data['my_descrip']) . "', `my_manuf` = '" . $this->db->escape($data['my_manuf']) . "', `my_mark` = '" . $this->db->escape($data['my_mark']) . "', `weight` = '" . $this->db->escape($data['weight']) . "', `length` = '" . $this->db->escape($data['length']) . "', `width` = '" . $this->db->escape($data['width']) . "', `height` = '" . $this->db->escape($data['height']) ."', `parent` = '" . $data['parent'] ."', `hide` = '" . $data['hide'] ."', `newphoto` = '" . $this->db->escape($data['newphoto']) ."', `my_photo` = '" . $this->db->escape($data['my_photo']) ."', `cheap` = '" . $data['cheap'] ."', `addopt` = '" . $data['addopt'] ."', `addseo` = '" . $data['addseo'] . "', `related` = '" . $this->db->escape($data['related']) ."', `updte` = '" . $data['updte'] . "', `pmanuf` = '" . $data['pmanuf'] ."', `upattr` = '" . $data['upattr']."', `upopt` = '" . $data['upopt']. "', `upname` = '" . $data['upname']. "', `myplus` = '" . $data['myplus']. "', `cprice` = '" . $data['cprice']. "', `minus` = '" . $data['minus']. "', `chcode` = '" . $data['chcode']. "',  `importseo` = '" . $data['importseo'] ."', `sorder` = '" . $data['sorder']."', `spec` = '" . $data['spec']."', `upurl` = '" . $data['upurl']."', `ref` = '" . $data['ref']."', `ref1` = '" . $data['ref1']."', `addattr` = '" . $data['addattr'] ."', `exsame` = '" . 0 ."', `sku2` = '" . $data['sku2']."', `parss` = '" . $data['parss'] . "', `points` = '" . $this->db->escape($data['points']) . "', `places` = '" . $data['places'] . "', `parsi` = '" . $data['parsi'] . "', `pointi` = '" . $this->db->escape($data['pointi']) . "', `placei` = '" . $data['placei'] . "', `parsc` = '" . $data['parsc'] . "', `pointc` = '" . $this->db->escape($data['pointc']) . "', `placec` = '" . $data['placec'] . "', `parsp` = '" . $data['parsp'] . "', `pointp` = '" . $this->db->escape($data['pointp']) . "', `placep` = '" . $data['placep'] . "', `parsd` = '" . $data['parsd'] . "', `pointd` = '" . $this->db->escape($data['pointd']) . "', `placed` = '" . $data['placed'] . "', `parsm` = '" . $data['parsm'] . "', `pointm` = '" . $this->db->escape($data['pointm']) . "', `placem` = '" . $data['placem'] . "', `parsk` = '" . $data['parsk'] . "', `parsq` = '" . $data['parsq'] . "', `pointq` = '" . $this->db->escape($data['pointq']) . "', `placeq` = '" . $data['placeq'] . "', `bprice` = '" . $data['bprice'] . "', `kmenu` = '" . $data['kmenu'] . "', `catcreate` = '" .  0 . "', `stay` = '" . $data['stay'] . "', `joen` = '" . $data['joen'] . "', `off` = '" . $data['off'] . "', `umanuf` = '" . $data['umanuf'] . "', `onn` = '" . $data['onn'] . "', `refer` = '" . $data['refer'] . "', `disc` = '" . $data['disc'] . "', `newurl` = '" . $data['newurl'] ."', `upc` = '" . $data['upc'] . "', `ean` = '" . $data['ean'] . "', `mpn` = '" . $data['mpn'] . "', `ddata` = '" . 0 ."', `bonus` = '" . $data['bonus'] ."', `ddesc` = '" . $data['ddesc'] ."', `qu_discount` = '" . $data['qu_discount'] ."', `plusopt` = '" . $data['plusopt'] ."', `idcat` = '" . $data['idcat'] ."', `t_ref` = '" . $data['t_ref'] ."', `t_ref1` = '" . $data['t_ref1'] ."', `termin` = '" . $data['termin'] ."', `t_status` = '" . $data['t_status'] ."', `onoff` = '" . $data['onoff'] ."',  `zero` = '" . $data['zero'] ."',  `metka` = '" . $data['metka'] ."', `jopt` = '" . $data['jopt'] ."', `optsku` = '" . $data['optsku'] ."', `newproduct` = '" . $data['newproduct'] ."', `opt_prices` = '" . $data['opt_prices'] . "', `opt_fotos` = '" . $data['opt_fotos'] . "', `usd` = '" . $data['usd'] . "', `serie` = '" . $data['serie'] . "', `sleep` = '" . $data['sleep'] . "', `ffile` = '" . $data['ffile'] . "'");
		
		$form_id = $this->db->getLastId();
				
		$i = 0;	
		foreach ($data['cat_ext'] as $value) {
		  if ($data['cat_ext'][$i]) {		  
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_data SET `form_id` = '" . (int)$form_id . "', `cat_ext` = '" . $this->db->escape($data['cat_ext'][$i]) . "', `category_id` = '" . (int)$data['category_id'][$i] . "', `pic_int` = '" . $data['pic_int'][$i] . "', `cat_plus` = '" . $data['cat_plus'][$i] . "'");
		  }
			$i = $i +1;
		}
	
		$i = 0;	
		foreach ($data['attr_ext'] as $value) {
		  if ($data['attr_ext'][$i]) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_attributes SET `form_id` = '" . (int)$form_id . "', `attr_ext` = '" . $this->db->escape($data['attr_ext'][$i]) . "', `attr_point` = '". $this->db->escape($data['attr_point'][$i]) . "', `attribute_id` = '" . (int)$data['attribute_id'][$i] . "', `tags` = '" . $data['tags'][$i] . "', `filter_group_id` = '" . (int)$data['filter_group_id'][$i] . "'");
		  }
			$i = $i +1;			
		}

		$i = 0;	
		foreach ($data['opt'] as $value) {
		  if ($data['opt'][$i]) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_options SET `form_id` = '" . (int)$form_id . "', `opt` = '" . $data['opt'][$i] . "', `option_id` = '" . (int)$data['option_id'][$i] . "', `opt_point` = '" . $data['opt_point'][$i] . "', `po` = '" . $this->db->escape($data['po'][$i]) ."', `ko` = '" . $this->db->escape($data['ko'][$i]) . "', `pr` = '" . $this->db->escape($data['pr'][$i]) ."', `we` = '" . $this->db->escape($data['we'][$i]) ."', `option_required` = '" . $this->db->escape($data['option_required'][$i]) ."', `art` = '" . $this->db->escape($data['art'][$i]) ."', `foto` = '" . $this->db->escape($data['foto'][$i]) ."'");
		  }
			$i = $i +1;			
		}
		
		$i = 0;	
		foreach ($data['nom'] as $value) {
		  if ($data['nom'][$i]) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_price SET `form_id` = '" . (int)$form_id . "', `nom` = '" . $data['nom'][$i] . "', `ident` = '" . $data['ident'][$i] . "', `param` = '" . $this->db->escape($data['param'][$i]) ."', `point` = '" . $this->db->escape($data['point'][$i]) . "', `noprice` = '" . $data['noprice'][$i] . "', `paramnp` = '" . $this->db->escape($data['paramnp'][$i]) ."', `pointnp` = '" . $this->db->escape($data['pointnp'][$i]) . "', `baseprice` = '" . $data['baseprice'][$i] ."'");
		  }
			$i = $i +1;			
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_seo SET `form_id` = '" . (int)$form_id . "', `prod_title` = '" . $this->db->escape($data['prod_title']) . "', `prod_meta_desc` = '" . $this->db->escape($data['prod_meta_desc']) ."', `prod_desc` = '" . $this->db->escape($data['prod_desc']) ."', `prod_keyword` = '" . $this->db->escape($data['prod_keyword']) ."', `prod_h1` = '" . $this->db->escape($data['prod_h1']) ."', `prod_photo` = '" . $this->db->escape($data['prod_photo']) ."', `cat_title` = '" . $this->db->escape($data['cat_title']) ."', `cat_meta_desc` = '" . $this->db->escape($data['cat_meta_desc']) ."', `cat_desc` = '" . $this->db->escape($data['cat_desc']) ."', `manuf_title` = '" . $this->db->escape($data['manuf_title']) ."', `manuf_meta_desc` = '" . $this->db->escape($data['manuf_meta_desc']) ."', `manuf_desc` = '" . $this->db->escape($data['manuf_desc']) ."', `seo_1` = '" . $this->db->escape($data['seo_1']) ."', `seo_2` = '" . $this->db->escape($data['seo_2']) ."', `seo_3` = '" . $this->db->escape($data['seo_3']) ."', `seo_4` = '" . $this->db->escape($data['seo_4']) ."', `seo_5` = '" . $this->db->escape($data['seo_5']) ."', `seo_6` = '" . $this->db->escape($data['seo_6']) ."', `seo_7` = '" . $this->db->escape($data['seo_7']) ."', `seo_8` = '" . $this->db->escape($data['seo_8']) ."', `seo_9` = '" . $this->db->escape($data['seo_9']) ."', `seo_10` = '" . $this->db->escape($data['seo_10']) ."', `seo_11` = '" . $this->db->escape($data['seo_11']) ."', `seo_12` = '" . $this->db->escape($data['seo_12']) ."', `seo_13` = '" . $this->db->escape($data['seo_13']) ."', `seo_14` = '" . $this->db->escape($data['seo_14']) ."', `seo_15` = '" . $this->db->escape($data['seo_15']) ."', `seo_16` = '" . $this->db->escape($data['seo_16']) ."', `seo_17` = '" . $this->db->escape($data['seo_17']) ."', `seo_18` = '" . $this->db->escape($data['seo_18']) ."', `seo_19` = '" . $this->db->escape($data['seo_19']) ."', `seo_20` = '" . $this->db->escape($data['seo_20']) ."'");
				
		$this->cache->delete('suppler');		
	}
		
	public function editsuppler($form_id, $data) {
		if (!isset($data['suppler_id']) or !$data['suppler_id']) return;
		
		if ($data['name'] == "New" or $data['name'] == "new" or $data['name'] == "NEW")  {
		    unset($data['cat_ext'],$data['cat_plus'],$data['category_id'],$data['pic_int']);
			$rows = $this->getSupplerData($form_id);
			for ($i=0; $i<5000; $i++) {
				if (!isset($rows[$i]['cat_ext'])) break;
				$data['cat_ext'][$i] = $rows[$i]['cat_ext'];
				$data['cat_plus'][$i] = $rows[$i]['cat_plus'];
				$data['category_id'][$i] = $rows[$i]['category_id'];
				$data['pic_int'][$i] = $rows[$i]['pic_int'];
			}			
			$this->addSuppler($data);
			return;
		}	
			
		$data['rate'] = str_replace(',','.',trim($data['rate']));
		if (!$data['rate']) $data['rate'] = 1.0;
		$data['ratep'] = str_replace(',','.',trim($data['ratep']));
		if (!$data['ratep']) $data['ratep'] = 1.0;
		$data['ratek'] = str_replace(',','.',trim($data['ratek']));
		if (!$data['ratek']) $data['ratek'] = 1.0;
	
		$lang = $this->config->get('config_language_id');
		if (isset($data['main'])) $main = 1;
		else $main = 0;
			
      	$this->db->query("UPDATE " . DB_PREFIX . "suppler SET `suppler_id` =  '". $data['suppler_id'] . "', `name` = '" . $this->db->escape($data['name']) . "', `main` = '" . $main . "', `sort_order` = '" . $lang . "', `rate` = '" . $data['rate'] . "', `ratep` = '" . $data['ratep'] . "', `ratek` = '" . $data['ratek'] . "', `cod` = '" . $this->db->escape($data['cod']) . "', `item` = '" . $this->db->escape($data['item']) . "', `cat` = '" . $this->db->escape($data['cat']) . "', `qu` = '" . $this->db->escape($data['qu']) . "', `price` = '" . $this->db->escape($data['price']) . "', `descrip` = '" . $this->db->escape($data['descrip']) . "', `pic_ext` = '" . $this->db->escape($data['pic_ext']) . "', `manuf` = '" . $this->db->escape($data['manuf']) . "', `warranty` = '" . $this->db->escape($data['warranty']) . "', `ad` = '" . $data['ad'] . "', `status` = '" . $data['status'] . "', `my_cat` = '" . $data['my_cat'] . "', `my_qu` = '" . $this->db->escape($data['my_qu']) . "', `my_price` = '" . $data['my_price'] . "', `my_descrip` = '" . $this->db->escape($data['my_descrip']) . "', `my_manuf` = '" . $this->db->escape($data['my_manuf']) . "', `my_mark` = '" . $this->db->escape($data['my_mark']) . "', `weight` = '" . $this->db->escape($data['weight']) . "', `length` = '" . $this->db->escape($data['length']) . "', `width` = '" . $this->db->escape($data['width']) . "', `height` = '" . $this->db->escape($data['height']) . "', `parent` = '" . $data['parent'] . "', `hide` = '" . $data['hide'] . "', `newphoto` = '" . $this->db->escape($data['newphoto']) ."', `my_photo` = '" . $this->db->escape($data['my_photo']) ."', `cheap` = '" . $data['cheap'] ."', `addopt` = '" . $data['addopt'] ."', `addseo` = '" . $data['addseo'] . "', `related` = '" . $this->db->escape($data['related']) . "', `updte` = '" . $data['updte'] . "', `pmanuf` = '" . $data['pmanuf'] . "', `upattr` = '" . $data['upattr']."', `upopt` = '" . $data['upopt']. "', `upname` = '" . $data['upname']. "', `myplus` = '" . $data['myplus']. "', `cprice` = '" . $data['cprice']. "', `minus` = '" . $data['minus']. "', `chcode` = '" . $data['chcode']. "',  `importseo` = '" . $data['importseo'] ."', `sorder` = '" . $data['sorder']."', `spec` = '" . $data['spec']."', `upurl` = '" . $data['upurl']."', `ref` = '" . $data['ref']."', `ref1` = '" . $data['ref1']."', `addattr` = '" . $data['addattr'] ."', `exsame` = '" . 0 ."', `sku2` = '" . $data['sku2']."', `parss` = '" . $data['parss'] . "', `points` = '" . $this->db->escape($data['points']) . "', `places` = '" . $data['places'] . "', `parsi` = '" . $data['parsi'] . "', `pointi` = '" . $this->db->escape($data['pointi']) . "', `placei` = '" . $data['placei'] . "', `parsc` = '" . $data['parsc'] . "', `pointc` = '" . $this->db->escape($data['pointc']) . "', `placec` = '" . $data['placec'] . "', `parsp` = '" . $data['parsp'] . "', `pointp` = '" . $this->db->escape($data['pointp']) . "', `placep` = '" . $data['placep'] . "', `parsd` = '" . $data['parsd'] . "', `pointd` = '" . $this->db->escape($data['pointd']) . "', `placed` = '" . $data['placed'] . "', `parsm` = '" . $data['parsm'] . "', `pointm` = '" . $this->db->escape($data['pointm']) . "', `placem` = '" . $data['placem'] . "', `parsk` = '" . $data['parsk'] . "',`parsq` = '" . $data['parsq'] . "', `pointq` = '" . $this->db->escape($data['pointq']) . "', `placeq` = '" . $data['placeq'] . "', `bprice` = '" . $data['bprice'] . "', `kmenu` = '" . $data['kmenu'] . "', `catcreate` = '" .  0 . "', `stay` = '" . $data['stay'] . "', `joen` = '" . $data['joen'] . "', `off` = '" . $data['off'] . "', `umanuf` = '" . $data['umanuf'] . "', `onn` = '" . $data['onn'] . "', `refer` = '" . $data['refer'] . "', `disc` = '" . $data['disc'] . "', `newurl` = '" . $data['newurl'] ."', `upc` = '" . $data['upc'] . "', `ean` = '" . $data['ean'] . "', `mpn` = '" . $data['mpn'] . "', `ddata` = '" . 0 ."', `bonus` = '" . $data['bonus'] ."', `ddesc` = '" . $data['ddesc'] ."', `qu_discount` = '" . $data['qu_discount'] ."', `plusopt` = '" . $data['plusopt'] ."', `idcat` = '" . $data['idcat'] ."', `t_ref` = '" . $data['t_ref'] ."', `t_ref1` = '" . $data['t_ref1'] ."', `termin` = '" . $data['termin'] ."', `t_status` = '" . $data['t_status'] ."', `onoff` = '" . $data['onoff'] ."',  `zero` = '" . $data['zero'] ."',  `metka` = '" . $data['metka'] ."',  `jopt` = '" . $data['jopt'] ."', `optsku` = '" . $data['optsku'] ."', `newproduct` = '" . $data['newproduct'] ."', `opt_prices` = '" . $data['opt_prices'] . "', `opt_fotos` = '" . $data['opt_fotos'] . "', `usd` = '" . $data['usd'] . "', `serie` = '" . $data['serie'] . "', `sleep` = '" . $data['sleep'] . "', `ffile` = '" . $data['ffile'] . "' WHERE `form_id` = '" . (int)$form_id . "'");
		
		for ($i=0; $i<50; $i++) {
			if (!isset($data['nom_id'][$i])) break;
			if (isset($data['del'][$i])) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_data WHERE `nom_id`='" . (int)$data['del'][$i]. "'");
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "suppler_data SET `cat_ext` = '" . $this->db->escape($data['cat_ext'][$i+3]) . "', `category_id` = '" . (int)$data['category_id'][$i+3] . "', `pic_int` = '" . $data['pic_int'][$i+3] . "', `cat_plus` = '" . $data['cat_plus'][$i+3] . "' WHERE `nom_id`='" . (int)$data['nom_id'][$i]. "'");
			}
			
		}
		for ($i=0; $i<3; $i++) {
			if ($data['cat_ext'][$i]) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_data SET `form_id` = '" . (int)$form_id . "', `cat_ext` = '" . $this->db->escape($data['cat_ext'][$i]) . "', `category_id` = '" . (int)$data['category_id'][$i] . "', `pic_int` = '" . $data['pic_int'][$i] . "', `cat_plus` = '" . $data['cat_plus'][$i] . "'");
			}	
		}		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_attributes WHERE `form_id`='" . (int)$form_id. "'");
		
		$i = 0;			
		foreach ($data['attr_ext'] as $value) {
		  if ($data['attr_ext'][$i]) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_attributes SET `form_id` = '" . (int)$form_id . "', `attr_ext` = '" . $this->db->escape($data['attr_ext'][$i]) . "', `attr_point` = '". $this->db->escape($data['attr_point'][$i]) . "', `attribute_id` = '" . (int)$data['attribute_id'][$i] . "', `tags` = '" . $data['tags'][$i] . "', `filter_group_id` = '" . (int)$data['filter_group_id'][$i] . "'");
		  }
			$i = $i +1;			
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_options WHERE `form_id`='" . (int)$form_id. "'");
		
		$i = 0;	
		foreach ($data['opt'] as $value) {
		  if ($data['opt'][$i]) {		
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_options SET `form_id` = '" . (int)$form_id . "', `opt` = '" . $data['opt'][$i] . "', `option_id` = '" . (int)$data['option_id'][$i] . "', `opt_point` = '" . $data['opt_point'][$i] . "', `po` = '" . $this->db->escape($data['po'][$i]) ."', `ko` = '" . $this->db->escape($data['ko'][$i]) . "', `pr` = '" . $this->db->escape($data['pr'][$i]) ."', `we` = '" . $this->db->escape($data['we'][$i]) ."',   `option_required` = '" . $this->db->escape($data['option_required'][$i]) ."', `art` = '" . $this->db->escape($data['art'][$i]) ."', `foto` = '" . $this->db->escape($data['foto'][$i]) ."'");
		  }
			$i = $i +1;			
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_price WHERE `form_id`='" . (int)$form_id. "'");
		
		$i = 0;	
		foreach ($data['nom'] as $value) {
		  if ($data['nom'][$i]) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_price SET `form_id` = '" . (int)$form_id . "', `nom` = '" . $data['nom'][$i] . "', `ident` = '" . $data['ident'][$i] . "', `param` = '" . $this->db->escape($data['param'][$i]) ."', `point` = '" . $this->db->escape($data['point'][$i]) . "', `noprice` = '" . $data['noprice'][$i] . "', `paramnp` = '" . $this->db->escape($data['paramnp'][$i]) ."', `pointnp` = '" . $this->db->escape($data['pointnp'][$i]) . "', `baseprice` = '" . $data['baseprice'][$i] ."'");
		  }
			$i = $i +1;			
		}		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_seo WHERE `form_id`='" . (int)$form_id. "'");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_seo SET `form_id` = '" . (int)$form_id . "', `prod_title` = '" . $this->db->escape($data['prod_title']) . "', `prod_meta_desc` = '" . $this->db->escape($data['prod_meta_desc']) ."', `prod_desc` = '" . $this->db->escape($data['prod_desc']) ."', `prod_keyword` = '" . $this->db->escape($data['prod_keyword']) ."', `prod_h1` = '" . $this->db->escape($data['prod_h1']) ."', `prod_photo` = '" . $this->db->escape($data['prod_photo']) ."',  `cat_title` = '" . $this->db->escape($data['cat_title']) ."', `cat_meta_desc` = '" . $this->db->escape($data['cat_meta_desc']) ."', `cat_desc` = '" . $this->db->escape($data['cat_desc']) ."', `manuf_title` = '" . $this->db->escape($data['manuf_title']) ."', `manuf_meta_desc` = '" . $this->db->escape($data['manuf_meta_desc']) ."', `manuf_desc` = '" . $this->db->escape($data['manuf_desc']) ."', `seo_1` = '" . $this->db->escape($data['seo_1']) ."', `seo_2` = '" . $this->db->escape($data['seo_2']) ."', `seo_3` = '" . $this->db->escape($data['seo_3']) ."', `seo_4` = '" . $this->db->escape($data['seo_4']) ."', `seo_5` = '" . $this->db->escape($data['seo_5']) ."', `seo_6` = '" . $this->db->escape($data['seo_6']) ."', `seo_7` = '" . $this->db->escape($data['seo_7']) ."', `seo_8` = '" . $this->db->escape($data['seo_8']) ."', `seo_9` = '" . $this->db->escape($data['seo_9']) ."', `seo_10` = '" . $this->db->escape($data['seo_10']) ."', `seo_11` = '" . $this->db->escape($data['seo_11']) ."', `seo_12` = '" . $this->db->escape($data['seo_12']) ."', `seo_13` = '" . $this->db->escape($data['seo_13']) ."', `seo_14` = '" . $this->db->escape($data['seo_14']) ."', `seo_15` = '" . $this->db->escape($data['seo_15']) ."', `seo_16` = '" . $this->db->escape($data['seo_16']) ."', `seo_17` = '" . $this->db->escape($data['seo_17']) ."', `seo_18` = '" . $this->db->escape($data['seo_18']) ."', `seo_19` = '" . $this->db->escape($data['seo_19']) ."', `seo_20` = '" . $this->db->escape($data['seo_20']) ."'");
				
		$this->cache->delete('suppler');		
	}
	
	public function deletesuppler($form_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler WHERE `form_id` = '" . (int)$form_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_data WHERE `form_id` = '" . (int)$form_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_attributes WHERE `form_id`='" . (int)$form_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_options WHERE `form_id`='" . (int)$form_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_price WHERE `form_id`='" . (int)$form_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_seo WHERE `form_id`='" . (int)$form_id. "'");
		
		$this->cache->delete('suppler');
	}
	
	public function getAllCategories($form_id) {
		$row = $this->getsuppler($form_id);
		$store = 0;
		if (!empty($row)) $store = $row['addattr'];		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$store . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

		$category_data = array();
		foreach ($query->rows as $row) {
			$category_data[$row['parent_id']][$row['category_id']] = $row;
		}		

		return $category_data;
	}
	
	public function getAllFilters() {
		$filters = '';
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_group_description WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");
		
		$filters = array();
		$i=0;
		foreach ($query->rows as $row) {
			$filters[$i]['filter_group_id'] = $row['filter_group_id'];			
			$filters[$i]['name'] = $row['name'];
			$i++;
		}	
		return $filters;	
	}	
	
	public function getAllManufacturers($form_id) {
		$row = $this->getsuppler($form_id);
		$store = 0;
		if (!empty($row)) $store = $row['addattr'];
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$store . "'");
		
		return $query->rows;
	}
	
	public function getManufacturerDesc($manufacturer_id, $lang) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer_description WHERE `manufacturer_id` = '" . $manufacturer_id . "' and `language_id` = '" . $lang . "'");
		
		return $query->rows;
	}
	
	public function getManufacturerStore($manufacturer_id, $store) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id = '" . $manufacturer_id . "' AND m2s.store_id = '" . (int)$store . "'");
		
		return $query->rows;
	}
	
	public function getCategoryStore($category_id, $store) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . $category_id . "' AND c2s.store_id = '" . (int)$store . "'");
		
		return $query->rows;
	}
	
	public function getChildCategory($parent_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE parent_id = '" . $parent_id . "'");
		
		return $query->rows;
	}
	
	public function getDataForm($cat, $form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_data WHERE `form_id` = '" . (int)$form_id . "' and `cat_ext` = '" . $cat . "'");
		
		return $query->rows;
	}
	
	public function getsuppler($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler WHERE `form_id` = '" . (int)$form_id . "'");
		
		return $query->row;
	}

	public function getStatus($config_language_id, $status, $num_status) {
		$rows = $this->getlanguages();
		if (!empty($rows)) {
			$status_ = 999;
			if ((isset($rows[0]['locale']) or !empty($rows[0]['locale'])) and $config_language_id == substr($status,8,2)) {
				$language_id = $this->config->get('config_language_id');
				$status_ = round($config_language_id, 0)/round($num_status, 0) - 1;
			} else {
				$l = $this->config->get('config_language_id');
				$language_id = $rows[0]['status'] - $l;
			}
		}	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "stock_status WHERE `language_id` = '" . $language_id . "' and `stock_status_id` > '" . $status_ . "'");
		return $query->rows;	
	}

	public function getSupplerOptions($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_options WHERE `form_id` = '" . (int)$form_id . "' ORDER BY nom_id");
			
		return $query->rows;
	}	
	
	public function getLink($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_ref WHERE `product_id` = '" . $product_id . "' ORDER BY ident ASC");
			
		return $query->rows;
	}
	
	public function getSupplerSEO($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_seo WHERE `form_id` = '" . (int)$form_id . "'");
			
		return $query->rows;
	}	
	
	public function getBonus1($customer_group_id, $product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE `product_id` = '" . $product_id . "' AND `customer_group_id` = '" . $customer_group_id . "'");
			
		return $query->rows;
	}
	
	public function deleteBonus0($product_id) {
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET `points` = '" . '' . "' WHERE `product_id` = '" . $product_id . "'");		
	}
	
	public function deleteBonus1($customer_group_id, $product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE `product_id` = '" . $product_id . "' and `customer_group_id` = '". $customer_group_id . "'");		
	}
	
	public function Bonus0($product_id, $value) {	
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET `points` = '" . $value . "' WHERE `product_id` = '" . $product_id . "'");		
	}
	
	public function Bonus1($customer_group_id, $product_id, $value) {
		$rows = $this->getBonus1($customer_group_id, $product_id);
		if (!empty($rows)) {
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_reward SET `points` = '" . $value . "' WHERE `product_id` = '" . $product_id . "' AND `customer_group_id` = '". $customer_group_id . "'");
		} else {
			$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET `points` = '" . $value . "',   `product_id` = '" . $product_id . "', `customer_group_id` = '" . $customer_group_id . "'");
		}	
	}
	
	public function getProductSerie($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_series WHERE `product_id` = '" . $product_id . "'");
			
		return $query->rows;
	}
	
	public function getlanguages() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language ORDER BY `language_id` ASC");
			
		return $query->rows;
	}
	
	public function getAllLanguages() {
		$rows = $this->getlanguages();
		for ($i=1; $i<20; $i++) {
			if (!isset($rows[$i-1]['language_id'])) break;
			$langs[$i] = $rows[$i-1]['language_id'];
		}
		return $langs;	
	}
	
	public function isFilterInProduct($product_id, $filter) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE `filter_id` = '" . (int)$filter . "' and `product_id` = '" . (int)$product_id . "'");
		
		return $query->row;
	}
	
	public function AttributeToFilter($product_id, $filters) {
		for ($i=0; $i<3; $i++) {
			if ($filters[$i]) {
				$row = $this->isFilterInProduct($product_id, $filters[$i]);
				if (empty($row)) {
					$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET `product_id` = '" . (int)$product_id . "', `filter_id` = '" . (int)$filters[$i] . "'");
				}
			}
		}	
	}

	public function findFilter($text, $filter_group_id, &$filter_id) {
		$filter_id = 0;
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_description WHERE `filter_group_id` = '" . $filter_group_id . "' and `name` = '" . $this->db->escape($text) . "'");
		
		if (!empty($query->row)) $filter_id = $query->row['filter_id'];
	}
	
	public function checkFilter($text, $filter_group_id, $lang, &$filter_id) {
		$filter_id = 0;
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_description WHERE `filter_group_id` = '" . $filter_group_id . "' and `name` = '" . $this->db->escape($text) . "' and `language_id` = '" . $lang . "'");
		
		if (!empty($query->row)) $filter_id = $query->row['filter_id'];
	}	
	
	public function CreateFilter($data, $filter_group_id, $langs, &$filters) {
		$filters[0] = 0;
		$filters[1] = 0;
		$filters[2] = 0;
		if (!empty($data['text1'])) {
			$this->checkFilter($data['text1'], $filter_group_id, $langs[1], $filter_id);
			if ($filter_id) $filters[0] = $filter_id;			
		}
		if (!empty($data['text2'])) {
			$this->checkFilter($data['text2'], $filter_group_id, $langs[2], $filter_id);
			if ($filter_id) $filters[1] = $filter_id;			
		}
		if (!empty($data['text3'])) {
			$this->checkFilter($data['text3'], $filter_group_id, $langs[3], $filter_id);
			if ($filter_id) $filters[2] = $filter_id;			
		}	
		for ($i=0; $i<3; $i++) {
			if (!$filters[$i]) {
				if ($i == 0) $name = $data['text1'];
				if ($i == 1) $name = $data['text2'];
				if ($i == 2) $name = $data['text3'];
				if (isset($langs[$i+1]) and !empty($name)) {	
					$query = $this->db->query("INSERT INTO " . DB_PREFIX . "filter SET `filter_group_id` = '" . (int)$filter_group_id . "', `sort_order` = '" . 0 . "'");
				
					$id = $this->db->getLastId();
				
					$query = $this->db->query("INSERT INTO " . DB_PREFIX . "filter_description SET  `filter_id` = '" . $id . "', `filter_group_id` = '" . (int)$filter_group_id . "', `language_id` = '" . (int)$langs[$i+1] . "', `name` = '" . $this->db->escape($name) . "'");
				
					$filters[$i] = $id;
				}
			}
		}		
	}	
	
	public function getOptionsOfProduct($option_id, $option_value_id, $lang) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE `option_value_id` = '" . $option_value_id . "' and `option_id` = '" . $option_id . "' and `language_id` = '" . $lang . "'");
			
		return $query->rows;	
	}
	
	public function getOptionsById($option_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE `option_id` = '" . (int)$option_id . "'");
			
		return $query->rows;
	}

	public function getOptionsType($option_id) {		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option`  WHERE option_id = '" . (int)$option_id . "'");
			
		return $query->row;
	}
	
	public function addValueDescription($option_id, $ovid, $opt_val, $langs) {	
		for	($i=1; $i<=count($langs); $i++) {					
			$query = $this->db->query("INSERT INTO " . DB_PREFIX . "option_value_description SET `option_value_id` = '" . (int)$ovid . "', `language_id` = '" . $langs[$i] . "', `option_id` = '" . (int)$option_id . "', `name` = '" . $this->db->escape($opt_val) . "'");
		}
		$this->cache->delete('option');	
	}
	
	public function upOptionFoto($option_id, $option_value_id, $foto) {
		$query = $this->db->query("UPDATE " . DB_PREFIX . "option_value SET `image` = '" . $foto . "' WHERE `option_id` = '" . (int)$option_id . "' and `option_value_id` = '" . (int)$option_value_id . "'");	
		
	}	
	
	public function addValue($option_id, &$ovid, $foto) {
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "option_value SET `option_id` = '" . (int)$option_id . "', `image` = '" . $foto . "', `sort_order` = '" . 0 . "'");
		
		$ovid = $this->db->getLastId();
	
		$this->cache->delete('option');
	
	}
	
	public function getOptionID($name) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_description WHERE `name` = '" . $this->db->escape($name) . "'");
		
		return $query->rows;
	}
	
	public function getOptionValue($product_id, $option_value_id, $sku) {
		if (!$sku) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `option_value_id` = '" . (int)$option_value_id. "' and `product_id` = '" . (int)$product_id . "'");
		} else {
			if ($option_value_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `product_id` = '" . (int)$product_id . "' and `optsku` = '" . $this->db->escape($sku) . "' and `option_value_id` = '" . (int)$option_value_id . "'");
			} else {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `product_id` = '" . (int)$product_id . "' and `optsku` = '" . $this->db->escape($sku) . "'");
			}	
		}
		return $query->rows;
	}	
	
	public function getProductOption($product_id, $option_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option WHERE `option_id` = '" . (int)$option_id. "'  and `product_id` = '" . $product_id . "'");
		
		return $query->rows;
	}
	
	public function getProductOptionValue($product_id, $option_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `option_id` = '" . (int)$option_id. "'  and `product_id` = '" . $product_id . "'");
		
		return $query->rows;
	}
	
	public function getProductAllOptionValue($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `product_id` = '" . $product_id . "'");
		
		return $query->rows;
	}
	
	public function getProductAllOption($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option WHERE `product_id` = '" . $product_id . "'");
		
		return $query->rows;
	}
	
	public function isProductOption($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `product_id` = '" . $product_id . "'");
		
		return $query->rows;
	}
	
	public function cleanQuantityOption($product_id) {
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET `quantity` = '" . 0 . "' WHERE `product_id` = '" . (int)$product_id . "'");	

		$query = $this->db->query("UPDATE " . DB_PREFIX . "relatedoptions SET `quantity` = '" . 0 . "' WHERE `product_id` = '" . (int)$product_id . "'");
	
		$this->cache->delete('option');
	}
		
	public function upOptionPlus($id, $price, $prefix) {
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET `price` = '" . $price . "', `price_prefix` = '" .$prefix . "' WHERE `product_option_value_id` = '" . (int)$id . "'");
	}
	
	public function upProductOption($product_id, $option_id, $data_option, $subtract, $ad, $type, $my_price, $usd, $uu) {	
		$prod_opt_id = 0;
		$rows = $this->getProductOption($product_id, $option_id);
		if ($option_id) {
			if (empty($rows)) {
				if (!empty($data_option['opt'])) {
					if ($type == 'text') {
						$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET `product_id` = '" . (int)$product_id . "', `option_value` = '" . $this->db->escape($data_option['opt']) . "', `option_id` = '" . (int)$option_id . "', `required` = '" . $data_option['option_required'] . "'");
					} else {
						$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET `product_id` = '" . (int)$product_id . "', `option_id` = '" . (int)$option_id . "', `required` = '" . $data_option['option_required'] . "'");
					}
					$prod_opt_id = $this->db->getLastId();
				}							
			} else {
				if (!empty($data_option['opt'])) {
					if ($type == 'text') {
						$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option SET `required` = '" . $data_option['option_required'] . "', `option_value` = '" . $this->db->escape($data_option['opt']) . "' WHERE `product_id` = '" . (int)$product_id . "' AND `option_id` = '" . (int)$option_id . "'");
					} else {
						$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option SET `required` = '" . $data_option['option_required'] . "' WHERE `product_id` = '" . (int)$product_id . "' AND `option_id` = '" . (int)$option_id . "'");
					}
					$prod_opt_id = $rows[0]['product_option_id'];
				}				
			}
		}
		if ($type == 'text') return;	

		$rows = $this->getOptionValue($product_id, $data_option['op_val_id'], $data_option['optsku']);		
		if (empty($rows)) {
			if ($data_option['op_val_id'] and $prod_opt_id and $option_id) {
				$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET `product_option_id` = '" . (int)$prod_opt_id . "', `product_id` = '" . (int)$product_id. "', `option_id` = '" . (int)$option_id. "', `option_value_id` = '" . (int)$data_option['op_val_id'] . "', `quantity` = '" . (int)$data_option['ko'] . "', `subtract` = '" . (int)$subtract . "', `price` = '" . $data_option['pr'] . "', `price_prefix` = '" . $data_option['pr_prefix'] . "', `points` = '" . (int)$data_option['po'] . "', `points_prefix` = '" . $data_option['po_prefix'] . "', `weight` = '" . $data_option['we'] . "', `weight_prefix` = '" . $data_option['we_prefix'] . "', `optsku` = '" . $data_option['optsku'] . "'");
			}
		} else {		
			$st = "UPDATE " . DB_PREFIX . "product_option_value SET `subtract` = '" . (int)$subtract . "'";
			$e = 0;
			if ($my_price == 1) $e = 1;
			if ($my_price == 2 and (float)$rows[0]['price'] < (float)$data_option['pr']) $e = 1;			
			if ($my_price == 3 and (float)$rows[0]['price'] > (float)$data_option['pr']) $e = 1;
			
			if ($e and $ad != 4) $st = $st . ", `quantity` = '" . (int)$data_option['ko'] . "'";
			if ($ad != 2) {					
				if (($e or !$data_option['pr']) and $data_option['ko']) 	
				$st = $st . " , `price` = '" . $data_option['pr'] . "', `price_prefix` = '" . $data_option['pr_prefix'] . "'";
				if ($e and $usd and $uu != '') {
					if ($uu == '0') $uu = '';
					$st = $st . " , `base_price` = '" . $data_option['pr'] . "'";
				}
			}				
			if ($e and $ad != 2 and $ad != 4 and (int)$data_option['po']) $st = $st . " , `points` = '" . (int)$data_option['po'] . "', `points_prefix` = '" . $data_option['po_prefix'] . "'";
			
			if ($e and $ad != 2 and $ad != 4 and (int)$data_option['we']) $st = $st . " , `weight` = '" . $data_option['we'] . "', `weight_prefix` = '" . $data_option['we_prefix'] . "'";
	
			if (!$data_option['optsku'] and $data_option['op_val_id']) {
				$st = $st ." WHERE `option_value_id` = '" . $data_option['op_val_id'] . "' and `product_id` = '" . (int)$product_id . "'";
			}				
			if ($data_option['optsku'] and !$data_option['op_val_id']) {
				$st = $st ." WHERE `optsku` = '" . $this->db->escape($data_option['optsku']) . "' and `product_id` = '" . (int)$product_id . "'";
			}
			if ($data_option['optsku'] and $data_option['op_val_id']) {				
				$st = $st ." WHERE `optsku` = '" . $this->db->escape($data_option['optsku']) . "' and `option_value_id` = '" . (int)$data_option['op_val_id'] . "' and `product_id` = '" . (int)$product_id . "'";
			}	
			$query = $this->db->query($st);	
		}		
		$this->cache->delete('option');		
	}
	
	public function getVariant($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "relatedoptions_variant_product WHERE `product_id` = '" . $product_id. "'");
			
		return $query->row;
	}
		
	public function getGroups($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "relatedoptions_option WHERE `product_id` = '" . $product_id. "' ORDER BY `relatedoptions_id` ");
			
		return $query->rows;
	}	
	
	public function getLayout($product_id, $store) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE `product_id` = '" . $product_id. "' and `store_id` = '" . $store . "'");
			
		return $query->rows;
	}
	
	public function getjOptionsID($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "relatedoptions_option WHERE `product_id` = '" . $product_id . "'");
			
		return $query->rows;
	}
	
	public function getGroupSumma($product_id, $gr) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "relatedoptions WHERE `product_id` = '" . $product_id. "' and  `relatedoptions_id` = '" . $gr . "'");
			
		return $query->row;
	
	}
	
	public function getAllGroups($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "relatedoptions WHERE `product_id` = '" . $product_id. "'");
			
		return $query->rows;
	
	}
	
	public function summaOption($product_id, &$sum) {
		$rows = $this->getjOptionsID($product_id);
		if (!empty($rows)) {
			$min = 0;
			foreach ($rows as $val) {
				if ($val['option_value_id'] < $min) $min = $val['option_value_id'];			
			}
			$summ = array();
			for ($i=0; $i<5000; $i++) {
				$summ[$i] = 0;
			}	
			for ($i=0; $i<200; $i++) {
				if (!isset($rows[$i]['option_value_id'])) break;
				$row = $this->getGroupSumma($product_id, $rows[$i]['relatedoptions_id']);
				if (!empty($row)) {
					$v = $rows[$i]['option_value_id'] - $min;
					$summ[$v] = $summ[$v] + $row['quantity'];
				}
			}
			$dim = count($summ);
			for ($i=0; $i<$dim; $i++) {
				if (!isset($summ[$i]) or empty($summ[$i])) continue;
				$v = $i + $min;
				$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET `quantity` = '" . $summ[$v] . "' WHERE `product_id` = '" . (int)$product_id . "' AND `option_value_id` = '" . $v . "'");
			}				
				
		}
		
		$rows = $this->getAllGroups($product_id);
		if (!empty($rows)) {
			$sum = 0;
			foreach ($rows as $val) {
				$sum = $sum + $val['quantity'];
			}
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET `quantity` = '" . $sum . "' WHERE `product_id` = '" . (int)$product_id . "'");		
		}
		unset($summ);
	}
	
	public function jOption($gr_data) {		
		$mas1 = array();
		$mas2 = array();
		$rows = $this->getGroups($gr_data[1][1]);			
		$found = 0;
		$nom = 0;
		while(1) {	
			if (!isset($rows[$nom]['relatedoptions_id'])) break;			
			$mas1 = '';
			$mas2 = '';
			$k = 0;
			for ($j=0; $j<10; $j++) {					
				if ($j == 0) {
					$mas1[$k] = $rows[$j+$nom]['option_id'];
					$mas2[$k] = $rows[$j+$nom]['option_value_id'];
					$gr = $rows[$j+$nom]['relatedoptions_id'];
				} else {
					if (isset($rows[$j+$nom]['relatedoptions_id']) and $rows[$j+$nom-1]['relatedoptions_id'] == $rows[$j+$nom]['relatedoptions_id']) {
						$k++;
						$mas1[$k] = $rows[$j+$nom]['option_id'];
						$mas2[$k] = $rows[$j+$nom]['option_value_id'];
					} else break;
				}
			}

			$found = 0;	
			$nom = $nom+$k+1;			
			for ($i=0; $i<10; $i++) {
				if (!isset($mas1[$i])) break;
				$ok = 0;
				for ($j=1; $j<10; $j++) {
					if (!isset($gr_data[$j][2])) break;
					if ($mas1[$i] == $gr_data[$j][2] and $mas2[$i] == $gr_data[$j][3]) {
						$ok = 1;
						break;
					}					
				}				
				if (!$ok) break;			
			}
			if ($ok) {
				$found = 1;	
				break;
			}	
		}
	
		if ($found) {
			$this->db->query("UPDATE " . DB_PREFIX . "relatedoptions SET `quantity` = '" . $gr_data[1][4] . "', `price` = '" .  $gr_data[1][5] . "', `model` = '" . $gr_data[1][8] . "', `weight` = '" . $gr_data[1][7] . "', `weight_prefix` = '" . $gr_data[1][6] . "' WHERE `relatedoptions_id` = '" . $gr . "' and `product_id` = '" . $gr_data[1][1]. "'");			
			
		} else {			
			$this->db->query("INSERT INTO " . DB_PREFIX . "relatedoptions SET `product_id` = '" . (int)$gr_data[1][1] . "', `quantity` = '" . (int)$gr_data[1][4] . "', `price` = '" .  $gr_data[1][5] . "', `model` = '" . $gr_data[1][8] . "', `weight` = '" . $gr_data[1][7] . "', `weight_prefix` = '" . $gr_data[1][6] . "'");	
			
			$next = $this->db->getLastId();
		
			for ($i=1; $i<10; $i++) {			
				if (!isset($gr_data[$i][3])) break;
	
				$this->db->query("INSERT INTO " . DB_PREFIX . "relatedoptions_option SET `relatedoptions_id` =  '" . $next . "', `product_id` = '" . (int)$gr_data[1][1] . "', `option_id` = '" . $gr_data[$i][2] . "', `option_value_id` = '" . $gr_data[$i][3] . "'");
			}			
		}
		
		$row = $this->getVariant($gr_data[1][1]);
		if (empty($row)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "relatedoptions_variant_product SET `relatedoptions_use` = '" . 1 . "', `product_id` = '" . $gr_data[1][1]. "'");
			
		} else $this->db->query("UPDATE " . DB_PREFIX . "relatedoptions_variant_product SET `relatedoptions_use` = '" . 1 . "' WHERE `product_id` = '" . $gr_data[1][1]. "'");
		
		unset($mas1);
		unset($mas2);
		$this->cache->delete('option');
	}
	
	public function getSupplerAttributes($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_attributes WHERE `form_id` = '" . (int)$form_id . "' ORDER BY nom_id");
			
		return $query->rows;
	}
	
	public function getAllAttr() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute ORDER BY attribute_id");
			
		return $query->rows;
	}
	
	public function	DelAttribute($attribute_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute WHERE attribute_id = '" . (int)$attribute_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute_description WHERE attribute_id = '" . (int)$attribute_id . "'");
	
	}	
	
	public function	DelAttributeInProduct($product_id, $attribute_id, $lang) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' and attribute_id = '" . $attribute_id . "' and language_id = '" . $lang . "'");
		
		$this->cache->delete('product');	
	}
	
	public function	deleteAttribute($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		
		$this->cache->delete('product');
	}
	
	public function	getAllAttributes() {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description");
				
		return $query->rows;
	}
	
	public function	getAttrib($product_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE `product_id` = '" . (int)$product_id . "'");
			
		return $query->rows;
	}
	
	public function	isProductAttribute($product_id, $attribute_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE `attribute_id` = '" . (int)$attribute_id . "' and `product_id` = '" . (int)$product_id . "'");
			
		return $query->rows;
	}
	
	public function	isProductByAttribute($attribute_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE `attribute_id` = '" . (int)$attribute_id . "'");
			
		return $query->rows;
	}
	
	public function	isAttribute($attribute_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute WHERE `attribute_id` = '" . (int)$attribute_id . "'");
			
		return $query->row;
	}
	
	public function	getAttributes($product_id) {
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE `product_id` = '" . (int)$product_id . "' and `language_id` = '" . $lang . "' ORDER BY attribute_id");
			
		return $query->rows;
	}
	
	public function	getAttributeID($name) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description WHERE `name` = '" . $this->db->escape($name) . "'");
			
		return $query->rows;
	}
	
	public function upDesc($newdesc, $id) {
		$lang = $this->config->get('config_language_id');
		$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($newdesc) . "' WHERE `product_id` = '" . $id . "' and `language_id` = '" . $lang. "'");
		
		$this->cache->delete('*');
	}	
	
	public function getMaxAttributeID() {	
		$query = $this->db->query("SELECT max(attribute_id) FROM " . DB_PREFIX . "attribute");
			
		return $query->row;
	}
	
	public function	checkAttribute($id, $lang) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description WHERE `attribute_id` = '" . (int)$id . "' and `language_id` = '" . $lang . "'");
			
		return $query->rows;
	}	
	
	public function	getAttributeName($id) {
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description WHERE `attribute_id` = '" . (int)$id . "' and `language_id` = '" . $lang . "'");
			
		return $query->rows;
	}	
	
	public function getAttributeById($product_id, $attribute_id, $lang) {        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE `product_id` = '" . (int)$product_id . "' and `attribute_id` = '". $attribute_id . "' and `language_id` = '". $lang. "'");
            
        return $query->rows;
    }	

	public function changeAttributeId($product_id, $attribute_id_new, $attribute_id_old) {		
		$rows = $this->isProductAttribute($product_id, $attribute_id_new);
		if (empty($rows)) {				
			$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `attribute_id` = '" . $attribute_id_new . "' WHERE `product_id` = '" . $product_id . "' and `attribute_id` = '" . $attribute_id_old. "'");
		} else {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' and `attribute_id` ='" . $attribute_id_old. "'");
		}
		$this->cache->delete('suppler');		
	}
	
	public function putAttributeById($data, $langs) {
		if (empty($data['text1'])) return;
        $text1 = $data['text1'];
        $text1 = htmlspecialchars($text1, ENT_COMPAT, 'UTF-8');
		$text2 = $data['text2'];
        $text2 = htmlspecialchars($text2, ENT_COMPAT, 'UTF-8');
		$text3 = $data['text3'];
        $text3 = htmlspecialchars($text3, ENT_COMPAT, 'UTF-8');
		if (preg_match('/^[0-9.,Ee+-]+$/', $text1)) $text1 = (string)round($text1, 3);
		if (preg_match('/^[0-9.,Ee+-]+$/', $text2)) $text2 = (string)round($text2, 3);
		if (preg_match('/^[0-9.,Ee+-]+$/', $text3)) $text2 = (string)round($text3, 3);
		
		if (!empty($text1)) {
			$rows = $this->getAttributeById((int)$data['product_id'], (int)$data['attribute_id'], $langs[1]);
			if (empty($rows)) {			
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET `product_id` = '" . (int)$data['product_id'] . "', `attribute_id` = '" . (int)$data['attribute_id'] . "', `language_id` = '" . $langs[1] . "', `text` = '" . $this->db->escape($text1) . "'");				
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($text1). "' WHERE `product_id` = '" . (int)$data['product_id'] . "' and `attribute_id` = '" . (int)$data['attribute_id'] . "' and `language_id` = '" . $langs[1] . "'");
			}
			if (empty($text2) and isset($langs[2])) {				
				if (empty($rows)) {			
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET `product_id` = '" . (int)$data['product_id'] . "', `attribute_id` = '" . (int)$data['attribute_id'] . "', `language_id` = '" . $langs[2] . "', `text` = '" . $this->db->escape($text1) . "'");				
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($text1). "' WHERE `product_id` = '" . (int)$data['product_id'] . "' and `attribute_id` = '" . (int)$data['attribute_id'] . "' and `language_id` = '" . $langs[2] . "'");
				}
			}
			if (empty($text3) and isset($langs[3])) {				
				if (empty($rows)) {			
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET `product_id` = '" . (int)$data['product_id'] . "', `attribute_id` = '" . (int)$data['attribute_id'] . "', `language_id` = '" . $langs[3] . "', `text` = '" . $this->db->escape($text1) . "'");				
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($text1). "' WHERE `product_id` = '" . (int)$data['product_id'] . "' and `attribute_id` = '" . (int)$data['attribute_id'] . "' and `language_id` = '" . $langs[3] . "'");
				}
			}
		}
		if (!empty($text2) and isset($langs[2])) {
			$rows = $this->getAttributeById((int)$data['product_id'], (int)$data['attribute_id'], $langs[2]);
			if (empty($rows)) {	
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET `product_id` = '" . (int)$data['product_id'] . "', `attribute_id` = '" . (int)$data['attribute_id'] . "', `language_id` = '" . $langs[2] . "', `text` = '" . $this->db->escape($text2) . "'");
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($text2). "' WHERE `product_id` = '" . (int)$data['product_id'] . "' and `attribute_id` = '" . (int)$data['attribute_id'] . "' and `language_id` = '" . $langs[2] . "'");
			}	
		}
		if (!empty($text3) and isset($langs[3])) {
			$rows = $this->getAttributeById((int)$data['product_id'], (int)$data['attribute_id'], $langs[3]);
			if (empty($rows)) {	
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET `product_id` = '" . (int)$data['product_id'] . "', `attribute_id` = '" . (int)$data['attribute_id'] . "', `language_id` = '" . $langs[3] . "', `text` = '" . $this->db->escape($text3) . "'");
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($text3). "' WHERE `product_id` = '" . (int)$data['product_id'] . "' and `attribute_id` = '" . (int)$data['attribute_id'] . "' and `language_id` = '" . $langs[3] . "'");
			}	
		}
        $this->cache->delete('attribute');        
    }	

	public function createAttribute($data, &$attID, $langs) {		
		if ((!empty($data['text2']) and count($langs) < 2) or (!empty($data['text3']) and count($langs) < 3) or empty($data['text1'])) {
			$attID = 0;
			return;
		}
		$t1 = 0;
		$t2 = 0;
		$t3 = 0;
		$rows = $this->getAttributeID($data['text1']);		
		if (!empty($rows)) {
			$t1 = 1;
			$attID1 = $rows[0]['attribute_id'];
		}	
		$rows = '';
		if (!empty($data['text2'])) $rows = $this->getAttributeID($data['text2']);
		if (!empty($rows)) {
			$t2 = 1;
			$attID2 = $rows[0]['attribute_id'];
		}
		$rows = '';
		if (!empty($data['text3'])) $rows = $this->getAttributeID($data['text3']);
		if (!empty($rows)) {
			$t3 = 1;
			$attID3 = $rows[0]['attribute_id'];
		}
			
		if (!$t1 and !$t2 and !$t3 and (!empty($data['text1']) or !empty($data['text2']) or !empty($data['text3']))) {				
			$this->db->query("INSERT INTO " . DB_PREFIX . "attribute SET attribute_group_id = '" . 1 . "', sort_order = '" . 0 . "'");
			
			$attID = $this->db->getLastId();
						
			$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[1] . "', name = '" . $this->db->escape($data['text1']) . "'");
			
			if (empty($data['text2']) and isset($langs[2])) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[2] . "', name = '" . $this->db->escape($data['text1']) . "'");
			}				
			if (empty($data['text3']) and isset($langs[3])) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text1']) . "'");
			}		
			if (!empty($data['text2']) and isset($langs[2])) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[2] . "', name = '" . $this->db->escape($data['text2']) . "'");			
			}
			if (!empty($data['text3']) and isset($langs[3])) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text3']) . "'");			
			}
			
		} 
		if ($t1 and !$t2) {
			$attID = $attID1;
			if (!empty($data['text2'])) {
				$rows = $this->checkAttribute($attID, $langs[2]);
				if (empty($rows) and isset($langs[2]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[2] . "', name = '" . $this->db->escape($data['text2']) . "'");			
			}		
		}
		if (!$t1 and $t2) {
			$attID = $attID2;
			if (!empty($data['text1'])) {
				$rows = $this->checkAttribute($attID, $langs[1]);
				if (empty($rows))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[1] . "', name = '" . $this->db->escape($data['text1']) . "'");
			}	
		}
		if (($t1 or $t2) and !$t3) {
			$attID = $attID1;
			if (!empty($data['text3'])) {
				$rows = $this->checkAttribute($attID, $langs[3]);
				if (empty($rows) and isset($langs[3]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text3']) . "'");			
			}		
		}
		if (!($t1 or $t2) and $t3) {
			$attID = $attID3;
			if (!empty($data['text3'])) {
				$rows = $this->checkAttribute($attID, $langs[3]);
				if (empty($rows) and isset($langs[3]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text3']) . "'");
			}	
		}
		if ($t1 and $t2 and $attID1 != $attID2) {
			$attID = $attID1;
			if (!empty($data['text2'])) {
				$rows = $this->checkAttribute($attID, $langs[2]);
				if (empty($rows) and isset($langs[2]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[2] . "', name = '" . $this->db->escape($data['text2']) . "'");
			}	
		}
		if ($t1 and $t2 and $attID1 == $attID2) $attID = $attID1;
		
		if ($t1 and $t3 and $attID1 != $attID3) {
			$attID = $attID1;
			if (!empty($data['text3'])) {
				$rows = $this->checkAttribute($attID, $langs[3]);
				if (empty($rows) and isset($langs[3]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text3']) . "'");
			}	
		}
		if ($t1 and $t3 and $attID1 == $attID3) $attID = $attID1;
		
		if (!$t1 and $t2 and $t3 and $attID2 != $attID3) {
			$attID = $attID2;
			if (!empty($data['text3'])) {
				$rows = $this->checkAttribute($attID, $langs[3]);
				if (empty($rows) and isset($langs[3]))
				$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . $attID . "', language_id = '" . $langs[3] . "', name = '" . $this->db->escape($data['text3']) . "'");
			}	
		}
		if (!$t1 and $t2 and $t3 and $attID2 == $attID3) $attID = $attID2;
		
		$this->cache->delete('attribute');	
	
	}
	
	public function getRefSort($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_ref WHERE `product_id` = '" . (int)$product_id . "' ORDER BY ident");
			
		return $query->rows;
	}
	
	public function getRefIdent($product_id, $ident) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_ref WHERE `product_id` = '" . (int)$product_id . "' and `ident` = '" . $ident . "'");
			
		return $query->row;
	}
	
	public function saveRef($product_id, $ident, $url) {
		$row = $this->getRefIdent($product_id, $ident);
		if (empty($row)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_ref SET `product_id` = '" . $product_id . "', `ident` = '" . $ident . "', `url` = '" . $url . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "suppler_ref SET `url` = '" . $url . "' WHERE `product_id` = '" . $product_id . "' and `ident` = '" . $ident . "'");
		}
	}
	
	public function getSupplerPriceSort($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_price WHERE `form_id` = '" . (int)$form_id . "' ORDER BY ident");
			
		return $query->rows;
	}
	
	public function getSupplerPrice($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_price WHERE `form_id` = '" . (int)$form_id . "' ORDER BY nom_id");
			
		return $query->rows;
	}	
	
	public function getReferens($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_ref WHERE `product_id` = '" . (int)$product_id . "'");
		
		return $query->rows;
	}
	
	public function getMySuppler($form_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler WHERE `form_id` = '" . (int)$form_id . "'");
			
		return $query->rows;
	}	
	
	public function getSupplers($order) {	
		$sql = "SELECT * FROM " . DB_PREFIX . "suppler ORDER BY ";
		if ($order == "ASC") $sql = $sql . "name ASC";
		else $sql = $sql . "suppler_id ASC";
	
		$query = $this->db->query($sql);		
		return $query->rows;
	}	
	
	public function getSame($names, $manufacturer_id, $category_id, $store) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
		
		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$store . "'";
		
		if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4]) and !empty($names[5]) and !empty($names[6]) and !empty($names[7]) and !empty($names[8]) and !empty($names[9])) {
		
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[5]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[6]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[7]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[8]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[9]) . "%')";

		} else {		
			if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4]) and !empty($names[5]) and !empty($names[6]) and !empty($names[7]) and !empty($names[8])) {
		
				$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[5]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[6]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[7]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[8]) . "%')";

			} else {		
				if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4]) and !empty($names[5]) and !empty($names[6]) and !empty($names[7])) {
		
					$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[5]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[6]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[7]) . "%')";

				} else {		
					if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4]) and !empty($names[5]) and !empty($names[6])) {
		
						$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[5]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[6]) . "%')";

					} else {		
						if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4]) and !empty($names[5])) {
		
							$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[5]) . "%')";

						} else {
							if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3]) and !empty($names[4])) {			
								$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[4]) . "%')";
							} else {
								if (!empty($names[0]) and !empty($names[1]) and !empty($names[2]) and !empty($names[3])) {			
									$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[3]) . "%')";
								} else {
									if (!empty($names[0]) and !empty($names[1]) and !empty($names[2])) {			
										$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[2]) . "%')";
									} else {
										if (!empty($names[0]) and !empty($names[1])) {
											$sql .= " AND (pd.name LIKE '%" . $this->db->escape($names[0]) . "%' OR pd.name LIKE '%" . $this->db->escape($names[1]) ."')";
										} else {
											if (!empty($names[0])) {
												$sql .= " AND pd.name LIKE '%" . $this->db->escape($names[0]) . "%'";
											} else if ($category_id == 0 and $manufacturer_id == 0) return '';
										}	
									}
								}
							}
						}	
					}	
				}
			}
		}	
		if ((int)$category_id != 0) {
			$sql .= " AND p2c.category_id = '" . (int)$category_id . "' AND p2s.store_id = '" . (int)$store . "'";
		}
		
		if ((int)$manufacturer_id != 0) {
			$sql .= " AND p.manufacturer_id = '" . $manufacturer_id . "' AND p2s.store_id = '" . (int)$store . "'";
		}
			
		$sql .= " ORDER BY pd.name ASC";	
			
		$query = $this->db->query($sql);
		return $query->rows;
	}	
	
	public function getMargin($form_id, $category_id) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_data WHERE `form_id` = '" . (int)$form_id . "' and `category_id` ='" . $category_id . "'");
			
		return $query->rows;
	}
	
	public function getCustomerGroup($customer_group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group WHERE `customer_group_id` ='" .$customer_group_id."'");
	
		return $query->row;
	}
		
	public function deleteWholesale($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
	
		$this->cache->delete('product');
	}
	
	public function putWholesale($data) {
		$row = $this->getCustomerGroup($data['customer_group_id']);
		if (empty($row)) return;
		if ($data['price'] != '' and $data['price'] != 0) 
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET `product_id` ='" .$data['product_id']."', `customer_group_id` = '".$data['customer_group_id']."', `quantity` = '".$data['quantity']."', `priority` = '".$data['priority']."', `price` = '".$data['price']."', `date_start` = '".$data['date_start']."', `date_end` = '".$data['date_end']."'");		
	}	
	
	public function deleteActionPrice($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE `product_id` ='" .$product_id. "'");
	
		$this->cache->delete('product');
	}

	public function getActionPrice($product_id, $customer_group_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE `product_id` ='" .$product_id."' AND `customer_group_id` ='" . $customer_group_id . "'");
	
		return $query->row;
	}
	
	public function putActionPrice($data) {
		$row = $this->getCustomerGroup($data['customer_group_id']);
		if (empty($row)) return;
		if ($data['price'] != '' and $data['price'] != 0)  $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET `product_id` ='" .$data['product_id']."', `customer_group_id` = '".$data['customer_group_id']."', `priority` = '".$data['priority']."', `price` = '".$data['price']."', `date_start` = '".$data['date_start']."', `date_end` = '".$data['date_end']."'");		
	}
	
	public function getTotalData($form_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "suppler_data WHERE `form_id` = '" . (int)$form_id . "'");
		
		return $query->row['total'];
	}
	
	public function getTotalSupplers() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "suppler");
		
		return $query->row['total'];
	}	

	public function getSupplerData($form_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_data WHERE `form_id` = '" . (int)$form_id . "' ORDER BY nom_id ASC");
			
		return $query->rows;
	}
	
	public function getOptionSKU($sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `optsku` = '" . $sku . "'");
			
		return $query->rows;
	}
	
	public function getProductBySKU($sku, $store) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.sku = '" . $this->db->escape($sku) . "' AND p2s.store_id = '" . (int)$store . "'");
			
		return $query->rows;
	}
	
	public function getCategory($category_id) {	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE `category_id` = '" . (int)$category_id . "'");
		
		return $query->rows;
	}
	
	public function chURL($seo_url) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` WHERE `keyword` = '" . $this->db->escape($seo_url) . "'");
	
		return $query->rows;
	}
	
	public function getURLmanufacturer($manufacturer_id) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'manufacturer_id=".(int)$manufacturer_id . "'");
	
		return $query->row;	
	}
	
	public function getURLcategory($category_id) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'category_id=".(int)$category_id . "'");
	
		return $query->row;	
	}
	
	public function getRedirect($product_id) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "redirect` WHERE `product_id` = '" . (int)$product_id . "'");
	
		return $query->row;	
	}	
	
	public function getURL($product_id) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'product_id=".(int)$product_id."'");
	
		return $query->row;	
	}
	
	public function isLink($parent_id, $category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE `category_id` = '" . (int)$category_id . "' and `parent_id` = '" . (int)$parent_id . "'");
		
		return $query->rows;
	
	}
	
	public function getProductDiscount($product_id, $j) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE `product_id` = '" . (int)$product_id . "' and `customer_group_id` = '" . $j . "'");
		
		return $query->rows;
	}
	
	public function getCategoryPhoto($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE `category_id` = '" . (int)$category_id . "'");
		
		return $query->rows;
	}
	
	public function getCategoryName($category_id) {
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE `category_id` = '" . (int)$category_id . "' and `language_id` = '" . $lang . "'");
		
		return $query->rows;
	}
	
	public function getCategoryIDbyName($name, $store) {
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description cd LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (cd.category_id = c2s.category_id) WHERE cd.name = '" . $this->db->escape($name) . "' AND  cd.language_id = '" . $lang . "' AND c2s.store_id = '" . (int)$store . "'");
		
		return $query->rows;
	}	
	
	public function CreateCategory($name, $langs, $parent_category_id, &$new_id, $date, $refer, $seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		if (!empty($refer)) $refer = "data/" . $refer;			
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET `image` = '" . $refer . "', `parent_id` = '" . (int)$parent_category_id . "', `top` = '" . 0 . "', `column` = '" . 1 ."', `sort_order` = '" . 0 . "', `status` = '" . 1 . "', `date_added` = '" . $date . "', `date_modified` = '" . $date . "'");
		
		$new_id = $this->db->getLastId();
		$seo = array();
		$this->seoCategory($store, $name, $parent_category_id, $seo_data, $seo);
		
		$seo_keyword = '';
		$seo_url = $this->TransLit($name);
		$seo_url = $this->MetaURL($seo_url);	
		$seo_url = strtolower($seo_url);
		
		for	($i=1; $i<=count($langs); $i++) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET `category_id` = '". (int)$new_id . "', `language_id` = '" . $langs[$i] . "', `name` = '" . $this->db->escape($name) . "', `description` = '" . $this->db->escape($seo['cat_desc']) . "', `meta_description` = '" . $this->db->escape($seo['cat_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['cat_title']) . "'");
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET `category_id` = '". (int)$new_id . "', `store_id` = '". $store ."'");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int)$new_id . "', keyword = '" . $this->db->escape($seo_url) . "'");		
		
		$this->cache->delete('category');
	}

	public function deleteProductImage($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");	
	}
	
	public function countDopImages($im) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE `image` = '" . $im . "'");
		
		return $query->rows;
	}
	
	public function countImages($im) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE `image` = '" . $im . "'");
		
		return $query->rows;
	}
	
	public function getProductImage($product_id) {	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE `product_id` = '" . (int)$product_id . "'");
		
		return $query->rows;
	}
	
	public function isCategoryOfProduct($product_id, $category_id) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE `product_id` = '" . (int)$product_id . "' AND `category_id` = '" . (int)$category_id . "'");
			
		return $query->rows;
	}
		
	public function getProductCategory($product_id) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE `product_id` = '" . (int)$product_id . "'");
			
		return $query->rows;
	}
	
	public function getProdOptions($product_id, $opt_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE `product_id` = '" . (int)$product_id . "' and `option_id` = '" . (int)$opt_id ."'");
			
		return $query->rows;
	
	}
	
	public function getPhotoOption($option_value_id) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value WHERE `option_value_id` = '" . $option_value_id . "'");		
			
		return $query->rows;	
	}
	
	public function getNameOption($option_value_id) {
		$lang = $this->config->get('config_language_id');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE `option_value_id` = '" . $option_value_id . "' and `language_id` = '" . $lang . "'");		
			
		return $query->rows;	
	}
	
	public function getOptions() {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` ORDER BY option_id");
	
		return $query->rows;
	}
	
	public function getRalatedAll($product_id) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_related` WHERE `product_id` = '" . $product_id . "'");
	
		return $query->rows;
	
	}	
	
	public function getRalated($new, $old) {	
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_related` WHERE `product_id` = '" . $new . "' and `related_id` = '" . $old . "'");
	
		return $query->rows;
	
	}	
	
	public function addRelated($new, $old) {	
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET `product_id` = '" . $new . "', `related_id` = '" . $old . "'");
	
		$this->cache->delete('product');	
	}
	
	public function getMinID() {	
		$query = $this->db->query("SELECT min(product_id) FROM " . DB_PREFIX . "product");
			
		return $query->row;
	}
	
	public function getMaxID() {	
		$query = $this->db->query("SELECT max(product_id) FROM " . DB_PREFIX . "product");
			
		return $query->row;
	}

	public function getMaxAttribute() {	
		$query = $this->db->query("SELECT max(attribute_id) FROM " . DB_PREFIX . "attribute");
			
		return $query->row;
	}

	public function getMaxLanguage() {	
		$query = $this->db->query("SELECT max(language_id) FROM " . DB_PREFIX . "language");
			
		return $query->row;
	}
	
	public function addManufacturer($data, $langs, &$last_id, $seo_data, $store) {
		$name = $this->db->escape($data['name']);
		$name = str_replace('ООО' , '' , $name);		
		$name = str_replace('ТОВ' , '' , $name);
		$name = $this->Code($name);
		$name = str_replace("\\" , '' , $name);
		$name = trim($name);		

		$seo_keyword = '';	
		$seo_url = $this->TransLit($name);
		$seo_url = $this->MetaURL($seo_url);
		$seo_url = strtolower($seo_url);
						
		$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer SET name = '" . $this->db->escape($name) . "', sort_order = '" . (int)$data['sort_order'] . "'");
		
		$last_id = $this->db->getLastId();
		$seo = array();
		$this->seoManufacturer($store, $name, $seo_data, $seo);		

		for	($i=1; $i<=count($langs); $i++) {	
			$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_description SET `manufacturer_id` = '". (int)$last_id . "', `language_id` = '" . $langs[$i] . "', `description` = '" . $this->db->escape($seo['manuf_desc']) . "', `meta_description` = '" . $this->db->escape($seo['manuf_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['manuf_title']) . "'");
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_to_store SET manufacturer_id = '" . (int)$last_id . "', store_id = '" . $store . "'");
						
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=" . (int)$last_id . "', keyword = '" . $this->db->escape($seo_url) . "'");		
		
		$this->cache->delete('manufacturer');
	}
	
	public function getTable() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "suppler_sku_description` WHERE `nom_id` = '" . 1 . "'");
	
		return $query->rows;
	
	}
	
	public function getMaxAliasID() {	
		$query = $this->db->query("SELECT max(url_alias_id) FROM " . DB_PREFIX . "url_alias");
		return $query->row;
	}
	
	public function getMaxSkuID() {
		$query = $this->db->query("SELECT max(sku_id) FROM " . DB_PREFIX . "suppler_sku_description");
	
		return $query->row;
	}
	
	public function getMaxNomid() {
		$query = $this->db->query("SELECT max(nom_id) FROM " . DB_PREFIX . "suppler_sku");
	
		return $query->row;
	}
	
	public function getSkuIDByNom($nom_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku WHERE `nom_id` = '" . $nom_id . "'");
	
		return $query->row;
	}
	
	public function getJoin($sku, $store) {		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku` = '" . $this->db->escape($sku) . "' AND store_id = '" . (int)$store . "'");
	
		return $query->rows;
	}
	
	public function getJoinOptSKU($sku, $store) {
		$rows = '';
		$rows = $this->getJoin($sku, $store);	
		if (!empty($rows)) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku_id` = '" . $rows[0]['sku_id'] . "' AND store_id = '" . (int)$store . "'");
			
			return $query->rows;
		}
		return $rows;
	}
	
	public function getskuDescription($sku, $store) {
		if ($store == 0) {
		  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku` = '" . $this->db->escape($sku) . "' AND (`store_id` = '" . (int)$store . "' OR `store_id` = '') ");
		} else {  
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku` = '" . $this->db->escape($sku) . "' AND `store_id` = '" . (int)$store . "'");
		}
		return $query->row;	
	
	}	
	
	public function getSku($sku_id, $store) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku_id` = '" . $sku_id . "' AND  store_id = '" . (int)$store . "'");
	
		return $query->rows;
	
	}
	
	public function getAllRecordsLibrary($sku, $store) {
		if ($store == 0) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku` = '" . $this->db->escape($sku) . "' AND  (`store_id` = '" . (int)$store . "' OR `store_id` = '') ");
		} else {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku_description WHERE `sku` = '" . $this->db->escape($sku) . "' AND store_id = '" . (int)$store . "'");
		}
		return $query->rows;
	
	}
	
	public function getSkuID($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku WHERE `product_id` = '" . $product_id . "'");
	
		return $query->row;	
	
	}
	
	public function getProductByTable($sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "suppler_sku ss ON (p.product_id = ss.product_id) LEFT JOIN " . DB_PREFIX . "suppler_sku_description ssd ON (ss.sku_id = ssd.sku_id) WHERE ssd.sku = '" . $this->db->escape($sku) . "'");
	
		return $query->rows;
	}	
		
	public function getProductIDbySkuID($sku_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku WHERE `sku_id` = '" . $sku_id . "'");
	
		return $query->row;	
	}		
	
	public function getskuIDbyProductID($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku WHERE `product_id` = '" . $product_id . "'");
	
		return $query->row;	
	}
	
	public function issetsku($id, $product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_sku WHERE `product_id` = '" . $product_id . "' and `sku_id` = '". $id. "'");
	
		return $query->row;	
	}
	
	public function putsku($product_id, $sku_id) {
		$row = $this->issetsku($sku_id, $product_id);
		if (empty($row)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku SET `sku_id` = '" . $sku_id . "', `product_id` = '" . $product_id . "'");
		}	
		
		$this->cache->delete('suppler');
	}

	public function getBasePrice($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "suppler_base_price WHERE `product_id` = '" . $product_id . "'");
	
		return $query->rows;	
	}	
	
	public function putProductBySKU($sku, $row_product, $updte, $upname, $max_attr, $attr_ext, $row, $tags, $addseo, $upurl, $umanuf, $seo_data, $store, $parent, $t_ref, $t_ref1, $metka, $yml, $usd, $catmany, $idcat) {
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `model` = '" . $row_product[0]['model'] . "', `sku` = '" . $this->db->escape($row_product[0]['sku']) . "', `price` = '" . $row_product[0]['price'] . "', `stock_status_id` = '" . $row_product[0]['stock_status_id'] . "', `quantity` = '" . $row_product[0]['quantity'] . "', `subtract` = '". $row_product[0]['subtract']. "', `image` = '". $this->db->escape($row_product[0]['image']). "', `status` = '". $row_product[0]['hide'] ."',  `sort_order` = '" . (int)$row_product[0]['sort_order'] . "', `weight` = '". $row_product[0]['weight'] . "', `length` = '". $row_product[0]['length'] ."', `width` = '". $row_product[0]['width'] ."', `height` = '". $row_product[0]['height'] ."', `date_modified` = '" . $row_product[0]['date_modified'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");		
		
		if ($usd and $row[$usd] != '') {
			if ($row[$usd] == '0') $row[$usd] = '';
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `base_currency_code` = '" . $this->db->escape($row[$usd]) . "', `base_price` = '" . $row_product[0]['price'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
		}
		if (!empty($row_product[0]['upc']) or $row_product[0]['upc'] == '0')
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `upc` = '" . $this->db->escape($row_product[0]['upc']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");

		if (!empty($row_product[0]['ean']) or $row_product[0]['ean'] == '0')
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `ean` = '" . $this->db->escape($row_product[0]['ean']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
			
		if (!empty($row_product[0]['mpn']) or $row_product[0]['mpn'] == '0')
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `mpn` = '" . $this->db->escape($row_product[0]['mpn']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");	
		
		if ($row_product[0]['manufacturer_id'])
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `manufacturer_id` = '" . $row_product[0]['manufacturer_id'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
		
		if (!empty($row_product[0]['bprice'])) {
			$rows = $this->getBasePrice($row_product[0]['product_id']);
			if (empty($rows)) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "suppler_base_price` SET `product_id` = '" . (int)$row_product[0]['product_id'] . "', `model` = '" . $row_product[0]['model'] . "', `bprice` = '" . $row_product[0]['bprice'] . "', `bpack` = '" . $row_product[0]['bpack'] . "', `brate` = '" . $row_product[0]['brate'] . "', `bsuppler` = '" . $row_product[0]['bsuppler'] . "', `bdisc` = '" . $row_product[0]['bdisc'] . "'");
			} else {
				$this->db->query("UPDATE `" . DB_PREFIX . "suppler_base_price` SET `model` = '" . $row_product[0]['model'] . "', `bprice` = '" . $row_product[0]['bprice'] . "', `bpack` = '" . $row_product[0]['bpack'] . "', `brate` = '" . $row_product[0]['brate'] . "', `bsuppler` = '" . $row_product[0]['bsuppler'] . "', `bdisc` = '" . $row_product[0]['bdisc'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
			}
		}
		$lang = $this->config->get('config_language_id');
		$date = $row_product[0]['date_modified'];
		
		// Описание оригинал
		$descript = "";
		if (isset($row_product[0]['description'])) {
			$descript = $row_product[0]['description'];
			$descript = $this->symbol($descript);
		}	
		
		// Наименование товара
		$prod_name = "";
		if (isset($row_product[0]['item'])) {
			$prod_name = $row_product[0]['item'];						
			$prod_name = $this->Code($prod_name);
			$prod_name = str_replace("#" , '' , $prod_name);
			$prod_name = trim($prod_name);
		}		
		
		// Имя производителя. Удалить ООО и ТОВ
		$meta_manuf = '';
		if (isset($row_product[0]['manuf_name'])) {
			$meta_manuf = str_replace('ООО' , '' , $row_product[0]['manuf_name']);		
			$meta_manuf = str_replace('ТОВ' , '' , $meta_manuf);
			$meta_manuf = $this->Code($meta_manuf);		
		}			
		
		// Вытаскиваем название категории для этого продукта 
		$rows = $this->getCategoryName((int)$row_product[0]['category_id']);
		$meta_category_name = '';	
		if (isset($rows[0]['name'])) $meta_category_name = $rows[0]['name'];		
				
		// Метки: атрибуты товара см. стр "Атрибуты"
		$at ='';
		if ($max_attr) {			
			for ($j = 1; $j <= $max_attr; $j++) {
				if ($j > 30) break;
				if (isset($row[$attr_ext[$j]]) and !empty($row[$attr_ext[$j]])) {
					if (!preg_match('/^[0-9 ]+$/', $row[$attr_ext[$j]])) {
						if ($tags[$j]) {						
							$add = $this->symbol($row[$attr_ext[$j]]);
							if (empty($at)) $at = $add;
							else $at = $at.','.$add;
						}	
					}	
				}	
			}
		}
		
		$tag = '';
		if ($metka) {
			$tag = $meta_category_name;
			if (!empty($meta_manuf)) $tag = $tag . ','. $meta_manuf;
			if (!empty($at)) $tag = $tag .',' . $at;
			
			if ($umanuf) {
				$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($tag) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
			}
		}
		$seo = array();
		$this->seoProduct($store, (int)$row_product[0]['product_id'], $seo_data, $seo);
		$seo_h1 = $seo['prod_h1'];
		if (empty($seo_h1)) $seo_h1 = $prod_name;
		$seo_title = $seo['prod_title'];
		$meta_desc = $seo['prod_meta_desc'];
		$desc = $seo['prod_desc'];
		$keywords = $seo['prod_keyword'];
	
		for ($j=1; $j<300; $j++) {
			if (!isset($row[$j]) or empty($row[$j])) continue;
			$a = '{' . $j . '}';
			$seo_h1 = str_replace($a, $row[$j], $seo_h1);
			$seo_title = str_replace($a, $row[$j], $seo_title);
			$meta_desc = str_replace($a, $row[$j], $meta_desc);
			$desc = str_replace($a, $row[$j], $desc);
			$keywords = str_replace($a, $row[$j], $keywords);
		}
		$seo_h1 = $this->clearSEO($seo_h1);
		$seo_title = $this->clearSEO($seo_title);
		$meta_desc = $this->clearSEO($meta_desc);
		$desc = $this->clearSEO($desc);
		$keywords = $this->clearSEO($keywords);
		
		if ($updte == 4) $descript = $desc;
	
	// SEO URL
		$seo_url = $prod_name;			
	//	$seo_url = substr($seo_url, 0, 64);  // обрезать до 64 символов        
	//	$seo_url = $seo_url.'_'.$row_product[0]['model']; // название товара+Модель
	//  $seo_url = $row_product[0]['sku']."_".$row_product[0]['model']; // sku+model
	//	$seo_url = $seo_url."_".$row_product[0]['sku']; // название+sku
		$seo_url = $this->TransLit($seo_url);
		$seo_url = $this->MetaURL($seo_url);		
		$seo_url = strtolower($seo_url);			
		
		// Импорт мета-данных из прас-листа. Из колонок прайса номера: 38, 39, 40, 41, 42
		if ($addseo == 2) {	
			if (isset($row_product[0]['seo_h1']) and !empty($row_product[0]['seo_h1'])) $seo_h1 = $row_product[0]['seo_h1'];
			if (isset($row_product[0]['seo_title']) and !empty($row_product[0]['seo_title'])) $seo_title = $row_product[0]['seo_title'];
			if (isset($row_product[0]['meta_keyword']) and !empty($row_product[0]['meta_keyword'])) $keywords = $row_product[0]['meta_keyword'];
			if (isset($row_product[0]['meta_description']) and !empty($row_product[0]['meta_description'])) $meta_desc = $row_product[0]['meta_description'];
			if (isset($row_product[0]['tag']) and !empty($row_product[0]['tag']) and $metka) $tag = $row_product[0]['tag'];
		}
			
		if ($upurl > 1) {   // Импорт url из прас-листа. Из колонки прайса номер: 43
			if (isset($row_product[0]['url']) and !empty($row_product[0]['url'])) $seo_url = $row_product[0]['url'];
		}		
		
		if ($addseo) {				
			if (!empty($meta_desc)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang .  "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}
			if (!empty($keywords)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($keywords) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($keywords) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}
			if (!empty($seo_h1)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($seo_h1) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($seo_h1) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}
			if (!empty($seo_title)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($seo_title) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($seo_title) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}			
		}
		
		if (($upurl or $yml) and !empty($seo_url)) {			
			$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo_url) . "' WHERE `query` = 'product_id=".(int)$row_product[0]['product_id']."'");
		}
	
		if ($updte > 1 or $yml) {		
			if (!empty($descript)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($descript) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($descript) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}
		}
	
		if ($upname or $yml) {		
			if (!empty($prod_name)) {
				if (!$yml) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `name` = '" . $this->db->escape($prod_name) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `name` = '" . $this->db->escape($prod_name) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
				}	
			}
		}
		
		if ((!empty($row_product[0]['ref']) or $row_product[0]['ref'] == '0') and preg_match('/^[0-9]+$/', $t_ref) and $t_ref > 0) {
			
			switch ($t_ref) {			
				case 1:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 2:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 3:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 4:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 5:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 6:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `minimum` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 7:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `subtract` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 8:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 9:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `length_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 10:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `weight_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 11:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `tax_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 12:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `points` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 13:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `location` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 14:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `jan` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;	
				case 15:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `isbn` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;					
				case 16:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `stock_status_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;				
				case 17:
					$rows = $this->getProductSerie((int)$row_product[0]['product_id']);
					if (empty($rows)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_series SET `product_id` = '" .(int)$row_product[0]['product_id']. "', `series_id` = '" . (int)$row_product[0]['ref'] . "'");
					} else {	
						$this->db->query("UPDATE `" . DB_PREFIX . "product_to_series` SET `series_id` = '" . (int)$row_product[0]['ref'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					}	
					break;
				case 18:									
	//				$this->db->query("UPDATE `" . DB_PREFIX . "my_table` SET `my_field` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;	
			}
		}
		if ((!empty($row_product[0]['ref1']) or $row_product[0]['ref1'] == '0') and preg_match('/^[0-9]+$/', $t_ref1) and $t_ref1 > 0) {
			
			switch ($t_ref1) {			
				case 1:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 2:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 3:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 4:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 5:									
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
					break;
				case 6:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `minimum` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 7:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `subtract` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 8:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 9:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `length_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 10:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `weight_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 11:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `tax_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 12:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `points` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 13:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `location` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;
				case 14:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `jan` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;	
				case 15:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `isbn` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;	
				case 16:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `stock_status_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;				
				case 17:
					$rows = $this->getProductSerie((int)$row_product[0]['product_id']);
					if (empty($rows)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_series SET `product_id` = '" .(int)$row_product[0]['product_id']. "', `series_id` = '" . (int)$row_product[0]['ref1'] . "'");
					} else {	
						$this->db->query("UPDATE `" . DB_PREFIX . "product_to_series` SET `series_id` = '" . (int)$row_product[0]['ref1'] . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					}	
					break;
				case 18:									
	//				$this->db->query("UPDATE `" . DB_PREFIX . "my_table` SET `my_field` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "'");
					break;		
			}
		}
		if ($parent == 4 or $parent == 6) {
			$product_id = (int)$row_product[0]['product_id'];
			if ($product_id and $parent == 6) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");
			}	
			for ($i=0; $i<50; $i++) {
				if (!isset($catmany[$i])) break;
				if ($i == 0 and $row_product[0]['category_id']) {
					if ($parent == 4) $rows  = $this->isCategoryOfProduct($product_id, $row_product[0]['category_id']);
					else $rows = '';
					if (empty($rows)) {
						if ($parent != 6) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .$product_id. "', `category_id` = '" . (int)$row_product[0]['category_id'] . "', `main_category` = 0");
						} else {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .$product_id. "', `category_id` = '" . (int)$row_product[0]['category_id'] . "', `main_category` = 1");
						}
					}				
				} else {
					if (!$idcat) {
						$rows = $this->getCategoryIDbyName($catmany[$i], $store);						
						if (!empty($rows)) {
							$cat_id = (int)$rows[0]['category_id'];
							if ($parent == 4) $rows  = $this->isCategoryOfProduct($product_id, $cat_id);
							else $rows = '';
							if (empty($rows)) {	
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .$product_id. "', `category_id` = '" . $cat_id . "', `main_category` = 0");
							}	
						}
					} else {
						if ($parent == 4) $rows  = $this->isCategoryOfProduct($product_id, (int)$catmany[$i]);
						else $rows = '';
						if (empty($rows)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .$product_id. "', `category_id` = '" . (int)$catmany[$i] . "', `main_category` = 0");
						}
					}	
				}	
			}
		}
		
		if (($parent == 5 and !empty($row_product[0]['category_id'])) or ($yml and !empty($row_product[0]['category_id']))) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$row_product[0]['product_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$row_product[0]['product_id']. "', `category_id` = '" . (int)$row_product[0]['category_id'] . "', `main_category` = 1");

			if (!empty($tag) and $metka) {
				$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($tag) . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `language_id` = '" . $lang. "'");
			}
		}
		$this->cache->delete('suppler');
	}
	
	public function getManufacturerLike($name, $store) {
		$na = substr($name, 0, 2);
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.name LIKE '" . $this->db->escape($na) . "%' AND m2s.store_id = '" . (int)$store . "'");
	
		return $query->rows;
	}
	
	public function getManufacturerID($name, $store) {
		$rows = $this->getManufacturerLike($name, $store);		
	
		$nn = $this->TransLit($name);
		$nn = strtolower($nn);		
		$nn = str_replace('-', '', $nn);
		$nn = str_replace('_', '', $nn);
		$nn = str_replace('.', '', $nn);
		$nn = str_replace("/", '', $nn);
		$nn = str_replace("\\", '', $nn);
		$nn = str_replace('|', '', $nn);
		$nn = str_replace(' ', '', $nn);
		$nn = trim($nn);
	
		for ($i=0; $i<200; $i++) {
			if (!isset($rows[$i]['manufacturer_id'])) break;
			$r = $this->TransLit($rows[$i]['name']);
			$r = strtolower($r);		
			$r = str_replace('-', '', $r);
			$r = str_replace('_', '', $r);
			$r = str_replace('.', '', $r);
			$r = str_replace("/", '', $r);
			$r = str_replace("\\", '', $r);
			$r = str_replace('|', '', $r);
			$r = str_replace(' ', '', $r);
			$r = trim($r);	
			if ($r == $nn) {
				$rows[0] = $rows[$i];	
				return $rows;				
			}
		}			
		return '';
	}
	
	public function getManufacturerName($id) {	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer WHERE `manufacturer_id` = '" . $id . "'");
			
		return $query->rows;
	}
	
	public function getProductDesc($id) {
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE `product_id` = '" . $id . "' and `language_id` = '" . $lang . "'");
			
		return $query->rows;
	}

	public function getProductIDbyName($name) {	
		$lang = $this->config->get('config_language_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE `name` = '" . $this->db->escape($name) . "' and `language_id` = '" . $lang . "'");
			
		return $query->rows;
	}
		
	
	public function getProductsByID($product_id) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE `product_id` = '" . (int)$product_id . "'");
			
		return $query->rows;
	}
	
	public function getProductByID($product_id) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE `product_id` = '" . (int)$product_id . "'");
			
		return $query->row;
	}
	
	public function getProductByIDStore($product_id, $store) {				
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p2s.store_id = '" . (int)$store . "'");
			
		return $query->row;
	}
	
	public function	upProduct($row) {	
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `quantity` = '" . $row['quantity'] . "', `price` = '" . $row['price'] . "', `status` = '". $row['status'] . "', `stock_status_id` = '" . $row['stock_status_id'] . "', `sort_order` = '". $row['sort_order'] . "' WHERE `product_id` = '" . $row['product_id'] . "'");
		
		$this->cache->delete('*');
	}
	
	public function addPicture($product_id, $pic_addr, $sort_order) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET `product_id` = '" . $product_id . "', `image` = '" .$this->db->escape($pic_addr). "', `sort_order` = '" . $sort_order . "'");
	
		$this->cache->delete('*');
	}
	
	public function setCategory($product_id, $cat) {
		if (empty($cat)) return;
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$n = 0;
			for ($i=0; $i<2000; $i++) {
				if (!isset($rows[$i]['category_id'])) break;					
				if ($rows[$i]['category_id']>$n) $n = $rows[$i]['category_id'];
			}	
		}
		$m = 0;
		for ($i=0; $i<2000; $i++) {
			if (!isset($cat[$i])) break;
			if ($cat[$i]>$m) $m = $cat[$i];
			if ($cat[$i]==$n) {
				$m = $n;
				break;
			}	
		}
		if (!$m) return;
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" .(int)$product_id. "'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . (int)$m . "', `main_category` = 1");
		
		for ($l=0; $l<2000; $l++) {
			if (!isset($cat[$l])) break;
			if ($cat[$l] == $m) continue;
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . (int)$cat[$l] . "', `main_category` = 0");
		}
		$rows = $this->getCategoryName($m);
		$category_name = '';	
		if (isset($rows[0]['name'])) $category_name = $rows[0]['name'];
		$rows = $this->getProductDesc($product_id);	
		if (!empty($rows) and isset($rows[0]['tag'])) {
			$p = stripos($rows[0]['tag'], ',');		
			if ($p) {			
				$lang = $this->config->get('config_language_id');
				$hvost = substr($rows[0]['tag'], $p);				
				$tag = $category_name.$hvost;

				$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($tag) . "' WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");
			}	
		}
		$this->cache->delete('*');
	}
	
	public function issetProductCategory($product_id, $cat) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE `product_id` = '" . (int)$product_id . "' and `category_id` = '" . (int)$cat . "'");
			
		return $query->rows;
	}

	public function notCategory($product_id, $cat) {
		for ($l=0; $l<2000; $l++) {
			if (!isset($cat[$l])) break;
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' and category_id = '" . (int)$cat[$l] . "'");
		}	
	}
	
	public function toCategory($product_id, $cat) {
		for ($l=0; $l<2000; $l++) {
			if (!isset($cat[$l])) break;
			$rows = $this->issetProductCategory($product_id, $cat[$l]);		
			if (empty($rows)) {	
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . (int)$cat[$l] . "', `main_category` = 0");					
			}
		}
		$this->cache->delete('*');
	}
	
	public function	putNewProduct($row_product, $parent, &$last_product_id, $attr_ext, $max_attr, $langs, $row, $tags, $addseo, $catmany, $catcreate, $newurl, $refers, $seo_data, $store, $off, $idcat, $t_ref, $t_ref1, $metka, $usd) {
	
		if (!$catcreate) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product SET `model` = '" . $row_product[0]['model'] . "', `sku` = '" . $this->db->escape($row_product[0]['sku']) . "', `upc` = '" . $this->db->escape($row_product[0]['upc']) . "', `ean` = '" . $this->db->escape($row_product[0]['ean']) . "', `mpn` = '" . $this->db->escape($row_product[0]['mpn']) . "', `quantity` = '" . $row_product[0]['quantity'] . "', `stock_status_id` = '" . $row_product[0]['stock_status_id'] . "', `image` = '" . $this->db->escape($row_product[0]['image']) . "', `manufacturer_id` = '" . $row_product[0]['manufacturer_id'] . "', `shipping` = '" . $row_product[0]['shipping'] . "', `price` = '" . $row_product[0]['price'] . "', `points` = '0' , `tax_class_id` = '0' , `date_available` = '" . $row_product[0]['date_available'] . "', `weight` = '". $row_product[0]['weight'] . "', `weight_class_id` = '1' , `length` = '". $row_product[0]['length'] ."', `width` = '". $row_product[0]['width'] ."', `height` = '". $row_product[0]['height'] ."' , `length_class_id` = '1' , `subtract` = '". $row_product[0]['subtract']. "', `minimum` = '' ,  `sort_order` = '" . (int)$row_product[0]['sort_order'] . "', `status` = '". $row_product[0]['hide'] ."', `date_added` = '" . $row_product[0]['date_added'] . "', `date_modified` = '" . $row_product[0]['date_added'] . "', `viewed` = '0'");
		
			$product_id = $this->db->getLastId();
			$last_product_id = $product_id;	
			
			if ($usd and $row[$usd] != '') {
				if ($row[$usd] == '0') $row[$usd] = '';
				$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `base_currency_code` = '" . $this->db->escape($row[$usd]) . "', `base_price` = '" . $row_product[0]['price'] . "' WHERE `product_id` = '" .(int)$last_product_id . "'");
			}
		}
		$date = $row_product[0]['date_added'];
		
		if ($catcreate) {
			$dim = count($catmany);
			if (!$parent and $dim > 1) {									
				$rows = $this->getCategoryIDbyName($catmany[$dim-1], $store);			
				if (!empty($rows)) {
					$parent_id = $rows[0]['category_id'];
				
					$dim = $dim - 2;				
					for($i=$dim; $i>=0; $i--) {					
						$rows1 = $this->getCategoryIDbyName($catmany[$i], $store);					
						if (!empty($rows1)) {										
							$fl = 0;								
							foreach ($rows1 as $r1) {
								$rows2 = $this->isLink($parent_id, $r1['category_id']); 
								if (!empty($rows2) or $parent_id == $r1['category_id']) {
									$parent_id = $r1['category_id'];
									$cat_id = $r1['category_id'];
									$fl = 1;			
									break;
								}
							}
							if (!$fl) {
								$this->CreateCategory($catmany[$i], $langs, $parent_id, $cat_id, $date, $refers[$i], $seo_data, $store);
								$parent_id = $cat_id;								
							} 				
							
						} else {
							$this->CreateCategory($catmany[$i], $langs, $parent_id, $cat_id, $date, $refers[$i], $seo_data, $store);					
							$parent_id = $cat_id;						
						}				
					}				
				}
			}		
			return;
		}
		// Описание оригинал
		$descript = "";
		if (isset($row_product[0]['description'])) {
			$descript = $row_product[0]['description'];
			$descript = $this->symbol($descript);
		}	
			
		// Наименование товара
		$prod_name = "";
		if (isset($row_product[0]['item'])) {
			$prod_name = $row_product[0]['item'];						
			$prod_name = $this->Code($prod_name);
			$prod_name = str_replace("#" , '' , $prod_name);
			$prod_name = trim($prod_name);
		}		
		
		// Сео-Имя производителя. Удалить ООО и ТОВ
		$meta_manuf = '';
		if (isset($row_product[0]['manuf_name'])) {
			$meta_manuf = str_replace('ООО' , '' , $row_product[0]['manuf_name']);		
			$meta_manuf = str_replace('ТОВ' , '' , $meta_manuf);
			$meta_manuf = $this->Code($meta_manuf);
			$meta_manuf = str_replace("\\" , '' , $meta_manuf);
			$meta_manuf = trim($meta_manuf);
		}		
		
		// Вытаскиваем название категории для этого продукта 
		$rows = $this->getCategoryName((int)$row_product[0]['category_id']);
		$meta_category_name = '';	
		if (isset($rows[0]['name'])) $meta_category_name = $rows[0]['name'];		
		
		// Метки: атрибуты товара см. стр "Атрибуты"
		$at ='';
		if ($max_attr) {			
			for ($j = 1; $j <= $max_attr; $j++) {
				if ($j > 30) break;
				if (isset($row[$attr_ext[$j]]) and !empty($row[$attr_ext[$j]])) {
					if (!preg_match('/^[0-9 ]+$/', $row[$attr_ext[$j]])) {
						if ($tags[$j]) {						
							$add = $this->symbol($row[$attr_ext[$j]]);
							if (empty($at)) $at = $add;
							else $at = $at.','.$add;
						}	
					}	
				}	
			}
		}
		
		$tag = '';
		if ($metka) {
			$tag = $meta_category_name;
			if (!empty($meta_manuf)) $tag = $tag . ','. $meta_manuf;
			if (!empty($at)) $tag = $tag .',' . $at;
		}
		
		$seo_h1 = '';
		$seo_title = '';
		$keywords = '';
		$meta_desc = '';		
		
		// SEO URL
		$seo_url = $prod_name;			
	//	$seo_url = substr($seo_url, 0, 64);  // обрезать до 64 символов        
	//	$seo_url = $seo_url.'_'.$row_product[0]['model']; // название товара+Модель
	//  $seo_url = $row_product[0]['sku']."_".$row_product[0]['model']; // sku+model
	//	$seo_url = $seo_url."_".$row_product[0]['sku']; // название+sku
		$seo_url = $this->TransLit($seo_url);
		$seo_url = $this->MetaURL($seo_url);			
		$seo_url = strtolower($seo_url);		
		
		// Импорт мета-данных из прас-листа. Из колонок прайса номера: 38, 39, 40, 41, 42
		if ($addseo == 2) {
			if (isset($row_product[0]['seo_h1']) and !empty($row_product[0]['seo_h1'])) $seo_h1 = $row_product[0]['seo_h1'];
			if (isset($row_product[0]['seo_title']) and !empty($row_product[0]['seo_title'])) $seo_title = $row_product[0]['seo_title'];
			if (isset($row_product[0]['meta_keyword']) and !empty($row_product[0]['meta_keyword'])) $keywords = $row_product[0]['meta_keyword'];
			if (isset($row_product[0]['meta_description']) and !empty($row_product[0]['meta_description'])) $meta_desc = $row_product[0]['meta_description'];
			if (isset($row_product[0]['tag']) and !empty($row_product[0]['tag']) and $metka) $tag = $row_product[0]['tag'];
		}		
		if ($newurl) {   // Импорт url из прас-листа. Из колонки прайса номер: 43
			if (isset($row_product[0]['url']) and !empty($row_product[0]['url'])) $seo_url = $row_product[0]['url'];
		}
		
		if (!empty($row_product[0]['bprice'])) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "suppler_base_price` SET `product_id` = '" . (int)$product_id . "', `model` = '" . $row_product[0]['model'] . "', `bprice` = '" . $row_product[0]['bprice'] . "', `bpack` = '" . $row_product[0]['bpack'] . "', `brate` = '" . $row_product[0]['brate'] . "', `bsuppler` = '" . $row_product[0]['bsuppler'] . "', `bdisc` = '" . $row_product[0]['bdisc'] . "'");
		}
		
		for	($i=1; $i<=count($langs); $i++) {				
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET `product_id` = '" .(int)$product_id. "', `language_id` = '" .$langs[$i] . "', `name` = '" . $this->db->escape($prod_name) . "', `description` = '" . $this->db->escape($descript). "', `seo_h1` = '" . $this->db->escape($seo_h1) . "'");
			
			if ($addseo == 2) {
				if ($metka) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "', `seo_title` = '" . $this->db->escape($seo_title) . "', `meta_keyword` = '" . $this->db->escape($keywords) . "', `tag` = '" . $this->db->escape($tag) . "' WHERE `product_id` = '" .(int)$product_id. "' and `language_id` = '" .$langs[$i] . "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "', `seo_title` = '" . $this->db->escape($seo_title) . "', `meta_keyword` = '" . $this->db->escape($keywords) . "' WHERE `product_id` = '" .(int)$product_id. "' and `language_id` = '" .$langs[$i] . "'");
				}	
			}
		}
		for ($i=0; $i<50; $i++) {
			if (!isset($catmany[$i]) or !$product_id) break;
			if ($i == 0 and $row_product[0]['category_id']) {			
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . (int)$row_product[0]['category_id'] . "', `main_category` = 1");
			} else {
				if ($parent == 1) {
					if (preg_match('/[0-9]+$/', $catmany[$i]) and $idcat) {
						$rows = $this->getCategory((int)$catmany[$i]);
						if (!empty($rows)) {							
							$rows  = $this->isCategoryOfProduct($product_id, (int)$catmany[$i]);
							if (empty($rows)) {
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . (int)$catmany[$i] . "', `main_category` = 0");
							}	
						}
					} else {	
						$rows = $this->getCategoryIDbyName($catmany[$i], $store);			
						if (!empty($rows)) {
							$cat_id = (int)$rows[0]['category_id'];
							$rows  = $this->isCategoryOfProduct($product_id, $cat_id);
							if (empty($rows)) {
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . $cat_id . "', `main_category` = 0");
							}	
						}	
					}	
				}	
			}	
		}		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET `product_id` = '" .(int)$product_id. "', `store_id` = '" . $store ."'");

		$rows = $this->chURL($seo_url);
		if (!empty($rows)) $seo_url = $seo_url . '-' . $product_id;

		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($seo_url) . "'");
	
		if ($parent == 2) {
			$category_id = (int)$row_product[0]['category_id'];
			$rows  = $this->getCategory($category_id);
			if (!empty($rows)) {
				$parent_id = $rows[0]['parent_id'];
				if ($parent_id) {
					$rows  = $this->isCategoryOfProduct($product_id, $parent_id);
					if (empty($rows)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . $parent_id . "', `main_category` = 0");
					}	
				}	
			}	
		}
		
		if ($parent == 3) {
			$category_id = (int)$row_product[0]['category_id'];
			while (1) {
				$rows  = $this->getCategory($category_id);
				if (empty($rows))  break;
				$parent_id = $rows[0]['parent_id'];
				if ($parent_id) {
					$rows  = $this->isCategoryOfProduct($product_id, $parent_id);
					if (empty($rows)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" .(int)$product_id. "', `category_id` = '" . $parent_id . "', `main_category` = 0");
					}								
				}
				$category_id = $parent_id ;	
			}
		}
		
		$seo = array();
		$this->seoProduct($store, $product_id, $seo_data, $seo);
		$seo_h1 = $seo['prod_h1'];	
		if (empty($seo_h1)) $seo_h1 = $prod_name;
		$seo_title = $seo['prod_title'];
		$meta_desc = $seo['prod_meta_desc'];
		$desc = $seo['prod_desc'];
		$keywords = $seo['prod_keyword'];
		for ($j=1; $j<300; $j++) {	
			if (!isset($row[$j]) or empty($row[$j])) continue;
			$a = '{' . $j . '}';
			$seo_h1 = str_replace($a, $row[$j], $seo_h1);
			$seo_title = str_replace($a, $row[$j], $seo_title);
			$meta_desc = str_replace($a, $row[$j], $meta_desc);
			$desc = str_replace($a, $row[$j], $desc);
			$keywords = str_replace($a, $row[$j], $keywords);
		}
		$seo_h1 = $this->clearSEO($seo_h1);
		$seo_title = $this->clearSEO($seo_title);
		$meta_desc = $this->clearSEO($meta_desc);		
		$desc = $this->clearSEO($desc);
		$keywords = $this->clearSEO($keywords);
		
		if ($off) $descript = $desc;
		
		for	($i=1; $i<=count($langs); $i++) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($descript). "' WHERE `product_id` = '" .(int)$product_id. "' and `language_id` = '" .$langs[$i] . "'");
		}
		
		if ($addseo == 1) {
			for	($i=1; $i<=count($langs); $i++) {
				if ($metka) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "', `seo_title` = '" . $this->db->escape($seo_title) . "', `meta_keyword` = '" . $this->db->escape($keywords) . "', `tag` = '" . $this->db->escape($tag) . "' WHERE `product_id` = '" .(int)$product_id. "' and `language_id` = '" .$langs[$i] . "'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($meta_desc) . "', `seo_h1` = '" . $this->db->escape($seo_h1) . "', `seo_title` = '" . $this->db->escape($seo_title) . "', `meta_keyword` = '" . $this->db->escape($keywords) . "' WHERE `product_id` = '" .(int)$product_id. "' and `language_id` = '" .$langs[$i] . "'");
				}	
			}	
		}
		
		if ((!empty($row_product[0]['ref']) or $row_product[0]['ref'] == '0') and preg_match('/^[0-9]+$/', $t_ref) and $t_ref > 0) {
			
			switch ($t_ref) {			
				case 1:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 2:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i] . "'");
					}	
					break;
				case 3:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 4:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 5:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 6:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `minimum` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 7:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `subtract` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 8:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 9:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `length_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 10:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `weight_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 11:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `tax_class_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 12:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `points` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 13:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `location` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 14:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `jan` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 15:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `isbn` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;	
				case 16:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `stock_status_id` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;				
				case 17:
                    $rows = $this->getProductSerie((int)$product_id);
                    if (empty($rows)) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_series SET `product_id` = '" .(int)$product_id. "', `series_id` = '" . (int)$row_product[0]['ref'] . "'");
                    } else {    
                        $this->db->query("UPDATE `" . DB_PREFIX . "product_to_series` SET `series_id` = '" . (int)$row_product[0]['ref'] . "' WHERE `product_id` = '" .(int)$product_id . "'");
                    }    
                    break;
				case 18:									
	//				$this->db->query("UPDATE `" . DB_PREFIX . "my_table` SET `my_field` = '" . $this->db->escape($row_product[0]['ref']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;	
			}
		}
		if ((!empty($row_product[0]['ref1']) or $row_product[0]['ref1'] == '0') and preg_match('/^[0-9]+$/', $t_ref1) and $t_ref1 > 0) {	
			
			switch ($t_ref1) {			
				case 1:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 2:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i] . "'");
					}	
					break;
				case 3:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 4:
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					}	
					break;
				case 5:									
					for	($i=1; $i<=count($langs); $i++) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $langs[$i]. "'");
					} 
					break;
				case 6:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `minimum` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 7:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `subtract` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 8:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 9:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `length_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 10:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `weight_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 11:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `tax_class_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 12:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `points` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 13:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `location` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 14:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `jan` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;
				case 15:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `isbn` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;	
				case 16:									
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `stock_status_id` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;				
				case 17:
                    $rows = $this->getProductSerie((int)$product_id);
                    if (empty($rows)) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_series SET `product_id` = '" .(int)$product_id. "', `series_id` = '" . (int)$row_product[0]['ref1'] . "'");
                    } else {    
                        $this->db->query("UPDATE `" . DB_PREFIX . "product_to_series` SET `series_id` = '" . (int)$row_product[0]['ref1'] . "' WHERE `product_id` = '" .(int)$product_id . "'");
                    }    
                    break;
				case 18:									
	//				$this->db->query("UPDATE `" . DB_PREFIX . "my_table` SET `my_field` = '" . $this->db->escape($row_product[0]['ref1']) . "' WHERE `product_id` = '" .(int)$product_id . "'");
					break;	
			}
		}
		$this->cache->delete('*');
	}
	
	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");	
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id. "'");	
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_sku WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_base_price WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_ref WHERE product_id = '" . (int)$product_id . "'");		
		$this->db->query("DELETE FROM " . DB_PREFIX . "relatedoptions_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "relatedoptions WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "relatedoptions_variant_product WHERE product_id = '" . (int)$product_id . "'");		
		
		$this->cache->delete('product');
	}	
	
	public function clearCache() {
		$this->cache->delete('*');
	}
	
	public function Code($text) {
		
		$text = $this->symbol($text);		
		
	//	$text = str_replace('?' , '' , $text);
	//	$text = str_replace('@' , '' , $text);
	//	$text = str_replace('+' , '' , $text);
	//	$text = str_replace('!' , '' , $text);
	//	$text = str_replace(',' , '' , $text);		
	//	$text = str_replace('&nbsp;' , ' ' , $text);		
		$text = str_replace('"', '&quot;' , $text);
	//	$text = str_replace("'" , '&amp;#039;' , $text);		
		$text = preg_replace('| +|', ' ', $text);		
		$text = preg_replace('|-+|', '-', $text);
		$text = preg_replace('|_+|', '_', $text);
		
		$text = trim($text);

		return $text;
	}
	
	public function MetaURL($text) {
		$text = strip_tags($text);	
		$text = str_replace('&amp;&quot;' , '-' , $text);			
		$text = str_replace('&amp;' , '-' , $text);
		$text = str_replace('&quot;' , '-' , $text);
		$text = str_replace('&gt;' , '-' , $text);
		$text = str_replace('&lt;' , '-' , $text);
		$text = str_replace("'" , '-' , $text);
		$text = str_replace('"' , '-' , $text);
		$text = str_replace('«' , '' , $text);
		$text = str_replace('»' , '' , $text);
		$text = str_replace('.' , '-' , $text);
		$text = str_replace(':' , '-' , $text);
		$text = str_replace('|' , '-' , $text);
		$text = str_replace('*' , '-' , $text);
		$text = str_replace('=' , '-' , $text);
		$text = str_replace('^' , '-' , $text);
		$text = str_replace('%' , '-' , $text);
		$text = str_replace('$' , '-' , $text);
		$text = str_replace('?' , '-' , $text);
		$text = str_replace('@' , '-' , $text);
		$text = str_replace('+' , '-' , $text);
		$text = str_replace('!' , '-' , $text);
		$text = str_replace('<' , '' , $text);		
		$text = str_replace('>' , '' , $text);
		$text = str_replace('#' , '' , $text);
		$text = str_replace(',' , '-' , $text);		
		$text = str_replace('\\' , '-' , $text);
		$text = str_replace('\/' , '-' , $text);		
		$text = str_replace('_' , '-' , $text);
		$text = str_replace("/" , '-' , $text);		
		$text = str_replace("(" , '' , $text);
		$text = str_replace(")" , '' , $text);
		$text = str_replace("[" , '' , $text);
		$text = str_replace("]" , '' , $text);
		$text = str_replace('&' , '-' , $text);		
		$text = str_replace('#' , '' , $text);		
		$text = str_replace(" " , '-' , $text);
		$text = str_replace("№" , '' , $text);
		$text = preg_replace('|-+|', '-', $text);		
		$l = strlen($text);		
		if (substr($text, $l-1, 1) == "-") $text = substr($text, 0, $l-1);
		$text = trim($text);

		return $text;
	}
	
	public function symbol($text) {
	
		$tr = array(
				"&amp;#000;"=>"","&amp;#001;"=>"","&amp;#002;"=>"","&amp;#003;"=>"","&amp;#004;"=>"","&amp;#005;"=>"",
				"&amp;#006;"=>"","&amp;#007;"=>"","&amp;#008;"=>"","&amp;#009;"=>"","&amp;#010;"=>"","&amp;#011;"=>"",
				"&amp;#012;"=>"","&amp;#013;"=>"","&amp;#014;"=>"","&amp;#015;"=>"","&amp;#016;"=>"","&amp;#017;"=>"",
				"&amp;#018;"=>"","&amp;#019;"=>"","&amp;#020;"=>"","&amp;#021;"=>"","&amp;#022;"=>'"',"&amp;#023;"=>"",
				"&amp;#024;"=>"","&amp;#025;"=>"","&amp;#026;"=>"","&amp;#027;"=>"","&amp;#028;"=>"","&amp;#029;"=>"",
				"&amp;#030;"=>"","&amp;#031;"=>"","&amp;#032;"=>"",
                "&amp;#033;"=>"!","&amp;#034;"=>'"',"&amp;#035;"=>"#","&amp;#036;"=>"$",
                "&amp;#037;"=>"%","&amp;#038;"=>"&","&amp;#039;"=>"'","&amp;#040;"=>"(",
				"&amp;#041;"=>")","&amp;#042;"=>"*","&amp;#043;"=>"+","&amp;#044;"=>'"',"&amp;#045;"=>"-",
				"&amp;#046;"=>".","&amp;#047;"=>"/","&amp;#058;"=>":","&amp;#059;"=>";","&amp;#060;"=>"<",
				"&amp;#061;"=>"=","&amp;#062;"=>">","&amp;#064;"=>"?","&amp;#064;"=>"@",
				"&amp;#091;"=>"[","&amp;#092;"=>"\\","&amp;#093;"=>"]","&amp;#094;"=>"^","&amp;#095;"=>"_",
				"&amp;#096;"=>"`","&amp;#123;"=>"{","&amp;#124;"=>"|","&amp;#125;"=>"}","&amp;#126;"=>"~",
				"&amp;#128;"=>"EUR","&amp;#130;"=>'"',"&amp;#131;"=>"f","&amp;#132;"=>'"',"&amp;#133;"=>"...",
				"&amp;#134;"=>"+","&amp;#135;"=>"","&amp;#136;"=>"^","&amp;#137;"=>"%.","&amp;#138;"=>"S",
				"&amp;#139;"=>"","&amp;#140;"=>"","&amp;#141;"=>"","&amp;#142;"=>"","&amp;#143;"=>"",
				"&amp;#144;"=>"","&amp;#145;"=>"`","&amp;#146;"=>'"',"&amp;#147;"=>'"',"&amp;#148;"=>'"',
				"&amp;#149;"=>"*","&amp;#150;"=>"-","&amp;#151;"=>"-","&amp;#152;"=>"~","&amp;#153;"=>"TM",
				"&amp;#154;"=>"s","&amp;#155;"=>">","&amp;#156;"=>"","&amp;#157;"=>"","&amp;#158;"=>"",
				"&amp;#159;"=>"","&amp;#160;"=>" ","&amp;#161;"=>"","&amp;#162;"=>"","&amp;#163;"=>"",
				"&amp;#164;"=>"","&amp;#165;"=>"","&amp;#166;"=>"|","&amp;#167;"=>"","&amp;#168;"=>"..",
				"&amp;#169;"=>"","&amp;#170;"=>"a","&amp;#171;"=>'"',"&amp;#172;"=>"","&amp;#173;"=>"",
				"&amp;#174;"=>"","&amp;#175;"=>"","&amp;#176;"=>"","&amp;#177;"=>"","&amp;#178;"=>"",
				"&amp;#179;"=>"","&amp;#180;"=>"","&amp;#181;"=>"","&amp;#182;"=>"","&amp;#183;"=>"",
				"&amp;#184;"=>"","&amp;#185;"=>"","&amp;#186;"=>"","&amp;#187;"=>'"',"&amp;#188;"=>"",
				"&amp;#189;"=>"","&amp;#190;"=>"","&amp;#191;"=>"","&amp;#192;"=>"","&amp;#193;"=>"",
				"&amp;#194;"=>"","&amp;#195;"=>"","&amp;#196;"=>"","&amp;#197;"=>"","&amp;#198;"=>"",
				"&amp;#199;"=>"","&amp;#200;"=>"","&amp;#201;"=>"","&amp;#202;"=>"","&amp;#203;"=>"",
				"&amp;#204;"=>"","&amp;#205;"=>"","&amp;#206;"=>"","&amp;#207;"=>"","&amp;#208;"=>"",
				"&amp;#209;"=>"","&amp;#210;"=>"","&amp;#211;"=>"","&amp;#212;"=>"","&amp;#213;"=>"",
				"&amp;#214;"=>"","&amp;#215;"=>"","&amp;#216;"=>"","&amp;#217;"=>"","&amp;#218;"=>"",
				"&amp;#219;"=>"","&amp;#220;"=>"","&amp;#221;"=>"","&amp;#222;"=>"","&amp;#223;"=>"",
				"&amp;#224;"=>"","&amp;#225;"=>"","&amp;#226;"=>"","&amp;#227;"=>"","&amp;#228;"=>"",
				"&amp;#229;"=>"","&amp;#230;"=>"","&amp;#231;"=>"","&amp;#232;"=>"","&amp;#233;"=>"",
				"&amp;#234;"=>"","&amp;#235;"=>"","&amp;#236;"=>"","&amp;#237;"=>"","&amp;#238;"=>"",
				"&amp;#239;"=>"","&amp;#240;"=>"","&amp;#241;"=>"","&amp;#242;"=>"","&amp;#243;"=>"",
				"&amp;#244;"=>"","&amp;#245;"=>"","&amp;#246;"=>"","&amp;#247;"=>"","&amp;#248;"=>"",
				"&amp;#240;"=>"","&amp;#250;"=>"","&amp;#251;"=>"","&amp;#252;"=>"","&amp;#253;"=>"",
				"&amp;#254;"=>"","&amp;#255;"=>"","&amp;#8221;"=>'"',"&amp;quot;" =>'"', "&amp;laquo;" =>'"', 
				"&amp;raquo;" =>'"', "&amp;raquo;" =>'"', "&amp;ndash;" =>"-", "&amp;plusmn;"=>"", "&amp;amp;"=>"&",
				"&amp;gt;"=>">", "&amp;lt;"=>"<", "&amp;nbsp;"=>" ",
				
				"&#000;"=>"","&#001;"=>"","&#002;"=>"","&#003;"=>"","&#004;"=>"","&#005;"=>"",
				"&#006;"=>"","&#007;"=>"","&#008;"=>"","&#009;"=>"","&#010;"=>"","&#011;"=>"",
				"&#012;"=>"","&#013;"=>"","&#014;"=>"","&#015;"=>"","&#016;"=>"","&#017;"=>"",
				"&#018;"=>"","&#019;"=>"","&#020;"=>"","&#021;"=>"","&#022;"=>"","&#023;"=>"",
				"&#024;"=>"","&#025;"=>"","&#026;"=>"","&#027;"=>"","&#028;"=>"","&#029;"=>"",
				"&#030;"=>"","&#031;"=>"","&#032;"=>"", "&#33;"=>"!","&#34;"=>'"',"&#35;"=>"#","&#36;"=>"$",
                "&#37;"=>"%","&#38;"=>"&","&#39;"=>"'","&#40;"=>"(",
				"&#41;"=>")","&#42;"=>"*","&#43;"=>"+","&#44;"=>'"',"&#45;"=>"-",
				"&#46;"=>".","&#47;"=>"/","&#58;"=>":","&#59;"=>";","&#60;"=>"<",
				"&#61;"=>"=","&#62;"=>">","&#64;"=>"?","&#64;"=>"@",
				"&#91;"=>"[","&#92;"=>"\\","&#93;"=>"]","&#94;"=>"^","&#95;"=>"_",
				"&#96;"=>"`",
                "&#033;"=>"!","&#034;"=>'"',"&#035;"=>"#","&#036;"=>"$",
                "&#037;"=>"%","&#038;"=>"&","&#039;"=>"'","&#040;"=>"(",
				"&#041;"=>")","&#042;"=>"*","&#043;"=>"+","&#044;"=>'"',"&#045;"=>"-",
				"&#046;"=>".","&#047;"=>"/","&#058;"=>":","&#059;"=>";","&#060;"=>"<",
				"&#061;"=>"=","&#062;"=>">","&#064;"=>"?","&#064;"=>"@",
				"&#091;"=>"[","&#092;"=>"\\","&#093;"=>"]","&#094;"=>"^","&#095;"=>"_",
				"&#096;"=>"`","&#123;"=>"{","&#124;"=>"|","&#125;"=>"}","&#126;"=>"~",
				"&#128;"=>"EUR","&#130;"=>'"',"&#131;"=>"f","&#132;"=>'"',"&#133;"=>"...",
				"&#134;"=>"+","&#135;"=>"","&#136;"=>"^","&#137;"=>"%.","&#138;"=>"S",
				"&#139;"=>"","&#140;"=>"","&#141;"=>"","&#142;"=>"","&#143;"=>"",
				"&#144;"=>"","&#145;"=>"`","&#146;"=>'"',"&#147;"=>'"',"&#148;"=>'"',
				"&#149;"=>"*","&#150;"=>"-","&#151;"=>"-","&#152;"=>"~","&#153;"=>"TM",
				"&#154;"=>"s","&#155;"=>">","&#156;"=>"","&#157;"=>"","&#158;"=>"",
				"&#159;"=>"","&#160;"=>" ","&#161;"=>"","&#162;"=>"","&#163;"=>"",
				"&#164;"=>"","&#165;"=>"","&#166;"=>"|","&#167;"=>"","&#168;"=>"..",
				"&#169;"=>"","&#170;"=>"a","&#171;"=>'"',"&#172;"=>"","&#173;"=>"",
				"&#174;"=>"","&#175;"=>"","&#176;"=>"","&#177;"=>"","&#178;"=>"",
				"&#179;"=>"","&#180;"=>"","&#181;"=>"","&#182;"=>"","&#183;"=>"",
				"&#184;"=>"","&#185;"=>"","&#186;"=>"","&#187;"=>'"',"&#188;"=>"",
				"&#189;"=>"","&#190;"=>"","&#191;"=>"","&#192;"=>"","&#193;"=>"",
				"&#194;"=>"","&#195;"=>"","&#196;"=>"","&#197;"=>"","&#198;"=>"",
				"&#199;"=>"","&#200;"=>"","&#201;"=>"","&#202;"=>"","&#203;"=>"",
				"&#204;"=>"","&#205;"=>"","&#206;"=>"","&#207;"=>"","&#208;"=>"",
				"&#209;"=>"","&#210;"=>"","&#211;"=>"","&#212;"=>"","&#213;"=>"",
				"&#214;"=>"","&#215;"=>"","&#216;"=>"","&#217;"=>"","&#218;"=>"",
				"&#219;"=>"","&#220;"=>"","&#221;"=>"","&#222;"=>"","&#223;"=>"",
				"&#224;"=>"","&#225;"=>"","&#226;"=>"","&#227;"=>"","&#228;"=>"",
				"&#229;"=>"","&#230;"=>"","&#231;"=>"","&#232;"=>"","&#233;"=>"",
				"&#234;"=>"","&#235;"=>"","&#236;"=>"","&#237;"=>"","&#238;"=>"",
				"&#239;"=>"","&#240;"=>"","&#241;"=>"","&#242;"=>"","&#243;"=>"",
				"&#244;"=>"","&#245;"=>"","&#246;"=>"","&#247;"=>"","&#248;"=>"",
				"&#240;"=>"","&#250;"=>"","&#251;"=>"","&#252;"=>"","&#253;"=>"",
				"&#254;"=>"","&#255;"=>"", "&#8221;"=>'"', "&quot;" =>'"', "&laquo;" =>'"', 
				"&raquo;" =>'"', "&raquo;" =>'"', "&ndash;" =>"-", "&plusmn;"=>"", "&#8482;" =>"","&#8470;"=>"№");
				
		$text = strtr($text, $tr);
	//	$text = preg_replace('#^(:?&)(.*&?)(;)$#','',$text);		

		return $text;
	}

	public function litteras($text) {
	
		$tr = array(
				"&#45;"=>'-',"&#46;"=>'.',"&#47;"=>'/',
				"&#33;"=>'!',"&#34;"=>'"',"&#40;"=>'(',"&#41;"=>")","&#42;"=>"*","&#43;"=>"+",
				"&#758;"=>'"',"&#760;"=>":","&#782;"=>'"',"&#800;"=>"_","&#39;"=>"'","&#38;"=>"&",
				"&#840;"=>'"',"&#818;"=>"_","&#824;"=>"/","&#822;"=>"-","&#817;"=>"-","&#451;"=>"!",
				"&#1030;"=>"I","&#1031;"=>"Ї","&#1042;"=>"В","&#1110;"=>"і","&#1111;"=>"ї","&#835;"=>"'",
				"&#1040;"=>"А","&#1041;"=>"Б","&#1042;"=>"В","&#1043;"=>"Г","&#1044;"=>"Д","&#1045;"=>"Е",
				"&#1046;"=>"Ж","&#1047;"=>"З","&#1048;"=>"И","&#1049;"=>"Й","&#1050;"=>"К","&#1051;"=>"Л",
				"&#1052;"=>"М","&#1053;"=>"Н","&#1054;"=>"О","&#1055;"=>"П","&#1056;"=>"Р","&#1057;"=>"С",
				"&#1058;"=>"Т","&#1059;"=>"У","&#1060;"=>"Ф","&#1061;"=>"Х","&#1062;"=>"Ц","&#1063;"=>"Ч",
				"&#1064;"=>"Ш","&#1065;"=>"Щ","&#1066;"=>"Ъ","&#1067;"=>"Ы","&#1068;"=>"Ь","&#1069;"=>"Э",
				"&#1070;"=>"Ю","&#1071;"=>"Я","&#1072;"=>"а","&#1073;"=>"б","&#1074;"=>"в","&#1075;"=>"г",
				"&#1076;"=>"д","&#1077;"=>"е","&#1078;"=>"ж","&#1079;"=>"з","&#1080;"=>"и","&#1081;"=>"й",
				"&#1082;"=>"к","&#1083;"=>"л","&#1084;"=>"м","&#1085;"=>"н","&#1086;"=>"о","&#1087;"=>"п",
				"&#1088;"=>"р","&#1089;"=>"с","&#1090;"=>"т","&#1091;"=>"у","&#1092;"=>"ф","&#1093;"=>"х",
				"&#1094;"=>"ц","&#1095;"=>"ч","&#1096;"=>"ш","&#1097;"=>"щ","&#1098;"=>"ъ","&#1099;"=>"ы",
				"&#1100;"=>"ь","&#1101;"=>"э","&#1102;"=>"ю","&#1103;"=>"я","&#8470;"=>"№");
				
		$text = strtr($text, $tr);
		$text = preg_replace('#^(:?&)(.*&?)(;)$#','',$text);		

		return $text;
	}

	public function TransLit($text) {
	
		$tr = array(
                "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
                "Д"=>"d","Е"=>"e","Ё"=>"e","Ж"=>"G","З"=>"z","И"=>"i",
                "Й"=>"J","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
                "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
                "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
                "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"y","Ь"=>"",
                "Э"=>"e","Ю"=>"yu","Я"=>"ya","Ї"=>"ji","Ґ" =>"g","І" =>"I","а"=>"a","б"=>"b",
                "в"=>"v","г"=>"g","д"=>"d","е"=>"e", "ё"=>"e","ж"=>"g",
                "з"=>"z","и"=>"i","й"=>"j","к"=>"k","л"=>"l",
                "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
                "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
                "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
                "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
                "ї"=> "ji", "і"=> "i", "ґ" =>"g", "Є" =>"e", "є" =>"e" );
				
		$text = strtr($text, $tr);
		unset ($tr);
		return $text;
	}
	
	public function clearSEO($text) {
		$text = str_replace(' [n]', '', $text);
		$text = str_replace('[n]', '', $text);
		$text = str_replace(' [p]', '', $text);
		$text = str_replace('[p]', '', $text);
		$text = str_replace(' [sp]', '', $text);
		$text = str_replace('[sp]', '', $text);
		$text = str_replace(' [c]', '', $text);
		$text = str_replace('[c]', '', $text);
		$text = str_replace(' [pc]', '', $text);
		$text = str_replace('[pc]', '', $text);
		$text = str_replace(' [m]', '', $text);
		$text = str_replace('[m]', '', $text);
		$text = str_replace(' [d]', '', $text);	
		$text = str_replace('[d]', '', $text);
		$text = str_replace(' [b]', '', $text);	
		$text = str_replace('[b]', '', $text);
		$text = str_replace(' [sku]', '', $text);	
		$text = str_replace('[sku]', '', $text);
	
		for ($j=1; $j<300; $j++) {			
			$a = ' {' . $j . '}';
			$text = str_replace($a, '', $text);
			$a = '{' . $j . '}';
			$text = str_replace($a, '', $text);	
		}
		for ($j=1; $j<21; $j++) {			
			$a = ' [' . $j . ']';
			$text = str_replace($a, '', $text);	
			$a = '[' . $j . ']';
			$text = str_replace($a, '', $text);	
		}
		return $text;
	}
	
	public function updatePrice($row, $cheap, $kmenu, $disc, $onn, $placep, $ratek, $cprice, $zero, $max_site, $nomkol, $ident, $param, $point, $noprice, $paramnp, $pointnp, $baseprice, $onoff, $sleep, $ffile) {	
		if (!$row['sku']) return;
		$price = $row['price'];
		$zero_prod = 0;
		$off_prod = 0;
		$new_price = 0;
		$baseprice1 = 0;
		$mas = array();
		$identificator = array();
		$rows = $this->getReferens($row['product_id']);								
		if (!empty($rows)) {
			$k = 0;
			foreach ($rows as $r) {	
				$ht = $this->curl_get_contents($r['url'], 0, $sleep, $ffile);
				if (strlen($ht) > 1024) {
					$ff = 0;
					for ($l=0; $l<$max_site; $l++) {
						if ($r['ident'] == $ident[$l]) {
							$ff = 1;
							break;
						}	
					}
					if ($ff) {	
						$pr = $this->ParsPrice($ht, $param[$l], $point[$l], $placep);	
						if (!empty($pr)) $pr = $pr*$ratek;						
						$parsedprice = 0;
						if ($pr) $parsedprice = $pr; 
						$this->db->query("UPDATE `" . DB_PREFIX . "suppler_ref` SET `price` = '" . $parsedprice . "' WHERE `nom_id` = '" .(int)$r['nom_id'] . "'");
						if (!empty($pr) and $pr > $row['price']/2) {							
							if (!empty($noprice[$l])) {
								$nopr = $this->ParsName($ht, $paramnp[$l], $pointnp[$l], 1);
								if (empty($nopr) or !substr_count($nopr, $noprice[$l])) {
									$mas[$k] = round($pr, 2);									
									if ($baseprice[$l]) $baseprice1 = $pr;
									$k++;												
								}						
							} else {	
								$mas[$k] = round($pr, 2);								
								if ($baseprice[$l]) $baseprice1 = $pr;
								$k++;						
							}	
						}						
						
					}	
				}				
			}
		}
	    $l = 0;
		if (!empty($mas)) {
			$min = 1000000000;
			for ($j=0; $j<$k; $j++) {
				if ($mas[$j] <= $min) {
					$min = $mas[$j];
					$l = $j;
				}	
			}
			$sum = 0;
			for ($j=0; $j<$k; $j++) {
				$sum = $sum + $mas[$j];
			}
			$sum = $sum/$j;
			$maxp = 0;
			$m = 100;
			for ($j=0; $j<$k; $j++) {
				if ($mas[$j] >= $maxp) {
					$maxp = $mas[$j];
					$m = $j;
				}	
			}	
			$optimal = $sum;
			if (count($mas) == 2) $optimal = ($mas[0]+$mas[1])/2;
			if (count($mas) > 2) {
				$optimal = 0;
				for ($j=0; $j<$k; $j++) {
					$w = 3;
					if ($j==$l) $w = 1;									
					if ($j==$m) $w = 2;
					$optimal = $optimal + $mas[$j] * $w;	
				}
				$optimal = $optimal/($j*3-3);							
			}	
			$submin = 1000000000;
			$mas[$l] = 999999999;
			for ($j=0; $j<$k; $j++) {
				if ($mas[$j] <= $submin) $submin = $mas[$j];
			}
			if ($submin > 999999998) $submin = $min;
			$po = strpos($onn, '%');
			if ($po) $onnn = substr($onn, 0, $po);
			else $onnn = $onn;			
			switch ($cheap) {			
				case 1:									
					if ($po) $new_price = $min - $min*$onnn/100;
					else $new_price = $min - $onnn;
					break;
				case 2:									
					if ($po) $new_price = $sum - $sum*$onnn/100;
					else $new_price = $sum - $onnn;		
					break;
				case 3:									
					if ($po) $new_price = $maxp - $maxp*$onnn/100;
					else $new_price = $maxp - $onnn;
					break;
				case 4:									
					if ($po) $new_price = $optimal - $optimal*$onnn/100;
					else $new_price = $optimal - $onnn;
					break;
				case 5:									
					if ($po) $new_price = $min + $min*$onnn/100;
					else $new_price = $min + $onnn;
					break;
				case 6:									
					if ($po) $new_price = $sum + $sum*$onnn/100;
					else $new_price = $sum + $onnn;		
					break;
				case 7:									
					if ($po) $new_price = $maxp + $maxp*$onnn/100;
					else $new_price = $maxp + $onnn;
					break;
				case 8:									
					if ($po) $new_price = $optimal + $optimal*$onnn/100;
					else $new_price = $optimal + $onnn;
					break;		
			}
	
			$status = 0;
			$quantity = 10;
			if ($onoff) $status = 1;
			if ($baseprice1) {			
				$bpr = strip_tags($baseprice1);
				$bpr = preg_replace('/[^0-9.,Ee+-]/','',$bpr);
				$bpr = str_replace(',', '.',$bpr);
				$bpr = trim($bpr);
				$bpr = $bpr*$ratek;
				$bpr = round($bpr, 2);
				$bprr = $bpr;
				if (!empty($disc)) $bprr = $bpr - $bpr*$disc/100;
				if ($bprr > $new_price) {
					switch ($kmenu) {
						case '0': $new_price = 0;
							break;
						case '1': $quantity = 0;
								$new_price = $price;
							break;
						case '2': $status = 0;
								$new_price = $price;
							break;
						case '3': $new_price = $bpr*1.01;
							break;
						case '4': 
							if ($po) $new_price = $min - $min*$onnn/100;
							else $new_price = $min - $onnn;											
							break;
						case '5': 
							if ($po) $new_price = $submin - $submin*$onnn/100;
							else $new_price = $submin - $onnn;											
							break;	
					}		
				}
				$percent_to_bprice = 0;
				if ($bpr) $percent_to_bprice = 100*($new_price-$bpr)/$bpr;
				$percent_to_bdprice = 0;
				if ($bprr) $percent_to_bdprice = 100*($new_price-$bprr)/$bprr;
				
				$this->db->query("UPDATE `" . DB_PREFIX . "suppler_base_price` SET `bprice` = '" . $bpr . "',  `market_percent_to_bprice` = '" . $percent_to_bprice . "', `market_percent_to_bdprice` = '" . $percent_to_bdprice . "' WHERE `product_id` = '" . $row['product_id'] . "'");				
			}		
			
			$percent_to_price = 0;			
						
			$this->db->query("UPDATE `" . DB_PREFIX . "suppler_base_price` SET `optimal` = '" . $optimal . "', `bmin` = '" . $min . "', `bav` = '" . $sum . "', `bmax` = '" . $maxp . "', `market_percent_to_price` = '" . $percent_to_price . "' WHERE `product_id` = '" . $row['product_id'] . "'");	
	
			if ($new_price) {	
				$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `price` = '" . $new_price . "', `status` = '" . 1 . "', `quantity` = '" . $quantity . "', `status` = '" . $status . "' WHERE `product_id` = '" .(int)$row['product_id'] . "'");
			}
			unset($mas);
			unset($identificator);
		} else {
			switch ($zero) {
				case '0': 
					break;
				case '1': 
						$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `quantity` = '" . 0 . "', `stock_status_id` = '" . 5 . "' WHERE `product_id` = '" .(int)$row['product_id'] . "'");	
					break;
				case '2': 
						$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `status` = '" . 0 . "' WHERE `product_id` = '" .(int)$row['product_id'] . "'");	
					break;
			}
		}	
	}
	
	public function PicData1($addrold, $folder, &$addrnew) {		
		$p = strpos($addrold, "/");
		$of = substr($addrold, $p+1);
		$p = strpos($of, "/");
		if ($p) {
			$of = substr($of, 0, $p);
			$addrnew = str_replace($of, $folder, $addrold);
		}	
	}	
	
	public function PicData($row, $mas_catid, $pic_int) {		
		$rows = $this->getProductCategory($row['product_id']);
		if ($rows) {
			$child = 0;			
			for ($i=0; $i<1000; $i++) {
				if (!isset($rows[$i]['category_id'])) break;
				if ($rows[$i]['category_id'] > $child) $child = $rows[$i]['category_id'];				
			}
			if (!$child) return;
			$f = 0;
			for ($i=1; $i<1000; $i++) {
				if (!isset($mas_catid[$i])) break;
				if ($mas_catid[$i] == $child) {
					$f = $i;
					break;
				}	
			}
			if (!$f) {
				$err =  " Please, set category and folder for photo on page 'Category and margin' for Product: " . $row['model'] . " Category_id: " . $child ."  \n";
				$this->adderr($err);
				return;
			}
			$addrnew = 0;
			$this->PicData1($row['image'], $pic_int[$f], $addrnew);
			if ($addrnew and $addrnew != $row['image']) {
				$path_old = "../image/" . $row['image'];
				$path_new = "../image/" . $addrnew;
				$p = strrpos($addrnew, "/");
				if ($p) {
					$path = "../image/" . substr($addrnew, 0, $p) . "/";
					if (!is_dir($path)) @mkdir($path, 0755);
					if (copy($path_old, $path_new)) {
						$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" . $addrnew . "' WHERE `product_id` = '" . $row['product_id'] . "'");
						
						if (file_exists($path_old)) @unlink ($path_old);
					}
				}
			}
			$rows = $this->getProductImage($row['product_id']);
			if (!empty ($rows)) {	
				foreach ($rows as $pp) {
					$addrnew = 0;
					$this->PicData1($pp['image'], $pic_int[$f], $addrnew);	
					if ($addrnew and $addrnew != $pp['image']) {
						$path_old = "../image/" . $pp['image'];
						$path_new = "../image/" . $addrnew;
						$p = strrpos($addrnew, "/");
						if ($p) {
							$path = "../image/" . substr($addrnew, 0, $p) . "/";
							if (!is_dir($path)) @mkdir($path, 0755);
							if (copy($path_old, $path_new)) {
								$this->db->query("UPDATE " . DB_PREFIX . "product_image SET `image` = '" . $addrnew . "' WHERE `product_image_id` = '" . $pp['product_image_id'] . "'");
								
								if (file_exists($path_old)) @unlink ($path_old);
							}	
						}
					}							
				}
			}
		}	
	}
	
	public function PrintDublNameProducts($row) {
		$model = $row['model'];
		$rows = $this->getProductDesc($row['product_id']);	
		if (empty($rows)) return;
		$rows = $this->getProductDesc($row['product_id']);	
		$rows = $this->getProductIDbyName($rows[0]['name']);
		if (!isset($rows[1]['name'])) return;
		$st = 'Product code: ' . $model . ' Name: ' . $rows[0]['name'];
		for ($i=1; $i<30; $i++) {
			if (!isset($rows[$i]['product_id'])) break;
			$rows1 = $this->getProductsByID($rows[$i]['product_id']);
			$st = $st . "    " . $rows1[0]['model'];
		}			
		if (strlen($st) > 19) {
			$err = $st . " \n";
			$this->adderr($err);
		}
	}
	
	public function DoubleAliasManuf() {
		$row = $this->getMaxAliasID();
		$max = $row['max(url_alias_id)'];
		for ($j=1; $j<=$max; $j++) {
			$row = $this->getURLmanufacturer($j);			
			if (empty($row)) continue;
			if (!substr_count($row['query'], "urer_id=")) continue;
			$a = $row['query'];
			$p = strpos($a, "=");
			$a = (int)substr($a, $p+1);
			$rows1 = $this->getManufacturerName((int)$a);
			if (empty($rows1)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . $a. "'");
				continue;
			}
			$seo_url = $row['keyword'];			
			$rows = $this->chURL($seo_url);
			if (!isset($rows[1]['query'])) continue;
			$st = 'Manufacturer: ';
			for ($i=0; $i<10; $i++) {
				if (!isset($rows[$i]['query'])) break;
				if (!substr_count($rows[$i]['query'], "urer_id=")) continue;
				$a = $rows[$i]['query'];
				$p = strpos($a, "=");
				$a = (int)substr($a, $p+1);
				$rows1 = $this->getManufacturerName((int)$a);
				if (!empty($rows1)) $st = $st . "    " . $rows1[0]['name'];
			}			
			if (strlen($st) > 19) {
				$err = $st . " \n";
				$this->adderr($err);
			}		
		}	
	}
	
	public function DoubleAliasCat() {
		$row = $this->getMaxAliasID();
		$max = $row['max(url_alias_id)'];
		for ($j=1; $j<=$max; $j++) {
			$row = $this->getURLcategory($j);			
			if (empty($row)) continue;
			if (!substr_count($row['query'], "gory_id=")) continue;
			$a = $row['query'];
			$p = strpos($a, "=");
			$a = (int)substr($a, $p+1);
			$rows1 = $this->getCategory((int)$a);
			if (empty($rows1)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . $a. "'");
				continue;
			}
			$seo_url = $row['keyword'];			
			$rows = $this->chURL($seo_url);
			if (!isset($rows[1]['query'])) continue;
			$st = 'Categories: ';
			for ($i=0; $i<10; $i++) {
				if (!isset($rows[$i]['query'])) break;
				if (!substr_count($rows[$i]['query'], "gory_id=")) continue;
				$a = $rows[$i]['query'];
				$p = strpos($a, "=");
				$a = (int)substr($a, $p+1);
				$rows1 = $this->getCategoryName((int)$a);
				if (!empty($rows1)) $st = $st . "    " . $rows1[0]['name'];
			}			
			if (strlen($st) > 17) {
				$err = $st . " \n";
				$this->adderr($err);
			}		
		}	
	}
	
	public function FixDublAliasProducts($product_id) {
		if (!$product_id) return;
		$row = $this->getURL($product_id);
		if (empty($row)) return;
		$seo_url = $row['keyword'];			
		$rows = $this->chURL($seo_url);
		if (!isset($rows[1]['query'])) return;
		$st = 'Product SKU: ';		
		for ($i=0; $i<50; $i++) {
			if (!isset($rows[$i]['query'])) break;
			if (!substr_count($rows[$i]['query'], "duct_id=")) continue;			
			$a = $rows[$i]['query'];
			$p = strpos($a, "=");
			$a = (int)substr($a, $p+1);
			$row = $this->getProductByID((int)$a);
			if (empty($row)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . $product_id. "'");
				continue;
			} else {	
				$st = $st . "    " . $row['sku'];
				if ($i>0 and !substr_count($rows[$i]['query'], $row['sku'])) {
					$seo = $seo_url . '-' . $row['sku'];
					$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo) . "' WHERE `query` = 'product_id=" . (int)$a . "'");
				}
			}	
		}
		if (strlen($st) > 30) {
			$err = $st . " \n";
			$this->adderr($err);
		}
	}
	public function PrintDublAliasProducts($product_id) {
		if (!$product_id) return;
		$row = $this->getURL($product_id);
		if (empty($row)) return;
		$seo_url = $row['keyword'];			
		$rows = $this->chURL($seo_url);
		if (!isset($rows[1]['query'])) return;
		$st = 'Product Codes: ';		
		for ($i=0; $i<50; $i++) {
			if (!isset($rows[$i]['query'])) break;
			if (!substr_count($rows[$i]['query'], "duct_id=")) continue;
			$a = $rows[$i]['query'];
			$p = strpos($a, "=");
			$a = (int)substr($a, $p+1);
			$row = $this->getProductByID((int)$a);				
			$st = $st . "    " . $row['model'];
		}
		if (strlen($st) > 30) {
			$err = $st . " \n";
			$this->adderr($err);
		}
	}
	
	public function FixDesCategoryNest($seo_data, $store, $papa) {
		$lang = $this->config->get('config_language_id');
		for ($j=0; $j<2000; $j++) {	
			if (!isset($papa[$j])) break;
			$rows1 = $this->getChildCategory($papa[$j]);
			if (empty($rows1)) continue;
			for ($i=0; $i<=3000; $i++) {	
				if (!isset($rows1[$i]['category_id'])) break;
				$rows = $this->getCategoryName($rows1[$i]['category_id']);
				if (empty($rows)) continue;
				$name = '';	
				if (isset($rows[0]['name'])) $name = $rows[0]['name'];
				$seo = array();
				$this->seoCategory($store, $name, 0, $seo_data, $seo);			
				$seo['cat_desc'] = $this->clearSEO($seo['cat_desc']);
			
				if (!empty($seo['cat_desc'])) {
					$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `description` = '" . $this->db->escape($seo['cat_desc']) . "' WHERE `category_id` = '". $rows1[$i]['category_id'] . "' and `language_id` = '" . $lang . "'");
				}	
			}	
		}
	}
	
	public function FixDesCategoryOne($seo_data, $store, $category_id) {
		$lang = $this->config->get('config_language_id');
		for ($i=0; $i<2000; $i++) {	
			if (!isset($cat[$i])) break;
			$rows = $this->getCategoryName($cat[$i]);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoCategory($store, $name, 0, $seo_data, $seo);			
			$seo['cat_desc'] = $this->clearSEO($seo['cat_desc']);		
	
			if (!empty($seo['cat_desc'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `description` = '" . $this->db->escape($seo['cat_desc']) . "' WHERE `category_id` = '". $cat[$i] . "' and `language_id` = '" . $lang . "'");
			}	
		}
	}
	
	public function FixMetaCategoryNest($seo_data, $store, $papa) {	
		$lang = $this->config->get('config_language_id');
		for ($j=0; $j<2000; $j++) {	
			if (!isset($papa[$j])) break;
			$rows1 = $this->getChildCategory($papa[$j]);
			if (empty($rows1)) continue;
			for ($i=0; $i<=3000; $i++) {	
				if (!isset($rows1[$i]['category_id'])) break;
				$rows = $this->getCategoryName($rows1[$i]['category_id']);
				if (empty($rows)) continue;
				$name = '';	
				if (isset($rows[0]['name'])) $name = $rows[0]['name'];
				$seo = array();
				$this->seoCategory($store, $name, 0, $seo_data, $seo);			
				$seo['cat_meta_desc'] = $this->clearSEO($seo['cat_meta_desc']);
				$seo['cat_title'] = $this->clearSEO($seo['cat_title']);
		
				$seo_keyword = '';
			
				if (!empty($name)) {
					$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `name` = '" . $this->db->escape($name) . "', `meta_description` = '" . $this->db->escape($seo['cat_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['cat_title']) . "' WHERE `category_id` = '". $rows1[$i]['category_id'] . "' and `language_id` = '" . $lang . "'");
				}	
			}	
		}		
	}
	
	public function FixMetaCategoryOne($seo_data, $store, $cat) {
		$lang = $this->config->get('config_language_id');
		for ($i=0; $i<2000; $i++) {	
			if (!isset($cat[$i])) break;
			$rows = $this->getCategoryName($cat[$i]);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoCategory($store, $name, 0, $seo_data, $seo);			
			$seo['cat_meta_desc'] = $this->clearSEO($seo['cat_meta_desc']);
			$seo['cat_title'] = $this->clearSEO($seo['cat_title']);
	
			$seo_keyword = '';
			if (!empty($name)) {
				$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `name` = '" . $this->db->escape($name) . "', `meta_description` = '" . $this->db->escape($seo['cat_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['cat_title']) . "' WHERE `category_id` = '". $cat[$i] . "' and `language_id` = '" . $lang . "'");	
			}	
		}	
	}
	
	public function attributeToTags($product_id) {
		$rows = $this->getAttributes($product_id);
		if (empty($rows)) return;
		$at ='';
		foreach ($rows as $r) {
			$add = $this->symbol($r['text']);
			if (!empty($add)) {
				if (empty($at)) $at = $add;
				else $at = $at.','.$add;
			}	
		}
		if (!empty($at)) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($at) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");
		}
	}	
	
	public function countOptionQuantity($product_id) {
		$rows = $this->getAllGroups($product_id);
		$summa = 0;
		if (!empty($rows)) {
			foreach ($rows as $val) {
				$summa = $summa + $val['quantity'];
			}					
		} else {
			$rows = $this->getProductAllOptionValue($product_id);
			if (!empty($rows)) {			
				for ($j=0; $j<=100; $j++) {
					if (!isset($rows[$j]['price'])) break;
					$summa = $summa + (int)$rows[$j]['quantity'];								
				}
			}	
		}
		if ($summa) {
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET `quantity` = '" . $summa . "' WHERE `product_id` = '" . (int)$product_id . "'");
		}	
	}
	
	public function _setOptionRequired($product_id, $option_name) {
		if (empty($option_name)) return;
		$rows = $this->getOptionID($option_name);
		if (empty($rows)) return;
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option SET `required` = '" . 0 . "' WHERE `product_id` = '" . (int)$product_id . "' and `option_id` = '" . (int)$rows[0]['option_id'] . "'");		
	}

	public function setOptionRequired($product_id, $option_name) {
		if (empty($option_name)) return;
		$rows = $this->getOptionID($option_name);
		if (empty($rows)) return;
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product_option SET `required` = '" . 1 . "' WHERE `product_id` = '" . (int)$product_id . "' and `option_id` = '" . (int)$rows[0]['option_id'] . "'");		
	}	
	
	public function countOptionPrices($product_id) {
		$rows = $this->getProductAllOptionValue($product_id);
		if (!empty($rows)) return;
		$min = 999999999999;
		for ($j=0; $j<=100; $j++) {			
			if (!isset($rows[$j]['price'])) break;
			if ($rows[$j]['price'] and $rows[$j]['price'] < $min and $rows[$j]['price_prefix'] == '=') $min = $rows[$j]['price'];
		}
		if ($min == 999999999999) return;
		for ($j=0; $j<=100; $j++) {				
			$popt = 0;	
			if (!isset($rows[$j]['price'])) break;			
			if ($rows[$j]['price'] and $rows[$j]['price_prefix'] == '=' and $rows[$j]['quantity']) {
				$popt = (float)$rows[$j]['price'] - (float)$min;							
				$prefix = '+';
				if ($popt<0) $prefix = '-';							
				$popt = abs($popt);
				$popt = round($popt,2);	
				$this->upOptionPlus($rows[$j]['product_option_value_id'], $popt, $prefix);
			}	
		}
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `price` = '" . $min . "' WHERE `product_id` = '" . $product_id ."'");	
	}	
	
	public function deleteProductOption($product_id) {		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . $product_id . "'");
	}
	
	public function ResetQuantityOption($product_id) {
		$rows = $this->isProductOption($product_id);
		if (empty($rows)) return;
		for ($i=0; $i<100; $i++) {
			if (!isset($rows[$i]['quantity'])) break;
			$rows[$i]['quantity'] = 0;
			$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = '" . $rows[$i]['quantity'] . "' WHERE product_option_value_id = '" . $rows[$i]['product_option_value_id']. "'");
		}
	}
	
	public function MultOption($product_id, $mult) {
		if (empty($mult) or !preg_match('/^[0-9.,]+$/', $mult)) return;
		$mult = str_replace(',', '.', $mult);
		$rows = $this->isProductOption($product_id);
		if (empty($rows)) return;
		for ($i=0; $i<100; $i++) {
			if (!isset($rows[$i]['price'])) break;
			$rows[$i]['price'] = $rows[$i]['price']*$mult;
			$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET price = '" . $rows[$i]['price'] . "' WHERE product_option_value_id = '" . $rows[$i]['product_option_value_id']. "'");
		}	
	}
	
	public function Design($product_id, $num, $store) {
		if (!$num) return;
		$rows = $this->getLayout($product_id, $store);
		if (empty($rows)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET layout_id = '" . $num . "', product_id  = '" . $product_id. "', store_id = '" . $store . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "product_to_layout SET layout_id = '" . $num . "' WHERE product_id = '" . $product_id. "' AND store_id = '" . $store . "'");
			
		}
	}
	
	public function offNoPhoto($row) {		
		$path = "../image/" . $row['image'];	
		if (!empty($row['image']) and file_exists($path)) return;
		$row['status'] = 0;
		$this->upProduct($row);
	}
	
	public function deletePhotoIfProductGone($row) {
		if ($row['status']) return;
		$product_id = $row['product_id'];
		$path = "../image/" . $row['image'];	
		if (file_exists($path)) @unlink ($path);
		$path = "../image/cache/" . $row['image'];
		$pos = strrpos($path, "/");		
		$path = substr($path, 0, $pos+1);

		if (is_dir($path)) {
			if ($dh = opendir($path)) {
				while (($file = readdir($dh)) !== false) {
					$path_del = $path . $file;
					if (file_exists($path_del) and substr_count($path_del, ".jpg"))	@unlink ($path);				
				}
				closedir($dh);
			}
		}
		$rows = $this->getProductImage($product_id);
		if (!empty ($rows)) {	
			foreach ($rows as $p) {
				$path = "../image/" . $p['image'];				
				if (file_exists($path)) @unlink ($path);
			}
		}		
	}
	
	public function deleteProductWithPhoto($row) {
		$product_id = $row['product_id'];
		$path = "../image/" . $row['image'];	
		if (file_exists($path)) @unlink ($path);
	/* $path = "../image/cache/" . $row['image']; // clear Cache
		$pos = strrpos($path, "/");		
		$path = substr($path, 0, $pos+1);

		if (is_dir($path)) {
			if ($dh = opendir($path)) {
				while (($file = readdir($dh)) !== false) {
					$path_del = $path . $file;
					if (file_exists($path_del) and substr_count($path_del, ".jpg"))	@unlink ($path);				
				}
				closedir($dh);
			}
		} */
		$rows = $this->getProductImage($product_id);
		if (!empty ($rows)) {	
			foreach ($rows as $p) {
				$path = "../image/" . $p['image'];				
				if (file_exists($path)) @unlink ($path);
			}
		}
		$this->deleteProduct($product_id);
	}
	
	public function onlyMain($store, $row) {
		$product_id = $row['product_id'];
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$child = 0;
			for ($j=0; $j<10; $j++) {					
				if (!isset($rows[$j]['category_id'])) continue;
				else if ((int)$rows[$j]['category_id'] > $child) $child = $rows[$j]['category_id'];				
			}
			$rows = $this->getCategoryStore($child, $store);
			if (!empty($rows)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");
		
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" . $product_id . "', `category_id` = '" . $child . "', `main_category` = 1");

				$this->cache->delete('product');
			}
		}
	}
	
	public function MainAndParents($store, $row) {
		$product_id = $row['product_id'];
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$child = 0;
			for ($j=0; $j<10; $j++) {					
				if (!isset($rows[$j]['category_id'])) continue;
				else if ((int)$rows[$j]['category_id'] > $child) $child = $rows[$j]['category_id'];				
			}
			$rows = $this->getCategoryStore($child, $store);
			if (!empty($rows)) {
				while (1) {
					$rows  = $this->getCategory($child);
					if (empty($rows))  break;
					$parent_id = $rows[0]['parent_id'];
					if ($parent_id) {
						$rows  = $this->isCategoryOfProduct($product_id, $parent_id);
						if (empty($rows)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" . $product_id. "', `category_id` = '" . $parent_id . "', `main_category` = 0");
						}								
					}
					$child = $parent_id ;	
				}
			}
		}
		$this->cache->delete('product');
	}
	
	public function FixURLCategory($seo_data, $store) {		
		$row = $this->getMaxCategoryID();
		$max = $row['max(category_id)'];
		for ($i=1; $i<=$max; $i++) {			
			$rows = $this->getCategoryName($i);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			
			$seo_url = $this->TransLit($name);
			$seo_url = $this->MetaURL($seo_url);
			$seo_url = strtolower($seo_url);
			
			$row = $this->getURLcategory($i);
			if (empty($row)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . $i . "', keyword = '" . $this->db->escape($seo_url) . "'");
			} else {		
				$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo_url) . "' WHERE `query` = 'category_id=" . $i . "'");				
			}
		}	
	}
	
	public function copyToParent($store, $row) {
		$product_id = $row['product_id'];
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$child = 0;
			for ($j=0; $j<10; $j++) {					
				if (!isset($rows[$j]['category_id'])) continue;
				else if ((int)$rows[$j]['category_id'] > $child) $child = $rows[$j]['category_id'];				
			}
			$rows = $this->getCategoryStore($child, $store);
			if (!empty($rows)) {
				$parent = $rows[0]['parent_id'];
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" . $product_id . "', `category_id` = '" . $child . "', `main_category` = 1");

				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET `product_id` = '" . $product_id . "', `category_id` = '" . $parent . "', `main_category` = 0");
			}	
		}
		$this->cache->delete('product');
	}
	
	public function FillDescManufacturer($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxManufacturerID();
		$max = $row['max(manufacturer_id)'];
		for ($i=1; $i<=$max; $i++) {					
			$rows = $this->getManufacturerStore($i, $store);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$rows = $this->getManufacturerDesc($i, $lang);
			if (empty($rows)) continue;	
			$desc = $rows[0]['description'];
			$seo = array();
			$this->seoManufacturer($store, $name, $seo_data, $seo);
			$seo['manuf_desc'] = $this->clearSEO($seo['manuf_desc']);
			
			if (!empty($seo['manuf_desc']) and empty($desc)) {
				$this->db->query("UPDATE " . DB_PREFIX . "manufacturer_description SET `description` = '" . $this->db->escape($seo['manuf_desc']) . "' WHERE `manufacturer_id` = '". $i . "' and `language_id` = '" . $lang . "'");
			}
		}	
	}
	
	public function FixDescManufacturer($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxManufacturerID();
		$max = $row['max(manufacturer_id)'];
		for ($i=1; $i<=$max; $i++) {					
			$rows = $this->getManufacturerStore($i, $store);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoManufacturer($store, $name, $seo_data, $seo);
			$seo['manuf_desc'] = $this->clearSEO($seo['manuf_desc']);
			
			if (!empty($seo['manuf_desc'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "manufacturer_description SET `description` = '" . $this->db->escape($seo['manuf_desc']) . "' WHERE `manufacturer_id` = '". $i . "' and `language_id` = '" . $lang . "'");
			}
		}	
	}
	
	public function FillDescCategory($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxCategoryID();
		$max = $row['max(category_id)'];
		for ($i=1; $i<=$max; $i++) {			
			$rows = $this->getCategoryName($i);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$desc = $rows[0]['description'];
			$seo = array();
			$this->seoCategory($store, $name, 0, $seo_data, $seo);
			$seo['cat_desc'] = $this->clearSEO($seo['cat_desc']);
			
			if (!empty($seo['cat_desc']) and empty($desc)) {
				$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `description` = '" . $this->db->escape($seo['cat_desc']) . "' WHERE `category_id` = '". $i . "' and `language_id` = '" . $lang . "'");
			}
		}	
	}	
	
	public function FixDescCategory($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxCategoryID();
		$max = $row['max(category_id)'];
		for ($i=1; $i<=$max; $i++) {			
			$rows = $this->getCategoryName($i);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoCategory($store, $name, 0, $seo_data, $seo);
			$seo['cat_desc'] = $this->clearSEO($seo['cat_desc']);
			
			if (!empty($seo['cat_desc'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `description` = '" . $this->db->escape($seo['cat_desc']) . "' WHERE `category_id` = '". $i . "' and `language_id` = '" . $lang . "'");
			}
		}	
	}	
	
	public function FixMetaCategory($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxCategoryID();
		$max = $row['max(category_id)'];
		for ($i=1; $i<=$max; $i++) {			
			$rows = $this->getCategoryName($i);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoCategory($store, $name, 0, $seo_data, $seo);			
			$seo['cat_meta_desc'] = $this->clearSEO($seo['cat_meta_desc']);
			$seo['cat_title'] = $this->clearSEO($seo['cat_title']);
		
			$seo_keyword = '';
			
			if (!empty($name)) {
				$this->db->query("UPDATE " . DB_PREFIX . "category_description SET `name` = '" . $this->db->escape($name) . "', `meta_description` = '" . $this->db->escape($seo['cat_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['cat_title']) . "' WHERE `category_id` = '". $i . "' and `language_id` = '" . $lang . "'");					
			}	
		}		
	}
	
	public function FixURLManufacturer($seo_data, $store) {
		$row = $this->getMaxManufacturerID();
		$max = $row['max(manufacturer_id)'];
		for ($i=1; $i<=$max; $i++) {					
			$rows = $this->getManufacturerStore($i, $store);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			
			$seo_url = $this->TransLit($name);
			$seo_url = $this->MetaURL($seo_url);
			$seo_url = strtolower($seo_url);
			
			$row = $this->getURLmanufacturer($i);
			if (empty($row)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'manufacturer_id=" . $i . "', keyword = '" . $this->db->escape($seo_url) . "'");
			} else {		
				$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo_url) . "' WHERE `query` = 'manufacturer_id=" . $i . "'");
			}
		}	
	}
	
	public function FixMetaManufacturer($seo_data, $store) {
		$lang = $this->config->get('config_language_id');
		$row = $this->getMaxManufacturerID();
		$max = $row['max(manufacturer_id)'];
		for ($i=1; $i<=$max; $i++) {					
			$rows = $this->getManufacturerStore($i, $store);
			if (empty($rows)) continue;
			$name = '';
			if (isset($rows[0]['name'])) $name = $rows[0]['name'];
			$seo = array();
			$this->seoManufacturer($store, $name, $seo_data, $seo);
			$seo['manuf_title'] = $this->clearSEO($seo['manuf_title']);
			$seo['manuf_meta_desc'] = $this->clearSEO($seo['manuf_meta_desc']);
			
			$seo_keyword = '';			

			$this->db->query("UPDATE " . DB_PREFIX . "manufacturer_description SET `meta_description` = '" . $this->db->escape($seo['manuf_meta_desc']) . "', `meta_keyword` = '" . $this->db->escape($seo_keyword) . "', `seo_h1` = '" . $this->db->escape($name) . "', `seo_title` = '" . $this->db->escape($seo['manuf_title']) . "' WHERE `manufacturer_id` = '". $i . "' and `language_id` = '" . $lang . "'");			
		}
	}
	
	public function percentWhole($row, $per, $gr) {
		$pr = $row['price'];
		$pr = $pr - $pr*$per/100;
		$pr = round($pr, 0);
		$date_start = "2000-01-01";
		$date_end = "2040-01-01";
		$row1 = $this->getCustomerGroup($gr);
		if (empty($row1)) return;
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE `product_id` = '" . $row['product_id'] . "' and `customer_group_id` = '" . $gr . "'");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET `product_id` ='" .$row['product_id']."', `customer_group_id` = '" . $gr . "', `quantity` = '" . 1 . "', `priority` = '" . 1 . "', `price` = '" . $pr . "', `date_start` = '" . $date_start . "', `date_end` = '" . $date_end . "'");
	}
	
	public function percentAction($row, $per, $gr) {		
		$pr = $row['price'];
		$pr = $pr - $pr*$per/100;
		$pr = round($pr, 0);
		$date_start = "2000-01-01";
		$date_end = "2040-01-01";
		$row1 = $this->getCustomerGroup($gr);
		if (empty($row1)) return;
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE `product_id` = '" . $row['product_id'] . "' and `customer_group_id` = '" . $gr . "'");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET `product_id` ='" .$row['product_id']."', `customer_group_id` = '" . $gr . "', `priority` = '" . 1 . "', `price` = '" . $pr . "', `date_start` = '" . $date_start . "', `date_end` = '" . $date_end . "'");
	}
	
	public function tax($product_id, $class) {
		if ($class == '') return;
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `tax_class_id` = '" . (int)$class . "' WHERE `product_id` = '" . $product_id . "'");
	}
	
	public function weight($product_id, $weight) {
		if ($weight == '') return;
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `weight` = '" . (int)$weight . "' WHERE `product_id` = '" . $product_id . "'");
	}
	
	public function fillDescProduct($store, $row, $seo_data) {
		$lang = $this->config->get('config_language_id');
		$product_id = $row['product_id'];		
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;		
		$desc = $rows[0]['description'];		
		$seo = array();
		$this->seoProduct($store, $product_id, $seo_data, $seo);
		$seo['prod_desc'] = $this->clearSEO($seo['prod_desc']);
		
		if (!empty($seo['prod_desc']) and empty($desc)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($seo['prod_desc']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}	
	}
	
	public function fixDescProduct($store, $row, $seo_data) {
		$lang = $this->config->get('config_language_id');
		$product_id = $row['product_id'];		
		$seo = array();
		$this->seoProduct($store, $product_id, $seo_data, $seo);
		$seo['prod_desc'] = $this->clearSEO($seo['prod_desc']);
		
		if (!empty($seo['prod_desc'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($seo['prod_desc']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}	
	}
	
	public function fillMetaProduct($store, $row, $seo_data) {
		$lang = $this->config->get('config_language_id');
		$product_id = $row['product_id'];		
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		$name = $rows[0]['name'];
		$h1 = $rows[0]['seo_h1'];
		$meta_desc = $rows[0]['meta_description'];
		$title = $rows[0]['seo_title'];
		$keyword = $rows[0]['meta_keyword'];
		$seo = array();
		$this->seoProduct($store, $product_id, $seo_data, $seo);
		if (empty($seo['prod_h1'])) $seo['prod_h1'] = $name;
		$seo['prod_h1'] = $this->clearSEO($seo['prod_h1']);
		$seo['prod_title'] = $this->clearSEO($seo['prod_title']);
		$seo['prod_meta_desc'] = $this->clearSEO($seo['prod_meta_desc']);
		$seo['prod_keyword'] = $this->clearSEO($seo['prod_keyword']);
				
		if (!empty($seo['prod_h1']) and empty($h1)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($seo['prod_h1']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");
		}
		
		if (!empty($seo['prod_title']) and empty($title)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($seo['prod_title']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}
		
		if (!empty($seo['prod_meta_desc']) and empty($meta_desc)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($seo['prod_meta_desc']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}

		if (!empty($seo['prod_keyword']) and empty($keyword)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($seo['prod_keyword']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");
		}
	}
	
	public function fillURL($row) {
		$row1 = $this->getURL($row['product_id']);
		if (!isset($row1['keyword']) or empty($row1['keyword'])) $this->FixProductURL($row);		
	}
	
	public function copyModel($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `sku` = '" . $this->db->escape($row['model']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}	
	
	public function copySku_Loc($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `location` = '" . $this->db->escape($row['sku']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyLoc_Sku($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `sku` = '" . $this->db->escape($row['location']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyModel_Loc($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `location` = '" . $this->db->escape($row['model']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyUpc_Loc($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `location` = '" . $this->db->escape($row['upc']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyLoc_Upc($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `upc` = '" . $this->db->escape($row['location']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyMpn_Loc($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `location` = '" . $this->db->escape($row['mpn']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyLoc_Mpn($row) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `mpn` = '" . $this->db->escape($row['location']) . "' WHERE `product_id` = '" . $row['product_id']. "'");
	}
	
	public function copyAttr_UPC($product_id, $attr) {
		if (empty($attr)) return;
		$lang = $this->config->get('config_language_id');
		$rows = $this->getAttributeID($attr);
		if (!empty($rows)) {
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (empty($rows)) return;	
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `upc` = '" . $this->db->escape($rows[0]['text']). "' WHERE `product_id` = '" . $product_id . "'");
		}	
	}
	
	public function copyAttr_MPN($product_id, $attr) {
		if (empty($attr)) return;
		$lang = $this->config->get('config_language_id');
		$rows = $this->getAttributeID($attr);
		if (!empty($rows)) {
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (empty($rows)) return;	
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `mpn` = '" . $this->db->escape($rows[0]['text']). "' WHERE `product_id` = '" . $product_id . "'");
		}	
	}
	
	public function copyAttr_JAN($product_id, $attr) {
		if (empty($attr)) return;
		$lang = $this->config->get('config_language_id');
		$rows = $this->getAttributeID($attr);
		if (!empty($rows)) {
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (empty($rows)) return;	
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `jan` = '" . $this->db->escape($rows[0]['text']). "' WHERE `product_id` = '" . $product_id . "'");
		}	
	}
	
	public function copyAttr_SKU($product_id, $attr) {
		if (empty($attr)) return;
		$lang = $this->config->get('config_language_id');
		$rows = $this->getAttributeID($attr);
		if (!empty($rows)) {
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (empty($rows)) return;	
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `sku` = '" . $this->db->escape($rows[0]['text']). "' WHERE `product_id` = '" . $product_id . "'");
		}	
	}
	
	public function getValue($product_id, $n, $lang) {		
		$name = substr($n, 1, strlen($n)-2);
		if (empty($name)) return '';
		if (substr_count($name, '{')) $name = substr($name, 1, strlen($name)-2);
		if (empty($name)) return '';
		$rows = $this->getAttributeID($name);
		if (!empty($rows)) {
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (!empty($rows)) return $rows[0]['text'];
		}
		$rows = $this->getOptionID($name);		
		if (!empty($rows)) {
			$option_id = $rows[0]['option_id'];	
			$rows = $this->getProdOptions($product_id, $rows[0]['option_id']);	
			if (!empty($rows)) {
				$v = '';
				$i = 0;
				foreach ($rows as $r) {	
					$i++;
					$option_value_id = $r['option_value_id'];		
					$rows = $this->getOptionsOfProduct($option_id, $option_value_id, $lang);
					if (!empty($rows)) {
						if ($i == 1) $v = $rows[0]['name'];
						else $v = $v . ', ' . $rows[0]['name'];		
					}	
				}	
				return $v;
			}
		}		
	}
	
	public function seoManufacturer($store, $manufacturer, $seo_data, &$seo) {
		if (empty($manufacturer)) return;		
		$manufacturer = str_replace('&quot;', '', $manufacturer);
		$seo['manuf_title'] = $seo_data['manuf_title'];
		$seo['manuf_meta_desc'] = $seo_data['manuf_meta_desc'];
		$seo['manuf_desc'] = $seo_data['manuf_desc'];		
		
		for ($i=0; $i<3; $i++) {			
			$seo['manuf_title'] = str_replace('[m]', $manufacturer, $seo['manuf_title']);
			$seo['manuf_meta_desc'] = str_replace('[m]', $manufacturer, $seo['manuf_meta_desc']);
			$seo['manuf_desc'] = str_replace('[m]', $manufacturer, $seo['manuf_desc']);
		}	
		
		$t1 = ''; $t2 = ''; $t3 = ''; $t4 = ''; $t5 = ''; $t6 = '';	$t7 = ''; $t8 = ''; $t9 = ''; $t10 = '';
		$t11 = ''; $t12 = ''; $t13 = ''; $t14 = ''; $t15 = ''; $t16 = ''; $t17 = ''; $t18 = ''; $t19 = ''; $t20 = '';
		$mm = explode("|", $seo_data['seo_1']);	
		if (!empty($mm)) $t1 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_2']);
		if (!empty($mm)) $t2 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_3']);
		if (!empty($mm)) $t3 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_4']);
		if (!empty($mm)) $t4 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_5']);
		if (!empty($mm)) $t5 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_6']);
		if (!empty($mm)) $t6 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_7']);
		if (!empty($mm)) $t7 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_8']);
		if (!empty($mm)) $t8 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_9']);
		if (!empty($mm)) $t9 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_10']);
		if (!empty($mm)) $t10 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_11']);
		if (!empty($mm)) $t11 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_12']);
		if (!empty($mm)) $t12 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_13']);
		if (!empty($mm)) $t13 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_14']);
		if (!empty($mm)) $t14 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_15']);
		if (!empty($mm)) $t15 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_16']);
		if (!empty($mm)) $t16 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_17']);
		if (!empty($mm)) $t17 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_18']);
		if (!empty($mm)) $t18 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_19']);
		if (!empty($mm)) $t19 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_20']);
		if (!empty($mm)) $t20 = $mm[rand(0, count($mm)-1)];
		
		for ($i=0; $i<3; $i++) {	
			if (!empty($t1)) {
				$t1 = str_replace('[m]', $manufacturer, $t1);				
				$seo['manuf_title'] = str_replace('[1]', $t1, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[1]', $t1, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[1]', $t1, $seo['manuf_desc']);
			}	
			if (!empty($t2)) {
				$t2 = str_replace('[m]', $manufacturer, $t2);
				$seo['manuf_title'] = str_replace('[2]', $t2, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[2]', $t2, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[2]', $t2, $seo['manuf_desc']);
			}
			if (!empty($t3)) {
				$t3 = str_replace('[m]', $manufacturer, $t3);
				$seo['manuf_title'] = str_replace('[3]', $t3, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[3]', $t3, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[3]', $t3, $seo['manuf_desc']);
			}
			if (!empty($t4)) {
				$t4 = str_replace('[m]', $manufacturer, $t4);
				$seo['manuf_title'] = str_replace('[4]', $t4, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[4]', $t4, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[4]', $t4, $seo['manuf_desc']);
			}
			if (!empty($t5)) {	
				$t5 = str_replace('[m]', $manufacturer, $t5);
				$seo['manuf_title'] = str_replace('[5]', $t5, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[5]', $t5, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[5]', $t5, $seo['manuf_desc']);
			}
			if (!empty($t6)) {
				$t6 = str_replace('[m]', $manufacturer, $t6);
				$seo['manuf_title'] = str_replace('[6]', $t6, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[6]', $t6, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[6]', $t6, $seo['manuf_desc']);
			}
			if (!empty($t7)) {
				$t7 = str_replace('[m]', $manufacturer, $t7);
				$seo['manuf_title'] = str_replace('[7]', $t7, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[7]', $t7, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[7]', $t7, $seo['manuf_desc']);
			}
			if (!empty($t8)) {
				$t8 = str_replace('[m]', $manufacturer, $t8);
				$seo['manuf_title'] = str_replace('[8]', $t8, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[8]', $t8, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[8]', $t8, $seo['manuf_desc']);
			}
			if (!empty($t9)) {
				$t9 = str_replace('[m]', $manufacturer, $t9);
				$seo['manuf_title'] = str_replace('[9]', $t9, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[9]', $t9, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[9]', $t9, $seo['manuf_desc']);
			}
			if (!empty($t10)) {
				$t10 = str_replace('[m]', $manufacturer, $t10);
				$seo['manuf_title'] = str_replace('[10]', $t10, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[10]', $t10, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[10]', $t10, $seo['manuf_desc']);
			}
			if (!empty($t11)) {
				$t11 = str_replace('[m]', $manufacturer, $t11);
				$seo['manuf_title'] = str_replace('[11]', $t11, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[11]', $t11, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[11]', $t11, $seo['manuf_desc']);
			}
			if (!empty($t12)) {
				$t12 = str_replace('[m]', $manufacturer, $t12);
				$seo['manuf_title'] = str_replace('[12]', $t12, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[12]', $t12, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[12]', $t12, $seo['manuf_desc']);
			}
			if (!empty($t13)) {	
				$t13 = str_replace('[m]', $manufacturer, $t13);
				$seo['manuf_title'] = str_replace('[13]', $t13, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[13]', $t13, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[13]', $t13, $seo['manuf_desc']);
			}
			if (!empty($t14)) {
				$t14 = str_replace('[m]', $manufacturer, $t14);
				$seo['manuf_title'] = str_replace('[14]', $t14, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[14]', $t14, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[14]', $t14, $seo['manuf_desc']);
			}
			if (!empty($t15)) {
				$t15 = str_replace('[m]', $manufacturer, $t15);
				$seo['manuf_title'] = str_replace('[15]', $t15, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[15]', $t15, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[15]', $t15, $seo['manuf_desc']);
			}
			if (!empty($t16)) {
				$t16 = str_replace('[m]', $manufacturer, $t16);
				$seo['manuf_title'] = str_replace('[16]', $t16, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[16]', $t16, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[16]', $t16, $seo['manuf_desc']);
			}
			if (!empty($t17)) {	
				$t17 = str_replace('[m]', $manufacturer, $t17);
				$seo['manuf_title'] = str_replace('[17]', $t17, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[17]', $t17, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[17]', $t17, $seo['manuf_desc']);
			}
			if (!empty($t18)) {	
				$t18 = str_replace('[m]', $manufacturer, $t18);
				$seo['manuf_title'] = str_replace('[18]', $t18, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[18]', $t18, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[18]', $t18, $seo['manuf_desc']);
			}
			if (!empty($t19)) {
				$t19 = str_replace('[m]', $manufacturer, $t19);
				$seo['manuf_title'] = str_replace('[19]', $t19, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[19]', $t19, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[19]', $t19, $seo['manuf_desc']);
			}
			if (!empty($t20)) {
				$t20 = str_replace('[m]', $manufacturer, $t20);
				$seo['manuf_title'] = str_replace('[20]', $t20, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[20]', $t20, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[20]', $t20, $seo['manuf_desc']);
			}
		}
		$br = 1;
		for ($i=0; $i<200; $i++) {
			if (!$br) break;
			$br = 0;
			$pb = strpos($seo['manuf_title'], "[");	
			$pe = strpos($seo['manuf_title'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_title'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_title'] = str_replace($n, $text, $seo['manuf_title']);			
				}
			}	
			$pb = strpos($seo['manuf_meta_desc'], "[");	
			$pe = strpos($seo['manuf_meta_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_meta_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_meta_desc'] = str_replace($n, $text, $seo['manuf_meta_desc']);			
				}
			}	
			$pb = strpos($seo['manuf_desc'], "[");	
			$pe = strpos($seo['manuf_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_desc'] = str_replace($n, $text, $seo['manuf_desc']);			
				}
			}	
		}	
	}
	
	public function seoCategory($store, $category_name, $parent_id, $seo_data, &$seo) {
		if (empty($category_name)) return;		
		$pcategory = '';
		$seo['cat_title'] = $seo_data['cat_title'];
		$seo['cat_meta_desc'] = $seo_data['cat_meta_desc'];
		$seo['cat_desc'] = $seo_data['cat_desc'];
		if (empty($parent_id)) {
			$rows = $this->getCategoryIDbyName($category_name, $store);
			if (!empty($rows)) $category_id = $rows[0]['category_id'];
				
			$rows = $this->getCategoryStore($category_id, $store);
			if (!empty($rows)) $parent_id = $rows[0]['parent_id'];		
		}
		$rows = $this->getCategoryName($parent_id);
		if (!empty($rows)) $pcategory = $rows[0]['name'];
		
		$category = $category_name;	
		for ($i=0; $i<3; $i++) {			
			$seo['cat_title'] = str_replace('[c]', $category, $seo['cat_title']);			
			$seo['cat_meta_desc'] = str_replace('[c]', $category, $seo['cat_meta_desc']);
			$seo['cat_desc'] = str_replace('[c]', $category, $seo['cat_desc']);
			
			$seo['cat_title'] = str_replace('[pc]', $pcategory, $seo['cat_title']);			
			$seo['cat_meta_desc'] = str_replace('[pc]', $pcategory, $seo['cat_meta_desc']);
			$seo['cat_desc'] = str_replace('[pc]', $pcategory, $seo['cat_desc']);			
		}
		
		$t1 = ''; $t2 = ''; $t3 = ''; $t4 = ''; $t5 = ''; $t6 = '';	$t7 = ''; $t8 = ''; $t9 = ''; $t10 = '';
		$t11 = ''; $t12 = ''; $t13 = ''; $t14 = ''; $t15 = ''; $t16 = ''; $t17 = ''; $t18 = ''; $t19 = ''; $t20 = '';
		$mm = explode("|", $seo_data['seo_1']);	
		if (!empty($mm)) $t1 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_2']);
		if (!empty($mm)) $t2 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_3']);
		if (!empty($mm)) $t3 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_4']);
		if (!empty($mm)) $t4 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_5']);
		if (!empty($mm)) $t5 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_6']);
		if (!empty($mm)) $t6 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_7']);
		if (!empty($mm)) $t7 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_8']);
		if (!empty($mm)) $t8 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_9']);
		if (!empty($mm)) $t9 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_10']);
		if (!empty($mm)) $t10 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_11']);
		if (!empty($mm)) $t11 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_12']);
		if (!empty($mm)) $t12 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_13']);
		if (!empty($mm)) $t13 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_14']);
		if (!empty($mm)) $t14 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_15']);
		if (!empty($mm)) $t15 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_16']);
		if (!empty($mm)) $t16 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_17']);
		if (!empty($mm)) $t17 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_18']);
		if (!empty($mm)) $t18 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_19']);
		if (!empty($mm)) $t19 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_20']);
		if (!empty($mm)) $t20 = $mm[rand(0, count($mm)-1)];
		
		for ($i=0; $i<3; $i++) {	
			if (!empty($t1)) {
				$t1 = str_replace('[c]', $category, $t1);
				$t1 = str_replace('[pc]', $pcategory, $t1);	
				$seo['cat_title'] = str_replace('[1]', $t1, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[1]', $t1, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[1]', $t1, $seo['cat_desc']);				
			}	
			if (!empty($t2)) {				
				$t2 = str_replace('[c]', $category, $t2);
				$t2 = str_replace('[pc]', $pcategory, $t2);				
				$seo['cat_title'] = str_replace('[2]', $t2, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[2]', $t2, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[2]', $t2, $seo['cat_desc']);				
			}
			if (!empty($t3)) {
				$t3 = str_replace('[c]', $category, $t3);
				$t3 = str_replace('[pc]', $pcategory, $t3);	
				$seo['cat_title'] = str_replace('[3]', $t3, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[3]', $t3, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[3]', $t3, $seo['cat_desc']);				
			}
			if (!empty($t4)) {
				$t4 = str_replace('[c]', $category, $t4);
				$t4 = str_replace('[pc]', $pcategory, $t4);	
				$seo['cat_title'] = str_replace('[4]', $t4, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[4]', $t4, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[4]', $t4, $seo['cat_desc']);				
			}
			if (!empty($t5)) {
				$t5 = str_replace('[c]', $category, $t5);
				$t5 = str_replace('[pc]', $pcategory, $t5);	
				$seo['cat_title'] = str_replace('[5]', $t5, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[5]', $t5, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[5]', $t5, $seo['cat_desc']);				
			}
			if (!empty($t6)) {
				$t6 = str_replace('[c]', $category, $t6);
				$t6 = str_replace('[pc]', $pcategory, $t6);	
				$seo['cat_title'] = str_replace('[6]', $t6, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[6]', $t6, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[6]', $t6, $seo['cat_desc']);				
			}
			if (!empty($t7)) {
				$t7 = str_replace('[c]', $category, $t7);
				$t7 = str_replace('[pc]', $pcategory, $t7);	
				$seo['cat_title'] = str_replace('[7]', $t7, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[7]', $t7, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[7]', $t7, $seo['cat_desc']);				
			}
			if (!empty($t8)) {
				$t8 = str_replace('[c]', $category, $t8);
				$t8 = str_replace('[pc]', $pcategory, $t8);	
				$seo['cat_title'] = str_replace('[8]', $t8, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[8]', $t8, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[8]', $t8, $seo['cat_desc']);				
			}
			if (!empty($t9)) {
				$t9 = str_replace('[c]', $category, $t9);
				$t9 = str_replace('[pc]', $pcategory, $t9);	
				$seo['cat_title'] = str_replace('[9]', $t9, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[9]', $t9, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[9]', $t9, $seo['cat_desc']);				
			}
			if (!empty($t10)) {
				$t10 = str_replace('[c]', $category, $t10);
				$t10 = str_replace('[pc]', $pcategory, $t10);	
				$seo['cat_title'] = str_replace('[10]', $t10, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[10]', $t10, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[10]', $t10, $seo['cat_desc']);				
			}
			if (!empty($t11)) {	
				$t11 = str_replace('[c]', $category, $t11);
				$t11 = str_replace('[pc]', $pcategory, $t11);
				$seo['cat_title'] = str_replace('[11]', $t11, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[11]', $t11, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[11]', $t11, $seo['cat_desc']);				
			}
			if (!empty($t12)) {
				$t12 = str_replace('[c]', $category, $t12);
				$t12 = str_replace('[pc]', $pcategory, $t12);
				$seo['cat_title'] = str_replace('[12]', $t12, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[12]', $t12, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[12]', $t12, $seo['cat_desc']);				
			}
			if (!empty($t13)) {
				$t13 = str_replace('[c]', $category, $t13);
				$t13 = str_replace('[pc]', $pcategory, $t13);
				$seo['cat_title'] = str_replace('[13]', $t13, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[13]', $t13, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[13]', $t13, $seo['cat_desc']);				
			}
			if (!empty($t14)) {
				$t14 = str_replace('[c]', $category, $t14);
				$t14 = str_replace('[pc]', $pcategory, $t14);
				$seo['cat_title'] = str_replace('[14]', $t14, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[14]', $t14, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[14]', $t14, $seo['cat_desc']);				
			}
			if (!empty($t15)) {
				$t15 = str_replace('[c]', $category, $t15);
				$t15 = str_replace('[pc]', $pcategory, $t15);
				$seo['cat_title'] = str_replace('[15]', $t15, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[15]', $t15, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[15]', $t15, $seo['cat_desc']);				
			}
			if (!empty($t16)) {
				$t16 = str_replace('[c]', $category, $t16);
				$t16 = str_replace('[pc]', $pcategory, $t16);
				$seo['cat_title'] = str_replace('[16]', $t16, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[16]', $t16, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[16]', $t16, $seo['cat_desc']);				
			}
			if (!empty($t17)) {
				$t17 = str_replace('[c]', $category, $t17);
				$t17 = str_replace('[pc]', $pcategory, $t17);
				$seo['cat_title'] = str_replace('[17]', $t17, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[17]', $t17, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[17]', $t17, $seo['cat_desc']);				
			}
			if (!empty($t18)) {
				$t18 = str_replace('[c]', $category, $t18);
				$t18 = str_replace('[pc]', $pcategory, $t18);
				$seo['cat_title'] = str_replace('[18]', $t18, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[18]', $t18, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[18]', $t18, $seo['cat_desc']);				
			}
			if (!empty($t19)) {	
				$t19 = str_replace('[c]', $category, $t19);
				$t19 = str_replace('[pc]', $pcategory, $t19);
				$seo['cat_title'] = str_replace('[19]', $t19, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[19]', $t19, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[19]', $t19, $seo['cat_desc']);				
			}
			if (!empty($t20)) {	
				$t20 = str_replace('[c]', $category, $t20);
				$t20 = str_replace('[pc]', $pcategory, $t20);
				$seo['cat_title'] = str_replace('[20]', $t20, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[20]', $t20, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[20]', $t20, $seo['cat_desc']);				
			}
		}
		$br = 1;
		for ($i=0; $i<200; $i++) {
			if (!$br) break;
			$br = 0;
			$pb = strpos($seo['cat_title'], "[");	
			$pe = strpos($seo['cat_title'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_title'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_title'] = str_replace($n, $text, $seo['cat_title']);			
				}
			}	
			$pb = strpos($seo['cat_meta_desc'], "[");	
			$pe = strpos($seo['cat_meta_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_meta_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_meta_desc'] = str_replace($n, $text, $seo['cat_meta_desc']);			
				}
			}	
			$pb = strpos($seo['cat_desc'], "[");	
			$pe = strpos($seo['cat_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_desc'] = str_replace($n, $text, $seo['cat_desc']);			
				}
			}	
		}	
	}
	
	public function namePhoto($store, $data, $seo_photo) {
		$namephoto = '';
		if (empty($data)) return;
		if (empty($seo_photo)) return;
		$lang = $this->config->get('config_language_id');		
		$name = $data['name'];
		$category = $data['category'];		
		$manufacturer = $data['manufacturer'];	
		$model = $data['model'];
		$brand = $data['brand'];
		$sku = $data['sku'];
		
		$sp = explode(',', $seo_photo);
		for ($i=0; $i<10; $i++) {
			if (!isset($sp[$i])) break;
			if (empty($sp[$i]) or !substr_count($sp[$i], '=')) continue;
			$fr = explode('=', $sp[$i]);			
			$pb = strpos($fr[0], "'");
		//	if ($pb === false) continue;
			$pe = strpos($fr[0], "'", $pb+1);
			if (!$pe) continue;
			$fr[0] = substr($fr[0], $pb+1, $pe-$pb-1);
			$pb = strpos($fr[1], "'");
			if ($pb === false) continue;
			$pe = strpos($fr[1], "'", $pb+1);
			if (!$pe) continue;
			$fr[1] = substr($fr[1], $pb+1, $pe-$pb-1);			
			$name = str_replace($fr[0], $fr[1], $name);
		
		}	
		$pb = strpos($seo_photo, ",");
		if ($pb) $seo_photo = substr($seo_photo, 0, $pb);
		$namephoto =  str_replace('/', '-', $seo_photo);
		$namephoto = str_replace('[n]', $name, $namephoto);
		$namephoto = str_replace('[c]', $category, $namephoto);		
		$namephoto = str_replace('[m]', $manufacturer, $namephoto);
		$namephoto = str_replace('[mod]', $model, $namephoto);
		$namephoto = str_replace('[b]', $brand, $namephoto);
		$namephoto = str_replace('[sku]', $sku, $namephoto);
		$r = rand(0, 999999999);
		if (!substr_count($namephoto, '[r]')) $namephoto = $r . '-' . $namephoto;
		else $namephoto = str_replace('[r]', $r, $namephoto);		
		
		$namephoto = $this->clearSEO($namephoto);
		$namephoto = $this->TransLit($namephoto);							
		$namephoto = $this->MetaURL($namephoto);
		$namephoto = strtolower($namephoto);
	
		return $namephoto;		
	}
	
	public function seoProduct($store, $product_id, $seo_data, &$seo) {	
		if (empty($product_id)) return;
		$lang = $this->config->get('config_language_id');
		$name = '';
		$price = '';
		$sprice = '';
		$category = '';
		$pcategory = '';
		$manufacturer = '';
		$description = '';
		$brand = '';
		$sku = '';
		$rows  = $this->getProductsByID($product_id);
		if (!empty($rows)) {
			$price = round($rows[0]['price'], 2);
			$brand = $rows[0]['location'];
			$sku = $rows[0]['sku'];
			$rows = $this->getManufacturerStore($rows[0]['manufacturer_id'], $store);
			if (!empty($rows)) $manufacturer = $rows[0]['name'];
			$manufacturer = str_replace('&quot;', '', $manufacturer);
		}
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$child = 0;
			for ($j=0; $j<10; $j++) {					
				if (!isset($rows[$j]['category_id'])) continue;
				else if ((int)$rows[$j]['category_id'] > $child) {
					$child = $rows[$j]['category_id'];					
				}	
			}
			$parent = 0;
			$rows = $this->getCategoryStore($child, $store);
			if (!empty($rows)) $parent = $rows[0]['parent_id'];
			
			$rows = $this->getCategoryName($child);
			if (!empty($rows)) $category = $rows[0]['name'];
			$rows = $this->getCategoryName($parent);
			if (!empty($rows)) $pcategory = $rows[0]['name'];
		}
		$customer_group_id = 1;
		$row = $this->getActionPrice($product_id, $customer_group_id);
		if (!empty($row)) $sprice = round($row['price'], 2);
		$rows = $this->getProductDesc($product_id);
		if (!empty($rows)) {
			$name = $rows[0]['name'];
			$name = str_replace('&quot;', '', $name);
			$description = $rows[0]['description'];
		}
		$seo['prod_h1'] = $seo_data['prod_h1'];
		$seo['prod_title'] = $seo_data['prod_title'];
		$seo['prod_meta_desc'] = $seo_data['prod_meta_desc'];
		$seo['prod_desc'] = $seo_data['prod_desc'];
		$seo['cat_title'] = $seo_data['cat_title'];
		$seo['cat_meta_desc'] = $seo_data['cat_meta_desc'];
		$seo['cat_desc'] = $seo_data['cat_desc'];
		$seo['manuf_title'] = $seo_data['manuf_title'];
		$seo['manuf_meta_desc'] = $seo_data['manuf_meta_desc'];
		$seo['manuf_desc'] = $seo_data['manuf_desc'];
		$seo['prod_keyword'] = $seo_data['prod_keyword'];
				
		for ($i=0; $i<3; $i++) {
			$seo['prod_h1'] = str_replace('[n]', $name, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[n]', $name, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[n]', $name, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[n]', $name, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[n]', $name, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[p]', $price, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[p]', $price, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[p]', $price, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[p]', $price, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[p]', $price, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[sp]', $sprice, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[sp]', $sprice, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[sp]', $sprice, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[sp]', $sprice, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[sp]', $sprice, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[c]', $category, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[c]', $category, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[c]', $category, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[c]', $category, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[c]', $category, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[pc]', $pcategory, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[pc]', $pcategory, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[pc]', $pcategory, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[pc]', $pcategory, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[pc]', $pcategory, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[m]', $manufacturer, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[m]', $manufacturer, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[m]', $manufacturer, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[m]', $manufacturer, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[m]', $manufacturer, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[b]', $brand, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[b]', $brand, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[b]', $brand, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[b]', $brand, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[b]', $brand, $seo['prod_keyword']);
			
			$seo['prod_h1'] = str_replace('[sku]', $sku, $seo['prod_h1']);
			$seo['prod_title'] = str_replace('[sku]', $sku, $seo['prod_title']);
			$seo['prod_meta_desc'] = str_replace('[sku]', $sku, $seo['prod_meta_desc']);
			$seo['prod_desc'] = str_replace('[sku]', $sku, $seo['prod_desc']);
			$seo['prod_keyword'] = str_replace('[sku]', $sku, $seo['prod_keyword']);
			
			if (empty($description))  $seo['prod_desc'] = str_replace('[d]', '', $seo['prod_desc']);
			else {
				$b = 0;
				$a = strpos($description, "&nbsp;&nbsp;&nbsp;");
				if (!($a === false)) $b = strrpos($description, "&nbsp;&nbsp;&nbsp;");	
				if ($b and $a != $b) {
					$b = substr ($description, $a, $b+18);
					$seo['prod_desc'] = str_replace('[d]', $b, $seo['prod_desc']);
				} else 	$seo['prod_desc'] = str_replace('[d]', "&nbsp;&nbsp;&nbsp;".$description."&nbsp;&nbsp;&nbsp;", $seo['prod_desc']);
			}			
		}
		
		$t1 = ''; $t2 = ''; $t3 = ''; $t4 = ''; $t5 = ''; $t6 = '';	$t7 = ''; $t8 = ''; $t9 = ''; $t10 = '';
		$t11 = ''; $t12 = ''; $t13 = ''; $t14 = ''; $t15 = ''; $t16 = ''; $t17 = ''; $t18 = ''; $t19 = ''; $t20 = '';
		$mm = explode("|", $seo_data['seo_1']);	
		if (!empty($mm)) $t1 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_2']);
		if (!empty($mm)) $t2 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_3']);
		if (!empty($mm)) $t3 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_4']);
		if (!empty($mm)) $t4 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_5']);
		if (!empty($mm)) $t5 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_6']);
		if (!empty($mm)) $t6 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_7']);
		if (!empty($mm)) $t7 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_8']);
		if (!empty($mm)) $t8 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_9']);
		if (!empty($mm)) $t9 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_10']);
		if (!empty($mm)) $t10 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_11']);
		if (!empty($mm)) $t11 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_12']);
		if (!empty($mm)) $t12 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_13']);
		if (!empty($mm)) $t13 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_14']);
		if (!empty($mm)) $t14 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_15']);
		if (!empty($mm)) $t15 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_16']);
		if (!empty($mm)) $t16 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_17']);
		if (!empty($mm)) $t17 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_18']);
		if (!empty($mm)) $t18 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_19']);
		if (!empty($mm)) $t19 = $mm[rand(0, count($mm)-1)];
		$mm = explode("|", $seo_data['seo_20']);
		if (!empty($mm)) $t20 = $mm[rand(0, count($mm)-1)];
		
		for ($i=0; $i<3; $i++) {	
			if (!empty($t1)) {
				$t1 = str_replace('[n]', $name, $t1);				
				$t1 = str_replace('[p]', $price, $t1);
				$t1 = str_replace('[sp]', $sprice, $t1);
				$t1 = str_replace('[c]', $category, $t1);
				$t1 = str_replace('[pc]', $pcategory, $t1);
				$t1 = str_replace('[m]', $manufacturer, $t1);
				$t1 = str_replace('[b]', $brand, $t1);
				$t1 = str_replace('[sku]', $sku, $t1);
				$seo['prod_h1'] = str_replace('[1]', $t1, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[1]', $t1, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[1]', $t1, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[1]', $t1, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[1]', $t1, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[1]', $t1, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[1]', $t1, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[1]', $t1, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[1]', $t1, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[1]', $t1, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[1]', $t1, $seo['manuf_desc']);
			}	
			if (!empty($t2)) {
				$t2 = str_replace('[n]', $name, $t2);				
				$t2 = str_replace('[p]', $price, $t2);
				$t2 = str_replace('[sp]', $sprice, $t2);
				$t2 = str_replace('[c]', $category, $t2);
				$t2 = str_replace('[pc]', $pcategory, $t2);
				$t2 = str_replace('[m]', $manufacturer, $t2);
				$t2 = str_replace('[b]', $brand, $t2);
				$t2 = str_replace('[sku]', $sku, $t2);
				$seo['prod_h1'] = str_replace('[2]', $t2, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[2]', $t2, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[2]', $t2, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[2]', $t2, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[2]', $t2, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[2]', $t2, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[2]', $t2, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[2]', $t2, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[2]', $t2, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[2]', $t2, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[2]', $t2, $seo['manuf_desc']);
			}
			if (!empty($t3)) {
				$t3 = str_replace('[n]', $name, $t3);				
				$t3 = str_replace('[p]', $price, $t3);
				$t3 = str_replace('[sp]', $sprice, $t3);
				$t3 = str_replace('[c]', $category, $t3);
				$t3 = str_replace('[pc]', $pcategory, $t3);
				$t3 = str_replace('[m]', $manufacturer, $t3);
				$t3 = str_replace('[b]', $brand, $t3);
				$t3 = str_replace('[sku]', $sku, $t3);
				$seo['prod_h1'] = str_replace('[3]', $t3, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[3]', $t3, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[3]', $t3, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[3]', $t3, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[3]', $t3, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[3]', $t3, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[3]', $t3, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[3]', $t3, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[3]', $t3, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[3]', $t3, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[3]', $t3, $seo['manuf_desc']);
			}
			if (!empty($t4)) {
				$t4 = str_replace('[n]', $name, $t4);				
				$t4 = str_replace('[p]', $price, $t4);
				$t4 = str_replace('[sp]', $sprice, $t4);
				$t4 = str_replace('[c]', $category, $t4);
				$t4 = str_replace('[pc]', $pcategory, $t4);
				$t4 = str_replace('[m]', $manufacturer, $t4);
				$t4 = str_replace('[b]', $brand, $t4);
				$t4 = str_replace('[sku]', $sku, $t4);
				$seo['prod_h1'] = str_replace('[4]', $t4, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[4]', $t4, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[4]', $t4, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[4]', $t4, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[4]', $t4, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[4]', $t4, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[4]', $t4, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[4]', $t4, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[4]', $t4, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[4]', $t4, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[4]', $t4, $seo['manuf_desc']);
			}
			if (!empty($t5)) {
				$t5 = str_replace('[n]', $name, $t5);				
				$t5 = str_replace('[p]', $price, $t5);
				$t5 = str_replace('[sp]', $sprice, $t5);
				$t5 = str_replace('[c]', $category, $t5);
				$t5 = str_replace('[pc]', $pcategory, $t5);
				$t5 = str_replace('[m]', $manufacturer, $t5);
				$t5 = str_replace('[b]', $brand, $t5);
				$t5 = str_replace('[sku]', $sku, $t5);
				$seo['prod_h1'] = str_replace('[5]', $t5, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[5]', $t5, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[5]', $t5, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[5]', $t5, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[5]', $t5, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[5]', $t5, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[5]', $t5, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[5]', $t5, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[5]', $t5, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[5]', $t5, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[5]', $t5, $seo['manuf_desc']);
			}
			if (!empty($t6)) {
				$t6 = str_replace('[n]', $name, $t6);				
				$t6 = str_replace('[p]', $price, $t6);
				$t6 = str_replace('[sp]', $sprice, $t6);
				$t6 = str_replace('[c]', $category, $t6);
				$t6 = str_replace('[pc]', $pcategory, $t6);
				$t6 = str_replace('[m]', $manufacturer, $t6);
				$t6 = str_replace('[b]', $brand, $t6);
				$t6 = str_replace('[sku]', $sku, $t6);
				$seo['prod_h1'] = str_replace('[6]', $t6, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[6]', $t6, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[6]', $t6, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[6]', $t6, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[6]', $t6, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[6]', $t6, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[6]', $t6, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[6]', $t6, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[6]', $t6, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[6]', $t6, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[6]', $t6, $seo['manuf_desc']);
			}
			if (!empty($t7)) {
				$t7 = str_replace('[n]', $name, $t7);				
				$t7 = str_replace('[p]', $price, $t7);
				$t7 = str_replace('[sp]', $sprice, $t7);
				$t7 = str_replace('[c]', $category, $t7);
				$t7 = str_replace('[pc]', $pcategory, $t7);
				$t7 = str_replace('[m]', $manufacturer, $t7);
				$t7 = str_replace('[b]', $brand, $t7);
				$t7 = str_replace('[sku]', $sku, $t7);
				$seo['prod_h1'] = str_replace('[7]', $t7, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[7]', $t7, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[7]', $t7, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[7]', $t7, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[7]', $t7, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[7]', $t7, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[7]', $t7, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[7]', $t7, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[7]', $t7, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[7]', $t7, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[7]', $t7, $seo['manuf_desc']);
			}
			if (!empty($t8)) {
				$t8 = str_replace('[n]', $name, $t8);				
				$t8 = str_replace('[p]', $price, $t8);
				$t8 = str_replace('[sp]', $sprice, $t8);
				$t8 = str_replace('[c]', $category, $t8);
				$t8 = str_replace('[pc]', $pcategory, $t8);
				$t8 = str_replace('[m]', $manufacturer, $t8);
				$t8 = str_replace('[b]', $brand, $t8);
				$t8 = str_replace('[sku]', $sku, $t8);
				$seo['prod_h1'] = str_replace('[8]', $t8, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[8]', $t8, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[8]', $t8, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[8]', $t8, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[8]', $t8, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[8]', $t8, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[8]', $t8, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[8]', $t8, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[8]', $t8, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[8]', $t8, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[8]', $t8, $seo['manuf_desc']);
			}
			if (!empty($t9)) {
				$t9 = str_replace('[n]', $name, $t9);				
				$t9 = str_replace('[p]', $price, $t9);
				$t9 = str_replace('[sp]', $sprice, $t9);
				$t9 = str_replace('[c]', $category, $t9);
				$t9 = str_replace('[pc]', $pcategory, $t9);
				$t9 = str_replace('[m]', $manufacturer, $t9);
				$t9 = str_replace('[b]', $brand, $t9);
				$t9 = str_replace('[sku]', $sku, $t9);
				$seo['prod_h1'] = str_replace('[9]', $t9, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[9]', $t9, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[9]', $t9, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[9]', $t9, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[9]', $t9, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[9]', $t9, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[9]', $t9, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[9]', $t9, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[9]', $t9, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[9]', $t9, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[9]', $t9, $seo['manuf_desc']);
			}
			if (!empty($t10)) {
				$t10 = str_replace('[n]', $name, $t10);				
				$t10 = str_replace('[p]', $price, $t10);
				$t10 = str_replace('[sp]', $sprice, $t10);
				$t10 = str_replace('[c]', $category, $t10);
				$t10 = str_replace('[pc]', $pcategory, $t10);
				$t10 = str_replace('[m]', $manufacturer, $t10);
				$t10 = str_replace('[b]', $brand, $t10);
				$t10 = str_replace('[sku]', $sku, $t10);
				$seo['prod_h1'] = str_replace('[10]', $t10, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[10]', $t10, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[10]', $t10, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[10]', $t10, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[10]', $t10, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[10]', $t10, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[10]', $t10, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[10]', $t10, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[10]', $t10, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[10]', $t10, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[10]', $t10, $seo['manuf_desc']);
			}
			if (!empty($t11)) {
				$t11 = str_replace('[n]', $name, $t11);				
				$t11 = str_replace('[p]', $price, $t11);
				$t11 = str_replace('[sp]', $sprice, $t11);
				$t11 = str_replace('[c]', $category, $t11);
				$t11 = str_replace('[pc]', $pcategory, $t11);
				$t11 = str_replace('[m]', $manufacturer, $t11);
				$t11 = str_replace('[b]', $brand, $t11);
				$t11 = str_replace('[sku]', $sku, $t11);
				$seo['prod_h1'] = str_replace('[11]', $t11, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[11]', $t11, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[11]', $t11, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[11]', $t11, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[11]', $t11, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[11]', $t11, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[11]', $t11, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[11]', $t11, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[11]', $t11, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[11]', $t11, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[11]', $t11, $seo['manuf_desc']);
			}
			if (!empty($t12)) {
				$t12 = str_replace('[n]', $name, $t12);				
				$t12 = str_replace('[p]', $price, $t12);
				$t12 = str_replace('[sp]', $sprice, $t12);
				$t12 = str_replace('[c]', $category, $t12);
				$t12 = str_replace('[pc]', $pcategory, $t12);
				$t12 = str_replace('[m]', $manufacturer, $t12);
				$t12 = str_replace('[b]', $brand, $t12);
				$t12 = str_replace('[sku]', $sku, $t12);
				$seo['prod_h1'] = str_replace('[12]', $t12, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[12]', $t12, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[12]', $t12, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[12]', $t12, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[12]', $t12, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[12]', $t12, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[12]', $t12, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[12]', $t12, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[12]', $t12, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[12]', $t12, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[12]', $t12, $seo['manuf_desc']);
			}
			if (!empty($t13)) {
				$t13 = str_replace('[n]', $name, $t13);				
				$t13 = str_replace('[p]', $price, $t13);
				$t13 = str_replace('[sp]', $sprice, $t13);
				$t13 = str_replace('[c]', $category, $t13);
				$t13 = str_replace('[pc]', $pcategory, $t13);
				$t13 = str_replace('[m]', $manufacturer, $t13);
				$t13 = str_replace('[b]', $brand, $t13);
				$t13 = str_replace('[sku]', $sku, $t13);
				$seo['prod_h1'] = str_replace('[13]', $t13, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[13]', $t13, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[13]', $t13, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[13]', $t13, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[13]', $t13, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[13]', $t13, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[13]', $t13, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[13]', $t13, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[13]', $t13, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[13]', $t13, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[13]', $t13, $seo['manuf_desc']);
			}
			if (!empty($t14)) {
				$t14 = str_replace('[n]', $name, $t14);				
				$t14 = str_replace('[p]', $price, $t14);
				$t14 = str_replace('[sp]', $sprice, $t14);
				$t14 = str_replace('[c]', $category, $t14);
				$t14 = str_replace('[pc]', $pcategory, $t14);
				$t14 = str_replace('[m]', $manufacturer, $t14);
				$t14 = str_replace('[b]', $brand, $t14);
				$t14 = str_replace('[sku]', $sku, $t14);
				$seo['prod_h1'] = str_replace('[14]', $t14, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[14]', $t14, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[14]', $t14, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[14]', $t14, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[14]', $t14, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[14]', $t14, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[14]', $t14, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[14]', $t14, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[14]', $t14, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[14]', $t14, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[14]', $t14, $seo['manuf_desc']);
			}
			if (!empty($t15)) {
				$t15 = str_replace('[n]', $name, $t15);				
				$t15 = str_replace('[p]', $price, $t15);
				$t15 = str_replace('[sp]', $sprice, $t15);
				$t15 = str_replace('[c]', $category, $t15);
				$t15 = str_replace('[pc]', $pcategory, $t15);
				$t15 = str_replace('[m]', $manufacturer, $t15);
				$t15 = str_replace('[b]', $brand, $t15);
				$t15 = str_replace('[sku]', $sku, $t15);
				$seo['prod_h1'] = str_replace('[15]', $t15, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[15]', $t15, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[15]', $t15, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[15]', $t15, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[15]', $t15, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[15]', $t15, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[15]', $t15, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[15]', $t15, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[15]', $t15, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[15]', $t15, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[15]', $t15, $seo['manuf_desc']);
			}
			if (!empty($t16)) {
				$t16 = str_replace('[n]', $name, $t16);				
				$t16 = str_replace('[p]', $price, $t16);
				$t16 = str_replace('[sp]', $sprice, $t16);
				$t16 = str_replace('[c]', $category, $t16);
				$t16 = str_replace('[pc]', $pcategory, $t16);
				$t16 = str_replace('[m]', $manufacturer, $t16);
				$t16 = str_replace('[b]', $brand, $t16);
				$t16 = str_replace('[sku]', $sku, $t16);
				$seo['prod_h1'] = str_replace('[16]', $t16, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[16]', $t16, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[16]', $t16, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[16]', $t16, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[16]', $t16, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[16]', $t16, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[16]', $t16, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[16]', $t16, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[16]', $t16, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[16]', $t16, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[16]', $t16, $seo['manuf_desc']);
			}
			if (!empty($t17)) {
				$t17 = str_replace('[n]', $name, $t17);				
				$t17 = str_replace('[p]', $price, $t17);
				$t17 = str_replace('[sp]', $sprice, $t17);
				$t17 = str_replace('[c]', $category, $t17);
				$t17 = str_replace('[pc]', $pcategory, $t17);
				$t17 = str_replace('[m]', $manufacturer, $t17);
				$t17 = str_replace('[b]', $brand, $t17);
				$t17 = str_replace('[sku]', $sku, $t17);
				$seo['prod_h1'] = str_replace('[17]', $t17, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[17]', $t17, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[17]', $t17, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[17]', $t17, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[17]', $t17, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[17]', $t17, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[17]', $t17, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[17]', $t17, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[17]', $t17, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[17]', $t17, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[17]', $t17, $seo['manuf_desc']);
			}
			if (!empty($t18)) {
				$t18 = str_replace('[n]', $name, $t18);				
				$t18 = str_replace('[p]', $price, $t18);
				$t18 = str_replace('[sp]', $sprice, $t18);
				$t18 = str_replace('[c]', $category, $t18);
				$t18 = str_replace('[pc]', $pcategory, $t18);
				$t18 = str_replace('[m]', $manufacturer, $t18);
				$t18 = str_replace('[b]', $brand, $t18);
				$t18 = str_replace('[sku]', $sku, $t18);
				$seo['prod_h1'] = str_replace('[18]', $t18, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[18]', $t18, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[18]', $t18, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[18]', $t18, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[18]', $t18, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[18]', $t18, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[18]', $t18, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[18]', $t18, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[18]', $t18, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[18]', $t18, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[18]', $t18, $seo['manuf_desc']);
			}
			if (!empty($t19)) {
				$t19 = str_replace('[n]', $name, $t19);				
				$t19 = str_replace('[p]', $price, $t19);
				$t19 = str_replace('[sp]', $sprice, $t19);
				$t19 = str_replace('[c]', $category, $t19);
				$t19 = str_replace('[pc]', $pcategory, $t19);
				$t19 = str_replace('[m]', $manufacturer, $t19);
				$t19 = str_replace('[b]', $brand, $t19);
				$t19 = str_replace('[sku]', $sku, $t19);
				$seo['prod_h1'] = str_replace('[19]', $t19, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[19]', $t19, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[19]', $t19, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[19]', $t19, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[19]', $t19, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[19]', $t19, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[19]', $t19, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[19]', $t19, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[19]', $t19, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[19]', $t19, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[19]', $t19, $seo['manuf_desc']);
			}
			if (!empty($t20)) {
				$t20 = str_replace('[n]', $name, $t20);				
				$t20 = str_replace('[p]', $price, $t20);
				$t20 = str_replace('[sp]', $sprice, $t20);
				$t20 = str_replace('[c]', $category, $t20);
				$t20 = str_replace('[pc]', $pcategory, $t20);
				$t20 = str_replace('[m]', $manufacturer, $t20);
				$t20 = str_replace('[b]', $brand, $t20);
				$t20 = str_replace('[sku]', $sku, $t20);
				$seo['prod_h1'] = str_replace('[20]', $t20, $seo['prod_h1']);
				$seo['prod_title'] = str_replace('[20]', $t20, $seo['prod_title']);
				$seo['prod_meta_desc'] = str_replace('[20]', $t20, $seo['prod_meta_desc']);
				$seo['prod_desc'] = str_replace('[20]', $t20, $seo['prod_desc']);
				$seo['prod_keyword'] = str_replace('[20]', $t20, $seo['prod_keyword']);
				$seo['cat_title'] = str_replace('[20]', $t20, $seo['cat_title']);			
				$seo['cat_meta_desc'] = str_replace('[20]', $t20, $seo['cat_meta_desc']);
				$seo['cat_desc'] = str_replace('[20]', $t20, $seo['cat_desc']);
				$seo['manuf_title'] = str_replace('[20]', $t20, $seo['manuf_title']);
				$seo['manuf_meta_desc'] = str_replace('[20]', $t20, $seo['manuf_meta_desc']);
				$seo['manuf_desc'] = str_replace('[20]', $t20, $seo['manuf_desc']);
			}
						
		}
		
		$br = 1;
		for ($i=0; $i<200; $i++) {
			if (!$br) break;
			$br = 0;
			$pb = strpos($seo['prod_h1'], "[");			
			$pe = strpos($seo['prod_h1'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['prod_h1'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['prod_h1'] = str_replace($n, $text, $seo['prod_h1']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['prod_h1'] = str_replace($n, $text, $seo['prod_h1']);
					} else $seo['prod_h1'] = str_replace($n, '', $seo['prod_h1']);
				}	
			}	
			$pb = strpos($seo['prod_title'], "[");			
			$pe = strpos($seo['prod_title'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['prod_title'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['prod_title'] = str_replace($n, $text, $seo['prod_title']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['prod_title'] = str_replace($n, $text, $seo['prod_title']);
					} else $seo['prod_title'] = str_replace($n, '', $seo['prod_title']);
				}	
			}		
			$pb = strpos($seo['prod_meta_desc'], "[");			
			$pe = strpos($seo['prod_meta_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['prod_meta_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['prod_meta_desc'] = str_replace($n, $text, $seo['prod_meta_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['prod_meta_desc'] = str_replace($n, $text, $seo['prod_meta_desc']);
					} else $seo['prod_meta_desc'] = str_replace($n, '', $seo['prod_meta_desc']);
				}	
			}
			
			$pb = strpos($seo['prod_desc'], "[");		
			$pe = strpos($seo['prod_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['prod_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['prod_desc'] = str_replace($n, $text, $seo['prod_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['prod_desc'] = str_replace($n, $text, $seo['prod_desc']);
					} else $seo['prod_desc'] = str_replace($n, '', $seo['prod_desc']);
				}	
			}	
			$pb = strpos($seo['cat_title'], "[");	
			$pe = strpos($seo['cat_title'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_title'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_title'] = str_replace($n, $text, $seo['cat_title']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['cat_title'] = str_replace($n, $text, $seo['cat_title']);
					} else $seo['cat_title'] = str_replace($n, '', $seo['cat_title']);
				}	
			}	
			$pb = strpos($seo['cat_meta_desc'], "[");	
			$pe = strpos($seo['cat_meta_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_meta_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_meta_desc'] = str_replace($n, $text, $seo['cat_meta_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['cat_meta_desc'] = str_replace($n, $text, $seo['cat_meta_desc']);
					} else $seo['cat_meta_desc'] = str_replace($n, '', $seo['cat_meta_desc']);
				}	
			}	
			$pb = strpos($seo['prod_keyword'], "[");	
			$pe = strpos($seo['prod_keyword'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['prod_keyword'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['prod_keyword'] = str_replace($n, $text, $seo['prod_keyword']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['prod_keyword'] = str_replace($n, $text, $seo['prod_keyword']);
					} else $seo['prod_keyword'] = str_replace($n, '', $seo['prod_keyword']);
				}	
			}	
			$pb = strpos($seo['cat_desc'], "[");	
			$pe = strpos($seo['cat_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['cat_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['cat_desc'] = str_replace($n, $text, $seo['cat_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['cat_desc'] = str_replace($n, $text, $seo['cat_desc']);
					} else $seo['cat_desc'] = str_replace($n, '', $seo['cat_desc']);
				}	
			}	
			$pb = strpos($seo['manuf_title'], "[");	
			$pe = strpos($seo['manuf_title'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_title'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_title'] = str_replace($n, $text, $seo['manuf_title']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['manuf_title'] = str_replace($n, $text, $seo['manuf_title']);
					} else $seo['manuf_title'] = str_replace($n, '', $seo['manuf_title']);
				}	
			}	
			$pb = strpos($seo['manuf_meta_desc'], "[");	
			$pe = strpos($seo['manuf_meta_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_meta_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_meta_desc'] = str_replace($n, $text, $seo['manuf_meta_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['manuf_meta_desc'] = str_replace($n, $text, $seo['manuf_meta_desc']);
					} else $seo['manuf_meta_desc'] = str_replace($n, '', $seo['manuf_meta_desc']);
				}	
			}	
			$pb = strpos($seo['manuf_desc'], "[");	
			$pe = strpos($seo['manuf_desc'], "]");
			if ($pe) {
				$br = 1;
				$n = substr($seo['manuf_desc'], $pb, $pe-$pb+1);
				if (substr_count($n, "|")) {
					$m = substr($n, 1, strlen($n)-2);
					$mm = explode("|", $m);						
					$text = $mm[rand(0, count($mm)-1)];
					$seo['manuf_desc'] = str_replace($n, $text, $seo['manuf_desc']);
				} else {
					$v = $this->getValue($product_id, $n, $lang);
					if (!empty($v)) {
						if (substr_count($n, '{')) $text = $v;
						else $text = substr($n, 1, strlen($n)-2) . ': ' . $v;
						$seo['manuf_desc'] = str_replace($n, $text, $seo['manuf_desc']);
					} else $seo['manuf_desc'] = str_replace($n, '', $seo['manuf_desc']);
				}	
			}	
		}	
	}
	
	public function FixProductURL($row) {
		$product_id = $row['product_id'];		
		$model = $row['model'];
		$sku = $row['sku'];
		
		$rows = $this->getProductDesc($product_id);		
		$name = '';
		if (isset($rows[0]['name'])) $name = $this->Code($rows[0]['name']);
		$seo_url = $this->TransLit($name);		
		$seo_url = $this->MetaURL($seo_url);
		$seo_url = strtolower($seo_url);
		
	//	$seo_url = substr($seo_url, 0, 64);  // обрезать до 64 символов        
	//	$seo_url = $seo_url.'_'.$model; // название товара+Модель
	//  $seo_url = $row_product[0]['sku']."_".$model; // sku+model
	//	$seo_url = $seo_url."_".$sku; // название+sku		
		$row = $this->getURL($product_id);
		if (empty($row)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($seo_url) . "'");
		} else {		
			$rows = $this->chURL($seo_url);
			if (!empty($rows)) $seo_url = $seo_url . '-' . $product_id;
			$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo_url) . "' WHERE `query` = 'product_id=" . $product_id . "'");
		}
	}
	
	public function FixMetaProduct($store, $row, $seo_data) {
		$lang = $this->config->get('config_language_id');
		$product_id = $row['product_id'];		
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		$name = $rows[0]['name'];		
		$seo = array();
		$this->seoProduct($store, $product_id, $seo_data, $seo);		
		if (empty($seo['prod_h1'])) $seo['prod_h1'] = $name;
		$seo['prod_h1'] = $this->clearSEO($seo['prod_h1']);
		$seo['prod_title'] = $this->clearSEO($seo['prod_title']);
		$seo['prod_meta_desc'] = $this->clearSEO($seo['prod_meta_desc']);
		$seo['prod_keyword'] = $this->clearSEO($seo['prod_keyword']);		
				
		if (!empty($seo['prod_h1'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($seo['prod_h1']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");
		}
		
		if (!empty($seo['prod_title'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($seo['prod_title']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}
		
		if (!empty($seo['prod_meta_desc'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($seo['prod_meta_desc']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");	
		}

		if (!empty($seo['prod_keyword'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_keyword` = '" . $this->db->escape($seo['prod_keyword']) . "'  WHERE `product_id` = '" . $product_id . "' and `language_id` = '" . $lang. "'");
		}
				
	}
	
	public function findProduct($cod, $store) {
		$rows = '';	
		$rows  = $this->getProductBySKU($cod, $store);
		if (empty($rows)) {
			$rows = '';
			$rows = $this->getProductByTable($cod);
		    if (empty($rows)) return '';
			$row = $this->getProductByID($rows[0]['product_id']);
			if (isset($row['sku']) and !empty($row['sku'])) $rows[0]['sku'] = $row['sku'];
		}
		return $rows;
	}	
	
	public function getProduct($cod, $store) {
		$c = $cod;
		$rows = "";	
		$rows = $this->findProduct($c, $store);			
		return $rows;
	}		
	
	public function addSkuToTable($c, &$sku_id, $store) {
		if (!$sku_id) {
			$row = $this->getMaxSkuID();
			$sku_id = $row['max(sku_id)'];
			$sku_id = $sku_id + 1;
		}		
		$row = $this->getskuDescription($c, $store);
		if (!empty($row) and !empty($c) and !empty($sku_id)) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_sku_description WHERE sku = '" . $c . "' AND store_id = '" . (int)$store . "'");
			if ($store == 0)
			$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_sku_description WHERE sku = '" . $c . "' AND store_id = ''");
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$sku_id. "', `sku` = '" . $this->db->escape($c) . "', store_id = '" . (int)$store . "'");		
		}
		if ((!isset($row) or empty($row)) and !empty($c)) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$sku_id. "', `sku` = '" . $this->db->escape($c) . "', store_id = '" . (int)$store . "'");	
			
		} 
		
	}
	
	public function addProductToTable($product_id, $code, &$last_sku_id, $store) {			
		$row = $this->getskuDescription($code, $store);
		if (!empty($row)) {
			$this->putsku($product_id, $row['sku_id']);
			$last_sku_id = $row['sku_id'];			
		} else {
			$code = trim($code);			
			$last_sku_id = 0;
			$this->addSkuToTable($code, $last_sku_id, $store);			
			$this->putsku($product_id, $last_sku_id);			
		}	
	}
	
	public function CreateSkuTable($row, $store) {
		$row1 = $this->getMaxNomid();
		$maxid = $row1['max(nom_id)'];
		for ($i=1; $i<=$maxid; $i++) {	
			$row1 = $this->getSkuIDByNom($i);		
			if (empty($row1['product_id'])) continue;
			$rows = $this->getProductsByID($row1['product_id']);
			if (empty($rows)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "suppler_sku WHERE `nom_id` = '" . $i . "'");
			}	
		}
		$last_sku_id = 0;
	// запишем sku существующего товара в библиотеку
		$this->addProductToTable($row['product_id'], $row['sku'], $last_sku_id, $store);
		
	// если sku состоит из двух разных ску, разделенных слешем, то пишем все по одному до 2-х штук
		if (substr_count($row['sku'], "/")) {
			$codes = explode("/", $row['sku']);
			if (isset($codes[0]) and !empty($codes[0]) and isset($codes[1]) and !empty($codes[1])) {
				$l1 = strlen($codes[0]);
				$l2 = strlen($codes[1]);				
				if (substr($codes[0],0,1) == substr($codes[1],0,1) and $l1 == $l2) {
					$this->addSkuToTable($codes[0], $last_sku_id, $store);					
					$this->addSkuToTable($codes[1], $last_sku_id, $store);							
				}				
			}			
		}
	/*	
	// Если в названии товара есть скобки, то пишем в библиотеку все, что в скобках, если там не только русские буквы
		$rows = $this->getProductDesc($row['product_id']);
		if (!empty($rows)) {
			$pb = strpos($rows[0]['name'], "(");
			if ($pb) {
				$pe = strpos($rows[0]['name'], ")");
				if ($pe) {
					$l = $pe - $pb - 1;
					if ($l > 0) {
						$txt = substr($rows[0]['name'], $pb+1, $l);
						if (!preg_match('/^[А-Яа-я.,-:? ]+$/', $txt) and !empty($txt)) {
							$this->addSkuToTable($txt, $last_sku_id, $store);
							$c = str_replace(" ", "", $txt);
							$c = trim($c);
							if ($c != $txt and !empty($c)) $this->addSkuToTable($c, $last_sku_id, $store);
						}
					}
				}
			}
		}	*/
	}
	
	public function deleteEmptyPhoto($row) {
		if (empty($row)) return;
		$nul = '';
		$path = "../image/" . $row['image'];
		if (!file_exists($path)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" . $nul . "' WHERE product_id = '" . (int)$row['product_id'] ."'");
		}
		$rows = $this->getProductImage($row['product_id']);
		if (empty($rows)) return;		
		for ($i=0; $i<40; $i++) {
			if (!isset($rows[$i]['image']) or empty($rows[$i]['image'])) break;
			$path = "../image/" . $rows[$i]['image'];
			if (!file_exists($path)) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$row['product_id'] . "' and `image` = '" . $rows[$i]['image'] . "'");
			}
		}
	}
	
	public function DeleteDefaultFoto($row, $photo) {		
		$nul = '';
		if (substr_count($row['image'], $photo)) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" . $nul . "' WHERE product_id = '" . (int)$product_id ."'");
		}
		$rows = $this->getProductImage($row['product_id']);
	// проверяем до 50 дополнительных фото
		for ($i=0; $i<50; $i++) {
			if (!isset($rows[$i]['image'])) break;				
			if (substr_count($rows[$i]['image'], $photo)) {		
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' and `product_image_id` = '".$rows[$i]['product_image_id']."'");
				
			}
		}
	}
	
	public function RenameFoto($row, $seo_photo, $store) {
		if (empty($row)) return;
		if (empty($seo_photo)) return;
		$rows = $this->countImages($row['image']);
		if (isset($rows[1]['image']) and !empty($rows[1]['image'])) return;
		$product_id = $row['product_id'];		
		$lang = $this->config->get('config_language_id');
		$name = '';		
		$category = '';	
		$manufacturer = '';	
		$brand = $row['location'];
		$sku = $row['sku'];
		$model = $row['model'];
		$rows = $this->getManufacturerStore($row['manufacturer_id'], $store);
		if (!empty($rows)) $manufacturer = $rows[0]['name'];
		$manufacturer = str_replace('&quot;', '', $manufacturer);
	
		$rows = $this->getProductCategory($product_id);
		if (!empty($rows)) {
			$child = 0;
			for ($j=0; $j<10; $j++) {					
				if (!isset($rows[$j]['category_id'])) continue;
				else if ((int)$rows[$j]['category_id'] > $child) {
					$child = $rows[$j]['category_id'];					
				}	
			}			
			$rows = $this->getCategoryName($child);
			if (!empty($rows)) $category = $rows[0]['name'];			
		}		
		$rows = $this->getProductDesc($product_id);
		if (!empty($rows)) {
			$name = $rows[0]['name'];
			$name = str_replace('&quot;', '', $name);			
		}
		$data['name'] = $name;
		$data['category'] = $category;
		$data['manufacturer'] = $manufacturer;
		$data['model'] = $model;
		$data['brand'] = $brand;
		$data['sku'] = $sku;
		$app = $this->namePhoto($store, $data, $seo_photo);
		$nom = stripos($row['image'], ".j");
		if (!$nom) $nom = stripos($row['image'], ".png");
		if (!$nom) $nom = stripos($row['image'], ".gif");
		if (!$nom) $nom = stripos($row['image'], ".bmp");
		if (!$nom) return;
		$se = substr($row['image'], $nom);
		$old = '../image/' . $row['image'];
		$p = strrpos($row['image'], "/");
		if (!$p) return;
		$new = substr($row['image'], 0, $p+1);
		$new = $new . $app . $se;
		$new = $this->TransLit($new);
		$new = strtolower($new);
		if (!file_exists($old)) return;
		if (!rename ($old, '../image/' . $new)) return;
		$row['image'] = $new;
		
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" . $new . "' WHERE product_id = '" . $product_id ."'");
		
		$rows = $this->getProductImage($product_id);
		if (empty($rows)) return;		
		for ($i=0; $i<40; $i++) {
			if (!isset($rows[$i]['image']) or empty($rows[$i]['image'])) break;
			$rows1 = $this->countDopImages($rows[$i]['image']);
			if (isset($rows1[1]['image']) and !empty($rows1[1]['image'])) continue;
			$app = $this->namePhoto($store, $data, $seo_photo);
			$nom = stripos($rows[$i]['image'], ".j");
			if (!$nom) $nom = stripos($rows[$i]['image'], ".png");
			if (!$nom) $nom = stripos($rows[$i]['image'], ".gif");
			if (!$nom) $nom = stripos($rows[$i]['image'], ".bmp");
			if (!$nom) return;
			$se = substr($rows[$i]['image'], $nom);
			$old = '../image/' . $rows[$i]['image'];
			$p = strrpos($rows[$i]['image'], "/");
			if (!$p) return;
			$new = substr($rows[$i]['image'], 0, $p+1);
			$new = $new . $app . $se;
			$new = $this->TransLit($new);
			$new = strtolower($new);
			if (!file_exists($old)) return;
			if (!rename ($old, '../image/' . $new)) return;
			$row['image'] = $new;
		
			$this->db->query("UPDATE " . DB_PREFIX . "product_image SET `image` = '" . $new . "' WHERE product_image_id = '" . $rows[$i]['product_image_id'] ."'");
			
		}			
	}
	
	public function DoubleFoto($row) {
		if (empty($row)) return;
		$product_id = $row['product_id'];
		$mas[0]['image'] = $row['image'];
		$mas[0]['id'] = '';
	
		$rows = $this->getProductImage($product_id);
		if (empty($rows)) return;		
		$k = 1;
		for ($i=0; $i<40; $i++) {
			if (!isset($rows[$i]['image'])) break;
			$mas[$k]['image'] = $rows[$i]['image'];
			$mas[$k]['id'] = $rows[$i]['product_image_id'];
			$k++;
		}	
		for ($i=0; $i<$k; $i++) {			
			if ($mas[$i]['image'] == "del") continue;
			$hashi = sha1_file('../image/' . $mas[$i]['image']);
			for ($j=0; $j<$k; $j++) {				
				if ($i != $j) {	
					if ($mas[$j]['image'] == "del") continue;
					$hashj = sha1_file('../image/' . $mas[$j]['image']);
	
					if ($hashi == $hashj) {		
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' and `product_image_id` = '".$mas[$j]['id']."'");
						$mas[$j]['image'] = "del";
					}
				}
			}
		}	
	}
	
	public function deleteProductWithoutAttribute($product_id) {
		$rows = $this->getAttrib($product_id);
		if (empty($rows)) $this->deleteProduct($product_id);
		
	}
	
	public function DeleteSpecialPrice($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . $product_id . "'");
		
	}
	
	public function changeManufacturer($row, $manufacturer_idF, $manufacturer_idR) {		
		if ($manufacturer_idF == $manufacturer_idR) return;
		if (empty($manufacturer_idF)) return;
		if (empty($manufacturer_idR)) return;		
		
		if ($row['manufacturer_id'] == $manufacturer_idF) {			
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET `manufacturer_id` = '" . $manufacturer_idR . "' WHERE `product_id` = '" . $row['product_id'] . "'");
		}	
	}
	
	public function changeAttribute($store, $product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		
		if ($find == $replace) return;
		if (empty($find)) return;
		$rows = $this->getAttributeID($find);
		if (empty($rows)) return;
		$attribute_idF = $rows[0]['attribute_id'];
		$langF = $rows[0]['language_id'];
		if (empty($replace)) {
			$this->DelAttributeInProduct($product_id, $attribute_idF, $langF);
			return;
		}	
		$rows = $this->getAttributeID($replace);
		if (empty($rows)) return;
		$attribute_idR = $rows[0]['attribute_id'];
		$langR = $rows[0]['language_id'];
		$rows = $this->getAttributeById($product_id, $attribute_idR, $langR);
		if (!empty($rows)) {
			$this->DelAttributeInProduct($product_id, $attribute_idF, $langF);
			return;
		}	
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `attribute_id` = '" . $attribute_idR . "' WHERE `product_id` = '" . $product_id . "' AND `attribute_id` = '" . $attribute_idF . "' AND `language_id` = '" . $langF . "'");
					
	}
	
	public function FindReplaceURL($row, $find, $replace) {
		if (empty($find)) return;
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		$product_id = $row['product_id'];		
		$row = $this->getURL($product_id);
		if (empty($row)) return;
		$seo_url = str_replace($find, $replace, $row['keyword']);
		$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET `keyword` = '" . $this->db->escape($seo_url) . "' WHERE `query` = 'product_id=" . $product_id . "'");
		
	}
	
	public function FindReplaceOption($row, $find, $replace) {
		if ($find == '') return;
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		$rows = $this->getProductAllOption($row['product_id']);
		if (empty($rows)) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);
		foreach ($rows as $r) {
			for ($j=0; $j<$max; $j++) {
				if (!isset($replaces[$j]) or empty($replaces[$j])) $replaces[$j] = '';
				if ($r['option_value'] == $finds[$j]) {
					$this->db->query("UPDATE " . DB_PREFIX . "product_option SET `option_value` = '" . $this->db->escape($replaces[$j]). "' WHERE `product_option_id` = '" . $r['product_option_id'] . "'");
				}
			}	
		}	
	}
	
	public function findreplaceAttribute($product_id, $name, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getAttributes($product_id);
		if (empty($rows)) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);
		if (!$name) {
			foreach ($rows as $r) {				
				for ($j=0; $j<$max; $j++) {
					if (!isset($replaces[$j]) or empty($replaces[$j])) $replaces[$j] = '';
					if (substr_count($r['text'], $finds[$j])) {
						$new = str_replace($finds[$j], $replaces[$j], $r['text']);
						$lang = $this->config->get('config_language_id');
						$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($new). "' WHERE `product_id` = '" . (int)$product_id . "' and `attribute_id` = '" . (int)$r['attribute_id'] . "' and `language_id` = '" . $lang . "'");
						break;
					}	
				}
			}	
		} else {
			$rows = $this->getAttributeID($name);
			if (empty($rows)) return;
			$lang = $this->config->get('config_language_id');
			$rows = $this->getAttributeById($product_id, $rows[0]['attribute_id'], $lang);
			if (empty($rows)) return;			
			for ($j=0; $j<$max; $j++) {
				if (!isset($replaces[$j])) $replaces[$j] = '';
				if (substr_count($rows[0]['text'], $finds[$j])) {
					$new = str_replace($finds[$j], $replaces[$j], $rows[0]['text']);
					$lang = $this->config->get('config_language_id');	
					$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($new). "' WHERE `product_id` = '" . (int)$product_id . "' and `attribute_id` = '" . (int)$rows[0]['attribute_id'] . "' and `language_id` = '" . $lang . "'");
					break;
					
				}	
			}
		}		
	}
	
	public function shipping($product_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . 1 . "' WHERE `product_id` = '" . (int)$product_id . "'");
	
	}
	
	public function noshipping($product_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `shipping` = '" . 0 . "' WHERE `product_id` = '" . (int)$product_id . "'");
	
	}
	
	public function deleteProductFilter($product_id, $find, $filter_group_id) {		
		$this->findFilter($find, $filter_group_id, $filter_id);
		if ($filter_id) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "' and filter_id = '" . $filter_id . "'");
		}		
	}	
	
	public function findreplaceKeywords($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		if (!isset($rows[0]['tag'])) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;		
		$newtag = $rows[0]['tag'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';			
			if (substr_count($newtag, $finds[$j])) {
				$newtag = str_replace($finds[$j], $replaces[$j], $newtag);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `tag` = '" . $this->db->escape($newtag) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");		
		}	
	}
	
	public function findreplaceMetaDesc($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		if (!isset($rows[0]['meta_description'])) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;		
		$newmeta = $rows[0]['meta_description'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';			
			if (substr_count($newmeta, $finds[$j])) {
				$newmeta = str_replace($finds[$j], $replaces[$j], $newmeta);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `meta_description` = '" . $this->db->escape($newmeta) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");		
		}	
	}
	
	public function findreplaceH1($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		if (!isset($rows[0]['seo_h1'])) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;		
		$newh1 = $rows[0]['seo_h1'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';
			if (substr_count($newh1, $finds[$j])) {
				$newh1 = str_replace($finds[$j], $replaces[$j], $newh1);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_h1` = '" . $this->db->escape($newh1) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");		
		}	
	}
	
	public function findreplaceTitle($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		if (!isset($rows[0]['seo_title'])) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;		
		$newtitle = $rows[0]['seo_title'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';
			if (substr_count($newtitle, $finds[$j])) {
				$newtitle = str_replace($finds[$j], $replaces[$j], $newtitle);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `seo_title` = '" . $this->db->escape($newtitle) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");		
		}	
	}
	
	public function findreplaceName($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;
		$newname = $rows[0]['name'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';
			if (substr_count($newname, $finds[$j])) {
				$newname = str_replace($finds[$j], $replaces[$j], $newname);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `name` = '" . $this->db->escape($newname) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");		
		}	
	}
	
	public function findreplaceDescription($product_id, $find, $replace) {
		$find = str_replace('&lt;', '<', $find);
		$find = str_replace('&gt;', '>', $find);
		$find = str_replace('&quot;', '"', $find);
		$find = str_replace('&amp;', '&', $find);
		$replace = str_replace('&lt;', '<', $replace);
		$replace = str_replace('&gt;', '>', $replace);
		$replace = str_replace('&quot;', '"', $replace);
		$replace = str_replace('&amp;', '&', $replace);
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		$finds = explode("|", $find);
		$replaces = explode("|", $replace);
		$max = count($finds);		
		$fl = 0;
		$newdesc = $rows[0]['description'];
		for ($j=0; $j<$max; $j++) {
			if (!isset($replaces[$j])) $replaces[$j] = '';
			if (substr_count($newdesc, $finds[$j])) {
				$newdesc = str_replace($finds[$j], $replaces[$j], $newdesc);
				$fl = 1;
			}
		}
		if ($fl) {
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $this->db->escape($newdesc) . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");				
		
		}	
	}
	
	public function shortDescription($product_id, $find, $replace) {
		if (empty($find)) return;
		$rows = $this->getProductDesc($product_id);
		if (empty($rows)) return;
		if (!preg_match('/[0-9]+$/', $find)) return;
		$st = $this->TransLit($rows[0]['description']);
		$st = trim(strip_tags($st));
		
		if (strlen($st) < $find) {
			$newdesc = '';
			$lang = $this->config->get('config_language_id');
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET `description` = '" . $newdesc . "' WHERE `product_id` = '" .(int)$product_id . "' and `language_id` = '" . $lang. "'");
		}
	}
	
	public function redirect($product_id, $new_prefix) {
		$ds = date('Y-m-d');
		$de = '2034-00-00';
		$tu = 622080000;
		$active = 1;		
		$pref = HTTP_CATALOG;
		$m = explode ("+", $new_prefix);
		$new_pref = $m[0];		
		$en = '';
		if (substr_count($new_prefix, 'htm')) $en = '.htm';
		if (substr_count($new_prefix, 'html')) $en = '.html';
		$u = 0;
		if (substr_count($new_prefix, 'url')) $u = 1;	
		$row = $this->getURL($product_id);		
		if (!empty($row)) {
			$from_url = $pref.$row['keyword'].'.html';			
			$to_url = $new_pref;
			if ($u) $to_url = $to_url.$row['keyword'];
			if (!empty($en) and !substr_count($new_prefix, '.htm')) $to_url = $to_url.$en;			
			
			$row = $this->getRedirect($product_id);
			if (!empty($row)) {
				$this->db->query("UPDATE " . DB_PREFIX . "redirect SET `active` = '" . $active . "', `from_url` = '" . $from_url . "', `to_url` = '" . $to_url . "', `response_code` = 301, `date_start` = '" . $ds . "', `date_end` = '" . $de . "', `times_used` = '" . $tu . "' WHERE `product_id` = '" .(int)$product_id . "'");
			} else {
				$this->db->query("INSERT " . DB_PREFIX . "redirect SET `active` = '" . $active . "', `from_url` = '" . $from_url . "', `to_url` = '" . $to_url . "', `response_code` = 301, `date_start` = '" . $ds . "', `date_end` = '" . $de . "', `times_used` = '" . $tu . "', `product_id` = '" .(int)$product_id . "'");
			}
		}
	}
	
	public function minimum($product_id, $find, $replace) {
		if (empty($find)) return;
		$rows = $this->getProductsByID($product_id);
		if (empty($rows)) return;
		if (!preg_match('/[0-9]+$/', $find)) return;
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `minimum` = '" . $find . "' WHERE `product_id` = '" .(int)$product_id . "'");
	}
	
	public function sortPhoto($product_id) {		
		$rows = $this->getProductsByID($product_id);		
		if (!empty($rows)) {
			$p = strpos($rows[0]['model'], "-");
			if (!$p) $p = strpos($rows[0]['model'], "~");
			$papka = substr($rows[0]['model'], $p-1, 1);
			$a = substr_count($rows[0]['image'], "/0/");
			if (!$a) $a = substr_count($rows[0]['image'], "/1/");
			if (!$a) $a = substr_count($rows[0]['image'], "/2/");
			if (!$a) $a = substr_count($rows[0]['image'], "/3/");
			if (!$a) $a = substr_count($rows[0]['image'], "/4/");
			if (!$a) $a = substr_count($rows[0]['image'], "/5/");
			if (!$a) $a = substr_count($rows[0]['image'], "/6/");
			if (!$a) $a = substr_count($rows[0]['image'], "/7/");
			if (!$a) $a = substr_count($rows[0]['image'], "/8/");
			if (!$a) $a = substr_count($rows[0]['image'], "/9/");
			if (!$a) {
				$path_old = "../image/" . $rows[0]['image'];
				$p = strrpos($rows[0]['image'], "/");
				if ($p) {
					$b = substr($rows[0]['image'], 0, $p);
					$e = substr($rows[0]['image'], $p+1);
					$addr_new = $b . "/" . $papka . "/" . $e;
					$path = "../image/" . $b . "/" . $papka . "/";
					$path_new = $path . $e;
					if (!is_dir($path)) @mkdir($path, 0755);					
					$a = copy ($path_old, $path_new);
					if ($a) {
						$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" . $this->db->escape($addr_new) . "' WHERE `product_id` = '" . $product_id . "'");
					} else {
						$err = " Photo: " . $path_old . " not copied. Product_ID: " . $product_id . " \n";
						$this->adderr($err);
					}
				}	
			}
		
			$rows = $this->getProductImage($product_id);
			if (!empty($rows)) {
				for ($j=0; $j<30; $j++) {
					if (!isset($rows[$j]['image'])) break;
					$a = substr_count($rows[$j]['image'], "/0/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/1/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/2/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/3/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/4/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/5/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/6/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/7/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/8/");
					if (!$a) $a = substr_count($rows[$j]['image'], "/9/");
					if (!$a) {
						$path_old = "../image/" . $rows[$j]['image'];
						$p = strrpos($rows[$j]['image'], "/");
						if ($p) {
							$b = substr($rows[$j]['image'], 0, $p);
							$e = substr($rows[$j]['image'], $p+1);
							$addr_new = $b . "/" . $papka . "/" . $e;
							$path = "../image/" . $b . "/" . $papka . "/";
							$path_new = $path . $e;
							if (!is_dir($path)) @mkdir($path, 0755);							
							if (copy($path_old, $path_new)) {								
								$this->db->query("UPDATE " . DB_PREFIX . "product_image SET `image` = '" . $this->db->escape($addr_new) . "' WHERE `product_image_id` = '" . $rows[$j]['product_image_id'] . "'");
							} else {
								$err = " Photo: " . $path_old . " not copied. Product_ID: " . $product_id . " \n";
								$this->adderr($err);
							}
						}	
					}
				}
			}
		}	
		return 0;
	}
	
	public function changeQuantity($row, $old, $new) {
		if ($old == '' or $new == '') return;
		$oldg = 0;
		$oldl = 0;
		$newg = 0;
		$newl = 0;
		if (substr_count($old, "&gt;")) $oldg = 1;
		if (substr_count($old, "&lt;")) $oldl = 1;
		if (substr_count($new, "&gt;")) $newg = 1;
		if (substr_count($new, "&lt;")) $newl = 1;
		$old = preg_replace('/[^0-9]/','',$old);
		$old = trim($old);
		$new = preg_replace('/[^0-9]/','',$new);
		$new = trim($new);
		$f = 0;
		if ($oldg and $row['quantity'] > $old) $f = 1;
		if ($oldl and $row['quantity'] < $old) $f = 1;
		if (!$oldg and $row['quantity'] == $old) $f = 1;
		
		if ($f) {
			if ($newg) $row['quantity'] = $new+1;
			else if ($newl) $row['quantity'] = $new-1;
				 else $row['quantity'] = $new;
			$this ->upproduct($row);			
		}	
	}
	
	public function renameFolder($row, $source, $target) {	
		if (empty($source) or empty($target)) return;
		$row['image'] = str_replace($source, $target, $row['image']);
			
		$this->db->query("UPDATE " . DB_PREFIX . "product SET `image` = '" .$row['image']. "' WHERE `product_id` = '" . $row['product_id'] . "'");
		
		$rows = $this->getProductImage($row['product_id']);		
		if (!empty($rows)) {
			for ($j=0; $j<30; $j++) {
				if (!isset($rows[$j]['image'])) break;
				$rows[$j]['image'] = str_replace($source, $target, $rows[$j]['image']);
				$this->db->query("UPDATE " . DB_PREFIX . "product_image SET `image` = '" .$rows[$j]['image']. "' WHERE `product_image_id` = '" . $rows[$j]['product_image_id'] . "'");
				
			}
		}				
	}
	
	public function DeletePhoto($product_id) {
		$path = "../image1/";
		if (!is_dir($path)) return 29;
		$rows = $this->getProductsByID($product_id);
		if (!empty($rows)) {
			$path_old = "../image/" . $rows[0]['image'];
			$path_new = "../image1/" . $rows[0]['image'];
			$a = copy ($path_old, $path_new);
			if (!$a) {
				$err = " Photo: " . $path_old . " not copied. Product_ID: " . $product_id . " \n";
				$this->adderr($err);				
			}
		}	
		$rows = $this->getProductImage($product_id);
		if (!empty($rows)) {
			foreach ($rows as $r) {
				$path_old = "../image/" . $r['image'];
				$path_new = "../image1/" . $r['image'];
				$a = copy ($path_old, $path_new);
				if (!$a) {
					$err = " Photo: " . $path_old . " not copied. Product_ID: " . $product_id . " \n";
					$this->adderr($err);				
				}
			}
		}	
		return 0;
	}
	
	public function importAtt($product_id, &$masatt) {	
		$lang = $this->config->get('config_language_id');
		for ($i=0; $i<5000; $i++) {	
			if (!isset($masatt[$i][1])) break;			
			$rows = $this->getAttributeID($masatt[$i][1]);	
			if (!empty($rows)) {
				$attribute_id = $rows[0]['attribute_id'];	
				$rows = $this->getAttributeById($product_id, $attribute_id, $lang);
				if (!empty($rows)) {	
					if (isset($masatt[$i][2]) and !empty($masatt[$i][2]) and $masatt[$i][2] != "0" and ($masatt[$i][1] != $masatt[$i][2])) {
						$this->db->query("UPDATE " . DB_PREFIX . "attribute_description SET `name` = '" . $this->db->escape($masatt[$i][2]) . "' WHERE `attribute_id` = '" . $attribute_id . "' and `language_id` = '" . $lang. "'");
				
						$this->cache->delete('attribute');
					}	
					for ($j=4; $j<2000; $j=$j+2) {	
						if (empty($masatt[$i][$j-1])) break;						
						if (isset($masatt[$i][$j]) and $masatt[$i][$j] != "") {
		
							if ($masatt[$i][$j] == "0") {		
								$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE text = '" . $this->db->escape($masatt[$i][$j-1]) . "' and `attribute_id` = '" . $attribute_id . "' and `language_id` = '" . $lang. "' and `product_id` = '" . $product_id. "'");		
							} else {
								$this->db->query("UPDATE " . DB_PREFIX . "product_attribute SET `text` = '" . $this->db->escape($masatt[$i][$j]) . "' WHERE `attribute_id` = '" . $attribute_id . "' and `language_id` = '" . $lang. "' and `product_id` = '" . $product_id. "' and `text` = '" . $masatt[$i][$j-1] ."'");		
							}	
						}	
					}
					$this->cache->delete('product');
				}
			}
		}	
	}
	
	public function exportAtt($product_id, &$masatt) {
		$rows = $this->getAttributes($product_id);
		if (!empty($rows)) {
			foreach ($rows as $r) {				
				$f = 0;
				for ($i=0; $i<30000; $i++) {
					if (!isset($masatt[$i][0])) break;
					if ($r['attribute_id'] == (int)$masatt[$i][0]) {
						$f = 1;
						break;
					}
				}
				if (!$f) {					
					$rows1 = $this->getAttributeName($r['attribute_id']);	
					if (!empty($rows1)) {
						$masatt[$i][0] = $r['attribute_id'];
						$masatt[$i][1] = $rows1[0]['name'];
					} else {			
						$this->DelAttributeInProduct($product_id, $r['attribute_id'], $this->config->get('config_language_id'));
						continue;
					}
					
				}	
				$f = 0;	
				for ($j=2; $j<801; $j++) {
					if (!isset($masatt[$i][$j])) break;
					if ($r['text'] == $masatt[$i][$j]) {
						$f = 1;
						break;
					}
				}				
				if (!$f) $masatt[$i][$j] = $r['text'];	
			}			
		}		
	}
	
	public function Convert($product_id, $mas_con, $text) {
		$rows = $this->getProductDesc($product_id);
		if ($rows) {
			$newdesc = strtr($rows[0]['description'], $mas_con);
			$newdesc = ucfirst($newdesc);
			$j=0;
			$rep = ' ';
			while (1) {
				if (!isset($text[$j][1])) break;
				$pe = stripos($newdesc, $text[$j][1]);	
				if ($pe) {
					$a = substr($text[$j][2], 0, 80);
					if (!substr_count($rep, $a)) {
						if (substr($text[$j][2], 0, 3) == "<B>") {
							$pen = stripos($newdesc, '<p>', $pe) -1;
							if (!$pen) $pen = stripos($newdesc, '</p>', $pe) +4;
							if (!$pen) $pen = stripos($newdesc, '</ul>', $pe) +5;
							if (!$pen) $pen = stripos($newdesc, '<br />', $pe) +6;
							if (!$pen) $pen = stripos($newdesc, '&lt;p&gt;', $pe) +9;
							if (!$pen) $pen = stripos($newdesc, "&lt;/p&gt;", $pe) +10;
							if (!$pen) $pen = stripos($newdesc, "&lt;/ul&gt;", $pe) +11;
							if (!$pen) $pen = stripos($newdesc, "&lt;br /&gt;", $pe) +12;							
							
							if ($pen) {
								$newdesc = substr($newdesc, 0, $pen) . '<p>' . $text[$j][2] . '</p>'. substr($newdesc, $pen);
								$rep = $rep.substr($text[$j][2], 0, 80);
							}	
							
						} else {
							$a = substr($text[$j][2], 0, 1);
							if (preg_match('/^[A-ZА-Я ]+$/', $a) or $a == "<") {
		
								$pen = stripos($newdesc, "<", $pe);
								if (!$pen) $pen = stripos($newdesc, "&lt;", $pe);
								if (!$pen) $pen = stripos($newdesc, ". ", $pe);
								
								if ($pen) {
									$newdesc = substr($newdesc, 0, $pen) . ' ' . $text[$j][2] . substr($newdesc, $pen);
									$rep = $rep.substr($text[$j][2], 0, 80);
								}	
							} else {
		
								$pe = $pe + strlen($text[$j][1]);
								$newdesc = substr($newdesc, 0, $pe) . ' ' . $text[$j][2] . substr($newdesc, $pe);
								$rep = $rep.substr($text[$j][2], 0, 80);
							}	
						}
					}	
				}
				$j++;
			}
			$this->upDesc($newdesc, $product_id); 
		}	
		
	}
	
	public function printSkuLibrary($row, $store) {
		$path = "./uploads/ex.xml";			
		if (!file_exists($path)) {
			$this->StartEx();			
			
			for ($j=0; $j<5; $j++) {
				$st = ' <Column ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
				$this->addex($st);
			}
			$st = '<Row>'."\n";
			$this->addex($st);			
			$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product Code</Data></Cell>'."\n";
			$this->addex($st);
			$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Main SKU</Data></Cell>'."\n";
			$this->addex($st);
			$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Alt SKU</Data></Cell>'."\n";
			$this->addex($st);
			$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name</Data></Cell>'."\n";
			$this->addex($st);						
			$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price</Data></Cell>'."\n";
			$this->addex($st);			
			$st = '</Row>'."\n";
			$this->addex($st);			
		}
		$name = '';
		$price = $row['price'];
		$model = $row['model'];
		$product_id = $row['product_id'];		
		$main_sku = $row['sku'];
		$row = $this->getSkuID($product_id);
		
		if (!empty($row)) {
			$fl = 0;			
			$rows = $this->getSku($row['sku_id'], $store);				
			if (!empty($rows)) {
				foreach ($rows as $r) {				
					if ($r['sku'] != $main_sku) {
						$fl = 1;
						$alt = $r['sku'];						
					}
		
					if ($fl) {
						$fl = 0;
						$rows1 = $this->getProductDesc($product_id);
						if (!empty($rows1)) $name = $rows1[0]['name'];				
						$st = '<Row>'."\n";
						$this->addex($st);
						$st = $model;
						$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = $main_sku;
						$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = $alt;
						$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = $name;
						$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = $price;
						$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = '</Row>'."\n";
						$this->addex($st);
					}	
				}	
			}
		}
	}
	
	public function addPrefix($row, $prefix, $infix, $store) {	
		$sku = $row['sku'];
		if (empty($sku)) return;
		$a = 1;
		$b = 1;
		$new_sku = '';
		if (!empty($prefix)) $a = substr_count($sku, $prefix);
		if (!empty($infix)) $b = substr_count($sku, $infix);
		if (!$a and !$b) $new_sku = $prefix . $sku . $infix;
		if (!$b and $a) $new_sku = $sku . $infix;
		if ($b and !$a) $new_sku = $prefix . $sku;
		if (!empty($new_sku)) {
			$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `sku` = '" . $this->db->escape($new_sku) . "' WHERE `product_id` = '" . $row['product_id'] . "'");

			$rows = $this->getAllRecordsLibrary($sku, $store);
			if (!empty($rows)) {
				foreach ($rows as $r) {	
					if ($r['sku'] == $sku) {
						$this->db->query("UPDATE `" . DB_PREFIX . "suppler_sku_description` SET `sku` = '" . $this->db->escape($new_sku) . "' WHERE `nom_id` = '" . $r['nom_id'] . "'");
					}
				}
			}
		}	
	}
	
	public function putsos($row_count, $sku) {
		$file_sos    = "./uploads/sos.tmp";	
		
		$sos = @fopen($file_sos,'r+');
		if (!$sos) { $row_count = -5; return $row_count; }
		else {			
			fseek($sos, 0);
			$mmm = fgets($sos, 100);
			$m = explode(" " , $mmm);
			$row_count_old = (int)$m[0];
							
			if (empty($row_count_old)) $row_count_old = -1;	
			if ($row_count_old > $row_count) {
				fclose($sos); 
				unlink ($file_sos);
				$row_count = -5; 
				return $row_count; 
			}
			fseek($sos, 0);					
			$m = $row_count . ' ' . $sku . '     ';	
			if (!@fputs($sos, $m)) {
				fclose($sos); 
				unlink ($file_sos);
				$row_count = -5; 
				return $row_count; 
			}
			fclose($sos);		
			$row_count = $row_count + 1;
			return $row_count;
		}
	}
	
	public function addReport($report, $row, $sku) {
		$file_rep    = "./uploads/report.tmp";
		$rep = @fopen($file_rep,'a');
		if (!$rep) $rep = @fopen($file_rep,'w+');
		$line =  " Row =~ ".$row." SKU = ".$sku." ".$report. "\n";
		@fputs($rep, $line);
		@fclose($rep);	
	}
	
	public function adderr($err) {
		$file_er    = "./uploads/errors.tmp";
		$er = @fopen($file_er,'a');
		if (!$er) $er = @fopen($file_er,'w+');
		@fputs($er, $err);
		@fclose($er);	
	}
	
	public function addex($st) {
		$file_ex    = "./uploads/ex.xml";		
		$ex = @fopen($file_ex,'a');
		if (!$ex) $ex = @fopen($file_ex,'w+');			
		if (!$ex) return 3;
		@fputs($ex, $st);
		@fclose($ex);		
	}
			
	public function checkurl($url) {	
		$url=trim($url);
		if (strlen($url) < 4) return -1;
		if (!substr_count($url, "/") and (substr_count($url, ".JPG") or substr_count($url, ".jpg") or substr_count($url, ".PNG") or substr_count($url, ".png") or substr_count($url, ".jpeg") or substr_count($url, ".JPEG") or substr_count($url, ".GIF") or substr_count($url, ".gif") or substr_count($url, ".BMP") or substr_count($url, ".bmp"))) return $url;
		if (!(substr_count($url, "http://") or substr_count($url, "https://")) and substr_count($url, "/") and !substr_count($url, "www")) return -1;		
		$url = str_replace("\\" , "/" , $url);		
		if (!substr_count($url,"://")) {
			$a = substr($url, 0, 1);
			if ($a == "/") $url = substr($url, 1);
			$a = substr($url, 0, 1);
			if ($a == "/") $url = substr($url, 1);
			$url = "http://".$url;
		}	
		$url = str_replace("&#45;", "-", $url);
		$url = str_replace("&amp;", "&", $url);
	//	$url = str_replace(" ", "%25%20", $url);
	//	$url = str_replace(" ", "%20", $url);
		$url = trim($url);	
		return $url;
	}
	
	public function StartEx() {
		$st = '<?xml version="1.0"?>'."\n";
		$this->addex($st);
		$st = '<?mso-application progid="Excel.Sheet"?>'."\n";
		$this->addex($st);
		$st = '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"'."\n";
		$this->addex($st);
		$st = 'xmlns:o="urn:schemas-microsoft-com:office:office"'."\n";
		$this->addex($st);
		$st = 'xmlns:x="urn:schemas-microsoft-com:office:excel"'."\n";
		$this->addex($st);
		$st = 'xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"'."\n";
		$this->addex($st);
		$st = 'xmlns:html="http://www.w3.org/TR/REC-html40">'."\n";
		$this->addex($st);
		$st = '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">'."\n";
		$this->addex($st);
		$st = ' <Author>usergio</Author>'."\n";
		$this->addex($st);
		$st = ' <LastAuthor>me</LastAuthor>'."\n";
		$this->addex($st);
		$st = ' <Created>'.date('Y-m-d H:i:s').'</Created>'."\n";
		$this->addex($st);
		$st = ' <LastSaved>'.date('Y-m-d H:i:s').'</LastSaved>'."\n";
		$this->addex($st);
		$st = ' <Company>'.HTTP_CATALOG.'</Company>'."\n";
		$this->addex($st);
		$st = ' <Version>12.00</Version>'."\n";
		$this->addex($st);
		$st = '</DocumentProperties>'."\n";
		$this->addex($st);
		$st = '<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">'."\n";
		$this->addex($st);
		$st = ' <WindowHeight>12396</WindowHeight>'."\n";
		$this->addex($st);
		$st = ' <WindowWidth>23256</WindowWidth>'."\n";
		$this->addex($st);				
		$st = ' <WindowTopX>180</WindowTopX>'."\n";
		$this->addex($st);
		$st = ' <WindowTopY>456</WindowTopY>'."\n";
		$this->addex($st);
		$st = ' <ProtectStructure>False</ProtectStructure>'."\n";
		$this->addex($st);
		$st = ' <ProtectWindows>False</ProtectWindows>'."\n";
		$this->addex($st);
		$st = '</ExcelWorkbook>'."\n";
		$this->addex($st);
		$st = '<Styles>'."\n";
		$this->addex($st);
		$st = ' <Style ss:ID="Default" ss:Name="Normal">'."\n";
		$this->addex($st);
		$st = ' <Alignment ss:Vertical="Bottom"/>'."\n";
		$this->addex($st);
		$st = ' <Borders/>'."\n";
		$this->addex($st);
		$st = ' <Font ss:FontName="Calibri" ss:Size="11"/>'."\n";
		$this->addex($st);
		$st = ' <Interior/>'."\n";
		$this->addex($st);				
		$st = ' <NumberFormat/>'."\n";
		$this->addex($st);
		$st = ' <Protection/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s16">'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="Fixed"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s17">'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="0"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s18">'."\n";
		$this->addex($st);
		$st = ' <Font ss:FontName="Calibri" x:CharSet="204" x:Family="Swiss" ss:Size="11"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s19">'."\n";
		$this->addex($st);
		$st = ' <Font ss:FontName="Calibri" x:CharSet="204" x:Family="Swiss" ss:Size="11"/>'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="0"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s20">'."\n";
		$this->addex($st);
		$st = '<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>'."\n";
		$this->addex($st);
		$st = '<Font ss:FontName="Calibri" x:CharSet="204" x:Family="Swiss" ss:Size="11" ss:Bold="1"/>'."\n";
		$this->addex($st);		
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s21">'."\n";
		$this->addex($st);   
		$st = ' <Font ss:FontName="Calibri" x:CharSet="204" x:Family="Swiss" ss:Size="11"/>'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="0.0000"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s22">'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="0.0000"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s23">'."\n";
		$this->addex($st);
		$st = ' <Font ss:FontName="Calibri" x:CharSet="204" x:Family="Swiss" ss:Size="11"/>'."\n";
		$this->addex($st);
		$st = ' <NumberFormat/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s24">'."\n";
		$this->addex($st);
		$st = ' <NumberFormat/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '<Style ss:ID="s25">'."\n";
		$this->addex($st);
		$st = ' <NumberFormat ss:Format="Standard"/>'."\n";
		$this->addex($st);
		$st = '</Style>'."\n";
		$this->addex($st);
		$st = '</Styles>'."\n";
		$this->addex($st);
		$st = '<Worksheet ss:Name="ERC price">'."\n";
		$this->addex($st);
		$st = '<Table ss:ExpandedColumnCount="47" ss:ExpandedRowCount="1" x:FullColumns="1"'."\n";
		$this->addex($st);
		$st = '           x:FullRows="1" ss:DefaultRowHeight="14">'."\n";
		$this->addex($st);	
	}
	
	public function EndEx($kol_cell) {
		$file_ex  = "./uploads/ex.xml";		
		$ex = @fopen($file_ex,'r');
		$st ='usergio';
		$kol_row = 0;
		while (!@feof($ex)) {
				$st = @fgets($ex, 2048);
				if (substr_count($st, "<Row")) $kol_row++;
			}
		fclose($ex);
		
		$ex = @fopen($file_ex,'r+');
		$st ='usergio';
		while (!@feof($ex) and !substr_count($st, "<Worksheet ss:Name=")) {
				$st = @fgets($ex, 2048);
			}			
		
		if ($kol_row < 1) $kol_row = 1;
		$st = '<Table ss:ExpandedColumnCount="'.$kol_cell.'" ss:ExpandedRowCount="'.$kol_row.'" x:FullColumns="1"'."\n";
		$ste = $st;
		@fputs($ex, $st);
		@fclose($ex);	
		
		$st = '</Table>'."\n";
		$this->addex($st);
		$st = '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">'."\n";
		$this->addex($st);
		$st = '<PageSetup>'."\n";
		$this->addex($st);
		$st = '<Header x:Margin="0.3"/>'."\n";
		$this->addex($st);
		$st = '<Footer x:Margin="0.3"/>'."\n";
		$this->addex($st);
		$st = '<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>'."\n";
		$this->addex($st);
		$st = '</PageSetup>'."\n";
		$this->addex($st);
		$st = '<Print>'."\n";
		$this->addex($st);
		$st = '<ValidPrinterInfo/>'."\n";
		$this->addex($st);
		$st = '<PaperSizeIndex>9</PaperSizeIndex>'."\n";
		$this->addex($st);
		$st = '<HorizontalResolution>600</HorizontalResolution>'."\n";
		$this->addex($st);
		$st = '<VerticalResolution>600</VerticalResolution>'."\n";
		$this->addex($st);
		$st = '</Print>'."\n";
		$this->addex($st);
		$st = '<Selected/>'."\n";
		$this->addex($st);
		$st = '<Panes>'."\n";
		$this->addex($st);
		$st = '<Pane>'."\n";
		$this->addex($st);
		$st = '<Number>3</Number>'."\n";
		$this->addex($st);
		$st = '<ActiveCol>26</ActiveCol>'."\n";
		$this->addex($st);
		$st = '<RangeSelection>R1C27:R22C36</RangeSelection>'."\n";
		$this->addex($st);
		$st = '</Pane>'."\n";
		$this->addex($st);
		$st = '</Panes>'."\n";
		$this->addex($st);
		$st = '<ProtectObjects>False</ProtectObjects>'."\n";
		$this->addex($st);
		$st = '<ProtectScenarios>False</ProtectScenarios>'."\n";
		$this->addex($st);
		$st = '</WorksheetOptions>'."\n";
		$this->addex($st);
		$st = '</Worksheet>'."\n";
		$this->addex($st);
		$st = '<Worksheet ss:Name="Лист1">'."\n";
		$this->addex($st);
		$st = $ste;
		$this->addex($st);
		$st = 'x:FullRows="1" ss:DefaultRowHeight="14.4">'."\n";
		$this->addex($st);
		$st = '</Table>'."\n";
		$this->addex($st);
		$st = '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">'."\n";
		$this->addex($st);
		$st = '<PageSetup>'."\n";
		$this->addex($st);
		$st = '<Header x:Margin="0.3"/>'."\n";
		$this->addex($st);
		$st = '<Footer x:Margin="0.3"/>'."\n";
		$this->addex($st);
		$st = '<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>'."\n";
		$this->addex($st);  
		$st = '</PageSetup>'."\n";
		$this->addex($st);
		$st = '<ProtectObjects>False</ProtectObjects>'."\n";
		$this->addex($st);
		$st = '<ProtectScenarios>False</ProtectScenarios>'."\n";
		$this->addex($st);
		$st = '</WorksheetOptions>'."\n";
		$this->addex($st);
		$st = '</Worksheet>'."\n";
		$this->addex($st);
		$st = '</Workbook>'."\n";
		$this->addex($st);	
	}
	
	public function Competitors($row, $name, $store) {
		$rows = $this->getBasePrice($row['product_id']);
		if (empty($rows)) return;
		$st = '<Row>'."\n";
		$this->addex($st);
		$st = $row['model'];
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $row['sku'];
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $name;
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['bprice'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['bdisc'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($row['price'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['bmin'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['bav'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['bmax'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['optimal'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['market_percent_to_price'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['market_percent_to_bprice'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = round($rows[0]['market_percent_to_bdprice'], 2);
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$rows = $this->getRefSort($row['product_id']);
		if (!empty($rows)) {
			for ($i=0; $i<10; $i++) {
				if (isset($rows[$i]['price'])) $st = round($rows[$i]['price'], 2);
				else $st = '';
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
			}	
		}
		$st = '</Row>'."\n";		
		$this->addex($st);
	}
	
	public function PrintSame($model, $sku1, $sku2, $name1, $name2, $price1, $price2) {
					
		$st = '<Row>'."\n";
		$this->addex($st);
		$st = $model;
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $sku1;
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $sku2;
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $name1;
		$st = strip_tags($st, '<p><em><i><br><li><ul><i><b><strong>');
		$st = htmlspecialchars($st);				
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);			
		$st = $name2;
		$st = strip_tags($st, '<p><em><i><br><li><ul><i><b><strong>');
		$st = htmlspecialchars($st);				
		$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);				
		$st = $price1;
		$st = '<Cell ss:StyleID="s22"><Data ss:Type="Number">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = $price2;
		$st = '<Cell ss:StyleID="s22"><Data ss:Type="Number">'.$st.'</Data></Cell>'."\n";
		$this->addex($st);
		$st = '</Row>'."\n";
		$this->addex($st);	
	}
	
	public function Same($sku, $name, $category_id, $manufacturer_id, $price2, $store) {	
	
		if (empty($name) or empty($sku)) return "";
		if (empty($category_id)) $category_id = 0;
			
		$name2 = str_replace("-", " ", $name);
		$name2 = str_replace("/", " ", $name2);
		$name2 = str_replace("III", "3", $name2);
		$name2 = str_replace("II", "2", $name2);		
		$name2 = str_replace("V", "5", $name2);
		$name2 = str_replace("IV", "4", $name2);
		$name2 = str_replace("(", "", $name2);
		$name2 = str_replace(")", "", $name2);
		$name2 = str_replace("[", "", $name2);
		$name2 = str_replace("]", "", $name2);
		$name2 = strip_tags($name2);
		$ms2 = explode (" ", $name2);	
	
		$rows = $this->getSame($ms2, $manufacturer_id, $category_id, $store);
		
		if (empty($rows)) return "";
			
		foreach ($rows as $r) {			
			$name1 = $r['name'];
			$model = $r['model'];
			$sku1 = $r['sku'];
			$price1 = $r['price'];
			$r['name'] = str_replace("-", " ", $r['name']);
			$r['name'] = str_replace("/", " ", $r['name']);
			$r['name'] = str_replace("III", "3", $r['name']);
			$r['name'] = str_replace("II", "2", $r['name']);			
			$r['name'] = str_replace("V", "5", $r['name']);
			$r['name'] = str_replace("IV", "4", $r['name']);
			$r['name'] = str_replace("(", "", $r['name']);
			$r['name'] = str_replace(")", "", $r['name']);
			$r['name'] = str_replace("[", "", $r['name']);
			$r['name'] = str_replace("]", "", $r['name']);
			$ms1 = explode (" ", $r['name']);
			
			$yes = 0;
			$equal = 0;
			$max1 = count($ms1);
			$max2 = count($ms2);			
			for ($i=0; $i<$max1; $i++) {
				$le = strlen($ms1[$i]);
				$ms1[$i] = strtolower($ms1[$i]);
				for ($j=0; $j<$max2; $j++) {					
					if ($le < 3) continue;
					if (strlen($ms2[$j]) < 3) continue;
					$ms2[$j] = strtolower($ms2[$j]);
	
					if ($ms1[$i] == $ms2[$j] and $le > 5 and preg_match('/^[0-9a-zA-Z-\/]+$/', $ms1[$i]) and !preg_match('/^[0-9]+$/', $ms1[$i]) and !preg_match('/^[a-zA-Z]+$/', $ms1[$i])) {
						$yes = 1;	
					} else {						
						$p = stripos($ms1[$i], $ms2[$j]);
						if ($p === false) $p = stripos($ms2[$j], $ms1[$i]);
						if (!($p === false)) {
							$equal++;	
						}	
					}
				}
			}				
	
			$min = $max1;			
			if ($min > $max2) $min = $max2;				
			$c = $equal/$min;
	
			if (($c > 0.60 and $sku != $sku1) or ($yes and $sku != $sku1)) {
				$this->PrintSame($model, $sku1, $sku, $name1, $name, $price1, $price2);	
			} else {
				if ($sku != $sku1 and !empty($sku1) and !empty($sku)) {
					$s = strtolower($sku);
					$s1 = strtolower($sku1);
					if ((substr_count($sku1, $sku) or substr_count($sku, $sku1)) and abs(strlen($sku)-strlen($sku1)) < 3) {
						$this->PrintSame($model, $sku1, $sku, $name1, $name, $price1, $price2);
	
					}	
				}
			}  
		}	
	}

	public function Action($data, $form_id) {
		
		$rows = $this->getSupplerSEO($form_id);
		
		$seo_data['prod_photo'] = '';
		if (isset($rows[0]['prod_photo']))
		$seo_data['prod_photo'] = $this->symbol($rows[0]['prod_photo']);
		$seo_data['prod_h1'] = '';
		if (isset($rows[0]['prod_h1']))
		$seo_data['prod_h1'] = $this->symbol($rows[0]['prod_h1']);
		$seo_data['prod_title'] = '';
		if (isset($rows[0]['prod_title']))
		$seo_data['prod_title'] = $this->symbol($rows[0]['prod_title']);		
		$seo_data['prod_meta_desc'] = '';
		if (isset($rows[0]['prod_meta_desc']))
		$seo_data['prod_meta_desc'] = $this->symbol($rows[0]['prod_meta_desc']);		
		$seo_data['prod_desc'] = '';
		if (isset($rows[0]['prod_desc']))
		$seo_data['prod_desc'] = $this->symbol($rows[0]['prod_desc']);
		if (isset($rows[0]['prod_keyword']))
		$seo_data['prod_keyword'] = $this->symbol($rows[0]['prod_keyword']);	
		$seo_data['cat_title'] = '';
		if (isset($rows[0]['cat_title']))
		$seo_data['cat_title'] = $this->symbol($rows[0]['cat_title']);		
		$seo_data['cat_meta_desc'] = '';
		if (isset($rows[0]['cat_meta_desc']))
		$seo_data['cat_meta_desc'] = $this->symbol($rows[0]['cat_meta_desc']);		
		$seo_data['cat_desc'] = '';
		if (isset($rows[0]['cat_desc']))
		$seo_data['cat_desc'] = $this->symbol($rows[0]['cat_desc']);		
		$seo_data['manuf_title'] = '';
		if (isset($rows[0]['manuf_title']))
		$seo_data['manuf_title'] = $this->symbol($rows[0]['manuf_title']);		
		$seo_data['manuf_meta_desc'] = '';
		if (isset($rows[0]['manuf_meta_desc']))
		$seo_data['manuf_meta_desc'] = $this->symbol($rows[0]['manuf_meta_desc']);		
		$seo_data['manuf_desc'] = '';
		if (isset($rows[0]['manuf_desc']))
		$seo_data['manuf_desc'] = $this->symbol($rows[0]['manuf_desc']);
		$seo_data['seo_1'] = '';
		if (isset($rows[0]['seo_1']))
		$seo_data['seo_1'] = $this->symbol($rows[0]['seo_1']);
		$seo_data['seo_2'] = '';
		if (isset($rows[0]['seo_2']))
		$seo_data['seo_2'] = $this->symbol($rows[0]['seo_2']);
		$seo_data['seo_3'] = '';
		if (isset($rows[0]['seo_3']))
		$seo_data['seo_3'] = $this->symbol($rows[0]['seo_3']);
		$seo_data['seo_4'] = '';
		if (isset($rows[0]['seo_4']))
		$seo_data['seo_4'] = $this->symbol($rows[0]['seo_4']);
		$seo_data['seo_5'] = '';
		if (isset($rows[0]['seo_5']))
		$seo_data['seo_5'] = $this->symbol($rows[0]['seo_5']);
		$seo_data['seo_6'] = '';
		if (isset($rows[0]['seo_6']))
		$seo_data['seo_6'] = $this->symbol($rows[0]['seo_6']);		
		$seo_data['seo_7'] = '';
		if (isset($rows[0]['seo_7']))
		$seo_data['seo_7'] = $this->symbol($rows[0]['seo_7']);
		$seo_data['seo_8'] = '';
		if (isset($rows[0]['seo_8']))
		$seo_data['seo_8'] = $this->symbol($rows[0]['seo_8']);
		$seo_data['seo_9'] = '';
		if (isset($rows[0]['seo_9']))
		$seo_data['seo_9'] = $this->symbol($rows[0]['seo_9']);
		$seo_data['seo_10'] = '';
		if (isset($rows[0]['seo_10']))
		$seo_data['seo_10'] = $this->symbol($rows[0]['seo_10']);
		$seo_data['seo_11'] = '';
		if (isset($rows[0]['seo_11']))
		$seo_data['seo_11'] = $this->symbol($rows[0]['seo_11']);
		$seo_data['seo_12'] = '';
		if (isset($rows[0]['seo_12']))
		$seo_data['seo_12'] = $this->symbol($rows[0]['seo_12']);		
		$seo_data['seo_13'] = '';
		if (isset($rows[0]['seo_13']))
		$seo_data['seo_13'] = $this->symbol($rows[0]['seo_13']);
		$seo_data['seo_14'] = '';
		if (isset($rows[0]['seo_14']))
		$seo_data['seo_14'] = $this->symbol($rows[0]['seo_14']);
		$seo_data['seo_15'] = '';
		if (isset($rows[0]['seo_15']))
		$seo_data['seo_15'] = $this->symbol($rows[0]['seo_15']);
		$seo_data['seo_16'] = '';
		if (isset($rows[0]['seo_16']))
		$seo_data['seo_16'] = $this->symbol($rows[0]['seo_16']);
		$seo_data['seo_17'] = '';
		if (isset($rows[0]['seo_17']))
		$seo_data['seo_17'] = $this->symbol($rows[0]['seo_17']);		
		$seo_data['seo_18'] = '';
		if (isset($rows[0]['seo_18']))
		$seo_data['seo_18'] = $this->symbol($rows[0]['seo_18']);
		$seo_data['seo_19'] = '';
		if (isset($rows[0]['seo_19']))
		$seo_data['seo_19'] = $this->symbol($rows[0]['seo_19']);
		$seo_data['seo_20'] = '';
		if (isset($rows[0]['seo_20']))
		$seo_data['seo_20'] = $this->symbol($rows[0]['seo_20']);
		
		$rows = $this->getMySuppler($form_id);
		if (empty($rows)) return;
		$id	= $rows[0]['suppler_id'];
		$store = $rows[0]['addattr'];
		$kmenu = $rows[0]['kmenu'];
		$placep = $rows[0]['placep'];
		$disc   = $rows[0]['disc'];
		$onn    = $rows[0]['onn'];
		$cheap  = $rows[0]['cheap'];
		$ratek  = $rows[0]['ratek'];
		$cprice  = $rows[0]['cprice'];
		$zero  = $rows[0]['zero'];
		$onoff  = $rows[0]['onoff'];
		
		$rows  = $this->getSupplerPrice($form_id);
	
		$max_site = 0;
		if ($rows) {			
			foreach ($rows as $value) {								
				$nomkol[$max_site] = $value['nom'];
				$ident[$max_site] = $value['ident'];
				$param[$max_site] = $value['param'];
				$point[$max_site] = $value['point'];
				$noprice[$max_site] = $value['noprice'];
				$paramnp[$max_site] = $value['paramnp'];
				$pointnp[$max_site] = $value['pointnp'];
				$baseprice[$max_site] = $value['baseprice'];				
				$max_site++;
			}	
		}
		
		$rows  = $this->getSupplerData($form_id);		
		$max = 0;
		foreach ($rows as $value) {
			$max++;			
			$mas_catid[$max] = $value['category_id'];
			$pic_int[$max] = trim($value['pic_int']);			
		}
		
		if ($data['command'] == 104) {
			if (!$data['act_filter_group_id']) return 32;			
		}
		
		if ($data['command'] == 105) {
			if (!$data['act_filter_group_id']) return 32;
			if (!$data['act_change'] or !$data['act_find']) return 33;
			$lang = $this->config->get('config_language_id');
			$this->checkFilter($data['act_find'], $data['act_filter_group_id'], $lang, $filter_id);
			$filter_old = $filter_id; 
			if ($filter_id) {
				$this->checkFilter($data['act_change'], $data['act_filter_group_id'], $lang, $filter_id);
				if (!$filter_id) {
					$this->db->query("UPDATE `" . DB_PREFIX . "filter_description` SET `name` = '" . $this->db->escape($data['act_change']) . "' WHERE `filter_id` = '" .(int)$filter_old . "'");
				} else {
					$err =  "Filter " . $data['act_change'] ." already exist " . "  \n";
					$this->adderr($err);
				}	
			}
			return 0;
		}
		
		if ($data['command'] == 87) {
			$this->FixDesCategoryNest($seo_data, $store, $data['act_cat']);
			return 0;
		}
		
		if ($data['command'] == 86) {
			$this->FixDesCategoryOne($seo_data, $store, $data['act_cat']);
			return 0;
		}
		
		if ($data['command'] == 84) {
			$this->FixMetaCategoryNest($seo_data, $store, $data['act_cat']);
			return 0;
		}
		if ($data['command'] == 85) {
			$this->FixMetaCategoryOne($seo_data, $store, $data['act_cat']);
			return 0;
		}		
		if ($data['command'] == 31) {
			$this->FixMetaCategory($seo_data, $store);
			return 0;
		}
		if ($data['command'] == 32) {
			$this->FixMetaManufacturer($seo_data, $store);
			return 0;
		}
		if ($data['command'] == 57) {
			$this->FixURLCategory($seo_data, $store);
			return 0;
		}
		if ($data['command'] == 58) {
			$this->FixURLManufacturer($seo_data, $store);
			return 0;
		}
		
		if ($data['command'] == 49) {
			$this->FixDescCategory($seo_data, $store);
			return 0;
		}
		
		if ($data['command'] == 50) {
			$this->FixDescManufacturer($seo_data, $store);
			return 0;
		}
		
		if ($data['command'] == 52) {
			$this->FillDescCategory($seo_data, $store);
			return 0;
		}
		
		if ($data['command'] == 53) {
			$this->FillDescManufacturer($seo_data, $store);
			return 0;
		}
		
		if ($data['command'] == 64) {
			$this->DoubleAliasCat();
			return 0;
		}
		
		if ($data['command'] == 65) {
			$this->DoubleAliasManuf();
			return 0;
		}		
		
		if (!isset($data['act_attribut'])) $data['act_attribut'] = '';
		if (!isset($data['act_find'])) $data['act_find'] = '';
		if (!isset($data['act_change'])) $data['act_change'] = '';
		
		if ($data['command'] == 61) {
			$find = $data['act_find'];
			$replace = $data['act_change'];
			$find = str_replace('&lt;', '<', $find);
			$find = str_replace('&gt;', '>', $find);
			$find = str_replace('&quot;', '"', $find);
			$find = str_replace('&amp;', '&', $find);
			$replace = str_replace('&lt;', '<', $replace);
			$replace = str_replace('&gt;', '>', $replace);
			$replace = str_replace('&quot;', '"', $replace);
			$replace = str_replace('&amp;', '&', $replace);
			$manufacturer_idF = '';
			$rows = $this->getManufacturerID($find, $store);
			if (!empty($rows)) $manufacturer_idF = $rows[0]['manufacturer_id'];
			$manufacturer_idR = '';
			$rows = $this->getManufacturerID($replace, $store);
			if (!empty($rows)) $manufacturer_idR = $rows[0]['manufacturer_id'];			
		}
		
		$table_sku = "";
		$table_sku = $this->getTable();
		$lang = $this->config->get('config_language_id');

		$path = "./uploads/";		
		if (!is_dir($path)) return 30;

		if ($data['command'] == 47) {
			$row = $this->getMaxAttributeID();
			$max = $row['max(attribute_id)'];			
			
			$file_sos    = "./uploads/sos.tmp";
			$was_timelimit = 0;
			if (!file_exists ($file_sos)) {
				$sos = fopen($file_sos,'w+');
				if (!$sos) { @fclose($sos); return 2;}
				chmod($file_sos, 0777);
				@fclose($sos);
				$pid = 0;				
			} else {			
				$sos = fopen($file_sos,'r+');
				$pid = (int)fgets($sos, 10);
				if (empty($pid)) $pid = 0;
				else $was_timelimit = 1;
				@fclose($sos);
			}
			
			for ($i=$pid; $i<=$max; $i++) {
				$row = $this->isAttribute($i);
				if (!empty($row)) {
					$e = $this->putsos($i, '');
					if ($e < 0) return 2;	
					$rows = $this->isProductByAttribute($i);
					if (empty($rows)) $this->DelAttribute($i);
				}
			}
			if (file_exists($file_sos)) unlink ($file_sos);
		}
		
		if ($data['command'] == 14) {
	
			$row = $this->getMaxAttributeID();
			$max = $row['max(attribute_id)'];
			
			$file_table = "./uploads/attribute.tmp";
			$file_sos    = "./uploads/sos.tmp";
			$was_timelimit = 0;
			if (!file_exists ($file_sos)) {
						
				if (file_exists($file_table)) @unlink ($file_table);				
				
				$i = 1;
				for ($k=1; $k<=$max; $k++) {
					$rows = $this->getAttributeName($k);
					if (!empty($rows)) {					
						$rows = $this->getAttributeID($rows[0]['name']);
						$j=0;
						foreach ($rows as $r) {
							$table[$i][$j] = $r['attribute_id'];
							$j++;
						}
						$i++;	
					}
				}				
				
				$tab = fopen($file_table,'w+b');
				$str_table = serialize($table);
				if (fwrite($tab, $str_table) === false) {
					@fclose($tab);
					return 26;
				}	
				@fclose($tab);

				$sos = fopen($file_sos,'w+');
				if (!$sos) { @fclose($sos); return 2;}
				chmod($file_sos, 0777);
				@fclose($sos);
				$row = $this->getMinID();
				$pid = $row['min(product_id)'];		
			} else {			
				$sos = fopen($file_sos,'r+');
				$pid = (int)fgets($sos, 10);
				if (empty($pid)) {
					$row = $this->getMinID();
					$pid = $row['min(product_id)'];
				} else $was_timelimit = 1;	
				@fclose($sos);
				
				$tab = fopen($file_table,'rb');
				if(!$tab) return 27;
				$table = unserialize(fread($tab, filesize($file_table)));	
				if (empty($table)) return 26;
			}	
			
			$row = $this->getMaxID();
			$max_id = $row['max(product_id)'];		
			for ($k=$pid; $k<=$max_id; $k++) {
				$row  = $this->getProductByIDStore($k, $store);
				if (empty($row)) continue;
					
				$e = $this->putsos($k, '');
				if ($e < 0) return 2;	
				
				$rows = $this->getAttrib($row['product_id']);
				foreach ($rows as $r){			
					for ($i=1; $i<10000; $i++) {
						if (!isset($table[$i][0])) break;
						for ($j=1; $j<10000; $j++) {
							if (!isset($table[$i][$j])) break;							
							if ($r['attribute_id'] == $table[$i][$j]) {						
								if ($table[$i][0] != $r['attribute_id']) {
									$this->changeAttributeId($row['product_id'], $table[$i][0], $r['attribute_id']);								
								}
							}
						}
						for ($j=1; $j<10000; $j++) {
							if (!isset($table[$i][$j])) break;
							if ($table[$i][0] != $table[$i][$j]) $this->DelAttribute($table[$i][$j]);
						}	
					}	
				}				
			}			
			if (file_exists($file_table)) unlink ($file_table);
			if (file_exists($file_sos)) unlink ($file_sos);
			return 0;	
		}
		
		if ($data['command'] == 15) {
		
			$file_con  = "./uploads/conv.xml"; 
			$con = @fopen($file_con,'r');			
			if (!$con) return 25;
						
			$st = '';
			$j = 0;
			$text = array();	
			$mas_con = array();	
			while (!feof($con)) {		
				while (!@feof($con) and !substr_count($st, "<Row")){
					$st = @fgets($con, 4096);
				}	
				if (@feof($con)) break;						
					
				for ($i=1; $i<4; $i++) {
					$m = '';
					while (1) {						
						$st = @fgets($con, 4096);
						$m = $m.$st;
						if (@feof($con)) break;				
						if (substr_count($st, "</Row>"))  break;		
						if (substr_count($st, "<Cell") and substr_count($st, "</Cell")) break;	
											
						$st = @fgets($con, 4096);
						$m = $m.$st;
						if (@feof($con)) break;				
						if (substr_count($st, "</Row>"))  break;
						if (substr_count($st, "</Cell"))  break;
					}
					$posb = stripos($m, "String");	
					
					if (!$posb) break;
					$posb = $posb;
					$posb = stripos($m, ">", $posb)+1;
					$pose = stripos($m, "</Data", $posb);
					if (!$pose) $pose = stripos($m, "</ss:Data", $posb);
		
					if ($pose > $posb) {						
						$len = $pose - $posb;
						$m = substr($m, $posb, $len);
						if ($i < 3) $mas[$i] = $m;
						if ($i == 2) $mas_con[$mas[1]] = $mas[2];
						if ($i == 3) {
							$m = str_replace("&gt;", '>', $m);	
							$m = str_replace("&lt;", '<', $m);
							$m = str_replace("&quot;", '"', $m);
							$m = str_replace("&amp;nbsp;", " ", $m);
							$m = str_replace("&amp;quot;", '"', $m);	
							$m = str_replace("html:", "", $m);						
							$m = str_replace("&#10;", "<br />", $m);
							$m = str_replace("&amp;#xD;&amp;#xA;", "<br />", $m);
							$m = str_replace("&#xD;&#xA;", "<br />", $m);		
							$m = str_replace('Size="8"', 'size="0"', $m);
							$m = str_replace('Size="9"', 'size="0"', $m);
							$m = str_replace('Size="10"', 'size="2"', $m);
							$m = str_replace('Size="11"', 'size="3"', $m);
							$m = str_replace('Size="12"', 'size="3"', $m);
							$text[$j][1] = $mas[2];
							$text[$j][2] = $m;
							$j++;
			
						}			
					} 
				}			
			}
			@fclose($con);	
		}
		$was_timelimit = 0;	
		$file_sos    = "./uploads/sos.tmp"; 
		if (!file_exists ($file_sos)) {
		
			$path = "./uploads/report.tmp";
			if (file_exists($path)) @unlink ($path);
		
			$path = "./uploads/errors.tmp";
			if (file_exists($path)) @unlink ($path);
			
			$path = "./uploads/ex.xml";
			if (file_exists($path) and $data['command'] != 26) @unlink ($path);
		}
		
		if ($data['command'] == 69) {			
			$path = "./uploads/ex.xml";			
			if (!file_exists($path)) {
				$this->StartEx();			
			
				for ($j=0; $j<23; $j++) {
					$st = ' <Column ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
					$this->addex($st);
				}
				$st = '<Row>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product Code</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">SKU</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Base price</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">My margin</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">My price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Min. market price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Aver. market price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Max. market price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Optimal price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Market percent to price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Market percent to base price</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Market percent to base discount price</Data></Cell>'."\n";
				$this->addex($st);
				$rows = $this->getSupplerPriceSort($form_id);
				for ($j=0; $j<10; $j++) {
					$st = '';	
					if (isset($rows[$j]['ident'])) $st = $rows[$j]['ident'];
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">' . $st . '</Data></Cell>'."\n";
					$this->addex($st);
				}
				$st = '</Row>'."\n";
				$this->addex($st);			
			} else {				
				if (isset($was_timelimit) and $was_timelimit) {
					$was_timelimit = 0;
					$file_ex  = "./uploads/ex.xml";		
					$ex = @fopen($file_ex,'r+');					
					$offcet = 0;
					$seek = 0;
					while (!@feof($ex)) {						
						$st = @fgets($ex, 2048);
						$offcet = $offcet + strlen($st);
						if (substr_count($st, "<Row")) $seek = $offcet - strlen($st);
					}
					ftruncate($ex, $seek);	
					@fclose($ex);				
				}				
			}
		}	
		
		if ($data['command'] == 30) {			
			$path = "./uploads/ex.xml";			
			if (!file_exists($path)) {
				$this->StartEx();			
			
				for ($j=0; $j<7; $j++) {
					$st = ' <Column ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
					$this->addex($st);
				}
				$st = '<Row>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Main SKU in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">SKU in Price-list</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name in Store</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name in Price-list</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price in Price-list</Data></Cell>'."\n";
				$this->addex($st);
				$st = '</Row>'."\n";
				$this->addex($st);			
			} else {				
				if (isset($was_timelimit) and $was_timelimit) {
					$was_timelimit = 0;
					$file_ex  = "./uploads/ex.xml";		
					$ex = @fopen($file_ex,'r+');					
					$offcet = 0;
					$seek = 0;
					while (!@feof($ex)) {						
						$st = @fgets($ex, 2048);
						$offcet = $offcet + strlen($st);
						if (substr_count($st, "<Row")) $seek = $offcet - strlen($st);
					}
					ftruncate($ex, $seek);	
					@fclose($ex);				
				}				
			}	
		}

		if 	($data['command'] == 26) {
			$file_ex  = "./uploads/ex.xml";
			if (!file_exists($file_ex)) return 3;
			$ex = @fopen($file_ex,'r');			
			if (!$ex) return 3;		
		
			$st = '';
			while (!@feof($ex) and !substr_count($st, "</Row")) {
				$st = @fgets($ex, 4096);
			}
			$k = -1;
			while (!feof($ex)) {
				$k++;
				while (!@feof($ex) and !substr_count($st, "<Row")) {
					$st = @fgets($ex, 4096);
				}	
				if (@feof($ex)) break;

				for ($j=1; $j<2003; $j++) { $row[$j] = NULL;}	
				$i = -1;
				$br = 0;
				$ext = 1;			
				while ($ext) {			
					$st = @fgets($ex, 4096);
					if (@feof($ex)) break;				
					if (substr_count($st, "</Row>"))  break;
								
					if (!substr_count($st, "<Cell")) {
				
						if (substr_count($st, "</Data")) $pose = strpos($st, "</Data"); 
							else if (substr_count($st, "</ss:Data")) $pose = strpos($st, "</ss:Data"); 
									else $pose = strlen($st) - 1;
						if ($pose and $br) $row[$i] = $row[$i].preg_replace('| +|', ' ', substr($st, 0, $pose));					
						continue;
					
					} else {					
						$i++;
						$p = strpos($st, "Index=");
						if ($p != 0) {							
							$pe = strpos($st, '"', $p+7);
							$ii = substr ($st, $p+7, $pe-$p-7)-1;
							if ($ii>$i) {
								for ($ll=$i; $ll<$ii; $ll++) {
									$masatt[$k][$ll] = '';
								}
								$i = $ii;
							}	
						}
						$br = 0;
						$a = ">";
						$posb1 = strpos($st, "String");
						if ($posb1 === false) $posb1 = 999;
						$posb2 = strpos($st, "Number");
						if ($posb2 === false) $posb2 = 999;
						$posb3 = strpos($st, "HRef=");
						if ($posb3 === false) $posb3 = 999;
						if ($posb1 < $posb2) $posb = $posb1;
						else $posb = $posb2;
						if ($posb3 < $posb) {
							$posb = $posb3;
							$a = '"';						
						}		
						if ($posb != 999)	{					
							$posb = strpos($st, $a , $posb) +1;
							if ($posb < 0) continue;
							$pose = 0;
							if ($a != '"') {						
								if (substr_count($st, "</Data")) $pose = strpos($st, "</Data", $posb); 
								else if (substr_count($st, "</ss:Data")) $pose = strpos($st, "</ss:Data", $posb); 
							} else $pose = strpos($st, $a, $posb); 
							if (!$pose) {
								$br = 1;
								$row[$i] = substr($st, $posb);
								continue;
							}	
							if ($pose and $pose > $posb) {						
								$len = $pose - $posb;
								$row[$i] = substr($st, $posb, $len);		
							} 
						} else continue;
					}
					$masatt[$k][$i] = $row[$i];
				}		
			}	
		}	
		
		if 	($data['command'] == 25) {	
			$file_table = "./uploads/attribute.tmp";
			$path = "./uploads/ex.xml";
			$file_sos = "./uploads/sos.tmp"; 
			if (!file_exists ($file_sos)) {
				if (file_exists($file_table)) unlink ($file_table);
				$tab = fopen($file_table,'w+b');				
				@fclose($tab);
			} else {
				if (!file_exists($file_table)) return 27;
				$tab = fopen($file_table,'rb');
				if(!$tab) return 27;
				$l = filesize($file_table);
				$masatt = unserialize(fread($tab, $l));
				@fclose($tab);
			}	
			if (!file_exists($path)) {			
				$this->StartEx();				
				for ($j=0; $j<2003; $j++) {
					$st = ' <Column ss:AutoFitWidth="0" ss:Width="82"/>'."\n";
					$this->addex($st);
				}
				
				$st = '<Row>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Attribute ID</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Attribute Name</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">New Name</Data></Cell>'."\n";
				$this->addex($st);
			
				for ($j=0; $j<1000; $j++) {
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Attribute Value</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">New Value</Data></Cell>'."\n";
					$this->addex($st);
				}		

				$st = '</Row>'."\n";
				$this->addex($st);
			
			} else {
				if (isset($was_timelimit) and $was_timelimit) {
					$was_timelimit = 0;
					$file_ex  = "./uploads/ex.xml";		
					$ex = @fopen($file_ex,'r+');					
					$offcet = 0;
					$seek = 0;
					while (!@feof($ex)) {						
						$st = @fgets($ex, 2048);
						$offcet = $offcet + strlen($st);
						if (substr_count($st, "<Row")) $seek = $offcet - strlen($st);
					}
					ftruncate($ex, $seek);	
					@fclose($ex);				
				}				
			}
		}
				
		if 	($data['command'] == 12 or $data['command'] == 88) {
			if ($data['command'] == 88) {
				$rows = $this->getAllAttr();
				for ($i=0; $i<10000; $i++) {
					if (!isset($rows[$i]['attribute_id'])) break;
					$sort_att[$i] = $rows[$i]['attribute_id'];
				}
				unset($rows);
				$sk = $i;
				$max_a = $i+3;
			} else $max_a = 200;
			
				$max_att = abs($max_a/2);
				$nf = 12;
			
				$rows = $this->getOptions();
				$max_options = 0;				
				foreach ($rows as $value) {
					$max_options++;
					$allOptions[$max_options] = $value['option_id'];
					}
				$max_opt7 = $max_options*7;
				
				$path = "./uploads/ex.xml";
				if (!file_exists($path)) {
					$this->StartEx();				
				
					for ($j=1; $j<20; $j++) {
						$st = ' <Column ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
						$this->addex($st);
					}
				
					$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
					$this->addex($st);				
				
					for ($j=1; $j<=$nf; $j++) {
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
						$this->addex($st);
					}				
				
					for ($j=1; $j<12; $j++) {
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
						$this->addex($st);
					}
					
					for ($j=1; $j<18; $j++) {
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="82"/>'."\n";
						$this->addex($st);
					}
					
					for ($j=1; $j<11; $j++) {
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
						$this->addex($st);
					}
					
					$rows = $this->getOptions();
					$max_options = 0;				
					foreach ($rows as $value) {
						$max_options++;
						$allOptions[$max_options] = $value['option_id'];
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="82"/>'."\n";
						$this->addex($st);
					}
						
					for ($j=1; $j<=$max_a; $j++) {
						$st = ' <Column ss:StyleID="s16" ss:AutoFitWidth="0" ss:Width="82"/>'."\n";
						$this->addex($st);
					}
				
					$st = '<Row>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Sort Order</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product Code</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Main SKU</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">UPC</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">EAN</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">JAN</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">ISBN</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">MPN</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Location</Data></Cell>'."\n";
					$this->addex($st);					
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Category</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Parent Category</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Parent Category</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Parent Category</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Parent Category</Data></Cell>'."\n";
					$this->addex($st);					
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Quantity</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Special Price</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Description</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Main photo</Data></Cell>'."\n";
					$this->addex($st);
				
					
					for ($j=1; $j<=$nf; $j++) {
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
					}
				
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Manufacturer</Data></Cell>'."\n";
					$this->addex($st);				
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Weight</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Length</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Width</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Height</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">HTML-tag H1</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">HTML-tag Title</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Meta-tag Keywords</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Meta-tag Description</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Tags</Data></Cell>'."\n";
					$this->addex($st);	
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">URL</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo for Category</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo for Parentcategory</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo for Parentcategory</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo for Parentcategory</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo for Parentcategory</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Related products</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount1</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount2</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount3</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount4</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount5</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Discount6</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product Bonus</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Bonus1</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Bonus2</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Bonus3</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Bonus4</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Bonus5</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Competitor1</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Link1</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Competitor2</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Link2</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Competitor3</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Link3</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Competitor4</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Link4</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Competitor5</Data></Cell>'."\n";
					$this->addex($st);
					$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Link5</Data></Cell>'."\n";
					$this->addex($st);				
					
					for ($j=1; $j<=$max_options; $j++) {					
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">OPTION'.$j.'-&gt;</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">SKU'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Quantity'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Add to price'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Points'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Weight'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Photo'.$j.'</Data></Cell>'."\n";
						$this->addex($st);
					}				
				
					$text = "Attribute Name";
					if ($data['command'] == 88) $text = "Attribute Value";
				
					for ($j=1; $j<=$max_att; $j++) {						
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">'.$text.'</Data></Cell>'."\n";
						$this->addex($st);
						$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Attribute Value</Data></Cell>'."\n";
						$this->addex($st);
					}
				
					$st = '</Row>'."\n";
					$this->addex($st);
				} 
		}
		$was_timelimit = 0;
		$file_sos    = "./uploads/sos.tmp";
		if (file_exists ($file_sos)) {
			$sos = @fopen($file_sos,'r+');
			$pid = (int)fgets($sos, 10);
			if (empty($pid)) {
				$row = $this->getMinID();
				$pid = $row['min(product_id)']-1;
			} else $was_timelimit = 1;
			@fclose($sos);
		} else {
			$sos = @fopen($file_sos,'w+');
			if (!$sos) { @fclose($sos); return 2;}
			chmod($file_sos, 0777);
			$row = $this->getMinID();
			$pid = $row['min(product_id)']-1;		
		}	
	
		$pid++;	
		
		$row = $this->getMaxID();
		$max_id = $row['max(product_id)'];
		
		for ($i=$pid; $i<=$max_id; $i++) {	
			$row  = $this->getProductByIDStore($i, $store);			
			if (empty($row)) continue;		
			
			if (!isset($time_limit) or ((isset($time_limit) and $time_limit != 2.71828))) {
				$rows1 = $this->getSupplerSEO($form_id);
				$time_limit = 2.71828;	
		
				$seo_data['prod_photo'] = '';
				if (isset($rows1[0]['prod_photo']))
				$seo_data['prod_photo'] = $this->symbol($rows1[0]['prod_photo']);
				$seo_data['prod_h1'] = '';
				if (isset($rows1[0]['prod_h1']))
				$seo_data['prod_h1'] = $this->symbol($rows1[0]['prod_h1']);
				$seo_data['prod_title'] = '';
				if (isset($rows1[0]['prod_title']))
				$seo_data['prod_title'] = $this->symbol($rows1[0]['prod_title']);		
				$seo_data['prod_meta_desc'] = '';
				if (isset($rows1[0]['prod_meta_desc']))
				$seo_data['prod_meta_desc'] = $this->symbol($rows1[0]['prod_meta_desc']);		
				$seo_data['prod_desc'] = '';
				if (isset($rows1[0]['prod_desc']))
				$seo_data['prod_desc'] = $this->symbol($rows1[0]['prod_desc']);
				if (isset($rows1[0]['prod_keyword']))
				$seo_data['prod_keyword'] = $this->symbol($rows1[0]['prod_keyword']);	
				$seo_data['cat_title'] = '';
				if (isset($rows1[0]['cat_title']))
				$seo_data['cat_title'] = $this->symbol($rows1[0]['cat_title']);		
				$seo_data['cat_meta_desc'] = '';
				if (isset($rows1[0]['cat_meta_desc']))
				$seo_data['cat_meta_desc'] = $this->symbol($rows1[0]['cat_meta_desc']);		
				$seo_data['cat_desc'] = '';
				if (isset($rows1[0]['cat_desc']))
				$seo_data['cat_desc'] = $this->symbol($rows1[0]['cat_desc']);		
				$seo_data['manuf_title'] = '';
				if (isset($rows1[0]['manuf_title']))
				$seo_data['manuf_title'] = $this->symbol($rows1[0]['manuf_title']);		
				$seo_data['manuf_meta_desc'] = '';
				if (isset($rows1[0]['manuf_meta_desc']))
				$seo_data['manuf_meta_desc'] = $this->symbol($rows1[0]['manuf_meta_desc']);		
				$seo_data['manuf_desc'] = '';
				if (isset($rows1[0]['manuf_desc']))
				$seo_data['manuf_desc'] = $this->symbol($rows1[0]['manuf_desc']);
				$seo_data['seo_1'] = '';
				if (isset($rows1[0]['seo_1']))
				$seo_data['seo_1'] = $this->symbol($rows1[0]['seo_1']);
				$seo_data['seo_2'] = '';
				if (isset($rows1[0]['seo_2']))
				$seo_data['seo_2'] = $this->symbol($rows1[0]['seo_2']);
				$seo_data['seo_3'] = '';
				if (isset($rows1[0]['seo_3']))
				$seo_data['seo_3'] = $this->symbol($rows1[0]['seo_3']);
				$seo_data['seo_4'] = '';
				if (isset($rows1[0]['seo_4']))
				$seo_data['seo_4'] = $this->symbol($rows1[0]['seo_4']);
				$seo_data['seo_5'] = '';
				if (isset($rows1[0]['seo_5']))
				$seo_data['seo_5'] = $this->symbol($rows1[0]['seo_5']);
				$seo_data['seo_6'] = '';	
				if (isset($rows1[0]['seo_6']))
				$seo_data['seo_6'] = $this->symbol($rows1[0]['seo_6']);
				$seo_data['seo_7'] = '';
				if (isset($rows1[0]['seo_7']))
				$seo_data['seo_7'] = $this->symbol($rows1[0]['seo_7']);
				$seo_data['seo_8'] = '';
				if (isset($rows1[0]['seo_8']))
				$seo_data['seo_8'] = $this->symbol($rows1[0]['seo_8']);
				$seo_data['seo_9'] = '';
				if (isset($rows1[0]['seo_9']))
				$seo_data['seo_9'] = $this->symbol($rows1[0]['seo_9']);
				$seo_data['seo_10'] = '';
				if (isset($rows1[0]['seo_10']))
				$seo_data['seo_10'] = $this->symbol($rows1[0]['seo_10']);
				$seo_data['seo_11'] = '';
				if (isset($rows1[0]['seo_11']))
				$seo_data['seo_11'] = $this->symbol($rows1[0]['seo_11']);
				$seo_data['seo_12'] = '';
				if (isset($rows1[0]['seo_12']))
				$seo_data['seo_12'] = $this->symbol($rows1[0]['seo_12']);		
				$seo_data['seo_13'] = '';
				if (isset($rows1[0]['seo_13']))
				$seo_data['seo_13'] = $this->symbol($rows1[0]['seo_13']);
				$seo_data['seo_14'] = '';
				if (isset($rows1[0]['seo_14']))
				$seo_data['seo_14'] = $this->symbol($rows1[0]['seo_14']);
				$seo_data['seo_15'] = '';
				if (isset($rows1[0]['seo_15']))
				$seo_data['seo_15'] = $this->symbol($rows1[0]['seo_15']);
				$seo_data['seo_16'] = '';
				if (isset($rows1[0]['seo_16']))
				$seo_data['seo_16'] = $this->symbol($rows1[0]['seo_16']);
				$seo_data['seo_17'] = '';
				if (isset($rows1[0]['seo_17']))
				$seo_data['seo_17'] = $this->symbol($rows1[0]['seo_17']);		
				$seo_data['seo_18'] = '';
				if (isset($rows1[0]['seo_18']))
				$seo_data['seo_18'] = $this->symbol($rows1[0]['seo_18']);
				$seo_data['seo_19'] = '';
				if (isset($rows1[0]['seo_19']))
				$seo_data['seo_19'] = $this->symbol($rows1[0]['seo_19']);
				$seo_data['seo_20'] = '';
				if (isset($rows1[0]['seo_20']))
				$seo_data['seo_20'] = $this->symbol($rows1[0]['seo_20']);
		
				$rows1 = $this->getMySuppler($form_id);
				if (empty($rows1)) return;
				$id	= $rows1[0]['suppler_id'];
				$store = $rows1[0]['addattr'];
				$kmenu = $rows1[0]['kmenu'];
				$placep = $rows1[0]['placep'];
				$disc   = $rows1[0]['disc'];
				$onn    = $rows1[0]['onn'];
				$cheap  = $rows1[0]['cheap'];
				$ratek  = $rows1[0]['ratek'];
				$cprice  = $rows1[0]['cprice'];
				$zero  = $rows1[0]['zero'];
				$onoff  = $rows1[0]['onoff'];
				$sleep  = $rows1[0]['sleep'];
				$ffile  = $rows1[0]['ffile'];
		
				$rows1  = $this->getSupplerPrice($form_id);
	
				$max_site = 0;
				if ($rows1) {			
					foreach ($rows1 as $value) {								
						$nomkol[$max_site] = $value['nom'];
						$ident[$max_site] = $value['ident'];
						$param[$max_site] = $value['param'];
						$point[$max_site] = $value['point'];
						$noprice[$max_site] = $value['noprice'];
						$paramnp[$max_site] = $value['paramnp'];
						$pointnp[$max_site] = $value['pointnp'];
						$baseprice[$max_site] = $value['baseprice'];				
						$max_site++;
					}	
				}
			}	
			
			$p = strpos($row['model'], "-");
			if (!$p) $p = strpos($row['model'], "~");
			
			if (!$data['cod-id']) { 
				if ((preg_match('/^[0-9-~]+$/', $row['model']) and !substr_count($row['model'], 'Series') and $p > 0) or 
					(substr_count($row['model'], 'Series') and $p > 0)) {				
					$sup = substr($row['model'], $p+1, 2);
					$number = substr($row['model'], 0, $p);
					
					if (!empty ($data['cod_from']) and (int)$data['cod_from'] > (int)$number) continue;
					if (!empty ($data['cod_to']) and (int)$data['cod_to'] < (int)$number) continue;
					if ((int)$data['all'] == 0 and $id != (int)$sup) continue;				
				} else { 
					if ((int)$data['all'] == 0) continue;
					if (!empty ($data['cod_from']) or !empty ($data['cod_to'])) continue;				
				}
			} else {
				if ((preg_match('/^[0-9-~]+$/', $row['model']) and !substr_count($row['model'], 'Series') and $p > 0) or 
					(substr_count($row['model'], 'Series') and $p > 0)) {				
					$sup = substr($row['model'], $p+1, 2);
					$number = substr($row['model'], 0, $p);
		
					if (!empty ($data['cod_from']) and (int)$data['cod_from'] > (int)$row['product_id']) continue;
					if (!empty ($data['cod_to']) and (int)$data['cod_to'] < (int)$row['product_id']) continue;
					if ((int)$data['all'] == 0 and $id != (int)$sup) continue;				
				} else { 
					if ((int)$data['all'] == 0) continue;
					if (!empty ($data['cod_from']) or !empty ($data['cod_to'])) continue;				
				}
			}
				
			if (!empty ($data['price_from']) and (float)$data['price_from'] > (float)$row['price']) continue;
			if (!empty ($data['price_to']) and (float)$data['price_to'] < (float)$row['price']) continue;
	
			if (!isset($row) or !isset($row['date_modified']) or !isset($row['price']) or 
				!isset($row['stock_status_id']) or !isset($row['quantity']) or !isset($row['manufacturer_id']) or 
				!isset($row['status'])) continue;
		
			if (!empty($data['act_cat'])) {			
				$rows = $this->getProductCategory($row['product_id']);				
				$j = 0;
				foreach ($rows as $cat) {
					for ($l=0; $l<2000; $l++) {
						if (!isset($data['act_cat'][$l])) break;
						if ($cat['category_id'] == (int)$data['act_cat'][$l]) {
							$j++;
							break;
						}
					}
					if ($j) break;
				}				
				if ($j == 0) continue;
			}	
			
			if (!empty($data['act_manuf']) and ((int)$row['manufacturer_id'] != (int)$data['act_manuf'])) continue;	
		
			$y1 = (int)substr($data['filter_date_start'], 0, 4);
			$m1 = (int)substr($data['filter_date_start'], 5, 2);
			$d1 = (int)substr($data['filter_date_start'], 8, 2);
			$y2 = (int)substr($data['filter_date_end'], 0, 4);
			$m2 = (int)substr($data['filter_date_end'], 5, 2);
			$d2 = (int)substr($data['filter_date_end'], 8, 2);
	
			if ($data['up-add'] == '0') {
				$y = (int)substr($row['date_modified'], 0, 4);
				$m = (int)substr($row['date_modified'], 5, 2);
				$d = (int)substr($row['date_modified'], 8, 2);
			} else {
				$y = (int)substr($row['date_added'], 0, 4);
				$m = (int)substr($row['date_added'], 5, 2);
				$d = (int)substr($row['date_added'], 8, 2);
			}	
			$t1 = mktime(0, 0, 0, $m1, $d1, $y1);
			$t2 = mktime(0, 0, 0, $m2, $d2, $y2);
			$t = mktime(0, 0, 0, $m, $d, $y);	
		
			if (($t<$t1 or $t>$t2) and ($data['filter_date_start'] != '0000-00-00' or $data['filter_date_end'] != '0000-00-00')) continue;	
  
			if ($data['isno'] == 1 and $row['quantity'] > 0) continue;
			if ($data['isno'] == 2 and $row['quantity'] == 0) continue;
			
			if ($data['offproduct'] == 1 and $row['status'] == 0) continue;
			if ($data['offproduct'] == 2 and $row['status'] == 1) continue;			
			if ($data['descr']) {
				$rows = $this->getProductDesc($row['product_id']);
				if ($data['descr'] == 1 and empty($rows[0]['description'])) continue;
				if ($data['descr'] == 2 and !empty($rows[0]['description'])) continue;
			}
	
			if ($data['act_attribut'] and !$data['act_noattribut']) {
				$finds = explode("|", $data['act_attribut']);
				$f = 0;
				for ($ii=0; $ii<500; $ii++) {
					if (!isset($finds[$ii])) break;
					$rows = $this->getAttributeID($finds[$ii]);
					if (empty($rows)) continue;
					$rows = $this->getAttributeById($row['product_id'], $rows[0]['attribute_id'], $lang);
					if (empty($rows)) continue;
					else {
						$f = 1;
						break;
					}
				}
				if (!$f) continue;
			}
	
			if ($data['act_noattribut'] and !$data['act_attribut']) {
				$finds = explode("|", $data['act_noattribut']);
				$f = 0;
				for ($ii=0; $ii<500; $ii++) {
					if (!isset($finds[$ii])) break;
					$rows = $this->getAttributeID($finds[$ii]);
					if (!empty($rows)) { 
						$rows = $this->getAttributeById($row['product_id'], $rows[0]['attribute_id'], $lang);
						if (!empty($rows)) {
							$f = 0;
							break;
						} else {
							$f = 1;
							continue;
						}
					}	
				}		
				if (!$f) continue;
			}
	
			if ($data['act_noattribut'] and $data['act_attribut'] and $data['act_attribut'] != $data['act_noattribut']) {
				$rows = $this->getAttributeID($data['act_attribut']);
				if (empty($rows)) continue;
				$rows = $this->getAttributeById($row['product_id'], $rows[0]['attribute_id'], $lang);
				if (empty($rows)) continue;
				
				$rows = $this->getAttributeID($data['act_noattribut']);
				if (!empty($rows)) { 
					$rows = $this->getAttributeById($row['product_id'], $rows[0]['attribute_id'], $lang);
					if (!empty($rows)) continue;
				}
			}
	
			if ($data['act_inattribut'] or $data['act_isvalue']) {
				if ($data['act_inattribut'] and !$data['act_isvalue']) continue;
				if ($data['act_inattribut'] and $data['act_isvalue']) {
					$rows = $this->getAttributeID($data['act_inattribut']);
					if (empty($rows)) continue;	
					$rows = $this->getAttributeById($row['product_id'], $rows[0]['attribute_id'], $lang);
					if (empty($rows)) continue;
					$finds = explode("|", $data['act_isvalue']);
					$f = 0;
					for ($ii=0; $ii<500; $ii++) {
						if (!isset($finds[$ii])) break;
						if ($rows[0]['text'] != $finds[$ii]) continue;	
						else {
							$f = 1;
							break;
						}	
					}
					if (!$f) continue;						
				} else {
					$rows = $this->getAttrib($row['product_id']);
					if (empty($rows)) continue;
					$finds = explode("|", $data['act_isvalue']);
					$f = 0;
					for ($j=0; $j<200; $j++) {
						if (!isset($rows[$j]['attribute_id'])) break;
						for ($ii=0; $ii<500; $ii++) {
							if (!isset($finds[$ii])) break;
							if ($rows[$j]['text'] == $finds[$ii]) {
								$f = 1;
								break;
							} else continue;	
						} if ($f) break;
					}
					if (!$f) continue;				
				}
			}
	
			if ($data['isattribute']) {
				$rows = $this->getAttrib($row['product_id']);
				if ($data['isattribute'] == 1 and empty($rows)) continue;
				if ($data['isattribute'] == 2 and !empty($rows)) continue;
			}
			
			if ($data['isoptions']) {
				$rows = $this->isProductOption($row['product_id']);
				if ($data['isoptions'] == 1 and empty($rows)) continue;
				if ($data['isoptions'] == 2 and !empty($rows)) continue;
			}
			
			if ($data['act_sname']) {						
				$rows = $this->getProductDesc($row['product_id']);
				if (empty($rows)) return;
				$finds = explode("|", $data['act_sname']);
				$f = 0;
				for ($ii=0; $ii<500; $ii++) {
					if (!isset($finds[$ii])) break;						
					if (!substr_count($rows[0]['name'], $finds[$ii])) continue;
					else {
						$f = 1;
						break;
					}	
				}
				if (!$f) continue;				
			}
			
			if ($data['act_sdesc']) {						
				$rows = $this->getProductDesc($row['product_id']);
				if (empty($rows)) return;
				$finds = explode("|", $data['act_sdesc']);
				$f = 0;
				for ($ii=0; $ii<500; $ii++) {
					if (!isset($finds[$ii])) break;						
					if (!substr_count($rows[0]['description'], $finds[$ii])) continue;
					else {
						$f = 1;
						break;
					}	
				}
				if (!$f) continue;
			}
			
			switch ($data['command']) {
				case 1: 		
					if (empty($data['act_find']) or !preg_match('/^[0-9.,]+$/', $data['act_find'])) return;
					$data['act_find'] = str_replace(',', '.', $data['act_find']);
					$row['price'] = $row['price'] * $data['act_find'];
					$this->upProduct($row);				
					break;
				case 2: 
					$row['stock_status_id']	= $data['act_find'];
					$this->upProduct($row);
					break;
				case 3: $row['stock_status_id']	= 6;
					$this->upProduct($row);
					break;
				case 4: $row['stock_status_id']	= 8;
					$this->upProduct($row);
					break;
				case 5: $row['stock_status_id']	= 5;
					$this->upProduct($row);
					break;
				case 6: $n = (int)$data['act_find'];
					$row['quantity']	= $n;
					if (!$n) $row['sort_order'] = 100;
					$this->upProduct($row);
					break;
				case 7: if (!$data['zact_cat']) return;	
					$this->toCategory($row['product_id'], $data['zact_cat']);				
					break;	
				case 8: $this->setCategory($row['product_id'], $data['act_cat']);			
					break;	
				case 9: $row['status']	= 1;
					$this->upProduct($row);
					break;
				case 10: $row['status']	= 0;
					$this->upProduct($row);
					break;
				case 11: $this->deleteProduct($row['product_id']);
					break;		
				case 13: $n = (int)$data['act_find'];
					$row['price'] = round($row['price'], $n);
					$this->upProduct($row);
					$rows = $this->getProductAllOptionValue($row['product_id']);
					if (!empty($rows)) {
						for ($l=0; $l<500; $l++) {
							if (!isset($rows[$l]['product_option_value_id'])) break;
							$p = round($rows[$l]['price'], $n);
							$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET `price` = '" . $p. "' WHERE `product_option_value_id` = '" . $rows[$l]['product_option_value_id'] . "'");
						}
					}	
					break;				
				case 15: $this->Convert($row['product_id'], $mas_con, $text);		
					break;				
				case 16: $this->DoubleFoto($row);		
					break;
				case 17: $this->FixMetaProduct($store, $row, $seo_data);
					break;					
				case 18: $this->CreateSkuTable($row, $store);
					break;				
				case 19: $this->deleteProductWithoutAttribute($row['product_id']);
					break;	
				case 20: $this->findreplaceAttribute($row['product_id'], $data['act_attribut'], $data['act_find'], $data['act_change']);
				 $this->cache->delete('product');
					break;
				case 21: $this->findreplaceDescription($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 22: $this->shipping($row['product_id']);
					break;
				case 23: $this->noshipping($row['product_id']);
					break;
				case 24: $this->findreplaceName($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 25: $this->exportAtt($row['product_id'], $masatt);
					break;
				case 26: $err = $this->importAtt($row['product_id'], $masatt);					
					break;
				case 27: $err = $this->DeletePhoto($row['product_id']);					
					break;
				case 28: $this->addPrefix($row, $data['act_find'], $data['act_change'], $store);					
					break;
				case 29: $this->printSkuLibrary($row, $store);					
					break;
				case 30:
					$category_id = 0;
					$rows = $this->getProductCategory($row['product_id']);
					if (!empty($rows)) $category_id = $rows[0]['category_id'];
					$name = '';
					$rows = $this->getProductDesc($row['product_id']);
					if (!empty($rows)) $name = $rows[0]['name'];
				    $this->Same($row['sku'], $name, $category_id, $row['manufacturer_id'], $row['price'], $store);		
					break;
				case 33:
					$err = $this->DeleteSpecialPrice($row['product_id']);					
					break;	
				case 34: $this->FixProductURL($row);
					break;
				case 35: $this->findreplaceTitle($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 36: $this->findreplaceH1($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 37: $this->findreplaceMetaDesc($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 38: $this->sortPhoto($row['product_id']);		
					break;
				case 39: $this->shortDescription($row['product_id'], $data['act_find'], $data['act_change']);
				    break;
				case 40: $this->minimum($row['product_id'], $data['act_find'], $data['act_change']);
				    break;
				case 41: $this->redirect($row['product_id'], $data['act_find'], $data['act_change']);
				    break;
				case 42: $this->DeleteDefaultFoto($row, $data['act_find']);
				    break;
				case 43: $this->fillURL($row);
				    break;
				case 44: $this->copyModel($row);
				    break;
				case 45: $this->fillMetaProduct($store, $row, $seo_data);
				    break;
				case 46: $this->tax($row['product_id'], $data['act_find']);
				    break;
				case 48: $this->weight($row['product_id'], $data['act_find']);
				    break;
				case 51: $this->fillDescProduct($store, $row, $seo_data);
					break;
				case 54: $this->fixDescProduct($store, $row, $seo_data);
					break;
				case 55: $this->copyToParent($store, $row);
					break;
				case 56: $this->changeAttribute($store, $row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 59: $this->onlyMain($store, $row);				
					break;
				case 60: $this->MainAndParents($store, $row);
					break;
				case 61: $this->changeManufacturer($row, $manufacturer_idF, $manufacturer_idR);
					break;
				case 62: $this->deleteProductWithPhoto($row);
					break;	
				case 63: $this->PrintDublAliasProducts($row['product_id']);
					break;
				case 66: $this->updatePrice($row, $cheap, $kmenu, $disc, $onn, $placep, $ratek, $cprice, $zero, $max_site, $nomkol, $ident, $param, $point, $noprice, $paramnp, $pointnp, $baseprice, $onoff, $sleep, $ffile);				
					break;
				case 67: $this->PrintDublNameProducts($row);			
					break;
				case 68: if (!$data['zact_cat']) return;	
					$this->notCategory($row['product_id'], $data['zact_cat']);					
					break;
				case 69:					
					$name = '';
					$rows = $this->getProductDesc($row['product_id']);
					if (!empty($rows)) $name = $rows[0]['name'];
				    $this->Competitors($row, $name, $store);		
					break;
				case 70: 	
					$this->RenameFoto($row, $seo_data['prod_photo'], $store);				
					break;
				case 71: 	
					$this->deleteWholesale($row['product_id']);				
					break;
				case 72: 	
					$this->deleteEmptyPhoto($row);				
					break;
				case 73: 	
					$n = (int)$data['act_find'];
					$row['sort_order']	= $n;
					$this->upProduct($row);				
					break;
				case 74: 	
					$n = $data['act_find']+ 1.1 - 1.1;
					$row['price']	= round($n, 2);
					$this->upProduct($row);				
					break;
				case 75: 	
					$this->percentAction($row, $data['act_find'], $data['act_change']);				
					break;	
				case 76: 	
					$this->percentWhole($row, $data['act_find'], $data['act_change']);			
					break;
				case 77:
					$this->renameFolder($row, $data['act_find'], $data['act_change']);					
					break;
				case 78:
					$this->changeQuantity($row, $data['act_find'], $data['act_change']);					
					break;
				case 79:
					$this->FindReplaceOption($row, $data['act_find'], $data['act_change']);					
					break;
				case 80:
					$this->FindReplaceURL($row, $data['act_find'], $data['act_change']);					
					break;
				case 81: $this->offNoPhoto($row);
					break;	
				case 82: $this->Design($row['product_id'], $data['act_find'], $store);
					break;
				case 83: $this->MultOption($row['product_id'], $data['act_find']);
					break;
				case 89: $this->ResetQuantityOption($row['product_id']);
					break;	
				case 90: $this->deletePhotoIfProductGone($row);
					break; 
				case 91: $this->FixDublAliasProducts($row['product_id']);
					break;
				case 92: $this->PicData($row, $mas_catid, $pic_int);
					break;
				case 93: $this->copySku_Loc($row);
					break;
				case 94: $this->copyLoc_Sku($row);
					break;
				case 95: $this->copyModel_Loc($row);
					break;	
				case 96: $this->copyUpc_Loc($row);
					break;
				case 97: $this->copyLoc_Upc($row);
					break;	
				case 98: $this->copyMpn_Loc($row);
					break;
				case 99: $this->copyLoc_Mpn($row);
					break;
				case 100: $this->copyAttr_SKU($row['product_id'], $data['act_find']);
					break;
				case 101: if (empty($data['act_find']) or !preg_match('/^[0-9.,]+$/', $data['act_find'])) return;
					$data['act_find'] = str_replace(',', '.', $data['act_find']);
					$row['price'] = $row['price'] + $data['act_find'];
					$this->upProduct($row);				
					break;
				case 102: $this->findreplaceKeywords($row['product_id'], $data['act_find'], $data['act_change']);
					break;
				case 103: $n = (int)$data['act_find'];
					$row['price'] = round($row['price']/$n, 0)*$n;
					$this->upProduct($row);
					$rows = $this->getProductAllOptionValue($row['product_id']);
					if (!empty($rows)) {
						for ($l=0; $l<500; $l++) {
							if (!isset($rows[$l]['product_option_value_id'])) break;
							$p = round($rows[$l]['price']/$n, 0)*$n;
							$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET `price` = '" . $p. "' WHERE `product_option_value_id` = '" . $rows[$l]['product_option_value_id'] . "'");
						}
					}	
					break;				
				case 104: $this->deleteProductFilter($row['product_id'], $data['act_find'], $data['act_filter_group_id']);				
					break;
				case 106: $this->copyAttr_UPC($row['product_id'], $data['act_find']);
					break;
				case 107: $this->copyAttr_MPN($row['product_id'], $data['act_find']);
					break;
				case 108: $this->copyAttr_JAN($row['product_id'], $data['act_find']);
					break;
				case 109: $this->deleteProductOption($row['product_id']);
					break;
				case 110: $this->countOptionQuantity($row['product_id']);
					break;
				case 111: $this->countOptionPrices($row['product_id']);
					break;
				case 112: $this->attributeToTags($row['product_id']);
					break;
				case 113: $this->setOptionRequired($row['product_id'], $data['act_find']);
					break;
				case 114: $this->_setOptionRequired($row['product_id'], $data['act_find']);
					break;	
			}		
			
			if 	($data['command'] == 12 or $data['command'] == 88) {
				$product_id = $row['product_id'];
				$manufacturer_id = $row['manufacturer_id'];
				
				$rows = $this->getProductDesc($product_id);
				if (empty($rows)) continue;	
				$desc = $rows;
				
				if (isset($was_timelimit) and $was_timelimit) {
					$was_timelimit = 0;
					$file_ex  = "./uploads/ex.xml";		
					$ex = @fopen($file_ex,'r+');					
					$offcet = 0;
					$seek = 0;
					while (!@feof($ex)) {						
						$st = @fgets($ex, 2048);
						$offcet = $offcet + strlen($st);
						if (substr_count($st, "<Row")) $seek = $offcet - strlen($st);
					}
					ftruncate($ex, $seek);	
					@fclose($ex);				
				}
				
				$st = '<Row>'."\n";
				$this->addex($st);
			
				$st = '';
				if ($row['sort_order']) $st = $row['sort_order'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if ($row['model']) {
					$st = $row['model'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if ($row['sku']) $st = $row['sku'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if ($row['upc']) $st = $row['upc'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';				
				if (isset($row['ean']) and $row['ean']) $st = $row['ean'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if (isset($row['jan']) and $row['jan']) $st = $row['jan'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if (isset($row['isbn']) and $row['isbn']) $st = $row['isbn'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';				
				if (isset($row['mpn']) and $row['mpn']) $st = $row['mpn'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '';
				if ($row['location']) {
					$st = $row['location'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}	
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				$description = $rows[0]['description'];
				$st = '';
				if (isset($rows[0]['name'])) {
					$st = $rows[0]['name'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);				
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
					
				}	
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
	
				$rows = $this->getProductCategory($product_id);
				$child = 0;
				for ($j=0; $j<10; $j++) {					
					if (!isset($rows[$j]['category_id'])) continue;
					else if ((int)$rows[$j]['category_id'] > $child) $child = $rows[$j]['category_id'];					
				}					
				if ($child) {
					$pach[0] = $child;
					for ($j=1; $j<5; $j++) {					
						$rows1 = $this->getCategory($child);
						if (empty($rows1)) break;
						$pach[$j] = $rows1[0]['parent_id'];
						$child = $pach[$j];					
					}	
				}
		
				for ($j=0; $j<5; $j++) {
					$st = '';
					if (isset($pach[$j])) {
						$rows = $this->getCategoryName($pach[$j]);						
						if (!empty($rows)) $st = $rows[0]['name'];
					}	
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
				}	
				
				$st = '';
				if (isset($row['quantity'])) $st = $row['quantity'];
				$st = '<Cell ss:StyleID="s21"><Data ss:Type="Number">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($row['price'])) $st = $row['price'];
				$st = '<Cell ss:StyleID="s22"><Data ss:Type="Number">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$image = '';
				if (isset($row['image'])) $image = $row['image'];
				$weight = '';
				if (isset($row['weight'])) $weight = $row['weight'];
				$length = '';
				if (isset($row['length'])) $length = $row['length'];
				$width = '';
				if (isset($row['width'])) $width = $row['width'];
				$height = '';
				if (isset($row['height'])) $height = $row['height'];
				
				$spec = '';
				$row = $this->getActionPrice($product_id, 1);
				if (isset($row) and !empty($row)) $spec = $row['price'];
				
				$st = '<Cell ss:StyleID="s22"><Data ss:Type="Number">'.$spec.'</Data></Cell>'."\n";
				$this->addex($st);					
				
				$st = $description;
				$st = str_replace("<", "&lt;", $st);
				$st = str_replace(">", "&gt;", $st);				
				$st = str_replace("&nbsp;", " ", $st);
				$st = str_replace("& ", "&amp;", $st);
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);				
				
				$st = $image;
				$st = '<Cell ss:StyleID="s18"><Data ss:Type="String">'.HTTP_CATALOG."image/".$st.'</Data></Cell>'."\n";
				$this->addex($st);
								
				$rows = $this->getProductImage($product_id);
				for ($j=0; $j<$nf; $j++) {
					$st = '';
					if (isset($rows[$j]['image'])) {
						$st = $rows[$j]['image'];				
						$st = '<Cell ss:StyleID="s18"><Data ss:Type="String">'.HTTP_CATALOG.'image/'.$st.'</Data></Cell>'."\n";
					} else $st = '<Cell ss:StyleID="s18"><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";	
					$this->addex($st);
				}				
				
				if (!empty($data['act_manuf'])) $manufacturer_id = $data['act_manuf'];
				
				$rows = $this->getManufacturerName($manufacturer_id);
				$st = '';
				if (isset($rows[0]['name'])) {
					$st = $rows[0]['name'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);

				$st = '<Cell ss:StyleID="s21"><Data ss:Type="Number">'.$weight.'</Data></Cell>'."\n";
				$this->addex($st);			
				
				$st = '<Cell ss:StyleID="s21"><Data ss:Type="Number">'.$length.'</Data></Cell>'."\n";
				$this->addex($st);			
				
				$st = '<Cell ss:StyleID="s21"><Data ss:Type="Number">'.$width.'</Data></Cell>'."\n";
				$this->addex($st);				
				
				$st = '<Cell ss:StyleID="s21"><Data ss:Type="Number">'.$height.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($desc[0]['seo_h1'])) {
					$st = $desc[0]['seo_h1'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($desc[0]['seo_title'])) {
					$st = $desc[0]['seo_title'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($desc[0]['meta_keyword'])) {
					$st = $desc[0]['meta_keyword'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($desc[0]['meta_description'])) {
					$st = $desc[0]['meta_description'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				$st = '';
				if (isset($desc[0]['tag'])) {
					$st = $desc[0]['tag'];
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);

				$row1 = $this->getURL($product_id);
				
				$st = '';
				if (!empty($row1)) $st = $row1['keyword'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				for ($j=0; $j<5; $j++) {
					$st = '';
					if (isset($pach[$j])) {
						$rows = $this->getCategoryPhoto($pach[$j]);						
						if (!empty($rows)) {
							$st = $rows[0]['image'];
							$st = str_replace("data/", "", $st);
						}
					}	
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
				}
				
				$st = '';
				$rows = $this->getRalatedAll($product_id);
				if (!empty($rows)) {					
					foreach ($rows as $r) {
						$rows1 = $this->getProductsByID($r['related_id']);
						$st = $st.$rows1[0]['sku'].";";					
					}		
				}
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);

				for ($j=1; $j<7; $j++) {
					$st = '';
					$rows = $this->getProductDiscount($product_id, $j);
					if (!empty($rows)) $st = $rows[0]['price'];
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
				}				
				
				$st = '';
				$rows = $this->getProductsByID($product_id);
				if (!empty($rows)) $st = $rows[0]['points'];
				$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
				$this->addex($st);
				
				for ($j=1; $j<6; $j++) {
					$st = '';
					$rows = $this->getBonus1($j, $product_id);
					if (!empty($rows)) $st = $rows[0]['points'];
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
				}
				
				$rows = $this->getLink($product_id);
				for ($j=0; $j<5; $j++) {
					$st = '';
					if (isset($rows[$j]['ident']) and !empty($rows[$j]['ident'])) $st = $rows[$j]['ident'];
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					$st = '';
					if (isset($rows[$j]['url']) and !empty($rows[$j]['url'])) $st = $rows[$j]['url'];
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
				}
				
				for ($j=1; $j<=$max_options; $j++) {
					$rows = $this->getProdOptions($product_id, $allOptions[$j]);					
					$prod = $rows;					
					
					$st = '';
					foreach ($prod as $one) {
						$rows = $this->getNameOption($one['option_value_id']);	
						if (empty($rows)) $st = $st . ';';
						else $st = $st . $rows[0]['name'].';';
					}
					$st = str_replace("<", "&lt;", $st);
					$st = str_replace(">", "&gt;", $st);
					$st = str_replace("&nbsp;", " ", $st);
					$st = str_replace("& ", "&amp;", $st);
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {	
						if (empty($one['optsku'])) $st = $st . ';';
						else $st = $st . $one['optsku'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {
						if (empty($one['quantity'])) $st = $st . ';';
						else $st = $st . $one['quantity'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {
						if (empty($one['price'])) $st = $st . ';';
						else $st = $st . $one['price'].$one['price_prefix'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {
						if (empty($one['points'])) $st = $st . ';';
						else $st = $st . $one['points'].$one['points_prefix'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {
						if (empty($one['weight'])) $st = $st . ';';
						else $st = $st . $one['weight'].$one['weight_prefix'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);
					
					$st = '';
					foreach ($prod as $one) {
						$rows = $this->getPhotoOption($one['option_value_id']);	
						if (!isset($rows[0]['image']) or empty($rows[0]['image'])) $st = $st . ';';
						else $st = $st.HTTP_CATALOG."image/".$rows[0]['image'].';';
					}					
					$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
					$this->addex($st);				
				}
				
				if ($data['command'] == 88) {
					$nb = 60 + $nf + $max_opt7;					
					$rows = $this->getAttributes($product_id);
					for ($j=0; $j<$max_a; $j++) {
						$mid = ceil($sk/2);
						$h = $sk;
						$e = $sk;
						$st = '';
						$name = "";						
						$f = 0;
						$b = 0;						
						if (!empty($rows[$j]['text']) and $rows[$j]['attribute_id']) {
							if ($mid > 100) {
								for ($l=0; $l<10; $l++) {
									if ($rows[$j]['attribute_id'] > $sort_att[$mid]) {
										$mid = ceil(($h - $mid)/2);
										$b = $mid;
										$e = $h;
									}	
									if ($rows[$j]['attribute_id'] < $sort_att[$mid]) {
										$h = $mid;
										$mid = ceil($mid/2);
										$b = 0;
										$e = $mid;
									}
								}	
							}								
							for ($k=$b; $k<$e; $k++ ) {								
								if ($sort_att[$k] == $rows[$j]['attribute_id']) {
									$f = 1;
									break;
								}	
							}
		
							if ($f) {
								$nk = $nb + $k;
								$rows1 = $this->getAttributeName($rows[$j]['attribute_id']);
								if (isset($rows1[0]['name'])) $name = $rows1[0]['name'];							
								if ($data['act_attribut'] and $data['act_noattribut'] and $data['act_attribut'] == $data['act_noattribut']) {
									if ($data['act_noattribut'] == $name) {
										$st = $rows[$j]['text'];
										$st = str_replace("<", "&lt;", $st);
										$st = str_replace(">", "&gt;", $st);
										$st = str_replace("&nbsp;", " ", $st);
										$st = str_replace("& ", "&amp;", $st);
										$st = '<Cell ss:Index="' . $nk . '" ss:StyleID="s20"><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
										$this->addex($st);									
									}	
								} else {
									$st = $rows[$j]['text'];
									$st = str_replace("<", "&lt;", $st);
									$st = str_replace(">", "&gt;", $st);
									$st = str_replace("&nbsp;", " ", $st);
									$st = str_replace("& ", "&amp;", $st);
									$st = '<Cell ss:Index="' . $nk . '" ss:StyleID="s20"><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
									$this->addex($st);								
								}							
							}
						}	
					}
				} else {
					$rows = $this->getAttributes($product_id);
					for ($j=0; $j<$max_att; $j++) {
						$st = '';
						$name = "";					
						if (isset($rows[$j]['text']) and isset($rows[$j]['attribute_id'])) {
							$rows1 = $this->getAttributeName($rows[$j]['attribute_id']);
							if (isset($rows1[0]['name'])) $name = $rows1[0]['name'];
							$st = $name;
							if ($data['act_attribut'] and $data['act_noattribut'] and $data['act_attribut'] == $data['act_noattribut']) {
								if ($data['act_noattribut'] == $name) {
									$st = str_replace("<", "&lt;", $st);
									$st = str_replace(">", "&gt;", $st);
									$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
									$this->addex($st);
									$st = $rows[$j]['text'];
									$st = str_replace("<", "&lt;", $st);
									$st = str_replace(">", "&gt;", $st);
									$st = str_replace("&nbsp;", " ", $st);
									$st = str_replace("& ", "&amp;", $st);
									$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
									$this->addex($st);
								}	
							} else {
								$st = str_replace("<", "&lt;", $st);
								$st = str_replace(">", "&gt;", $st);
								$st = str_replace("&nbsp;", " ", $st);
								$st = str_replace("& ", "&amp;", $st);
								$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
								$this->addex($st);
								$st = $rows[$j]['text'];
								$st = str_replace("<", "&lt;", $st);
								$st = str_replace(">", "&gt;", $st);
								$st = str_replace("&nbsp;", " ", $st);
								$st = str_replace("& ", "&amp;", $st);
								$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
								$this->addex($st);
							}	
						} else {
							$st = str_replace("<", "&lt;", $st);
							$st = str_replace(">", "&gt;", $st);
							$st = str_replace("&nbsp;", " ", $st);
							$st = str_replace("& ", "&amp;", $st);
							$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
							$this->addex($st);
							$st = '';
							$st = '<Cell><Data ss:Type="String">'.$st.'</Data></Cell>'."\n";
							$this->addex($st);
						}	
					}	
				}
				
				$st = '</Row>'."\n";
				$this->addex($st);				
			}

			if 	($data['command'] == 25) {
				$file_table = "./uploads/attribute.tmp";
				$file_table1 = "./uploads/attribute1.tmp";
				$tab1 = fopen($file_table1,'w+b');
				$str_table1 = serialize($masatt);
				$b = fwrite($tab1, $str_table1);
				@fclose($tab1);				
				$a = @copy($file_table1, $file_table);
				if ($a) @unlink ($file_table1);
			}			
			$e = $this->putsos($i, '');
			if ($e < 0) return 2;
		}
		$this->cache->delete('*');
		
		if 	($data['command'] == 77) return 31;
		
		if 	($data['command'] == 12 or $data['command'] == 88) {
			$kol_cell = 60 + $nf + $max_a + $max_opt7;	
			$this->EndEx($kol_cell);			
		}
		
		if 	($data['command'] == 29) {			
			$this->EndEx(5);			
		}
		
		if 	($data['command'] == 30) {			
			$this->EndEx(7);			
		}
		
		if 	($data['command'] == 69) {			
			$this->EndEx(23);			
		}
		
		if 	($data['command'] == 25) {
			$file_table = "./uploads/attribute.tmp";
			$tab = fopen($file_table,'rb');
			if(!$tab) return 27;
			$l = filesize($file_table);
			$masatt = unserialize(fread($tab, $l));
			@fclose($tab);
			for ($k=0; $k<5000; $k++) {
				if (!isset($masatt[$k][0])) break;
				$st = '<Row>'."\n";
				$this->addex($st);
				for ($j=0; $j<2; $j++) {
					if (!isset($masatt[$k][$j])) break;						
					$st = '<Cell><Data ss:Type="String">'.$masatt[$k][$j].'</Data></Cell>'."\n";
					$this->addex($st);
				}				
				for ($j=2; $j<1000; $j++) {
					if (!isset($masatt[$k][$j])) break;
					$st = '<Cell><Data ss:Type="String">'."".'</Data></Cell>'."\n";
					$this->addex($st);
					$st = '<Cell><Data ss:Type="String">'.$masatt[$k][$j].'</Data></Cell>'."\n";
					$this->addex($st);
					
				}
				$st = '<Cell><Data ss:Type="String">'."".'</Data></Cell>'."\n";
				$this->addex($st);
				$st = '</Row>'."\n";
				$this->addex($st);	
			}		
		
			$kol_cell = 2003;
			$this->EndEx($kol_cell);			
		}
		$path = "./uploads/sos.tmp";
		$file_table = "./uploads/attribute.tmp";
		if (file_exists($path)) @unlink ($path);		
		if (file_exists($file_table)) @unlink ($file_table);
		return 0;	
	}
	
	function getHead(&$url) {
		$ch = curl_init();	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
		// допустимый заголовок HTTP Referer:
	//	curl_setopt ($ch, CURLOPT_REFERER, 'https://'.$url.'/index.php');
		// сохранять информацию Cookie в файл
	//	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		// не проверять SSL сертификат
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// не проверять Host SSL сертификата
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$headers = array (
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
			'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
			'Accept-Encoding: identity',
			'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
		); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	//	curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');
	//	curl_setopt($ch, CURLOPT_COOKIE, "uid=CmZNYVVnEMgyumFPA8CtAg==;ps_gch=4775889975433905152;HISTORY_UNAUTH_SESSION=true;ps_bch=204722949377770117;cuts=0;parent_reqid_seq=0c9e0ed831c1a622f74daf2d9fcebf67%2Cf0a88ed04886cd1e86dddad55e410ed3%2C68ac3d89771ac3f7a73957b2a7274fe6%2Ca4c9fe6b086bfeb040c1449b618b14fa%2C6753f02b117836f05d2f91db70089d4e;yandexmarket=10,UAH,1,,,,2,0,0");
	
		$head = curl_exec($ch);
		if($head === false) {
			$s=curl_error($ch);	
			$err = " curl error head = " . $s ." \n";
			$this->adderr($err);
			
		}	
		curl_close($ch);	
		return $head; 		
	}	
	
	function getBody($url) {
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
		// допустимый заголовок HTTP Referer:
	//	curl_setopt ($ch, CURLOPT_REFERER, 'https://'.$url.'/index.php');
		// сохранять информацию Cookie в файл
	//	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		// не проверять SSL сертификат
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// не проверять Host SSL сертификата
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$headers = array (
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
			'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
			'Accept-Encoding: identity',
			'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
		); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
	//	curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');
	//	curl_setopt($ch, CURLOPT_COOKIE, "uid=CmZNYVVnEMgyumFPA8CtAg==;ps_gch=4775889975433905152;HISTORY_UNAUTH_SESSION=true;ps_bch=204722949377770117;cuts=0;parent_reqid_seq=0c9e0ed831c1a622f74daf2d9fcebf67%2Cf0a88ed04886cd1e86dddad55e410ed3%2C68ac3d89771ac3f7a73957b2a7274fe6%2Ca4c9fe6b086bfeb040c1449b618b14fa%2C6753f02b117836f05d2f91db70089d4e;yandexmarket=10,UAH,1,,,,2,0,0");
	
		$body = curl_exec($ch);
		if($body === false) {
			$s=curl_error($ch);	
			$err = " curl body error = " . $s ." \n";
			$this->adderr($err);
			
		}
		curl_close($ch);		
		return $body; 		
	}
	
	function getRef($head, $url) {
		$new_url = 0;
		$p = stripos($head, "location:");
		if (!$p) {
			$p = strpos($head, "src");
			if (!$p) $p = strpos($head, "href");
			if (!$p) return 0;
			$a = strpos($head, '"', $p)+1;			
			$b = strpos($head, '"', $p+9);
			$p = $b - $a;
			$new_url = substr($head, $a, $p);			
		} else {
			$pb = $p + 10;
			$pe = strpos($head, "\r\n", $pb);
			if (!$pe) return 0;
			$p = $pe - $pb;
			$new_url = substr($head, $pb, $p);
		}	
		if ($new_url) {
			if (!substr_count($new_url, "://")) {							
				$pe = strpos($url, "//");
				if ($pe) $pe = $pe + 2;
				$pe = strpos($url, "/", $pe);
				$a = substr($url, 0, $pe);							
				if (substr($new_url, 0 ,1) != "/") $new_url = '/'.$new_url;
				$new_url = $a.$new_url;
				$new_url = str_replace ("../", "", $new_url);
				$new_url = str_replace ("./", "", $new_url);
			} else {
				$pe = strpos($new_url, "//");
				if ($pe) $pe = $pe + 2;
				$pe = strpos($new_url, "/", $pe);
				if (substr($new_url, $pe+1, 1) == ".") {
					$new_url = str_replace ("../", "", $new_url);
					$new_url = str_replace ("./", "", $new_url);
				}
			}
		}
		
		return $new_url;
	}
	
	function getCode($head) {		
		$s = substr($head, 0, 64);
		$ms = explode (" ", $s);
		if (!isset($ms[1])) return "dupa";
		if ($ms[1] == "200") return "OK";
		if ($ms[1] < "300" or $ms[1] > "399") return "dupa";	
		
		return "redirect";
	}
	
	function getContents(&$url) { 
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7");
		// допустимый заголовок HTTP Referer:
	//	curl_setopt ($ch, CURLOPT_REFERER, 'https://'.$url.'/index.php');
		// сохранять информацию Cookie в файл
	//	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		// не проверять SSL сертификат
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// не проверять Host SSL сертификата
	//	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$headers = array (
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8',
			'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
			'Accept-Encoding: identity',
			'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
		); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers); 
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_NOBODY, false);
	//	curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');
	//	curl_setopt($ch, CURLOPT_COOKIE, "uid=CmZNYVVnEMgyumFPA8CtAg==;ps_gch=4775889975433905152;HISTORY_UNAUTH_SESSION=true;ps_bch=204722949377770117;cuts=0;parent_reqid_seq=0c9e0ed831c1a622f74daf2d9fcebf67%2Cf0a88ed04886cd1e86dddad55e410ed3%2C68ac3d89771ac3f7a73957b2a7274fe6%2Ca4c9fe6b086bfeb040c1449b618b14fa%2C6753f02b117836f05d2f91db70089d4e;yandexmarket=10,UAH,1,,,,2,0,0");
	
		$out = curl_exec($ch);
		
		if($out === false) {
			$s=curl_error($ch);	
			$err = " curl contens error = " . $s ." \n";
			$this->adderr($err);	
		}
		curl_close($ch);
		return $out; 		
	}	
	
	function curl_get_contents(&$url, $pi, $sleep, $ffile) {			
		$body = '';	
		$url = $this->checkurl($url);	
		if ($url == -1) return $body;
	
		if ($sleep and !$ffile) sleep(3);  // пауза перед парсингом 3 сек
		
		if ($ffile and !$pi) {			
			$p = strrpos($url, "?");
			if (!$p) $p = strrpos($url, "/");
			$name = substr($url, $p+1);
			$p = strrpos($name, ".");
			if ($p) $name = substr($name, 0, $p);
			$name = trim($name);
        
			$file_s    = "./uploads/".$name;
			if (file_exists ($file_s)) {
				$st ='';
				$s = @fopen($file_s,'r');
				while (!@feof($s)) {
					$f = @fgets($s, 4096);
					$st = $st.$f;
				}    
				@fclose($s);
				$ht = $st;
			} else {
				$err = " file error = " . $file_s ." \n";
				$this->adderr($err);
				$err = $url ." \n";
				$this->adderr($err);
			}    
			return $ht;
		}
	
		if ($pi) {
			if (strlen($url) < 25) {
				$err = " The Link on photo is too short \n";
				$this->adderr($err);
				return '';
			}
	/* заменить в ссылке на фото слово john на sam	*/	
	 $url = str_replace ("john", "sam", $url);
	 
			$body = @file_get_contents($url);
			if (!$body) {
				$err = " Can not get photo whith 'file_get_contents' function : " . $url . "\n I'll try get photo whith CURL \n";
				$this->adderr($err);				
			}			
			if ($this->isPicture($body)) return $body;
		}
		
		for ($r=0; $r<3; $r++) {
			$head = $this->getHead($url);
			if ($head === false) {
				$body = $this->getContents($url);					
				break;
			}

			$code = $this->getCode($head);
		
			if ($code == "dupa") {
				$body = $this->getContents($url);
				break;
			}
		
			if ($code == "OK") {
				$body = $this->getBody($url);	
				if (!$pi) break;	
				if ($this->isPicture($body)) break;				
			}	
			$ref = '';
			$body = '';
			$ref = $this->getRef($head, $url);   // если неправильный редирект, закомментируйте эту строку		
			if (!$ref) {
				$body = $this->getContents($url);
				break;
			}
	
			if ($ref) $url = $ref;	
		}
		if (empty($body)) return '';	
		$charset = '';
		$fl = 0;
		$p = stripos($body, "charset=");
		if ($p) $charset = substr($body, $p+8, 80);		
		if (!empty($charset) and (substr_count($charset, "1251") or (substr_count($charset, "utf-8") and !$this->detect_utf($body)))) {
			$fl = 1;	
			$body = $this->win_to_utf($body);
		}
		
		if (!$pi and !$this->detect_utf($body)) $body = $this->win_to_utf($body);
	
		return $body;
	}

	function isPicture($pic) {
		$beg = substr($pic, 0, 3);
		$a = 0;
		if (ord($beg[0]) == 0x47 && ord($beg[1]) == 0x49 && ord($beg[2]) == 0x46) $a = 1;
		if (ord($beg[0]) == 0xff && ord($beg[1]) == 0xd8 && ord($beg[2]) == 0xff) $a = 1;
		if (ord($beg[0]) == 0x89 && ord($beg[1]) == 0x50 && ord($beg[2]) == 0x4e) $a = 1;
					
		return $a;		
	}	
	
	
	function detect_utf($string) {
        return preg_match('%(?:
        [\xC2-\xDF][\x80-\xBF]    
        |\xE0[\xA0-\xBF][\x80-\xBF]  
        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
        |\xED[\x80-\x9F][\x80-\xBF] 
        |\xF0[\x90-\xBF][\x80-\xBF]{2}
        |[\xF1-\xF3][\x80-\xBF]{3}
        |\xF4[\x80-\x8F][\x80-\xBF]{2}
        )+%xs', $string);
	}
	
	function win_to_utf($s) {
		$t ='';
		for($i=0, $m=strlen($s); $i<$m; $i++)    {
			$c=ord($s[$i]);
			if ($c<=127) {$t.=chr($c); continue; }
			if ($c>=192 && $c<=207) {$t.=chr(208).chr($c-48); continue; }
			if ($c>=208 && $c<=239) {$t.=chr(208).chr($c-48); continue; }
			if ($c>=240 && $c<=255) {$t.=chr(209).chr($c-112); continue; }
			if ($c==184) { $t.=chr(209).chr(145); continue; }; // ё
			if ($c==168) { $t.=chr(208).chr(129); continue; }; // Ё
			if ($c==179) { $t.=chr(209).chr(150); continue; }; // і
			if ($c==178) { $t.=chr(208).chr(134); continue; }; // І
			if ($c==191) { $t.=chr(209).chr(151); continue; }; // ї
			if ($c==175) { $t.=chr(208).chr(135); continue; }; // ї
			if ($c==186) { $t.=chr(209).chr(148); continue; }; // є
			if ($c==170) { $t.=chr(208).chr(132); continue; }; // Є
			if ($c==180) { $t.=chr(210).chr(145); continue; }; // ґ
			if ($c==165) { $t.=chr(210).chr(144); continue; }; // Ґ
			if ($c==250) { $t.=chr(208).chr(170); continue; }; // ъ			
			
		}
		return $t;
	}

	public function ParsOptions($ht, $key1, $point, $key2, &$maso, &$masp) {		
		if (!empty($point)) {
			$point = str_replace('&quot;', '"',$point);
			$point = str_replace('&lt;', '<',$point);
			$point = str_replace('&gt;', '>',$point);
			$point = str_replace('&amp;', '&',$point);
		}
		if (!empty($key1) and strlen($ht) > 500) {
			$key1 = str_replace('&quot;', '"',$key1);
			$key1 = str_replace('&lt;', '<',$key1);
			$key1 = str_replace('&gt;', '>',$key1);
			$key1 = str_replace('&amp;', '&',$key1);
		
			if (!empty($key2)) {
				$key2 = str_replace('&quot;', '"',$key2);
				$key2 = str_replace('&lt;', '<',$key2);
				$key2 = str_replace('&gt;', '>',$key2);
				$key2 = str_replace('&amp;', '&',$key2);
			}
			$k1 = 0;
			$k2 = 0;
			$lk10 = 0;
			$lk11 = 0;
			$lk20 = 0;
			$lk21 = 0;
			$k1 = explode(",", $key1);
			if (!empty($key2) and !preg_match('/^[0-9]+$/', $key2)) $k2 = explode(",", $key2);
			if ((empty($k1[0]) or empty($k1[1])) or ($k2 and (empty($k2[0]) or empty($k2[1])))) {
				$err = " Option keyword error \n";
				$this->adderr($err);
				return;
			}			
			$lk10 = strlen($k1[0]);
			$lk11 = strlen($k1[1]);
			if ($k2) {
				$lk20 = strlen($k2[0]);
				$lk21 = strlen($k2[1]);
			}
			
			if (!empty($point))	$points = explode(",", $point);
			
			$posb = 0;
			$pose = 0;
			$h = $ht;
			if (!empty($points[0]))	{
				$posb = strpos($ht, $points[0]);				
				if (!$posb) return;
			}
			if (!empty($points[1]))	{
				$pose = strpos($ht, $points[1], $posb);
				$h = substr($ht, $posb-1, $pose-$posb);
			} else $h = substr($ht, $posb-1);
			$lim = strlen($h);
			
			$posa = 0;
			$posp = 0;
			$i = 0;	
			
			while ($posa < $lim-5) {
				$posa = stripos($h, $k1[0], $posa);	
				if (!$posa) break;					
				$posa = $posa + $lk10;		
				$pe = stripos($h, $k1[1], $posa);						
				if (!$pe) break;						
				$le = $pe - $posa;
				$a = substr($h, $posa, $le);	
				$a = strip_tags($a);						
				$a = $this->litteras($a);
				$a = str_replace('&amp;', '&',$a);
				$a = $this->symbol($a);
				$a = trim($a);
				$maso[$i] = $a;
				$posa = $pe + $lk11;
	
				$masp[$i] = '';
				if ($k2) {
					$posp = stripos($h, $k2[0], $posp);
					if (!$posp) continue;
					$posp = $posp + $lk20;		
					$pe = stripos($h, $k2[1], $posp);						
					if (!$pe) continue;						
					$le = $pe - $posp;
					$a = substr($h, $posp, $le);
					$a = strip_tags($a);
					$a = preg_replace('/[^0-9.,+-]/','',$a);
					$a = str_replace(',', '.',$a);
					$a = trim($a);					
					$masp[$i] = $a;
				}
				$i++;
			}	
					
		}	
	}	
	
	public function ParsAttribute($ht, $key, $point, &$text) {
		$text = '';
	
		if (!empty($point)) {
			$point = str_replace('&quot;', '"',$point);
			$point = str_replace('&lt;', '<',$point);
			$point = str_replace('&gt;', '>',$point);
			$point = str_replace('&amp;', '&',$point);
		}	
		
		if (!empty($key) and strlen($ht) > 500) {
	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1]) or empty($k[2])) {
				$err = " Attribute keyword error \n";
				$this->adderr($err);
				return $text;
			}			
			$lk0 = strlen($k[0]);
			$lk1 = strlen($k[1]);
			$lk2 = strlen($k[2]);
			$lk3 = 0;
			if (isset($k[3]) and !empty($k[3])) $lk3 = strlen($k[3]);
			
			if (!empty($point))	$points = explode(",", $point);
			
			$pos = 0;			
			if (!empty($points[0]))	{
				$pos = strpos($ht, $points[0]);				
				if (!$pos) return;
			}
			$pos = stripos($ht, $k[0], $pos);			
			
			if ($pos) {
				$lim = 35000;
				$l = 35000;
				if (!empty($points[1])) {
					$p = strpos($ht, $points[1], $pos);
					if ($p) {
						$l = $p - $pos;
						$lim = $p;
					}	
				}	
				$h = substr($ht, $pos-1, $l);
					
				$posa = 0;
				$i = 0;				
				while ($posa < $lim-500) {						
					$posa = stripos($h, $k[0], $posa);
					if ($posa) {						
						$posa = $posa + $lk0;		
						$pe = stripos($h, $k[1], $posa);						
						if (!$pe) break;						
						$le = $pe - $posa;
						$a = substr($h, $posa, $le);
						$a = strip_tags($a);						
						$a = $this->litteras($a);
						$a = str_replace('&amp;', '&',$a);
						$a = $this->symbol($a);
						$a = trim($a);
						$posa = $pe + $lk1;
						
						if (!$lk3) $posv = $posa;		
						else $posv = stripos($h, $k[2], $posa);
						if ($posv) {
							if ($lk3) {
								$posv = $posv + $lk2;								
								$pe = stripos($h, $k[3], $posv);
							} else $pe = stripos($h, $k[2], $posv);						
							$le = $pe - $posv;						
							$v = substr($h, $posv, $le);
							$v = $this->symbol($v);
							$v = $this->litteras($v);							
							$v = trim($v);
	
							if ($v) {
								$text[$i]['name'] = $a;
								$v = str_replace("<ul><li>", "", $v);
								$v = str_replace("</li><li>", ", ", $v);
								$v = str_replace('&nbsp;', '',$v);
								$v = str_replace('&amp;', '&',$v);							
								$text[$i]['val'] = strip_tags($v, '<em><i><b><strong>');								
								$i++;			
							}	
						} else break;
						$posa = $pe+$lk2;						
	
					} else break;
				}
			}	
		}
		return;
	}

	public function Parsing($ht, $k, $point, $place) {	
		$pointe = '';			
		if (!empty($point)) {
			$point = str_replace('&quot;', '"',$point);
			$point = str_replace('&lt;', '<',$point);
			$point = str_replace('&gt;', '>',$point);
			$point = str_replace('&amp;', '&',$point);
			$pointe = '';
			$mp = explode(",", $point);
			if (isset($mp[0]) and !empty($mp[0])) $point = $mp[0];
			if (!empty($mp[0]) and isset($mp[2]) and !empty($mp[2])) $point = $point . ',' . $mp[2];
			if (isset($mp[1]) and !empty($mp[1])) $pointe = $mp[1];
		}
	
		$text = '';
		$lk0 = strlen($k[0]);
		$num = 1;
		if (!empty($place) and $place > 0 and preg_match('/^[0-9]+$/', $place)) $num = $place;	
	
		$pos = 0;
		$back = 0;
		$posf = 0;	
		
		if (!empty($point)) {
			$nn = strlen($point) - 2;
			if ($nn > 0) {
				$a = substr($point, $nn);
				if ($a == ",<") {
					$back = 1;
					$point = substr($point, 0, $nn);
				}	
				$pos = stripos($ht, $point);	
				if (!$pos) return $text;
			}	
		}
	
		if ($pointe) $posf = stripos($ht, $pointe, $pos);
	
		if (!$back) {
			for ($j=1; $j<= $num; $j++) {
				$pos = stripos($ht, $k[0], $pos+1);				
				if (!$pos) break;					
			}			
		} else {			
			$h = $ht;
			for ($j=1; $j<= $num; $j++) {				
				$h = substr($h, 0, $pos);
				$pos = strrpos($h, $k[0]);
				$pos--;	
				if (!$pos) return $text;		
			}	
			$pos++;
		}		
	
		if ($pos) {
			$posa = $pos + $lk0;	
			if ($posf) {	
				if ($posa > $posf) return $text;
			}
			$pose = stripos($ht, $k[1], $posa);

			if (isset($k[2]) and !empty($k[2])) {
				while(1) {
					$p = stripos($ht, $k[2], $pose+1);
					if (!$p) { 
						$pose = 0;
						break;
					}					
					$l = $p - $pose + strlen($k[2]);
					$end = substr($ht, $pose, $l);
					$end = preg_replace('%[^A-Za-zА-Яа-я0-9-/<>.:"=+;]%', '', $end);									
					$pose = $p;
					if ($end == $k[1].$k[2]) break;
					else {
						$pose = stripos($ht, $k[1], $p);
						if (!$pose) break;
					}				
				}
			}	
			if ($pose) {
				$l = $pose - $posa;
				if ($l > 0) {
					$text = substr($ht, $posa, $l);
					$text = trim($text);	
				}	
			}	
		}
	
		$text = $this->litteras($text);
	
		return $text;	
	}
	
	public function ParsQu($ht, $key, $point, $place) {
		$text = '';			
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Quantity keyword error \n";
				$this->adderr($err);
				return $text;
			}			
			$pr = $this->Parsing($ht, $k, $point, $place);
			$pr = strip_tags($pr);			
			$pr = str_replace("'", "", $pr);
			$text = trim($pr);
		}	
		return $text;
			
	}
	
	public function ParsPrice($ht, $key, $point, $place) {
		$pr = '';		
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);			
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Price keyword error \n";
				$this->adderr($err);
				return $pr;
			}
			$n = 0;
			if (isset($k[2]) and !empty($k[2]) and preg_match('/[0-9]+$/', $k[2])) {
				$n = $k[2];
				$k[2] = '';
			}
			if (!$place) {
				$pr = $this->Parsing($ht, $k, $point, 1);	
				preg_match_all('/\d+(?:[\.,]\d+)?/', $pr, $mas);
				$d = 0;
				if (isset($mas[0])) $d = count($mas[0]);
				if ($n and $d) {
					if (isset($mas[0][$n-1])) $pr =	$mas[0][$n-1];
					else $pr = 	$mas[0][$d-1];
				}
				$pr = preg_replace('/[^0-9.,]/','',$pr);
				$pr = str_replace(',', '.',$pr);
				$pr = trim($pr);	
			} else {
				$prm = array();
				$l = 0;
				for ($i=1; $i<11; $i++) {
					$a = $this->Parsing($ht, $k, $point, $i);
					if ($a) {
						preg_match_all('/\d+(?:[\.,]\d+)?/', $a, $mas);
						$d = 0;
						if (isset($mas[0])) $d = count($mas[0]);	
						if ($n and $d) {
							if (isset($mas[0][$n-1])) $a =	$mas[0][$n-1];
							else $a = 	$mas[0][$d-1];
						}
						$a = preg_replace('/[^0-9.,]/','',$a);
						$a = str_replace(',', '.',$a);
						$prm[$l] = trim($a);					
						$l++;	
					}					
				}
				$n = count($prm);
				if (!$n) return $pr;
				$min = 10000000000;
				for ($i=0; $i<$n; $i++) {
					if ($prm[$i] < $min) $min = $prm[$i];						
				}
				$max = 0;
				for ($i=0; $i<$n; $i++) {
					if ($prm[$i] > $max) $max = $prm[$i];						
				}
				$sum = 0;
				for ($i=0; $i<$n; $i++) {
					$sum = $sum + $prm[$i];						
				}
				$av = $sum/$n;				
				switch ($place) {			
					case 1:
						$pr = $min;
						break;
					case 2:						
						$pr = $max;
						break;
					case 3:
						$pr = $av;
						break;
					case 4:
						$m = 0;
						for ($i=0; $i<$n; $i++) {
							if ($prm[$i]<$av and $prm[$i]>$m) $m = $prm[$i];								
						}
						$pr = $m;
						break;
					case 5:
						$m = 10000000;
						for ($i=0; $i<$n; $i++) {
							if ($prm[$i]>$min and $prm[$i]<$m) $m = $prm[$i];								
						}
						$pr = $m;
						break;
					case 6:
						$m = 0;
						for ($i=0; $i<$n; $i++) {
							if ($prm[$i]<$max and $prm[$i]>$m) $m = $prm[$i];								
						}
						$pr = $m;
						break;					
				}
			}
		}	
		return $pr;			
	}	
	
	public function ParsCategory($ht, $key, $point, $place) {
		$text = '';			
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Category keyword error \n";
				$this->adderr($err);
				return $text;
			}
			$text = $this->Parsing($ht, $k, $point, $place);
			$text = strip_tags($text);
			$text = str_replace('&amp;', '&',$text);			
			$text = trim($text);
		}	
		return $text;
			
	}
	
	public function ParsManufacturer($ht, $key, $point, $place) {
		$text = '';			
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Manufacturer keyword error \n";
				$this->adderr($err);
				return $text;
			}
			$text = $this->Parsing($ht, $k, $point, $place);
			$text = strip_tags($text);
			$text = str_replace('&amp;', '&',$text);			
			$text = trim($text);			
		}
		
		return $text;
			
	}
	
	public function ParsCode($ht, $key, $point, $place) {
		$text = '';
		
		if (!empty($key) and strlen($ht) > 500) {
		
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " SKU keyword error = ". $key."\n";
				$this->adderr($err);
				return $text;
			}
			$text = $this->Parsing($ht, $k, $point, $place);
			$text = strip_tags($text);
			$text = str_replace('&amp;', '&',$text);			
			$text = trim($text);
		}	
		return $text;
			
	}	
	
	public function ParsName($ht, $key, $point, $place) {
		
		$text = '';			
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Product name keyword error \n";
				$this->adderr($err);
				return $text;
			}
			
			$text = $this->Parsing($ht, $k, $point, $place);
			$text = str_replace('&amp;', '&',$text);
			$text = strip_tags($text, '<em><i><b><strong>');			
			$text = trim($text);
		
		}	
		return $text;
			
	}
	
	public function delAny($text, $any) {
		if (!$any) return; 
		for ($i=0; $i<100; $i++) {
			$pos = stripos($text, $any);
			if (!$pos) break;
			$l = strlen($any);			
			$text1 = substr($text, 0, $pos);
			$text2 = substr($text, $pos+$l);
			$text = $text1 . $text2;
		}
	
		return $text;
	}
	
	public function delRefer(&$text, $pos, $epos) {
		$text1 = substr($text, 0, $pos-1);
		$text2 = substr($text, $epos+1);
		$text = $text1 . $text2;		
	}
	
	public function descImage(&$text, $spath, $row_count, $url, $sleep, $ffile) {
		$pos = -1;		
		for ($i=0; $i<50; $i++) {
			$path = '';
			$fpath = '';
			$ppath = '';
			$pos1 = stripos($text, '<img ', $pos+1);
			if ($pos1) {
				if ($pos > $pos1) break;
				$pos = $pos1;
				$epos = stripos($text, '>', $pos+1);				
				$kav = stripos($text, 'src', $pos+1);	
				if (!$kav) $kav = stripos($text, "ref", $pos+1);
				if (!$kav) {
					$this->delRefer($text, $pos, $epos);
					continue;
				}	
				$ekav = stripos($text, '"', $kav+8);	
				if (!$ekav) $ekav = stripos($text, "'", $kav+8);
				if (!$ekav) {
					$this->delRefer($text, $pos, $epos);
					continue;
				}
				$bkav = stripos($text, '"', $kav);	
				if (!$bkav) $bkav = stripos($text, "'", $kav);
				if (!$bkav) {
					$this->delRefer($text, $pos, $epos);
					continue;
				}
				
				$im = substr($text, $bkav+1, $ekav-$bkav-1);
				if (!substr_count($im, "http")) {							
					$pe = strpos($url, "//");
					if ($pe) $pe = $pe + 2;
					$pe = strpos($url, "/", $pe);
					$a = substr($url, 0, $pe);							
					if (substr($im, 0 ,1) != "/") $im = '/'.$im;
					if (substr($im, 0 ,2) == "//") $im = substr($im, 2);						
					else {	
						$im = $a.$im;
						$im = str_replace ("../", "", $im);
						$im = str_replace ("./", "", $im);
					}	
				} else {
					$pe = strpos($im, "//");
					if ($pe) $pe = $pe + 2;
					$pe = strpos($im, "/", $pe);
					if (substr($im, $pe+1, 1) == ".") {
						$im = str_replace ("../", "", $im);
						$im = str_replace ("./", "", $im);
					}
				}
				
				$url = $im;
				$url = $this->checkurl($url);	
				if ($url == -1) $this->delRefer($text, $pos, $epos);				
				$nom = stripos($url, ".j");				
				if (!$nom) $nom = stripos($url, ".gif");
				if (!$nom) $nom = stripos($url, ".png");
				if (!$nom) $nom = stripos($url, ".bmp");
				
				$a = strlen($url);
				if (!$nom or $a - $nom > 5) {
					$se = ".jpg";
					$nom = $a;
				} else $se = substr($url, $nom);										
				$app = substr($url, 0, $nom);
				$nom = strpos($app, ".");
				$app = substr($app, $nom+7);
				$app = $this->TransLit($app);
				$nom = strlen($app);										
				if ($nom > 250) $app = substr($app, $nom-250, 250);
				if ($nom < 2) $app = rand(0, 999999999);									
				$app = $this->MetaURL($app);
				
				$fpath = '../image/' . $spath;	
				if (!is_dir($fpath)) {											
					$err =  " Photo in description has not insert : Row ~= " . $row_count . " Folder: " . $fpath. "  not found \n";
					$this->adderr($err);
				}
				$ppath = '../image/' . $spath . 'img/';	
				if (!is_dir($ppath)) @mkdir($ppath, 0755);				
				$ref = '<img src="' . '../image/' . $spath . 'img/' . $app . $se . '" width="100" height="100">';
				$path = $ppath.$app.$se;
				if (!file_exists($path)) {
					$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);
					if (!$this->isPicture($pict)) {
						$err =  " Download photo in description fails. Row ~= " . $row_count ." Url = ". $url . " \n";
						$this->adderr($err);					
						$this->delRefer($text, $pos, $epos);
						continue;			
					} else {
						$bytes = @file_put_contents($path, $pict);
						if (!$bytes) {
							$err =  " Write photo in description fails. Row ~= " . $row_count ." Url = ". $url . " \n";
							$this->adderr($err);
							$this->delRefer($text, $pos, $epos);
							continue;			
						}	
					}
				}

				$text1 = substr($text, 0, $pos);
				$text2 = substr($text, $epos+1);
				$text = $text1 . $ref . $text2;

			}
		}
	}
	
	public function ParsDescription($ht, $key, $point, $place, $spath, $row_count, $url, $sleep, $ffile) {
	
		$text = '';			
		if (!empty($key) and strlen($ht) > 500) {	
			$key = str_replace('&quot;', '"',$key);
			$key = str_replace('&lt;', '<',$key);
			$key = str_replace('&gt;', '>',$key);
			$key = str_replace('&amp;', '&',$key);
			
			$k = explode(",", $key);
			if (empty($k[0]) or empty($k[1])) {
				$err = " Product description keyword error \n";
				$this->adderr($err);
				return $text;
			}			
			$text = $this->Parsing($ht, $k, $point, $place);	
            		
			$text = strip_tags($text, '<img><p><em><i><br><li><ul><tbody><table><tr><td><b><strong>');
			$any = '';
			$any = '<li class="slidemenuItem" id="slideli">';   // удалить из описания все такие тексты
			
			$text = $this->delAny($text, $any);
			if (substr_count($text, "img")) $this->descImage($text, $spath, $row_count, $url, $sleep, $ffile);
			$text = str_replace('Описание', '', $text);
            $text = str_replace('Description', '', $text);			
			$text = preg_replace('/<P.*?>/','<p>',$text);	
			$text = str_replace('<p></p>', '', $text);
			$text = str_replace('<p> </p>', '', $text);
			$text = str_replace('<p>  </p>', '', $text);
			$text = str_replace('<p>&nbsp;</p>', '', $text);
			$text = str_replace('<strong></strong>', '', $text);
			$text = str_replace('<br /><br /><br />', '<br />', $text);
			$text = str_replace('<br/><br/><br/>', '<br />', $text);
			$text = str_replace('<br><br><br>', '<br />', $text);
			$text = str_replace('<br ><br ><br >', '<br />', $text);
			$text = str_replace('<br /><br />', '<br />', $text);
			$text = str_replace('<br/><br/>', '<br />', $text);
			$text = str_replace('<br><br>', '<br />', $text);
			$text = str_replace('<br ><br >', '<br />', $text);
			$text = str_replace('&amp;', '&',$text);
			$text = str_replace('&nbsp;', ' ',$text);			
			$posa = strrpos($text, "<!--");
			if ($posa) $text = substr($text, 0, $posa);
			$text = trim($text);
			
			/************ Вырезать текст начиная, с ********************/
			$pos = stripos($text, 'Купить', 0);
			if ($pos) $text = substr($text, 0, $pos);
			else {
				$pos = stripos($text, 'Сделать заказ', 0);
				if ($pos) $text = substr($text, 0, $pos);
				else {
					$pos = stripos($text, 'Продажа', 0);
					if ($pos) $text = substr($text, 0, $pos);
					else {
						$pos = stripos($text, 'Заказ', 0);
						if ($pos) $text = substr($text, 0, $pos);
						else {
							$pos = stripos($text, 'Расширяйте', 0);
							if ($pos) $text = substr($text, 0, $pos);
							else {
								$pos = stripos($text, 'Почему именно в', 0);
								if ($pos) $text = substr($text, 0, $pos);
								else {
									$pos = stripos($text, 'Инструкция', 0);
									if ($pos) $text = substr($text, 0, $pos);
									else {
										$pos = stripos($text, 'Сайт производителя', 0);
										if ($pos) $text = substr($text, 0, $pos);
									}	
								}							
							}	
						}	
					}
				}
			}	
			/********************************/
	
            $text = trim($text);    
        }
		return $text;
    }
	
	public function ParsPic($ht, $url, $key, $warranty, $fname, $point) {
	
		$fname = str_replace('&quot;', '"',$fname);
		$fname = str_replace('&lt;', '<',$fname);
		$fname = str_replace('&gt;', '>',$fname);
		$fname = str_replace('&amp;', '&',$fname);
		$pointe = '';
		$pos = 0;
		$posf = 0;
		if (!empty($point)) {
			$point = str_replace('&quot;', '"',$point);
			$point = str_replace('&lt;', '<',$point);
			$point = str_replace('&gt;', '>',$point);
			$point = str_replace('&amp;', '&',$point);			
			$mp = explode(",", $point);
			
			if (empty($mp[0]) or (!empty($mp[0]) and preg_match('/^[0-9]+$/', $mp[0]))) {
				$err = " Invalid parameter for parsing photo: ". $mp[0] ." URL: ". $url ."\n";
				$this->adderr($err);
				return 0;
			}
						
			$pos = stripos($ht, $mp[0]);	
			if (!$pos) {
				$err = " Invalid parameter for parsing photo = ". $mp[0] ." URL = ". $url ."\n";
				$this->adderr($err);
				return 0;
			}	
		}
		
		if (isset($mp[1]) and !empty($mp[1])) $posf = stripos($ht, $mp[1], $pos);
		if ($pos and $posf) $ht = substr($ht, $pos, $posf-$pos);
		if ($pos and !$posf) $ht = substr($ht, $pos);
	
		$l = strlen($ht);
		$im = 0;
		if ( $l > 500) {							
			$posb = 0;
			$pos = 0;							
			$num = substr($warranty, 4) + 0;
			
			for ($j=1; $j<= $num; $j++) {				
				$pos = stripos($ht, $fname, $pos+1);
				if (!$pos) break;					
			}	
			$s = '';
			if ($pos) {
				$sign = substr($warranty,0, 4);
				$fl = 0;
				if ($sign == "&lt;") {
					if ($pos > 500) $s = substr ($ht, $pos-500, 500);
					else $s = substr ($ht, 0, $pos);
					if (empty($key)) {						
						$posb = strrpos($s, "href=");
						if (!$posb) $posb=0;
						$posb1 = strrpos($s, "src=");
						if (!$posb1) $posb1=0;
						$posb2 = strrpos($s, "http");
						if (!$posb2) $posb2=0;
						$posb3 = strrpos($s, "url");
						if (!$posb3) $posb3=0;
						$max = 0;
						if ($posb > $max) $max = $posb;
						if ($posb1 > $max) $max = $posb1;
						if ($posb3 > $max) $max = $posb3;
						if ($posb2 > $max) {
							$max = $posb2;
							$fl = 1;
						}	
						$posb = $max;
						if ($fl) $posb = $posb - 2;
					} else $posb = strrpos($s, $key);
				} else {
					$s = substr ($ht, $pos, 500);	
					if (empty($key)) {						
						$posb = stripos($s, "href=");
						if (!$posb) $posb=500;
						$posb1 = stripos($s, "src=");
						if (!$posb1) $posb1=500;
						$posb2 = stripos($s, "http");
						if (!$posb2) $posb2=500;
						$posb3 = stripos($s, "url");
						if (!$posb3) $posb3=500;
						$min = 99999999;
						if ($posb < $min) $min = $posb;
						if ($posb1 < $min) $min = $posb1;
						if ($posb3 < $min) $min = $posb3;
						if ($posb2 < $min) {
							$min = $posb2;
							$fl = 1;
						}
						$posb = $min;
						if ($fl) $posb = $posb - 2;
					} else $posb = stripos($s, $key);	
				}
	
				$posb1 = 500;
				$posb2 = 500;
				$posb3 = 500;
				if ($posb != 500 and $posb != 0) {
					if (!empty($key)) $posb = $posb + strlen($key);
					$posb1 = stripos($s, "'", $posb);
					if ($posb1-$posb > 10) $posb1 = 500;
					$posb2 = stripos($s, '"', $posb);
					if ($posb2-$posb > 10) $posb2 = 500;
					if ($posb1 == 500 and $posb2 == 500) {
						$posb3 = stripos($s, '=', $posb);
						if ($posb3-$posb > 10) $posb3 = 500;
					}	
	
					$posb = 500;
					if ($posb1 < $posb and $posb1) $posb = $posb1;
					if ($posb2 < $posb and $posb2) $posb = $posb2;
					if ($posb3 < $posb and $posb3) $posb = $posb3;
	
					$pose=0;
					if ($posb != 500) {
						if ($posb1 == $posb) $pose = stripos($s, "'", $posb+1);					
						else {
							if ($posb2 == $posb) $pose = stripos($s, '"', $posb+1);
							else {
								if ($posb3 == $posb) $pose = stripos($s, '.jpg', $posb3+1) + 4;
							}
						}	
					}
	
					if ($posb != 500 and $pose) {
						$len = $pose-$posb-1;
						$im = 0;
						$im = substr($s, $posb+1, $len);	
						if (!substr_count($im, "http")) {							
							$pe = strpos($url, "//");
							if ($pe) $pe = $pe + 2;
							$pe = strpos($url, "/", $pe);
							$a = substr($url, 0, $pe);							
							if (substr($im, 0 ,1) != "/") $im = '/'.$im;
							if (substr($im, 0 ,2) == "//") {
								$im = substr($im, 2);
								$im = trim($im);		
								$im = str_replace(' ', '%20',$im);
								return $im;
							}	
							$im = $a.$im;
							$im = str_replace ("../", "", $im);
							$im = str_replace ("./", "", $im);
						} else {
							$pe = strpos($im, "//");
							if ($pe) $pe = $pe + 2;
							$pe = strpos($im, "/", $pe);
							if (substr($im, $pe+1, 1) == ".") {
								$im = str_replace ("../", "", $im);
								$im = str_replace ("./", "", $im);
							}
						}
					}
				}	
			}							
		}
		$im = trim($im);		
		$im = str_replace(' ', '%20',$im);
		
	/* заменить в ссылке на фото слово john на sam	*/	
	 $im = str_replace ("john", "sam", $im);
	
		return $im;
	}
	
	public function checkException($cod, $masex, $nex) {
		$yes = 0;
		for ($i=0; $i<$nex; $i++) {
			if ($masex[$i] == $cod) {
				$yes = 1;
				break;
			}
		}
		return $yes;
	}
	
	public function ftp($file_tmp, $file_name, $form_id) {
	
		$file_tmp = "./uploads/" . $form_id . ".xml";
		$err = $this->loadfile($file_tmp, $file_name, $form_id);
	
		return $err;
	}
	
	public function loadfile($file_tmp, $file_name, $form_id) {				
		$allowed_filetypes = '.xml';		
					
		$f = htmlspecialchars($file_name);
		$ext = substr($f, strpos($f,'.'));
	  	
		if($ext != $allowed_filetypes) return 1;
		else {
			if (!file_exists($file_tmp)) return 3;
			$file_xml = @fopen($file_tmp,"r");
			for ($i=0; $i < 3; $i++) {
				$st = fgets ($file_xml, 256);
				$res = substr_count($st, "office");				
			}	
			if (!$res) return 4;	
		}
		$path = "./uploads/";	
		if (!is_dir($path)) return 26;
		
		$rows = $this->getSupplerSEO($form_id);
		
		$seo_data['prod_photo'] = '';
		if (isset($rows[0]['prod_photo']))
		$seo_data['prod_photo'] = $this->symbol($rows[0]['prod_photo']);
		$seo_data['prod_h1'] = '';
		if (isset($rows[0]['prod_h1']))
		$seo_data['prod_h1'] = $this->symbol($rows[0]['prod_h1']);	
		$seo_data['prod_title'] = '';
		if (isset($rows[0]['prod_title']))
		$seo_data['prod_title'] = $this->symbol($rows[0]['prod_title']);		
		$seo_data['prod_meta_desc'] = '';
		if (isset($rows[0]['prod_meta_desc']))
		$seo_data['prod_meta_desc'] = $this->symbol($rows[0]['prod_meta_desc']);		
		$seo_data['prod_desc'] = '';
		if (isset($rows[0]['prod_desc']))
		$seo_data['prod_desc'] = $this->symbol($rows[0]['prod_desc']);
		if (isset($rows[0]['prod_keyword']))
		$seo_data['prod_keyword'] = $this->symbol($rows[0]['prod_keyword']);	
		$seo_data['cat_title'] = '';
		if (isset($rows[0]['cat_title']))
		$seo_data['cat_title'] = $this->symbol($rows[0]['cat_title']);		
		$seo_data['cat_meta_desc'] = '';
		if (isset($rows[0]['cat_meta_desc']))
		$seo_data['cat_meta_desc'] = $this->symbol($rows[0]['cat_meta_desc']);		
		$seo_data['cat_desc'] = '';
		if (isset($rows[0]['cat_desc']))
		$seo_data['cat_desc'] = $this->symbol($rows[0]['cat_desc']);		
		$seo_data['manuf_title'] = '';
		if (isset($rows[0]['manuf_title']))
		$seo_data['manuf_title'] = $this->symbol($rows[0]['manuf_title']);		
		$seo_data['manuf_meta_desc'] = '';
		if (isset($rows[0]['manuf_meta_desc']))
		$seo_data['manuf_meta_desc'] = $this->symbol($rows[0]['manuf_meta_desc']);		
		$seo_data['manuf_desc'] = '';
		if (isset($rows[0]['manuf_desc']))
		$seo_data['manuf_desc'] = $this->symbol($rows[0]['manuf_desc']);
		$seo_data['seo_1'] = '';
		if (isset($rows[0]['seo_1']))
		$seo_data['seo_1'] = $this->symbol($rows[0]['seo_1']);
		$seo_data['seo_2'] = '';
		if (isset($rows[0]['seo_2']))
		$seo_data['seo_2'] = $this->symbol($rows[0]['seo_2']);
		$seo_data['seo_3'] = '';
		if (isset($rows[0]['seo_3']))
		$seo_data['seo_3'] = $this->symbol($rows[0]['seo_3']);
		$seo_data['seo_4'] = '';
		if (isset($rows[0]['seo_4']))
		$seo_data['seo_4'] = $this->symbol($rows[0]['seo_4']);
		$seo_data['seo_5'] = '';
		if (isset($rows[0]['seo_5']))
		$seo_data['seo_5'] = $this->symbol($rows[0]['seo_5']);
		$seo_data['seo_6'] = '';
		if (isset($rows[0]['seo_6']))
		$seo_data['seo_6'] = $this->symbol($rows[0]['seo_6']);		
		$seo_data['seo_7'] = '';
		if (isset($rows[0]['seo_7']))
		$seo_data['seo_7'] = $this->symbol($rows[0]['seo_7']);
		$seo_data['seo_8'] = '';
		if (isset($rows[0]['seo_8']))
		$seo_data['seo_8'] = $this->symbol($rows[0]['seo_8']);
		$seo_data['seo_9'] = '';
		if (isset($rows[0]['seo_9']))
		$seo_data['seo_9'] = $this->symbol($rows[0]['seo_9']);
		$seo_data['seo_10'] = '';
		if (isset($rows[0]['seo_10']))
		$seo_data['seo_10'] = $this->symbol($rows[0]['seo_10']);
		$seo_data['seo_11'] = '';
		if (isset($rows[0]['seo_11']))
		$seo_data['seo_11'] = $this->symbol($rows[0]['seo_11']);
		$seo_data['seo_12'] = '';
		if (isset($rows[0]['seo_12']))
		$seo_data['seo_12'] = $this->symbol($rows[0]['seo_12']);		
		$seo_data['seo_13'] = '';
		if (isset($rows[0]['seo_13']))
		$seo_data['seo_13'] = $this->symbol($rows[0]['seo_13']);
		$seo_data['seo_14'] = '';
		if (isset($rows[0]['seo_14']))
		$seo_data['seo_14'] = $this->symbol($rows[0]['seo_14']);
		$seo_data['seo_15'] = '';
		if (isset($rows[0]['seo_15']))
		$seo_data['seo_15'] = $this->symbol($rows[0]['seo_15']);
		$seo_data['seo_16'] = '';
		if (isset($rows[0]['seo_16']))
		$seo_data['seo_16'] = $this->symbol($rows[0]['seo_16']);
		$seo_data['seo_17'] = '';
		if (isset($rows[0]['seo_17']))
		$seo_data['seo_17'] = $this->symbol($rows[0]['seo_17']);		
		$seo_data['seo_18'] = '';
		if (isset($rows[0]['seo_18']))
		$seo_data['seo_18'] = $this->symbol($rows[0]['seo_18']);
		$seo_data['seo_19'] = '';
		if (isset($rows[0]['seo_19']))
		$seo_data['seo_19'] = $this->symbol($rows[0]['seo_19']);
		$seo_data['seo_20'] = '';
		if (isset($rows[0]['seo_20']))
		$seo_data['seo_20'] = $this->symbol($rows[0]['seo_20']);

		$seo = array();
				
		$rows = $this->getMySuppler($form_id);
		
		if (empty($rows) or !isset($rows[0]['suppler_id'])) return 27;
		
			$id		  = $rows[0]['suppler_id'];
			$rate     = $rows[0]['rate'];
			$ratep     = $rows[0]['ratep'];
			$ratek     = $rows[0]['ratek'];
			$ccod      = $rows[0]['cod'];
			$related  = $rows[0]['related'];
			$lang 	  = $rows[0]['sort_order'];
			$iitem     = $rows[0]['item'];
			$ccat      = $rows[0]['cat'];			
			$qu       = $rows[0]['qu'];
			$pprice    = $rows[0]['price'];
			$pqu    	= $rows[0]['qu'];
			$ddescrip  = $rows[0]['descrip'];
			$ppic_ext  = $rows[0]['pic_ext'];
			$mmanuf    = $rows[0]['manuf'];
			$warranty = $rows[0]['warranty'];
			$sku2 	  = $rows[0]['sku2'];
			$ad       = $rows[0]['ad'];
			
			$st_status   = $rows[0]['status'];
			$my_cat   = $rows[0]['my_cat'];
			$my_qu    = $rows[0]['my_qu'];
			$my_price = $rows[0]['my_price'];
			$my_descrip = $rows[0]['my_descrip'];
			$my_manuf = $rows[0]['my_manuf'];
			$my_photo  = $rows[0]['my_photo'];
			$cheap    = $rows[0]['cheap'];
			$my_mark  = $rows[0]['my_mark'];
			$weight  = $rows[0]['weight'];
			$length  = $rows[0]['length'];
			$width  = $rows[0]['width'];
			$height  = $rows[0]['height'];
			$parent  = $rows[0]['parent'];
			$hide  = $rows[0]['hide'];
			$newphoto = $rows[0]['newphoto'];
			$addopt = $rows[0]['addopt'];
			$addseo = $rows[0]['addseo'];
			$ignore_margin = $rows[0]['importseo'];
			$updte  = $rows[0]['updte'];
			$pmanuf  = $rows[0]['pmanuf'];
			$upattr = $rows[0]['upattr'];
			$upopt = $rows[0]['upopt'];
			$upname = $rows[0]['upname'];
			$myplus = $rows[0]['myplus'];
			if (empty($myplus)) $myplus = 0;
			$cprice = $rows[0]['cprice'];
			$minus = $rows[0]['minus'];
			$chcode = $rows[0]['chcode'];
			$sorder = $rows[0]['sorder'];
			$spec = $rows[0]['spec'];
			$upurl = $rows[0]['upurl'];
			$ref = $rows[0]['ref'];
			$ref1 = $rows[0]['ref1'];
			$store = $rows[0]['addattr'];
			$exsame = $rows[0]['exsame'];
			$parss = $rows[0]['parss'];
			$points = $rows[0]['points'];
			$places = $rows[0]['places'];
			$parsi = $rows[0]['parsi'];
			$pointi = $rows[0]['pointi'];
			$placei = $rows[0]['placei'];
			$parsc = $rows[0]['parsc'];
			$pointc = $rows[0]['pointc'];
			$placec = $rows[0]['placec'];
			$parsp = $rows[0]['parsp'];
			$pointp = $rows[0]['pointp'];			
			$placep = $rows[0]['placep'];
			$parsd = $rows[0]['parsd'];
			$pointd = $rows[0]['pointd'];
			$placed = $rows[0]['placed'];
			$parsm = $rows[0]['parsm'];
			$pointm = $rows[0]['pointm'];
			$placem = $rows[0]['placem'];
			$parsk = $rows[0]['parsk'];
			$parsq = $rows[0]['parsq'];
			$pointq = $rows[0]['pointq'];
			$placeq = $rows[0]['placeq'];
			$kmenu = $rows[0]['kmenu'];
			$bprice = $rows[0]['bprice'];
			$catcreate = $rows[0]['catcreate'];
			$stay	 = $rows[0]['stay'];
			$joen	 = $rows[0]['joen'];
			$off	 = $rows[0]['off'];
			$umanuf  = $rows[0]['umanuf'];
			$onn	 = $rows[0]['onn'];
			$refer  = $rows[0]['refer'];
			$disc  = $rows[0]['disc'];
			$upc  = $rows[0]['upc'];
			$ean  = $rows[0]['ean'];
			$mpn  = $rows[0]['mpn'];
			$newurl  = $rows[0]['newurl'];
			$ddata  = $rows[0]['ddata'];
			$bonus  = $rows[0]['bonus'];
			$ddesc  = $rows[0]['ddesc'];
			$qu_discount = $rows[0]['qu_discount'];
			$plusopt  = $rows[0]['plusopt'];
			$idcat  = $rows[0]['idcat'];
			$termin  = $rows[0]['termin'];
			$t_status  = $rows[0]['t_status'];
			$t_ref  = $rows[0]['t_ref'];
			$t_ref1  = $rows[0]['t_ref1'];
			$onoff  = $rows[0]['onoff'];
			$main  = $rows[0]['main'];
			$zero  = $rows[0]['zero'];
			$metka  = $rows[0]['metka'];
			$jopt  = $rows[0]['jopt'];
			$optsku  = $rows[0]['optsku'];
			$newproduct  = $rows[0]['newproduct'];			
			$upOptionFoto = $rows[0]['opt_fotos'];    // Включить фото в опциях
			$opt_prices  = $rows[0]['opt_prices'];    // Цена в опциях
			$usd         = $rows[0]['usd'];          // Для модуля Валюта плюс			
			if (empty($usd)) $usd = 0;
			$sleep  = $rows[0]['sleep'];
			$ffile	= $rows[0]['ffile'];
			
			$minPriceOption = $opt_prices;  // Установить цену на товар, как мин. среди опций
			$minPriceOptionPlus = 0;
			if ($opt_prices == 2) {
				$minPriceOptionPlus = 1; // Вычислить и поставить плюс к цене
				$minPriceOption = 1;
			}			
			
			$yml = 0;
			if ($ad == 11) $yml = 1;
			
			$la = $this->config->get('config_language_id');
			$catcreate = 0;
			$ddata = 0;
			$exsame = 0;			
			if ($ad == 5) $catcreate = 1;			
			if ($ad == 6) $ddata = 1;
			if ($ad == 7) $ddata = 2;
			if ($ad == 8) $exsame = 1;			
			
			$cod = $ccod;
			$item = $iitem;
			$cat = $ccat;
			$manuf = $mmanuf;
			$price = $pprice;
			$qu = $pqu;
			$descrip = $ddescrip;
			$pic_ext = $ppic_ext;			
			
		$np = substr_count($rows[0]['pic_ext'], ",");				
		$np = $np + 1;
		$ns = substr_count($rows[0]['warranty'], ",");
		$ns = $ns + 1;	
			
		$rows  = $this->getSupplerData($form_id);

		if (empty($rows) and !$ddata) return 21;
		
		$max = 0;
		foreach ($rows as $value) {
			$max++;
			$cat_ext[$max] = trim($value['cat_ext']);
			$category_id[$max] = $value['category_id'];
			$pic_int[$max] = trim($value['pic_int']);
			$cat_plus[$max] = trim($value['cat_plus']);
		}			
	
		$rows  = $this->getSupplerAttributes($form_id);
		
		$tags = '0';
		$attr_ext = '';
		$max_attr = 0;		
		if ($rows) {			
			foreach ($rows as $value) {
				$max_attr++;
				$attr_ext[$max_attr] = '';
				$attr_point[$max_attr] = '';
				$tags[$max_attr] = '0';
				$attr_ext[$max_attr] = $value['attr_ext'];
				$attr_point[$max_attr] = $value['attr_point'];
				$attribute_id[$max_attr] = $value['attribute_id'];
				$tags[$max_attr] = $value['tags'];
				$filter_group_id[$max_attr]= $value['filter_group_id'];
			}
		}		
		
		$langs = $this->getAllLanguages();
		
		$rows  = $this->getSupplerOptions($form_id);
	
		$max_opt = 0;		
		if ($rows) {			
			foreach ($rows as $value) {		
				$max_opt++;				
				$option_id[$max_opt] = $value['option_id'];
				$opt[$max_opt] = $value['opt'];
				$opt_point[$max_opt] = $value['opt_point'];
				$ko[$max_opt] = $value['ko'];
				$po[$max_opt] = $value['po'];
				$prro[$max_opt] = $value['pr'];
				$we[$max_opt] = $value['we'];
				$art[$max_opt] = $value['art'];
				$foto[$max_opt] = $value['foto'];
				$option_required[$max_opt] = $value['option_required'];
				$row = $this->getOptionsType($value['option_id']);
				if (empty($row)) $row['type'] = 'select';
				$option_type[$max_opt] = $row['type'];
			}	
		}

		$rows  = $this->getSupplerPrice($form_id);
	
		$max_site = 0;
		if ($rows) {			
			foreach ($rows as $value) {								
				$nomkol[$max_site] = $value['nom'];
				$ident[$max_site] = $value['ident'];
				$param[$max_site] = $value['param'];
				$point[$max_site] = $value['point'];
				$noprice[$max_site] = $value['noprice'];
				$paramnp[$max_site] = $value['paramnp'];
				$pointnp[$max_site] = $value['pointnp'];
				$baseprice[$max_site] = $value['baseprice'];				
				$max_site++;
			}	
		}			
		
		if (!empty ($rate) and !preg_match('/^[0-9.,Ee+-]+$/', $rate)) return 7;
		if (empty ($rate)) $rate = 1;	
		$rate = str_replace(',','.',$rate);
		if (!empty ($ratep) and !preg_match('/^[0-9.,Ee+-]+$/', $ratep)) return 7;
		if (empty ($ratep)) $ratep = 1;	
		$ratep = str_replace(',','.',$ratep);
		if (!empty ($ratek) and !preg_match('/^[0-9.,Ee+-]+$/', $ratek)) return 7;
		if (empty ($ratek)) $ratek = 1;	
		$ratek = str_replace(',','.',$ratek);
		if (empty ($cod)) return 8;
		if (empty ($item)) return 16;
		if (empty ($price)) return 19;	
		if (empty ($pic_ext) and empty ($parsk) and ($ad == 1 or $ad == 3)) return 13;
		if (!empty ($weight) and !preg_match('/^[0-9]+$/', $weight)) return 18;
		if ((!empty ($length) and !preg_match('/^[0-9]+$/', $length)) or
			(!empty ($width) and !preg_match('/^[0-9]+$/', $width)) or
			(!empty ($height) and !preg_match('/^[0-9]+$/', $height))) return 11;
		if (!empty ($related) and !preg_match('/^[0-9]+$/', $related)) return 12;
		if (!empty ($myplus) and !preg_match('/^[0-9]+$/', $myplus)) return 9;
		if ($optsku and empty($newproduct) and ($ad == 1 or $ad == 3)) return 28;
			
		if (!empty($warranty) and !preg_match('/^[0-9,&lt;&gt;]+$/', $warranty)) return 15;
		if ((!empty($parss) and !preg_match('/^[0-9]+$/', $parss)) or 
			(!empty($parsi) and !preg_match('/^[0-9]+$/', $parsi)) or 
			(!empty($parsc) and !preg_match('/^[0-9]+$/', $parsc)) or
			(!empty($parsp) and !preg_match('/^[0-9]+$/', $parsp)) or
			(!empty($parsd) and !preg_match('/^[0-9]+$/', $parsd)) or
			(!empty($parsm) and !preg_match('/^[0-9]+$/', $parsm)) or
			(!empty($parsk) and !preg_match('/^[0-9]+$/', $parsk))) return 14;
				
		for ($i = 1; $i <= $max; $i++) {
			if (empty($category_id[$i]) and !$catcreate and $ad != 6 and $ad != 7) return 25;			
			if (empty($pic_int[$i]) and $ad != 6 and $ad != 7) return 22;
		}
		
		$file_sos    = "./uploads/sos.tmp"; 
		$was_timelimit = 0;
		if (!file_exists ($file_sos)) {
		
			$path = "./uploads/report.tmp";
			if (file_exists($path)) @unlink ($path);
		
			$path = "./uploads/errors.tmp";
			if (file_exists($path)) @unlink ($path);
			
			$path = "./uploads/ex.xml";
			if (file_exists($path)) @unlink ($path);
		} else $was_timelimit = 1;
		
		$row = array();
		$old_sku = 'FF30884Rjklr07754';	
		$price_on_site = 999999999999;
		$oldprice = 0;
		$old_product_id = 0;

		$was_timelimit = 0;
		$file_sos    = "./uploads/sos.tmp"; 
		if (file_exists ($file_sos)) {			
			$sos = @fopen($file_sos,'r+');
			$mmm = fgets($sos, 100);
			$m = explode(" " , $mmm);	
			$row_count = (int)$m[0];
			if ($row_count) $was_timelimit = 1;
			$old_sku = '';
			if (isset($m[1])) $old_sku = $m[1];
			if (empty($row_count)) $row_count = 0;
			@fclose($sos);
		} else {
			$sos = @fopen($file_sos,'w+');
			if (!$sos) { @fclose($sos); return 5;}
			chmod($file_sos, 0777);
			$row_count = 0;		
		}
		
		$except = 0;
		$path = "./uploads/exception.xml";
		if (file_exists($path)) {
			$except = 1;
			$file_con  = "./uploads/exception.xml"; 
			$con = @fopen($file_con,'r');			
			if (!$con) return 25;
						
			$st = '';
			$nex = 0;			
			$masex = array();	
			while (!feof($con)) {		
				while (!@feof($con) and !substr_count($st, "<Row")){
					$st = @fgets($con, 4096);
				}	
				if (@feof($con)) break;					
				
				$m = '';
				while (1) {						
					$st = @fgets($con, 4096);
					$m = $m.$st;
					if (@feof($con)) break;				
					if (substr_count($st, "</Row>"))  break;		
					if (substr_count($st, "<Cell") and substr_count($st, "</Cell")) break;	
										
					$st = @fgets($con, 4096);
					$m = $m.$st;
					if (@feof($con)) break;				
					if (substr_count($st, "</Row>"))  break;
					if (substr_count($st, "</Cell"))  break;
				}
				$posb = stripos($m, "String");
				if (!$posb) $posb = stripos($m, "Number");
					
				if (!$posb) break;
				$posb = $posb;
				$posb = stripos($m, ">", $posb)+1;
				$pose = stripos($m, "</Data", $posb);
				if (!$pose) $pose = stripos($m, "</ss:Data", $posb);
		
				if ($pose > $posb) {						
					$len = $pose - $posb;
					$m = substr($m, $posb, $len);
					$masex[$nex] = $m;
					$nex++;		
				}			
			}
			@fclose($con);		
		}	

		if ($exsame) {
			$path = "./uploads/ex.xml";			
			if (!file_exists($path)) {
				$this->StartEx();			
			
				for ($j=0; $j<7; $j++) {
					$st = ' <Column ss:AutoFitWidth="0" ss:Width="100"/>'."\n";
					$this->addex($st);
				}
				$st = '<Row>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Product in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Main SKU in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">SKU in Price-list</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name in Store</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Name in Price-list</Data></Cell>'."\n";
				$this->addex($st);			
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price in Store</Data></Cell>'."\n";
				$this->addex($st);
				$st = ' <Cell ss:StyleID="s20"><Data ss:Type="String">Price in Price-list</Data></Cell>'."\n";
				$this->addex($st);
				$st = '</Row>'."\n";
				$this->addex($st);			
			} else {				
				if (isset($was_timelimit) and $was_timelimit) {	
					$was_timelimit = 0;
					$file_ex  = "./uploads/ex.xml";		
					$ex = @fopen($file_ex,'r+');					
					$offcet = 0;
					$seek = 0;
					while (!@feof($ex)) {						
						$st = @fgets($ex, 2048);
						$offcet = $offcet + strlen($st);
						if (substr_count($st, "<Row")) $seek = $offcet - strlen($st);
					}
					ftruncate($ex, $seek);	
					@fclose($ex);				
				}				
			}	
		}
		$table_sku = "";
		$table_sku = $this->getTable();	
	
		if (!@rewind($file_xml)) return 3;
	
		if ($row_count) {
			$i = 0;
			while (!@feof($file_xml) and ($i < $row_count)) {
				$st = @fgets($file_xml, 4096);
				if (substr_count($st, "<Row")) $i++; 
			}
		}	
		if (@feof($file_xml) and ($row_count > 0)) return 6;
		if (@feof($file_xml) and ($row_count = 0)) return 17;
	
		while (!feof($file_xml)) {		
			while (!@feof($file_xml) and !substr_count($st, "<Row")) {
				$st = @fgets($file_xml, 4096);
			}	
			if (@feof($file_xml)) break;

			for ($j=1; $j<2048; $j++) { $row[$j] = NULL;}	
			$i = 0;
			$br = 0;
			$ext = 1;			
			while ($ext) {			
				$st = @fgets($file_xml, 4096);
				if (@feof($file_xml)) break;				
				if (substr_count($st, "</Row>"))  break;
								
				if (!substr_count($st, "<Cell")) {
				
					if (substr_count($st, "</Data")) $pose = strpos($st, "</Data"); 
						else if (substr_count($st, "</ss:Data")) $pose = strpos($st, "</ss:Data"); 
								else $pose = strlen($st) - 1;
					if ($pose and $br) $row[$i] = $row[$i].preg_replace('| +|', ' ', substr($st, 0, $pose));					
					continue;
					
				} else {					
					$p = strpos($st, "Index=");
					if ($p != 0) {
						$pe = strpos($st, '"', $p+7);
						$i = substr ($st, $p+7, $pe-$p-7) + 0;
					} else $i ++;
					
					$br = 0;
					$a = ">";
					$posb1 = strpos($st, "String");
					if ($posb1 === false) $posb1 = 999;
					$posb2 = strpos($st, "Number");
					if ($posb2 === false) $posb2 = 999;
					$posb3 = strpos($st, "HRef=");
					if ($posb3 === false) $posb3 = 999;
					if ($posb1 < $posb2) $posb = $posb1;
					else $posb = $posb2;
					if ($posb3 < $posb) {
						$posb = $posb3;
						$a = '"';						
					}		
					if ($posb != 999)	{					
						$posb = strpos($st, $a , $posb) +1;
						if ($posb < 0) continue;
						$pose = 0;
						if ($a != '"') {						
							if (substr_count($st, "</Data")) $pose = strpos($st, "</Data", $posb); 
							else if (substr_count($st, "</ss:Data")) $pose = strpos($st, "</ss:Data", $posb); 
						} else $pose = strpos($st, $a, $posb); 
						if (!$pose) {
							$br = 1;
							$row[$i] = substr($st, $posb);
							continue;
						}	
						if ($pose and $pose > $posb) {						
							$len = $pose - $posb;
							$row[$i] = substr($st, $posb, $len);		
						} 
					} else continue;
				}
			}			
	
			$pname = "";
			$ht = "";
			$parsed = "";
			$cod = $ccod;
			$item = $iitem;
			$cat = $ccat;
			$manuf = $mmanuf;
			$price = $pprice;
			$qu = $pqu;
			$descrip = $ddescrip;
			$pic_ext = $ppic_ext;
			
			if ($cheap and $ad != 2 and empty($bprice)) {				
				$err = " Please, set the column number, containing the purchase price in price-list" . "\n";
				$this->adderr($err);					
				continue;
			}
			if (!empty($bprice)) {   // указана колонка, а цены закупки нет
				if (empty($row[$bprice])) {
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					$err = " The Product passed: Row ~= " . $row_count . " Purchase price not found in price-list in column: " . $bprice . "\n";
					$this->adderr($err);
					continue;
				}
			}
			if (!preg_match('/^[0-9]+$/', $cod) and !empty($cod)) {
				if (empty($row[$parss])) {
					$row_count = (int)$this->putsos($row_count, 1);
					if ($row_count < 0) return 5;
					$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parss."\n";
					$this->adderr($err);					
					continue;
				}
				$url = $this->checkurl($row[$parss]);
				if ($url == -1) {
					$err = " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parss]. " in column = ".$parss."\n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, 1);
					if ($row_count < 0) return 5;
					continue;
				}
				
				$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
				if (strlen($ht) > 2048)  $parsed = $parss;
				else {
					$parsed = '';
					$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, 1);
					if ($row_count < 0) return 5;
					continue;
				}
	
				$in = $this->ParsCode($ht, $ccod, $points, $places);
				
				if (empty($in) or strlen($in) > 64) {
					$err = " The Product passed: Row ~= " . $row_count . " parsing sku fail, sku = " . $in . " \n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, 1);
					if ($row_count < 0) return 5;
					continue;
				}
				$cod = 'cod';				
				$row[$cod] = $in;
			}
	/***********************/			
			if (!preg_match('/^[0-9,]+$/', $cat) and !empty($cat)) {
				if (empty($row[$parsc])) {
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parsc."\n";
					$this->adderr($err);						
					continue;
				}
				$url = $this->checkurl($row[$parsc]);
				if ($url == -1) {
					$err =  " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parsc]. " in column = ".$parsc."\n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					continue;
				}
				if (strlen($ht) < 1024 or $parsed != $parsc) {
					$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
					if (strlen($ht) > 2048) $parsed = $parsc;
					else {
						$parsed = '';
						$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						continue;
					}	
				}
				$in = $this->ParsCategory($ht, $ccat, $pointc, $placec);
					
				if (empty($in) or strlen($in) > 100 or strlen($in) < 2) {
					$err = " The Product passed: Row ~= " . $row_count . " parsing product category fail, category = ". $in . " \n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					$cat = 'cat';
					$row[$cat] = '';
				} else {
					$cat = 'cat';
					$row[$cat] = $in;
				}	
			}	
		/**************/
			$price_parsed = 0;
			$placep = 0;
			if (!preg_match('/^[0-9,]+$/', $price) and !empty($price)) {
				if (empty($row[$parsp])) {
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parsp."\n";
					$this->adderr($err);					
					continue;
				}
				$url = $this->checkurl($row[$parsp]);
				if ($url == -1) {
					$err = " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parsp]. " in column = ".$parsp."\n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					continue;
				}
				if (strlen($ht) < 1024 or $parsed != $parsp) {
					$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);					
					if (strlen($ht) > 2048) $parsed = $parsp;
					else {
						$parsed = '';
						$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						continue;
					}						
				}
				
				$in = $this->ParsPrice($ht, $pprice, $pointp, $placep);				
								
				if (empty($in) or strlen($in) > 40 or !preg_match('/^[0-9,.]+$/', $in)) {
					$err = " The Product passed: Row ~= " . $row_count . " parsing product price fail, price = " . $in . " \n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					continue;
				}
				$price = 'price';
				$row[$price] = $in;
				$price_parsed = 1;				
				
			}
			/**************/
			if (!preg_match('/^[0-9,]+$/', $qu) and !empty($qu)) {
				if (empty($row[$parsq])) {
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parsq."\n";
					$this->adderr($err);					
					continue;
				}
				$url = $this->checkurl($row[$parsq]);
				if ($url == -1) {
					$err = " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parsq]. " in column = ".$parsq."\n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$cod]);
					if ($row_count < 0) return 5;
					continue;
				}
				if (strlen($ht) < 1024 or $parsed != $parsq) {
					$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);					
					if (strlen($ht) > 2048) $parsed = $parsq;
					else {
						$parsed = '';
						$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						continue;
					}						
				}
				
				$in = $this->ParsQu($ht, $pqu, $pointq, $placeq);

				if (empty($in) or strlen($in) > 60) {
					$err = " The Product passed: Row ~= " . $row_count . " parsing product quantity fail, quantity = " . $in . " \n";
					$this->adderr($err);
					$row_count = (int)$this->putsos($row_count, $row[$qu]);
					if ($row_count < 0) return 5;
					continue;
				}
				$qu = 'qu';
				$row[$qu] = $in;
			}
		
			//  Форматирование текста в описании, можно закоментировать ненужное:
			if (isset($row[$descrip])) {			
			//	 Разрешить теги HTML 
			// $row[$descrip] = htmlspecialchars_decode($row[$descrip]);	
			//   Удалить теги html 
			//  $row[$descrip]  = strip_tags($row[$descrip]);
						
			$url = 'http://mysite.com/aaaaa';
			$spath = "data/photo/";
			$row[$descrip] = strip_tags($row[$descrip], '<img><p><em><i><br><li><ul><tbody><table><tr><td><b><strong>');
			if (substr_count($row[$descrip], "img")) $this->descImage($row[$descrip], $spath, $row_count, $url, $sleep, $ffile);
			
			$row[$descrip] = str_replace("&gt;", '>', $row[$descrip]);	
			$row[$descrip] = str_replace("&lt;", '<', $row[$descrip]);
			$row[$descrip] = str_replace("&quot;", '"', $row[$descrip]);
			$row[$descrip] = str_replace("&amp;nbsp;", " ", $row[$descrip]);
			$row[$descrip] = str_replace("&amp;quot;", '"', $row[$descrip]);	
			$row[$descrip] = str_replace("html:", "", $row[$descrip]);						
			$row[$descrip] = str_replace("&#10;", "&lt;br&gt;", $row[$descrip]);
			$row[$descrip] = str_replace("&amp;#xD;&amp;#xA;", "&lt;br&gt;", $row[$descrip]);
			$row[$descrip] = str_replace("&#xD;&#xA;", "&lt;br&gt;", $row[$descrip]);		
			$row[$descrip] = str_replace('Size="8"', 'size="0"', $row[$descrip]);
			$row[$descrip] = str_replace('Size="9"', 'size="0"', $row[$descrip]);
			$row[$descrip] = str_replace('Size="10"', 'size="2"', $row[$descrip]);
			$row[$descrip] = str_replace('Size="11"', 'size="3"', $row[$descrip]);
			$row[$descrip] = str_replace('Size="12"', 'size="3"', $row[$descrip]);
						
			$row[$descrip] = $this->symbol($row[$descrip]);
						
		// Разделить текст на строки
		//	$row[$descrip] = str_replace('. ', '.<br />', $row[$descrip]);
		//	$row[$descrip] = str_replace('! ', '!<br />', $row[$descrip]);
					
		// Удалить из описания слово "Описание"
		//	$row[$descrip] = str_replace('Описание', '', $row[$descrip]);
		//	$row[$descrip] = str_replace('Description', '', $row[$descrip]);			
		
		}
			$report = '';
			$row_count = (int)$this->putsos($row_count, $row[$cod]);
			if ($row_count < 0) return 5;
			
			if ($ad == 2) {
				$cheap = 0;			
				$updte = 0;
				$upname = 0;
				$addseo = 0;
				$upurl = 0;
				$umanuf = 0;
				$upattr = 0;							
			}
			if ($ad == 4) {				
				$updte = 0;
				$upname = 0;
				$addseo = 0;
				$upurl = 0;
				$umanuf = 0;
				$upattr = 0;			
			}
			$aprice = '';
			if (preg_match('/^[0-9,]+$/', $spec)) {				
				$aprice = explode("," , $spec);				
			}
			$mprice = '';
			if (preg_match('/^[0-9,]+$/', $price)) {				
				$mprice = explode("," , $price);
				$price = $mprice[0];				
			}
			
			if (isset($row[$price])) {
				$pr = trim($row[$price]);
				$pr = preg_replace('/[^0-9.,Ee+-]/','',$pr);
				$pr = str_replace(',', '.',$pr);
				$pr = trim($pr);				
				$row[$price] = $pr;
			}

			if (!preg_match('/^[0-9.Ee+-]+$/', $row[$price]) and $ad != 2 and $ad != 12 and !$catcreate and !$yml) {	
				$err = " The Product passed: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Cell 'price' contains a formula or illegal text". "\n";
				$this->adderr($err);
				continue;
			}
			
			if ((empty($row[$price]) or !preg_match('/^[0-9.Ee+-]+$/', $row[$price])) and $ad != 2  and $ad != 12 and !$catcreate and !$yml) {				
				$err = " The Product passed: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Invalid price of product = ". $row[$price]. "\n";
				$this->adderr($err);
				continue;
			}
				
			if (empty($row[$cod]) and empty($row[$sku2]) and !$catcreate) {				
				$err = " The Product passed: Row ~= " . $row_count . " SKU not found \n";
				$this->adderr($err);
				continue;				
			}
			
			if ($except) {
				if ($this->checkException($row[$cod], $masex, $nex)) continue;					
			}
			
			if ($ddata) {
				if (!empty($cat)) {
					if (substr_count($cat, ",")) {
						$cats = explode(",", $cat);
						$cat = $cats[0];
					}
					if (!empty($row[$cat])) {
						$pic_int = '';
						$cat_plus = '';
						$category_id = 0;
						$name = '';
						$rows = $this->getCategoryIDbyName($row[$cat], $store);
						if (!empty($rows)) {
							$category_id = $rows[0]['category_id'];							
							$name = $row[$cat];
						}
						if ($ddata == 2 and !empty($name)) {
							$app = $this->TransLit($name);
							$nom = strlen($app);										
							if ($nom > 20) $app = substr($app, 0, 20);
							if ($nom < 2) $app = rand(0, 999999999);									
							$app = $this->MetaURL($app);
							$path = "../image/data/" .$app."/";	
							if (!is_dir($path)) @mkdir($path, 0755);
							$pic_int = $app;
						}	
						$rows = $this->getDataForm($row[$cat], $form_id);
						if (empty($rows)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_data SET `form_id` = '" . (int)$form_id . "', `cat_ext` = '" . $this->db->escape($row[$cat]) . "', `category_id` = '" . (int)$category_id . "', `pic_int` = '" . $pic_int . "', `cat_plus` = '" . $cat_plus . "'");
						} else {
							$nom_id = $rows[0]['nom_id'];
							if ($ddata == 2 and !empty($name) and empty($rows[0]['pic_int']))
								$this->db->query("UPDATE " . DB_PREFIX . "suppler_data SET `pic_int` = '" . $pic_int . "'  WHERE `nom_id` = '" . (int)$nom_id . "'");
						}				
					} else {
						$err = " Category missing: Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
						$this->adderr($err);
					}
				}	
				continue;
			}
			
			$flag = 0;
			$i = 1;
			$text_cat = "";
			$catmany = '';
			$refers = '';
			$cats = explode(",", $cat);
			if (isset($cats[0]) and preg_match('/^[0-9]+$/', $cats[0])) {
				$cat = $cats[0];
				$j = 0;
				foreach ($cats as $c) {
					if (!empty($c) and preg_match('/^[0-9]+$/', $c) and isset($row[$c]) and !empty($row[$c])) {
						$catmany[$j] = $row[$c];
						$refers[$j] = $row[$c+33];
						$j++;
					}	
				}
			}
	
			if (!empty($row[$cat])) {
				$text_cat = trim($row[$cat]);
				if (!$idcat) {
					for ($i=1; $i<=$max; $i++) {
						if ($text_cat == trim($cat_ext[$i])) {
							$flag = 1;
							break;
						}
					}
				} else {
					for ($i=1; $i<=$max; $i++) {
						if ($category_id[$i] == (int)$row[$cat]) {
							$flag = 1;
							break;
						}
					}
				}	
			}

			if (!$flag and ($parent == 6 or $parent == 5)) {				
				$err = " The Product passed: Row ~= " . $row_count . " Category '" . $row[$cat] . "' not found on page 'Category and margin' \n";
				$this->adderr($err);
				continue;				
			}
			
			if ($catcreate) {
				$row_product[0]['date_added'] = date('Y-m-d H:i:s');				
				$this->putNewProduct($row_product, 0, $a, 1, 1, $langs, 1, 1, 0, $catmany, $catcreate, $newurl, $refers, $seo_data, $store, 0, 0, 0, 0, 0, $usd);
				continue;
			}			
	
			$rows = '';
			$sku = '';
			$o_optsku = '';
			if ($optsku) {
				if (!empty($row[$cod])) {
					if ($joen == 2 and !empty($row[$sku2]) and !empty($table_sku)) {
						$row1 = $this->getskuDescription($row[$cod], $store);
						$row2 = $this->getskuDescription($row[$sku2], $store);
						if (!empty($row1) and empty($row2)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$row1['sku_id']. "', `sku` = '" . $this->db->escape($row[$sku2]) . "', store_id = '" . (int)$store . "'");	
						}
						if (empty($row1) and !empty($row2)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$row2['sku_id']. "', `sku` = '" . $this->db->escape($row[$cod]) . "', store_id = '" . (int)$store . "'");	
						}
						if (empty($row1) and empty($row2)) {
							$row3 = $this->getMaxSkuID();
							$sku_id = $row3['max(sku_id)'];
							$sku_id = $sku_id + 1;
							$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$sku_id. "', `sku` = '" . $this->db->escape($row[$cod]) . "', store_id = '" . (int)$store . "'");	
							$this->db->query("INSERT INTO " . DB_PREFIX . "suppler_sku_description SET `sku_id` = '" .$sku_id. "', `sku` = '" . $this->db->escape($row[$sku2]) . "', store_id = '" . (int)$store . "'");
						}					
					}
					$o_optsku = $row[$cod];							
					$rows  = $this->getOptionSKU($o_optsku);					
					if (!empty($rows)) {
						$product_id = $rows[0]['product_id'];						
						$o_option_id = $rows[0]['option_id'];
						$o_option_value_id = $rows[0]['option_value_id'];
						$rows  = $this->getProductsByID($product_id);
						if (!empty($rows)) $sku = $rows[0]['sku'];	
					} else {						
						if (!empty($table_sku)) {
							$rows1  = $this->getJoinOptSKU($o_optsku, $store);
							foreach ($rows1 as $r) {	
								$rows2 = '';
								if ($o_optsku != $r['sku']) $rows2  = $this->getOptionSKU($r['sku']);
								if (!empty($rows2)) {	
									$product_id = $rows2[0]['product_id'];						
									$o_option_id = $rows2[0]['option_id'];
									$o_option_value_id = $rows2[0]['option_value_id'];							
									$rows  = $this->getProductsByID($product_id);
									if (!empty($rows)) {	
										$sku = $rows[0]['sku'];
										$o_optsku = $r['sku'];
									}
								}
							}
						} else {
							$rows  = $this->getProductBySKU($o_optsku, $store);
							if (!empty($rows)) $sku = $o_optsku;	
						}	
					}	
					if (!$sku and !empty($row[$newproduct])) {
						$sku = $old_sku;
						if (!empty($table_sku)) {
							$rows = $this->getProduct($sku, $store);
							if (!empty($rows)) $sku = $rows[0]['sku'];
						} else {
							$rows  = $this->getProductBySKU($sku, $store);							
						}	
					}
					if (($old_sku == 'FF30884Rjklr07754' and !$sku) or (!$sku and empty($row[$newproduct]))) {
						if (!empty($table_sku)) {
							$rows = $this->getProduct($o_optsku, $store);
							if (!empty($rows)) $sku = $rows[0]['sku'];
						} else {
							$rows  = $this->getProductBySKU($o_optsku, $store);
							if (!empty($rows)) $sku = $o_optsku;
						}	
					}				
				}
			} else {
				if (!empty($row[$cod])) {					
					if (!empty($table_sku)) {
						$rows = $this->getProduct($row[$cod], $store);
						if (!empty($rows)) $sku = $rows[0]['sku'];
					} else {
						$rows  = $this->getProductBySKU($row[$cod], $store);
						$sku = $row[$cod];	
					}	
				}	
				if (!empty($row[$sku2])) {
					if (empty($rows)) {
						if (!empty($table_sku)) {
							$rows = $this->getProduct($row[$sku2], $store);
							if (!empty($rows)) $sku =  $rows[0]['sku'];	
						} else {
							$rows  = $this->getProductBySKU($row[$sku2], $store);
							$sku = $row[$sku2];	
						}	
					} else {
						if ($joen == 1) {
							$row1 = '';
							if (!empty($row[$cod])) $row1 = $this->getskuDescription($row[$cod], $store);
							if (!empty($row1)) $this->addSkuToTable($row[$sku2], $row1['sku_id'], $store);
							else if (!empty($row[$cod])) {
								$rows1  = $this->getProductBySKU($row[$cod], $store);
								if (!empty($rows1)) {
									$last_sku_id = 0;
									$this->addSkuToTable($row[$cod], $last_sku_id, $store);			
									$this->putsku($rows1[0]['product_id'], $last_sku_id);
									$this->addSkuToTable($row[$sku2], $last_sku_id, $store);
									$sku = $rows1[0]['sku'];
								}
							}					
						}					
					}
					if (!empty($rows) and $stay) $rows[0]['sku'] = $row[$sku2];
				}
			}
			
			if (!empty($row[$cod]) and $old_sku != $sku and $old_sku != 'FF30884Rjklr07754' and $max_opt and ($upopt or $yml))	{
				if ($minPriceOptionPlus and $old_product_id) {
					$summa = 0;
					$rows1 = $this->getProductAllOptionValue($old_product_id);
					if (!empty($rows1)) {						
						for ($j=0; $j<=100; $j++) {				
							$popt = 0;	
							if (!isset($rows1[$j]['price'])) break;
							$summa = $summa + (int)$rows1[$j]['quantity'];
							if ($rows1[$j]['price_prefix'] == '=') {
								$popt = (float)$rows1[$j]['price'] - (float)$price_on_site;							
								$prefix = '+';
								if ($popt<0) $prefix = '-';							
								$popt = abs($popt);
								$popt = round($popt,2);	
								if ($rows1[$j]['price'] != 0 and $price_on_site != 999999999999) $this->upOptionPlus($rows1[$j]['product_option_value_id'], $popt, $prefix);
							}	
						}
						$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `quantity` = '" . $summa . "' WHERE `product_id` = '" . $old_product_id ."'");
					}
					$e = 0;
					if ($my_price == 1) $e = 1;
					if ($my_price == 2 and (float)$oldprice < (float)$price_on_site) $e = 1;
					if ($my_price == 3 and (float)$oldprice > (float)$price_on_site) $e = 1;	
					if ($e) {
						$rows1 = $this->getProductBySKU($old_sku, $store);
						if (!empty($rows1) and $price_on_site) {
							if ($summa) {
								if  ($price_on_site == 999999999999) $price_on_site = $oldprice;
								$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `price` = '" . $price_on_site . "' WHERE `product_id` = '" . $rows1[0]['product_id'] ."'");							
							} else {
								$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `price` = '" . $oldprice . "' WHERE `product_id` = '" . $rows1[0]['product_id'] ."'");
							}	
						}
					}
					
				} else {
					if ($old_product_id and !$jopt) {
						$rows1 = $this->getProductAllOptionValue($old_product_id);
						if (!empty($rows1)) {
							$summa = 0;
							for ($j=0; $j<=100; $j++) {
								if (!isset($rows1[$j]['price'])) break;
								$summa = $summa + (int)$rows1[$j]['quantity'];								
							}
							$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `quantity` = '" . $summa . "' WHERE `product_id` = '" . $old_product_id ."'");
						}	
					}	
				}
				$price_on_site = 999999999999;				
			}

			if (!empty($rows)) {
				if ($old_product_id != $rows[0]['product_id']) $old_product_id = $rows[0]['product_id'];
			}	

			if (!empty($sku)) $row[$cod] = $sku;
				else if (empty($row[$cod]) and isset($row[$sku2]) and !empty($row[$sku2])) $row[$cod] = $row[$sku2];
			
			$row_product  = $rows;			
			
			if ($ad == 9 and empty($rows)) {
				$err = " Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
				$this->adderr($err);
				continue;
			}

			if (preg_match('/^[a-zA-Zа-яА-Я _-]+$/', $row[$price]) and $ad != 2 and $ad != 12) {				
				$err = " The row passed: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Invalid price of product \n";
				$this->adderr($err);
				continue;
			}
			
			$product_found = 0;
			$zero_prod = 0;
			$off_prod = 0;
			if (!empty($rows)) $product_found = 1;
			if (empty($rows) and $ad == 2) continue;
			if (empty($rows) and $ad == 4) continue;		
			
			if ($product_found and $ad != 3) {
			
		/**************/		
				if (!preg_match('/^[0-9]+$/', $manuf) and !empty($manuf) and $umanuf) {
					if (empty($row[$parsm])) {
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parsm."\n";
						$this->adderr($err);						
						continue;
					}
					$url = $this->checkurl($row[$parsm]);
					if ($url == -1) {
						$err = " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parsm]. " in column = ".$parsm."\n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						continue;
					}
					if (strlen($ht) < 1024 or $parsed != $parsm) {
						$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
						if (strlen($ht) > 2048) $parsed = $parsm;
						else {
							$parsed = "";
							$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
							$this->adderr($err);
							$row_count = (int)$this->putsos($row_count, $row[$cod]);
							if ($row_count < 0) return 5;
							continue;
						}	
					}
					$in = $this->ParsManufacturer($ht, $mmanuf, $pointm, $placem);					
					if (empty($in) or strlen($in) > 100 ) {
						$err = " The Product passed: Row ~= " . $row_count . " parsing manufacturer fail, manufacturer = " . $in . " \n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						$manuf = 'manuf';
						$row[$manuf] = '';
					} else {
						$manuf = 'manuf';
						$row[$manuf] = $in;
					}	
				}
		/**************/	
				
				$ismain = 0;
				$p = strpos($row_product[0]['model'], "-");
				if (!$p) {
					$p = strpos($row_product[0]['model'], "~");
					if ($p) $ismain = 1;
				}	
				if ($p)	$papka = substr($row_product[0]['model'], $p-1, 1);
				else $papka = 0;
				
				if ($ismain and !$main and $ad != 10 and $row_product[0]['quantity']) {
					$err = " The Product passed: Row ~= " . $row_count . " SKU = " . $row[$cod] . ", because it does not belong to the main supplier \n";
					$this->adderr($err);
					continue;
				}
				
				if ($row[$price] == 0 and !$yml) {				
					$err = " The Product passed: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Zero price of product \n";
					$this->adderr($err);
					continue;
				}			
				
				$newstatus = 0;					
				$quantity = 0;				
				if (preg_match('/^[0-9,]+$/', $qu)) $qus = explode("," , $qu);
				else $qus[0] = 'qu';	
				for ($k=0; $k<20; $k++) {
					$quant = 0;
					if (!isset($qus[$k])) break;
					$quk = $qus[$k];	
					if (isset($row[$quk]) and preg_match('/^[0-9]+$/', $row[$quk])) {
						$quant = (int)$row[$quk];		
					} else {
						if (!empty($my_qu)) {
							if (substr_count($my_qu, "=")) {												
								$t = explode("," , $my_qu);
								foreach ($t as $value) {
									if (isset($value)) {
										$m = explode("=" , $value);
										if (isset($row[$quk]) and isset($m[0]) and isset($m[1]) and preg_match('/^[0-9()-]+$/', $m[1])) {
											if ($m[0] == $row[$quk]) {											
												$posa = strpos($m[1], "(");
												if ($posa) {
													$quant = (int)substr($m[1], 0, $posa);
													$posb = strpos($m[1], ")");
													if ($posb) $newstatus = (int)substr($m[1], $posa+1, $posb-$posa-1);
												} else $quant = (int)$m[1];
											}
										}
									}
								}
							}
						} 					
					}					
					$quantity = $quantity + $quant;
				}

				unset($gus);
				if (empty($newstatus)) $newstatus = 0;
				
				if (!$quantity and preg_match('/^[0-9]+$/', $my_qu)) {
					$quantity = $my_qu;
					if (!$yml) $report = $report."Quantity set by default ";
				}				
				
				$qu_d = array();  // Расчет скидок по процентам от количества
				if (!empty($qu_discount) and substr_count($qu_discount, "=")) {				
					$pj = explode(",", $qu_discount);
					for ($j=0; $j<20; $j++) {		
						if (!isset($pj[$j])) break;
						if (!substr_count($pj[$j], "=")) break;		
						$p = strpos($pj[$j], '=');						
						$q = substr($pj[$j], 0, $p);	
						$q = trim($q)+1-1;
						$q = round($q, 0);
						if (!preg_match('/^[0-9]+$/', $q)) break;	
						$per = substr($pj[$j], $p+1);	
						$per = trim($per)+1.11-1.11;
						$per = round($per, 2);
						if (!preg_match('/^[0-9.]+$/', $per)) break;
						$qu_d['quantity'][$j] = $q;
						$qu_d['percent'][$j] = $per;
					}
				}
				
				$kon_price = 0;
				$new_price = 0;
				$plus = 0;
				$mas = array();
				$identificator = array();	
				if ($cheap and $ad != 2 and $ad != 12 and !$yml and $row_product[0]['sku']) {
					if ($ad == 4 or $quantity or $ad == 10) {
						if (!$refer) {							
							$k = 0;
							for ($l=0; $l<$max_site; $l++) {
								if (!empty($row[$nomkol[$l]])) {
									$url = $this->checkurl($row[$nomkol[$l]]);
									if ($url != -1) {
										$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);				
										if (strlen($ht) > 1024) {
										
											$this->saveRef($row_product[0]['product_id'], $ident[$l], $url);
											
											$pr = $this->ParsPrice($ht, $param[$l], $point[$l], $placep);
											if (!empty($pr)) $pr = $pr*$ratek;
											
											$parsedprice = 0;
											if ($pr) $parsedprice = $pr;
											$this->db->query("UPDATE `" . DB_PREFIX . "suppler_ref` SET `price` = '" . $parsedprice . "' WHERE `product_id` = '" .(int)$row_product[0]['product_id'] . "' and `ident` = '" . $ident[$l] ."'");
											
											if (!empty($pr) and $pr > $row_product[0]['price']/2) {
												if (!empty($noprice[$l])) {
													$nopr = $this->ParsName($ht, $paramnp[$l], $pointnp[$l], 1);
													if (empty($nopr) or !substr_count($nopr, $noprice[$l])) {
														$mas[$k] = round($pr, 2);										
														$identificator[$k] = $ident[$l];
														$k++;
													}
												} else {
													$mas[$k] = round($pr, 2);											
													$identificator[$k] = $ident[$l];
													$k++;
												}	
											}											
										}
									}
								}	
							}
						} else {
							$rows = $this->getReferens($row_product[0]['product_id']);								
							if (!empty($rows)) {
								$k = 0;
								foreach ($rows as $r) {	
									$ht = $this->curl_get_contents($r['url'], 0, $sleep, $ffile);
									if (strlen($ht) > 1024) {
										$ff = 0;
										for ($l=0; $l<$max_site; $l++) {
											if ($r['ident'] == $ident[$l]) {
												$ff = 1;
												break;
											}	
										}
										if ($ff) {
											$pr = $this->ParsPrice($ht, $param[$l], $point[$l], $placep);
											if (!empty($pr)) $pr = $pr*$ratek;
											if (!empty($pr) and $pr > $row_product[0]['price']/2) {		
												if (!empty($noprice[$l])) {
													$nopr = $this->ParsName($ht, $paramnp[$l], $pointnp[$l], 1);
													if (empty($nopr) or !substr_count($nopr, $noprice[$l])) {
														$mas[$k] = round($pr, 2);
														$k++;												
													}
												} else {
													$mas[$k] = round($pr, 2);
													$k++;						
												}
											}
										}	
									}
								}
							}
						}
						$l = 100;
						if (!empty($mas)) {
							$min = 1000000000;
							for ($j=0; $j<$k; $j++) {
								if ($mas[$j] <= $min) {
									$min = $mas[$j];
									$l = $j;
								}	
							}
							$sum = 0;
							for ($j=0; $j<$k; $j++) {
								$sum = $sum + $mas[$j];
							}	
							$sum = $sum/$j;
							$maxp = 0;
							$m = 100;
							for ($j=0; $j<$k; $j++) {
								if ($mas[$j] >= $maxp) {
									$maxp = $mas[$j];
									$m = $j;
								}	
							}
							$optimal = $sum;
							if (count($mas) == 2) $optimal = ($mas[0]+$mas[1])/2;
							if (count($mas) > 2) {
								$optimal = 0;
								for ($j=0; $j<$k; $j++) {
									$w = 3;
									if ($j==$l) $w = 1;									
									if ($j==$m) $w = 2;
									$optimal = $optimal + $mas[$j] * $w;	
								}
								$optimal = $optimal/($j*3-3);							
							}	
							$submin = 1000000000;
							$mas[$l] = 999999999;
							for ($j=0; $j<$k; $j++) {
								if ($mas[$j] <= $submin) $submin = $mas[$j];
							}
							if ($submin > 999999998) $submin = $min;
							$po = strpos($onn, '%');
							if ($po) $onnn = substr($onn, 0, $po);
							else $onnn = $onn;
							switch ($cheap) {			
								case 1:									
									if ($po) $new_price = $min - $min*$onnn/100;
									else $new_price = $min - $onnn;
									break;
								case 2:									
									if ($po) $new_price = $sum - $sum*$onnn/100;
									else $new_price = $sum - $onnn;		
									break;
								case 3:									
									if ($po) $new_price = $maxp - $maxp*$onnn/100;
									else $new_price = $maxp - $onnn;
									break;
								case 4:									
									if ($po) $new_price = $optimal - $optimal*$onnn/100;
									else $new_price = $optimal - $onnn;
									break;
								case 5:									
									if ($po) $new_price = $min + $min*$onnn/100;
									else $new_price = $min + $onnn;
									break;
								case 6:									
									if ($po) $new_price = $sum + $sum*$onnn/100;
									else $new_price = $sum + $onnn;		
									break;
								case 7:									
									if ($po) $new_price = $maxp + $maxp*$onnn/100;
									else $new_price = $maxp + $onnn;
									break;
								case 8:									
									if ($po) $new_price = $optimal + $optimal*$onnn/100;
									else $new_price = $optimal + $onnn;
									break;			
							}
							if (!$price_parsed) $pr = $row[$price]*$rate;  // сначала, умножаем на курс	
							else $pr = $row[$price]*$ratep;
							
							$ff = 1;
							$plus = 0;
							$prr = $pr;
							if ($ad == 4 or $quantity or $ad == 10) {
								if (!$flag and $my_price != 4 and !$cprice and (empty($myplus) or $row[$myplus] == '')) {
									$rows = $this->getProductCategory($row_product[0]['product_id']);
									if (!isset($rows) or empty($rows)) {							
										$err = " The Product missing: Row ~= " . $row_count . " SKU = " . $row[$cod] . " error in database: unknown category \n";
										$this->adderr($err);
										$ff = 0;
										continue;
									}
									if (!empty($rows)) {
										$cat_id = $rows[0]['category_id'];
										foreach ($rows as $value) {
											if ($cat_id < $value['category_id']) 
												$cat_id = $value['category_id'];							
										}
										$rows = $this->getMargin($form_id, $cat_id);
									} else $rows = '';	

									if ((!isset($rows) or empty($rows)) and !$ignore_margin) {							
										if (!$yml) {
											$err =  " Warning: Can not calculate margin. Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
											$this->adderr($err);
										}	
								//		$ff = 0;
									} else {
										$text = '';
										if (!empty($rows)) $text = $rows[0]['cat_plus'];							
										if (!empty($text)) {
											if (preg_match('/^[-0-9,.+]+$/', $text)) {
												$plus = str_replace(',','.',$text);
											} else {
												$pj = explode(",", $text);
												for ($j=0; $j<60; $j++) {
													if (!isset($pj[$j])) break;
													if (!substr_count($pj[$j], "(")) continue;
													if (!substr_count($pj[$j], ")")) continue;
													$pj[$j] = str_replace('(','',$pj[$j]);		
													$p = strpos($pj[$j], ')');
													if (!$p) continue;
													$d = substr($pj[$j], 0, $p);
													$p12 = explode("-", $d);
													$p1 = trim($p12[0]);
													$p2 = trim($p12[1]);
													if ($pr >= $p1 and $pr <= $p2) {
														$plus = substr($pj[$j], $p+1);			
														$plus = trim($plus);
														break;
													}
												}	
											}
											if (!empty($plus) and !$ignore_margin) $report = $report."Margin added success. ";
										}
									}
								} else {
									if (!empty($myplus) and $my_price != 4 and preg_match('/^[0-9,.Ee+]+$/', $row[$myplus]) and $row[$myplus] != '0') {
										$plus = str_replace(',','.',$row[$myplus]);							
									} else {
										if ((empty($cat_plus[$i]) or $cat_plus[$i] == 0) and $my_price != 4 and $cprice) {
											if (!$price_parsed) $a = $rate;
											else $a = $ratep;
											$doll = $pr/$a + 0.01 - 0.01;	// переведем цену в доллары					
					
						// Таблица наценок. Зависит от цены товара в долларах. $m - множитель 
			
											if ($doll > 500.00) $m = 1.01;   // 1%
											if ($doll <= 500.00) $m = 1.05;  // 5%
											if ($doll <= 200.00) $m = 1.06;
											if ($doll <= 100.00) $m = 1.1;			
											if ($doll <= 50.00) $m = 1.07;	
											if ($doll <= 30.00) $m = 1.15;
											if ($doll <= 20.00) $m = 1.2;
											if ($doll <= 10.00) $m = 1.35;
											if ($doll <= 5.00) $m = 1.4;
											if ($doll <= 4.00) $m = 1.5;
											if ($doll <= 3.00) $m = 1.6;
											if ($doll <= 2.00) $m = 1.7;
											if ($doll <= 1.40) $m = 1.8;
											if ($doll <= 1.20) $m = 1.9;
											if ($doll <= 1.00) $m = 2.0;	// 100 процентов				
					
											$plus = 100*($m-1);
											$report = $report."Margin set by formula. ";
								
										} else {
											if (!empty($cat_plus[$i]) and $row[$myplus] != '0') {
												if (preg_match('/^[-0-9,.+]+$/', $cat_plus[$i])) {
													$plus = str_replace(',','.',$cat_plus[$i]);
												} else {
													$pj = explode(",", $cat_plus[$i]);
													for ($j=0; $j<60; $j++) {
														if (!isset($pj[$j])) break;
														if (!substr_count($pj[$j], "(")) continue;
														if (!substr_count($pj[$j], ")")) continue;
														$pj[$j] = str_replace('(','',$pj[$j]);		
														$p = strpos($pj[$j], ')');
														if (!$p) continue;
														$d = substr($pj[$j], 0, $p);
														$p12 = explode("-", $d);
														$p1 = trim($p12[0]);
														$p2 = trim($p12[1]);
														if ($pr >= $p1 and $pr <= $p2) {
															$plus = substr($pj[$j], $p+1);
															$plus = trim($plus);
															break;
														}
													}	
												}
												if (!empty($plus) and !$ignore_margin) $report = $report."Margin added success ";
											}	
										}
									}
								}					
							}		
							if ($ignore_margin) $plus = 0;
							if ($ff or (!$ff and $ignore_margin)) {
								if (!substr_count($plus, "+")) $pr = $pr + $pr * $plus/100;
								else {
									$pl = explode("+", $plus);									
									if (isset($pl[0]) and !empty($pl[0])) $pr = $pr + $pr * $pl[0]/100;
									if (isset($pl[1]) and !empty($pl[1])) $pr = $pr + $pl[1];									
								}
							}
														
							$rows = $this->getBasePrice($row_product[0]['product_id']);
							if (empty($rows)) {	
								$this->db->query("INSERT INTO `" . DB_PREFIX . "suppler_base_price` SET `product_id` = '" . (int)$row_product[0]['product_id'] . "', `bmin` = '" . $min . "', `bav` = '" . $sum . "', `bmax` = '" . $maxp . "'");
							} else {
								$this->db->query("UPDATE `" . DB_PREFIX . "suppler_base_price` SET `bmin` = '" . $min . "', `bav` = '" . $sum . "', `bmax` = '" . $maxp . "' WHERE `product_id` = '" . (int)$row_product[0]['product_id'] . "'");
							}	
	
							if (!preg_replace('/[^0-9]/','',$bprice) or !isset($row[$bprice])) $bpr = 0;
							else $bpr = strip_tags($row[$bprice]);
							$bpr = preg_replace('/[^0-9.,Ee+-]/','',$bpr);
							$bpr = str_replace(',', '.',$bpr);
							$bpr = trim($bpr);
							$bpr = $bpr*$rate;
							$bpr = round($bpr, 2);							
							$bprr = $bpr;
							$bdprr = $bpr;
							if (!empty($disc)) $bdprr = $bpr - $bpr*$disc/100;							
							if (!empty($disc)) $pr = $pr - $pr*$disc/100;
							
							if ($pr > $new_price) {								
								if (!empty($disc)) $bpr = $bpr - $bpr*$disc/100;								
								if ($bpr > $new_price) {
									switch ($kmenu) {
										case '0': $new_price = 0;
											break;
										case '1': $zero_prod = 1;
												$new_price = $row_product[0]['price'];
											break;
										case '2': $off_prod = 1;
												$new_price = $row_product[0]['price'];
											break;
										case '3': $new_price = $bpr*1.01;
											break;
										case '4': 
											if ($po) $new_price = $min - $min*$onnn/100;
											else $new_price = $min - $onnn;											
											break;
										case '5': 
											if ($po) $new_price = $submin - $submin*$onnn/100;
											else $new_price = $submin - $onnn;											
											break;	
									}		
								}
							}							
							
							$percent_to_price = 0;
							if ($prr) $percent_to_price = 100*($new_price-$prr)/$prr;
							$percent_to_bprice = 0;
							if ($bprr) $percent_to_bprice = 100*($new_price-$bprr)/$bprr;
							$percent_to_bdprice = 0;
							if ($bdprr) $percent_to_bdprice = 100*($new_price-$bdprr)/$bdprr;
	
							$this->db->query("UPDATE `" . DB_PREFIX . "suppler_base_price` SET `optimal` = '" . $optimal . "', `market_percent_to_price` = '" . $percent_to_price . "', `market_percent_to_bprice` = '" . $percent_to_bprice . "', `market_percent_to_bdprice` = '" . $percent_to_bdprice . "' WHERE `product_id` = '" . (int)$row_product[0]['product_id'] . "'");
							
						} else {
							switch ($zero) {
								case '0': $new_price = 0;
									break;
								case '1': $zero_prod = 1;
										  $new_price = 0;
									break;
								case '2': $off_prod = 1;
										  $new_price = 0;
									break;
							}
						}	
					}		
				}
	
				unset($mas);
				unset($identificator);
	
				if ($new_price) $kon_price = 1;
				$old_price = $row_product[0]['price'];				
				if (!$new_price and $ad != 2 and $ad != 12) {	
					$ff = 1; // Категория не найдена на стр Данные, ценa не меняется, если не включено: Игнорировать маржу
					$plus = 0;					
					if (!$price_parsed) $row[$price] = $row[$price]*$rate;  // сначала, умножаем на курс	
					else $row[$price] = $row[$price]*$ratep;
					if ($ad == 4 or $quantity or $ad == 10) {
						if (!$flag and $my_price != 4 and !$cprice and (empty($myplus) or $row[$myplus] == '')) {
							$rows = $this->getProductCategory($row_product[0]['product_id']);
							if (!isset($rows) or empty($rows) and !$yml) {							
								$err = " The Product missing: Row ~= " . $row_count . " SKU = " . $row[$cod] . " error in database: unknown Category \n";
								$this->adderr($err);
								continue;
							}
							if (!empty($rows)) {
								$cat_id = $rows[0]['category_id'];
								foreach ($rows as $value) {
									if ($cat_id < $value['category_id']) 
										$cat_id = $value['category_id'];							
								}
								$rows = $this->getMargin($form_id, $cat_id);
							} else $rows = '';							

							if ((!isset($rows) or empty($rows)) and !$ignore_margin) {							
								if (!$yml) {
									$err =  " Warning: can not calculate margin. Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
									$this->adderr($err);
								}	
						//		$ff = 0;
							} else {
								$text = '';
								if (!empty($rows)) $text = $rows[0]['cat_plus'];
								if (!empty($text)) {
									if (preg_match('/^[-0-9,.+]+$/', $text)) {
										$plus = str_replace(',','.',$text);
									} else {
										$pj = explode(",", $text);
										for ($j=0; $j<60; $j++) {
											if (!isset($pj[$j])) break;
											if (!substr_count($pj[$j], "(")) continue;
											if (!substr_count($pj[$j], ")")) continue;
											$pj[$j] = str_replace('(','',$pj[$j]);		
											$p = strpos($pj[$j], ')');
											if (!$p) continue;
											$d = substr($pj[$j], 0, $p);
											$p12 = explode("-", $d);
											$p1 = trim($p12[0]);
											$p2 = trim($p12[1]);
											if ($row[$price] >= $p1 and $row[$price] <= $p2) {
												$plus = substr($pj[$j], $p+1);			
												$plus = trim($plus);
												break;
											}
										}	
									}
									if (!empty($plus) and !$ignore_margin and !$yml) $report = $report."Margin added success ";	
								}
							}
						} else {
							if (!empty($myplus) and $my_price != 4 and preg_match('/^[0-9,.Ee+]+$/', $row[$myplus]) and $row[$myplus] != '0') {
								$plus = str_replace(',','.',$row[$myplus]);							
							} else {
								if ((empty($cat_plus[$i]) or $cat_plus[$i] == 0) and $my_price != 4 and $cprice) {
									if (!$price_parsed) $a = $rate;
									else $a = $ratep;
									$doll = $row[$price]/$a + 0.01 - 0.01;	// переведем цену в доллары					
					
				// Таблица наценок. Зависит от цены товара в долларах. $m - множитель 
			
									if ($doll > 500.00) $m = 1.01;   // 1%
									if ($doll <= 500.00) $m = 1.05;  // 5%
									if ($doll <= 200.00) $m = 1.06;
									if ($doll <= 100.00) $m = 1.1;			
									if ($doll <= 50.00) $m = 1.07;	
									if ($doll <= 30.00) $m = 1.15;
									if ($doll <= 20.00) $m = 1.2;
									if ($doll <= 10.00) $m = 1.35;
									if ($doll <= 5.00) $m = 1.4;
									if ($doll <= 4.00) $m = 1.5;
									if ($doll <= 3.00) $m = 1.6;
									if ($doll <= 2.00) $m = 1.7;
									if ($doll <= 1.40) $m = 1.8;
									if ($doll <= 1.20) $m = 1.9;
									if ($doll <= 1.00) $m = 2.0;	// 100 процентов				
					
									$plus = 100*($m-1);
									if (!$yml) $report = $report."Margin set by formula ";
								
								} else {
									if (isset($cat_plus[$i]) and !empty($cat_plus[$i]) and isset($row[$myplus]) and $row[$myplus] != '0') {
										if (preg_match('/^[-0-9,.+]+$/', $cat_plus[$i])) {
											$plus = str_replace(',','.',$cat_plus[$i]);
										} else {
											$pj = explode(",", $cat_plus[$i]);
											for ($j=0; $j<60; $j++) {
												if (!isset($pj[$j])) break;
												if (!substr_count($pj[$j], "(")) continue;
												if (!substr_count($pj[$j], ")")) continue;
												$pj[$j] = str_replace('(','',$pj[$j]);		
												$p = strpos($pj[$j], ')');
												if (!$p) continue;
												$d = substr($pj[$j], 0, $p);
												$p12 = explode("-", $d);
												$p1 = trim($p12[0]);
												$p2 = trim($p12[1]);
												if ($row[$price] >= $p1 and $row[$price] <= $p2) {
													$plus = substr($pj[$j], $p+1);
													$plus = trim($plus);
													break;
												}
											}	
										}
										if (!empty($plus) and !$ignore_margin and !$yml) $report = $report."Margin added success ";
									}	
								}
							}
						}					
					}					
					if ($yml) $ignore_margin = 1;
					if ($ignore_margin) $plus = 0;
	
					if ($ff or (!$ff and $ignore_margin)) {
						if (!substr_count($plus, "+")) $new_price = $row[$price] + ($row[$price] * $plus/100);			
						else {
							$pl = explode("+", $plus);	
							$f = 0;
							if (isset($pl[0]) and !empty($pl[0])) {
								$new_price = $row[$price] + ($row[$price] * $pl[0]/100);
								$f = 1;
							}
							if (isset($pl[1]) and !empty($pl[1]) and $f) $new_price = $new_price + $pl[1];
							if (isset($pl[1]) and !empty($pl[1]) and !$f) $new_price = $row[$price] + $pl[1];
						}	
					}					
				}				
					
				$n = round($new_price, 2); 	// округление цены до копеек, 2 цифры после запятой
				if (!$new_price and $ad != 10 and !$yml) $report = $report."Price not updated ";
	
				$price_changed = 0;
				if ((!$row_product[0]['quantity'] and $quantity and $new_price and $ad != 2 and $ad != 12 and $my_price == 1) or $ad == 10 or ($yml and $n)) {
					$row_product[0]['price'] = $n;
					$price_changed = 1;
					if ($n) $report = $report."Price updated ";
				} else {				
					if (($my_price == 1 and $quantity and $new_price and $ad != 2 and $ad != 12) or ($my_price == 1 and $new_price and $ad == 10)) {
						$row_product[0]['price'] = $n;
						$price_changed = 1;
						$report = $report."Price updated ";
					} else { 
						if ($kon_price) { // Цена установлена по конкурентам
							$equ = 0;
							$p = strpos($row_product[0]['model'], "-");
							if (!$p) $p = strpos($row_product[0]['model'], "~");
							
							if (preg_match('/^[0-9-~]+$/', $row_product[0]['model']) and $p > 0) {
								$nom = substr($row_product[0]['model'], $p+1, 2);
								if ((int)$id == (int)$nom) $equ = 1;
							}
							$rows = $this->getBasePrice($row_product[0]['product_id']);
							if (!empty($rows) and isset($row[$bprice]) and !empty($row[$bprice])) {
								$old_bprice = $rows[0]['bprice'];
								$pr = $row[$bprice];
								$pr = preg_replace('/[^0-9.,Ee+-]/','',$pr);
								$pr = str_replace(',', '.',$pr);
								$pr = trim($pr);
								$new_bprice = $pr*$rate;								
								if (($my_price == 2 and $new_bprice and $new_bprice > $old_bprice and $quantity and $ad != 2 and $ad != 12) or ($my_price == 2 and $new_bprice and $new_bprice > $old_bprice and $ad == 10) or  ($equ and $ad != 2 and $ad != 12)){
									$row_product[0]['price'] = $n;
									$price_changed = 1;
									$report = $report."Price updated ";
								} else {
									if (($my_price == 3 and $new_bprice and $new_bprice < $old_bprice and $quantity and $ad != 2 and $ad != 12) or ($my_price == 3 and $new_bprice and $new_bprice < $old_bprice and $ad == 10) or ($equ and $ad != 2 and $ad != 12)) {
										$row_product[0]['price'] = $n;
										$price_changed = 1;
										$report = $report."Price updated ";
									}								
								}
							}
						} else {					
							if (($my_price == 2 and $new_price and $new_price > $old_price and $quantity and $ad != 2 and $ad != 12) or ($my_price == 2 and $new_price and $new_price > $old_price and $ad == 10)) {
								$row_product[0]['price'] = $n;
								$price_changed = 1;
								$report = $report."Price updated ";
							} else {
								if (($my_price == 3 and $new_price and $new_price < $old_price and $quantity and $ad != 2 and $ad != 12) or ($my_price == 3 and $new_price and $new_price < $old_price and $ad == 10)) {
									$row_product[0]['price'] = $n;
									$price_changed = 1;
									$report = $report."Price updated ";															
								}
							}
						}						
					}
				}				
				
				// Обновление акционных цен
				$ff = 0;
				if ((!empty($aprice) and $quantity and $ad != 2 and $ad != 12) or (!empty($aprice) and ($ad == 4 or $ad == 10))) {
					$this->deleteActionPrice($row_product[0]['product_id']);
					for ($j=0; $j<20; $j++) {
						if (!isset($aprice[$j])) break;
						if (empty($aprice[$j])) continue;
						$data['product_id'] = $row_product[0]['product_id'];
						$data['customer_group_id'] = $j+1;
						$data['priority'] = 1;
						$pr = $row[$aprice[$j]];
						$pr = preg_replace('/[^0-9.Ee,+-]/','',$pr);
						$pr = str_replace(',', '.',$pr);
						$pr = trim($pr);
						if (!preg_match('/^[0-9.Ee+-]+$/', $pr)) $pr = '';
						else $pr = $pr*$rate;
						if (round($pr, 0) > round($new_price, 0)) $pr = '';
						$data['price'] = $pr;
						$data['date_start'] = "2000-01-01";
						$data['date_end'] = "2040-01-01";
						if ($pr) {							
							$this->putActionPrice($data);
							$ff = 1;
						}
					}	
				}
				if ($ff) $report = $report."Special price updated ";
				
				// Скидочные цены, скидки
				$ff = 0;
				if ((count($mprice) > 1 and $ad != 2 and $ad != 12 and $quantity) or (count($mprice) > 1 and ($ad == 4 or $ad == 10))) {
					$this->deleteWholesale($row_product[0]['product_id']);
					for ($j=1; $j<20; $j++) {
						if (!isset($mprice[$j])) break;
						if (empty($mprice[$j])) continue;						
						$data['product_id'] = $row_product[0]['product_id'];
						$data['customer_group_id'] = $j;
						$data['priority'] = 1;
						$pr = $row[$mprice[$j]];
						$pr = preg_replace('/[^0-9.Ee,+-]/','',$pr);
						$pr = str_replace(',', '.',$pr);
						$pr = trim($pr);
						if (!preg_match('/^[0-9.Ee+-]+$/', $pr)) $pr = '';
						else $pr = $pr*$rate;
						if (round($pr, 0) > round($new_price, 0)) $pr = '';						
						$data['price'] = $pr;
						$data['quantity'] = 1;
						$data['date_start'] = "2000-01-01";
						$data['date_end'] = "2040-01-01";
						if ($pr) {
							$this->putWholesale($data);
							$ff = 1;
						}	
					}
				} else {
					if (count($mprice) == 1 and !empty($qu_d) and $ad != 2 and $ad != 12) {
						$this->deleteWholesale($row_product[0]['product_id']);
						for ($j=1; $j<20; $j++) {							
							$data['product_id'] = $row_product[0]['product_id'];
							$data['customer_group_id'] = $j;
							$data['priority'] = 1;
							for ($k=0; $k<20; $k++) {
								if (!isset($qu_d['quantity'][$k])) break;								
								$data['price'] = $new_price-$new_price*$qu_d['percent'][$k]/100;
								$data['quantity'] = $qu_d['quantity'][$k];
								$data['date_start'] = "2000-01-01";
								$data['date_end'] = "2040-01-01";
								if ($data['price']) {
									$this->putWholesale($data);
									$ff = 1;
								}
							}
						}
					}
				}	
				unset($qu_d);
				
				if ($ff) $report = $report."Wholesale price updated ";
				
				if ((!empty($bonus) and $ad != 2 and preg_match('/^[0-9,]+$/', $bonus) and $ad != 12) or $ad == 10) { // бонусы
					$bb = explode(',', $bonus);					
					for ($j=0; $j<count($bb); $j++) {
						if ($j == 0) {							
							if (preg_match('/^[0-9]+$/', $bb[0]) and $row[$bb[0]] == '0') $this->deleteBonus0($row_product[0]['product_id']);
							else if (!empty($row[$bb[$j]])) $this->Bonus0($row_product[0]['product_id'], $row[$bb[0]]);
						} else {
							if (preg_match('/^[0-9]+$/', $bb[$j]) and $row[$bb[$j]] == '0') 
								$this->deleteBonus1($j, $row_product[0]['product_id']);
								
							if (preg_match('/^[0-9]+$/', $bb[$j]) and !empty($row[$bb[$j]]) and $row[$bb[$j]] != '0') 
								$this->Bonus1($j, $row_product[0]['product_id'], $row[$bb[$j]]);
							
						}	
					}	
				}
				
				$equ = 0;
				$p = strpos($row_product[0]['model'], "-");
				if (!$p) $p = strpos($row_product[0]['model'], "~");
				if (preg_match('/^[0-9-~]+$/', $row_product[0]['model']) and $p > 0) {
					$nom = substr($row_product[0]['model'], $p+1, 2);
					if ((int)$id == (int)$nom) $equ = 1;
				}
	
				$quantity_changed = 0;
				if ((!$quantity and $equ and $ad != 4 and $ad != 12) or (!$quantity and $ad == 10)) {
					$row_product[0]['quantity'] = 0;
					$quantity_changed = 1;
					$report = $report."Quantity was set at zero ";
				}	
				
				if (($quantity and $equ and $ad != 4 and $ad != 12) or ($quantity and $price_changed and $ad != 4 and $ad != 12) or ($quantity and $equ and $ad != 4 and $ad != 12) or $ad == 2 or $ad == 10) {
					$row_product[0]['quantity'] = $quantity;
					$quantity_changed = 1;
					if (!$yml) $report = $report."Quantity updated ";					
				}
		
				if ($price_changed) {
					$p = strpos($row_product[0]['model'], "-");
					if (!$p) $p = strpos($row_product[0]['model'], "~");
					$nom = substr($row_product[0]['model'], 0, $p);
					if (!$main) $nom = $nom."-";
					else $nom = $nom."~";
					$l = strlen($id);
					if ($l < 2) $nom = $nom."0";
					$nom = $nom.$id;
					if ($ad != 12) {
		//				if (substr_count($row_product[0]['model'], "Series")) $nom = $nom.' '.'Series'; для модуля Серии
						$row_product[0]['model'] = $nom;
						if (!$equ) $report = $report. "Supplier has been changed ";
					}	
				}
				
				$row_product[0]['hide'] = $row_product[0]['status'];				
				if ($quantity_changed and $new_price and $onoff) $row_product[0]['hide'] = 1;
				if ($onoff and (($ad == 2 and $quantity_changed) or $ad == 10)) $row_product[0]['hide'] = 1;
				if ($onoff and (($ad == 4 and $price_changed) or $ad == 10)) $row_product[0]['hide'] = 1;
				if ($off_prod == 1) $row_product[0]['hide'] = 0;
				
				$summa_options = 0;
				if ($old_sku != $row[$cod]) {
					$summa_product_options = 0;
					$oldprice = $old_price;					
				}

				$mas_opt = array();
				$yes_joption = 0;				
				if ($yml) $upopt = 2;
				if ($max_opt and $upopt) {				
					if (($upopt == 2 and $old_sku != $row[$cod] and !$optsku ) or ($upopt == 2 and $optsku and empty($row[$newproduct])))
						$this->cleanQuantityOption($row_product[0]['product_id']);
					$jj = 1;
					for ($j = 1; $j <= $max_opt; $j++) {
						
						if (!$option_id[$j] or empty($opt[$j])) continue;
						
						if (preg_match('/^[0-9]+$/', $opt[$j])) {
							$row[$opt[$j]] = str_replace('&amp;&quot;' , '"' , $row[$opt[$j]]);			
							$row[$opt[$j]] = str_replace('&amp;' , '&' , $row[$opt[$j]]);	
							$row[$opt[$j]] = str_replace('&quot;' , '"' , $row[$opt[$j]]);							
							$opt_val = explode(";" , $row[$opt[$j]]);
						}
	
						if (isset($row[$ko[$j]])) $opt_ko = explode(";" , $row[$ko[$j]]);
						if (isset($row[$po[$j]])) $opt_po = explode(";" , $row[$po[$j]]);
						if (preg_match('/^[0-9]+$/', $prro[$j])) {
							if (isset($row[$prro[$j]])) $opt_pr = explode(";" , $row[$prro[$j]]);
						}	
						if (isset($row[$we[$j]])) $opt_we = explode(";" , $row[$we[$j]]);
						if (isset($row[$art[$j]])) $opt_art = explode(";" , $row[$art[$j]]);
						if (isset($row[$foto[$j]])) $opt_foto = explode(";" , $row[$foto[$j]]);
		
						if (($opt[$j] and !preg_match('/^[0-9]+$/', $opt[$j])) or ($prro[$j] and !preg_match('/^[0-9]+$/', $prro[$j]))) {
							if (isset($row[$parsi]) and !empty($row[$parsi])) {	
								$url = $this->checkurl($row[$parsi]);
								if ($url != -1) {
									$maso = '';
									$masp = '';
									if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
									if (strlen($ht) > 1024) {
										$parsed = $parsi;
										unset($maso);
										unset($masp);
										$maso = '';
										$masp = '';
										$this->ParsOptions($ht, $opt[$j], $opt_point[$j], $prro[$j], $maso, $masp);
									}		
		
									if (!$maso) {
										$err =  " Row ~= " . $row_count . " SKU = " . $row[$cod] ." Error in parameter parsing options: ". $opt[$j] . " price: " . $prro[$j] . " Link: " . $row[$parsi] ." \n";
										$this->adderr($err);
										continue;
									} else {		
										if (isset($opt_val)) unset($opt_val);
										if (isset($opt_pr)) unset($opt_pr);
										for ($l=0; $l<200; $l++) {	
											if (!isset($maso[$l])) break;		
											if ($maso[$l]) $opt_val[$l] = $maso[$l];
											if ($masp[$l]) $opt_pr[$l] = $masp[$l];
											if (empty($prro[$j])) $opt_pr[$l] = '';
										}
									}							
								} else {
									$err =  " Row ~= " . $row_count . " SKU = " . $row[$cod] ." Error link for parsing options in column: ". $parsi . " \n";
									$this->adderr($err);
									continue;
								}
							}	
						}
						for ($l=0; $l<200; $l++) {
							for ($x=0; $x<1; $x++) {	
								$option_foto = '';							
								if (isset($opt_foto[$l])) {
									$url = $opt_foto[$l];									
									$url = $this->checkurl($url);	
									$pic_addr = '';
									$a = strlen($url)-6;
									$en = substr($url, $a);
									if (!substr_count($url, "/") and (stripos($en, '.jpg') or stripos($en, '.png') or stripos($en, '.jpeg') or stripos($en, '.gif') or stripos($en, '.bmp'))) {									
	
										$nom = stripos($url, ".j");
										if (!$nom) $nom = stripos($url, ".png");
										if (!$nom) $nom = stripos($url, ".gif");
										if (!$nom) $nom = stripos($url, ".bmp");
										if (!$nom) break;
										$se = substr($url, $nom);
										$app = substr($url, 0, $nom);
										$nom = strpos($app, ".");
										$app = substr($app, $nom);
										$app = $this->TransLit($app);							
										$app = $this->MetaURL($app);

										$try = "../image/data/temp/".$url;
										if (file_exists($try)) {						
											if (!empty ($pic_int[$i]))	{
												$spath = "../image/data/" .$pic_int[$i]."/";
												$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
												$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
												$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
											} else {
												$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." \n";
												$this->adderr($err);
												break;
											}		
											if (!is_dir($spath)) {
												if (!@mkdir($spath, 0755)) {								
													$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
													$this->adderr($err);
													break;
												}
											}								
											if (!is_dir($path)) @mkdir($path, 0755);								
											$path = $path.$app.$se;	
											$a = @copy ($try, $path);
											if (!$a) {
												$a = @copy ($try, $spath);
												$pic_addr = $spic_addr;
											}											
										}								
									}								
									if (substr_count($url, "/") and (stripos($en, '.jpg') or stripos($en, '.png') or stripos($en, '.jpeg') or stripos($en, '.gif') or stripos($en, '.bmp'))) {	
										$nom = stripos($url, ".j");
										if (!$nom) $nom = stripos($url, ".png");
										if (!$nom) $nom = stripos($url, ".gif");
										if (!$nom) $nom = stripos($url, ".bmp");
										$a = strlen($url);
										if (!$nom or $a - $nom > 5) {
											$se = ".jpg";
											$nom = $a;
										} else $se = substr($url, $nom);	
										$app = '';
										if (!empty($seo_data['prod_photo'])) {
											$data['name'] = '';
											if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
											$data['category'] = '';
											if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
											$data['manufacturer'] = '';
											if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = trim($row[$manuf]);
											$data['model'] = '';
											if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
											$data['brand'] = '';
											if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
											$data['sku'] = '';
											if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
											$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
											$app = $this->TransLit($app);
											$app = strtolower($app);
										}
										if (empty($app)) {
											$app = substr($url, 0, $nom);
											$nom = strpos($app, ".");
											$app = substr($app, $nom+7);
											$app = $this->TransLit($app);
											$nom = strlen($app);
											if ($nom > 250) $app = substr($app, $nom-250, 250);
											if ($nom < 2) $app = rand(0, 999999999);								
											$app = $this->MetaURL($app);
										}								
								
										if (!empty ($pic_int[$i]))	{
											$spath = "../image/data/" .$pic_int[$i]."/";
											$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
											$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
											$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
										} else {
											$path = "../image/data/photo/";											
											$pic_addr = "data/photo/".$app.$se;									
										}		
										if (!is_dir($spath)) {
											if (!@mkdir($spath, 0755)) {								
												$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
												$this->adderr($err);
												break;
											}
										}
										if (!is_dir($path)) @mkdir($path, 0755);
										$path = $path.$app.$se;										
										if (!file_exists($path)) {
											$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);	
											if (!$this->isPicture($pict)) {
												$err =  " Download photo for Option, fails. Row ~= " . $row_count ." Url = ". $url . " Column = " . $foto[$j] . " \n";
												$this->adderr($err);
												break;
											} else {
												$bytes = @file_put_contents($path, $pict);
												if (!$bytes) {
													$bytes = @file_put_contents($spath, $pict);
													$pic_addr = $spic_addr;
												}	
											} 
										}
									}	
									$option_foto = $pic_addr;
								}	
							}
							$e = 0;
							if ((empty($opt_val[$l]) and !isset($opt_val[$l+1]) and !$optsku) or ($optsku and $l > 0) or (isset($row[$art[$j]]) and !isset($opt_art[$l]))) break;			
							
							$data_option['op_val_id'] = 0;
							$rows = $this->getOptionsById($option_id[$j]);	
							if (!empty($rows) and isset($opt_val[$l]) and !empty($opt_val[$l])) {
								if (preg_match('/^[0-9.,Ee+-]+$/', $opt_val[$l])) $opt_val[$l] = (string)round($opt_val[$l],3);
	
								foreach ($rows as $r) {									
									if ((string)$r['name'] == $opt_val[$l]) {	
										$e = 1;
										$data_option['op_val_id'] = $r['option_value_id'];
										break;
									}	
								}
							}							
							if (!$e) {
								if ($addopt and !empty($opt_val[$l])) {
									$this->addValue($option_id[$j], $ovid, $option_foto);							
									$this->addValueDescription($option_id[$j], $ovid, $opt_val[$l], $langs);								
									$data_option['op_val_id'] = $ovid;
									$report = $report." Option value ".$opt_val[$l]." has been added";
								}
							}
						
							if ($e and $upOptionFoto)
								$this->upOptionFoto($option_id[$j], $data_option['op_val_id'], $option_foto);
	
							if (isset($opt_val[$l])) $data_option['opt'] = $opt_val[$l];
	
							$data_option['ko'] = 0;							
							if (isset($opt_ko[$l])) $data_option['ko'] = $opt_ko[$l];
							
							$data_option['optsku'] = '';						
							if (isset($opt_art[$l])) $data_option['optsku'] = $opt_art[$l];							
							elseif ($optsku) $data_option['optsku'] = $o_optsku;
							
							$data_option['pr'] = 0;
							$data_option['pr_prefix'] = '=';						
							if (isset($opt_pr[$l])) {						
								$e = substr($opt_pr[$l], strlen($opt_pr[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') {
									$data_option['pr_prefix'] = $e;								
									$b = substr($opt_pr[$l], 0, strlen($opt_pr[$l])-1);
									$a = $data_option['pr_prefix'];
								} else 	{
									$b = substr($opt_pr[$l], 0, strlen($opt_pr[$l]));
									$a = 0;
								}
								if (preg_match('/^[0-9.,Ee+-]+$/', $b)) {
									$data_option['pr'] = str_replace("," , ".", $b);
									if ($price != $prro[$j]) $data_option['pr'] = $data_option['pr']*$rate;
									
									if ($plusopt and $plus) $data_option['pr'] = $data_option['pr']+($data_option['pr']*$plus/100);
									$data_option['pr'] = round($data_option['pr'], 2);
									if ($a == '=' or !$a) {
										if ($data_option['pr'] and (float)$data_option['pr'] < (float)$price_on_site and (int)$data_option['ko']) {
											$price_on_site = (float)$data_option['pr'];		
										}
									}		
								}	
							}
														
							$data_option['po'] = 0;
							$data_option['po_prefix'] = '=';
							if (isset($opt_po[$l])) {
								$e = substr($opt_po[$l], strlen($opt_po[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') 
								{	
						 	        $data_option['po_prefix'] = $e;							
									$b = substr($opt_po[$l], 0, strlen($opt_po[$l])-1);									
							    } else $b = substr($opt_po[$l], 0, strlen($opt_po[$l]));						
							    if (preg_match('/^[0-9.,Ee+-]+$/', $b)) $data_option['po'] = str_replace("," , ".", $b);
							}	
						
							
							$data_option['we'] = 0;
							$data_option['we_prefix'] = '=';
							if (isset($opt_we[$l])) {
								$e = substr($opt_we[$l], strlen($opt_we[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') 
								{ 	
							      $data_option['we_prefix'] = $e;								
								  $b = substr($opt_we[$l], 0, strlen($opt_we[$l])-1);
								} else  $b = substr($opt_we[$l], 0, strlen($opt_we[$l])); 
								if (preg_match('/^[0-9.,Ee+-]+$/', $b)) $data_option['we'] = str_replace("," , ".", $b);		
							}							
							
							if ($j == 1 and $l == 0 ) $report = $report."Product options updated ";						
														
							$data_option['option_required'] = $option_required[$j];
							$valuta = 0;
							if (isset($row[$usd])) $valuta = $row[$usd];
							$this->upProductOption($row_product[0]['product_id'], $option_id[$j], $data_option, $minus, $ad, $option_type[$j], $my_price, $usd, $valuta);	
	
							if ($option_type[$j] == 'select' or $option_type[$j] == 'radio' or $option_type[$j] == 'image' or $option_type[$j] == 'checkbox') {
								$mas_opt[$jj][$l][0] = $row_product[0]['product_id'];
								$mas_opt[$jj][$l][1] = $option_id[$j];
								$mas_opt[$jj][$l][2] = $data_option['op_val_id'];
								$mas_opt[$jj][$l][3] = $ko[$j];
								$mas_opt[$jj][$l][4] = $data_option['ko'];							
								$mas_opt[$jj][$l][5] = $data_option['pr'];							
								$mas_opt[$jj][$l][6] = $data_option['we_prefix'];							
								$mas_opt[$jj][$l][7] = $data_option['we'];
								$mas_opt[$jj][$l][8] = $data_option['optsku'];
		
								if (isset($summa_product_options)) $summa_product_options = $summa_product_options+$data_option['ko'];
	
								$jj++;
							}
						}	
					}
					if ($jopt) {
						for ($l=0; $l<30; $l++) {
							$gr_data = array();
							$n = 0; $a = ''; $b = '';	
							for ($j=1; $j<=$jj; $j++) {
								if (!isset($mas_opt[$j][$l][0])) continue;
								$m = 0;
								for ($k=1; $k<=$jj; $k++) {
									if (!isset($mas_opt[$k][$l][0])) continue;
									if ($mas_opt[$j][$l][3] == $mas_opt[$k][$l][3] and $j != $k and $a != $mas_opt[$j][$l][1] and $b != $mas_opt[$j][$l][2]) {								
										$a = $mas_opt[$j][$l][1];
										$b = $mas_opt[$j][$l][2];
										$n++;
										$m++;
										$gr_data[$n][0] = $l;
										$gr_data[$n][1] = $row_product[0]['product_id'];
										$gr_data[$n][2] = $mas_opt[$j][$l][1];
										$gr_data[$n][3] = $mas_opt[$j][$l][2];
										$gr_data[$n][4] = $mas_opt[$j][$l][4];
										$gr_data[$n][5] = $mas_opt[$j][$l][5];
										$gr_data[$n][6] = $mas_opt[$j][$l][6];
										$gr_data[$n][7] = $mas_opt[$j][$l][7];
										$gr_data[$n][8] = $mas_opt[$j][$l][8];									
									}
								}
							}

							if (!empty($gr_data)) {
								$this->jOption($gr_data);
								unset($gr_data);
								$yes_joption = 1;
							}
						}
					}					
				}
				unset($mas_opt);
	
				if ($yes_joption) {
					$this->summaOption($row_product[0]['product_id'], $summa_options);
					if ($summa_options) $row_product[0]['quantity'] = $summa_options;
				} else {
					if (isset($summa_product_options) and $summa_product_options) $row_product[0]['quantity'] = $summa_product_options;	
				}				
				
				if ($sorder and isset($row[$sorder]) and !empty($row[$sorder]) and $price_changed and $quantity)
					$row_product[0]['sort_order'] = $row[$sorder];
				elseif ($price_changed and $quantity and $row_product[0]['sort_order'] == 100) $row_product[0]['sort_order'] = 0;
				
				$stat = $st_status;
				if ($newstatus) $stat = $newstatus;
				if (!empty($termin) and !empty($row[$termin]) and preg_match('/^[0-9]+$/', $row[$termin]) and !empty($t_status)) {
					$term = (int)trim($row[$termin]);
					$pj = explode(",", $t_status);
					for ($j=0; $j<20; $j++) {		
						if (!isset($pj[$j])) break;
						if (!substr_count($pj[$j], "=")) break;		
						$p = strpos($pj[$j], '=');						
						$q = substr($pj[$j], 0, $p);						
						if (!preg_match('/^[0-9]+$/', $q)) break;
						$q = (int)trim($q);						
						if ($q == $term) {
							$stat = substr($pj[$j], $p+1);
							if (!preg_match('/^[0-9]+$/', $stat)) break;
							$stat = (int)trim($stat);
						}					
					}				
				}
				if ($ad != 4) $row_product[0]['stock_status_id'] = $stat;
				
				if ($yml) {
					$updte = 2;
					$upname = 1;					
				}	
	
				$yes = 0;
				$rating_old =0;
				$l_old = 0;
				$row_product[0]['description'] = '';
				$rows = $this->getProductDesc($row_product[0]['product_id']);
				$row_product[0]['item'] = $rows[0]['name'];
				if (!empty($rows)) {
					$row_product[0]['description'] = $rows[0]['description'];
					if (substr_count($rows[0]['description'], "<br")) $rating_old++;
					if (substr_count($rows[0]['description'], "<strong")) $rating_old++;
					if (substr_count($rows[0]['description'], "<em")) $rating_old++;					
					if (substr_count($rows[0]['description'], "<b")) $rating_old++;
					if (substr_count($rows[0]['description'], "<li")) $rating_old++;
					$l_old = strlen($rows[0]['description']);					
				}	
								
				if (($updte > 1 or $upname or $upurl) and $ad != 2 and $ad != 4){
					$text = "";
					$pname = "";	
					if (!empty($descrip) and preg_match('/^[0-9]+$/', $descrip) and !empty($row[$descrip]) and $updte > 1){		
						$rating_new =0;						
						if (substr_count($row[$descrip], "<br")) $rating_new++;
						if (substr_count($row[$descrip], "<strong")) $rating_new++;
						if (substr_count($row[$descrip], "<em")) $rating_new++;						
						if (substr_count($row[$descrip], "<b")) $rating_new++;
						if (substr_count($row[$descrip], "<li")) $rating_new++;
						$l_new = strlen($row[$descrip]);						
						if ($l_old > $l_new) $rating_old++;
						if ($l_old < $l_new) $rating_new++;
							
						if ($updte == 3 and (empty($row_product[0]['description']) or $rating_new > $rating_old)) {		
							$row_product[0]['description'] = $row[$descrip];
							$yes = 1;
						}
						if ($updte == 2 and !empty($row[$descrip])) {
							if ($yml) {							
								$d = $this->symbol($row[$descrip]);							
								if (!empty($d) and !empty($rows[0]['description']) and !substr_count($rows[0]['description'], $d)) $row_product[0]['description'] = $rows[0]['description']. "&lt;br&gt;" . $d;
								else $row_product[0]['description'] = $row[$descrip];
							} else $row_product[0]['description'] = $row[$descrip];
							$yes = 1;	
						}	
						
					}
					if (!empty($descrip) and !preg_match('/^[0-9]+$/', $descrip) and isset($row[$parsd]) and !$yml) {					
						$url = $this->checkurl($row[$parsd]);
						if ($url != -1) {							
							if ($updte > 1) {												
								if (strlen($ht) < 1024 or $parsed != $parsd) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
								if (strlen($ht) > 1024) {
									$parsed = $parsd;
									$spath = "data/";
									if (isset($pic_int[$i]) and !empty($pic_int[$i])) $spath = "data/" .$pic_int[$i]."/";
									$text = $this->ParsDescription($ht, $descrip, $pointd, $placed, $spath, $row_count, $url, $sleep, $ffile);
									if (strlen($text) < 10) $text = '';
								} else {
									$parsed = '';
									$err =  " Parsing description error: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
									$this->adderr($err);										
								}
							}	
						}	
					}
					
					if (isset($row[$item]) and preg_match('/^[0-9]+$/', $item) and !empty($row[$item]) and $upname )  {	  
						$row_product[0]['item'] = trim($row[$item]);
						$report = $report."Product name updated ";	
					}
					
					if (!empty($item) and !preg_match('/^[0-9]+$/', $item) and ($upname or $upurl) and isset($row[$parsi]) and !$yml) {
						$url = $this->checkurl($row[$parsi]);
						if ($url != -1) {							
							if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
							if (strlen($ht) > 1024) {
								$parsed = $parsi;
								$pname = $this->ParsName($ht, $item, $pointi, $placei);
								if (strlen($pname) < 2) {
									$err =  " Parsing Product Name error: Row ~= " . $row_count . " url = ". $url. " Product Name has not been updated \n";
									$this->adderr($err);
									$pname = "";
								}	
							} else {									
								$err =  " Parsing Product Name error: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
								$this->adderr($err);								
							}	
											
							if (!empty($pname)) {
								$row_product[0]['item'] = $pname;
								$report = $report."Product name parsed and updated ";
							} else $report = $report."Product name has not been parsed ";
						}					
					}						
										
					if (!empty($my_descrip) and empty($text) and !$yes and !$yml) {
						if (!preg_match('/^[0-9]+$/', $my_descrip)) $row_product[0]['description'] = $my_descrip;
						else if (!empty($row[$my_descrip])) $row_product[0]['description'] = $row[$my_descrip];
						$report = $report."Description set by default ";
					} else {
						if (empty($my_descrip) and empty($text) and !$yes and !$yml) {
							$row_product[0]['description'] = '';							
						} else {
							$t = '';
							if (!empty($my_descrip) and preg_match('/^[0-9]+$/', $my_descrip) and !empty($row[$my_descrip]) and !$yml) $t = $row[$my_descrip];
							if (!empty($my_descrip) and !preg_match('/^[0-9]+$/', $my_descrip) and !$yml) $t = $my_descrip;
							if ($ddesc == 1 and !empty($t) and !$yes and !$yml) $text = $t . "&lt;br&gt;&lt;br&gt;". $text;
							if ($ddesc == 2 and !empty($t) and !$yes and !$yml) $text = $text . "&lt;br&gt;&lt;br&gt;". $t;
							if ($ddesc == 1 and !empty($t) and $yes and !$yml) $text = $t . "&lt;br&gt;&lt;br&gt;". $row_product[0]['description'];
							if ($ddesc == 2 and !empty($t) and $yes and !$yml) $text = $row_product[0]['description'] . "&lt;br&gt;&lt;br&gt;". $t;
							
							if (!empty($text) and !$yml) {
								$rating_new =0;						
								if (substr_count($text, "<br")) $rating_new++;
								if (substr_count($text, "<strong")) $rating_new++;
								if (substr_count($text, "<em")) $rating_new++;							
								if (substr_count($text, "<b")) $rating_new++;
								$l_new = strlen($text);
								if ($l_old > $l_new) $rating_old++;
								else $rating_new++;
						
								if ($updte == 3 and ($rating_new > $rating_old or empty($row_product[0]['description']))) {
									$row_product[0]['description'] = $text;
									$report = $report."Description parsed and updated ";
								}								
								if ($updte == 2) {
									$row_product[0]['description'] = $text;
									$report = $report."Description parsed and updated ";
								}	
							} else if (!$yml) $report = $report."Description updated ";							
						}					
					}
				}
	
				$pictures ='';
				$pi = explode(",", $pic_ext);
				if (!empty($parsk)) $pictures[0] = $parsk;					
				else $pictures = $pi;				
	
				$nojpg = 0;
				if ($yml) $newphoto = 2;
				if ($newphoto > 1 and $ad != 2 and $ad != 4) {
					if ($newphoto == 4) $this->deleteProductImage($row_product[0]['product_id']);
					for ($k=0; $k<$np; $k++) {
						if (!isset($pictures[$k])) break;		
						$pic = $pictures[$k];		
						if (isset($row[$pic]) and !empty ($row[$pic])) {
							$url = $row[$pic];
							if (substr_count($url, "/")) $url = $this->checkurl($url);							
							if ($url == -1) continue;								
							$url = str_replace("&#45;", "-", $url);
							$url = str_replace("&amp;", "&", $url);			
						} else {
							if ($k == 0) {
								$url = $this->checkurl($my_photo);
								$url = str_replace("&#45;", "-", $url);
								$url = str_replace("&amp;", "&", $url);
							} else continue;
						}	
						$rout = 0;
						$a = strlen($url)-6;
						$en = substr($url, $a);
						if (!substr_count($url, "/") and (stripos($en, '.jpg') or stripos($en, '.png') or stripos($en, '.jpeg') or stripos($en, '.gif') or stripos($en, '.bmp'))) {	
							$nom = stripos($url, ".j");
							if (!$nom) $nom = stripos($url, ".png");
							if (!$nom) $nom = stripos($url, ".gif");
							if (!$nom) $nom = stripos($url, ".bmp");
							if (!$nom) continue;
							$se = substr($url, $nom);
							$app = '';
							if (!empty($seo_data['prod_photo'])) {
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = trim($row[$manuf]);
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}	
							if (empty($app)) {
								$app = substr($url, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom);
								$app = $this->TransLit($app);							
								$app = $this->MetaURL($app);
							}

							$try = "../image/data/temp/".$url;
							if (file_exists($try)) {						
								if (!empty ($pic_int[$i]))	{
									$spath = "../image/data/" .$pic_int[$i]."/";
									$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
									$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
									$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
								} else {
									$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." \n";
									$this->adderr($err);
									continue;
								}		
								if (!is_dir($spath)) {
									if (!@mkdir($spath, 0755)) {								
										$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
										$this->adderr($err);
										continue;
									}
								}								
								if (!is_dir($path)) @mkdir($path, 0755);								
								$path = $path.$app.$se;	
								$a = @copy ($try, $path);
								if (!$a) {
									$a = @copy ($try, $spath);
									$pic_addr = $spic_addr;
								}	
								if ($a) {								
									if ($k == 0 and $newphoto != 6) $row_product[0]['image'] = $pic_addr;
									$rout = 1;
									if ($k>0 or $newphoto == 6) {
										$rows = $this->getProductImage($row_product[0]['product_id']);
										$e = 1;										
										foreach ($rows as $p) {
											if ($p['image'] == $pic_addr) $e = 0;
										}	
										if ($e and !empty($pic_addr)) $this->addPicture($row_product[0]['product_id'], $pic_addr, $k);				
									}	
								} else if ($k==0 and $newphoto != 6) $url = $this->checkurl($my_photo);
							}	
						}
					
						if (!$rout) {
							$pars = 0;
							$a = strlen($url)-6;
							$en = substr($url, $a);						
							
							if (substr_count($url, "/") and strlen($url) > 12 and !stripos($en, '.jpg') and !stripos($en, '.png') and !stripos($en, '.jpeg') and !stripos($en, '.gif') and !stripos($en, '.bmp') and $url != -1 and $k == 0 and $parsk) $pars = 1;
							
							$save = $row_product[0]['image'];														
							if ($pars) {									
								$fname = "photo";
								$marks = explode(",", $my_mark);								
								for ($j=0; $j<20; $j++) {
									if (!isset($marks[$j])) break;
									if (!empty($marks[$j])) {
										$fname = $marks[$j];
									} else {						
										if (isset($row[$manuf]) and !empty($row[$manuf])) {
											$fname = trim($row[$manuf]);											
											$fname = substr($fname, 0, 16);
										}
									}										
									$nojpg = 1;							
									$seeks = explode(",", $warranty);
									if (!isset($seeks[$j]) or empty($seeks[$j])) break;								
									$seek = $seeks[$j];															
									
									if (strlen($ht) < 1024 or $parsed != $parsk) {	
										$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
										if (strlen($ht) > 1024) $parsed = $parsk;
										else {
											$parsed = '';
											$err =  " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
											$this->adderr($err);												
											break;
										}	
									}
									$key = '';														
									$urlp = $this->ParsPic($ht, $url, $key, $seek, $fname, $pic_ext);
									$urlp = $this->checkurl($urlp);			
									if ($urlp == -1) continue;								
										
									$nom = stripos($urlp, ".j");
									if (!$nom) $nom = stripos($urlp, ".png");
									if (!$nom) $nom = stripos($urlp, ".gif");
									if (!$nom) $nom = stripos($urlp, ".bmp");
									$a = strlen($urlp);
									if (!$nom or $a - $nom > 5) {
										$se = ".jpg";
										$nom = $a;
									} else $se = substr($urlp, $nom);
									$app = '';
									if (!empty($seo_data['prod_photo'])) {
										$data['name'] = '';
										if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
										$data['category'] = '';
										if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
										$data['manufacturer'] = '';
										if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = trim($row[$manuf]);
										$data['model'] = '';
										if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
										$data['brand'] = '';
										if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
										$data['sku'] = '';
										if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
										$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
										$app = $this->TransLit($app);
										$app = strtolower($app);
									}
									if (empty($app)) {
										$app = substr($urlp, 0, $nom);
										$nom = strpos($app, ".");
										$app = substr($app, $nom+7);
										$app = $this->TransLit($app);
										$nom = strlen($app);										
										if ($nom > 250) $app = substr($app, $nom-250, 250);
										if ($nom < 2) $app = rand(0, 999999999);									
										$app = $this->MetaURL($app);
									}
	
									if (!empty ($pic_int[$i]))	{
										$spath = "../image/data/" .$pic_int[$i]."/";
										$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
										$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
										$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
									} else {
										$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." \n";
										$this->adderr($err);
										continue;
									}		
									if (!is_dir($spath)) {
										if (!@mkdir($spath, 0755)) {								
											$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
											$this->adderr($err);
											continue;
										}
									}
									if (!is_dir($path)) @mkdir($path, 0755);
									$path = $path.$app.$se;								
									if ($j == 0 and $newphoto != 6) $row_product[0]['image'] = $pic_addr;
									if (!file_exists($path)) {											
										$pict = $this->curl_get_contents($urlp, 1, $sleep, $ffile);
										if (!$this->isPicture($pict)) {
											$row_product[0]['image'] = $save;							
											$err =  " Download photo fails. Row ~= " . $row_count ." Url = ". $urlp . " \n";
											$this->adderr($err);											
										} else {
											if ($newphoto == 2 or $newphoto == 4 or $newphoto == 6) {
												$bytes = @file_put_contents($path, $pict);
												if (!$bytes) {
													$bytes = @file_put_contents($spath, $pict);
													$pic_addr = $spic_addr;
												}	
											}
											if ($newphoto == 3) {
												$yes = 0;
												$temp = "../image/data/temp/temp".$se;
												$bytes = @file_put_contents($temp, $pict);
												if ($bytes and @getimagesize($temp)) {
													$sizen = @getimagesize($temp);
													$vol = filesize($temp);
													$pn = $vol/$sizen[0]/$sizen[1];
													$pn = round($pn, 2);												
													$old = "../image/".$save;
													if (file_exists($old) and @getimagesize($old)) {
														$sizeo = @getimagesize($old);
														$vol = filesize($old);
														$po = $vol/$sizeo[0]/$sizeo[1];
														$po = round($po, 2);
														$maxn = $sizen[0];
														if ($maxn < $sizen[1]) $maxn = $sizen[1];
														$maxo = $sizeo[0];
														if ($maxo < $sizeo[1]) $maxo = $sizeo[1];
														$rn = $maxn/$maxo + sqrt($pn)/sqrt($po);
														$ro = $maxo/$maxn + sqrt($po)/sqrt($pn);
														if ($rn >= $ro) $yes = 1;
													} else $yes = 1;
														
													if ($yes) {
														$a = @copy ($temp, $path);
														if (!$a) {
															$a = @copy ($temp, $spath);
															$pic_addr = $spic_addr;
														}	
													} else if ($j == 0) $row_product[0]['image'] = $save;
														
												} else {														
													$err =  " Please, create folder image/data/temp" . "\n";
													$this->adderr($err);
													if ($j == 0) $row_product[0]['image'] = $save;
												}
											}
											if ($j>0 or $newphoto == 6) {
												if ($bytes) {
													$rows = $this->getProductImage($row_product[0]['product_id']);
													$e = 1;
													if (!empty ($rows)) {	
														foreach ($rows as $p) {
															if ($p['image'] == $pic_addr) $e = 0;
														}
													}	
													if ($e and !empty($pic_addr)) $this->addPicture($row_product[0]['product_id'], $pic_addr, $j);
												}
											} else {
												if (!$bytes) {											
													$row_product[0]['image'] = $save;									
													$err =  " Photo has not been updated  Url: ". $urlp . " Row = ".$row_count." Folder: ". $path . " is bad \n";
													$this->adderr($err);
												} else $report = $report."Photo updated ";
											}	
										}
									} else {		
										if ($j>0 or $newphoto == 6) {
											$rows = $this->getProductImage($row_product[0]['product_id']);
											$e = 1;
											if (!empty ($rows)) {	
												foreach ($rows as $p) {
													if ($p['image'] == $pic_addr) $e = 0;
												}
											}
											if ($e and !empty($pic_addr)) {
												$this->addPicture($row_product[0]['product_id'], $pic_addr, $j);
												$report = $report."Additional photo added ";
											} 	
										}
									} 
								}
							} else {							
								$nom = stripos($url, ".j");
								if (!$nom) $nom = stripos($url, ".png");
								if (!$nom) $nom = stripos($url, ".gif");
								if (!$nom) $nom = stripos($url, ".bmp");
								$a = strlen($url);
								if (!$nom or $a - $nom > 5) {
									$se = ".jpg";
									$nom = $a;
								} else $se = substr($url, $nom);
								$app = '';
								if (!empty($seo_data['prod_photo'])) {
									$data['name'] = '';
									if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
									$data['category'] = '';
									if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
									$data['manufacturer'] = '';
									if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = trim($row[$manuf]);
									$data['model'] = '';
									if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
									$data['brand'] = '';
									if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
									$data['sku'] = '';
									if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
									$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
									$app = $this->TransLit($app);
									$app = strtolower($app);
								}
								if (empty($app)) {
									$app = substr($url, 0, $nom);
									$nom = strpos($app, ".");
									$app = substr($app, $nom+7);
									$app = $this->TransLit($app);
									$nom = strlen($app);
									if ($nom > 250) $app = substr($app, $nom-250, 250);
									if ($nom < 2) $app = rand(0, 999999999);									
									$app = $this->MetaURL($app);
								}
								
								if ($newphoto != 5) {
									if (!empty ($pic_int[$i]))	{
										$spath = "../image/data/" .$pic_int[$i]."/";
										$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
										$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
										$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
									} else {
										if (!$yml) {
											$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." \n";
											$this->adderr($err);
											continue;
										} else {
											$path = "../image/data/photo/";											
											$pic_addr = "data/photo/".$app.$se;
										}	
									}		
									if (!is_dir($spath)) {
										if (!@mkdir($spath, 0755)) {								
											$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
											$this->adderr($err);
											continue;
										}
									}
									if (!is_dir($path)) @mkdir($path, 0755);
									
								} else {
									$pic_addr = '';
									if (!empty($row[$pic])) {
										$link = $row[$pic];
										$link = str_replace('&quot;', '"',$link);
										$link = str_replace('&lt;', '<',$link);
										$link = str_replace('&gt;', '>',$link);
										$link = str_replace('&amp;', '&',$link);												
										if (substr_count($link, "data/")) {
											$nom = strpos($link, "data/");		
											$link = substr($link, $nom);
											$pic_addr = $link;		
										}
									}	
								}	
							}
							
							if (!$pars) {	
								if ($newphoto != 5) $path = $path.$app.$se;	
								$pyml = 0;
								if (($k == 0 and !$yml and $newphoto != 6) or ($yml and empty($row_product[0]['image']))) {
									if ($newphoto == 5) {
										$pa = "../image/" . $pic_addr;
										if (file_exists($pa)) {
											$row_product[0]['image'] = $pic_addr;
											$pyml = 1;
										}
									} else {	
										$row_product[0]['image'] = $pic_addr;
										$pyml = 1;
									}	
								}	
								if (!file_exists($path) and $newphoto != 5) {
									$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);
									if (!$this->isPicture($pict)) {
										$row_product[0]['image'] = $save;											
										if (!$yml) {
											$err =  " Download photo fails. Row ~= " . $row_count ." Url = ". $url . " Column = " . $pic . " \n";
											$this->adderr($err);
										}	
									} else {
										if ($newphoto == 2 or $newphoto == 4 or $newphoto == 6) {
											$bytes = @file_put_contents($path, $pict);
											if (!$bytes) {
												$bytes = @file_put_contents($spath, $pict);
												$pic_addr = $spic_addr;
											}	
										} 
										if ($newphoto == 3) {
											$yes = 0;
											$temp = "../image/data/temp/temp".$se;
											$bytes = @file_put_contents($temp, $pict);
											if ($bytes and @getimagesize($temp)) {
												$sizen = @getimagesize($temp);
												$vol = filesize($temp);
												$pn = $vol/$sizen[0]/$sizen[1];
												$pn = round($pn, 2);												
												$old = "../image/".$save;
												if (file_exists($old) and @getimagesize($old)) {
													$sizeo = @getimagesize($old);
													$vol = filesize($old);
													$po = $vol/$sizeo[0]/$sizeo[1];
													$po = round($po, 2);
													$maxn = $sizen[0];
													if ($maxn < $sizen[1]) $maxn = $sizen[1];
													$maxo = $sizeo[0];
													if ($maxo < $sizeo[1]) $maxo = $sizeo[1];
													$rn = $maxn/$maxo + sqrt($pn)/sqrt($po);
													$ro = $maxo/$maxn + sqrt($po)/sqrt($pn);
													if ($rn >= $ro) $yes = 1;
												} else $yes = 1;
												
												if ($yes) {
													$a = @copy ($temp, $path);
													if (!$a) {
														$a = @copy ($temp, $spath);
														$pic_addr = $spic_addr;
													}	
												} else if ($k == 0) $row_product[0]['image'] = $save;
													
											} else {														
												$err =  " Please. create folder image/data/temp" . "\n";
												$this->adderr($err);
												if ($k == 0) $row_product[0]['image'] = $save;
											}
										}
										if ((!$yml and ($k>0 or $newphoto == 6)) or ($yml and !$pyml)) {
											if ($bytes) {
												$rows = $this->getProductImage($row_product[0]['product_id']);
												$e = 1;
												if (!empty ($rows)) {	
													foreach ($rows as $p) {
														if ($p['image'] == $pic_addr) $e = 0;
													}
												}	
												if ($e and !empty($pic_addr)) $this->addPicture($row_product[0]['product_id'], $pic_addr, $k);
											}
										} else {
											if (!$bytes) {
												$row_product[0]['image'] = $save;										
												$err =  " Photo has not been updated  Url: ". $url . " Row = ".$row_count." Folder: ". $path . " ist schlecht \n";
												$this->adderr($err);
											} else $report = $report."Photo updated ";
										}	
									}
								} else {		
									if ((!$yml and ($k>0 or $newphoto == 6)) or ($yml and !$pyml)) {	
										$rows = $this->getProductImage($row_product[0]['product_id']);
										$e = 1;
										if (!empty ($rows)) {	
											foreach ($rows as $p) {
												if ($p['image'] == $pic_addr) $e = 0;
											}
										}
										if ($newphoto == 5) {
											$pa = "../image/" . $pic_addr;
											if (!file_exists($pa)) $pic_addr = '';										
										}
										if ($e and !empty($pic_addr)) $this->addPicture($row_product[0]['product_id'], $pic_addr, $k);
									}
								}								
							}				
						}				
					}
				}				
				
				$row_product[0]['category_id'] = '';
				if ($flag) $row_product[0]['category_id'] = $category_id[$i];					
				else if (!$yml) $row_product[0]['category_id'] = $my_cat;
	
				$row_product[0]['manufacturer_id'] = 0;
				$name = '0';
				$row_product[0]['manuf_name'] = '';
				
				if (isset($row[$manuf]) and !empty ($row[$manuf])) $name = trim($row[$manuf]);
				else {
					if ($my_manuf) {
						$rows = $this->getManufacturerName($my_manuf);
						$name = $rows[0]['name'];
					}	
				}
				$name = $this->Code($name);
				$name = str_replace("\\" , '' , $name);
				$name = trim($name);
				$row_product[0]['manuf_name'] = $name;
				
				if ($umanuf and $name) {
					$rows  = $this->getManufacturerID($name, $store);					
					if(!empty($rows) and $rows[0]['manufacturer_id'] != 0) {
						$row_product[0]['manufacturer_id'] = $rows[0]['manufacturer_id'];
						$report = $report." Manufacturer updated \n";
					} else {
						if ($ad == 1 or $ad == 3) {
							$data['name'] = $name;
							$data['sort_order'] = '0';						
							$this->addManufacturer($data, $langs, $last_id, $seo_data, $store);
							$row_product[0]['manufacturer_id'] = $last_id;
							$report = $report."Manufacturer ".$name." created and updated \n";						
						}
					}
				}				
				
				$yesno = 0;				
				if ($max_attr and $upattr and $ad != 2 and $ad != 4) {					
					$fl =0;
					$er = 0;
					for ($j = 1; $j <= $max_attr; $j++) {
						$at = $attribute_id[$j];
						$col = explode(",", $attr_ext[$j]);
						if (!empty($col[0]) and preg_match('/^[0-9]+$/', $col[0])) {
							
							if (!$fl and $upattr == 1) {								
								$this->deleteAttribute($row_product[0]['product_id']);
								$fl = 1;
							}
							if (($at == 0 and !empty($row[$col[0]-1]) and !$yml) or ($at == 0 and !empty($row[$col[0]+1]) and $yml)) {													
								if (!$yml) $rows = $this->getAttributeID($row[$col[0]-1]);
								else $rows = $this->getAttributeID($row[$col[0]+1]);
								if (isset($rows[0]['attribute_id'])) $at = $rows[0]['attribute_id'];
	
								if ($upattr == 1 or $upattr == 2) {
									if (!$yml) $data['text1'] = $row[$col[0]-1];
									else $data['text1'] = $row[$col[0]+1];
									$data['text2'] = '';
									if (isset($col[1]) and !empty($col[1])) $data['text2'] = $row[$col[1]-1];
									$data['text3'] = '';
									if (isset($col[2]) and !empty($col[2])) $data['text3'] = $row[$col[2]-1];
									$this->createAttribute($data, $attID, $langs);
									$at = $attID;
									if (!$at) {
										$er = 1;
										break;
									}	
								} 
								if (!$at) continue;
							}
							if ($upattr == 4 and $at) {
								$rows = $this->getAttributeById($row_product[0]['product_id'], $at, $lang);
								if (empty($rows)) continue;
							}
							if (isset($row[$col[0]]) and !empty($row[$col[0]])) {
								$t = $this->symbol($row[$col[0]]);
								$t = trim($t);
								$data['text1'] = $t;
								$t = '';
								if (isset($col[1]) and !empty($col[1])) $t = $this->symbol($row[$col[1]]);
								$t = trim($t);
								$data['text2'] = $t;
								$t = '';
								if (isset($col[2]) and !empty($col[2])) $t = $this->symbol($row[$col[2]]);
								$t = trim($t);
								$data['text3'] = $t;
								$data['product_id'] = $row_product[0]['product_id'];
								$data['attribute_id'] = $at;
								$this->putAttributeById($data, $langs);
								$yesno = 1;
							}	
							if ($attribute_id[$j] and $filter_group_id[$j]) {											
								$this->CreateFilter($data, $filter_group_id[$j], $langs, $filters);
								if (!empty($filters)) $this->AttributeToFilter($row_product[0]['product_id'], $filters);				
							}	
						} else {											
							if (isset($row[$parsi])) $url = $this->checkurl($row[$parsi]);
							else $url = -1;
							if ($url != -1) {	
								if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
								if (strlen($ht) > 1024) {
									$parsed = $parsi;
									$this->ParsAttribute($ht, $attr_ext[$j], $attr_point[$j], $text);
								} else {
									$parsed = '';
									$text = '';										
								}														
								if (!empty ($text)) {
									if (!$fl and $upattr == 1) {
										$this->deleteAttribute($row_product[0]['product_id']);
										$fl = 1;
									}				
									foreach ($text as $t) {
										if (empty ($t['name']) or empty ($t['val'])) continue;
										if (strlen((string)$t['name']) > 64) {
											$err =  " Attribute name: ". $t['name'] . " is too large. I cat it. \n";
											$this->adderr($err);
											$t['name'] = mb_substr($t['name'], 0, 64);
										}		
										$rows = $this->getAttributeID($t['name']);										
										if (isset($rows[0]['attribute_id'])) $at = $rows[0]['attribute_id'];
										else {
											if ($upattr == 1 or $upattr == 2) {
												$data['text1'] = $t['name'];
												$data['text2'] = '';
												$data['text3'] = '';
												$this->createAttribute($data, $attID, $langs);
												$at = $attID;												
												if ($at) $report = $report." Attribute: ". $t['name'] . " created \n";
											} else continue;
										}
										if ($upattr == 4 and $at) {
											$rows = $this->getAttributeById($row_product[0]['product_id'], $at, $lang);
											if (empty($rows)) continue;
										}
																		
										$data['product_id'] = $row_product[0]['product_id'];							
										$data['text1'] = $t['val'];
										$data['text2'] = '';
										$data['text3'] = '';
										$data['attribute_id'] = $at;										
										$this->putAttributeById($data, $langs);
										$yesno = 1;
									}
								} else {
									$err =  "Row ~= " . $row_count . " SKU = " . $row[$cod] . " Attribute parse error \n";
									$this->adderr($err);
								}							
							}
						} 						
					}
					if ($er) {
						$err =  "Language 2 is not provided in the Store \n";
						$this->adderr($err);
					}	
				}
				if ($yesno) $report = $report." Attribute updated \n";

				if ($ad != 2 and $ad != 4) $row_product[0]['subtract'] = $minus;
				if ($chcode) {
					if (!$main) $model = $row_product[0]['product_id']."-";
					else $model = $row_product[0]['product_id']."~";
					$l = strlen($id);
					if ($l < 2) $nom = $model."0";
					$row_product[0]['model'] = $model.$id;
				}
				$row_product[0]['upc'] = "";				
				if (isset($row[$upc]) and $ad != 2 and $ad != 4) $row_product[0]['upc'] = $row[$upc];
				$row_product[0]['ean'] = "";				
				if (isset($row[$ean]) and $ad != 2 and $ad != 4) $row_product[0]['ean'] = $row[$ean];
				$row_product[0]['mpn'] = "";				
				if (isset($row[$mpn]) and $ad != 2 and $ad != 4) $row_product[0]['mpn'] = $row[$mpn];
				$row_product[0]['ref'] = "";				
				if (isset($row[$ref]) and $ad != 2 and $ad != 4) $row_product[0]['ref'] = $row[$ref];
				$row_product[0]['ref1'] = "";				
				if (isset($row[$ref1]) and $ad != 2 and $ad != 4) $row_product[0]['ref1'] = $row[$ref1];
				$row_product[0]['seo_h1'] = 0;
				if (isset($row[38]) and $ad != 2 and $ad != 4) $row_product[0]['seo_h1'] = $row[38];
				$row_product[0]['seo_title'] = 0;
				if (isset($row[39]) and $ad != 2 and $ad != 4) $row_product[0]['seo_title'] = $row[39];
				$row_product[0]['meta_keyword'] = 0;
				if (isset($row[40]) and $ad != 2 and $ad != 4) $row_product[0]['meta_keyword'] = $row[40];
				$row_product[0]['meta_description'] = 0;
				if (isset($row[41]) and $ad != 2 and $ad != 4) $row_product[0]['meta_description'] = $row[41];
				$row_product[0]['tag'] = 0;
				if (isset($row[42]) and $ad != 2 and $ad != 4) $row_product[0]['tag'] = $row[42];
				$row_product[0]['url'] = '';
				if (isset($row[43]) and $ad != 2 and $ad != 4) $row_product[0]['url'] = $row[43];

				if ($ad != 4 and $ad != 2) {					
					if (isset($row[$weight])) {					
						$a = trim($row[$weight]);
						if (!empty($a) and $a != '0') $row_product[0]['weight'] = $a;
						elseif ($a == '0') $row_product[0]['weight'] = '0';
					}					
					if (isset($row[$length])) {					
						$a = trim($row[$length]);
						if (!empty($a) and $a != '0') $row_product[0]['length'] = $a;
						elseif ($a == '0') $row_product[0]['length'] = '0';
					}					
					if (isset($row[$width])) {					
						$a = trim($row[$width]);
						if (!empty($a) and $a != '0') $row_product[0]['width'] = $a;
						elseif ($a == '0') $row_product[0]['width'] = '0';
					}					
					if (isset($row[$height])) {					
						$a = trim($row[$height]);
						if (!empty($a) and $a != '0') $row_product[0]['height'] = $a;
						elseif ($a == '0') $row_product[0]['height'] = '0';
					}
				}
				if ($ad != 2 and $ad != 12) {
					$row_product[0]['bprice'] = 0;					
					if (isset($row[$bprice])) {
						$pr = strip_tags($row[$bprice]);
						$pr = preg_replace('/[^0-9.,Ee+-]/','',$pr);
						$pr = str_replace(',', '.',$pr);
						$pr = trim($pr);
						$pr = $pr*$rate;	
						$pr = round($pr, 2);
						if (!empty($pr)) {
							$row_product[0]['bprice'] = $pr;
							$row_product[0]['bpack'] = 1;
							$row_product[0]['brate'] = $rate;
							$row_product[0]['bsuppler'] = $id;
							if (!substr_count($plus, "+")) $row_product[0]['bdisc'] = $row[$price]*$rate * $plus/100;
							else {
								$pl = explode("+", $plus);	
								$f = 0;
								if (isset($pl[0]) and !empty($pl[0])) {
									$row_product[0]['bdisc'] = $row[$price]*$rate * $pl[0]/100;
									$f = 1;
								}
								if (isset($pl[1]) and !empty($pl[1]) and $f) $row_product[0]['bdisc'] = $row_product[0]['bdisc'] + $pl[1];
								if (isset($pl[1]) and !empty($pl[1]) and !$f) $row_product[0]['bdisc'] = $pl[1];
							} 
						}	
					}
				}
				if ($zero_prod  and $ad != 4 and $ad != 12) $row_product[0]['quantity'] = 0;
				if ($minPriceOption and $price_on_site != 999999999999 and $max_opt and ($upopt or $yml)) {	
					if ($ad != 2 and $ad != 12) $row_product[0]['price'] = $price_on_site;
				}
				$row_product[0]['date_modified'] = date('Y-m-d H:i:s');
	
				$this->putProductBySKU($row[$cod], $row_product, $updte, $upname, $max_attr, $attr_ext, $row, $tags, $addseo, $upurl, $umanuf, $seo_data, $store, $parent, $t_ref, $t_ref1, $metka, $yml, $usd, $catmany, $idcat);					
				
				if (!empty($related) and $ad != 2 and $ad != 4) {
					$related_val = explode(";" , $row[$related]);
					foreach ($related_val as $val) {						
						$rows = $this->getProductBySKU($val, $store);
						if (isset($rows) and !empty($rows)) {
							$related_id = $rows[0]['product_id'];
							$rows = $this->getRalated($row_product[0]['product_id'], $related_id);
							if (isset($rows) and empty($rows)) $this->addRelated($row_product[0]['product_id'], $related_id);

							$rows = $this->getRalated($related_id, $row_product[0]['product_id']);
							if (isset($rows) and empty($rows)) $this->addRelated($related_id, $row_product[0]['product_id']);
							
						}	
					}
				}
	/*****************************************************************************************/	
					
			} elseif ((!$product_found and !$optsku) or (!$product_found and $optsku and empty($row[$newproduct]))) {	
				if ($ad == 0 or $ad == 2 or $ad == 4) {						
					$err = " Row ~= " . $row_count . " SKU = " . $row[$cod] . " not found in the Store. " . " \n";
					$this->adderr($err);	
					continue;
				}
				
		/**************/		
				if (!preg_match('/^[0-9]+$/', $manuf) and !empty($manuf) and $pmanuf) {
					if (empty($row[$parsm])) {
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						$err = " The Product passed: Row ~= " . $row_count . " Empty link in column = ".$parsm."\n";
						$this->adderr($err);						
						continue;
					}
					$url = $this->checkurl($row[$parsm]);
					if ($url == -1) {
						$err = " The Product passed: Row ~= " . $row_count . " Incorrect link = ".$row[$parsm]. " in column = ".$parsm."\n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						if ($row_count < 0) return 5;
						continue;
					}
					if (strlen($ht) < 1024 or $parsed != $parsm) {
						$ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
						if (strlen($ht) > 2048) $parsed = $parsm;
						else {
							$parsed = "";
							$err = " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
							$this->adderr($err);
							$row_count = (int)$this->putsos($row_count, $row[$cod]);
							if ($row_count < 0) return 5;
							continue;
						}	
					}
					$in = $this->ParsManufacturer($ht, $mmanuf, $pointm, $placem);					
					if (empty($in) or strlen($in) > 100 ) {
						$err = " The Product passed: Row ~= " . $row_count . " parsing manufacturer fail, manufacturer = " . $in . " \n";
						$this->adderr($err);
						$row_count = (int)$this->putsos($row_count, $row[$cod]);
						$manuf = 'manuf';
						$row[$manuf] = '';
					} else {
						$manuf = 'manuf';
						$row[$manuf] = $in;
					}	
				}
		/**************/		
				
				$row_product[0]['cat_name'] = $text_cat;
				$row_product[0]['category_id'] = '';				
				
				if (preg_match('/^[0-9]+$/', $text_cat) and $idcat) {
					$rows = $this->getCategoryStore((int)$text_cat, $store);
					if (!empty($rows)) {
						$row_product[0]['category_id'] = (int)$text_cat;
						$report = $report."Category set by ID ";
						$pic_int[$i] = "photo";
					}	
				}
				
				if ($flag) {
					$row_product[0]['category_id'] = $category_id[$i];
					$catmany[0] = $category_id[$i];
				} else {
					if (!$idcat and !$yml) {
						$row_product[0]['category_id'] = $my_cat;
						$catmany[0] = $my_cat;
						$report = $report."Category set by default ";
					}	
				}
				
				$row_product[0]['manufacturer_id'] = '0';
				$name = '0';
				$row_product[0]['manuf_name'] = '';
				
				if (isset($row[$manuf]) and !empty ($row[$manuf])) $name = trim($row[$manuf]);
				else {
					if ($my_manuf) {
						$rows = $this->getManufacturerName($my_manuf);
						$name = $rows[0]['name'];
					}	
				}
				$name = str_replace('ООО' , '' , $name);		
				$name = str_replace('ТОВ' , '' , $name);
				$name = $this->Code($name);
				$name = str_replace("\\" , '' , $name);
				$name = trim($name);
				$row_product[0]['manuf_name'] = $name;
				
				$rows  = $this->getManufacturerID($name, $store);				
				
				if(!empty($rows) and $rows[0]['manufacturer_id'] != 0) {
					$row_product[0]['manufacturer_id'] = $rows[0]['manufacturer_id'];
				} else {
					if (($pmanuf and $name and ($ad == 1 or $ad == 3) and $row_product[0]['category_id'] != '') or ($pmanuf and $name and $yml)) {
						$data['name'] = $name;
						$data['sort_order'] = '0';						
						$this->addManufacturer($data, $langs, $last_id, $seo_data, $store);
						$row_product[0]['manufacturer_id'] = $last_id;
						$report = $report."Manufacturer ".$name." created ";
					} else {
						if ($my_manuf and ($ad == 1 or $ad == 3)) {
							$row_product[0]['manufacturer_id'] = $my_manuf;
							$report = $report."Manufacturer set by default";											
						} else {
							if ($ad == 1 or $ad == 3) {							
								$err = " Warning. Row ~= " . $row_count . " SKU = " . $row[$cod] . " Manufacturer: '". $name. "' not found \n";
								$this->adderr($err);
							}	
						}						
					}
				}

				$max_id = $this->getMaxID();
				$max_model = $max_id['max(product_id)'];				
				$max_model = $max_model + 1;
				if (!$main) $max_model = $max_model."-";
				else $max_model = $max_model."~";
				$l = strlen($id);
				if ($l < 2) $max_model = $max_model."0";
				$max_model = $max_model.$id;
				
				$row_product[0]['model'] = $max_model;				 
				$row_product[0]['sku'] = $row[$cod];
				$row_product[0]['lang'] = $lang;

				if ($exsame and isset($row[$cod]) and !empty($row[$cod])) {
				
					if (!empty($item) and preg_match('/^[0-9]+$/', $item)) $pname = $row[$item];
					else {
						if (!empty($item) and !preg_match('/^[0-9]+$/', $item) and empty($pname) and isset($row[$parsi]) and !empty($row[$item])) {
							$pname = "";
							$url = $this->checkurl($row[$parsi]);
							if ($url != -1) {							
								if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
								if (strlen($ht) > 1024) {
									$parsed = $parsi;
									$pname = $this->ParsName($ht, $row[$item], $pointi, $placei);
									if (strlen($pname) < 2) {
										$err =  " Parsing Product Name error: Row ~= " . $row_count . " url = ". $url. " \n";
										$this->adderr($err);
										$pname = "";
									}	
								} else {									
									$err =  " Parsing Product Name error: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
									$this->adderr($err);								
								}							
							}					
						}					
					}
	
					if (!empty($pname))
					$this->Same($row[$cod], $pname, $row_product[0]['category_id'], $row_product[0]['manufacturer_id'], $row[$price], $store);
					
					continue;
				}
				
				if ($ad == 0 or $ad == 2) continue;
					
				if ($catcreate and empty($catmany)) {					
					$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create category(s) \n";
					$this->adderr($err);
					continue;
				}

				if (!$row_product[0]['category_id'] and !$catcreate and !$yml) {				
					$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Category: '".$text_cat."' not found in your settings (see page 'Category and margin')\n";
					$this->adderr($err);
					continue;
				}
				
				if (empty($row[$cat]) and empty($my_cat) and !$yml) {					
					$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Product category not found in price-list\n";
					$this->adderr($err);
					continue;
				}				
				
				if (empty($pic_ext) and empty($my_photo) and empty($parsk)) {					
					$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Please, set picture column \n";
					$this->adderr($err);
					continue;				
				}
				
				$text =	'';
				$pname = '';
				$yes = 0;
				$row_product[0]['description'] = '';
				if (!empty($descrip) and preg_match('/^[0-9]+$/', $descrip) and !empty($row[$descrip])) {
					$row_product[0]['description'] = trim($row[$descrip]);
					$yes = 1;
				}
				if (isset($row[$item]) and !empty($row[$item]) and preg_match('/^[0-9]+$/', $item))
				    $pname = trim($row[$item]);	
	
				if (!preg_match('/^[0-9]+$/', $descrip) and isset($row[$parsd]) and (!$optsku or empty($row[$newproduct]))) {					
					$url = $this->checkurl($row[$parsd]);
					if ($url != -1) {							
						if (strlen($ht) < 1024 or $parsed != $parsd) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
						if (strlen($ht) > 1024) {
							$parsed = $parsd;
							$spath = "data/";
							if (isset($pic_int[$i]) and !empty($pic_int[$i])) $spath = "data/" .$pic_int[$i]."/";
							$text = $this->ParsDescription($ht, $descrip, $pointd, $placed, $spath, $row_count, $url, $sleep, $ffile);
							if (strlen($text) < 10) $text = '';			
						} else {
							$parsed = '';
							$err =  " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
							$this->adderr($err);										
						}					
					}
				}	
				if (!preg_match('/^[0-9]+$/', $item) and isset($row[$parsi]) and (!$optsku or empty($row[$newproduct]))) {
					$url = $this->checkurl($row[$parsi]);
					if ($url != -1) {							
						if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
						if (strlen($ht) > 1024) {
							$parsed = $parsi;
							$pname = $this->ParsName($ht, $item, $pointi, $placei);
							if (strlen($pname) < 2) {
								$err =  " Parsing Product Name error: Row ~= " . $row_count . " url = ". $url. " Check your settings \n";
								$this->adderr($err);								
								continue;
							}	
						} else {
							$parsed = '';
							$err =  " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
							$this->adderr($err);										
						}						
					}								
				}	
		
				if (!empty($pname)) $row_product[0]['item'] = $pname;
				else if (!$yml and (!$optsku or empty($row[$newproduct]))) continue;
				
				if (!empty($my_descrip) and !$yes and empty($text)) {
					if (!preg_match('/^[0-9]+$/', $my_descrip)) $row_product[0]['description'] = $my_descrip;
					else if (!empty($row[$my_descrip])) $row_product[0]['description'] = $row[$my_descrip];
					if (!$yml) $report = $report."Description set by default ";
				} else {
					if (empty($my_descrip) and !$yes and empty($text)) {
						$row_product[0]['description'] = "";
						if (!$yml) $report = $report."No Description ";
					} else {
						$t = '';
						if (!empty($my_descrip) and preg_match('/^[0-9]+$/', $my_descrip) and !empty($row[$my_descrip])) $t = $row[$my_descrip];
						if (!empty($my_descrip) and !preg_match('/^[0-9]+$/', $my_descrip)) $t = $my_descrip;
						if ($ddesc == 1 and !empty($t) and !$yes) $text = $t . "&lt;br&gt;&lt;br&gt;". $text;
						if ($ddesc == 2 and !empty($t) and !$yes) $text = $text . "&lt;br&gt;&lt;br&gt;". $t;
						if ($ddesc == 1 and !empty($t) and $yes) $text = $t . "&lt;br&gt;&lt;br&gt;". $row_product[0]['description'];
						if ($ddesc == 2 and !empty($t) and $yes) $text = $row_product[0]['description'] . "&lt;br&gt;&lt;br&gt;". $t;
							
					    if (!empty($text)) $row_product[0]['description'] = $text;						
					}					
				}
				
				$p = strpos($max_model, "-");
				if (!$p) $p = strpos($max_model, "~");
				$papka = substr($max_model, $p-1, 1);
				$row_product[0]['image'] = '';	
				
				$photo_default = 0;		
				$nojpg = 0;
				$pictures ='';
				$pi = explode(",", $pic_ext);
				if (!empty($parsk)) {
					$pictures[0] = $parsk;
					$m = 0;
					for ($l=1; $l<$np; $l++) {
						if (!isset($pi[$m])) break;							
						$pictures[$l] = $pi[$m];
						$m++;
					}
				} else $pictures = $pi;
	
				$enn = 0;
			$q = -1;			
			$npic = count($pictures);
			for ($n=0; $n<$npic; $n++) {
				$nolink = 0;
				$q++;
				$pic = $pictures[$n];

				if (!empty ($row[$pic]) and (!$optsku or empty($row[$newproduct]))) {
					if (!substr_count($row[$pic], "/")) $nolink = 1;
					$url = $row[$pic];
					if (!$nolink) $url = $this->checkurl($row[$pic]);					
					if ($url == -1) {
						if ($n == $npic-1) {
							if ($my_photo) {
								$url = $my_photo;
								$photo_default = 1;
								$nolink = 0;									
								break;
							} else {						
								if (!$yml) {
									$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] ." Invalid picture link\n";
									$this->adderr($err);							
									$enn = 1;
								}	
								break;
							}	
						} else if (!$yml) continue;
					}

					$a = strlen($url)-6;
					$en = substr($url, $a);
					if (substr_count($url, "/") and strlen($url) > 12 and !stripos($en, '.jpg') and !stripos($en, '.png') and !stripos($en, '.jpeg') and !stripos($en, '.gif') and !stripos($en, '.bmp') and $url != -1 and $parsk) {
					
						$fname = "photo";
						$marks = explode(",", $my_mark);
						if (isset($marks[0]) and !empty($marks[0])) {													
							$fname = $marks[0];
						} else {						
							if (isset($row[$manuf]) and !empty($row[$manuf])) {
								$fname = $row[$manuf];							
								$fname = substr($fname, 0, 16);
							}
						}							
					
						if ((empty ($row[$manuf]) or !isset($row[$manuf])) and (!isset($my_mark) or empty ($my_mark))) {	
							if ($my_photo) {
								$url = $my_photo;
								$photo_default = 1;
								$nolink = 0;								
								break;		
							} else {									
								$err =  " Photo can not be found: Row ~= " . $row_count . " SKU = " . $row[$cod] ." Please, set  Manufacturer or keyword \n";
								$this->adderr($err);							
								$enn = 2;
								break;								
							}
						}							
						$nojpg = 1;
						$seeks = explode(",", $warranty);
						$seek = $seeks[0];	
						if (strlen($ht) < 1024 or $parsed != $parsk) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);	
						if (strlen($ht) > 1024) {
							$parsed = $parsk;								
							$key = '';
							$url = $this->ParsPic($ht, $url, $key, $seek, $fname, $pic_ext);
							if ($this->checkurl($url) == -1) {
								if (empty($my_photo)) {
									$err =  " Parsing main photo error: Row ~= " . $row_count . " url = ". $url. " Check your settings \n";
									$this->adderr($err);
									$enn = 3;
									break;	
								} else {													
									$url = $my_photo;
									$photo_default = 1;
									$nolink = 0;									
									break;
								}	
							}	
						} else {							
							$err =  " The Product passed: Row ~= " . $row_count . " url = ". $url. " Site no answer \n";
							$this->adderr($err);
							$row_count = (int)$this->putsos($row_count, $row[$cod]);
							if ($row_count < 0) return 5;
							$enn = 4;
							break;							
						}										
	
						if (!$url) {
							$row_product[0]['image'] = '';							
							if (!empty($my_photo)) {
								$url = $my_photo;
								$photo_default = 1;
								$nolink = 0;								
								break;
							} else {					
								$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] ." Photo not found on the site: " . $url." Check your setting field in form: 'location photo'"." keywords = ".$fname." seek = ".$seek."\n";
								$this->adderr($err);								
								$enn = 5;
								break;
							}
						}							
					} else {						
						if (strlen($url) < 5) {	
							$row_product[0]['image'] = '';							
							if (!empty($my_photo)) {
								$url = $my_photo;
								if ((strlen($url) < 3) or (!stristr($url, '.jpg') and !stristr($url, '.png') and !stristr($url, '.jpeg') and !stristr($url, '.gif') and !stripos($en, '.bmp'))) {
									if (!$yml) {
										$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Default link: " . $url. " too short "." \n";
										$this->adderr($err);
									}	
									break;
								}
								$photo_default = 1;
								$nolink = 0;
							} else {					
								if (!$yml) {
									$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Link: " . $url. " too short "." \n";
									$this->adderr($err);								
									$enn = 6;
								}	
								break;
							}	
						}
					}					
					$rout = 0;
					$try = "";					
					if (!$nolink) $url = $this->checkurl($url);		
					if ($url != -1) {
						if ($nolink) {	
							$nom = stripos($url, ".j");
							if (!$nom) $nom = stripos($url, ".png");
							if (!$nom) $nom = stripos($url, ".gif");
							if (!$nom) $nom = stripos($url, ".bmp");
							if (!$nom) continue;							
							$se = substr($url, $nom);	
							$app = '';
							if (!empty($seo_data['prod_photo'])) {								
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = $row_product[0]['manuf_name'];
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}
							if (empty($app)) {
								$app = substr($url, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom);
								$app = $this->TransLit($app);							
								$app = $this->MetaURL($app);
							}
							$try = "../image/data/temp/".$url;
	
							if (file_exists($try)) {						
								if (!empty ($pic_int[$i]))	{
									$spath = "../image/data/" .$pic_int[$i]."/";
									$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
									$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
									$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
								} else {
									$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count . " Product passed" ." \n";
									$this->adderr($err);
									$enn = 7;
									break;
								}		
								if (!is_dir($spath)) {
									if (!@mkdir($spath, 0755)) {								
										$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
										$this->adderr($err);
										continue;
									}
								}								
								
								if (!is_dir($path)) @mkdir($path, 0755);
								$path = $path.$app.$se;
								$a = @copy ($try, $path);
								if (!$a) {
									$a = @copy ($try, $spath);
									$pic_addr = $spic_addr;
								}	
								$row_product[0]['image'] = $pic_addr;			
								$rout = 1;
								break;
							} else {
								if ($n == $npic-1) {
									if ($my_photo) {
										$url = $my_photo;
										$photo_default = 1;
										$nolink = 0;
										break;
									} else {
										$enn = 9;																		
										break;
									}
								} else continue;
							}	
						}					
						if (!$rout) {	
							$nom = stripos($url, ".j");
							if (!$nom) $nom = stripos($url, ".png");
							if (!$nom) $nom = stripos($url, ".gif");
							if (!$nom) $nom = stripos($url, ".bmp");
							$a = strlen($url);
							if (!$nom or $a - $nom > 5) {
								$se = ".jpg";
								$nom = $a;
							} else $se = substr($url, $nom);
							$app = '';
							if (!empty($seo_data['prod_photo'])) {
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = $row_product[0]['manuf_name'];
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}
							if (empty($app)) {
								$app = substr($url, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom+7);
								$app = $this->TransLit($app);
								$nom = strlen($app);
								if ($nom > 250) $app = substr($app, $nom-250, 250);
								if ($nom < 2) $app = rand(0, 999999999);							
								$app = $this->MetaURL($app);
							}
							if ($newphoto != 5) {
								if (!empty ($pic_int[$i]))	{
									$spath = "../image/data/" .$pic_int[$i]."/";
									$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
									$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
									$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
								} else {
									$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." The product passed"." \n";
									$this->adderr($err);
									$enn = 10;
									break;
								}		
								if (!is_dir($spath)) {
									if (!@mkdir($spath, 0755)) {								
										$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
										$this->adderr($err);
										continue;
									}
								}
								if (!is_dir($path)) @mkdir($path, 0755);		
								$path = $path.$app.$se;	
							} else 	{
								$pic_addr = '';
								if (!empty($row[$pic])) {
									$link = $row[$pic];
									$link = str_replace('&quot;', '"',$link);
									$link = str_replace('&lt;', '<',$link);
									$link = str_replace('&gt;', '>',$link);
									$link = str_replace('&amp;', '&',$link);								
									if (substr_count($link, "data/")) {
										$nom = strpos($link, "data/");		
										$link = substr($link, $nom);
										$pic_addr = $link;		
									}
								}	
							}
							if ($newphoto == 5) {
								$pa = "../image/" . $pic_addr;
								if (file_exists($pa)) $row_product[0]['image'] = $pic_addr;
								else {
									if ($n == $npic-1) {
										if (!$yml) {
											$err =  " Main photo not found. Path: ". $pic_addr . " Row ~= " . $row_count . " SKU = " . $row[$cod] . " Product passed \n";
											$this->adderr($err);
											$enn = 12;
										}	
										break;
									} else continue;
								}	
							} else $row_product[0]['image'] = $pic_addr;
							if (!file_exists($path) and $newphoto != 5) {
								$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);								
								if (!$this->isPicture($pict)) {	
									if ($n == $npic-1) {
										if ($my_photo) {											
											$photo_default = 1;
											$nolink = 0;
											if (!$yml) {
												$err =  " Download main photo fails. Url: ". $url . " Row ~= " . $row_count . " SKU = " . $row[$cod] . " I'll try insert default photo \n";
												$this->adderr($err);
												$url = $my_photo;
											}	
											break;
										} else {
											if (!$yml) {
												$err =  " Download main photo fails. Url: ". $url . " Row ~= " . $row_count . " SKU = " . $row[$cod] . " Product passed \n";
												$this->adderr($err);
												$enn = 12;
											}	
											break;
										}
									} else continue;	
									
								} else {
									$bytes = @file_put_contents($path, $pict);
									if (!$bytes) {
										$bytes = @file_put_contents($spath, $pict);
										$row_product[0]['image'] = $spic_addr;
									}

									if (!$bytes) {
										if ($n == $npic-1) {
											if (!$yml) {
												$err =  " The Product has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Link in price-list: ". $row[$pic]. " patch = ".$path." url = ".$url." is not available \n";
												$this->adderr($err);
											}	
											if ($my_photo) {
												$url = $my_photo;
												$photo_default = 1;
												$nolink = 0;
												break;
											} else {
												$enn = 13;
												break;
											}
										} else continue;
									}
									break;
								}	
							} else break;
						}
					}
				} else {
					if ($n == $npic-1 and (!$optsku or empty($row[$newproduct]))) {
						if ($my_photo) {
							$url = $my_photo;
							$photo_default = 1;
							$nolink = 0;
							break;
						} else {
							$enn = 14;
							break;
						}
					}
				}
				if (!empty($parsk)) break;
			}	// new	
	
			if ($q > 0) {
				$npic = $npic-$q;
				for ($l=0; $l<16; $l++) {
					if (!isset($pictures[$l+$q])) break;
					$pictures_new[$l] = $pictures[$l+$q];					
				}
			} else 	$pictures_new = $pictures;
		
				if ($enn and (!$optsku or empty($row[$newproduct])) and !$yml) {
					$err =  " Main photo not found. " . " Row ~= " . $row_count . " SKU = " . $row[$cod] . " err = " . $enn . " Product passed \n";
					$this->adderr($err);
					continue;
				}
				
				if ($photo_default and (!$optsku or empty($row[$newproduct])) and !$yml) {
					if ($my_photo) {					
						$url = $my_photo;											
						$ff = $url;										
						$ff = strrchr($ff, "/");					
						$nom = stripos($ff, ".");
						$sb = substr($ff, 1, $nom-1);
						$se = substr($ff, $nom);
						$pic_name = $sb.$se;
						
						if (!empty ($pic_int[$i]))	{
							$spath = "../image/data/" .$pic_int[$i]."/";
							$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
							$spic_addr = "data/".$pic_int[$i]."/".$pic_name;
							$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$pic_name;				
						} else {
							$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." The product passed"." \n";
							$this->adderr($err);
							continue;
						}		
						if (!is_dir($spath)) {
							if (!@mkdir($spath, 0755)) {								
								$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
								$this->adderr($err);
								continue;
							}
						}
						if (!is_dir($path)) @mkdir($path, 0755);
						$path = $path.$pic_name;					
						$row_product[0]['image'] = $pic_addr;
						if (!file_exists($path)) {
							$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);
							if (!$this->isPicture($pict)) {								
								$err =  " Download default photo fails. Url: ". $url . " Row ~= " . $row_count . " SKU = " . $row[$cod] ." \n";
								$this->adderr($err);
								continue;
							}
							$bytes = @file_put_contents($path, $pict);
							if (!$bytes) {
								$bytes = @file_put_contents($spath, $pict);
								$row_product[0]['image'] = $spic_addr;
							}
							if (!$bytes) {								
								$err =  " Defaul photo has not been added: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Default link: ". $row[$pic]. " patch = ".$path." url = ".$url." is not available \n";
								$this->adderr($err);								
								continue;
							}
						}						
					} else {						
						$err =  " Any photo not found: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Default photo expected \n";
						$this->adderr($err);
						continue;
					}	
				}	
	
				if ($photo_default > 0 and (!$optsku or empty($row[$newproduct])) and !$yml) $report = $report."Photo set by default ";				
				
				$row_product[0]['weight'] = '0';
				$row_product[0]['length'] = '0';
				$row_product[0]['width'] = '0';
				$row_product[0]['height'] = '0';
				if (isset($row[$weight])) {						
					$a = trim($row[$weight]);
					if (!empty($a) and $a != '0') $row_product[0]['weight'] = $a;
					elseif ($a == '0') $row_product[0]['weight'] = '0';
				}					
				if (isset($row[$length])) {					
					$a = trim($row[$length]);
					if (!empty($a) and $a != '0') $row_product[0]['length'] = $a;
					elseif ($a == '0') $row_product[0]['length'] = '0';
				}					
				if (isset($row[$width])) {					
					$a = trim($row[$width]);
					if (!empty($a) and $a != '0') $row_product[0]['width'] = $a;
					elseif ($a == '0') $row_product[0]['width'] = '0';
				}					
				if (isset($row[$height])) {					
					$a = trim($row[$height]);
					if (!empty($a) and $a != '0') $row_product[0]['height'] = $a;
					elseif ($a == '0') $row_product[0]['height'] = '0';
				}				
				
				if (isset($row[$sorder]))
					$row_product[0]['sort_order'] = $row[$sorder];
				else $row_product[0]['sort_order'] = 0;					
				
				$row_product[0]['quantity'] = 0;
				$newstatus = 0;
				$qus = explode("," , $qu);
				for ($k=0; $k<9; $k++) {
					$quant = 0;
					if (!isset($qus[$k])) break;
					$quk = $qus[$k];	
					if (isset($row[$quk]) and preg_match('/^[0-9]+$/', $row[$quk])) {
						$quant = (int)$row[$quk];		
					} else {
						if (!empty($my_qu)) {
							if (substr_count($my_qu, "=")) {												
								$t = explode("," , $my_qu);
								foreach ($t as $value) {
									if (isset($value)) {
										$m = explode("=" , $value);
										if (isset($row[$quk]) and isset($m[0]) and isset($m[1]) and preg_match('/^[0-9()-]+$/', $m[1])) {
											if ($m[0] == $row[$quk]) {												
												$posa = strpos($m[1], "(");
												if ($posa) {
													$quant = (int)substr($m[1], 0, $posa);
													$posb = strpos($m[1], ")");
													if ($posb) $newstatus = (int)substr($m[1], $posa+1, $posb-$posa-1);
												} else $quant = (int)$m[1];
												
											}
										}
									}
								}
							}
						} 					
					}			
					$row_product[0]['quantity'] = $row_product[0]['quantity'] + $quant;
				}
				
				if (empty($newstatus)) $newstatus = 0;				
				if (!$row_product[0]['quantity'] and preg_match('/^[0-9]+$/', $my_qu)) {
					$row_product[0]['quantity'] = $my_qu;
					if (!$yml) $report = $report."Quantity set by default ";
				} else {	
					if (!$row_product[0]['quantity'] and !$yml) $report = $report."Quantity = 0 ";				
					else if ($row_product[0]['quantity'] > 0 and !$yml) $report = $report."Quantity found ";
				}
				
				$row_product[0]['hide'] = 1;
				if (!$hide) $row_product[0]['hide'] = 0;
				if ($off_prod == 1) $row_product[0]['hide'] = 0;

				$qu_d = array();  // Расчет скидок по процентам от количества
				if (!empty($qu_discount) and substr_count($qu_discount, "=")) {				
					$pj = explode(",", $qu_discount);
					for ($j=0; $j<20; $j++) {		
						if (!isset($pj[$j])) break;
						if (!substr_count($pj[$j], "=")) break;		
						$p = strpos($pj[$j], '=');						
						$q = substr($pj[$j], 0, $p);	
						$q = trim($q)+1-1;
						$q = round($q, 0);
						if (!preg_match('/^[0-9]+$/', $q)) break;	
						$per = substr($pj[$j], $p+1);	
						$per = trim($per)+1.11-1.11;
						$per = round($per, 2);
						if (!preg_match('/^[0-9.Ee+-]+$/', $per)) break;
						$qu_d['quantity'][$j] = $q;
						$qu_d['percent'][$j] = $per;
					}
				}
				
				$plus = 0;
				$new_price = 0;
				$ff = 1;
				if (!$price_parsed) $row[$price] = $row[$price]*$rate;  // сначала, умножаем на курс	
				else $row[$price] = $row[$price]*$ratep;
								
				if (!$flag and !$cprice and $my_cat and (empty($myplus) or $row[$myplus] == '')) {								
					$rows = $this->getMargin($id, $my_cat);					
					if (!isset($rows) or empty($rows)) {						
						$err =  " Warning: cannot set Margin. Row ~= " . $row_count . " SKU = " . $row[$cod] . " because  category not found on page 'Category and margin' \n";
						$this->adderr($err);
						$ff = 0;
					} else {					
						$plus = $rows[0]['cat_plus'];
						$report = $report."Margin set by default category ";
					}
				} else {
					if (!empty($myplus) and preg_match('/^[0-9,.Ee+]+$/', $row[$myplus]) and $row[$myplus] != '0') {	
						$plus = str_replace(',','.',$row[$myplus]);
						$report = $report."Margin set manualy ";
					} else {
						if ($cprice and $cat_plus[$i] == 0 and (empty($myplus) or $row[$myplus] == '0' or !preg_match('/^[-0-9,.Ee+]+$/', $row[$myplus]))) {
							if (!$price_parsed) $a = $rate;
							else $a = $ratep;
							$doll = $row[$price]/$a + 0.01 - 0.01;	// переведем цену в доллары					
					
				// Таблица наценок. Зависит от цены товара в долларах. $m - множитель 
		
							if ($doll > 500.00) $m = 1.01;   // 1%
							if ($doll <= 500.00) $m = 1.05;  // 5%
							if ($doll <= 200.00) $m = 1.06;
							if ($doll <= 100.00) $m = 1.1;			
							if ($doll <= 50.00) $m = 1.07;	
							if ($doll <= 30.00) $m = 1.15;
							if ($doll <= 20.00) $m = 1.2;
							if ($doll <= 10.00) $m = 1.35;
							if ($doll <= 5.00) $m = 1.4;
							if ($doll <= 4.00) $m = 1.5;
							if ($doll <= 3.00) $m = 1.6;
							if ($doll <= 2.00) $m = 1.7;
							if ($doll <= 1.40) $m = 1.8;
							if ($doll <= 1.20) $m = 1.9;
							if ($doll <= 1.00) $m = 2.0;	// 100 процентов				
					
							$plus = 100*($m-1);
							$report = $report."Margin set by formula ";
								
						} else {				
							if (isset($cat_plus[$i]) and !empty($cat_plus[$i]) and isset($row[$myplus]) and $row[$myplus] != '0') {		
								if (preg_match('/^[-0-9,.Ee+]+$/', $cat_plus[$i])) {
									$plus = str_replace(',','.',$cat_plus[$i]);
								} else {
									$pj = explode(",", $cat_plus[$i]);
									for ($j=0; $j<60; $j++) {
										if (!isset($pj[$j])) break;
										if (!substr_count($pj[$j], "(")) continue;
										if (!substr_count($pj[$j], ")")) continue;
										$pj[$j] = str_replace('(','',$pj[$j]);		
										$p = strpos($pj[$j], ')');
										if (!$p) continue;
										$d = substr($pj[$j], 0, $p);
										$p12 = explode("-", $d);
										$p1 = trim($p12[0]);
										$p2 = trim($p12[1]);
										if ($row[$price] >= $p1 and $row[$price] <= $p2) {
											$plus = substr($pj[$j], $p+1);
											$plus = trim($plus);
											break;
										}
									}	
								}
							if (!empty($plus) and !$yml) $report = $report."Margin added success ";
							}	
						}
					}
				}
				if ($ignore_margin) $plus = 0;
				if ($ff or (!$ff and $ignore_margin or (!$ff and $yml))) {
					if (!substr_count($plus, "+")) $new_price = $row[$price] + ($row[$price] * $plus/100);
					else {
						$pl = explode("+", $plus);	
						$f = 0;
						if (isset($pl[0]) and !empty($pl[0])) {
							$new_price = $row[$price] + ($row[$price] * $pl[0]/100);
							$f = 1;
						}
						if (isset($pl[1]) and !empty($pl[1]) and $f) $new_price = $new_price + $pl[1];
						if (isset($pl[1]) and !empty($pl[1]) and !$f) $new_price = $row[$price] + $pl[1];
					}
				}					
				
				if ($plus == 0 and !$yml) $report = $report."Margin = 0 ";
				$row_product[0]['price'] = round($new_price, 2);// округление цены до копеек, 2 цифры после запятой					
				
				$row_product[0]['date_added'] = date('Y-m-d H:i:s');
				$row_product[0]['date_available'] = date('Y-m-d H:i:s');				
				$row_product[0]['shipping'] = 1;
				
				$stat = $st_status;
				if ($newstatus) $stat = $newstatus;
				if (!empty($termin) and !empty($row[$termin]) and preg_match('/^[0-9]+$/', $row[$termin]) and !empty($t_status)) {
					$term = (int)trim($row[$termin]);
					$pj = explode(",", $t_status);
					for ($j=0; $j<20; $j++) {		
						if (!isset($pj[$j])) break;
						if (!substr_count($pj[$j], "=")) break;		
						$p = strpos($pj[$j], '=');						
						$q = substr($pj[$j], 0, $p);						
						if (!preg_match('/^[0-9]+$/', $q)) break;
						$q = (int)trim($q);						
						if ($q == $term) {
							$stat = substr($pj[$j], $p+1);
							if (!preg_match('/^[0-9]+$/', $stat)) break;
							$stat = (int)trim($stat);
						}					
					}				
				}
				if ($ad != 4) $row_product[0]['stock_status_id'] = $stat;
	
				$row_product[0]['bprice'] = 0;
				if (isset($row[$bprice])) {
					$pr = strip_tags($row[$bprice]);
					$pr = preg_replace('/[^0-9.,Ee+-]/','',$pr);
					$pr = str_replace(',', '.',$pr);
					$pr = trim($pr);
					$pr = $pr*$rate;
					$pr = round($pr, 2);
					if (!empty($pr)) {
						$row_product[0]['bprice'] = $pr;
						$row_product[0]['bpack'] = 1;
						$row_product[0]['brate'] = $rate;
						$row_product[0]['bsuppler'] = $id;
						if (!substr_count($plus, "+")) $row_product[0]['bdisc'] = $row[$price]*$rate * $plus/100;
						else {
							$pl = explode("+", $plus);	
							$f = 0;
							if (isset($pl[0]) and !empty($pl[0])) {
								$row_product[0]['bdisc'] = $row[$price]*$rate * $pl[0]/100;
								$f = 1;
							}
							if (isset($pl[1]) and !empty($pl[1]) and $f) $row_product[0]['bdisc'] = $row_product[0]['bdisc'] + $pl[1];
							if (isset($pl[1]) and !empty($pl[1]) and !$f) $row_product[0]['bdisc'] = $pl[1];
						}	
					}	
				}				
				
				$row_product[0]['subtract'] = $minus;
				$row_product[0]['upc'] = "";				
				if (isset($row[$upc])) $row_product[0]['upc'] = $row[$upc];
				$row_product[0]['ean'] = "";				
				if (isset($row[$ean])) $row_product[0]['ean'] = $row[$ean];
				$row_product[0]['mpn'] = "";				
				if (isset($row[$mpn])) $row_product[0]['mpn'] = $row[$mpn];
				$row_product[0]['ref'] = "";				
				if (isset($row[$ref])) $row_product[0]['ref'] = $row[$ref];
				$row_product[0]['ref1'] = "";				
				if (isset($row[$ref1])) $row_product[0]['ref1'] = $row[$ref1];
				$row_product[0]['seo_h1'] = 0;
				if (isset($row[38])) $row_product[0]['seo_h1'] = $row[38];
				$row_product[0]['seo_title'] = 0;
				if (isset($row[39])) $row_product[0]['seo_title'] = $row[39];
				$row_product[0]['meta_keyword'] = 0;
				if (isset($row[40])) $row_product[0]['meta_keyword'] = $row[40];
				$row_product[0]['meta_description'] = 0;
				if (isset($row[41])) $row_product[0]['meta_description'] = $row[41];
				$row_product[0]['tag'] = 0;
				if (isset($row[42])) $row_product[0]['tag'] = $row[42];
				$row_product[0]['url'] = '';
				if (isset($row[43])) $row_product[0]['url'] = $row[43];
				
				if ($zero_prod) $row_product[0]['quantity'] = 0;				
				
				$report = $report."Product added ";
				
				if (!$optsku or empty($row[$newproduct])) {
					$this->putNewProduct($row_product, $parent, $last_product_id, $attr_ext, $max_attr, $langs, $row, $tags, $addseo, $catmany, $catcreate, $newurl, $refers, $seo_data, $store, $off, $idcat, $t_ref,  $t_ref1, $metka, $usd);				
				}
				
				if (!isset($last_product_id) or !$last_product_id) {					
					if (!$optsku or empty($row[$newproduct])) {
						$err =  " Database write error Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
						$this->adderr($err);
						continue;
					} else {
						$err =  " No product to add Option Row ~= " . $row_count . " SKU = " . $row[$cod] . " \n";
						$this->adderr($err);
						continue;
					}	
				}
				
				$old_product_id = $last_product_id;
				$last_sku_id = 0;
				if (!$optsku or empty($row[$newproduct])) {
					$this->addProductToTable($last_product_id, $row_product[0]['sku'], $last_sku_id, $store);
					if (!empty($row[$sku2])) $this->addSkuToTable($row[$sku2], $last_sku_id, $store);
				} 
				
				$er = 0;				
				if ($max_attr and $upattr != 4 and (!$optsku or empty($row[$newproduct]))) {					
					for ($j = 1; $j <= $max_attr; $j++) {					
						$at = $attribute_id[$j];
						$col = explode(",", $attr_ext[$j]);
						if (!empty($col[0]) and preg_match('/^[0-9]+$/', $col[0])) {
							if (($at == 0 and !empty($row[$col[0]-1]) and !$yml) or ($at == 0 and !empty($row[$col[0]+1]) and $yml)){								
								if (!$yml) $rows = $this->getAttributeID($row[$col[0]-1]);
								else $rows = $this->getAttributeID($row[$col[0]+1]);
								if (isset($rows[0]['attribute_id'])) $at = $rows[0]['attribute_id'];
								if ($upattr == 1 or $upattr == 2) {
									if (!$yml) $data['text1'] = $row[$col[0]-1];
									else $data['text1'] = $row[$col[0]+1];
									$data['text2'] = '';
									if (isset($col[1]) and !empty($col[1])) $data['text2'] = $row[$col[1]-1];
									$data['text3'] = '';
									if (isset($col[2]) and !empty($col[2])) $data['text3'] = $row[$col[2]-1];
									$this->createAttribute($data, $attID, $langs);
									$at = $attID;
									if (!$at) {
										$er = 1;
										break;
									}								
								}
								if (!$at) continue;
							}					
							if (isset($row[$col[0]]) and !empty($row[$col[0]])) {
								$t = $this->symbol($row[$col[0]]);
								$t = trim($t);
								$data['text1'] = $t;
								$t = '';
								if (isset($col[1]) and !empty($col[1])) $t = $this->symbol($row[$col[1]]);
								$t = trim($t);
								$data['text2'] = $t;
								$t = '';
								if (isset($col[2]) and !empty($col[2])) $t = $this->symbol($row[$col[2]]);
								$t = trim($t);
								$data['text3'] = $t;
								$data['product_id'] = $last_product_id;
								$data['attribute_id'] = $at;
								$this->putAttributeById($data, $langs);								
							}
							if ($attribute_id[$j] and $filter_group_id[$j]) {											
								$this->CreateFilter($data, $filter_group_id[$j], $langs, $filters);
								if (!empty($filters)) $this->AttributeToFilter($last_product_id, $filters);				
							}
						} else {											
							if (isset($row[$parsi])) $url = $this->checkurl($row[$parsi]);
							else $url = -1;
							if ($url != -1) {	
								if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
								if (strlen($ht) > 1024) {
									$parsed = $parsi;
									$this->ParsAttribute($ht, $attr_ext[$j], $attr_point[$j], $text);
								} else {
									$parsed = '';
									$text = '';										
								}	
														
								if (!empty ($text)) {
									foreach ($text as $t) {
										if (empty ($t['name']) or empty ($t['val'])) continue;
										if (strlen((string)$t['name']) > 64) {
											$err =  " Attribute name: ". $t['name'] . " is too large. I cat it. \n";
											$this->adderr($err);
											$t['name'] = mb_substr($t['name'], 0, 64);
										}	
										$rows = $this->getAttributeID($t['name']);										
										if (empty($rows)) {
										    if ($upattr == 1 or $upattr == 2) {									
												$data['text1'] = $t['name'];
												$data['text2'] = '';
												$data['text3'] = '';
												$this->createAttribute($data, $attID, $langs);
												$at = $attID;											
												if (!$at) $report = $report." Attribute: ". $t['name'] . " created \n";
											} else continue;	
										} else 	$at = $rows[0]['attribute_id'];									
																			
										$data['product_id'] = $last_product_id;										
										$data['text1'] = $t['val'];
										$data['text2'] = '';
										$data['text3'] = '';
										$data['attribute_id'] = $at;										
										$this->putAttributeById($data, $langs);										
									}
								} else {
									$err =  "Row ~= " . $row_count . " SKU = " . $row[$cod] . " Attribute parse error \n";
									$this->adderr($err);
								}								
							}
						} 						
					}
					if ($er) {
						$err =  "Language2 is not provided in the Store \n";
						$this->adderr($err);
					}	
				}

				$summa_options = 0;
				if (($old_sku != $row[$cod] and !$optsku) or ($optsku and empty($row[$newproduct]))) {
					$summa_product_options = 0;
					$oldprice = $row_product[0]['price'];					
				}	
			
				$mas_opt = array();
				$yes_joption = 0;				
				if ($max_opt) {
					$jj = 1;
					for ($j = 1; $j <= $max_opt; $j++) {
						
						if (!$option_id[$j] or empty($opt[$j])) continue;
						
						if (preg_match('/^[0-9]+$/', $opt[$j])) {
							$row[$opt[$j]] = str_replace('&amp;&quot;' , '"' , $row[$opt[$j]]);			
							$row[$opt[$j]] = str_replace('&amp;' , '&' , $row[$opt[$j]]);	
							$row[$opt[$j]] = str_replace('&quot;' , '"' , $row[$opt[$j]]);							
							$opt_val = explode(";" , $row[$opt[$j]]);
						}
						
						if (isset($row[$ko[$j]])) $opt_ko = explode(";" , $row[$ko[$j]]);
						if (isset($row[$po[$j]])) $opt_po = explode(";" , $row[$po[$j]]);
						if (preg_match('/^[0-9]+$/', $prro[$j])) {
							if (isset($row[$prro[$j]])) $opt_pr = explode(";" , $row[$prro[$j]]);
						}	
						if (isset($row[$we[$j]])) $opt_we = explode(";" , $row[$we[$j]]);
						if (isset($row[$art[$j]])) $opt_art = explode(";" , $row[$art[$j]]);
						if (isset($row[$foto[$j]])) $opt_foto = explode(";" , $row[$foto[$j]]);
						
						if (($opt[$j] and !preg_match('/^[0-9]+$/', $opt[$j])) or ($prro[$j] and !preg_match('/^[0-9]+$/', $prro[$j]))) {
							if (isset($row[$parsi]) and !empty($row[$parsi])) {
								$url = $this->checkurl($row[$parsi]);
								if ($url != -1) {
									$maso = '';
									$masp = '';
									if (strlen($ht) < 1024 or $parsed != $parsi) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
									if (strlen($ht) > 1024) {
										$parsed = $parsi;
										unset($maso);
										unset($masp);
										$maso = '';
										$masp = '';
										$this->ParsOptions($ht, $opt[$j], $opt_point[$j], $prro[$j], $maso, $masp);
									}
									if (!$maso) {
										$err =  " Row ~= " . $row_count . " SKU = " . $row[$cod] ." Error in parameter parsing options: ". $opt[$j] . " price: " . $prro[$j] . " Link: " . $row[$parsi] ." \n";
										$this->adderr($err);
										continue;
									} else {
										if (isset($opt_val)) unset($opt_val);
										if (isset($opt_pr)) unset($opt_pr);
										for ($l=0; $l<200; $l++) {	
											if (!isset($maso[$l])) break;			
											if ($maso[$l]) $opt_val[$l] = $maso[$l];
											if ($masp[$l]) $opt_pr[$l] = $masp[$l];
											if (empty($prro[$j])) $opt_pr[$l] = '';
										}
									}	
								} else {
									$err =  " Row ~= " . $row_count . " SKU = " . $row[$cod] ." Error link for parsing options in column: ". $parsi . " \n";
									$this->adderr($err);
									continue;
								}
							}	
						}
						for ($l=0; $l<200; $l++) {
							for ($x=0; $x<1; $x++) {
								$option_foto = '';							
								if (isset($opt_foto[$l])) {
									$url = $opt_foto[$l];									
									$url = $this->checkurl($url);
									$pic_addr = '';
									$a = strlen($url)-6;
									$en = substr($url, $a);
									if (!substr_count($url, "/") and (stripos($en, '.jpg') or stripos($en, '.png') or stripos($en, '.jpeg') or stripos($en, '.gif') or stripos($en, '.bmp'))) {												

										$nom = stripos($url, ".j");
										if (!$nom) $nom = stripos($url, ".png");
										if (!$nom) $nom = stripos($url, ".gif");
										if (!$nom) $nom = stripos($url, ".bmp");
										if (!$nom) break;
										$se = substr($url, $nom);
										$app = substr($url, 0, $nom);
										$nom = strpos($app, ".");
										$app = substr($app, $nom);
										$app = $this->TransLit($app);							
										$app = $this->MetaURL($app);									
								
										$try = "../image/data/temp/".$url;
										if (file_exists($try)) {						
											if (!empty ($pic_int[$i]))	{
												$spath = "../image/data/" .$pic_int[$i]."/";
												$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
												$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
												$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
											} else {
												$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." The product passed"." \n";
												$this->adderr($err);
												break;
											}		
											if (!is_dir($spath)) {
												if (!@mkdir($spath, 0755)) {								
													$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
													$this->adderr($err);
													break;
												}
											}								
											if (!is_dir($path)) @mkdir($path, 0755);								
											$path = $path.$app.$se;	
											$a = @copy ($try, $path);
											if (!$a) {
												$a = @copy ($try, $spath);
												$pic_addr = $spic_addr;
											}											
										}
									}								
									if (substr_count($url, "/") and (stripos($en, '.jpg') or stripos($en, '.png') or stripos($en, '.jpeg') or stripos($en, '.gif') or stripos($en, '.bmp'))) {
								
										$nom = stripos($url, ".j");
										if (!$nom) $nom = stripos($url, ".png");
										if (!$nom) $nom = stripos($url, ".gif");
										if (!$nom) $nom = stripos($url, ".bmp");
										$a = strlen($url);
										if (!$nom or $a - $nom > 5) {
											$se = ".jpg";
											$nom = $a;
										} else $se = substr($url, $nom);
										$app = '';
										if (!empty($seo_data['prod_photo'])) {
											$data['name'] = '';
											if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
											$data['category'] = '';
											if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
											$data['manufacturer'] = '';
											if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = trim($row[$manuf]);
											$data['model'] = '';
											if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
											$data['brand'] = '';
											if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
											$data['sku'] = '';
											if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
											$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
											$app = $this->TransLit($app);
											$app = strtolower($app);
										}
										if (empty($app)) {
											$app = substr($url, 0, $nom);
											$nom = strpos($app, ".");
											$app = substr($app, $nom+7);
											$app = $this->TransLit($app);
											$nom = strlen($app);
											if ($nom > 250) $app = substr($app, $nom-250, 250);
											if ($nom < 2) $app = rand(0, 999999999);									
											$app = $this->MetaURL($app);
										}								
								
										if (!empty ($pic_int[$i]))	{
											$spath = "../image/data/" .$pic_int[$i]."/";
											$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
											$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
											$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
										} else {
											$path = "../image/data/photo/";											
											$pic_addr = "data/photo/".$app.$se;									
										}		
										if (!is_dir($spath)) {
											if (!@mkdir($spath, 0755)) {								
												$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
												$this->adderr($err);
												break;
											}
										}
										if (!is_dir($path)) @mkdir($path, 0755);
										$path = $path.$app.$se;										
										if (!file_exists($path)) {
											$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);
											if (!$this->isPicture($pict)) {
												$err =  " Download photo for Option, fails. Row ~= " . $row_count ." Url = ". $url . " Column = " . $foto[$j] . " \n";
												$this->adderr($err);
												break;
											} else {
												$bytes = @file_put_contents($path, $pict);
												if (!$bytes) {
													$bytes = @file_put_contents($spath, $pict);
													$pic_addr = $spic_addr;
												}	
											} 
										}
									}	
									$option_foto = $pic_addr;
								}	
							}
							$e = 0;
							if ((empty($opt_val[$l]) and !isset($opt_val[$l+1]) and !$optsku) or ($optsku and $l > 0) or (isset($row[$art[$j]]) and !isset($opt_art[$l]))) break;
							
							$data_option['op_val_id'] = 0;
							$rows = $this->getOptionsById($option_id[$j]);
							if (!empty($rows) and isset($opt_val[$l]) and !empty($opt_val[$l])) {
								if (preg_match('/^[0-9.,Ee+-]+$/', $opt_val[$l])) $opt_val[$l] = (string)round($opt_val[$l], 3);
								foreach ($rows as $r) {
									if ((string)$r['name'] == $opt_val[$l]) {		
										$e = 1;
										$data_option['op_val_id'] = $r['option_value_id'];
										break;
									}	
								}
							}	
							if (!$e) {
								if ($addopt and !empty($opt_val[$l])) {
									$this->addValue($option_id[$j], $ovid, $option_foto);
									$this->addValueDescription($option_id[$j], $ovid, $opt_val[$l], $langs);							
									$data_option['op_val_id'] = $ovid;
									$report = $report." Option value ".$opt_val[$l]." added";
								} else {									
									$err =  " The Option value: '". $opt_val[$l] . "' not found in the Store.  Row ~= " . $row_count . " SKU = " . $row[$cod] . " Please, set this Option value \n";
									$this->adderr($err);
									continue;
								}
							}
						
							$data_option['opt'] = $opt_val[$l];
							
							$data_option['ko'] = 0;							
							if (isset($opt_ko[$l])) $data_option['ko'] = $opt_ko[$l];
							
							$data_option['optsku'] = '';						
							if (isset($opt_art[$l])) $data_option['optsku'] = $opt_art[$l];							
							elseif ($optsku) $data_option['optsku'] = $o_optsku;
							
							$data_option['pr'] = 0;
							$data_option['pr_prefix'] = '=';						
							if (isset($opt_pr[$l])) {
								$e = substr($opt_pr[$l], strlen($opt_pr[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') {
									$data_option['pr_prefix'] = $e;								
									$b = substr($opt_pr[$l], 0, strlen($opt_pr[$l])-1);
									$a = $data_option['pr_prefix'];
								} else 	{
									$b = substr($opt_pr[$l], 0, strlen($opt_pr[$l]));
									$a = 0;
								}
								if (preg_match('/^[0-9.,Ee+-]+$/', $b)) {
									$data_option['pr'] = str_replace("," , ".", $b);
									if ($price != $prro[$j]) $data_option['pr'] = $data_option['pr']*$rate;
									
									if ($plusopt and $plus) $data_option['pr'] = $data_option['pr']+($data_option['pr']*$plus/100);
									$data_option['pr'] = round($data_option['pr'], 2);
									if ($a == '=' or !$a) {
										if ($data_option['pr'] and (float)$data_option['pr'] < (float)$price_on_site and (int)$data_option['ko']) {
											$price_on_site = (float)$data_option['pr'];	
										}
									}		
								}	
							}							
							
							$data_option['po'] = 0;
							$data_option['po_prefix'] = '=';
							if (isset($opt_po[$l])) {
								$e = substr($opt_po[$l], strlen($opt_po[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') 
								{	
						 	        $data_option['po_prefix'] = $e;							
									$b = substr($opt_po[$l], 0, strlen($opt_po[$l])-1);									
							    } else $b = substr($opt_po[$l], 0, strlen($opt_po[$l]));						
							    if (preg_match('/^[0-9.,Ee+-]+$/', $b)) $data_option['po'] = str_replace("," , ".", $b);
							}	
						
							
							$data_option['we'] = 0;
							$data_option['we_prefix'] = '=';
							if (isset($opt_we[$l])) {
								$e = substr($opt_we[$l], strlen($opt_we[$l])-1, 1);
								if ($e == '+' or $e == '-' or $e == '=' or $e == '%' or $e == '*' or $e == '#') 
								{ 	
							      $data_option['we_prefix'] = $e;								
								  $b = substr($opt_we[$l], 0, strlen($opt_we[$l])-1);
								} else  $b = substr($opt_we[$l], 0, strlen($opt_we[$l])); 
								if (preg_match('/^[0-9.,Ee+-]+$/', $b)) $data_option['we'] = str_replace("," , ".", $b);		
							}							
							
							if ($j == 1 and $l == 0 ) $report = $report."Product options created ";	
	
							$data_option['option_required'] = $option_required[$j];
							$valuta = 0;
							if (isset($row[$usd])) $valuta = $row[$usd];
							$this->upProductOption($last_product_id, $option_id[$j], $data_option, $minus, $ad, $option_type[$j], $my_price, $usd, $valuta);
							
							if ($minPriceOption and $price_on_site != 999999999999 and $max_opt) {			
								$this->db->query("UPDATE `" . DB_PREFIX . "product` SET `price` = '" . $price_on_site . "' WHERE `product_id` = '" . $last_product_id ."'");
							}
						
							if ($option_type[$j] == 'select' or $option_type[$j] == 'radio' or $option_type[$j] == 'image' or $option_type[$j] == 'checkbox') {
								$mas_opt[$jj][$l][0] = $last_product_id;
								$mas_opt[$jj][$l][1] = $option_id[$j];
								$mas_opt[$jj][$l][2] = $data_option['op_val_id'];
								$mas_opt[$jj][$l][3] = $ko[$j];
								$mas_opt[$jj][$l][4] = $data_option['ko'];							
								$mas_opt[$jj][$l][5] = $data_option['pr'];							
								$mas_opt[$jj][$l][6] = $data_option['we_prefix'];							
								$mas_opt[$jj][$l][7] = $data_option['we'];
								$mas_opt[$jj][$l][8] = $data_option['optsku'];

								if (isset($summa_product_options)) $summa_product_options = $summa_product_options+$data_option['ko'];
	
								$jj++;
							}	
						}	
					}					
					if ($jopt) {
						for ($l=0; $l<30; $l++) {	
							$gr_data = array();
							$n = 0; $a = ''; $b = '';		
							for ($j=1; $j<=$jj; $j++) {
								if (!isset($mas_opt[$j][$l][0])) continue;
								$m = 0;
								for ($k=1; $k<=$jj; $k++) {
									if (!isset($mas_opt[$k][$l][0])) continue;
									if ($mas_opt[$j][$l][3] == $mas_opt[$k][$l][3] and $j != $k and $a != $mas_opt[$j][$l][1] and $b != $mas_opt[$j][$l][2]) {								
										$a = $mas_opt[$j][$l][1];
										$b = $mas_opt[$j][$l][2];
										$n++;
										$m++;
										$gr_data[$n][0] = $l;
										$gr_data[$n][1] = $last_product_id;
										$gr_data[$n][2] = $mas_opt[$j][$l][1];
										$gr_data[$n][3] = $mas_opt[$j][$l][2];
										$gr_data[$n][4] = $mas_opt[$j][$l][4];
										$gr_data[$n][5] = $mas_opt[$j][$l][5];
										$gr_data[$n][6] = $mas_opt[$j][$l][6];
										$gr_data[$n][7] = $mas_opt[$j][$l][7];
										$gr_data[$n][8] = $mas_opt[$j][$l][8];									
									}
								}					
							}			
							if (!empty($gr_data)) {
								$this->jOption($gr_data);
								unset($gr_data);
								$yes_joption = 1;
							}
						}
					}	
				}
				unset($mas_opt);

				if ($yes_joption) {
					$this->summaOption($last_product_id, $summa_options);
					if ($summa_options) $row_product[0]['quantity'] = $summa_options;
				} else {
					if (isset($summa_product_options) and $summa_product_options) $row_product[0]['quantity'] = $summa_product_options;
				}
		
				// Добавление акционных цен
				$ff = 0;
				if (!empty($aprice) and empty($row[$newproduct])) {
					for ($j=0; $j<20; $j++) {
						if (!isset($aprice[$j])) break;
						if (empty($aprice[$j])) continue;
						$data['product_id'] = $last_product_id;
						$data['customer_group_id'] = $j+1;
						$data['priority'] = 1;
						$pr = $row[$aprice[$j]];
						$pr = preg_replace('/[^0-9.Ee,+-]/','',$pr);
						$pr = str_replace(',', '.',$pr);
						$pr = trim($pr);
						if (!preg_match('/^[0-9.Ee+-]+$/', $pr)) $pr = '';
						else $pr = $pr*$rate;
						if (round($pr, 0) > round($new_price, 0)) $pr = '';
						$data['price'] = $pr;
						$data['date_start'] = "2000-01-01";
						$data['date_end'] = "2040-01-01";
						if ($pr) {							
							$this->putActionPrice($data);
							$ff = 1;
						}
					}	
				}
				if ($ff) $report = $report."Special price added ";

				$ff = 0;
				if (count($mprice) > 1 and empty($row[$newproduct])) {   // Скидочные цены, скидки
					for ($j=1; $j<20; $j++) {
						if (!isset($mprice[$j])) break;
						if (empty($mprice[$j])) continue;					
						$data['product_id'] = $last_product_id;
						$data['customer_group_id'] = $j;
						$data['priority'] = 1;
						$pr = $row[$mprice[$j]];
						$pr = preg_replace('/[^0-9.,Ee+-]/','',$pr);
						$pr = str_replace(',', '.',$pr);
						$pr = trim($pr);
						if (!preg_match('/^[0-9.Ee+-]+$/', $pr)) $pr = '';
						else $pr = $pr*$rate;
						if (round($pr, 0) > round($new_price, 0)) $pr = '';
						$data['price'] = $pr;
						$data['quantity'] = 1;
						$data['date_start'] = "2000-01-01";
						$data['date_end'] = "2040-01-01";	
						if ($pr) {
							$this->putWholesale($data);
							$ff = 1;
						}	
					}	
				} else {
					if (count($mprice) == 1 and !empty($qu_d) and $ad != 2 and empty($row[$newproduct])) {
						for ($j=1; $j<20; $j++) {							
							$data['product_id'] = $last_product_id;
							$data['customer_group_id'] = $j;
							$data['priority'] = 1;
							for ($k=0; $k<20; $k++) {
								if (!isset($qu_d['quantity'][$k])) break;								
								$data['price'] = $new_price-$new_price*$qu_d['percent'][$k]/100;
								$data['quantity'] = $qu_d['quantity'][$k];
								$data['date_start'] = "2000-01-01";
								$data['date_end'] = "2040-01-01";
								if ($data['price']) {
									$this->putWholesale($data);
									$ff = 1;
								}
							}
						}
					}
				}	
				unset($qu_d);
				
				if ($ff) $report = $report."Wholesale price added ";

				if (!empty($bonus) and preg_match('/^[0-9,]+$/', $bonus)) { // бонусы
					$bb = explode(',', $bonus);					
					for ($j=0; $j<count($bb); $j++) {
						if ($j == 0) {							
							if (preg_match('/^[0-9]+$/', $bb[0]) and !empty($row[$bb[$j]])) $this->Bonus0($last_product_id, $row[$bb[0]]);
						} else {							
							if (preg_match('/^[0-9]+$/', $bb[$j]) and !empty($row[$bb[$j]])) $this->Bonus1($j, $last_product_id, $row[$bb[$j]]);
						}	
					}	
				}						
				
				for ($k=1; $k<=$npic; $k++) {		
					if (!isset($pictures_new[$k])) break;
					$nn = $pictures_new[$k];
					if (isset($row[$nn]) and !empty ($row[$nn])) {
						$nolink = 0;
						if (!substr_count($row[$nn], "/")) $nolink = 1;
						$url = $row[$nn];
						if (!$nolink) $url = $this->checkurl($row[$nn]);
						if ($url == -1) continue;
						if ($nolink) {
							$url = $row[$nn];
							$nom = stripos($url, ".j");
							if (!$nom) $nom = stripos($url, ".png");
							if (!$nom) $nom = stripos($url, ".gif");
							if (!$nom) $nom = stripos($url, ".bmp");
							if (!$nom) continue;
							$se = substr($url, $nom);
							$app = '';
							if (!empty($seo_data['prod_photo'])) {
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = $row_product[0]['manuf_name'];
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}
							if (empty($app)) {
								$app = substr($url, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom);
								$app = $this->TransLit($app);							
								$app = $this->MetaURL($app);
							}
	
							$try = "../image/data/temp/".$url;
							if (file_exists($try)) {						
								if (!empty ($pic_int[$i]))	{
									$spath = "../image/data/" .$pic_int[$i]."/";
									$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
									$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
									$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;				
								} else {
									$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." \n";
									$this->adderr($err);
									continue;
								}		
								if (!is_dir($spath)) {
									if (!@mkdir($spath, 0755)) {								
										$err =  " Additional photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
										$this->adderr($err);
										continue;
									}
								}								
								if (!is_dir($path)) @mkdir($path, 0755);
								$path = $path.$app.$se;
								$a = @copy ($try, $path);
								if (!$a) {
									$a = @copy ($try, $spath);
									$pic_addr = $spic_addr;
								}	
								if ($a) {
									$rows = $this->getProductImage($last_product_id);
									$e = 1;										
									foreach ($rows as $p) {
										if ($p['image'] == $pic_addr) $e = 0;
									}	
									if ($e and !empty($pic_addr)) $this->addPicture($last_product_id, $pic_addr, $k);						
								}
							}
						} else {						
							$nom = stripos($url, ".j");
							if (!$nom) $nom = stripos($url, ".png");
							if (!$nom) $nom = stripos($url, ".gif");
							if (!$nom) $nom = stripos($url, ".bmp");
							$a = strlen($url);
							if (!$nom or $a - $nom > 5) {
								$se = ".jpg";
								$nom = $a;
							} else $se = substr($url, $nom);
							$app = '';
							if (!empty($seo_data['prod_photo'])) {
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = $row_product[0]['manuf_name'];
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}
							if (empty($app)) {
								$app = substr($url, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom+7);
								$app = $this->TransLit($app);
								$nom = strlen($app);
								if ($nom > 250) $app = substr($app, $nom-250, 250);
								if ($nom < 2) $app = rand(0, 999999999);						
								$app = $this->MetaURL($app);
							}
							
							if ($newphoto != 5) {
								if (!empty ($pic_int[$i]))	{
									$spath = "../image/data/" .$pic_int[$i]."/";
									$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
									$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
									$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;		
								} else {
									$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." The product passed"." \n";
									$this->adderr($err);
									continue;
								}		
								if (!is_dir($spath)) {
									if (!@mkdir($spath, 0755)) {								
										$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
										$this->adderr($err);
										continue;
									}
								}
								if (!is_dir($path)) @mkdir($path, 0755);					
								$path = $path.$app.$se;
								
							} else 	{
								$pic_addr = '';
								if (!empty($row[$pic])) {
									$link = $row[$pic];
									$link = str_replace('&quot;', '"',$link);
									$link = str_replace('&lt;', '<',$link);
									$link = str_replace('&gt;', '>',$link);
									$link = str_replace('&amp;', '&',$link);									
									if (substr_count($link, "data/")) {
										$nom = strpos($link, "data/");		
										$link = substr($link, $nom);
										$pic_addr = $link;		
									}
								}	
							}
							
							if (!file_exists($path) and $newphoto != 5) {
								$pict = $this->curl_get_contents($url, 1, $sleep, $ffile);
								if (!$this->isPicture($pict)) {								
									$err =  " Download additional photo fails. Url: ". $url . " Row ~= " . $row_count . " SKU = " . $row[$cod] ." \n";
									$this->adderr($err);
									continue;
								}
								$bytes = @file_put_contents($path, $pict);
								if (!$bytes) {
									$bytes = @file_put_contents($spath, $pict);
									$pic_addr = $spic_addr;
								}	
								if ($bytes) $this->addPicture($last_product_id, $pic_addr, $k);	
							} else {
								$rows = $this->getProductImage($last_product_id);
								$e = 1;
								if (!empty ($rows)) {	
									foreach ($rows as $p) {
										if ($p['image'] == $pic_addr) $e = 0;
									}
								}
								if ($newphoto == 5) {
									$pa = "../image/" . $pic_addr;
									if (!file_exists($pa)) $pic_addr = '';										
								}
								if ($e and !empty($pic_addr)) $this->addPicture($last_product_id, $pic_addr, $k);										
							}			
						}
					}
				}
				if ($nojpg) {
					if (!empty($parsk) and isset($row[$parsk])) {
						$url = $this->checkurl($row[$parsk]);					
						if (strlen($ht) < 1024 or $parsed != $parsk) $ht = $this->curl_get_contents($url, 0, $sleep, $ffile);
						if (strlen($ht) < 1024) {										
							$err =  " Parsing additional photo error: Row ~= " . $row_count . " url = ". $url. " Check your settings \n";
							$this->adderr($err);										
							continue;
						}
					}
					$parsed = $parsk;
					for ($k=1; $k<=$ns; $k++) {						
						if (!isset($seeks[$k]) or empty($seeks[$k])) break;						
						$fname = "photo";
						if (isset($marks[$k]) and !empty($marks[$k])) {												
							$fname = $marks[$k];
						} else {						
							if (isset($row[$manuf]) and !empty($row[$manuf])) {
								$fname = $row[$manuf];								
								$fname = substr($fname, 0, 16);
							}
						}						
						$key = '';						 
						$urlp = $this->ParsPic($ht, $url, $key, $seeks[$k], $fname, $pic_ext);		
						if ($urlp) {				
							$nom = stripos($urlp, ".j");
							if (!$nom) $nom = stripos($urlp, ".png");
							if (!$nom) $nom = stripos($urlp, ".gif");
							if (!$nom) $nom = stripos($urlp, ".bmp");
							$a = strlen($urlp);
							if (!$nom or $a - $nom > 5) {
								$se = ".jpg";
								$nom = $a;
							} else $se = substr($urlp, $nom);
							$app = '';
							if (!empty($seo_data['prod_photo'])) {
								$data['name'] = '';
								if (isset($row_product[0]['item']) and !empty($row_product[0]['item'])) $data['name'] = $row_product[0]['item'];
								$data['category'] = '';
								if (isset($text_cat) and !empty($text_cat)) $data['category'] = trim($text_cat);
								$data['manufacturer'] = '';
								if (isset($row[$manuf]) and !empty($row[$manuf])) $data['manufacturer'] = $row_product[0]['manuf_name'];
								$data['model'] = '';
								if (isset($row_product[0]['model']) and !empty($row_product[0]['model'])) $data['model'] = $row_product[0]['model'];
								$data['brand'] = '';
								if (isset($row[$ref]) and !empty($row[$ref])) $data['brand'] = trim($row[$ref]);
								$data['sku'] = '';
								if (isset($row[$cod]) and !empty($row[$cod])) $data['sku'] = trim($row[$cod]);
								$app = $this->namePhoto($store, $data, $seo_data['prod_photo']);
								$app = $this->TransLit($app);
								$app = strtolower($app);
							}
							if (empty($app)) {
								$app = substr($urlp, 0, $nom);
								$nom = strpos($app, ".");
								$app = substr($app, $nom+7);
								$app = $this->TransLit($app);
								$nom = strlen($app);
								if ($nom > 250) $app = substr($app, $nom-250, 250);
								if ($nom < 2) $app = rand(0, 999999999);								
								$app = $this->MetaURL($app);
							}
	
							if (!empty ($pic_int[$i]))	{
								$spath = "../image/data/" .$pic_int[$i]."/";
								$path = "../image/data/" .$pic_int[$i]."/".$papka."/";
								$spic_addr = "data/".$pic_int[$i]."/".$app.$se;
								$pic_addr = "data/".$pic_int[$i]."/".$papka."/".$app.$se;		
							} else {
								$err =  " Please, set folder for photo on page 'Category and margin'  for Category '" .$catmany[0]."' Row ~= " . $row_count ." The product passed"." \n";
								$this->adderr($err);
								continue;
							}		
							if (!is_dir($spath)) {
								if (!@mkdir($spath, 0755)) {								
									$err =  " Photo has not been write: Row ~= " . $row_count . " SKU = " . $row[$cod] . " Can not create folder: " . $spath. ", create it manually \n";
									$this->adderr($err);
									continue;
								}
							}
							if (!is_dir($path)) @mkdir($path, 0755);
							$path = $path.$app.$se;							
							if (!file_exists($path)) {					
								$pict = $this->curl_get_contents($urlp, 1, $sleep, $ffile);
								if (!$this->isPicture($pict)) break;									
								$bytes = @file_put_contents($path, $pict);
								if (!$bytes) {
									$bytes = @file_put_contents($spath, $pict);
									$pic_addr = $spic_addr;
								}	
								if ($bytes) $this->addPicture($last_product_id, $pic_addr, $k);
							} else {
								$rows = $this->getProductImage($last_product_id);
								$e = 1;
								if (!empty ($rows)) {	
									foreach ($rows as $p) {
										if ($p['image'] == $pic_addr) $e = 0;
									}
								}
								if ($e and !empty($pic_addr)) $this->addPicture($last_product_id, $pic_addr, $k);										
							}					
						} // !er				
					} // end for picture
				}	
			
				if (!empty($related)) {
					$related_val = explode(";" , $row[$related]);
					foreach ($related_val as $val) {						
						$rows = $this->getProductBySKU($val, $store);
						if (isset($rows) and !empty($rows[0]['product_id'])) {
							$related_id = $rows[0]['product_id'];
							$rows = $this->getRalated($last_product_id, $related_id);
							if (isset($rows) and empty($rows)) $this->addRelated($last_product_id, $related_id);			
												
							$rows = $this->getRalated($related_id, $last_product_id);
							if (isset($rows) and empty($rows)) $this->addRelated($related_id, $last_product_id);
						
						}	
					}
				}
			}			
			
			if (!empty($report)) $this->addReport($report, $row_count, $row[$cod]);
			$old_sku = $row[$cod];
		}
		$path = "./uploads/sos.tmp";
		if (file_exists($path)) unlink ($path);
		
		if ($exsame) {
			$this->EndEx(7);
		}
		
		return 0;	
	}	
}
?>