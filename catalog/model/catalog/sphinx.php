<?php
class ModelCatalogSphinx extends Model
{

    protected $LENGTH_THRESHOLD = 1;
    protected $LEVENSHTEIN_THRESHOLD = 2;
    protected $TOP_COUNT = 10;

    protected $LANG_BITS_MASK = 4194303; // 22 bits set to 1
    
    protected $_sphinxClient = null;

    protected $_indexes = array(
                            'products' => 'fish_main',
                            'categories' => 'fish_categoryinfo',
                            'suggestions' => 'fish_suggestions',
                          );

    protected $_productFieldWeights = array(
                                        'name'        => 1,
                                        'description' => 1,
                                        'model'       => 1,
                                        'sku'         => 1,
                                        'ean'         => 1,
                                        'jan'         => 1,
                                        'isbn'        => 1,
                                        'mpn'         => 1,
                                      );

    protected $_lastQueryKeywords = array();

    /**
     * @return SphinxClient
     */
    public function getSphinxClient()
    {
        if (null === $this->_sphinxClient) {
            if (!class_exists("SphinxClient")) {
                $this->load->library('sphinx/sphinxapi');
            }

            $sphinxClient = new SphinxClient();
  		    $sphinxClient->SetServer($this->config->get('sphinx_search_server'),
  		                             $this->config->get('sphinx_search_port'));

  		    $sphinxClient->SetConnectTimeout(1);
  		    //$sphinxClient->_mbenc = "UTF-8";
            $sphinxClient->ResetFilters();

            $this->_sphinxClient = $sphinxClient;
        }

        return $this->_sphinxClient;
    }


    /**
     * Get sphinx index name
     * @return string
     */
    public function getSphinxIndex($name)
    {
        if (!isset($this->_indexes[$name])) {
            $name = 'products';
        }
        return $this->_indexes[$name];
    }

    /**
     * Get child categories ids recursively
     *
     * @param int $categoryId
     * @return array
     */
    public function getSubcategoriesForFilter($categoryId)
    {
        $this->load->model('catalog/category');

        $ids = array();

        $categories = $this->model_catalog_category->getCategories($categoryId);

        foreach ($categories as $category) {
            $ids[] = $category['category_id'];

            $ids = array_merge($ids,$this->getSubcategoriesForFilter($category['category_id']));
        }

        return $ids;
    }

