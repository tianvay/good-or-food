<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index ()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function profile ($user)
    {
        $user = User::where('name', '=', $user)
            ->first();
        #dd($user->name, $user->created_at->diffForHumans());

        return view('users.profile', compact('user'));
    }
}
