@extends('user.layouts.app')

@section('title', 'Cek Status Pesanan')

@section('styles')
<style>
    .hero-cek {
        background: linear-gradient(135deg, #1a2340 0%, #1e6fff 100%);
        padding: 70px 0 50px;
        color: #fff;
    }
    .cek-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 8px 40px rgba(30,111,255,0.15);
    }
    .input-telp {
        border-radius: 50px 0 0 50px;
        border: 2px solid #e2e8f0;
        border-right: none;
        padding: 14px 22px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }
    .input-telp:focus {
        border-color: #1e6fff;
        box-shadow: none;
        outline: none;
    }
    .btn-cari {
        background: #1e6fff;
        color: #fff;
        border-radius: 0 50px 50px 0;
        border: 2px solid #1e6fff;
        padding: 14px 30px;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.2s;
    }
    .btn-cari:hover { background: #1455d9; border-color: #1455d9; color: #fff; }

    /* TRANSAKSI CARDS */
    .trx-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(30,111,255,0.08);
        transition: box-shadow 0.2s;
        overflow: hidden;
    }
    .trx-card:hover {
        box-shadow: 0 8px 30px rgba(30,111,255,0.18);
    }
    .trx-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f0f4ff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .badge-status {
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 0.82rem;
        font-weight: 600;
    }
    .status-proses   { background:#fff3cd; color:#856404; }
    .status-selesai  { background:#d1e7dd; color:#0f5132; }
    .status-diambil  { background:#cff4fc; color:#055160; }
    .status-batal    { background:#f8d7da; color:#842029; }

    /* TIMELINE */
    .timeline-wrap {
        display: flex;
        align-items: center;
        gap: 0;
        margin: 16px 0;
    }
    .tl-step {
        flex: 1;
        text-align: center;
        position: relative;
    }
    .tl-step::before {
        content: '';
        position: absolute;
        top: 14px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
    }
    .tl-step:last-child::before { display: none; }
    .tl-dot {
        width: 28px; height: 28px;
        border-radius: 50%;
        border: 3px solid #e2e8f0;
        background: #fff;
        margin: 0 auto 6px;
        position: relative; z-index: 1;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.7rem;
    }
    .tl-dot.active { border-color: #1e6fff; background: #1e6fff; color: #fff; }
    .tl-dot.done   { border-color: #198754; background: #198754; color: #fff; }
    .tl-label { font-size: 0.72rem; color: #718096; }

    .empty-state { text-align: center; padding: 60px 20px; }
    .no-result-icon { font-size: 5rem; margin-bottom: 16px; }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero-cek">
    <div class="container text-center">
        <nav aria-label="breadcrumb" class="mb-3 d-flex justify-content-center">
            <ol class="breadcrumb" style="font-size:0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="text-white-50">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Cek Status</li>
            </ol>
        </nav>
        <div style="font-size:3rem;">🔍</div>
        <h1 class="fw-bold mt-2 mb-2" style="font-size:2.2rem;">Cek Status Pesanan</h1>
        <p style="color:rgba(255,255,255,0.8);">Masukkan nomor telepon yang kamu daftarkan di laundry kami</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                {{-- FORM CEK --}}
                <div class="card cek-card p-5 mb-5">
                    <h5 class="fw-bold mb-1">Masukkan Nomor Telepon</h5>
                    <p class="text-muted mb-4" style="font-size:0.9rem;">Nomor telepon yang kamu gunakan saat mendaftar sebagai pelanggan</p>

                    <form method="POST" action="{{ route('user.hasil-cek-status') }}">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill border-2 border-end-0 bg-white px-4" style="border-color:#e2e8f0;">
                                <i class="bi bi-telephone text-primary"></i>
                            </span>
                            <input
                                type="tel"
                                name="no_telepon"
                                class="form-control input-telp border-2 rounded-0"
                                placeholder="Contoh: 081234567890"
                                value="{{ old('no_telepon', request()->old('no_telepon')) }}"
                                required
                            >
                            <button type="submit" class="btn btn-cari">
                                <i class="bi bi-search me-1"></i>Cek Sekarang
                            </button>
                        </div>
                        @error('no_telepon')
                        <div class="text-danger mt-2" style="font-size:0.85rem;"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </form>

                    <div class="mt-4 p-3 rounded-3" style="background:#f0f6ff;">
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">
                            <i class="bi bi-info-circle me-2 text-primary"></i>
                            Tidak ingat nomor telepon yang didaftarkan? Hubungi kasir kami untuk bantuan.
                        </p>
                    </div>
                </div>

                {{-- HASIL --}}
                @if(isset($pelanggan))
                    @if($pelanggan && $transaksis->count() > 0)
                    {{-- INFO PELANGGAN --}}
                    <div class="alert border-0 rounded-3 mb-4 p-4" style="background:#e8f0fe;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:50px; height:50px; border-radius:50%; background:#1e6fff; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.3rem; font-weight:700; flex-shrink:0;">
                                {{ strtoupper(substr($pelanggan->nama_pelanggan, 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $pelanggan->nama_pelanggan }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-telephone me-1"></i>{{ $pelanggan->no_telepon }}
                                    &nbsp;|&nbsp;
                                    <i class="bi bi-receipt me-1"></i>{{ $transaksis->count() }} transaksi ditemukan
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- DAFTAR TRANSAKSI --}}
                    <h6 class="fw-bold mb-3">Riwayat Pesanan</h6>
                    <div class="d-flex flex-column gap-3">
                        @foreach($transaksis as $trx)
                        @php
                            $statusClass = [
                                'Proses'  => 'status-proses',
                                'Selesai' => 'status-selesai',
                                'Diambil' => 'status-diambil',
                                'Batal'   => 'status-batal',
                            ][$trx->status_transaksi] ?? 'status-proses';

                            $statusIcon = [
                                'Proses'  => 'bi-hourglass-split',
                                'Selesai' => 'bi-check-circle',
                                'Diambil' => 'bi-bag-check',
                                'Batal'   => 'bi-x-circle',
                            ][$trx->status_transaksi] ?? 'bi-clock';

                            $steps = ['Proses', 'Selesai', 'Diambil'];
                            $currentStep = array_search($trx->status_transaksi, $steps);
                        @endphp

                        <div class="card trx-card">
                            <div class="trx-header">
                                <div>
                                    <span class="text-muted" style="font-size:0.78rem;">No. Transaksi</span>
                                    <h6 class="fw-bold mb-0">#{{ str_pad($trx->id_transaksi, 5, '0', STR_PAD_LEFT) }}</h6>
                                </div>
                                <span class="badge-status {{ $statusClass }}">
                                    <i class="bi {{ $statusIcon }} me-1"></i>{{ $trx->status_transaksi }}
                                </span>
                            </div>
                            <div class="p-4">
                                {{-- TIMELINE PROGRESS (hanya jika bukan Batal) --}}
                                @if($trx->status_transaksi !== 'Batal')
                                <div class="timeline-wrap mb-3">
                                    @foreach($steps as $si => $stepLabel)
                                    <div class="tl-step">
                                        <div class="tl-dot {{ $si < $currentStep ? 'done' : ($si == $currentStep ? 'active' : '') }}">
                                            @if($si < $currentStep)
                                            <i class="bi bi-check"></i>
                                            @elseif($si == $currentStep)
                                            <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                                            @endif
                                        </div>
                                        <div class="tl-label">{{ $stepLabel }}</div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                <div class="row g-3" style="font-size:0.88rem;">
                                    <div class="col-6">
                                        <div class="text-muted">Tanggal Masuk</div>
                                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted">Estimasi Selesai</div>
                                        <div class="fw-semibold">{{ $trx->tanggal_selesai ? \Carbon\Carbon::parse($trx->tanggal_selesai)->format('d M Y') : '-' }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted">Jenis Layanan</div>
                                        <div class="fw-semibold">
                                            {{ $trx->detail->count() }} item layanan
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted">Total Bayar</div>
                                        <div class="fw-bold" style="color:#1e6fff;">
                                            Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('user.detail-transaksi', $trx->id_transaksi) }}"
                                       class="btn w-100 rounded-pill py-2"
                                       style="background:#f0f6ff; color:#1e6fff; font-weight:600; font-size:0.88rem; border:none;">
                                        <i class="bi bi-eye me-2"></i>Lihat Detail Pesanan
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @else
                    {{-- TIDAK DITEMUKAN --}}
                    <div class="empty-state">
                        <div class="no-result-icon">😕</div>
                        <h5 class="fw-bold">Data Tidak Ditemukan</h5>
                        <p class="text-muted">
                            @if(!$pelanggan)
                            Nomor telepon <strong>{{ request('no_telepon') }}</strong> tidak terdaftar sebagai pelanggan kami.
                            @else
                            Belum ada transaksi untuk nomor ini.
                            @endif
                        </p>
                        <p class="text-muted" style="font-size:0.9rem;">Pastikan nomor yang dimasukkan benar, atau hubungi kasir kami untuk bantuan.</p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn rounded-pill px-4 mt-2" style="background:#25d366; color:#fff;">
                            <i class="bi bi-whatsapp me-2"></i>Hubungi via WhatsApp
                        </a>
                    </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</section>

@endsection
