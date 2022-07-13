@extends('layouts.app')

@section('title')
    Материалы
@endsection

@section('content')
    <h1 class="my-md-5 my-4">{{ $material->name }}</h1>
    <div class="row mb-3">
        <div class="col-lg-6 col-md-8">
            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                <p class="col">{{ $material->author }}</p>
            </div>
            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                <?php $types = ['Книга', 'Статья', 'Видео', 'Сайт/Блог', 'Подборка', 'Ключевые идеи книги'] ?>
                <p class="col">{{ $types[$material->type] }}</p>
            </div>
            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                <p class="col">{{ $material->category->name }}</p>
            </div>
            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                <p class="col">{{ $material->description }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(array('route' => ['materials.add_tag', $material->id], 'method'=>'POST')) !!}
            <h3>Теги</h3>
            <div class="input-group mb-3">
                {!! Form::select('tag_id', $all_tags,[], array('class' => 'form-select','id' => 'selectAddTag')) !!}
                <button class="btn btn-primary" type="sumbit">Добавить</button>
            </div>
            {!! Form::close() !!}
            <ul class="list-group mb-4">
                @foreach ($tags as $key => $tag)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="{{ route('materials.list').'?tag='.$tag->name }}" class="me-3">
                            {{ $tag->name }}
                        </a>
                        {!! Form::open(array('route' => ['materials.rm_tag', $material->id], 'method'=>'DELETE', 'onsubmit'=>'return confirm("Удалить?");')) !!}
                        {!! Form::hidden('tag_id', $tag->id, array('class' => 'd-none')) !!}
                        <label class="text-decoration-none">
                            {!! Form::submit('', ['class' => 'd-none']) !!}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </label>
                        {!! Form::close() !!}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-between mb-3">
                <h3>Ссылки</h3>
                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Добавить</a>
            </div>
            <ul class="list-group mb-4">
                @foreach ($links as $key => $link)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="{{	$link->url }}" class="me-3">
                            {{ $link->name ? $link->name : $link->url  }}
                        </a>
                        <span class="text-nowrap d-flex">
								<a class="text-decoration-none me-2 edit-button"
                                   edit-data="{{ route('urls.edit', $link->id) }}" role="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pencil" viewBox="0 0 16 16">
										<path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
									</svg>
								</a>
								{!! Form::open(array('route' => ['urls.destroy', $link->id], 'method'=>'DELETE', 'onsubmit'=>'return confirm("Удалить?");')) !!}
								<label class="text-decoration-none">
									{!! Form::submit('', ['class' => 'd-none']) !!}
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
										<path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg>
								</label>
								{!! Form::close() !!}
							</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @if (count($errors->links) > 0)
                    <div class="alert-danger m-3 rounded p-1">
                        <strong>Ошибка!</strong> Возникла ошибка при вводе данных.<br>
                        <ul>
                            @foreach ($errors->links->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('route' => 'urls.store','method'=>'POST')) !!}
                {!! Form::hidden('material_id', $material->id, array('class' => 'd-none')) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Добавить ссылку</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        {!! Form::text('name', null, array('placeholder' => 'Добавьте подпись','class' => 'form-control','id' => 'floatingModalSignature')) !!}
                        <label for="floatingModalSignature">Подпись</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>

                    </div>
                    <div class="form-floating mb-3">
                        {!! Form::text('url', null, array('placeholder' => 'Добавьте ссылку','class' => 'form-control','id' => 'floatingModalLink')) !!}
                        <label for="floatingModalLink">Ссылка</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="alert-danger m-3 rounded p-1" id="edit-errors">

                </div>
                <div class="alert-success m-3 rounded p-1" id="edit-success">

                </div>
                <form id="edit-form" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" class="d-none" id="material_id" name="material_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel1">Изменить ссылку</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Добавьте подпись"
                                   id="edit-name">
                            <label for="edit-name">Подпись</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>

                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Добавьте ссылку" name="url"
                                   id="edit-url">
                            <label for="edit-url">Ссылка</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php $links = $errors->hasBag('links'); ?>
    <script>
        var links = {!! json_encode($links) !!};
        $(document).ready(function () {
            if (links) $('#exampleModalToggle').modal('show')
        })

        $('.edit-button').click(function () {
            var url = $(this).attr('edit-data');
            $('#edit-errors').hide();
            $('#edit-success').hide();
            $.ajax({
                url: url,
                type: 'GET',
                async: false,
                success: function (res) {
                    return res;
                }
            }).then(function (res) {
                $('#edit-form').attr('action', '/url/' + res.data.id + '/update');
                $('#material_id').val(res.data.material_id);
                $('#edit-name').val(res.data.name);
                $('#edit-url').val(res.data.url);
                $('#exampleModalToggle1').modal('show');
            });
        });

        $("#edit-form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function (res) {
                    return res
                }
            }).then(function (res) {
                if (res.errors) {
                    var html = Object.keys(res.errors).map(key => `${res.errors[key]}`).join("<br/>");
                    $('#edit-errors').html(html);
                    $('#edit-errors').show();
                }
                if (res.success) {
                    $('#edit-success').html(res.success);
                    $('#edit-success').show();
                }
            });

        });
    </script>
@endpush
