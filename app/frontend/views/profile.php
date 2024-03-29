<div class="container-fluid mt-4">
    <div class="row text-center">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

            <img class="rounded-circle w-50 mt-2 mb-2" alt="Profile Image"
                 src="<?php echo($profilepicmodel->getProfileImagePath()) ?>"
                 data-holder-rendered="true">

        </div>
        <div class="col-md-4 mb-4">

            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                Profilbild bearbeiten
            </button>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTitle">Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                include 'profilepicedit.php';
                ?>
            </div>
        </div>
    </div>
</div>

<div style="text-align: center;">
    <b>
    <?php
    echo $profile->firstname . " " . $profile->lastname;
    ?>
    </b>
</div>

<table class="table table-borderless">
    <thead>
    <tr>
        <th scope="col">Geburtsdatum</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <div class="card border-dark">
                <div class="card-body">
                    <?php
                    echo $profile->birthdate;
                    ?>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>


<table class="table table-borderless">
    <thead>
    <tr>
        <!-- Scores -->
        <th scope="col">Host Score:
            <?php
            if ($visitenkarte->scoreHost == null) {
                echo "0";
            } else {
                echo $visitenkarte->scoreHost;
            }
            ?>
        </th>
        <th scope="col">Teilnehmer Score:
            <?php
            if ($visitenkarte->scoreAttendee == null) {
                echo "0";
            } else {
                echo $visitenkarte->scoreAttendee;
            }
            ?>
        </th>
    </tr>
    </thead>
</table>


<div class="col-md-11">
    <div class="row d-flex ml-2 mr-2">
        <?php
        foreach ($visitenkarte->interests as $interest) {
            echo '<label class="PillList-item"><input disabled type="checkbox" name="interests[]" value="' . $interestModel->getInterestName($interest) . '" checked><span class="PillList-label">' . $interestModel->getInterestName($interest) . '</span></label>';
        }
        ?>
    </div>
</div>

<table class="table table-borderless">
    <thead>
    <tr>
        <th scope="col">Beschreibung</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <div class="card border-dark">
                <div class="card-body text-break">
                    <?php
                    echo '<div class="textwrap">' . $profile->description . '</div>';
                    ?>
                </div>
            </div>
        </td>
    </tr>
</table>

<style>
    .modal-content {
        background-color: #DFF2E9;
    }
</style>
<!-- Button trigger modal -->
<button type="button" class="btn float-right" data-toggle="modal" data-target="#exampleModalCenter">
    Visitenkarte
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
            <div class="modal-body text-center">
                <button type="button" class="btn" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="?t=frontend&request=profileedit" class="btn text-center">Profil bearbeiten</a><br>
</div>

<style>
    .textwrap {
        white-space: pre-line;
    }
</style>

