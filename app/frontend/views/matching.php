<h1>Matching</h1>
<div class="matchCard">
    <table>
        <!-- checkboxes with interest to filter the user list -->
        <tr>
            <td>
                <form action="?t=frontend&request=matching/filter" method="post">
                    <?php
                    foreach($interestModel->interests as $interest) {
                        echo '<input type="checkbox" name="interests[]" value="' . $interest . '">' . $interest . '<br>';
                    }
                    ?>
                    <input type="submit" name="filter" value="Filter">
                </form>
            </td>
        <tr>
            <td>
                <!-- reset filter button -->
                <form action="?t=frontend&request=matching/resetfilter" method="post">
                    <input type="submit" name="reset" value="Reset Filter">
                </form>
            </td>
            <td>
                <!-- clear filter button -->
                <form action="?t=frontend&request=matching/clearfilter" method="post">
                    <input type="submit" name="clear" value="Clear Filter">
                </form>
            </td>
        </tr>

        <tr>
            <h2>
                <?php echo $model->firstname . " " . $model->lastname;?>
            </h2>
        </tr>
        <tr>
            <td>
                image
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $model->description; ?>
            </td>
        </tr>
        <tr>
            <td>
                Interessen: <br>
                <!-- print the interests of the user in plain text-->
                <ul>
                    <?php foreach($model->interests as $interest) {
                        echo "<li>" . $interestModel->getInterestName($interest) . "</li>";
                    } ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <!-- two buttons: one for matching and one for not matching -->
                <form action="?t=frontend&request=matching/matching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <input type="submit" value="Matchen">
                </form>
                <form action="?t=frontend&request=matching/notmatching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <input type="submit" value="Nicht Matchen">
                </form>
            </td>
        </tr>
    </table>
</div>
