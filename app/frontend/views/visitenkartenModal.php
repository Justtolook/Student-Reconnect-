<div class="visitenkartenModal">
    <div class="text-center">
        <img class="rounded-circle w-50 mt-2 mb-2" alt="Profile Image"
             src="<?php echo($profilepicmodel->getProfileImagePath()) ?>"
             data-holder-rendered="true">
    </div>
    <?php
    if ($visitenkarte->id_user != $_SESSION['user']['id_user']) {
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visitenkartenModal">
            User melden
        </button>';
    }
    echo "Name: " . $visitenkarte->firstname . " " . $visitenkarte->lastname . "<br>";
    echo "Beschreibung: " . $visitenkarte->description . "<br>";
    echo "Interessen: <br>";
    echo "<ul>";
    foreach ($visitenkarte->interests as $interest) {
        echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
    }
    echo "</ul>";
    echo "Kontaktinformationen: <br>" . $visitenkarte->contactInformation;

    ?>
</div>
