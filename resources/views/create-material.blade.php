<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Материалы</title>
</head>
<body>
<div class="main-wrapper">
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('materials.list') }}">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tag.list') }}">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.list') }}">Категории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
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
        </div>
    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>