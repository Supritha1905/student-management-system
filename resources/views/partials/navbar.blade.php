<nav class="text-white shadow-lg" style="background-color: #813F98;">
    <div class="container mx-auto h-20 flex items-center justify-between px-4">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">
            <img src="{{ asset('images/logo (2).png') }}" alt="Logo" class="h-12 md:h-22">
        </a>

        <!-- Mobile menu button -->
        <button class="md:hidden focus:outline-none" id="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

  
        <div class="hidden md:flex items-center space-x-6 ml-auto">
            @auth('admin')
                <div class="flex items-center space-x-4">
                    <span class="hidden sm:inline">Welcome, {{ Auth::guard('admin')->user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

            <a href="{{ route('admin.password.form') }}" class="border hover:bg-white/30 text-white px-4 py-2 rounded transition">
                Change Password
            </a>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden bg-purple-900 px-4 py-2" id="mobile-menu">
        @auth('admin')
            <div class="flex flex-col space-y-2 py-2">
                <span class="text-white">Welcome, {{ Auth::guard('admin')->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
        <a href="{{ route('admin.password.form') }}" class="block border hover:bg-white/30 text-white px-4 py-2 rounded transition mb-2">
            Change Password
        </a>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>