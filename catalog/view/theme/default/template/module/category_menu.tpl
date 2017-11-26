<div id="cmpro-<?php echo $module; ?>" class="<?php echo $box_class; ?>">
  <?php if ($title_status) { ?>

  <?php } ?>
  <div class="<?php echo $content_class; ?>">
    <ul class="cmpro-<?php echo $style; ?> <?php echo $position; ?>">
      <?php foreach ($categories as $category) { ?>
      <li class="cid-<?php echo $category['category_id']; ?><?php echo $category['active'] ? ' active' : ''; ?>">
        <div> <a href="<?php echo $category['href']; ?>" class="<?php echo ($category['children'] && $toggle == 0 ? 'parent-item' : ''); ?><?php echo ($category['children'] && $toggle ? 'tb-item' : ''); ?><?php echo $category['active'] ? ' active' : ''; ?>">
          <?php if ($icon && $category['thumb']) { ?>
          <div class="category-image"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>"></div>
          <?php } ?>
          <div class="category-menu-name"><?php echo $category['name']; ?></div></a>
          <?php if ($category['children'] && $toggle) { ?>
          <span class="toggle-btn<?php echo $category['active'] ? ' item-open' : ''; ?>"></span>
          <?php } ?>
        </div>
        <?php if ($category['children']) { ?>
        <ul>
          <?php if ($image && $category['thumb']) { ?>
          <li class="item-image"><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>"></a></li>
          <?php } ?>
          <?php foreach ($category['children'] as $child) { ?>
          <li class="cid-<?php echo $child['cid']; ?><?php echo $child['active'] ? ' active' : ''; ?>">
            <div> <a href="<?php echo $child['href']; ?>" class="<?php echo ($child['child2_id'] && $toggle == 0 ? 'parent-item' : ''); ?><?php echo ($child['child2_id'] && $toggle ? 'tb-item' : ''); ?><?php echo $child['active'] ? ' active' : ''; ?>"><span><?php echo $child['name']; ?></span></a>
              <?php if ($child['child2_id'] && $toggle) { ?>
              <span class="toggle-btn<?php echo $child['active'] ? ' item-open' : ''; ?>"></span>
              <?php } ?>
            </div>
            <?php if($child['child2_id']){ ?>
            <ul>
              <?php if ($image && $child['thumb']) { ?>
              <li class="item-image"><a href="<?php echo $child['href']; ?>" title="<?php echo $child['name']; ?>"><img src="<?php echo $child['thumb']; ?>" alt="<?php echo $child['name']; ?>"></a></li>
              <?php } ?>
              <?php foreach ($child['child2_id'] as $child2) { ?>
              <li class="cid-<?php echo $child2['cid']; ?><?php echo $child2['active'] ? ' active' : ''; ?>">
                <div> <a href="<?php echo $child2['href']; ?>" class="<?php echo ($child2['child3_id'] && $toggle == 0 ? 'parent-item' : ''); ?><?php echo ($child2['child3_id'] && $toggle ? 'tb-item' : ''); ?><?php echo $child2['active'] ? ' active' : ''; ?>"><span><?php echo $child2['name']; ?></span></a>
                  <?php if ($child2['child3_id'] && $toggle) { ?>
                  <span class="toggle-btn<?php echo $child2['active'] ? ' item-open' : ''; ?>"></span>
                  <?php } ?>
                </div>
                <?php if($child2['child3_id']){ ?>
                <ul>
                  <?php if ($image && $child2['thumb']) { ?>
                  <li class="item-image"><a href="<?php echo $child2['href']; ?>" title="<?php echo $child2['name']; ?>"><img src="<?php echo $child2['thumb']; ?>" alt="<?php echo $child2['name']; ?>"></a></li>
                  <?php } ?>
                  <?php foreach ($child2['child3_id'] as $child3) { ?>
                  <li class="cid-<?php echo $child3['cid']; ?><?php echo $child3['active'] ? ' active' : ''; ?>">
                    <div> <a href="<?php echo $child3['href']; ?>" class="<?php echo ($child3['child4_id'] && $toggle == 0 ? 'parent-item' : ''); ?><?php echo ($child3['child4_id'] && $toggle ? 'tb-item' : ''); ?><?php echo $child3['active'] ? ' active' : ''; ?>"><span><?php echo $child3['name']; ?></span></a>
                      <?php if ($child3['child4_id'] && $toggle) { ?>
                      <span class="toggle-btn<?php echo $child3['active'] ? ' item-open' : ''; ?>"></span>
                      <?php } ?>
                    </div>
                    <?php if($child3['child4_id']){ ?>
                    <ul>
                      <?php if ($image && $child3['thumb']) { ?>
                      <li class="item-image"><a href="<?php echo $child3['href']; ?>" title="<?php echo $child3['name']; ?>"><img src="<?php echo $child3['thumb']; ?>" alt="<?php echo $child3['name']; ?>"></a></li>
                      <?php } ?>
                      <?php foreach ($child3['child4_id'] as $child4) { ?>
                      <li class="cid-<?php echo $child4['cid']; ?><?php echo $child4['active'] ? ' active' : ''; ?>">
                        <div> <a href="<?php echo $child4['href']; ?>" class="<?php echo $child4['active'] ? ' active' : ''; ?>"><span><?php echo $child4['name']; ?></span></a> </div>
                      </li>
                      <?php } ?>
                    </ul>
                    <?php } ?>
                  </li>
                  <?php } ?>
                </ul>
                <?php } ?>
              </li>
              <?php } ?>
            </ul>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php foreach ($manufacturers as $manufacturer) { ?>
      <li class="mid-<?php echo $manufacturer['manufacturer_id']; ?><?php echo ($manufacturer['manufacturer_id'] == $manufacturer_id ? ' active' : ''); ?>">
        <div><a href="<?php echo $manufacturer['href']; ?>" class="<?php echo ($manufacturer['manufacturer_id'] == $manufacturer_id ? 'active' : ''); ?>"><?php echo $manufacturer['name']; ?></a></div>
      </li>
      <?php } ?>
      <?php foreach ($informations as $information) { ?>
      <li class="iid-<?php echo $information['information_id']; ?><?php echo ($information['information_id'] == $information_id ? ' active' : ''); ?>">
        <div><a href="<?php echo $information['href']; ?>" class="<?php echo ($information['information_id'] == $information_id ? 'active' : ''); ?>"><?php echo $information['title']; ?></a></div>
      </li>
      <?php } ?>
      <?php foreach ($custom_links as $custom_link) { ?>
      <li class="ciid-<?php echo $custom_link['ciid']; ?>">
        <div> <a href="<?php echo $custom_link['href']; ?>">
          <?php if ($icon && $custom_link['thumb']) { ?>
          <span class="item-icon"><img src="<?php echo $custom_link['thumb']; ?>" alt="<?php echo $custom_link['link_title']; ?>"></span>
          <?php } ?>
          <span class="center-menu-custom-link"><?php echo $custom_link['link_title']; ?></span></a></div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
  $('#cmpro-<?php echo $module; ?> ul.cmpro-flyout,#cmpro-<?php echo $module; ?> ul.cmpro-flyout ul').menuAim({
    <?php if ($position == 'column_right') { ?>
    submenuDirection: 'left',
    <?php } else { ?> 
    submenuDirection: 'right',
    <?php } ?>
    activate: function(item){
    $(item).find('> ul').fadeIn(100);
    },
    deactivate: function(item){
    $(item).find('> ul').fadeOut(100);
    },
    exitMenu: function(item) {
    $(item).find('> ul').fadeOut(100);
    return true;
    }
  });
});
//--></script> 
