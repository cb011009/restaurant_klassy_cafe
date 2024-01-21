
@extends('layouts.app') <!-- Use your layout as needed -->
<br>
<br>
<br>
<br>

@section('content')
<div class="container">
    <h1>User Management</h1>
    <a href="{{ route('admin_analytics') }}" class="btn btn-primary mb-3">Customer Analytics</a>
    <a href="{{ route('admin_create_product') }}" class="btn btn-primary mb-3">Products & Categories</a>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Users here</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin_add_user') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <select class="form-control" id="user_role" name="user_role" required>
                                    <option value="chef">Chef</option>
                                    <option value="waiter">Waiter</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <!-- Add other input fields for the remaining user details -->
    
                    <button type="submit" class="btn btn-success">Add User</button>
                </form>
            </div>
        </div>
    </div>
    
    <br>
    <br>
    <div class="container mb-3">
        <form method="GET" action="{{ route('admin_panel') }}" class="form-inline">
            <label class="mr-2">Filter by Role:</label>
            <select class="form-control mr-2" name="role">
                <option value="" selected>All Roles</option>
                <option value="chef">Chef</option>
                <option value="waiter">Waiter</option>
                <option value="user">User</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    
        @if(isset($userCounts))
            <div class="mt-2">
                <strong>User Counts:</strong>
                @foreach($userCounts as $role => $count)
                    <span class="mr-2">{{ ucfirst($role) }}: {{ $count }}</span>
                @endforeach
            </div>
        @endif

        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_role }}</td>
                    <td>
                        <a href="{{ route('admin_edit_user', $user->id) }}" class="btn btn-primary">Edit</a>
                        <form method="POST" action="{{ route('admin_delete_user', $user->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Add forms and buttons for creating, updating, activating, and deactivating users -->
</div>
@endsection












