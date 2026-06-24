<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Layanan;
use App\Models\KategoriLayanan;
use App\Models\Pelanggan;
use App\Models\DetailTransaksi;

class UserController extends Controller
{
    // Halaman Beranda
    public function index()
    {
        $layanan = Layanan::with('kategori')->take(8)->get();
        $totalLayanan = Layanan::count();
        $totalTransaksi = Transaksi::count();
        $totalPelanggan = Pelanggan::count();

        return view('user.index', compact('layanan', 'totalLayanan', 'totalTransaksi', 'totalPelanggan'));
    }

    // Halaman Daftar Layanan
    public function layanan(Request $request)
    {
        $kategoris = KategoriLayanan::all();
        $query = Layanan::with('kategori');

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama_layanan', 'like', '%' . $request->search . '%');
        }

        $layanans = $query->paginate(12)->appends($request->all());

        return view('user.layanan', compact('layanans', 'kategoris'));
    }

    // Form Cek Status Pesanan
    public function cekStatus()
    {
        return view('user.cek-status');
    }

    // Proses Cek Status berdasarkan No. Telepon
    public function hasilCekStatus(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required|string|max:20',
        ]);

        $pelanggan = Pelanggan::where('no_telepon', $request->no_telepon)->first();

        $transaksis = null;
        if ($pelanggan) {
            $transaksis = Transaksi::with(['detail.layanan', 'pembayaran'])
                ->where('id_pelanggan', $pelanggan->id_pelanggan)
                ->orderByDesc('tanggal_terima')
                ->get();
        }

        return view('user.cek-status', compact('pelanggan', 'transaksis'));
    }

    // Halaman Detail Transaksi
    public function detailTransaksi($id)
    {
        $transaksi = Transaksi::with(['detail.layanan', 'pembayaran', 'pelanggan', 'pegawai'])
            ->where('id_transaksi', $id)
            ->firstOrFail();

        return view('user.detail-transaksi', compact('transaksi'));
    }
}
