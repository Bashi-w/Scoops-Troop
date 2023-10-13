@extends('layouts.guest')
@section('content')
<section id="hero">
    <div class="hero-container">
      
 <br>
 <br>
 <br>
 <br>  
<form method="POST" action="" enctype="multipart/form-data"  class="mx-auto col-10 col-md-8 col-lg-6">
@csrf

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInput1" name="name" value="{{ Auth::user()->name }}" required autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<!--<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <div class="mt-1">
        <select id="status" name="status" class="w-100 p-2">
                @foreach (App\Enums\OrderStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                @endforeach

        </select>
    </div>
    @error('status')
        <div class="text-sm text-red-400">{{ $message }}</div>
    @enderror
</div>-->

<div class="mb-3">
    <label for="product_id" class="form-label @error('quantity') is-invalid @enderror"> Product
    </label>
    <div class="mt-1">
        <select id="product_id" name="product_id" class="form-multiselect block w-100 p-2">
            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                   {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>   
</div>

<div class="mb-3">
    <label for="topping_id" class="form-label @error('quantity') is-invalid @enderror"> Topping
    </label>
    <div class="mt-1">
        <select id="topping_id" name="topping_id" class="form-multiselect block w-100 p-2">
            @foreach ($toppings as $topping)
                <option value="{{ $topping->id }}">
                    {{ $topping->name }}
                </option>
            @endforeach
        </select>
    </div>   
</div>

<div class="mb-3">
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

<!--<div class="mb-3">
    <label for="date" class="form-label @error('date') is-invalid @enderror">Date</label> 
    <input type="date" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="date" required autofocus>
    @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>-->
<!--
<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="price">
</div>-->

<a href="/" class="btn btn-primary">Cancel</a>
<button type="submit" class="btn btn-primary ">OK</button>

</form>


    
    </div>
    <br>
    <br>
  </section>

  <main id="main"></main>
@endsection