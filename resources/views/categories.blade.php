@extends('layouts.main')

@section('title')
Список категорий новостей @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Список категорий новостей</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <ul style="list-style: none;">
            @forelse($categories as $category)
            <li>
                <h2>
                    <a href="{{ route('news.index', ['category' => $category]) }}">{{ $category->title }}</a>
                </h2>
            </li>

            @empty
            <li>
                <h2>Записей нет</h2>
            </li>

            @endforelse
        </ul>
    </div>
    {{ $categories->links() }}
</div>
@endsection
