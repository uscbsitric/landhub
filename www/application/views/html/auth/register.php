<h1 class="text-center">Registration</h1>
<?php echo View::factory("html/validation/errors")->set("errors", @$errors); ?>
<form method="post">
    <div class="form-group">
        <div class="controls">
            <input id="username" name="username" type="text" placeholder="Username" class="form-control" value="<?php echo Security::xss_clean(@$_POST["username"]); ?>" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control" value="<?php echo Security::xss_clean(@$_POST["first_name"]); ?>" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control" value="<?php echo Security::xss_clean(@$_POST["last_name"]); ?>" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="email" name="email" type="text" placeholder="E-mail Address" class="form-control" value="<?php echo Security::xss_clean(@$_POST["email"]); ?>" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="password" name="password" type="password" placeholder="Password" class="form-control" required="required" value="<?php echo Security::xss_clean(@$_POST["password"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <input id="password-verify" name="password_confirm" type="password" placeholder="Enter your password again" class="form-control" required="required" value="<?php echo Security::xss_clean(@$_POST["password_confirm"]); ?>">
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-block btn-danger">Sign Up</button>
</form>

<div class="text-center">
    <hr class="hr-normal">
</div>