@extends('layouts.admin')

@section('meta_tags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Список источников - @parent
@stop

@section('header')
<h1 class="h2">Список источников</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{ route('admin.sources.create') }}" class="btn btn-sm btn-outline-secondary">
            Добавить источник
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
                <th>Адрес</th>
                <th>Название</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sources as $source)
            <tr>
                <td>{{ $source->id }}</td>
                <td>{{ $source->url }}</td>
                <td>{{ $source->title }}</td>
                <td>{{ $source->created_at }}</td>
                <td>
                    <a href="{{ route('admin.sources.edit', ['source' => $source]) }}">Ред.</a>
                    &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ $source->id }}">Уд.</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sources->links() }}
</div>
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление источника с #ID ${id}?`)) {
                    send(`/admin/sources/${id}`).then(() => {
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
