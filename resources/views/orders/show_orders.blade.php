<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>  
    <a href="{{ route('orders.index') }}">Back to orders</a>
    <p>ID :{{ $order->id }}</p>
    <p>User Name :{{ $order->user->name }}</p>
    @foreach ($order->transactions as $transaction)
        <p>Product Name :{{ $transaction->product->name }}</p>
        <p>Price :{{ $transaction->product->price }}</p>
        <p>Amount :{{ $transaction->amount }}</p>
        <img src=" {{ asset('storage/' . $transaction->product->image) }}" alt="" height="100px" width="100px">
    @endforeach

    {{-- order receipt --}}
    @if ($order->is_paid == false && $order->payment_receipt == null)
        <form action="{{ route('ordersReceipt.pay', $order) }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="order_receipt">Upload Payment Here</label>
            <br>
            <input type="file" name="order_receipt" id="order_receipt">
            <br>
            <button type="submit" >Submit payment</button>
        </form>
    @endif
</body>
</html>