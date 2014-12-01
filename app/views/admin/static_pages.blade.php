<form action="/admin/static-pages" method="post" class="form-group">
    <div class="col-md-12"><strong>Key: </strong> <input type="text" class="form-control" required="" name="key"/> </div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="alias" required="" placeholder="ЧПУ"/></div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="title" placeholder="Title"/></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="keywords" id="" placeholder="Keywords"  cols="30" rows="10"></textarea></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="description" id="" placeholder="Description"  cols="30" rows="10"></textarea></div>
    <div class="form-group col-md-12"><textarea class="form-control ckeditor" name="content" required="" id="" placeholder="Content"  cols="30" rows="10"></textarea></div>
    <div class="col-md-12"><input class="btn btn-success" type="submit"/></div>
</form>

@foreach ($pages as $page)
<form action="/admin/static-pages" method="post" class="form-group">
    <input type="hidden" name="id" value="{{ $page->id }}"/>
    <div class="col-md-12"><strong>{{ $page->key }}: </strong> </div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="alias" required="" placeholder="ЧПУ" value="{{ $page->alias }}"/></div>
    <div class="form-group col-md-3"><input type="text" class="form-control" name="title" placeholder="Title" value="{{ $page->title }}"/></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="keywords" id="" placeholder="Keywords"  cols="30" rows="10">{{ $page->keywords }}</textarea></div>
    <div class="form-group col-md-3"><textarea class="form-control" name="description" id="" placeholder="Description"  cols="30" rows="10">{{ $page->description }}</textarea></div>
    <div class="form-group col-md-12"><textarea class="form-control ckeditor" name="content" required="" id="" placeholder="Content"  cols="30" rows="10">{{ $page->content }}</textarea></div>
    <div class="col-md-12"><input class="btn btn-success" type="submit"/></div>
</form>
@endforeach