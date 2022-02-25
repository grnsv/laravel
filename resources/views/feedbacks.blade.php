@extends('layouts.main')

@section('title')
Отзыв принят - @parent
@stop

@section('header')
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Отзывы</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    @include('inc.message')

        @forelse ($feedbacks as $feedback)
        <div class="card mb-3">
            <div class="card-header">
                {{ $feedback->author }}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{ $feedback->feedback }}</p>
                    <footer class="blockquote-footer">{{ $feedback->created_at }}</footer>
                </blockquote>
            </div>
        </div>

        @empty
        <h2>Отзывов нет</h2>

        @endforelse

    {{ $feedbacks->links() }}
</div>
@endsection
