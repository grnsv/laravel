@extends('layouts.main')

@section('title')
Список новостей @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Список новостей</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        @forelse ($newsList as $news)
        <div class="col">
            <div class="card shadow-sm h-100">
                @if($news->isImage)
                <img src="{{ Storage::disk('public')->url($news->image) }}" alt="image">
                @elseif ($news->image)
                <img src="{{ $news->image }}" alt="image">
                @else
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                        dy=".3em">Thumbnail</text>
                </svg>
                @endif
                <div class="card-body">
                    <h6>
                        <a href="{{ route('news.show', ['news' => $news]) }}">
                            <strong>{{ $news->title }}</strong>
                        </a>
                    </h6>
                    <p><strong>Автор:</strong> {{ $news->author }}</p>
                    <p class="card-text">{!! preg_replace("/<img[^>]+\>/i", "", $news->description) !!}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('news.show', ['news' => $news]) }}"
                                class="btn btn-sm btn-outline-secondary">
                                Смотреть подробнее
                            </a>
                        </div>
                        <small class="text-muted">Дата добавления:<br>{{ $news->created_at }}</small>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <h2>Записей нет</h2>

        @endforelse

    </div>
    {{ $newsList->links() }}
</div>
@endsection
