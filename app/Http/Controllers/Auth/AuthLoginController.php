<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthLoginController extends Controller
{
public function index(){
    if(!session('loggedUser')){
        return view('auth.login'); 
    }else{
        return redirect('/dashboard');
    }
    
}
public function login(Request $request){


    $request->validate([
        'username'=>'required',
        'password'=>'required|min:5|max:12'
    ]);

     $usr = User::where('username','=',$request->username)->firstorfail();
     if (!$usr) {
         return back()->with('fail','Wrong username or password');
     } else {
         if(Hash::check($request->password, $usr->password)){
             $request->session()->put('loggedUser',$usr);
            // dd(session());
            date_default_timezone_set('Asia/Jakarta');
            $date = now();
            $update = User::find($usr->id);
            $update->last_login = $date;
            $update->save();
             return redirect('/dashboard');
         }else{
             //dd(session());
            return back()->with('fail','Wrong username or password');
         }
     }
     
    
    
}

public function logout(Request $request){
    if(session()->has('loggedUser')){
        date_default_timezone_set('Asia/Jakarta');
            $date = now();
            $update = User::find(session('loggedUser')->id);
            $update->last_logout = $date;
            $update->save();
        session()->pull('loggedUser');
        return redirect('/');
    }
}





} 
