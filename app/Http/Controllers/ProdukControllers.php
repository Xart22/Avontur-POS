<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukControllers extends Controller
{
    public function index(){
        return view('admin.produk',['produk'=>Produk::get()]);
    }

    public function addProduk(Request $req){
        $req->validate([
            'nm_produk'=>'required',
            'harga'=>'required'
        ]);
        $addProduk = new Produk;
        $nm_produk = $req->nm_produk;
        $harga = $req->harga;
        $addProduk->name_produk = $nm_produk;
        $addProduk->harga = $harga;
        $save =$addProduk->save();
        
        if ($save) {
            return back()->with('success','Sukses menambah produk');
        }else{
            return back()->with('fail','Gagal menambah produk');
        }

    }

    public function detailProduk($id){
        return view('admin.produk_detail',['produk'=>Produk::where('id',$id)->get()]);
    }

    public function updateProduk(Request $req){
        $update = Produk::where('id','=',$req->id)->update(['name_produk'=> $req->nm_produk,'harga'=>$req->harga]);
        if ($update) {
            return redirect('/produk')->with('success','Sukses memperbarui produk');
        }else{
            return redirect('/produk')->with('fail','Gagal memperbarui produk');
        }

    }
    public function deleteProduk(Request $req){
        $del = Produk::where('id','=',$req->id)->delete();
        if ($del) {
            return redirect('/produk')->with('success','Sukses menghapus produk');
        }else{
            return redirect('/produk')->with('fail','Gagal menghapus produk');
        }

    }

}
