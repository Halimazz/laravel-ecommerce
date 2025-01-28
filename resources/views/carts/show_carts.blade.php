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

    @foreach ($carts as $cart )
        <img src="{{ url('storage/' . $cart->product->image) }}" alt="" height="100px" width="100px">
        <p>Name : {{ $cart->product->name }}</p>
        <p>Price : {{ $cart->product->price }}</p>
        <p>Amount : {{ $cart->product->stock }}</p>
        <form action="{{ route('cart.update', $cart) }}" method="post">
            @csrf
            @method('patch')
            <input type="number" name="amount" value="{{ $cart->amount }}">
            <button type="submit">Update</button>
        </form>
        <form action="{{ route('cart.destroy', $cart) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
    @endforeach
</body>
</html>