<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Kilat Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --accent: #06b6d4;
            --accent-light: #67e8f9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --surface: #ffffff;
            --surface-hover: #f8fafc;
            --bg: #f1f5f9;
            --bg-dark: #0f172a;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --sidebar-width: 272px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            border-right: 1px solid var(--border);
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .sidebar::-webkit-scrollbar { width: 0; }

        .sidebar-header {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border-light);
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(79,70,229,0.25);
        }
        .sidebar-brand-text {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-primary);
            letter-spacing: -0.3px;
        }
        .sidebar-brand-text span {
            color: var(--accent);
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }
        .sidebar-section-title {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            padding: 12px 16px 8px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: var(--transition);
            margin-bottom: 2px;
            position: relative;
        }
        .sidebar-link:hover {
            background: var(--border-light);
            color: var(--primary);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(79,70,229,0.08), rgba(6,182,212,0.05));
            color: var(--primary);
            font-weight: 600;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: linear-gradient(180deg, var(--primary), var(--accent));
            border-radius: 0 4px 4px 0;
        }
        .sidebar-link i {
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
            opacity: 0.85;
        }
        .sidebar-link.active i { opacity: 1; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border-light);
        }
        .sidebar-link.danger {
            color: var(--danger);
        }
        .sidebar-link.danger:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* ===== MAIN ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 28px 36px;
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .topbar-left h1 {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .topbar-left p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin: 4px 0 0;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .topbar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .topbar-user-info {
            text-align: right;
        }
        .topbar-user-name {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-primary);
        }
        .topbar-user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ===== CARDS ===== */
        .card-base {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            padding: 24px;
            transition: var(--transition);
        }
        .card-base:hover {
            box-shadow: var(--shadow);
        }

        /* ===== ALERTS ===== */
        .alert-modern {
            border: none;
            border-radius: var(--radius);
            padding: 14px 18px;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-modern.alert-success {
            background: #ecfdf5;
            color: #065f46;
        }
        .alert-modern.alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        /* ===== TABLE ===== */
        .table-modern {
            font-size: 0.875rem;
        }
        .table-modern thead th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            padding: 12px 16px;
            background: var(--bg);
        }
        .table-modern tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }
        .table-modern tbody tr:hover {
            background: var(--surface-hover);
        }
        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== BADGES ===== */
        .badge-modern {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-baru { background: #dbeafe; color: #1e40af; }
        .badge-proses { background: #fef3c7; color: #92400e; }
        .badge-selesai { background: #d1fae5; color: #065f46; }
        .badge-diambil { background: #e0e7ff; color: #3730a3; }
        .badge-batal { background: #fee2e2; color: #991b1b; }
        .badge-lunas { background: #d1fae5; color: #065f46; }
        .badge-belum { background: #fef3c7; color: #92400e; }

        /* ===== BUTTONS ===== */
        .btn-primary-gradient {
            background: linear-gradient(135deg, var(--primary), #6366f1);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 0.875rem;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(79,70,229,0.25);
        }
        .btn-primary-gradient:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79,70,229,0.35);
            color: #fff;
        }
        .btn-outline-modern {
            border: 1.5px solid var(--border);
            color: var(--text-secondary);
            font-weight: 500;
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 0.8rem;
            transition: var(--transition);
            background: transparent;
        }
        .btn-outline-modern:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(79,70,229,0.04);
        }

        /* ===== MOBILE ===== */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1100;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 13px;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-content {
                margin-left: 0;
                padding: 20px 16px;
                padding-top: 64px;
            }
            .sidebar-toggle { display: block; }
            .topbar-left h1 { font-size: 1.3rem; }
        }

        @yield('styles')
    </style>
</head>
<body>

<!-- Mobile Toggle -->
<button class="sidebar-toggle" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('user.index') }}" class="sidebar-brand">
            <div class="sidebar-brand-icon">🧺</div>
            <div class="sidebar-brand-text">Kilat<span>Laundry</span></div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-title">Menu Utama</div>
        <a href="{{ route('pelanggan.dashboard') }}" class="sidebar-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('pelanggan.pesan') }}" class="sidebar-link {{ request()->routeIs('pelanggan.pesan') ? 'active' : '' }}">
            <i class="bi bi-bag-plus-fill"></i> Pesan Laundry
        </a>
        <a href="{{ route('pelanggan.pesanan') }}" class="sidebar-link {{ request()->routeIs('pelanggan.pesanan*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Pesanan
        </a>

        <div class="sidebar-section-title mt-3">Akun</div>
        <a href="{{ route('pelanggan.profil') }}" class="sidebar-link {{ request()->routeIs('pelanggan.profil') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i> Profil Saya
        </a>
        <a href="{{ route('user.index') }}" class="sidebar-link">
            <i class="bi bi-globe2"></i> Kunjungi Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="sidebar-link danger w-100 border-0 bg-transparent text-start">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="main-content">
    <div class="topbar">
        <div class="topbar-left">
            <h1>@yield('title', 'Dashboard')</h1>
            <p>@yield('subtitle', '')</p>
        </div>
        <div class="topbar-right">
            <div class="topbar-user-info d-none d-md-block">
                <div class="topbar-user-name">{{ Auth::user()->name }}</div>
                <div class="topbar-user-role">Pelanggan</div>
            </div>
            <div class="topbar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-modern alert-success mb-4">
            <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-modern alert-danger mb-4">
            <i class="bi bi-exclamation-circle-fill"></i>{{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
        document.querySelector('.sidebar-overlay').classList.toggle('show');
    }
</script>
@yield('scripts')
</body>
</html>
