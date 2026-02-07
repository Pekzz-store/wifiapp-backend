<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WiFi App</title>

    <!-- Tailwind CDN (NO VITE, NO npm) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
    <div class="font-bold text-lg">WiFi App 🚀</div>

    <div class="flex items-center gap-4 text-sm">
        <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
                Logout
            </button>
        </form>
    </div>
</nav>

<main class="p-6">
    @yield('content')
</main>

</body>
</html>
