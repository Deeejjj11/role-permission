@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create User</h1>

    <form action="{{ route('users.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Permissions</label>
            <div class="mb-2">
                @foreach (Spatie\Permission\Models\Permission::all() as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input">
                        <label class="form-check-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Create User</button>
        
    </form>
</div>
@endsection
