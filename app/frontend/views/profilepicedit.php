<div class="container-fluid">
<br><h1>Profilbild bearbeiten</h1><br><br>
<form action="?t=frontend&request=profilepicedit" method="post" enctype="multipart/form-data">
    Profilbild bearbeiten:
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
</div>
