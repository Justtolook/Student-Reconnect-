<div class="container-fluid">
<br><h1>Registrierung</h1><br><br>
<form method="POST" action="?t=frontend&request=register">
    <div class="form-group">
        <input type="text" class="form-control <?php echo $model->hasError('firstname') ? 'is-invalid' : ''?>" id="firstname" name="firstname" placeholder="Vorname">
    </div><br>
    <div class="form-group">
        <input type="text" class="form-control <?php echo $model->hasError('lastname') ? 'is-invalid' : ''?>" id="lastname" name="lastname" placeholder="Nachname">
    </div><br>
    <div class="form-group">
        <input type="email" class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" placeholder="E-Mail">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Passwort">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control <?php echo $model->hasError('passwordrepeat') ? 'is-invalid' : ''?>" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
    </div><br>
    <div class="form-groups">
        <select name="gender" id="gender" placeholder="Geschlecht">
            <option value="maennlich">Männlich</option>
            <option value="weiblich">Weiblich</option>
            <option value="divers">Divers</option>
        </select>
    </div><br>
    <div class="form-group">
        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Geburtsdatum">
        <?php
        if($model->hasError('birthdate')) {
            echo "<div>Bitte gib dein Geburtsdatum an!<div>";
        }
        ?>
    </div><br>
    <a href="?t=frontend&request=login" class="login">Zurück zum Login</a><br><br>
    <button type="submit" class="btn btn-primary">Account anlegen</button><br><br>
</form>
</div>
