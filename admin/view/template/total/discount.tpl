<?php echo $header; ?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
<style>
    .form td
    {
        padding:10px;
        border:1px solid #ddd;
        text-align:center;
    }
    .form input,.form select
    {
        padding:5px;
    }
</style>
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
            <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
                <table class='form'>
                    <thead>
                        <tr>
                            <td><?= $entry_incentive_program;?></td>
                            <td><?= $entry_from_summ;?></td>
                            <td><?= $entry_to_summ;?></td>
                            <td><?= $entry_discount_value;?></td>
                            <td><?= $entry_discount_type;?></td>
                            <td><?= $entry_delete_discount;?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $len=count($discount_value);
                        for($i=0;$i<$len;$i++):
                        ?>
                        <tr>
                            <td>
                                <select class='form-control' name='discount_incentive_program[]'>
                                    <option value='accumulation' <?php if($discount_incentive_program[$i]=='accumulation') echo "selected='selected'";?>><?= $entry_incentive_program_accamulation;?></option>
                                    <option value='summ_current_order' <?php if($discount_incentive_program[$i]=='summ_current_order') echo "selected='selected'";?>><?= $entry_incentive_program_summ_current_order;?>
                                </option>
                            </select>
                        </td>
                        <td><input class='form-control' name='discount_from_summ[]' value='<?= $discount_from_summ[$i];?>'></td>
                        <td><input class='form-control' name='discount_to_summ[]' value='<?= $discount_to_summ[$i];?>'></td>
                        <td><input class='form-control' name='discount_value[]' value='<?= $discount_value[$i];?>'></td>
                        <td>
                            <select class='form-control' name='discount_type[]'>
                                <option value='precent' <?php if($discount_type[$i]=='precent') echo "selected='selected'";?>><?= $entry_discount_type_precent;?></option>
                                <option value='fixed_summ' <?php if($discount_type[$i]=='fixed_summ') echo "selected='selected'";?>><?= $entry_discount_type_fixed_summ;?>
                            </option>
                        </select>
                    </td>
                    <td><div  class='text-center' onclick="removeRow(this);"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div></td>
                </tr>

                <?php endfor;?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='5' class='text-center'><div onclick='addRow(this);'><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></div></td>
                </tr>
            </tfoot>
        </table>
        <table class='form'>
            <tr>
                <td><?php echo $entry_status; ?></td>
                <td><select name="discount_status">
                        <?php if ($discount_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td><?php echo $entry_exclude_ids; ?></td>
                <td><input type="text" name="discount_exclude_ids" value="<?php echo $discount_exclude_ids; ?>"  size="25" /></td>
            </tr>

           <tr>
                <td><?php echo $entry_exclude_promotional_items; ?></td>
                <td>
                    <input type="checkbox" name="discount_promotional_items" id="discount_promotional_items" class="form-control" 
                    <?php if($discount_promotional_items)
                        echo "checked";
                    ; ?>
                    />
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_sort_order; ?></td>
                <td><input type="text" name="discount_sort_order" value="<?php echo $discount_sort_order; ?>" size="1" /></td>
            </tr>
        </table>

    </form>
</div>
</div>
</div>
<?php echo $footer; ?> 



<script>
    function addRow(el)
    {
        $(el).parents('table').find('tbody').append("<tr><td><select class='form-control' name='discount_incentive_program[]'><option value='accumulation'><?= $entry_incentive_program_accamulation;?></option><option value='summ_current_order'><?= $entry_incentive_program_summ_current_order;?></option></select></td><td><input class='form-control' name='discount_from_summ[]'></td><td><input class='form-control' name='discount_to_summ[]' ></td><td><input class='form-control' name='discount_value[]'></td><td><select class='form-control' name='discount_type[]'><option value='precent'><?= $entry_discount_type_precent;?></option><option value='fixed_summ'><?= $entry_discount_type_fixed_summ;?></option></select></td><td><div  class='text-center' onclick='removeRow(this);'><i class='fa fa-times fa-2x' aria-hidden='true'></i></div></td></tr>");
        return false;
    }
    function removeRow(el)
    {
        $(el).parents('tr').remove();
        return false;

    }
</script>
<?php echo $footer; ?>



