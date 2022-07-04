<h1>Meldeformular</h1>
<div class="form-group">
    <form method="post" action="?t=frontend&request=handleReport">
        <input type="hidden" value="<?php echo $report->id_objectReported; ?>" name="id_objectReported">
        <input type="hidden" value="<?php echo $report->type; ?>" name="type">
        <label for="report-description">Warum möchtest du <?php
        if($report->type == 'e') echo 'das Event';
        else if($report->type == 'u') echo 'den User';

            ?> melden?</label>
        <textarea class="form-control <?php echo $report->hasError('description') ? 'is-invalid' : ''?>" id="report-description" name="description" rows="3"></textarea>
        <div class="invalid-feedback">
            <?php echo $report->getError('description') ?>
        </div>
        <button type="submit" class="btn btn-danger">Abschicken</button>
    </form>
</div>
<?php
var_dump($report->errors);