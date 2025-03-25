@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" 
                            {{ $role->name == $user->getRoleNames()->first() ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Permissions</label>
            <div id="permissions" class="permissions">
                <!-- Permissions will be loaded here dynamically -->
                @foreach($user->roles as $role)
                    @foreach($role->permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                   class="form-check-input" 
                                   {{ in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    // This will fire whenever the role is changed
    document.getElementById('role').addEventListener('change', function() {
        let roleName = this.value;
        
        // Make an AJAX request to fetch permissions for the selected role
        fetch(`/users/permissions/${roleName}`)
            .then(response => response.json())
            .then(data => {
                let permissionsContainer = document.getElementById('permissions');
                permissionsContainer.innerHTML = '';  // Clear previous permissions
                
                // Dynamically generate permission checkboxes
                data.forEach(permission => {
                    let permissionElement = document.createElement('div');
                    permissionElement.classList.add('form-check');

                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'permissions[]';
                    checkbox.value = permission.name;
                    checkbox.classList.add('form-check-input');
                    
                    let label = document.createElement('label');
                    label.classList.add('form-check-label');
                    label.textContent = permission.name;

                    permissionElement.appendChild(checkbox);
                    permissionElement.appendChild(label);
                    permissionsContainer.appendChild(permissionElement);
                });
            });
    });
</script>
@endsection
