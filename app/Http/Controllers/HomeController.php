<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todos_completed = Todo::where('is_completed', true)->get();
        $todos_progress = Todo::where('is_completed', false)->get();
        // return view('home');
        return view('home', compact('todos_completed', 'todos_progress'));
    }
}
