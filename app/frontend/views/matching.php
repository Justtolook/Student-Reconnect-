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
                Interessen: <?php echo var_dump($model->interests); ?>
            </td>
        </tr>
        <tr>
            <td>
                swipe buttons here
            </td>
        </tr>
    </table>
</div>
