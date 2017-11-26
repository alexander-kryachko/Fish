<?php
class ModelModuleCustomSorting extends Model {
    public function editProductSorting($data){
        if(is_array($data)){
            foreach($data as $res){
                $this->db->query("UPDATE " . DB_PREFIX . "product SET sort_order = '" .$res['order'] . "' WHERE product_id = '".$res['product_id']."'");
            }
        }
    }
}