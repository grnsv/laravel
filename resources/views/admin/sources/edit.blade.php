@extends('layouts.admin')

@section('title')
Редактировать источник - @parent
@stop

@section('header')
<h1 class="h2">Редактировать источник</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.sources.update', ['source' => $source]) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="url">Адрес</label>
        <input type="url" name="url" id="url" class="form-control" value="{{ $source->url }}" required>
    </div>
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $source->title }}">
    </div>
    <div class="form-group">
        <label for="link">Ссылка</label>
        <input type="url" name="link" id="link" class="form-control" value="{{ $source->link }}">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{!! $source->description !!}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Изображение</label>
        <input type="url" name="image" id="image" class="form-control" value="{{ $source->image }}">
    </div>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection
