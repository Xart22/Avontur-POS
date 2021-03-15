<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['id_order','disc','total_harga','total_tunai','qty','kembalian','metode_pembayaran','operator','tgl_transaksi'];
}
