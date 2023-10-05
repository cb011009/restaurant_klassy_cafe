@extends('layouts.app') <!-- Use your layout as needed -->

@section('content')

<br>
<br>
<br>
<div class="container mt-5">
    <h1>Waiter Dashboard</h1>
    <form action="{{ route('waiter_filter') }}" method="post" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
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
                <th>Table Number</th>
                <th>Name</th>
                <th>Number of Guests</th>
                <th>Occasion</th>
                <th>Additional Info</th>
                <th>Actions</th> <!-- Added column for "Done" button -->
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->table_id}}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->number_of_guests }}</td>
                    <td>{{ $reservation->occasion }}</td>
                    <td>{{ $reservation->additional_info }}</td>
                    <td>
                        
                        <div class="btn-group" role="group">
                            <form action="{{ route('mark_reservation_as_done', $reservation->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                            <form action="{{ route('edit_table', $reservation->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary ml-2">Edit</button>
                            </form>
                            <form action="{{ route('create_order', $reservation->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-warning ml-2">Order</button>
                            </form>
                        </div>
                        
                        </td>
                    </td>
                   
                </tr>
            @empty
                <tr>
                    <td colspan="5">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
