<div class="reportItem">
    <?php
    echo '<div class="reportItem_id">' . $report->id_report . '</div>';
    if ($report->status == 0) {
        echo '<div class="reportItem_status">Offen</div>';
    } else {
        echo '<div class="reportItem_status">Geschlossen</div>';
    }
    echo '<div class="reportItem_description">' . $report->description . '</div>';
    echo '<div class="reportItem_userReporter">' . $report->id_userReporter . '</div>';
    if($report->id_userReported != null) {
        echo '<div class="reportItem_userReported"> Reported: ' . $report->id_userReported . '</div>';
    } else {
        echo '<div class="reportItem_userReported">-</div>';
    }


    ?>
    <hr>
</div>