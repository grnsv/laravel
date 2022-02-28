@extends('layouts.main')

@section('title')
Список категорий новостей - @parent
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
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">

        @forelse ($categories as $category)
        <div class="col">
            <div class="card shadow-sm h-100">
                <a href="{{ route('news.index', ['category' => $category]) }}" class="link-dark text-decoration-none">
                    <div class="card-body">
                        <h3>{{ $category->title }}</h3>
                    </div>
                </a>
            </div>
        </div>

        @empty
        <h2>Записей нет</h2>

        @endforelse

    </div>
    {{ $categories->links() }}
</div>
@endsection
