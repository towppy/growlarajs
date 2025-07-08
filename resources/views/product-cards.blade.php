@forelse ($products as $product)
    <div class="col mb-5">
        <div class="card h-100 shadow-sm">

            @if($product->price < 100)
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
            @endif

            <!-- Wrap image and name in a link to product detail -->
            <a href="{{ route('shop.show', $product->id) }}" class="text-decoration-none text-dark">
                <@php
    $imagePath = $product->images->count()
        ? asset('uploads/products/' . $product->images->first()->filename)
        : ($product->image_url ?? 'https://via.placeholder.com/450x300?text=Product+Image');
@endphp

<img class="card-img-top"
     src="{{ $imagePath }}"
     alt="{{ $product->name }}"
     style="object-fit: cover; height: 225px;">

                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                        ₱{{ number_format($product->price, 2) }}
                    </div>
                </div>
            </a>

            <!-- Add to Cart Button -->
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
    <p class="text-center">No products found.</p>
@endforelse
