<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

  protected const TASK_CLASS_TODO = 'secondary';
  protected const TASK_CLASS_DOING = 'primary';
  protected const TASK_CLASS_DONE = 'success';

  protected $fillable = [
    'title',
    'description',
    'status',
    'position',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function comments() {
    return $this->hasMany(Comment::class);
  }

  /**
   * Add task.
   *
   * @param $fields
   *
   * @return \App\Task
   */
  public static function add($fields) {
    $task = new static;
    $task->fill($fields);
    $task->save();

    return $task;
  }

  /**
   * Update task.
   *
   * @param $fields
   */
  public function edit($fields) {
    $this->fill($fields);
    $this->save();
  }

  /**
   * Gets class for task by status.
   *
   * @param $status
   *
   * @return mixed|null
   */
  static function getTaskClass($status) {
    $classes = [
      'todo' => self::TASK_CLASS_TODO,
      'doing' => self::TASK_CLASS_DOING,
      'done' => self::TASK_CLASS_DONE,
    ];

    return $classes[$status] ?? NULL;
  }

}
