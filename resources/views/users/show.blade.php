@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details: {{ $user->name }}</h1>

    <div class="mb-3">
        <strong>Email:</strong> {{ $user->email }}
    </div>

    <div class="mb-3">
        <strong>Roles:</strong>
        @foreach ($user->roles as $role)
            <span class="badge ">{{ $role->name }}</span>
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Permissions:</strong>
        @foreach ($user->permissions as $permission)
            <span class="badge ">{{ $permission->name }}</span>
        @endforeach
    </div>

    <div class="mb-3">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users List</a>
    </div>
</div>
@endsection
