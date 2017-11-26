<?php echo $header; ?>
<div id="content">
	<div class="page-header">
    	<div class="container-fluid">
      		<ul class="breadcrumb">
        		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
        			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        		<?php } ?>
      		</ul>
    	</div>
  	</div>
  	<div class="container-fluid">
   		<?php if ($success) { ?>
    		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      			<button type="button" class="close" data-dismiss="alert">&times;</button>
    		</div>
    	<?php } ?>
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
        		<h3 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
        		<div class="pull-right"> 
      			<div class="btn-group">
      				<button type="submit" id="button-pdf" form="form" formaction="<?php echo $pdf; ?>&type=printDocument" data-toggle="tooltip" title="<?php echo $button_pdf; ?>" class="btn btn-default" disabled="disabled"><i class="fa fa-file-pdf-o"></i></button>
  					<button type="button" id="button-pdf" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled">
    					<span class="caret"></span>
  					</button>
		  			<ul class="dropdown-menu dropdown-menu-right">
		  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printDocument" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-file-text-o"></i> <?php echo $button_ei; ?></button></li>
		  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printMarkings" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-object-group"></i> <?php echo $button_mark; ?></button></li>
		  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printMarkings" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-barcode"></i> <?php echo $button_mark_zebra; ?></button></li>
					</ul>
				</div>
				<div class="btn-group">
      				<a href="<?php echo $print . '/printDocument/type/html/apiKey/' . $api_key; ?>" target="_blank" id="print" data-toggle="tooltip" title="<?php echo $button_print; ?>" class="btn btn-default" disabled="disabled"><i class="fa fa-print"></i></a>
  					<button type="button" id="print" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled">
    					<span class="caret"></span>
  					</button>
		  			<ul class="dropdown-menu dropdown-menu-right">
				    	<li><a href="<?php echo $print . '/printDocument/type/html/apiKey/' . $api_key; ?>" id="print" target="_blank"><i class="fa fa-file-text-o"></i> <?php echo $button_ei; ?></a></li>
				    	<li><a href="<?php echo $print . '/printMarkings/type/html/apiKey/' . $api_key; ?>" id="print" target="_blank"><i class="fa fa-object-group"></i> <?php echo $button_mark; ?></a></li>
				    	<li><a href="<?php echo $print . '/printMarkings/type/html/apiKey/' . $api_key . '/zebra/zebra'; ?>" id="print" target="_blank"><i class="fa fa-barcode"></i> <?php echo $button_mark_zebra; ?></a></li>
					</ul>
				</div>
        		<a href="<?php echo $back_to_orders; ?>" data-toggle="tooltip" title="<?php echo $button_back_to_orders; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      		</div>
      		</div>
      		<div style="clear: both;"></div>
      	<div class="panel-body">
        	<div class="well">
          		<div class="row">
            		<div class="col-sm-4">
              			<div class="form-group">
                			<label class="control-label" for="input-ei-number"><?php echo $entry_ei_number; ?></label>
                			<input type="text" name="filter_ei_number" value="<?php echo $filter_ei_number; ?>" placeholder="<?php echo $entry_ei_number; ?>" id="input-ei-number" class="form-control" />
             			</div>
            		</div>
            		<div class="col-sm-4">
              			<div class="form-group">
                			<label class="control-label" for="input-recipient"><?php echo $entry_recipient; ?></label>
                			<input type="text" name="filter_recipient" value="<?php echo $filter_recipient; ?>" placeholder="<?php echo $entry_recipient; ?>" id="input-recipient" class="form-control" />
              			</div>
            		</div>
            		<div class="col-sm-4">
              			<div class="form-group">
                			<label class="control-label" for="input-shipment-date"><?php echo $entry_shipment_date; ?></label>
                			<div class="input-group date">
                  				<input type="text" name="filter_shipment_date" value="<?php echo $filter_shipment_date; ?>" placeholder="<?php echo $entry_shipment_date; ?>" data-date-format="DD.MM.YYYY" id="input-shipment-date" class="form-control" />
                  				<span class="input-group-btn">
                  					<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  				</span>
                  			</div>
              			</div>
              			<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
           	 		</div>
          		</div>
        	</div>
        	<form method="post" enctype="multipart/form-data" id="form">
          		<div class="table-responsive">
            		<table class="table table-bordered table-hover">
              			<thead>
                			<tr>
	                  			<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name^=selected]').prop('checked', this.checked); $('input[name^=selected]').triggerHandler('change')" /></td>
	                  			<td><?php echo $column_ei_number; ?></td>
	                  			<td><?php echo $column_estimated_delivery_date; ?></td>
	                  			<td><?php echo $column_recipient; ?></td>
	                  			<td><?php echo $column_phone; ?></td>
	                  			<td><?php echo $column_city; ?></td>
	                  			<td><?php echo $column_address; ?></td>
	                  			<td><?php echo $column_state; ?></td>
	                  			<td><?php echo $column_action; ?></td>
                			</tr>
              			</thead>
              			<tbody>
              				<?php if ($documents) { ?>
              					<?php foreach ($documents as $document) { ?>
              						<tr>
			              				<td class="text-center">
			                    			<input type="checkbox" name="selected[]" value="<?php echo $document['IntDocNumber']; ?>" />
										</td>
			                  			<td><?php echo $document['IntDocNumber']; ?></td>
			                  			<td><?php echo $document['EstimatedDeliveryDate']; ?></td>
			                  			<td><?php echo $document['RecipientContactPerson']; ?></td>
			                  			<td><?php echo $document['RecipientContactPhone']; ?></td>
			                  			<td><?php echo $document['CityRecipientDescription']; ?></td>
			                  			<td><?php echo $document['RecipientAddressDescription']; ?></td>
			                  			<td><?php echo $document['StateName']; ?></td>
			                  			<td class="text-center">
			                    			<div class="btn-group">
									      		<button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printDocument&order=<?php echo $document['IntDocNumber']; ?>" data-toggle="tooltip" title="<?php echo $button_pdf; ?>" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></button>
									  			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    			<span class="caret"></span>
									  			</button>
									  			<ul class="dropdown-menu dropdown-menu-right">
									  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printDocument&order=<?php echo $document['IntDocNumber']; ?>" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-file-text-o"></i> <?php echo $button_ei; ?></button></li>
									  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printMarkings&order=<?php echo $document['IntDocNumber']; ?>" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-object-group"></i> <?php echo $button_mark; ?></button></li>
									  				<li><button type="submit" form="form" formaction="<?php echo $pdf; ?>&type=printMarkings&order=<?php echo $document['IntDocNumber']; ?>" class="btn btn-link btn-block" style="text-align: left"><i class="fa fa-barcode"></i> <?php echo $button_mark_zebra; ?></button></li>
												</ul>
											</div>
			                    			<div class="btn-group">
									      		<a href="<?php echo $print . '/printDocument/type/html/apiKey/' . $api_key . '/orders[]/' . $document['IntDocNumber']; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_print; ?>" class="btn btn-default"><i class="fa fa-print"></i></a>
									  			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    			<span class="caret"></span>
									  			</button>
									  			<ul class="dropdown-menu dropdown-menu-right">
											    	<li><a href="<?php echo $print . '/printDocument/type/html/apiKey/' . $api_key . '/orders[]/' . $document['IntDocNumber']; ?>" target="_blank"><i class="fa fa-file-text-o"></i> <?php echo $button_ei; ?></a></li>
											    	<li><a href="<?php echo $print . '/printMarkings/type/html/apiKey/' . $api_key . '/orders[]/' . $document['IntDocNumber']; ?>" target="_blank"><i class="fa fa-object-group"></i> <?php echo $button_mark; ?></a></li>
											    	<li><a href="<?php echo $print . '/printMarkings/type/html/apiKey/' . $api_key . '/orders[]/' . $document['IntDocNumber'] . '/zebra/zebra'; ?>" target="_blank"><i class="fa fa-barcode"></i> <?php echo $button_mark_zebra; ?></a></li>
												</ul>
											</div>
			                    		</td>
               			 			</tr>
               					<?php } ?>
               				<?php } else { ?>
               					<tr>
                  					<td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
                				</tr>
               				<?php } ?>
              			</tbody>
            		</table>
          		</div>
        	</form>
        	<div class="row">
          		<div class="col-sm-12 text-right"><?php echo $pagination; ?></div>
       		</div>
      	</div>
    </div>
