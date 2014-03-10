<input class="form-control" placeholder="<?php echo $field->label;?>" type="text" id="<?php echo $field->name; ?>" name="<?php echo $field->name;?>" value="<?php
if(!$field->allow_html):
    echo Security::xss_clean(strip_tags(@$_POST[$field->name]));
else:
    echo Security::xss_clean(@$_POST[$field->name]);
endif;
?>"
<?php if($field->is_required): ?>
required="required"
<?php endif; ?>>