<?php if (isset($errors) && is_array($errors) && sizeof($errors) > 0): ?>
<div class="validation-errors alert alert-danger">
    <?php foreach($errors as $error): ?>
    <div><?php echo $error; ?></div>
    <?php endforeach; ?>
</div>
<?php endif; ?>