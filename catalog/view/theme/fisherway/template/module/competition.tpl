<?php 
//print_r($products);
//print_r($answers);
?>


<?php if($competition['0']['status'] == 1): ?>

<div class="box competition-box">
	<?php foreach($competition as $competition): ?>
		<?php $id = $competition['competition_id']; ?>
  <h5 id="heading<?php echo $id; ?>"><span>Розыгрыш призов</span></h5>
  <div class="box-content" id="content<?php echo $id; ?>">
	<div class="box-line"></div>
  	<input type="hidden" name="competition_id" id="<?php echo $id; ?>">
  	
  	<?php if($competition['title'] != ""): ?>
  		<h3><?php echo $competition['title']; ?></h3>
  	<?php endif; ?>
  	
  	<?php if($competition['question'] != ""): ?>
  		<p class="question"><?php echo $competition['question']; ?></p>
  	<?php endif;?>
  	
  	<form method="post" id="competition-<?php echo $competition['competition_id']; ?>">
  	<?php $i = 0; //print_r($products);?>
	<?php if (isset($products)) { ?>
	<div class="b-slider-comp">
		<div class="slides_container" id="slides_container">
		<?php foreach($answers as $answer): ?>
		<?php if ($i%3 == 0) { ?><div class="tri-slide-comp"><?php } ?>
			<div class="e-slide-comp">
				<?php if ($products[$i]['thumb']) { ?>
				<div class="image"><img src="<?php echo $products[$i]['thumb']; ?>" alt="<?php echo $products[$i]['name']; ?>" /></div>
				<?php } ?>
				<div class="name"><?php echo $products[$i]['name']; ?><?php //echo $answer['value']; ?></div>
				<input type="radio" name="answer<?php echo $id; ?>" value="<?php echo $answer['id']; ?>" <?php if($i == 0): ?>checked<?php endif; ?> id="answer<?php echo $answer['id']; ?>">
				<label <?php if($answer['value'] == "[hideanswer]"): ?>style="display:none;"<?php endif; ?> for="answer<?php echo $answer['id']; ?>"></label>
			</div>
			<?php if ($i%3 == 2 || !isset($products[$i+1])) { ?></div><?php } ?>	
			<?php $i++; ?>
		<?php endforeach; ?>
		</div>
	</div>
	<?php } ?>
	<?php if($competition['description'] != ""): ?>
  		<div class="description-comp"><?php echo html_entity_decode($competition['description'], ENT_QUOTES, 'UTF-8'); ?></div>
  	<?php endif; ?>
	<?php 
		if($this->customer->isLogged()) {
			$firstname = $this->customer->getFirstName();
			$lastname = $this->customer->getLastName();
			$e_mail = $this->customer->getEmail();
		} else {
			$firstname = '';
			$lastname = '';
			$e_mail = '';
		}
	?>
	<div class="comp-registr">
		<span class="comp-label">Имя:</span>
		<input type="text" name="name" id="name<?php echo $id; ?>" value="<?php echo $firstname.' '.$lastname; ?>">
		<span class="comp-label">E-mail:</span>
		<input type="text" name="email" id="email<?php echo $id; ?>" value="<?php echo $e_mail; ?>">
  	
  	<?php if($competition['newsletter'] == 1): ?>
  		<input type="checkbox" name="newsletter" value="1" id="newsletter<?php echo $id; ?>"> <?php echo $text_newsletter_subscribe; ?>
  	<?php endif; ?>
  	
  	<?php if($competition['term'] == 1): ?>
  		<?php if($competition['information_id'] != 0): ?>
  			<input type="checkbox" name="terms" value="1" id="term<?php echo $id; ?>"><?php echo $text_read_accept; ?><a href="<?php echo $this->url->link('information/information', 'information_id=' . $competition['information_id']); ?>"><?php echo $information['title']; ?></a>
  		<?php endif; ?>
  	<?php endif; ?>
	<br><br>
		<input type="button" value="" onclick="enterCompetition(<?php echo $id; ?>)" id="but<?php echo $id; ?>" class="button comp_submit">
		<div style="clear:both;"></div>
	</div>
  	</form>
  </div>
  
  <?php endforeach; ?>
</div>


<script type="text/javascript">

function enterCompetition(comp_id) {
	var id = comp_id;
			
			var useranswer = $('input:radio[name="answer' + id +  '"]:checked').val();
			
			$('.error').remove();
			
	        if($('#newsletter'+id).is(":checked")) {
	            var newsl = 1;
	        } else {
	            var newsl = 0;
	        }

	        if($('#term'+id).is(":checked")) {
	            var term = 1;
	        } else {
	            var term = 0;
	        }

			var form_data = {
				competition_id	: id,
				answer			: useranswer,
				name 			: $('#name'+id).val(),
				email 			: $('#email'+id).val(),
				newsletter		: newsl,
				term			: term
			};
			
			$.ajax({
	            url: 'index.php?route=module/competition/enterCompetition',
	            type: 'POST',
	            data: form_data,
	            dataType: 'json',
	            success: function(json){
	            	
	            		if(json['success']){
					        $('#content' + id).remove();
					        $('#heading' + id).after('<div class="box-content">' + json['success'] + '</div>');
	            		}
	            		
	            		if(json['error']) {
							if (json['email_error']) {
								$('#email' + id).after('<span class="error">' + json['email_error'] + '</span>');
							}
							
							if (json['name_error']) {
								$('#name' + id).after('<span class="error">' + json['name_error'] + '</span>');
							}
							
							if (json['exist_error']) {
								$('#but' + id).before('<span class="error">' + json['exist_error'] + '</span>');
							}
							
							if (json['term_error']) {
								$('#term' + id).before('<span class="error">' + json['term_error'] + '</span>');
							}
	            		}
	                    
	                }
	            });
		};
</script>
<?php endif; ?>