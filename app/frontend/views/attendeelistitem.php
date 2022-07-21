<div class="row text-center">
    <div class="col-md-4 align-middle"><?php
        echo $user->firstname . " " . $user->lastname;
        ?>
    </div>
    <div class="col-md-8">
        <button class="btn" onclick="getVisitenkartenContent(<?php echo $user->id_user; ?>)" data-uid="<?php echo $user->id_user; ?>" data-toggle="modal" data-target="#userDetailsModal">
            Details
        </button>
        <button class="btn toggle-acceptance-button" data-eid="<?php echo $attendee->id_Event; ?>"  data-uid="<?php echo $user->id_user; ?>" onclick="toggleAcceptance(this)">
            <?php
            if($attendee->accepted) {
                echo "Ablehnen";
            }
            else {
                echo "Annehmen";
            }
            ?>
        </button>
    </div>
</div>