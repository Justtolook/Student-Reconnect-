<script>
    function getVisitenkartenContent(uid) {
        //get the id of the currently open modal
        //var modalId = $('.modal.show').attr('id');
        // close all modals
        //$("#modalId").modal("hide");
        //open the modal
        $('#visitenkartenModalTemplate').modal('show');
        $.ajax({
            url: "index.php",
            type: "get",
            data: {
                't': "frontend",
                'request': "API_getVisitenkartenContent",
                'uid': uid
            },
            success: function(data) {
                
                $("#visitenkarten-modal-body").html(data);
            }
        });
    }
</script>

<style>
    .modal-content{
        background-color: #DFF2E9;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="visitenkartenModalTemplate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Visitenkarte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="visitenkarten-modal-body">
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>