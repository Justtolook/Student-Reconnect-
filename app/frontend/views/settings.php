<!-- implement logout button -->
<div class="form-group">
    <form action="?t=frontend&request=logout" method="post">
        <input type="submit" value="Logout" class="btn btn-primary">
    </form>
</div>
<?php
if(Application::$app->controller->isModerator()) {
    echo '<div class="form-group">
    <form action="?t=frontend&request=moderation" method="post">
        <input type="submit" value="Moderationsbereich" class="btn btn-primary">
    </form>
    </div>';}
?>
