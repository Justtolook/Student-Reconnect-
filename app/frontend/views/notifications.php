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

function openEventDetails(id_user) {
    //show modal
    $('.eventcard').modal('show');
    $.ajax({
        type: "GET",
        url: "index.php",
        data: {
            't': 'frontend',
            'request': 'API_getEventNotification',
            'id_user': id_user
        },
        success: function(data) {
            var data = JSON.parse(data);
            console.log(data);
            $('#event_name').text(data.name);
            $('#event_location_rough').text(data.location_rough);
            $('#event_eventDate').text(data.eventDate);
            //loop through all data.interestsWithNames and create a span for each one with the name as text
        }
    });

     
}
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
        foreach($eventModel->eventsSignedIn as $event) {
                echo "<div class='newNotification'>Neu!</div>";
                echo "<form action='?t=frontend&request=notifications/showEvent'  method='POST'>";
                echo "<input type='hidden' name='id_user' value= '" . $event['event_id_user'] . "'>";    
                echo "<button type='button' class='btn float-left' onclick='openEventDetails(" . $event['event_id_user'] . ")'>Event</button>";
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
                    <div id="event_name"></div>
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
