@extends('template')

@section('title', 'Form ' . $title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="mb-4">Form {{ $title }} Produk</h4>
        <form class="border p-4 shadow-sm bg-light" method="POST" action="{{ $route }}">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <h5 class="text-primary mb-3">1. Data Utama Produk</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
            </div>

            @if($method !== 'PUT')
            <hr class="my-4">
            <h5 class="text-success mb-3">2. Data Varian Awal (Opsional)</h5>
            <div class="mb-3">
                <label class="form-label">Nama Varian</label>
                <input type="text" name="v_name" class="form-control" placeholder="Contoh: RAM 8GB / SSD 256GB">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="2"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3"><label>Processor</label><input type="text" name="processor" class="form-control"></div>
                <div class="col-md-4 mb-3"><label>Memory</label><input type="text" name="memory" class="form-control"></div>
                <div class="col-md-4 mb-3"><label>Storage</label><input type="text" name="storage" class="form-control"></div>
            </div>
            @endif

            @if($method === 'PUT' && $product->variants->count() > 0)
            <hr class="my-4">
            <h5 class="text-warning mb-3">2. Edit Data Varian</h5>
            
            @foreach($product->variants as $index => $var)
                <div class="border p-3 mb-3 bg-white rounded">
                    <h6 class="fw-bold text-secondary">Varian #{{ $index + 1 }}</h6>
                    
                    <input type="hidden" name="variants[{{ $var->id }}][id]" value="{{ $var->id }}">

                    <div class="mb-2">
                        <label class="form-label small">Nama Varian</label>
                        <input type="text" name="variants[{{ $var->id }}][name]" class="form-control form-control-sm" value="{{ $var->name }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small">Deskripsi</label>
                        <textarea name="variants[{{ $var->id }}][description]" class="form-control form-control-sm" rows="1" required>{{ $var->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-2"><label class="small">Processor</label><input type="text" name="variants[{{ $var->id }}][processor]" class="form-control form-control-sm" value="{{ $var->processor }}" required></div>
                        <div class="col-md-4 mb-2"><label class="small">Memory</label><input type="text" name="variants[{{ $var->id }}][memory]" class="form-control form-control-sm" value="{{ $var->memory }}" required></div>
                        <div class="col-md-4 mb-2"><label class="small">Storage</label><input type="text" name="variants[{{ $var->id }}][storage]" class="form-control form-control-sm" value="{{ $var->storage }}" required></div>
                    </div>
                </div>
            @endforeach
            @endif

            <div class="d-flex justify-content-between mt-4">
                <a href="/products" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection