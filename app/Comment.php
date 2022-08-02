<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

  protected $fillable = [
    'comment',
    'task_id',
  ];

  public function task() {
    return $this->belongsTo(Task::class);
  }

  /**
   * @param $fields
   *
   * @return \App\Comment
   */
  public static function add($fields) {
    $comment = new static;
    $comment->fill($fields);
    $comment->save();

    return $comment;
  }

  /**
   * @param $fields
   */
  public function edit($fields) {
    $this->fill($fields);
    $this->save();
  }

  /**
   * @param $taskId
   *
   * @return \App\Comment[]|\Illuminate\Database\Eloquent\Collection
   */
  public static function getComments($taskId) {
    return Comment::all()->where('task_id', $taskId)->sortBy('created_at');
  }
}
