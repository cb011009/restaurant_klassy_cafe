
@extends('layouts.app') <!-- Use your layout as needed -->
<br>
<br>
<br>
<br>

@section('content')
<div class="container">
    <h1>User Management</h1>
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












