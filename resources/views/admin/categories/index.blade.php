@extends('layouts.admin')

@section('meta_tags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Список категорий - @parent
@stop

@section('header')
<h1 class="h2">Список категорий</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-outline-secondary">
            Добавить категорию
        </a>
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
                <th>Название</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['category' => $category]) }}">Ред.</a>
                    &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ $category->id }}">Уд.</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление категории с #ID ${id}?`)) {
                    send(`/admin/categories/${id}`).then(() => {
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
