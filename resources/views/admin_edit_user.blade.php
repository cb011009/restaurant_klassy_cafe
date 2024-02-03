@extends('layouts.app') 

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
        @method('PUT') 

        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="user_role">Role</label>
            <select class="form-control" id="user_role" name="user_role">
                <option value="chef" {{ $user->user_role == 'chef' ? 'selected' : '' }}>Chef</option>
                <option value="waiter" {{ $user->user_role == 'waiter' ? 'selected' : '' }}>Waiter</option>
               
            </select>
        </div>

        

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
