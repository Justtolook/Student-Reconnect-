<div class="container-fluid">
<br><h1>Passwort vergessen?</h1><br><br>
<h2>Gib deine Uni-E-Mail Adresse ein, um dein Passwort zurückzusetzen. Möglicherweise musst du deinen Spamordner prüfen.</h2><br>
<form method="POST" action="?t=frontend&request=pwreset">
    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail">
    </div>
    <button type="button" class="btn btn-primary">Senden</button><br><br><br>
    <div class="form-group">
        <input type="number" class="form-control" id="verifcode" name="verifcode" placeholder="Verifizierungscode">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Passwort setzen">
    </div><br>
    <div class="form-group">
        <input type="password" class="form-control" id="passwordrepeat" name="passwordrepeat" placeholder="Passwort wiederholen">
    </div><br>
    <button type="submit" class="btn btn-primary">Passwort zurücksetzen</button><br><br>  
    <a href="?t=frontend&request=login" class="login">Zurück zum Login</a><br>
</div>