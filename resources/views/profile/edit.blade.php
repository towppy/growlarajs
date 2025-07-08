@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile</h2>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
@endsection
