<html>
<head>
    <title>Frontend Main</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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

</body>
</html>

