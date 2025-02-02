<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>ID :{{ $order->id }}</p>
    <p>User Name :{{ $order->user->name }}</p>
    @foreach ($order->transactions as $transaction)
        <p>Product Name :{{ $transaction->product->name }}</p>
        <p>Price :{{ $transaction->product->price }}</p>
        <p>Amount :{{ $transaction->amount }}</p>
        <img src=" {{ asset('storage/' . $transaction->product->image) }}" alt="" height="100px" width="100px">
    @endforeach
</body>
</html>