<link rel="stylesheet" href="app/backend/css/jquery.dataTables.min.css">
<script src="app/backend/js/jquery.dataTables.min.js"></script>
<h1>Events Administration</h1>

<script>
    //fill the event edit modal if the user clicks on the edit button
    $(document).ready(function() {
        $('.event-edit-button').click(function() {
        //$('#eventsTable').on('click', '#event-edit-button', function() {
            var id = $(this).attr('data-event-id');
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
    });


    $(document).ready( function () {
        $('#EventsTable').DataTable();
    } );
</script>

<!--
implement a table to display all events with this data as columns:
    public int $id_event;
    public string $name = "";
    public string $description = "";
    public string $location = "";
    public string $location_rough = "";
    public int $id_userCreator;
    public DateTime $eventDate;
    public DateTime $createdTimestamp;
    public int $numberAttendees = 0;
-->
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
    <div class="modal-dialog" role="document">
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
            </div>
        </div>
    </div>
</div>

