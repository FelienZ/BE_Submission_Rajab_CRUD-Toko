<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //show dashboard pages
    public function index(){

        return redirect()->route('products.index');
        
        // return view('dashboard');

    }
}
