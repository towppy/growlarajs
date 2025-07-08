@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-warning">✏️ Edit Product</h2>

    <div class="mb-3 text-start">
        <a href="{{ route('prod.management') }}" class="btn btn-outline-secondary">
            🔙 Back to Product Management
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following issues:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">📝 Product Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">💰 Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">📦 Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">🖼 Upload More Images (optional):</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
        </div>

        @if ($product->images->count())
            <div class="mb-3">
                <label class="form-label">📸 Current Images:</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($product->images as $image)
                        <div class="border rounded p-1 shadow-sm" style="width: 120px;">
                            <img src="{{ asset('uploads/products/' . $image->filename) }}" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div id="image-preview" class="d-flex flex-wrap gap-3 mb-3"></div>

        <button type="submit" class="btn btn-warning w-100">💾 Update Product</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#images').on('change', function () {
        $('#image-preview').html('');
        const files = this.files;

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-preview').append(`
                        <div class="border rounded p-1 shadow-sm" style="width: 120px;">
                            <img src="${e.target.result}" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    $('form').on('submit', function () {
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Updating...');
    });
});
</script>
@endpush
