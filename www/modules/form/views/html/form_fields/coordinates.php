<input class="form-control" placeholder="Longitude" type="text" id="longitude" name="gps[longitude]" value="<?php
if(!$field->allow_html):
    echo Security::xss_clean(strip_tags(@$_POST['gps']['longitude']));
else:
    echo Security::xss_clean(@$_POST['gps']['longitude']);
endif;
?>"
    <?php if($field->is_required): ?>
        required2="required"
    <?php endif; ?>>

<input class="form-control" placeholder="Latitude" type="text" id="latitude" name="gps[latitude]" value="<?php
if(!$field->allow_html):
    echo Security::xss_clean(strip_tags(@$_POST['gps']['latitude']));
else:
    echo Security::xss_clean(@$_POST['gps']['latitude']);
endif;
?>"
    <?php if($field->is_required): ?>
        required2="required"
    <?php endif; ?>>