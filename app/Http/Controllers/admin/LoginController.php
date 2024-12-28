<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validator->passes()){

            if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password])){

                // success login
                
                if(Auth::guard('admin')->user()->role != "admin") {

                    Auth::guard('admin')->logout();
                    
                    return redirect()-> route('admin.login')->with('error','Hanya admin yang dapat mengakses halaman');
                }

                // set session sebagai admin
                session(['role' => 'admin']);


                return redirect()->route('admin.dashboard');

            }else{

                
                // gagal login

                return redirect()-> route('admin.login')->with('error','Email atau Password Salah');
            }
        }else{
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()-> route('admin.login');
    }
}
