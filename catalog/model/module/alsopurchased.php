<?php

class ModelModuleAlsopurchased extends Model
{
    public function getPurchasedProductsPerProductId( $product_id, $limit )
    {
        if ( $this->customer->isLogged() )
        {
            $customer_group_id = $this->customer->getCustomerGroupId();
        }
        else
        {
            $customer_group_id = $this->config->get( 'config_customer_group_id' );
        }

        $product_data = $this->cache->get( 'product.alsopurchased.' . ( int )$this->
            config->get( 'config_language_id' ) . '.' . ( int )$this->config->get( 'config_store_id' ) .
            '.' . $customer_group_id . '.' . ( int )$limit . '.' . ( int )$product_id );

        if ( !$product_data )
        {
            $product_data = array();

            $sql = "SELECT order_id FROM " . DB_PREFIX .
                "order_product WHERE product_id = '" . ( int )$product_id . "'";
            $query = $this->db->query( $sql );

            $order_id = array();
            foreach ( $query->rows as $result )
            {
                $order_id[] = $result['order_id'];
            }
            
            $orders_id = implode( ',', $order_id );
            if ( !$orders_id )
            {
                $orders_id = 0;
            }

            $sql = "SELECT op.product_id, COUNT(*) AS total FROM " .
                DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX .
                "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX .
                "product` p ON (op.product_id = p.product_id)";

            $sql .= " LEFT JOIN " . DB_PREFIX .
                "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1'";

            $sql .= " AND p.date_available <= NOW() AND op.order_id IN (" . $orders_id .
                ") AND op.product_id != '" . ( int )$product_id . "'";

            $sql .= " AND p2s.store_id = '" . ( int )$this->config->get( 'config_store_id' ) .
                "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . ( int )$limit;

            $query = $this->db->query( $sql );

            $this->load->model( 'catalog/product' );

            foreach ( $query->rows as $result )
            {
                $product_data[$result['product_id']] = $this->model_catalog_product->getProduct( $result['product_id'] );
            }

            $this->cache->set( 'product.alsopurchased.' . ( int )$this->config->get( 'config_language_id' ) .
                '.' . ( int )$this->config->get( 'config_store_id' ) . '.' . $customer_group_id .
                '.' . ( int )$limit . '.' . ( int )$product_id, $product_data );
        }
        return $product_data;
    }
}