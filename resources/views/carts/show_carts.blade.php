@extends('layouts.app')

    <style>
        .cart-item {
            background-color: #f9f9f9;
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        a.back{
            margin-bottom: 20px;
            margin-left: 80px;
        }
    </style>
@section('content')
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ route('products.index') }}" class="back btn btn-primary">Back to products</a>
    <h1 class="text-center mb-4">Cart</h1>

    @foreach ($carts as $cart)
        <div class="cart-item mb-4 p-3 border rounded">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ url('storage/' . $cart->product->image) }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <p><strong>Name:</strong> {{ $cart->product->name }}</p>
                    <p><strong>Price:</strong> ${{ number_format($cart->product->price, 2) }}</p>
                    <p><strong>Amount:</strong> {{ $cart->product->stock }}</p>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('cart.update', $cart) }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="number" name="amount" value="{{ $cart->amount }}" min="1" class="form-control mb-2">
                        <button type="submit" class="btn btn-warning w-100">Update</button>
                    </form>
                    <form action="{{ route('cart.destroy', $cart) }}" method="post" class="mt-2">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                    </form>
                    <form action="{{ route('checkout') }}" method="post" class="mt-2">
                        @csrf
                        <div class="form-check">
                            <input type="checkbox" name="product_ids[]" value="{{ $cart->product_id }}" class="form-check-input">
                            <label class="form-check-label">Pilih untuk checkout</label>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-2">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('styles')
<style>
    .cart-item {
        background-color: #f9f9f9;
    }

    .cart-item img {
        max-width: 100%;
        height: auto;
    }

    .cart-item p {
        font-size: 1rem;
        color: #333;
    }

    .btn {
        font-weight: bold;
    }

    .form-check-label {
        font-size: 0.9rem;
    }

    h1 {
        font-family: Arial, sans-serif;
        font-size: 2rem;
        color: #333;
    }

    .alert {
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .p-3 {
        padding: 1rem;
    }
</style>
@endpush
