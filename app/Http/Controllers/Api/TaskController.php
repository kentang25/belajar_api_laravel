<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $tasks,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task = Task::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'is_completed' => $validated['is_completed'] ?? false,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::where('user_id', $request->user()->id)->findOrFail($id);

        if(!$task){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully',
            'data' => $task,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::where('user_id', $request->user()->id)->findOrFail($id);

        if(!$task){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        $task->delate();

        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted successfully'
        ], 200);
    }
}
