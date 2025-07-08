@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary mb-4">← Back to Shop</a>

    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            @if ($product->images->count())
                <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/products/' . $image->filename) }}" class="d-block w-100 img-fluid rounded" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    @if ($product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            @else
                <img src="https://via.placeholder.com/450x300?text=No+Image" class="img-fluid mb-3 rounded" alt="No Image">
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted fs-5">₱{{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-lg btn-success w-100">🛒 Add to Cart</button>
            </form>
        </div>
    </div>


    <!-- Reviews Section -->
<div class="mt-5">
    <h4 class="border-bottom pb-3">🗣 Customer Reviews</h4>

    <!-- Review Form at the Top -->
    @auth
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Leave a Review</h5>
            <form>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select id="rating" class="form-select" disabled>
                        <option value="">⭐ Select a rating</option>
                        <option>⭐</option>
                        <option>⭐⭐</option>
                        <option>⭐⭐⭐</option>
                        <option>⭐⭐⭐⭐</option>
                        <option>⭐⭐⭐⭐⭐</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="review" class="form-label">Your Review</label>
                    <textarea class="form-control" id="review" rows="3" placeholder="Write your review here..." disabled></textarea>
                </div>

                <button type="submit" class="btn btn-secondary" disabled>Submit (coming soon)</button>
                <small class="text-muted d-block mt-2">Review functionality is coming soon.</small>
            </form>
        </div>
    </div>
    @else
        <div class="alert alert-info mb-4">
            <a href="{{ route('login') }}">Login</a> to leave a review.
        </div>
    @endauth

    <!-- Dummy Existing Reviews -->
    <div class="mb-3">
        <strong>🌟 Cristel M.</strong>
        <p class="mb-1">"Amazing product! Arrived fast and works perfectly in my garden."</p>
        <small class="text-muted">Posted on July 3, 2025</small>
    </div>

    <div class="mb-3">
        <strong>🌟 Aia A.</strong>
        <p class="mb-1">"Good value for money. Would recommend to fellow plant lovers."</p>
        <small class="text-muted">Posted on June 28, 2025</small>
    </div>
</div>

@endsection