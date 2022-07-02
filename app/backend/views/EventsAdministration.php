<link rel="stylesheet" href="app/backend/css/jquery.dataTables.min.css">
<script src="app/backend/js/jquery.dataTables.min.js"></script>
<h1>Events Administration</h1>

<script>
    function loadAttendeeList(id_event) {
        console.log("loadAttendeeList");
        /**
         * Fetch the attendees for the event via ajax and fill the datatable
         */
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'backend',
                'request': 'API_getAttendeesByEventId',
                'eid': id_event
            },
            success: function(data) {
                console.log(data);
                var attendees = JSON.parse(data);
                var table = $('#EventAttendeeList').DataTable();
                table.clear();
                for (var i = 0; i < attendees.length; i++) {
                    table.row.add([
                        attendees[i].id_User,
                        attendees[i].signOnDate,
                        attendees[i].ratingHost,
                        attendees[i].ratingAttendee,
                        attendees[i].accepted,
                        '<button data-user-id="' + attendees[i].id_User + '" data-event-id="' + id_event + '" class="btn btn-outline-primary" id="toggle-acceptance" type="button">Toggle Akzeptierung</button>' +
                        '<button data-user-id="' + attendees[i].id_User + '" data-event-id="' + id_event + '" class="btn btn-outline-danger" id="delete-attendee" type="button">Löschen</button>'
                    ]).draw();
                    //add a button to last last column of the Datatable

                }
            }
        });
    }



    //fill the event edit modal if the user clicks on the edit button
    $(document).ready(function() {

        $('.event-edit-button').click(
            function() {
        //$('#eventsTable').on('click', '#event-edit-button', function() {
                var id = $(this).attr('data-event-id');
                loadAttendeeList(id);
                console.log(id);
            $.ajax({
                url: 'index.php',
                type: 'GET',
                data: {
                    't': 'backend',
                    'request': 'API_getEventById',
                    'eid': id
                },
                success: function(data) {
                    console.log(data);
                    var event = JSON.parse(data);
                    $('#id_event').val(event.id_event);
                    $('#eventName').val(event.name);
                    $('#eventDescription').val(event.description);
                    $('#eventDate').val(event.eventDate);
                    $('#eventLocation').val(event.location);
                    $('#eventLocationRough').val(event.location_rough);
                    $('#eventCreator').val(event.id_userCreator);
                    $('#eventCreatedTimestamp').val(event.createdTimestamp);
                    $('#eventNumberAttendees').val(event.numberAttendees);
                }
            });


    });
        //toggle the acceptance of an attendee and call the API to update the database via ajax
        $('#EventAttendeeList').on('click', '#toggle-acceptance', function() {
            var uid = $(this).attr('data-user-id');
            var eid = $(this).attr('data-event-id');
            console.log(eid);
            $.ajax({
                url: 'index.php',
                type: 'get',
                data: {
                    't': 'backend',
                    'request': 'API_toggleAttendeeAcceptance',
                    'eid': eid,
                    'uid': uid
                },
                success: function(data) {
                    //reload the attendeelist for the event
                    loadAttendeeList(eid);
                }
            });
        });

        /**
         * Delete an attendee from an event and call the API to update the database via ajax
         */
        $('#EventAttendeeList').on('click', '#delete-attendee', function() {
            var uid = $(this).attr('data-user-id');
            var eid = $(this).attr('data-event-id');
            console.log(eid);
            $.ajax({
                url: 'index.php',
                type: 'get',
                data: {
                    't': 'backend',
                    'request': 'API_deleteAttendee',
                    'eid': eid,
                    'uid': uid
                },
                success: function(data) {
                    //reload the attendeelist for the event
                    loadAttendeeList(eid);
                }
            });
        });



    });



    $(document).ready( function () {
        $('#EventsTable').DataTable();
    } );
</script>

<table id="EventsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Location Rough</th>
            <th>Creator</th>
            <th>Date</th>
            <th>Created</th>
            <th>Attendees</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event) { ?>
        <tr>
            <td><?php echo $event->id_event; ?></td>
            <td><?php echo $event->name; ?></td>
            <td><?php echo $event->description; ?></td>
            <td><?php echo $event->location; ?></td>
            <td><?php echo $event->location_rough; ?></td>
            <td><?php echo $event->id_userCreator; ?></td>
            <td><?php echo $event->eventDate; ?></td>
            <td><?php echo $event->createdTimestamp; ?></td>
            <td><?php echo $event->numberAttendees; ?></td>
            <td>
                <button data-toggle="modal" data-target="#EventEditModal" class="event-edit-button btn btn-primary" data-event-id="<?php echo $event->id_event; ?>">Bearbeiten</button>
                <a class="btn btn-outline-danger" href="?t=backend&request=API_deleteEvent&eid=<?php echo $event->id_event; ?>">Löschen</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<!-- create the modal for editing an event -->
<div class="modal fade" id="EventEditModal" tabindex="-1" role="dialog" aria-labelledby="EventEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EventEditModalLabel">Event bearbeiten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="?t=backend&request=API_editEvent">
                    <input type="hidden" id="id_event" name="id_event" value="">
                    <div class="form-group">
                        <label for="eventName">Name</label>
                        <input type="text" class="form-control" id="eventName" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Beschreibung</label>
                        <textarea class="form-control" id="eventDescription" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventLocation">Ort</label>
                        <input type="text" class="form-control" id="eventLocation" placeholder="Ort" name="location">
                    </div>
                    <div class="form-group">
                        <label for="eventLocationRough">Grober Ort</label>
                        <input type="text" class="form-control" id="eventLocationRough" placeholder="Grober Ort" name="location_rough">
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Datum</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate">
                    </div>
                    <div class="form-group">
                        <label for="eventCreator">Ersteller</label>
                        <input type="text" class="form-control" id="eventCreator" placeholder="Ersteller" name="id_userCreator">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary" id="eventEditSubmit">Speichern</button>
                    </div>
                </form>
                <hr>
                <h6>Teilnehmende:</h6>
                <table id="EventAttendeeList">
                    <thead>
                    <tr>
                        <th>ID_User</th>
                        <th>SignOnDate</th>
                        <th>RatingHost</th>
                        <th>RatingAttendee</th>
                        <th>Akzeptiert</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

