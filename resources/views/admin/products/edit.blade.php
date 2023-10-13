@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <a href="/admin/products"><i class="mdi mdi-arrow-left" style="font-size: 24px;"></i></a>
         <h4 class="card-title">Edit Product Details</h4>
         <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="name" value="{{$product->name}}">
            </div>

            <div class="form-group">
               <label for="description" class="form-label">Description</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='description'>{{$product->description}}</textarea>
            </div>

            <div class="form-group">
               <img src="{{ asset('storage/' . $product->image) }}" alt="product Image" class="img-fluid" style="width:100px;">
               <label for="image" class="form-label">Image: {{$product->image}}</label>
               <input class="form-control" type="file" id="image" name="image" >
            </div>

            <div class="form-group">
               <label for="price" class="form-label">Price</label>
               <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="price" value="{{$product->price}}">
            </div>

            <div class="form-group">
               <label for="categories" class="form-label">Category</label>
               <br>
               <select id="categories" name="categories[]" class="w-100 p-3" multiple>
               @foreach ($categories as $category)
               <option value="{{ $category->id }}" @selected($product->categories->contains($category))>{{ $category->name }}</option>
               @endforeach
               </select>
            </div>
            
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button class="btn btn-light">Cancel</button>
         </form>
      </div>
   </div>
</div>
@endsection