@extends('pelanggan.layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan aktivitas laundry kamu')

@section('content')

{{-- Welcome Banner --}}
<div class="card-base mb-4 p-0 overflow-hidden" style="border:none;">
    <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #06b6d4 100%); padding: 32px 36px; position:relative; overflow:hidden;">
        {{-- Decorative elements --}}
        <div style="position:absolute; top:-40px; right:-40px; width:200px; height:200px; background:rgba(255,255,255,0.06); border-radius:50%;"></div>
        <div style="position:absolute; bottom:-60px; right:80px; width:150px; height:150px; background:rgba(255,255,255,0.04); border-radius:50%;"></div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <div style="font-size:0.8rem; font-weight:600; color:rgba(255,255,255,0.7); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">
                    Selamat Datang Kembali
                </div>
                <h3 class="fw-bold text-white mb-2" style="font-size:1.5rem; letter-spacing:-0.3px;">
                    Halo, {{ $user->name }}! 👋
                </h3>
                <p class="mb-0" style="color:rgba(255,255,255,0.75); font-size:0.9rem;">
                    Atur dan pantau cucian kamu dari sini.
                </p>
            </div>
            <a href="{{ route('pelanggan.pesan') }}" class="btn px-4 py-2 fw-semibold"
               style="background:#fff; color:#4f46e5; border-radius:10px; font-size:0.88rem; box-shadow:0 4px 12px rgba(0,0,0,0.15);">
                <i class="bi bi-plus-lg me-2"></i>Pesan Laundry
            </a>
        </div>
    </div>
</div>

{{-- Stats Grid --}}
<div class="row g-3 mb-4">
    <div class="col-lg-4 col-sm-6">
        <div class="card-base h-100">
            <div class="d-flex align-items-center gap-3">
                <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #ede9fe, #ddd6fe); display:flex; align-items:center; justify-content:center;">
                    <i class="bi bi-receipt-cutoff" style="font-size:1.2rem; color:#7c3aed;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem; font-weight:800; color:var(--text-primary); line-height:1; letter-spacing:-0.5px;">{{ $totalPesanan }}</div>
                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:500; margin-top:2px;">Total Pesanan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card-base h-100">
            <div class="d-flex align-items-center gap-3">
                <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #fef3c7, #fde68a); display:flex; align-items:center; justify-content:center;">
                    <i class="bi bi-arrow-repeat" style="font-size:1.2rem; color:#d97706;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem; font-weight:800; color:var(--text-primary); line-height:1; letter-spacing:-0.5px;">{{ $pesananAktif }}</div>
                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:500; margin-top:2px;">Sedang Diproses</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card-base h-100">
            <div class="d-flex align-items-center gap-3">
                <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg, #d1fae5, #a7f3d0); display:flex; align-items:center; justify-content:center;">
                    <i class="bi bi-check2-all" style="font-size:1.2rem; color:#059669;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem; font-weight:800; color:var(--text-primary); line-height:1; letter-spacing:-0.5px;">{{ $pesananSelesai }}</div>
                    <div style="font-size:0.78rem; color:var(--text-muted); font-weight:500; margin-top:2px;">Selesai</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="card-base">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h6 class="fw-bold mb-0" style="font-size:1rem;">Pesanan Terbaru</h6>
        </div>
        @if(!$recentTransaksi->isEmpty())
        <a href="{{ route('pelanggan.pesanan') }}" class="btn-outline-modern text-decoration-none">
            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
        </a>
        @endif
    </div>

    @if($recentTransaksi->isEmpty())
        <div class="text-center py-5">
            <div style="width:72px; height:72px; border-radius:50%; background:var(--bg); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i class="bi bi-inbox" style="font-size:2rem; color:var(--text-muted);"></i>
            </div>
            <h6 class="fw-bold mb-1" style="color:var(--text-primary);">Belum ada pesanan</h6>
            <p class="text-muted mb-3" style="font-size:0.85rem;">Mulai pesan laundry untuk melihat riwayat di sini</p>
            <a href="{{ route('pelanggan.pesan') }}" class="btn-primary-gradient text-decoration-none">
                <i class="bi bi-plus-lg me-1"></i> Buat Pesanan Pertama
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Layanan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransaksi as $trx)
                    <tr>
                        <td><span class="fw-semibold">#{{ $trx->id_transaksi }}</span></td>
                        <td style="color:var(--text-secondary);">{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d M Y') }}</td>
                        <td>
                            <span style="color:var(--text-secondary);">{{ $trx->detail->count() }} layanan</span>
                        </td>
                        <td><span class="fw-bold" style="color:var(--primary);">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</span></td>
                        <td>
                            @php
                                $statusColors = [
                                    'Proses' => 'badge-proses',
                                    'Selesai' => 'badge-selesai',
                                    'Diambil' => 'badge-diambil',
                                    'Batal' => 'badge-batal',
                                ];
                                $badgeClass = $statusColors[$trx->status_transaksi] ?? 'badge-proses';
                            @endphp
                            <span class="badge-modern {{ $badgeClass }}">{{ $trx->status_transaksi }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pelanggan.pesanan.detail', $trx->id_transaksi) }}" class="btn-outline-modern text-decoration-none">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
