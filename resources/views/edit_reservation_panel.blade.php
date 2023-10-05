@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container mt-5">
    <h1>Reservation History</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Number of Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userReservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time_slot }}</td>
                    <td>{{ $reservation->number_of_guests }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        @if ($reservation->status === 'pending')
                            <a href="{{ route('edit_reservation', $reservation->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('cancel_reservation', $reservation->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
