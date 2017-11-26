<?php

class ModelTotalPayComission extends Model {

  public function getTotal(&$total_data, &$total, &$taxes) {
    if (isset($this->session->data['payment_method'])) {
      $this->load->language('total/pay_comission');

      $payment_method = $this->session->data['payment_method'];
      $payment_val    = $this->config->get('pay_comission_payment');

      $payment_percent = (float)$this->cart->getSubTotal() * (float)$payment_val[$payment_method['code']] / 100;

      $total_data[] = array(
          'code'       => 'pay_comission',
          'title'      => $this->language->get('text_pay_comission'),
          'value'      => $payment_percent,
          'sort_order' => $this->config->get('pay_comission_sort_order'),
      );

      if ($this->config->get('pay_comission_tax_class_id')) {
        $tax_rates = $this->tax->getRates($payment_percent, $this->config->get('pay_comission_tax_class_id'));

        foreach ($tax_rates as $tax_rate) {
          if (!isset($taxes[$tax_rate['tax_rate_id']])) {
            $taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
          } else {
            $taxes[$tax_rate['tax_rate_id']] += $tax_rate['amount'];
          }
        }
      }

      $total += $payment_percent;
    }
  }
}