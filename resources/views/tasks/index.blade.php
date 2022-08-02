<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ToDo List</title>
  <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="container">
  <div class="row mt-3 mb-3">
    <div class="col-sm-6">
      <h3>My <b>Tasks</b></h3>
    </div>
    <div class="col-sm-6 text-right">
      <button class="btn btn-outline-info add-task-form" data-toggle="modal" data-target="#addTaskForm">
        <i class="fa fa-plus" aria-hidden="true"></i> Add Task
      </button>
    </div>
  </div>
  <div class="row mb-3">
    @foreach($tasks as $status => $tasksByType)
      <div class="col-sm-4">
        <div class="card border-{{ App\Task::getTaskClass($status) }} h-100">
          <div class="card-header bg-{{ App\Task::getTaskClass($status) }} text-light text-uppercase">
            <b>{{ $status }}</b>
          </div>
          <div class="card-body pb-0 {{ $status }}">
            @foreach($tasksByType as $task)
              @include('partials.tasks.card')
            @endforeach
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@include('partials.tasks.add')
@include('partials.tasks.delete')
@include('partials.tasks.edit')
@include('partials.comments.add')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="{{asset('js/tasks.js')}}"></script>
</body>
</html>
