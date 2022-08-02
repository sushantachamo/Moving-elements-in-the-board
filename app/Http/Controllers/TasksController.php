<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class TasksController extends Controller {

  protected $rules = [
    'title' => 'required',
    'status' => 'required',
    'description' => 'required',
  ];

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $tasks = [
      'todo' => [],
      'doing' => [],
      'done' => [],
    ];

    foreach (Task::all()->sortBy('position') as $task) {
      $tasks[$task->status][] = $task;
    }

    return view('tasks.index', compact('tasks'));
  }

  /**
   * Gets task data in json by api.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getDataJson() {
    $tasks = [
      'todo' => [],
      'doing' => [],
      'done' => [],
    ];

    foreach (Task::all()->sortByDesc('position') as $task) {
      $tasks[$task->status][] = $task;
    }

    return response()->json($tasks);
  }

  /**
   * Add task.
   *
   * @param  \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   * @throws \Throwable
   */
  public function store(Request $request) {
    $validator = Validator::make($request->input(), $this->rules);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->getMessageBag()->toArray(),
      ]);
    }

    $maxPosition = Task::max('position');
    
    $request['position'] = $maxPosition + 1;

    $task = Task::add($request->all());
    $card = view('partials.tasks.card')->with('task', $task)->render();

    return response()->json([
      'task' => $task,
      'card' => $card,
    ]);
  }

  /**
   * Update task.
   *
   * @param  \Illuminate\Http\Request $request
   * @param $id
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, $id) {
    $validator = Validator::make($request->input(), $this->rules);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->getMessageBag()->toArray(),
      ]);
    }

    $maxPosition = Task::max('position');
    if($maxPosition < $request->position) {
       return response()->json([
        'errors' => [
          'value' => "You cannot enter greater position"
        ],
      ]);
    }
    $task = Task::find($id);
    if($task->position != $request->position) {
      if($request->position > $task->position) {
        $data =null;
        for($i = $task->position + 1; $i<= $request->position; $i++) {
          
          $data = $data.$i;
          if($i!= $request->position) {
            $data = $data.',';
          }
        }
        $myArray = explode(',', $data);
        $updateTask = Task::whereIn('position', $myArray)->get();
        if(!empty($updateTask)) {
          foreach($updateTask as $taskdetails) {
            $taskUpdate = Task::find($taskdetails->id);
            $data = array();
            $data['position'] = $taskUpdate['position'] - 1;
            $data['id'] = $taskUpdate['id'];
            $taskUpdate->edit($data);
          }
        }
        $task->edit($request->all());
      }
      else {
        $updateTask = DB::Table('tasks')->whereBetween('position',[$request->position, $task->position])->get();
        if(!empty($updateTask)) {
          foreach($updateTask as $taskdetails) {
            // print_r($taskdetails->id);
            $taskUpdate = Task::find($taskdetails->id);
            $data = array();
            $data['position'] = $taskUpdate['position'] + 1;
            $data['id'] = $taskUpdate['id'];
            $taskUpdate->edit($data);

          }
        }
        $task->edit($request->all());
      }
    }
    

    $card = view('partials.tasks.card')->with('task', $task)->render();

    return response()->json([
      'task' => $task,
      'card' => $card,
    ]);

  }

  /**
   * Delete task.
   *
   * @param $id
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id) {
    $task = Task::findOrFail($id);
    $task->comments()->delete();
    $task->delete();

    return response()->json($task);
  }
}
