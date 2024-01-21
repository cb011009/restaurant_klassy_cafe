@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="container">
        <h1>Most Ordered Products</h1>
        <br>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Order Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostOrderedProducts as $product)
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_category_id }}</td>
                        <td>{{ $product->order_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <h1>Most Reserved Time Slots</h1>
        <br>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Time Slot</th>
                    <th>Reservation Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mostReservedTimeSlots as $timeSlot)
                    <tr>
                        <td>{{ $timeSlot->time_slot }}</td>
                        <td>{{ $timeSlot->reservation_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

   
    
</div>
@endsection
