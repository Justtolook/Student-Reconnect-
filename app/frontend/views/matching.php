<h1>Matching</h1>
<div class="matchCard">
    <div class="text-center">
        <button class="btn text-center" onclick="showFilter()">Filter</button>
    </div>
    <div class="matchingFilter">
        <div class="row">
            <div class="col-md-12">
                <label class="PillList-item">
                    <input type="checkbox" name="feature" value="1">
                    <span class="PillList-label">one
                    <span class="Icon Icon--checkLight Icon--smallest">
                        </span>
                        </span>
                </label>
                <!-- checkboxes with interest to filter the user list -->
                <form action="?t=frontend&request=matching/filter" method="post">
                    <?php
                    foreach ($interestModel->interests as $interest) {
                        echo '<lable class="PillList-item">' . '<input type="checkbox" name="interests[]" value="' .
                            $interest . '">' . '<span class="PillList-label">' . $interest . '<span class="Icon Icon--checkLight Icon--smallest"><i class="fa fa-check"></i></span>' .
                            '</span>' . '</lable>';
                    }
                    ?>
                    <br>
                    <input class="btn" type="submit" name="filter" value="Filter setzen">
                </form>
            </div>
        </div>
        <!-- reset filter button -->
        <form action="?t=frontend&request=matching/resetfilter" method="post">
            <input class="btn" type="submit" name="reset" value="Reset Filter">
        </form>
        <!-- clear filter button -->
        <form action="?t=frontend&request=matching/clearfilter" method="post">
            <input class="btn" type="submit" name="clear" value="Clear Filter">
        </form>
    </div>
    <div>
        <h2>
            <?php echo $model->firstname . " " . $model->lastname; ?>
        </h2>
        image
        <?php echo $model->description; ?>

        Interessen: <br>
        <!-- print the interests of the user in plain text-->
        <span>
                        <?php foreach ($model->interests as $interest) {
                            echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
                        } ?>
                    </span>

        <!-- two buttons: one for matching and one for not matching -->
        <form action="?t=frontend&request=matching/matching" method="post">
            <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
            <input type="submit" value="Matchen">
        </form>
        <form action="?t=frontend&request=matching/notmatching" method="post">
            <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
            <input type="submit" value="Nicht Matchen">
        </form>
    </div>
</div>
<script src="app/frontend/js/matching.js"></script>

<style>
    .PillList-item {
        cursor: pointer;
        display: inline-block;
        float: left;
        font-size: 14px;
        font-weight: normal;
        line-height: 20px;
        margin: 0 12px 12px 0;
        text-transform: capitalize;
    }

    .PillList-item input[type="checkbox"] {
        display: none;
    }

    .PillList-item input[type="checkbox"]:checked + .PillList-label {
        background-color: #40bf8e;
        border: 1px solid rgb(255, 255, 255);
        color: rgb(255, 255, 255);
        padding-right: 16px;
        padding-left: 16px;
    }

    .PillList-label {
        border: 1px solid #40bf8e;
        border-radius: 20px;
        color: #40bf8e;
        display: block;
        padding: 7px 28px;
        text-decoration: none;
    }

    .PillList-item
    input[type="checkbox"]:checked
    + .PillList-label
    .Icon--checkLight {
        display: inline-block;
    }

    .PillList-item input[type="checkbox"]:checked + .PillList-label .Icon--addLight,
    .PillList-label .Icon--checkLight,
    .PillList-children {
        display: none;
    }

    .PillList-label .Icon {
        width: 12px;
        height: 12px;
        margin: 0 0 0 12px;
    }

    .Icon--smallest {
        width: 12px;
        height: 12px;
    }

    .Icon {
        background: transparent;
        display: inline-block;
        font-style: normal;
        vertical-align: baseline;
        position: relative;
    }
</style>