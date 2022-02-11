@extends('layouts.admin')

@section('title')
Добавить пользователя - @parent
@stop

@section('header')
<h1 class="h2">Добавить пользователя</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<form action="{{ route('admin.users.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
        <label for="pwd">Пароль</label>
        <input type="password" name="password" id="pwd" class="form-control" value="{{ old('password') }}" required>
    </div>
    <fieldset>
        <legend class="col-form-label">Админ?</legend>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_admin" id="is-admin" value="1">
            <label class="form-check-label" for="is-admin">Да</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_admin" id="is-not-admin" value="0" checked>
            <label class="form-check-label" for="is-not-admin">Нет</label>
        </div>
    </fieldset>
    <br>
    <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
</form>
@endsection
