<?php if ($on_off_plpopups == true) {?>
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
      

    <?php if (!empty($plpopups)){?>
    <div style="display: none;">  
        <div class="box-plpopup<?php echo $plpopups_id; ?>" id="boxUserFirstInfo<?php if ($openbutton_on_off_plpopups == true) {?><?php echo $plpopups_id; ?><?php }?><?php if ($openbutton_on_off_plpopups == false) {?><?php if ($on_off_plpopups_pop == 1) {?><?php echo $plpopups_id; ?><?php }?><?php if ($on_off_plpopups_pop != 1) {?><?php echo $plpopups_timeout; ?><?php echo $plpopups_id; ?><?php }?><?php }?>">  
            <?php if (!empty($plpopups_close_name)) { ?><div class="box-plpopup<?php echo $plpopups_id; ?>_close <?php if (!empty($plpopups_close_link)) { ?><?php } else { echo "plpopup-close"; } ?>"><?php if (!empty($plpopups_close_link)) { ?><a href="<?php echo $plpopups_close_link ?>"><?php }?><?php echo $plpopups_close_name; ?><?php if (!empty($plpopups_close_link)) { ?></a><?php }?></div><?php }?>
            <div><?php echo $plpopups; ?></div>
        </div>  
    </div> 
    <?php }?>
    
<script>
(function(d){var g={type:"html",content:"",url:"",ajax:{},ajax_request:null,closeOnEsc:!0,closeOnOverlayClick:!0,clone:!1,overlay:{block:void 0,tpl:'<div class="plpopup-overlay<?php echo $plpopups_id; ?>"></div>',css:{backgroundColor:"<?php echo $plpopups_opacity_color; ?>",opacity:<?php echo $plpopups_opacity; ?>}},container:{block:void 0,tpl:'<div class="plpopup-container<?php echo $plpopups_id; ?>"><table class="plpopup-container<?php echo $plpopups_id; ?>_i"><tr><td class="plpopup-container<?php echo $plpopups_id; ?>_i2"></td></tr></table></div>'},wrap:void 0,body:void 0,errors:{tpl:'<div class="plpopup-error<?php echo $plpopups_id; ?> plpopup-close"></div>',autoclose_delay:2E3,
ajax_unsuccessful_load:"Error"},openEffect:{type:"fade",speed:400},closeEffect:{type:"fade",speed:400},beforeOpen:d.noop,afterOpen:d.noop,beforeClose:d.noop,afterClose:d.noop,afterLoading:d.noop,afterLoadingOnShow:d.noop,errorLoading:d.noop},j=0,e=d([]),m={isEventOut:function(a,b){var c=!0;d(a).each(function(){d(b.target).get(0)==d(this).get(0)&&(c=!1);0==d(b.target).closest("HTML",d(this).get(0)).length&&(c=!1)});return c}},f={getParentEl:function(a){var b=d(a);return b.data("plpopup")?b:(b=
d(a).closest(".plpopup-container<?php echo $plpopups_id; ?>").data("plpopupParentEl"))?b:!1},transition:function(a,b,c,e){e=void 0==e?d.noop:e;switch(c.type){case "fade":"show"==b?a.fadeIn(c.speed,e):a.fadeOut(c.speed,e);break;case "none":"show"==b?a.show():a.hide(),e()}},prepare_body:function(a,b){d(".plpopup-close",a.body).unbind("click.plpopup").bind("click.plpopup",function(){b.plpopup("close");return!1})},init_el:function(a,b){var c=a.data("plpopup");if(!c){c=b;j++;c.modalID=j;c.overlay.block=
d(c.overlay.tpl);c.overlay.block.css(c.overlay.css);c.container.block=d(c.container.tpl);c.body=d(".plpopup-container<?php echo $plpopups_id; ?>_i2",c.container.block);b.clone?c.body.html(a.clone(!0)):(a.before('<div id="plpopupReserve'+c.modalID+'" style="display: none" />'),c.body.html(a));f.prepare_body(c,a);c.closeOnOverlayClick&&c.overlay.block.add(c.container.block).click(function(b){m.isEventOut(d(">*",c.body),b)&&a.plpopup("close")});c.container.block.data("plpopupParentEl",a);a.data("plpopup",c);
e=d.merge(e,a);d.proxy(h.show,a)();if("html"==c.type)return a;if(void 0!=c.ajax.beforeSend){var k=c.ajax.beforeSend;delete c.ajax.beforeSend}if(void 0!=c.ajax.success){var g=c.ajax.success;delete c.ajax.success}if(void 0!=c.ajax.error){var l=c.ajax.error;delete c.ajax.error}var n=d.extend(!0,{url:c.url,beforeSend:function(){void 0==k?c.body.html('<div class="plpopup-loading<?php echo $plpopups_id; ?>" />'):k(c,a)},success:function(b){a.trigger("afterLoading");c.afterLoading(c,a,b);void 0==g?c.body.html(b):g(c,a,b);f.prepare_body(c,
a);a.trigger("afterLoadingOnShow");c.afterLoadingOnShow(c,a,b)},error:function(){a.trigger("errorLoading");c.errorLoading(c,a);void 0==l?(c.body.html(c.errors.tpl),d(".plpopup-error<?php echo $plpopups_id; ?>",c.body).html(c.errors.ajax_unsuccessful_load),d(".plpopup-close",c.body).click(function(){a.plpopup("close");return!1}),c.errors.autoclose_delay&&setTimeout(function(){a.plpopup("close")},c.errors.autoclose_delay)):l(c,a)}},c.ajax);c.ajax_request=d.ajax(n);a.data("plpopup",c)}},init:function(a){a=
d.extend(!0,{},g,a);if(d.isFunction(this))if(void 0==a)d.error("jquery.plpopup: Uncorrect parameters");else if(""==a.type)d.error('jquery.plpopup: Don\'t set parameter "type"');else switch(a.type){case "html":if(""==a.content){d.error('jquery.plpopup: Don\'t set parameter "content"');break}var b=a.content;a.content="";return f.init_el(d(b),a);case "ajax":if(""==a.url){d.error('jquery.plpopup: Don\'t set parameter "url"');break}return f.init_el(d("<div />"),a)}else return this.each(function(){f.init_el(d(this),
d.extend(!0,{},a))})}},h={show:function(){var a=f.getParentEl(this);if(!1===a)d.error("jquery.plpopup: Uncorrect call");else{var b=a.data("plpopup");b.overlay.block.hide();b.container.block.hide();d("BODY").append(b.overlay.block);d("BODY").append(b.container.block);b.beforeOpen(b,a);a.trigger("beforeOpen");if("hidden"!=b.wrap.css("overflow")){b.wrap.data("plpopupOverflow",b.wrap.css("overflow"));var c=b.wrap.outerWidth(!0);b.wrap.css("overflow","hidden");var g=b.wrap.outerWidth(!0);g!=
c&&b.wrap.css("marginRight",g-c+"px")}e.not(a).each(function(){d(this).data("plpopup").overlay.block.hide()});f.transition(b.overlay.block,"show",1<e.length?{type:"none"}:b.openEffect);f.transition(b.container.block,"show",1<e.length?{type:"none"}:b.openEffect,function(){b.afterOpen(b,a);a.trigger("afterOpen")});return a}},close:function(){if(d.isFunction(this))e.each(function(){d(this).plpopup("close")});else return this.each(function(){var a=f.getParentEl(this);if(!1===a)d.error("jquery.plpopup: Uncorrect call");
else{var b=a.data("plpopup");!1!==b.beforeClose(b,a)&&(a.trigger("beforeClose"),e.not(a).last().each(function(){d(this).data("plpopup").overlay.block.show()}),f.transition(b.overlay.block,"hide",1<e.length?{type:"none"}:b.closeEffect),f.transition(b.container.block,"hide",1<e.length?{type:"none"}:b.closeEffect,function(){b.afterClose(b,a);a.trigger("afterClose");b.clone||d("#plpopupReserve"+b.modalID).replaceWith(b.body.find(">*"));b.overlay.block.remove();b.container.block.remove();a.data("plpopup",
null);d(".plpopup-container<?php echo $plpopups_id; ?>").length||(b.wrap.data("plpopupOverflow")&&b.wrap.css("overflow",b.wrap.data("plpopupOverflow")),b.wrap.css("marginRight",0))}),"ajax"==b.type&&b.ajax_request.abort(),e=e.not(a))}})},setDefault:function(a){d.extend(!0,g,a)}};d(function(){g.wrap=d(document.all&&!document.querySelector?"html":"body")});d(document).bind("keyup.plpopup",function(a){var b=e.last();b.length&&b.data("plpopup").closeOnEsc&&27===a.keyCode&&b.plpopup("close")});d.plpopup=
d.fn.plpopup=function(a){if(h[a])return h[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"===typeof a||!a)return f.init.apply(this,arguments);d.error("jquery.plpopup: Method "+a+" does not exist")}})(jQuery);
</script>
<script>
jQuery.cookie=function(b,j,m){if(typeof j!="undefined"){m=m||{};if(j===null){j="";m.expires=-1}var e="";if(m.expires&&(typeof m.expires=="number"||m.expires.toUTCString)){var f;if(typeof m.expires=="number"){f=new Date();f.setTime(f.getTime()+(m.expires*24*60*60*1000))}else{f=m.expires}e="; expires="+f.toUTCString()}var l=m.path?"; path="+(m.path):"";var g=m.domain?"; domain="+(m.domain):"";var a=m.secure?"; secure":"";document.cookie=[b,"=",encodeURIComponent(j),e,l,g,a].join("")}else{var d=null;if(document.cookie&&document.cookie!=""){var k=document.cookie.split(";");for(var h=0;h<k.length;h++){var c=jQuery.trim(k[h]);if(c.substring(0,b.length+1)==(b+"=")){d=decodeURIComponent(c.substring(b.length+1));break}}}return d}};
</script>
<?php }?>
