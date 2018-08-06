<?php

namespace App\Http\Controllers;

use App\Rune;
use Illuminate\Http\Request;

class RunesController extends Controller
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

        if(auth()->check()){
            $user = auth()->user();

            $runes = Rune::where('user_id', '=', $user->id)
                ->orderBy('slot')
                ->orderBy('set')
                ->get();
        }
        else {
            $runes = null;
        }

        return view('runes.index', compact('runes'));
    }

    public function wizard()
    {

        return view('runes.wizard');
    }


}
