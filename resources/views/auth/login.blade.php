<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen m-0 p-0">
    <div class="min-h-screen w-full bg-cover bg-center bg-fixed flex items-center justify-center px-4 py-8" 
         style="background-image: url('images/background_login.png');">
        <div class="w-full max-w-md bg-white/30 backdrop-blur-sm rounded-lg shadow-lg p-6 sm:p-8 mx-2">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Admin Login</h1>
                <p class="text-sm text-gray-700 mt-2">Enter credentials to access dashboard</p>
            </div>
            
            @if ($errors->any())
                <div class="bg-red-100/50 backdrop-blur-sm border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="username" class="block text-gray-900 font-medium mb-2 text-sm sm:text-base">Username</label>
                    <input type="text" id="username" name="username" required 
                           class="w-full px-3 py-2 bg-white/50 backdrop-blur-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base"
                        >
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-900 font-medium mb-2 text-sm sm:text-base">Password</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full px-3 py-2 bg-white/50 backdrop-blur-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base"
                         >
                </div>
                
                <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-opacity-50 transition-colors text-sm sm:text-base">
                    Login
                </button>
            </form>

        </div>
    </div>
</body>
</html>