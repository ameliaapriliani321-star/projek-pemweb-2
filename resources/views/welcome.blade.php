<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kilat Laundry</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-blue-700">
                🧺 Kilat Laundry
            </h1>

            <div class="space-x-6 hidden md:flex items-center">
                <a href="#fitur" class="hover:text-blue-600">Fitur</a>
                <a href="#layanan" class="hover:text-blue-600">Layanan</a>
                <a href="#galeri" class="hover:text-blue-600">Galeri</a>

                <a href="/admin"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    Login Admin
                </a>
            </div>

        </div>
    </nav>

    <!-- HERO -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            <div>

                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    Solusi Laundry Cepat, Bersih & Terpercaya
                </h1>

                <p class="mt-6 text-xl text-blue-100">
                    Kelola layanan laundry dengan mudah menggunakan Sistem Informasi Kilat Laundry berbasis Laravel dan Filament.
                </p>

                <div class="mt-8 flex gap-4">

                    <a href="/admin"
                       class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Login Admin
                    </a>

                    <a href="#layanan"
                       class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-700 transition">
                        Lihat Layanan
                    </a>

                </div>

            </div>

            <div>
                <img
                    src="{{ asset('images/3.jpeg') }}"
                    alt="Laundry"
                    class="w-full h-[450px] object-cover rounded-3xl shadow-2xl"
                >
            </div>

        </div>

    </section>

    <!-- STATISTIK -->
    <section class="-mt-10 relative z-10">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl p-6 shadow">
                    <h3 class="text-gray-500">Pelanggan</h3>
                    <p class="text-3xl font-bold text-blue-700">250+</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow">
                    <h3 class="text-gray-500">Transaksi</h3>
                    <p class="text-3xl font-bold text-blue-700">1.200+</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow">
                    <h3 class="text-gray-500">Layanan</h3>
                    <p class="text-3xl font-bold text-blue-700">10+</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow">
                    <h3 class="text-gray-500">Pegawai</h3>
                    <p class="text-3xl font-bold text-blue-700">5</p>
                </div>

            </div>

        </div>

    </section>

    <!-- FITUR -->
    <section id="fitur" class="max-w-7xl mx-auto py-20 px-6">

        <h2 class="text-4xl font-bold text-center mb-12">
            Kenapa Memilih Kami?
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white p-8 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="font-bold text-2xl mb-3">Proses Cepat</h3>
                <p class="text-gray-600">
                    Pengerjaan laundry lebih cepat dengan kualitas terbaik.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
                <div class="text-5xl mb-4">🧼</div>
                <h3 class="font-bold text-2xl mb-3">Bersih & Wangi</h3>
                <p class="text-gray-600">
                    Menggunakan deterjen premium dan pewangi berkualitas.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
                <div class="text-5xl mb-4">🚚</div>
                <h3 class="font-bold text-2xl mb-3">Antar Jemput</h3>
                <p class="text-gray-600">
                    Layanan antar jemput untuk memudahkan pelanggan.
                </p>
            </div>

        </div>

    </section>

    <!-- LAYANAN -->
    <section id="layanan" class="bg-white py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-12">
                Layanan Laundry
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="border rounded-2xl p-8 hover:bg-blue-50 transition">
                    <h3 class="text-2xl font-bold text-blue-700">👕 Cuci Kiloan</h3>
                    <p class="mt-3 text-gray-600">Mulai Rp10.000 / Kg</p>
                </div>

                <div class="border rounded-2xl p-8 hover:bg-blue-50 transition">
                    <h3 class="text-2xl font-bold text-blue-700">👔 Cuci Setrika</h3>
                    <p class="mt-3 text-gray-600">Pakaian bersih dan rapi.</p>
                </div>

                <div class="border rounded-2xl p-8 hover:bg-blue-50 transition">
                    <h3 class="text-2xl font-bold text-blue-700">⚡ Express</h3>
                    <p class="mt-3 text-gray-600">Selesai dalam hitungan jam.</p>
                </div>

            </div>

        </div>

    </section>

    <!-- GALERI -->
    <section id="galeri" class="bg-gray-100 py-20">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center mb-4">
                Galeri Kilat Laundry
            </h2>

            <p class="text-center text-gray-500 mb-12">
                Dokumentasi kegiatan dan layanan kami
            </p>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="group overflow-hidden rounded-3xl shadow-lg bg-white">
                    <img src="{{ asset('images/1.jpeg') }}"
                         class="w-full h-80 object-cover transition duration-500 group-hover:scale-110">
                </div>

                <div class="group overflow-hidden rounded-3xl shadow-lg bg-white">
                    <img src="{{ asset('images/2.jpeg') }}"
                         class="w-full h-80 object-cover transition duration-500 group-hover:scale-110">
                </div>

                <div class="group overflow-hidden rounded-3xl shadow-lg bg-white">
                    <img src="{{ asset('images/4.jpeg') }}"
                         class="w-full h-80 object-cover transition duration-500 group-hover:scale-110">
                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white py-12">

        <div class="max-w-7xl mx-auto text-center px-6">

            <h2 class="text-3xl font-bold">
                🧺 Kilat Laundry
            </h2>

            <p class="mt-4">
                Jl. Situ Indah 116, Tugu, Cimanggis, Depok
            </p>

            <p>
                WhatsApp : 0899-8666-458
            </p>

            <p class="mt-6 text-blue-200">
                © 2026 Kilat Laundry | Laravel 12 + Filament
            </p>

        </div>

    </footer>

</body>
</html>
```
