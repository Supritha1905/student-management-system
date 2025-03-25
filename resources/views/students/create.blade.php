@extends('layouts.app')

@section('content')
<div class="bg-[#F7F3FA] ">
    <div class="max-w-2xl bg-white mx-auto rounded-lg shadow-md p-6">
        <h1 class="text-2xl text-[#EA624C] font-bold mb-6">Add New Student</h1>
        
        <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Name *</label>
                    <input type="text" id="name" name="name" required 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name') }}" placeholder="Enter student's full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" required 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email') }}" placeholder="student@example.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 mb-2">Phone *</label>
                    <input type="text" id="phone" name="phone" required 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('phone') }}" placeholder="+91 6788888880">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course -->
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 mb-2">Course *</label>
                    <input type="text" id="course" name="course" required 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('course') }}"  placeholder="Computer Science, Mathematics, etc.">
                    @error('course')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Photo -->
                <div class="mb-4 md:col-span-2">
                    <label for="profile_photo" class="block text-gray-700 mb-2">Profile Photo (Max 2MB, JPG/PNG)</label>
                    <input type="file" id="profile_photo" name="profile_photo" 
                        class="w-full px-3 py-2 text-gray-700 font-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/jpeg,image/png">
                    @error('profile_photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-[#EA624C] text-white px-4 py-2 rounded-lg">Cancel</a>
                <button type="submit" class="bg-[#813F98] text-white px-4 py-2 rounded-lg ">Save Student</button>
            </div>
        </form>
    </div>
</div>
@endsection
