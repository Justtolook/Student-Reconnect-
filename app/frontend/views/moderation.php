<?php
?>
<h1>Moderation</h1>
<?php
foreach($reports as $report) {

    include 'app/frontend/views/reportItem.php';
}