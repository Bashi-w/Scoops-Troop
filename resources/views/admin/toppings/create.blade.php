@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
         <a href="/admin/toppings"><i class="mdi mdi-arrow-left" style="font-size: 24px;"></i></a>
         <h4 class="card-title">Create Topping</h4>

         <form method="POST" action="{{ route('admin.toppings.store') }}" enctype="multipart/form-data">
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
            
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection