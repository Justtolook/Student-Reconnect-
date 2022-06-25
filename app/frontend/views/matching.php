<h1>Matching</h1>
<div class="matchCard">
    <table>
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
                Interessen: <?php var_dump($model->interests); ?>
            </td>
        </tr>
        <tr>
            <td>
                <!-- two buttons: one for matching and one for not matching -->
                <form action="?t=frontend&request=matching/matching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <input type="submit" value="Match">
                </form>
                <form action="?t=frontend&request=matching/notmatching" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $model->id_user; ?>">
                    <input type="submit" value="Niet Match">
                </form>
            </td>
        </tr>
    </table>
</div>
