<?php
?>
<script>
    //function to dismiss a report
    function dismiss(rid) {
        $.ajax({
            type: "get",
            url: "index.php",
            data: {
                't': 'frontend',
                'request': 'API_dismissReport',
                'id_report': rid
            },
            success: function(data) {
                location.reload();
            }
        });
    }

    function accept(rid) {
        $.ajax({
            type: "get",
            url: "index.php",
            data: {
                't': 'frontend',
                'request': 'API_acceptReport',
                'id_report': rid
            },
            success: function(data) {
                location.reload();
            }
        });
    }

</script>

<div class="mt-2 mb-3">
<h1>Meldevorgänge</h1>
</div>
<?php
foreach($reports as $report) {

    include 'app/frontend/views/reportItem.php';
}