<form method="POST" action="?t=frontend&request=eventcreation">
    <div class="form-group m-4">
        <label for="name">Event-Name</label>
        <input type="text"
               class="form-control border-dark shadow <?php if ($model->hasError('name')) echo "is-invalid" ?>"
               id="name"
               name="name">
        <?php
        if ($model->hasError('name')) {
            echo "<div class='invalid-feedback'> " . $model->getError('name') . "</div>";
        }
        ?>
    </div>
    <div class="form-group m-4">
        <label for="eventDate">Veranstaltungsdatum</label>
        <input type="date"
               class="form-control border-dark shadow <?php if ($model->hasError('eventDate')) echo "is-invalid" ?>"
               id="eventDate" name="eventDate">
        <?php
        if ($model->hasError('eventDate')) {
            echo "<div class='invalid-feedback'> " . $model->getError('eventDate') . "</div>";
        }
        ?>
    </div>
    <div class="form-group m-4">
        <label for="location_rough">Grober Veranstaltungsort</label>
        <input type="text"
               class="form-control border-dark shadow <?php if ($model->hasError('location_rough')) echo "is-invalid" ?>"
               id="location_rough" name="location_rough" placeholder="Diese Angabe kann jeder sehen.">
        <?php
        if ($model->hasError('location_rough')) {
            echo "<div class='invalid-feedback'> " . $model->getError('location_rough') . "</div>";
        }
        ?>
    </div>
    <div class="form-group m-4">
        <label for="location">Genauer Veranstaltungsort</label>
        <input type="text"
               class="form-control border-dark shadow <?php if ($model->hasError('location')) echo "is-invalid" ?>"
               id="location" name="location" placeholder="Diese Angabe können nur Teilnehmer sehen.">
        <?php
        if ($model->hasError('location')) {
            echo "<div class='invalid-feedback'> " . $model->getError('location') . "</div>";
        }
        ?>
    </div>
    <div class="form-group m-4">
        <label for="description">Kurzbeschreibung</label>
        <textarea class="form-control border-dark shadow <?php if ($model->hasError('description')) echo "is-invalid" ?>"
                  id="description" name="description" placeholder="Bitte gib hier auch die Startuhrzeit an."
                  rows="3"></textarea>
        <?php
        if ($model->hasError('description')) {
            echo "<div class='invalid-feedback'> " . $model->getError('description') . "</div>";
        }
        ?>
    </div>
    <div class="form-group m-4">
        <label for="numberAttendees">Maximale Teilnehmeranzahl</label>
        <input type="number" min="1"
               class="form-control border-dark shadow <?php if ($model->hasError('numberAttendees')) echo "is-invalid" ?>"
               id="numberAttendees" name="numberAttendees">
        <?php
        if ($model->hasError('numberAttendees')) {
            echo "<div class='invalid-feedback'> " . $model->getError('numberAttendees') . "</div>";
        }
        ?>
    </div>


    <div class="text-center">
        <button type="submit" class="btn">Event erstellen</button>
        <br>
        <a href="?t=frontend&request=events" class="btn mt-3">Zurück zum Eventfeed</a>
    </div>
</form>

<style>
    input {
        max-width: 100%;
    }

</style>


