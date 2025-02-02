<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
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
    <a href="{{ route('products.index') }}">Back to products</a>
    <h1>Cart</h1>

    <!-- Form Checkout (Hanya satu form untuk semua produk) -->
<form action="{{ route('checkout') }}" method="post">
    @csrf

    <!-- Loop melalui setiap produk di keranjang -->
    @foreach ($carts as $cart)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <!-- Checkbox untuk memilih produk -->
            <input type="checkbox" name="product_ids[]" value="{{ $cart->product_id }}"> Pilih untuk checkout

            <!-- Informasi Produk -->
            <img src="{{ url('storage/' . $cart->product->image) }}" alt="" height="100px" width="100px">
            <p>Name : {{ $cart->product->name }}</p>
            <p>Price : {{ $cart->product->price }}</p>
            <p>Amount : {{ $cart->amount }}</p>

            <!-- Form Update Jumlah (Dipisahkan dari form checkout) -->
            <form action="{{ route('cart.update', $cart) }}" method="post" style="display: inline;">
                @csrf
                @method('patch')
                <input type="number" name="amount" value="{{ $cart->amount }}">
                <button type="submit">Update</button>
            </form>

            <!-- Form Hapus Barang (Dipisahkan dari form checkout) -->
            <form action="{{ route('cart.destroy', $cart) }}" method="post" style="display: inline;">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach

    <!-- Tombol Checkout untuk semua item yang dipilih -->
    <button type="submit">Checkout</button>
</form>
</body>
</html>