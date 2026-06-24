@extends('user.layouts.app')

@section('title', 'Beranda')

@section('styles')
<style>
    /* ===== HERO ===== */
    .hero {
        padding: 100px 0 80px;
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(79,70,229,0.06) 0%, transparent 70%);
        top: -200px; right: -100px;
        border-radius: 50%;
    }
    .hero::after {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(6,182,212,0.05) 0%, transparent 70%);
        bottom: -100px; left: -100px;
        border-radius: 50%;
    }
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 50px;
        padding: 6px 14px 6px 8px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .hero-tag .tag-dot {
        width: 8px; height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    .hero-title {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1.1;
        color: var(--dark);
        letter-spacing: -1.5px;
    }
    .hero-title .gradient-text {
        background: linear-gradient(135deg, var(--primary), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-desc {
        font-size: 1.1rem;
        color: var(--gray-600);
        line-height: 1.7;
        max-width: 480px;
    }
    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s;
        box-shadow: 0 4px 16px rgba(79,70,229,0.3);
    }
    .hero-cta:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(79,70,229,0.35);
        color: #fff;
    }
    .hero-cta-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-600);
        text-decoration: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1.5px solid var(--gray-200);
        transition: all 0.2s;
    }
    .hero-cta-secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
    }
    .hero-visual {
        position: relative;
    }
    .hero-card-main {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.04);
        border: 1px solid var(--gray-100);
    }
    .hero-card-float {
        position: absolute;
        background: #fff;
        border-radius: 14px;
        padding: 14px 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        border: 1px solid var(--gray-100);
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    /* ===== STATS ===== */
    .stats-section {
        padding: 64px 0;
        background: #fff;
    }
    .stat-item {
        text-align: center;
        padding: 24px;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--dark);
        letter-spacing: -1px;
        line-height: 1;
    }
    .stat-label {
        font-size: 0.82rem;
        color: var(--gray-400);
        font-weight: 500;
        margin-top: 6px;
    }

    /* ===== SERVICES ===== */
    .services-section {
        padding: 80px 0;
        background: var(--gray-50);
    }
    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--primary);
        margin-bottom: 12px;
    }
    .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark);
        letter-spacing: -0.8px;
        line-height: 1.2;
    }
    .section-desc {
        font-size: 1rem;
        color: var(--gray-600);
        max-width: 500px;
    }
    .service-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 16px;
        padding: 28px;
        transition: all 0.25s;
        height: 100%;
    }
    .service-card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 12px 32px rgba(79,70,229,0.08);
        transform: translateY(-4px);
    }
    .service-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 16px;
    }
    .service-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 4px;
    }
    .service-cat {
        font-size: 0.75rem;
        color: var(--gray-400);
        margin-bottom: 12px;
    }
    .service-price {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--primary);
    }
    .service-unit {
        font-size: 0.75rem;
        color: var(--gray-400);
        font-weight: 500;
    }

    /* ===== HOW IT WORKS ===== */
    .how-section {
        padding: 80px 0;
        background: #fff;
    }
    .step-card {
        text-align: center;
        padding: 32px 24px;
        position: relative;
    }
    .step-num {
        width: 56px; height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 20px rgba(79,70,229,0.25);
    }
    .step-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }
    .step-desc {
        font-size: 0.85rem;
        color: var(--gray-600);
        line-height: 1.6;
    }

    /* ===== CTA ===== */
    .cta-section {
        padding: 80px 0;
        background: var(--gray-50);
    }
    .cta-card {
        background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
        border-radius: 24px;
        padding: 64px;
        position: relative;
        overflow: hidden;
    }
    .cta-card::before {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(79,70,229,0.2) 0%, transparent 70%);
        top: -100px; right: -50px;
        border-radius: 50%;
    }
    .cta-card::after {
        content: '';
        position: absolute;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(6,182,212,0.15) 0%, transparent 70%);
        bottom: -80px; left: 50px;
        border-radius: 50%;
    }
    .cta-title {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
    }
    .cta-desc {
        color: var(--gray-400);
        font-size: 1rem;
    }

    /* ===== FEATURES ===== */
    .features-section {
        padding: 80px 0;
        background: #fff;
    }
    .feature-card {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 24px;
        border-radius: 14px;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    .feature-card:hover {
        background: var(--gray-50);
        border-color: var(--gray-100);
    }
    .feature-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .feature-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 4px;
    }
    .feature-desc {
        font-size: 0.82rem;
        color: var(--gray-600);
        line-height: 1.6;
        margin: 0;
    }
