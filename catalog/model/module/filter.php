<?php
class ModelModuleFilter extends Model {
    private $filter_setting;

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function getManufacturerAttributesValues($manufacturer_id) {
        $array = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_manufacturer_attributes WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

        foreach ($query->rows as $row) {
            $array[$row['attribute_value_id']] = array(
                'id'                => $row['attribute_value_id'],
                'quantity_items'    => $row['quantity_items']
            );
        }

        return $array;
    }

    public function getCategoryAttributesValues($category_id) {
        $array = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_category_attributes WHERE category_id = '" . (int)$category_id . "'");

        foreach ($query->rows as $row) {
            $array[$row['attribute_value_id']] = array(
                'id'                => $row['attribute_value_id'],
                'quantity_items'    => $row['quantity_items']
            );
        }

        return $array;
    }

    public function getAttributesManufacturer($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT DISTINCT(attribute_id) FROM " . DB_PREFIX . "filter_attributes_manufacturers_value WHERE attribute_value_id IN (" . implode(',', array_keys($data)) . ")");

            foreach ($query->rows as $row) {
                $array[] = $row['attribute_id'];
            }
        }

        return $array;
    }

    public function getAttributesCategory($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT DISTINCT(attribute_id) FROM " . DB_PREFIX . "filter_attributes_categories_value WHERE attribute_value_id IN (" . implode(',', array_keys($data)) . ")");

            foreach ($query->rows as $row) {
                $array[] = $row['attribute_id'];
            }
        }

        return $array;
    }

    public function getAttributesValueByManufacturer($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT attribute_id, attribute_value_id, value FROM " . DB_PREFIX . "filter_attributes_manufacturers_value WHERE attribute_value_id IN (" . implode(',', array_keys($data)) . ")");

            foreach ($query->rows as $row) {
                $array[$row['attribute_id']][$row['attribute_value_id']] = array(
                    'attribute_value_id'    =>  $row['attribute_value_id'],
                    'value'                 =>  $row['value'],
                    'quantity_items'        =>  $data[$row['attribute_value_id']]['quantity_items']
                );
            }
        }

        return $array;
    }

    public function getAttributesValueByCategory($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT attribute_id, attribute_value_id, value FROM " . DB_PREFIX . "filter_attributes_categories_value WHERE attribute_value_id IN (" . implode(',', array_keys($data)) . ")");

            foreach ($query->rows as $row) {
                $array[$row['attribute_id']][$row['attribute_value_id']] = array(
                    'attribute_value_id'    =>  $row['attribute_value_id'],
                    'value'                 =>  $row['value'],
                    'quantity_items'        =>  $data[$row['attribute_value_id']]['quantity_items']
                );
            }
        }

        return $array;
    }

    public function getAttributesNameFromManufacturersByID($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_attributes_manufacturers WHERE attribute_id IN (" . implode(',', $data) . ") ORDER BY  sort_order ASC");

            foreach ($query->rows as $row) {
                $array[$row['attribute_id']] = $row['name'];
            }
        }

        return $array;
    }

    public function getAttributesNameFromCategoriesByID($data) {
        $array = array();

        if (!empty($data)) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "filter_attributes_categories WHERE attribute_id IN (" . implode(',', $data) . ") ORDER BY  sort_order ASC");

            foreach ($query->rows as $row) {
                $array[$row['attribute_id']] = $row['name'];
            }
        }

        return $array;
    }

    public function getProductsIDFromCategory($filter, $category_id) {
        $products_id = '';

        $tmp_1          = array();
        $tmp_1          = explode(",", $filter);
        $filter         = array();
        $attributes     = array();

        foreach ($tmp_1 as $value) {
            $tmp_2 = explode(":", $value);
            if (isset($tmp_2[0]) && isset($tmp_2[1]) && $tmp_2[0] && $tmp_2[1]) {
                $attributes[$tmp_2[0]]  = $tmp_2[0];
                $filter[]       = $tmp_2[1];
            }
        }

        $filterTypeQty = count($attributes);
        $filter = implode(",", $filter);

        $product_query = "SELECT p.product_id FROM " . DB_PREFIX . "product AS p, " . DB_PREFIX . "product_to_category AS p2c";

        if ($filterTypeQty > 0) {
            $product_query .= ", " . DB_PREFIX . "filter_product_attributes_categories AS fpac";
        }

        $product_query .= " WHERE p.product_id = p2c.product_id AND p2c.category_id = '" . $category_id . "'";

        if ($filterTypeQty > 0) {
            $product_query .= " AND attribute_value_id IN (" . $filter . ") AND fpac.product_id = p.product_id GROUP BY fpac.product_id HAVING COUNT(fpac.product_id) >= " . $filterTypeQty;
        }

        $query = $this->db->query($product_query);

        foreach ($query->rows as $row) {
            $products_id[] = $row['product_id'];
        }

        if ($products_id) {
            $products_id = implode(',', $products_id);
        } else {
            $products_id = false;
        }

        return $products_id;
    }
}
