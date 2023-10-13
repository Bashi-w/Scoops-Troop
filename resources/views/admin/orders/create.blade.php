@extends('layouts.admin')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
   <div class="card">
      <div class="card-body">
        <a href="/admin/orders"><i class="mdi mdi-arrow-left" style="font-size: 24px;"></i></a>
        <br>
         <h4 class="card-title">Create Order</h4>
         <form method="POST" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data"  >
            @csrf
            <div class="form-group">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInput1" name="name" required autofocus placeholder="Enter Name">
            </div>
            <div class="form-group">
               <label for="status" class="form-label">Status</label>
               <div class="mt-1">
                  <select id="status" name="status" class="w-100 p-2">
                     @foreach (App\Enums\OrderStatus::cases() as $status)
                     <option value="{{ $status->value }}">{{ $status->name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="product_id" class="form-label @error('quantity') is-invalid @enderror"> Product
               </label>
               <div class="form-group">
                  <select id="product_id" name="product_id" class="form-multiselect block w-100 p-2">
                     @foreach ($products as $product)
                     <option value="{{ $product->id }}">
                        {{$product->id}}: {{ $product->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="topping_id" class="form-label @error('quantity') is-invalid @enderror"> Topping
               </label>
               <div class="mt-1">
                  <select id="topping_id" name="topping_id" class="form-multiselect block w-100 p-2">
                     @foreach ($toppings as $topping)
                     <option value="{{ $topping->id }}">
                        {{$topping->id}}: {{ $topping->name }}
                     </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="serving" class="form-label @error('quantity') is-invalid @enderror"> Serving Type
               </label>
               <div class="mt-1">
                  <select name="serving" id="serving" class="form-multiselect block w-100 p-2">
                     <option value="csmall">Cone: small</option>
                     <option value="cmedium">Cone: medium</option>
                     <option value="clarge">Cone: large</option>
                     <option value="csingle">Cup: Single Scoop</option>
                     <option value="cdouble">Cup: Double Scoop</option>
                     <option value="ctriple">Cup: Triple Scoop</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="quantity" class="form-label @error('quantity') is-invalid @enderror"> Quantity
               </label>
               <div class="mt-1">
                  <input type="number" id="quantity" name="quantity" class="w-100 p-2" name="quantity" min="1" value="1" required autofocus >
                  @error('quantity')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="form-group">
               <label for="date" class="form-label @error('date') is-invalid @enderror">Date</label> 
               <input type="date" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="date" required autofocus>
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection