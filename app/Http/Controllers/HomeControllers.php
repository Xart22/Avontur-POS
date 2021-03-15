<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class HomeControllers extends Controller
{
    public function index(){
        return view('dashboard.index',['produk'=>Produk::get()]);
    }
}
