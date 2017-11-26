</div>
<script type="text/javascript"><!--
        $(document).ready(function() {
        $(".list tr:even").css("background-color", "#F4F4F8");
});
</script>
<div id="footer"><?php echo $text_footer; ?></div>

                <script type="text/javascript">
                    var startPosition = 130;
                    $(window).scroll(function() {
                       if($(window).scrollTop() > startPosition) {
                            width = $('.box div.heading').width();
                            height = $('.box div.heading').height();
                           $('.box div.heading').css('position', 'fixed').css('top',0).css('width',width).css('border-radius','0px').css('z-index','2');
                           $('.box div.content').css('margin-top', height+20);
                       } else {
                        $('.box div.heading').removeAttr('style');
                        $('.box div.content').removeAttr('style');
                       }
                    });
                </script>
            
</body></html>