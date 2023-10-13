@extends('layouts.guest')
@section('content')
<style>
      header{
        background-color:black;
    }
    /* footer{
        display:none;
    } */

    #main{
      margin-top:5%;
    }

    .breadcrumb-nav{
      margin-left:5%;
    }

    #not-available{
      text-align:center;
      margin-top:5%;
      font-weight: bold;
      background-color: #ffdddd; 
      padding: 5px; 
      border: 1px solid #ff0000; 
      border-radius: 5px;
    }

    nav{
      display: flex;
      justify-items:space-between;
      /* background-color:red; */
    }
</style>
<!-- <section id="hero">
    <div class="hero-container">
      <h3><strong>Cantegories/ {{$category->name}}/ Products </strong></h3>
    </div>
</section>  -->



<main id="main">
    <section id="portfolio" class="portfolio"> 
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="breadcrumb-nav">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
        <li class="breadcrumb-item" aria-current="page">Products</li>
      </ol>
      
    </nav>  
      <div class="container">
        <div class="section-title">
          <a href="{{route('categories.index')}}"><h2>< Back to Categories</h2></a>
          <p>{{$category->description}}</p>
          <br>
          <br>
          <h2>{{$category->name}}/ Products</h2>
        </div>

        <div class="product-container">
          <div class="my-cart">
            <lord-icon
              src="https://cdn.lordicon.com/hyhnpiza.json"
              trigger="hover"
              colors="primary:#121331"
              style="width:4em;height:4em"
              class="cart"
              data-bs-toggle="offcanvas" 
              data-bs-target="#offcanvasRight" 
              aria-controls="offcanvasRight"
            ></lord-icon>
            <span class="quantity" id="quantity">0</span> 
          </div>     

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasRightLabel"><b>My Cart</b></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div id="cart">

              </div>
              <div class="cart-buttons">
                <button class="btn btn-success" id="clear-btn">Clear Cart</button>
                <a href="{{route('cart.order')}}"><button class="btn btn-success">Order Cart</button></a>
              </div>
            </div>
          </div>

          <div class="products">
            @foreach($category->products as $product)
              <div class="card product">
                  <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><b>{{$product->name}}</b></h5>
                    <!-- <p>{{$product->id}}</p> -->
                    <p class="card-text">{{$product->description}}</p>
                    <b><p class="card-text text-success">{{$product->price}} LKR</p></b> 
                    
                    <!-- display if product is available -->
                    @php
                        $isAvailable = false;

                        // Check if the product is available in the specified branch
                        $stock = $product->stocks->where('branch_id', $storedBranch)->first();
                        if ($stock && $stock->quantity > 0) {
                            $isAvailable = true;
                        }
                    @endphp

                    <!-- Display availability status -->
                    @if ($isAvailable)
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                        <lord-icon
                            src="https://cdn.lordicon.com/hyhnpiza.json"
                            trigger="click"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-price="{{ $product->price }}"
                            data-product-image="{{ $product->image }}"
                            data-user-id="{{ Auth::user()->id }}"
                            class="add-to-cart-icon"
                        ></lord-icon>
                    @else
                        <p class="text-danger" id="not-available">Not Available</p>
                    @endif


                  </div>
              </div>
            @endforeach
          </div>
        </div>
        
      </div>
    </section>

    <br>
    <br>

    <!-- ======= Toppings Section ======= -->
    <section id="toppings" class="features">
      <div class="container">
      <div class="section-title">
          <h2>Toppings</h2>
          <h3>12 Different <span>Toppings</span></h3>
        </div>
        <div class="row">
        @foreach($toppings as $topping)
        <div class="col-lg-3 col-md-4 col-6 col-6">
            <div class="icon-box">
              <i class="ri-ice-cream-line" style="color: #ffbb2c;">🍨</i>
              <h3><a href="" >{{$topping->name}} : {{$topping->price}}LKR</a></h3>
            </div>
          </div>
          @endforeach
        
        </div>
      </div>
    </section><!-- End Toppings Section -->

    <br>
    <br>
    
   
  
</main>

<script>
    var productImageBaseUrl = "{{ asset('storage/') }}/";
</script>
<script>
    window.currentUser = {
        id: {{ Auth::user()->id }},
    };
    console.log("User ID:", window.currentUser.id);


        // Function to retrieve and set the selected region from session storage
        const storedBranch = sessionStorage.getItem('selectedBranch');
    if (storedBranch) {
        console.log(storedBranch);

    }
</script>


<script src="{{asset('assets/js/cart.js')}}"></script>

@endsection