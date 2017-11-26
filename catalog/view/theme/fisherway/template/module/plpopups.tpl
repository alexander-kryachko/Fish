<?php if ($on_off_plpopups == true) {
	/*?>
    <style>
    .plpopup-overlay<?php echo $plpopups_id; ?>,
    .plpopup-container<?php echo $plpopups_id; ?> { position: fixed; left: 0; top: 0; right: 0; bottom: 0; <?php if(!empty($plpopups_zindex)){?>z-index: <?php echo $plpopups_zindex; ?> !important;<?php }?>}
    .plpopup-container<?php echo $plpopups_id; ?> { overflow: auto; margin: 0; padding: 0; border: 0; border-collapse: collapse; }
    *:first-child+html .plpopup-container<?php echo $plpopups_id; ?> { height: 100% }
    .plpopup-container<?php echo $plpopups_id; ?>_i { height: 100%; <?php if(!empty($plpopups_margin)){?>margin: <?php echo $plpopups_margin; ?>;<?php }?> }
    .plpopup-container<?php echo $plpopups_id; ?>_i2 { padding: 24px; margin: 0; border: 0; vertical-align: middle; }
    .plpopup-error<?php echo $plpopups_id; ?> { padding: 20px; border-radius: 10px; background: #000; color: #fff; }
    .plpopup-loading<?php echo $plpopups_id; ?> { width: 80px; height: 80px; border-radius: 10px; background: #000  url('data:image/gif;base64,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') no-repeat 50% 50%; }
    <?php if(!empty($plpopups_screen_resolution)){?>
    @media screen and (max-width: <?php echo $plpopups_screen_resolution; ?>px){
    .box-plpopup<?php echo $plpopups_id; ?>{display: none;}
    .plpopup-overlay<?php echo $plpopups_id; ?>{display: none !important;}
    }
    <?php }?>
    .box-plpopup<?php echo $plpopups_id; ?> {
    position: relative;
    <?php if(!empty($plpopups_background_size_w)){?>width: <?php echo $plpopups_background_size_w; ?>px;<?php }?>
    <?php if(!empty($plpopups_background_size_h)){?>height: <?php echo $plpopups_background_size_h; ?>px;<?php }?>
    background: <?php if(!empty($plpopups_background_color)){?><?php } echo $plpopups_background_color; ?><?php if (!empty($plpopups_background)){?> url('/image/data/plpopups/<?php if(!empty($plpopups_background)){?><?php } echo $plpopups_background; ?>') no-repeat<?php }?>;
    font: 14px/18px Arial, "Helvetica CY", "Nimbus Sans L", sans-serif;
    <?php if(!empty($plpopups_shadow)){?>box-shadow: <?php echo $plpopups_shadow; ?>;<?php }?>
    <?php if(!empty($plpopups_borderradius)){?>
        -webkit-border-radius: <?php echo $plpopups_borderradius; ?>px;
        -moz-border-radius: <?php echo $plpopups_borderradius; ?>px;
        border-radius: <?php echo $plpopups_borderradius; ?>px;<?php }?>
    }
    .box-plpopup<?php echo $plpopups_id; ?>_close { position: absolute; <?php if(!empty($plpopups_close_button_right)){?>right: <?php echo $plpopups_close_button_right; ?>px;<?php }?> <?php if(!empty($plpopups_close_button_top)){?>top: <?php echo $plpopups_close_button_top; ?>px;<?php }?> <?php if(!empty($plpopups_close_font_size)){?>font-size: <?php echo $plpopups_close_font_size; ?>px;<?php }?> line-height: 15px; <?php if(!empty($plpopups_close_font_color)){?>color: <?php echo $plpopups_close_font_color; ?>;<?php }?> <?php if ($plpopups_close_font_weight == true) {?>font-weight: bold;<?php }?> <?php if ($plpopups_close_font_italic == true) {?>font-style: italic;<?php }?> cursor: pointer; }

    <?php if(!empty($plpopups_close_font_color_hover)){?>.box-plpopup<?php echo $plpopups_id; ?>_close:hover { color: <?php echo $plpopups_close_font_color_hover; ?>; }<?php }?>

    <?php if(!empty($plpopups_close_css)){?>.box-plpopup<?php echo $plpopups_id; ?>_close {
        <?php echo $plpopups_close_css; ?>
    }<?php }?>

    <?php if(!empty($plpopups_close_css_a)){?>.box-plpopup<?php echo $plpopups_id; ?>_close a{
        <?php echo $plpopups_close_css_a; ?>
    }<?php }?>
    <?php echo $plpopups_css_global; ?>
    <?php if(!empty($plpopups_css_button)){?>.plopenbutton<?php echo $plpopups_id; ?>{
        <?php echo $plpopups_css_button; ?>
    }<?php }?>
    </style>
    <script>  
    setTimeout(function() {
    (function($) {  
    $(function() {  
    if (!$.cookie('<?php if ($plpopups_cookie_ip == true) {?><?php echo $plpopups_cookie_name; echo '_', $_SERVER["REMOTE_ADDR"]; ?><?php if ($dev_mode_plpopups == true) {?><?php echo '_', rand() ?><?php }?><?php }?><?php if ($plpopups_cookie_ip == false) {?><?php echo $plpopups_cookie_name; ?><?php if ($dev_mode_plpopups == true) {?><?php echo rand() ?><?php }?><?php }?>')) {  
    $('#boxUserFirstInfo<?php if ($openbutton_on_off_plpopups == true) {?><?php echo $plpopups_id; ?><?php }?><?php if ($openbutton_on_off_plpopups == false) {?><?php if ($on_off_plpopups_pop == 1) {?><?php echo $plpopups_id; ?><?php }?><?php if ($on_off_plpopups_pop != 1) {?><?php echo $plpopups_timeout; ?><?php echo $plpopups_id; ?><?php }?><?php }?>').plpopup({  
      closeOnOverlayClick: <?php if ($click_close_plpopups == true) {?>true<?php }?><?php if ($click_close_plpopups == false) {?>false<?php }?>,  
      closeOnEsc: <?php if ($esc_close_plpopups == true) {?>true<?php }?><?php if ($esc_close_plpopups == false) {?>false<?php }?>
    });  
    }  
    $.cookie('<?php if ($plpopups_cookie_ip == true) {?><?php echo $plpopups_cookie_name; echo '_', $_SERVER["REMOTE_ADDR"]; ?><?php }?><?php if ($plpopups_cookie_ip == false) {?><?php echo $plpopups_cookie_name; ?><?php }?>', true, {  
    expires: <?php echo $plpopups_cookie; ?>,  
    path: '/'  
    });  
    })  
    })(jQuery)  }, <?php if ($openbutton_on_off_plpopups == true) {?>no-popup<?php }?><?php if ($openbutton_on_off_plpopups == false) {?><?php if ($on_off_plpopups_pop == 1) {?>no-popup<?php }?><?php if ($on_off_plpopups_pop != 1) {?><?php if(empty($plpopups_timeout_one)){?><?php echo $plpopups_timeout; ?><?php } else  { ?><?php echo $plpopups_timeout_one; ?><?php }?>000<?php }?><?php }?>);
    </script>
    */
	
	if (!empty($plpopups)){
		?><div style="display: none;"><div class="box-plpopup" id="boxUserFirstInfo"><?php 
		if (!empty($plpopups_close_name)) { ?><div class="box-plpopup_close <?php if (!empty($plpopups_close_link)) { ?><?php } else { echo "plpopup-close"; } ?>"><?php if (!empty($plpopups_close_link)) { ?><a href="<?php echo $plpopups_close_link ?>"><?php }?><?php echo $plpopups_close_name; ?><?php if (!empty($plpopups_close_link)) { ?></a><?php }?></div><?php }
			?><div><?php echo $plpopups; 
		?></div></div></div><?php 
	}
}?>
