<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;


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

        if (isset($task)) {

            return $task;


        } else {

            return response('', 404);
        }
    }


    public function createTask(Request $request)
    {

        if ($request->filled('title')) {


            $request->validate([
                'title' => 'min:3|max:255'
            ]);


            $title = $request->input('title');

            $newTask = new Task();

            $newTask->title = $title;

            if ($newTask->save()) {

                return response()->json(Task::find($newTask->id), Response::HTTP_CREATED);
            } else {

                return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response('', Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateTask(Request $request, int $id)
    {

        $taskToUpdate = Task::find($id);


        if ($taskToUpdate !== null) {

            if ($request->filled('title')) {

                $taskToUpdate->title = $request->input('title');

                if ($taskToUpdate->save()) {

                    return response('', Response::HTTP_NO_CONTENT);
                } else {
                    return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                return response('', Response::HTTP_BAD_REQUEST);
            }
        } else {

            return response('', Response::HTTP_NOT_FOUND);
        }
    }

    public function deleteTask(int $id)
    {
        $taskToDelete = Task::find($id);


        if ($taskToDelete === null) {
            return response('', Response::HTTP_NOT_FOUND);
        }

        if ($taskToDelete->delete()) {
            return response('', Response::HTTP_NO_CONTENT);
        } else {
            return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
