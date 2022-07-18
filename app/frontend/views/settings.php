<!-- implement logout button -->
<div class="container-fluid">
    <div style = "padding: 100px 100px 10px;" class="row justify-content-center">
    <br><h1>Das Nutzerhandbuch findest du hier:</h1><br><br>
        <div style= "padding: 100px 10px 10px;" </div>
    <div class="card pastelgruen border-success m-3">
        <div class="p-3">
            <br><h1>Wenn du Probleme bei der Verwendung der App hast, kannst du hier unser Nutzerhandbuch downloaden:</h1>
            <div style = "padding: 50px 10px 10px;" class="row justify-content-center">
            <a href="?t=frontend&request=nutzerhandbuch" class="link-primary float-none">Nutzerhandbuch</a><br>
            </div>
        </div>
    </div>
        <div style = "padding: 150px 100px 10px;" class="row justify-content-center">
            <br><h1>Das Impressum findest du hier:</h1>
            <a href="?t=frontend&request=impressum" style = "padding: 50px 10px 10px;" class="link-primmary">Impressum</a><br>
        </div>
        </div>
    <div style = "padding: 100px 100px 10px;" class="row justify-content-center">
        <div class="form-group">
    <form action="?t=frontend&request=logout" method="post">
        <input type="submit" value="Logout" class="btn text-center">
    </form>
        </div>
</div>
<?php
if(Application::$app->controller->isModerator()) {
    echo '<div style = "padding: 50px 100px 10px;" class="form-group">
    <form action="?t=frontend&request=moderation" method="post">
        <button class="btn text-center">Moderationsbereich </button>
    </form>
    </div>';}
if(Application::$app->controller->isAdmin()) {
    echo '<div class="form-group">
    <form action="?t=backend&request=user" method="post">
        <input type="submit" value="Adminbereich" class="btn">
    </form>
    </div>';}
?>
    </div>
</div>