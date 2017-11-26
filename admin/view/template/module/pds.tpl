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
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<h2><?php echo $text_general; ?></h2>
		<table class="form">
			<tbody>
				<tr>
					<td>
						<?php echo $entry_allow_buying_series; ?>
					</td>
					<td>
						<input type="radio" name="pds_allow_buying_series" value="1" <?php echo $pds_allow_buying_series ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
						<input type="radio" name="pds_allow_buying_series" value="0" <?php echo !$pds_allow_buying_series ? 'checked="checked"' : ''; ?>><?php echo $text_no;?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_hide_from_list_view; ?>
						<span class="help"><?php echo $text_hide_from_list_view; ?></span>
					</td>
					<td>
						<input type="radio" name="pds_hide_from_list_view" value="items" <?php echo $pds_hide_from_list_view == 'items' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_items;?><br/>
						<input type="radio" name="pds_hide_from_list_view" value="series" <?php echo $pds_hide_from_list_view == 'series' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_series;?><br/>		
						<input type="radio" name="pds_hide_from_list_view" value="none" <?php echo $pds_hide_from_list_view == 'none' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_none;?>
					</td>
				</tr>
			</tbody>
		</table>
		<h2><?php echo $text_category_page; ?></h2>
		<table class="form">
			<tbody>
				<tr>
					<td>
						<?php echo $entry_show_thumbnails; ?>
						<span class="help"><?php echo $text_show_thumbnails; ?></span>
					</td>
					<td>
						<input type="radio" name="pds_show_thumbnails" value="1" <?php echo $pds_show_thumbnails ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
						<input type="radio" name="pds_show_thumbnails" value="0" <?php echo !$pds_show_thumbnails? 'checked="checked"' : ''; ?>><?php echo $text_no;?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_thumbnail_size; ?>
					</td>
					<td>
						<input type="text" name="pds_list_thumbnail_width" value="<?php echo $pds_list_thumbnail_width; ?>" size="3" />
						&nbsp;x&nbsp;
						<input type="text" name="pds_list_thumbnail_height" value="<?php echo $pds_list_thumbnail_height; ?>" size="3" />
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_thumbnail_hover_effect; ?>
						<span class="help"><?php echo $text_thumbnail_hover_effect; ?></span>
					</td>
					<td>
						<input type="radio" name="pds_thumbnail_hover_effect" value="rollover" <?php echo $pds_thumbnail_hover_effect == 'rollover' ? 'checked="checked"' : ''; ?>><?php echo $text_rollover;?><br/>
						<input type="radio" name="pds_thumbnail_hover_effect" value="preview" <?php echo $pds_thumbnail_hover_effect == 'preview' ? 'checked="checked"' : ''; ?>><?php echo $text_preview;?><br/>		
						<input type="radio" name="pds_thumbnail_hover_effect" value="none" <?php echo $pds_thumbnail_hover_effect == 'none' ? 'checked="checked"' : ''; ?>><?php echo $text_no_effect;?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_preview_size; ?>
						<span class="help"><?php echo $text_list_preview_size; ?></span>
					</td>
					<td>
						<input type="text" name="pds_list_preview_width" value="<?php echo $pds_list_preview_width; ?>" size="3" />
						&nbsp;x&nbsp;
						<input type="text" name="pds_list_preview_height" value="<?php echo $pds_list_preview_height; ?>" size="3" />
					</td>
				</tr>
			</tbody>
		</table>
		<h2><?php echo $text_product_page; ?></h2>
		<table class="form">
			<tbody>
				<tr>
					<td>
						<?php echo $entry_thumbnail_size; ?>
					</td>
					<td>
						<input type="text" name="pds_detail_thumbnail_width" value="<?php echo $pds_detail_thumbnail_width; ?>" size="3" />
						&nbsp;x&nbsp;
						<input type="text" name="pds_detail_thumbnail_height" value="<?php echo $pds_detail_thumbnail_height; ?>" size="3" />
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_enable_preview; ?>						
						<span class="help"><?php echo $text_enable_preview; ?></span>
					</td>
					<td>
						<input type="radio" name="pds_enable_preview" value="1" <?php echo $pds_enable_preview ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
						<input type="radio" name="pds_enable_preview" value="0" <?php echo !$pds_enable_preview ? 'checked="checked"' : ''; ?>><?php echo $text_no;?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $entry_preview_size; ?>
					</td>
					<td>
						<input type="text" name="pds_preview_width" value="<?php echo $pds_preview_width; ?>" size="3" />
						&nbsp;x&nbsp;
						<input type="text" name="pds_preview_height" value="<?php echo $pds_preview_height; ?>" size="3" />
					</td>
				</tr>
			</tbody>
		</table>
    </form>

	<p>
		Thank you for your purchase, please check <a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=WeDoWeb" title="WeDoWeb's OpenCart extensions">our website</a> for more useful extensions.<br/>
		<br/>
		<b><a href="http://wedoweb.com.au" title="WeDoWeb Team">WeDoWeb Team</a></b>
	</p>
  </div>
</div>
<?php echo $footer; ?>