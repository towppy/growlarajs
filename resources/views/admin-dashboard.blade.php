@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-3xl font-bold text-success mb-4">👑 Admin Dashboard</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5 class="card-title">📦 Total Products</h5>
                    <p class="card-text fs-4">123</p> {{-- Replace with real count --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">👥 Registered Users</h5>
                    <p class="card-text fs-4">50</p> {{-- Replace with dynamic count --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">🛒 Orders Today</h5>
                    <p class="card-text fs-4">7</p> {{-- Replace with dynamic count --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
