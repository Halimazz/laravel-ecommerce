<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }}</title>
</head>
<body>
    <a href="{{ route('products.index') }}">Back</a>
    <p>Name : {{ $product->name }}</p>
    <p>Description : {{ $product->description }}</p>
    <p>Price : {{ $product->price }}</p>
    <p>Stock : {{ $product->stock }}</p>
    <img src="{{ url('storage/'. $product->image) }}" alt="" height="100px" width="100px">
    <a href="{{ route('products.edit', $product->id) }}">Edit</a>
    <form action="{{ route('cart.add', $product->id) }}" method="post">
        @csrf
        <input type="number" name="amount" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        
    @endif
    
</body>
</html>