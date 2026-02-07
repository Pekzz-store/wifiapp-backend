<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-gray-900 to-black">

    {{-- BLUR BACKGROUND --}}
    <div class="absolute inset-0 backdrop-blur-md"></div>

    {{-- LOGIN CARD --}}
    <div class="relative w-full max-w-md bg-white/10 backdrop-blur-xl rounded-2xl shadow-xl p-8 border border-white/20">

        <h2 class="text-2xl font-bold text-white text-center mb-6">
            Login Sistem
        </h2>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-5">
            @csrf

            <div>
                <label class="text-sm text-gray-300">Username</label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="w-full mt-1 px-4 py-2 rounded bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm text-gray-300">Password</label>

                <div class="relative mt-1">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full px-4 py-2 pr-12 rounded bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >

                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-300 hover:text-white"
                    >
                        {{-- EYE ICON --}}
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478
                                     0 8.268 2.943 9.542 7-1.274 4.057-5.064
                                     7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 transition py-2 rounded text-white font-semibold">
                Login
            </button>
        </form>

        <p class="text-sm text-center text-gray-300 mt-6">
            Belum punya akun?
            <a href="/register" class="text-blue-400 hover:underline">Register</a>
        </p>
    </div>

    {{-- SCRIPT --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478
                     0-8.268-2.943-9.542-7a9.956 9.956 0 012.15-3.411M6.223
                     6.223A9.955 9.955 0 0112 5c4.478 0 8.268 2.943
                     9.542 7a9.956 9.956 0 01-4.043 5.195M15 12a3
                     3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M3 3l18 18"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478
                     0 8.268 2.943 9.542 7-1.274 4.057-5.064
                     7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }
    </script>

</body>
</html>
