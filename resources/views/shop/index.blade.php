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
       
<input type="text" id="search-autocomplete" class="form-control" placeholder="Search for products...">
<div id="autocomplete-results" class="list-group position-absolute w-100 z-3"></div>
</div>
</div>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center" id="product-list">
        @include('product-cards', ['products' => $products])
    </div>
</div>
<!-- @if ($errors->has('account'))
    <div class="alert alert-danger">
        {{ $errors->first('account') }}
    </div>
@endif -->

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#search-autocomplete').on('keyup', function () {
        let query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "{{ route('autocomplete') }}",
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let suggestions = '';
                    data.forEach(function (item) {
                        suggestions += `<a href="/shop/${item.id}" class="list-group-item list-group-item-action autocomplete-item">${item.name}</a>`;
                    });
                    $('#autocomplete-results').html(suggestions).show();
                }
            });
        } else {
            $('#autocomplete-results').hide();
        }
    });

    // Hide autocomplete dropdown on outside click
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#search-autocomplete, #autocomplete-results').length) {
            $('#autocomplete-results').hide();
        }
    });
});
</script>


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

</script>
@endpush
