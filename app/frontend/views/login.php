<p class="container-fluid">
<div style = "padding: 100px 100px 10px;">
    <br><h1>Bei Student Reconnect anmelden</h1><br><br>
    <form method="POST" action="?t=frontend&request=login">
        <div class="form-group row justify-content-center">
            <input type="email" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" placeholder="E-Mail">
            <div class="invalid-feedback">
                <?php echo $model->getError('email') ?>
            </div>
        </div> <br>
        <div class="form-group row justify-content-center">
            <input type="password" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Passwort">
            <div class="invalid-feedback">
                <?php echo $model->getError('password') ?>
            </div>
        </div>
<br>
<a href="?t=frontend&request=pwreset" class="mr-5 link-primary float-right">Passwort vergessen?</a><br>
<div style = "padding: 100px 100px 10px;" class="row justify-content-center">
    <button type="submit" class="btn mx-auto">Einloggen</button>
</div>
        <div class="p-5"></div>
<div>
    <br><h2>Du hast noch keinen Account?</h2><br>
    <div class="row justify-content-center">
        <a href="?t=frontend&request=register" class="btn mx-auto">Jetzt registrieren</a><br>
    </div>
</div>
</form>
</div>