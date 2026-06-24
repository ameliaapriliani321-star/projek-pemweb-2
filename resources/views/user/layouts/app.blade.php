<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kilat Laundry') - Kilat Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #818cf8;
            --accent: #06b6d4;
            --accent-dark: #0891b2;
            --dark: #0f172a;
            --gray-900: #1e293b;
            --gray-700: #334155;
            --gray-600: #475569;
            --gray-400: #94a3b8;
            --gray-300: #cbd5e1;
            --gray-200: #e2e8f0;
            --gray-100: #f1f5f9;
            --gray-50: #f8fafc;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--gray-700);
            background: #fff;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            padding: 14px 0;
            transition: all 0.3s;
        }
        .navbar-custom.scrolled {
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
        }
        .navbar-brand-custom {
            font-weight: 800;
            font-size: 1.3rem;
            color: var(--dark) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.3px;
        }
        .navbar-brand-custom .brand-icon {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .nav-link-custom {
            font-weight: 500;
            font-size: 0.88rem;
            color: var(--gray-600) !important;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-link-custom:hover {
            color: var(--primary) !important;
            background: rgba(79,70,229,0.04);
        }
        .nav-link-custom.active {
            color: var(--primary) !important;
            font-weight: 600;
        }
        .btn-nav-primary {
            background: var(--primary);
            color: #fff !important;
            border: none;
            border-radius: 9px;
            padding: 9px 20px;
            font-weight: 600;
            font-size: 0.84rem;
            transition: all 0.2s;
        }
        .btn-nav-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
        }
        .btn-nav-outline {
            background: transparent;
            color: var(--gray-600) !important;
            border: 1.5px solid var(--gray-200);
            border-radius: 9px;
            padding: 8px 18px;
            font-weight: 500;
            font-size: 0.84rem;
            transition: all 0.2s;
        }
        .btn-nav-outline:hover {
            border-color: var(--primary);
            color: var(--primary) !important;
        }

        /* ===== FOOTER ===== */
        .footer-modern {
            background: var(--dark);
            color: var(--gray-400);
            padding: 64px 0 32px;
        }
        .footer-brand {
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-brand .brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        .footer-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--gray-300);
            margin-bottom: 16px;
        }
        .footer-link {
            display: block;
            color: var(--gray-400);
            text-decoration: none;
            font-size: 0.88rem;
            padding: 4px 0;
            transition: color 0.2s;
        }
        .footer-link:hover { color: #fff; }
        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-400);
            text-decoration: none;
            transition: all 0.2s;
            margin-right: 8px;
        }
        .footer-social a:hover {
            background: var(--primary);
            color: #fff;
        }

        @yield('styles')
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand-custom" href="{{ route('user.index') }}">
            <span class="brand-icon">🧺</span>
            KilatLaundry
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('user.layanan') ? 'active' : '' }}" href="{{ route('user.layanan') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ route('user.index') }}#cara-kerja">Cara Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ route('user.cek-status') }}">Cek Status</a>
                </li>
            </ul>
            <div class="d-flex gap-2 mt-3 mt-lg-0">
                @auth
                    @if(Auth::user()->hasRole('pelanggan'))
                        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-nav-primary">
                            <i class="bi bi-grid-fill me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="/admin" class="btn btn-nav-primary">
                            <i class="bi bi-shield-lock-fill me-1"></i> Panel Admin
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-nav-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-nav-primary">Daftar Gratis</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- ===== CONTENT ===== --}}
@yield('content')

{{-- ===== FOOTER ===== --}}
<footer class="footer-modern" id="kontak">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand mb-3">
                    <span class="brand-icon">🧺</span>
                    KilatLaundry
                </div>
                <p style="font-size:0.88rem; line-height:1.7; color:var(--gray-400);">
                    Solusi laundry modern dan terpercaya. Cucian bersih, wangi, dan siap pakai dalam waktu singkat.
                </p>
                <div class="footer-social mt-3">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <div class="footer-title">Navigasi</div>
                <a href="{{ route('user.index') }}" class="footer-link">Beranda</a>
                <a href="{{ route('user.layanan') }}" class="footer-link">Layanan</a>
                <a href="{{ route('user.cek-status') }}" class="footer-link">Cek Status</a>
                <a href="{{ route('login') }}" class="footer-link">Login</a>
            </div>
            <div class="col-lg-3 col-6">
                <div class="footer-title">Layanan</div>
                <a href="#" class="footer-link">Cuci Kiloan</a>
                <a href="#" class="footer-link">Express 6 Jam</a>
                <a href="#" class="footer-link">Dry Cleaning</a>
                <a href="#" class="footer-link">Cuci Sepatu</a>
            </div>
            <div class="col-lg-3">
                <div class="footer-title">Kontak</div>
                <div style="font-size:0.88rem;" class="d-flex flex-column gap-2">
                    <span><i class="bi bi-geo-alt me-2" style="color:var(--primary-light);"></i>Jl. Laundry Bersih No.1</span>
                    <span><i class="bi bi-telephone me-2" style="color:var(--primary-light);"></i>0812-3456-7890</span>
                    <span><i class="bi bi-clock me-2" style="color:var(--primary-light);"></i>Senin–Sabtu, 07–21</span>
                    <span><i class="bi bi-envelope me-2" style="color:var(--primary-light);"></i>halo@kilatlaundry.id</span>
                </div>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,0.08); margin:40px 0 20px;">
        <div class="d-flex flex-wrap justify-content-between align-items-center" style="font-size:0.8rem;">
            <span>&copy; {{ date('Y') }} Kilat Laundry. All rights reserved.</span>
            <span>Built with Laravel & Bootstrap</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        document.querySelector('.navbar-custom').classList.toggle('scrolled', window.scrollY > 20);
    });
</script>
@yield('scripts')
</body>
</html>
