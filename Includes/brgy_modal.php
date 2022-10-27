<!-- Edit -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="id"></span></b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="brgy_edit.php">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="edit_name" class="col-sm-3 control-label">Barangay Name</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_name" name="name">
            </div>
          </div>
          <div class="form-group">
            <label for="edit_tag" class="col-sm-3 control-label">Barangay Tag</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_tag" name="tag">
            </div>
          </div>
          <div class="modal-footer">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="id"></span></b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="brgy_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>DELETE BARANGAY</p>
            <h2 class="bold name"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>