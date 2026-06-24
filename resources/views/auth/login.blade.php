<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Kilat Laundry</title>
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
            flex: 1;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(79,70,229,0.15) 0%, transparent 70%);
            top: -150px; right: -100px;
            border-radius: 50%;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, transparent 70%);
            bottom: -100px; left: -100px;
            border-radius: 50%;
        }
        .auth-left-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 380px;
        }
        .auth-left-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }
        .auth-left-brand .icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 8px 24px rgba(79,70,229,0.3);
        }
        .auth-left-brand .text {
            font-weight: 800;
            font-size: 1.3rem;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .auth-left h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .auth-left p {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        .auth-features {
            margin-top: 40px;
            text-align: left;
        }
        .auth-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            color: #cbd5e1;
            font-size: 0.88rem;
        }
        .auth-feature-item i {
            width: 28px; height: 28px;
            background: rgba(79,70,229,0.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #818cf8;
            font-size: 0.8rem;
        }

        /* Right Panel */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #fff;
        }
        .auth-form-wrapper {
            width: 100%;
            max-width: 400px;
        }
        .auth-form-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .auth-form-subtitle {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 32px;
        }
        .form-label-modern {
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
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
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
        }
        .input-icon-wrapper .form-input {
            padding-left: 42px;
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
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #94a3b8;
            font-size: 0.78rem;
        }
        .auth-divider::before, .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
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
            font-size: 0.84rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            font-size: 0.78rem;
            color: #475569;
            margin-top: 20px;
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
                <h2>Laundry Jadi Mudah<br>& Praktis</h2>
                <p>Platform laundry online terpercaya. Pesan, pantau, dan kelola cucian dari mana saja.</p>

                <div class="auth-features">
                    <div class="auth-feature-item">
                        <i class="bi bi-lightning-fill"></i>
                        <span>Express service siap dalam 6 jam</span>
                    </div>
                    <div class="auth-feature-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Layanan antar jemput gratis</span>
                    </div>
                    <div class="auth-feature-item">
                        <i class="bi bi-phone-fill"></i>
                        <span>Pantau status pesanan real-time</span>
                    </div>
                    <div class="auth-feature-item">
                        <i class="bi bi-shield-fill-check"></i>
                        <span>Garansi cucian bersih & rapi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="auth-right">
            <div class="auth-form-wrapper">
                <a href="{{ route('user.index') }}" style="display:inline-flex; align-items:center; gap:6px; font-size:0.82rem; color:#64748b; text-decoration:none; margin-bottom:32px;">
                    <i class="bi bi-arrow-left"></i> Kembali ke beranda
                </a>

                <h1 class="auth-form-title">Masuk ke Akun</h1>
                <p class="auth-form-subtitle">Selamat datang kembali! Masuk untuk melanjutkan.</p>

                @if($errors->any())
                    <div class="alert-modern">
                        <i class="bi bi-exclamation-circle-fill"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-modern">Email</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" class="form-input" placeholder="nama@email.com"
                                   value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Password</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password" class="form-input" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <label style="display:flex; align-items:center; gap:6px; font-size:0.82rem; color:#475569; cursor:pointer;">
                            <input type="checkbox" name="remember" style="width:16px; height:16px; border-radius:4px; accent-color:#4f46e5;">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">
                        Masuk <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="auth-divider">atau</div>

                <p class="text-center mb-0" style="font-size:0.88rem; color:#475569;">
                    Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar gratis</a>
                </p>

                <div class="info-card">
                    <i class="bi bi-info-circle me-1"></i>
                    Satu form login untuk semua role. <strong>Admin/Kasir</strong> akan diarahkan ke panel admin, <strong>Pelanggan</strong> ke dashboard pribadi.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
