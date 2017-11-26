<?php echo $header; ?>

<style type="text/css">
#table tbody tr td {
	background-color: #FFF !important;
}

#table tbody tr:nth-child(2n) td {
	background-color: #F9F9F9 !important;
}

#table tbody tr:hover td {
	background-color: #E4EEF7 !important;
}

#table tbody tr td.drag:hover {
	cursor: move;
	background: url(view/batch_editor/image/arrow_up_down.png) center center no-repeat !important;
}

#table tbody tr td.border_left, #table thead tr td.border_left {
	border-left: 2px solid #CCC;
}
</style>
<div id="content">
 <div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?> <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
 </div>
 <?php if ($warning) { ?>
 <div class="warning">
  <?php echo $warning; ?>
 </div>
 <?php } ?>
 <div class="box">
  <div class="heading">
   <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons">
    <a class="button" onclick="$('#form_setting').submit();"><?php echo $button_save; ?></a>
    <a class="button" onclick="location = '<?php echo $url_cancel; ?>';"><?php echo $button_cancel; ?></a>
   </div>
  </div>
  <div class="content">
   <form id="form_setting" action="<?php echo $url_action; ?>" method="post">
    <div id="tab-setting" class="htabs">
     <a href="#tab-field"><?php echo $tab_general; ?></a>
     <a href="#tab-link"><?php echo $tab_link; ?></a>
     <a href="#tab-filter"><?php echo $tab_filter; ?></a>
     <a href="#tab-multilanguage"><?php echo $text_language; ?> (<?php echo $text_variables; ?>)</a>
     <a href="#tab-option"><?php echo $tab_option; ?></a>
     <a href="#tab-support"><span style="color:green;">Support</span></a>
    </div>
    <div id="tab-field">
     <table id="table" class="be-list">
      <thead>
       <tr>
        <td class="center" width="20" rowspan="3"><img src="view/batch_editor/image/arrow_up_down.png" alt="" title="" style="vertical-align:middle;" /></td>
        <td class="center border_left" colspan="3"><?php echo $text_visible; ?></td>
        <td class="center border_left" colspan="2"><?php echo $text_seo_generator; ?></td>
        <td class="center border_left" colspan="2"><?php echo $text_search_replace; ?></td>
        <td class="center border_left"><?php echo $text_rounding_numbers; ?></td>
        <td class="center border_left"><?php echo $text_image_google; ?></td>
        <td class="center border_left" width="1%" rowspan="3"></td>
        <td class="left" width="1%" rowspan="3"><?php echo $text_field; ?></td>
        <td class="left" width="1%" rowspan="3"><?php echo $text_type; ?></td>
        <td class="left" width="1%" rowspan="3"><?php echo $text_size; ?></td>
        <td class="left" rowspan="3"><?php echo $text_name; ?></td>
       </tr>
       <tr>
        <td class="center border_left" width="80"><?php echo $tab_filter; ?>
         <span class="be-help">[<?php echo $text_tab; ?>]</span></td>
        <td class="center" width="80"><?php echo $tab_general; ?>
         <span class="be-help">[<?php echo $text_tab; ?>]</span></td>
        <td class="center" width="80"><?php echo $text_product; ?>
         <span class="be-help">[<?php echo $text_list; ?>]</span></td>
        <td class="center border_left" width="80"><?php echo $text_data; ?></td>
        <td class="center" width="80"><?php echo $text_apply_to; ?>:</td>
        <td class="center border_left" width="80"><?php echo $text_data; ?></td>
        <td class="center" width="80"><?php echo $text_apply_to; ?>:</td>
        <td class="center border_left" width="80"><?php echo $text_apply_to; ?>:</td>
        <td class="center border_left" width="80"><?php echo $text_keyword; ?></td>
       </tr>
       <tr>
        <td class="center border_left"><input type="checkbox" onclick="$('#tab-field input[name*=\'[enable][filter]\']').prop('checked', this.checked);" /></td>
        <td class="center"><input type="checkbox" onclick="$('#tab-field input[name*=\'[enable][main]\']').prop('checked', this.checked);" /></td>
        <td class="center"><input type="checkbox" onclick="$('#tab-field input[name*=\'[enable][product]\']').prop('checked', this.checked);" /></td>
        <td class="center border_left"><input type="checkbox" onclick="$('#tab-field input[name=\'seo_generator[field][]\']').prop('checked', this.checked);" /></td>
        <td class="center"><input type="checkbox" onclick="$('#tab-field input[name=\'seo_generator[apply_to][]\']').prop('checked', this.checked);" /></td>
        <td class="center border_left"><input type="checkbox" onclick="$('#tab-field input[name=\'search_replace[field][]\']').prop('checked', this.checked);" /></td>
        <td class="center"><input type="checkbox" onclick="$('#tab-field input[name=\'search_replace[apply_to][]\']').prop('checked', this.checked);" /></td>
        <td class="center border_left"><input type="checkbox" onclick="$('#tab-field input[name=\'rounding_numbers[apply_to][]\']').prop('checked', this.checked);" /></td>
        <td class="center border_left"><input type="checkbox" onclick="$('#tab-field input[name=\'image_google[keyword][]\']').prop('checked', this.checked);" /></td>
       </tr>
      </thead>
      <tbody>
       <!--<?php foreach ($table as $field => $parameter) { ?>-->
       <tr>
        <td class="drag"></td>
        <td class="center border_left"><?php if (isset ($parameter['enable']['filter'])) { ?>
         <input name="table[<?php echo $field; ?>][enable][filter]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="table[<?php echo $field; ?>][enable][filter]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="center"><?php if (isset ($parameter['enable']['main'])) { ?>
         <input name="table[<?php echo $field; ?>][enable][main]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="table[<?php echo $field; ?>][enable][main]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="center"><?php if ($field == 'description') { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } else { ?>
         <?php if ($field == 'name') { ?>
         <input type="checkbox" disabled="disabled" checked="checked" />
         <?php } else { ?>
         <?php if (isset ($parameter['enable']['product'])) { ?>
         <input name="table[<?php echo $field; ?>][enable][product]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="table[<?php echo $field; ?>][enable][product]" type="checkbox" value="1" />
         <?php } ?>
         <?php } ?>
         <?php } ?></td>
        <td class="center border_left"><?php if (in_array ($field, $seo_generator['field'])) { ?>
         <input name="seo_generator[field][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="seo_generator[field][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?></td>
        <td class="center"><?php if ($parameter['type'] == 'char' || $parameter['type'] == 'varchar' || $parameter['type'] == 'text' || $parameter['type'] == 'longtext') { ?>
         <?php if (in_array ($field, $seo_generator['apply_to'])) { ?>
         <input name="seo_generator[apply_to][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="seo_generator[apply_to][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?>
         <?php } else { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } ?></td>
        <td class="center border_left"><?php if (in_array ($field, $search_replace['field'])) { ?>
         <input name="search_replace[field][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="search_replace[field][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?></td>
        <td class="center"><?php if ($parameter['type'] == 'char' || $parameter['type'] == 'varchar' || $parameter['type'] == 'text') { ?>
         <?php if (in_array ($field, $search_replace['apply_to'])) { ?>
         <input name="search_replace[apply_to][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="search_replace[apply_to][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?>
         <?php } else { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } ?></td>
        <td class="center border_left"><?php if (!preg_match ('/_id$/', $field) && ($parameter['type'] == 'int' || $parameter['type'] == 'decimal')) { ?>
         <?php if (in_array ($field, $rounding_numbers['apply_to'])) { ?>
         <input name="rounding_numbers[apply_to][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="rounding_numbers[apply_to][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?>
         <?php } else { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } ?></td>
        <td class="center border_left"><?php if ($field != 'url_alias' && ($parameter['type'] == 'char' || $parameter['type'] == 'varchar')) { ?>
         <?php if (in_array ($field, $image_google['keyword'])) { ?>
         <input name="image_google[keyword][]" type="checkbox" value="<?php echo $field; ?>" checked="checked" />
         <?php } else { ?>
         <input name="image_google[keyword][]" type="checkbox" value="<?php echo $field; ?>" />
         <?php } ?>
         <?php } else { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } ?></td>
        <td class="center border_left"><?php if ($parameter['table'] == 'pd' || $parameter['table'] == 'pt') { ?>
         <img src="view/batch_editor/image/language.png" alt="<?php echo $text_multilanguage; ?>" title="<?php echo $text_multilanguage; ?>" style="vertical-align:middle; margin:-3px;" />
         <?php } ?></td>
        <td class="left"><b><?php echo $field; ?></b></td>
        <td class="left"><?php echo $parameter['type']; ?>
         <input name="table[<?php echo $field; ?>][type]" type="hidden" value="<?php echo $parameter['type']; ?>" />
         <input name="table[<?php echo $field; ?>][table]" type="hidden" value="<?php echo $parameter['table']; ?>" />
         <?php if (isset ($parameter['calc'])) { ?>
         <input name="table[<?php echo $field; ?>][calc]" type="hidden" value="1" />
         <?php } ?></td>
        <td class="center"><?php if (isset ($parameter['size'])) { ?>
         <?php echo $parameter['size']; ?>
         <input name="table[<?php echo $field; ?>][size]" type="hidden" value="<?php echo $parameter['size']; ?>" />
         <?php } ?>
         <?php if (isset ($parameter['size_2'])) { ?>
         <?php echo ' , ' . $parameter['size_2']; ?>
         <input name="table[<?php echo $field; ?>][size_2]" type="hidden" value="<?php echo $parameter['size_2']; ?>" />
         <?php } ?></td>
        <td class="left"><?php if (is_array ($parameter['text'])) { ?>
         <?php foreach ($languages as $code => $language) { ?>
         <?php if (isset ($parameter['text'][$code])) { ?>
         <input name="table[<?php echo $field; ?>][text][<?php echo $code; ?>]" type="text" value="<?php echo $parameter['text'][$code]; ?>" />
         <?php } else { ?>
         <input name="table[<?php echo $field; ?>][text][<?php echo $code; ?>]" type="text" value="" />
         <?php } ?>
         <img src="view/image/flags/<?php echo $language['image']; ?>" />
         &nbsp;&nbsp;
         <?php } ?>
         <?php } else { ?>
         <?php echo $parameter['text']; ?>
         <?php } ?></td>
       </tr>
       <!--<?php } ?>-->
      </tbody>
     </table>
    </div>
    <div id="tab-link">
     <table class="be-list">
      <thead>
       <tr>
        <td class="center" colspan="3"><?php echo $text_visible; ?></td>
        <td class="left" width="10%" rowspan="2"><?php echo $text_name; ?></td>
        <td class="left" rowspan="2"><?php echo $text_description; ?></td>
        <td class="left" width="1%" rowspan="2"></td>
       </tr>
       <tr>
        <td class="center" width="80"><?php echo $text_filter; ?>
         <span class="be-help">[<?php echo $text_tab; ?>]</span></td>
        <td class="center" width="80"><?php echo $text_link; ?>
         <span class="be-help">[<?php echo $text_tab; ?>]</span></td>
        <td class="center" width="80"><?php echo $text_product; ?>
         <span class="be-help">[<?php echo $text_list; ?>]</span></td>
       </tr>
      </thead>
      <?php foreach ($setting['link'] as $link => $parameter) { ?>
      <tbody>
       <tr>
        <td class="center"><?php if ($link == 'ocfilter' && $link == 'description') { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } else { ?>
         <?php if (isset ($parameter['enable']['filter'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][filter]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][filter]" type="checkbox" value="1" />
         <?php } ?>
         <?php } ?></td>
        <td class="center"><?php if ($link != 'description') { ?>
         <?php if (isset ($parameter['enable']['link'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][link]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][link]" type="checkbox" value="1" />
         <?php } ?>
         <?php } else { ?>
         <input type="checkbox" disabled="disabled" />
         <?php } ?></td>
        <td class="center"><?php if (isset ($parameter['enable']['product'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][product]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][product]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="left"><?php echo $link; ?></td>
        <td class="left"><?php echo ${'text_' . $link}; ?></td>
        <td class="left"></td>
       </tr>
      </tbody>
      <?php } ?>
      <tbody class="additional_link">
       <tr class="filter">
        <td class="left" colspan="3">
        <td class="left" colspan="3"><b><?php echo $text_additional; ?> <em style="color:red;">(Beta)</em></b></td>
       </tr>
      </tbody>
      <?php foreach ($setting['additional_link'] as $link => $parameter) { ?>
      <tbody class="<?php echo $link; ?>">
       <tr>
        <td class="center"><?php if (isset ($parameter['enable']['filter'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][filter]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][filter]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="center"><?php if (isset ($parameter['enable']['link'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][link]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][link]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="center"><?php if (isset ($parameter['enable']['product'])) { ?>
         <input name="link[<?php echo $link; ?>][enable][product]" type="checkbox" value="1" checked="checked" />
         <?php } else { ?>
         <input name="link[<?php echo $link; ?>][enable][product]" type="checkbox" value="1" />
         <?php } ?></td>
        <td class="left"><?php echo $link; ?></td>
        <td class="left"><?php echo ${'text_' . $link}; ?></td>
        <td class="center"><a onclick="deteteLink('<?php echo $link; ?>');">
         <img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" />
         </a></td>
       </tr>
      </tbody>
      <?php } ?>
      <tfoot>
       <tr>
        <td class="center" colspan="5"></td>
        <td class="center"><a onclick="addLink();">
         <img src="view/image/add.png" alt="<?php echo $text_add; ?>" title="<?php echo $text_add; ?>" />
         </a></td>
       </tr>
      </tfoot>
     </table>
    </div>
    <div id="tab-filter">
     <table class="be-list">
      <thead>
       <tr>
        <td class="left" colspan="4"><?php echo $text_additional; ?>:</td>
       </tr>
       <tr>
        <td class="center" width="1"></td>
        <td class="left" width="20%"><?php echo $text_table; ?></td>
        <td class="left" width="20%"><?php echo $text_field; ?></td>
        <td class="left"><?php echo $text_description; ?></td>
       </tr>
      </thead>
      <?php foreach ($filter as $table => $array) { ?>
      <?php foreach ($array['field'] as $field) { ?>
      <tbody>
       <tr>
        <td class="center"><a onclick="$(this).parents('tbody:first').remove();">
         <img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />
         </a></td>
        <td class="left"><?php echo $table; ?></td>
        <td class="left"><?php echo $field; ?></td>
        <td class="left"><input type="hidden" name="filter[<?php echo $table; ?>][field][]" value="<?php echo $field; ?>" />
         <?php foreach ($languages as $code => $language) { ?>
         <?php $value = ''; ?>
         <?php if (isset ($array['text'][$field][$code])) { ?>
         <?php $value = $array['text'][$field][$code]; ?>
         <?php } ?>
         <input type="text" name="filter[<?php echo $table; ?>][text][<?php echo $field; ?>][<?php echo $code; ?>]" value="<?php echo $value; ?>" />
         <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />
         <?php } ?></td>
       </tr>
      </tbody>
      <?php } ?>
      <?php } ?>
      <tfoot>
       <tr>
        <td class="center" width="1"><a onclick="addFilterField();">
         <img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" />
         </a></td>
        <td class="center" colspan="3"></td>
       </tr>
      </tfoot>
     </table>
    </div>
    <div id="tab-multilanguage">
     <table class="be-list" id="table-multilanguage">
      <thead>
       <tr>
        <td class="left" width="1"></td>
        <td class="left" width="10%"><?php echo $text_variable; ?></td>
        <td class="left"><?php echo $text_value; ?></td>
       </tr>
      </thead>
      <?php foreach ($variables as $variable) { ?>
      <tbody>
       <tr>
        <td class="center"><a onclick="$(this).parents('tbody:first').remove();">
         <img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />
         </a></td>
        <td class="left"><?php echo $variable; ?></td>
        <td class="left"><?php foreach ($languages as $code => $language) { ?>
         <?php $value = '' ?>
         <?php if (isset ($multilanguage['field'][$code][$variable])) { ?>
         <?php $value = $multilanguage['field'][$code][$variable]; ?>
         <?php } ?>
         <input type="text" name="multilanguage[field][<?php echo $code; ?>][<?php echo $variable; ?>]" value="<?php echo $value; ?>" />
         <img src="view/image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />
         <?php } ?></td>
       </tr>
      </tbody>
      <?php } ?>
      <tfoot>
       <tr class="filter">
        <td class="center"><a onclick="addMultilanguage();">
         <img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" />
         </a></td>
        <td class="left" colspan="2"><?php echo $text_variable; ?>:
         <input type="text" id="multilanguage-variable" size="50" /></td>
       </tr>
      </tfoot>
     </table>
    </div>
    <div id="tab-option">
     <table class="be-form">
      <tr>
       <td id="text_activate"><?php if ($activate) { ?>
        <p>
         <b style="color:green;"><?php echo $success_activate_extension; ?></b>
        </p>
        <?php } else { ?>
        <p>
         <b style="color:red;"><?php echo $error_activate_extension; ?></b>
        </p>
        <?php } ?></td>
       <td id="button_activate"><?php if (!$activate) { ?>
        <a class="button" onclick="activate();"><?php echo $button_activate; ?></a>
        <?php } ?></td>
      </tr>
      <tr>
       <td><?php echo $text_counter; ?></td>
       <td><select name="option[counter]">
         <?php if ($option['counter']) { ?>
         <option value="0"><?php echo $text_no; ?></option>
         <option value="1" selected="selected"><?php echo $text_yes; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_no; ?></option>
         <option value="1"><?php echo $text_yes; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_add_related; ?></td>
       <td><select name="option[related][add]">
         <?php if ($option['related']['add'] == 1) { ?>
         <option value="1" selected="selected"><?php echo $text_one_side; ?></option>
         <option value="2"><?php echo $text_two_side; ?></option>
         <?php } else { ?>
         <option value="1"><?php echo $text_one_side; ?></option>
         <option value="2" selected="selected"><?php echo $text_two_side; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_del_related; ?></td>
       <td><select name="option[related][del]">
         <?php if ($option['related']['del'] == 1) { ?>
         <option value="1" selected="selected"><?php echo $text_one_side; ?></option>
         <option value="2"><?php echo $text_two_side; ?></option>
         <?php } else { ?>
         <option value="1"><?php echo $text_one_side; ?></option>
         <option value="2" selected="selected"><?php echo $text_two_side; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_image_size; ?></td>
       <td><input name="option[image][width]" type="text" value="<?php echo $option['image']['width']; ?>" size="3" />
        &times;
        <input name="option[image][height]" type="text" value="<?php echo $option['image']['height']; ?>" size="3" /></td>
      </tr>
      <tr>
       <td><?php echo $text_view_categories; ?></td>
       <td><select name="option[category]">
         <?php if ($option['category']) { ?>
         <option value="0"><?php echo $text_list; ?></option>
         <option value="1" selected="selected"><?php echo $text_autocomplete; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_list; ?></option>
         <option value="1"><?php echo $text_autocomplete; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_column_categories; ?></td>
       <td><select name="option[column_categories]">
         <?php if ($option['column_categories']) { ?>
         <option value="0"><?php echo $text_disabled; ?></option>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <option value="1"><?php echo $text_enabled; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_column_attributes; ?></td>
       <td><select name="option[column_attributes]">
         <?php if ($option['column_attributes']) { ?>
         <option value="0"><?php echo $text_disabled; ?></option>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <option value="1"><?php echo $text_enabled; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_column_options; ?></td>
       <td><select name="option[column_options]">
         <?php if ($option['column_options']) { ?>
         <option value="0"><?php echo $text_disabled; ?></option>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <option value="1"><?php echo $text_enabled; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_quick_filter; ?></td>
       <td><select name="option[quick_filter]">
         <?php if ($option['quick_filter']) { ?>
         <option value="0"><?php echo $text_disabled; ?></option>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <option value="1"><?php echo $text_enabled; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_yandex_translate; ?> {<a href="https://tech.yandex.ru/keys/get/?service=trnsl" target="_blank">Key API</a>}</td>
       <td><input name="option[yandex_translate_key_api]" size="110" value="<?php echo $option['yandex_translate_key_api']; ?>" /></td>
      </tr>
      <tr>
       <td><?php echo $text_image_google; ?> {<a href="https://console.developers.google.com/apis/" target="_blank">Key API</a>}</td>
       <td><input name="option[image_google_key_api]" size="110" value="<?php echo $option['image_google_key_api']; ?>" /></td>
      </tr>
      <tr>
       <td><?php echo $text_image_google; ?> {<a href="https://cse.google.com/cse/" target="_blank">CX</a>}</td>
       <td><input name="option[image_google_cx]" size="110" value="<?php echo $option['image_google_cx']; ?>" /></td>
      </tr>
      <tr>
       <td><?php echo $text_image_bing; ?> {<a href="https://www.microsoft.com/cognitive-services/en-us/subscriptions" target="_blank">Key API</a>}</td>
       <td><input name="option[image_bing_key_api]" size="110" value="<?php echo $option['image_bing_key_api']; ?>" /></td>
      </tr>
      <tr>
       <td><?php echo $text_dir_image; ?></td>
       <td><input type="text" name="option[dir_image]" value="<?php echo $option['dir_image']; ?>" size="110" /></td>
      </tr>
      <tr>
       <td><?php echo $text_product_image_remove; ?></td>
       <td><select name="option[product_image_remove]">
         <?php if ($option['product_image_remove']) { ?>
         <option value="0"><?php echo $text_disabled; ?></option>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <?php } else { ?>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <option value="1"><?php echo $text_enabled; ?></option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_url_alias; ?></td>
       <td><select name="option[url_alias]">
         <?php if ($option['url_alias']) { ?>
         <option value="0">SELECT</option>
         <option value="1" selected="selected">CONCAT</option>
         <?php } else { ?>
         <option value="0" selected="selected">SELECT</option>
         <option value="1">CONCAT</option>
         <?php } ?>
        </select></td>
      </tr>
      <tr>
       <td><?php echo $text_option; ?> - <?php echo $text_price_prefix; ?></td>
       <td><table id="option_price_prefix" class="be-list" style="width:300px; margin:0px;">
         <thead>
          <tr>
           <td class="center"></td>
           <td class="center"><?php echo $text_value; ?></td>
           <td class="center"><?php echo $text_name; ?></td>
          </tr>
         </thead>
         <?php $option_price_prefix_row = 0; ?>
         <?php foreach ($option['option_price_prefix'] as $price_prefix) { ?>
         <tbody>
          <tr>
           <td class="center"><a onclick="$(this).parents('tbody:first').remove();">
            <img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />
            </a></td>
           <td class="center"><input type="text" name="option[option_price_prefix][<?php echo $option_price_prefix_row; ?>][value]" value="<?php echo $price_prefix['value']; ?>" /></td>
           <td class="center"><input type="text" name="option[option_price_prefix][<?php echo $option_price_prefix_row; ?>][name]" value="<?php echo $price_prefix['name']; ?>" /></td>
          </tr>
         </tbody>
         <?php $option_price_prefix_row++; ?>
         <?php } ?>
         <tfoot>
          <tr>
           <td class="center" width="1"><a onclick="addOptionPricePrefix();">
            <img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" />
            </a></td>
           <td class="center" colspan="2"></td>
          </tr>
         </tfoot>
        </table></td>
      </tr>
      <tr>
       <td><?php echo $text_option; ?> - <?php echo $text_type; ?></td>
       <td><table id="option_type" class="be-list" style="width:150px; margin:0px;">
         <?php foreach ($option['option_type'] as $type) { ?>
         <tbody>
          <tr>
           <td class="center"><a onclick="$(this).parents('tbody:first').remove();">
            <img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />
            </a></td>
           <td class="center"><input type="text" name="option[option_type][]" value="<?php echo $type; ?>" /></td>
          </tr>
         </tbody>
         <?php } ?>
         <tfoot>
          <tr>
           <td class="center" width="1"><a onclick="addOptionType();">
            <img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" />
            </a></td>
           <td class="center"></td>
          </tr>
         </tfoot>
        </table></td>
      </tr>
      <tr>
       <td><?php echo $text_limit; ?></td>
       <td><table id="limit" class="be-list" style="width:150px; margin:0px;">
         <?php foreach ($option['limit'] as $limit) { ?>
         <tbody>
          <tr>
           <td class="center"><a onclick="$(this).parents('tbody:first').remove();">
            <img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" />
            </a></td>
           <td class="center"><input type="text" name="option[limit][]" value="<?php echo $limit; ?>" /></td>
          </tr>
         </tbody>
         <?php } ?>
         <tfoot>
          <tr>
           <td class="center" width="1"><a onclick="addLimit();">
            <img src="view/image/add.png" alt="<?php echo $button_insert; ?>" title="<?php echo $button_insert; ?>" />
            </a></td>
           <td class="center"></td>
          </tr>
         </tfoot>
        </table></td>
      </tr>
     </table>
    </div>
    <div id="tab-support">
     <table class="be-form">
      <tr>
       <td>E-mail:</td>
       <td><a href="mailto:yaroslav-kaverzin@yandex.ru">yaroslav-kaverzin@yandex.ru</a></td>
      </tr>
      <tr>
       <td>Skype:</td>
       <td><a href="skype:yaroslav-kaverzin?chat">yaroslav-kaverzin</a></td>
      </tr>
      <tr>
       <td>ICQ:</td>
       <td><a onclick="retun false;">602250606</a></td>
      </tr>
     </table>
    </div>
   </form>
  </div>
 </div>
</div>
<script type="text/javascript"><!--//
$(document).ready(function() {
	$('#tab-setting a').tabs();
	
	$('#table tbody').tableDnD({
		onDragClass: 'shadow',
		dragHandle: '.drag',
		onDrop: function(table, row) {}
	});
});

var option_price_prefix_row = '<?php echo $option_price_prefix_row; ?>';

function addOptionPricePrefix() {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="center"><input type="text" name="option[option_price_prefix][' + option_price_prefix_row + '][value]" value="" /></td>';
	html += '  <td class="center"><input type="text" name="option[option_price_prefix][' + option_price_prefix_row + '][name]" value="" /></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	option_price_prefix_row++;
	
	$('#tab-option #option_price_prefix tfoot').before(html);
}

function addOptionType() {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="center"><input type="text" name="option[option_type][]" /></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#tab-option #option_type tfoot').before(html);
}

function addLimit() {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="center"><input type="text" name="option[limit][]" /></td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#tab-option #limit tfoot').before(html);
}

function addLink() {
	var link_box = creatDialog('dialog');
	
	xhr = $.ajax({type:'GET', dataType:'html', url:'index.php?route=batch_editor/setting/addLink&token=<?php echo $this->session->data["token"]; ?>',
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(html) {
			link_box.html(html).dialog({title:'<?php echo $text_add; ?>'}).dialog('open');
			
			creatOverlayLoad(false);
		}
	});
}

function saveLink() {
	xhr = $.ajax({type:'POST', dataType:'json', data:$('#form-link').serialize(), url:'index.php?route=batch_editor/setting/saveLink&token=<?php echo $this->session->data["token"]; ?>',
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(json) {
			if (json['success']) {
				var html = '';
				var link_ = $('#form-link select[name=\'link[table]\']').val();
				var description = $('#form-link input[name=\'link[description][' + json['value'] + ']\']').val();
				
				$('#tab-link table tbody.' + link_).remove();
				
				html += '<tbody class="' + link_ + '">';
				html += ' <tr>';
				html += '  <td class="center"><input name="link[' + link_ + '][enable][filter]" type="checkbox" value="1" /></td>';
				html += '  <td class="center"><input name="link[' + link_ + '][enable][link]" type="checkbox" value="1" /></td>';
				html += '  <td class="center"><input name="link[' + link_ + '][enable][product]" type="checkbox" value="1" /></td>';
				html += '  <td class="left">' + link_ + '</td>';
				html += '  <td class="left">' + description + '</td>';
				html += '  <td class="center"><a onclick="deteteLink(\'' + link_ + '\');"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>';
				html += ' </tr>';
				html += '</tbody>';
				
				$('#tab-link table tbody.additional_link').after(html);
				
				$('#dialog').dialog('close');
			}
			creatOverlayLoad(false);
			creatMessage(json);
		}
	});
}

function deteteLink(link_) {
	xhr = $.ajax({type:'POST', dataType:'json', data:'link=' + link_, url:'index.php?route=batch_editor/setting/deleteLink&token=<?php echo $this->session->data["token"]; ?>',
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(json) {
			if (json['success']) {
				$('#tab-link table tbody.' + link_).remove();
			}
			
			creatOverlayLoad(false);
			creatMessage(json);
		}
	});
}

function addFilterField() {
	var html = '';
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center">';
	html += '   <a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a>';
	html += '  </td>';
	html += '  <td class="left">';
	html += '   <select onchange="getFilterField(this);">';
	html += '    <option value=""></option>';
	<?php foreach ($tables as $table) { ?>
	html += '    <option value="<?php echo $table; ?>"><?php echo $table; ?></option>';
	<?php } ?>
	html += '   </select>';
	html += '  </td>';
	html += '  <td class="left">';
	html += '  </td>';
	html += '  <td class="left">';
	html += '  </td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#tab-filter table tfoot').before(html);
}

function getFilterField(this_) {
	var table = $(this_).val();
	var field_box = $(this_).parents('td').next('td');
	var html = '';
	
	if (table) {
		xhr = $.ajax({type:'POST', dataType:'json', data:'table=' + table, url:'index.php?route=batch_editor/setting/getFilterField&token=<?php echo $this->session->data["token"]; ?>',
			beforeSend: function() { field_box.html(loading); },
			success: function(json) {
				html += '<select name="filter[' + table + '][field][]" onchange="getFilterFieldText(this);" style="min-width:200px;">';
				html += ' <option value=""></option>';
				
				$.each(json, function (index, field) {
					html += ' <option value="' + field + '">' + field + '</option>';
				});
				
				html += '</select>';
				
				field_box.html(html);
			}
		});
	} else {
		field_box.html('');
	}
}

function getFilterFieldText(this_) {
	var table = $(this_).parents('tbody').find('select:first').val();
	var field = $(this_).val();
	var text_box = $(this_).parents('td').next('td');
	var html = '';
	
	if (field) {
		<?php foreach ($languages as $code => $language) { ?>
		html += '<input type="text" name="filter[' + table + '][text][' + field + '][<?php echo $code; ?>]" />&nbsp;';
		html += '<img src="view/image/flags/<?php echo $language["image"]; ?>" alt="<?php echo $language["name"]; ?>" title="<?php echo $language["name"]; ?>" />&nbsp;';
		<?php } ?>
	}
	
	text_box.html(html);
}

function addMultilanguage() {
	var html = '';
	var variable = $('#tab-multilanguage #multilanguage-variable');
	var value = variable.val();
	
	if (!value) {
		variable.fadeOut(300).fadeIn(300);
		
		return false;
	}
	
	html += '<tbody>';
	html += ' <tr>';
	html += '  <td class="center" width="1"><a onclick="$(this).parents(\'tbody:first\').remove();"><img src="view/image/delete.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>';
	html += '  <td class="left">' + value + '</td>';
	html += '';
	html += '  <td class="left">';
	<?php foreach ($languages as $code => $language) { ?>
	html += '   <input type="text" name="multilanguage[field][<?php echo $code; ?>][' + value + ']" value="" />&nbsp;';
	html += '   <img src="view/image/flags/<?php echo $language["image"]; ?>" alt="<?php echo $language["name"]; ?>" title="<?php echo $language["name"]; ?>" />&nbsp;';
	<?php } ?>
	html += '  </td>';
	html += ' </tr>';
	html += '</tbody>';
	
	$('#tab-multilanguage #table-multilanguage').append(html);
	$('#tab-multilanguage #multilanguage-variable').val('');
}

function activate() {
	xhr = $.ajax({type:'GET', dataType:'json', url:'index.php?route=batch_editor/setting/activate&token=<?php echo $this->session->data["token"]; ?>',
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(json) {
			creatOverlayLoad(false);
			creatMessage(json);
			
			if (json['success']) {
				$('#tab-option #text_activate').html('<p><b style="color:green;">' + json['success'] + '</b></p>');
				$('#tab-option #button_activate').html('');
			}
		}
	});
}
//--></script> 
<?php echo $footer; ?>