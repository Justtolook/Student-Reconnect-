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
            if (data.scoreHost == null){
                $('#visitenkarte_scorehost').text('Host Score: ' + 0);
            } else {
                $('#visitenkarte_scorehost').text('Host Score: ' + data.scoreHost);
            }
            if(data.scoreAttendee == null){
                $('#visitenkarte_scoreattendee').text('Teilnehmer Score: ' + 0);
            } else {
                $('#visitenkarte_scoreattendee').text('Teilnehmer Score: ' + data.scoreAttendee);
            }
            
            
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
                $("#event-details-name").text("");
                $("#event-details-description").text("");
                $("#event-details-location").text("");
                $("#event-details-eventDate").text("");
                $("#event-details-signons").text("");
                $("#event-details-maxAttendees").text("");
                $("#event-sign-on.button").attr("data-eid", "");
                $('#event-details-name').text(eventDetails.name);
                $('#event-details-description').text(eventDetails.description);
                $('#event-details-location').text(eventDetails.location);
                $('#event-details-eventDate').text(eventDetails.eventDate);
                $('#event-details-signons').text(eventDetails.numberSignOns);
                $('#event-details-maxAttendees').text(eventDetails.numberAttendees);
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
function RatingHost(event_id) {
        //var eventId = $('#event-set-rating-button').attr('data-eid');
        //show modal
        $('#hostRatingModal').modal('show');
        console.log(event_id);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getEventDetails',
                'eid' : event_id
            },
            success: function(data) {
                console.log(data);
                var eventDetails = JSON.parse(data);

                $('#hostrating-ename').text(eventDetails.name);

                document.getElementById("ratingHost").innerHTML = "";
                if(eventDetails.hostRated == 1) {
                    var hostRatedDiv = document.createElement("div");
                    var hostRatedMessage = document.createTextNode("Du hast den Veranstalter bereits bewertet.");
                    hostRatedDiv.appendChild(hostRatedMessage);
                    document.getElementById("ratingHost").appendChild(hostRatedDiv);
                }else{
                    var linebreak = document.createElement("br");

                    var inputEvent = document.createElement("input");
                    inputEvent.setAttribute('type', 'hidden');
                    inputEvent.setAttribute('id', 'id_event');
                    inputEvent.setAttribute('name', 'id_event');
                    inputEvent.setAttribute('value', event_id);
                    document.getElementById("ratingHost").appendChild(inputEvent);
                    var inputCreator = document.createElement("input");
                    inputCreator.setAttribute('type', 'hidden');
                    inputCreator.setAttribute('id', 'id_userRated');
                    inputCreator.setAttribute('name', 'id_userRated');
                    inputCreator.setAttribute('value', eventDetails.id_userCreator);
                    document.getElementById("ratingHost").appendChild(inputCreator);
                    var inputRating = document.createElement("input");
                    inputRating.setAttribute('type', 'range');
                    inputRating.setAttribute('id', 'rating');
                    inputRating.setAttribute('name', 'rating');
                    inputRating.setAttribute('value', '3');
                    inputRating.setAttribute('min', '0');
                    inputRating.setAttribute('max', '5');
                    inputRating.setAttribute('step', '1.0');
                    document.getElementById("ratingHost").appendChild(inputRating);

                    document.getElementById("ratingHost").appendChild(linebreak);
                    document.getElementById("ratingHost").appendChild(linebreak);

                    var submitButton = document.createElement("button");
                    var buttonText = document.createTextNode("Bewerten");
                    submitButton.appendChild(buttonText);
                    submitButton.setAttribute('type', 'submit');
                    submitButton.setAttribute('id', 'submit-ratings-button');
                    submitButton.setAttribute('name', 'submit-ratings-button');
                    submitButton.setAttribute('class', 'btn btn-secondary');
                    document.getElementById("ratingHost").appendChild(submitButton);
                }
            }
        });
}

