<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Variant; // <-- INI YANG BARU DITAMBAHKAN

class ProductController extends Controller
{
    // Tampil Data
    public function index()
    {
        $products = Product::all(); 
        return view('products.index', ['products' => $products]); 
    }

    // Tampil Form Tambah
    public function create()
    {
        return view('products.form', [
            'title' => 'Tambah',
            'product' => new Product(),
            'route' => route('products.store'),
            'method' => 'POST',
        ]);
    }

    // Simpan Data Baru
    public function store(Request $request)
    {
        // 1. Validasi data produk
        $validated = $request->validate([
            'name' => 'required|min:4',
            'price' => 'required|integer|min:1000000',
        ]);

        // 2. Simpan Produk dan tampung datanya di variabel $product
        $product = Product::create($validated);

        // 3. Cek apakah form nama varian (v_name) diisi oleh user
        if ($request->filled('v_name')) {
            // Jika diisi, sekalian simpan data variannya!
            Variant::create([
                'product_id' => $product->id, 
                'name' => $request->v_name,
                'description' => $request->description,
                'processor' => $request->processor,
                'memory' => $request->memory,
                'storage' => $request->storage,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Produk beserta Varian berhasil ditambahkan');
    }

    // Tampil Form Edit
    public function edit(Product $product)
    {
        return view('products.form', [
            'title' => 'Edit',
            'product' => $product,
            'route' => route('products.update', $product),
            'method' => 'PUT',
        ]);
    }

    // Simpan Perubahan Data (Update)
    public function update(Request $request, Product $product)
    {
        // 1. Validasi dan update data produk utama
        $validated = $request->validate([
            'name' => 'required|min:4',
            'price' => 'required|integer|min:1000000',
        ]);
        $product->update($validated);

        // 2. Cek apakah ada data varian yang dikirim dari form Edit
        if ($request->has('variants')) {
            // Lakukan perulangan untuk setiap varian yang diedit
            foreach ($request->variants as $varData) {
                // Cari varian berdasarkan ID
                $variant = Variant::find($varData['id']);
                
                // Jika ketemu, update datanya
                if ($variant) {
                    $variant->update([
                        'name' => $varData['name'],
                        'description' => $varData['description'],
                        'processor' => $varData['processor'],
                        'memory' => $varData['memory'],
                        'storage' => $varData['storage'],
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk dan Varian berhasil diperbarui!');
    }

    // Hapus Data (Delete) - BAGIAN YANG SUDAH DIPERBAIKI
    public function destroy(Product $product)
    {
        // 1. Hapus semua anak (varian) yang terhubung dengan produk ini terlebih dahulu
        $product->variants()->delete();

        // 2. Setelah anak-anaknya terhapus, baru hapus induknya (produk utamanya)
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Produk beserta seluruh variannya berhasil dihapus');
    }
}