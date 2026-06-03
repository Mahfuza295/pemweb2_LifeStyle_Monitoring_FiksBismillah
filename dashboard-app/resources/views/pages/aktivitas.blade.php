@extends('layouts.app')

@section('title', 'Input Aktivitas Harian')

@section('content')
@php
    $tanggalAwal = old('tanggal', date('Y-m-d'));
@endphp

<style>
    .activity-page {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-soft: #dbeafe;
        --border: #e2e8f0;
        --text: #1e293b;
    }

    .activity-card {
        border: 1px solid var(--border);
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    }

    .activity-card:hover {
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.12);
    }

    .activity-btn-primary {
        background: var(--primary);
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.22);
    }

    .activity-btn-primary:hover {
        background: var(--primary-dark);
    }

    .activity-field {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 0.9rem;
        background: #ffffff;
        padding: 0.95rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--text);
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .activity-field:focus,
    .activity-date-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .activity-field::placeholder {
        color: #94a3b8;
    }

    .activity-select {
        appearance: none;
        background-image: linear-gradient(45deg, transparent 50%, #64748b 50%),
            linear-gradient(135deg, #64748b 50%, transparent 50%);
        background-position: calc(100% - 22px) 50%, calc(100% - 14px) 50%;
        background-size: 8px 8px, 8px 8px;
        background-repeat: no-repeat;
        padding-right: 3rem;
    }

    .activity-date-input::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: 0.75;
    }

    .status-chip {
        border-radius: 999px;
        padding: .35rem .75rem;
        font-size: .8rem;
        font-weight: 700;
        white-space: nowrap;
    }

    @media (max-width: 640px) {
        .activity-mobile-wrap {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
        }
    }
</style>

<div class="activity-page activity-mobile-wrap max-w-5xl mx-auto">

    @if (session('success'))
        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold mb-2">Ada data yang belum benar:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- HALAMAN PILIH SESI --}}
    <section id="dailyView">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                        Input Aktivitas Harian
                    </h1>

                    <p class="mt-2 text-sm sm:text-base text-slate-500">
                        Tanggal Terpilih:
                        <span id="tanggalLabel" class="font-semibold text-slate-700"></span>
                    </p>
                </div>

                <div class="shrink-0 w-full sm:w-auto">
                    <label for="tanggalInput" class="block text-sm font-semibold text-slate-600 mb-2">
                        Pilih Tanggal
                    </label>

                    <input type="date" id="tanggalInput" value="{{ $tanggalAwal }}"
                        class="activity-date-input w-full sm:w-auto min-w-[220px] rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm sm:text-base font-semibold text-slate-700 outline-none transition cursor-pointer">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-6">

            <button type="button" data-session-card="pagi"
                class="session-card activity-card w-full bg-white rounded-2xl px-5 py-5 flex items-center justify-between gap-4 text-left transition">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800">Sesi Pagi</h2>
                    <p class="session-summary mt-1 text-sm text-slate-500 hidden"></p>
                </div>

                <span class="session-status status-chip bg-slate-100 text-slate-500">
                    Belum Diisi
                </span>
            </button>

            <button type="button" data-session-card="siang"
                class="session-card activity-card w-full bg-white rounded-2xl px-5 py-5 flex items-center justify-between gap-4 text-left transition">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800">Sesi Siang</h2>
                    <p class="session-summary mt-1 text-sm text-slate-500 hidden"></p>
                </div>

                <span class="session-status status-chip bg-slate-100 text-slate-500">
                    Belum Diisi
                </span>
            </button>

            <button type="button" data-session-card="malam"
                class="session-card activity-card w-full bg-white rounded-2xl px-5 py-5 flex items-center justify-between gap-4 text-left transition">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800">Sesi Malam</h2>
                    <p class="session-summary mt-1 text-sm text-slate-500 hidden"></p>
                </div>

                <span class="session-status status-chip bg-slate-100 text-slate-500">
                    Belum Diisi
                </span>
            </button>

        </div>

        <form id="dailySubmitForm" method="POST" action="{{ route('aktivitas.store') }}">
            @csrf

            <input type="hidden" name="tanggal" id="formTanggal" value="{{ $tanggalAwal }}">
            <input type="hidden" name="makan" id="formMakan" value="0">
            <input type="hidden" name="olahraga" id="formOlahraga" value="0">
            <input type="hidden" name="tidur" id="formTidur" value="0">
            <input type="hidden" name="air_minum" id="formAirMinum" value="0">
            <input type="hidden" name="catatan" id="formCatatan" value="">

            <button type="button" id="btnKirimData"
                class="activity-btn-primary w-full text-white py-4 rounded-xl text-base sm:text-lg font-bold tracking-wide transition">
                Kirim ke Data Harian
            </button>
        </form>
    </section>

    {{-- HALAMAN FORM PER SESI --}}
    <section id="sessionView" class="hidden">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">

            <button type="button" id="btnKembali"
                class="mb-5 text-sm font-semibold text-slate-500 hover:text-blue-600 transition">
                Kembali ke pilihan sesi
            </button>

            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Input Aktivitas Sesi:
                    <span id="sessionTitle">PAGI</span>
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Isi data sesuai aktivitas pada sesi waktu ini.
                </p>
            </div>

            <form id="sessionForm" class="space-y-6">

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Pilih Nama Makanan
                    </label>

                    <select id="makanan" class="activity-field activity-select">
                        <option>Nasi Goreng</option>
                        <option>Nasi Uduk</option>
                        <option>Nasi Putih</option>
                        <option>Roti</option>
                        <option>Bubur Ayam</option>
                        <option>Mie Goreng</option>
                        <option>Sayur</option>
                        <option>Buah</option>
                        <option>Protein</option>
                        <option>Junk Food</option>
                        <option>Minuman Manis</option>
                        <option>Tidak Makan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Jenis Minuman
                    </label>

                    <select id="minuman" class="activity-field activity-select">
                        <option>Air Putih</option>
                        <option>Teh Manis</option>
                        <option>Kopi</option>
                        <option>Jus</option>
                        <option>Susu</option>
                        <option>Minuman Bersoda</option>
                        <option>Tidak Ada</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Jumlah Air Minum
                    </label>

                    <input type="number" min="0" max="30" step="1" id="gelas"
                        placeholder="Contoh: 2" class="activity-field">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Aktivitas Olahraga
                    </label>

                    <select id="olahragaJenis" class="activity-field activity-select">
                        <option>Tidak Ada</option>
                        <option>Jalan Santai</option>
                        <option>Jogging</option>
                        <option>Bersepeda</option>
                        <option>Push Up</option>
                        <option>Yoga</option>
                        <option>Gym</option>
                        <option>Renang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Durasi Olahraga
                    </label>

                    <input type="number" min="0" max="300" step="1" id="olahragaDurasi"
                        placeholder="Durasi dalam menit" class="activity-field">
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <label class="block text-sm font-bold text-slate-700 mb-3">
                        Istirahat / Tidur
                    </label>

                    <label class="flex items-center gap-3 text-base text-slate-700 cursor-pointer select-none">
                        <input type="checkbox" id="tidurCheck" class="w-5 h-5 accent-blue-600">
                        <span>Saya tidur pada sesi waktu ini</span>
                    </label>
                </div>

                <div id="tidurInputWrap" class="hidden">
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Durasi Tidur
                    </label>

                    <input type="number" min="0" max="24" step="0.5" id="tidurJam"
                        placeholder="Durasi tidur dalam jam" class="activity-field">
                </div>

                <button type="submit"
                    class="activity-btn-primary w-full text-white py-4 rounded-xl text-base sm:text-lg font-bold tracking-wide transition">
                    Simpan Sesi Ini
                </button>

            </form>
        </div>
    </section>

    {{-- RIWAYAT DATA HARIAN --}}
    @if(isset($riwayat) && $riwayat->count())
        <section class="mt-8">
            <div class="mb-5">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    Riwayat Data Harian
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Data aktivitas yang sudah pernah disimpan.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5">
                @foreach($riwayat as $item)
                    <div class="activity-card bg-white rounded-2xl p-5 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-slate-800">
                                    Hari Aktivitas: {{ date('j-n-Y', strtotime($item->tanggal)) }}
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Ringkasan aktivitas harian Anda.
                                </p>
                            </div>

                            <span class="status-chip bg-blue-100 text-blue-700">
                                Skor {{ $item->skor }}%
                            </span>
                        </div>

                        @if($item->catatan)
                            <div class="text-sm text-slate-600 leading-7 mb-5 rounded-xl bg-slate-50 border border-slate-100 p-4">
                                {!! nl2br(e($item->catatan)) !!}
                            </div>
                        @endif

                        <div class="border-t pt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-600">
                            <p>
                                <span class="font-semibold text-slate-700">Total Air Diminum:</span>
                                {{ $item->air_minum }} Gelas
                            </p>

                            <p>
                                <span class="font-semibold text-slate-700">Total Olahraga:</span>
                                {{ $item->olahraga }} Menit
                            </p>

                            <p>
                                <span class="font-semibold text-slate-700">Total Tidur:</span>
                                {{ $item->tidur }} Jam
                            </p>

                            <p>
                                <span class="font-semibold text-slate-700">Kategori:</span>
                                {{ $item->kategori }}
                            </p>
                        </div>

                        <a href="{{ route('dashboard') }}"
                            class="mt-5 block activity-btn-primary text-center text-white py-3 rounded-xl text-sm sm:text-base font-bold transition">
                            Cek Skor Kesehatan Anda
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sessions = {
            pagi: null,
            siang: null,
            malam: null,
        };

        const sessionLabels = {
            pagi: 'PAGI',
            siang: 'SIANG',
            malam: 'MALAM',
        };

        const sessionReadable = {
            pagi: 'Pagi',
            siang: 'Siang',
            malam: 'Malam',
        };

        let activeSession = 'pagi';

        const dailyView = document.getElementById('dailyView');
        const sessionView = document.getElementById('sessionView');
        const sessionTitle = document.getElementById('sessionTitle');
        const tanggalInput = document.getElementById('tanggalInput');
        const tanggalLabel = document.getElementById('tanggalLabel');
        const formTanggal = document.getElementById('formTanggal');
        const tidurCheck = document.getElementById('tidurCheck');
        const tidurInputWrap = document.getElementById('tidurInputWrap');
        const tidurJam = document.getElementById('tidurJam');
        const olahragaJenis = document.getElementById('olahragaJenis');
        const olahragaDurasi = document.getElementById('olahragaDurasi');

        const formatTanggal = (value) => {
            if (!value) {
                return '-';
            }

            const [year, month, day] = value.split('-');

            return `${Number(day)}-${Number(month)}-${year}`;
        };

        const numberValue = (id) => {
            const value = document.getElementById(id).value;

            return value === '' ? 0 : Number(value);
        };

        const showDaily = () => {
            sessionView.classList.add('hidden');
            dailyView.classList.remove('hidden');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        const showSession = (key) => {
            activeSession = key;
            sessionTitle.textContent = sessionLabels[key];

            const data = sessions[key] || {
                makanan: key === 'pagi' ? 'Nasi Goreng' : 'Nasi Putih',
                minuman: 'Air Putih',
                gelas: '',
                olahragaJenis: 'Tidak Ada',
                olahragaDurasi: '',
                tidurCheck: false,
                tidurJam: '',
            };

            document.getElementById('makanan').value = data.makanan;
            document.getElementById('minuman').value = data.minuman;
            document.getElementById('gelas').value = data.gelas;
            olahragaJenis.value = data.olahragaJenis;
            olahragaDurasi.value = data.olahragaDurasi;
            tidurCheck.checked = data.tidurCheck;
            tidurJam.value = data.tidurJam;

            tidurInputWrap.classList.toggle('hidden', !tidurCheck.checked);

            dailyView.classList.add('hidden');
            sessionView.classList.remove('hidden');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        const updateTanggal = () => {
            tanggalLabel.textContent = formatTanggal(tanggalInput.value);
            formTanggal.value = tanggalInput.value;
        };

        const updateCards = () => {
            document.querySelectorAll('[data-session-card]').forEach((card) => {
                const key = card.getAttribute('data-session-card');
                const data = sessions[key];
                const status = card.querySelector('.session-status');
                const summary = card.querySelector('.session-summary');

                if (data) {
                    status.textContent = 'Sudah Diisi';
                    status.classList.remove('bg-slate-100', 'text-slate-500');
                    status.classList.add('bg-green-100', 'text-green-700');

                    summary.textContent = `${data.makanan}, ${data.gelas || 0} gelas, olahraga ${data.olahragaDurasi || 0} menit`;
                    summary.classList.remove('hidden');
                } else {
                    status.textContent = 'Belum Diisi';
                    status.classList.add('bg-slate-100', 'text-slate-500');
                    status.classList.remove('bg-green-100', 'text-green-700');

                    summary.textContent = '';
                    summary.classList.add('hidden');
                }
            });
        };

        tanggalInput.addEventListener('click', () => {
            if (typeof tanggalInput.showPicker === 'function') {
                try {
                    tanggalInput.showPicker();
                } catch (error) {
                    // Jika browser tidak mendukung showPicker, input tanggal tetap bisa diklik manual.
                }
            }
        });

        tanggalInput.addEventListener('change', updateTanggal);
        tanggalInput.addEventListener('input', updateTanggal);

        document.querySelectorAll('[data-session-card]').forEach((button) => {
            button.addEventListener('click', () => {
                showSession(button.getAttribute('data-session-card'));
            });
        });

        document.getElementById('btnKembali').addEventListener('click', showDaily);

        tidurCheck.addEventListener('change', () => {
            tidurInputWrap.classList.toggle('hidden', !tidurCheck.checked);

            if (!tidurCheck.checked) {
                tidurJam.value = '';
            }
        });

        olahragaJenis.addEventListener('change', () => {
            if (olahragaJenis.value === 'Tidak Ada') {
                olahragaDurasi.value = '';
            }
        });

        document.getElementById('sessionForm').addEventListener('submit', (event) => {
            event.preventDefault();

            const data = {
                makanan: document.getElementById('makanan').value,
                minuman: document.getElementById('minuman').value,
                gelas: numberValue('gelas'),
                olahragaJenis: olahragaJenis.value,
                olahragaDurasi: olahragaJenis.value === 'Tidak Ada' ? 0 : numberValue('olahragaDurasi'),
                tidurCheck: tidurCheck.checked,
                tidurJam: tidurCheck.checked ? numberValue('tidurJam') : 0,
            };

            if (data.gelas < 0 || data.olahragaDurasi < 0 || data.tidurJam < 0) {
                alert('Angka tidak boleh kurang dari 0.');
                return;
            }

            sessions[activeSession] = data;

            updateCards();
            showDaily();
        });

        document.getElementById('btnKirimData').addEventListener('click', () => {
            const filledSessions = Object.entries(sessions).filter(([, data]) => data !== null);

            if (filledSessions.length === 0) {
                alert('Isi minimal satu sesi terlebih dahulu.');
                return;
            }

            const totalMakan = filledSessions.filter(([, data]) => {
                return data.makanan !== 'Tidak Makan';
            }).length;

            const totalAir = filledSessions.reduce((sum, [, data]) => {
                return sum + Number(data.gelas || 0);
            }, 0);

            const totalOlahraga = filledSessions.reduce((sum, [, data]) => {
                return sum + Number(data.olahragaDurasi || 0);
            }, 0);

            const totalTidur = filledSessions.reduce((sum, [, data]) => {
                return sum + Number(data.tidurJam || 0);
            }, 0);

            const catatan = filledSessions.map(([key, data]) => {
                const rincian = [
                    `Makan ${data.makanan}`,
                    `Minum ${data.minuman} ${data.gelas || 0} gelas`,
                    `Olahraga ${data.olahragaJenis} ${data.olahragaDurasi || 0} menit`,
                    data.tidurCheck ? `Tidur ${data.tidurJam || 0} jam` : 'Tidak tidur pada sesi ini',
                ];

                return `Sesi ${sessionReadable[key]}: ${rincian.join(', ')}`;
            }).join('\n');

            document.getElementById('formMakan').value = totalMakan;
            document.getElementById('formAirMinum').value = totalAir;
            document.getElementById('formOlahraga').value = totalOlahraga;
            document.getElementById('formTidur').value = totalTidur;
            document.getElementById('formCatatan').value = catatan;

            document.getElementById('dailySubmitForm').submit();
        });

        updateTanggal();
        updateCards();
    });
</script>
@endsection
