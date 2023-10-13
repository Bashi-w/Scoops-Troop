@extends('layouts.admin')

@section('content')

<a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Create Order</a>
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
                    <th scope="col">Customer ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price (LKR)</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->customer_id}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}.00</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->order_date}}</td>
                    
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="d-flex flex-row buttons">
                           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Status
                            </button>
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  @foreach ($orders as $order)
                                  <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="modal-body">
                                  <div class="mb-3">                                       
                                        <label for="status" class="form-label">Order id: {{$order->id}} : {{$order->status}}</label>
                                        <div class="mt-1">
                                        <select id="status" name="status" class="w-100 p-2">
                                            @foreach (App\Enums\OrderStatus::cases() as $status)
                                            <option>
                                                {{ $status->name }}</option>
                                            @endforeach                                            
                                        </select>
                                        </div>
                                        @error('status')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Change</button>
                                  </div>
                                  </form>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                                <form method="POST"
                                action="{{ route('admin.orders.destroy', $order->id) }}"
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