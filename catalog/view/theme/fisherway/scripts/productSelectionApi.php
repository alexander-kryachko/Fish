<?

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: text/html; encoding=utf-8');
mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
mysql_select_db(DB_DATABASE);
mysql_query('set names utf8');
if (isset($_GET['categories'])) categories();
if (isset($_GET['options'])) options();
if (isset($_GET['products'])) products();
if (isset($_GET['test'])) test();

function test(){
	echo rand(0, 100);
	exit();
}

function categories(){
	global $categories, $table;
	$data = $categories = $table = array();
	$result = mysql_query('SELECT 
			c.category_id, 
			c.parent_id, 
			cd.name 
		FROM oc_category c
		INNER JOIN oc_category_description cd on (c.category_id = cd.category_id)
		WHERE language_id = 1 AND status = 1
		ORDER BY c.sort_order');
	while ($row = mysql_fetch_assoc($result)){
		if (!isset($categories[$row['parent_id']])) $categories[$row['parent_id']] = array();
		$categories[$row['parent_id']][$row['category_id']] = $row;
		$table[$row['category_id']] = $row;
	}

	recursiveCategory($data, 0);
	echo json_encode($data);
	exit();
}

function options(){
	$category = (int)$_GET['options'];
	$result = mysql_query('SELECT 
			o.option_id,
			o.type,
			o.selectbox,
			od.name
		FROM oc_ocfilter_option_to_category o2c
		INNER JOIN oc_ocfilter_option o on (o.option_id = o2c.option_id)
		INNER JOIN oc_ocfilter_option_description od on (o.option_id = od.option_id AND od.language_id = 1)
		WHERE o2c.category_id = '.$category.' 
		ORDER BY o.sort_order');
		// AND o2c.enabled = 1 AND o.status = 1
	$options = $values = array();
	while ($row = mysql_fetch_assoc($result)){
		$options[$row['option_id']] = $row;
	}
	if (!empty($options)){
		$result = mysql_query('SELECT 
				ov2p.value_id
			FROM oc_ocfilter_option_value_to_product ov2p
			INNER JOIN oc_product_to_category p2c on (p2c.product_id = ov2p.product_id)
			WHERE ov2p.option_id IN ('.implode(',', array_keys($options)).') AND p2c.category_id = '.$category.'
		');
		while ($row = mysql_fetch_assoc($result)) $values[] = $row['value_id'];
		$values = array_unique($values);

		$result = mysql_query('SELECT 
				ov.value_id,
				ov.option_id,
				ovd.name
			FROM oc_ocfilter_option_value ov
			INNER JOIN oc_ocfilter_option_value_description ovd on (ov.value_id = ovd.value_id AND ovd.language_id = 1)
			WHERE ov.option_id IN ('.implode(',', array_keys($options)).')
			ORDER BY ovd.name
		');
		while ($row = mysql_fetch_assoc($result)){
			if (!in_array($row['value_id'], $values)) continue;
			if (!isset($options[$row['option_id']]['values'])) $options[$row['option_id']]['values'] = array();
			$options[$row['option_id']]['values'][] = $row;
		}
	}
	$data = array();
	foreach($options as $o) $data[] = $o;
	echo json_encode($data);
	exit();	
}

function products(){
	/*
		'category': parseInt($('#category option:selected').val()),
		'priceFrom': parseFloat($('#priceFrom').val().trim()),
		'priceTo': parseFloat($('#priceTo').val().trim()),
		'values': values		
	*/
	$data = array();
	$category = isset($_POST['category']) ? (int)$_POST['category'] : 0;
	$priceFrom = isset($_POST['priceFrom']) ? (float)$_POST['priceFrom'] : 0;
	$priceTo = isset($_POST['priceTo']) ? (float)$_POST['priceTo'] : 0;
	$values = isset($_POST['values']) ? $_POST['values'] : array();
	$rpp = 99999;
	$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
	$notavailable = !empty($_POST['notavailable']) && $_POST['notavailable'] == 'true' ? true : false;
	$disabled = !empty($_POST['fdisabled']) && $_POST['fdisabled'] == 'true' ? true : false;

	$products = array();
	if ($category){
				//p.quantity,
		$result = mysql_query('SELECT 
				p.product_id, 
				p.purchase_price,
				p.price,
				p.sku,
				p.image,
				p.status,
				p.quantity,
				p.jan,
				ps.price as special,
				IF (ps.price, ps.price, p.price) as `finalPrice`,
				(IF (ps.price, ps.price, p.price)) - p.purchase_price as `margin`
			FROM oc_product p
			INNER JOIN oc_product_to_category p2c on (p2c.product_id = p.product_id)
			LEFT JOIN oc_product_special ps on (ps.product_id = p.product_id AND date_start <= "'.date('Y-m-d').'" AND (ps.date_end = "0000-00-00" OR date_end >= "'.date('Y-m-d').'"))
			WHERE p2c.category_id = '.$category.' '.($disabled ? '' : 'AND p.status = 1').' '.($notavailable || $disabled ? '' : 'AND p.quantity > 0').'
			ORDER BY `margin` DESC
		');

		while ($row = mysql_fetch_assoc($result)){
			$price = !empty($row['special']) && (float)$row['special'] < (float)$row['price'] ? (float)$row['special'] : (float)$row['price'];
			if (($priceFrom && $priceFrom > $price) || ($priceTo && $priceTo < $price)) continue;
			$products[$row['product_id']] = $row;
			$products[$row['product_id']]['sku'] = ltrim($products[$row['product_id']]['sku'], '0');
		}


		// filter values
		if (!empty($values)){
			$productIds = array_keys($products);
			
			$result = mysql_query('SELECT value_id, option_id FROM oc_ocfilter_option_value WHERE value_id IN ('.implode(',', $values).')');
			$o2v = $v2o = array();
			while ($row = mysql_fetch_assoc($result)){
				if (!isset($o2v[$row['option_id']])) $o2v[$row['option_id']] = array();
				$o2v[$row['option_id']][] = $row['value_id'];
				$v2o[$row['value_id']] = $row['option_id'];
			}

			foreach($o2v as $o => $v){
				$result = mysql_query('SELECT 
						ov2p.product_id
					FROM oc_ocfilter_option_value_to_product ov2p
					INNER JOIN oc_product_to_category p2c on (p2c.product_id = ov2p.product_id)
					WHERE option_id = '.$o.' AND value_id IN ('.implode(',', $v).')');
				$pids = array();
				while ($row = mysql_fetch_assoc($result)){
					$pids[] = $row['product_id'];
				}
				$productIds = array_intersect($productIds, $pids);
				if (empty($productIds)) break;
			}

					
			$filtered = array();
			foreach($products as $k => $v){
				if (in_array($k, $productIds)) $filtered[$k] = $v;
			}
			$products = $filtered;
		}
		

		if (!empty($products)) $products = array_slice($products, $offset, $rpp, true);
		if (!empty($products)){
			$keys = array_keys($products);

			$result = mysql_query('SELECT SUBSTR(query,12) AS pid, `keyword` as `url` FROM oc_url_alias WHERE `query` LIKE "product_id=%"');
			$links = array();
			while ($row = mysql_fetch_assoc($result)){
				$links[$row['pid']] = $row['url'];
			}
			
			$result = mysql_query('SELECT od.product_id, od.name FROM oc_product_description od WHERE language_id = 1 AND product_id IN ('.implode(',', $keys).')');
			while ($row = mysql_fetch_assoc($result)){
				$products[$row['product_id']]['name'] = $row['name'];
				$products[$row['product_id']]['attributes'] = array();
				
				$products[$row['product_id']]['url'] = !empty($links[$row['product_id']]) ? '/'.$links[$row['product_id']] : '#';
			}
			
			//$attributes = array();
			if (!empty($keys)){
				$result = mysql_query('SELECT 
						pa.product_id, 
						ad.name as attribute,
						pa.text as value
					FROM oc_product_attribute pa
					INNER JOIN oc_attribute a on (pa.attribute_id = a.attribute_id)
					INNER JOIN oc_attribute_description ad on (ad.attribute_id = a.attribute_id AND ad.language_id = 1)
					WHERE pa.product_id IN ('.implode(',', $keys).') AND pa.language_id = 1 AND a.enabled = 1
					ORDER BY a.sort_order');
					
				while ($row = mysql_fetch_assoc($result)){
					if (!isset($attributes[$row['product_id']])) $attributes[$row['product_id']] = array();
					$products[$row['product_id']]['attributes'][] = $row['attribute'].': '.$row['value'];
				}
			}
		}
		
		//print_r($products);
	}
	
	echo json_encode(array_values($products));
	exit();
}


function recursiveCategory(&$data, $parent, $lvl = 0){
	global $categories, $table;
	foreach ($categories[$parent] as $k => $v){
		$hasChildren = !empty($categories[$k]);
		//echo $lvl.'. '.$v['name'].'<br />';
		$name = $v['name'];
		$j = $v;
		while($j['parent_id']){
			$j = $table[$j['parent_id']];
			$name = $j['name'].' > '.$name;
		}
		$data[] = array('id' => $k, 'name' => $name);
		if ($hasChildren){
			recursiveCategory($data, $k, $lvl+1);
		}
	}
}

?>