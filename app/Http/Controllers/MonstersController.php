<?php

namespace App\Http\Controllers;

use App\Monster;
use Illuminate\Http\Request;

class MonstersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')
            ->except([
                'index',
                'show'
            ])
        ;
    }

    public function index()
    {

        $monsters = Monster::orderBy('name')
            ->where('awakens_from', '!=', null)
            ->where('name', 'NOT LIKE', '%Angelmon')
            ->where('name', 'NOT LIKE', '%Imperfect');

        $element = request('element');
        if ($element && is_string($element) && strlen($element)) {
            $monsters->where('element', $element);
        }

        $name = request('name');
        if ($name && is_string($name) && strlen($name)) {
            $monsters->where('name', 'LIKE', '%'.$name.'%');
        }

        $monsters = $monsters->paginate(42);
            #->get(); /* not needed when paginate is used */

        // fun fact: using simplePaginate means that models->total() will not work
        // with paginate you can use it

        return view('monsters.index',
            compact('monsters', 'name', 'element')
        );
    }

    public function show(Monster $monster)
    {

        return view('monsters.show', compact('monster'));
    }

    public function featured()
    {
        $featured = Monster::orderBy('motd')
            ->whereNotNull('motd')
            ->whereNotNull('article')
            ->get();

        return view('monsters.featured', compact('featured'));
    }

    public function writeArticle (Monster $monster)
    {

        $article = $_POST['article'];

        if(auth()->user()->is_admin){
            $monster->update([
                'article' => $article
            ]);
        }

        return redirect('/monsters/' . $monster->id);
    }
}
