<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    public function __construct() {}


    public function index()
    {
        $tasks = Task::paginate(10);
        return $this->setSuccessMessage('Tasks retrieved successfully!!', $tasks, Response::HTTP_OK);
    }


    public function store(Request $request)
    {

        try {
            $task = new Task();
            $validationInput = Validator::make($request->all(), $task->rules());


            if ($validationInput->fails()) {
                return $this->setErrorMessage('Validation Error', $validationInput->errors(), Response::HTTP_BAD_REQUEST);
            }

            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'status' => $request->status
            ]);

            if (!$task) {
                return $this->setErrorMessage('Error', 'Error while creating a task', Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                return $this->setSuccessMessage('Task created successfully!', $task, Response::HTTP_CREATED);
            }
        } catch (\Throwable $th) {
            return $this->setErrorMessage($th->getMessage(), $th, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id)
    {
        $task = Task::find($id);


        if (!$task) {
            return $this->setErrorMessage('Error', 'Task not found', Response::HTTP_NOT_FOUND);
        } else {
            return $this->setSuccessMessage('Task retrieved successfully!', $task, Response::HTTP_OK);
        }
    }

    public function update($id)
    {
        try {
            $request = request();
            $task = Task::find($id);

            if (!$task) {
                return $this->setErrorMessage('Error', 'Task not found', Response::HTTP_NOT_FOUND);
            }

            $task->update($request->all());

            return $this->setSuccessMessage('Task updated successfully!', $task, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->setErrorMessage($th->getMessage(), $th, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->setErrorMessage('Error', 'Task not found', Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return $this->setSuccessMessage('Task deleted successfully!', [], Response::HTTP_OK);
    }


    public function filterByStatus(Request $request)
    {
        $tasks = Task::where('status', $request->status)->paginate(10);

        // dd($tasks);

        if (!$tasks) {
            return $this->setErrorMessage('Error', 'No tasks found with status ' . $request->status, Response::HTTP_NOT_FOUND);
        } else {
            return $this->setSuccessMessage('Tasks By Filter Found!', $tasks, Response::HTTP_OK);
        }
    }

    /**
     * Search for exact match of the task,
     */
    public function searchTask(Request $request)
    {

        // dd($request);
        $tasks = Task::where('title', '=', $request->query('search'))
            ->orWhere('description', '=', $request->query('search'))
            ->paginate(10);

        if (!$tasks) {
            return $this->setErrorMessage('Error', 'No tasks found with title ' . $request->query('search'), Response::HTTP_NOT_FOUND);
        } else {
            return $this->setSuccessMessage('Search Results Found!', $tasks, Response::HTTP_OK);
        }
    }
}
