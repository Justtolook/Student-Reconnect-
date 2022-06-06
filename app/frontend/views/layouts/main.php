<?php ?>
<html>
<head>
    <title>Frontend Main</title>
    <script src="app/frontend/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="app/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="app/frontend/css/colours.css">
    <link rel="stylesheet" href="app/frontend/css/style.css">
    <!-- TODO: include jquery for bootstrap -->
</head>
<body>
    <!-- define navbar -->
    <nav class="navbar sticky-top container-fluid">
        <a class="navbar-brand" href="?t=frontend&request=landingpage">
            <img src="res/Logo_weiß_Schrift_transparent 1.png" width="150" height="150" class="d-inline-block align-top" alt="">
            Student Reconnect
        </a>
    </nav>
    <!-- content will be inserted here by the view handler-->
    <div class="content">
        {{content}}
    </div>
    <!-- define footer -->
    <footer id="sticky-footer" class="page-footer purple fixed-bottom container-fluid">
        <div class="row">
                <a class="p-2 col footer-item">Matching</a>
                <a class="p-2 col footer-item footer-item">Events</a>
                <a href="?t=frontend&request=profile" class="p-2 col footer-item">Profil</a>
        </div>
    </footer>
</body>
</html>

