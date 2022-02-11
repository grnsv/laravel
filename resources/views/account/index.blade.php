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
    <form action="{{ route('order') }}" method="post">
        @csrf
        <fieldset class="form-group border p-2">
            <legend>Форма заказа на получение выгрузки данных из какого-либо источника</legend>
            <div class="form-group">
                <label for="customer">Имя заказчика</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ old('customer') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="tel">Номер телефона</label>
                <input type="tel" name="tel" id="tel" class="form-control" value="{{ old('tel') }}">
            </div>
            <div class="form-group">
                <label for="email">Email-адрес</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="info">Информация о том, что нужно получить</label>
                <textarea name="info" id="info" class="form-control">{!! old('info') !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Отправить</button>
        </fieldset>
    </form>
    <br>
    <form action="{{ route('feedback') }}" method="post">
        @csrf
        <fieldset class="form-group border p-2">
            <legend>Форма обратной связи</legend>
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="feedback">Комментарий / отзыв по работе проекта</label>
                <textarea name="feedback" id="feedback" class="form-control">{!! old('feedback') !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Отправить</button>
        </fieldset>
    </form>
</div>
@endsection
