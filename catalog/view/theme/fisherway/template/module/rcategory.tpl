<?php
$this->load->model('catalog/product');
$this->data['products'] = array();
		$data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);
$results = $this->model_catalog_product->getProducts($data);
?>

<?php if(!empty($products)){ ?>
<div class="rcategory-block">
  <div class="rcategory-heading">Рекомендуемые товары</div>
  <div class="rcategory-content">
    <div class="rcategory-products">
      <?php foreach ($products as $product) { ?>
      <div class="rcategory-product">
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>">
		<?php foreach ($results as $result) { ?>
			<?php if ($result['product_id'] == $product['product_id']) { ?>
			<span class="latest-item"></span>
			<?php } ?>
         <?php } ?>
		<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
		</a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
		<div class="cart"><input type="button" value="В корзину" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <?php echo $product['special']; ?>
          <?php } ?>
        </div>
        <?php } ?>
		<div style="clear:both;"></div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>