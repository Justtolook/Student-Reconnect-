<script src="app/frontend/js/events.js"></script>
<div id="alert-container"></div>
<h1>Events</h1>
<button class="btn btn-outline-primary" data-toggle="modal" data-target="#EventCreationModal">Event erstellen</button>
<button class="btn search-my-events-button" onclick="getMyEvents()">Meine Events</button>
<button class="search-all-events-button btn" onclick="getAllEvents()">Alle</button>
<form>
    <div class="form-group">
        <label for="search-events-input">Suche</label>
        <input type="text" class="form-control" id="search-events-input" name="searchTerm" placeholder="Suche">
    </div>
    <button type="button" class="btn" onclick="searchEvents()">Suchen</button>
</form>

<div class="eventFeed" id="eventFeed">

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

<div class="modal fade" id="MyEventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="MyEventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-event-details-name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="alert-container-details"></div>
                <div id="my-event-details-description"></div>
                <div id="my-event-details-location_rough"></div>
                <div id="my-event-details-eventDate"></div>
                <div id="my-event-details-attendees">Akzeptierte Teilnehmende:
                    <span id="my-event-details-signons"></span>/<span id="my-event-details-maxAttendees"></span>
                </div>
                <br>
                <table class="my-event-details-attendees-list">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody id="my-event-details-attendees-list-body">

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <!-- sign on button -->
                <button type="button" class="btn btn-danger my-event-delete-button" id="my-event-delete-button" data-eid="" onclick="deleteEvent()">Löschen</button>
            </div>
        </div>
    </div>
</div>