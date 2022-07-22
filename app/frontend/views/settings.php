<div class="container-fluid">
    <div class="row justify-content-center pt-4">
        <h1>Das Nutzerhandbuch findest du hier:</h1>
    </div>
    <div class="row justify-content-center">
        <div class="card pastelgruen border-success m-5">
            <div class="p-3">
                <br>
                <h1>Wenn du Probleme bei der Verwendung der App hast, kannst du hier unser Nutzerhandbuch
                    downloaden:</h1>
                <div class="row justify-content-center p-4">
                    <a href="?t=frontend&request=nutzerhandbuch" class="link-primary float-none">Nutzerhandbuch</a><br>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center p-4">
    <h1>Das Impressum findest du hier:</h1>
    </div>
    <div class="row justify-content-center p-4">
        <a href="?t=frontend&request=impressum" class="link-primmary float-none">Impressum</a><br>
    </div>
    <div class="form-group row justify-content-center">
        <form action="?t=frontend&request=logout" method="post">
            <div style="padding: 50px 10px 10px;" class="row justify-content-center">
                <button type="submit" class="btn text-center">Logout</button>
            </div>
        </form>
    </div>
    <div class="form-group row justify-content-center">
        <?php
        if (Application::$app->controller->isModerator()) {
            echo '<div style = "padding: 20px 10px 10px;" class="form-group">
    <form action="?t=frontend&request=moderation" method="post">
        <button class="btn text-center">Moderationsbereich </button>
    </form>
    </div>';
        }
        ?>
    </div>
    <div class="form-group row justify-content-center">
        <?php
        if (Application::$app->controller->isAdmin()) {
            echo '<div class="form-group">
    <form action="?t=backend&request=user" method="post">
        <button class="btn text-center">Adminbereich </button>
    </form>
    </div>';
        }
        ?>
    </div>
</div>
</div>

