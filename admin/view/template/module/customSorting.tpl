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
                <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
                <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
            </div>
            <div class="content">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                    <label for="sortingFile"><span><?php echo $text_add_file; ?></span></label><input type="file" name="sortingFile" id="sortingFile">
                    <input type="hidden" name="MAX_FILE_SIZE" value="52428800" />
                </form>
            </div>
        </div>>
    </div>

<?php echo $footer; ?>