//handle attendee-rating button click
function RatingAttendees(event_id) {
        //show modal
        $('#attendeeRatingModal').modal('show');
        console.log(event_id);
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getEventDetails',
                'eid' : event_id,
            },
            success: function(data) {
                var eventDetails = JSON.parse(data);
                document.getElementById("rateAttendees").innerHTML = "";

                $('#attendeerating-ename').text(eventDetails.name);
                $('#attendeeRatingForm-eid').val(event_id);

                if(eventDetails.attendeeRated == 0) {
                    if(eventDetails.attendees.length !== 0) {
                        var counter = 1;
                        var linebreak = document.createElement("br");
                        for (var i = 0; i < eventDetails.attendees.length; i++) {
                            if(eventDetails.attendees[i].id_user == eventDetails.id_userCreator) {
                                continue;
                            }else{
                                var name = document.createElement("div");
                                var nameContent = document.createTextNode(eventDetails.attendees[i].firstname + " " + eventDetails.attendees[i].lastname);
                                name.appendChild(nameContent);
                                document.getElementById("rateAttendees").appendChild(name);
                                var input1 = document.createElement("input");
                                input1.setAttribute('type', 'hidden');
                                input1.setAttribute('id', 'id_User' + counter);
                                input1.setAttribute('name', 'id_User' + counter);
                                input1.setAttribute('value', eventDetails.attendees[i].id_user);
                                document.getElementById("rateAttendees").appendChild(input1);
                                var input2 = document.createElement("input");
                                input2.setAttribute('type', 'range');
                                input2.setAttribute('id', 'attendeeRating' + counter);
                                input2.setAttribute('name', 'attendeeRating' + counter);
                                input2.setAttribute('value', '3');
                                input2.setAttribute('min', '0');
                                input2.setAttribute('max', '5');
                                input2.setAttribute('step', '1.0');
                                document.getElementById("rateAttendees").appendChild(input2);

                                counter ++;
                            }
                        }
                        var inputCounter = document.createElement("input");
                        inputCounter.setAttribute('type', 'hidden');
                        inputCounter.setAttribute('id', 'counter');
                        inputCounter.setAttribute('name', 'counter');
                        inputCounter.setAttribute('value', counter);
                        document.getElementById("rateAttendees").appendChild(inputCounter);
                        var inputEvent = document.createElement("input");
                        inputEvent.setAttribute('type', 'hidden');
                        inputEvent.setAttribute('id', 'id_event');
                        inputEvent.setAttribute('name', 'id_event');
                        inputEvent.setAttribute('value', event_id);
                        document.getElementById("rateAttendees").appendChild(inputEvent);
                        document.getElementById("rateAttendees").appendChild(linebreak);
                        var submitButton = document.createElement("button");
                        var buttonText = document.createTextNode("Bewertungen abgeben");
                        submitButton.appendChild(buttonText);
                        submitButton.setAttribute('type', 'submit');
                        submitButton.setAttribute('id', 'submit-ratings-button');
                        submitButton.setAttribute('name', 'submit-ratings-button');
                        submitButton.setAttribute('class', 'btn btn-secondary');
                        document.getElementById("rateAttendees").appendChild(submitButton);
                    }else{
                        var nADiv = document.createElement("div");
                        var noAttendees = document.createTextNode("Bei diesem Event gab es keine Teilnehmer.");
                        nADiv.appendChild(noAttendees);
                        document.getElementById("rateAttendees").appendChild(naDiv);
                    }
                }else{
                    var attendeeRatedDiv = document.createElement("div");
                    var attendeeRatedMessage = document.createTextNode("Du hast die Teilnehmer bereits bewertet.");
                    attendeeRatedDiv.appendChild(attendeeRatedMessage);
                    document.getElementById("rateAttendees").appendChild(attendeeRatedDiv);
                }
            }
        });
}
    
</script>


<!-- Match Notification -->
<h1><strong>Benachrichtigungen</strong></h1>
<div class="ml-3 mt-3">
    <h5><strong>Matches</strong></h5>
