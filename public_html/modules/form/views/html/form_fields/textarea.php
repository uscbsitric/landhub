<textarea class="form-control" placeholder="<?php echo $field->label;?>" id="<?php echo $field->name; ?>" name="<?php echo $field->name;?>"
<?php if($field->is_required): ?>
    required2="required"
<?php endif; ?>
><?php
if(!$field->allow_html):
    echo Security::xss_clean(strip_tags(@$_POST[$field->name]));
else:
    echo Security::xss_clean(@$_POST[$field->name]);
endif;
?></textarea>