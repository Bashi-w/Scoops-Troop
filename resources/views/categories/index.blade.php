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

</style>
  <!-- <section id="hero">
    <div class="hero-container">
      <h3><strong>Categories</strong></h3>
    </div>
  </section> -->

  @if (Session::has('success'))
      <script>
          alert('{{ Session::get('success') }}');
      </script>
  @endif

  <main id="main">
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title">
          <h2>Categories</h2>
          <h3>Select a <span>Category</span></h3>
        </div>   
        <div class="row portfolio-container">
        @foreach($categories as $category)
              <div class="col-lg-4 col-md-6 portfolio-item">
                <img src="{{ asset('storage/' . basename($category->image)) }}" alt="{{$category->name}}" class="img-fluid">
                <div class="portfolio-info">
                  <h4>{{$category->name}}</h4>
                  <a href="{{ route('categories.show', $category->id) }}" title="More Details"  class="details-link"><i class="bi bi-arrow-right"></i></i></a>
                </div>
              </div>
        @endforeach
        </div>   
      </div>
    </section>
  </main>


@endsection