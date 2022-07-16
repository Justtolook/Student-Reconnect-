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

<div class="eventcard">
    <div id="event-name"><?php echo $event->name ?></div>
    <div id="event-description"><?php echo $event->description ?></div>
    <div id="event-location_rough"><?php echo $event->location_rough ?></div>
    <div id="event-eventDate"><?php echo $event->eventDate ?></div>
    <button id="event-details-button" data-details-eid="<?php echo $event->id_event ?>" class="btn btn-outline-primary <?php if($event->id_userCreator == $_SESSION['user']['id_user']) echo 'my-';?>event-details-button" data-toggle="modal" data-target="<?php
    if($event->id_userCreator == $_SESSION['user']['id_user']) echo '#MyEventDetailsModal';
    else echo '#EventDetailsModal';
    ?>" >Details</button>
</div>
<br>



