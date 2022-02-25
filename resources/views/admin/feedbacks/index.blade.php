@extends('layouts.admin')

@section('meta_tags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Список отзывов - @parent
@stop

@section('header')
<h1 class="h2">Список отзывов</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
</div>
@endsection

@section('content')
@include('inc.message')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Автор</th>
                <th>Отзыв</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->id }}</td>
                <td>{{ $feedback->author }}</td>
                <td>{{ $feedback->feedback }}</td>
                <td>{{ $feedback->created_at }}</td>
                <td>
                    <a href="javascript:;" class="delete" rel="{{ $feedback->id }}">Уд.</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $feedbacks->links() }}
</div>
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление отзыва с #ID ${id}?`)) {
                    send(`/admin/feedbacks/${id}`).then(() => {
                        location.reload();
                    });
                }
            });
        });
    });

    async function send(url) {
        let response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        let result = await response.json();
        return result.ok;
    }
</script>
@endpush
