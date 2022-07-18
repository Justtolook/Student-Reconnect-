<form method="POST" action="?t=frontend&request=eventcreation">
    <div class="form-group">
        <label for="name">Event-Name</label>
        <input type="text" class="form-control <?php if($model->hasError('name')) echo "is-invalid" ?>" id="name" name="name">
        <?php
        if($model->hasError('name')) {
            echo "<div class='invalid-feedback'> " . $model->getError('name') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="eventDate">Veranstaltungsdatum</label>
        <input type="date" class="form-control <?php if($model->hasError('eventDate')) echo "is-invalid" ?>" id="eventDate" name="eventDate">
        <?php
        if($model->hasError('eventDate')) {
            echo "<div class='invalid-feedback'> " . $model->getError('eventDate') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="location_rough">Grober Veranstaltungsort</label>
        <input type="text" class="form-control <?php if($model->hasError('location_rough')) echo "is-invalid" ?>" id="location_rough" name="location_rough" placeholder="Diese Angabe kann jeder sehen.">
        <?php
        if($model->hasError('location_rough')) {
            echo "<div class='invalid-feedback'> " . $model->getError('location_rough') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="location">Genauer Veranstaltungsort</label>
        <input type="text" class="form-control <?php if($model->hasError('location')) echo "is-invalid" ?>" id="location" name="location" placeholder="Diese Angabe können nur Teilnehmer sehen.">
        <?php
        if($model->hasError('location')) {
            echo "<div class='invalid-feedback'> " . $model->getError('location') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="description">Kurzbeschreibung</label>
        <input type="text" class="form-control <?php if($model->hasError('description')) echo "is-invalid" ?>" id="description" name="description" placeholder="Bitte gib hier auch die Startuhrzeit an.">
        <?php
        if($model->hasError('description')) {
            echo "<div class='invalid-feedback'> " . $model->getError('description') . "</div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="numberAttendees">Maximale Teilnehmeranzahl</label>
        <input type="number" class="form-control <?php if($model->hasError('numberAttendees')) echo "is-invalid" ?>" id="numberAttendees" name="numberAttendees">
        <?php
        if($model->hasError('numberAttendees')) {
            echo "<div class='invalid-feedback'> " . $model->getError('numberAttendees') . "</div>";
        }
        ?>
    </div><br>
    <a href="?t=frontend&request=events" class="btn">Zurück zum Eventfeed</a><br><br>
    <button type="submit" class="btn btn-primary">Event erstellen</button><br><br>
</form>


