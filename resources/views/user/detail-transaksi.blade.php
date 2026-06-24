@extends('user.layouts.app')

@section('title', 'Detail Pesanan #' . str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT))

@section('styles')
<style>
    .hero-detail {
        background: linear-gradient(135deg, #1a2340 0%, #1e6fff 100%);
        padding: 50px 0 30px;
        color: #fff;
    }
    .detail-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30,111,255,0.10);
    }
    .info-label {
        font-size: 0.8rem;
        color: #a0aec0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a2340;
    }

    /* BADGE STATUS */
    .status-proses   { background:#fff3cd; color:#856404; }
    .status-selesai  { background:#d1e7dd; color:#0f5132; }
    .status-diambil  { background:#cff4fc; color:#055160; }
    .status-batal    { background:#f8d7da; color:#842029; }

    /* TIMELINE */
    .steps-container {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 20px 0;
    }
    .steps-container::before {
        content: '';
        position: absolute;
        top: 36px;
        left: 10%;
        right: 10%;
        height: 3px;
        background: #e2e8f0;
        z-index: 0;
    }
    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .step-dot {
        width: 36px; height: 36px;
        border-radius: 50%;
        border: 3px solid #e2e8f0;
        background: #fff;
        margin: 0 auto 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    .step-dot.done   { border-color: #198754; background: #198754; color: #fff; }
    .step-dot.active { border-color: #1e6fff; background: #1e6fff; color: #fff; }
    .step-label { font-size: 0.78rem; color: #718096; font-weight: 500; }
    .step-label.done   { color: #198754; font-weight: 600; }
    .step-label.active { color: #1e6fff; font-weight: 600; }

    /* TABLE DETAIL */
    .detail-table th {
        background: #f8faff;
        font-weight: 600;
        font-size: 0.85rem;
        color: #4a5568;
        border: none;
        padding: 12px 16px;
    }
    .detail-table td {
        border-color: #f0f4ff;
        padding: 12px 16px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .total-row {
        background: #f0f6ff;
        font-weight: 700;
    }

    /* PEMBAYARAN */
    .bayar-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #d1e7dd;
        color: #0f5132;
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 0.82rem;
        font-weight: 600;
    }

    @media print {
        .no-print { display: none !important; }
        .hero-detail { background: #1e6fff !important; -webkit-print-color-adjust: exact; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero-detail">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="font-size:0.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="text-white-50">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.cek-status') }}" class="text-white-50">Cek Status</a></li>
                <li class="breadcrumb-item active text-white">Detail Pesanan</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="fw-bold mb-1" style="font-size:1.8rem;">
                    Pesanan #{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                </h1>
                <p class="mb-0" style="color:rgba(255,255,255,0.8); font-size:0.9rem;">
                    Diterima {{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->format('d F Y, H:i') }}
                </p>
            </div>
            @php
                $statusClass = [
                    'Proses'  => 'status-proses',
                    'Selesai' => 'status-selesai',
                    'Diambil' => 'status-diambil',
                    'Batal'   => 'status-batal',
                ][$transaksi->status_transaksi] ?? 'status-proses';
            @endphp
            <span class="badge {{ $statusClass }} rounded-pill px-4 py-2" style="font-size:0.95rem;">
                {{ $transaksi->status_transaksi }}
            </span>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">

        {{-- TOMBOL --}}
        <div class="d-flex gap-2 mb-4 no-print">
            <a href="{{ route('user.cek-status') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-printer me-2"></i>Cetak / Simpan
            </button>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">

                {{-- PROGRESS TIMELINE --}}
                @if($transaksi->status_transaksi !== 'Batal')
                <div class="card detail-card p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-bar-chart-steps me-2 text-primary"></i>Status Progres</h6>
                    @php
                        $steps = [
                            ['label'=>'Diterima',  'icon'=>'bi-inbox',          'key'=>null],
                            ['label'=>'Proses',    'icon'=>'bi-hourglass-split', 'key'=>'Proses'],
                            ['label'=>'Selesai',   'icon'=>'bi-check-circle',    'key'=>'Selesai'],
                            ['label'=>'Diambil',   'icon'=>'bi-bag-check',       'key'=>'Diambil'],
                        ];
                        $statusOrder = [null => 0, 'Proses' => 1, 'Selesai' => 2, 'Diambil' => 3];
                        $currentOrder = $statusOrder[$transaksi->status_transaksi] ?? 1;
                    @endphp
                    <div class="steps-container">
                        @foreach($steps as $si => $step)
                        @php
                            $isDone   = $si < $currentOrder;
                            $isActive = $si === $currentOrder;
                        @endphp
                        <div class="step-item">
                            <div class="step-dot {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                                @if($isDone)
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi {{ $step['icon'] }}" style="font-size:0.85rem;"></i>
                                @endif
                            </div>
                            <div class="step-label {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                                {{ $step['label'] }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($transaksi->status_transaksi === 'Selesai')
                    <div class="alert alert-success border-0 rounded-3 mt-2 mb-0" style="font-size:0.88rem;">
                        <i class="bi bi-check-circle me-2"></i>
                        Cucian kamu sudah <strong>selesai</strong>! Silakan ambil di outlet kami.
                    </div>
                    @elseif($transaksi->status_transaksi === 'Proses')
                    <div class="alert alert-warning border-0 rounded-3 mt-2 mb-0" style="font-size:0.88rem;">
                        <i class="bi bi-hourglass-split me-2"></i>
                        Cucian kamu sedang <strong>diproses</strong>. Estimasi selesai: <strong>{{ $transaksi->tanggal_selesai ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d M Y') : '-' }}</strong>
                    </div>
                    @endif
                </div>
                @else
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <i class="bi bi-x-circle me-2"></i>
                    Transaksi ini telah <strong>dibatalkan</strong>.
                </div>
                @endif

                {{-- DETAIL LAYANAN --}}
                <div class="card detail-card mb-4">
                    <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
                        <h6 class="fw-bold mb-0"><i class="bi bi-list-check me-2 text-primary"></i>Detail Layanan</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table detail-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Layanan</th>
                                        <th>Jumlah</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksi->detail as $i => $detail)
                                    <tr>
                                        <td class="text-muted">{{ $i + 1 }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $detail->layanan->nama_layanan ?? '-' }}</div>
                                            <small class="text-muted">
                                                Rp {{ number_format($detail->layanan->harga ?? 0, 0, ',', '.') }} / {{ $detail->layanan->satuan ?? '' }}
                                            </small>
                                        </td>
                                        <td>{{ $detail->jumlah }} {{ $detail->layanan->satuan ?? '' }}</td>
                                        <td class="text-end fw-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Tidak ada detail layanan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="total-row">
                                        <td colspan="3" class="text-end fw-bold" style="border:none;">Total Bayar</td>
                                        <td class="text-end fw-bold" style="color:#1e6fff; font-size:1.05rem; border:none;">
                                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- PEMBAYARAN --}}
                @if($transaksi->pembayaran->count() > 0)
                <div class="card detail-card">
                    <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
                        <h6 class="fw-bold mb-0"><i class="bi bi-credit-card me-2 text-primary"></i>Riwayat Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        @foreach($transaksi->pembayaran as $bayar)
                        <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-2" style="background:#f8faff;">
                            <div>
                                <div class="fw-semibold" style="font-size:0.9rem;">{{ $bayar->metode_pembayaran }}</div>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y, H:i') }}</small>
                            </div>
                            <div class="text-end">
                                <span class="bayar-badge"><i class="bi bi-check-circle"></i>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- SIDEBAR INFO --}}
            <div class="col-lg-4">

                {{-- INFO PELANGGAN --}}
                <div class="card detail-card p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-person-circle me-2 text-primary"></i>Info Pelanggan</h6>
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <div class="info-label">Nama</div>
                            <div class="info-value">{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="info-label">No. Telepon</div>
                            <div class="info-value">{{ $transaksi->pelanggan->no_telepon ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ $transaksi->pelanggan->alamat ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- INFO TRANSAKSI --}}
                <div class="card detail-card p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-receipt me-2 text-primary"></i>Info Transaksi</h6>
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <div class="info-label">No. Transaksi</div>
                            <div class="info-value">#{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div>
                            <div class="info-label">Tanggal Masuk</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->format('d M Y, H:i') }}</div>
                        </div>
                        <div>
                            <div class="info-label">Estimasi Selesai</div>
                            <div class="info-value">{{ $transaksi->tanggal_selesai ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d M Y') : '-' }}</div>
                        </div>
                        <div>
                            <div class="info-label">Kasir / Pegawai</div>
                            <div class="info-value">{{ $transaksi->pegawai->nama_pegawai ?? '-' }}</div>
                        </div>
                        <hr class="my-1">
                        <div>
                            <div class="info-label">Total Bayar</div>
                            <div class="fw-bold mt-1" style="color:#1e6fff; font-size:1.2rem;">
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BUTUH BANTUAN --}}
                <div class="card detail-card p-4" style="background:linear-gradient(135deg, #1e6fff, #00c4cc); border:none;">
                    <h6 class="fw-bold text-white mb-2"><i class="bi bi-headset me-2"></i>Butuh Bantuan?</h6>
                    <p class="text-white mb-3" style="font-size:0.85rem; opacity:0.9;">Ada pertanyaan tentang pesananmu? Hubungi kami langsung.</p>
                    <a href="https://wa.me/6281234567890?text=Halo, saya ingin tanya tentang pesanan %23{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}" target="_blank"
                       class="btn btn-light w-100 rounded-pill fw-semibold" style="color:#1e6fff; font-size:0.88rem;">
                        <i class="bi bi-whatsapp me-2"></i>Chat via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