    public function search($data, $index = null, $wildcard = false)
    {

		$this->load->model('catalog/product');
		
        $sphinxClient = $this->getSphinxClient();
        $sphinxClient->ResetFilters();

        $data = array_merge(array(
                                'filter_name' => '',
                                'filter_tag'  => '',
                                'filter_category_id' => 0,
                                'filter_sub_category' => false
                                ),
                            $data
                            );
        $result = array ('product_total' => 0,
                         'results' => array());

        /**
         * There is a problem with searchd connection or search is done by tag
         * @TODO Add support for product tag indexing and searching
         */
		 
		// var_dump($data);
/*
		 
        if (!$sphinxClient->status() || (empty($data['filter_name']) && !empty($data['filter_tag']))) {
            // @TODO Better fallback for products index.
            if ($index == 'products') {
                $result['product_total'] = $this->model_catalog_product->getTotalProducts($data);
                $result['results'] = $this->model_catalog_product->getProducts($data);
            }

            return $result;
        }
		*/

        $index = (null == $index) ? 'products' : $index;
        $sphinxIndex = $this->getSphinxIndex($index);
		

        //Set field weights
        $weights = $this->_productFieldWeights;

        if ($fieldWeights = $this->config->get('sphinx_weights')) {
            foreach ($fieldWeights as $key => $val) {
                $weights[$key] = (int)$val;
            }
        }
        $sphinxClient->SetFieldWeights($weights);

        // Set matching mode
     //   if (!$wildcard) {
 //           $sphinxClient->SetMatchMode((int)$this->config->get('sphinx_match_mode'));

            // Set how to rank the weighted values
    //        $sphinxClient->SetRankingMode((int)$this->config->get('sphinx_ranking_mode'));
   //     } else {
            $data['filter_name'] = '*' . $data['filter_name'] . '*';
			
	
		
	//	$text = preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/","",$data['filter_name']);
		

		
	//	$data['filter_name'] = '*' . $text . '*';
		
	
	/*
		$text = preg_replace('|[\s]+|s', ' ', $data['filter_name']);
			

		$words = explode(" ", $text);
		
		$res = array();
		foreach ($words as $word) {	

			if	(strlen($word) > 1) {	
				$word_ = $this->dmstring($word);
				$ins = array();
				$ins[] = $word;
				$ins[] = '*' . $word . '*';

				if ($word_ != strtolower($word)){
					$ins[] = $word_;
					$ins[] = '*' . $word_ . '*';
					
				} ;
		 
				$res[] = '(' .implode(' | ', $ins) . ')';
			};
		}
		
		$data['filter_name'] = implode(' & ', $res);
		$data['filter_name'] .= ' | (*' . $text . '*) | (*' . $this->dmstring($text) . '*)';
		*/
	//	print_r($data['filter_name']);
	//	print_r($res);
	//	exit();


		// (масло | *масло*) & (Castrol | *Castrol*) & (5W40 | *5W40*)
		// $sphinxClient->SetMatchMode((int)$this->config->get('sphinx_match_mode'));
	  //   $sphinxClient->SetRankingMode((int)$this->config->get('sphinx_ranking_mode'));
            $sphinxClient->SetMatchMode(SPH_MATCH_EXTENDED);
            $sphinxClient->SetRankingMode(SPH_RANK_WORDCOUNT);
     //   }

        // Set sort mode and direction
        switch ($data['sort']) {
            case 'pd.name':
            case 'p.price':
            case 'p.model':
            case 'rating':
                $field = str_ireplace(array('p.', 'pd.'), '', $data['sort']);
                $sortMode = constant('SPH_SORT_ATTR_' . strtoupper($data['order']));
                $sphinxClient->SetSortMode($sortMode, $field);
                break;
            default:
                $sphinxClient->SetSortMode(SPH_SORT_RELEVANCE);
                break;
        }
		
		

		

        if ($data['filter_category_id'] > 0) {

            $categoryIdFilter = array($data['filter_category_id']);

            if (!isset($data['filter_name']) || empty($data['filter_name'])) {
            //    $sphinxClient->SetMatchMode(SPH_MATCH_FULLSCAN);
            }

            if ($data['filter_sub_category'] == true) {
                $categoryIdFilter = array_merge($categoryIdFilter, $this->getSubcategoriesForFilter($data['filter_category_id']));
            }

            $sphinxClient->setFilter("categories_filter", $categoryIdFilter);
        }


        // Set quantity filter
        if ($index == 'products') {
            $quantity = (int)$this->config->get('sphinx_search_products_quantity');
            $sphinxClient->SetFilterRange('quantity', $quantity, 2147000000);
        }

        // Set product status filter
        if((int)$this->config->get('sphinx_search_product_status') == 0) {
            $sphinxClient->setFilter('status', array(1));
        }

        // Set store filter
        $storeID = (int)$this->config->get('store_id');
        $sphinxClient->SetFilter('store_filter', array($storeID));

        // Set language filter
        $langID = (int)$this->config->get('config_language_id');
        $sphinxClient->SetFilter('language_id', array($langID));
        
		// Set manufacturer filter
		$isRtIndex = $this->config->get('sphinx_config_index_type');
        if (!empty($data['filter_manufacturer_id']) && $isRtIndex == '0') {
        	$manID = $data['filter_manufacturer_id'];
        	$sphinxClient->SetFilter('manufacturer_id', array($manID));
        }
		
		// Set product attribute filter
        if (isset($data['filter_product_attribute']) && $data['filter_product_attribute'] > 0) {
        	$productAttributeFilter = array($data['filter_product_attribute']);
        	$sphinxClient->setFilter("product_attribute", $productAttributeFilter);
        }
		
        // Set page limits
        $sphinxClient->SetLimits((int)$data['start'], (int)$data['limit']);

        // Return the results as an array
        $sphinxClient->SetArrayResult(true);

        // Search
        $searchResults = $sphinxClient->Query($data['filter_name'], $sphinxIndex);
		
	//	var_dump($data['filter_name']);	
	//	var_dump($sphinxIndex);	
	//	var_dump($sphinxClient);	
	
		



        if (!$searchResults) {
            $this->log->write('Sphinx search failed: ' . $sphinxClient->GetLastError());
            return $result;
        }

        if ($sphinxClient->GetLastWarning()) {
            $this->log->write('Sphinx search warning: ' . $sphinxClient->GetLastWarning());
        }

        if (isset($searchResults['words'])) {
            $this->_lastQueryKeywords = $searchResults['words'];
        }
		
		//var_dump($searchResults);
		//exit();

        if ($searchResults['total'] <= 0 || !isset($searchResults['matches'])) {
            return $result;
        }
		


		

        $this->load->model('catalog/product');
        $this->load->model('catalog/category');

        $result['product_total'] = $searchResults['total_found'];
        foreach ($searchResults['matches'] as $docinfo) {
        	$id = $docinfo['id'];
        	$id &= $this->LANG_BITS_MASK; 
        	
            if ($index == 'products') {
                $record = $this->model_catalog_product->getProduct((int) $id);
            } else {
                $record = $this->model_catalog_category->getCategory((int) $id);
            }
            // DB record missing but still in index?!?!
            if (!$record) {
                continue;
            }

            $result['results'][] = $record;
        }

			
        return $result;
    }

    /**
     * Get normalized keywords from last sphinx query
     *
     * @return array
     */
    public function getLastQueryKeywords()
    {
        return $this->_lastQueryKeywords;
    }

    /**
     * Get keyword trigrams
     *
     * @param stringn $keyword
     * @return string
     */
    public function getKeywordTrigrams($keyword)	{

        mb_internal_encoding("UTF-8");

        $t = "__" . $keyword . "__";

        $trigrams = "";
        for ($i = 0; $i < mb_strlen($t) - 2; $i++) {
            $trigrams .= mb_substr($t, $i, 3) . " ";
        }

        return $trigrams;
    }

    public function getKeywordSuggestion($keyword) {

        $trigrams = $this->getKeywordTrigrams($keyword);

        $query = "\"$trigrams\"/1";
        $len = strlen($keyword);

        $delta = $this->LENGTH_THRESHOLD;

        $sphinxClient = $this->getSphinxClient();
        $sphinxClient->ResetFilters();
        $sphinxClient->SetMatchMode(SPH_MATCH_EXTENDED2);
        $sphinxClient->SetRankingMode(SPH_RANK_WORDCOUNT);
        $sphinxClient->SetFilterRange("len", $len - $this->LENGTH_THRESHOLD, $len + $this->LENGTH_THRESHOLD );
        $sphinxClient->SetSelect("*, @weight+$this->LENGTH_THRESHOLD-abs(len-$len) AS myrank");
        $sphinxClient->SetSortMode(SPH_SORT_EXTENDED, "myrank DESC, @weight DESC, freq DESC");
        $sphinxClient->SetLimits(0, $this->TOP_COUNT);
        $sphinxClient->SetArrayResult(true);

        $res = $sphinxClient->Query($query, $this->getSphinxIndex('fish_suggestions'));

        if (!$res || !isset($res["matches"])) {
            return false;
        }

        // further restrict trigram matches with a sane Levenshtein distance limit
        foreach ($res["matches"] as $match) {
            $suggested = $match["attrs"]["keyword"];

            if (levenshtein($keyword, $suggested) <= $this->LEVENSHTEIN_THRESHOLD) {
                return $suggested;
            }
        }

        return $keyword;
    }

    public function buildSuggestion($query, $words = null) {

        if (null === $words) {
            $words = $this->getLastQueryKeywords();
        }

        if (!count($words)) {
            return false;
        }

        $suggested = array();
        $llimf = 0;
        $i = 0;
        foreach ($words  as $key => $word) {
            if (!$word['docs']) {
                continue;
            }

            $llimf +=$word['docs'];$i++;
        }

        if(($i * $i) > 0) {
            $llimf = $llimf / ($i * $i);
        }

        foreach ($words  as $key => $word) {
            if ($word['docs'] == 0 | $word['docs'] < $llimf) {
                $mis[] = trim($key,'*'); //$word['keyword'];
            }
        }

        if (!isset($mis) || !count($mis)) {
            return false;
        }

        foreach ($mis as $m) {
            $re = $this->getKeywordSuggestion($m);

            if ($re && $m != $re) {
               // if($m!=$re) {
                    $suggested[$m] = $re;
               // }
            }
        }

        if(count($words) == 1 && empty($suggested)) {
            return false;
        }

        $phrase = explode(' ', $query);
        foreach ($phrase as $k => $word) {
            if (isset($suggested[strtolower($word)]))
                $phrase[$k] = $suggested[strtolower($word)];
        }

        $phrase = implode(' ', $phrase);

        return $phrase;
    }
	
	
	private	function dmword($string, $is_cyrillic = true) 	{   

		 $codes = array(
			'A' =>  array(array(0, -1, -1),
				'I' =>  array(array(0, 1, -1)),
				'J' =>  array(array(0, 1, -1)),
				'Y' =>  array(array(0, 1, -1)),
				'U' =>  array(array(0, 7, -1))),
		   
			'B' =>  array(array(7, 7, 7)),
		   
			'C' =>  array(array(5, 5, 5), array(4, 4, 4),
				'Z' =>  array(array(4, 4, 4),
					'S' =>  array(array(4, 4, 4))),
				'S' =>  array(array(4, 4, 4),
					'Z' =>  array(array(4, 4, 4))),
				'K' =>  array(array(5, 5, 5), array(45, 45, 45)),
				'H' =>  array(array(5, 5, 5), array(4, 4, 4),
					'S' =>  array(array(5, 54, 54)))),
				   
			'D' =>  array(array(3, 3, 3),
				'T' =>  array(array(3, 3, 3)),
				'Z' =>  array(array(4, 4, 4),
					'H' =>  array(array(4, 4, 4)),
					'S' =>  array(array(4, 4, 4))),
				'S' =>  array(array(4, 4, 4),
					'H' =>  array(array(4, 4, 4)),
					'Z' =>  array(array(4, 4, 4))),
				'R' =>  array(
					'S' =>  array(array(4, 4, 4)),
					'Z' =>  array(array(4, 4, 4)))),
	 
			'E' =>  array(array(0, -1, -1),
				'I' =>  array(array(0, 1, -1)),
				'J' =>  array(array(0, 1, -1)),
				'Y' =>  array(array(0, 1, -1)),
				'U' =>  array(array(1, 1, -1))),
			   
			'F' =>  array(array(7, 7, 7),
				'B' =>  array(array(7, 7, 7))),
			   
			'G' =>  array(array(5, 5, 5)),
		   
			'H' =>  array(array(5, 5, -1)),
		   
			'I' =>  array(array(0, -1, -1),
				'A' =>  array(array(1, -1, -1)),
				'E' =>  array(array(1, -1, -1)),
				'O' =>  array(array(1, -1, -1)),
				'U' =>  array(array(1, -1, -1))),
			   
			'J' =>  array(array(4, 4, 4)),
		   
			'K' =>  array(array(5, 5, 5),
				'H' =>  array(array(5, 5, 5)),
				'S' =>  array(array(5, 54, 54))),
			   
			'L' =>  array(array(8, 8, 8)),
		   
			'M' =>  array(array(6, 6, 6),
				'N' =>  array(array(66, 66, 66))),
		   
			'N' =>  array(array(6, 6, 6),
				'M' =>  array(array(66, 66, 66))),
		   
			'O' =>  array(array(0, -1, -1),
				'I' =>  array(array(0, 1, -1)),
				'J' =>  array(array(0, 1, -1)),
				'Y' =>  array(array(0, 1, -1))),
			   
			'P' =>  array(array(7, 7, 7),
				'F' =>  array(array(7, 7, 7)),
				'H' =>  array(array(7, 7, 7))),
			   
			'Q' =>  array(array(5, 5, 5)),
		   
			'R' =>  array(array(9, 9, 9),
				'Z' =>  array(array(94, 94, 94), array(94, 94, 94)), // special case
				'S' =>  array(array(94, 94, 94), array(94, 94, 94))), // special case
			   
			'S' =>  array(array(4, 4, 4),
				'Z' =>  array(array(4, 4, 4),
					'T' =>  array(array(2, 43, 43)),
					'C' =>  array(
						'Z' => array(array(2, 4, 4)),
						'S' => array(array(2, 4, 4))),
					'D' =>  array(array(2, 43, 43))),
				'D' =>  array(array(2, 43, 43)),
				'T' =>  array(array(2, 43, 43),
					'R' =>  array(
						'Z' =>  array(array(2, 4, 4)),
						'S' =>  array(array(2, 4, 4))),
					'C' =>  array(
						'H' =>  array(array(2, 4, 4))),
					'S' =>  array(
						'H' =>  array(array(2, 4, 4)),
						'C' =>  array(
							'H' =>  array(array(2, 4, 4))))),
				'C' =>  array(array(2, 4, 4),
					'H' =>  array(array(4, 4, 4),
						'T' => array(array(2, 43, 43),
							'S' => array(
								'C' => array(
									'H' =>  array(array(2, 4, 4))),
								'H' => array(array(2, 4, 4))),
							'C' => array(
								'H' =>  array(array(2, 4, 4)))),
						'D' =>  array(array(2, 43, 43)))),
				'H' =>  array(array(4, 4, 4),
					'T' =>  array(array(2, 43, 43),
						'C' =>  array(
							'H' =>  array(array(2, 4, 4))),
						'S' =>  array(
							'H' =>  array(array(2, 4, 4)))),
					'C' =>  array(
						'H' =>  array(array(2, 4, 4))),
					'D' =>  array(array(2, 43, 43)))),
				   
			'T' =>  array(array(3, 3, 3),
				'C' =>  array(array(4, 4, 4),
					'H' =>  array(array(4, 4, 4))),
				'Z' =>  array(array(4, 4, 4),
					'S' =>  array(array(4, 4, 4))),
				'S' =>  array(array(4, 4, 4),
					'Z' =>  array(array(4, 4, 4)),
					'H' =>  array(array(4, 4, 4)),
					'C' =>  array(
						'H' =>  array(array(4, 4, 4)))),
				'T' =>  array(
					'S' =>  array(array(4, 4, 4),
						'Z' =>  array(array(4, 4, 4)),
						'C' =>  array(
							'H' =>  array(array(4, 4, 4)))),
					'C' =>  array(
						'H' =>  array(array(4, 4, 4))),
					'Z' =>  array(array(4, 4, 4))),
				'H' =>  array(array(3, 3, 3)),
				'R' =>  array(
					'Z' =>  array(array(4, 4, 4)),
					'S' =>  array(array(4, 4, 4)))),
				   
			'U' =>  array(array(0, -1, -1),
				'E' =>  array(array(0, -1, -1)),
				'I' =>  array(array(0, 1, -1)),
				'J' =>  array(array(0, 1, -1)),
				'Y' =>  array(array(0, 1, -1))),
			   
			'V' =>  array(array(7, 7, 7)),
		   
			'W' =>  array(array(7, 7, 7)),
		   
			'X' =>  array(array(5, 54, 54)),
		   
			'Y' =>  array(array(1, -1, -1)),
		   
			'Z' =>  array(array(4, 4, 4),
				'D' =>  array(array(2, 43, 43),
					'Z' =>  array(array(2, 4, 4),
						'H' =>  array(array(2, 4, 4)))),
				'H' =>  array(array(4, 4, 4),
					'D' => array(array(2, 43, 43),
						'Z' =>  array(
							'H' =>  array(array(2, 4, 4))))),
				'S' =>  array(array(4, 4, 4),
					'H' =>  array(array(4, 4, 4)),
					'C' =>  array(
						'H' =>  array(array(4, 4, 4))))));
				   
		$length = strlen($string);
		$output = '';
		$i = 0;
	   
		$previous = -1;
	   
		while ($i < $length)
		{       
			$current = $last = &$codes[$string[$i]];
		   
			for ($j = $k = 1; $k < 7; $k++)
			{           
				if (!isset($string[$i + $k]) ||
					!isset($current[$string[$i + $k]]))
					break;
				   
				$current = &$current[$string[$i + $k]];                     
			   
				if (isset($current[0]))
				{
					$last = &$current;
					$j = $k + 1;
				}
			}
		   
		//	fav
			   
			if (($code != -1) && ($code != $previous))
				$output .= $code;
			   
			$previous = $code;
		   
			$i += $j;
			   
		}

		return str_pad(substr($output, 0, 6), 6, '0');
	}
	 
	//------------------------------------------------------------------------------
	 
	function dmstring($string)
	{
		

		$is_cyrillic = false;
		if (preg_match('/[А-Яа-я]/iu', $string) == 1)
		{
			$string = $this->translit($string);

			$is_cyrillic = true;
		}
	   
		$string = preg_replace(array('/[^\w\s]|\d/iu', '/\b[^\s]{1,3}\b/iu', '/\s{2,}/iu', '/^\s+|\s+$/iu'),
			array('', '', ' '), strtolower($string));
   
		if (!isset($string[0]))
			return null;
		   
		$matches = explode(' ', $string);
		foreach($matches as $key => $match)
			$matches[$key] = $this->dmword($match, $is_cyrillic);         
		return $matches;
	
		
		return $string;
		
	}
 
//------------------------------------------------------------------------------
 
	private function translit($string) {
$replace=array(
"'"=>"",
"`"=>"",
"а"=>"a","А"=>"a",
"б"=>"b","Б"=>"b",
"в"=>"v","В"=>"v",
"г"=>"g","Г"=>"g",
"д"=>"d","Д"=>"d",
"е"=>"e","Е"=>"e",
"ё"=>"e","Ё"=>"e",
"ж"=>"zh","Ж"=>"zh",
"з"=>"z","З"=>"z",
"и"=>"i","И"=>"i",
"й"=>"y","Й"=>"y",
"к"=>"k","К"=>"k",
"л"=>"l","Л"=>"l",
"м"=>"m","М"=>"m",
"н"=>"n","Н"=>"n",
"о"=>"o","О"=>"o",
"п"=>"p","П"=>"p",
"р"=>"r","Р"=>"r",
"с"=>"s","С"=>"s",
"т"=>"t","Т"=>"t",
"у"=>"u","У"=>"u",
"ф"=>"f","Ф"=>"f",
"х"=>"h","Х"=>"h",
"ц"=>"c","Ц"=>"c",
"ч"=>"ch","Ч"=>"ch",
"ш"=>"sh","Ш"=>"sh",
"щ"=>"sch","Щ"=>"sch",
"ъ"=>"","Ъ"=>"",
"ы"=>"y","Ы"=>"y",
"ь"=>"","Ь"=>"",
"э"=>"e","Э"=>"e",
"ю"=>"yu","Ю"=>"yu",
"я"=>"ya","Я"=>"ya",
"і"=>"i","І"=>"i",
"ї"=>"yi","Ї"=>"yi",
"є"=>"e","Є"=>"e"
);
$str=iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
$str = preg_replace ("/[^a-z0-9-]/i"," ",$str);
$str = preg_replace("/ +/", "-", trim($str));
return strtolower($str);
}
}