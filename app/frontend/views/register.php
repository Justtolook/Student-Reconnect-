<div class="container-fluid">
<br><h1>Registrierung</h1><br><br>
<form method="POST" action="?t=f&request=register">
    <div class="form-group">
        <input type="text" class="form-control" id="vorname" name="vorname" placeholder="Vorname">
    </div><br>
    <div class="form-group">
        <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname">
    </div><br>
    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Passwort">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Passwort">
    </div><br>
    <div class="form-group">   
        <select name="gender" id="gender" placeholder="Geschlecht">
            <option value="maennlich">Männlich</option>
            <option value="weiblich">Weiblich</option>
            <option value="divers">Divers</option>
        </select>
    </div><br>
    <div class="form-group">
        <input type="date" class="form-control" id="gbdatum" name="gbdatum" placeholder="Geburtsdatum">
    </div><br>
    <a href="?t=f&request=login" class="login">Zurück zum Login</a><br><br>
    <button type="submit" class="btn btn-primary">Account anlegen</button><br><br>
</form>
</div>
