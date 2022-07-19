<tr>
    <td><?php
        echo $user->firstname . " " . $user->lastname;
        ?>
    </td>
    <td>
        <button class="btn btn-outline-primary" onclick="getVisitenkartenContent(<?php echo $user->id_user; ?>)" data-uid="<?php echo $user->id_user; ?>" data-toggle="modal" data-target="#userDetailsModal">
            Details
        </button>
        <button class="btn btn-outline-light toggle-acceptance-button" data-eid="<?php echo $attendee->id_Event; ?>"  data-uid="<?php echo $user->id_user; ?>" onclick="toggleAcceptance(this)">
            <?php
            if($attendee->accepted) {
                echo "Ablehnen";
            }
            else {
                echo "Annehmen";
            }
            ?>
        </button>
    </td>
</tr>