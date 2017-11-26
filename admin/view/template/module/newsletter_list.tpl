<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/category.png" alt="" /><?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $back; ?>'" class="button"><?php echo $text_back; ?></a></div>
    </div>
    <div class="content">
        <table class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $text_name; ?></td>
              <td class="left"><?php echo $text_email; ?></td>
              <td class="right"><?php echo $text_action; ?></td>
            </tr>
          </thead>
          <tbody>
          	<?php $i = 0; ?>
          	<?php foreach($newsletters as $newsletter): ?>
	            <tr>
	              <td class="left"><?php echo $newsletter['name']; ?></td>
                <td class="left"><?php echo $newsletter['email']; ?></td>
	              <td class="right">[ <a href="<?php echo $this->url->link('module/competition/newsletterdelete&id=' . $newsletter['newsletter_id'] . '', 'token=' . $this->session->data['token'], 'SSL'); ?>"><?php echo $text_delete; ?></a> ]</td>
	            </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
            <?php if($i == 0): ?>
            <tr>
              <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
<?php echo $footer; ?>