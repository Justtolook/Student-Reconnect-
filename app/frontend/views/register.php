<div class="container-fluid">
<<<<<<< app/frontend/views/register.php
    <br><h1>Registrierung</h1><br><br>
    <form method="POST" action="?t=frontend&request=register">
        <div class="form-group row justify-content-center">
            <input type="text" class="form-control w-75 border border-dark <?php echo $model->hasError('firstname') ? 'is-invalid' : ''?>" id="firstname" name="firstname" placeholder="Vorname">
        <?php
        if($model->hasError('firstname')) {
            echo "<div class='invalid-feedback'> " . $model->getError('firstname') . "</div>";
        }
        ?>
        </div><br>
        <div class="form-group row justify-content-center">
            <input type="text" class="form-control w-75 border border-dark <?php echo $model->hasError('lastname') ? 'is-invalid' : ''?>" id="lastname" name="lastname" placeholder="Nachname">
        <?php
        if($model->hasError('lastname')) {
            echo "<div class='invalid-feedback'> " . $model->getError('lastname') . "</div>";
        }
        ?>
        </div><br>
        <div class="form-group row justify-content-center">
            <input type="email" class="form-control w-75 border border-dark <?php echo $model->hasError('email') ? 'is-invalid' : ''?>" id="email" name="email" placeholder="E-Mail">
        <?php
        if($model->hasError('email')) {
            echo "<div class='invalid-feedback'>" . $model->getError('email') . "</div>";
        }
        ?>
        </div><br>
        <div class="form-group row justify-content-center">
            <input type="password" class="form-control w-75 border border-dark <?php echo $model->hasError('password') ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Passwort">
        <?php
        if($model->hasError('password')) {
            echo "<div class='invalid-feedback'> " . $model->getError('password') . "</div>";
        }
        ?>
        </div><br>
        <div class="form-group row justify-content-center">
            <input type="password" class="form-control w-75 border border-dark <?php echo $model->hasError('passwordrepeat') ? 'is-invalid' : ''?>" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
        <?php
        if($model->hasError('passwordrepeat')) {
            echo "<div class='invalid-feedback'> " . $model->getError('passwordrepeat') . "</div>";
        }
        ?>
        </div><br>
        <div class="form-group row justify-content-center">
            <select class="form-control w-75 row border border-dark">
                <option selected>Geschlecht</option>
                <option value=>Männlich</option>
                <option value=>Weiblich</option>
                <option value=>Divers</option>
            </select>
        </div><br>
        <div class="form-group row justify-content-center">
            <input type="date" class="form-control w-75 border border-dark " id="birthdate" name="birthdate" placeholder="Geburtsdatum">
        <?php
        if($model->hasError('birthdate')) {
            echo "<div class='invalid-feedback'> " . $model->getError('birthdate') . "</div>";
        }
        ?>
        </div><br>
        <a href="?t=frontend&request=login" class="link-primary float-right">Zurück zum Login</a><br>
        <div style = "padding: 200px 100px 10px;" class="row justify-content-center">
            <button type="submit" class="btn btn-success mx-auto">Account anlegen</button><br>
        </div>
    </form>
>>>>>>> app/frontend/views/register.php
</div>
