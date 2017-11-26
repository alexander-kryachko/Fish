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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/image_search.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('form').submit();" class="button"><?php echo $button_save; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td class="center"><?php echo $column_status; ?></td>
              <td class="center"><?php echo $column_stock_status; ?></td>
              <td class="center"><?php echo $column_image; ?></td>
              <td class="center"><?php echo $column_category; ?></td>                            
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td>
                <select name="filter_status">
                  <option value=""></option>
                  <option value="1" <?php echo ($filter_status) ? 'selected="selected"' : '' ?>>
                    <?php echo $text_enabled; ?>
                  </option>                  
                  <option value="0" <?php echo (!is_null($filter_status) && !$filter_status) ? 'selected="selected"' : '' ?>>
                    <?php echo $text_disabled; ?>
                  </option>
                </select>              
              </td>
              
              <td>
                <select name="filter_stock_status_id">
                  <option value=""></option>                
                <?php foreach($stock_statuses as $stock_status) {?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>" <?php echo ($stock_status['stock_status_id'] == $filter_stock_status_id) ? 'selected="selected"' : '' ?>>
                    <?php echo $stock_status['name']; ?>
                  </option>
                <?php } ?>
                </select>
              </td>

              <td>
                <select name="filter_image">
                  <option value=""></option>                
                <?php foreach($image_statuses as $image_status) {?>
                  <option value="<?php echo $image_status['image_status_id']; ?>" <?php echo ($image_status['image_status_id'] == $filter_image) ? 'selected="selected"' : '' ?>>
                    <?php echo $image_status['name']; ?>
                  </option>
                <?php } ?>
                </select>
              </td>
              
              <td>
                <select name="filter_category_id">
                  <option value=""></option>                
                <?php foreach($categories as $category) {?>
                  <option value="<?php echo $category['category_id']; ?>" <?php echo ($category['category_id'] == $filter_category_id) ? 'selected="selected"' : '' ?>>
                    <?php echo $category['name']; ?>
                  </option>
                <?php } ?>
                </select>
              </td>
              
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
              
            </tr>
            <?php if ($products) { ?>
            <tr>
              <td colspan="5">
                <?php echo $image_path; ?>
                <select name="image_path[select]">
                  <option value="data" <?php echo 'data' == $options['image_path'] ? "selected='selected'" : "" ?>>
                  data
                  </option>
                <?php foreach ($directories as $directory) { ?>
                  <option value="<?php echo $directory['path']; ?>" <?php echo $directory['path'] == $options['image_path'] ? "selected='selected'" : "" ?>>
                    <?php echo str_repeat("&nbsp;&nbsp;&nbsp;", $directory['level']) . $directory['name']; ?>
                  </option>
                <?php } ?>    
                </select>
                /
                <input name="image_path[text]" />
              </td>
            </tr>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td colspan="5">
                
                <div class="product_name" id="product_name<?php echo $product['product_id']; ?>">
                  
                  <span class="name"><a href="../index.php?route=product/product&product_id=<?php echo $product['product_id']; ?>" target="_blank">
                    <?php echo $product['name']; ?>
                  </a></span> 
                  <span class="price">
                    <?php echo $product['price']; ?>
                  </span>
                    
                </div>
                
                <div class="product_images" id="product_images<?php echo $product['product_id']; ?>">
                  <div class="image_container">
                    <a href="<?php echo $product['image']['popup']; ?>" class="colorbox" rel="colorbox_p<?php echo $product['product_id']; ?>">
                      <img src="<?php echo $product['image']['thumb']; ?>" class="main_image" />
                    </a>

                    <input type="hidden" value="<?php echo $product['image']['image']; ?>" name="image[<?php echo $product['product_id']; ?>][url][]">
                    <input type="hidden" value="0" name="image[<?php echo $product['product_id']; ?>][deleted][]">
                    <input type="hidden" value="1" name="image[<?php echo $product['product_id']; ?>][main][]">
                        
                    <div class="links" style="display: none; ">
                      <a href="#" onclick="setMainImage(this, <?php echo $product['product_id']; ?>); return false;" class="link_main"></a>
                      <a href="#" onclick="deleteImage(this, <?php echo $product['product_id']; ?>); return false;" class="link_delete"></a>
                    </div>              

                  </div>
                    <?php foreach ($product['images'] as $image) { ?>
                      <div class="image_container">
                        <a href="<?php echo $image['popup']; ?>" class="colorbox" rel="colorbox_p<?php echo $product['product_id']; ?>">
                          <img src="<?php echo $image['thumb']; ?>" />
                        </a> 
                                                
                        <input type="hidden" value="<?php echo $image['image']; ?>" name="image[<?php echo $product['product_id']; ?>][url][]">
                        <input type="hidden" value="0" name="image[<?php echo $product['product_id']; ?>][deleted][]">
                        <input type="hidden" value="0" name="image[<?php echo $product['product_id']; ?>][main][]">
                        
                        <div class="links" style="display: none; ">
                          <a href="#" onclick="setMainImage(this, <?php echo $product['product_id']; ?>); return false;" class="link_main"></a>
                          <a href="#" onclick="deleteImage(this, <?php echo $product['product_id']; ?>); return false;" class="link_delete"></a>
                        </div>              
                        
                      </div>
                    <?php } ?>
                </div>
              
                <div class="search_container" id="search_container<?php echo $product['product_id']; ?>">
                  <div class="search_inputs" id="search_inputs<?php echo $product['product_id']; ?>">
                    <?php if (isset($options['search_where']['model']) && $options['search_where']['model']) {?>
                      <?php echo $entry_model; ?>
                      <input type="text" id="model<?php echo $product['product_id']; ?>" value="<?php echo $product['model']; ?>" size="15">
                      <input type="button" onclick="OnLoad('<?php echo $product['product_id']; ?>', $('#model'+<?php echo $product['product_id']; ?>).val())" value="<?php echo $button_search; ?>" class="button">
                    <?php } ?>
                    
                    <?php if (isset($options['search_where']['name']) && $options['search_where']['name']) {?>
                      <?php echo $entry_name; ?>
                      <input type="text" id="title<?php echo $product['product_id']; ?>" value="<?php echo $product['name']; ?>" size="40">
                      <input type="button" onclick="OnLoad('<?php echo $product['product_id']; ?>', $('#title'+<?php echo $product['product_id']; ?>).val())" value="<?php echo $button_search; ?>" class="button">
                    <?php } ?>

                    <?php if (isset($options['search_where']['sku']) && $options['search_where']['sku']) {?>
                      <?php echo $entry_sku; ?>
                      <input type="text" id="code<?php echo $product['product_id']; ?>" value="<?php echo $product['sku']; ?>" size="15">
                      <input type="button" onclick="OnLoad('<?php echo $product['product_id']; ?>', $('#code'+<?php echo $product['product_id']; ?>).val())" value="<?php echo $button_search; ?>" class="button">
                    <?php } ?>
                                    
                  </div>
                
                  <div id="branding<?php echo $product['product_id']; ?>"></div>
                  <div id="content<?php echo $product['product_id']; ?>"></div>
                
                </div>

              </td>              
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="5"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
      <div class="buttons" style="text-align: center;">
        <a onclick="$('form').submit();" class="button"><?php echo $button_save; ?></a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/image_search&token=<?php echo $token; ?>';
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status) {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	var filter_stock_status_id = $('select[name=\'filter_stock_status_id\']').val();
	
	if (filter_stock_status_id) {
		url += '&filter_stock_status_id=' + encodeURIComponent(filter_stock_status_id);
	}
	
	var filter_image = $('select[name=\'filter_image\']').val();
	
	if (filter_image) {
		url += '&filter_image=' + encodeURIComponent(filter_image);
	}
	
	var filter_category_id = $('select[name=\'filter_category_id\']').val();
	
	if (filter_category_id) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	location = url;
}
//--></script> 

