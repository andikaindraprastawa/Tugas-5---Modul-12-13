<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib dipanggil untuk fitur login
use App\Models\User;                  // <-- TAMBAHAN UNTUK REGISTER
use Illuminate\Support\Facades\Hash;  // <-- TAMBAHAN UNTUK REGISTER (Keamanan Password)

class SiteController extends Controller
{
    // Fungsi untuk memproses data login
    public function auth(Request $req) 
    {
        // Mengecek apakah email dan password cocok dengan di database
        if (Auth::attempt(['email' => $req->em, 'password' => $req->pwd])) {
            return redirect('/products'); // Jika benar, masuk ke halaman produk
        }
        
        // Jika salah, kembalikan ke halaman login dengan pesan error
        return redirect('/login')->with('msg', 'Email / password salah');
    }

    // ==========================================
    // INI TAMBAHAN UNTUK REGISTER (LANGKAH 2)
    // ==========================================

    // Menampilkan halaman form register
    public function register()
    {
        return view('register');
    }

    // Menyimpan data user baru
    public function storeRegister(Request $request)
    {
        // 1. Validasi input dari user
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users', // Pastikan email belum pernah dipakai
            'password' => 'required|min:6'
        ]);

        // 2. Simpan ke database dan enkripsi password-nya
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash::make untuk mengamankan password
        ]);

        // 3. Langsung login-kan user tersebut secara otomatis setelah sukses mendaftar
        Auth::login($user);

        // 4. Arahkan ke halaman daftar produk
        return redirect('/products')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }
}