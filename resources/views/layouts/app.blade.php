<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shop Control - POS System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="text-3xl">🏪</div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Shop Control</h1>
                        <p class="text-xs text-gray-500">POS System</p>
                    </div>
                </div>

                <!-- Menu -->
                <div class="hidden md:flex gap-6 items-center">
                    <a href="/dashboard" class="text-gray-700 hover:text-blue-600 font-semibold transition">📊 Dashboard</a>
                    <a href="/products" class="text-gray-700 hover:text-blue-600 font-semibold transition">👕 Products</a>
                    <a href="/sales/create" class="text-gray-700 hover:text-blue-600 font-semibold transition">➕ Sales</a>
                    <a href="/cart" class="text-gray-700 hover:text-blue-600 font-semibold transition">🛒 Cart</a>
                    <a href="/customers" class="text-gray-700 hover:text-blue-600 font-semibold transition">👥 Customers</a>
                    <a href="/credits" class="text-gray-700 hover:text-blue-600 font-semibold transition">💳 Credits</a>
                    <a href="/sales/history" class="text-gray-700 hover:text-blue-600 font-semibold transition">📋 History</a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700 text-2xl" onclick="toggleMobileMenu()">
                    ☰
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-2">
                <a href="/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    📊 Dashboard
                </a>
                <a href="/products" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    👕 Products
                </a>
                <a href="/sales/create" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    ➕ Sales
                </a>
                <a href="/cart" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    🛒 Cart
                </a>
                <a href="/customers" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    👥 Customers
                </a>
                <a href="/credits" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    💳 Credits
                </a>
                <a href="/sales/history" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    📋 History
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 Shop Control - Professional POS System</p>
            <p class="text-sm mt-2">Built with ❤️ using Laravel & Tailwind CSS</p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>