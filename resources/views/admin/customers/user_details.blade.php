<style>
    .orders{
        margin-top:3em;
        display:grid;
        grid-template-columns:2fr 1fr;
    }
    .payment-records{
        margin-top:3em;
    }
    .dets {
    margin-top: 1em;
    display: flex;
    grid-gap: 2em;
    /* background-color: #f9f9f9; */
    padding: 20px;
    border-radius: 20px;
    width: fit-content;
    margin-bottom: 1em;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-left: auto; /* Horizontally center the div */
    margin-right: auto; /* Horizontally center the div */
  }

    .order-chart {
    margin-top: 20px;
    /* background-color: #f9f9f9; */
    padding: 20px;
    border-radius: 10px;
  }

  .order-chart2 {
    /* background-color: #f9f9f9; */
    padding: 20px;
    border-radius: 10px;
  }

  .orders {
    margin-top: 20px;
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    align-items: center; /* Vertically center the child elements */
  }

  .order-summary {
    /* background-color: #f9f9f9; */
    padding: 20px;
    border-radius: 10px;
    align-items:center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    height:fit-content;
  }

  .order-summary p{
    font-size:1em;
    font-weight:bolder;
  }


  .payment-records {
    margin-top: 20px;
    /* background-color: #f9f9f9; */
    padding: 20px;
    border-radius: 10px;
  }

  .payment-records h4 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  table.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  table.table th {
    background-color: #f0f0f0;
    padding: 10px;
    text-align: left;
  }

  table.table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
</style>
<div>
<h4><b>CUSTOMER DETAILS</b></h4>
    <div class="dets">
        <div class="image">
            <lord-icon
                src="https://cdn.lordicon.com/bhfjfgqz.json"
                trigger="hover"
                colors="primary:#121331"
                style="width:150px;height:150px">
            </lord-icon>
        </div>
        <div class="info">
            <p>ID: {{ $user->id }}</p>
            <p>Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Mobile Number: {{$user->mobile}}</p>
            <p>Address:  {{$user->house}}, {{$user->street}}, {{$user->city}}</p>
            <p>Total Orders: {{$orderCount}}</p>
        </div>
    </div>
    
    <!-- Add more user details as needed -->
</div>
<h4><b>ORDER HISTORY</b></h4>
<div class="order-chart">
    <canvas id="orderChart"></canvas>
</div>
<br>
<div class="orders">
    <div class="order-chart2">
        <canvas id="orderChart2"></canvas>
    </div>
    <div class="order-summary">
        <p>Total Paid: {{$totalPrice}}.00 LKR</p>
        <p>Total Orders: {{$orderCount}}</p>
    </div>
</div>


<!-- Display payment records -->
<div class="payment-records">
    <h4><b>PAYMENT HISTORY</b></h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Payment Date</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Order Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->price }} LKR</td> <!-- Display the order price -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!-- Include the Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Function to initialize or update the chart
    function createOrUpdateChart(labels, data) {
        if (window.myChart) {
            // Clear the existing chart instance
            window.myChart.destroy();
        }

        if (window.myChart2) {
            // Clear the existing chart instance
            window.myChart2.destroy();
        }


        // Get the chart canvas element
        const orderCtx = document.getElementById('orderChart');
        const orderCtx2 = document.getElementById('orderChart2');

        // Check if orderCtx exists before creating the chart
        if (orderCtx) {
            // Create a new chart
            window.myChart = new Chart(orderCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Orders',
                        data: data,
                        borderWidth: 1,
                        borderColor: 'rgba(216, 72, 194, 1)',
                        pointBackgroundColor: 'rgba(216, 72, 194, 1)',
                        pointBorderColor: 'white',
                        pointRadius: 5,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                font: {}
                            }
                        }
                    }
                }
            });
        }

        if (orderCtx2) {
            // Create a new chart
            window.myChart2 = new Chart(orderCtx2, {
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

        }
    }

    // Initial data for the chart
    createOrUpdateChart(@json($labels), @json($data));
</script>
