<!DOCTYPE html>
<html>
<head>
    <title>LandHub.com</title>
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
    <script src="/media/flatty3/javascripts/html5shiv.js" type="text/javascript"></script>
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
    <!-- / jquery migrate (for compatibility with new jquery) -->
    <script src="/media/flatty3/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>

</head>
<body class="contrast-blue fixed-header fixed-navigation">
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <a class="navbar-brand" href="/">Land Hub</a>
        <a class="toggle-nav btn pull-left" href="#">
            <i class="icon-reorder"></i>
        </a>
        <ul class="nav">
            <li class="dropdown dark user-menu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="user-name hidden-phone"><?php echo ucfirst($user->first_name).' '.ucfirst($user->last_name); ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/account"><i class="icon-user"></i> Account Settings</a></li>
                    <li class="divider"></li>
                    <li> <a href="/logout"><i class="icon-signout"></i> Sign out</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<div id="wrapper">
    <div id="main-nav-bg"></div>
    <nav class="main-nav-fixed" id="main-nav">
        <div class="navigation">
            <?php /*
            <div class="search hidden-phone">
                <form action="index.html" method="get">
                    <div class="search-wrapper">
                        <input value="" class="search-query" placeholder="Search..." autocomplete="off" name="q" type="text" />
                        <button class="btn btn-link icon-search" name="button" type="submit"></button>
                    </div>
                </form>
            </div>
            */ ?>
            <?php echo View::factory('html/navigation/sidebar')->set('user', @$user); ?>
        </div>
    </nav><!-- nav -->
    <section id="content">
        <div class="container">
            <div class="row" id="content-wrapper">
                <div class="col-xs-12">
                    <?php echo @$content; ?>
                </div>
            </div>

            <footer id="footer">
                <div class="footer-wrapper">
                    <div class="row">
                        <div class="col-sm-6 text">
                            Copyright © 2013 LandHub.com
                        </div>
                        <div class="col-sm-6 buttons">
                            <small>Powered by LandHub.com</small>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>
</div><!-- wrapper -->

<!-- / jquery [required] -->
<script src="/media/flatty3/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<!-- / jquery mobile (for touch events) -->
<script src="/media/flatty3/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
<!-- / jquery migrate (for compatibility with new jquery) [required] -->
<script src="/media/flatty3/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
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
<script src="/media/flatty3/javascripts/plugins/flot/excanvas.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/flot/flot.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/flot/flot.resize.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/timeago/jquery.timeago.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/common/wysihtml5.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/media/flatty3/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<script src="/media/lsp/js/lib.js" type="text/javascript"></script>
</body>
</html>
