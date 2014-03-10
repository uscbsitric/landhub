<select class="form-control" id="<?php echo $field->name; ?>" name="<?php echo $field->name;?>"
<?php if($field->is_required): ?>
    required2="required"
<?php endif; ?>>
    <option value="">Select One...</option>
<?php foreach($data as $key=>$val): ?>
    <option value="<?php echo $key; ?>" <?php if(Security::xss_clean(@$_POST[$field->name]) == $key) echo "selected=\"selected\""; ?>><?php echo $val; ?></option>
<?php endforeach; ?>
</select>