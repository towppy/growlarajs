@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-success">📦 Product Management</h2>

    <div class="mb-3 text-start">
        <a href="{{ route('shop.admin') }}" class="btn btn-outline-secondary">
            🔙 Back to Admin Dashboard
        </a>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">➕ Add New Product</a>

    <div class="table-responsive">
        <table id="products-table" class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Image</th> 
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->images->count())
                            <img src="{{ asset('uploads/products/' . $product->images->first()->filename) }}"
                                 alt="Product Image"
                                 style="width: 80px; height: auto;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<!-- jQuery and DataTables CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#products-table').DataTable({
        responsive: true,
        pageLength: 10, // default
        lengthMenu: [ [10, 20, 50, -1], [10, 20, 50, "All"] ],
        columnDefs: [
            { orderable: false, targets: [0, 4] } // disable sorting for image and actions
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "🔍 Search products..."
        }
    });
});
</script>
@endpush