</div>
<div class= "notificationCard">
    <div class = "matchingNotification">
        <?php
        //ignore warning if no matches are found
        error_reporting(E_ERROR | E_PARSE);
        if ($notifications->matches != null){
            foreach ($notifications->matches as $match) {
                //if ($match['notificationRead'] != 1){
                ?>
                <div class="card pastelgruen border-success ml-3 mr-3">
                    <div class="card-body float-left">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Match</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <div class="pl-2" id="event-eventDate">
                                        <i class="fa fa-clock-four"> </i>
                                        <?php
                                        echo $match['timestamp'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            echo "Sie haben ein Match mit: " . $userModel->getUserNameByID($match['id_user']) . "<br>";
                            ?>
                            <div style = "padding: 20px 10px 10px;"></div>
                            <?php
                            if(!$match['notificationRead']) {
                                echo "<div class='newNotification'>Du hast ein neues Match!</div>";
                                echo "<form action='?t=frontend&request=notifications/markAsReadNotification'  method='POST'>";
                                echo "<input type='hidden' name='id_user_match' value= '" . $match['id_user'] . "'>";
                                echo "<button type='submit' class='btn' name='markAsReadNotification'>Gelesen</button";
                                echo "</form>";
                            }
                            echo "<button type='button' class='btn float-left' onclick='getVisitenkartenContent(" . $match['id_user'] . ")'>Visitenkarte</button>";
                            /*
                            echo "<form action='?t=frontend&request=notifications/showVisitenkarte'  method='POST'>";
                            echo "<input type='hidden' name='id_user_match' value= '" . $match['id_user'] . "'>";
                            echo "<input class='btn float-left' type='submit' name='showVisitenkarte' value='Visitenkarte anzeigen'>";
                            echo "</form>";*/
                            //echo "Gelesen? " . $match['notificationRead'] . "<br>";
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                echo "<br>";
                //}
            }
        } else {
            echo "<div class='ml-3'>Aktuell keine Matches</div>";
        }
        ?>
    </div>
</div>

<!-- Event Notifications -->
<div class="ml-3 mt-3">
    <h5><strong>Events</strong></h5>
</div>
<div class= "eventCard">
    <div class= "eventNotification">
        <?php
        //ignore warning if no events are found
        error_reporting(E_ERROR | E_PARSE);
        if ($eventNotification->eventsSignedIn != null){
            foreach($eventNotification->eventsSignedIn as $event) {
                /* Check if Event is over --> due to Rating Option */
                ?>
                <div class="card pastelgruen border-success ml-3 mr-3">
                    <div class="card-body float-left">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <?php
                                        echo $event['event_name'];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <?php
                                    if (strtotime("now") > strtotime($event['event_time'])) {
                                        echo "Das Event ist vorbei.<br>";
                                    }else{
                                        echo "Du bist erfolgreich angemeldet.<br>";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-4 border-left border-success p-0">
                                    <div class="pl-2" id="event-eventDate">
                                        <i class="fa fa-clock-four"> </i>
                                        <?php
                                        echo $event['event_time'];
                                        ?>
                                    </div>
                                    <hr class="border-success" />
                                    <div class="pl-2" id="event-location_rough">
                                        <i class="fas fa-map-marker-alt"> </i>
                                        <?php
                                        echo $event['event_location_rough'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (strtotime("now") > strtotime($event['event_time'])) {
                                // echo "User Creator ID: " . $event['event_id_userCreator'] . "<br>";
                                // echo "Session User ID: " . $_SESSION['user']['id_user'] . "<br>";
                                /* If Event is over --> Insert Ratings Button, depending on EventOwner or Attende */
                                if ($event['event_id_userCreator'] == $_SESSION['user']['id_user']) {
                                    echo "<button type='button' class='btn' onclick='RatingAttendees(" . $event['event_id'] . ")'>Teilnehmer Bewerten</button>";

                                } else {
                                    /* insert button onclick RatingHost */
                                    echo "<button type='button' class='btn' onclick='RatingHost(" . $event['event_id'] . ")'>Host bewerten</button>";
                                }
                            }
                            echo "<input type='hidden' name='id_user' value= '" . $event['event_id_user'] . "'>";
                            echo "<button type='button' class='btn float-left' onclick='openEventDetails(" . $event['event_id'] . ")'>Details</button>";
                            ?>

                            <?php


                            // else {
                            //  echo "Das Event " . $event['event_name'] . " startet am " . $event['event_time'] . "<br>";
                            // }

                            ?>
                        </div>
                    </div>
                </div>
                <?php
                echo "<br>";
            }
        } else {
            echo "Sie sind zu keinem Event angemeldet.";
        }
        ?>
    </div>
</div>




<div class="modal fade" id="EventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="EventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="event-details-name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="event-details-description"></div>
                <br>
                <div>
                    <i class="fa fa-clock-four"> </i>
                    <span id="event-details-eventDate"></span>
                </div>
                <div>
                    <i class="fas fa-map-marker-alt mr-1"> </i>
                    <span id="event-details-location"></span>
                </div>
                <div id="event-details-attendees">
                    <i class="fas fa-user-alt"> </i>
                    Teilnehmende:
                    <span id="event-details-signons"></span>/<span id="event-details-maxAttendees"></span>
                </div>
            </div>

            <div class="modal-footer">
                <!-- sign off button -->
                <button type="button" class="btn event-sign-on-button" id="event-sign-on-button" data-eid="" onclick="EventSignOff()">Abmelden</button>
            </div>
        </div>
    </div>
</div>


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
                    <div id="hostrating-ename"></div><br>
                </div>
                <div id="ratingForms">
                    <form action="?t=frontend&request=notifications/rateHost"  method="POST">
                        <div id="ratingHost">
                        </div>
                    </form>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
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
                    <div id="attendeerating-ename"></div><br>
                </div>
                <div id="ratingForms">
                    <form action='?t=frontend&request=notifications/rateAttendees' method='POST'>
                        <div id="rateAttendees">
                        </div>
                    </form>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'app/frontend/views/visitenkartenkartenModalTemplate.php';
?>