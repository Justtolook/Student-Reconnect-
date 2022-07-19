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
        <br><h1>Das Impressum findest du hier:</h1>
        <div style = "padding: 50px 10px 10px;" class="row justify-content-center">
            <a href="?t=frontend&request=impressum" class="link-primmary float-none">Impressum</a><br>
        </div>
    <div class="form-group row justify-content-center">
        <form action="?t=frontend&request=logout" method="post">
            <div style = "padding: 50px 10px 10px;" class="row justify-content-center">
                <button type="submit" class="btn text-center">Logout</button>
            </div>
        </form>
    </div>
    <div class="form-group row justify-content-center">
<?php
if(Application::$app->controller->isModerator()) {
    echo '<div style = "padding: 20px 10px 10px;" class="form-group">
    <form action="?t=frontend&request=moderation" method="post">
        <button class="btn text-center">Moderationsbereich </button>
    </form>
    </div>';}
?>
    </div>
    <div class="form-group row justify-content-center">
        <?php
if(Application::$app->controller->isAdmin()) {
    echo '<div class="form-group">
    <form action="?t=backend&request=user" method="post">
        <button class="btn text-center">Adminbereich </button>
    </form>
    </div>';}
?>
    </div>
</div>
</div>

