<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index() {

    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        $todo = Todo::create([
            'name' => $request->name
        ]);

        return response([
            'msg' => 'Utworzono nowe zadanie',
            'todo' => $todo
        ]);
    }
    public function show($id) {
        $todo = Todo::find($id);
    }
    public function update() {

    }
    public function destroy() {

    }
}
