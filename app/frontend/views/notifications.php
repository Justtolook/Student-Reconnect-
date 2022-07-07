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
    
</script>


<h1>notifications</h1>


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

