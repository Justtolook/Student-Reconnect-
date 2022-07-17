<script>


function openVisitenkarte(id_user) {
    //show modal
    $('.visitenkartenModal').modal('show');
    $.ajax({
        type: "GET",
        url: "index.php",
        data: {
            't': 'frontend',
            'request': 'API_getVisitenkarte',
            'id_user': id_user
        },
        success: function(data) {
            
            var data = JSON.parse(data);
            console.log(data);
            $('#visitenkarte_name').text('Name: ' + data.firstname + ' ' + data.lastname);
            $('#visitenkarte_description').text('Beschreibung: ' + data.description  );
            //$('#visitenkarte_image').attr('src', data.image);
            $('#visitenkarte_contactinformation').text('Kontaktinformationen: '  +data.contactInformation);
            //loop through all data.interestsWithNames and create a span for each one with the name as text
            $('#visitenkarte_interests').text('Interessen:');
            for (const [key, value] of Object.entries(data.interestsWithNames)) {
                console.log(`${key}: ${value}`);
                //TODO: USE PILLS INSTEAD OF BADGES
                $('#visitenkarte_interests').append('<span class="badge badge-primary">' + value + '</span>');
            }
            //for reporting purpose:
            $('#report-user-button').attr('data-userid', id_user);
        }
    });
};

 function openEventDetails(event_id) {

        //$('#eventFeed').on('click', '.event-details-button', function() {
        //var eventId = $(this).attr('data-details-eid');

        $('#EventDetailsModal').modal('show');
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getEventDetails',
                'eid': event_id
            },
            success: function(data) {
                var eventDetails = JSON.parse(data);
                console.log(eventDetails);
                //fill the modal with the event details
                //$('#event-details-id').val(eventDetails.id_event);
                $('#event-details-name').text('Name: '+eventDetails.name);
                $('#event-details-description').text('Beschreibung: '+eventDetails.description);
                $('#event-details-location_rough').text('Gegend: '+eventDetails.location_rough);
                $('#event-details-eventDate').text('Zeit: '+eventDetails.eventDate);
                $('#event-details-signons').text(eventDetails.numberSignOns);
                $('#event-details-maxAttendees').text('Max. Teilnehmerzahl: '+eventDetails.numberAttendees);
                //set the data-eid attribute of the sign-on button to the event id
                $('#event-sign-on-button').attr('data-eid', event_id);
                //set the data-eid attribute of the report button to the event id
                //$('#report-event-button').attr('data-eid', event_id);
                
            } 
        });

}; 

//handle event sign on button click
function EventSignOff() {
        var eventId = $('#event-sign-on-button').attr('data-eid');
        console.log(eventId);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_toggleSignOnForEvent',
                'eid': eventId
            },
            success: function(data) {
                console.log(data);
                console.log("toggled");
                $('#event-sign-on-button').text('Abmelden');
                //reload page
                location.reload();
            }
        });
}

 //handle event report button click
 //TODO Report für User ermöglichen
 function reportUser() {
        var userID = $('#report-user-button').attr('data-userid');
        console.log (userID);
        //redirect to the report event page
        window.location.href = 'index.php?t=frontend&request=reportUser&id_user=' + userID;
}

//handle host-rating button click
function RatingHost(event_id_userCreator, event_id ) {
        //var eventId = $('#event-set-rating-button').attr('data-eid');
        //show modal
        $('#hostRatingModal').modal('show');
        console.log(event_id);
        console.log(event_id_userCreator);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_handleHostRating',
                'event_id' : event_id,
                'event_id_userCreator': event_id_userCreator,
            },
            success: function(data) {
                /* Kein SQL Select Statement --> also keine Daten anzuzeigen */
                $('#rating-host-id').text(data.event_id_userCreator);
                $('#event-set-rating-button').text('Bewertung abgegeben');
                
                //reload page
                //location.reload();
            }
        });
}

