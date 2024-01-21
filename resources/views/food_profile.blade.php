@extends('layouts.app')

@section('content')

<br>
<br>


<div class="container mt-5">
  

    <h1>Profile of Customer: {{ $reservation->user->name }}</h1>

    
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="list-inline">
                    <li class="list-inline-item border p-4  ">Most Frequent Reservation Day: {{ $mostFrequentDay ?? 'Not available' }}</li>
                    <li class="list-inline-item border p-4 ">Most Frequent Reservation Time Slot: {{ $mostFrequentTimeSlot ?? 'Not available' }}</li>
                    <li class="list-inline-item border p-4 ">
                        Most Ordered Dish:
                        @if ($mostOrderedDish)
                            {{ $productDetails[$mostOrderedDish]['name'] ?? 'Not available' }}
                        @else
                            Not available
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Dish Name</th>
                    <th>Times Ordered</th>
                    <th>Allergies</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostOrderedDishes as $productCode => $orders)
                    @php
                        $productDetail = $productDetails[$productCode] ?? null;
                    @endphp
                    <tr>
                        <td>{{ $productDetail['name'] ?? 'Unknown Product' }}</td>
                        <td>{{ count($orders) }}</td>
                        <td>
                            @if ($productDetail && $productDetail['allergies'])
                                <ul class="list-unstyled">
                                    @foreach ($productDetail['allergies'] as $allergy)
                                        <li>{{ $allergy }}</li>
                                    @endforeach
                                </ul>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr class="table-info">
                    <td>Most Ordered Dish:</td>
                    <td colspan="2">
                        @if ($mostOrderedDish)
                            {{ $productDetails[$mostOrderedDish]['name'] ?? 'Not available' }}
                        @else
                            Not available
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    
    <br>

    
       
           
            
       
            <div class="container">
                <div class="row">
                    @foreach ($allDaysOfWeek as $day)
                        <div class="col-md-4 mb-3">
                            <div class="border p-3">
                                <h4 class="mb-3">{{ $day }}</h4>
                                <hr>
                                <ul class="list-unstyled">
                                    @foreach ($reservationsGroupedByDay[$day] ?? [] as $timeSlot => $reservations)
                                        <li>{{ $timeSlot }}: {{ count($reservations) }} times</li>
                                    @endforeach
                                    <li class="total-reservations">Total Reservations: {{ $totalReservationsPerDay[$day] ?? 0 }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            
            
 
    
    


   

    

    
</div>
@endsection
