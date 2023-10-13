@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
      <a href="/admin/categories"><i class="mdi mdi-arrow-left" style="font-size: 24px;"></i></a>
         <h4 class="card-title">Create Category</h4>
         <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInput1" name="name" required autofocus placeholder="Enter Name">
               @error('name')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="description" class="form-label">Product Description</label>
               <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name='description' required autofocus placeholder="Enter Description"></textarea>
               @error('description')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="image" class="form-label">Image</label>
               <input class="form-control @error('description') is-invalid @enderror" type="file" id="formFile" name="image" required autofocus>
               @error('image')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection