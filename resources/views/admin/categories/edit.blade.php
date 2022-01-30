@extends('layouts.admin')

@section('title')
Редактировать категорию @parent
@stop

@section('header')
<h1 class="h2">Редактировать категорию</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.categories.update', ['category' => $category]) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $category->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" id="description" class="form-control">{!! $category->description !!}</textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection
