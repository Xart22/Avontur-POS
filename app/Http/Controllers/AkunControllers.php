<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AkunControllers extends Controller
{
    public function index(){
        return view('admin.akun',['akun'=>User::get()]);
    }

    public function detailAkun($id){
        return view('admin.akun_detail',['akun'=>User::where('id',$id)->get()]);
    }

    public function addAkun(Request $req){
        $req->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:12',
            'isRole'=>'required'
        ]);
        $add_akun =new User;
        $hash = Hash::make($req->password);
        $add_akun ->username = $req->username;
        $add_akun ->password = $hash;
        $add_akun->isAdmin = $req->isRole;
        $save = $add_akun->save();

        if ($save) {
            return back()->with('success','Sukses menambah user');
        }else{
            return back()->with('fail','Gagal menambah user');
        }

    }

    public function updateAkun(Request $req){
        $req->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:12',
            'isRole'=>'required'
        ]);
        $pass = Hash::make($req->password);

        $update = User::where('id','=',$req->id)->update(['username'=> $req->username,'password'=>$pass,'isAdmin'=>$req->isRole]);
        if ($update) {
            return redirect('/akun')->with('success','Sukses memperbarui akun');
        }else{
            return redirect('/akun')->with('fail','Gagal memperbarui akun');
        }

    }

    public function deleteAkun(Request $req){
        $del = User::where('id','=',$req->id)->delete();
        if ($del) {
            return redirect('/akun')->with('success','Sukses menghapus akun');
        }else{
            return redirect('/akun')->with('fail','Gagal menghapus akun');
        }

    }
    
}
