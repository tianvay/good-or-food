<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    //
    public function __construct()
    {
        # access features only if you are logged in
        $this->middleware('auth')
            #->except(['index'])
        ;
    }

    public function index()
    {
        $tasks = Task::orderBy('id')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        #return $task; //output as json

        return view('tasks.show', compact('task'));
    }
}
