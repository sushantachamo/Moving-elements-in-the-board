<?php

use App\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tasks', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title');
      $table->integer('position');
      $table->text('description');
      $table->string('status');
      $table->timestamps();
    });

    Task::create([
      'title' => 'Task 1',
      'position' => 1,
      'description' => 'Description for Task 1',
      'status' => 'todo',
    ]);

    Task::create([
      'title' => 'Task 2',
      'position' => 2,
      'description' => 'Description for Task 2',
      'status' => 'doing',
    ]);

    Task::create([
      'title' => 'Task 3',
      'position' => 3,
      'description' => 'Description for Task 3',
      'status' => 'done',
    ]);

    Task::create([
      'title' => 'Task 4',
      'position' => 4,
      'description' => 'Description for Task 4',
      'status' => 'done',
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tasks');
  }
}
