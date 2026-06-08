<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Healthy Life Monitoring</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-lg">

        <h1 class="text-2xl font-bold text-center text-slate-800 mb-2">
            Login
        </h1>

        <p class="text-center text-slate-400 mb-6">
            Masuk ke Healthy Life Monitoring
        </p>

        @if (session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-semibold">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-xl px-4 py-3"
                    placeholder="Masukkan email">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-semibold">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-xl px-4 py-3"
                    placeholder="Masukkan password">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold">
                Register
            </a>
        </p>

    </div>

</body>

</html>