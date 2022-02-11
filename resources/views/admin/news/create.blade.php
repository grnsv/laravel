@extends('layouts.admin')

@section('title')
Добавить новость - @parent
@stop

@section('header')
<h1 class="h2">Добавить новость</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.news.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="categories">Выбрать категории</label>
        <select name="categories[]" id="categories" class="form-control" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if (collect(old('categories'))->contains($category->id)) selected
                @endif>{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>
    <div class="form-group">
        <label for="author">Автор</label>
        <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
    </div>
    <div class="form-group">
        <label for="status">Статус</label>
        <select name="status" id="status" class="form-control" required>
            <option value="draft" @if( old('status')==='draft' ) selected @endif>DRAFT</option>
            <option value="active" @if( old('status')==='active' ) selected @endif>ACTIVE</option>
            <option value="blocked" @if( old('status')==='blocked' ) selected @endif>BLOCKED</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{!! old('description') !!}</textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection
