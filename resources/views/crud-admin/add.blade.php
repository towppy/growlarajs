@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-success">➕ Add New Product</h2>

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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">📝 Product Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">💰 Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">📦 Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock') }}">
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">🖼 Upload Images (You can select multiple):</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
        </div>

        <div id="image-preview" class="d-flex flex-wrap gap-3 mb-3"></div>

        <button type="submit" class="btn btn-success w-100">✅ Save Product</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#images').on('change', function () {
        $('#image-preview').html(''); // Clear previous previews
        const files = this.files;

        if (files.length > 0) {
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
        }
    });

    // Disable submit button during upload
    $('form').on('submit', function () {
        const btn = $(this).find('button[type=submit]');
        btn.prop('disabled', true).text('Saving...');
    });
});
</script>
@endpush
