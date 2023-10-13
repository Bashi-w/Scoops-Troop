@extends('layouts.admin')

@section('content')

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
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td scope="row" style="color: #666666;">{{$user->id}}</td>
                    <td>{{$user->name}}</td> 
                    <td>{{$user->email}}</td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="d-flex flex-row buttons">
                            <form method="POST"
                                action="{{ route('admin.customers.destroy', $user->id) }}"
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