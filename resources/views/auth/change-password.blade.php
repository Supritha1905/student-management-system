@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <h1 class="text-2xl font-bold text-center mb-6">Change Password</h1>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        
        <div class="mb-4">
            <label for="current_password" class="block text-gray-700 mb-2">Current Password</label>
            <input type="password" id="current_password" name="current_password" required 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">New Password</label>
            <input type="password" id="password" name="password" required 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            Update Password
        </button>
    </form>
</div>
@endsection 