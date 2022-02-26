@extends('layouts.main')

@section('title')
Главная - @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Привет, {{ Auth::user()->name }}</h1>
        @if (Auth::user()->avatar)
        <img src="{{ Auth::user()->avatar }}" alt="avatar" style="width: 250px">
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="container">
    @include('inc.message')
    <form action="{{ route('source') }}" method="post" class="mb-4">
        @csrf
        <fieldset class="form-group border p-2">
            <legend>Форма добавления источника новостей</legend>
            <div class="form-group">
                <label for="source">Источник в формате RSS</label>
                <input type="text" name="source" id="source" class="form-control"
                    placeholder="https://news.yandex.ru/computers.rss" value="{!! old('source') !!}" required>
            </div>
            <button type="submit" class="btn btn-success mt-2" style="float: right;">Отправить</button>
        </fieldset>
    </form>
    <form action="{{ route('feedbacks.create') }}" method="post">
        @csrf
        <fieldset class="form-group border p-2">
            <legend>Форма обратной связи</legend>
            <div class="form-group">
                <label for="author">Имя пользователя</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ Auth::user()->name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="feedback">Комментарий / отзыв по работе проекта</label>
                <textarea name="feedback" id="feedback" class="form-control"
                    placeholder="Прошу выдать мне права администратора">{!! old('feedback') !!}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2" style="float: right;">Отправить</button>
        </fieldset>
    </form>
</div>
@endsection
