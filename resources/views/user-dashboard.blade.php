@extends('layouts.app')

@section('content')
<header class="bg-dark py-5 mb-4">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">GROWCERY</h1>
            <p class="lead fw-normal text-white-50 mb-0">Start your gardening journey with us!</p>
        </div>
    </div>
</header>

<div class="container px-4 px-lg-5 mt-4">
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center">
        @forelse ($products as $product)
            <div class="col mb-5">
                <div class="card h-100 shadow-sm">
                    <!-- Sale badge (optional logic) -->
                    @if($product->price < 100)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    @endif

                    <!-- Product image -->
                    <img class="card-img-top"
                         src="{{ $product->image_url ? asset($product->image_url) : 'https://via.placeholder.com/450x300?text=Product+Image' }}"
                         alt="{{ $product->name }}"
                         style="object-fit: cover; height: 225px;">

                    <!-- Product details -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $product->name }}</h5>
                            ₱{{ number_format($product->price, 2) }}
                        </div>
                    </div>

                    <!-- Add to cart -->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-dark mt-auto w-100" type="submit">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products available.</p>
        @endforelse
    </div>
</div>
@endsection
@push('scripts')
<script>
    @auth
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Optional: prevent default form submit
            // e.preventDefault();
            alert('🛒 Product added to cart!');
        });
    });
    @endauth
</script>
@endpush
