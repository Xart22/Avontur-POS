<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Laporan;
use App\Models\DeleteLap;

class LaporanControllers extends Controller
{
    public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $y = date('Y');
        $m = date('m');
        $bulanan = Invoice::whereYear('tgl_pembayaran','=',$y)->whereMonth('tgl_pembayaran','=',$m)->get();
        $itemtotal=[];
        foreach($bulanan as $item){
            array_push($itemtotal,$item->total);
        }
        $total = array_sum(str_replace('Rp. ','',$itemtotal));
        return view('admin.report',['invoice'=>Invoice::where('tgl_pembayaran','=',$date)->get()],['total'=>(int)$total]);
    }
    public function detail($id){
        $getinv = Invoice::find($id);
        $noinv = $getinv->no_inv;
        $laporan = Laporan::where('no_inv','=',$noinv)->get();
        return view('admin.detail_struk',['invoice'=>$getinv],['laporan'=>$laporan]);
    }


    public function bulanan(){
        return view('admin.report_bln',['laporan'=>Laporan::get()]);
    }






    public function delete(Request $req){
       if(session('loggedUser')->isAdmin === 1){
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $getinv = Invoice::where('no_inv','=',$req->no_inv)->get()->first();
        $laporan = Laporan::where('no_inv','=',$req->no_inv)->get();
        $delete = new DeleteLap;
        $delete->no_inv = $req->no_inv;
        $delete->total = $getinv->total;
        $delete->operator = $getinv->operator;
        $delete->keterangan = $req->keterangan;
        $delete->tgl_delete=$date;
        $delete->save();
        Invoice::where('no_inv','=',$req->no_inv)->delete();
        Laporan::where('no_inv','=',$req->no_inv)->delete();
        return back()->with('success',"Sukses");

       }else{
           return back()->with('fail','Gagal Delete');
       }
    }

}
