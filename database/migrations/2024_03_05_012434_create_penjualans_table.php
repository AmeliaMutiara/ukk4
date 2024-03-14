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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('tglPenjualan')->nullable();
            $table->decimal('totalHarga', 10)->nullable();
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->foreign('pelanggan_id')->on('pelanggans')->references('id')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
