<div class="container-fluid">
<br><h1>Bei Student Reconnect anmelden</h1><br><br>
<form method="POST" action="?t=frontend&request=login">
    <div class="form-group">
        <input type="email" class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" placeholder="E-Mail">
        <div class="invalid-feedback">
            <?php echo $model->getError('email') ?>
        </div>
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Passwort">
        <div class="invalid-feedback">
            <?php echo $model->getError('password') ?>
        </div>
    </div><br>
    <a href="?t=frontend&request=pwreset" class="pw-reset">Passwort vergessen?</a>
    <button type="submit" class="btn btn-primary">Einloggen</button><br><br>
    <h2>Du hast noch keinen Account?</h2><br>
    <a href="?t=frontend&request=register" class="btn">Jetzt registrieren</a><br>
</form>
</div>