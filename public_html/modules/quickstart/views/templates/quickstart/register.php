<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/media/frameworks/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/media/frameworks/bootstrap/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/media/frameworks/bootstrap/assets/js/html5shiv.js"></script>
    <script src="/media/frameworks/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form role="form" class="form-signin" method="post">
        <fieldset>

            <!-- Form Name -->

            <h2 class="form-signin-heading">Register</h2>

            <?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                    <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control" value="<?php echo Security::xss_clean(@$_POST['first_name']); ?>" required2="required2">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                    <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control" value="<?php echo Security::xss_clean(@$_POST['last_name']); ?>" required2="required2">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label">E-mail</label>
                <div class="controls">
                    <input id="email" name="email" type="text" placeholder="E-mail Address" class="form-control" value="<?php echo Security::xss_clean(@$_POST['email']); ?>" required2="required2">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="control-label">Password</label>
                <div class="controls">
                    <input id="password" name="password" type="password" placeholder="Password" class="form-control" required2="required2">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="control-label">Verify Password</label>
                <div class="controls">
                    <input id="password-verify" name="password_confirm" type="password" placeholder="Enter your password again" class="form-control" required2="required2">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="control-label"></label>
                <div class="controls">
                    <button id="submit" name="submit" class="btn btn-primary">Register</button>
                </div>
            </div>

        </fieldset>
    </form>


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
