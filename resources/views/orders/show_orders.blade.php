@extends('layouts.app')
<style>
    /* Container untuk halaman detail order */
    .order-detail-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tombol "Back to orders" */
    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .back-link:hover {
        background-color: #0056b3;
    }

    /* Informasi order */
    .order-info {
        margin-bottom: 20px;
    }

    .order-info p {
        font-size: 16px;
        margin: 10px 0;
        color: #333;
    }

    /* Styling untuk setiap transaksi */
    .transaction-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .transaction-item img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        margin-right: 20px;
        object-fit: cover; /* Pastikan gambar tidak terdistorsi */
    }

    .transaction-details {
        flex-grow: 1;
    }

    .transaction-details p {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
    }

    /* Form upload payment receipt */
    .upload-form {
        margin-top: 30px;
        padding: 20px;
        background-color: #f1f1f1;
        border-radius: 8px;
    }

    .upload-form label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .upload-form input[type="file"] {
        margin-bottom: 15px;
    }

    .upload-form button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .upload-form button:hover {
        background-color: #218838;
    }
</style>
@section('content')
    <div class="order-detail-container">
        <!-- Tombol "Back to orders" -->
        <a href="{{ route('orders.index') }}" class="back-link">Back to orders</a>

        <!-- Informasi order -->
        <div class="order-info">
            <p><strong>ID:</strong> {{ $order->id }}</p>
            <p><strong>User Name:</strong> {{ $order->user->name }}</p>
        </div>

        <!-- Daftar transaksi -->
        @foreach ($order->transactions as $transaction)
            <div class="transaction-item">
                <img src="{{ asset('storage/' . $transaction->product->image) }}" alt="{{ $transaction->product->name }}">
                <div class="transaction-details">
                    <p><strong>Product Name:</strong> {{ $transaction->product->name }}</p>
                    <p><strong>Price:</strong> Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</p>
                    <p><strong>Amount:</strong> {{ $transaction->amount }}</p>
                </div>
            </div>
        @endforeach

        <!-- Form upload payment receipt -->
        @if ($order->is_paid == false && $order->payment_receipt == null)
            <div class="upload-form">
                <form action="{{ route('ordersReceipt.pay', $order) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="order_receipt">Upload Payment Here</label>
                    <input type="file" name="order_receipt" id="order_receipt" required>
                    <button type="submit">Submit payment</button>
                </form>
            </div>
        @endif
    </div>
@endsection