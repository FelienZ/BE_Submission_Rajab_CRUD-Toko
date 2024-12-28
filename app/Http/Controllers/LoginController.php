<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //login page customer
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validator->passes()){

            if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
                
                if (Auth::user()->name == "Admin") {
                    return redirect()-> route('account.login')->with('error','Anda terdafatar sebagai admin , gunakan url lain');    
                }

                // success login
                return redirect()->route('account.dashboard');


            }else{

                // gagal login
                return redirect()-> route('account.login')->with('error','Email atau Password Salah');
            }

        }else{
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    public function register(){
        return view('register');

    }
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        if($validator->passes()){
           $user = new User();
           $user-> name = $request-> name;
           $user-> email = $request-> email;
           $user-> password = Hash::make($request-> password);
           $user-> role = 'customer';
           $user-> save();
           return redirect()->route('account.login')->with('success','Register Berhasil!');
          
           
        }else{
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
}
