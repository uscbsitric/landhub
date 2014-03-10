<!DOCTYPE html>
<html>
<head>
    <title>Listing Syndication Platform | LandHub.com</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="text/html;charset=utf-8" http-equiv="content-type">
    <meta content="Flat administration template for Twitter Bootstrap." name="description">
    <link href="/media/flatty3/images/meta_icons/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="/media/flatty3/images/meta_icons/apple-touch-icon.png" rel="apple-touch-icon-precomposed">
    <link href="/media/flatty3/images/meta_icons/apple-touch-icon-57x57.png" rel="apple-touch-icon-precomposed" sizes="57x57">
    <link href="/media/flatty3/images/meta_icons/apple-touch-icon-72x72.png" rel="apple-touch-icon-precomposed" sizes="72x72">
    <link href="/media/flatty3/images/meta_icons/apple-touch-icon-114x114.png" rel="apple-touch-icon-precomposed" sizes="114x114">
    <link href="/media/flatty3/images/meta_icons/apple-touch-icon-144x144.png" rel="apple-touch-icon-precomposed" sizes="144x144">
    <!--[if lt IE 9]>
    <script src="/media/theme/javascripts/html5shiv.js" type="text/javascript"></script>
    <![endif]-->
    <!-- / START - page related stylesheets [optional] -->

    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="/media/flatty3/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="/media/flatty3/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/media/flatty3/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/media/lsp/css/style.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="/media/flatty3/javascripts/ie/html5shiv.js" type="text/javascript"></script>
    <script src="/media/flatty3/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    <!-- / jquery -->
    <script src="/media/flatty3/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile events (for touch and slide) -->
    <script src="/media/flatty3/javascripts/plugins/mobile_events/jquery.mobile-events.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) -->
    <script src="/media/flatty3/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>

</head>
<body class="contrast-blue login contrast-background">
<div class="middle-container">
    <div class="middle-row">
        <div class="middle-wrapper">
            <div class="login-container-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blank headline text-center"><h1>LandHub.com</h1></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <?php echo @$content; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <?php if(isset($sub_content)): ?>
                                <?php echo @$sub_content; ?>
                                <?php else: ?>
                                    <a target="_blank" href="http://www.landhub.com">Listing Syndication Platform from LandHub.com</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- / jquery ui -->
<script src="/media/flatty3/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
<!-- / jQuery UI Touch Punch -->
<script src="/media/flatty3/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<!-- / bootstrap [required] -->
<script src="/media/flatty3/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
<!-- / modernizr -->
<script src="/media/flatty3/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
<!-- / retina -->
<script src="/media/flatty3/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
<!-- / theme file [required] -->
<script src="/media/flatty3/javascripts/theme.js" type="text/javascript"></script>
<!-- / START - page related files and scripts [optional] -->

<!-- / END - page related files and scripts [optional] -->
</body>
</html>