</div>
<script type="text/javascript"><!--  
$(function() {
	
	if ('<?php echo $ei; ?>') {
		$('tr:contains("<?php echo $ei; ?>")').addClass('success');
	}
		
	$('input[name ^= select]').on('change', function(e) {
		
		var selected = $('input[name^=selected]:checked'), orders = '';
		
		for(var i = 0; i < selected.length; i++) {
			orders += '/orders[]/' + selected[i].value;
		}
		
		$('a#print').each( function(indx) {
			$(this).attr('href', $(this).attr('href').replace(/\/orders\[\]\/.*/g, ''));
		});
		
		$('a#print').each( function(indx) {
			$(this).attr('href', $(this).attr('href') + orders);
		});
		
		if (selected.length) {
			$('#button-pdf, #print').attr('disabled', false);
		} else {
			$('#button-pdf, #print').attr('disabled', true);
		}
	});
	
	$('#button-filter').on('click', function() {
		url = 'index.php?route=sale/novaposhta_ei&token=<?php echo $token; ?>';

		var filter_shipment_date = $('input[name=filter_shipment_date]').val();

		if (filter_shipment_date) {
			url += '&filter_shipment_date=' + encodeURIComponent(filter_shipment_date);
		}

		location = url;
	});

	$('.date').datetimepicker({
		pickTime: false
	});

});
//--></script>
<?php echo $footer; ?>