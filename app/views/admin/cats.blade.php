<table class="table table-hover col-md-12">
    <thead>
        <tr>
            <th>ID</th><th>Автор</th><th>Дата</th><th class="col-md-7">Содержание</th><th>Операции</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cats as $cat)
        <tr>
            <td>{{ $cat->id  }}</td>
            <td>
                @if(!is_null($cat->author))
                    {{ $cat->author->email }}
                @endif
            </td>
            <td>{{ $cat->created_at }}</td>
            <td>{{ $cat->content }}</td>
            <td>
                <a class="btn btn-danger" href="/admin/cat/delete/{{ $cat->id  }}">Удалить</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>