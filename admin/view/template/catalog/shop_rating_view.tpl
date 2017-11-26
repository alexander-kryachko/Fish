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
            <h1><img src="view/image/review.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('form#form-shop_rate-answer').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
    <div class="content">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-eye"></i> <?php echo $heading_title.$rating['rate_id'];?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-shop_rate-answer">
                <div class="row">
                    <div class="col-md-6">
                        <table class="form">
                            <tbody>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $entry_status.':'; ?></td>
                                <td style="padding: 6px 8px;">
                                    <?php if($rating['rate_status'] == 1){ ?>
                                    <a id="change_status-<?php echo $rating['rate_id']?>" class="button enabled change_status_button"><i class="fa fa-check-circle fa-fw"></i><span><?php echo $status_published;?></span></a>
                                    <?php }else{ ?>
                                    <a id="change_status-<?php echo $rating['rate_id']?>" class="button remove change_status_button"><i class="fa fa-times-circle fa-fw"></i><span><?php echo $status_unpublished;?></span></a>
                                    <?php }?>

                                </td>
                            </tr>

                            <tr>
                                    <td class="text-right" width="30%"><?php echo $rating_date.':'; ?></td>
                                    <td>
                                        <div class="input-group date">
                                            <input name="rating_date_change" value="<?php echo date('d.m.Y H:i', strtotime($rating['date_added']));?>" class="datepicker" type="text" required>
                                        </div>
                                        <input type="hidden" name="old_rating_date" value="<?php echo date('d.m.Y H:i', strtotime($rating['date_added']));?>"">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%"><?php echo $rating_sender.':'; ?></td>
                                    <td><b class="<?php if(isset($rating['customer_id']) && $rating['customer_id'] != 0) echo 'text-success';?>"><?php echo $rating['customer_name']; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" width="30%"><?php echo $rating_sender_email.':'; ?></td>
                                    <td><?php echo $rating['customer_email']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" >
                        <table class="form">
                            <tbody>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $shop_rating.':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($rating['shop_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($rating['shop_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($rating['shop_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($rating['shop_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($rating['shop_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $site_rating.':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($rating['site_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($rating['site_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($rating['site_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($rating['site_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($rating['site_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php foreach($rating['customs'] as $custom){ ?>
                            <tr>
                                <td class="text-right" width="30%"><?php echo $custom['title'].':'; ?></td>
                                <td>
                                    <div class="rate-stars">
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                        <div class="rate-star big-stars <?php if($custom['value'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="form">
                            <tbody>
                            <tr>
                                <td class="text-center"><?php echo $comment; ?></td>
                                <td width="60%">
                                    <textarea id="new_rating_comment" name="new_rating_comment" style="width: 100%; height: 100px" disabled><?php echo html_entity_decode(nl2br($rating['comment']), ENT_QUOTES, 'UTF-8'); ?></textarea>
                                </td>
                                <td><a id="edit_rating_comment" class="button" style="margin-left: 20px"><?php echo $edit; ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="form">
                            <tbody>
                            <tr>
                                <td class="text-center text-success"><?php echo $good; ?></td>
                                <td width="60%">
                                    <textarea name="new_rating_good" id="new_rating_good" style="width: 100%; height: 100px" disabled><?php echo html_entity_decode($rating['good'], ENT_QUOTES, 'UTF-8');?></textarea>

                                </td>
                                <td><a id="edit_rating_good" class="button" style="margin-left: 20px"><?php echo $edit; ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="form">
                            <tr>
                                <td class="text-center text-danger"><?php echo $bad; ?></td>
                                <td  width="60%">
                                    <textarea name="new_rating_bad" id="new_rating_bad" style="width: 100%; height: 100px" disabled><?php echo html_entity_decode($rating['bad'], ENT_QUOTES, 'UTF-8');?></textarea>
                                </td>
                                <td><a id="edit_rating_bad" class="button" style="margin-left: 20px"><?php echo $edit; ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="form">
                            <tbody>
                            <tr>
                                <td class="text-center"><?php echo $answer; ?></td>
                                <td width="60%">

                                        <input type="hidden" name="answer_id" value="<?php if(isset($rating_answer['id']))echo $rating_answer['id']; ?>">
                                        <?php if(isset($rating_answer['comment'])){ ?>
                                            <textarea  name="answer" id="answer"  style="width: 100%; height: 100px" disabled><?php echo nl2br($rating_answer['comment']);?></textarea>
                                        <?php }else{ ?>
                                            <textarea name="answer" id="answer"  style="width: 100%; height: 100px" disabled></textarea>
                                        <?php } ?>

                                </td>
                                <td><a id="edit_rating_answer" class="button" style="margin-left: 20px"><?php echo $edit; ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datepicker({dateFormat: 'dd.mm.yy <?php echo date('H:i', strtotime($rating['date_added']));?>'});

/*
        $('#edit_comment_ok').click(function(){
            var new_comment = $('#new_rating_comment').val();
            var new_good = $('#new_rating_good').val();
            var new_bad = $('#new_rating_bad').val();
            $('#rating_comment').html(new_comment.replace(/\r\n|\r|\n/g,'<br />'));
            $('#rating_good').html(new_good.replace(/\r\n|\r|\n/g,'<br />'));
            $('#rating_bad').html(new_bad.replace(/\r\n|\r|\n/g,'<br />'));
            $('#editCommentModal').modal('hide');
        });
*/

        $('#edit_rating_comment').click(function(){
            $('textarea#new_rating_comment').removeAttr('disabled');
        });
        $('#edit_rating_answer').click(function(){
            $('textarea#answer').removeAttr('disabled');
        });
        $('#edit_rating_good').click(function(){
            $('textarea#new_rating_good').removeAttr('disabled');
        });
        $('#edit_rating_bad').click(function(){
            $('textarea#new_rating_bad').removeAttr('disabled');
        });
/*
        $('.input-group.date').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            timepicker: false,
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-calendar-check-o',
                clear: 'fa fa-trash-o',
                close: 'fa fa-close'
            }
        });
*/
        $('.change_status_button').click(function(){
            var rating_id = this.id.split('-')[1];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($change_status_url);?>';
            var status_publ = '<?php echo $status_published;?>';
            var status_unpubl = '<?php echo $status_unpublished;?>';

            $.post( url, { rate_id: rating_id }, function( data ) {
                        if(data == "OK"){
                            if(btn.hasClass('remove')){
                                btn.removeClass('remove');
                                btn.addClass('enabled');
                                btn.find('span').text(status_publ);

                            }else{
                                btn.removeClass('enabled');
                                btn.addClass('remove');
                                btn.find('span').text(status_unpubl);
                            }
                        }
                    }, "json");
        });
    });

</script>

<?php echo $footer; ?>