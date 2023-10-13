@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Edit Category Details</h4>
         <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="name" value="{{$category->name}}">
            </div>
            <div class="form-group">
               <label for="description" class="form-label">Description</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name='description'>{{$category->description}}</textarea>
            </div>
            <div class="form-group">
               <img src="{{ asset('storage/' . $category->image) }}" alt="category Image" class="img-fluid" style="width:100px;">
               <label for="image" class="form-label">Image: {{$category->image}}</label>
               <input class="form-control" type="file" id="image" name="image" >
            </div>
      </div>
      <button type="submit" class="btn btn-primary me-2">Update</button>
      <a class="btn btn-light" href="/admin/categories">Cancel</a>
      </form>
   </div>
</div>
</div>
@endsection