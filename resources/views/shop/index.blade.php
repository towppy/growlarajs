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
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <input id="product-search" class="form-control" type="text" placeholder="Search products...">
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center" id="product-list">
        @include('product-cards', ['products' => $products])
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#product-search').on('keyup', function () {
        const query = $(this).val();

        $.ajax({
            url: "{{ route('search.products') }}",
            type: "GET",
            data: { query: query },
            success: function (data) {
                $('#product-list').html(data);
            }
        });
    });

    @auth
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            alert('🛒 Product added to cart!');
        });
    });
    @endauth
});
</script>
@endpush
