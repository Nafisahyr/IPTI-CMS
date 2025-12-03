@extends('auth-master')

@section('title', 'Register')
@section('page-title', 'Register')

@section('auth-content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <input type="text"
                       name="name"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                       required>
            </div>

            <div>
                <input type="email"
                       name="email"
                       placeholder="Email"
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                       required>
            </div>

            <div>
                <input type="password"
                       name="password"
                       placeholder="Password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                       required>
            </div>

            <div>
                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:-translate-y-0.5">
                Register
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium ml-1">
                    Login
                </a>
            </p>
        </div>
    </form>
@endsection
