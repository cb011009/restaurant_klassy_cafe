@extends('layouts.app') <!-- Use your layout as needed -->

@section('content')
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('admin_update_user', $user->id) }}">
        @csrf
        @method('PUT') <!-- Use 'PUT' method to update user details -->

        <!-- Add form fields to edit user information here -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <!-- Add more form fields for email, user_role, etc. as needed -->

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
