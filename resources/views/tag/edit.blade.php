@extends('layouts.app')

@section('title')
    Теги
@endsection

@section('content')
    <h1 class="my-md-5 my-4">Изменить тег</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            {!! Form::model($tag, ['method' => 'PATCH','route' => ['tags.update', $tag->id]]) !!}
            <div class="form-floating mb-3">
                {!! Form::text('name', null, array('placeholder' => 'Введите название','class' => 'form-control','id' => 'floatingName')) !!}
                <label for="floatingName">Название</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Сохранить</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

