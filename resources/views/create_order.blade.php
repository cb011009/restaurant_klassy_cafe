@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <h1>Create Order</h1>

    <form action="{{ route('store_order', ['id' => $reservation->id]) }}"method="post">
        @csrf
        <div class="form-group">
            <label for="waiter_id">Waiter ID:</label>
            <input type="number" name="waiter_id" id="waiter_id" class="form-control" required>
        </div>

        

        <div class="form-group">
            <label for="product_code">Product Code:</label>
            <select name="product_code" id="product_code" class="form-control" required>
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <option value="product3">Product 3</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="allergies">Allergies (optional):</label>
            <textarea name="allergies" id="allergies" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
