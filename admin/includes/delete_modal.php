<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Delete
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Delete Box</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure want to delete this post?
            </div>

            <div class="modal-footer">
                <form id="formDeletePost" action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST'>
                    <input type='hidden' class="modal_delete_link" name='post_id' value=''>
                </form>
                <input form="formDeletePost" type='submit' class='btn btn-danger' name='delete' value='Delete'>
                <!-- <a href="" class="btn btn-danger modal_delete_link">Delete</a> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>