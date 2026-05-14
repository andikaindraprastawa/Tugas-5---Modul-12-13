<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;

class VariantController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman form tambah varian
    public function create($id)
    {
        // Mencari produk berdasarkan ID agar kita tahu varian ini untuk produk apa
        $product = Product::findOrFail($id); 
        
        // Menampilkan halaman (view) form dan mengirimkan data produknya
        return view('variants.create', compact('product'));
    }

    // 2. Fungsi untuk memproses data dari form dan menyimpannya ke database
    public function store(Request $request, $id)
    {
        // Validasi: Pastikan tidak ada kolom yang dikosongkan oleh user
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'processor' => 'required',
            'memory' => 'required',
            'storage' => 'required',
        ]);

        // Proses menyimpan data ke tabel variants
        Variant::create([
            'product_id' => $id, // Mengambil ID Produk otomatis dari URL
            'name' => $request->name,
            'description' => $request->description,
            'processor' => $request->processor,
            'memory' => $request->memory,
            'storage' => $request->storage,
        ]);

        // Jika sukses, kembalikan user ke halaman daftar produk dengan pesan sukses
        return redirect('/products')->with('success', 'Varian baru berhasil ditambahkan!');
    }
}