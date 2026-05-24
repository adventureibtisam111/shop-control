<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Control</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen text-gray-800">

    <div class="pb-24">

        @yield('content')

    </div>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg">
        <div class="max-w-md mx-auto grid grid-cols-4 text-center py-3 text-sm">

            <a href="/dashboard" class="text-gray-600">Home</a>
            <a href="/sales/create" class="text-gray-600">Sales</a>
            <a href="/credits" class="text-gray-600">Credits</a>
            <a href="/sales/history" class="text-gray-600">History</a>

        </div>
    </nav>

</body>
</html>