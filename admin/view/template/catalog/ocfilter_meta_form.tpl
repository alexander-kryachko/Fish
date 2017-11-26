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
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div>
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_category; ?></td>
                <td>
                  <select name="category" id="category">
                    <option value="">Выбирите категорию</option>
                    <?php foreach ($categories as $key => $category) {
                      if (isset($category_id)){
                        if ($category_id == $category['category_id'])
                          echo "<option value='".$category['category_id']."' selected='selected'>".$category['name']."</option>";
                        else
                          echo "<option value='".$category['category_id']."'>".$category['name']."</option>";
                      }
                      else
                        echo "<option value='".$category['category_id']."'>".$category['name']."</option>";
                    } ?>
                  </select>
                  <?php if (isset($error_category)) { ?>
                  <span class="error"><?php echo $error_category; ?></span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_option; ?></td>
                <td>
                  <select name="option1" id="option1">
                    <option value="">Выберите значение опции фильтра</option>
                  </select>
                  <?php if (isset($error_option)) { ?>
                  <span class="error"><?php echo $error_option; ?></span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_option; ?></td>
                <td>
                  <select name="option2" id="option2">
                    <option value="">Выберите значение опции фильтра</option>
                  </select>
                  <?php if (isset($error_option)) { ?>
                  <span class="error"><?php echo $error_option; ?></span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_title; ?></td>
                <td><textarea name="meta_title" cols="40" rows="5"><?php echo isset($meta_title) ? $meta_title : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="meta_description" cols="40" rows="5"><?php echo isset($meta_description) ? $meta_description : ''; ?></textarea></td>
              </tr>
              <tr>
                <td>SEO H1</td>
                <td><input name="h1" size="100" value="<?php echo $h; ?>" />
                </td>
              </tr>
            <tr>
              <td>Описание сверху</td>
              <td><textarea name="text_top" id="dscr_top" size="100" /><?php echo $text_top; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>Описание снизу</td>
              <td><textarea name="text_bottom" id="dscr_foot" size="100" /><?php echo $text_bottom; ?></textarea>
              </td>
            </tr>
            </table>
          </div>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('dscr_top', {
  filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
CKEDITOR.replace('dscr_foot', {
  filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
  filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
  delay: 500,
  source: function(request, response) {   
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {
        json.unshift({
          'category_id':  0,
          'name':  '<?php echo $text_none; ?>'
        });
        
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.category_id
          }
        }));
      }
    });
  },
  select: function(event, ui) {
    $('input[name=\'path\']').val(ui.item.label);
    $('input[name=\'parent_id\']').val(ui.item.value);
    
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
});
//--></script> 
<script type="text/javascript"><!--
// Filter
$('input[name=\'filter\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.filter_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#category-filter' + ui.item.value).remove();
    
    $('#category-filter').append('<div id="category-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="category_filter[]" value="' + ui.item.value + '" /></div>');

    $('#category-filter div:odd').attr('class', 'odd');
    $('#category-filter div:even').attr('class', 'even');
        
    return false;
  },
  focus: function(event, ui) {
      return false;
   }
});

$('#category-filter div img').live('click', function() {
  $(this).parent().remove();
  
  $('#category-filter div:odd').attr('class', 'odd');
  $('#category-filter div:even').attr('class', 'even'); 
});
//--></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
  $('#dialog').remove();
  
  $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
  
  $('#dialog').dialog({
    title: '<?php echo $text_image_manager; ?>',
    close: function (event, ui) {
      if ($('#' + field).attr('value')) {
        $.ajax({
          url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
          dataType: 'text',
          success: function(data) {
            $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
          }
        });
      }
    },  
    bgiframe: false,
    width: 800,
    height: 400,
    resizable: false,
    modal: false
  });
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<script type="text/javascript">
  $(function(){
    $("#category").change(function(){
      var category_id = $(this).val();

      $.ajax({
        url: "index.php?route=catalog/ocfilter_meta/getOptions&token=<?php echo $token; ?>",
        type: "POST",
        async: false,
        dataType: "json",   
        data: {category_id : category_id},
        success: function(data){
          $("#option1").empty();
          $("#option2").empty();
          $("#option1").append('<option value="">Выберите значение опции фильтра</option>');
          $("#option2").append('<option value="">Выберите значение опции фильтра</option>');
            for (i=0;i<data.length;i++){
              val = data[i]['opt']+":"+data[i]['name'];
              $("#option1").append("<option value='"+data[i]['value_id']+"'>"+val+"</option>");
              $("#option2").append("<option value='"+data[i]['value_id']+"'>"+val+"</option>");
            }
        }
      });
    });
    //alert($("#category").val());
    if ($("#category").val() != ''){
      var category_id = $("#category").val();

      $.ajax({
        url: "index.php?route=catalog/ocfilter_meta/getOptions&token=<?php echo $token; ?>",
        type: "POST",
        async: false,
        dataType: "json",   
        data: {category_id : category_id},
        success: function(data){
          $("#option1").empty();
          $("#option2").empty();
          $("#option1").append('<option value="">Выберите значение опции фильтра</option>');
          $("#option2").append('<option value="">Выберите значение опции фильтра</option>');
            for (i=0;i<data.length;i++){
              val = data[i]['opt']+":"+data[i]['name'];
              if (data[i]['value_id'] == '<?php echo $option1; ?>')
                $("#option1").append("<option value='"+data[i]['value_id']+"' selected='selected'>"+val+"</option>");
              else
                $("#option1").append("<option value='"+data[i]['value_id']+"'>"+val+"</option>");

              if (data[i]['value_id'] == '<?php echo $option2; ?>')
                $("#option2").append("<option value='"+data[i]['value_id']+"' selected='selected'>"+val+"</option>");
              else
                $("#option2").append("<option value='"+data[i]['value_id']+"'>"+val+"</option>");
            }
        }
      });
    }
  })
</script>
<?php echo $footer; ?>