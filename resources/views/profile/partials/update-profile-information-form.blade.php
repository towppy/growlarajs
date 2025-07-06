@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
    {{-- Profile Image --}}
                <div class="mb-4">
                    <label for="image" class="block font-medium text-sm text-gray-700">Profile Image</label>

                    @if ($user->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="h-20 w-20 rounded-full object-cover">
                        </div>
                    @endif

                    <input type="file" name="image" id="image" class="form-input mt-1 block w-full">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                           class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role (readonly) --}}
                <div class="mb-4">
                    <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                    <input id="role" name="role" type="text" value="{{ $user->is_admin ? 'admin' : 'user' }}"
                           class="form-input rounded-md shadow-sm mt-1 block w-full bg-gray-100" readonly>
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                           class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="mb-4">
                    <label for="address" class="block font-medium text-sm text-gray-700">Address</label>
                    <input id="address" name="address" type="text" value="{{ old('address', $user->address) }}"
                           class="form-input rounded-md shadow-sm mt-1 block w-full">
                    @error('address')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            

                {{-- Submit --}}
                <div class="flex items-center gap-4">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-black hover:bg-indigo-700">
                        Save
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p class="text-sm text-green-600">Saved.</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
