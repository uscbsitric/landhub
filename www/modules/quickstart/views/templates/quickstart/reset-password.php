<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset Password</title>

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

            <h2 class="form-signin-heading">Reset Password</h2>

            <?php echo View::factory('html/validation/errors')->set('errors', @$errors); ?>

            <?php echo $content; ?>

        </fieldset>
    </form>


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
