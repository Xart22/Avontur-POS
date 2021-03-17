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
            $get_total = TempCart::where('id','=',$id)->first();
            $id_prd = $get_total->id_produk;
            $get_hrg = Produk::where('id',"=",$id_prd)->first();
            $hrg =  $get_hrg->harga;
            $str = str_replace(".","",$hrg);
            $ttl = str_replace(".","",$get_total->total_harga);
            $int = (int)$str;
            $intt =(int)$ttl;
            $total = $ttl + $int;
            $qtytemp = $get_total->qty;
            $qty = $qtytemp+ 1;
            $cart = TempCart::where('id','=',$id)->update(['qty'=>$qty,'total_harga'=>$total]);
            return back();
          
          
    }
    public function kurangqty($id){
        $get_total = TempCart::where('id','=',$id)->first();
        $id_prd = $get_total->id_produk;
        $get_hrg = Produk::where('id',"=",$id_prd)->first();
        $hrg =  $get_hrg->harga;
        $str = str_replace(".","",$hrg);
        $ttl = str_replace(".","",$get_total->total_harga);
        $int = (int)$str;
        $intt =(int)$ttl;
        $total = $ttl - $int;
        $qtytemp = $get_total->qty;
        $qty = $qtytemp- 1;
        $cart = TempCart::where('id','=',$id)->update(['qty'=>$qty,'total_harga'=>$total]);
        return back();
      
      
}
}
