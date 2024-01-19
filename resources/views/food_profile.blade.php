@extends('layouts.app')

@section('content')

<br>
<br>
<br>
<div class="container mt-5">
    <!--So maybe to check if tables are free by date i have the status_booked and the time slot and date"-->
    <h1>Food Profile of Customer: {{ $reservation->user->name }}</h1>

    <h2>Most Frequent Reservation Details:</h2>
    <ul>
        <li>Most Frequent Reservation Day: {{ $mostFrequentDay ?? 'Not available' }}</li>
        <li>Most Frequent Reservation Time Slot: {{ $mostFrequentTimeSlot ?? 'Not available' }}</li>
    </ul>

    <h2>Frequent Reservation Details:</h2>
    @foreach ($allDaysOfWeek as $day)
        <div class="mb-3">
            <h3>{{ $day }}</h3>
            <ul>
                @foreach ($reservationsGroupedByDay[$day] ?? [] as $timeSlot => $reservations)
                    <li>{{ $timeSlot }}: {{ count($reservations) }} times</li>
                @endforeach
                <li>Total Reservations: {{ $totalReservationsPerDay[$day] ?? 0 }}</li>
            </ul>
        </div>
    @endforeach

    <h2>Most Ordered Dishes:</h2>
    <ul>
        @foreach ($mostOrderedDishes as $productCode => $orders)
            @php
                $productDetail = $productDetails[$productCode] ?? null;
            @endphp
            <li>
                {{ $productDetail['name'] ?? 'Unknown Product' }}:
                {{ count($orders) }} times
                @if ($productDetail && $productDetail['allergies'])
                    <ul>
                        @foreach ($productDetail['allergies'] as $allergy)
                            <li>{{ $allergy }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        <li>Most Ordered Dish: {{ $mostOrderedDish ?? 'Not available' }}</li>
    </ul>


   

    

    
</div>
@endsection
