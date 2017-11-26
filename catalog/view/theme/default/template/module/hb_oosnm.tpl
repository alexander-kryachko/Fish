<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/magnific-popup.css"> 
<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/huntbee-popup.css">
<script src="catalog/view/theme/default/stylesheet/jquery.magnific-popup.min.js"></script>

<style type="text/css"><?php echo $hb_oosn_css;?></style>

<div id="notifyform" class="white-popup mfp-with-anim mfp-hide">
	<input type="hidden" id="pid" name="pid" value="">
	<div id="oosn_info_text"><?php echo $oosn_info_text; ?></div><div id="opt_info"></div><br />
    <table style="padding-top:5px; width:100%;">
		<?php if ($hb_oosn_name_enable == 'y') {?>
            <tr>
                <td><?php echo $oosn_text_name; ?></td>
                <td><input name="notifyname" type="text" id="notifyname" placeholder="<?php echo $oosn_text_name_plh; ?>" value="<?php echo $fname;?>" /></td>
            </tr>
		<?php } ?>
        <tr>
            <td><?php echo $oosn_text_email; ?></td>
            <td><input name="notifyemail" type="text" id="notifyemail" placeholder="<?php echo $oosn_text_email_plh; ?>" value="<?php echo $email;?>" /></td>
        </tr>
        <?php if ($hb_oosn_mobile_enable == 'y') {?>
        <tr>
            <td><?php echo $oosn_text_phone; ?></td>
            <td><input name="notifyphone" type="text" id="notifyphone" placeholder="<?php echo $oosn_text_phone_plh; ?>" value="<?php echo $phone;?>" /></td>
        </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td><button type="button" id="notify_btn" class="notify_button"><i class="fa fa-bell"></i> <?php echo $notify_button; ?></button></td>
        </tr>
        </table>
       <br>
	
	<div id='loadgif' style='display:none'><img src='catalog/view/theme/default/image/loading.gif'/></div>
	<div id="msgoosn"></div>
                        
</div><!--notifyform -->
                
<script type="text/javascript">
function notifypop(i){$("#pid").val(i),$("#msgoosn").html(""),$.magnificPopup.open({items:{src:"#notifyform"},type:"inline",removalDelay:800,midClick:!0,callbacks:{beforeOpen:function(){this.st.mainClass="<?php echo $hb_oosn_animation;?>"}}})}
</script>

<script type="text/javascript">
$("#notify_btn").click(function(){$("#msgoosn").html(""),$("#loadgif").show();var e=$("#notifyname").length?$("#notifyname").val():"",o=$("#notifyphone").length?$("#notifyphone").val():"";if($("#option_values").length)var t=$("#option_values").val(),n=$("#selected_option").val(),a=$("#all_selected_option").val();else var t=0,n=0,a=0;$.ajax({type:"post",url:"index.php?route=product/product_oosn",data:{data:$("#notifyemail").val(),name:e,phone:o,product_id:$("#pid").val(),selected_option_value:t,selected_option:n,all_selected_option:a},dataType:"json",success:function(e){e.success&&($("#msgoosn").html(e.success),$("#loadgif").hide())},error:function(e,o,t){alert(t+"\r\n"+e.statusText+"\r\n"+e.responseText)}})});
</script>
