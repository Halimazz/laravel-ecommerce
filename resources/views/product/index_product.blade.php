<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ( $products as $product )
        <div>
            <h1>{{ $product->name }}</h1>
            <img src="{{ url('storage/' . $product->image) }}" alt="" height="100px" width="100px">
            <form action="{{ route('products.show', $product->id) }}" method="get">
                <button type="submit" name="">Show Detail</button>
            </form>
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" name="">Delete</button>
            </form>
        </div>
        
    @endforeach
</body>
</html>