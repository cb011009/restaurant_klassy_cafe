@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <h1>Analytics</h1>
    <br>
    <br>
    <section>
        <h2>Most Ordered Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostOrderedProducts as $product)
                    <tr>
                        <td>{{ $product->product_code }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Most Reserved Time Slots</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Time Slot</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostReservedTimeSlots as $timeSlot)
                    <tr>
                        <td>{{ $timeSlot->time_slot }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
