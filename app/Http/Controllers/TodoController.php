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

        return back()->with('msg', 'Zadanie zostało utworzone');
    }
    public function show($id) {
        $todo = Todo::find($id);
    }
    public function update($id, Request $request) {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'is_completed' => 'required|boolean',
            'name' => 'string|min:3'
        ]);
        if($validator->fails()) {
            return back()->with("errors_$id", $validator->errors());
        }
        $todo = Todo::find($id);
        $list = ['is_completed', 'name'];
        foreach($list as $name) {
            if(isset($request->$name)) $todo->$name = $request->$name;
        }
        $todo->save();

        return back()->with("msg_$id", 'Zaktualizowano zadanie');
    }
    public function destroy() {

    }
}
