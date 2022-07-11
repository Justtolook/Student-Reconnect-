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
            $('#visitenkarte_name').text(data.firstname + ' ' + data.lastname);
            $('#visitenkarte_description').text(data.description);
            //$('#visitenkarte_image').attr('src', data.image);
            $('#visitenkarte_contactinformation').text(data.contactInformation);
            //loop through all data.interestsWithNames and create a span for each one with the name as text
            $('#visitenkarte_interests').empty();
            for (const [key, value] of Object.entries(data.interestsWithNames)) {
                console.log(`${key}: ${value}`);
                //TODO: USE PILLS INSTEAD OF BADGES
                $('#visitenkarte_interests').append('<span class="badge badge-primary">' + value + '</span>');
            }
        }
    });
}

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
                $('#event-details-name').text(eventDetails.name);
                $('#event-details-description').text(eventDetails.description);
                $('#event-details-location_rough').text(eventDetails.location_rough);
                $('#event-details-eventDate').text(eventDetails.eventDate);
                $('#event-details-signons').text(eventDetails.numberSignOns);
                $('#event-details-maxAttendees').text(eventDetails.numberAttendees);
                //set the data-eid attribute of the sign-on button to the event id
                $('#event-sign-on-button').attr('data-eid', event_id);
                //set the data-eid attribute of the report button to the event id
                $('#report-event-button').attr('data-eid', event_id);
                //set the text of the sign on button to sign off if the user is already signed on
                if (eventDetails.signOnStatus == 1) {
                    $('#event-sign-on-button').text('Abmelden');
                } else {
                    $('#event-sign-on-button').text('Anmelden');
                }
            } 
        });

    }; 
</script>


<h1>Benachrichtigungen</h1>
<h5>Matches</h5>
<div class= "notificationCard">
    <div class = "matchingNotification">
    <?php
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
    ?>    
    </div>
</div>

<h5>Events</h5>
<div class= "eventCard">
    <div class= "eventNotification">
        <?php
        foreach($eventNotification->eventsSignedIn as $event) {
                echo "<div class='newNotification'>Neu!</div>";
               // echo "<form action='?t=frontend&request=notifications/showEvent'  method='POST'>";
                echo "<input type='hidden' name='id_user' value= '" . $event['event_id_user'] . "'>"; 
                echo "<button type='button' class='btn float-left' onclick='openEventDetails(" . $event['event_id'] . ")'>Event</button>";
                echo "Sie wurden dem Event hinzugefügt: " . $event['event_name'] . "<br>";
                echo "Das Event findet am: " . $event['event_time'] ." statt." ."<br>";
                echo "Die Event Location wird in der Gegend: " . $event['event_location_rough'] ." sein." ."<br>";
                echo "<hr>";
        }
        ?>
    </div>
</div>



<div class="visitenkartenModal modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Visitenkarte</h3>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
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
                <button type="button" data-eid="" id="report-event-button" class="report-event-button btn btn-outline-danger" onclick="report()">Melden</button>
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
                <!-- sign on button -->
                <button type="button" class="btn btn-primary event-sign-on-button" id="event-sign-on-button" data-eid="" onclick="toggleSignOn()">Anmelden</button>
            </div>
        </div>
    </div>
</div>


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
</div>






