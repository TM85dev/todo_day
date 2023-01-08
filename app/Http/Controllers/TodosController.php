<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodosController extends Controller
{
    public function index() {}
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            abort(400, json_encode(compact('errors')));
        }
        $todos = Todo::all();
        if(count($todos) > 20) {
            $errors = ['limit' => ['Maksymalna ilość zadań przekroczona']];
            abort(400, json_encode(compact('errors')));
        }
        
        $todo = Todo::create([
            'name' => $request->name
        ]);

        $msg = 'Zadanie zostało utworzone';
        return response(compact('msg'));
    }
    public function show() {}
    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'is_completed' => 'required|boolean',
            'name' => 'string|min:3'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            abort(400, json_encode(compact('errors')));
        }
        $todo = Todo::find($id);
        $list = ['is_completed', 'name'];
        foreach($list as $name) {
            if(isset($request->$name)) $todo->$name = $request->$name;
        }
        $todo->save();

        $msg = 'Zadanie zostało zaktualizowane';
        return response(compact('msg'));
    }
    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();

        $msg = 'Zadanie zostało usunięte';
        return response(compact('msg'));
    }
}
