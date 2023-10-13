@extends('layouts.profile')

@section('content')
@if (Session::has('success'))
    <script>
        alert('{{ Session::get('success') }}');
    </script>
@endif
<div class="settings-container">
  <div class="left">
    <div class="profile">
        <div class="basics">
          <div class="basic-top"> 
          <lord-icon
              src="https://cdn.lordicon.com/bhfjfgqz.json"
              trigger="hover"
              colors="primary:#121331"
              style="width:150px;height:150px">
          </lord-icon>
            <p><b>{{Auth::user()->name}}</b></p>
          </div>

            <div class="basic-d">
                <p><b>User ID: </b>{{Auth::user()->id}}</p>
                <p><b>Email address: </b>{{Auth::user()->email}}</p>
                <p><b>Mobile number: </b>{{Auth::user()->mobile}}</p>
                <p><b>Address: </b>{{Auth::user()->house}}, {{Auth::user()->street}}, {{Auth::user()->city}}</p>
                <p><b>Date of Birth: </b>{{Auth::user()->dob}}</p>
                <br>
                <p><b>You are logged in to {{$branch->location}} branch</b></p>
            </div>

        </div>
    
        <br>
        <hr>
        <div style="text-align: center;">
          <a href="{{ route('user.edit', Auth::user()->id) }}" style="text-decoration: none; display: inline-block; margin: 0 10px;">
            <lord-icon
              src="https://cdn.lordicon.com/edxgdhxu.json"
              trigger="hover"
              colors="primary:#4be1ec,secondary:#cb5eee"
              style="width:50px;height:50px;">
            </lord-icon>
            <br>
            <span>Edit</span>
          </a>

          <form
              id="delete-account-form-icon"
              action="{{ route('user.destroy', Auth::user()->id) }}"
              method="POST"
              style="display: inline-block; margin: 0 10px;"
          >
              @csrf @method('DELETE')
              <a href="#" style="text-decoration: none;" onclick="return confirmDelete();">
                  <lord-icon
                      src="https://cdn.lordicon.com/tntmaygd.json"
                      trigger="hover"
                      colors="primary:#4be1ec,secondary:#cb5eee"
                      style="width:50px;height:50px;"
                  >
                  </lord-icon>
                  <br>
                  <span>Delete Account</span>
              </a>
          </form>

          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none; display: inline-block; margin: 0 10px;">
            <lord-icon
                src="https://cdn.lordicon.com/hcuxerst.json"
                trigger="hover"
                colors="primary:#4be1ec,secondary:#cb5eee"
                style="width:50px;height:50px;">
            </lord-icon>     
            <br>
            <span>Logout</span>
          </a>

        </div>

    </div>

    <br>

    <div class="product">
      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front">
            <h4><b> Favourite Scoop</b></h4>
            <lord-icon
                src="https://cdn.lordicon.com/tyvtvbcy.json"
                trigger="loop"
                colors="primary:#121331"
                style="width:200px;height:200px">
            </lord-icon>
            <p>Hover to reveal</p>
          </div>
         <div class="flip-card-back">
            @if ($mostOrderedProduct)
                <img src="{{ asset('storage/' . $mostOrderedProduct->image) }}" class="card-img-top" alt="product image">
                <p class="pName">{{ $mostOrderedProduct->name }}</p>
                <p>You have the highest purchase rate for this product</p>
            @else
                <p>No most ordered product found</p>
            @endif
        </div>

        </div>
      </div>
    </div>
    

  </div>
    
    <div class="history">
        
    <ul class="box-info">
				<li>   
        <lord-icon
            src="https://cdn.lordicon.com/hyhnpiza.json"
            trigger="hover"
            colors="primary:#121331">
        </lord-icon>
					<span class="text">
						<h3>{{$orderCount}}</h3>
						<p>Total Orders</p>
					</span>
				</li>
				<li>
          <lord-icon
              src="https://cdn.lordicon.com/jsoeastu.json"
              trigger="hover"
              colors="primary:#121331">
          </lord-icon>
					<span class="text">
						<h3>{{$totalPrice}}.00 LKR</h3>
						<p>Total Spent</p>
					</span>
				</li>
                
				<li>
        <lord-icon
            src="https://cdn.lordicon.com/wdqztrtx.json"
            trigger="hover"
            colors="primary:#121331">
        </lord-icon>
					<span class="text">
						<h3>{{$abandonRate}}%</h3>
						<p>Abandon Rate</p>
					</span>
				</li>               
			</ul>

      <div class="chart-container">
        <div class="order-chart">
          <canvas id="orderChart"></canvas>
        </div>
        <div class="order-sum">
          <canvas id="orderChart2"></canvas>
        </div>

      </div>


      <br><br>
        <div class="order-history">
            <p><b>Order History</b></p>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Order Date</th>   
                        <th>Quantity</th>      
                        <th>Total Price (LKR)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="order-history">
                    @foreach($orders as $order)
                    <tr>
                    <td>{{$order->order_date}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->status}}</td>
                    <td><button type="button" class="btn btn-success view-order" data-order-id="{{ $order->id }}" data-order-price="{{ $order->price }}" data-order-status="{{ $order->status }}" data-bs-toggle="modal" data-bs-target="#orderModal">View</button></td>
                    <!-- Modal -->
                    <div class="modal fade" id="orderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="orderModalLabel">Order Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="orderItemsContainer">
                                    <!-- Order items will be dynamically added here -->
                                </div>
                                
                                <div class="modal-footer">
                                <p id="pricep"></p>
                                <form id="cancel-order-form" action="{{ route('cancel-order') }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Use the PUT method -->
                                    <input type="hidden" name="order_id" id="order_id" value="">
                                    <button type="submit" class="btn btn-danger" id="cancel">Cancel Order</button>
                                </form>
                                <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" id="order_id_pay" value="">
                                    <button id="pay" class="btn btn-success" type="submit">Pay</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    </tr>
                    
                    @endforeach

                </tbody>


            </table>
        </div>
        <br>
        <br>
        <!-- <div class="purchase-history">
            <p><b>Purchase History</b></p>
            
        </div> -->
        
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var productImageBaseUrl = "{{ asset('storage/') }}/";
</script>

