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
    //check of the flag_noMoreMatches is set to true, if so, display an alert
    if ($flag_noMoreMatches) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Achtung!</strong>
            <p>Es stehen aktuell keine Personen zum Matchen mehr zur Verfügung. Schaue später nochmal vorbei!</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
    }
    else {
    // check if the flag_noInterestOverlaps is set to true and if so, display an alert
    if ($flag_noInterestOverlaps) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Vorsicht!</strong>
            <p>Es wurden keine Personen diesen Interessen gefunden!</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
    }
    include 'app/frontend/views/matchingcard.php';
    }
    ?>

</div>

<script src="app/frontend/js/matching.js"></script>