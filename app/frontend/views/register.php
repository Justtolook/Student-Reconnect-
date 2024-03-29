<div class="container-fluid">
<br><h1>Registrierung</h1><br><br>
<form method="POST" action="?t=frontend&request=register">
    <div class="form-group row justify-content-center">
        <input type="text" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('firstname') ? 'is-invalid' : ''?>" id="firstname" name="firstname" placeholder="Vorname">
        <?php
        if($model->hasError('firstname')) {
            echo "<div class='invalid-feedback'> " . $model->getError('firstname') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group row justify-content-center">
        <input type="text" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('lastname') ? 'is-invalid' : ''?>" id="lastname" name="lastname" placeholder="Nachname">
        <?php
        if($model->hasError('lastname')) {
            echo "<div class='invalid-feedback'> " . $model->getError('lastname') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group row justify-content-center">
        <input type="email" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" placeholder="E-Mail">
        <?php
        if($model->hasError('email')) {
            echo "<div class='invalid-feedback'>" . $model->getError('email') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group row justify-content-center">
        <input type="password" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Passwort">
        <?php
        if($model->hasError('password')) {
            echo "<div class='invalid-feedback'> " . $model->getError('password') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group row justify-content-center">
        <input type="password" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('passwordrepeat') ? 'is-invalid' : ''?>" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
        <?php
        if($model->hasError('passwordrepeat')) {
            echo "<div class='invalid-feedback'> " . $model->getError('passwordrepeat') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group row justify-content-center">
        <select class="form-control w-75 row border border-dark shadow" name="gender">
            <option value="d" selected>Divers</option>
            <option value="m">Männlich</option>
            <option value="f">Weiblich</option>
        </select>
    </div><br>
    <div class="form-group row justify-content-center">
        <input type="date" class="form-control w-75 border border-dark shadow <?php echo $model->hasError('birthdate') ? 'is-invalid' : ''?>" id="birthdate" name="birthdate" placeholder="Geburtsdatum">
        <?php
        if($model->hasError('birthdate')) {
            echo "<div class='invalid-feedback'> " . $model->getError('birthdate') . "</div>";
        }
        ?>
    </div>
    <br>
    <a href="?t=frontend&request=login" class="mr-5 link-primary float-right">Zurück zum Login</a><br><br>
    <div class="form-group row justify-content-center">
    <button type="submit" class="btn text-center">Account anlegen</button><br><br>
    </div>
</form>
</div>
