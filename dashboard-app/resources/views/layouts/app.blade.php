<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Healthy Life Monitoring')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    <div class="flex min-h-screen">
        
        <!-- SIDEBAR NAVIGASI (KIRI) - Sesuai Bab 3.1 Proposal -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-40">
            <!-- Logo / Judul Website -->
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 text-white p-2 rounded-xl shadow-md shadow-blue-200">
                        <i class="fa-solid fa-heart-pulse text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-950 text-sm leading-tight">Lifestyle Monitor</h2>
                        <span class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">SDGs 3 Platform</span>
                    </div>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 p-4 space-y-1.5 mt-4">
                <span class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Menu Utama</span>
                
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-chart-pie text-base w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Input Aktivitas -->
                <a href="{{ route('aktivitas') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('aktivitas') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-circle-plus text-base w-5 text-center"></i>
                    <span>Input Aktivitas</span>
                </a>

                <!-- Artikel Edukasi -->
                <a href="{{ route('artikel') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('artikel') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-newspaper text-base w-5 text-center"></i>
                    <span>Artikel Edukasi</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('profil') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-user text-base w-5 text-center"></i>
                    <span>Profil Pengguna</span>
                </a>
            </nav>

            <!-- Bagian Bawah Sidebar (User Info & Logout) -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-blue-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            M
                        </div>
                        <div class="truncate max-w-[110px]">
                            <span class="text-xs font-semibold text-slate-800 block leading-tight">Mahfuza</span>
                            <span class="text-[10px] text-slate-400 block truncate">User Aktif</span>
                        </div>
                    </div>
                    <button class="text-slate-400 hover:text-red-500 p-1.5 rounded-lg hover:bg-white transition" title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-sm"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- KONTEN UTAMA (KANAN) -->
        <div class="flex-1 ml-64 flex flex-col min-h-screen">
            
            <!-- TOP BAR (HEADER ATAS) -->
            <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between sticky top-0 z-30">
                <div class="text-xs font-medium text-slate-400">
                    Sistem Monitoring Kesehatan & Pencegahan Penyakit Tidak Menular (PTM)
                </div>
                <div class="flex items-center gap-4">
                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-md text-xs font-bold tracking-wide">
                         <i class="fa-solid fa-shield-heart mr-1"></i> SDGs Target 3.4
                    </span>
                </div>
            </header>

            <!-- ISI VIEW DINAMIS -->
            <main class="flex-1 p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>