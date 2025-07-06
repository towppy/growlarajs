@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">🛒 Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info">Your cart is empty.</div>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-success mt-3">Continue Shopping</a>
    @else
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $productId => $qty)
                    @php
                        $product = \App\Models\Product::find($productId);
                    @endphp
                    <tr>
                        <td>{{ $product->name ?? 'Unknown' }}</td>
                        <td>
                            <form action="{{ route('cart.update', ['id' => $productId]) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                <button type="button" class="btn btn-sm btn-outline-secondary change-qty-btn" data-delta="-1">−</button>
                                <input type="number" name="quantity" value="{{ $qty }}" min="1" class="form-control form-control-sm text-center quantity-input" style="width: 60px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary change-qty-btn" data-delta="1">+</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', ['id' => $productId]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <a href="#" class="btn btn-success">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.change-qty-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent form submission
                const delta = parseInt(btn.getAttribute('data-delta'));
                const input = btn.closest('form').querySelector('.quantity-input');
                let value = parseInt(input.value) || 1;
                value += delta;
                if (value < 1) value = 1;
                input.value = value;
            });
        });
    });
</script>
@endpush