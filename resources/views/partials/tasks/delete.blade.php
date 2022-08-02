<!-- Modal form to delete a task -->
<div class="modal fade" id="deleteTaskForm" tabindex="-1" role="dialog" aria-labelledby="deleteTaskFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTaskFormLabel">Delete Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header">
            Are you sure you want to delete the following task?
          </div>
          <div class="card-body">
            <div class="title">
              <span class="text-muted">Title:</span> <span class="card-title"></span>
            </div>
            <div class="description">
              <span class="text-muted">Description:</span> <span class="card-text"></span>
            </div>
            <div class="status">
              <span class="text-muted">Status:</span> <span class="card-status text-uppercase"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger delete-task-confirm">
          <i class="fa fa-trash" aria-hidden="true"></i> Delete
        </button>
        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">
          <i class="fa fa-times" aria-hidden="true"></i> Cancel
        </button>
      </div>
    </div>
  </div>
</div>
