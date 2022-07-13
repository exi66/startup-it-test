@extends('layouts.app')

@section('title')
    Теги
@endsection

@section('content')
    <h1 class="my-md-5 my-4">Добавить тег</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            {!! Form::open(array('route' => 'tags.store','method'=>'POST')) !!}
            <div class="form-floating mb-3">
                {!! Form::text('name', null, array('placeholder' => 'Введите название','class' => 'form-control','id' => 'floatingName')) !!}
                <label for="floatingName">Название</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Добавить</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
