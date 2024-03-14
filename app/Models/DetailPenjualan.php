<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [
        'created_at',
        'deleted_at'
    ];

    public function produk() {
        return $this->belongsTo(Produk::class);
    }
}
