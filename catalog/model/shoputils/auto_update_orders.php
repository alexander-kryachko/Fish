<?php
/*
 * Shoputils
 *
 * ���������� � ������������� ����������
 *
 * ���� ���� ������ ������������ �����������, ������� ����� ����� � ������,
 * ������ � ���� ������. ���� �������� ����������: LICENSE.1.5.x.RUS.txt
 * ��� �� ������������ ���������� ����� ����� �� ������:
 * http://opencart.shoputils.ru/LICENSE.1.5.x.RUS.txt
 * 
 * =================================================================
 * OPENCART 1.5.x ���������� �� �������������
 * =================================================================
 *  ���� ���� ������������ ��� Opencart 1.5.x. Shoputils ��
 *  ����������� ���������� ������ ����� ���������� �� ����� ������ 
 *  ������ Opencart, ����� Opencart 1.5.x. 
 *  Shoputils �� ������������ ����������� ����������� ��� ������ 
 *  ������ Opencart.
 * =================================================================
*/

class ModelShoputilsAutoUpdateOrders extends Model {    
    public function autoUpdateOrders() {
        $status = $this->config->get('shoputils_auto_update_orders_status');
        $old_order_status_ids = explode(',', $this->config->get('shoputils_auto_update_orders_old_order_status_ids'));
        $new_order_status_id = $this->config->get('shoputils_auto_update_orders_new_order_status');
        $days = $this->config->get('shoputils_auto_update_orders_days');
        
        if ($old_order_status_ids && $status) {
              $this->updateOrders($old_order_status_ids, $new_order_status_id, $days);
        }
    }

    // 'array('������ order_status_id'), '����� order_status_id', �-�� ���� � ������� ������, array('������ �� shipping_code ������� ����� ��������� ��� ����� ������� �������');
    public function updateOrders($old_order_status_ids, $new_order_status_id, $days, $shipping_codes = false) {
        $time = time() - $days * 24 * 60 * 60;
        $cache = $this->cache->get('shoputils_auto_update_orders');
        if ($cache && (((int)$cache['time'] + (24 * 60 * 60)) >= time())) return;  //24 * 60 * 60 = 1 day
        //if ($time < 0) $time = 0;
        $this->cache->set('shoputils_auto_update_orders', array('time' => time()));
        $date = date('Y-m-d H:i:s', $time);

//        $sql = "SELECT order_id, language_id, order_status_id FROM `" . DB_PREFIX . "order` WHERE order_status_id IN ('" . implode("', '", $old_order_status_ids) . "') AND (date_added <= '" . $date . "' OR date_modified <= '" . $date . "')";
$sql = "SELECT order_id, language_id, order_status_id FROM `" . DB_PREFIX . "order` WHERE order_status_id IN ('" . implode("', '", $old_order_status_ids) . "') AND (date_modified <= '" . $date . "')";
        if ($shipping_codes && is_array($shipping_codes)) {
            $sql .= " AND shipping_code IN ('" . implode("', '", $shipping_codes) . "')";
        }
        $orders_query = $this->db->query($sql);
        if ($orders_query->num_rows) {
            $this->load->language('shoputils/auto_update_orders');
            $this->load->model('checkout/order');
            //$this->cache->delete('shoputils_auto_update_orders');

            foreach ($orders_query->rows as $order_info) {
                $new_order_status = $this->getOrderStatusById((int)$new_order_status_id, (int)$order_info['language_id']);
                $comment = sprintf($this->language->get('text_comment'), (int)$order_info['order_id'], $new_order_status, $days);
                //���� $order_info['order_status_id'] == 0 (���������� �����) - ������� ������ �������������� sql-�������� ����� �����,
                //����� ����� $this->model_checkout_order->update() �� ��������� ����� � ����� ������ (����������� 1.5.x)
                if (!$order_info['order_status_id']) {
                    $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$new_order_status_id . "' WHERE order_id = '" . (int)$order_info['order_id'] . "'");
                }
                $this->model_checkout_order->update($order_info['order_id'], $new_order_status_id, $comment, true);
            }
        }
    }

    public function getOrderStatusById($order_status_id, $language_id = false) {
        if (!$language_id) {
            $language_id = (int)$this->config->get('config_language_id');
        }
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . $language_id . "'");
        return $query->num_rows ? $query->row['name'] : '';
    }
}
?>