<div class="matchCard mt-2">
    <div class="text-center">
        <button class="btn text-center" onclick="showFilter()">Interessenfilter</button>
    </div>
    <div class="container-fluid matchingFilter">
        <div class="row d-flex justify-content-center">
            <span class="mb-3 mt-2">Nach welchen Interessen möchtest du Filtern?</span>
        </div>
        <!-- checkboxes with interest to filter the user list -->
        <form action="?t=frontend&request=matching/filter" method="post">
            <div class="row d-flex ml-2 mr-2">
                <?php
                foreach ($interestModel->interests as $interest) {
                    echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' .
                        $interest . '" ' ;
                    if(in_array(($interestModel->getInterestID($interest)), $filter)) echo "checked";
                    echo '><span class="PillList-label">' . $interest .
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
    <?php
    // check if the flag_noInterestOverlaps is set to true and if so, display an alert
    if ($flag_noInterestOverlaps) {
        echo '<div class="alert alert-warning" role="alert">
            <strong>Vorsicht!</strong>
            <p>Es wurden keine Personen diesen Interessen gefunden!</p>
        </div>';
    }

    ?>
    <div class="card pastelgruen border-success m-3">
        <div class="p-3">
            <h2>
                <?php echo $model->firstname . " " . $model->lastname; ?>
            </h2>
            <div class="text-center">
                <img class="rounded-circle w-50 mt-2" <?php echo'src="' . $imagemodel->getProfileImagePath() . '"' ?> alt="Profilbild">
            </div>
        </div>
        <div class="card-body">
            <p>
                <?php echo $model->description; ?>
            </p>
            <p>Interessen:</p>
                <!-- print the interests of the user in plain text-->
            <div class="row d-flex ml-2 mr-2">
                <?php foreach ($model->interests as $interest) {
                    echo '<label class="PillList-item"><input disabled checked type="checkbox" name="interests[]" value="' . $interestModel->getInterestName($interest) . '">';
                    echo '<span class="PillList-label">' . $interestModel->getInterestName($interest) .
                        '</span></label>';
                    //echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
                } ?>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2 text-center">
                <!-- two buttons: one for matching and one for not matching -->
                <form action="?t=frontend&request=matching/matching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <button class="btn-matching" type="submit" id="matchen">
                        <i class="fa-solid fa-check fa-2xl text-success"></i>
                    </button>
                </form>
            </div>
            <div class="col col-lg-2 text-center">
                <form action="?t=frontend&request=matching/notmatching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <button class="btn-matching" type="submit" id="nichtMatchen">
                        <i class="fa-solid fa-xmark fa-2xl text-danger"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row justify-content-md-center pb-3">
            <div class="col col-lg-2 text-center">
                <span>Matchen</span>
            </div>
            <div class="col col-lg-2 text-center">
                <span>Nicht Matchen</span>
            </div>
        </div>
    </div>
</div>
<script src="app/frontend/js/matching.js"></script>