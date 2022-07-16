<div class="reportItem">
    <?php
    echo '<div class="reportItem_id">' . $report->id_report . '</div>';
    if ($report->status == 0) {
        echo '<div class="reportItem_status">Offen</div>';
    } else if ($report->status == 1) {
        echo '<div class="reportItem_status">Akzeptiert</div>';
    }
    else if ($report->status == 2) {
        echo '<div class="reportItem_status">Abgelehnt</div>';
    }
    if($report->type == 'e') {
        echo '<div class="reportItem_type">Event</div>';
    } else if ($report->type == 'u') {
        echo '<div class="reportItem_type">User</div>';
    }
    echo '<div class="reportItem_description">' . $report->description . '</div>';
    echo '<div class="reportItem_userReporter">' . $report->id_userReporter . '</div>';
    if($report->id_objectReported != null) {
        echo '<div class="reportItem_userReported"> Reported: ' . $report->id_objectReported . '</div>';
    } else {
        echo '<div class="reportItem_userReported">-</div>';
    }


    ?>
    <hr>
</div>