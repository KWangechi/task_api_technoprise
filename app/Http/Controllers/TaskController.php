<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Response;

// use Laravel\Lumen\Routing\Controller as BaseController;


class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::paginate(10);
        return $this->setSuccessMessage('Tasks retrieved successfully!!', $tasks, Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique|string',
                'description' => 'required',
                'due_date' => 'required|datetime',
                'status' => 'required|default:pending'
            ]);


            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'status' => $request->status
            ]);

            // dd($task);

            if (!$task) {
                return $this->setErrorMessage('Error', 'Error while creating a task', Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                return $this->setSuccessMessage('Task created successfully!', $task, Response::HTTP_CREATED);
            }
        } catch (\Throwable $th) {
            return $this->setErrorMessage($th->getMessage(), $th, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id) {}

    public function update($id) {}

    public function destroy($id) {}


    public function complete($id) {}

    public function incomplete($id) {}

    public function dueToday($id) {}

    public function dueThisWeek($id) {}
}