<script type="text/javascript" src="view/javascript/jquery/image_search_min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script src="http://www.google.com/jsapi"></script> 

<script type="text/javascript"><!--
    
    google.load('search', '1');
    
    function OnLoad(nid, searchText) {
    	searchText = searchText || "";

      // ImageSearch instance.
      imageSearch = new google.search.ImageSearch();
    
      <?php if (isset($options['SiteRestriction']) && $options['SiteRestriction']) { ?>
        imageSearch.setSiteRestriction("<?php echo $options['SiteRestriction']; ?>");
      <?php } ?>
      
      <?php if (isset($options['RESTRICT_SAFESEARCH']) && $options['RESTRICT_SAFESEARCH']) { ?>
        imageSearch.setRestriction(
          google.search.Search.RESTRICT_SAFESEARCH,
          google.search.Search.<?php echo $options['RESTRICT_SAFESEARCH']; ?>
        );  
      <?php } ?>

      <?php if (isset($options['RESTRICT_IMAGESIZE']) && $options['RESTRICT_IMAGESIZE']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_IMAGESIZE,
          google.search.ImageSearch.<?php echo $options['RESTRICT_IMAGESIZE']; ?>
        );  
      <?php } ?>
      
      <?php if (isset($options['RESTRICT_COLORIZATION']) && $options['RESTRICT_COLORIZATION']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_COLORIZATION,
          google.search.ImageSearch.<?php echo $options['RESTRICT_COLORIZATION']; ?>
        );  
      <?php } ?>
      
      <?php if (isset($options['RESTRICT_COLORFILTER']) && $options['RESTRICT_COLORFILTER']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_COLORFILTER,
          google.search.ImageSearch.<?php echo $options['RESTRICT_COLORFILTER']; ?>
        );  
      <?php } ?>
      
      <?php if (isset($options['RESTRICT_FILETYPE']) && $options['RESTRICT_FILETYPE']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_FILETYPE,
          google.search.ImageSearch.<?php echo $options['RESTRICT_FILETYPE']; ?>
        );  
      <?php } ?>

      <?php if (isset($options['RESTRICT_IMAGETYPE']) && $options['RESTRICT_IMAGETYPE']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_IMAGETYPE,
          google.search.ImageSearch.<?php echo $options['RESTRICT_IMAGETYPE']; ?>
        );  
      <?php } ?>

      <?php if (isset($options['RESTRICT_RIGHTS']) && $options['RESTRICT_RIGHTS']) { ?>
        imageSearch.setRestriction(
          google.search.ImageSearch.RESTRICT_RIGHTS,
          google.search.ImageSearch.<?php echo $options['RESTRICT_RIGHTS']; ?>
        );  
      <?php } ?>

                                              
      imageSearch.setSearchCompleteCallback(this, searchComplete, [nid, imageSearch]);
      
      imageSearch.setResultSetSize(google.search.Search.LARGE_RESULTSET);
      
      
      // Search
      imageSearch.execute(searchText);
      
      //Branding
      google.search.Search.getBranding('branding'+nid);

    }
    //google.setOnLoadCallback(OnLoad);
//--></script> 
<?php echo $footer; ?>
