@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary">👥 User Management</h2>

    <div class="mb-3 text-start">
        <a href="{{ route('shop.admin') }}" class="btn btn-outline-secondary">
            🔙 Back to Admin Dashboard
        </a>
    </div>

    <table class="table table-bordered table-hover" id="userTable">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <select name="is_admin" class="form-select">
                            <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>User</option>
                            <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                        </select>
                    </td>
                    <td>
                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->is_active ? 'Active' : 'Disabled' }}
                        </span>
                    </td>
                    <td class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">💾 Save</button>
                </form>

                        <!-- Enable/Disable form -->
                        <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                {{ $user->is_active ? 'Disable' : 'Enable' }}
                            </button>
                        </form>
                        
                    </td>
            </tr>
            @endforeach
               @if (session('success'))
   <div class="alert alert-success">
        {{ session('success') }}
</div>
   @endif
        </tbody>
    </table>
</div>

@endsection
