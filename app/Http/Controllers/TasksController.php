<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Return a single task.
     */
    public function show(string $task_id)
    {
        $task = Task::find($task_id);
        return response()->json($task);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // validate request
            $validatedTask =  $request->validate([
                'title' => 'required',
                'description' => 'required',
                'workspace_id' => 'required',
                'deadline' => 'required',
                'status' => 'required',
            ]);

            // create task
            $task = Task::create($validatedTask);

            // return task
            return response()->json(['message' => 'Task created successfully.', 'data' => $task]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Task could not be created.', 'data' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'status' => 'required',
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
