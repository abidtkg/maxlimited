@extends('layouts.admin.master')
@section('page-title', 'Add Purchase - Max Limited')
@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h2>Purchase Products</h2>
    </div>
    <div class="card-body">
        <form id="purchaseForm" method="POST" action="{{ route('admin.purchase.store') }}">
            @csrf
    
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="product" class="form-label">Select Product</label>
                    <select id="product" class="form-select select-product">
                        <option value="" disabled selected>Choose a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-name="{{ $product->name }} ({{ $product->zone->name }})">{{ $product->name }} ({{ $product->zone->name }}) </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" class="form-control" min="1" placeholder="Enter quantity">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="addItem" class="btn btn-primary">Add</button>
                </div>
            </div>
    
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Selected Products</h4>
                </div>
                <div class="card-body">
                    <ul id="selectedItems" class="list-group">
                        <!-- Dynamically added items will appear here -->
                    </ul>
                </div>
            </div>
    
            <button type="submit" class="btn btn-info mt-4">ADD PURCHASE</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addItemButton = document.getElementById('addItem');
        const productSelect = document.getElementById('product');
        const quantityInput = document.getElementById('quantity');
        const selectedItemsList = document.getElementById('selectedItems');
        const purchaseForm = document.getElementById('purchaseForm');

        addItemButton.addEventListener('click', () => {
            const productId = productSelect.value;
            const productName = productSelect.options[productSelect.selectedIndex]?.dataset.name;
            const quantity = quantityInput.value;

            if (!productId || !quantity) {
                alert('Please select a product and enter a quantity.');
                return;
            }

            // Create a list item for the selected product
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.dataset.productId = productId;

            listItem.innerHTML = `
                ${productName} [Qty: ${quantity}]
                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                <input type="hidden" name="products[]" value="${productId}-${quantity}">
            `;

            // Add remove functionality
            listItem.querySelector('.remove-item').addEventListener('click', () => {
                listItem.remove();
            });

            // Add the list item to the selected items list
            selectedItemsList.appendChild(listItem);

            // Reset inputs
            productSelect.value = '';
            quantityInput.value = '';
        });

        // Handle form submission (optional - to validate the list is not empty)
        purchaseForm.addEventListener('submit', (e) => {
            if (selectedItemsList.children.length === 0) {
                e.preventDefault();
                alert('Please add at least one product to the list before submitting.');
            }
        });
    });
</script>
@endsection

@section('page-js')
    <script>
        $(document).ready(function() {
            $('.select-product').select2();
        });
    </script>
@endsection