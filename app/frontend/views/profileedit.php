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
    <div class="col-md-11">
        <?php
        foreach ($interestModel->interests as $id => $name) {
            if(in_array($id, $profile->interests)) {
				echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' . $name . '" checked><span class="PillList-label">' . $name . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
			}else{
				echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' . $name . '"><span class="PillList-label">' . $name . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
			}
        }
        ?>
        <br class="spacer">
    </div>
    <button type="submit" class="btn btn-primary">Änderungen speichern</button><br><br>
    <a href="?t=frontend&request=profile" class="btn">Abbrechen</a><br>
</form>