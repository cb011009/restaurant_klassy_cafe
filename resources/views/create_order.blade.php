@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <h1>Create Order</h1>

    <form action="{{ route('store_order', ['id' => $reservation->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="waiter_id">Waiter ID:</label>
            <input type="number" name="waiter_id" id="waiter_id" class="form-control" required>
        </div>
        <!-- Add a section for multiple items as a table -->
        <table class="table items-table">
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Quantity</th>
                    <th>Allergies (optional)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="item-template" style="display: none;">
                    <td>
                        <select name="product_codes[]" class="form-control" required>
                            <option value="product1">Product 1</option>
                            <option value="product2">Product 2</option>
                            <option value="product3">Product 3</option>
                            <!-- Add more options as needed -->
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantities[]" class="form-control" required>
                    </td>
                    <td>
                        <input type="text" name="allergies[]" class="form-control">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete-item">Delete Item</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Allow users to add more items dynamically -->
        <button type="button" class="btn btn-success add-item">Add Item</button>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addItemButton = document.querySelector(".add-item");
    const itemTemplate = document.querySelector(".item-template");

    addItemButton.addEventListener("click", function() {
        // Clone the item template
        const newItem = itemTemplate.cloneNode(true);

        // Remove the "style" attribute to make it visible
        newItem.removeAttribute("style");

        // Append the cloned item to the items table
        const itemsTable = document.querySelector(".items-table tbody");
        itemsTable.appendChild(newItem);
    });

    // Add event listener for delete buttons
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("delete-item")) {
            event.target.closest("tr").remove();
        }
    });
});
</script>
@endsection
