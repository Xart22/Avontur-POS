<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\TempCart;

class HomeControllers extends Controller
{
    public function index(){
        return view('dashboard.index',['produk'=>Produk::get()],['tempcart'=>TempCart::get()]);
    }

    public function addTempCart(Request $req, $id){
        $opr = session('loggedUser')->username;
        date_default_timezone_set('Asia/Jakarta');
        $date = now();
        $findPrd = Produk::where('id','=',$id)->first();
        $cekCart = TempCart::where('id_produk','=',$id)->first();
        if ($cekCart) {
            return back()->with('itemcount',$cekCart->name_produk);
        } else {
            $insPrd = TempCart::insert([
                "id_produk"=>$findPrd->id,
                "name_produk"=>$findPrd->name_produk,
                "total_harga"=>$findPrd->harga,
                "qty"=>"1",
                "operator"=>$opr,
                "tgl_order"=>$date]);
            return back();
        }
        
        
    }
    public function tambahqty($id){
        $get_hrg = TempCart::where('id','=',$id)->first();
        $int = intval($get_hrg->total_harga);
        
        dd(35.000);
        // $cart = TempCart::where('id','=',$id)->update(['qty'=>'+1','total_harga'=>$total]);
        // return back();
    }
}
