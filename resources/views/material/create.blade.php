@extends('layouts.app')

@section('title')
    Материалы
@endsection

@section('content')
    <h1 class="my-md-5 my-4">Добавить материал</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            {!! Form::open(array('route' => 'materials.store','method'=>'POST')) !!}
            <div class="form-floating mb-3">
                <select class="form-select" name="type" id="floatingSelectType">
                    <option value="0">Книга</option>
                    <option value="1">Статья</option>
                    <option value="2">Видео</option>
                    <option value="3">Сайт/Блог</option>
                    <option value="4">Подборка</option>
                    <option value="5">Ключевые идеи книги</option>
                </select>
                <label for="floatingSelectType">Тип</label>
                <div class="invalid-feedback">
                    Пожалуйста, выберите значение
                </div>
            </div>
            <div class="form-floating mb-3">
                {!! Form::select('category_id', $category,[], array('class' => 'form-control','id' => 'floatingSelectCategory')) !!}
                <label for="floatingSelectCategory">Категория</label>
                <div class="invalid-feedback">
                    Пожалуйста, выберите значение
                </div>
            </div>
            <div class="form-floating mb-3">
                {!! Form::text('name', null, array('placeholder' => 'Введите название','class' => 'form-control','id' => 'floatingName')) !!}
                <label for="floatingName">Название</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <div class="form-floating mb-3">
                {!! Form::text('author', null, array('placeholder' => 'Введите автора','class' => 'form-control','id' => 'floatingAuthor')) !!}
                <label for="floatingAuthor">Авторы</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <div class="form-floating mb-3">
                {!! Form::textarea('description', null, array('id' => 'floatingDescription', 'style' => 'height: 100px', 'class' => 'form-control')) !!}
                <label for="floatingDescription">Описание</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Добавить</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection


