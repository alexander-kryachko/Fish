<?php 
//print_r($products);
//print_r($answers);
?>


<?php if($competition['0']['status'] == 1): ?>

<div class="box">
	<?php foreach($competition as $competition): ?>
		<?php $id = $competition['competition_id']; ?>
  <div class="box-heading" id="heading<?php echo $id; ?>">Розыгрыш призов</div>
  <div class="box-content" id="content<?php echo $id; ?>">
  	
  	<input type="hidden" name="competition_id" id="<?php echo $id; ?>">
  	
  	<?php if($competition['title'] != ""): ?>
  		<h3><?php echo $competition['title']; ?></h3>
  	<?php endif; ?>
  	
  	<?php if($competition['question'] != ""): ?>
  		<b><?php echo $competition['question']; ?></b><br>
  	<?php endif;?>
  	
  	<form method="post" id="competition-<?php echo $competition['competition_id']; ?>">
  	<?php $i = 0; ?>
	<?php if (isset($products)) { ?>
  	<?php foreach($answers as $answer): ?>
  		<label <?php if($answer['value'] == "[hideanswer]"): ?>style="display:none;"<?php endif; ?>>
		
		<div>
			<?php if ($products[$i]['thumb']) { ?>
			<div class="image"><img src="<?php echo $products[$i]['thumb']; ?>" alt="<?php echo $products[$i]['name']; ?>" /></div>
			<?php } ?>
			<div class="name"><?php echo $products[$i]['name']; ?> - <?php echo $answer['value']; ?></div>
		</div>
		
		<input type="radio" name="answer<?php echo $id; ?>" value="<?php echo $answer['id']; ?>" <?php if($i == 0): ?>checked<?php endif; ?> id="answer<?php echo $id; ?>">
		<?php //echo $answer['value']; ?>
		</label><br>
  		<?php $i++; ?>
  	<?php endforeach; ?>
	<?php } ?>
  	<br>
	<?php if($competition['description'] != ""): ?>
  		<?php echo html_entity_decode($competition['description'], ENT_QUOTES, 'UTF-8'); ?>
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
  	Имя:<br>
  	<input type="text" name="name" id="name<?php echo $id; ?>" value="<?php echo $firstname.' '.$lastname; ?>"><br>
  	<br>
  	E-mail:<br>
  	<input type="text" name="email" id="email<?php echo $id; ?>" value="<?php echo $e_mail; ?>"><br>
  	<br>
  	<?php if($competition['newsletter'] == 1): ?>
  		<input type="checkbox" name="newsletter" value="1" id="newsletter<?php echo $id; ?>"> <?php echo $text_newsletter_subscribe; ?><br>
  	<?php endif; ?>
  	
  	<?php if($competition['term'] == 1): ?>
  		<?php if($competition['information_id'] != 0): ?>
  			<input type="checkbox" name="terms" value="1" id="term<?php echo $id; ?>"><?php echo $text_read_accept; ?><a href="<?php echo $this->url->link('information/information', 'information_id=' . $competition['information_id']); ?>"><?php echo $information['title']; ?></a>
  		<?php endif; ?>
  	<?php endif; ?>
  	
  	<br>
  	<input type="button" value="Голосовать" onclick="enterCompetition(<?php echo $id; ?>)" id="but<?php echo $id; ?>" class="button comp_submit">

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