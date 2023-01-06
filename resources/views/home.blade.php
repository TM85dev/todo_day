@extends('layouts.app')

@section('content')
<div class="container">
    {{-- CREATE TASK --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Utwórz zadanie</div>
                <div class="card-body">
                    <form action="/todo" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nazwa</label>
                            <input type="text" class="form-control" id="name" placeholder="Wprowadź nazwę zadania" autocomplete="off">
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
                </div>
            </div>
        </div>
    </div>

    {{-- LIST OF TASKS --}}
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Lista zadań</div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
