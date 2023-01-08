@extends('layouts.app')

@section('content')
<div class="container">
    {{-- CREATE TASK --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Utwórz zadanie</div>
                <div class="card-body">
                    <form action="/todos" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Wprowadź nazwę zadania" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary ms-auto me-0 d-block">Utwórz</button>
                        @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                @foreach ( $errors->all() as $error )
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                    </form>
                    @if(session('msg'))
                        <div class="alert alert-success mt-3">{{ session('msg') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- LIST OF TASKS --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Lista zadań</div>
                <div class="card-body">
                    {{-- LINKS --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="true">W toku</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab" aria-controls="done" aria-selected="false">Zakończone</button>
                        </li>
                    </ul>
                    {{-- TABS --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($todos_progress as $todo)
                                        <label class="list-group-item">
                                            <form class="row" method="POST" action="/todos/{{ $todo->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="col-md-6">
                                                    <input class="form-check-input" type="checkbox" value="{{ $todo->is_completed }}" name="is_completed">
                                                    {{ $todo->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-sm btn-primary">Zapisz</button>
                                                </div>
                                                <div class="col-md-12">
                                                    @if(session("msg_$todo->id"))
                                                        <div class="alert alert-success">{{ session("msg_$todo->id") }}</div>
                                                    @elseif(session("errors_$todo->id"))
                                                        <div class="alert alert-danger">{{ session("errors_$todo->id")->first('is_completed') }}</div>
                                                    @endif
                                                </div>

                                            </form>
                                        </label>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($todos_completed as $todo)
                                    <label class="list-group-item"> 
                                        <form class="row" method="POST" action="/todos/{{ $todo->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="col-md-6">
                                                <input class="form-check-input" type="checkbox" value="{{ $todo->is_completed }}" name="is_completed" checked>
                                                {{ $todo->name }}
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-sm btn-primary">Zapisz</button>
                                            </div>
                                            <div class="col-md-12">
                                                @if(session("msg_$todo->id"))
                                                    <div class="alert alert-success">{{ session("msg_$todo->id") }}</div>
                                                @elseif(session("errors_$todo->id"))
                                                    <div class="alert alert-danger">{{ session("errors_$todo->id")->first('is_completed') }}</div>
                                                @endif
                                            </div>

                                        </form>
                                    </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
