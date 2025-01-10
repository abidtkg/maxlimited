@extends('layouts.admin.master')
@section('page-title', 'Create Order - Max Limited')
@section('dashboard-content')

<div class="card">
    <div class="card-header">
        <h5>Create Order</h5>
    </div>
    <div class="card-body">
        <form id="orderForm" method="POST" action="{{ route('admin.order.store') }}">
            @csrf
            <!-- User Selection -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="user" class="form-label">Select User</label>
                    <select id="user" name="user_id" class="form-select select-user" required>
                        <option value="" disabled selected>Choose a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Discount</label>
                    <input type="number" name="discount" id="inputDiscount" value="0" class="form-select">
                </div>
            </div>

            <!-- Product Selection -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="product" class="form-label">Select Product</label>
                    <select id="product" class="form-select select-product">
                        <option value="" disabled selected>Choose a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                {{ $product->name }} ({{ $product->zone->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" class="form-control" min="1" placeholder="Enter quantity">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="addProduct" class="btn btn-primary">Add</button>
                </div>
            </div>

            <!-- Selected Products -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Selected Products</h4>
                </div>
                <div class="card-body">
                    <ul id="selectedProducts" class="list-group">
                        <!-- Dynamically added products will appear here -->
                    </ul>
                </div>
            </div>

            <!-- Summary -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <p>Total Product Price: <span id="totalProductPrice">0</span></p>
                    <p>Delivery Fee: <span id="deliveryFee">50</span></p>
                    <p>Discount: <span id="discountValue">0</span></p>
                    <p>Payable Amount: <span id="payableAmount">0</span></p>
                </div>
            </div>

            <!-- Inputs -->
            <input type="hidden" name="total_product_price" id="inputTotalProductPrice" value="0">
            <input type="hidden" name="delivery_fee" id="inputDeliveryFee" value="50">
            <input type="hidden" name="payable" id="inputPayable" value="0">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success mt-4">Submit Order</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addProductButton = document.getElementById('addProduct');
        const productSelect = document.getElementById('product');
        const quantityInput = document.getElementById('quantity');
        const selectedProductsList = document.getElementById('selectedProducts');
        const totalProductPriceElem = document.getElementById('totalProductPrice');
        const deliveryFeeElem = document.getElementById('deliveryFee');
        const payableAmountElem = document.getElementById('payableAmount');

        const inputTotalProductPrice = document.getElementById('inputTotalProductPrice');
        const inputDeliveryFee = document.getElementById('inputDeliveryFee');
        const inputPayable = document.getElementById('inputPayable');

        let totalProductPrice = 0;

        const updateSummary = () => {
            // Update delivery fee based on total product price
            const deliveryFee = totalProductPrice < 2000 ? 50 : 0;
            const discount = parseFloat(document.getElementById('inputDiscount').value || 0);
            discountValue.textContent = discount.toFixed(2);

            const payable = totalProductPrice + deliveryFee - discount;

            // Update the summary values
            totalProductPriceElem.textContent = totalProductPrice.toFixed(2);
            deliveryFeeElem.textContent = deliveryFee.toFixed(2);
            payableAmountElem.textContent = payable.toFixed(2);

            // Update hidden input values
            inputTotalProductPrice.value = totalProductPrice.toFixed(2);
            inputDeliveryFee.value = deliveryFee.toFixed(2);
            inputPayable.value = payable.toFixed(2);
        };

        // add update summery for discount and run update summery
        document.getElementById('inputDiscount').addEventListener('input', updateSummary);
        

        addProductButton.addEventListener('click', () => {
            const productId = productSelect.value;
            const productName = productSelect.options[productSelect.selectedIndex]?.dataset.name;
            const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex]?.dataset.price || 0);
            const quantity = parseInt(quantityInput.value, 10);

            if (!productId || !quantity || quantity <= 0) {
                alert('Please select a product and enter a valid quantity.');
                return;
            }

            const totalPrice = quantity * productPrice;

            // Create a list item for the selected product
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.dataset.productId = productId;

            listItem.innerHTML = `
                ${productName} [Qty: ${quantity}, Total: ${totalPrice.toFixed(2)}]
                <button type="button" class="btn btn-danger btn-sm remove-product">Remove</button>
                <input type="hidden" name="products[]" value="${productId}-${quantity}">
            `;

            // Add remove functionality
            listItem.querySelector('.remove-product').addEventListener('click', () => {
                totalProductPrice -= totalPrice;
                listItem.remove();
                updateSummary();
            });

            // Add the list item to the selected products list
            selectedProductsList.appendChild(listItem);

            // Update the total product price
            totalProductPrice += totalPrice;

            // Reset inputs
            productSelect.value = '';
            quantityInput.value = '';

            // Update summary
            updateSummary();
        });

        updateSummary(); // Initialize the summary
    });
</script>

@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            $('.select-product').select2();
            $('.select-user').select2();
        });
    </script>
@endsection