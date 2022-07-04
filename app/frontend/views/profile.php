<h1>
    Profile
</h1>

<div>
<a href="?t=frontend&request=profilepicedit" class="btn">Profilbild bearbeiten</a><br>
</div>

<?php
// print own visitenkarte
include 'app/frontend/views/visitenkartenModal.php';

//Show Profile Information 
if($profile->id_user != $_SESSION['user']['id_user']) {
    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfileTestModal">
        User melden
    </button>';
}
echo "Name: " . $profile->firstname . " " . $profile->lastname . "<br>";
echo "Geschlecht: " . $profile->gender . "<br>";
echo "scoreHost: " . $profile->scoreHost . "<br>";
echo "scoreAttendee: " . $profile->scoreAttendee . "<br>";
echo "Beschreibung: " . $profile->description . "<br>";
echo "Interessen: <br>";
echo "<ul>";
foreach ($profile->interests as $interest) {
    echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
}
echo "</ul>";
echo "Kontaktinformationen: <br>" . $profile->contactInformation;

?>
<div>
<a href="?t=frontend&request=profileedit" class="btn">Profil bearbeiten</a><br>
</div>