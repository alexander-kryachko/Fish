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
<div class="box">
  <div class="box-heading">Рекомендуемые товары</div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>">
		<?php foreach ($results as $result) { ?>
			<?php if ($result['product_id'] == $product['product_id']) { ?>
			<span class="latest-item">Новинка</span>
			<?php } ?>
         <?php } ?>
		<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
		</a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
		<div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <?php echo $product['special']; ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>