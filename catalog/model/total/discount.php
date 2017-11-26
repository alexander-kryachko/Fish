<?php

class ModelTotalDiscount extends Model
{

    public function getTotal(&$total_data, &$total, &$taxes)
    {
        if ($this->config->get('discount_status'))
        {
            $this->load->language('total/discount');

            $discount_programm = $this->config->get('discount_incentive_program');
            $discount_value = $this->config->get('discount_value');
            $discount_to = $this->config->get('discount_to_summ');
            $discount_from = $this->config->get('discount_from_summ');
            $discount_type = $this->config->get('discount_type');

            $len = count($discount_value);

            $discounts=array();
            for ($i = 0; $i < $len; $i++)
            {

                if ($discount_programm[$i] == 'accumulation')
                {
                    $t = $this->getSummAllCompletedOrders();
                    $title_format = $this->language->get('heading_title_incentive_program_accamulation');
                } else if ($discount_programm[$i] == 'summ_current_order')
                {
                     if ($this->config->get('discount_exclude_ids') || $this->config->get('discount_promotional_items'))
                        $t = $this->getMyTotal();
                    else
                        $t = $total['total'];
                    
                    $title_format = $this->language->get('heading_title_incentive_program_summ_current_order');
                } else
                    continue;

                if ($discount_from[$i] <= $t && $t < $discount_to[$i])
                {
					if(isset($_SESSION['coupon']))
						$_SESSION['coupon']='';
				
                    if ($discount_type[$i] == 'precent')
                    {
                        $value = ($t / 100) * $discount_value[$i];
                        $discount_val = $discount_value[$i] . "%";
                    } else if ($discount_type[$i] == 'fixed_summ')
                    {
                        $value = $discount_value[$i];
                        $discount_val = $this->currency->format($discount_value[$i]);
                    } else
                        continue;


                    $discount_from_currency = $this->currency->format($discount_from[$i], $this->session->data['currency']);


                    $discounts[] = array(
                        'code' => 'discount',
                        'title' => sprintf($title_format, $discount_from_currency, $discount_val),
                        'text' => $this->currency->format($value),
                        'value' => $value,
                        'sort_order' => $this->config->get('discount_sort_order')
                    );

                    $total -= $value;
                }
            }
            
            if (count($discounts))
            {
                if (count($discounts) == 1)
                    $discount = $discounts[0];
                else
                    $discount = $this->getMaxDiscount($discounts);

                $total['total'] -= $discount['value'];
                $total_data[] = $discount;
            }
        }
    }

    private function getMaxDiscount($discounts)
    {
        $i_max_discount = 0;
        $max_discount = 0;

        for ($i = 0; $i < count($discounts); $i++)
        {
            if ($discounts[$i]['value'] > $max_discount)
            {
                $max_discount = $discounts[$i]['value'];
                $i_max_discount = $i;
            }
        }

        return $discounts[$i_max_discount];
    }

    private function getMyTotal()
    {
        $prods = $this->cart->getProducts();
        $total = 0;

        if ($this->config->get('discount_exclude_ids'))
            $exclude_ids = explode(',', $this->config->get('discount_exclude_ids'));

        if ($this->config->get('discount_promotional_items'))
            $this->load->model('catalog/product');
			$this->load->model('checkout/coupon');
        foreach ($prods as $p)
        {
            $exclude1 = false;
            $exclude2 = false;

            if ($this->config->get('discount_exclude_ids'))
                if (array_search($p['product_id'], $exclude_ids) !== FALSE)
                    $exclude1 = true;

            if ($this->config->get('discount_promotional_items'))
            {
                $prod = $this->model_catalog_product->getProduct($p['product_id']);
                if ($prod['special'])
                    $exclude2 = true;
            }
            
            if($exclude2==false && $exclude1==false)
                $total+=$p['total'];
        }
        return $total;
    }

    private function getSummAllCompletedOrders()
    {
        $this->load->model('account/order');
        $sum = 0;

        $completes = $this->config->get('config_complete_status');
        $orders = $this->model_account_order->getOrders();

        foreach ($orders as $order)
        {
            $order_details = $this->model_account_order->getOrder($order['order_id']);
            if (array_search($order_details['order_status_id'], $completes) !== FALSE)
                $sum += $order_details['total'];
        }

        return $sum;
    }

}
