<form method="POST" action="?t=frontend&request=eventcreation">
    <div class="form-group">
        <label for="name">Event-Name</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php
        if($model->hasError('name')) {
            echo "<div>Bitte gib deinem Event einen Namen!<div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="eventDate">Veranstaltungsdatum</label>
        <input type="date" class="form-control" id="eventDate" name="eventDate">
        <?php
        if($model->hasError('eventDate')) {
            echo "<div>Bitte gib ein Datum an!<div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="location_rough">Grober Veranstaltungsort</label>
        <input type="text" class="form-control" id="location_rough" name="location_rough" placeholder="Diese Angabe kann jeder sehen.">
        <?php
        if($model->hasError('location_rough')) {
            echo "<div>Bitte gib einen Veranstaltungsort an!<div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="location">Genauer Veranstaltungsort</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Diese Angabe können nur Teilnehmer sehen.">
        <?php
        if($model->hasError('location')) {
            echo "<div>Bitte gib einen Veranstaltungsort an!<div>";
        }
        ?>
    </div><br>
    <div class="form-group">
        <label for="description">Kurzbeschreibung</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Bitte gib hier auch die Uhrzeit an, zu der das Event stattfinden soll.">
        <?php
        if($model->hasError('location_rough')) {
            echo "<div>Bitte gib deinem Event eine kurze Beschreibung!<div>";
        }
        ?>
    </div><br>
    <a href="?t=frontend&request=events" class="btn">Zurück zum Eventfeed</a><br><br>
    <button type="submit" class="btn btn-primary">Event erstellen</button><br><br>
</form>


