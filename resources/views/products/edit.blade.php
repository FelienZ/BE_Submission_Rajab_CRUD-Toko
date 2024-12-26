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
        <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
    </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Edit Product</h3>
                </div>
                <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label h4">Nama Barang</label>
                        <input value="{{old('name', $product->Nama_Barang)}}" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }} form-control form-control-lg" placeholder="Name" name="name">
                        @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h4">Harga</label>
                        <input value="{{old('price', $product->Harga)}}" type="text" class="{{ $errors->has('price') ? 'is-invalid' : '' }} form-control form-control-lg" placeholder="Price" name="price">
                        @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h4">Deskripsi</label>
                        <textarea class="form-control" name="desc" placeholder="Desc" cols="30" rows="5">{{old('desc', $product->Deskripsi)}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h4">Foto</label>
                        <input type="file" class="form-control form-control-lg" placeholder="Img" name="img">

                         @if($product->image != "")
                                <img class="w-50 my-2" width="50" src="{{asset('uploads/products/'.$product->image)}}" alt="">
                                
                                @endif
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-dark text-white">Submit</button>
                    </div>
                </div>
              </form>
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