@extends('layouts.app')
<br>
<br>
<br>

@section('content')
<div class="container mt-5">
    <h1>Edit Reservation</h1>
    <form action="{{ route('update_table', $reservation->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="table_id">Select Table:</label>
            <select name="table_id" id="table_id" class="form-control">
                @foreach($tables as $table)
                    <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Table</button>
    </form>
</div>
@endsection
