<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('users')->orderBy('created_at', 'desc')->get()->groupBy('status');

        $response = [
            'success' => true,
            'message' => "Task List",
            'data' => $tasks,
        ];

        return response()->json($response);
    }

    public function show(Task $task)
    {
        $taskWithUsers = $task->load('users');

        $taskWithUsers->users = $task->users->map(function ($user) {
            unset($user->pivot);
            return $user;
        });

        $response = [
            'success' => true,
            'message' => "Task info",
            'data' => $taskWithUsers
        ];

        return response()->json($response);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'by_user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        if (isset($request->user_id)) {
            $task->users()->attach($request->user_id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $response = [
            'success' => true,
            'message' => "Task created successfully",
            'data' => $task,
        ];

        return response()->json($response);
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        if (!Gate::allows('update', $task)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to update this task',
            ], 403);
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        // Update the user associations if user_id is provided
        if (isset($request->user_id)) {
            $task->users()->sync($request->user_id);
        }

        $response = [
            'success' => true,
            'message' => "Task updated successfully",
            'data' => $task,
        ];

        return response()->json($response);
    }

    public function destroy(Task $task)
    {
        if (!Gate::allows('delete', $task)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to delete this task',
            ], 403);
        }

        $task->delete();

        $response = [
            'success' => true,
            'message' => "Task deleted successfully",
        ];

        return response()->json($response);
    }

    public function getUsers()
    {
        $users = User::orderBy('name', 'asc')->get();

        $response = [
            'success' => true,
            'message' => "User List",
            'data' => $users,
        ];

        return response()->json($response);
    }
}
