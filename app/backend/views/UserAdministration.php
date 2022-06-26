<link rel="stylesheet" href="app/backend/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<h1>User Administration</h1>
<!-- print a table with all users and their data specified in UserModel-->
<script>
$(document).ready( function () {
$('#UserTable').DataTable();
} );
</script>
<table id="UserTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Description</th>
            <th>ScoreHost</th>
            <th>ScoreAttendee</th>
            <th>Role</th>
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
            <td><?php echo $user->description; ?></td>
            <td><?php echo $user->scoreHost; ?></td>
            <td><?php echo $user->scoreAttendee; ?></td>
            <td><?php echo $user->id_role; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
