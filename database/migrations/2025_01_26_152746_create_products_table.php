<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // kolom auto-increment primary key
            $table->string('name'); // kolom untuk nama produk
            $table->decimal('price', 10, 2); // kolom untuk harga produk (decimals)
            $table->text('description'); // kolom untuk deskripsi produk
            $table->string('image'); // kolom untuk menyimpan nama file gambar
            $table->integer('stock'); // kolom untuk jumlah stok produk
            $table->timestamps(); // kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
