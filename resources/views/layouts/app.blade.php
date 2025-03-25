<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* Add this style block */
        .animate-fade-in-out {
            animation: fadeInOut 4s ease-in-out forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>

</head>
<body class="bg-[#F7F3FA]">
    <div id="notification-container" class="fixed top-4 right-4 z-[1000] space-y-2 w-full max-w-xs">
        @if(session('success'))
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center justify-between animate-fade-in-out">
                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 font-bold hover:text-green-200">×</button>
            </div>
        @endif
    </div>
    <div class="min-h-screen">
        @include('partials.navbar')
        
        <main class="container mx-auto py-8 px-4">
            @yield('content')
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>