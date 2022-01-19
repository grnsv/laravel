@extends('layouts.admin')

@section('title')
Панель управления @parent
@stop

@section('header')
<h1 class="h2">Панель управления</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
<div class="table-responsive">
    Панель управления
    @php
    $msg = "Это сообщение создано динамически";
    @endphp
    <x-alert type="success" message="Сообщение"></x-alert>
    <x-alert type="danger" message="Сообщение"></x-alert>
    <x-alert type="warning" :message="$msg"></x-alert>
</div>
@endsection

@push('js')
<script>
    console.log('Hello world');
</script>
@endpush
