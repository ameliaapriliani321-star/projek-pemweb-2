<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login (unified untuk admin & pelanggan)
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman register (untuk pelanggan)
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.register');
    }

    /**
     * Proses register pelanggan baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role pelanggan
        $user->assignRole('pelanggan');

        // Buat data pelanggan yang terhubung
        Pelanggan::create([
            'nama_pelanggan' => $request->name,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'user_id' => $user->id,
        ]);

        // Auto login
        Auth::login($user);

        return redirect()->route('pelanggan.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di Kilat Laundry.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Redirect user berdasarkan role
     */
    private function redirectBasedOnRole($user)
    {
        if ($user->hasAnyRole(['admin', 'kasir', 'owner'])) {
            return redirect('/admin');
        }

        return redirect()->route('pelanggan.dashboard');
    }
}
