<nav class="bg-blue-600 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Student Management</a>
        
        @auth('admin')
        <div class="flex items-center space-x-4">
            <span>Welcome, {{ Auth::guard('admin')->user()->username }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</button>
            </form>
        </div>
        @endauth

        <a href="{{ route('admin.password.form') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
            Change Password
        </a>
    </div>
</nav>