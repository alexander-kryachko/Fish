<?php
class ModelModuleFilter extends Model {
    public function install() {
        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_attributes_categories` (
                `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
                `field_id` varchar(100) COLLATE utf8_bin NOT NULL,
                `name` varchar(100) COLLATE utf8_bin NOT NULL,
                `sort_order` int(3) NOT NULL,
                PRIMARY KEY (`attribute_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_attributes_categories_value` (
                `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT,
                `attribute_id` int(11) NOT NULL,
                `value` varchar(100) COLLATE utf8_bin NOT NULL,
                `sort_order` int(3) NOT NULL,
                PRIMARY KEY (`attribute_value_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_category_attributes` (
                `category_id` int(11) NOT NULL,
                `attribute_value_id` int(11) NOT NULL,
                `quantity_items` int(11) NOT NULL,
                PRIMARY KEY (`category_id`,`attribute_value_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_product_attributes_categories` (
                `product_id` int(11) NOT NULL,
                `attribute_id` int(11) NOT NULL,
                `attribute_value_id` int(11) NOT NULL
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        /*******************************************************************************/

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_attributes_manufacturers` (
                `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
                `field_id` varchar(100) COLLATE utf8_bin NOT NULL,
                `name` varchar(100) COLLATE utf8_bin NOT NULL,
                `sort_order` int(3) NOT NULL,
                PRIMARY KEY (`attribute_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_attributes_manufacturers_value` (
                `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT,
                `attribute_id` int(11) NOT NULL,
                `value` varchar(100) COLLATE utf8_bin NOT NULL,
                `sort_order` int(3) NOT NULL,
                PRIMARY KEY (`attribute_value_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_manufacturer_attributes` (
                `manufacturer_id` int(11) NOT NULL,
                `attribute_value_id` int(11) NOT NULL,
                `quantity_items` int(11) NOT NULL,
                PRIMARY KEY (`manufacturer_id`,`attribute_value_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");

        $this->db->query("
            CREATE TABLE `" . DB_PREFIX . "filter_product_attributes_manufacturers` (
                `product_id` int(11) NOT NULL,
                `attribute_id` int(11) NOT NULL,
                `attribute_value_id` int(11) NOT NULL
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
        ");
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "filter_attributes_categories, " . DB_PREFIX . "filter_attributes_categories_value, " . DB_PREFIX . "filter_category_attributes, " . DB_PREFIX . "filter_product_attributes_categories, " . DB_PREFIX . "filter_attributes_manufacturers, " . DB_PREFIX . "filter_attributes_manufacturers_value, " . DB_PREFIX . "filter_manufacturer_attributes, " . DB_PREFIX . "filter_product_attributes_manufacturers");
    }

    public function clearDB() {
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_attributes_categories");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_attributes_categories_value");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_attributes_manufacturers");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_attributes_manufacturers_value");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_category_attributes");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_manufacturer_attributes");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_product_attributes_categories");
        $this->db->query("DELETE FROM " . DB_PREFIX . "filter_product_attributes_manufacturers");

        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_attributes_categories AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_attributes_categories_value AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_attributes_manufacturers AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_attributes_manufacturers_value AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_category_attributes AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_manufacturer_attributes AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_product_attributes_categories AUTO_INCREMENT = 0");
        $this->db->query("ALTER TABLE " . DB_PREFIX . "filter_product_attributes_manufacturers AUTO_INCREMENT = 0");
    }

    public function getAttributesCategories() {
        $query = $this->db->query("SELECT pa.attribute_id, ad.name FROM " . DB_PREFIX . "product_attribute as pa LEFT JOIN " . DB_PREFIX . "attribute_description as ad ON pa.attribute_id = ad.attribute_id LEFT JOIN " . DB_PREFIX . "product as p ON pa.product_id = p.product_id LEFT JOIN " . DB_PREFIX . "product_to_category as p2c ON p.product_id = p2c.product_id LEFT JOIN " . DB_PREFIX . "category as c ON p2c.category_id = c.category_id WHERE c.status = 1 AND p.status = 1 AND ad.language_id = 1 GROUP BY pa.attribute_id ORDER BY ad.name");

        return $query->rows;
    }

    public function getAttributesManufacturers() {
        $query = $this->db->query("SELECT pa.attribute_id, ad.name FROM " . DB_PREFIX . "product_attribute as pa LEFT JOIN " . DB_PREFIX . "attribute_description as ad ON pa.attribute_id = ad.attribute_id LEFT JOIN " . DB_PREFIX . "product as p ON pa.product_id = p.product_id WHERE p.status = 1 AND p.manufacturer_id != 0 AND ad.language_id = 1 GROUP BY pa.attribute_id ORDER BY ad.name");

        return $query->rows;
    }

    public function getManufactutersList() {
        $query = $this->db->query("SELECT name as value, manufacturer_id FROM " . DB_PREFIX . "manufacturer ORDER BY name");

        return $query->rows;
    }

    public function getAttributeValues($attribute_id) {
        $query = $this->db->query("SELECT DISTINCT text as value FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . $attribute_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY text");

        return $query->rows;
    }

    public function getProductsIDByPrice($start, $end) {
        $query = $this->db->query("SELECT DISTINCT p.product_id FROM " . DB_PREFIX . "product as p LEFT JOIN " . DB_PREFIX . "product_special as ps ON p.product_id = ps.product_id LEFT JOIN " . DB_PREFIX . "product_to_store as p2s ON p.product_id = p2s.product_id WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ((p.price >= '" . (int)$start . "' AND p.price < '" . (int)$end . "') OR ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())  AND (ps.price >= '" . (int)$start . "' AND ps.price < '" . (int)$end . "')))");

        $products_id = array();
        foreach ($query->rows as $product) {
            $products_id[] = $product['product_id'];
        }

        return $products_id;
    }

    public function getProductsIDByManufactuters($manufacturer_id) {
        $query = $this->db->query("SELECT DISTINCT p.product_id FROM " . DB_PREFIX . "product as p LEFT JOIN " . DB_PREFIX . "product_to_store as p2s ON p.product_id = p2s.product_id WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p.manufacturer_id = '" . (int)$manufacturer_id . "'");

        $products_id = array();
        foreach ($query->rows as $product) {
            $products_id[] = $product['product_id'];
        }

        return $products_id;
    }

    public function getProductsIDByAttribute($attribute_id, $value) {
        $query = $this->db->query("SELECT DISTINCT p.product_id FROM " . DB_PREFIX . "product_attribute as pa LEFT JOIN " . DB_PREFIX . "product as p ON pa.product_id = p.product_id LEFT JOIN " . DB_PREFIX . "product_to_store as p2s ON p.product_id = p2s.product_id WHERE pa.attribute_id = '" . (int)$attribute_id . "' AND pa.text = '" . $this->db->escape($value) . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

        $products_id = array();
        foreach ($query->rows as $product) {
            $products_id[] = $product['product_id'];
        }

        return $products_id;
    }

    public function getCategoriesIDByProducts($products_id) {
        $query = $this->db->query("SELECT DISTINCT(p2c.category_id) FROM " . DB_PREFIX . "product_to_category as p2c LEFT JOIN " . DB_PREFIX . "category as c ON p2c.category_id = c.category_id WHERE p2c.product_id IN (" . implode(',', $products_id) . ") AND c.status = 1");

        $categories_id = array();
        foreach ($query->rows as $category) {
            $categories_id[] = $category['category_id'];
        }

        return $categories_id;
    }

    public function getManufacturersIDByProducts($products_id) {
        $query = $this->db->query("SELECT DISTINCT(manufacturer_id) FROM " . DB_PREFIX . "product WHERE product_id IN (" . implode(',', $products_id) . ")");

        $manufacturers_id = array();
        foreach ($query->rows as $manufacturer) {
            $manufacturers_id[] = $manufacturer['manufacturer_id'];
        }

        return $manufacturers_id;
    }

    public function getTotalProductsOnCategory($category_id, $products_id) {
        $query = $this->db->query("SELECT COUNT(DISTINCT product_id) AS total FROM " . DB_PREFIX . "product_to_category WHERE product_id IN (" . implode(',', $products_id) . ") AND category_id = '" . (int)$category_id . "'");

        return $query->row['total'];
    }

    public function getTotalProductsOnManufacturer($manufacturer_id, $products_id) {
        $query = $this->db->query("SELECT COUNT(DISTINCT product_id) AS total FROM " . DB_PREFIX . "product WHERE product_id IN (" . implode(',', $products_id) . ") AND manufacturer_id = '" . (int)$manufacturer_id . "'");

        return $query->row['total'];
    }

    public function getAttributeName($attribute_id) {
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "attribute_description WHERE `attribute_id` = '" . (int)$attribute_id . "' AND `language_id` = '1'");

        return isset($query->row['name']) ? $query->row['name'] : '';
    }

    public function addAttributeCategories($attribute) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_attributes_categories SET `field_id` = '" . $this->db->escape($attribute['attribute_id']) . "', `name` = '" . $this->db->escape($attribute['name']) . "', `sort_order` = '" . (int)$attribute['sort_order'] . "'");

        return $this->db->getLastId();
    }

    public function addAttributeManufacturers($attribute) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_attributes_manufacturers SET `field_id` = '" . $this->db->escape($attribute['attribute_id']) . "', `name` = '" . $this->db->escape($attribute['name']) . "', `sort_order` = '" . (int)$attribute['sort_order'] . "'");

        return $this->db->getLastId();
    }

    public function addAttributeCategoriesValue($attribute_id, $attribute_value) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_attributes_categories_value SET attribute_id = '" . $this->db->escape($attribute_id) . "', `value` = '" . $this->db->escape($attribute_value) . "'");

        return  $this->db->getLastId();
    }

    public function addAttributeManufacturersValue($attribute_id, $attribute_value) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_attributes_manufacturers_value SET attribute_id = '" . $this->db->escape($attribute_id) . "', `value` = '" . $this->db->escape($attribute_value) . "'");

        return  $this->db->getLastId();
    }

    public function addCategoryAttribute($category_id, $attribute_value_id, $quantity_items) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_category_attributes SET category_id = '" . (int)$category_id . "', attribute_value_id = '" . (int)$attribute_value_id . "', quantity_items = '" . (int)$quantity_items . "'");
    }

    public function addManufacturerAttribute($manufacturer_id, $attribute_value_id, $quantity_items) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_manufacturer_attributes SET manufacturer_id = '" . (int)$manufacturer_id . "', attribute_value_id = '" . (int)$attribute_value_id . "', quantity_items = '" . (int)$quantity_items . "'");
    }

    public function addProductAttributeCategory($product_id, $attribute_id, $attribute_value_id) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_product_attributes_categories SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$attribute_id . "', attribute_value_id = '" . (int)$attribute_value_id . "'");
    }

    public function addProductAttributeManufacturer($product_id, $attribute_id, $attribute_value_id) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "filter_product_attributes_manufacturers SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$attribute_id . "', attribute_value_id = '" . (int)$attribute_value_id . "'");
    }
}
?>
