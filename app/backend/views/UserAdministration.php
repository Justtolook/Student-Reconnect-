<link rel="stylesheet" href="app/backend/css/jquery.dataTables.min.css">
<script src="app/backend/js/jquery.dataTables.min.js"></script>
<?php

?>
<h1>User Administration</h1>
<!-- print a table with all users and their data specified in UserModel-->
<script>
    $(document).ready(function() {
        $('.user-edit-button').click(function() {
            //clear all modal fields
            $('#user-edit-modal-id').val();
            $('#user-edit-modal-firstname').val();
            $('#user-edit-modal-lastname').val();
            $('#user-edit-modal-email').val();
            $('#user-edit-modal-birthdate').val();
            $('#user-edit-modal-gender').val();
            $('#user-edit-modal-description').val();
            $('#user-edit-modal-contactinfo').val();
            $('#user-edit-modal-scoreHost').val();
            $('#user-edit-modal-scoreAttendee').val();
            $('#user-edit-modal-role-user').prop('checked', false);
            $('#user-edit-modal-role-moderator').prop('checked', false);
            $('#user-edit-modal-role-admin').prop('checked', false);

            var userId = $(this).attr('data-user-id');
            //get current url
            var url_base = window.location.host + window.location.pathname;
            $.ajax({
                url: url_base + '?t=backend&request=API_getUser&uid=' + userId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    var user = JSON.parse(data);
                    $('#user-edit-modal-id').val(user.id_user);
                    $('#user-delete-modal-id').val(user.id_user);
                    $('#user-edit-modal-firstname').val(user.firstname);
                    $('#user-edit-modal-lastname').val(user.lastname);
                    $('#user-edit-modal-email').val(user.email);
                    $('#user-edit-modal-birthdate').val(user.birthdate);
                    $('#user-edit-modal-gender').val(user.gender);
                    $('#user-edit-modal-description').val(user.description);
                    $('#user-edit-modal-contactinfo').val(user.contactInformation);
                    $('#user-edit-modal-scoreHost').val(user.scoreHost);
                    $('#user-edit-modal-scoreAttendee').val(user.scoreAttendee);
                    //select the correct radio button according to role
                    if (user.id_role == 1) {
                        $('#user-edit-modal-role-user').prop('checked', true);
                    } else if (user.id_role == 2) {
                        $('#user-edit-modal-role-moderator').prop('checked', true);
                    } else if (user.id_role == 3) {
                        $('#user-edit-modal-role-admin').prop('checked', true);
                    }
                }
            });
        });
    } );



$(document).ready( function () {
$('#UserTable').DataTable();
} );
// AJAX call to get user data by id and dump it in the modal
/*
// AJAX call to update data with the inserted data in the modal
$(document).ready(function() {
    $('.user-edit-modal-save').click(function() {
        var userId = $('#user-edit-modal-id').val();
        var firstname = $('#user-edit-modal-firstname').val();
        var lastname = $('#user-edit-modal-lastname').val();
        var email = $('#user-edit-modal-email').val();
        var birthdate = $('#user-edit-modal-birthdate').val();
        var gender = $('#user-edit-modal-gender').val();
        var description = $('#user-edit-modal-description').val();
        var contactinfo = $('#user-edit-modal-contactinfo').val();
        var scoreHost = $('#user-edit-modal-scoreHost').val();
        var scoreAttendee = $('#user-edit-modal-scoreAttendee').val();
        var role = $('#user-edit-modal-role').val();
        //get current url
        var url_base = window.location.host + window.location.pathname;

        $.ajax({
            url: url_base + '?t=backend&request=API_editUser',
            type: 'POST',
            data: {
                id: userId,
                firstname: firstname,
                lastname: lastname,
                email: email,
                birthdate: birthdate,
                gender: gender,
                description: description,
                contactinfo: contactinfo,
                scoreHost: scoreHost,
                scoreAttendee: scoreAttendee,
                role: role,
            }
        });
    })
} );
*/
</script>
<table id="UserTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Gender</th>
            <th>Description</th>
            <th>Contact Information</th>
            <th>ScoreHost</th>
            <th>ScoreAttendee</th>
            <th>Role</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr>
            <td><?php echo $user->id_user; ?></td>
            <td><?php echo $user->firstname; ?></td>
            <td><?php echo $user->lastname; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->birthdate; ?></td>
            <td><?php echo $user->gender; ?></td>
            <td><?php echo $user->description; ?></td>
            <td><?php echo $user->contactInformation; ?></td>
            <td><?php echo $user->scoreHost; ?></td>
            <td><?php echo $user->scoreAttendee; ?></td>
            <td><?php echo $user->id_role; ?></td>
            <td><button data-toggle="modal" data-target="#UserEditModal" class="user-edit-button" data-user-id="<?php echo $user->id_user; ?>">Edit</button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- create the modal for editing users called by the edit button -->
<div class="modal fade" id="UserEditModal" tabindex="-1" role="dialog" aria-labelledby="UserEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserEditModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?t=backend&request=API_editUser" method="POST">
                    <input type="hidden" id="user-edit-modal-id" name="id_user" value="">
                    <div class="form-group">
                        <label for="user-edit-modal-email">Email</label>
                        <input type="email" class="form-control" id="user-edit-modal-email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-firstname">Firstname</label>
                        <input type="text" class="form-control" id="user-edit-modal-firstname" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-lastname">Lastname</label>
                        <input type="text" class="form-control" id="user-edit-modal-lastname" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="user-edit-modal-birthdate" name="birthdate">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-gender">Gender</label>
                        <input type="text" class="form-control" id="user-edit-modal-gender" name="gender">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-description">Description</label>
                        <textarea type="text" class="form-control" id="user-edit-modal-description" name="description">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-contactinfo">Contact Information</label>
                        <textarea type="text" class="form-control" id="user-edit-modal-contactinfo" name="contactinfo">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-scoreHost">ScoreHost</label>
                        <input type="text" class="form-control" id="user-edit-modal-scoreHost" name="scoreHost">
                    </div>
                    <div class="form-group">
                        <label for="user-edit-modal-scoreAttendee">ScoreAttendee</label>
                        <input type="text" class="form-control" id="user-edit-modal-scoreAttendee" name="scoreAttendee">
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="user-edit-modal-role-user" name="id_role" value="1">
                        <label class="form-check-label" for="user-edit-modal-role-user">Standard User</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="user-edit-modal-role-moderator" name="id_role" value="2">
                        <label class="form-check-label" for="user-edit-modal-role-moderator">Moderator</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="user-edit-modal-role-admin" name="id_role" value="3">
                        <label class="form-check-label" for="user-edit-modal-role-admin">Administrator</label>
                    </div>
                    <button type="submit" class="btn btn-primary user-edit-modal-save">Daten Updaten</button>
                </form>
                <form action="?t=backend&request=API_deleteUser" method="POST">
                    <input type="hidden" id="user-delete-modal-id" name="id_user" value="">
                    <button type="submit" class="btn btn-danger user-edit-modal-delete">User Löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>