<table class="table table-hover col-md-12">
    <thead>
        <tr>
            <th>ID</th><th>Автор</th><th>Дата</th><th>Содержание</th><th>Операции</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id  }}</td>
            <td>
                @if(!is_null($user->contacts))
                    {{ $user->contacts->name }} {{ $user->contacts->surname }}
                @endif
            </td>
            <td>{{ $user->email  }}</td>
            <td>
                @if(!is_null($user->contacts))
                    {{ $user->contacts->city }}
                @endif
            </td>
            <td>
                @if(!is_null($user->contacts))
                    {{ $user->contacts->phone }}
                @endif
            </td>
            <td>
                <a class="btn btn-danger" href="/admin/user/delete/{{ $user->id  }}">Удалить</a>
                @if( $user->locked)
                    <a class="btn btn-success col-md-6" href="/admin/user/unlock/{{ $user->id  }}">Разблокировать</a>
                @else
                    <a class="btn btn-warning col-md-6" href="/admin/user/lock/{{ $user->id  }}">Заблокировать</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>