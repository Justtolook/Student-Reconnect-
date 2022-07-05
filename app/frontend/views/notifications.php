<h1>notifications</h1>


<?php
foreach ($notifications->matches as $match) {
    echo "Sie wurde gematched mit der UserID: " . $match['id_user'] . "<br>";
    echo "Der Timestamp des Matches ist: " . $match['timestamp'] . "<br>";
    echo "Gelesen? " . $match['notificationRead'] . "<br>";
    echo "<hr>";
}
?>