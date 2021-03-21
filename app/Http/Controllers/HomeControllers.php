<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\TempCart;
use App\Models\Invoice;
use App\Models\Laporan;

class HomeControllers extends Controller
{
    public function index(){

        return view('dashboard.index',['produk'=>Produk::get()],['tempcart'=>TempCart::get()]);
    }

    public function addTempCart(Request $req, $id){
        $opr = session('loggedUser')->username;
        date_default_timezone_set('Asia/Jakarta');
        $date = now();
        $prd = Produk::find($id);
        $cekCart = TempCart::where('id_produk','=',$id)->first();
        if($cekCart){
            $qty = $cekCart->qty+1;
            $ttl = $cekCart->total_harga+(int)$req->harga;
            TempCart::where('id_produk','=',$id)->update([
                'qty'=>$qty,'total_harga'=>$ttl,'tgl_order'=>$date
            ]);
            return back();
        }else{
            $temp = new TempCart;
            $temp->id_produk = $prd->id;
            $temp->name_produk = $prd->name_produk;
            $temp->total_harga =(int) $prd->harga;
            $temp->qty = '1';
            $temp->operator = $opr;
            $temp->tgl_order = $date;
            $temp->save();
            return back();
        }
    }
    public function tambahqty($id){
            $get_total = TempCart::where('id','=',$id)->first();
            $id_prd = $get_total->id_produk;
            $get_hrg = Produk::where('id',"=",$id_prd)->first();
            $hrg =  $get_hrg->harga;
            $ttl = $get_total->total_harga;
            $total =   (int)$ttl  +  (int)$hrg;
            $qtytemp = $get_total->qty;
            $qty = $qtytemp+ 1;
            $cart = TempCart::where('id','=',$id)->update(['qty'=>$qty,'total_harga'=>$total]);
            return back();
          
          
    }
    public function kurangqty(Request $req,$id){

        if ($req->qty === '1') {
            return back();
        } else {
            $get_total = TempCart::where('id','=',$id)->first();
            $id_prd = $get_total->id_produk;
            $get_hrg = Produk::where('id',"=",$id_prd)->first();
            $hrg =  $get_hrg->harga;
            $ttl = $get_total->total_harga;
            $total =   (int)$ttl  -  (int)$hrg;
            $qtytemp = $get_total->qty;
            $qty = $qtytemp- 1;
            $cart = TempCart::where('id','=',$id)->update(['qty'=>$qty,'total_harga'=>$total]);
            return back();
        }
    }
        

public function deleteall(){
    TempCart::truncate();
    return redirect('dashboard');


}
public function addlaporan(Request $req){
    $opr = session('loggedUser')->username;
    $req->validate([
        'tunai'=>'required'
    ]);
    date_default_timezone_set('Asia/Jakarta');
    $date = now();
    $cek = Invoice::get()->last();
    $getall = TempCart::get();
    if($cek ===null){
        $random = rand(100,1000);
        $no_inv="AVN-".strval($random);
        Invoice::insert([
            'no_inv'=>$no_inv,
            'jns'=>$req->jns,
            'total'=>$req->total,
            'tunai'=>$req->tunai,
            'kembalian'=>$req->kembalian,
            'tgl_pembayaran'=>$date,
            'operator'=>$opr,
            'no_rek'=>$req->norek
        ]);
        foreach($getall as $item){
            Laporan::insert([
                'no_inv'=>$no_inv,
                'id_produk'=>$item->id_produk,
                'name_produk'=>$item->name_produk,
                'total_harga'=>$item->total_harga,
                'qty'=>$item->qty,
                'operator'=>$item->opertaor,
                'tgl_order'=>$date,
                'operator'=>$opr
            ]);
        }
        TempCart::truncate();
        $last = Invoice::get()->last();
        return redirect('detailreport/'.$last->id);
    }else{
        $no_inv = $cek->no_inv;
        $new_no =substr($no_inv,-3,3)+1;
        $new_inv = "AVN-".$new_no;
        Invoice::insert([
            'no_inv'=> $new_inv,
            'jns'=>$req->jns,
            'total'=>$req->total,
            'tunai'=>$req->tunai,
            'kembalian'=>$req->kembalian,
            'tgl_pembayaran'=>$date,
            'operator'=>$opr,
            'no_rek'=>$req->norek
        ]);
        foreach($getall as $item){
            Laporan::insert([
                'no_inv'=> $new_inv,
                'id_produk'=>$item->id_produk,
                'name_produk'=>$item->name_produk,
                'total_harga'=>$item->total_harga,
                'qty'=>$item->qty,
                'operator'=>$item->opertaor,
                'tgl_order'=>$date,
                'operator'=>$opr
            ]);
        }
        TempCart::truncate();
        $last = Invoice::get()->last();
        return redirect('detailreport/'.$last->id);
    }
 }
}

