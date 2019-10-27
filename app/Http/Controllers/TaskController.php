<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
  public function index(Request $request){
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
      'tasks' => $tasks
    ]);
  }

  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required|max:255',
    ]);

    $task = new Task;
    $task->name = $request->name;
    // save;だと登録されない
    $task->save();

    return redirect('/tasks');
  }

  public function destroy(Request $request, Task $task){
    $task->delete();
    return redirect('/tasks');
  }
}
