@extends('pelanggan.layouts.app')

@section('title', 'Riwayat Pesanan')
@section('subtitle', 'Semua pesanan laundry kamu')

@section('content')

<div class="card-base">
    @if($transaksis->isEmpty())
        <div class="text-center py-5">
            <div style="width:80px; height:80px; border-radius:50%; background:var(--bg); display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
                <i class="bi bi-clock-history" style="font-size:2.2rem; color:var(--text-muted);"></i>
            </div>
            <h5 class="fw-bold mb-2" style="color:var(--text-primary);">Belum Ada Riwayat</h5>
            <p class="mb-4" style="font-size:0.88rem; color:var(--text-secondary);">Anda belum pernah membuat pesanan laundry.</p>
            <a href="{{ route('pelanggan.pesan') }}" class="btn-primary-gradient text-decoration-none">
                <i class="bi bi-plus-lg me-1"></i> Pesan Sekarang
            </a>
        </div>
    @else
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="font-size:0.95rem;">
                <i class="bi bi-clock-history me-2" style="color:var(--primary);"></i>Daftar Pesanan
            </h6>
            <span style="font-size:0.78rem; color:var(--text-muted);">{{ $transaksis->total() }} pesanan</span>
        </div>

        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Terima</th>
                        <th>Selesai</th>
                        <th>Layanan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Bayar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $trx)
                    <tr>
                        <td><span class="fw-semibold">#{{ $trx->id_transaksi }}</span></td>
                        <td style="color:var(--text-secondary);">{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d M Y') }}</td>
                        <td style="color:var(--text-secondary);">
                            {{ $trx->tanggal_selesai ? \Carbon\Carbon::parse($trx->tanggal_selesai)->format('d M Y') : '—' }}
                        </td>
                        <td>
                            @foreach($trx->detail->take(2) as $d)
                                <span style="display:inline-block; padding:2px 8px; border-radius:4px; background:var(--bg); font-size:0.72rem; color:var(--text-secondary); font-weight:500; margin:1px 2px;">
                                    {{ $d->layanan->nama_layanan ?? '-' }}
                                </span>
                            @endforeach
                            @if($trx->detail->count() > 2)
                                <span style="font-size:0.72rem; color:var(--text-muted);">+{{ $trx->detail->count() - 2 }}</span>
                            @endif
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
                            @if($trx->pembayaran->isNotEmpty())
                                <span class="badge-modern badge-lunas">Lunas</span>
                            @else
                                <span class="badge-modern badge-belum">Belum</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pelanggan.pesanan.detail', $trx->id_transaksi) }}" class="btn-outline-modern text-decoration-none">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($transaksis->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $transaksis->links() }}
        </div>
        @endif
    @endif
</div>

@endsection
