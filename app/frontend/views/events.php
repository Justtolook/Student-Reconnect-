<script src="app/frontend/js/events.js"></script>
<div id="alert-container"></div>
<div class="event-page mt-2">
    <a href="?t=frontend&request=eventcreation" class="btn">Event erstellen</a>
    <button class="btn search-my-events-button" onclick="getMyEvents()">Meine Events</button>
    <button class="search-all-events-button btn" onclick="getAllEvents()">Alle</button>
    <div class="form-group">
        <input type="text" class="form-control border-dark" id="search-events-input" name="searchTerm"
               placeholder="Suche">
        <button type="button" class="btn" onclick="searchEvents()">Suchen</button>
    </div>

    <div class="eventFeed" id="eventFeed">
    </div>

    <div class="modal fade" id="EventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="EventDetailsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content pastelgruen">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-11">
                                <h5 class="modal-title" id="event-details-name"></h5>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
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
                        <span id="event-details-location_rough"></span>
                    </div>
                    <div id="event-details-attendees">
                        <i class="fas fa-user-alt"> </i>
                        Teilnehmende:
                        <span id="event-details-signons"></span>/<span id="event-details-maxAttendees"></span>
                        <div class="row justify-content-md-center mt-4">
                            <div class="col col-md-5 text-center">
                                <!-- sign on button -->
                                <button type="button" class="btn event-sign-on-button" id="event-sign-on-button"
                                        data-eid=""
                                        onclick="toggleSignOn()">Anmelden
                                </button>
                            </div>
                            <div class="col col-md-5 text-center">
                                <button type="button" data-eid="" id="report-event-button"
                                        class="report-event-button btn btn-outline-danger"
                                        onclick="report()">
                                    Melden
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="MyEventDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="MyEventDetailsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content pastelgruen">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-11">
                                <h5 class="modal-title" id="my-event-details-name"></h5>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="alert-container-details"></div>
                    <div id="my-event-details-description"></div>
                    <br>
                    <div><i class="fa fa-clock-four"> </i>
                        <span id="my-event-details-eventDate"></span>
                    </div>
                    <div>
                        <i class="fas fa-map-marker-alt mr-1"> </i>
                        <span id="my-event-details-location_rough"></span>
                    </div>
                    <div id="my-event-details-attendees">
                        <i class="fas fa-user-alt"> </i>
                        Akzeptierte Teilnehmende:
                        <span id="my-event-details-signons"></span>/<span id="my-event-details-maxAttendees"></span>
                    </div>
                    <br>
                    <div class="container-fluid my-event-details-attendees-list">
                        <div class="row text-center font-weight-bold mb-2">
                            <div class="col-md-3">
                                <span>Name</span>
                            </div>
                            <div class="col-md-9">
                                <span>Aktionen</span>
                            </div>
                        </div>
                        <div id="my-event-details-attendees-list-body">

                        </div>
                    </div>
                </div>

                <div class="modal-footer align-self-center">
                    <!-- sign on button -->
                    <button type="button" class="btn btn-danger my-event-delete-button" id="my-event-delete-button"
                            data-eid="" onclick="deleteEvent()">Löschen
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'app/frontend/views/visitenkartenkartenModalTemplate.php';
    ?>

</div>

<style>
    input {
        margin: 0.375rem 0.75rem;
    }
</style>