<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($orders as $order)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <p>Order ID : {{ $order->id }}</p>
            <p>User ID : {{ $order->user->name }}</p>
            <p>{{ $order->created_at }}</p>
        </div>
        
    @endforeach
</body>
</html>