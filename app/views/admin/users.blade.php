
@if (isset($create))
<form action="/admin/general" method="post" class="form-inline form-group">
    <div class="form-group">
        <input class="form-control" type="email" required="" name="login" placeholder="E-mail"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="password" required="" name="password" placeholder="Пароль"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="password" required="" name="password_repeat" placeholder="Повторите пароль"/>
    </div>
    <div class="form-group">
        <input class="btn" type="submit" value="Создать"/>
    </div>
</form>
@endif
<table class="table table-hover col-md-12">
    <thead>
        <tr>
            <th>ID</th><th>Имя</th><th>Добавлен</th><th>E-mail</th><th>Страница в соцсети</th><th>Телефон</th><th>Операции</th>
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
            <td>{{ $user->created_at  }}</td>
            <td>{{ $user->email  }}</td>
            <td>
                @if(!is_null($user->contacts))
                    {{ $user->contacts->web }}
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
                    <a class="btn btn-success" href="/admin/user/unlock/{{ $user->id  }}">Разблокировать</a>
                @else
                    <a class="btn btn-warning" href="/admin/user/lock/{{ $user->id  }}">Заблокировать</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>