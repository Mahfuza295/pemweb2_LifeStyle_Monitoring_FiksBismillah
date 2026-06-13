<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lifestyle Monitoring</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* ===== BACKGROUND DECORATION ===== */
        .bg-blur-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(59,130,246,0.4);
            filter: blur(120px);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            z-index: 0;
        }

        .bg-blur-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(147,197,253,0.5);
            filter: blur(120px);
            bottom: -120px;
            right: -100px;
            border-radius: 50%;
            z-index: 0;
        }

        .bg-blur-3 {
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(37,99,235,0.4);
            filter: blur(100px);
            top: 40%;
            left: 60%;
            border-radius: 50%;
            z-index: 0;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 text-white overflow-x-hidden">

<!-- DECOR -->
<div class="bg-blur-1"></div>
<div class="bg-blur-2"></div>
<div class="bg-blur-3"></div>

<!-- NAVBAR -->
<header class="relative flex justify-between items-center px-10 py-5 bg-white/10 backdrop-blur-md border-b border-white/20 z-10">
    <h1 class="text-xl font-bold flex items-center gap-2">
         Lifestyle Monitoring
    </h1>

    <div class="flex gap-3">
        <a href="/login"
           class="px-5 py-2 text-sm rounded-xl bg-white text-blue-600 hover:bg-blue-50 transition shadow">
            Login
        </a>

        <a href="/register"
           class="px-5 py-2 text-sm rounded-xl bg-blue-900/30 hover:bg-blue-900/50 transition border border-white/20">
            Register
        </a>
    </div>
</header>

<!-- HERO -->
<section class="relative flex flex-col items-center text-center mt-24 px-6 z-10">

    <div class="bg-white/15 px-4 py-1 rounded-full text-sm mb-5 backdrop-blur">
         Monitor hidup sehat lebih mudah
    </div>

    <h1 class="text-5xl font-bold leading-tight">
        Kendalikan Gaya Hidup<br>
        <span class="text-blue-200">Lebih Sehat & Teratur</span>
    </h1>

    <p class="mt-5 text-blue-100 max-w-2xl text-lg">
        Aplikasi untuk mencatat aktivitas harian seperti makan, olahraga, tidur, dan konsumsi air
        agar hidup kamu lebih seimbang dan sehat.
    </p>

    <div class="mt-8 flex gap-4">
        <a href="/login"
           class="px-7 py-3 bg-white text-blue-600 rounded-2xl shadow-lg hover:scale-105 transition font-semibold">
            Mulai Sekarang
        </a>

        <a href="#fitur"
           class="px-7 py-3 bg-blue-900/30 border border-white/30 rounded-2xl hover:bg-blue-900/50 transition">
            Lihat Fitur
        </a>
    </div>

</section>

<!-- FITUR -->
<section id="fitur" class="relative mt-28 px-10 z-10">

    <h2 class="text-center text-3xl font-bold mb-10">
        Fitur Utama
    </h2>

    <div class="grid md:grid-cols-4 gap-6 max-w-6xl mx-auto">

        <!-- CARD 1 -->
        <div class="bg-white text-slate-800 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <!-- ICON FOOD -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l1-5H6.4M7 13l-1 6h12l-1-6M7 13h10M9 21h.01M15 21h.01"/>
                </svg>
            </div>
            <h3 class="font-bold mt-4">Makan</h3>
            <p class="text-sm text-slate-500 mt-1">Catat konsumsi makanan harian.</p>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white text-slate-800 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <!-- ICON SPORT -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="font-bold mt-4">Olahraga</h3>
            <p class="text-sm text-slate-500 mt-1">Pantau aktivitas fisik harian.</p>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white text-slate-800 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <!-- ICON SLEEP -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3c4.97 0 9 3.582 9 8s-4.03 8-9 8-9-3.582-9-8 4.03-8 9-8z"/>
                </svg>
            </div>
            <h3 class="font-bold mt-4">Tidur</h3>
            <p class="text-sm text-slate-500 mt-1">Monitor kualitas tidur.</p>
        </div>

        <!-- CARD 4 -->
        <div class="bg-white text-slate-800 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <!-- ICON WATER -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 2C8 8 6 10 6 14a6 6 0 0012 0c0-4-2-6-6-12z"/>
                </svg>
            </div>
            <h3 class="font-bold mt-4">Air Minum</h3>
            <p class="text-sm text-slate-500 mt-1">Pantau kebutuhan cairan.</p>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="relative mt-28 text-center px-6 z-10">

    <div class="bg-white text-blue-600 max-w-3xl mx-auto py-14 rounded-3xl shadow-2xl">

        <h2 class="text-3xl font-bold">
            Siap Memulai Hidup Sehat?
        </h2>

        <p class="mt-3 text-slate-500">
            Catat aktivitas harian kamu dan lihat perubahan nyata.
        </p>

        <a href="/register"
           class="mt-6 inline-block bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Daftar Sekarang
        </a>

    </div>

</section>

<!-- FOOTER -->
<footer class="relative text-center py-10 text-sm text-blue-100 z-10">
    © 2026 Lifestyle Monitoring - Built with Laravel
</footer>

</body>
</html>