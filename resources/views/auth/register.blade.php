<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-900 via-gray-900 to-black">

    {{-- BLUR BACKGROUND --}}
    <div class="absolute inset-0 backdrop-blur-md"></div>

    {{-- REGISTER CARD --}}
    <div class="relative w-full max-w-md bg-white/10 backdrop-blur-xl rounded-2xl shadow-xl p-8 border border-white/20">

        <h2 class="text-2xl font-bold text-white text-center mb-6">
            Register Akun
        </h2>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-300">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full mt-1 px-4 py-2 rounded bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required
                >
            </div>

            <div>
                <label class="text-sm text-gray-300">Username</label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="w-full mt-1 px-4 py-2 rounded bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required
                >
            </div>

            <div>
                <label class="text-sm text-gray-300">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full mt-1 px-4 py-2 rounded bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 transition py-2 rounded text-white font-semibold"
            >
                Register
            </button>
        </form>

        <p class="text-sm text-center text-gray-300 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-blue-400 hover:underline">
                Login
            </a>
        </p>
    </div>

</body>
</html>
