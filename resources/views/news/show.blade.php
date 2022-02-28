@extends('layouts.main')

@section('title')
{{ $news->title }} @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">{{ $news->title }}</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <h2>{{ $news->title }}</h2>
    <h4>Категории:
        @foreach ($news->categories as $category)
        <a class="btn btn-primary" href="{{ route('news.index', ['category' => $category]) }}">
            {{ $category->title }}
        </a>
        @endforeach
    </h4>
    <p>Автор: {{ $news->author }} &nbsp; Дата добавления: {{ $news->created_at }}</p>
    <p>{!! $news->description !!}</p>
    @if ($news->source)
    <div class="card shadow-sm mt-5">
        @if($news->source->image)
        <a href="{{ $news->source->link }}">
            <img src="{{ $news->source->image }}" alt="image">
        </a>
        @endif
        <div class="card-body">
            <h6><a href="{{ $news->source->link }}">{{ $news->source->title }}</a></h6>
            <p class="card-text">{{ $news->source->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ $news->link }}" class="btn btn-sm btn-outline-secondary">
                        Смотреть подробнее
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
