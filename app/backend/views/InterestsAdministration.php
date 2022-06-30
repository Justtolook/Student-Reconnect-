<link rel="stylesheet" href="app/backend/css/jquery.dataTables.min.css">
<script src="app/backend/js/jquery.dataTables.min.js"></script>
<h1>Interessen Administration</h1>

<script>
    $(document).ready(function() {
        $('.interest-edit-button').click(function() {
            //clear all modal fields
            $('#interest-edit-modal-id').val();
            $('#interest-edit-modal-name').val();

            var interestId = $(this).attr('data-interest-id');
            //get current url
            var url_base = window.location.host + window.location.pathname;
            $.ajax({
                url: url_base + '?t=backend&request=API_getInterest&iid=' + interestId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    var interest = JSON.parse(data);
                    $('#interest-edit-modal-id').val(interest.id_interest);
                    $('#interest-edit-modal-name').val(interest.name);
                }
            });
        });
    } );


$(document).ready( function () {
    $('#InterestTable').DataTable();
} );
</script>


<!-- form to add an interest -->
<div class="form-group" style="width: 40%;">
    <form action="?t=backend&request=API_addInterest" method="POST">
        <label for="interest-add-name">Name</label>
        <input type="text" class="form-control" id="interest-add-name" name="interest-add-name">
        <button type="submit" class="btn btn-success">Interesse hinzufügen</button>
    </form>
</div>
<div style="height: 5%;"></div>


<table id="InterestTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($interestModel->interests as $id => $name) { ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $name; ?></td>
            <td>
                <a data-toggle="modal" data-target="#InterestEditModal" class="interest-edit-button btn btn-primary" data-interest-id="<?php echo $id; ?>">Edit</a>
                <a href="?t=backend&request=API_deleteInterest&iid=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </thead>
</table>

<div class="modal fade" id="InterestEditModal" tabindex="-1" role="dialog" aria-labelledby="UserEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InterestEditModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?t=backend&request=API_editInterest" method="POST">
                    <input type="hidden" id="interest-edit-modal-id" name="id_interest" value="">
                    <div class="form-group">
                        <label for="interest-edit-modal-name">Name</label>
                        <input type="name" class="form-control" id="interest-edit-modal-name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary interest-edit-modal-save">Daten Updaten</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

?>