<h1 class="text-center">Log In</h1>
<?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>
<form method="post">
    <div class="form-group">
        <div class="controls">
            <input id="text" name="username" type="text" placeholder="Username" class="form-control" value="<?php echo Security::xss_clean(@$_POST['username']); ?>" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="password" name="password" type="password" placeholder="Password" class="form-control" value="<?php echo Security::xss_clean(@$_POST['password']); ?>" required="required">
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-block btn-danger">Log In</button>
</form>

<div class="text-center">
    <hr class="hr-normal">
</div>