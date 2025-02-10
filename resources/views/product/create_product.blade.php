@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Tambah Produk Baru') }}</span>
                        <div>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Kembali ke Produk</a>
                            <a href="{{ route('cart.show') }}" class="btn btn-success btn-sm">Keranjang</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan Harga Produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan Deskripsi Produk" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok Produk</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Stok Produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
@endsection