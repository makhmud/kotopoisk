
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

@foreach ($pages as $page)
<form action="/admin/pages" method="post" class="form-group">
    <input type="hidden" name="id" value="{{ $page->id }}"/>
    <div class="col-md-12"><strong>{{ $page->key }}: </strong> </div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="alias" placeholder="ЧПУ" value="{{ $page->alias }}"/></div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="title" placeholder="Title" value="{{ $page->title }}"/></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="keywords" id="" placeholder="Keywords"  cols="30" rows="10">{{ $page->keywords }}</textarea></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="description" id="" placeholder="Description"  cols="30" rows="10">{{ $page->description }}</textarea></div>
    <div class="col-md-12"><input class="btn btn-success" type="submit"/></div>
</form>
@endforeach