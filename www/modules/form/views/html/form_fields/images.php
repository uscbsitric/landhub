<input class="form-control" placeholder="<?php echo $field->name;?>" type="file" id="<?php echo $field->name; ?>" name="<?php echo $field->name;?>[]" value=""
    <?php if($field->is_required): ?>
        required2="required"
    <?php endif; ?> multiple="multiple">