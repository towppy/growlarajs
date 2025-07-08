@extends('layouts.app')

@section('content')
<!-- Header -->
<header class="bg-dark py-5 mb-4">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">GROWCERY Admin</h1>
            <p class="lead fw-normal text-white-50 mb-0">Manage your shop with ease 🌿</p>
        </div>
    </div>
</header>

<!-- Button Section -->
<div class="container px-4 px-lg-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
            <div class="d-flex flex-wrap gap-4 justify-content-center">
                <a href="{{ route('prod.management') }}" class="btn btn-outline-success shadow px-4 py-2 rounded-pill">
                    📦 Product Management
                </a>

                <a href="{{ route('user.management') }}" class="btn btn-outline-primary shadow px-4 py-2 rounded-pill">
                    👤 User Management
                </a>

                {{-- Uncomment when ready --}}
                {{--
                <a href="{{ route('transaction.management') }}" class="btn btn-outline-warning shadow px-4 py-2 rounded-pill">
                    📄 Transaction Management
                </a>

                <a href="{{ route('category.management') }}" class="btn btn-outline-dark shadow px-4 py-2 rounded-pill">
                    🏷 Category Management
                </a>
                --}}
            </div>
        </div>
    </div>
</div>
@endsection
