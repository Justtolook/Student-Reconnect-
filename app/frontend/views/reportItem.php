<div class="reportItem card pastelgruen border-success ml-3 mr-3">
    <div class="card-body">
        <?php
        echo '<div class="reportItem_id"><span>Vorgangsnummer : ' . $report->id_report . '</span></div>';
        if ($report->status == 0) {
            echo '<div class="reportItem_status">Status : Offen</div>';
        } else if ($report->status == 1) {
            echo '<div class="reportItem_status">Status : Akzeptiert</div>';
        } else if ($report->status == 2) {
            echo '<div class="reportItem_status">Status : Abgelehnt</div>';
        }
        if ($report->type == 'e') {
            echo '<div class="reportItem_type">Gemeldetes Objekt : Event</div>';
        } else if ($report->type == 'u') {
            echo '<div class="reportItem_type">Gemeldetes Objekt : User</div>';
        }
        echo '<div class="reportItem_description"><span>Beschreibung : ' . $report->description . '</span></div>';
        echo '<div class="reportItem_userReporter"><span>Melder:in : ' . $report->id_userReporter . '</span></div>';
        if ($report->id_objectReported != null) {
            echo '<div class="reportItem_userReported"> Gemeldete:r : ' . $report->id_objectReported . '</div>';
        } else {
            echo '<div class="reportItem_userReported">-</div>';
        }


        ?>
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-5 text-center">
        <button class="btn" onclick="">Annehmen</button>
            </div>
            <div class="col-md-5 text-center">
        <button class="btn" onclick="">Ablehnen</button>
            </div>
        </div>
    </div>
</div>
<br>