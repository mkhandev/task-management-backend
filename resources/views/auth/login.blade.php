@extends('layouts.auth')

@section('title', 'Home Page')

@section('content')

    <div class="w-1/3 mt-[50px] mx-auto">
        <form action="{{ route('login') }}" method="POST" class="p-5 bg-white rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="border rounded w-full p-2 @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                @error('email')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="border rounded w-full p-2 @error('password') border-red-500 @enderror">

                @error('password')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="p-2 text-white bg-blue-500 rounded">Login</button>
        </form>
    </div>

@endsection
