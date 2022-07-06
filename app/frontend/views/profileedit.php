<form method="POST" action="?t=frontend&request=profileedit">
    <div class="form-group">
        <label for="firstname">Vorname</label>
        <input type="text" class="form-control <?php echo $model->hasError('firstname') ? 'is-invalid' : ''?>" value="<?php echo $profile->firstname ?>" id="firstname" name="firstname">
    </div><br>
    <div class="form-group">
        <label for="lastname">Nachname</label>
        <input type="text" class="form-control <?php echo $model->hasError('lastname') ? 'is-invalid' : ''?>" value="<?php echo $profile->lastname ?>" id="lastname" name="lastname">
    </div><br>
    <div class="form-group">
        <label for="description">Kurzbeschreibung</label>
        <input type="text" class="form-control <?php echo $model->hasError('description') ? 'is-invalid' : ''?>" value="<?php echo $profile->description ?>" id="description" name="description">
    </div><br>
    <div class="form-group">
        <label for="contactInformation">Kontaktinformationen</label>
        <input type="text" class="form-control <?php echo $model->hasError('contactInformation') ? 'is-invalid' : ''?>" value="<?php echo $profile->contactInformation ?>" id="contactInformation" name="contactInformation">
    </div><br>
    <div class="form-group">
        <label for="interests">Interessen</label>
        <select multiple="multiple" class="form-control" id="interests" name="interests[]">
           <?php
           foreach ($interestModel->interests as $id => $name) {
               if(in_array($id, $profile->interests)) echo '<option selected value="' . $id . '">' . $name . '</option>';
               else echo '<option value="' . $id . '">' . $name . '</option>';
              }
               ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Änderungen speichern</button><br><br>
    <a href="?t=frontend&request=profile" class="btn">Abbrechen</a><br>
</form>
