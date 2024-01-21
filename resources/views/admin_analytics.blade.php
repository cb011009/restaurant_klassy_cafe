@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@section('content')
<br>
<br>
<br>

<div class="container mt-5">
    
    <div class="container">
        <h1>Customer Analytics </h1>
        <form action="{{ route('admin_analytics') }}" method="get">
            <div class="form-group">
                <label for="category">Filter by Ordered Products by Category:</label>
                <select name="category" id="category" class="form-control">
                    <option value="" {{ $selectedCategory ? '' : 'selected' }}>All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Filter</button>

        </form>
        <h4>Ordered Products</h4>
        <br>
        <!-- Most Ordered Products Table -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Product Code</th>
                    <th>Name</th>
                    
                    <th>Order Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mostOrderedProducts as $product)
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->order_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h4>Ordered Products Chart</h4>
                    <br>
                    <canvas id="mostOrderedProductsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <script>
            // Get the most ordered products data
            var mostOrderedProductsData = @json($mostOrderedProducts);
        
            // Prepare labels and data for the chart
            var productLabels = mostOrderedProductsData.map(function(product) {
                return product.product_name;
            });
        
            var orderCounts = mostOrderedProductsData.map(function(product) {
                return product.order_count;
            });
        
            // Create the line chart
            var ctx = document.getElementById('mostOrderedProductsChart').getContext('2d');
            var mostOrderedProductsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: productLabels,
                    datasets: [{
                        label: 'Order Count',
                        data: orderCounts,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        
        

        <br>

        
        <h4>Most Reserved Time Slots</h4>
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

    <br>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <h4>Most Reserved Time Slots Chart</h4>
        <canvas id="mostReservedTimeSlotsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    
    <script>
        // Get the most reserved time slots data
        var mostReservedTimeSlotsData = @json($mostReservedTimeSlots);
    
        // Prepare labels and data for the chart
        var timeSlotLabels = mostReservedTimeSlotsData.map(function(timeSlot) {
            return timeSlot.time_slot;
        });
    
        var reservationCounts = mostReservedTimeSlotsData.map(function(timeSlot) {
            return timeSlot.reservation_count;
        });
    
        // Create the bar chart
        var ctx = document.getElementById('mostReservedTimeSlotsChart').getContext('2d');
        var mostReservedTimeSlotsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: timeSlotLabels,
                datasets: [{
                    label: 'Reservation Count',
                    data: reservationCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
    

   
    
</div>


@endsection
