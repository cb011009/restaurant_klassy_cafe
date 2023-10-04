@extends('layouts.app') <!-- Use your layout as needed -->
<br>
<br>
<br>
@section('content')
<div class="container mt-5">
    <h1>Waiter Dashboard</h1>
    <form action="{{ route('waiter_filter') }}" method="post" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="time_slot">Select Time Slot:</label>
            <select name="time_slot" id="time_slot" class="form-control">
                <option value="Lunch - 12:00 PM">Lunch - 12:00 PM</option>
                <option value="Lunch - 12:30 PM">Lunch - 12:30 PM</option>
                <option value="Lunch - 1:00 PM">Lunch - 1:00 PM</option>
                <option value="Lunch - 1:30 PM">Lunch - 1:30 PM</option>
                <option value="Lunch - 1:00 PM">Lunch - 2:00 PM</option>
                <option value="Lunch - 2:00 PM">Lunch - 2:30 PM</option>
                <option value="Dinner - 7:00 PM">Dinner - 7:00 PM</option>
                <option value="Dinner - 7:30 PM">Dinner - 7:30 PM</option>
                <option value="Dinner - 8:00 PM">Dinner - 8:00 PM</option>
                <option value="Dinner - 8:30 PM">Dinner - 8:30 PM</option>
                <option value="Dinner - 9:00 PM">Dinner - 9:00 PM</option>
                <option value="Dinner - 9:30 PM">Dinner - 9:30 PM</option>
                <option value="Dinner - 10:00 PM">Dinner - 10:00 PM</option>
                <!-- Add more time slots as needed -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter Reservations</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Number of Guests</th>
                <th>Occasion</th>
                <th>Additional Info</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->number_of_guests }}</td>
                    <td>{{ $reservation->occasion }}</td>
                    <td>{{ $reservation->additional_info }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
