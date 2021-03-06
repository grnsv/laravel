@extends('layouts.admin')

@section('title')
Редактировать новость - @parent
@stop

@section('header')
<h1 class="h2">Редактировать новость</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.news.update', ['news' => $news]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="categories">Выбрать категории</label>
        <select name="categories[]" id="categories" class="form-control" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($news->categories->contains($category->id)) selected
                @endif>{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}" required>
        @error('title') <strong style="color: red;">{{ $message }}</strong> @enderror
    </div>
    <div class="form-group">
        <label for="author">Автор</label>
        <input type="text" name="author" id="author" class="form-control" value="{{ $news->author }}">
        @error('author') <strong style="color: red;">{{ $message }}</strong> @enderror
    </div>
    <div class="form-group">
        <label for="image">Загрузить изображение</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="status">Статус</label>
        <select name="status" id="status" class="form-control">
            <option value="draft" @if( $news->status==='draft' ) selected @endif>DRAFT</option>
            <option value="active" @if( $news->status==='active' ) selected @endif>ACTIVE</option>
            <option value="blocked" @if( $news->status==='blocked' ) selected @endif>BLOCKED</option>
        </select>
        @error('status') <strong style="color: red;">{{ $message }}</strong> @enderror
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{!! $news->description !!}</textarea>
        @error('description') <strong style="color: red;">{{ $message }}</strong> @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection

@push('js')
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
                options: {
                    resourceType: 'Images',
                }
            },
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
