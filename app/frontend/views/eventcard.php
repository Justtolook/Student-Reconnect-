<!--
An event card that acts as a template and can be filled with data from an event model
it should contain the following information:
- a hidden field with the id of the event
- name
- description
- location_rough
- eventDate
- a button to open a modal to sign on for the event
-->
<div class="eventcard card pastelgruen border-success ml-3 mr-3">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="event-name">
                        <h3>
                            <?php echo $event->name ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="event-description"><?php echo $event->description ?></div>
                </div>
                <div class="col-md-4 border-left border-success p-0">
                    <div class="pl-2" id="event-eventDate">
                        <i class="fa fa-clock-four"> </i>
                        <?php echo $event->eventDate ?>
                    </div>
                    <hr class="border-success" />
                    <div class="pl-2" id="event-location_rough">
                        <i class="fas fa-map-marker-alt"> </i>
                        <?php echo $event->location_rough ?>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button id="event-details-button" data-details-eid="<?php echo $event->id_event ?>"
                        class="btn <?php if ($event->id_userCreator == $_SESSION['user']['id_user']) echo 'my-'; ?>event-details-button"
                        data-toggle="modal" data-target="<?php
                if ($event->id_userCreator == $_SESSION['user']['id_user']) echo '#MyEventDetailsModal';
                else echo '#EventDetailsModal';
                ?>">Details
                </button>
            </div>
        </div>
    </div>
</div>
<br>