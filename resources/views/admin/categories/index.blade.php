<?php
use Illuminate\Support\Facades\Storage;
?>
@extends('layouts.admin')

@section('content')

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
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
                    <th scope="col">IMAGE</th>
                    <th scope="col">DESCRIPTION</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                  <tr>
                    <td scope="row" style="color: #666666;">{{$category->name}}</td>
                    <td ><img src="{{ asset('storage/' . $category->image) }}" alt="{{$category->image}}" class="img-fluid" style="width:50px;"></td> 
                    <td>{{$category->description}}</td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="d-flex flex-row buttons">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="btn btn-primary">EDIT</a>
                            <form method="POST"
                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">DELETE</button>
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