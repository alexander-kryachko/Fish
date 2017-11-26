<?php echo $header; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <div class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="heading">
                <h1><img src="view/image/setting.png" alt="" /> <?php echo $heading_title; ?></h1>
                <div class="buttons">
                    <a onclick="$('#form-shop_rate').submit();" class="button"><?php echo $button_save; ?></a>
                    <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
                </div>
            </div>
            <div class="content">
                <div id="tabs" class="htabs">
                    <a href="#tab-rates"><?php echo $rates_block_title; ?></a>
                    <a href="#tab-settings"><?php echo $settings_block_title; ?></a>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-rates">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-star"></i> <?php echo $rates_block_title;?></h3>
                            </div>
                            <div class="panel-body">

                                <table class="list">
                                    <thead>
                                        <tr>
                                            <td class="left"><?php echo $date ;?></td>
                                            <td class="left"><?php echo $name ;?></td>
                                            <td class="left" width="70px"><?php echo $shop ;?></td>
                                            <td class="left" width="70px"><?php echo $site ;?></td>
                                            <td class="left"><?php echo $comment ;?></td>
                                            <td class="left"><?php echo $good ;?></td>
                                            <td class="left"><?php echo $bad ;?></td>
                                            <td class="center">Статус</td>
                                            <td class="left"></td>
                                            <td class="left"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($ratings as $rating){ ?>

                                    <tr id="review_row-<?php echo $rating['rate_id']?>">
                                        <td class="center"><?php echo date('d.m.y H:i', strtotime($rating['date_added']));?></td>
                                        <td class="left">
                                            <div>
                                                <b class="<?php if(isset($rating['customer_id']) && $rating['customer_id'] != 0) echo 'text-primary';?>">
                                                    <?php echo $rating['customer_name'];?>
                                                </b>
                                                <?php if(isset($rating_answers[$rating['rate_id']])){ ?>
                                                <a class="button enabled" style="padding: 2px 5px; font-size: 10px;"><?php echo $answered; ?></a>
                                                <?php } ?>
                                            </div>
                                            <div class="rates_table_email"><?php echo $rating['customer_email'];?></div>
                                        </td>
                                        <td class=center">
                                            <div class="rate-stars">
                                                <div class="rate-star <?php if($rating['shop_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                                <div class="rate-star <?php if($rating['shop_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                                <div class="rate-star <?php if($rating['shop_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                                <div class="rate-star <?php if($rating['shop_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                                <div class="rate-star <?php if($rating['shop_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <div class="rate-stars">
                                                <div class="rate-star <?php if($rating['site_rate'] >= 1)echo 'star-change';?>" id="site_rate-1"></div>
                                                <div class="rate-star <?php if($rating['site_rate'] >= 2)echo 'star-change';?>" id="site_rate-2"></div>
                                                <div class="rate-star <?php if($rating['site_rate'] >= 3)echo 'star-change';?>" id="site_rate-3"></div>
                                                <div class="rate-star <?php if($rating['site_rate'] >= 4)echo 'star-change';?>" id="site_rate-4"></div>
                                                <div class="rate-star <?php if($rating['site_rate'] == 5)echo 'star-change';?>" id="site_rate-5"></div>
                                            </div>

                                        </td>
                                        <td class="left"><?php echo utf8_substr(strip_tags(html_entity_decode($rating['comment'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..' ;?></td>
                                        <td class="left text-success"><?php echo utf8_substr(strip_tags(html_entity_decode($rating['good'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..';?></td>
                                        <td class="left text-danger"><?php echo utf8_substr(strip_tags(html_entity_decode($rating['bad'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..';?></td>
                                        <td class="center">
                                            <?php if($rating['rate_status'] == 1){ ?>
                                            <a id="change_status-<?php echo $rating['rate_id']?>" class="button enabled change_status_button" style="height: 20px; border-radius: 50%;"></a>
                                            <?php }else{ ?>
                                            <a id="change_status-<?php echo $rating['rate_id']?>" class="button remove change_status_button" style="height: 20px; border-radius: 50%;"></a>
                                            <?php }?>
                                        </td>

                                        <td class="center">
                                            <a href="<?php echo $view_rate_link.'&rating_id=' . $rating['rate_id']?>" class="button">View</a>

                                        </td>
                                        <td>
                                            <a id="remove_review-<?php echo $rating['rate_id']?>"  class="button remove remove_review_btn">Remove</a>
                                        </td>


                                    </tr>
                                    <?php }?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div id="tab-settings">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-shop_rate" class="">
                                <table class="form">
                                    <tbody>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-moderate"><?php echo $entry_moderate; ?></label><br>
                                            <span class="help">(<?php echo $entry_moderate_desc; ?>)</span>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_moderate" value="1" <?php if ($shop_rating_moderate) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-authorized"><?php echo $entry_authorized; ?></label><br>
                                            <span class="help">(<?php echo $entry_authorized_desc; ?>)</span>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_authorized" value="1" <?php if ($shop_rating_authorized) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-shop_rating"><?php echo $entry_summary; ?></label><br>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_summary" value="1" <?php if ($shop_rating_summary) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-shop_rating"><?php echo $entry_shop_rating; ?></label><br>
                                            <span class="help">(<?php echo $entry_shop_rating_desc; ?>)</span>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_shop_rating" value="1" <?php if ($shop_rating_shop_rating) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-site_rating"><?php echo $entry_site_rating; ?></label><br>
                                            <span class="help">(<?php echo $entry_site_rating_desc; ?>)</span>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_site_rating" value="1" <?php if ($shop_rating_site_rating) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <label class="control-label" for="input-good_bad"><?php echo $entry_good_bad; ?></label>
                                        </td>
                                        <td>
                                            <input class="form-control" type="checkbox" name="shop_rating_good_bad" value="1" <?php if ($shop_rating_good_bad) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_status; ?></label></td>
                                        <td>
                                            <select name="shop_rating_status" id="input-status" class="form-control">
                                                <?php if ($shop_rating_status) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="shop_rating_installed" value="<?php echo $installed; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_email; ?></label></td>
                                        <td>
                                            <input type="text" class="form-control" name="shop_rating_email" value="<?php echo $shop_rating_email; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_notify; ?></label></td>
                                        <td>
                                            <input type="checkbox" class="form-control" name="shop_rating_notify" <?php if ($shop_rating_notify) echo 'checked'; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><label class="control-label" for="input-status"><?php echo $entry_count; ?></label></td>
                                        <td>
                                            <input type="text" class="form-control" name="shop_rating_count" value="<?php echo $shop_rating_count; ?>">
                                        </td>
                                    </tr>



                                    </tbody>
                                </table>
                                <h2>Дополнительные типы оценок</h2>
                                <table id="custom-types" class="form">
                                    <thead>
                                    <tr>
                                        <th width="200px">Заголовок</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-left" style="width: 200px">
                                            <input id="add-custom-type-input" type="text" class="form-control" style="width: 100%">
                                        </td>
                                        <td>
                                            <a id="add-custom-type" class="button">Add type</a>
                                        </td>
                                    </tr>
                                    <?php foreach($custom_types as $type) { ?>
                                    <tr id="custom-tr-<?php echo $type['id']; ?>">
                                        <td class="text-left">
                                            <input id="custom-type-input-<?php echo $type['id']; ?>" type="text" class="form-control" value="<?php echo $type['title']; ?>" style="width: 100%">
                                        </td>
                                        <td>
                                            <a id="custom-change-status-<?php echo $type['id']; ?>" class="button custom-change-status <?php if($type['status'] == '1') {echo 'enabled';}else{echo 'disabled';} ?>"><?php if($type['status'] == '1') {echo 'Enabled';}else{echo 'Disabled';} ?></a>
                                            <a id="custom-remove-<?php echo $type['id']; ?>" class="button custom-remove remove">Remove</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <h2>Запрос на отзыв</h2>

                           <table class="form">
                                        <tbody>
                                        <tr>
                                            <td class="text-right"><label class="control-label" for="input-shop_rating_request_status"><?php echo $entry_request_mail_status; ?></label></td>
                                            <td>
                                                <select name="shop_rating_request_status" id="input-shop_rating_request_status" class="form-control">

                                                    <?php if ($shop_rating_request_status == 0) { ?>
                                                    <option value="0" selected="selected"><?php echo $text_disabled_not_sent; ?></option>
                                                    <?php } else { ?>
                                                    <option value="0"><?php echo $text_disabled_not_sent; ?></option>
                                                    <?php } ?>

                                                    <?php foreach ($order_statuses as $order_status) { ?>
                                                    <?php if ($order_status['order_status_id'] == $shop_rating_request_status) { ?>
                                                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                <label class="control-label" for="input-status"><?php echo $entry_request_subject; ?></label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="shop_rating_request_subject" value="<?php echo $shop_rating_request_subject; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" style="width: 250px">
                                                <label class="control-label"><?php echo $tokens_label; ?></label>
                                                <p>[store_name] - <?php echo $store_name; ?></p>
                                                <p>[store_name_link] - <?php echo $store_name_link; ?></p>
                                                <p>[customer_name] - <?php echo $customer_name; ?></p>
                                                <p>[ratings_link] - <?php echo $ratings_link; ?></p>
                                                <div style="margin-top: 30px"><i>(<?php echo $tokens_desc; ?>)</i></div>
                                            </td>
                                            <td colspan="">
                                                <textarea name="shop_rating_request_text" id="input-shop_rating_request_text" class="form-control">
                                                    <?php if($shop_rating_request_text){echo $shop_rating_request_text; } ?>
                                                </textarea>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                        </form>

                    </div>
                </div>

            </div>
        </div>






        <!---------------------------->

        <div class="container-fluid">
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
    </div>
</div>
    <script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
    <script type="text/javascript"><!--
            CKEDITOR.replace('shop_rating_request_text', {
            });
        //--></script>

    <script type="text/javascript">
    $(document).ready(function(){

        $('#add-custom-type').click(function(){
            var type_title = $('#add-custom-type-input');
            if(type_title.val()){
                var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                $.post( url, { action: 'create', new_custom_title: type_title.val() }, function( data ) {
                    if(data){
                        var params = {
                            id: data['id'],
                            title: data['title']
                        };
                        createRow(params);

                    }
                }, "json");
                function createRow(params){
                    var new_row = '<tr id="custom-tr-'+params.id+'">';
                    new_row += '<td>';
                    new_row += '<input id="custom-type-input-'+params.id+'" type="text" value="'+params.title+'" style="width:100%">';
                    new_row += '</td>';
                    new_row += '<td>';
                    var change = "changeCustomStatus('"+params.id+"')";
                    new_row += '<a id="custom-change-status-'+params.id+'" onClick="'+change+'" class="button custom-change-status disabled">Disabled</a>';
                    var remove = "removeCustom('"+params.id+"')";

                    new_row += '<a id="custom-remove-'+params.id+'" onClick="'+remove+'" class="button custom-remove remove">Remove</a>';
                    new_row += '</td>';
                    new_row += '</tr>';

                    $('#custom-types').find('tbody').append(new_row);
                }
                type_title.val('');
            }
        });
        $('#custom-types').find('.custom-change-status').click(function(){
            var id = this.id.split('-')[3];
            changeCustomStatus(id)
        });
        $('#custom-types').find('.custom-remove').click(function(){
            var id = this.id.split('-')[2];
            var btn = $(this);
            removeCustom(id);
        });



        $('.change_status_button').click(function(){
            var rating_id = this.id.split('-')[1];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($change_status);?>';


            $.post( url, { rate_id: rating_id }, function( data ) {
                        if(data == "OK"){
                            if(btn.hasClass('enabled')){
                                btn.removeClass('enabled');
                                btn.addClass('remove');
                            }else{
                                btn.removeClass('remove');
                                btn.addClass('enabled');
                            }
                        }
                    }, "json");
        });
        $('.remove_review_btn').click(function(){
            var rating_id = this.id.split('-')[1];
            var btn = $(this);
            var url = '<?php echo htmlspecialchars_decode($remove_review);?>';


            $.post( url, { rate_id: rating_id }, function( data ) {
                if(data.success == "success"){
                    $('tr#review_row-'+data.rate_id).remove();
                }
            }, "json");
        });


        $('#add-custom-type1').click(function(){
            var type_title = $('#add-custom-type-input');
            if(type_title.val()){
                var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                $.post( url, { action: 'create', new_custom_title: type_title.val() }, function( data ) {
                    if(data){
                        var params = {
                            id: data['id'],
                            title: data['title']
                        };
                        createRow(params);

                    }
                }, "json");
                function createRow(params){
                    $('#custom-types').find('tbody').append(
                            $('<tr/>', {
                                id: 'custom-tr-'+params.id
                            }).append([
                                $('<td/>').append(
                                        $('<input>', {
                                            id: 'custom-type-input-t'+params.id,
                                            type:'text',
                                            class: 'form-control',
                                            value: params.title,
                                            keypress: function(){
                                                //$('#custom-change-remove').addClass('hidden');
                                                //$('#custom-change-save').removeClass('hidden');
                                            }
                                        })
                                ),
                                $('<td/>').append([
                                    $('<a/>', {
                                        id: 'custom-change-status-'+params.id,
                                        class: 'btn btn-default pull-left custom-change-status',
                                        title: 'Disabled',
                                        click: function(){
                                            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                                            $.post( url, { action: 'status', custom_id: +params.id }, function( data ) {
                                                if(data['status'] == 'success'){
                                                    var btn = $('#custom-change-status-'+data['id']);
                                                    if(btn.hasClass('btn-info')){
                                                        btn.removeClass('btn-info');
                                                        btn.addClass('btn-default');
                                                    }else{
                                                        btn.removeClass('btn-default');
                                                        btn.addClass('btn-info');
                                                    }
                                                }
                                            }, "json");

                                        }
                                    }).append(
                                            $('<i/>',{class: 'fa fa-power-off'})
                                    ),
                                    $('<a/>', {
                                        id: 'custom-remove-'+params.id,
                                        class: 'btn btn-danger pull-right custom-remove',
                                        title: 'Remove',
                                        click: function(){
                                            var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
                                            $.post( url, { action: 'remove', custom_id: +params.id }, function( data ) {
                                                if(data['status'] == 'success'){
                                                    if (confirm("<?php echo $remove_custom_type;?>"))
                                                    {
                                                        $('tr#custom-tr-'+params.id).remove();
                                                    }
                                                }
                                            }, "json");
                                        }

                                    }).append(
                                            $('<i/>',{class: 'fa fa-trash'})
                                    )
                                ])
                            ])
                    );

                }
                type_title.val('');
            }
        });
    });
    function changeCustomStatus(id){
        var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
        $.post( url, { action: 'status', custom_id: id }, function( data ) {
            if(data['status'] == 'success'){
                var btn = $('#custom-change-status-'+data['id']);
                if(btn.hasClass('enabled')){
                    btn.removeClass('enabled');
                    btn.addClass('disabled');
                }else{
                    btn.removeClass('disabled');
                    btn.addClass('enabled');
                }
            }
        }, "json");

    }
    function removeCustom(id){
        var url = '<?php echo htmlspecialchars_decode($create_custom_type_url);?>';
        $.post( url, { action: 'remove', custom_id: +id }, function( data ) {
            if(data['status'] == 'success'){
                if (confirm("<?php echo $remove_custom_type;?>"))
                {
                    $('tr#custom-tr-'+id).remove();
                }
            }
        }, "json");
    }

</script>

    <script type="text/javascript"><!--
                    $('#tabs a').tabs();
    //--></script>
<?php echo $footer; ?>