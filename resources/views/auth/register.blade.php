<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Kilat Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            margin: 0;
            background: #f8fafc;
            -webkit-font-smoothing: antialiased;
        }
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Left Panel */
        .auth-left {
            width: 420px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(79,70,229,0.15) 0%, transparent 70%);
            top: -100px; right: -100px;
            border-radius: 50%;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, transparent 70%);
            bottom: -80px; left: -80px;
            border-radius: 50%;
        }
        .auth-left-content {
            position: relative;
            z-index: 1;
        }
        .auth-left-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }
        .auth-left-brand .icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 8px 24px rgba(79,70,229,0.3);
        }
        .auth-left-brand .text {
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
        }
        .auth-left h2 {
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            line-height: 1.3;
            margin-bottom: 12px;
        }
        .auth-left p {
            color: #94a3b8;
            font-size: 0.9rem;
            line-height: 1.7;
        }
        .benefit-list {
            margin-top: 32px;
        }
        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        .benefit-item .num {
            width: 28px; height: 28px;
            background: rgba(79,70,229,0.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #818cf8;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .benefit-item .info {
            font-size: 0.84rem;
            color: #cbd5e1;
            line-height: 1.5;
        }
        .benefit-item .info strong {
            color: #f1f5f9;
            display: block;
            margin-bottom: 2px;
        }

        /* Right Panel */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #fff;
            overflow-y: auto;
        }
        .auth-form-wrapper {
            width: 100%;
            max-width: 480px;
        }
        .auth-form-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .auth-form-subtitle {
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 28px;
        }
        .form-label-modern {
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }
        .form-input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            font-size: 0.88rem;
            font-family: inherit;
            color: #0f172a;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.08);
        }
        .form-input::placeholder {
            color: #94a3b8;
        }
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
        }
        .input-icon-wrapper .form-input {
            padding-left: 38px;
        }
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.92rem;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            background: #3730a3;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79,70,229,0.3);
        }
        .auth-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-link:hover {
            color: #3730a3;
            text-decoration: underline;
        }
        .alert-modern {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.82rem;
            margin-bottom: 20px;
        }
        .alert-modern ul {
            margin: 0;
            padding-left: 16px;
        }
        .alert-modern li {
            margin-bottom: 2px;
        }

        @media (max-width: 991px) {
            .auth-left { display: none; }
            .auth-right { padding: 24px; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <!-- Left Panel -->
        <div class="auth-left">
            <div class="auth-left-content">
                <div class="auth-left-brand">
                    <span class="icon">🧺</span>
                    <span class="text">KilatLaundry</span>
                </div>
                <h2>Bergabung Sekarang,<br>Gratis!</h2>
                <p>Buat akun dalam 30 detik dan nikmati semua kemudahan laundry online.</p>

                <div class="benefit-list">
                    <div class="benefit-item">
                        <span class="num">1</span>
                        <div class="info">
                            <strong>Pesan dari Mana Saja</strong>
                            Buat pesanan laundry online kapan saja, 24/7
                        </div>
                    </div>
                    <div class="benefit-item">
                        <span class="num">2</span>
                        <div class="info">
                            <strong>Tracking Real-time</strong>
                            Pantau status cucian dari dashboard pribadi
                        </div>
                    </div>
                    <div class="benefit-item">
                        <span class="num">3</span>
                        <div class="info">
                            <strong>Riwayat Lengkap</strong>
                            Akses semua riwayat pesanan dan pembayaran
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="auth-right">
            <div class="auth-form-wrapper">
                <a href="{{ route('user.index') }}" style="display:inline-flex; align-items:center; gap:6px; font-size:0.82rem; color:#64748b; text-decoration:none; margin-bottom:28px;">
                    <i class="bi bi-arrow-left"></i> Kembali ke beranda
                </a>

                <h1 class="auth-form-title">Buat Akun Baru</h1>
                <p class="auth-form-subtitle">Isi data di bawah untuk mendaftar sebagai pelanggan.</p>

                @if($errors->any())
                    <div class="alert-modern">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-modern">Nama Lengkap</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" class="form-input" placeholder="Masukkan nama lengkap"
                                       value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-modern">Email</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" class="form-input" placeholder="nama@email.com"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-modern">No. Telepon</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-telephone"></i>
                                <input type="text" name="no_telepon" class="form-input" placeholder="08xxxxxxxxxx"
                                       value="{{ old('no_telepon') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label-modern">Alamat</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-geo-alt"></i>
                                <input type="text" name="alamat" class="form-input" placeholder="Alamat lengkap"
                                       value="{{ old('alamat') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-modern">Password</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" class="form-input" placeholder="Min. 8 karakter" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-modern">Konfirmasi Password</label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-lock-fill"></i>
                                <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
                        </button>
                    </div>
                </form>

                <p class="text-center mt-4 mb-0" style="font-size:0.88rem; color:#475569;">
                    Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
