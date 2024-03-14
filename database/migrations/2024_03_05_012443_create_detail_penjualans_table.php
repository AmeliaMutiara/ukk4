<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->on('penjualans')->references('id')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->foreign('produk_id')->on('produks')->references('id')->onUpdate('cascade')->onDelete('set null');
            $table->integer('jmlProduk')->nullable();
            $table->decimal('subtotal', 10)->nullable();
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
