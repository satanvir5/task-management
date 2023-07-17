<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Mail;


class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function allTasks(){
        $tasks = Task::getTaskOfUser();
        $users = User::getUsers();
        return view('tasks.index', compact('tasks','users'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline' => ['required', 'date'],
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');

        $user = User::findOrFail(auth()->id());
        $user->tasks()->save($task);

        // Implement the code to send email notification to the assignee

        return redirect()->route('tasks')->with('success', 'Task created successfully!');
    }




    public function taskAssign(Request $request)
    {

        $task = Task::findOrFail($request->task_id);
        $user = User::findOrFail($request->selected_user);

        $task->assigned_user = $user->id;
        $task->save();

        // Send email notification to the assignee

        Mail::to($user->email)->send(new TaskAssigned($task));

        // Redirect or return a response
    }
}

