<script src="app/frontend/js/events.js"></script>
<div id="alert-container"></div>
<div id="eventPage" class="mt-2">
    <button class="btn text-center" onclick="showFilter()">Interessenfilter</button>
    <div class="container-fluid matchingFilter">
        <div class="row d-flex justify-content-center">
            <span class="mb-3 mt-2">Interessen</span>
        </div>
        <!-- checkboxes with interest to filter the user list -->
        <form action="?t=frontend&request=matching/filter" method="post">
            <div class="row d-flex ml-2 mr-2">
                <?php
                foreach ($interestModel->interests as $interest) {
                    echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' .
                        $interest . '"><span class="PillList-label">' . $interest .
                        '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
                }
                ?>
            </div>
            <input class="btn" type="submit" name="filter" value="Filter setzen">
        </form>
        <!-- reset filter button -->
        <form action="?t=frontend&request=matching/resetfilter" method="post">
            <input class="btn float-left" type="submit" name="reset" value="Filter zurücksetzen">
        </form>
        <!-- clear filter button -->
        <form action="?t=frontend&request=matching/clearfilter" method="post">
            <input class="btn" type="submit" name="clear" value="Filter löschen">
        </form>
    </div>
    <button class="btn" data-toggle="modal" data-target="#EventCreationModal">Event erstellen</button>
    <button class="btn search-my-events-button" onclick="getMyEvents()">Meine Events</button>
    <button class="search-all-events-button btn" onclick="getAllEvents()">Alle</button>
    <form>
        <div class="container-fluid mt-2 ml-1"
        <div class="row">
            <input type="text" class="form-control border-dark" id="search-events-input" name="searchTerm"
                   placeholder="Suche">
        </div>
        <button type="button" class="btn" onclick="searchEvents()">Suchen</button>
    </form>

    <div class="eventFeed" id="eventFeed">
    </div>
    <div class="modal fade" id="EventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="EventDetailsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="event-details-name"></h5>
                    <button type="button" data-eid="" id="report-event-button"
                            class="report-event-button btn btn-outline-danger" onclick="report()">Melden
                    </button>
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
                    <button type="button" class="btn btn-primary event-sign-on-button" id="event-sign-on-button"
                            data-eid=""
                            onclick="toggleSignOn()">Anmelden
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="MyEventDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="MyEventDetailsModalLabel"
         aria-hidden="true">
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
                    <button type="button" class="btn btn-danger my-event-delete-button" id="my-event-delete-button"
                            data-eid="" onclick="deleteEvent()">Löschen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="app/frontend/js/matching.js"></script>