</style>
@endsection

@section('content')

{{-- ===== HERO ===== --}}
<section class="hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-tag">
                    <span class="tag-dot"></span>
                    Layanan Laundry Terpercaya Sejak 2020
                </div>
                <h1 class="hero-title">
                    Cucian Bersih<br>
                    <span class="gradient-text">Tanpa Ribet</span>
                </h1>
                <p class="hero-desc mt-3 mb-4">
                    Titipkan cucian Anda ke kami. Kami proses dengan cepat, bersih, dan harum. Pantau status pesanan kapan saja secara online.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('register') }}" class="hero-cta">
                        Mulai Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('user.layanan') }}" class="hero-cta-secondary">
                        <i class="bi bi-grid-3x3-gap"></i> Lihat Layanan
                    </a>
                </div>
                <div class="d-flex flex-wrap gap-4 mt-2" style="font-size:0.82rem; color:var(--gray-600);">
                    <span><i class="bi bi-check-circle-fill me-1" style="color:#10b981;"></i>Express 6 Jam</span>
                    <span><i class="bi bi-check-circle-fill me-1" style="color:#10b981;"></i>Antar Jemput</span>
                    <span><i class="bi bi-check-circle-fill me-1" style="color:#10b981;"></i>Garansi Bersih</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual">
                    <div class="hero-card-main">
                        <div class="text-center">
                            <div style="font-size:4rem; margin-bottom:16px;">🧺</div>
                            <h4 class="fw-bold mb-2" style="color:var(--dark); letter-spacing:-0.3px;">Kilat Laundry</h4>
                            <p style="color:var(--gray-400); font-size:0.88rem;">Cepat • Bersih • Terpercaya</p>
                            <div class="d-flex justify-content-center gap-4 mt-4">
                                <div class="text-center">
                                    <div style="font-size:1.5rem; font-weight:800; color:var(--primary);">{{ $totalLayanan }}+</div>
                                    <div style="font-size:0.72rem; color:var(--gray-400);">Layanan</div>
                                </div>
                                <div style="width:1px; background:var(--gray-200);"></div>
                                <div class="text-center">
                                    <div style="font-size:1.5rem; font-weight:800; color:var(--accent);">{{ $totalPelanggan }}+</div>
                                    <div style="font-size:0.72rem; color:var(--gray-400);">Pelanggan</div>
                                </div>
                                <div style="width:1px; background:var(--gray-200);"></div>
                                <div class="text-center">
                                    <div style="font-size:1.5rem; font-weight:800; color:#10b981;">4.9</div>
                                    <div style="font-size:0.72rem; color:var(--gray-400);">Rating</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-card-float" style="top:-10px; right:-20px;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:28px; height:28px; background:#d1fae5; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-check2" style="color:#059669; font-size:0.85rem;"></i>
                            </div>
                            <span style="font-size:0.78rem; font-weight:600; color:var(--dark);">Pesanan Selesai!</span>
                        </div>
                    </div>
                    <div class="hero-card-float" style="bottom:20px; left:-30px; animation-delay:1.5s;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:28px; height:28px; background:#ede9fe; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-lightning-fill" style="color:var(--primary); font-size:0.85rem;"></i>
                            </div>
                            <span style="font-size:0.78rem; font-weight:600; color:var(--dark);">Express Ready</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS BAR ===== --}}
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">{{ $totalLayanan }}+</div>
                    <div class="stat-label">Jenis Layanan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">{{ $totalTransaksi }}+</div>
                    <div class="stat-label">Transaksi Selesai</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">{{ $totalPelanggan }}+</div>
                    <div class="stat-label">Pelanggan Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">4.9<span style="font-size:1rem;">⭐</span></div>
                    <div class="stat-label">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SERVICES ===== --}}
