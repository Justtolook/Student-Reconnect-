<div class="container-fluid">
    <div class="row">
        <div class="col text-center">
<br><h1>Profilbild bearbeiten</h1><br><br>
<form action="?t=frontend&request=profile" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" onchange="loadFile(event)">
    <img id="output"/>
    <script>
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    <input type="submit" class="btn" value="Bild speichern" name="submit">
    <br><br><br>
    <a href="?t=frontend&request=profile" class="btn">Zurück zum Profil</a>
</form>
<form action="?t_frontend&request=profile/rmvprofilepic" method="post">
    <input type="submit" class="btn" value="Profilbild entfernen" name="submit">
</form>
</div>
</div>
</div>

