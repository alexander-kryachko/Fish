<script type="text/javascript">
function addSeoUrl(){
var name = document.getElementById("category_description[1][name]").value;
var transl=new Array();
    transl['А']='a';    transl['а']='a';
    transl['Б']='b';    transl['б']='b';
    transl['В']='v';    transl['в']='v';
    transl['Г']='g';    transl['г']='g';
    transl['Д']='d';    transl['д']='d';
    transl['Е']='e';    transl['е']='e';
    transl['Ё']='yo';   transl['ё']='yo';
    transl['Ж']='zh';   transl['ж']='zh';
    transl['З']='z';    transl['з']='z';
    transl['И']='i';    transl['и']='i';
    transl['Й']='j';    transl['й']='j';
    transl['К']='k';    transl['к']='k';
    transl['Л']='l';    transl['л']='l';
    transl['М']='m';    transl['м']='m';
    transl['Н']='n';    transl['н']='n';
    transl['О']='o';    transl['о']='o';
    transl['П']='p';    transl['п']='p';
    transl['Р']='r';    transl['р']='r';
    transl['С']='s';    transl['с']='s';
    transl['Т']='t';    transl['т']='t';
    transl['У']='u';    transl['у']='u';
    transl['Ф']='f';    transl['ф']='f';
    transl['Х']='h';    transl['х']='h';
    transl['Ц']='c';    transl['ц']='c';
    transl['Ч']='ch';   transl['ч']='ch';
    transl['Ш']='sh';   transl['ш']='sh';
    transl['Щ']='shh';  transl['щ']='shh';
    transl['Ъ']='"';    transl['ъ']='';
    transl['Ы']='y';    transl['ы']='y';
    transl['Ь']='';     transl['ь']='';
    transl['Э']='e';    transl['э']='e';
    transl['Ю']='yu';   transl['ю']='yu';
    transl['Я']='ya';   transl['я']='ya';
    transl['і']='i';    transl['1']='1';
    transl['2']='2';    transl['3']='3';
    transl['4']='4';    transl['5']='5';
    transl['6']='6';    transl['7']='7';
    transl['8']='8';    transl['9']='9';
    transl['!']='';     transl['+']='+';
    transl['@']='';     transl['#']='';
    transl['$']='';     transl['%']='';
    transl['^']='';     transl['&']='';
    transl['*']='';     transl['(']='-';
    transl[')']='-';    transl['-']='-';
    transl['"']='';     transl['`']='';
    transl[';']='-';    transl[':']='-';
    transl['?']='';     transl[',']='_';
    transl['_']='_';    transl['+']='_';
    transl['=']='_';    transl['<']='-';
    transl['>']='-';    transl['.']='_';
    transl['{']='-';    transl['}']='-';
    transl['|']='-';    transl['/']='-';
    transl['[']='-';    transl[']']='-';
    transl[' ']='-';    transl['\\']='-';
    transl[' - ']='-';

    var result='';
    for(i=0;i<name.length;i++) {
        if(transl[name[i]]!=undefined) { result+=transl[name[i]]; }
        else { result+=name[i]; }
    }

var jArray= <?php
$query = $this->db->query("SELECT `keyword` FROM " . DB_PREFIX . "url_alias");
        $keywords = array();

        foreach ($query->rows as $row) {
                    $keywords[] = $row['keyword'];
                }
$sizeArr= sizeof($keywords);
  echo json_encode($keywords ); ?>;

var sizeArr = <?php $query = $this->db->query("SELECT `keyword` FROM " . DB_PREFIX . "url_alias");
        $keywords = array();
        foreach ($query->rows as $row) {
                    $keywords[] = $row['keyword'];
                }
$sizeArr=sizeof($keywords);
echo sizeof($keywords);
?>;
var flag = 0;
    var point = 1;
    var point_t = 1;
    var str2 = result;
    while(flag==0){
        flag=1;
            for(var i=0;i<sizeArr;i++){
                if(point!=1){
                    str2=result+point;
                    }
                        if((jArray[i].toString())==(str2.toString())){
                            point = point+1;
                            flag = 0;
                        }
                    }
                }

if(point!=1){

    document.getElementById("keyword").value = result+point;
    }else{

    document.getElementById("keyword").value = result;
    }


}
</script>

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

		<div id="tabs" class="htabs">
			<a href="#tab-general"><?php echo $tab_general; ?></a>
			<a href="#tab-filters"><?php echo $tab_filters; ?></a>
			<a href="#tab-data"><?php echo $tab_data; ?></a>
			<a href="#tab-attributes"><?php echo $tab_attributes; ?></a>
			<a href="#tab-design"><?php echo $tab_design; ?></a>
		</div>

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>

                 <td><input type="text" id="category_description[<?php echo $language['language_id']; ?>][name]"  onchange="addSeoUrl()" name="category_description[<?php echo $language['language_id']; ?>][name]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['name'] : ''; ?>" />

                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_seo_h1; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][seo_h1]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['seo_h1'] : ''; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_seo_title; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][seo_title]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['seo_title'] : ''; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_keyword; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][meta_keyword]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_keyword'] : ''; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="category_description[<?php echo $language['language_id']; ?>][meta_description]" cols="100" rows="2"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="category_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
		<div id="tab-filters">
			<?/*
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
		  */?>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><?php echo $entry_seo_h1; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][filter_h1]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['filter_h1'] : ''; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_seo_title; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][filter_title]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['filter_title'] : ''; ?>" /></td>
              </tr>
              <?/*<tr>
                <td><?php echo $entry_meta_keyword; ?></td>
                <td><input type="text" name="category_description[<?php echo $language['language_id']; ?>][meta_keyword]" maxlength="255" size="100" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_keyword'] : ''; ?>" /></td>
              </tr>*/?>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="category_description[<?php echo $language['language_id']; ?>][filter_description]" cols="100" rows="2"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['filter_description'] : ''; ?></textarea></td>
              </tr>
              <?/*<tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="category_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>*/?>
            </table>
          </div>
          <?php } ?>
		</div>
        <div id="tab-data">
          <table class="form">
            <tr>
              <td><?php echo $entry_parent; ?></td>
              <td><select name="parent_id">
                <option value="0" selected="selected"><?php echo $text_none; ?></option>
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['category_id'] == $parent_id) { ?>
                <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_filter; ?></td>
              <td><input type="text" name="filter" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="category-filter" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($category_filters as $category_filter) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="category-filter<?php echo $category_filter['filter_id']; ?>" class="<?php echo $class; ?>"><?php echo $category_filter['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="category_filter[]" value="<?php echo $category_filter['filter_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $category_store)) { ?>
                    <input type="checkbox" name="category_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="category_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $category_store)) { ?>
                    <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_keyword; ?></td>

                 <td><input id="keyword" type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>

            </tr>
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');$('#image_url').val('');"><?php echo $text_clear; ?></a></div><br>Url: <input type="text" name="image_url" value="<?php echo $image; ?>" id="image_url" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_icon; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $icon_thumb; ?>" alt="" id="icon_thumb" />
                  <input type="hidden" name="menu_icon" value="<?php echo $menu_icon; ?>" id="menu_icon" />
                  <br />
                  <a onclick="image_upload('menu_icon', 'icon_thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#icon_thumb').attr('src', '<?php echo $no_image; ?>'); $('#menu_icon').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
            <tr>
              <td><?php echo $entry_top; ?></td>
              <td><?php if ($top) { ?>
                <input type="checkbox" name="top" value="1" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="top" value="1" />
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_column; ?></td>
              <td><input type="text" name="column" value="<?php echo $column; ?>" size="1" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </table>
        </div>

        <div id="tab-attributes">
          <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'attribute_category_attributes\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo $column_attribute; ?></td>
              <td class="left"><?php echo $column_series; ?></td>
              <td class="left"><?php echo $column_attribute_group; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($attributes) { ?>
              <?php foreach ($attributes as $attribute) {
                    $checked_series = '';
                    foreach($attribute['attributes_series'] as $key=>$value){
                        if($key == $attribute['attribute_id']){
                            $checked_series = "checked='checked'";
                        }
                    }
                    ?>
              <tr>
                <td style="text-align: center;">
                  <input type="checkbox" class="attr_check" name="attribute_category_attributes[<?php echo $attribute['attribute_id'];?>]" value="1" <?php echo $attribute['checked'];?> />
                <td class="left"><?php echo $attribute['name']; ?></td>
                <td class="left"><input class="attr_series" type="checkbox" name="attribute_category_attributes_series[<?php echo $attribute['attribute_id'];?>]" value="1" <?php echo $checked_series;?> /></td>
                <td class="left"><?php echo $attribute['attribute_group']; ?></td>
              </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>

        <div id="tab-design">
          <table class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_store; ?></td>
                <td class="left"><?php echo $entry_layout; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $text_default; ?></td>
                <td class="left"><select name="category_layout[0][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($category_layout[0]) && $category_layout[0] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            </tbody>
            <?php foreach ($stores as $store) { ?>
            <tbody>
              <tr>
                <td class="left"><?php echo $store['name']; ?></td>
                <td class="left"><select name="category_layout[<?php echo $store['store_id']; ?>][layout_id]">
                    <option value=""></option>
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if (isset($category_layout[$store['store_id']]) && $category_layout[$store['store_id']] == $layout['layout_id']) { ?>
                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
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

    $('.attr_series').on('change', function(){
        if($(this).attr("checked") == 'checked'){
            $(this).parent().parent().find('.attr_check').attr('checked', 'checked');
        }
    })
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
$('#image_url').val('');
                    }
                });
            }
        },
        bgiframe: false,
        width: <?php echo $this->config->get('pim_width')?$this->config->get('pim_width'):800;?>,
        height: <?php echo $this->config->get('pim_height')?$this->config->get('pim_height'):400;?>,
        resizable: false,
        modal: false
    });
};
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs();
$('#languages a').tabs();
//--></script>
<?php echo $footer; ?>
