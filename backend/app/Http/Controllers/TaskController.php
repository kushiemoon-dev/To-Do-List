<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::with('category')->get();

        return $tasks;
    }

    public function getSingleTask($id)
    {
        $task = Task::find($id)->load('category');

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return $task;
    }

    public function createTask(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Task created'], 201);
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->title = $request->title;
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Task updated'], 200);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted'], 200);
    }
}