//handle attendee-rating button click
function RatingAttendees(event_id_userCreator, event_id ) {
        //var eventId = $('#event-set-rating-button').attr('data-eid');
        //show modal
        $('#attendeeRatingModal').modal('show');
        console.log(event_id);
        console.log(event_id_userCreator);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_handleAttendeeRating',
                'event_id' : event_id,
                'event_id_userCreator': event_id_userCreator,
            },
            success: function(data) {
                /* Kein SQL Select Statement --> also keine Daten anzuzeigen */
                $('#rating-host-id').text(data.event_id_userCreator);
                $('#event-set-rating-button').text('Bewertung abgegeben');
            }
        });
}
    
</script>

<!-- Match Notification -->
<h1>Benachrichtigungen</h1>
<h5>Matches</h5>
<div class= "notificationCard">
    <div class = "matchingNotification">
    <?php
        //ignore warning if no matches are found
        error_reporting(E_ERROR | E_PARSE);
        if ($notifications->matches != null){
            foreach ($notifications->matches as $match) {
                //if ($match['notificationRead'] != 1){
                    if(!$match['notificationRead']) {
                        echo "<div class='newNotification'>Neu!</div>";
                        echo "<form action='?t=frontend&request=notifications/markAsReadNotification'  method='POST'>";
                        echo "<input type='hidden' name='id_user_match' value= '" . $match['id_user'] . "'>"; 
                        echo "<input class='btn float-left' type='submit' name='markAsReadNotification' value='Gelesen'>";
                        echo "</form>";
                    }
                    echo "<button type='button' class='btn float-left' onclick='openVisitenkarte(" . $match['id_user'] . ")'>Visitenkarte</button>";
                    /*
                    echo "<form action='?t=frontend&request=notifications/showVisitenkarte'  method='POST'>";
                    echo "<input type='hidden' name='id_user_match' value= '" . $match['id_user'] . "'>"; 
                    echo "<input class='btn float-left' type='submit' name='showVisitenkarte' value='Visitenkarte anzeigen'>";
                    echo "</form>";*/
                    
                    echo "Sie wurde gematched mit der UserID: " . $match['id_user'] . "<br>";
                    echo "Der Timestamp des Matches ist: " . $match['timestamp'] . "<br>";
                    //echo "Gelesen? " . $match['notificationRead'] . "<br>";
                    echo "<hr>";
                //} 
            }
        } else {
            echo "Keine Matches gefunden";
        }
    ?>    
    </div>
</div>

<!-- Event Notifications -->
<h5>Events</h5>
<div class= "eventCard">
    <div class= "eventNotification">
        <?php
        //ignore warning if no events are found
        error_reporting(E_ERROR | E_PARSE);
        if ($eventNotification->eventsSignedIn != null){
            foreach($eventNotification->eventsSignedIn as $event) {
                /* Check if Event is over --> due to Rating Option */
                if (strtotime("now") > strtotime($event['event_time'])) {
                   echo "User Creator ID: " . $event['event_id_userCreator'] . "<br>";
                   echo "Session User ID: " . $_SESSION['user']['id_user'] . "<br>";
                   /* If Event is over --> Insert Ratings Button, depending on EventOwner or Attende */ 
                   if ($event['event_id_userCreator'] == $_SESSION['user']['id_user']){
                        echo "<button type='button' class='btn btn-secondary' onclick='RatingAttendees(" . $event['event_id_userCreator'] . "," . $event['event_id'] . ")'>Teilnehmer Bewerten</button>";
                    } else {
                        echo "<button type='button' class='btn btn-secondary' onclick='RatingHost(" . $event['event_id_userCreator'] . "," . $event['event_id'] . ")'>Host bewerten</button>";
                }
                   echo "Das Event " . $event['event_name'] . " ist vorbei<br>";
                }else{
                echo "<input type='hidden' name='id_user' value= '" . $event['event_id_user'] . "'>"; 
                echo "<button type='button' class='btn float-left' onclick='openEventDetails(" . $event['event_id'] . ")'>Event</button>";
                echo "Sie wurden dem Event hinzugefügt: " . $event['event_name'] . "<br>";
                echo "Das Event findet am: " . $event['event_time'] ." statt." ."<br>";
                echo "Die Event Location wird in der Gegend: " . $event['event_location_rough'] ." sein." ."<br>";
                echo "<hr>";
                }
            }
        } else {
            echo "Sie sind zu keinem Event angemeldet.";
        }
        ?>
    </div>
