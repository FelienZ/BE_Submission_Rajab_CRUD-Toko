<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class DashBoardController extends Controller
{
        //show admin dashboard pages
        public function index() {

            return redirect()->route('products.index');

            // return view('admin.dashboard');

        }
}
