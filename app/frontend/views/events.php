<script>
    //function to get the events from the database
    function getAllEvents() {
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getAllEvents'
            },
            success: function(data) {
                $('#eventFeed').html(data);
            }
        });
    }



    $(document).ready(function() {
        getAllEvents();


        //handle event details button click
        $('#eventFeed').on('click', '.event-details-button', function() {
            var eventId = $(this).attr('data-details-eid');
            $.ajax({
                url: 'index.php',
                type: 'GET',
                data: {
                    't': 'frontend',
                    'request': 'API_getEventDetails',
                    'eid': eventId
                },
                success: function(data) {
                    var eventDetails = JSON.parse(data);
                    //fill the modal with the event details
                    //$('#event-details-id').val(eventDetails.id_event);
                    $('#event-details-name').text(eventDetails.name);
                    $('#event-details-description').text(eventDetails.description);
                    $('#event-details-location_rough').text(eventDetails.location_rough);
                    $('#event-details-eventDate').text(eventDetails.eventDate);
                    $('#event-details-attendees').text(eventDetails.numberAttendees);
                    //set the data-eid attribute of the sign-on button to the event id
                    $('#event-sign-on-button').attr('data-eid', eventId);
                    //set the text of the sign on button to sign off if the user is already signed on
                    if (eventDetails.signOnStatus == 1) {
                        $('#event-sign-on-button').text('Abmelden');
                    } else {
                        $('#event-sign-on-button').text('Anmelden');
                    }
                }
            });
        });

    });
    //handle event sign on button click
    function toggleSignOn() {
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
                //rename the button to "abmelden"
                $('#event-sign-on-button').text('Abmelden');
            }
        });
    }


</script>

<h1>Events</h1>
<button class="search-events-button btn btn-primary">Suchen</button>

<div class="eventFeed" id="eventFeed">

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
                <div id="event-details-attendees"></div>
            </div>

            <div class="modal-footer">
                <!-- sign on button -->
                <button type="button" class="btn btn-primary event-sign-on-button" id="event-sign-on-button" data-eid="" onclick="toggleSignOn()">Anmelden</button>
            </div>
        </div>
    </div>
</div>