<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    /**
     * Dashboard pelanggan
     */
    public function dashboard()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $totalPesanan = 0;
        $pesananAktif = 0;
        $pesananSelesai = 0;
        $recentTransaksi = collect();

        if ($pelanggan) {
            $totalPesanan = Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)->count();
            $pesananAktif = Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)
                ->where('status_transaksi', 'Proses')
                ->count();
            $pesananSelesai = Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)
                ->whereIn('status_transaksi', ['Selesai', 'Diambil'])
                ->count();
            $recentTransaksi = Transaksi::with(['detail.layanan', 'pembayaran'])
                ->where('id_pelanggan', $pelanggan->id_pelanggan)
                ->orderByDesc('tanggal_terima')
                ->take(5)
                ->get();
        }

        return view('pelanggan.dashboard', compact(
            'user', 'pelanggan', 'totalPesanan', 'pesananAktif', 'pesananSelesai', 'recentTransaksi'
        ));
    }

    /**
     * Halaman pesan laundry (buat pesanan baru)
     */
    public function pesanForm()
    {
        $kategoris = KategoriLayanan::with('layanan')->get();
        $layanans = Layanan::with('kategori')->get();

        return view('pelanggan.pesan', compact('kategoris', 'layanans'));
    }

    /**
     * Proses simpan pesanan baru
     */
    public function pesanStore(Request $request)
    {
        $request->validate([
            'layanan' => 'required|array|min:1',
            'layanan.*.id_layanan' => 'required|exists:ms_layanan,id_layanan',
            'layanan.*.jumlah' => 'required|numeric|min:0.1',
        ]);

        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $totalBayar = 0;

            // Hitung total
            foreach ($request->layanan as $item) {
                $layanan = Layanan::findOrFail($item['id_layanan']);
                $subtotal = $layanan->harga * $item['jumlah'];
                $totalBayar += $subtotal;
            }

            // Buat transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_pegawai' => null, // akan diassign oleh admin/kasir
                'tanggal_terima' => now()->toDateString(),
                'tanggal_selesai' => null,
                'status_transaksi' => 'Proses',
                'total_bayar' => $totalBayar,
            ]);

            // Buat detail transaksi
            foreach ($request->layanan as $item) {
                $layanan = Layanan::findOrFail($item['id_layanan']);
                $subtotal = $layanan->harga * $item['jumlah'];

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_layanan' => $item['id_layanan'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);
            }

            DB::commit();

            return redirect()->route('pelanggan.pesanan.detail', $transaksi->id_transaksi)
                ->with('success', 'Pesanan berhasil dibuat! Silakan antar cucian ke outlet kami.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Daftar semua pesanan pelanggan
     */
    public function riwayatPesanan()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $transaksis = collect();
        if ($pelanggan) {
            $transaksis = Transaksi::with(['detail.layanan', 'pembayaran'])
                ->where('id_pelanggan', $pelanggan->id_pelanggan)
                ->orderByDesc('tanggal_terima')
                ->paginate(10);
        }

        return view('pelanggan.riwayat', compact('transaksis'));
    }

    /**
     * Detail pesanan
     */
    public function detailPesanan($id)
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $transaksi = Transaksi::with(['detail.layanan', 'pembayaran', 'pelanggan', 'pegawai'])
            ->where('id_transaksi', $id)
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->firstOrFail();

        return view('pelanggan.detail-pesanan', compact('transaksi'));
    }

    /**
     * Halaman profil pelanggan
     */
    public function profil()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        return view('pelanggan.profil', compact('user', 'pelanggan'));
    }

    /**
     * Update profil pelanggan
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        // Update user
        $user->update(['name' => $request->name]);

        // Update pelanggan
        if ($user->pelanggan) {
            $user->pelanggan->update([
                'nama_pelanggan' => $request->name,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
