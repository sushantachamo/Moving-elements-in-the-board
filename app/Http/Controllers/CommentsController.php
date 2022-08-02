<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller {

  protected $rules = [
    'comment' => 'required',
  ];

  public function index($taskId) {
    $comments = Comment::getComments($taskId);

    return response()->json([
      'comments' => $comments->count() ? view('comments.index', compact('comments'))->render() : '',
    ]);
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \App\Comment|\Illuminate\Http\JsonResponse
   */
  public function store(Request $request) {
    $validator = Validator::make($request->input(), $this->rules);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->getMessageBag()->toArray(),
      ]);
    }

    return Comment::add($request->all());
  }
}
