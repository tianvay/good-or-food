<?php

namespace App\Http\Controllers;

use App\json;
use App\User;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    //
    public function index () {

        return view('partials.upload');
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if(auth()->check()){
            $storagepath = 'public/json/' . auth()->user()->name;
            #dd($storagepath);
            $request->json->storeAs($storagepath, $request->json->getClientOriginalName());

            $location = $request->json->getClientOriginalName();
            #dd($storagepath . '/' . $location);
            $json = new json;
            $json->filelocation = $location;
            $json->user_id = auth()->user()->id;
            $json->save();



            $user->json_id = $json->id;
            $user->update();
        }

        return redirect('/');

    }
}
