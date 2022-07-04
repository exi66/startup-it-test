@extends('layouts.app')

@section('title')
Теги
@endsection

@section('content')
            <h1 class="my-md-5 my-4">Добавить тег</h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    {!! Form::open(array('route' => 'tag.store','method'=>'POST')) !!}
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
@endpush