@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Edit Category Details</h4>
         <form method="POST" action="{{ route('admin.toppings.update', $topping->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="name" value="{{$topping->name}}">
            </div>

            <div class="form-group">
               <label for="description" class="form-label">Description</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='description'>{{$topping->description}}</textarea>
            </div>

            <div class="form-group">
               <label for="price" class="form-label">Price</label>
               <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="price" value="{{$topping->price}}">
            </div>
            
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a class="btn btn-light" href="/admin/toppings">Cancel</a>
         </form>
      </div>
   </div>
</div>
@endsection