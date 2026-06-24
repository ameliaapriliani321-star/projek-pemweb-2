@extends('pelanggan.layouts.app')

@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi akun kamu')

@section('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #06b6d4 100%);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        padding: 32px 28px;
        position: relative;
        overflow: hidden;
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 140px;
        height: 140px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .profile-avatar-lg {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(255,255,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #fff;
        font-weight: 800;
    }
    .profile-body {
        background: var(--surface);
        border: 1px solid var(--border);
        border-top: none;
        border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        padding: 28px;
    }
    .form-label-modern {
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .form-control-modern {
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 11px 16px;
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--text-primary);
        transition: var(--transition);
    }
    .form-control-modern:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.08);
    }
    .form-control-modern:disabled {
        background: var(--bg);
        color: var(--text-muted);
    }
    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>
@endsection

@section('content')

<div class="row g-4">
    {{-- Profile Card --}}
    <div class="col-lg-4 order-lg-2">
        <div style="border-radius:var(--radius-lg); overflow:hidden; border:1px solid var(--border);">
            <div class="profile-header">
                <div class="d-flex align-items-center gap-3 position-relative">
                    <div class="profile-avatar-lg">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h6 class="fw-bold text-white mb-1" style="font-size:1rem;">{{ $user->name }}</h6>
                        <span style="font-size:0.78rem; color:rgba(255,255,255,0.7);">{{ $user->email }}</span>
                    </div>
                </div>
            </div>
            <div style="background:var(--surface); padding:24px;">
                <div class="mb-3">
                    <span class="info-badge" style="background:#ede9fe; color:#6d28d9;">
                        <i class="bi bi-person-badge"></i> Pelanggan
                    </span>
                </div>

                <div class="d-flex flex-column gap-3" style="font-size:0.85rem;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:32px; height:32px; border-radius:8px; background:var(--bg); display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-telephone" style="font-size:0.85rem; color:var(--text-muted);"></i>
                        </div>
                        <div>
                            <div style="font-size:0.7rem; color:var(--text-muted);">Telepon</div>
                            <div class="fw-medium">{{ $pelanggan->no_telepon ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:32px; height:32px; border-radius:8px; background:var(--bg); display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-geo-alt" style="font-size:0.85rem; color:var(--text-muted);"></i>
                        </div>
                        <div>
                            <div style="font-size:0.7rem; color:var(--text-muted);">Alamat</div>
                            <div class="fw-medium">{{ $pelanggan->alamat ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:32px; height:32px; border-radius:8px; background:var(--bg); display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-calendar3" style="font-size:0.85rem; color:var(--text-muted);"></i>
                        </div>
                        <div>
                            <div style="font-size:0.7rem; color:var(--text-muted);">Bergabung</div>
                            <div class="fw-medium">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="col-lg-8 order-lg-1">
        <div class="card-base">
            <h6 class="fw-bold mb-1" style="font-size:1rem;">
                <i class="bi bi-pencil-square me-2" style="color:var(--primary);"></i>Edit Profil
            </h6>
            <p class="mb-4" style="font-size:0.82rem; color:var(--text-muted);">Perbarui informasi pribadi kamu</p>

            @if($errors->any())
                <div class="alert-modern alert-danger mb-4">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('pelanggan.profil.update') }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-modern">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-modern"
                               value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-modern">Email</label>
                        <input type="email" class="form-control form-control-modern" value="{{ $user->email }}" disabled>
                        <small style="font-size:0.7rem; color:var(--text-muted);">Email tidak dapat diubah</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-modern">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control form-control-modern"
                               value="{{ old('no_telepon', $pelanggan->no_telepon ?? '') }}" required
                               placeholder="08xx-xxxx-xxxx">
                    </div>
                    <div class="col-12">
                        <label class="form-label-modern">Alamat</label>
                        <textarea name="alamat" class="form-control form-control-modern" rows="3" required
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 pt-3" style="border-top:1px solid var(--border-light);">
                    <button type="submit" class="btn btn-primary-gradient">
                        <i class="bi bi-check2 me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
