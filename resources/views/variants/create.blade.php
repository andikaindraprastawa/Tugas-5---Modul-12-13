@extends('template')

@section('title', 'Tambah Varian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="mb-4">Tambah Varian untuk: <span class="text-primary">{{ $product->name }}</span></h3>

        <div class="card shadow-sm p-4 border-0 bg-light">
            <form action="{{ route('variants.store', $product->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Varian</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: RAM 8GB / SSD 256GB" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat fitur varian ini" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Processor</label>
                    <input type="text" name="processor" class="form-control" placeholder="Contoh: Intel Core i5" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Memory (RAM)</label>
                    <input type="text" name="memory" class="form-control" placeholder="Contoh: 8GB DDR4" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Storage (Penyimpanan)</label>
                    <input type="text" name="storage" class="form-control" placeholder="Contoh: 256GB SSD" required>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/products" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Varian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection