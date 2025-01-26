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
            <p>{{ $product->price }}</p>
            <p>{{ $product->description }}</p>
            <p>{{ $product->stock }}</p>
            <img src="{{ url('storage/' . $product->image) }}" alt="" height="100px" width="100px">
        </div>
        
    @endforeach
</body>
</html>