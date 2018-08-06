<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index ()
    {
        $monsters = auth()
            ->user()
            ->units;

        return view('users.units.index', compact('monsters'));
    }
}
