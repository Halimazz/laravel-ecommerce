@extends('layouts.app')


<style>
    /* Container untuk halaman cart */
    .cart-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tombol "Back to products" */
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

    /* Judul halaman */
    .cart-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* Item cart */
    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .cart-item img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        margin-right: 20px;
        object-fit: cover; /* Pastikan gambar tidak terdistorsi */
    }

    .cart-item-details {
        flex-grow: 1;
    }

    .cart-item-details p {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
    }

    /* Checkbox untuk memilih produk */
    .cart-item-checkbox {
        margin-right: 20px;
    }

    /* Form update dan delete */
    .cart-item-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .cart-item-actions input[type="number"] {
        width: 60px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .cart-item-actions button {
        padding: 5px 10px;
        background-color: #f10808;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .cart-item-actions button:hover {
        background-color: #b31212;
    }

    /* Tombol checkout */
    .checkout-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

   

    /* Alert untuk error */
    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    button.update {
        padding: 2px 10px;
        background-color: #215fe3;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }
    button.update:hover {
        background-color: #0056b3;
    }
    .cart-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Styling untuk total price */
    .cart-summary .total-price {
        font-size: 1 rem;
        font-weight: bold;
        color: #333;
    }

    .cart-summary .total-price strong {
        margin-right: 18px;
    }

    /* Styling untuk tombol checkout */
    .cart-summary .checkout-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .cart-summary .checkout-button:hover {
        background-color: #0056b3;
    }
</style>
@section('content')
    <div class="cart-container">
        <!-- Alert untuk error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any()))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @php
                $total_perpices = 0;
                $total_price= 0;
            @endphp
        <!-- Tombol "Back to products" -->
        <a href="{{ route('products.index') }}" class="back-link">Back to products</a>

        <!-- Judul halaman -->
        <h1 class="cart-title">Cart</h1>

        <!-- Form Checkout (Hanya satu form untuk semua produk) -->
        <form action="{{ route('checkout') }}" method="post" id="checkout-form">
            @csrf
        
            <!-- Loop melalui setiap produk di keranjang -->
            @foreach ($carts as $cart)
                <div class="cart-item">
                    <!-- Checkbox untuk memilih produk -->
                    <input type="checkbox" name="product_ids[]" value="{{ $cart->product_id }}" class="cart-item-checkbox"> Pilih untuk checkout
        
                    <!-- Gambar produk -->
                    <img src="{{ url('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">
        
                    <!-- Informasi produk -->
                    <div class="cart-item-details">
                        <p><strong>Name:</strong> {{ $cart->product->name }}</p>
                        <p><strong>Price:</strong> Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                        @php
                            $total_perpices = $cart->product->price * $cart->amount;
                        @endphp
                        <p><strong>Total : </strong> {{ $total_perpices }} </p>
                        <p><strong>Amount:</strong> {{ $cart->amount }}</p>
                    </div>
        
                    <!-- Tombol Update Jumlah -->
                    <div class="cart-item-actions">
                        <input type="number" id="amount-{{ $cart->id }}" value="{{ $cart->amount }}">
                        <button type="button" class="update" onclick="updateCart({{ $cart->id }})">Update</button>
        
                        <!-- Tombol Hapus Barang -->
                        <button type="button" class="delete" onclick="deleteCart({{ $cart->id }})">Delete</button>
                    </div>
                </div>
                @php
                    $total_price += $cart->product->price * $cart->amount;
                @endphp
            @endforeach
           <div class="cart-summary">
            <!-- Total Price -->
            <div class="total-price">
                <p><strong>Total Price:</strong></p>
                <p>
                    Rp {{ number_format($total_price, 0, ',', '.') }}
                </p>
            </div>
        
            <!-- Tombol Checkout -->
            <button type="submit" class="checkout-button">Checkout</button>
        </div>
        </form>
    </div>
@endsection

    <script>
        function updateCart(cartId) {
        const amount = document.getElementById(`amount-${cartId}`).value;

        fetch(`/cart/${cartId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amount })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cart updated successfully!');
                location.reload(); // Reload halaman untuk memperbarui tampilan
            } else {
                alert('Failed to update cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the cart.');
        });
    }


    function deleteCart(cartId) {
        if (confirm('Are you sure you want to delete this item?')) {
            fetch(`/cart/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cart item deleted successfully!');
                    location.reload(); // Reload halaman untuk memperbarui tampilan
                } else {
                    alert('Failed to delete cart item.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
    </script>