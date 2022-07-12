<h1>
    Profile
</h1>
<br>
<br>
<div class="row text-center">

    <!--Grid column-->
    <div class="col-md-6 mb-4">

        <img class="rounded-circle" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg"
             data-holder-rendered="true">
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Profilbild bearbeiten
    </button>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTitle" >Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                include 'profilepicedit.php';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<table class="table table-borderless">
    <thead>
    <tr>
        <th scope="col">Vorname</th>
        <th scope="col">Nachname</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <div class="card">
            <div class="card-body">
                <?php
                echo $profile->firstname;
                ?>
            </div>
            </div>
        </td>
        <td>
            <div class="card">
                <div class="card-body">
                    <?php
                    echo $profile->lastname;
                    ?>
                </div>
            </div>
            </div>
        </td>
    </tr>
<tr>
    <td scope="row">
        <div class="card">
            <div class="card-body">
                Interessen
            </div>
        </div>
    </td>
    <td>
        <div class="card">
            <div class="card-body">
                Eigenschaften
            </div>
        </div>
        </div>
    </td>
</tr>
    </tbody>
</table>

<table class="table table-borderless">
    <thead>
    <tr>
        <th scope="col">Kurzbeschreibung</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <div class="card">
                <div class="card-body">
                    <?php
                    echo $profile->description;
                    ?>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>






<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
    Visitenkarte
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Visitenkarte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                include 'visitenkartenModal.php'
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="?t=frontend&request=profileedit" class="btn btn-primary">Profil bearbeiten</a><br>
</div>
