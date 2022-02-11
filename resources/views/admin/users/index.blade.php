@extends('layouts.admin')

@section('meta_tags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
Список пользователей - @parent
@stop

@section('header')
<h1 class="h2">Список пользователей</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-secondary">
            Добавить пользователя
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
                <th>Имя</th>
                <th>Email</th>
                <th>Админ?</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'Да' : 'Нет' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', ['user' => $user]) }}">Ред.</a>
                    &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ $user->id }}">Уд.</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление пользователя с #ID ${id}?`)) {
                    send(`/admin/users/${id}`).then(() => {
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
