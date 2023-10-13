@extends('layouts.admin')

@section('content')
<h1>Edit Order</h1>

<form method="POST" action="{{ route('admin.orders.update', $order->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" name="name" value="{{$order->name}}">
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>


@endsection