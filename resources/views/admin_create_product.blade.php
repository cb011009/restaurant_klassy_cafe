@extends('layouts.app') <!-- You can adjust the layout as needed -->

@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <h2>Manage Products and Categories</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add Product Form -->
    <div class="card mb-4">
        <div class="card-header">Add Product</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin_add_product') }}">
                @csrf
                <div class="form-group">
                    <label for="product_code">Product Code:</label>
                    <input type="text" class="form-control" id="product_code" name="product_code" required>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Add Category</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin_create_category') }}">
                @csrf
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>

    <!-- List of Categories -->
<div class="card">
    <div class="card-header">Category List</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="{{ route('admin_delete_category', ['id' => $category->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    


    


   

    <!-- Product List and Filter -->
    <div class="card">
        <div class="card-header">Product List</div>
        <div class="card-body">
            <!-- Category Filter -->
            <form method="POST" action="{{ route('admin_filter') }}" class="mb-3">
                @csrf
                <div class="form-group">
                    <label for="category_filter">Filter by Category:</label>
                    <select class="form-control" id="category_filter" name="category_id">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>

            <!-- Product Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                            
                            <td>
                                <a href="{{ route('delete_product', ['id' => $product->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
