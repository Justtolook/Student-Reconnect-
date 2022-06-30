<?php ?>
<html>
<head>
    <title>Frontend Main</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="app/frontend/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="app/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="app/frontend/css/colours.css">
    <link rel="stylesheet" href="app/frontend/css/style.css">
</head>
<body>
    <!-- define navbar -->
    <nav class="navbar sticky-top container-fluid">
        <a class="navbar-brand" href="?t=frontend&request=landingpage">
            <img src="res/Logo_weiß_Schrift_transparent 1.png" width="150" height="150" class="d-inline-block align-top" alt="">
            Student Reconnect
        </a>
        <!-- only show notification and settings button if the user is logged in -->
        <?php if (Application::$app->controller->isLoggedIn()) echo '
        <a class="nav-link" href="?t=frontend&request=notifications">
            <img src="res/notifications.png" width="55" height="55" class="d-inline-block align-top" alt="">
        </a>
        <a class="nav-link" href="?t=frontend&request=settings">
            <img src="res/settings.png" width="55" height="55" class="d-inline-block align-top" alt="">
        </a>
        ';?>
    </nav>
    <!-- content will be inserted here by the view handler-->
    <div class="content">
        {{content}}
    </div>
    <!-- define footer -->
    <footer id="sticky-footer" class="page-footer purple fixed-bottom container-fluid">
        <div class="row">
                <a href="?t=frontend&request=matching" class="p-2 col footer-item">Matching</a>
                <a href="?t=frontend&request=events" class="p-2 col footer-item footer-item">Events</a>
                <a href="?t=frontend&request=profile" class="p-2 col footer-item">Profil</a>
        </div>
    </footer>
</body>
</html>

