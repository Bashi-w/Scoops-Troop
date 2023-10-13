@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <a href="/admin/products"><i class="mdi mdi-arrow-left" style="font-size: 24px;"></i></a>
         <h4 class="card-title">Create Product</h4>

         <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" >
            @csrf

            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInput1" aria-describedby="emailHelp" name="name" required autofocus placeholder="Enter Name">
            </div>

            <div class="form-group">
               <label for="description" class="form-label">Description</label>
               <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name='description' required autofocus placeholder="Enter Description"></textarea>
            </div>

            <div class="form-group">
               <label for="price" class="form-label">Price</label>
               <input type="text" class="form-control @error('price') is-invalid @enderror" id="exampleInput1" aria-describedby="emailHelp" name="price" required autofocus placeholder="Enter Price">
            </div>

            <div class="form-group">
               <label for="categories" class="form-label">Category</label>
               <br>
               <select id="categories" name="categories[]" class="w-100 p-3" multiple>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
               </select>
            </div>
            
            <div class="form-group">
               <label for="image" class="form-label">Image</label>
               <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
         </form>
      </div>
   </div>
</div>
@endsection