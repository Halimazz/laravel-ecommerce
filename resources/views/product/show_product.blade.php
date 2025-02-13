@extends('layouts.app')

@section('styles')
    <style>
        .card {
            border-radius: 10px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .btn-outline-secondary {
            border-radius: 5px;
        }
        .btn-warning {
            border-radius: 5px;
        }
        .btn-primary {
            border-radius: 5px;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Produk</h5>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <h3>{{ $product->name }}</h3>
                                <p class="text-muted">{{ $product->description }}</p>
                                <ul class="list-unstyled">
                                    <li><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</li>
                                    <li><strong>Stok:</strong> {{ $product->stock }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit Produk</a>
                        </div>

                        <hr>

                        <form action="{{ route('cart.add', $product->id) }}" method="post" class="mt-3">
                            @csrf
                            <div class="input-group" style="max-width: 230px;">
                                <!-- Menggunakan step dan memastikan tombol input dapat bekerja -->
                                <input type="number" name="amount" value="1" min="1" step="1" class="form-control" aria-label="Jumlah">
                                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                            </div>
                        </form>

                        @if (session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

