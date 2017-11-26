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
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'email') { ?>
                <a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_customer; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($customer_ban_emails) { ?>
            <?php foreach ($customer_ban_emails as $customer_ban_email) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($customer_ban_email['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer_ban_email['customer_ban_email_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer_ban_email['customer_ban_email_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $customer_ban_email['email']; ?></td>
              <td class="right"><?php if ($customer_ban_email['total']) { ?>
                <a href="<?php echo $customer_ban_email['customer']; ?>"><?php echo $customer_ban_email['total']; ?></a>
                <?php } else { ?>
                <?php echo $customer_ban_email['total']; ?>
                <?php } ?></td>
              <td class="right"><?php foreach ($customer_ban_email['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 