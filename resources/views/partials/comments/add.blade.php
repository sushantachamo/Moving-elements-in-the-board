<!-- Modal form to add a comment -->
<div class="modal fade" id="addCommentForm" tabindex="-1" role="dialog" aria-labelledby="addCommentFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCommentFormLabel">Add New Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="task-comment">Comment</label>
              <textarea name="comment" id="task-comment" cols="10" rows="5" placeholder="Task comment" class="form-control">{{old('comment')}}</textarea>
            </div>
            <div class="form-group d-none">
              <label for="task-task-id">Task ID</label>
              <input type="text" class="form-control" id="task-task-id" name="task_id">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info add-comment">
          <i class="fa fa-plus" aria-hidden="true"></i> Add
        </button>
        <button type="button" class="btn btn-outline-warning close-comments-form" data-dismiss="modal">
          <i class="fa fa-times" aria-hidden="true"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