</div>



<div class="visitenkartenModal modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Visitenkarte</h3>
                <!-- TODO Report for User Anpassen -->
                <button type="button" data-userid="" id="report-user-button" class="report-user-button btn btn-outline-danger" onclick="reportUser()">Melden</button>
            </div>
            <div class="modal-body">
                <div id="visitenkarte">
                    <div id="visitenkarte_name"></div>
                    <div id="visitenkarte_image"></div>
                    <div id="visitenkarte_description"></div>
                    <div id="visitenkarte_contactinformation"></div>
                    <div id="visitenkarte_interests"></div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="EventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="EventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="event-details-name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="event-details-description"></div>
                <div id="event-details-location_rough"></div>
                <div id="event-details-eventDate"></div>
                <div id="event-details-attendees">Teilnehmende:
                    <span id="event-details-signons"></span>/<span id="event-details-maxAttendees"></span>
                </div>
            </div>

            <div class="modal-footer">
                <!-- sign off button -->
                <button type="button" class="btn btn-primary event-sign-on-button" id="event-sign-on-button" data-eid="" onclick="EventSignOff()">Abmelden</button>
            </div>
        </div>
    </div>
</div>

<!-- 
<div class="eventcard modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Event</h3>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="eventcard">
                    <div id="eventcard_name"></div>
                    <div id="eventcard_location_rough"></div>
                    <div id="eventcard_eventDate"></div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- insert modal for host rating -->
<div class="modal fade" id="hostRatingModal" tabindex="-1" role="dialog" aria-labelledby="hostRatingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bewertung</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="eventRating">
                    <div id="event_name"><?php echo ($event['event_name']) ?></div><br>
                </div>
                <div id="ratingForms">
                    <form action="?t=frontend&request=notifications/rateHost"  method="POST">
                        <input id="ratingForm-eid"  type="hidden" name="id_event" <?php echo "value='" . $event['event_id'] . "'" ?>>
                        <input id="ratingForm-uid"  type="hidden" name="id_userRated" <?php echo "value='" . $event['event_id_userCreator'] . "'" ?>>
                        <input id="ratingForm-rating" type="range" min="0" max="5" step="1.0" name="rating" value="3"></input><br><br>
                        <input type="submit" name="rateEvent" value="Bewerten">
                    </form>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div
    </div>
</div>


<!-- insert modal for attendee rating -->
<div class="modal fade" id="attendeeRatingModal" tabindex="-1" role="dialog" aria-labelledby="attendeeRatingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bewertung der Teilnehmer</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="eventRating">
                    <div id="event_name"><?php echo ($event['event_name']) ?></div><br>
                </div>
                <div id="ratingForms">
                    <?php 
                    $attendees = $eventSignOn->getSignOnIdsByEventId($event['event_id']);
                    if (!empty($attendees)) {
                        foreach ($attendees as $attendee) {
                            if ($attendee == $_SESSION['user']['id_user']) {
                                continue;
                            }else{
                                echo "<form action='?t=frontend&request=notifications/rateAttendees'  method='POST'>";
                                echo "<input id='attendeeRating' type='range' min='0' max='5' step='1.0' name='attendeeRating' value='3'></input><br>";
                                echo "<input id='ratingForm-eid'  type='hidden' name='id_event' value='" . $event['event_id'] . "'>";
                                echo "<input id='ratingForm-uid'  type='hidden' name='id_User' value='" . $attendee . "'>";
                                echo "<input type='submit' name='rateEvent' value='Bewerten'>";
                                // TO DO: submit ohne reload!
                                echo "</form>";
                            }
                        }
                    }else{
                        echo "Bei diesem Event gab es keine Teilnehmer.";
                    }
                    ?>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div
    </div>
</div>