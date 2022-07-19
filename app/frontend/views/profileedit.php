<div class="container-fluid">
    <form method="POST" action="?t=frontend&request=profileedit">
        <div class="col-md-12">
            <div class="form-row">
                <div class="col-md-6 mt-3">
                    <label for="firstname"><p class="font-weight-bold">Vorname</p></label>
                    <input type="text"
                           class="form-control border-dark shadow <?php echo $model->hasError('firstname') ? 'is-invalid' : '' ?>"
                           value="<?php echo $profile->firstname ?>" id="firstname" name="firstname">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="lastname"><p class="font-weight-bold">Nachname</p></label>
                    <input type="text"
                           class="form-control border-dark shadow <?php echo $model->hasError('lastname') ? 'is-invalid' : '' ?>"
                           value="<?php echo $profile->lastname ?>" id="lastname" name="lastname">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="description"><p class="font-weight-bold">Kurzbeschreibung</p></label>
                <textarea
                        class="form-control border-dark shadow <?php echo $model->hasError('description') ? 'is-invalid' : '' ?>"
                        id="description" name="description" rows="3"><?php echo $profile->description ?></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="contactInformation"><p class="font-weight-bold">Kontaktinformationen</p></label>
                <textarea
                        class="form-control border-dark shadow <?php echo $model->hasError('contactInformation') ? 'is-invalid' : '' ?>"
                        id="contactInformation" name="contactInformation"
                        rows="3"><?php echo $profile->contactInformation ?></textarea>
            </div>
        </div>
        <br>
        <br>
        <div class="col-md-11">
            <div class="row d-flex ml-2 mr-2">
                <?php
                foreach ($interestModel->interests as $id => $name) {
                    if (in_array($id, $profile->interests)) {
                        echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' . $name . '" checked><span class="PillList-label">' . $name . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
                    } else {
                        echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' . $name . '"><span class="PillList-label">' . $name . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
                    }
                }
                ?>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn">Änderungen speichern</button>
                    <br><br>
                    <a href="?t=frontend&request=profile" class="btn">Abbrechen</a><br>
                </div>
            </div>
        </div>
    </form>
</div>
