<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>" xml:lang="<?php echo $language; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/invoice.css" />
<!-------- begin ----------->
<style media='print' type='text/css'>
.noprint {display: none;}
body {background:#FFF; color:#000;}
}
</style>
<!-------- end ----------->
</head>
<body>
<!-------- begin ----------->
<span class="noprint">
<a href='javascript:window.print(); void 0;'>Распечататьььь</a>
<br><br>
</span>
<!-------- end ----------->
<?php foreach ($orders as $order) { ?>
<div style="page-break-after: always;">

  <table class="address">
    <tr>
      <td>
		<br><br>	
			<b>Заказ №: <?php echo $order['order_id']; ?></b></br>
			<br>
			ФИО:     <?php echo $order['firstname']; ?> <?php echo $order['lastname']; ?> <br />	
			Тел:     <?php echo $order['telephone']; ?><br />
			<br>
			Город:   <?php echo $order['payment_city']; ?><br />
			Склад:   <?php echo $order['payment_address_1']; ?><br />
			<br>
			Оплата:  <?php echo $order['payment_method']; ?><br />
			<br><br>
			<b>Состав посылки:</b>
       <table class="product">
    <tr class="heading">
<!--	<td><b><?php echo $column_model; ?></b></td> -->
      <td><b><?php echo $column_product; ?></b></td>
<!--	  <td><b><?php echo $column_sku; ?></b></td> -->
      <td><b><?php echo "Кол-во"; ?></b></td>    <!--в этой строке---->
      <td><b><?php echo "Цена"; ?></b></td>  <!--в этой строке---->
<!--      <td align="right"><b><?php echo "Всего"; ?></b></td> -->    <!--в этой строке---->
    </tr>
    <?php foreach ($order['product'] as $product) { ?>
    <tr>
<!--	<td><?php echo $product['model']; ?></td> -->
      <td><?php echo $product['name']; ?>
        <?php foreach ($product['option'] as $option) { ?>
        <br />
        &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
        <?php } ?></td>
<!--	  <td><?php echo $product['sku']; ?></td> -->
      <td><?php echo $product['quantity']; ?>шт</td>
      <td><?php echo $product['price']; ?></td>
<!--      <td align="right"><?php echo $product['total']; ?></td> -->
    </tr>
    <?php } ?>
    <?php foreach ($order['voucher'] as $voucher) { ?>
    <tr>
      <td align="left"><?php echo $voucher['description']; ?></td>
      <td align="left"></td>
      <td>1</td>
      <td><?php echo $voucher['amount']; ?></td>
      <td><?php echo $voucher['amount']; ?></td>
    </tr>
    <?php } ?>
    <?php foreach ($order['total'] as $total) { ?>
    <tr>
      <td align="right" colspan="2"><b><?php echo $total['title']; ?>:</b></td>
      <td align="right"><?php echo $total['text']; ?></td>
    </tr>
    <?php } ?>
	<br><br>
  </table>
  <br><br>
  Выдана карта №_______________________
	   </td>
      <td>
	  <br><br>
			<b>Заказ № <?php echo $order['order_id']; ?></b></br>
			<br>
			ФИО:     <?php echo $order['firstname']; ?> <?php echo $order['lastname']; ?> <br />	
			Тел:     <?php echo $order['telephone']; ?><br />
			<br>
			Город:   <?php echo $order['payment_city']; ?><br />
			Склад:   <?php echo $order['payment_address_1']; ?><br />
			<br>
			Оплата:  <?php echo $order['payment_method']; ?><br />
			<br><br>
			Сумма посылки: <b><?php echo $total['text']; ?></b>
			<br><br>
     
	   </td>
    </tr>
  </table>
  <table class="product">
    <tr class="heading">
	<td><b><?php echo $column_model; ?></b></td>
      <td><b><?php echo $column_product; ?></b></td>
	  <td><b><?php echo $column_sku; ?></b></td>
      <td align="right"><b><?php echo "Кол-во"; ?></b></td>    <!--в этой строке---->
      <td align="right"><b><?php echo "Цена"; ?></b></td>  <!--в этой строке---->
      <td align="right"><b><?php echo "Всего"; ?></b></td>     <!--в этой строке---->
    </tr>
    <?php foreach ($order['product'] as $product) { ?>
    <tr>
	<td><?php echo $product['model']; ?></td>
      <td><?php echo $product['name']; ?>
        <?php foreach ($product['option'] as $option) { ?>
        <br />
        &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
        <?php } ?></td>
	  <td><?php echo $product['sku']; ?></td>
      <td align="right"><?php echo $product['quantity']; ?>шт</td>
      <td align="right"><?php echo $product['price']; ?></td>
      <td align="right"><?php echo $product['total']; ?></td>
    </tr>
    <?php } ?>
    <?php foreach ($order['voucher'] as $voucher) { ?>
    <tr>
      <td align="left"><?php echo $voucher['description']; ?></td>
      <td align="left"></td>
      <td align="right">1</td>
      <td align="right"><?php echo $voucher['amount']; ?></td>
      <td align="right"><?php echo $voucher['amount']; ?></td>
    </tr>
    <?php } ?>
    <?php foreach ($order['total'] as $total) { ?>
    <tr>
      <td align="right" colspan="4"><b><?php echo $total['title']; ?>:</b></td>
      <td align="right"><?php echo $total['text']; ?></td>
    </tr>
    <?php } ?>
  </table>
  <?php if ($order['comment']) { ?>
  <table class="comment">
    <tr class="heading">
      <td><b><?php echo $column_comment; ?></b></td>
    </tr>
    <tr>
      <td><?php echo $order['comment']; ?></td>
    </tr>
  </table>
  <?php } ?>

  <!-------- begin ----------->
   <br/><br/><br/><b> &nbsp;&nbsp;&nbsp;&nbsp;Продавець: _________________</b><br/><br/><br/>
  <!-------- end ----------->
</div>

 
<?php } ?>
</body>
</html>