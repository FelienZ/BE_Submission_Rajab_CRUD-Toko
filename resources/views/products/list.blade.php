<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Website Jual Beli Barang Bekas</title>
  </head>
  <body>
    
  <div class="bg-dark py-3">
    <h3 class="text-white text-center">Toko HP Online</h3>
  </div>
  <div class="container">
    <div class="row d-flex justify-content-center mt-4">
    <div class="col-md-10 d-flex justify-content-end">
        <a href="{{route('products.create')}}" class="btn btn-dark">Jual</a>
    </div>
        @if(Session::has('success'))
        <div class="col-md-10 mt-4">
        <div class="alert alert-success">{{Session::get('success')}}
        </div>
        </div>
        @endif
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Display Produk</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th>Nama_Barang</th>
                            <th>Harga</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @if($products->isNotEmpty())
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @if($product->image != "")
                                <img width="90" height="100" src="{{asset('uploads/products/'.$product->image)}}" alt="">
                                
                                @endif
                            </td>
                            <td>{{$product->Nama_Barang}}</td>
                            <td>{{$product->Harga}}</td>
                            <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                            <td>
    <div class="d-flex justify-content-center gap-2 align-items-center">
        <!-- Tombol Edit -->
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>

        <!-- Tombol Beli -->
        <form id="buy-product-form-{{ $product->id }}" action="{{ route('products.purchase', $product->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="button" class="btn btn-success" onclick="confirmAction('buy', {{ $product->id }})">Beli</button>
        </form>

        <!-- Tombol Delete -->
        <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="confirmAction('delete', {{ $product->id }})">Delete</button>
        </form>
    </div>
</td>



                        </tr>
                        @endforeach
                        
                        @endif
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<script>
    function confirmAction(action, id) {
        let message = action === 'buy'
            ? "Apakah Anda yakin ingin membeli produk ini?"
            : "Apakah Anda yakin ingin menghapus produk ini?";
        
        if (confirm(message)) {
            const formId = action === 'buy'
                ? `buy-product-form-${id}`
                : `delete-product-form-${id}`;
            document.getElementById(formId).submit();
        }
    }
</script>
