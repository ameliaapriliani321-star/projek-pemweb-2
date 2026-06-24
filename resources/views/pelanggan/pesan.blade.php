@extends('pelanggan.layouts.app')

@section('title', 'Pesan Laundry')
@section('subtitle', 'Pilih layanan dan tentukan jumlah')

@section('styles')
<style>
    .search-box {
        position: relative;
    }
    .search-box input {
        padding-left: 40px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: 0.875rem;
        height: 42px;
        transition: var(--transition);
    }
    .search-box input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.08);
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .kategori-chip {
        padding: 7px 16px;
        border-radius: 8px;
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        transition: var(--transition);
        user-select: none;
    }
    .kategori-chip:hover {
        border-color: var(--primary-light);
        color: var(--primary);
        background: rgba(79,70,229,0.04);
    }
    .kategori-chip.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 2px 8px rgba(79,70,229,0.25);
    }

    .service-card {
        background: var(--surface);
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        padding: 18px;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: transparent;
        transition: var(--transition);
    }
    .service-card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 4px 12px rgba(79,70,229,0.08);
    }
    .service-card.selected {
        border-color: var(--primary);
        background: rgba(79,70,229,0.02);
    }
    .service-card.selected::before {
        background: linear-gradient(90deg, var(--primary), var(--accent));
    }
    .service-card .check-indicator {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        flex-shrink: 0;
    }
    .service-card.selected .check-indicator {
        background: var(--primary);
        border-color: var(--primary);
    }
    .service-card .check-indicator i {
        font-size: 0.7rem;
        color: #fff;
        opacity: 0;
        transition: var(--transition);
    }
    .service-card.selected .check-indicator i {
        opacity: 1;
    }

    .service-price {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--primary);
    }
    .service-unit {
        font-size: 0.72rem;
        color: var(--text-muted);
        font-weight: 500;
    }
    .service-kategori {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 4px;
        background: var(--bg);
        font-size: 0.7rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .qty-control {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid var(--border-light);
    }
    .qty-control label {
        font-size: 0.78rem;
        color: var(--text-secondary);
        font-weight: 500;
    }
    .qty-control input {
        width: 72px;
        height: 34px;
        border-radius: 8px;
        border: 1.5px solid var(--border);
        text-align: center;
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--text-primary);
        transition: var(--transition);
    }
    .qty-control input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.08);
    }

    .cart-panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        position: sticky;
        top: 28px;
        overflow: hidden;
    }
    .cart-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid var(--border-light);
    }
    .cart-body {
        padding: 16px 24px;
        max-height: 320px;
        overflow-y: auto;
    }
    .cart-body::-webkit-scrollbar { width: 4px; }
    .cart-body::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

    .cart-item {
        padding: 10px 0;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cart-item:last-child { border-bottom: none; }

    .cart-footer {
        padding: 16px 24px 24px;
        border-top: 1px solid var(--border-light);
        background: var(--surface-hover);
    }

    .empty-cart {
        padding: 32px 24px;
        text-align: center;
    }
</style>
@endsection

@section('content')

<form method="POST" action="{{ route('pelanggan.pesan.store') }}" id="pesanForm">
    @csrf

    <div class="row g-4">
        {{-- Left: Service List --}}
        <div class="col-lg-8">
            <div class="card-base">
                {{-- Header with search --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <h6 class="fw-bold mb-0"><i class="bi bi-grid-3x3-gap-fill me-2" style="color:var(--primary);"></i>Pilih Layanan</h6>
                    <div class="search-box" style="width:220px;">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Cari layanan..." id="searchInput">
                    </div>
                </div>

                {{-- Category Filter --}}
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="kategori-chip active" data-kategori="all">Semua</span>
                    @foreach($kategoris as $kat)
                        <span class="kategori-chip" data-kategori="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</span>
                    @endforeach
                </div>

                {{-- Service Grid --}}
                <div class="row g-3" id="layananList">
                    @foreach($layanans as $layanan)
                    <div class="col-md-6 layanan-col" data-kategori="{{ $layanan->id_kategori }}">
                        <div class="service-card" data-id="{{ $layanan->id_layanan }}" data-nama="{{ $layanan->nama_layanan }}" data-harga="{{ $layanan->harga }}" data-satuan="{{ $layanan->satuan }}">
                            <div class="d-flex align-items-start gap-3">
                                <div class="check-indicator"><i class="bi bi-check2"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-semibold mb-1" style="font-size:0.88rem; color:var(--text-primary);">{{ $layanan->nama_layanan }}</h6>
                                            <span class="service-kategori">{{ $layanan->kategori->nama_kategori ?? '-' }}</span>
                                        </div>
                                        <div class="text-end">
                                            <div class="service-price">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</div>
                                            <div class="service-unit">per {{ $layanan->satuan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qty-control" style="display:none;">
                                <label>Jumlah ({{ $layanan->satuan }}):</label>
                                <input type="number" class="jumlah-field" step="0.1" min="0.1" value="1">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($layanans->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-emoji-frown" style="font-size:2.5rem; color:var(--text-muted);"></i>
                    <p class="text-muted mt-2">Belum ada layanan tersedia.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Right: Cart Summary --}}
        <div class="col-lg-4">
            <div class="cart-panel">
                <div class="cart-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-bag-fill" style="color:var(--primary);"></i>
                        <h6 class="fw-bold mb-0" style="font-size:0.95rem;">Keranjang</h6>
                        <span class="ms-auto badge rounded-pill" style="background:var(--bg); color:var(--text-secondary); font-size:0.72rem; font-weight:600;" id="cartCount">0 item</span>
                    </div>
                </div>

                <div id="cartItems">
                    <div class="empty-cart">
                        <div style="width:56px; height:56px; border-radius:50%; background:var(--bg); display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                            <i class="bi bi-bag" style="font-size:1.3rem; color:var(--text-muted);"></i>
                        </div>
                        <p class="mb-0" style="font-size:0.82rem; color:var(--text-muted);">Klik layanan untuk menambahkan</p>
                    </div>
                </div>

                <div class="cart-footer">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="font-size:0.85rem; font-weight:600; color:var(--text-secondary);">Total Bayar</span>
                        <span style="font-size:1.25rem; font-weight:800; color:var(--primary); letter-spacing:-0.5px;" id="totalHarga">Rp 0</span>
                    </div>

                    <button type="submit" class="btn btn-primary-gradient w-100" id="btnSubmit" disabled>
                        <i class="bi bi-check2-circle me-2"></i>Buat Pesanan
                    </button>

                    <p class="mb-0 mt-3 text-center" style="font-size:0.72rem; color:var(--text-muted);">
                        <i class="bi bi-info-circle me-1"></i>Antar cucian ke outlet setelah pesanan dibuat
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="hiddenInputs"></div>
</form>

@endsection

@section('scripts')
<script>
    const selectedItems = {};

    // Filter kategori
    document.querySelectorAll('.kategori-chip').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.kategori-chip').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const kat = this.dataset.kategori;
            document.querySelectorAll('.layanan-col').forEach(col => {
                if (kat === 'all' || col.dataset.kategori === kat) {
                    col.style.display = '';
                } else {
                    col.style.display = 'none';
                }
            });
        });
    });

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.layanan-col').forEach(col => {
            const name = col.querySelector('.service-card').dataset.nama.toLowerCase();
            col.style.display = name.includes(q) ? '' : 'none';
        });
        // Reset active category
        document.querySelectorAll('.kategori-chip').forEach(t => t.classList.remove('active'));
        document.querySelector('.kategori-chip[data-kategori="all"]').classList.add('active');
    });

    // Select service
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.classList.contains('jumlah-field')) return;

            const id = this.dataset.id;
            if (selectedItems[id]) {
                delete selectedItems[id];
                this.classList.remove('selected');
                this.querySelector('.qty-control').style.display = 'none';
            } else {
                selectedItems[id] = {
                    id: id,
                    nama: this.dataset.nama,
                    harga: parseFloat(this.dataset.harga),
                    satuan: this.dataset.satuan,
                    jumlah: parseFloat(this.querySelector('.jumlah-field').value)
                };
                this.classList.add('selected');
                this.querySelector('.qty-control').style.display = 'flex';
            }
            updateCart();
        });

        card.querySelector('.jumlah-field').addEventListener('input', function() {
            const id = card.dataset.id;
            if (selectedItems[id]) {
                selectedItems[id].jumlah = parseFloat(this.value) || 0;
                updateCart();
            }
        });

        // Prevent deselection when clicking input
        card.querySelector('.jumlah-field').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    function updateCart() {
        const cartDiv = document.getElementById('cartItems');
        const hiddenDiv = document.getElementById('hiddenInputs');
        const totalEl = document.getElementById('totalHarga');
        const countEl = document.getElementById('cartCount');
        const btnSubmit = document.getElementById('btnSubmit');

        let html = '';
        let hiddenHtml = '';
        let total = 0;
        let count = 0;

        for (const id in selectedItems) {
            const item = selectedItems[id];
            const subtotal = item.harga * item.jumlah;
            total += subtotal;
            count++;

            html += `
                <div class="cart-item">
                    <div>
                        <div style="font-size:0.82rem; font-weight:600; color:var(--text-primary);">${item.nama}</div>
                        <div style="font-size:0.72rem; color:var(--text-muted);">${item.jumlah} ${item.satuan} × Rp ${item.harga.toLocaleString('id')}</div>
                    </div>
                    <div style="font-size:0.82rem; font-weight:700; color:var(--primary);">Rp ${subtotal.toLocaleString('id')}</div>
                </div>
            `;

            hiddenHtml += `
                <input type="hidden" name="layanan[${count}][id_layanan]" value="${item.id}">
                <input type="hidden" name="layanan[${count}][jumlah]" value="${item.jumlah}">
            `;
        }

        if (count === 0) {
            cartDiv.innerHTML = `
                <div class="empty-cart">
                    <div style="width:56px; height:56px; border-radius:50%; background:var(--bg); display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                        <i class="bi bi-bag" style="font-size:1.3rem; color:var(--text-muted);"></i>
                    </div>
                    <p class="mb-0" style="font-size:0.82rem; color:var(--text-muted);">Klik layanan untuk menambahkan</p>
                </div>`;
            btnSubmit.disabled = true;
        } else {
            cartDiv.innerHTML = '<div class="cart-body">' + html + '</div>';
            btnSubmit.disabled = false;
        }

        countEl.textContent = count + ' item';
        hiddenDiv.innerHTML = hiddenHtml;
        totalEl.textContent = 'Rp ' + total.toLocaleString('id');
    }
</script>
@endsection
