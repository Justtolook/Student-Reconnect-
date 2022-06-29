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
<div class="content">
    {{content}}
</div>
</body>
</html>

