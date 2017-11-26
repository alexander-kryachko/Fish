<?php
/*
 * Shoputils
 *
 * ПРИМЕЧАНИЕ К ЛИЦЕНЗИОННОМУ СОГЛАШЕНИЮ
 *
 * Этот файл связан лицензионным соглашением, которое можно найти в архиве,
 * вместе с этим файлом. Файл лицензии называется: LICENSE.1.5.x.RUS.txt
 * Так же лицензионное соглашение можно найти по адресу:
 * http://opencart.shoputils.ru/LICENSE.1.5.x.RUS.txt
 * 
 * =================================================================
 * OPENCART 1.5.x ПРИМЕЧАНИЕ ПО ИСПОЛЬЗОВАНИЮ
 * =================================================================
 *  Этот файл предназначен для Opencart 1.5.x. Shoputils не
 *  гарантирует правильную работу этого расширения на любой другой 
 *  версии Opencart, кроме Opencart 1.5.x. 
 *  Shoputils не поддерживает программное обеспечение для других 
 *  версий Opencart.
 * =================================================================
*/
?>
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
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="center"><span class="control-label" title="<?php echo $help_old_order_statuses; ?>"><?php echo $column_old_order_statuses; ?></span></td>
              <td class="center"><span class="control-label" title="<?php echo $help_new_order_status; ?>"><?php echo $column_new_order_status; ?></span></td>
              <td class="center"><span class="control-label" title="<?php echo $help_days; ?>"><?php echo $column_days; ?></span></td>
              <td class="center"><?php echo $column_status; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="left">
                  <div class="scrollbox" style="width: 100%; height: 150px;">
                      <?php $class = 'odd'; ?>
                      <div class="<?php echo $class; ?>">
                          <input type="checkbox" name="shoputils_auto_update_orders_old_order_status_ids[]"
                                 value="0"<?php echo in_array('0', $shoputils_auto_update_orders_old_order_status_ids) ? 'checked="checked"' : ''?>/>
                                 <?php echo $text_missing; ?>
                      </div>
                      <?php foreach ($order_statuses as $order_status) { ?>
                          <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                          <div class="<?php echo $class; ?>">
                              <input type="checkbox" name="shoputils_auto_update_orders_old_order_status_ids[]"
                                     value="<?php echo $order_status['order_status_id'] ?>"<?php echo in_array($order_status['order_status_id'], $shoputils_auto_update_orders_old_order_status_ids) ? 'checked="checked"' : ''?>/>
                                     <?php echo $order_status['name']; ?>
                          </div>
                      <?php } ?>
                  </div>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
              </td>
              <td class="center">
                  <select name="shoputils_auto_update_orders_new_order_status">
                      <?php foreach ($order_statuses as $order_status) { ?>
                          <?php if ($order_status['order_status_id'] == $shoputils_auto_update_orders_new_order_status) { ?>
                              <option value="<?php echo $order_status['order_status_id']; ?>"
                                    selected="selected"><?php echo $order_status['name']; ?></option>
                          <?php } else { ?>
                              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                          <?php } ?>
                      <?php } ?>
                  </select>
              </td>
              <td class="center"><input type="text" name="shoputils_auto_update_orders_days" value="<?php echo $shoputils_auto_update_orders_days; ?>" size="3" />&nbsp;<?php echo $entry_days; ?></td>
              <td class="center">
                <select name="shoputils_auto_update_orders_status">
                  <?php if ($shoputils_auto_update_orders_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <div style="padding: 15px 15px; border:1px solid #ccc; margin-top: 15px; box-shadow:0 0px 5px rgba(0,0,0,0.1);"><?php echo $text_copyright; ?></div>
  </div>
</div>
<?php echo $footer; ?>