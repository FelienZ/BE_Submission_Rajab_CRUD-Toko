<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //showing pages prod
    public function index(){
    $products = Product::orderBy('created_at', 'DESC')->get();
    return view('products.list',[
        'products' => $products
    ]);
    }
    //create product
    public function create(){
    return view('products.create');
    }
    //store a product
    public function store(Request $request){
        $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric',
        'desc' => 'nullable|string'
        ];
        
        if($request->image != ""){
            $rules['img'] = 'image|mimes:jpg,jpeg,png|max:2048';
        }

    $validator = Validator::make($request->all(),$rules);

    if ($validator->fails()){
        return redirect()->route('products.create')->withInput()->withErrors($validator);
    }
    // store in db
    $product = new Product();
    $product->Nama_Barang = $request->name;
    $product->Harga  = $request->price;
    $product->Deskripsi = $request->desc;
    $product->save();

    if($request->hasFile('img')){
        $image = $request->file('img');
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
    
        $image->move(public_path('uploads/products'), $imageName);
    
        $product->image = $imageName;
        $product->save();
    }

    return redirect()->route('products.index')->with('success','Produk Berhasil Ditambahkan!');
    }
    //edit a product
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }
    //update a product
    public function update($id, Request $request){

        $product = Product::findOrFail($id);
        $rules = [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'desc' => 'nullable|string'
            ];
            
            if($request->image != ""){
                $rules['img'] = 'image|mimes:jpg,jpeg,png|max:2048';
            }
    
        $validator = Validator::make($request->all(),$rules);
    
        if ($validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }
        // Update product in db
        $product->Nama_Barang = $request->name;
        $product->Harga  = $request->price;
        $product->Deskripsi = $request->desc;
        $product->save();
    
        if($request->hasFile('img')){
            //delete old img
            File::delete(public_path('uploads/products/'.$product->image));
            $image = $request->file('img');
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
        
            $image->move(public_path('uploads/products'), $imageName);
        
            $product->image = $imageName;
            $product->save();
        }
    
        return redirect()->route('products.index')->with('success','Produk Berhasil Diperbarui!');
    }
    //delete a product
    public function destroy($id){
        $product = Product::findOrFail($id);
        //Hapus gambar
        File::delete(public_path('uploads/products/'.$product->image));
        //Hapus poduk dari db
        $product->delete();

        return redirect()->route('products.index')->with('success','Produk Berhasil Dihapus!');
    }

    public function purchase($id, Request $request){
    $product = Product::findOrFail($id);
    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
    }
    $totalPrice = $product->Harga;

    Transaction::create([
        'product_id' => $product->id, // ID produk (jika masih ingin melacak)
        'quantity' => 1, // Misalnya jumlah selalu 1, sesuaikan dengan kebutuhan
        'total_price' => $product->Harga,
        'product_name' => $product->Nama_Barang, // Tambahkan kolom nama produk ke transactions
        'product_description' => $product->Deskripsi, // Tambahkan kolom deskripsi ke transactions
    ]);

    if ($product->image) {
        File::delete(public_path('uploads/products/' . $product->image));
    }
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Pembelian berhasil dilakukan!');
}

    public function transactions(){
    $transactions = Transaction::with('product')->orderBy('created_at', 'DESC')->get();
    return view('transactions.list', compact('transactions'));
    }

}
