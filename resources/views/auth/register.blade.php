@extends('layouts.guest')

@section('content')

<div class="bg-gray-50 min-h-screen flex items-center justify-center px-4 relative overflow-hidden">
        
    <!-- Background shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-100 rounded-full opacity-20"></div>
            <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-red-50 rounded-full opacity-30"></div>
            <div class="absolute top-1/4 -left-20 w-40 h-40 bg-red-200 rounded-full opacity-15"></div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl w-full max-w-4xl overflow-hidden relative z-10">
            
            <div class="bg-white px-12 py-6 text-center border-b border-gray-100 relative">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
                <p class="text-gray-600 text-lg">Join NGO Connect and make a difference</p>
            </div>

            <!-- Form Section -->
            <div class="bg-white px-12 py-10">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-8 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 p-4 mb-8 rounded-lg">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="name" class="block text-lg font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                placeholder="Enter your full name"
                                required>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="email" class="block text-lg font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                placeholder="Enter your email address"
                                required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="password" class="block text-lg font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                placeholder="Create a secure password"
                                required>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                placeholder="Confirm your password"
                                required>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-lg">
                        Create Account
                    </button>
                </form>
                
                <div class="mt-10 text-center">
                    <p class="text-gray-600 text-lg">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-red-500 hover:text-red-600 font-medium transition-colors">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
