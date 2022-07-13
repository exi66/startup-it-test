@extends('layouts.app')

@section('title')
    Материалы
@endsection

@section('content')
    <h1 class="my-md-5 my-4">Материалы</h1>
    <a class="btn btn-primary mb-4" href="{{ route('materials.create') }}" role="button">Добавить</a>
    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="input-group mb-3">
                    <input id="search" type="text" name="search" class="form-control" placeholder=""
                           aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <button class="btn btn-primary" type="sumbit" id="button-addon1">Искать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Автор</th>
                <th scope="col">Тип</th>
                <th scope="col">Категория</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $key => $material)
                <tr>
                    <td><a href="{{ route('materials.show',$material->id) }}">{{ $material->name }}</a></td>
                    <td>{{ $material->author }}</td>
                    <?php $types = ['Книга', 'Статья', 'Видео', 'Сайт/Блог', 'Подборка', 'Ключевые идеи книги'] ?>
                    <td>{{ $types[$material->type] }}</td>
                    <td>{{ $material->category->name }}</td>
                    <td class="text-nowrap text-end">
                        <a href="{{ route('materials.edit', $material->id) }}" class="text-decoration-none me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['materials.destroy', $material->id],'style'=>'display:inline', 'onsubmit'=>'return confirm("Удалить?");']) !!}
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        function getSearchParameters() {
            var prmstr = window.location.search.substr(1);
            return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
        }

        function transformToAssocArray(prmstr) {
            var params = {};
            var prmarr = prmstr.split("&");
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }

        var params = getSearchParameters();
        if (params.search) document.getElementById('search').value = decodeURIComponent(params.search.replace(/\+/g, '%20'));
    </script>
@endpush
