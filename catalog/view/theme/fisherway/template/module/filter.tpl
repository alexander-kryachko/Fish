<style>
    .filter-header {
        text-align: center;
        font-size: 18px;
    }
    .filter-header a {
        color: #319999;
        text-transform: uppercase;
        border-bottom: 1px dashed #319999;
        text-decoration: none;
    }
    .filter-header a:hover {
        color: #319999;
        border-bottom: none;
        text-decoration: none;
    }
    ul.filter {
        list-style: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .box-filter {
        width: 200px;
        margin: 10px;
        display: inline-block;
        text-align: left;
        vertical-align: top;
    }
    .title {
        padding: 0 0 5px;
        margin: 0;
        text-align: center;
        color: #999;
        border-bottom: 1px solid #cce0eb;
        font-size: 18px;
    }
    .box-filter ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .box-filter li {
        margin: 2px 0;
    }
    .box-filter a {
        color: #336699;
        font-size: 18px;
        text-decoration: none;
    }
    .box-filter a:hover {
        text-decoration: underline;
    }
	.filteratt {
		text-align: center;
		width: 100%;
		float: left;
	}
</style>

<?php if ($filter_attributes) { ?>
<div class="filteratt">
    <p class="filter-header"><a href="javascript:void(0)" onclick="$('#filter').toggle('slow');"><?php echo $heading_title; ?></a></p>
</div>
<?php if ($filter) { ?>
<ul class="filter" id="filter">
<?php } else { ?>
<ul class="filter" id="filter" style="display: none;">
<?php } ?>

    <?php foreach ($filter_attributes as $key => $filter_attribute) { ?>
    <li class="box-filter">
        <p class="title"><?php echo $filter_attribute ?></p>
        <ul>
            <?php foreach ($filter_attributes_value[$key] as $sub_key => $filter_attribute_value) { ?>
            <?php if ($filter_attribute_value['checked']) { ?>
            <li><input type="checkbox" onclick="location.href='<?php echo $filter_attribute_value['href']; ?>'" checked>&nbsp;<a href="<?php echo $filter_attribute_value['href']; ?>"><?php echo $filter_attribute_value['value']; ?></a></li>
            <?php } else { ?>
            <li><input type="checkbox" onclick="location.href='<?php echo $filter_attribute_value['href']; ?>'">&nbsp;<a href="<?php echo $filter_attribute_value['href']; ?>"><?php echo $filter_attribute_value['value']; ?></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
    </li>
    <?php } ?>
</ul>
<?php } ?>
