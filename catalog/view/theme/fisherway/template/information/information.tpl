<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content" class="content-page">
<div class="one-line"></div>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?>
	<?php if($i+1 < count($breadcrumbs)) { ?>
		<a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } elseif ($i+1 == count($breadcrumbs)) { ?>
		<?php echo $breadcrumb['text']; ?>
	<?php } ?>
	<?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $content_top; ?>
  <?php echo $description; ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>