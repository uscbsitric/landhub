<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

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

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please Sign In</h2>

        <?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>

        <!-- Text input-->
        <div class="form-group">
            <label class="control-label">E-mail</label>
            <div class="controls">
                <input id="email" name="email" type="email" placeholder="E-mail Address" class="form-control" required="required" value="<?php echo Security::xss_clean(@$_POST['email']); ?>">
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="control-label">Password</label>
            <div class="controls">
                <input id="password" name="password" type="password" placeholder="Password" class="form-control" required="required">

            </div>
        </div>

        <!-- Forgot Password -->
        <div class="form-group">
            <label class="control-label"><a href="/forgot-password">Forgot your password?</a></label>
            <div class="controls"></div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="control-label"></label>
            <div class="controls">
                <button id="submit" name="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>

        </fieldset>
    </form>
    </form>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
