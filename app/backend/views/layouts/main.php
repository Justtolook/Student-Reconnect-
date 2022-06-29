<?php
//set access control header to allow cross origin resource sharing
header("Access-Control-Allow-Origin: *");
?>
<html>
<head>
    <title>Backend Main</title>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script src="app/frontend/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="app/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="app/frontend/css/colours.css">
    <link rel="stylesheet" href="app/backend/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Student Reconnect - Administration</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="?t=backend&request=user">Users</a>
            <a class="nav-item nav-link" href="?t=backend&request=events">Events</a>
            <a class="nav-item nav-link" href="?t=backend&request=interests">Interessen</a>
        </div>
    </div>
</nav>
<div class="content">
    {{content}}
</div>
</body>
</html>

