
<!--author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (roman@pinkovskiy.com fisherway.com.ua)-->
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
      <div class="buttons">
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">

      <?php $fields = array('name', 'description', 'tags', 'attributes', 'model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn' ); ?>

      <div id="tabs" class="htabs">
        <a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-relevance"><?php echo $tab_relevance; ?></a>
				<a href="#tab-exclude-words"><?php echo $tab_exclude_words; ?></a>
        <a href="#tab-replace-words"><?php echo $tab_replace_words; ?></a>
        <a href="#tab-support"><?php echo $tab_support; ?></a>
      </div>      

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

        <div id="tab-general" style="width: 1000px; margin: 0 auto;">
          
          <br />
          <table id="general" class="list" style="width: 700px;">
              <tr>
                <td class="left"><?php echo $text_key; ?></td>              
                <td width="500" style="text-align: left;">
                  <input type="text" size="70" name="search_mr_options[key]" value="<?php echo isset($options['key']) ? $options['key'] : '';?>">
                </td>
              </tr>
          </table>          
          <br />

          <table id="general" class="list" style="width: 1000px; margin: 0 auto;">
            <thead>
              <tr height="25">
                <td><?php echo $fields_name; ?></td>
                <td><?php echo $search; ?></td>
                <td><?php echo $phrase; ?></td>
                <td><?php echo $use_morphology; ?></td>
                <td><?php echo $use_relevance; ?></td>
                <td><?php echo $exclude_characters; ?></td>
                <td><?php echo $search_logic; ?></td> 
              </tr>
            </thead>

            <tbody >

              <?php foreach($fields as $field): ?>

              <tr>

                <td>
                  <?php echo $field; ?>
                </td>

                <td>
                  <select name="search_mr_options[fields][<?php echo $field; ?>][search]">
                    <option value="equally"  <?php echo (isset($options['fields'][$field]['search']) && $options['fields'][$field]['search'] == 'equally')  ? 'selected="selected"' : "" ;?>><?php echo $search_equally; ?></option>
                    <option value="contains" <?php echo (isset($options['fields'][$field]['search']) && $options['fields'][$field]['search'] == 'contains') ? 'selected="selected"' : "" ;?>><?php echo $search_contains; ?></option>
                    <option value="start"    <?php echo (isset($options['fields'][$field]['search']) && $options['fields'][$field]['search'] == 'start') ? 'selected="selected"' : "" ;?>><?php echo $search_start; ?></option>
                    <option value="0" <?php echo (isset($options['fields'][$field]['search']) && $options['fields'][$field]['search'] == '0') ? 'selected="selected"' : "" ;?>><?php echo $search_dont_search; ?></option>
                  </select>
                </td>

                <td>
                  <select name="search_mr_options[fields][<?php echo $field; ?>][phrase]">
                    <option value="cut"  <?php echo (isset($options['fields'][$field]['phrase']) && $options['fields'][$field]['phrase'] == 'cut')  ? 'selected="selected"' : "" ;?>><?php echo $phrase_cut; ?></option>
                    <option value="dont_cut"  <?php echo (isset($options['fields'][$field]['phrase']) && $options['fields'][$field]['phrase'] == 'dont_cut')  ? 'selected="selected"' : "" ;?>><?php echo $phrase_dont_cut; ?></option>
                  </select>
                </td>

                <td>
                  <input type="checkbox" name="search_mr_options[fields][<?php echo $field; ?>][use_morphology]" value="1" <?php echo isset($options['fields'][$field]['use_morphology']) && $options['fields'][$field]['use_morphology'] ? "checked=checked" : "" ;?> />
                </td>              

                <td>
                  <input type="checkbox" name="search_mr_options[fields][<?php echo $field; ?>][use_relevance]" value="1" <?php echo isset($options['fields'][$field]['use_relevance']) && $options['fields'][$field]['use_relevance'] ? "checked=checked" : "" ;?> />
                </td>              
                
                <td>
                  <input type="text" name="search_mr_options[fields][<?php echo $field; ?>][exclude_characters]" value="<?php echo isset($options['fields'][$field]['exclude_characters']) ? $options['fields'][$field]['exclude_characters'] : '';?>" size="10" />
                </td>                              
               
                <td>
                  <select name="search_mr_options[fields][<?php echo $field; ?>][logic]">
                    <option value="OR"   <?php echo (isset($options['fields'][$field]['logic']) && $options['fields'][$field]['logic'] == 'OR')   ? 'selected="selected"' : "" ;?>><?php echo $logic_or; ?></option>
                    <option value="AND"  <?php echo (isset($options['fields'][$field]['logic']) && $options['fields'][$field]['logic'] == 'AND')  ? 'selected="selected"' : "" ;?>><?php echo $logic_and; ?></option>
                  </select>
                </td>
                                							
              </tr>

              <?php endforeach; ?>

            </tbody>  

          </table>
          
          <br />          
          <table id="general" class="list" style="width: 500px;">
              <tr>
                <td><?php echo $min_word_length; ?></td> 
                <td>
                  <input type="text" name="search_mr_options[min_word_length]" value="<?php echo isset($options['min_word_length']) ? $options['min_word_length'] : '' ; ?>" size="7" />
                </td>              
              </tr>
          </table>

          <?php echo $tab_general_help; ?>
        </div>

        <div id="tab-relevance">

          <table id="relevance" class="list" style="width: 1000px; margin: 0 auto;">
            <thead>
              <tr height="25">
                <td><?php echo $fields_name; ?></td>
                <td><?php echo $relevance_start; ?></td>
                <td><?php echo $relevance_phrase; ?></td>
                <td><?php echo $relevance_word; ?></td>
              </tr>
            </thead>

            <tbody >

              <?php foreach($fields as $field): ?>

              <tr>

                <td>
                  <?php echo $field; ?>
                </td>

                <td>
                  <input type="text" name="search_mr_options[fields][<?php echo $field; ?>][relevance][start]" value="<?php echo isset($options['fields'][$field]['relevance']['start']) ? $options['fields'][$field]['relevance']['start'] : 0; ?>" />
                </td>              

                <td>
                  <input type="text" name="search_mr_options[fields][<?php echo $field; ?>][relevance][phrase]" value="<?php echo isset($options['fields'][$field]['relevance']['phrase']) ? $options['fields'][$field]['relevance']['phrase'] : 0; ?>" />
                </td>              

                <td>
                  <input type="text" name="search_mr_options[fields][<?php echo $field; ?>][relevance][word]" value="<?php echo isset($options['fields'][$field]['relevance']['word']) ? $options['fields'][$field]['relevance']['word'] : 0; ?>" />
                </td>              

              </tr>

              <?php endforeach; ?>

            </tbody>  

          </table>
          <?php echo $tab_relevance_help; ?>
        </div>

        <div id="tab-exclude-words">

          <div id="exclude-words-languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#exclude-words-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          
          <?php foreach ($languages as $language) { ?>
          <div id="exclude-words-language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td>
                  <?php echo $tab_exclude_words_help; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea name="search_mr_options[exclude_words][<?php echo $language['language_id']; ?>]" cols="80" rows="20"><?php echo isset($options['exclude_words'][$language['language_id']]) ? $options['exclude_words'][$language['language_id']] : ''; ?></textarea>
                </td>
              </tr>
            </table>
          </div>
          <?php } ?>
          
        </div>

        <div id="tab-replace-words">
          
          <div id="replace-words-languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#replace-words-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          
          <?php foreach ($languages as $language) { ?>
          <div id="replace-words-language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td>
                  <?php echo $tab_replace_words_help; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea name="search_mr_options[replace_words][<?php echo $language['language_id']; ?>]" cols="80" rows="20"><?php echo isset($options['replace_words'][$language['language_id']]) ? $options['replace_words'][$language['language_id']] : ''; ?></textarea>
                </td>
              </tr>
            </table>
          </div>
          <?php } ?>
          
        </div>
        
        <div id="tab-support">
          <?php echo $support_text; ?>
        </div>

      </form>
    </div>
  </div>
  <div id="copyright">author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (roman@pinkovskiy.com fisherway.com.ua)</div>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs();
$('#exclude-words-languages a').tabs();
$('#replace-words-languages a').tabs();  
//--></script> 

<?php echo $footer; ?>
