<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SM Irigasi — Dashboard Monitoring</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            950: '#022C22', 900: '#064E3B', 800: '#065F46',
                            700: '#047857', 600: '#059669', 500: '#10B981',
                            400: '#34D399', 300: '#6EE7B7', 200: '#A7F3D0',
                            100: '#D1FAE5', 50: '#ECFDF5'
                        }
                    },
                    fontFamily: { sans: ["'Plus Jakarta Sans'", 'sans-serif'] }
                }
            }
        }
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-grid-blur {
            background-image: linear-gradient(rgba(4,120,87,0.03) 1px, transparent 1px), 
                              linear-gradient(90deg, rgba(4,120,87,0.03) 1px, transparent 1px);
            background-size: 32px 32px;
        }
        .anim-pulse-slow { animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(6,78,59,0.1); border-radius: 9px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(6,78,59,0.2); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col bg-grid-blur">

    <!-- HEADER / NAVBAR -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-emerald-900/5 px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-900 flex items-center justify-center shadow-md shadow-emerald-900/10">
                <svg width="20" height="20" viewBox="0 0 44 44" fill="none">
                    <path d="M22 7C22 7 13 18 13 24C13 29.52 17.03 34 22 34C26.97 34 31 29.52 31 24C31 18 22 7 22 7Z" fill="#10B981"/>
                    <line x1="18" y1="24" x2="26" y2="24" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <line x1="22" y1="20" x2="22" y2="28" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h1 class="font-extrabold text-emerald-950 text-base tracking-tight leading-none">SM Irigasi</h1>
                <p class="text-[10px] font-bold text-emerald-600/60 uppercase tracking-widest mt-1">Sistem Pemantau Air</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-xs font-bold text-slate-800">{{ Auth::user()->name ?? 'Pengguna' }}</div>
                <div class="text-[10px] font-medium text-slate-400 capitalize">{{ Auth::user()->role ?? 'petani' }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-800 font-bold text-sm shadow-inner uppercase">
                {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
            </div>
            <div class="h-5 w-px bg-slate-200 mx-1"></div>
            
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" title="Keluar dari sistem" 
                    class="p-2 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-4 sm:p-6 max-w-7xl w-full mx-auto space-y-6">

        <!-- HERO SECTION -->
        <div class="relative bg-gradient-to-br from-emerald-900 to-emerald-950 rounded-3xl p-6 shadow-xl shadow-emerald-950/10 overflow-hidden text-white">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_50%_at_20%_-10%,rgba(16,185,129,0.15),transparent)] pointer-events-none"></div>
            <div class="relative z-10 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight mb-1">Selamat Datang Kembali!</h2>
                    <p class="text-xs sm:text-sm text-emerald-200/70 max-w-xl leading-relaxed">
                        Pantau distribusi air dan kondisi kelembapan tanah di wilayah sawah petak timur secara real-time untuk hasil panen optimal.
                    </p>
                </div>
                <div class="flex items-center gap-2 bg-emerald-800/40 backdrop-blur-sm border border-emerald-700/30 rounded-2xl px-4 py-2.5 self-start sm:self-auto shadow-inner">
                    <span class="anim-pulse-slow inline-block w-2.5 h-2.5 bg-emerald-400 rounded-full"></span>
                    <span class="text-xs font-semibold tracking-wide text-emerald-100">Sistem Berjalan Normal</span>
                </div>
            </div>
        </div>

        <!-- STATISTIK WIDGET -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Rerata Debit Air</p>
                    <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight leading-none">
                        <span id="rata-debit">0.0</span> <span class="text-xs font-medium text-slate-400">L/dtk</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Rerata Muka Air</p>
                    <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight leading-none">
                        <span id="rata-tma">0</span> <span class="text-xs font-medium text-slate-400">cm</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22v-5M12 13V2M4 12h16"/></svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Status Keamanan</p>
                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight mt-1" id="sensor-aman">Menghitung...</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shadow-inner">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
            </div>
        </div>

        <!-- GRID UTAMA: TABEL SENSOR & FORM LAPORAN -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- TABEL MONITORING SENSOR -->
            <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col h-[480px]">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between flex-shrink-0 bg-slate-50/50">
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm tracking-tight">Kondisi Sensor Lapangan</h4>
                        <p class="text-[11px] font-medium text-slate-400 mt-0.5">Pembaruan otomatis berkala dari perangkat IoT</p>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-white border border-slate-200 shadow-sm text-slate-500 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full inline-block animate-ping"></span> Live Update
                    </span>
                </div>

                <div class="flex-1 overflow-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="sticky top-0 bg-white shadow-[0_1px_0_rgba(0,0,0,0.05)] z-10">
                            <tr class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                <th class="py-3 px-6">Titik Ukur / Lokasi</th>
                                <th class="py-3 px-4 text-center">Debit Air</th>
                                <th class="py-3 px-4 text-center">Tinggi Muka Air</th>
                                <th class="py-3 px-4 text-center">Kelembapan</th>
                                <th class="py-3 px-6 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-sensor-body" class="text-xs font-medium text-slate-700 divide-y divide-slate-100"></tbody>
                    </table>
                </div>
            </div>

            <!-- FORM LAPORAN KENDALA -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 space-y-4">
                <div>
                    <h4 class="font-extrabold text-slate-800 text-sm tracking-tight">Laporkan Kendala Irigasi</h4>
                    <p class="text-[11px] font-medium text-slate-400 mt-0.5">Kirim aduan kerusakan pintu air atau saluran mampet</p>
                </div>

                @if(session('pesan_laporan'))
                    <div class="flex items-start gap-2 p-3 text-xs font-semibold rounded-xl border 
                        {{ session('pesan_warna') === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 'bg-green-50 border-green-200 text-green-800' }}">
                        {{ session('pesan_laporan') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-3 text-xs font-semibold rounded-xl border bg-red-50 border-red-200 text-red-800 space-y-1">
                        @foreach($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('laporan.simpan') }}" method="POST" class="space-y-3.5">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Nama Pelapor</label>
                        <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor', Auth::user()->name ?? '') }}" required placeholder="Nama lengkap Anda"
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 outline-none transition-all duration-200 focus:border-emerald-500 focus:bg-white placeholder:text-slate-300">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Lokasi Kendala / Blok Sawah</label>
                        <input type="text" name="lokasi_kendala" value="{{ old('lokasi_kendala') }}" required placeholder="Contoh: Petak C-12, Saluran Timur"
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 outline-none transition-all duration-200 focus:border-emerald-500 focus:bg-white placeholder:text-slate-300">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Detail Jenis Kendala</label>
                        <textarea name="jenis_kendala" rows="3" required placeholder="Deskripsikan masalah (cth: Tanggul bocor, pintu air macet)..."
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 outline-none transition-all duration-200 focus:border-emerald-500 focus:bg-white placeholder:text-slate-300 resize-none">{{ old('jenis_kendala') }}</textarea>
                    </div>

                    <button type="submit" name="kirim_laporan"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-bold text-white transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0"
                        style="background: linear-gradient(135deg, #065F46 0%, #064E3B 100%); box-shadow: 0 4px 12px rgba(6,78,59,0.2);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Kirim Laporan Aduan
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100 px-6 py-3.5 text-center text-[11px] font-medium text-slate-400 mt-auto flex flex-col sm:flex-row justify-between items-center gap-2">
        <p>© 2026 Kelompok PemWeb — Sistem Monitoring Irigasi Pintar Berbasis Web.</p>
        <p class="text-emerald-600/70 font-semibold bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100">UAS Pemrograman Web</p>
    </footer>

    <!-- JAVASCRIPT SIMULASI DATA SENSOR -->
    <script>
        var dataSensor = [
            { id: 1, nama: 'Pintu Air Utama Blok A', debit: 4.2, tma: 42, lembap: 78, status: 'normal' },
            { id: 2, nama: 'Saluran Sekunder Blok B', debit: 2.8, tma: 28, lembap: 82, status: 'normal' },
            { id: 3, nama: 'Petak Sawah Timur 01', debit: 1.5, tma: 12, lembap: 45, status: 'kritis' },
            { id: 4, nama: 'Petak Sawah Timur 02', debit: 1.9, tma: 16, lembap: 58, status: 'waspada' },
            { id: 5, nama: 'Saluran Tersier Blok C', debit: 2.1, tma: 22, lembap: 69, status: 'normal' }
        ];

        function renderTabel() {
            var tbody = document.getElementById('tabel-sensor-body');
            var rows = '';
            dataSensor.forEach(function(s) {
                var bgPill = 'bg-green-50 text-green-700 border-green-200/60';
                if(s.status === 'waspada') bgPill = 'bg-orange-50 text-orange-700 border-orange-200/60';
                if(s.status === 'kritis')  bgPill = 'bg-red-50 text-red-700 border-red-200/60';

                rows += `<tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-6 font-bold text-slate-800">${s.nama}</td>
                    <td class="py-3 px-4 text-center text-blue-600 font-bold">${s.debit.toFixed(1)} <span class="text-[10px] text-slate-400 font-normal">L/d</span></td>
                    <td class="py-3 px-4 text-center text-slate-800 font-bold">${s.tma} <span class="text-[10px] text-slate-400 font-normal">cm</span></td>
                    <td class="py-3 px-4 text-center font-bold text-emerald-600">${s.lembap}%</td>
                    <td class="py-3 px-6 text-center">
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold border capitalize ${bgPill}">${s.status}</span>
                    </td>
                </tr>`;
            });
            tbody.innerHTML = rows;
            hitungRangkuman();
        }

        function hitungRangkuman() {
            var td = 0, tt = 0, n = 0, c = dataSensor.length;
            dataSensor.forEach(function(s) { 
                td += s.debit; tt += s.tma;
                if (s.status === 'normal') n++;
            });
            document.getElementById('rata-debit').textContent = (td/c).toFixed(1);
            document.getElementById('rata-tma').textContent   = Math.round(tt/c);
            document.getElementById('sensor-aman').textContent = n + ' dari ' + c + ' titik';
        }

        function perbaruiSensor() {
            dataSensor.forEach(function(s) {
                s.debit  = Math.max(0.5, s.debit + (Math.random() - 0.5));
                s.tma    = Math.max(5,   s.tma   + Math.round((Math.random() - 0.5) * 3));
                s.lembap = Math.min(100, Math.max(10, s.lembap + Math.round((Math.random() - 0.5) * 2)));
                
                if (s.tma < 15)       s.status = 'kritis';
                else if (s.tma < 20)  s.status = 'waspada';
                else                  s.status = 'normal';
            });
            renderTabel();
        }

        renderTabel();
        setInterval(perbaruiSensor, 4000);
    </script>
</body>
</html>