<section class="services-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag"><i class="bi bi-grid-3x3-gap-fill"></i> LAYANAN KAMI</div>
            <h2 class="section-heading">Layanan Unggulan</h2>
            <p class="section-desc mx-auto mt-2">Pilihan layanan laundry terbaik sesuai kebutuhanmu</p>
        </div>
        <div class="row g-4">
            @foreach($layanan as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="service-card">
                    <div class="service-icon" style="background:{{ ['#ede9fe','#dbeafe','#d1fae5','#fef3c7','#fee2e2','#e0e7ff','#fce7f3','#ccfbf1'][$loop->index % 8] }};">
                        @php
                            $icons = ['🧺','👕','🧦','🥼','👔','🧥','🛏️','🎽'];
                            echo $icons[$loop->index % count($icons)];
                        @endphp
                    </div>
                    <div class="service-cat">{{ $item->kategori->nama_kategori ?? '-' }}</div>
                    <div class="service-name">{{ $item->nama_layanan }}</div>
                    <div class="mt-2">
                        <span class="service-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span class="service-unit"> / {{ $item->satuan }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('user.layanan') }}" class="hero-cta-secondary text-decoration-none">
                Lihat Semua Layanan <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="how-section" id="cara-kerja">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag"><i class="bi bi-signpost-2-fill"></i> CARA KERJA</div>
            <h2 class="section-heading">4 Langkah Mudah</h2>
            <p class="section-desc mx-auto mt-2">Proses laundry yang simpel dan transparan</p>
        </div>
        <div class="row g-4">
            @php
            $steps = [
                ['num'=>'1', 'title'=>'Pesan Online', 'desc'=>'Daftar akun, pilih layanan yang kamu butuhkan dan buat pesanan dari mana saja'],
                ['num'=>'2', 'title'=>'Antar Cucian', 'desc'=>'Antar cucianmu ke outlet kami atau gunakan layanan jemput gratis'],
                ['num'=>'3', 'title'=>'Proses Laundry', 'desc'=>'Cucian diproses oleh tim profesional dengan deterjen premium berkualitas'],
                ['num'=>'4', 'title'=>'Ambil/Diantar', 'desc'=>'Cucian selesai! Ambil di outlet atau kami antar sampai depan rumahmu'],
            ];
            @endphp
            @foreach($steps as $step)
            <div class="col-lg-3 col-sm-6">
                <div class="step-card">
                    <div class="step-num">{{ $step['num'] }}</div>
                    <h6 class="step-title">{{ $step['title'] }}</h6>
                    <p class="step-desc">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FEATURES ===== --}}
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-tag"><i class="bi bi-stars"></i> KEUNGGULAN</div>
            <h2 class="section-heading">Kenapa Pilih Kilat Laundry?</h2>
        </div>
        <div class="row g-3">
            @php
            $features = [
                ['icon'=>'bi-lightning-charge-fill', 'bg'=>'#fef3c7', 'color'=>'#d97706', 'title'=>'Express 6 Jam', 'desc'=>'Layanan super cepat untuk kebutuhan mendesak. Cucian siap dalam hitungan jam.'],
                ['icon'=>'bi-shield-check', 'bg'=>'#d1fae5', 'color'=>'#059669', 'title'=>'Aman & Terjamin', 'desc'=>'Setiap pakaian dijaga dengan hati-hati. Garansi cuci ulang gratis.'],
                ['icon'=>'bi-wallet2', 'bg'=>'#dbeafe', 'color'=>'#2563eb', 'title'=>'Harga Terjangkau', 'desc'=>'Mulai Rp 5.000/kg. Tersedia paket hemat bulanan untuk pengguna rutin.'],
                ['icon'=>'bi-truck', 'bg'=>'#fce7f3', 'color'=>'#db2777', 'title'=>'Antar Jemput Gratis', 'desc'=>'Kami jemput dan antar cucian ke rumahmu tanpa biaya tambahan.'],
                ['icon'=>'bi-phone', 'bg'=>'#ede9fe', 'color'=>'#7c3aed', 'title'=>'Pantau Online', 'desc'=>'Cek status cucian real-time lewat website atau dashboard pelanggan.'],
                ['icon'=>'bi-heart', 'bg'=>'#fee2e2', 'color'=>'#dc2626', 'title'=>'Wangi Tahan Lama', 'desc'=>'Pewangi premium pilihan yang membuat pakaian wangi berhari-hari.'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:{{ $f['bg'] }}; color:{{ $f['color'] }};">
                        <i class="bi {{ $f['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="feature-title">{{ $f['title'] }}</div>
                        <p class="feature-desc">{{ $f['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="cta-section">
    <div class="container">
        <div class="cta-card text-center position-relative">
            <div class="position-relative" style="z-index:1;">
                <h2 class="cta-title mb-3">Siap Laundry Tanpa Ribet?</h2>
                <p class="cta-desc mb-4">Daftar sekarang dan nikmati kemudahan laundry online. Gratis pendaftaran!</p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="hero-cta">
                        Daftar Gratis <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('user.cek-status') }}" class="hero-cta-secondary" style="border-color:rgba(255,255,255,0.2); color:#fff;">
                        <i class="bi bi-search"></i> Cek Status Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
