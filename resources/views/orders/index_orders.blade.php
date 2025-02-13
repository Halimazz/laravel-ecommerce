@extends('layouts.app')


    <style>
        /* Styling untuk link order */
        a.order-link {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        a.order-link:hover {
            color: green; /* Mengubah warna teks menjadi hijau */
            transform: translateY(-2px); /* Menambahkan efek pergeseran saat hover */
        }

        a.order-link:hover * {
            color: green; /* Mengubah warna teks semua elemen di dalam <a> menjadi hijau */
            border-color: green; /* Mengubah warna border menjadi hijau */
        }

        a.order-link:hover img {
            filter: brightness(0.8) sepia(1) hue-rotate(60deg); /* Efek hijau pada gambar */
        }

        a.order-link:hover .confirm-button {
            background-color: green; /* Mengubah warna background tombol menjadi hijau */
            color: white; /* Mengubah warna teks tombol menjadi putih */
            border-color: green; /* Mengubah warna border tombol menjadi hijau */
        }

        /* Styling untuk card order */
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-4px); /* Menambahkan efek pergeseran sedikit lebih besar */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-color: green; /* Menambahkan efek border hijau saat hover */
        }

        .order-card p {
            margin: 5px 0;
            font-size: 16px;
            line-height: 1.5;
        }

        .order-card .order-status {
            font-weight: bold;
        }

        .order-card .paid {
            color: green;
        }

        .order-card .unpaid {
            color: red;
        }

        /* Styling untuk gambar payment receipt */
        .order-card .payment-receipt img {
            width: 100%;
            height: auto; /* Menjaga aspect ratio */
            max-width: 120px; /* Lebar maksimal gambar */
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
        }

        /* Styling untuk tombol confirm payment */
        .order-card .confirm-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .order-card .confirm-button:hover {
            background-color: #218838;
        }

        .payment-receipt {
        width: 20%;
        max-width: 20%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-top: 10px;
    }

    </style>


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @foreach ($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="order-link text-decoration-none text-dark">
                        <div class="order-card mb-4 p-3 border rounded">
                            <p><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p><strong>User:</strong> {{ $order->user->name }}</p>
                            <p class="text-muted">{{ $order->created_at }}</p>
                            <p>
                                @if ($order->is_paid == 1)
                                    <span class="order-status paid">Paid</span>
                                @else
                                    <span class="order-status unpaid">Unpaid</span>
                                    @if ($order->payment_receipt)
                                        <a href="{{ url('storage/' . $order->payment_receipt) }}" class="d-block mt-3">
                                            <img src="{{ asset('storage/' . $order->payment_receipt) }}" alt="Payment Receipt" class="payment-receipt">
                                        </a>
                                    @endif
                                    <form action="{{ route('ordersReceipt.confirm', $order) }}" method="post" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="confirm-button">Confirm Payment</button>
                                    </form>
                                @endif
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection