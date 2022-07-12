<div class="visitenkartenModal">
    <?php
    if($visitenkarte->id_user != $_SESSION['user']['id_user']) {
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
