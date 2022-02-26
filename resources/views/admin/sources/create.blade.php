@extends('layouts.admin')

@section('title')
Добавить источник - @parent
@stop

@section('header')
<h1 class="h2">Добавить источник</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.sources.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="url">Адрес</label>
        <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}">
    </div>
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="link">Ссылка</label>
        <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{!! old('description') !!}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Изображение</label>
        <input type="url" name="image" id="image" class="form-control" value="{{ old('image') }}">
    </div>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection
