<div class="visitenkartenModal">

    <?php
    if ($visitenkarte->id_user != $_SESSION['user']['id_user']) {
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visitenkartenModal">
            User melden
        </button>';
    }
    ?>

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
                echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' . $interestModel->getInterestName($interest) . '" checked><span class="PillList-label">' . $interestModel->getInterestName($interest) . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
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
        </tbody>
    </table>
</div>
