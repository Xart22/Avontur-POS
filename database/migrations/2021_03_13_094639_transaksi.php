<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_order');
            $table->integer('disc')->default('0');
            $table->string('total_harga');
            $table->integer('qty');
            $table->string('total_tunai');
            $table->string('kembalian');
            $table->string('metode_pembayaran')->default('cash');
            $table->string('operator');
            $table->date('tgl_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
