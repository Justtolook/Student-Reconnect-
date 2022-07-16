<?php
?>
<div class="mt-2 mb-3">
<h1>Meldevorgänge</h1>
</div>
<?php
foreach($reports as $report) {

    include 'app/frontend/views/reportItem.php';
}