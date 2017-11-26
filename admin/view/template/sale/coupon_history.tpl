<table class="list">
  <thead>
    <tr>
	  <td></td>
      <td class="right"><b><?php echo $column_order_id; ?></b></td>
      <td class="right"><b><?php echo $column_order_total; ?></b></td>
      <td class="left"><b><?php echo $column_order_status; ?></b></td>
      <td class="left"><b><?php echo $column_customer; ?></b></td>
      <td class="right"><b><?php echo $column_amount; ?></b></td>
      <td class="left"><b><?php echo $column_date_added; ?></b></td>
    </tr>
  </thead>
  <tbody>
    <?php if ($histories) { ?>
    <?php foreach ($histories as $history) { ?>
    <tr>
	  <td class="center"><a title="Удалить заказ из купона" onclick="deleteOrderFromCoupon(<?=$history['order_id']?>);" class="redcross">X</a></td>
      <td class="right"><a href="<?php echo $history['order_url']; ?>"><?php echo $history['order_id']; ?></a></td>
      <td class="right"><?php echo $history['order_total']; ?></td>
      <td class="left"><?php echo $history['order_status']; ?></td>
      <td class="left"><?php echo $history['customer']; ?></td>
      <td class="right"><?php echo $history['amount']; ?></td>
      <td class="left"><?php echo $history['date_added']; ?></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<p>
Добавить заказ № <input type="text" name="addOrderToCoupon" id="addOrderToCoupon" size="6" value="" /> <a class="button" onclick="addOrderToCoupon();">Добавить</a>
</p>

<div class="pagination"><?php echo $pagination; ?></div>
