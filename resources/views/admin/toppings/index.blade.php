@extends('layouts.admin')

@section('content')

<a href="{{ route('admin.toppings.create') }}" class="btn btn-primary">Create Topping</a>
<br>
<br>
<section class="intro">
  <div class="gradient-custom-1 h-100">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="table-responsive bg-white">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">PRICE</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($toppings as $topping)
                  <tr>
                    <td scope="row" style="color: #666666;">{{$topping->name}}</td>
                    <td>{{$topping->description}}</td>
                    <td>{{$topping->price}}</td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="d-flex flex-row buttons">
                            <a href="{{ route('admin.toppings.edit', $topping->id) }}"
                                class="btn btn-primary">Edit</a>
                            <form method="POST"
                                action="{{ route('admin.toppings.destroy', $topping->id) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>
                    </td>                 
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection