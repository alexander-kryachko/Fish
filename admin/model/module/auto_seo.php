<?php
class ModelModuleAutoSEO extends Model {
    public function generateCategories () {
        $categories = $this->getCategories();
        $slugs = array();
        foreach ($categories as $category) {
            $slug = $uniqueSlug = $this->makeSlugs($category['name']);
            $index = 1;
            while (in_array($uniqueSlug, $slugs)) {
                $uniqueSlug = $slug . '-' . $index ++;
            }
            $slugs[] = $uniqueSlug;
            $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int) $category['category_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int) $category['category_id'] . "', keyword = '" . $this->db->escape($uniqueSlug) . "'");
        }
    }
    public function generateProducts ($appendModel) {
        $products = $this->getProducts();
        $slugs = array();
        foreach ($products as $product) {
            $slug = $uniqueSlug = $this->makeSlugs($product['name'] . ($appendModel ? '-' . $product['model'] : ''));
            $index = 1;
            while (in_array($uniqueSlug, $slugs)) {
                $uniqueSlug = $slug . '-' . $index ++;
            }
            $slugs[] = $uniqueSlug;
            $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product['product_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product['product_id'] . "', keyword = '" . $this->db->escape($uniqueSlug) .$w_page_ext = ".php" ."'"  );
        }
    }
    private function getCategories () {
        $query = $this->db->query("SELECT c.category_id, cd.name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE cd.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
        return $query->rows;
    }
    private function getProducts () {
        $query = $this->db->query("SELECT p.product_id, pd.name, p.model FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY pd.name ASC");
        return $query->rows;
    }
    // Taken from http://code.google.com/p/php-slugs/
    private function my_str_split ($string) {
        $slen = strlen($string);
        for ($i = 0; $i < $slen; $i ++) {
            $sArray[$i] = $string{$i};
        }
        return $sArray;
    }
    private function noDiacritics ($string) {
        //cyrylic transcription
        $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $cyrylicTo = array('A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Tsh', '', 'Y', '', 'E', 'yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'tsh', '', 'y', '', 'e', 'yu', 'ya');
        $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
        $to = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");
        $from = array_merge($from, $cyrylicFrom);
        $to = array_merge($to, $cyrylicTo);
        $newstring = str_replace($from, $to, html_entity_decode($string, ENT_QUOTES, "UTF-8"));
        return $newstring;
    }
    private function makeSlugs ($string, $maxlen = 0) {
        $newStringTab = array();
        $string = strtolower($this->noDiacritics($string));
        if (function_exists('str_split')) {
            $stringTab = str_split($string);
        } else {
            $stringTab = $this->my_str_split($string);
        }
        $numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-");
        foreach ($stringTab as $letter) {
            if (in_array($letter, range("a", "z")) || in_array($letter, $numbers)) {
                $newStringTab[] = $letter;
            } elseif ($letter == " ") {
                $newStringTab[] = "-";
            }
        }
        if (count($newStringTab)) {
            $newString = implode($newStringTab);
            if ($maxlen > 0) {
                $newString = substr($newString, 0, $maxlen);
            }
            $newString = $this->removeDuplicates('--', '-', $newString);
        } else {
            $newString = '';
        }
        return $newString;
    }
    private function removeDuplicates ($sSearch, $sReplace, $sSubject) {
        $i = 0;
        do {
            $sSubject = str_replace($sSearch, $sReplace, $sSubject);
            $pos = strpos($sSubject, $sSearch);
            $i ++;
            if ($i > 100) {
                die('removeDuplicates() loop error');
            }
        } while ($pos !== false);
        return $sSubject;
    }
}