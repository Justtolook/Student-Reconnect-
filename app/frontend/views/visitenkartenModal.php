<script>
    //handle event report button click
    function reportUser(uid) {
        //redirect to the report event page
        window.location.href = 'index.php?t=frontend&request=reportUser&id_user=' + uid;
    }
</script>
<div class="visitenkartenModal">
    <div class="text-center">
        <img class="rounded-circle w-50 mt-2 mb-2" alt="Profile Image"
             src="<?php echo($profilepicmodel->getProfileImagePath()) ?>"
             data-holder-rendered="true">
    </div>
    <h1 class="text-center font-weight-bold">
        <?php
        echo $visitenkarte->firstname . " " . $visitenkarte->lastname . "<br>";
        ?>
    </h1>

    <h2 class="text-center">

        <table class="table table-borderless ml-3">
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
    </h2>

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
            <th scope="col">Beschreibung</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="row">
                <div class="card border-dark">
                    <div class="card-body text-break">
                        <?php
                        echo '<div class="textwrap">' . $visitenkarte->description . '</div>';
                        ?>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
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
            <th scope="col">Kontaktinformationen</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="row">
                <div class="card border-dark">
                    <div class="card-body text-break">
                        <?php
                        echo '<div class="textwrap">' . $visitenkarte->contactInformation . '</div>';
                        ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="text-center">
        <?php
        if ($visitenkarte->id_user != $_SESSION['user']['id_user']) {
            echo '<button onclick="reportUser(' . $visitenkarte->id_user . ')" type="button" class="btn" data-toggle="modal" data-target="#visitenkartenModal">
            User melden
        </button>';
        }
        ?>
    </div>
</div>
