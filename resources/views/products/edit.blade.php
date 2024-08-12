<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel-CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <style>

  </style>
</head>



<body>
  <div class="bg-dark py-3">
    <h3 class="text-white text-center">Laravel-11</h3>
  </div>

  <div class="container">
    <!-- the back button -->
   <div class="row justify-content-center mt-4">
     <div class="col-md-10 d-flex justify-content-end">
       <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
     </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8"> 
        <div class="card border-0 shadow-lg my-4">
          <div class="card-header bg-dark">
            <h4 class="text-white">Edit Product</h4>
          </div>

          <form enctype="multipart/form-data" action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
    @csrf
    <div class="card-body">
        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label h5">Name</label>
            <input value="{{ old('name',$product->name) }}" type="text" class="form-control form-control-md @error('name') is-invalid @enderror" placeholder="Enter Name" name="name" required>
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label for="sku" class="form-label h5">SKU</label>
            <input value="{{ old('sku',$product->sku) }}" type="text" class="form-control form-control-md @error('sku') is-invalid @enderror" placeholder="Enter SKU" name="sku" required>
            @error('sku')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label h5">Price</label>
            <input value="{{ old('price',$product->price) }}" type="number" step="0.01" class="form-control form-control-md @error('price') is-invalid @enderror" placeholder="Enter Price" name="price" required>
            @error('price')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label h5">Description</label>
            <textarea name="description" id="description" class="form-control form-control-md" cols="30" rows="4" placeholder="Description">{{ old('description',$product->descriptiion) }}</textarea>
           
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image" class="form-label h5">Image</label>
            <input type="file" class="form-control form-control-md " name="image">
            @if ($product->image != "")
                  <img class="w-50 my-3" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
            @endif
           
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
            <button class="btn btn-lg btn-primary">Update</button>
        </div>
    </div>
</form>



        </div>
      </div>
    </div>
  </div>

</body>

</html>