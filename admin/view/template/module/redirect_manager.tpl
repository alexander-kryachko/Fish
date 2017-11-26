<?php
//==============================================================================
// Redirect Manager v156.2
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
//==============================================================================
?>

<?php echo $header; ?>
<style type="text/css">
	table.form td:first-child {
		width: 275px !important;
	}
	table.list thead tr {
		height: 40px;
	}
	table.list td {
		white-space: nowrap;
	}
	textarea {
		width: 95%;
	}
	input[type="text"] {
		width: 65px;
	}
	input[type="file"] {
		border: 1px dashed #CCC;
	}
	.button {
		text-decoration: none !important;
	}
	.green {
		background: #080 !important;
	}
	.red {
		background: #B00 !important;
	}
	.yellow {
		background: #EE0 !important;
	}
	.status {
		color: #FFF; 
		cursor: pointer;
		font-size: 18px;
		width: 15px;
	}
</style>
<?php if ($version > 149) { ?>
<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
<?php } ?>
<?php if ($error_warning) { ?><div class="warning"><?php echo $error_warning; ?></div><?php } ?>
<?php if ($success) { ?><div class="success"><?php echo $success; ?></div><?php } ?>
<div class="box">
	<?php if ($version < 150) { ?><div class="left"></div><div class="right"></div><?php } ?>
	<div class="heading">
		<h1 style="padding: 10px 2px 0"><img src="view/image/<?php echo $type; ?>.png" alt="" style="vertical-align: middle" /> <?php echo $heading_title; ?></h1>
		<div class="buttons">
			<a onclick="$('#form').attr('action', location + '&exit=true'); $('#form').submit()" class="button"><span><?php echo $button_save_exit; ?></span></a>
			<a onclick="$('#form').submit()" class="button"><span><?php echo $button_save_keep_editing; ?></span></a>
			<a onclick="location = '<?php echo $exit; ?>'" class="button"><span><?php echo $button_cancel; ?></span></a>
		</div>
	</div>
	<div class="content">
		<form action="" method="post" enctype="multipart/form-data" id="form">
			<table class="form" style="margin-bottom: -1px">
				<tr>
					<td><?php echo $entry_status; ?></td>
					<td><div class="buttons" style="float: right">
							<input type="file" name="import_file" />
							<a class="button" onclick="if (confirm('<?php echo $text_warning; ?>')) { $('#form').attr('action', location + '&import=true'); $('#form').submit() }"><span><?php echo $button_import_csv; ?></span></a>
							<a class="button" href="<?php echo HTTPS_SERVER . 'index.php?route=' . $type . '/' . $name . '/exportCSV&token=' . $token; ?>"><span><?php echo $button_export_csv; ?></span></a>
						</div>
						<select name="<?php echo $name; ?>_status">
							<option value="1" <?php if (!empty(${$name.'_status'})) echo 'selected="selected"'; ?>><?php echo $text_enabled; ?></option>
							<option value="0" <?php if (empty(${$name.'_status'})) echo 'selected="selected"'; ?>><?php echo $text_disabled; ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="buttons" style="float: right">
							<a class="button" onclick="if (confirm('<?php echo $text_warning; ?>')) { $('#form').attr('action', location + '&resetall=true'); $('#form').submit() }"><span><?php echo $button_reset_all; ?></span></a>
							<a class="button" onclick="if (confirm('<?php echo $text_warning; ?>')) { $('#form').attr('action', location + '&delall=true'); $('#form').submit() }"><span><?php echo $button_delete_all; ?></span></a>
						</div>
						<?php echo $text_help; ?>
					</td>
				</tr>
			</table>
			<table class="list">
			<thead>
				<tr>
					<?php foreach (array('active', 'from_url', 'to_url', 'response_code', 'date_start', 'date_end', 'times_used') as $column) { ?>
						<td class="center" <?php if (strpos($column, 'url')) echo 'style="width: 33%"'; ?>>
							<a onclick="$('#form').attr('action', location + '&sort=<?php echo $column; ?>&order=<?php echo ($sort == $column && $order == 'ASC') ? 'DESC' : 'ASC'; ?>&page=1'); $('#form').submit()">
								<?php echo ${'entry_'.$column}; ?>
								<?php if ($sort == $column) { ?>
									<img src="view/image/<?php echo strtolower($order); ?>.png" />
								<?php } ?>
							</a>
						</td>
					<?php } ?>
					<td class="center"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="left" colspan="8" style="background: #EEE"><a onclick="addRow($(this))" class="button"><span><?php echo $button_add_row; ?></span></a></td>
				</tr>
				<?php if ($results) { ?>
					<?php foreach ($results as $result) { ?>
						<?php $id = $result['redirect_id']; ?>
						<tr>
							<td class="center status <?php echo ($result['active']) ? 'green' : 'red'; ?>" onclick="if ($(this).hasClass('green')) { $(this).removeClass('green').addClass('red').find('span').html('&#10008;'); $(this).find('input').val('0'); } else { $(this).removeClass('red').addClass('green').find('span').html('&#10004;'); $(this).find('input').val('1'); }">
								<span><?php echo ($result['active']) ? '&#10004;' : '&#10008;'; ?></span>
								<input type="hidden" name="data[<?php echo $id; ?>][active]" value="<?php echo $result['active']; ?>" />
							</td>
							<td class="center"><textarea name="data[<?php echo $id; ?>][from_url]"><?php echo $result['from_url']; ?></textarea></td>
							<td class="center"><textarea name="data[<?php echo $id; ?>][to_url]"><?php echo $result['to_url']; ?></textarea></td>
							<td class="center">
								<select name="data[<?php echo $id; ?>][response_code]">
									<option value="301" <?php if ($result['response_code'] == '301') echo 'selected="selected"'; ?>><?php echo $text_moved_permanently; ?></option>
									<option value="302" <?php if ($result['response_code'] == '302') echo 'selected="selected"'; ?>><?php echo $text_found; ?></option>
									<option value="307" <?php if ($result['response_code'] == '307') echo 'selected="selected"'; ?>><?php echo $text_temporary_redirect; ?></option>
								</select>
							</td>
							<td class="center"><input type="text" class="date" name="data[<?php echo $id; ?>][date_start]" value="<?php if ($result['date_start'] != '0000-00-00') echo $result['date_start']; ?>" /></td>
							<td class="center"><input type="text" class="date" name="data[<?php echo $id; ?>][date_end]" value="<?php if ($result['date_end'] != '0000-00-00') echo $result['date_end']; ?>" /></td>
							<td class="center">
								<div class="times-used"><?php echo $result['times_used']; ?></div>
								<a onclick="if (confirm('<?php echo $text_warning; ?>')) { $(this).prev().html('0'); $(this).next().val('0') }" style="font-size: 11px">Reset</a>
								<input class="times-used" type="hidden" name="data[<?php echo $id; ?>][times_used]" value="<?php echo $result['times_used']; ?>" />
							</td>
							<td class="center"><a onclick="$('#deleted-rows').append('<input type=\'hidden\' name=\'deleted[]\' value=\'<?php echo $id; ?>\' />'); $(this).parent().parent().remove()"><img src="view/image/error.png" title="Delete Redirect" /></a></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
			</table>
			<div class="pagination" style="border-top: none"><?php echo $pagination; ?></div>
			<div id="deleted-rows"></div>
		</form>
		<?php echo $copyright; ?>
	</div>
</div>
<?php if ($version < 150) { ?>
	<script type="text/javascript" src="view/javascript/jquery/ui/ui.datepicker.js"></script>
<?php } else { ?>
	</div>
<?php } ?>
<script type="text/javascript"><!--
	function attachDatePickers() {
		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	}
	attachDatePickers();
	
	newRow = -1;
	function addRow(element) {
		element.parent().parent().before('\
			<tr>\
				<td class="center status green" onclick="if ($(this).hasClass(\'green\')) { $(this).removeClass(\'green\').addClass(\'red\').find(\'span\').html(\'&#10008;\'); $(this).find(\'input\').val(\'0\'); } else { $(this).removeClass(\'red\').addClass(\'green\').find(\'span\').html(\'&#10004;\'); $(this).find(\'input\').val(\'1\'); }">\
					<span>&#10004;</span>\
					<input type="hidden" name="data[' + newRow + '][active]" value="1" />\
				</td>\
				<td class="center"><textarea name="data[' + newRow + '][from_url]"></textarea></td>\
				<td class="center"><textarea name="data[' + newRow + '][to_url]"></textarea></td>\
				<td class="center">\
					<select name="data[' + newRow + '][response_code]">\
						<option value="301"><?php echo $text_moved_permanently; ?></option>\
						<option value="302"><?php echo $text_found; ?></option>\
						<option value="307"><?php echo $text_temporary_redirect; ?></option>\
					</select>\
				</td>\
				<td class="center"><input type="text" class="date" name="data[' + newRow + '][date_start]" /></td>\
				<td class="center"><input type="text" class="date" name="data[' + newRow + '][date_end]" /></td>\
				<td class="center">\
					<div>0</div>\
					<a onclick="if (confirm(\'<?php echo $text_warning; ?>\')) { $(this).prev().html(\'0\'); $(this).next().val(\'0\') }" style="font-size: 11px">Reset</a>\
					<input type="hidden" name="data[' + newRow + '][times_used]" value="0" />\
				</td>\
				<td class="center"><a onclick="$(this).parent().parent().remove()"><img src="view/image/error.png" title="Delete Redirect" /></a></td>\
			</tr>\
		');
		newRow--;
		attachDatePickers();
	}
	
	function exportCSV() {
		if (!$('#import').val()) alert('No import file');
		
		if (confirm('<?php echo $text_warning; ?>')) {
			$('#import').after('<img id="loading" style="padding: 0 5px" alt="Loading" src="view/image/loading.gif" />');
			$.ajax({
				type: 'POST',
				url: 'index.php?route=<?php echo $type; ?>/<?php echo $name; ?>/importCSV&token=<?php echo $token; ?>',
				data: {'import': $('#import')},
				success: function(data){
					if (data) alert(data);
					$('#loading').remove();
				}
			});
		}
	}
--></script>
<?php echo $footer; ?>