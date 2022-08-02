<!-- Modal form to edit a task -->
<div class="modal fade" id="editTaskForm" tabindex="-1" role="dialog" aria-labelledby="editTaskFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTaskFormLabel">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="task-title">Title</label>
              <input type="text" class="form-control" id="task-title" placeholder="Task Name" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
              <label for="task-position">Position</label>
              <input type="number" name="position" id="task-position" placeholder="Task Position" class="form-control" value="{{old('position')}}">
            </div>
            <div class="form-group">
              <label for="task-status">Select status</label>
              <select class="form-control" id="task-status">
                <option value="todo">TODO</option>
                <option value="doing">DOING</option>
                <option value="done">DONE</option>
              </select>
            </div>
            <div class="form-group">
              <label for="task-description">Description</label>
              <textarea name="description" id="task-description" cols="15" rows="5" placeholder="Task Description" class="form-control">{{old('description')}}</textarea>
            </div>
          </div>
        </form>
        {{-- <div class="text-right">
          <button type="button" class="btn btn-sm btn-outline-secondary add-comments-form" data-toggle="modal" data-target="#addCommentForm">
            <i class="fa fa-plus" aria-hidden="true"></i> Add comment
          </button>
        </div> --}}
        <div id="task-comments"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info edit-task-save">
          <i class="fa fa-file-text-o" aria-hidden="true"></i> Save
        </button>
        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">
          <i class="fa fa-times" aria-hidden="true"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
