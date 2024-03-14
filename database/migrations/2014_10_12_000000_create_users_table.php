<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->tinyInteger('level')->default(0);
            $table->timestamps();
            $table->softDeletesTz();
        });
        DB::table('users')->insert([
            ['name' => 'administrator', 'password' => Hash::make('hai1234'), 'level' => '1'],
            ['name' => 'petugas', 'password' => Hash::make('hai123456'), 'level' => '0'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
