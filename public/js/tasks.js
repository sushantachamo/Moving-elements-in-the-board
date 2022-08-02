$(document).ready(function () {
    const $cardFooter = $('.modal-footer');
    const $formEdit = $('#editTaskForm');
    const $formAdd = $('#addTaskForm');
    const $formDelete = $('#deleteTaskForm');
    const $formAddComment = $('#addCommentForm');
    const interval = 250;
    const timeoutDefault = 2000;

    // Add task.
    $cardFooter.on('click', '.add-task', function () {
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'tasks',
            data: {
                '_token': $formAdd.find('input[name=_token]').val(),
                'title': $formAdd.find('#task-title').val(),
                'status': $formAdd.find('#task-status').val(),
                'description': $formAdd.find('#task-description').val()
            },
            success: function (data) {
                if ((data.errors)) {
                    let messageNumber = 0;
                    $.each(data.errors, function (key, value) {
                        showErrorMessage(value, (++messageNumber * interval));
                        $formElement = $('#task-' + key);
                        $formElement.addClass('is-invalid');
                        $formElement.after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    $formAdd.modal('hide');
                    toastr.success('Task added!', 'Success', {timeOut: timeoutDefault});
                    $('.' + data.task.status).prepend(data.card);
                }
            },
        });
    });

    // Update task.
    $cardFooter.on('click', '.edit-task-save', function () {
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let id = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'PUT',
            url: 'tasks/' + id,
            data: {
                '_token': $formEdit.find('input[name=_token]').val(),
                'title': $formEdit.find('#task-title').val(),
                'status': $formEdit.find('#task-status').val(),
                'description': $formEdit.find('#task-description').val(),
                'position': $formEdit.find('#task-position').val()
            },
            success: function (data) {
                if ((data.errors)) {
                    let messageNumber = 0;
                    $.each(data.errors, function (key, value) {
                        showErrorMessage(value, (++messageNumber * interval));
                        $formElement = $('#task-' + key);
                        $formElement.addClass('is-invalid');
                        $formElement.after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    $formEdit.modal('hide');
                    toastr.success('Task updated!', 'Success', {timeOut: timeoutDefault});
                    $('.card-' + data.task.id).remove();
                    $('.' + data.task.status).prepend(data.card);
                }
            },
        });
    });

    // Delete task.
    $cardFooter.on('click', '.delete-task-confirm', function () {
        let id = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: 'tasks/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $formDelete.modal('hide');
                toastr.success('Task delete!', 'Success', {timeOut: timeoutDefault});
                $('.card-' + data.id).remove();
            }
        });
    });

    // Add comment.
    $cardFooter.on('click', '.add-comment', function () {
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');
        let id = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'comments/add/' + id,
            data: {
                '_token': $formAddComment.find('input[name=_token]').val(),
                'comment': $formAddComment.find('#task-comment').val(),
                'task_id': $formAddComment.find('#task-task-id').val(),
            },
            success: function (data) {
                if ((data.errors)) {
                    let messageNumber = 0;
                    $.each(data.errors, function (key, value) {
                        showErrorMessage(value, (++messageNumber * interval));
                        $formElement = $('#task-' + key);
                        $formElement.addClass('is-invalid');
                        $formElement.after('<div class="invalid-feedback">' + value + '</div>');
                    });
                } else {
                    $formAddComment.modal('hide');
                    toastr.success('Comment added!', 'Success', {timeOut: timeoutDefault});
                    getComments(id);
                }
            },
        });
    });

    // Clears addTask form fields.
    $(document).on('click', '.add-task-form', function () {
        $formAdd.find('#task-title').val('');
        $formAdd.find('#task-status').val('todo');
        $formAdd.find('#task-description').val('');
    });

    // Show delete task form.
    $(document).on('click', '.delete-task', function () {
        let id = $(this).data('id');
        let $card = $('.card-' + id);

        $formDelete.find('.card-status').text($card.find('.card-status').text());
        $formDelete.find('.card-title').text($card.find('.card-title').text());
        $formDelete.find('.card-text').text($card.find('.card-text').text());
        $formDelete.find('.delete-task-confirm').data('id', id);
    });

    // Show edit task form.
    $(document).on('click', '.edit-task', function () {
        let id = $(this).data('id');
        $card = $('.card-' + id);

        $formEdit.find('#task-title').val($card.find('.card-title').text());
        $formEdit.find('#task-status').val($card.find('.card-status').text());
        $formEdit.find('#task-position').val($card.find('.card-position').text());
        $formEdit.find('#task-description').val($card.find('.card-text').text());
        $formEdit.find('.add-comments-form').data('id', id);
        $formEdit.find('.edit-task-save').data('id', id);

        getComments(id);
    });

    // Show add comments form.
    $(document).on('click', '.add-comments-form', function () {
        let id = $(this).data('id');
        $formEdit.modal('hide');
        $formAddComment.find('.add-comment').data('id', id);
        $formAddComment.find('#task-task-id').val(id);
        $formAddComment.find('#task-comment').val('');
    });

    // Show Edit task form after close add comment form.
    $formAddComment.on('hidden.bs.modal', function () {
        $formEdit.modal('show');
    });

    // Show validation error message.
    function showErrorMessage(message, timeout) {
        setTimeout(function () {
            toastr.error(message, 'Validation error', {timeOut: timeoutDefault});
        }, timeout);
    }

    // Gets comments by Task ID.
    function getComments(taskId) {
        $.ajax({
            url: 'comments/' + taskId,
            success: function (data) {
                $('#task-comments').html(data.comments);
            },
        });
    }
});