<script>
    const ctx = document.getElementById('orderChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels), // Pass PHP variable to JavaScript
            datasets: [{
                label: 'Number of Orders',
                data: @json($data), // Pass PHP variable to JavaScript
                borderWidth: 1,
                borderColor: 'rgba(216, 72, 194, 1)', // Line color
                pointBackgroundColor: 'rgba(216, 72, 194, 1)', // Point color
                pointBorderColor: 'white', // Point border color
                pointRadius: 5, // Point size
            }]
        },
        options: {
          scales: {
            y:{
              ticks:{
                font:{
                  // size: 15 //increase font size of y-axis items
                }
              }
            }
          }
        }
    });

    const ctx2 = document.getElementById('orderChart2');

    new Chart(ctx2, {
      type: "pie",
      data: {
        labels: [
          'Pending',
          'Cancelled',
          'Paid'
        ],
        datasets: [{
          label: 'Number of Orders',
          data: [
                {{ $unpaidOrders }},
                {{ $cancelledOrders }},
                {{ $paidOrders }}
            ],
          backgroundColor: [
            'rgb(193, 233, 246)',
            'rgb(246, 246, 196)',
            'rgb(244, 218, 218)'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Order Status' // Your title text here
          }
        }
      }
    });



    // get order items in modal

    document.addEventListener('DOMContentLoaded', function () {
    // Handle the click event of the "View" button
    document.querySelectorAll('.view-order').forEach(function (button) {
        button.addEventListener('click', function () {
            var orderId = this.dataset.orderId;
            var orderPrice = this.dataset.orderPrice;
            var orderStatus = this.dataset.orderStatus;

            const orderIdInput = document.getElementById('order_id');
            orderIdInput.value = orderId;

            const orderIdInput2 = document.getElementById('order_id_pay');
            orderIdInput2.value = orderId;

            var priceLabel = document.getElementById('pricep');
            priceLabel.textContent = 'Total price: ' +orderPrice+ '.00 LKR'; 


            var btnCancel = document.getElementById('cancel');
            var btnPay = document.getElementById('pay');

            if(orderStatus == "Paid" || orderStatus == "Cancelled"){
              btnCancel.style.display = "none";
              btnPay.style.display = "none";
            }
            if(orderStatus == "Pending"){
              btnCancel.style.display = "block";
              btnPay.style.display = "block";
            }

            btnCancel.addEventListener('click', function () {
                // Submit the form when the button is clicked
                document.getElementById('cancel-order-form').submit();
            });

            btnPay.addEventListener('click', function () {
                // Submit the form when the button is clicked
                document.getElementById('checkoutForm').submit();
            });

            // Make an AJAX request to fetch order items for the specific order
            fetch('/get-order-items/' + orderId) 
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function (data) {
                    // Handle the response data here and update the modal content
                    var modalBody = document.getElementById('orderItemsContainer');
                    modalBody.innerHTML = ''; // Clear previous content

                    // Iterate through order item details and append them to the modal body
                    data.forEach(function (orderItem) {
                        var productName = orderItem.product_name;
                        var toppingName = orderItem.topping_name;
                        var quantity = orderItem.quantity;
                        var separator = '<hr>';

                        // Create a variable to store the concatenated name
                        var fullName = productName;

                        // Add the topping name if it's not null
                        if (toppingName) {
                            fullName += ' with ' + toppingName;
                        }

                        // Concatenate product name and topping name if it's not null
                        var itemDetail = '<p><b>Product Name:</b> ' + fullName + '</p>';
                        var quantityDetail = '<p><b>Quantity:</b> ' + quantity + '</p>';
                       

                        modalBody.innerHTML += itemDetail + quantityDetail + separator ;
                    });
                })
                .catch(function (error) {
                    console.error('Fetch error:', error);
                });
        });
    });
});











</script>

<script>
    function confirmDelete() {
        var confirmResult = confirm('Are you sure you want to delete your account? This action cannot be undone.');
        if (confirmResult) {
            document.getElementById('delete-account-form-icon').submit();
        }
        return confirmResult; // Return true if confirmed, false otherwise
    }
</script>

@endsection
