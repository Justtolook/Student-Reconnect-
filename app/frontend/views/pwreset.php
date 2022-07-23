
<div class="container-fluid">
    <?php
    if(isset($model->success)) {
        if ($model->success) {
            echo '<div class="alert alert-success" role="alert">
            <strong>Success!</strong> Dein Passwort wurde erfolgreich zurückgesetzt.
            <a href="?t=frontend&request=login">Zum Login</a>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            <strong>Error!</strong> Dein Passwort konnte nicht zurückgesetzt werden. Bitte versuche es noch einmal.
            </div>';
        }
    }
    ?>
    <br><strong><h1>Passwort vergessen?</strong></h1>
    <div style = "padding: 80px 80px 10px;" class="row justify-content-center">
        <div class="card pastelgruen border-success m-3" style="width: 25rem;">
            <h2>Gib deine Uni-E-Mail Adresse ein, um dein Passwort zurückzusetzen. Möglicherweise musst du deinen Spamordner prüfen.</h2><br>
            <div style = "padding: 100px 100px 10px;">
            </div>
            <form method="POST" action="index.php?t=frontend&request=pwresetemail">
                <div class="form-group row justify-content-center">
                    <input type="email" class="form-control w-75 border border-dark shadow" id="email" name="email" placeholder="E-Mail">
                </div>
                <div class="row justify-content-center">
                    <button type="submit"  class="btn text-center">Senden</button>
                </div>
        </div>
    </div>
    </form>

    <div style ="padding: 50px 80px 10px;" class="row justify-content-center">
        <div class="card pastelgruen border-success m-3" style="width: 25rem;">
            <div style = "padding: 40px 20px 10px;"></div>
            <form method="POST" action="?t=frontend&request=pwreset">
                <!-- TODO display errors if there are any -->
                <div class="form-group row justify-content-center">
                    <input type="text" class="form-control w-75 border border-dark shadow" id="enteredcode" name="enteredcode" placeholder="Verifizierungscode">
                </div><br>
                <div class="form-group row justify-content-center">
                    <input type="password" class="form-control w-75 border border-dark shadow" id="newpassword" name="newpassword" placeholder="Passwort setzen">
                </div><br>
                <div class="form-group row justify-content-center">
                    <input type="password" class="form-control w-75 border border-dark shadow" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
                </div><br>
                <div class="row justify-content-center">
                    <button type="submit" class="btn text-center">Passwort zurücksetzen</button>
                </div>
            </form>
        </div>
    </div> <br>
    <a href="?t=frontend&request=login" class="mr-5 link-primary float-right">Zurück zum Login</a><br>
</div>
<div style="padding: 20px 0px;"></div>

<?php
if(isset($_SESSION['verifcode'])) { ?>
<?php } ?>
