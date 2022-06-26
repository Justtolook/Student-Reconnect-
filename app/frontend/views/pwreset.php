<div class="container-fluid">
    <?php
    if(isset($model->success)) {
        if ($model->success) {
            echo '<div class="alert alert-success" role="alert">
            <strong>Success!</strong> Dein  Passwort wurde erfolgreich zurückgesetzt.
            <a href="?t=frontend&request=login">Zum Login</a>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            <strong>Error!</strong> Dein Passwort konnte nicht zurückgesetzt werden. Bitte versuche es noch einmal.
            </div>';
        }
    }
    ?>
    <br><h1>Passwort vergessen?</h1><br><br>
<h2>Gib deine Uni-E-Mail Adresse ein, um dein Passwort zurückzusetzen. Möglicherweise musst du deinen Spamordner prüfen.</h2><br>
<form method="POST" action="index.php?t=frontend&request=pwresetemail">
    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail">
    </div>
    <button type="submit"  class="btn btn-primary">Senden</button><br><br><br>
</form>
<form method="POST" action="?t=frontend&request=pwreset">
    <!-- TODO display errors if there are any -->
    <div class="form-group">
        <input type="number" class="form-control" id="enteredcode" name="enteredcode" placeholder="Verifizierungscode">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Passwort setzen">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
    </div><br>
    <button type="submit" class="btn btn-primary">Passwort zurücksetzen</button><br><br>
</form>
    <a href="?t=frontend&request=login" class="login">Zurück zum Login</a><br>
</div>