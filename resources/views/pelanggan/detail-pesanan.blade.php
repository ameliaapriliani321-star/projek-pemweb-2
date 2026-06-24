@extends('pelanggan.layouts.app')

@section('title', 'Detail Pesanan')
@section('subtitle', 'Pesanan #' . $transaksi->id_transaksi)

@section('styles')
<style>
    .timeline-step {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        position: relative;
    }
    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 13px;
        top: 36px;
        bottom: -4px;
        width: 2px;
        background: var(--border);
    }
    .timeline-step.completed:not(:last-child)::after {
        background: linear-gradient(180deg, var(--primary), var(--accent));
    }
    .timeline-dot {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #fff;
        transition: var(--transition);
    }
    .timeline-step.completed .timeline-dot {
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-color: transparent;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
    }
    .timeline-step.completed .timeline-dot i {
        color: #fff;
        font-size: 0.7rem;
    }
    .timeline-step .timeline-dot i {
        color: var(--text-muted);
        font-size: 0.6rem;
    }
    .timeline-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-top: 4px;
    }
    .timeline-step:not(.completed) .timeline-label {
        color: var(--text-muted);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .info-item label {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--text-muted);
        margin-bottom: 4px;
        display: block;
    }
    .info-item span {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-primary);
    }
</style>
@endsection

@section('content')

<a href="{{ route('pelanggan.pesanan') }}" class="text-decoration-none d-inline-flex align-items-center gap-1 mb-4"
   style="font-size:0.82rem; color:var(--text-secondary); font-weight:500;">
    <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
</a>

<div class="row g-4">
    {{-- Main Content --}}
    <div class="col-lg-8">
        {{-- Order Info --}}
        <div class="card-base mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0" style="font-size:0.95rem;">
                    <i class="bi bi-receipt me-2" style="color:var(--primary);"></i>Informasi Pesanan
                </h6>
                @php
                    $statusColors = [
                        'Proses' => 'badge-proses',
                        'Selesai' => 'badge-selesai',
                        'Diambil' => 'badge-diambil',
                        'Batal' => 'badge-batal',
                    ];
                    $badgeClass = $statusColors[$transaksi->status_transaksi] ?? 'badge-proses';
                @endphp
                <span class="badge-modern {{ $badgeClass }}">{{ $transaksi->status_transaksi }}</span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>ID Pesanan</label>
                    <span>#{{ $transaksi->id_transaksi }}</span>
                </div>
                <div class="info-item">
                    <label>Tanggal Terima</label>
                    <span>{{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                    <label>Tanggal Selesai</label>
                    <span>{{ $transaksi->tanggal_selesai ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d M Y') : '—' }}</span>
                </div>
                <div class="info-item">
                    <label>Ditangani Oleh</label>
                    <span>{{ $transaksi->pegawai->nama_pegawai ?? 'Belum diassign' }}</span>
                </div>
            </div>
        </div>

        {{-- Service Details --}}
        <div class="card-base">
            <h6 class="fw-bold mb-3" style="font-size:0.95rem;">
                <i class="bi bi-list-check me-2" style="color:var(--primary);"></i>Rincian Layanan
            </h6>

            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->detail as $detail)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $detail->layanan->nama_layanan ?? '-' }}</span>
                            </td>
                            <td style="color:var(--text-secondary);">{{ $detail->jumlah }} {{ $detail->layanan->satuan ?? '' }}</td>
                            <td style="color:var(--text-secondary);">Rp {{ number_format($detail->layanan->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end fw-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3 pt-3" style="border-top:1px solid var(--border-light);">
                <div class="text-end">
                    <span style="font-size:0.78rem; color:var(--text-muted); display:block;">Total Pembayaran</span>
                    <span style="font-size:1.4rem; font-weight:800; color:var(--primary); letter-spacing:-0.5px;">
                        Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        {{-- Status Timeline --}}
        <div class="card-base mb-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;">
                <i class="bi bi-signpost-2 me-2" style="color:var(--primary);"></i>Tracking Status
            </h6>

            @php
                $statuses = [
                    'Proses' => ['icon' => 'bi-arrow-repeat', 'label' => 'Sedang Diproses'],
                    'Selesai' => ['icon' => 'bi-check-circle', 'label' => 'Selesai Dikerjakan'],
                    'Diambil' => ['icon' => 'bi-bag-check', 'label' => 'Sudah Diambil'],
                ];
                $statusKeys = array_keys($statuses);
                $currentIndex = array_search($transaksi->status_transaksi, $statusKeys);
                if ($currentIndex === false) $currentIndex = -1;
            @endphp

            <div>
                @foreach($statuses as $key => $info)
                    @php $i = array_search($key, $statusKeys); @endphp
                    <div class="timeline-step {{ $i <= $currentIndex ? 'completed' : '' }}">
                        <div class="timeline-dot">
                            <i class="bi {{ $i <= $currentIndex ? 'bi-check2' : $info['icon'] }}"></i>
                        </div>
                        <div class="timeline-label">{{ $info['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Payment Info --}}
        <div class="card-base">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;">
                <i class="bi bi-wallet2 me-2" style="color:var(--primary);"></i>Pembayaran
            </h6>

            @if($transaksi->pembayaran->isNotEmpty())
                @foreach($transaksi->pembayaran as $bayar)
                    <div class="p-3 rounded-3 mb-2" style="background:var(--bg); border:1px solid var(--border-light);">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:0.75rem; color:var(--text-muted);">Tanggal</span>
                            <span style="font-size:0.8rem; font-weight:600;">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:0.75rem; color:var(--text-muted);">Jumlah</span>
                            <span style="font-size:0.8rem; font-weight:700; color:var(--success);">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="font-size:0.75rem; color:var(--text-muted);">Metode</span>
                            <span style="font-size:0.8rem; font-weight:500;">{{ ucfirst($bayar->metode_pembayaran) }}</span>
                        </div>
                    </div>
                @endforeach
                <div class="text-center mt-3">
                    <span class="badge-modern badge-lunas"><i class="bi bi-check2 me-1"></i>Lunas</span>
                </div>
            @else
                <div class="text-center py-3">
                    <div style="width:48px; height:48px; border-radius:50%; background:#fef3c7; display:flex; align-items:center; justify-content:center; margin:0 auto 10px;">
                        <i class="bi bi-hourglass-split" style="font-size:1.2rem; color:#d97706;"></i>
                    </div>
                    <p class="mb-0" style="font-size:0.82rem; color:var(--text-secondary);">
                        Belum ada pembayaran.<br>
                        <span style="font-size:0.75rem; color:var(--text-muted);">Bayar saat mengambil cucian di outlet.</span>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
