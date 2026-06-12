<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Healthy Life Monitoring')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-100 font-sans text-slate-700">

    <div class="flex min-h-screen">

        <!--sidebar-->
        <aside class="w-64 bg-white shadow-lg fixed h-full">

            <!--logo-->
            <div class="p-6 border-b">
                <div class="flex items-center gap-3">

                    <div class="bg-blue-600 text-white w-12 h-12 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-heart-pulse text-xl"></i>
                    </div>

                    <div>
                        <h1 class="font-bold text-lg text-slate-800">
                            Lifestyle Monitor
                        </h1>

                        <p class="text-sm text-slate-400">
                            Healthy Life App
                        </p>
                    </div>

                </div>
            </div>

            <!--menu-->
            <nav class="p-4 space-y-2">

                <p class="text-xs text-slate-400 uppercase font-semibold px-3 mb-3">
                    Menu Utama
                </p>

                <!--dashboard-->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('dashboard')
    ? 'bg-blue-600 text-white shadow-md'
    : 'hover:bg-slate-100' }}">

                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <!--aktivitas-->
                <a href="{{ route('aktivitas') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('aktivitas')
    ? 'bg-blue-600 text-white shadow-md'
    : 'hover:bg-slate-100' }}">

                    <i class="fa-solid fa-circle-plus w-5 text-center"></i>
                    <span>Input Aktivitas</span>
                </a>

                <!--artikel-->
                @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.artikel.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                                    {{ request()->routeIs('admin.artikel.*')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'hover:bg-slate-100' }}">
                                <i class="fa-solid fa-newspaper w-5 text-center"></i>
                                <span>Kelola Artikel</span>
                            </a>
                @else
                            <a href="{{ route('artikel.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                                    {{ request()->routeIs('artikel.index')
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'hover:bg-slate-100' }}">
                                <i class="fa-solid fa-newspaper w-5 text-center"></i>
                                <span>Artikel Edukasi</span>
                            </a>
                @endif

                <!--profil-->
                <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('profil')
    ? 'bg-blue-600 text-white shadow-md'
    : 'hover:bg-slate-100' }}">

                    <i class="fa-solid fa-user w-5 text-center"></i>
                    <span>Profil Pengguna</span>
                </a>

            </nav>

            <!--pengguna-->
            <div class="absolute bottom-0 w-full p-4 border-t bg-slate-50">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                            M
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold">
                                Mahfuza
                            </h3>

                            <p class="text-xs text-slate-400">
                                User Aktif
                            </p>
                        </div>

                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-500 transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>

                </div>

            </div>

        </aside>

        <!--main content-->
        <div class="flex-1 ml-64">

            <!--header-->
            <header class="bg-white shadow-sm px-8 py-5 flex justify-between items-center">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Healthy Life Monitoring
                    </h2>

                    <p class="text-sm text-slate-400">
                        Sistem Monitoring Kesehatan
                    </p>
                </div>

            </header>

            <!--content-->
            <main class="p-8">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>