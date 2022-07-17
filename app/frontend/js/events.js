//function to get the events from the database
function getAllEvents() {
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_getAllEvents'
        },
        success: function (data) {
            $('#eventFeed').html(data);
        }
    });
}


$(document).ready(function () {
    getAllEvents();


    //handle event details button click
    $('#eventFeed').on('click', '.event-details-button', function () {
        var eventId = $(this).attr('data-details-eid');
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getEventDetails',
                'eid': eventId
            },
            success: function (data) {
                var eventDetails = JSON.parse(data);
                //fill the modal with the event details
                //$('#event-details-id').val(eventDetails.id_event);
                $('#event-details-name').text(eventDetails.name);
                $('#event-details-description').text(eventDetails.description);
                $('#event-details-location_rough').text(eventDetails.location_rough);
                $('#event-details-eventDate').text(eventDetails.eventDate);
                $('#event-details-signons').text(eventDetails.numberSignOns);
                $('#event-details-maxAttendees').text(eventDetails.numberAttendees);
                //set the data-eid attribute of the sign-on button to the event id
                $('#event-sign-on-button').attr('data-eid', eventId);
                //set the data-eid attribute of the report button to the event id
                $('#report-event-button').attr('data-eid', eventId);
                //set the text of the sign on button to sign off if the user is already signed on
                if (eventDetails.signOnStatus == 1) {
                    $('#event-sign-on-button').text('Abmelden');
                } else {
                    $('#event-sign-on-button').text('Anmelden');
                }
            }
        });
    });


    //handle my event details button click
    $('#eventFeed').on('click', '.my-event-details-button', function () {
        var eventId = $(this).attr('data-details-eid');
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                't': 'frontend',
                'request': 'API_getEventDetails',
                'eid': eventId
            },
            success: function (data) {
                var eventDetails = JSON.parse(data);
                //fill the modal with the event details
                //$('#event-details-id').val(eventDetails.id_event);
                $('#my-event-details-name').text(eventDetails.name);
                $('#my-event-details-description').text(eventDetails.description);
                $('#my-event-details-location_rough').text(eventDetails.location_rough);
                $('#my-event-details-eventDate').text(eventDetails.eventDate);
                $('#my-event-details-signons').text(eventDetails.numberSignOns);
                $('#my-event-details-maxAttendees').text(eventDetails.numberAttendees);
                //set the data-eid attribute of the sign-on button to the event id
                $('#my-event-delete-button').attr('data-eid', eventId);
                getAttendees(eventId);
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
        success: function (data) {
            console.log(data);
            console.log("toggled");
            //rename the button to "abmelden"
            //$('#event-sign-on-button').text('Abmelden');
            if ($('#event-sign-on-button').text() == 'Abmelden') {
                $('#event-sign-on-button').text('Anmelden');
            } else {
                $('#event-sign-on-button').text('Abmelden');
            }
        }
    });
}

//handle event report button click
function report() {
    var eventId = $('#report-event-button').attr('data-eid');
    //redirect to the report event page
    window.location.href = 'index.php?t=frontend&request=reportEvent&id_event=' + eventId;
}

//handle getmyevents button click
function getMyEvents() {
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_getMyEvents'
        },
        success: function (data) {
            $('#eventFeed').html(data);
        }
    });
}

function deleteEvent() {
    var eventId = $('#my-event-delete-button').attr('data-eid');
    console.log(eventId);
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_deleteEvent',
            'eid': eventId
        },
        success: function (data) {
            console.log(data);
            console.log("deleted");
            var result = JSON.parse(data);
            //close the modal
            $('#MyEventDetailsModal').modal('hide');
            if (result.success == true) {
                //create a positive alert
                $('#alert-container').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Erfolg!</strong> Dein Event wurde erfolgreich gelöscht.</div>');
            } else {
                //create a negative alert
                $('#alert-container').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Fehler!</strong> Das Event konnte nicht gelöscht werden. Du hast keine Berechtigung dazu.</div>');
            }
            getMyEvents();
        }
    });
}

function getAttendees(eid) {
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_getAttendees',
            'eid': eid
        },
        success: function (data) {
            $('#my-event-details-attendees-list-body').html(data);
        }
    });
}

/**
 * toggle the acceptance for the specific event and user
 * @param data
 */
function toggleAcceptance(data) {
    var eventId = $(data).attr('data-eid');
    var userId = $(data).attr('data-uid');
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_toggleAcceptance',
            'eid': eventId,
            'uid': userId
        },
        success: function (result) {
            result = JSON.parse(result);
            if (result.success) {
                //rename the button according to new status
                var n_accepted = $('#my-event-details-signons').text();
                if (result.newStatus) {
                    $(data).text('Ablehnen');
                    $('#my-event-details-signons').text(parseInt(n_accepted) + 1);
                } else {
                    $(data).text('Annehmen');
                    $('#my-event-details-signons').text(parseInt(n_accepted) - 1);
                }
            } else {
                //create a negative alert
                $('#alert-container-details').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Fehler!</strong> Du hast keine Berechtigung dazu.</div>');
            }

        }
    });
}

function searchEvents() {
    var search = $('#search-events-input').val();
    console.log(search);
    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: {
            't': 'frontend',
            'request': 'API_searchEvents',
            'searchTerm': search
        },
        success: function (data) {
            $('#eventFeed').html(data);
        }
    });
}