@extends('layouts.app')

@section('styles')
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .btn-sm {
            font-size: 0.875rem;
        }
        .card-img-top {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Products') }}</span>
                        <div>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Tambah Produk</a>
                            <a href="{{ route('cart.show') }}" class="btn btn-success btn-sm">Keranjang</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <img src="{{ url('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <form action="{{ route('products.show', $product->id) }}" method="get" class="d-inline">
                                                    <button type="submit" class="btn btn-info btn-sm">Detail</button>
                                                </form>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

