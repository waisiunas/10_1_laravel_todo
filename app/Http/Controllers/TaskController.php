<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => ['required'],
        ]);

        $data = [
            'task' => $request->task,
            'user_id' => Auth::id(),
        ];

        $is_created = Task::create($data);

        if ($is_created) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failue' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_edit' => ['required'],
        ]);

        $data = [
            'task' => $request->task_edit,
        ];

        $is_updated = $task->update($data);

        if ($is_updated) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failue' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $is_deleted = $task->delete();

        if ($is_deleted) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failue' => 'Magic has failed to spell!']);
        }
    }
}
