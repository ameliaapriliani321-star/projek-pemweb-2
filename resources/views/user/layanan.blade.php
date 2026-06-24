@extends('user.layouts.app')

@section('title', 'Daftar Layanan')

@section('styles')
<style>
    .hero-layanan {
        background: linear-gradient(135deg, #1e6fff 0%, #00c4cc 100%);
        padding: 60px 0 40px;
        color: #fff;
    }
    .filter-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30,111,255,0.10);
        position: sticky;
        top: 80px;
    }
    .kategori-btn {
        display: block;
        width: 100%;
        text-align: left;
        padding: 10px 16px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #4a5568;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }
    .kategori-btn:hover, .kategori-btn.active {
        background: #e8f0fe;
        color: #1e6fff;
        font-weight: 600;
    }
    .harga-badge {
        background: #e8f0fe;
        color: #1e6fff;
        border-radius: 50px;
        padding: 4px 14px;
        font-size: 0.82rem;
        font-weight: 700;
    }
    .search-box {
        border-radius: 50px;
        border: 2px solid #e2e8f0;
        padding: 10px 20px;
        font-size: 0.9rem;
        transition: border-color 0.2s;
    }
    .search-box:focus {
        border-color: #1e6fff;
        box-shadow: none;
        outline: none;
    }
    .card-layanan-list {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(30,111,255,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-layanan-list:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(30,111,255,0.16);
    }
    .layanan-icon-wrap {
        width: 56px; height: 56px;
        border-radius: 14px;
        background: #f0f6ff;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero-layanan">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="font-size:0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="text-white-50">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Layanan</li>
            </ol>
        </nav>
        <h1 class="fw-bold mb-2" style="font-size:2.2rem;">Daftar Layanan Kami</h1>
        <p style="color:rgba(255,255,255,0.85);">Temukan layanan laundry yang sesuai dengan kebutuhanmu</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- SIDEBAR FILTER --}}
            <div class="col-lg-3">
                <div class="card filter-card p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-funnel me-2 text-primary"></i>Filter Layanan</h6>

                    {{-- Search --}}
                    <form method="GET" action="{{ route('user.layanan') }}" id="filterForm">
                        <div class="mb-4">
                            <input
                                type="text"
                                name="search"
                                class="form-control search-box"
                                placeholder="🔍 Cari layanan..."
                                value="{{ request('search') }}"
                            >
                        </div>

                        <hr>
                        <p class="fw-semibold mb-2" style="font-size:0.88rem;">Kategori</p>

                        <a href="{{ route('user.layanan') }}"
                           class="kategori-btn {{ !request('kategori') ? 'active' : '' }}">
                            <i class="bi bi-grid-3x3-gap me-2"></i>Semua Kategori
                        </a>
                        @foreach($kategoris as $kat)
                        <a href="{{ route('user.layanan', ['kategori' => $kat->id_kategori, 'search' => request('search')]) }}"
                           class="kategori-btn {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}">
                            <i class="bi bi-chevron-right me-1" style="font-size:0.7rem;"></i>
                            {{ $kat->nama_kategori }}
                        </a>
                        @endforeach

                        <div class="mt-3">
                            <button type="submit" class="btn w-100 rounded-pill" style="background:#1e6fff; color:#fff; font-size:0.88rem;">
                                <i class="bi bi-search me-1"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- DAFTAR LAYANAN --}}
            <div class="col-lg-9">
                {{-- Info hasil --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <span class="fw-semibold">{{ $layanans->total() }} layanan ditemukan</span>
                        @if(request('search'))
                        <span class="text-muted"> untuk "{{ request('search') }}"</span>
                        @endif
                    </div>
                    @if(request('search') || request('kategori'))
                    <a href="{{ route('user.layanan') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="bi bi-x me-1"></i>Reset Filter
                    </a>
                    @endif
                </div>

                @if($layanans->isEmpty())
                <div class="text-center py-5">
                    <div style="font-size:4rem;">🔍</div>
                    <h5 class="fw-bold mt-3">Layanan Tidak Ditemukan</h5>
                    <p class="text-muted">Coba ubah kata kunci atau filter kategori</p>
                    <a href="{{ route('user.layanan') }}" class="btn rounded-pill px-4" style="background:#1e6fff; color:#fff;">Lihat Semua</a>
                </div>
                @else
                <div class="row g-3">
                    @php
                        $icons = ['🧺','👕','🧦','🥼','👔','🧥','🛏️','🎽','👗','🩳','🧤','🧣'];
                    @endphp
                    @foreach($layanans as $i => $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-layanan-list h-100 p-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="layanan-icon-wrap">
                                    {{ $icons[$i % count($icons)] }}
                                </div>
                                <div class="flex-grow-1">
                                    <span class="badge rounded-pill mb-1" style="background:#f0f6ff; color:#1e6fff; font-size:0.72rem;">
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                    <h6 class="fw-bold mb-2" style="font-size:0.9rem; line-height:1.3;">
                                        {{ $item->nama_layanan }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="harga-badge">
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </span>
                                        <span class="text-muted" style="font-size:0.78rem;">/ {{ $item->satuan }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                @if($layanans->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $layanans->links('vendor.pagination.bootstrap-5') }}
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
