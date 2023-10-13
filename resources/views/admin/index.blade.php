@extends('layouts.admin')

@section('content')

<div class="me-md-3 me-xl-5">
    <h2>Welcome back</h2>
    <p class="mb-md-0">Your analytics</p>
    <hr>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body dashboard-tabs p-0">
        <ul class="nav nav-tabs px-4" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Users</a>
          </li>
        </ul>
        <div class="tab-content py-0 px-0">
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <div class="d-flex flex-wrap justify-content-xl-between">
              <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-chart-pie icon-lg me-3 text-warning"></i>                         
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Orders</small>
                  <h5 class="me-2 mb-0">{{ $totalOrders}}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total today</small>
                  <h5 class="me-2 mb-0">{{ $todayOrders }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-calendar-blank me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total this month</small>
                  <h5 class="me-2 mb-0">{{ $ordersThisMonth }}</h5>
                </div>
              </div>
              <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-calendar-multiple me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total this year</small>
                  <h5 class="me-2 mb-0">{{$ordersThisYear}}</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
            <div class="d-flex flex-wrap justify-content-xl-between">
              <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-grid-large icon-lg me-3 text-primary"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Products</small>
                  <h5 class="me-2 mb-0">{{ $totalProducts}}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-checkerboard me-3 icon-lg text-warning"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Categories</small>
                  <h5 class="me-2 mb-0">{{ $totalCategories }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-view-headline me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Toppings</small>
                  <h5 class="me-2 mb-0">{{ $totalToppings }}</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
            <div class="d-flex flex-wrap justify-content-xl-between">
              <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-multiple icon-lg me-3 text-primary"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Users</small>
                  <h5 class="me-2 mb-0">{{ $totalAllUsers }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-emoticon me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Customers</small>
                  <h5 class="me-2 mb-0">{{ $totalUser }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-key me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Total Admins</small>
                  <h5 class="me-2 mb-0">{{ $totdalAdmin }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Messages</h4>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($messages as $message)
            <tr>
            <td>{{$message->name}}</td>
            <td>{{$message->email}}</td>
            <td>{{$message->subject}}</td>
            <td>{{$message->message}}</td>           
            <td>{{ $message->created_at->format('Y-m-d') }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection
