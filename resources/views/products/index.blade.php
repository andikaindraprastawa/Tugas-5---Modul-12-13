@extends('template')

@section('title', 'Daftar Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <h2 class="mb-4">Daftar Produk</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Varian</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <ul class="mb-0">
                            @forelse ($product->variants as $var)
                                <li>
                                    <strong>{{ $var->name }}</strong><br>
                                    <small>{{ $var->processor }} | RAM: {{ $var->memory }} | Storage: {{ $var->storage }}</small>
                                </li>
                            @empty
                                <span class="text-muted small">Tidak ada varian</span>
                            @endforelse
                        </ul>
                    </td>
                    <td>
                        
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display: inline" onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection