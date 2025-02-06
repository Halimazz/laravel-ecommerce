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
    <a href="{{ route('orders.show', $order) }}">
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <p>Order ID : {{ $order->id }}</p>
            <p>User ID : {{ $order->user->name }}</p>
            <p>{{ $order->created_at }}</p>
            <p>
                @if ($order->is_paid == 1)
                     Paid
                @else
                    UnPaid
                    @if ($order->payment_receipt)
                    <a href="{{ url('storage/' . $order->payment_receipt) }}" >
                        <img src="{{ asset('storage/' . $order->payment_receipt) }}" alt="" height="100px" width="100px">
                    </a>
                    @endif
                    <form action="{{ route('ordersReceipt.confirm', $order) }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit">Confirm Payment</button>
                    </form>
                @endif
            </p>
        </div>
    </a>
    @endforeach
</body>
</html>