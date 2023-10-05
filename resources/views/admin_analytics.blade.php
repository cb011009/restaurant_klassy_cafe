@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <h1>Analytics</h1>

    <section>
        <h2>Most Ordered Products</h2>
        <ul>
            @foreach ($mostOrderedProducts as $product)
                <li>{{ $product->product_code }}</li>
            @endforeach
        </ul>
    </section>

    <section>
        <h2>Most Reserved Time Slots</h2>
        <ul>
            @foreach ($mostReservedTimeSlots as $timeSlot)
                <li>{{ $timeSlot->time_slot }}</li>
            @endforeach
        </ul>
    </section>
</div>
@endsection
