@extends('layouts.main')

@section('title')
Заказ принят @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Заказ принят</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <p>Спасибо за заказ</p>
</div>
@endsection
