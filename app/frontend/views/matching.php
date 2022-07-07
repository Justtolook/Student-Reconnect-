<div class="matchCard">
    <div class="text-center">
        <button class="btn text-center" onclick="showFilter()">Filter deiner Suche</button>
    </div>
    <div class="matchingFilter">
        <div class="row d-flex justify-content-center">
            <span class="mb-3 mt-2">Interessen</span>
            <div class="col-md-11">

                <!-- checkboxes with interest to filter the user list -->
                <form action="?t=frontend&request=matching/filter" method="post">
                    <?php
                    foreach ($interestModel->interests as $interest) {
                        echo '<label class="PillList-item"><input type="checkbox" name="interests[]" value="' .
                            $interest . '"><span class="PillList-label">' . $interest .
                            '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span></span></label>';
                    }
                    ?>
                    <br class="spacer">
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
        </div>
    </div>
    <div class="card pastelgruen">
        <div class="card-header">
            <h2>
                <?php echo $model->firstname . " " . $model->lastname; ?>
            </h2>
            <div class="text-center">
                <img class="card-img w-50 mt-2 mb-4" src="res/Marie Becker.png" alt="Profilbild">
            </div>
        </div>
        <div class="card-body">
            <p>
                <?php echo $model->description; ?>
            </p>
            <p>Interessen:
                <!-- print the interests of the user in plain text-->
                <?php foreach ($model->interests as $interest) {
                    echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
                } ?>
            </p>
        </div>
        <div class="card-footer row justify-content-md-center">
            <div class="col col-lg-2 text-center">
                <!-- two buttons: one for matching and one for not matching -->
                <form action="?t=frontend&request=matching/matching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <button class="bg-white" type="submit" id="matchen">
                        <i class="fa-solid fa-check text-success"></i>
                    </button>
                </form>
            </div>
            <div class="col col-lg-2 text-center">
                <form action="?t=frontend&request=matching/notmatching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <button class="bg-white" type="submit" id="nichtMatchen">
                        <i class="fa-solid fa-xmark text-danger bg-white"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="app/frontend/js/matching.js"></script>