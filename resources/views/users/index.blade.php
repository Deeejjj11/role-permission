@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>

    <!-- Table with Dark Header -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Permissions</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th> <!-- Row Number -->
                    <td>{{ $user->name }}</td> <!-- User Name -->
                    <td>{{ $user->email }}</td> <!-- User Email -->
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge ">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($user->permissions as $permission)
                            <span class="badge">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm">Show</a>

                        <!-- Delete Confirmation -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
