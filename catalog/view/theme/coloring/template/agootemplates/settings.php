<?php
if (SC_VERSION < 20) {
$ascp_settings_settings = Array(
'box_begin' => '<div class="box">
<div class="box-heading">{TITLE}</div>
<div class="box-content">',
'box_end' => '</div>
</div>'
);
} else {$ascp_settings_settings = Array(
'box_begin' => '<div>
<h3>{TITLE}</h3>',
'box_end' => '</div>'
);
}