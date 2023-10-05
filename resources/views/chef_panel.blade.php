<!-- chef.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chef's Dashboard</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Table Number</th>
                <th>Reservation ID</th>
                <th>Quantity</th>
                <th>Allergies</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->product_code }}</td>
                <td>{{ $order->reservation->table_id }}</td>
                <td>{{ $order->reservation_id }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->allergies }}</td>
                <td>{{ $order->order_status }}</td>
                <td>
                    <form action="{{ route('chef_mark_order_done', $order->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Done</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
