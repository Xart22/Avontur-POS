<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCart extends Model
{
    protected $table = 'temp_carts';
    protected $fillable = ['id_produk','name_produk','total_harga','qty','operator','tgl_order'];
}
